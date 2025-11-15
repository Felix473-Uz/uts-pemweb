<?php

namespace App\Http\Controllers;

use App\Models\Penyewa;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Models\Enkripsi;
use App\Services\MultiLayerEncryptionService;

class PenyewaController extends Controller
{
    protected $encryptionService;

    public function __construct(MultiLayerEncryptionService $encryptionService)
    {
        $this->middleware('auth');
        $this->encryptionService = $encryptionService;
    }

    public function index()
    {
        $penyewaList = Penyewa::whereHas('user', function ($query) {
            $query->where('role', 'penyewa');
        })->get();

        foreach ($penyewaList as $penyewa) {
            $penyewa->nama = $this->encryptionService->decrypt($penyewa->nama, $penyewa->id);
            $penyewa->alamat = $this->encryptionService->decrypt($penyewa->alamat, $penyewa->id);
            $penyewa->nik = $this->encryptionService->decrypt($penyewa->nik, $penyewa->id);
            $penyewa->foto_ktp = $this->encryptionService->decrypt($penyewa->foto_ktp, $penyewa->id);
        }

        return view('penyewa', ['title' => "Penyewa", 'penyewas' => $penyewaList]);
    }// Fungsi untuk memproses enkripsi/dekripsi teks
    public function processEncryption(Request $request)
    {
        $request->validate([
            'text' => 'required|string',
            'action' => 'required|in:encrypt,decrypt'
        ]);

        $penyewa = Penyewa::where("id_user", Auth::id())->first();
        if (!$penyewa) {
            return redirect()->route('penyewa.encryption')->with('error', 'Data penyewa tidak ditemukan.');
        }

        $enkripsi = Enkripsi::where('id_penyewa', $penyewa->id)->first();
        if (!$enkripsi) {
            return redirect()->route('penyewa.encryption')->with('error', 'Kunci enkripsi tidak ditemukan.');
        }

        $key1 = base64_decode($enkripsi->kunci_enkripsi1);
        $key2 = base64_decode($enkripsi->kunci_enkripsi2);
        $key3 = (int) base64_decode($enkripsi->kunci_enkripsi3);
        $key4 = base64_decode($enkripsi->kunci_enkripsi4);

        $text = $request->text;
        $action = $request->action;
        $result = '';

        try {
            if ($action === 'encrypt') {
                $result = $this->encryptionService->encrypt($text, $key1, $key2, $key3, $key4);
            } else {
                $result = $this->encryptionService->decrypt($text, $penyewa->id);
            }
        } catch (\Exception $e) {
            return redirect()->route('penyewa_encryption')->with('error', 'Proses gagal: ' . $e->getMessage());
        }

        return redirect()->route('penyewa_encryption')->with('result', [
            'action' => $action,
            'text' => $text,
            'output' => $result
        ]);
    }
    public function encryptionPage()
    {
        $penyewa = Penyewa::where("id_user", Auth::id())->first();
        if (!$penyewa) {
            return redirect()->route('penyewa.penyewa')->with('error', 'Data penyewa tidak ditemukan.');
        }

        return view('penyewa_encryption', [
            'title' => 'Enkripsi & Dekripsi 4 Layer',
            'penyewa' => $penyewa
        ]);
    }

    public function penyewa()
    {
        $penyewa = Penyewa::where("id_user", Auth::id())->firstOrFail();

        $penyewa->nama = $this->encryptionService->decrypt($penyewa->nama, $penyewa->id);
        $penyewa->alamat = $this->encryptionService->decrypt($penyewa->alamat, $penyewa->id);
        $penyewa->nik = $this->encryptionService->decrypt($penyewa->nik, $penyewa->id);
        $penyewa->foto_ktp = $this->encryptionService->decrypt($penyewa->foto_ktp, $penyewa->id);

        return view('profil', [
            'title' => "Profil",
            'penyewa' => $penyewa
        ]);
    }

