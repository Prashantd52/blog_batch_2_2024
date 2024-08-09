@extends('backend.layouts.master')
@section('title')
Blog List
@endsection

@section('page-css')
<link rel="stylesheet" type="text/css" href="../../../app-assets/vendors/css/tables/datatable/datatables.min.css">
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

<link rel="stylesheet" type="text/css" href="../../../app-assets/vendors/css/editors/summernote.css">
<link rel="stylesheet" type="text/css" href="../../../app-assets/vendors/css/editors/codemirror.css">
<link rel="stylesheet" type="text/css" href="../../../app-assets/vendors/css/editors/theme/monokai.css">
@endsection

{{--@section('breadcum')
<li class="breadcrumb-item"><a href="{{Route('blogs.list')}}">Blogs</a></li>
@endsection--}}
@section('content')

@if(isset($blog))
<h3>Edit Blog</h3>
@else
<h3>Create Blog</h3>
@endif

<div class="card">
    <div class="card-body">
        <form  action="{{Route('blogs.store')}}" method="post" id="blog-form" enctype="multipart/form-data">
            @if(isset($blog))
                <input type="hidden" name="blog_id" value="{{$blog->id}}">
            @endif
            @csrf()
            @method('post')
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" name="title" id="title" class="form-control" placeholder="Enter title" value="{{ isset($blog) ? $blog->title : '' }}">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="title">Category</label>
                        <select name="category_id" id="category" class="form-control select2" placeholder="Enter title">
                            <option value="">Select Category</option>
                            @foreach($categories as $category)
                                <option value="{{$category->id}}" {{ isset($blog) ? ($blog->category_id == $category->id ? 'selected' : ''): ''}}>{{$category->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            @php
                if(isset($blog))
                    $blog_tags = $blog->tags()->pluck('id')->toArray();
            @endphp
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="title">Tags</label>
                        <select name="tags[]" id="tag" class="form-control select2" placeholder="Enter title" multiple>
                            @foreach($tags as $tag)
                                <option value="{{$tag->id}}" {{ isset($blog) ? (in_array($tag->id,$blog_tags) ? 'selected' : ''): ''}}>{{$tag->title}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="">Add Cover Image</label>
                        <input class="form-control" type="file" name="cover_image">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="form-group basic">
                        <label for="content">Content</label>
                        <textarea name="content" id="content" class="form-control summernote" placeholder="Enter content">{{ isset($blog)? $blog->content : ''}}</textarea>
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-center">
                <button type="submit"  class="btn btn-primary ml-auto">Submit</button>
            </div>
        </form>
    </div>
</div>
@endsection

@section('page-js')
<script src="../../../app-assets/vendors/js/tables/datatable/datatables.min.js"></script>
<script src="../../../app-assets/js/scripts/tables/datatables-extensions/datatables-sources.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script src="../../../app-assets/vendors/js/editors/codemirror/lib/codemirror.js"></script>
<script src="../../../app-assets/vendors/js/editors/codemirror/mode/xml/xml.js"></script>
<script src="../../../app-assets/vendors/js/editors/summernote/summernote.js"></script>
<!-- <script src="../../../app-assets/js/scripts/editors/editor-summernote.js"></script> -->
<script>
    $(document).ready(function() {
        $('.select2').select2();

         // Basic Summernote
        $('.summernote').summernote();
    });
</script>
@endsection