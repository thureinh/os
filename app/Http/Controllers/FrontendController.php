<?php

namespace App\Http\Controllers;

use App\Item;
use App\Brand;
use App\Category;
use App\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FrontendController extends Controller
{

  public function __construct(){
    $this->middleware('auth')->only('checkout');
  }

  public function home() {

    $brands = Brand::orderBy('name')->get();
    $categories = Category::orderBy('name')->withCount(['subcategories' => function($subcategory){$subcategory->orderBy('name');}])->get();

  	$items = Item::orderBy('id', 'desc')->take(4)->get();
  	return view('frontend.index', compact('items', 'brands', 'categories'));
  }

  // ItemController -> show method
  public function itemdetail($item) {
    
    $brands = Brand::orderBy('name')->get();
    $categories = Category::orderBy('name')->withCount(['subcategories' => function($subcategory){$subcategory->orderBy('name');}])->get();

  	$item = Item::find($item);
  	return view('frontend.detail', compact('item', 'brands', 'categories'));
  }

  public function cart() {
    
    $brands = Brand::orderBy('name')->get();
    $categories = Category::orderBy('name')->withCount(['subcategories' => function($subcategory){$subcategory->orderBy('name');}])->get();

  	return view('frontend.cart', compact('brands', 'categories'));
  }

  public function checkout(Request $request)
  {
    $arr = json_decode($request->data);
    $list = $arr->product_list;

    $total = 0;
    foreach ($list as $row) {
      $total += $row->price * $row->quantity;
    }

    $order = new Order;
    $order->orderdate = date('Y-m-d');
    $order->voucherno = uniqid();
    $order->total = $total;
    $order->note = $request->note;
    $order->status = 0;
    $order->user_id = Auth::id();

    $order->save();
    // for item_order
    foreach ($list as $row) {
      $order->items()->attach($row->id, ['qty' => $row->quantity]);
    }
  }

}
