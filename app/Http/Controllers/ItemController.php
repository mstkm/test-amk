<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
      $user = User::select('*')->where('id', Auth::id())->get()[0];

      return view('pages.item.index', [
        'items' => Item::orderBy('name')->get(),
        'user' => $user
      ]);
    }


    public function search(Request $request)
    {
      $user = User::select('*')->where('id', Auth::id())->get()[0];
      $keyword = $request->keyword;
      $search = '%'.$keyword.'%';
      return view('pages.item.index', [
        'items' => Item::where('name', 'like', $search)->get(),
        'user' => $user
      ]);
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
      $user = User::select('*')->where('id', Auth::id())->get()[0];
      return view('pages.item.create', [
        'user' => $user
      ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
      $validateData = $request->validate([
        'name' => 'required|unique:items,name',
        'price' => 'required|numeric',
        'description' => 'required'
      ]);

      Item::create($validateData);

      return redirect()->route('item.index')->with('success', 'Item baru berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
      $user = User::select('*')->where('id', Auth::id())->get()[0];
      return view('pages.item.show', [
        'item' => Item::findOrFail($id),
        'user' => $user
      ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
      $user = User::select('*')->where('id', Auth::id())->get()[0];
      return view('pages.item.edit', [
        'item' => Item::findOrFail($id),
        'user' => $user
      ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
      $validateData = $request->validate([
        'name' => ['required', Rule::unique('items')->ignore($id)],
        'price' => 'required|numeric',
        'description' => 'required'
      ]);

      $item = Item::findOrFail($id);

      $item->update($validateData);

      return redirect()->route('item.index')->with('success', 'Data item berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
      $item = Item::findOrFail($id);

      $item->delete();

      return redirect()->route('item.index')->with('delete', 'Data item berhasil dihapus!');
    }
}