    public function penyewa_update(Request $request, string $id)
    {
        $penyewa = Penyewa::findOrFail($id);
        $enkripsi = Enkripsi::where('id_penyewa', $penyewa->id)->firstOrFail();

        $key1 = base64_decode($enkripsi->kunci_enkripsi1);
        $key2 = base64_decode($enkripsi->kunci_enkripsi2);
        $key3 = (int) base64_decode($enkripsi->kunci_enkripsi3);
        $key4 = base64_decode($enkripsi->kunci_enkripsi4);

        $user = User::findOrFail($penyewa->id_user);
        $user->username = $request->username;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->role = 'penyewa';
        $user->save();

        $penyewa->nama = $this->encryptionService->encrypt($request->nama, $key1, $key2, $key3, $key4);
        $penyewa->alamat = $this->encryptionService->encrypt($request->alamat, $key1, $key2, $key3, $key4);
        $penyewa->nik = $this->encryptionService->encrypt($request->nik, $key1, $key2, $key3, $key4);

        if ($request->hasFile('foto_ktp')) {
            $fotoKtpPath = $request->file('foto_ktp')->store('ktp', 'public');
            $penyewa->foto_ktp = $this->encryptionService->encrypt($fotoKtpPath, $key1, $key2, $key3, $key4);
        }

        $penyewa->save();

        return redirect()->route('penyewa.penyewa')->with('message', 'Data penyewa berhasil diupdate!');
    }

    public function store(Request $request)
    {
        $key1 = random_bytes(16); 
        $key2 = random_bytes(16); 
        $key3 = random_int(1, 25); 
        $key4 = bin2hex(random_bytes(4)); 

        $user = new User();
        $user->nama = $request->nama;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->role = 'penyewa';
        $user->save();

        $fotoKtpPath = $request->file('foto_ktp')->store('ktp', 'public');

        $namaEncrypted   = $this->encryptionService->encrypt($request->nama, $key1, $key2, $key3, $key4);
        $alamatEncrypted = $this->encryptionService->encrypt($request->alamat, $key1, $key2, $key3, $key4);
        $nikEncrypted    = $this->encryptionService->encrypt($request->nik, $key1, $key2, $key3, $key4);
        $ktpEncrypted    = $this->encryptionService->encrypt($fotoKtpPath, $key1, $key2, $key3, $key4);

        $penyewa = new Penyewa();
        $penyewa->id_user = $user->id;
        $penyewa->nama = $namaEncrypted;
        $penyewa->alamat = $alamatEncrypted;
        $penyewa->nik = $nikEncrypted;
        $penyewa->foto_ktp = $ktpEncrypted;
        $penyewa->save();

        Enkripsi::create([
            'id_penyewa' => $penyewa->id,
            'kunci_enkripsi1' => base64_encode($key1),
            'kunci_enkripsi2' => base64_encode($key2),
            'kunci_enkripsi3' => base64_encode($key3),
            'kunci_enkripsi4' => $key4,
        ]);

        return redirect()->route('penyewas.index')->with('message', 'Penyewa berhasil ditambahkan!');
    }

    public function update(Request $request, string $id)
    {
        $penyewa = Penyewa::findOrFail($id);
        $user = User::findOrFail($penyewa->id_user);
        $user->nama = $request->nama;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->role = 'penyewa';
        $user->save();

        if ($request->hasFile('foto_ktp')) {
            $fotoKtpPath = $request->file('foto_ktp')->store('ktp', 'public');
            $penyewa->foto_ktp = $fotoKtpPath;
        }

        $penyewa->nama = $request->nama;
        $penyewa->alamat = $request->alamat;
        $penyewa->nik = $request->nik;
        $penyewa->save();

        return redirect()->route('penyewas.index')->with('message', 'Data penyewa berhasil diupdate!');
    }

    public function destroy($id)
    {
        $penyewa = Penyewa::findOrFail($id);

        // decrypt dulu untuk dapetin path asli
        $decryptedPath = $this->encryptionService->decrypt($penyewa->foto_ktp, $penyewa->id);
        if (Storage::disk('public')->exists($decryptedPath)) {
            Storage::disk('public')->delete($decryptedPath);
        }

        Enkripsi::where('id_penyewa', $penyewa->id)->delete();
        $id_user = $penyewa->id_user;
        $penyewa->delete();
        User::where('id', $id_user)->delete();

        return redirect()->route('penyewas.index')->with('message', 'Data penyewa berhasil dihapus!');
    }
}
