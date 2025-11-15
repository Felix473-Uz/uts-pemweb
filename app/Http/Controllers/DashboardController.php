<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\Produk;
use App\Models\User;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index()
    {
        $kategori = Kategori::all()->count();
        $produk = Produk::all()->count();
        $transaksi = Transaksi::all()->count();
        $user = User::all()->count();
        return view('dashboard', ['title'=>"Dashboard",'kategori'=>$kategori,'produk'=>$produk,'transaksi'=>$transaksi,'user'=>$user]);
    }

    public function homepage()
    {
        return view('homepage', ['title'=>"Homepage"]);
    }

    
}
