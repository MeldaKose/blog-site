@extends('back.layouts.master')
@section('title','Makale Oluştur')
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
        <form method="post" action="{{route('makaleler.store')}}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label>Makale Başlığı</label>
                <input type="text" name="title" class="form-control" value="{{old('title')}}" required>
            </div>
            <div class="form-group">
                <label>Makale Kategori</label>
                <select class="form-control" name="category" value="{{old('category')}}" required>
                    <option value="">Seçim Yapınız</option>
                    @foreach($categories as $category)
                        <option value="{{$category->id}}">{{$category->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label>Makale Fotoğrafı</label>
                <input type="file" name="image"  class="form-control">
            </div>
            <div class="form-group">
                <label>Makale İçeriği</label>
                <textarea name="message" id="editor" type="text" class="form-control" rows="4" required></textarea>
            </div>
            <div class="form-group">
                <button class="btn btn-primary btn-block" type="submit">Makaleyi Oluştur</button>
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
