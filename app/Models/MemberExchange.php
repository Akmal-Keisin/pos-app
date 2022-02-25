<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MemberExchange extends Model
{
    protected $guarded = ['id'];
    use HasFactory;

    public function memberProduct() {
        return $this->belongsTo(MemberProduct::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }
}
