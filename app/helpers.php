<?php

use App\Models\Category;


function getcategory(){
    $all_categories = Category::all();
    return $all_categories;
}



?>