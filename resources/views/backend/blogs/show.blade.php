@extends('backend.layouts.master')
@section('content')
<h5>{{$blog->title}}</h5>
<div class="row">
    <div class="col-md-4">
        <img src="{{asset($blog->cover_image)}}" alt="{{$blog->title}}" style="width: 100px; height: 100px;">
    </div>
<div>
    {!! $blog->content !!}
</div>
@endsection