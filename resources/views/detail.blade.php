@extends('layouts.app')

@section('title')
    {{ $blog->title }}
@endsection

@section('content')
    <div class="container">
        <h1>{{ $blog->title }}</h1>
        <hr>
        <p>{{ $blog->content }}</p>
    </div>
@endsection
