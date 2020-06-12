<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Menu extends Model
{
    use SoftDeletes;
    
    // Table name
    protected $table = 'menus';

    //  Fillable
    protected $guarded = [];

    // Primary Key
    public $primaryKey = 'id';
    // Timestamps
    public $timestamps = true;

    public function services()
    {
        return $this->hasMany(Service::class);
    }

    public function createdAtAgo()
    {
        return Carbon::instance($this->created_at)->diffForHumans();
    }
}
