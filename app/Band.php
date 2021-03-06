<?php

namespace App;

class Band extends BaseModel
{
    protected $fillable = ['name', 'slug', 'image_url'];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    public function albums() {
      return $this->hasMany('App\Album');
    }

    public function songs() {
      return $this->hasMany('App\Song')->orderBy('name');
    }

    public function videos() {
      return $this->hasMany('App\Video');
    }

    public function tours() {
        return $this->hasMany('App\Tour')->orderBy('date', 'desc');
    }
}
