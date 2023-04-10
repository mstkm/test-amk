<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Item;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
      $user = User::select('*')->where('id', Auth::id())->get()[0];
      return view('pages.transaction.index', [
        'orders' => Order::all(),
        'user' => $user
      ]);
    }

    // Search Order
    public function search(Request $request)
    {
      $user = User::select('*')->where('id', Auth::id())->get()[0];
      $keyword = $request->keyword;
      $search = '%'.$keyword.'%';
      return view('pages.transaction.index', [
        'orders' => Order::where('code', 'like', $search)->get(),
        'user' => $user
      ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
      $user = User::select('*')->where('id', Auth::id())->get()[0];
      return view('pages.transaction.create', [
        'customers' => Customer::orderBy('name')->get(),
        'user' => $user
      ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
      $validateData = $request->validate([
        'code' => 'required|unique:orders,code',
        'date' => 'required|date',
        'customer_id' => 'required|exists:customers,id',
        'address' => 'required',
        'subtotal' => 'nullable',
        'discount' => 'nullable',
        'total' => 'nullable'
      ]);

      Order::create($validateData);

      $order_id = Order::select('id')->where('code', $validateData['code'])->get()[0];

      return redirect()->route('add-items', [$order_id]);
    }

    // Add Items
    public function addItems(string $id) {
      $user = User::select('*')->where('id', Auth::id())->get()[0];

      $order = Order::select('*')->where('id', $id)->get()[0];
      $items = Item::all();
      $order_items = OrderItem::where('order_id', $id)->get();

      return view('pages.transaction.add-items', [
        'order' => $order,
        'items' => $items,
        'order_items' => $order_items,
        'user' => $user
      ]);
    }

    // Store Item
    public function storeItems(Request $request) {
      $validateData = $request->validate([
        "order_id" => "required|exists:orders,id",
        "item_id" => "required|exists:items,id",
        "qty" => "required|numeric",
        "price" => "required|numeric",
        "discount" => "required|numeric",
        "total" => "required|numeric",
        "note" => "nullable"
      ]);

      OrderItem::create($validateData);

      return redirect()->route('add-items', [$validateData['order_id']]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
      $user = User::select('*')->where('id', Auth::id())->get()[0];

      $order = Order::select('*')->where('id', $id)->get()[0];
      $items = Item::select('*')->orderBy('name')->get();
      $order_items = OrderItem::where('order_id', $id)->get();

      if ($order_items->count() == 0) {
        $order_items = [];
      };

      return view('pages.transaction.show', [
        'order' => $order,
        'items' => $items,
        'order_items' => $order_items,
        'user' => $user
      ]);
    }

    // Show edit order item
    public function showEditOrderItem(string $id)
    {
      $user = User::select('*')->where('id', Auth::id())->get()[0];
      $order_item = OrderItem::where('id', $id)->get()[0];
      $items = Item::select('*')->orderBy('name')->get();

      return view('pages.transaction.edit-order-item', [
        'order_item' => $order_item,
        'items' => $items,
        'user' => $user
      ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
      $user = User::select('*')->where('id', Auth::id())->get()[0];
      $order = Order::findOrFail($id);
      return view('pages.transaction.edit', [
        'order' => $order,
        'customers' => Customer::orderBy('name')->get(),
        'user' => $user
      ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
      $order = Order::findOrFail($id);
      $order['subtotal'] = $request['order_subtotal'];
      $order['discount'] = $request['order_discount'];
      $order['total'] = $request['order_total'];

      $dataOrder = [$order];

      $order->update($dataOrder);

      return redirect()->route('transaction.index')->with('success', 'Transaksi berhasil dibuat!');
    }

    // Edit order
    public function editOrder(Request $request, string $id) {
      $validateData = $request->validate([
        'code' => 'required',
        'date' => 'required|date',
        'customer_id' => 'required|exists:customers,id',
        'address' => 'required',
        'subtotal' => 'nullable',
        'discount' => 'nullable',
        'total' => 'nullable'
      ]);

      $order = Order::findOrFail($id);

      $order->update($validateData);

      return redirect()->route('transaction.index')->with('success', 'Data order berhasil diubah!');
    }

    // Edit order item
    public function editOrderItem(Request $request, string $id) {

      $order = Order::where('id', $request->order_id)->get()[0];
      $orderItem = OrderItem::where('id', $id)->get()[0];
      $order['subtotal'] = $order['subtotal'] - $orderItem['total'];
      $order['total'] = $order['total'] - $orderItem['total'];

      $validateData = $request->validate([
        "item_id" => "required",
        "qty" => "required|numeric",
        "price" => "required|numeric",
        "discount" => "required|numeric",
        "total" => "required|numeric",
        "note" => "nullable"
      ]);
      // return [$id, $validateData];
      $order['subtotal'] = $order['subtotal'] + $validateData['total'];
      $order['total'] = $order['total'] + $validateData['total'];

      $dataOrder = [$order];

      $order->update($dataOrder);
      $orderItem->update($validateData);

      return redirect()->route('transaction.index')->with('success', 'Data order berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
      $orderItems = OrderItem::where('order_id', $id)->get();

      foreach($orderItems as $orderItem) {
        $order_item = OrderItem::findOrFail($orderItem->id);
        $order_item->delete();
      }

      $order = Order::findOrFail($id);
      $order->delete();

      return redirect()->route('transaction.index')->with('delete', 'Data order berhasil dihapus!');
    }

    // Delete Order Item
    public function deleteOrderItem(string $id)
    {
      $order_item = OrderItem::findOrFail($id);

      $order = Order::where('id', $order_item->order_id)->get()[0];
      $order['subtotal'] = $order['subtotal'] - $order_item['total'];
      $order['total'] = $order['total'] - $order_item['total'];

      $order_item->delete();

      $dataOrder = [$order];
      $order->update($dataOrder);

      return redirect()->route('transaction.index')->with('delete', 'Data order item berhasil dihapus!');
    }

    // Get Customer
    public function selectCustomer(Request $request) {
      $customer = Customer::where('id', $request->id)->get();
      return response()->json(['customer' => $customer]);
    }

    // Get Item
    public function selectItem(Request $request) {
      $item = Item::where('id', $request->id)->get();
      return response()->json(['item' => $item]);
    }

    // Get Order Item
    public function selectOrderItem(Request $request) {
      $order_item = OrderItem::where('id', $request->id)->get();
      return response()->json(['order_item' => $order_item]);
    }
}
