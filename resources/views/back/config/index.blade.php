@extends('back.layouts.master')
@section('title','Ayarlar')
@section('content')
    <div class="card shadow mb-4">
        <div class="card-body">
            <form method="post" action="{{route('config.update')}}">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Site Başlığı</label>
                            <input type="text" name="title" class="form-control" value="{{$config->title}}" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Site Aktiflik Durumu</label>
                            <select class="form-control" name="active">
                                <option @if($config->active==1) selected @endif value="1">Açık</option>
                                <option @if($config->active==0) selected @endif value="0">Kapalı</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Site Logosu</label>
                                <input type="file" name="logo" class="form-control" value="{{$config->logo}}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Site Faviconu</label>
                                <input type="file" name="favicon" class="form-control" value="{{$config->favicon}}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Facebook</label>
                                <input type="text" name="facebook" class="form-control" value="{{$config->facebook}}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Twitter</label>
                                <input type="text" name="twitter" class="form-control" value="{{$config->twitter}}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Github</label>
                                <input type="text" name="github" class="form-control" value="{{$config->github}}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Linkedin</label>
                                <input type="text" name="linkedin" class="form-control" value="{{$config->linkedin}}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Youtube</label>
                                <input type="text" name="youtube" class="form-control" value="{{$config->youtube}}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Instagram</label>
                                <input type="text" name="instagram" class="form-control" value="{{$config->instagram}}">
                            </div>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-primary btn-block" type="submit">Kaydet</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
