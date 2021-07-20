<?php

namespace App\Models\Autoshop;

use http\Env\Request;
use Illuminate\Database\Eloquent\Model;
use DB;
use App\Models\Core\Categories;
use Illuminate\Support\Facades\Lang;



class Languages extends Model
{

  public function languages(){
    $data = DB::table('languages')
              ->leftJoin('image_categories','languages.image','image_categories.image_id')
              ->select('languages.*','image_categories.path as image_path')
              ->get();
    return $data;
  }

}
