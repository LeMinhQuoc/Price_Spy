<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alert extends Model
{
    protected $primaryKey = 'AlertID';

    protected $fillable = ['ProductID', 'UserID', 'AlertType', 'ThresholdValue', 'IsActive', 'LastAlertSent'];

    public function product()
    {
        return $this->belongsTo(Product::class, 'ProductID');
}
}