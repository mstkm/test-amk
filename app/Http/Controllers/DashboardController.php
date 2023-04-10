<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Item;
use App\Models\Order;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
  public function index() {
    $user = User::select('*')->where('id', Auth::id())->get()[0];
    $staff = User::select('*')->where('role', 'Staff')->get();
    $customers = Customer::all();
    $items = Item::all();
    $orders = Order::all();
    return view('pages.dashboard', [
      'user' => $user,
      'customers' => $customers,
      'items' => $items,
      'orders' => $orders,
      'staff' => $staff
    ]);
  }
}
