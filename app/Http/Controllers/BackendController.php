<?php

namespace App\Http\Controllers;

use App\Order;
use Illuminate\Http\Request;

class BackendController extends Controller
{
  public function dashboard() {
  	return view('backend.dashboard');
  }

  // public function orders()
  // {
  // 	$orders = Order::orderBy('orderdate')->get();
  // 	return view('backend.orders.index', compact('orders'));
  // }

  // public function orderdetail($id)
  // {
  // 	$order = Order::find($id);
  // 	return view('backend.orders.detail', compact('order'));
  // }
}
