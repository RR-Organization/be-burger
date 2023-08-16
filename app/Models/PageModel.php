<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PageModel extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'tb_page';
    protected $fillable = [
        'id' , 'description', 'created_at' , 'updated_at'
    ];
}
