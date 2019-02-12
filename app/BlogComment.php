<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BlogComment extends Model
{
    protected $fillable = ['comment','user_id','blog_id'];
    protected $appends = array('owner');

    public static function rules(){
        return [
            'comment' => 'required'
        ];
    }

    public function getOwnerAttribute(){
        return ($this->user == NULL) ? 'Guest User' : ucWords($this->user->name);
    }

    public function user(){
        return $this->belongsTo('App\User');
    }
}
