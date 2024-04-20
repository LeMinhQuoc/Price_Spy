<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductCategories extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';
    protected $fillable = ['p_id', 'cate_id','create_at', 'update_at'];
}
