<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Subscriber extends Model
{
    use Notifiable;
    use SoftDeletes;
    
    // Table name
    protected $table = 'subscribers';

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

}
