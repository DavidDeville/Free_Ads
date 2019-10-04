<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Images extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'annonce_id', 'images',
    ];

    public function annonces()
    {
        return $this->belongsTo('App\Annonces', 'annonce_id');
    }
}
