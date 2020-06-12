<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;
    
    // Table name
    protected $table = 'products';

    //  Fillable
    protected $guarded = [];

    // Primary Key
    public $primaryKey = 'id';
    // Timestamps
    public $timestamps = true;

    public function createdAtAgo()
    {
        return Carbon::instance($this->created_at)->diffForHumans();
    }

    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
