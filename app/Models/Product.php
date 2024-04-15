<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
   
    protected $primaryKey = 'ProductID';

    protected $fillable = ['ProductName', 'ProductCode', 'SKU', 'DateAdded', 'IsActive'];

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'ProductCategories', 'ProductID', 'CategoryID');
    }
    public function websites()
    {
        return $this->belongsToMany(Website::class, 'ProductWebsites', 'ProductID', 'WebsiteID')
                    ->withPivot('LatestPrice', 'LastChecked');
    }
    public function alerts()
    {
        return $this->hasMany(Alert::class, 'ProductID');
    }
}
