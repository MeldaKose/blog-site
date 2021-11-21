@extends('back.layouts.master')
@section('title',$pages->title. 'Sayfa Güncelle')
@section('content')
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
        <form method="post" action="{{route('pages.update.post',$pages->id)}}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label>Sayfa Başlığı</label>
                <input type="text" name="title" class="form-control" value="{{($pages->title)}}" required>
            </div>
            <div class="form-group">
                <label>Sayfa Fotoğrafı</label></br>
                <img src="{{asset($pages->image)}}" width="300" class="img-thumbnail rounded">
                <input type="file" name="image" class="form-control">
            </div>
            <div class="form-group">
                <label>Sayfa Mesajı</label>
                <textarea name="message" id="editor" type="text" class="form-control" rows="4"
                          required>{{$pages->content}}</textarea>
            </div>
            <div class="form-group">
                <input class="btn btn-primary btn-block" type="submit">Sayfayı Güncelle</input>
            </div>
        </form>
    </div>
@endsection
@section('css')
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
@endsection
@section('js')
    <!-- include summernote css/js -->
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#editor').summernote()({
                'height': 300,
            });
        });
    </script>
@endsection
