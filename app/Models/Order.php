<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $guarded = ['id'];
    use HasFactory;

    public function product() {
        return $this->belongsTo(Product::class);
    }
    public function transaction() {
        return $this->belongsTo(Transaction::class);
    }
}
