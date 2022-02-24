<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Transaction;
use App\Models\Modal;
use Illuminate\Http\Request;
use Carbon\Carbon;


class ReportController extends Controller
{
    public function index() {
        $transactions = Transaction::all();
        $modals = Modal::all();

        if(request('report') == 'week') {
            $modals = Modal::whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->get();
            $transactions = Transaction::whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->get();
        } elseif (request('report') == 'month') {
            $modals = Modal::whereMonth('created_at', date('m'))->whereYear('created_at', date('Y'))->get();
            $transactions = Transaction::whereMonth('created_at', date('m'))->whereYear('created_at', date('Y'))->get();
        }

        $income = 0;
        foreach($transactions as $transaction) {
            $income += $transaction->total_cost;
        }


        $modal_total = 0;
        foreach($modals as $modal_data) {
            $modal_total += $modal_data->cost;
        }


        return view('admin.web.report', [
            'income' => $income,
            'modal' => $modal_total,
        ]);
    }
}
