<?php
namespace App\Http\Controllers\Autoshop;
//use Mail;
//validator is builtin class in laravel
use Validator;

use DB;
//for password encryption or hash protected
use Hash;

//for authenitcate login data
use Auth;
use Illuminate\Foundation\Auth\ThrottlesLogins;

//for requesting a value
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Models\Autoshop\Products;
use App\Models\Autoshop\Index;
use App\Models\Autoshop\Cart;

//for Carbon a value
use Carbon;
use Session;
use Lang;

class CartController extends Controller
{

	public function __construct(
		                  Index $index,
											Products $products,
											Cart $cart
											)
	{
		$this->index = $index;
		$this->products = $products;
		$this->cart = $cart;
		$this->theme = new ThemeController();

	}

	//myCart
	public function viewcart(Request $request){
        
		$title = array('pageTitle' => Lang::get("website.View Cart"));
		$result = array();
		$data = array();
		$result['commonContent'] = $this->index->commonContent();
		$final_theme = $this->theme->theme();
		
		$other_charges = DB::table('other_charges')
		                ->join('other_charges_to_categories','other_charges_to_categories.other_charges_id','other_charges.id')
		                ->where('status', 1)->get();
		
        //dd($other_charges);
		$result['cart'] = $this->cart->myCart($data);
	
		// lets check if other chrages applicable of not
		foreach($result['cart']  as $products){
		    foreach($other_charges as $othercharge){
		         if($othercharge->categories_id == $products->categories_id){
		              $baskits = 	DB::table('customers_basket')->where('customers_basket_id', '=', $products->customers_basket_id)->first();
		              if($baskits){
		                    $baskits_products_id =  (int)$baskits->products_id;
                            $baskit_id = $baskits->customers_basket_id;
                    	    $org_final_price = $baskits->final_price;
                    	    if($othercharge->is_percentage == 1){
                                $perc_amount = ($othercharge->amount / 100)  * $baskits->final_price;
                                if($othercharge->changes_on_total == 1){
                                     $products->final_price = number_format((float)($baskits->final_price + $perc_amount ), 2, '.', '');
                                }elseif($othercharge->changes_on_total == 2){
                                     $products->final_price = number_format((float)($baskits->final_price - $perc_amount), 2, '.', '');
                                }
                            }else{
                                if($othercharge->changes_on_total == 1){
                                    $products->final_price = number_format((float)($baskits->final_price + $othercharge->amount), 2, '.', '');
                                }elseif($othercharge->changes_on_total == 2){
                                    $final_price = number_format((float)($baskits->final_price - $othercharge->amount), 2, '.', '');
                                }else{
                                    $products->final_price = number_format((float)$othercharge->amount, 2, '.', '');
                                }
                            }
                            $final_price = $products->final_price;
                            $products->old_final_price = $final_price;
                            
                            DB::table('customers_basket')->where('customers_basket_id', '=', $baskits->customers_basket_id)->update([
                    		        'final_price' => $final_price,
                    		        'old_final_price' => $org_final_price,
                    		        'customers_basket_quantity' =>($baskits->customers_basket_quantity > $othercharge->qty_limit ) ?  $othercharge->qty_limit : $baskits->customers_basket_quantity
                    		]);
                    		///now handleother chrages baskets
                            $other_charges_baskets = 	DB::table('other_charges_baskets')->where('customers_basket_id', '=', $baskits->customers_basket_id)->where('products_id', '=', $baskits_products_id)->first();
                            if(empty($other_charges_baskets)){
                                DB::table('other_charges_baskets')->insert(
                    			[
                    				 'other_charges_id' => $othercharge->id,
                    				 'customers_basket_id'  => $baskit_id,
                    				 'products_id' =>$baskits_products_id,
                    				 'is_checked' => 1
                    			]);
                            }else{
                                DB::table('other_charges_baskets')->where('id', '=', $other_charges_baskets->id)->where('products_id', '=', $baskits_products_id)->update(['is_checked' => 1]);
                            }
                        
		              }
		         }
		    }
		}
		
	
		
		
		//apply coupon
		if(session('coupon')){
			$session_coupon_data = session('coupon');
			session(['coupon' => array()]);
			$response = array();
			if(!empty($session_coupon_data)){
				foreach($session_coupon_data as $key=>$session_coupon){
						$response = $this->cart->common_apply_coupon($session_coupon->code);
				}
			}
		}
		//header("Refresh:0");
		//dd($result['cart']);
		return view("autoshop.carts.viewcart", ['title' => $title,'final_theme' => $final_theme,'other_charges' =>$other_charges])->with('result', $result);
	}

