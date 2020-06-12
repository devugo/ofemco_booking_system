<?php

namespace App;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    // Table name
    protected $table = 'users';

    //  Fillable
    protected $guarded = [];

    // Primary Key
    public $primaryKey = 'id';
    // Timestamps
    public $timestamps = true;

    public function users()
    {
        return $this->hasMany(User::class);
    }
}
