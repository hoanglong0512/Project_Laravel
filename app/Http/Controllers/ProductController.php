<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Category;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function getAll(Request $request)
    {
        $kwd = $request->has('keyword') ? $request->keyword : null;
        $msg = isset($_GET['msg']) ? $_GET['msg'] : null;
        if ($kwd === null) {
            $products = Product::paginate(10);
        } else {
            $products = Product::where('name', 'like', "%$kwd%")->paginate(2);
            $products->withPath("?keyword=$kwd");
        }



        //     dd($products);
        // truyền dữ liệu ra màn hình
        return view('admin.product', [
            'product' => $products,
            'keyword' => $kwd,
            'msg' => $msg

        ]);
    }




    public function addProduct()
    {
        $category = Category::all();

        return view('admin.add-product', [
            'cates' => $category
        ]);
    }

    public function saveProduct(Request $request)
    {

        $request->validate([
            'name' => 'required|unique:products|min:4',
            'price' => 'required|min:4',
            'short_desc' => 'required|min:10',
            'star' => 'required',
            'view' => 'required',
            'detail' => 'required|:min:10'


        ], [
            'name.required' => "hãy nhập tên sản phẩm",
            'name.unique' => "tên sản phẩm đã tồn tại",
            'name.min' => "nhập trên 4 ký tự",
            'price.required' => "Hãy nhập giá sản phẩm",
            'price.min' => "nhập trên 3 ký tự",
            'short_desc.required' => "Nhập mô tả ngắn",
            'short_desc.min' => "nhập trên 10 ký tự",
            'star.required' => "Hãy nhập đánh giá",
            'view.required' => "Hãy nhập lượt view sản phẩm",
            'detail.required' => "Hãy nhập mô tả chi tiết",
            'detail.min' => "nhập trên 10 ký tự"
        ]);

        $request = $_POST;
        $imgFile = $_FILES['image'];

        $model = new Product();
        $model->fill($request);
        $filename = "";
        // // nếu có ảnh up lên thì lưu ảnh
        if ($imgFile['size'] > 0) {
            $filename = uniqid() . '-' . $imgFile['name'];
            move_uploaded_file($imgFile['tmp_name'], '../public/uploads/' . $filename);
            $filename = '/' . 'uploads/' . $filename;
        }
        $model->image = $filename;
        $model->save();

        return redirect()->route('admin.product', 'msg= thêm sản phẩm thành công');
    }

    public function delete(Request $request)
    {
        $request = isset($_GET['id']) ? $_GET['id'] : null;
        if (!$request) {
            return redirect()->route('admin.product', 'msg=không đủ thông tin để xóa !');
            die;
        }
        // kiểm tra xem id có thật hay không
        $model = Product::find($request);
        $msg = "";
        if (!$model) {
            return redirect()->route('admin.product', 'msg=id Không Tồn tại !');
        } else {
            Product::destroy($request);
            $msg = "Xóa sản phẩm thành công";
        }

        return redirect()->route('admin.product', 'msg=' . $msg);
    }

    public function edit(Request $request)
    {
        $request = isset($_GET['id']) ? $_GET['id'] : null;

        if (!$request) {
            return redirect()->route('admin.product', 'msg=Không đủ thông tin để sửa !');
        }

        $model = Product::find($request);

        if (!$model) {
            return redirect()->route('admin.product', 'msg=id Không Tồn tại !');
        }

        $cate = Category::all();

        return view('admin.edit-product', [
            'product' => $model,
            'cates' => $cate
        ]);
    }

    public function saveEdit(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:products|min:4',
            'price' => 'required|min:4',
            'short_desc' => 'required|min:10',
            'star' => 'required',
            'view' => 'required',
            'detail' => 'required|:min:10'


        ], [
            'name.required' => "hãy nhập tên sản phẩm",
            'name.unique' => "tên sản phẩm đã tồn tại",
            'name.min' => "nhập trên 4 ký tự",
            'price.required' => "Hãy nhập giá sản phẩm",
            'price.min' => "nhập trên 3 ký tự",
            'short_desc.required' => "Nhập mô tả ngắn",
            'short_desc.min' => "nhập trên 10 ký tự",
            'star.required' => "Hãy nhập đánh giá",
            'view.required' => "Hãy nhập lượt view sản phẩm",
            'detail.required' => "Hãy nhập mô tả chi tiết",
            'detail.min' => "nhập trên 10 ký tự"
        ]);
        $request = isset($_GET['id']) ? $_GET['id'] : null;


        if (!$request) {
            return redirect()->route('admin.product', 'msg=Không Đủ Thông Tin Để Update');
            die;
        }

        $model = Product::find($request);
        $msg = "";
        if (!$model) {
            return redirect()->route('admin.product', 'msg= ID Không Tồn Tại');
            die;
        }

        $request = $_POST;
        $imgFile = $_FILES['image'];
        $model->fill($request);
        $filename = $model->image;

        if ($imgFile['size'] > 0) {
            $filename = uniqid() . '-' . $imgFile['name'];
            move_uploaded_file($imgFile['tmp_name'], '../public/uploads/' . $filename);
            $filename = '/' . 'uploads/' . $filename;
        }
        $model->image = $filename;
        $model->save();
        return redirect()->route('admin.product', 'msg= Sửa Sản Phẩm Thành Công');
    }

    public function detailProduct()
    {
        $dataId = $_GET['id'];

        $model = Product::find($dataId);

        // kiểm tra id có tồn tại hay không
        if (!$model) {
            return redirect()->route('index');
        }
        //  dd($model);

        $cates = Category::all();
        $cate_id = $model->cate_id;

        //dd($dataId);
        $Related = Product::where('cate_id', '=', $cate_id)->paginate(5)->except($dataId);

        return view('shop-details', [
            'product' => $model,
            'cates' => $cates,
            'Related' => $Related
        ]);
    }
    public function shopGrid()
    {
        $id = isset($_GET['id']) ? $_GET['id'] : null;
        $categries = Category::all();
        $cates = Category::all();
        if ($id === null) {
            $products = Product::paginate(12);
        } else {
            $products = Product::where('cate_id', '=', $id)->paginate(12);
        }
        $priceBig = Product::max('price');
        $priceSmall = Product::min('price');

        $productsNew = Product::orderBy('id', 'desc')->paginate(3);
        $count = Product::count();


        return view('shop-grid', compact('products', 'categries', 'count', 'cates', 'productsNew', 'priceBig', 'priceSmall'));
    }
}
