<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Product;

class CategoryController extends Controller
{
    public function search(Request $request)
    {
        $keyword = $request->keyword;
        $model = Category::where('name', 'like', '%' . $keyword . '%')
            ->get();


        return view('admin.category', [
            'category'  => $model
        ]);
    }


    public function getAll()
    {
        $category = Category::all();
        $msg = isset($_GET['msg']) ? $_GET['msg'] : null;
        return view('admin.category', [
            'category' => $category,
            'msg' => $msg
        ]);
    }
    public function addForm()
    {
        return view('admin.add-category');
    }

    public function saveForm(Request $request)
    {

        //dd($request);
        $request->validate([
            'name' => 'required|unique:products|min:4',
            'slug' => 'required|min:4',
            'desc' => 'required|min:10'


        ], [
            'name.required' => "hãy nhập danh mục",
            'name.unique' => "tên danh mục đã tồn tại",
            'name.min' => "nhập trên 4 ký tự",
            'desc.required' => "Nhập mô tả ngắn",
            'desc.min' => "nhập trên 10 ký tự",
            'slug.required' => "Hãy nhập slug",
            'slug.min' => "nhập trên 4 ký tự"
        ]);
        $model = new Category();
        $model->show_menu = $request->has('show_menu') ? $request->show_menu : null;
        $model->fill($request->all());
        $model->save();
        return redirect()->route('admin.category');
    }

    public function remove(Request $request)
    {
        $request = isset($_GET['id']) ? $_GET['id'] : null;
        if (!$request) {
            return redirect()->route('admin.category', 'msg=không đủ thông tin để xóa !');
            die;
        }
        // kiểm tra xem id có thật hay không
        $model = Category::find($request);
        $msg = "";
        if (!$model) {
            return redirect()->route('admin.category', 'msg=id Không Tồn tại !');
        } else {
            Category::destroy($request);
            $msg = "Xóa sản phẩm thành công";
        }

        return redirect()->route('admin.category', 'msg=' . $msg);
    }

    public function edit($id)
    {
        $model = Category::find($id);
        if (!$model) {
            return redirect()->route('admin.category', 'msg= ID Không Tồn Tại !');
        }

        return view('admin.edit-category', [
            'cates' => $model
        ]);
    }

    public function saveEdit($id, Request $request)
    {
        $request->validate([
            'name' => 'required|unique:categories|min:4',
            'slug' => 'required|min:4',
            'desc' => 'required|min:10'


        ], [
            'name.required' => "hãy nhập danh mục",
            'name.unique' => "tên danh mục đã tồn tại",
            'name.min' => "nhập trên 4 ký tự",
            'desc.required' => "Nhập mô tả ngắn",
            'desc.min' => "nhập trên 10 ký tự",
            'slug.required' => "Hãy nhập slug",
            'slug.min' => "nhập trên 4 ký tự"
        ]);
        $model = Category::find($id);
        if (!$model) {
            return redirect()->route('admin.category', 'msg= Không Đúng id Để Sửa');
        }
        $model->show_menu = $request->has('show_menu') ? $request->show_menu : null;
        $model->fill($request->all());
        $model->save();
        return redirect()->route('admin.category', 'msg= Sửa Danh Mục Thành Công');
    }
}
