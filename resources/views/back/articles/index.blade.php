@extends('back.layouts.master')
@section('title','Tüm Makaleler')
@section('content')
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary float-left">DataTables Example</h6>
            <a href="{{route('article.trashed')}}" class="btn btn-sm btn-warning float-right"><i
                    class="fa fa-trash"></i>Silinen Makaleler</a>
        </div>
        <div id="switchSuccess" style="display:none" class="alert alert-success">
             Makalenin durumu güncellendi.
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>Fotoğraf</th>
                        <th>Başlık</th>
                        <th>Kategori</th>
                        <th>Görüntülenme</th>
                        <th>Oluşturulma Tarihi</th>
                        <th>Durum</th>
                        <th>İşlemler</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($articles as $article)
                        <tr>
                            <td><img src="{{asset('public/uploads/'.$article->image)}}" width=200></td>
                            <td>{{$article->title}}</td>
                            <td>{{\App\Models\Category::where('id',$article->category_id)->first()->name}}</td>
                            <td>{{$article->hit}}</td>
                            <td>{{$article->created_at->diffforhumans()}}</td>
                            <td><input class="switch" article-id="{{$article->id}}"  type="checkbox" data-on="aktif"
                                       data-off="pasif" data-offstyle="danger" @if($article->status==1) checked @endif data-toggle="toggle"></td>
                            <td>
                                <a target="_blank" href="{{route('single',$article->slug)}}" title="Görüntüle"
                                   class="btn btn-sm btn-success"><i class="fa fa-eye"></i><a/>
                                    <a href="{{route('makaleler.edit',$article->id)}}" title="Düzenle"
                                       class="btn btn-sm btn-primary"><i class="fa fa-pen"></i><a/>
                                        <a href="{{route('delete.article',$article->id)}}" title="Sil"
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
    <script>
        $(function () {
            $('.switch').change(function () {
                id = $(this)[0].getAttribute('article-id');
                statu = $(this).prop('checked');
                $.get('{{route('article.switch')}}', {id:id, statu:statu}, function (data,status) {
                    console.log(data);
                    $('#switchSuccess').show().delay(1000).fadeOut();
                });
            });
        })
    </script>
@endsection
