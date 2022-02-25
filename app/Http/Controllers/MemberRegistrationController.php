<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Member;
use App\Models\User;
use App\Models\Transaction;

class MemberRegistrationController extends Controller
{
    public function index() {
        return view('main.web.member-registration');
    }

    public function store() {
        $user = User::findOrFail(Auth::user()->id);
        if ($user->money < 150000) {
            return back()->with('failed', 'Your money is not enough');
        }
        $user->money = $user->money - 150000;
        $user->save();

        // creating the transaction data
        $transaction = [
            'user_id' => Auth::user()->id,
            'total_cost' => 150000,
            'address' => Auth::user()->address,
            'profit' => 150000
        ];
        Transaction::create($transaction);

        $member = new Member();
        $member->user_id = $user->id;
        $member->save();

        return redirect('/member');

    }
}
