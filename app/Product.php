<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'poster',
        'manufacturer_id',
        'purpose_id',
        'available',
        'price',
        'from',
        'to',
        'description',
    ];

    protected $dates = ['deleted_at'];

    public function manufacturer()
    {
        return $this->belongsTo('App\Manufacturer');
    }

    public function purpose()
    {
        return $this->belongsTo('App\Purpose');
    }
}
