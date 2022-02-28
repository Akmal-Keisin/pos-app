<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Member;
use App\Models\MemberProduct;
use Illuminate\Support\Facades\Auth;

class MemberController extends Controller
{
    public function index() {
        $check_member = false;
        if (Member::where('user_id', '=', Auth::user()->id)->exists()) {
            $check_member = true;
        }
        $member = Member::where('user_id', '=', Auth::user()->id)->first();
        $products = MemberProduct::all();
        $products = MemberProduct::all();
        if (request('search')) {
            $products = MemberProduct::where('product_name', 'like' , '%' .  request('search') . '%')->get();
        }
        return view('main.web.member', [
            'check_member' => $check_member,
            'products' => $products,
            'member' => $member
        ]);
    }

    public function show($member) {
        $product = MemberProduct::findOrFail($member);
        $member = Member::where('user_id', '=', Auth::user()->id)->first();
        return view('main.web.member-detail', [
            'product' => $product,
            'member' => $member
        ]);
    }
}
