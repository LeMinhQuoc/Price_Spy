<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PriceHistory extends Model
{
    protected $primaryKey = 'id';
    protected $fillable = ['p-w_id', 'detec_price', 'detec_date'];
    /*public function productWebsite()
    {
        return $this->belongsTo(ProductWebsite::class, 'ProductWebsiteID');
    } */
}
