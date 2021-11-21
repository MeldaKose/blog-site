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
        <form method="post" action="" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label>Sayfa Başlığı</label>
                <input type="text" name="title" class="form-control" value="{{old('title')}}" required>
            </div>
            <div class="form-group">
                <label>Sayfa Fotoğrafı</label>
                <input type="file" name="image"  class="form-control">
            </div>
            <div class="form-group">
                <label>Sayfa İçeriği</label>
                <textarea name="message" id="editor" type="text" class="form-control" rows="4" required></textarea>
            </div>
            <div class="form-group">
                <button class="btn btn-primary btn-block" type="submit">Sayfayı Oluştur</button>
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
