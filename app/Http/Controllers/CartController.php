<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\User;
use App\Models\Product;
use App\Models\Category;
use App\Models\Invoice;
use App\Models\Promotion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
// Hiển thị danh sách sản phẩm đã mua trong rỏ hàng
public function index(Request $request)
{   
    if($request->session()->exists('cart_id')) {
        $cart_id =$request->session()->get('cart_id');
    }
    
    $category = Category::all();
    if (auth()->check()) {
        $cartItems = Cart::where('user_id', auth()->user()->id)->get();
        
        // $promotion = Invoice::where('cart_id', $cart_id)
        //     ->join('promotions', 'invoice.promotion_id', '=', 'promotions.id')
        //     ->select('promotions.title', 'promotions.discount_percent')
        //     ->first();
        // // if($promotion)
        // dd($promotion);

        return view('client.cart.index', compact('cartItems','category'));
    } else {
        // Handle the case when the user is not logged in
        // For example, you could redirect them to the login page.
        return redirect()->route('login_show');
    }
    // dd($cartItems);
    
}

// Thêm sản phẩm vào rỏ hàng hoặc cập nhật số lượng nếu sản phẩm đã tồn tại
// public function addToCart(Request $request)
// {
//     $productId = $request->input('product_id');
//     // $quantity = $request->input('quantity');
    
//     $product = Product::find($productId);
//     if (!$product) {
//         return redirect()->back()->with('error', 'Sản phẩm không tồn tại.');
//     }
    
//     if (auth()->check()) {
//         $existingCartItem = Cart::where('user_id', auth()->user()->id)
//         ->where('product_id', $productId)
//         ->first();
//     }else{
//         return redirect()->route('login_show');
//     }


//     if ($existingCartItem) {
//         // $existingCartItem->quantity += $quantity;
//         $existingCartItem->total_price = $product->price * $existingCartItem->quantity;
//         $existingCartItem->save();
//     } else {
//         $cartItem = new Cart();
//         $cartItem->user_id = auth()->user()->id;
//         $cartItem->product_id = $productId;
//         $cartItem->quantity = 1 ;
//         $cartItem->total_price = $product->price * 1;
//         $cartItem->save();
//     }

//     return redirect()->route('cart_index')->with('success', 'Đã thêm sản phẩm vào rỏ hàng.');
// }
public function addToCart(Request $request, $product_id, $user_id, $quantity = 1)
{
    function generateUniqueRandomNumber() {
        do {
            $randomNumber = mt_rand(1000, 9999); // Thay đổi khoảng số ngẫu nhiên theo nhu cầu của bạn
        } while (Cart::where('cart_id', $randomNumber)->exists());
        
        return $randomNumber;
    }
    if($request->session()->exists('cart_id')) {
        $cart_id =$request->session()->get('cart_id');

    }else{
        $cart_id = generateUniqueRandomNumber();
        $request->session()->put('cart_id', $cart_id);
    }

    $product = Product::find($product_id);
    $user = User::find($user_id);
    // Kiểm tra sự tồn tại của sản phẩm và người dùng
    if (!$product || !$user) {
        return redirect()->back()->with('error', 'Sản phẩm hoặc người dùng không tồn tại.');
    }
    $total_price = $product->price * $quantity;

    // Thêm sản phẩm vào giỏ hàng
    Cart::create([
        'cart_id' => $cart_id,
        'product_id' => $product_id,
        'user_id' => $user_id,
        'quantity' => $quantity,
        'total_price' => $total_price,
    ]);

    return redirect()->back()->with('success', 'Sản phẩm đã được thêm vào giỏ hàng.');
}

// Xóa sản phẩm khỏi rỏ hàng
public function removeFromCart($cartItemId)
{
    $cartItem = Cart::where('user_id', auth()->user()->id)
                    ->where('id', $cartItemId)
                    ->first();

    if (!$cartItem) {
        return redirect()->back()->with('error', 'Sản phẩm không tồn tại trong rỏ hàng.');
    }

    $cartItem->delete();
    return redirect()->route('cart_index')->with('success', 'Đã xóa sản phẩm khỏi rỏ hàng.');
}

public function updateCart(Request $request)
{
    $productId = $request->input('product_id');
    $quantity = $request->input('quantity');
    $id = $request->input('id');

    // Lấy thông tin sản phẩm từ CSDL
    $product = Product::findOrFail($productId);

    // Cập nhật số lượng sản phẩm trong giỏ hàng (hoặc session)
    // Ví dụ: Lưu vào session giỏ hàng
    $cart = session()->get('cart', []);
    $cart[$productId]['quantity'] = $quantity;
    session()->put('cart', $cart);

    // Tính toán lại thành tiền của sản phẩm
    $itemTotal = $product->price * $quantity;

    $cart_id = $request->input('cart_id');

    Cart::where('id', $id)->update(['quantity' => $quantity,'total_price'=>$itemTotal]);

    $total = Cart::where('cart_id', $cart_id)->sum('total_price');


    return response()->json(['id'=>$id,'itemTotal' => $itemTotal, 'total' => $total]);

}
public function promotion(Request $request){

    if($request->session()->exists('cart_id')) {
        $cart_id =$request->session()->get('cart_id');
    }

    $title = $request->input('title');
    $promotion = Promotion::where('title', $title)->first();
    if ($promotion) {
        // Lấy promotion_id từ bảng promotions và lưu vào bảng carts
        $cart = Invoice::create(['cart_id' => $cart_id,'promotion_id' => $promotion->id]);
// return ($promotion->id);
        return redirect('/cart');
    }
}

    public function calcTotal(Request $request) 
    {
        $cart_id = $request->input('cart_id');

        $total = Cart::sum('total_price')->where('cart_id', $cart_id)->first();   

        return response()->json(['total' => $total]);        
    }
}
