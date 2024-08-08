@extends('backend.layouts.master')

@section('title')
    Create Category
@endsection

@section('content')
<div class="conainer m-5">
    <div class="card">
        <div class="card-body">
            <form action="{{Route('categories.store')}}" method="Post">
                @csrf()
                @method('POST')
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Category Title</label>
                    <input type="text" class="form-control" name="title" id="title" >
                </div>
                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Description</label>
                    <textarea class="form-control" name="description" id="description">
        
                    </textarea>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
</div>
@endsection