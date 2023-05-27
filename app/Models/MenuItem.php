<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class MenuItem extends Model
{
    public static function getMenuItems($data){
        $children = [];
        foreach($data as $obj){
            $children[$obj['parent_id']][] = $obj['id'];
            $data[$obj['id']] = $obj;
        }
        
        $menuItems = [];
        
        $setChild = function(&$array, $parents) use (&$setChild, $data, $children){
            foreach($parents as $parent){
                $temp = $data[$parent];
                if(isset($children[$parent])){
                    $temp['children'] = [];
                    $setChild($temp['children'], $children[$parent]);
                }
                $array[] = $temp;
            }    
        };
        $setChild($menuItems, $children['']);
        return $menuItems;
    }

}