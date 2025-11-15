<?php
namespace App\Http\Controllers;

use App\Models\TransaksiDetail;
use Illuminate\Http\Request;

class TransaksiDetailController extends Controller
{
    public function index()
    {
        return TransaksiDetail::with('produk', 'transaksi')->get();
    }

    public function show($id_transaksi)
    {
        return TransaksiDetail::where('id_transaksi', $id_transaksi)->with('produk')->get();
    }

    public function destroy($id_transaksi, $id_produk)
    {
        TransaksiDetail::where('id_transaksi', $id_transaksi)
            ->where('id_produk', $id_produk)
            ->delete();

        return response()->json(['message' => 'Detail transaksi dihapus']);
    }
}
