<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Service extends Model
{
    use SoftDeletes;
    
    // Table name
    protected $table = 'services';

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

    public function menu()
    {
        return $this->belongsTo(Menu::class);
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
