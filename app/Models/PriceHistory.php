<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PriceHistory extends Model
{
    protected $primaryKey = 'PriceHistoryID';

    protected $fillable = ['ProductWebsiteID', 'DetectedPrice', 'DateDetected'];

    public function productWebsite()
    {
        return $this->belongsTo(ProductWebsite::class, 'ProductWebsiteID');
    }
}
