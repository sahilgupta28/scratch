<?php

class Helper{

    public function create_slug($title,$table){
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
    }
}