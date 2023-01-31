<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nasabah extends Model
{
    use HasFactory;

    protected $table = 'nasabah';

    protected $guarded = [];

    public function nasabah_transaksis()
    {
        return $this->hasMany(Transaksi::class, 'account_id', 'id');
    }

    public function nasabah_poins()
    {
        return $this->hasMany(Poin::class, 'account_id', 'id');
    }
}
