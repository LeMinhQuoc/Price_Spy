<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Website extends Model
{
    protected $primaryKey = 'id';

    protected $fillable = ['web_name', 'url'];

   /* public function products()
    {
        return $this->belongsToMany(Product::class, 'ProductWebsites', 'WebsiteID', 'ProductID')
                    ->withPivot('LatestPrice', 'LastChecked');
    }*/
}
