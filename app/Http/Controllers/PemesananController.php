<?php

namespace App\Http\Controllers;

use App\Models\Pemesanan;
use App\Models\KonfirmasiPembayaran;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use App\Models\Enkripsi;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Services\MultiLayerEncryptionService;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\PemesananExport;


class PemesananController extends Controller
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


    public function index(Request $request)
    {
        $query = Pemesanan::with('penyewa');

        // Filter bulan
        if ($request->filled('bulan')) {
            $query->whereMonth('tanggal_masuk', $request->bulan);
        }

        // Filter tahun
        if ($request->filled('tahun')) {
            $query->whereYear('tanggal_masuk', $request->tahun);
        }

        // Ambil hasil akhir
        $pemesanan = $query->get();

        // Dekripsi data penyewa
        foreach ($pemesanan as $item) {
            if ($item->penyewa) {
                $enkripsi = Enkripsi::where('id_penyewa', $item->penyewa->id)->first();
                
                if ($enkripsi) {
                    $key1 = base64_decode($enkripsi->kunci_enkripsi1);
                    $key2 = base64_decode($enkripsi->kunci_enkripsi2);
                    $key3 = (int) base64_decode($enkripsi->kunci_enkripsi3);
                    $key4 = base64_decode($enkripsi->kunci_enkripsi4);

                    $item->penyewa->nama = $this->encryptionService->decrypt($item->penyewa->nama, $item->penyewa->id);
                    $item->penyewa->alamat = $this->encryptionService->decrypt($item->penyewa->alamat, $item->penyewa->id);
                    $item->penyewa->nik = $this->encryptionService->decrypt($item->penyewa->nik, $item->penyewa->id);
                    $item->penyewa->foto_ktp = $this->encryptionService->decrypt($item->penyewa->foto_ktp, $item->penyewa->id);
                }
            }
        }

        // Return ke view
        return view('pemesanan', [
            'title' => "Pemesanan",
            'pemesanans' => $pemesanan
        ]);
    }


    public function penyewa()
    {
        $pemesanan = Pemesanan::all();
        return view('pemesanan-penyewa', ['title'=>"Pemesanan",'pemesanans'=>$pemesanan]);
    }

    public function destroy($id)
    {
        KonfirmasiPembayaran::where('id_pemesanan', $id)->delete();
        $pemesanan = Pemesanan::findOrFail($id);
        $pemesanan->delete();

        return redirect()->route('pemesanans.index')->with('message', 'Data Pemesanan berhasil dihapus!');
    }

    public function export(Request $request)
    {
        return Excel::download(new PemesananExport($request->bulan, $request->tahun), 'pemesanan.xlsx');
    }

}
