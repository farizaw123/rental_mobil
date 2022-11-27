<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class kendaraan extends Model
{
    use HasFactory;
    protected $fillable = ['nama', 'merk', 'seat', 'cc', 'warna', 'transmisi', 'tahun', 'harga', 'deskripsi'];
}
