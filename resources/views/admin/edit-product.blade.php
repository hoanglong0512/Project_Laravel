@extends('layouts.main')
@section('main-content')
<h1 class="mt-4"> Cập Nhập Thông Tin Sản Phẩm</h1>
<form action="{{route('save-edit-product', ['id' => $product->id])}}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
<div class="row">
        <div class="col-6">
            <div class="form-group">
                <label for="">Tên Sản phẩm</label>
                <input type="text" name="name" class="form-control" value="{{$product->name}}">
                @error('name')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="">Danh mục</label>
                <select name="cate_id" class="form-control">
                    @foreach ($cates as $cate)
                    <option @if ($cate->id == $product->cate_id) selected @endif
                        value="{{$cate->id}}">{{$cate->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="">Giá Sản phẩm</label>
                <input type="number" name="price" class="form-control" value="{{$product->price}}">
                @error('price')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="">Mô tả ngắn</label>
                <textarea name="short_desc" class="form-control" rows="4">{{$product->short_desc}}</textarea>
                @error('short_desc')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="col-6">
            <div class="row">
                <div class="col-4 offset-4">
                    <img src="{{$product->image}}" class="img-fluid">
                </div>
            </div>
            <div class="form-group">
                <label for="">ảnh sản phẩm</label>
                <input type="file" name="image" class="form-control">
            </div>
            <div class="form-group">
                <label for="">Đánh giá sản phẩm</label>
                <input type="number" step="0.1" name="star" class="form-control" value="{{$product->star}}">
                @error('star')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="">Lượt xem</label>
                
                
                <input type="number" name="view" class="form-control" value="{{$product->views}}">
                @error('view')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                
            </div>
        </div>
        <div class="col-12">
            <div class="form-group">
                <label for="">Mô tả chi tiết</label>
                <textarea name="detail" class="form-control" rows="6">{{$product->detail}}</textarea>
                @error('detail')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class=" col-12 text-center">
            <button type="submit" class="btn btn-info">Lưu</button>
            <a href="./" class="btn btn-danger">Hủy</a>
        </div>
    </div>
@endsection