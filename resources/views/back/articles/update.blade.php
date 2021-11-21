@extends('back.layouts.master')
@section('title',$articles->title. 'Makalesini Güncelle')
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
        <form method="post" action="{{route('makaleler.update',$articles->id)}}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label>Makale Başlığı</label>
                <input type="text" name="title" class="form-control" value="{{($articles->title)}}" required>
            </div>
            <div class="form-group">
                <label>Makale Kategori</label>
                <select class="form-control" name="category"  required>
                    <option value="">Seçim Yapınız</option>
                    @foreach($categories as $category)
                        <option @if($articles->category_id==$category->id) selected
                                @endif value="{{$category->id}}">{{$category->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label>Makale Fotoğrafı</label></br>
                <img src="{{asset($articles->image)}}" width="300" class="img-thumbnail rounded">
                <input type="file" name="image" class="form-control">
            </div>
            <div class="form-group">
                <label>Makale Mesajı</label>
                <textarea name="message" id="editor" type="text" class="form-control" rows="4"
                          required>{{$articles->content}}</textarea>
            </div>
            <div class="form-group">
                <input class="btn btn-primary btn-block" type="submit">Makaleyi Güncelle</input>
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
