@extends('front.layouts.master')
@section('title','Anasayfa')
@section('content')

    <!-- Main Content-->

    <div class="col-md-9 ">
  @include('Front.widgets.articleList')
    </div>

    @include('Front.widgets.categoryWidget')

@endsection
