<?php

namespace App\Http\Controllers;

use App\Models\Categorys;
use Illuminate\Http\Request;
use App\Models\Detail_Orders;
use App\Models\Orders;
use App\Models\Products;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use PhpParser\Node\Expr\New_;

class CartController extends Controller
{
    public function KodeOrder($length = 8)
    {
        $str = '';
        $characters = array_merge(range('A', 'Z'), range('a', 'z'));
        $max = count($characters) - 1;
        for ($i = 0; $i < $length; $i++) {
            $rand = mt_rand(0, $max);
            $str .= $characters[$rand];
        }

        return $str;
    }

    public function addToCart(Request $request)
    {
        $product = Products::where('id', $request->get('id'))->first();

        $ex = false;
        $exId = 0;
        $cart = Session::get('cart');

        if ($cart) {
            foreach ($cart as $key => $value) {
                if ($value['id'] == $request->get('id')) {
                    $ex = true;
                    $exId = $key;
                }
            }
        }

        $count = 0;
        $curentPrice = 0;
        $curentPrice = $product->harga;

        if ($ex == false) {
            $cart[] = array(
                'id' => $product->id,
                'name' => $product->name,
                'image' => $product->image,
                'harga' => $product->harga,
                'qty' => $request->get('qty'),
                'id_ukuran' => $request->get('id_ukuran'),
                'ukuran' => $request->get('ukuran'),
                'id_warna' => $request->get('id_warna'),
                'warna' => $request->get('warna')
            );
        } else {
            $cart[$exId]['qty'] = $request->get('qty');
        }

        Session::put('cart', $cart);
        Session::save();
        $cart = Session::get('cart');
        $count = count($cart);

        return response()->json([
            'succsess' => 1,
            'message' => 'Data Add To Cart Succssessfuly',
            'data' => $cart,
            'count' => $count
        ]);
    }

    public function deleteItemCart(Request $request)
    {
        $cart = Session::get('cart');
        if ($cart) {
            foreach ($cart as $key => $value) {
                if ($key == $request->get('id')) {
                    unset($cart[$key]);
                }
            }
        }

        Session::put('cart', $cart);
        Session::save();
        $cart = Session::get('cart');
        $count = count($cart);
        return response()->json([
            'Success' => 1,
            'message' => 'Data Berhasil Dihapus',
            'data' => $cart,
            'count' => $count
        ]);
    }

    public function detailCart()
    {
        $category = Categorys::all();
        $carts = Session::get('cart');
        $subtotal = 0;

        if (isset($carts) === false) {
            $carts = [];
        } else {
            foreach ($carts as $cart) {
                $subtotal = $subtotal + $cart['qty'] * $cart['harga'];
            }
        }

        return  view('User.Home.cart', compact('category', 'carts', 'subtotal'));
    }

    public function cekout(Request $request)
    {
        $carts = Session::get('cart');

        $order = new Orders();
        $order->kode_order = $this->KodeOrder();
        $order->id_user = Auth::id();
        $order->sub_total = $request->subtotal;
        $order->total = $request->total;
        $order->status = 'OnProses';
        $order->save();

        if ($order) {
            foreach ($carts as $cart) {
                $detail = new Detail_Orders();
                $detail->id_order = $order->id;
                $detail->id_product = $cart['id'];
                $detail->id_ukuran = $cart['id_ukuran'];
                $detail->id_warna = $cart['id_warna'];
                $detail->qty = $cart['qty'];
                $detail->harga_product = $cart['harga'];
                $detail->total_item = $cart['qty'] * $cart['harga'];

                $detail->save();
            }
        }

        Session::forget('cart');
        return response()->json([
            'success' => 1,
            'message' => 'Data Berhasil di cek out',
            'kode_order' => $order->kode_order
        ]);
    }
}
