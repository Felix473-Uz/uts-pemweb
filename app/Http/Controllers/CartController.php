<?php
namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index()
    {
        return Cart::with('produk')->where('id_user', Auth::id())->get();
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_produk' => 'required|exists:produk,id_produk',
            'qty' => 'required|integer|min:1',
        ]);

        $cart = Cart::updateOrCreate(
            ['id_user' => Auth::id(), 'id_produk' => $request->id_produk],
            ['qty' => \DB::raw('qty + ' . $request->qty)]
        );

        return response()->json(['message' => 'Produk ditambahkan ke keranjang', 'cart' => $cart]);
    }

    public function destroy($id_produk)
    {
        Cart::where('id_user', Auth::id())->where('id_produk', $id_produk)->delete();
        return response()->json(['message' => 'Produk dihapus dari keranjang']);
    }
}

