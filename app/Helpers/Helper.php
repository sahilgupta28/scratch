<?php

class Helper{

    public static function create_slug($title,$table){
        $slug = str_slug($title, '-');
        $counter = 0;
        $flag = true;
        do{
            if($table::where('slug',$slug)->count() > 0){
                $slug = str_slug($title, '-').'-'.++$counter;
            }else{
                $flag = false;
            }
        }while($flag);
        return $slug;
    }

    public static function flashCreated($title="")
    {
        Session::flash('success',"$title has been created Sucessfully"); 
    }

    public static function flashUpdated($title="")
    {
        Session::flash('success',"$title has been updated Sucessfully"); 
    }

    public static function flashError()
    {
        Session::flash('error','Some technical error found.'); 
    }

    public static function flashDelete($title="")
    {
        Session::flash('success',"$title has been deleted Sucessfully"); 
    }
}