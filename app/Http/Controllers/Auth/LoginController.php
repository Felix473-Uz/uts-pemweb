<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Enkripsi;
use App\Models\User;
use phpseclib3\Crypt\AES;
use phpseclib3\Crypt\Twofish;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected function redirectTo()
    {
        $user = Auth::user();

        if ($user->role == 'penyewa') {
            return '/homepage';
        } elseif ($user->role == 'admin') {
            return '/dashboard';
        }

        return '/'; // fallback
    }

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }
}
