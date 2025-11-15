<?php

namespace App\Http\Controllers;

use App\Models\Penyewa;
use App\Models\Pemesanan;
use App\Models\KonfirmasiPembayaran;
use App\Models\Kamar;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Services\MultiLayerEncryptionService;

class KamarController extends Controller
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
        $kamar = Kamar::all();
        return view('kamar', ['title'=>"Kamar",'kamars'=>$kamar]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function penyewa()
    {
        $kamar = Kamar::where("status","kosong")->get();
        $penyewa = Penyewa::where("id_user", Auth::id())->firstOrFail();
        $status = "tidak terisi";
        $penyewa->nama = $this->encryptionService->decrypt($penyewa->nama, $penyewa->id);
        $penyewa->alamat = $this->encryptionService->decrypt($penyewa->alamat, $penyewa->id);
        $penyewa->nik = $this->encryptionService->decrypt($penyewa->nik, $penyewa->id);
        $penyewa->foto_ktp = $this->encryptionService->decrypt($penyewa->foto_ktp, $penyewa->id);
        if($penyewa->nama != "-" && $penyewa->alamat != "-" && $penyewa->nama != "-" && $penyewa->nama != "-" ){
            $status = "terisi";
        }
        $kamar = Kamar::where("status","kosong")->get();
        return view('kamar_penyewa', ['title'=>"Kamar",'kamars'=>$kamar,'status'=>$status]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $kamar = new Kamar();
        $kamar->nama_kamar = $request->nama_kamar;
        $kamar->tipe_kamar = $request->tipe_kamar;
        $kamar->harga = $request->harga;
        $kamar->fasilitas = $request->fasilitas;
        $kamar->deskripsi = $request->deskripsi;
        $kamar->status = $request->status;

        // Upload Foto Utama
        if ($request->hasFile('foto_utama')) {
            $file = $request->file('foto_utama')->store('foto_utama', 'public');
            $kamar->foto_utama = $file; // path diakses dari URL langsung
        }

        // Upload Foto Lain-lain
        $fotoLainLain = [];
        if ($request->hasFile('foto_lain')) {
            foreach ($request->file('foto_lain') as $key => $file) {
                $path = $file->store('foto_lain', 'public'); // hanya dari $file
                $fotoLainLain[] = $path;
            }            
        }

        $kamar->foto_lain_lain = json_encode($fotoLainLain);
        $kamar->save();

        return redirect()->route('kamars.index')->with('message', 'Kamar berhasil ditambahkan!');
    }
    public function update(Request $request, string $id)
    {
        $kamar = Kamar::findOrFail($id);
        $kamar->nama_kamar = $request->nama_kamar;
        $kamar->tipe_kamar = $request->tipe_kamar;
        $kamar->harga = $request->harga;
        $kamar->fasilitas = $request->fasilitas;
        $kamar->deskripsi = $request->deskripsi;
        $kamar->status = $request->status;

        // Upload Foto Utama (optional ganti)
        if ($request->hasFile('foto_utama')) {
            $file = $request->file('foto_utama')->store('foto_utama', 'public');
            $kamar->foto_utama = $file;
        }

        // Upload Foto Lain-lain (optional ganti semua)
        if ($request->hasFile('foto_lain')) {
            $fotoLainLain = [];
            foreach ($request->file('foto_lain') as $key => $file) {
                $path = $file->store('foto_lain', 'public');
                $fotoLainLain[] = $path;
            }
            $kamar->foto_lain_lain = json_encode($fotoLainLain);
        }

        $kamar->save();

        return redirect()->route('kamars.index')->with('success', 'Kamar berhasil diupdate!');
    }

    
    public function penyewa_store(Request $request, string $id)
    {
        $pemesanan = new Pemesanan();
        $buktiPembayaranPath = $request->file('bukti_pembayaran')->store('bukti_pembayaran', 'public');
        $penyewa = Penyewa::where("id_user",Auth::id())->first();
        $pemesanan->id_penyewa = $penyewa->id;
        $pemesanan->id_kamar = $id;
        $pemesanan->tanggal_masuk = $request->tanggal_masuk;
        $pemesanan->tanggal_keluar = $request->tanggal_keluar;
        $pemesanan->bukti_pembayaran = $buktiPembayaranPath;
        $pemesanan->save();

        return redirect()->route('kamars.penyewa')->with('success', 'Kamar updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Cari data kamar
        $kamar = Kamar::findOrFail($id);

        // Hapus file foto utama kalau ada
        if ($kamar->foto_utama && Storage::disk('public')->exists($kamar->foto_utama)) {
            Storage::disk('public')->delete($kamar->foto_utama);
        }

        // Hapus file foto lain-lain
        if ($kamar->foto_lain_lain) {
            $fotoLain = json_decode($kamar->foto_lain_lain, true);
            if (is_array($fotoLain)) {
                foreach ($fotoLain as $foto) {
                    if (Storage::disk('public')->exists($foto)) {
                        Storage::disk('public')->delete($foto);
                    }
                }
            }
        }

        // Hapus data terkait
        KonfirmasiPembayaran::where('id_pemesanan', $id)->delete();
        Pemesanan::where('id_kamar', $id)->delete();

        // Hapus kamar
        $kamar->delete();

        return redirect()->route('kamars.index')->with('success', 'Kamar deleted successfully');
    }
}
