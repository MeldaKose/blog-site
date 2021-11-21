@extends('back.layouts.master')
@section('title','Category List')
@section('content')
    <table class="table">
        <thead>
        <tr>
            <th scope="col">id</th>
            <th scope="col">AD</th>
            <th scope="col">SLUG</th>
            <th scope="col">Created_at</th>
            <th scope="col">Updated_at</th>
        </tr>
        </thead>
        <tbody>
        @foreach($categories as $category)
            <tr>
                <th scope="row">{{$category->id}}</th>
                <td>{{$category->name}}</td>
                <td>{{$category->slug}}</td>
                <td>{{$category->created_at}}</td>
                <td>{{$category->updated_at}}</td>
                <td><button type="submit">SİL</button></td>
                <td><button type="submit">DÜZENLE</button></td>
            </tr>
    @endforeach

@endsection
