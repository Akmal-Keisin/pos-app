<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MoneyController extends Controller
{
    public function index() {
        return view('main.web.money');
    }

    public function store(Request $request) {
        $request->validate([
            'money' => 'required|numeric'
        ]);

        $user = User::findOrFail(Auth::user()->id);
        $user->money += $request->money;
        $user->save();

        return redirect('/money')->with('success', 'Top Up success');
    }
}
