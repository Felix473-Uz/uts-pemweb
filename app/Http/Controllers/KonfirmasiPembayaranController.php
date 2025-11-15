<?php

namespace App\Http\Controllers;

use App\Models\Pemesanan;
use App\Models\Kamar;
use App\Models\KonfirmasiPembayaran;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use App\Models\Enkripsi;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Services\MultiLayerEncryptionService;

class KonfirmasiPembayaranController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    protected $encryptionService;

    public function __construct(MultiLayerEncryptionService $encryptionService)
    {
        $this->middleware('auth');
        $this->encryptionService = $encryptionService;
    }


    public function index()
    {
        $pemesanan = Pemesanan::where('status_pembayaran','belum_lunas')->get();
    
        foreach ($pemesanan as $penyewa) {
            $enkripsi = Enkripsi::where('id_penyewa', $penyewa->penyewa->id)->first();
            
            if ($enkripsi) {
                $key1 = base64_decode($enkripsi->kunci_enkripsi1);
                $key2 = base64_decode($enkripsi->kunci_enkripsi2);
                $key3 = (int) base64_decode($enkripsi->kunci_enkripsi3);
                $key4 = base64_decode($enkripsi->kunci_enkripsi4);
    
                $penyewa->penyewa->nama = $this->encryptionService->decrypt($penyewa->penyewa->nama,$penyewa->penyewa->id);
                $penyewa->penyewa->alamat = $this->encryptionService->decrypt($penyewa->penyewa->alamat, $penyewa->penyewa->id);
                $penyewa->penyewa->nik = $this->encryptionService->decrypt($penyewa->penyewa->nik, $penyewa->penyewa->id);
                $penyewa->penyewa->foto_ktp = $this->encryptionService->decrypt($penyewa->penyewa->foto_ktp,$penyewa->penyewa->id);
            }
        }
        return view('konfirmasiPembayaran', ['title'=>"Konfirmasi Pembayaran",'konfirmasiPembayarans'=>$pemesanan]);
    }

    public function store(Request $request)
    {


        $konfirmasiPembayaran = new KonfirmasiPembayaran();
        $konfirmasiPembayaran->id_pemesanan = $request->id_pemesanan;
        $konfirmasiPembayaran->save();

        $pemesanan = Pemesanan::findOrFail($request->id_pemesanan);
        $kamar = $pemesanan->kamar;
        $kamar->status = "terisi";
        $kamar->save();
        $pemesanan->status_pembayaran = "lunas";
        $pemesanan->save();

        return redirect()->route('konfirmasi_pembayarans.index')->with('message', 'KonfirmasiPembayaran berhasil ditambahkan!');
    }

    public function destroy(Request $request)
    {


        $pemesanan = Pemesanan::findOrFail($request->id_pemesanan);
        $pemesanan->status_pembayaran = "lunas";
        $pemesanan->delete();

        return redirect()->route('konfirmasi_pembayarans.index')->with('message', 'KonfirmasiPembayaran berhasil dihapus!');
    }

    
}
