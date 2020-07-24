<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Posts;
use Illuminate\Support\Facades\DB;
class PostsController extends Controller
{
    public function index(){

        $posts = Posts::all();
        $msg = isset($_GET['msg']) ? $_GET['msg'] : null;
        return view('admin.posts', [
            'posts' => $posts,
            'msg' => $msg
        ]);
    }

    public function addForm(){
        return view('admin.add-posts');
    }

    public function saveForm(Request $request){
        //dd($request);
        $request->validate([
            'title' => 'required|unique:posts|min:4',
            'content' => 'required|min:15'
        ],[
            'title.required' => "hãy nhập tên tiêu đề",
            'title.unique' => "tên tiêu đề đã tồn tại",
            'title.min' => "nhập trên 4 ký tự",
            'content.required' => "Hãy nhập nội dung",
            'content.min' => "nhập trên 15 ký tự"    
        ]);
        
 
        $request = $_POST;
        
        $imgFile = $_FILES['image'];
        $model = new Posts();
        $model->fill($request);
        $filename = "";
        // // nếu có ảnh up lên thì lưu ảnh
        if ($imgFile['size'] > 0) {
            $filename = uniqid() . '-' . $imgFile['name'];
            move_uploaded_file($imgFile['tmp_name'], '../public/uploads/' . $filename);
            $filename = '/'.'uploads/' . $filename;
        }
        $model->image = $filename;
        $model->save();

        return redirect()->route('index.posts','msg= thêm bài viết thành công');
    }


    public function edit($id){

    

        $model = Posts::find($id);

        if(!$model){
            return redirect()->route('index.posts','msg=id Không Tồn tại !');
        }
        return view('admin.edit-posts',[
            'posts' =>$model
        ]);
    }


    public function saveEdit($id,Request $request){
        $request->validate([
            'title' => 'required|unique:posts|min:4',
            'content' => 'required|min:15'
        ],[
            'title.required' => "hãy nhập tên tiêu đề",
            'title.unique' => "tên tiêu đề đã tồn tại",
            'title.min' => "nhập trên 4 ký tự",
            'content.required' => "Hãy nhập nội dung",
            'content.min' => "nhập trên 15 ký tự"    
        ]);
        
        $model = Posts::find($id);
       $msg="";
        if(!$model){
            return redirect()->route('index.posts','msg= ID Không Tồn Tại');
            die;
        }

        $request = $_POST;
        $imgFile = $_FILES['image'];
        $model->fill($request);
        $filename = $model->image;

        if ($imgFile['size'] > 0) {
            $filename = uniqid() . '-' . $imgFile['name'];
            move_uploaded_file($imgFile['tmp_name'], '../public/uploads/' . $filename);
            $filename = '/'. 'uploads/' . $filename;
        }
        $model->image = $filename;
        $model->save();
        return redirect()->route('index.posts','msg = Sửa bài viết Thành Công');
    }

    public function remove(Request $request){
        $request = isset($_GET['id']) ? $_GET['id'] : null;
        if (!$request) {
            return redirect()->route('index.posts','msg=không đủ thông tin để xóa !');
            die;
        }
        // kiểm tra xem id có thật hay không
        $model = Posts::find($request);
        $msg="";
        if (!$model) {
            return redirect()->route('index.posts','msg=id Không Tồn tại !');
        } else {
            Posts::destroy($request);
            $msg = "Xóa bài viết thành công";
            
        }
        
        return redirect()->route('index.posts','msg='.$msg);
    }
    public function search(Request $request){
        if ($request->ajax()) {
            $output = '';
            $posts = Posts::where('title', 'LIKE', '%' . $request->search . '%')->get();
            if ($posts) {
                foreach ($posts as $key => $po) {
                    $output .= '<tr>
                    <td>' . $po->id . '</td>
                    <td>' . $po->title . '</td>
                    <td>
                        <img src="'.$po->image.'"class="img-avatar" width="100"></img>
                    </td>
                    <td>
                        <a href="edit/posts/'.$po->id.'"class="btn btn-primary">Sửa</a>
                        <a onclick="openConfirm(\'remove/posts/?id='.$po->id.'\')" href="javascript:;" class="btn btn-danger">Xóa</a>
                    </td>
                      
                    </tr>';
                }
            }
                
                if($output == ""){
                    $loi = "<div class='alert alert-success alert-dismissible fade show text-danger '>
                    <strong>Không tìm thấy sản phẩm nào ?</strong>
                </div> ";

                return Response($loi);

                }else{
                    return Response($output);
                }

        }
    }
}

