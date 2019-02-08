<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    protected $fillable = ['title','description','slug','owner_id'];

    public static function rules(){
        return [
            'title' => 'required',
            'description' => 'required' 
        ];
    }

    public function owner(){
        return $this->belongsTo('App\User', 'owner_id');
    }
}
