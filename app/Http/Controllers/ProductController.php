<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $product = DB::table('products')
        ->select('id','product_name','category_id','price','image','description','stock_quantity')
        ->whereNull('deleted_at')
        ->get();
        return view('admin.product.index', compact('product'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $categoy = DB::table('products')
        //     ->Join('categories', 'products.category_id', '=', 'categories.id')
        //     ->select('products.*', 'categories.*')
        //     ->get();
        $category = Category::all();
        // dd($categoy);
        // return $categoy;
        return view('admin.product.create', compact('category'))->with('success','Product created successfully.');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreProductRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProductRequest $request)
    {
        if ($request->isMethod('POST')) { //tồn tại phương thức post/
            //nếu như tồn tại file thì sẽ up file lên
            $params =  $request->except('_token');
            if ($request->hasFile('image') && $request->file('image')->isValid()) {
                $params['image'] = uploadFile('hinh',$request->file('image'));
            }

            $product = product::create($params);
            if ($product->id) {
                Session::flash('success', 'Thêm thành công');
                return redirect()->route('product_index');
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Category::all();
        $product = product::find($id);
        return view('admin.product.update', compact('product','category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateProductRequest  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProductRequest $request, Product $product, $id)
    {
        $oldImage = Product::find($id);
        if ($request->isMethod('POST')) {
            $params = $request->except('_token');
            if($request->hasFile('image') && $request->file('image')->isValid()){
                $resultDelete = Storage::delete($oldImage->image);
                if($resultDelete){
                    $params['image'] = uploadFile('hinh', $request->file('image'));
                }
                else{
                    $params['image'] = $product->image;
                }
            }
            $result = Product::where('id', $id)
                ->update($params);
            if ($result) {
                Session::flash('success', 'sửa thành công');
                return redirect()->route('product_index', ['id' => $id]);
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        product::where('id',$id)->delete();
        return redirect()->route('product_index')->with('success','Product delete successfully.');
    }
    // Lấy sản phẩm theo danh mục 
    public function showProductsByCategory($category_id)
    {
        $category = Category::all();
        // Lấy danh sách sản phẩm theo category_id
        $products = Product::where('category_id', $category_id)->get();

        // Gửi dữ liệu sản phẩm và category_id tới view
        // $tore = Cart::whereUserId(auth()->user()->id)->count();
        return view('client.home.product', compact('products', 'category', 'category_id'));
    }

}
