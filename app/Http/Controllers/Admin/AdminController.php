<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Store;
use Str;

class AdminController extends Controller
{
    public function showLogin()
    {
        return view('admin.login');
    }

    public function login(Request $request)
    {
        if ($request->password === 'PSwrhvna2QrAWx2z') {
            session(['admin_checked' => 'true']);

            return redirect()->route('admin-index');
        } else {
            session()->flash('flash_message', 'Senha incorreta.');

            return redirect()->route('admin.login');
        }
    }

    public function index()
    {
        return view('admin.index');
    }
}
