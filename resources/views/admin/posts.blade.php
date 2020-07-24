@extends('layouts.main')
@section('main-content')
<h1 class="mt-4"> Bài Viết</h1>
<div class="col-4">
<div class="input-group input-group-sm">
        <input class="form-control form-control-navbar" type="search" id="search" name="search" placeholder="Search" aria-label="Search">
      </div>
</div>
<br>
@if(isset($_GET['msg']))
<div class="alert alert-success alert-dismissible fade show text-danger">
    <strong>{{$msg}}</strong>
</div>
@endif
<div class="card mb-4">
    <div class="card-header"><i class="fas fa-table mr-1"></i>Bảng Bài Viết</div>
    <div class="card-body">
        <table class="table table-stripped">
            <thead>
                <th>ID</th>
                <th>Tiêu Đề</th>
                <th>Image</th>
                <th>Tùy Chọn</th>
                <th>
                    <a href="{{route('add.posts')}}" class="btn btn-success">Add new</a>
                </th>
            </thead>
            <tbody>
                @if($posts)
                @foreach($posts as $po)
                <tr>
                    <td>{{$po->id}}</td>
                    <td>{{$po->title}}</td>
                    <td>
                        <img src="{{$po->image}}" class="img-avatar" width="100">
                    </td>
                    <td>

                        <a href="{{route('edit.posts', ['id' => $po->id])}}" class="btn btn-primary">Sửa</a>
                        <a onclick="openConfirm('{{route('remove.posts', ['id' => $po->id])}}')" href="javascript:;" class="btn btn-danger">Xóa</a>
                    </td>
                </tr>
                @endforeach
                @endif
            </tbody>

        </table>
        
    </div>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script>
        function openConfirm(removeUrl) {
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
        } </script> 

        <script type="text/javascript">
        $('#search').on('keyup',function(event){
            $value = $(this).val(); // nhận dữ liệu từ input
            // console.log($value);
            $.ajax({
                method: 'GET',
                url: "{{route('search-posts')}}",
                data: {
                    'search': $value
                },
                success:function(data){
                    $('tbody').html(data);
                }
            });
        })
        $.ajaxSetup({ headers: { 'csrftoken' : '{{ csrf_token() }}' } });
    </script>

   
</div>
@endsection