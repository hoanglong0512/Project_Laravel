@extends('layouts.main')
@section('main-content')
<h1 class="mt-4">Thêm Bài Viết</h1>
<form action="{{route('add.posts')}}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="row">
        <div class="col-6">

            <div class="form-group">
                <label for="">Tiêu Đề Bài Viết</label>
                <input type="text" name="title" class="form-control">
                @error('title')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror

            </div>
            <div class="form-group">
                <label for="">ảnh Bài Viết</label>
                <input type="file" name="image" class="form-control">
            </div>
            <div class="form-group">
                <label for="">Nội Dung</label>
                <textarea name="content" class="form-control" rows="3"></textarea>
                @error('content')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>


            <div class=" col-12 ">
                <button type="submit" class="btn btn-info">Lưu</button>
                <a href="{{route('index.posts')}}" class="btn btn-danger">Hủy</a>
            </div>
        </div>
        @endsection