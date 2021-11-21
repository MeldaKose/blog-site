@extends('back.layouts.master')
@section('title','Tüm Sayfalar')
@section('content')
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary float-left">DataTables Example</h6>
        </div>
        <div class="card-body">
            <div id="orderSuccess" style="display:none" class="alert alert-success">
                Sıralama başarıyla güncellendi.
            </div>
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>Sırala</th>
                        <th>Fotoğraf</th>
                        <th>Başlık</th>
                        <th>Kategori</th>
                        <th>Görüntülenme</th>
                        <th>Oluşturulma Tarihi</th>
                        <th>Durum</th>
                        <th>İşlemler</th>
                    </tr>
                    </thead>
                    <tbody class="orders">
                    @foreach($pages as $page)
                        <tr id="page_{{$page->id}}">
                            <td>
                                <i class="fa fa-arrows-alt-v fa-3x handle" style="cursor:move"></i>
                            </td>
                            <td><img src="{{asset('public/uploads/'.$page->image)}}" width=200></td>
                            <td>{{$page->title}}</td>
                            <td>{{$page->hit}}</td>
                            <td>{{$page->created_at->diffforhumans()}}</td>
                            <td><input class="switch" page-id="{{$page->id}}"  type="checkbox" data-on="aktif"
                                       data-off="pasif" data-offstyle="danger" @if($page->status==1) checked @endif data-toggle="toggle"></td>
                            <td>
                                <a target="_blank" href="{{route('pages',$page->slug)}}" title="Görüntüle"
                                   class="btn btn-sm btn-success"><i class="fa fa-eye"></i><a/>
                                    <a href="{{route('pages.update',$page->id)}}" title="Düzenle"
                                       class="btn btn-sm btn-primary"><i class="fa fa-pen"></i><a/>
                                        <a href="{{route('pages.delete',$page->id)}}" title="Sil"
                                           class="btn btn-sm btn-danger"><i class="fa fa-times"></i></a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
@section('css')
    <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
@endsection
@section('js')
    <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Sortable/1.14.0/Sortable.min.js" ></script>
    <script>
        $('.switch').change(function (){
           id=$(this)[0].getAttribute('page-id');
           statu=$(this).prop('checked');
           $.get("{{route('pages.switch')}}",{id:id,statu:statu},function(data,status){
               console.log(data);
           });
        });
        $('.orders').sortable({
            handle:'.handle',
            update:function (){
                var siralama=$('.orders').sortable('serialize');
                $.get("{{route('pages.orders')}}?"+siralama,function(data,status){
                    $('#orderSuccess').show().delay(1000).fadeOut();
                });
            }
        });
    </script>
@endsection

