@extends('back.layouts.master')
@section('title','Kategori')
@section('content')
    <div class="row">
        <div class="col-md-6">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Kategori Oluştur</h6>
            </div>
            <div class="card-body">
                @if($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>{{$error}}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form method="post" action="{{route('category.create')}}">
                    @csrf
                    <div class="form-group">
                        <label>Kategori Adı</label>
                        <input class="form-control" type="text" name="name" value="{{old('name')}}" required>
                    </div>
                    <div class="form-group">
                        <button class="btn btn-primary btn-block" type="submit">Kategoriyi Oluştur</button>
                    </div>
                </form>

            </div>

        </div>
        <div class="col-md-6">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Kategori Listesi</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th>Kategori Adı</th>
                            <th>Makale Sayısı</th>
                            <th>Oluşturulma Tarihi</th>
                            <th>Durum</th>
                            <th>İşlemler</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($categories as $category)
                            <tr>
                                <td>{{$category->name}}</td>
                                <td>{{$category->articleCount()}}</td>
                                <td>{{$category->created_at->diffforhumans()}}</td>
                                <td><input class="switch" category-id="{{$category->id}}" type="checkbox" data-on="aktif" data-off="pasif" data-offstyle="danger"
                                           @if($category->status==1) checked @endif data-toggle="toggle"></td>
                                <td>
                                    <a target="_blank" href="{{Route('category',$category->slug)}}" title="Görüntüle"
                                       class="btn btn-sm btn-success"><i class="fa fa-eye"></i><a/>
                                        <a category-id="{{$category->id}}" title="Düzenle"
                                           class="btn btn-sm btn-primary edit-click"><i class="fa fa-pen"></i><a/>
                                            <a category-id="{{$category->id}}" category-name="{{$category->name}}"
                                               category-count="{{$category->articleCount()}}" title="Sil"
                                               class="btn btn-sm btn-danger remove-click"><i
                                                    class="fa fa-times"></i></a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
    <!-- Modal -->
    <div id="editModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Kategoriyi Düzenle</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="post" action="{{route('category.update')}}">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Kategori Adı</label>
                            <input id="name" type="text" class="form-control" name="category">
                            <input type="hidden" id="category_id" name="id">
                        </div>
                        <div class="form-group">
                            <label>Kategori Slug</label>
                            <input id="slug" type="text" class="form-control" name="slug">
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Kapat</button>
                        <input type="submit" class="btn btn-primary" value="Kaydet">
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div id="deleteModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Kategoriyi Sil</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="body">
                    <div class="alert alert-danger" id="articleAlert"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Kapat</button>
                    <form method="post" action="{{route('category.delete')}}">
                        @csrf
                        <input type="hidden" name="id" id="deleteId">
                        <input id="deleteButton" type="submit" class="btn btn-primary" value="Sil">
                    </form>

                </div>
            </div>
        </div>

    </div>
    </div>


@endsection
@section('css')
    <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
@endsection
@section('js')
    <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
    <script>
        $('.switch').change(function(){
            id=$(this)[0].getAttribute('category-id');
            statu=$(this).prop('checked');
            $.get('{{route('category.switch')}}',{id:id,statu:statu},function(data,status){
                console.log(data);
            });
        });
        $('.remove-click').click(function () {
            id = $(this)[0].getAttribute('category-id');
            count = $(this)[0].getAttribute('category-count');
            name = $(this)[0].getAttribute('category-name');
            if (id == 1) {
                $('#articleAlert').html(name + ' kategorisi sabit bir kategoridir. Silinen diğer makaleler bu kategoriye eklenecektir.');
                $('#deleteButton').hide();
                $('#body').show();
                $('#deleteModal').modal();
                return;
            }
            $('#deleteButton').show();
            $('#deleteId').val(id);
            $('#body').hide();
            if (count > 0) {
                $('#articleAlert').html('Bu kategoriye ait' + count + 'makale bulunmaktadır.Silmek istediğinize emin misiniz?');
                $('#body').show();
            }
            $('#deleteModal').modal();

        });
        $('.edit-click').click(function () {
            var id = $(this)[0].getAttribute('category-id');
            $.ajax({
                type: 'GET',
                url: '{{route('category.getdata')}}',
                data: {id: id},
                success: function (data) {
                    console.log(data);
                    $('#name').val(data.name);
                    $('#category_id').val(data.id);
                    $('#slug').val(data.slug);
                    $('#editModal').modal('show');
                },
            });
        });
    </script>
@endsection

