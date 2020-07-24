@extends('layouts.main')
@section('main-content')
<h1 class="mt-4">Thêm Danh Mục</h1>
<form action="{{route('add-category')}}" method="POST">
    @csrf
    <div class="row">
        <div class="col-6">

            <div class="form-group">
                <label for="">Danh danh mục</label>
                <input type="text" name="name" class="form-control">
                @error('name')
                <div class="alert alert-danger">{{$message}}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="">Slug</label>
                <input type="text" name="slug" class="form-control">
                @error('slug')
                <div class="alert alert-danger">{{$message}}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="">ShowMenu</label>
                <div class="btn-group" data-toggle="buttons">
                    <label class="btn btn-primary active">
                        <input type="checkbox" checked name="show_menu" value="1" autocomplete="off">
                    </label>
                </div>
                <div class="form-group">
                    <label for="">Mô Tả Ngắn</label>
                    <textarea name="desc" class="form-control" rows="3"></textarea>
                    @error('desc')
                    <div class="alert alert-danger">{{$message}}</div>
                    @enderror
                </div>
            </div>

            <div class=" col-12 ">
                <button type="submit" class="btn btn-info">Lưu</button>
                <a href="{{route('admin.category')}}" class="btn btn-danger">Hủy</a>
            </div>
        </div>
        @endsection