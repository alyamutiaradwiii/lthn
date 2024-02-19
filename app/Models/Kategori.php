<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    protected $table = "kategoris";
    protected $primaryKey = "id";
    protected $fillable = [
        'id','nama_kategori'
    ];

    public function relasi()
    {
        return $this->hasMany(Koleksi_relasi::class);
    }
}
