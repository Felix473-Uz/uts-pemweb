<?php
namespace App\Http\Controllers;

use App\Models\Transaksi;
use App\Models\TransaksiDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class TransaksiController extends Controller
{
    public function index()
    {
        $transaksi = Transaksi::all();
        return view('transaksi', ['title' => 'Transkasi', 'transaksis' => $transaksi]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'items' => 'required|array',
            'items.*.id_produk' => 'required|exists:produk,id_produk',
            'items.*.qty' => 'required|integer|min:1'
        ]);

        $transaksi = Transaksi::create([
            'id_user' => Auth::id(),
            'tanggal' => Carbon::now()->toDateString(),
            'status' => 0
        ]);

        foreach ($request->items as $item) {
            TransaksiDetail::create([
                'id_transaksi' => $transaksi->id_transaksi,
                'id_produk' => $item['id_produk'],
                'qty' => $item['qty']
            ]);
        }

        return response()->json(['message' => 'Transaksi berhasil', 'transaksi' => $transaksi]);
    }

    public function show($id)
    {
        return Transaksi::with('detail.produk')->where('id_user', Auth::id())->findOrFail($id);
    }

    public function updateStatus(Request $request, $id)
    {
        $transaksi = Transaksi::findOrFail($id);
        $transaksi->update(['status' => $request->status]);
        return response()->json(['message' => 'Status diperbarui']);
    }
}