	//eidtCart
	public function editcart(Request $request,$id,$slug){


				$title 			= 	array('pageTitle' => Lang::get('website.Product Detail'));
				$result 		= 	array();
				$result['commonContent'] = $this->index->commonContent();
				$final_theme = $this->theme->theme();
				//min_price
				if(!empty($request->min_price)){
					$min_price = $request->min_price;
				}else{
					$min_price = '';
				}

				//max_price
				if(!empty($request->max_price)){
					$max_price = $request->max_price;
				}else{
					$max_price = '';
				}

				if(!empty($request->limit)){
					$limit = $request->limit;
				}else{
					$limit = 15;
				}

				$products = $this->products->getProductsBySlug($slug);

				//category
				$category = $this->products->getCategoryByParent($products[0]->products_id);


				if(!empty($category)){
					$category_slug = $category[0]->categories_slug;
					$category_name = $category[0]->categories_name;
				}else{
					$category_slug = '';
					$category_name = '';
				}
				$sub_category = $this->products->getSubCategoryByParent($products[0]->products_id);

				if(!empty($sub_category) and count($sub_category)>0){
					$sub_category_name = $sub_category[0]->categories_name;
					$sub_category_slug = $sub_category[0]->categories_slug;
				}else{
					$sub_category_name = '';
					$sub_category_slug = '';
				}

				$result['category_name'] = $category_name;
				$result['category_slug'] = $category_slug;
				$result['sub_category_name'] = $sub_category_name;
				$result['sub_category_slug'] = $sub_category_slug;

				$isFlash = $this->products->getFlashSale($products[0]->products_id);


				if(!empty($isFlash) and count($isFlash)>0){
					$type = "flashsale";
				}else{
					$type = "";
				}

				$data = array('page_number'=>'0', 'type'=>$type, 'products_id'=>$products[0]->products_id, 'limit'=>$limit, 'min_price'=>$min_price, 'max_price'=>$max_price);
				$detail = $this->products->products($data);
				$result['detail'] = $detail;

				$i = 0;
				foreach($result['detail']['product_data'][0]->categories as $postCategory){
					if($i==0){
						$postCategoryId = $postCategory->categories_id;
						$i++;
					}
				}

				$data = array('page_number'=>'0', 'type'=>'', 'categories_id'=>$postCategoryId, 'limit'=>$limit, 'min_price'=>$min_price, 'max_price'=>$max_price);
				$simliar_products = $this->products->products($data);
				$result['simliar_products'] = $simliar_products;

				$cart = '';
				$result['cartArray'] = $this->products->cartIdArray($cart);

				//liked products
				$result['liked_products'] = $this->products->likedProducts();

	     	$result['cart'] = $this->cart->myCart($id);

		return view("autoshop.detail", ['title' => $title, 'final_theme' => $final_theme])->with('result', $result);

	}

	//deleteCart
	public function deleteCart(Request $request){
    
   		$check = $this->cart->deleteCart($request);
		//apply coupon
		if(!empty(session('coupon')) and count(session('coupon'))>0){
			$session_coupon_data = session('coupon');
			session(['coupon' => array()]);
			if(count($session_coupon_data)=='2'){
				$response = array();
				if(!empty($session_coupon_data)){
					foreach($session_coupon_data as $key=>$session_coupon){
							$response = $this->cart->common_apply_coupon($session_coupon->code);
					}
				}
			}
		}

		if(!empty($request->type) and $request->type=='header cart'){   
		  	$result['commonContent'] = $this->index->commonContent();
			if(empty($check)){
				$message = Lang::get("website.Cart item has been deleted successfully");
				return redirect('/autoshop')->with('message', $message);

			}else{
				$message = Lang::get("website.Cart item has been deleted successfully");
				return view("autoshop.headers.cartButtons.cartButton")->with('result', $result);
			}
		}else{
			if(empty($check)){
				$message = Lang::get("website.Cart item has been deleted successfully");
				return redirect('/autoshop')->with('message', $message);

			}else{
				$message = Lang::get("website.Cart item has been deleted successfully");
				return redirect()->back()->with('message', $message);
			}
		}
	}


	//getCart
	public function cartIdArray($request){
      $this->cart->cartIdArray($request);
	}

	//updatesinglecart
	public function updatesinglecart(Request $request){
    $this->cart->updatesinglecart($request);
		return view("autoshop.headers.cartButtons.cartButton")->with('result', $result);
	}



	//addToCart
	public function addToCart(Request $request){
	   
		$result = $this->cart->addToCart($request);
		if(!empty($result['status']) && $result['status'] == 'exceed'){
			return $result;
		}
		return view("autoshop.headers.cartButtons.cartButton")->with('result', $result);
	}
	//updateCart
	public function updateCart(Request $request){

		if(empty(session('customers_id'))){
			$customers_id					=	'';
		}else{
			$customers_id					=	session('customers_id');
		}
		$session_id							=	Session::getId();
		foreach($request->cart as $key=>$customers_basket_id){
       $this->cart->updateRecord($customers_basket_id,$customers_id,$session_id,$request->quantity[$key]);
		}

		$message = Lang::get("website.Cart has been updated successfully");
		return redirect()->back()->with('message', $message);

	}




	//apply_coupon
	public function apply_coupon(Request $request){

		$result = array();
		$coupon_code = $request->coupon_code;


		$carts = $this->cart->myCart(array());
		if(count($carts)>0){
			$response = $this->cart->common_apply_coupon($coupon_code);
		}else{
			$response = array('success'=>'0', 'message'=>Lang::get("website.Coupon can not be apllied to empty cart"));
		}
			print_r(json_encode($response));
	}


	//removeCoupon
	public function removeCoupon(Request $request){
		$coupons_id = $request->id;

		$session_coupon_data = session('coupon');
		session(['coupon' => array()]);
		session(['coupon_discount' => 0]);
		$response = array();
		if(!empty($session_coupon_data)){
			foreach($session_coupon_data as $key=>$session_coupon){
				if($session_coupon->coupans_id != $coupons_id){
					$response = $this->cart->common_apply_coupon($session_coupon->code);
				}
			}
		}

		$message = Lang::get("website.Coupon has been removed successfully");
		return redirect()->back()->with('message', $message);

	}
	
	
	// apply other charges
	public function apply_other_charge(Request $request){
       
	  
	
	    $this->cart->apply_other_charge($request);
	    $message = Lang::get("website.Other charge on Cart item has been updated successfully");
		return redirect()->back()->with('message', $message);
	}


	// remove other charges
	public function remove_other_charge(Request $request){
	    $this->cart->remove_other_charge($request);
	    $message = Lang::get("website.Other charge on Cart item has been deleted successfully");
		return redirect()->back()->with('message', $message);
	}

}
