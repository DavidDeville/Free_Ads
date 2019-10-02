<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Annonces extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'description', 'price', 'user_id',
    ];

    public function annonces()
    {
        return $this->belongsTo('App\Images');
    }
}
