<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Standard extends Model
{
    protected $guarded = [];

    public function expectations() {
        return $this->hasMany('App\Expectation');
    }

    public function essentialQuestions() {
        return $this->hasMany('App\EssentialQuestion');
    }
}
