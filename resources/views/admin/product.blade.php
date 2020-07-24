@extends('layouts.main')
@section('main-content')
<h1 class="mt-4"> Sản Phẩm</h1>
<form action="{{route('search.product')}}" method="get" class="col-12">
            <div class="form-group">
                @csrf
                <label for="">TÌM KIẾM</label>
                <input name="keyword" class="form-control form-control-dark w-50" value="{{$keyword}}" type="text" placeholder="Search" aria-label="Search">
            </div>
            <div class=" text-left ">
                <button type="submit" class="btn btn-primary btn-sm">Tìm Kiếm</button>

            </div>
<br>
<div class="card mb-4">
    <div class="card-header"><i class="fas fa-table mr-1"></i>Bảng Sản Phẩm</div>
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
                <th>Image</th>
                <th>Price</th>
                <th>Danh Mục</th>
                <th>
                    <a href="{{route('admin.add.product')}}" class="btn btn-success">Add new</a>
                </th>
            </thead>
            <tbody>
                @forelse($product as $pro)
                <tr>
                    <td>{{$pro->id}}</td>
                    <td>{{$pro->name}}</td>
                    <td>
                        <img src="{{$pro->image}}" class="img-avatar" width="100">
                    </td>
                    <td>{{$pro->price}}</td>
                    <td>{{$pro->getCategoryName()}}</td>
                    <td>

                        <a href="{{route('edit.product', ['id' => $pro->id])}}" class="btn btn-primary">Sửa</a>
                        <a onclick="openConfirm('{{route('delete.product', ['id' => $pro->id])}}')" href="javascript:;" class="btn btn-danger">Xóa</a>
                    </td>
                </tr>
                @empty
                    <div class="alert alert-danger">KHÔNG CÓ DANH MỤC NÀO !!!</div>
                @endforelse
            </tbody>
           
        </table>
        {{$product->links()}}
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