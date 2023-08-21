<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MenuModel extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'tb_menu';
    protected $fillable = [
        'id' , 'nama_menu' , 'harga' , 'gambar','created_at' , 'updated_at'
    ];
}
