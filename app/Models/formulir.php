<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class formulir extends Model
{
    use HasFactory;
    protected $fillable = ['id_user','nama', 'alamat', 'telp', 'email', 'tanggal_sewa', 'mobil_sewa', 'pickup_time', 'harga', 'order_code'];
    public function kendaraan()
    {
        return $this->belongsTo(kendaraan::class);
    }

}
