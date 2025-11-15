<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\Produk;
use App\Models\User;
use App\Models\Cart;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\TransaksiDetail;
use Midtrans\Snap;
use Carbon\Carbon;

use Midtrans\Config;

use App\Services\MidtransService;
use Auth;

class CustomerController extends Controller
{


    public function index()
    {
        $produks = Produk::take(12)->get();
        $cartCount = 0;
        if (Auth::check()) {
            $cartCount = Cart::where('id_user', Auth::id())->count();
        }
        return view('homepage', ['title'=>"Homepage",'produks'=>$produks,'cart' => $cartCount]);
    }

    public function about()
    {
        $cartCount = 0;
        if (Auth::check()) {
            $cartCount = Cart::where('id_user', Auth::id())->count();
        }
        return view('about', ['title'=>"About",'cart' => $cartCount]);
    }

    public function produk_customer()
    {
        $produks = Produk::all();
        $kategoris = Kategori::all();
        $cartCount = 0;
        if (Auth::check()) {
            $cartCount = Cart::where('id_user', Auth::id())->count();
        }
        return view('produk_customer', ['title'=>"Produk",'produks'=>$produks,'kategoris'=>$kategoris,'cart' => $cartCount]);
    }

    public function cart(Request $request)
    {
        $userId = Auth::id();
        $productId = $request->id_produk;
        $qty = $request->qty;

        $cart = Cart::where('id_user', $userId)
                    ->where('id_produk', $productId)
                    ->first();

        if ($cart) {
            Cart::where('id_user', $userId)
                ->where('id_produk', $productId)
                ->update(['qty' => $cart->qty + $qty]);
        } else {
            $cart = new Cart();
            $cart->id_user = $userId;
            $cart->id_produk = $productId;
            $cart->qty = $qty;
            $cart->save();
        }
        return redirect()->back()->with('message', 'Keranjang berhasil ditambahkan!');

    }

    public function checkout()
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu.');
        }

        $userId = Auth::id();

        // Ambil data cart beserta produk terkait
        $cartItems = Cart::with('produk')->where('id_user', $userId)->get();

        if ($cartItems->isEmpty()) {
            return redirect()->back()->with('error', 'Keranjang Anda kosong.');
        }

        $cartCount = $cartItems->count();

        // Hitung total harga
        $total = $cartItems->sum(function ($item) {
            return $item->produk->harga * $item->qty;
        });

        // Konfigurasi Midtrans
        Config::$serverKey = config('services.midtrans.server_key');
        Config::$isProduction = config('services.midtrans.is_production');
        Config::$isSanitized = true;
        Config::$is3ds = true;

        // Buat Snap Token
        $orderId = 'ORDER-' . time() . '-' . $userId;

        $params = [
            'transaction_details' => [
                'order_id' => $orderId,
                'gross_amount' => $total,
            ],
            'customer_details' => [
                'first_name' => Auth::user()->name,
                'email' => Auth::user()->email,
            ],
            'item_details' => $cartItems->map(function ($item) {
                return [
                    'id' => $item->produk->id_produk,
                    'price' => $item->produk->harga,
                    'quantity' => $item->qty,
                    'name' => $item->produk->nama_produk,
                ];
            })->toArray(),
        ];

        $snapToken = Snap::getSnapToken($params);

        return view('cart', [
            'title' => "Cart",
            'cart' => $cartCount,
            'checkout' => $cartItems,
            'snapToken' => $snapToken,
            'total' => $total
        ]);

    }
    public function store()
    {
        try {
            $user = Auth::user();

            if (!$user) {
                return response()->json(['message' => 'User belum login'], 401);
            }

            $cartItems = Cart::with('produk')->where('id_user', $user->id)->get();

            if ($cartItems->isEmpty()) {
                return response()->json(['message' => 'Cart kosong'], 400);
            }

            // Simpan ke tabel transaksi
            $transaksi = Transaksi::create([
                'id_user' => $user->id,
                'tanggal' => Carbon::now(),
                'status' => 'Success', // fallback jika null
            ]);

            // Simpan ke tabel transaksi_detail
            foreach ($cartItems as $item) {
                TransaksiDetail::create([
                    'id_transaksi' => $transaksi->id_transaksi,
                    'id_produk' => $item->id_produk,
                    'qty' => $item->qty,
                ]);
            }

            // Kosongkan cart user
            Cart::where('id_user', $user->id)->delete();

            return redirect()->route('history');
        } catch (\Exception $e) {   
            return response()->json([
                'message' => 'Terjadi kesalahan saat menyimpan transaksi',
                'error' => $e->getMessage()
            ], 500);
        }
    }
    
    public function history()
    {
        $user = Auth::user();
        $cartCount = 0;
        if (Auth::check()) {
            $cartCount = Cart::where('id_user', Auth::id())->count();
        }
        $transactions = Transaksi::with('detail.produk')
            ->where('id_user', $user->id)
            ->orderBy('tanggal', 'desc')
            ->get();
        return view('history', ['title'=>"History",'transaksis'=>$transactions,'cart' => $cartCount]);
    }

    
}
