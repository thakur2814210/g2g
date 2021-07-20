<?php

namespace App\Models\Vendor;

Use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Kyslik\ColumnSortable\Sortable;
use Hash;
class Vendor extends Model
{
    //
    use Sortable;
    // public function images(){
    //     return $this->belongsTo('App\Images');
    // }
    //
    // public function categories_description(){
    //     return $this->beliesngsTo('App\Categories_description');
    // }

    // public $sortable =['categories_id','created_at'];
    // public $sortableAs =['categories_name'];

    public function edit($id){
        $vendor = Vendor::where('id', $id)->first();
        return $vendor;
    }
    public function updaterecord($data){

      $date	= date('y-m-d h:i:s');
      if($data['image_id']){
          $uploadImage = $data['image_id'];
          $uploadImage = DB::table('image_categories')
                           ->where('image_id',$uploadImage)
                           ->select('path')
                           ->first();

          $uploadImage = 	$uploadImage->path;
      }	else{
          $uploadImage = $data['oldImage'];
      }

      DB::table('vendors')->where('id','=', auth()->guard('vendor')->user()->id)->update([
        'shop_name'		=>	$data['shop_name'],
        'email'	=>	$data['email'],
        'zip_code'		=>	$data['zip_code'],
        'phone'			=>	$data['phone'],
        'address'			=>	$data['address'],
        'updated_at'	=>	$date
      ]);
      
   }
   public function updatepassword($data){
     $date	= date('y-m-d h:i:s');
     DB::table('vendors')->where('id','=', auth()->guard('vendor')->user()->id)->update([
      'password'			=>	Hash::make($data['password']),
      'email'			    =>	$data['email'],
      'updated_at'	  =>	$date
     ]);

  }

}
