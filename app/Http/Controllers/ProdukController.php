<?php
namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProdukController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $produks = Produk::all();
        $kategoris = Kategori::all();
        return view('produk', ['title' => 'Produk', 'produks' => $produks, 'kategoris' => $kategoris]);
    }

    public function store(Request $request)
    {
        $produk = new Produk();
        $produk->id_kategori = $request->id_kategori;
        $produk->nama_produk = $request->nama_produk;
        $produk->deskripsi = $request->deskripsi;
        $produk->harga = $request->harga;

        // Upload Foto Cover
        if ($request->hasFile('foto_cover')) {
            $file = $request->file('foto_cover')->store('foto_produk/cover', 'public');
            $produk->foto_cover = $file;
        }

        // Upload Foto Lain-lain
        $foto = [];
        if ($request->hasFile('foto')) {
            foreach ($request->file('foto') as $file) {
                $path = $file->store('foto_produk/lain', 'public');
                $foto[] = $path;
            }
        }
        $produk->foto = json_encode($foto);
        $produk->save();

        return redirect()->route('produk.index')->with('message', 'Produk berhasil ditambahkan!');
    }

    public function update(Request $request, string $id)
    {
        $produk = Produk::findOrFail($id);
        $produk->id_kategori = $request->id_kategori;
        $produk->nama_produk = $request->nama_produk;
        $produk->deskripsi = $request->deskripsi;
        $produk->harga = $request->harga;

        if ($request->hasFile('foto_cover')) {
            $file = $request->file('foto_cover')->store('foto_produk/cover', 'public');
            $produk->foto_cover = $file;
        }

        if ($request->hasFile('foto')) {
            $foto = [];
            foreach ($request->file('foto') as $file) {
                $path = $file->store('foto_produk/lain', 'public');
                $foto[] = $path;
            }
            $produk->foto = json_encode($foto);
        }

        $produk->save();
        return redirect()->route('produk.index')->with('message', 'Produk berhasil diupdate!');
    }

    public function destroy(string $id)
    {
        $produk = Produk::findOrFail($id);
        if ($produk->foto_cover && Storage::disk('public')->exists($produk->foto_cover)) {
            Storage::disk('public')->delete($produk->foto_cover);
        }

        $foto = json_decode($produk->foto, true);
        if (is_array($foto)) {
            foreach ($foto as $path) {
                if (Storage::disk('public')->exists($path)) {
                    Storage::disk('public')->delete($path);
                }
            }
        }

        $produk->delete();
        return redirect()->route('produk.index')->with('message', 'Produk berhasil dihapus!');
    }
}