<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
   
    protected $primaryKey = 'id';

    protected $fillable = ['name', 'sku', 'barcode', 'create_at', 'update_at'];



    /*
    public function categories()
    {
        return $this->belongsToMany(Category::class, 'ProductCategories', 'id', 'category_id');
    }
    public function websites()
    {
        return $this->belongsToMany(Website::class, 'ProductWebsites', 'id', 'WebsiteID')
                    ->withPivot('LatestPrice', 'LastChecked');
    }
    public function alerts()
    {
        return $this->hasMany(Alert::class, 'id');
    }*/
}
