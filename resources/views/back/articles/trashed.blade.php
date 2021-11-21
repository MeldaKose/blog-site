@extends('back.layouts.master')
@section('title','Tüm Makaleler')
@section('content')
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary float-left">DataTables Example</h6>
            <a href="{{route('makaleler.index')}}" class="btn btn-sm btn-warning float-right"><i class="fa fa-trash"></i>Aktif Makaleler</a>
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
                        <td><img src="{{$article->image}}" width=200></td>
                        <td>{{$article->title}}</td>
                        <td>{{$article->getcategory()}}</td>
                        <td>{{$article->hit}}</td>
                        <td>{{$article->created_at->diffforhumans()}}</td>

                        <td>
                            <a href="{{route('recover.article',$article->id)}}" title="Kurtar" class="btn btn-sm btn-success"><i class="fa fa-recycle"></i></a>
                            <a href="{{route('hard.delete.article',$article->id)}}" title="Sil" class="btn btn-sm btn-danger"><i class="fa fa-times"></i></a>
                        </td>
                    </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
 @endsection
