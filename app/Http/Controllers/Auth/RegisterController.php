<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\Enkripsi;
use App\Models\Penyewa;

class RegisterController extends Controller
{
    use RegistersUsers;

    protected $redirectTo = '/homepage';
    protected $encryptionService;

    public function __construct()
    {
        $this->middleware('guest');
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'username' => ['required', 'string', 'max:255'],
            'no_telepon' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    protected function create(array $data)
    {

        $user = User::create([
            'username'    => $data['username'],
            'no_telepon'  => $data['no_telepon'],
            'email'       => $data['email'],
            'password'    => Hash::make($data['password']),
            'role'        => 'penyewa',
        ]);

        $request = request();

        return $user;
    }
}
