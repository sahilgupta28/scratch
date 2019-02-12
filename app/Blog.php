<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Mail;
use App\Mail\BlogUpdated;
use App\Events\BlogDeleted;

class Blog extends Model
{
    protected $fillable = ['title','description','slug','owner_id'];

    protected static function boot(){
        parent::boot();
        
        static::updated(function($blog){
            Mail::to($blog->owner->email)->send(new BlogUpdated($blog));
        });

        static::deleted(function($blog){
            event(new BlogDeleted($blog));
        });

        static::deleting(function($blog) {
            $blog->comments()->delete();
       });
    }

    public static function rules(){
        return [
            'title' => 'required',
            'description' => 'required' 
        ];
    }

    public function owner(){
        return $this->belongsTo('App\User', 'owner_id');
    }

    public function comments(){
        return $this->hasMany('App\BlogComment')->latest();
    }

}
