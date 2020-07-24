@extends('layouts.main')
        @section('main-content')
        <h1 class="mt-4"> Danh Mục</h1>
  <form action="{{route('search-cate')}}" method="get" class="col-12">
            <div class="form-group">
                @csrf
                <label for="">TÌM KIẾM</label>
                <input name="keyword" class="form-control form-control-dark w-50" type="text" placeholder="Search" aria-label="Search">
            </div>
            <div class=" text-left ">
                <button type="submit" class="btn btn-primary btn-sm">Tìm Kiếm</button>

            </div>
            <br>
        <div class="card mb-4">
            <div class="card-header"><i class="fas fa-table mr-1"></i>Bảng Danh Mục</div>
            
            @if(isset($_GET['msg']))
<div class="alert alert-success alert-dismissible fade show text-danger">
  <strong>{{$msg}}</strong>
</div>
@endif
            <div class="card-body">
        <table class="table table-stripped">
            <thead>
                <th>ID</th>
                <th>Name</th>
                <th>Slug</th>
                <th>ShowMenu</th>
                <th>
                   <a href="{{route('add-category')}}" class="btn btn-success">Add new</a>
                </th>
            </thead>
            <tbody>    
            
                @forelse($category as $cate)
                <tr>
                    <td>{{$cate->id}}</td>
                    <td>{{$cate->name}}</td>
                    <td>{{$cate->slug}}</td>
                    <td>{{$cate->show_menu}}</td>
                    <td>
                        <a href="{{route('edit-cate', ['id' => $cate->id])}}" class="btn btn-primary">Sửa</a>
                        <a onclick="openConfirm('{{route('cate.remove', ['id' => $cate->id])}}')" href="javascript:;" class="btn btn-danger">Xóa</a>
                    </td>
                </tr>
                @empty
                    <div class="alert alert-danger">KHÔNG CÓ DANH MỤC NÀO !!!</div>
                @endforelse
            </tbody>
        </table>
        </div>
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>
   function openConfirm(removeUrl){
    swal({
  title: "Cảnh Báo",
  text: "Bạn Có Chắc Chắn Xóa Bảng Ghi ?",
  icon: "warning",
  buttons: true,
  dangerMode: true,
})
.then((willDelete) => {
  if (willDelete) {
   window.location.href = removeUrl;
  } 
});
   }
</script>
          </div>
        @endsection