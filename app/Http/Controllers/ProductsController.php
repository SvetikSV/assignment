<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductsController extends Controller
{
    public function index(){
		$products = \App\Product::all();
		$current_date = date("Y-m-d");
		$sales=\DB::table('sales')
            ->where(function ($query) use ($current_date) {
                $query->where('start_date','<=',$current_date)
                      ->orWhereNull('start_date');
            })
			->where(function ($query) use ($current_date) {
                $query->where('final_date','>=',$current_date)
                      ->orWhereNull('final_date');
			})
			->latest()
            ->get();
		$current_sales=array();
		foreach($sales as $sale){
			if(!array_key_exists($sale->product_id, $current_sales)){
				$current_sales[$sale->product_id] = array('difference_in_days' => null);
			}
			if($sale->start_date && $sale->final_date){
				$difference_in_days=(strtotime($sale->final_date)-strtotime($sale->start_date))/(60*60*24);
				if(empty($current_sales[$sale->product_id]['difference_in_days']) || $current_sales[$sale->product_id]['difference_in_days'] > $difference_in_days){
					$current_sales[$sale->product_id]['difference_in_days'] = $difference_in_days;
					$current_sales[$sale->product_id]['price_by_days']= $sale->price;
				}
			}
			else{
				if(!array_key_exists('price_by_days',$current_sales[$sale->product_id])){
					$current_sales[$sale->product_id]['price_by_days']= $sale->price;
				}
			}
			if(!array_key_exists('price_by_latest', $current_sales[$sale->product_id])){
				$current_sales[$sale->product_id]['price_by_latest'] = $sale->price;
			}
		}
		$productsWrapper=array();
		foreach($products as $product){
			$newArray = array(
				"id" => $product->id,
				"name"=> $product->name,
				"price_by_days" => $product->price,
				"price_by_latest" => $product->price
			);
			if(array_key_exists($product->id, $current_sales)){
				$newArray["price_by_days"] = $current_sales[$product->id]["price_by_days"];
				$newArray["price_by_latest"] = $current_sales[$product->id]["price_by_latest"];
			}
			$productsWrapper[]=$newArray;
		}
		return view('welcome', compact('productsWrapper'));
	}
	public function addProduct(Request $request){
		if ($request-> isMethod('post')){
			$new_product= new \App\Product();
			$new_product->name=$request->input('name');
			$new_product->price=$request->input('price');
			$new_product->save();
			return index();
		}
		return view('product.add');
	}
}
	