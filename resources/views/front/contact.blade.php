@extends('front.layouts.master')
@section('title','İletişim')
@section('bg')
@section('content')
    @if(session('success'))
        <div class="alert alert-success">{{session('success')}}</div>
    @endif
    @if($errors->any())
        <div class="alert alert-danger">
        <ul>
            @foreach($errors->all() as $error)
            <li>{{$error}}</li>
            @endforeach
        </ul>
        </div>
        @endif
    <main class="mb-4">
        <div class="container px-4 px-lg-5">
            <div class="row gx-4 gx-lg-5 justify-content-center">
                <div class="col-md-10 col-lg-8 col-xl-7">
                    <p>Bizimle iletişime geçebilirsiniz.</p>
                    <div class="my-5">
                        <form method="post"
                              action="{{Route('contactpost') }}">
                            @csrf
                            <div class="form-floating">
                                <input class="form-control" name="name" value="{{old('name')}}" type="text" placeholder="Adınızı giriniz..."
                                       required/>
                                <label for="name">Name</label>
                            </div>
                            <div class="form-floating">
                                <input class="form-control" name="surname" value="{{old('surname')}}" type="text"
                                       placeholder="Soyadınızı giriniz..." required/>
                                <label for="soyad">Soyad</label>
                            </div>
                            <div class="form-floating">
                                <div>
                                    <label for="konu">Konu</label>
                                    <select class="form-floating" name="topic" required>
                                        <option @if(old('topic')=='Bilgi') selected @endif>Bilgi</option>
                                        <option @if(old('topic')=='Destek') selected @endif>Destek</option>
                                        <option @if(old('topic')=='Genel') selected @endif>Genel</option>
                                    </select>

                                </div>
                            </div>
                            <div class="form-floating">
                                <input class="form-control" name="email" value="{{old('email')}}" type="email" placeholder="Email giriniz..."
                                       required/>
                                <label for="email">Email address</label>

                            </div>
                            <div class="form-floating">
                                <textarea class="form-control"  name="message" placeholder="Mesajınızı giriniz..."
                                          style="height: 12rem" required> {{old('message')}}</textarea>
                                <label for="message">Message</label>

                            </div>
                            <br/>

                            <!-- Submit Button-->
                            <button class="btn btn-primary text-uppercase " id="submitButton" type="submit">Gönder
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>
    @include('Front.widgets.categoryWidget')

@endsection

