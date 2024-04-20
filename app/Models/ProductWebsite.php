<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductWebsite extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';
    protected $fillable = ['p_id', 'web_id','last_price','last_check'];

}
