<?php

namespace App\Http\Controllers;

use App\Models\Penyewa;
use App\Models\Informasi;
use App\Models\Pemesanan;
use App\Models\KonfirmasiPembayaran;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Services\MultiLayerEncryptionService;

class InformasiController extends Controller
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
        $informasi = Informasi::all();
        return view('informasi', ['title'=>"Informasi",'informasis'=>$informasi]);
    }


    public function penyewa()
    {
        $informasi = Informasi::all();
        return view('informasi_penyewa', ['title'=>"Informasi",'informasis'=>$informasi]);
    }

    public function store(Request $request)
    {
        $informasi = new Informasi();
        $informasi->judul = $request->judul;
        $informasi->deskripsi = $request->deskripsi;

        // Upload Foto Utama
        if ($request->hasFile('foto_informasi')) {
            $file = $request->file('foto_informasi')->store('foto_informasi', 'public');
            $informasi->foto_informasi = $file; // path diakses dari URL langsung
        }

        $informasi->save();

        return redirect()->route('informasis.index')->with('message', 'Informasi berhasil ditambahkan!');
    }
    public function update(Request $request, string $id)
    {
        $informasi = Informasi::findOrFail($id);
        $informasi->judul = $request->judul;
        $informasi->deskripsi = $request->deskripsi;

        // Upload Foto Utama (optional ganti)
        if ($request->hasFile('foto_informasi')) {
            $file = $request->file('foto_informasi')->store('foto_informasi', 'public');
            $informasi->foto_informasi = $file;
        }

        $informasi->save();

        return redirect()->route('informasis.index')->with('success', 'Informasi berhasil diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Cari data informasi
        $informasi = Informasi::findOrFail($id);

        // Hapus file foto utama kalau ada
        if ($informasi->foto_informasi && Storage::disk('public')->exists($informasi->foto_informasi)) {
            Storage::disk('public')->delete($informasi->foto_informasi);
        }
        $informasi->delete();

        return redirect()->route('informasis.index')->with('success', 'Informasi deleted successfully');
    }
}
