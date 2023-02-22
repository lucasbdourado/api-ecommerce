<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    public static function tree()
    {
        $allCategories = Category::all();

        $categories = $allCategories->whereNull('parent_id');

        self::formatTree($categories, $allCategories);

        return $categories;
    }

    public static function formatTree($categories, $allCategories){

        foreach ($categories as $category){
            $category->children = $allCategories->where('parent_id', $category->id)->values();

            if($category->children->isNotEmpty()){
                self::formatTree($category->children, $allCategories);
            }
        }
    }


}
