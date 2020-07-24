@extends('layouts.main')
@section('main-content')
<h1 class="mt-4">Sửa Danh Mục</h1>
<form action="{{route('edit-cate', ['id' => $cates->id])}}" method="POST">
@csrf
    <div class="row">
        <div class="col-6">

            <div class="form-group">
                <label for="">Danh danh mục</label>
                <input type="text" name="name" class="form-control" value="{{$cates->name}}">
                @error('name')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="">Slug</label>
                <input type="text" name="slug" class="form-control" value="{{$cates->slug}}">
                @error('slug')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                    <label for="">ShowMenu</label>
                    <div class="btn-group" data-toggle="buttons">
                        <label class="btn btn-danger active">
                            <input type="checkbox" 
                            @if($cates->show_menu == 1)
                            checked
                            @endif
                            name="show_menu" value="1"  autocomplete="off">
                        </label>
                </div>
                
            </div>
            <div class="form-group">
                <label for="">Mô Tả Ngắn</label>
                <textarea name="desc" class="form-control" rows="3">{{$cates->desc}}</textarea>
                @error('desc')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class=" col-12 ">
            <button type="submit" class="btn btn-info">Lưu</button>
            <a href="{{route('admin.category')}}" class="btn btn-danger">Hủy</a>
        </div>
    </div>
</form>
</div>
@endsection