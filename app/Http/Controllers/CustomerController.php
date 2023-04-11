<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
      $user = User::select('*')->where('id', Auth::id())->get()[0];
      return view('pages.customer.index', [
        'customers' => Customer::orderBy('name')->get(),
        'user' => $user
      ]);
    }

    public function search(Request $request)
    {
      $user = User::select('*')->where('id', Auth::id())->get()[0];
      $keyword = $request->keyword;
      $search = '%'.$keyword.'%';
      return view('pages.customer.index', [
        'customers' => Customer::where('name', 'like', $search)->get(),
        'user' => $user
      ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
      $user = User::select('*')->where('id', Auth::id())->get()[0];
      return view('pages.customer.create', [
        'user' => $user
      ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
      $validateData = $request->validate([
        'name' => 'required',
        'address' => 'required',
        'phone' => ['required', 'regex:/^(^08)(\d{3,4}-?){2}\d{3,4}$/', 'unique:customers,phone']
      ]);

      Customer::create($validateData);

      return redirect()->route('customer.index')->with('success', 'Customer baru berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
      $user = User::select('*')->where('id', Auth::id())->get()[0];
      return view('pages.customer.show', [
        'customer' => Customer::findOrFail($id),
        'user' => $user
      ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
      $user = User::select('*')->where('id', Auth::id())->get()[0];
      return view('pages.customer.edit', [
        'customer' => Customer::findOrFail($id),
        'user' => $user
      ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
      $validateData = $request->validate([
        'name' => 'required',
        'address' => 'required',
        'phone' => ['required', 'regex:/^(^\+62|62|^08)(\d{3,4}-?){2}\d{3,4}$/', Rule::unique('customers')->ignore($id)]
      ]);

      $customer = Customer::findOrFail($id);

      $customer->update($validateData);

      return redirect()->route('customer.index')->with('success', 'Data customer berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
      $customer = Customer::findOrFail($id);

      $customer->delete();

      return redirect()->route('customer.index')->with('delete', 'Data customer berhasil dihapus!');
    }
}
