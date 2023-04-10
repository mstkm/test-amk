@extends('layouts.main')

@section('title', 'AMK | Dashboard')

@section('content')
  <div class="p-5 w-full h-screen overflow-auto">
    <h1 class="text-3xl font-bold mb-12">Edit Order Item</h1>

    <!-- Form -->
    <div>
      <form action="{{ route('edit-order-item', $order_item->id) }}" method="post" class="mb-3">
        @csrf
        @method('put')
        <div>
          <!-- Order Id -->
          <input type="number" name="order_id" id="order_id" value="{{ $order_item->order_id }}" hidden>
          <!-- Item -->
          <div class="form-control w-full max-w-lg mb-3">
            <label class="label">
              <span class="label-text text-base">Item</span>
            </label>
            <select onchange="getItem(value)" name="item_id" id="item_id" class="select select-bordered text-base focus:outline-none @error('item_id') border-red-800 @enderror">
              @if ($order_item->item_id)
                <option value="{{ $order_item->item_id }}" selected hidden>{{ $order_item->item->name }}</option>
              @else
                <option value="{{ null }}" selected hidden>Pilih Item</option>
              @endif
              @foreach ($items as $item)
                <option value="{{ $item->id }}">{{ $item->name }}</option>
              @endforeach
            </select>
            @error('item_id')
              <p class="text-sm text-red-800">{{ $message }}</p>
            @enderror
          </div>
          <!-- Qty -->
          <div class="form-control w-full max-w-lg mb-3">
            <label class="label">
              <span class="label-text text-base">Qty</span>
            </label>
            <input name="qty" id="qty" type="number" placeholder="Qty" class="input input-bordered w-full max-w-lg focus:outline-none @error('qty') border-red-800 @enderror" onchange="setTotal()" value="{{ old('qty', $order_item->qty) }}" />
            @error('qty')
              <p class="text-sm text-red-800">{{ $message }}</p>
            @enderror
          </div>
          <!-- Price -->
          <div class="form-control w-full max-w-lg mb-3">
            <label class="label">
              <span class="label-text text-base">Price (Rp)</span>
            </label>
            <input name="price" id="price" type="number" placeholder="Price" class="input input-bordered w-full max-w-lg focus:outline-none @error('price') border-red-800 @enderror" onchange="setTotal()" value="{{ old('price', $order_item->price) }}" />
            @error('price')
              <p class="text-sm text-red-800">{{ $message }}</p>
            @enderror
          </div>
          <!-- Discount -->
          <div class="form-control w-full max-w-lg mb-3">
            <label class="label">
              <span class="label-text text-base">Discount (%)</span>
            </label>
            <input name="discount" id="discount" type="number" placeholder="Discount" class="input input-bordered w-full max-w-lg focus:outline-none @error('discount') border-red-800 @enderror" onchange="setTotal()" value="{{ old('discount', $order_item->discount) }}" />
            @error('discount')
              <p class="text-sm text-red-800">{{ $message }}</p>
            @enderror
          </div>
          <!-- Total -->
          <div class="form-control w-full max-w-lg mb-3">
            <label class="label">
              <span class="label-text text-base">Total (Rp)</span>
            </label>
            <input name="total" id="total" type="number" placeholder="Total" class="input input-bordered w-full max-w-lg focus:outline-none @error('total') border-red-800 @enderror" value="{{ old('total', $order_item->total) }}" />
            @error('total')
              <p class="text-sm text-red-800">{{ $message }}</p>
            @enderror
          </div>
          <!-- Note -->
          <div class="form-control w-full max-w-lg mb-5">
            <label class="label">
              <span class="label-text text-base">Note</span>
            </label>
            <input name="note" id="note" type="text" placeholder="Note" class="input input-bordered w-full max-w-lg focus:outline-none @error('note') border-red-800 @enderror" value="{{ old('note', $order_item->note) }}" />
            @error('note')
              <p class="text-sm text-red-800">{{ $message }}</p>
            @enderror
          </div>
        </div>
        <div>
          <div class="w-full max-w-lg">
            <button type="submit" class="btn btn-main">Edit Item</button>
          </div>
        </div>
      </form>
      <div>
        <form action="{{ route('delete-order-item', $order_item->id) }}" method="post">
          @csrf
          @method('delete')
          <div class="w-full max-w-lg">
            <button class="btn btn-error">Hapus</button>
          </div>
        </form>
      </div>
    </div>

  </div>

  <script>
    // Get Item
    const getItem = async (id) => {
      const response = await fetch('/transaction/selectItem?id='+id)
      const data = await response.json()
      const item = data.item[0]

      price.value = item.price

      const totalPrice = (qty.value*price.value) - ((qty.value*price.value)*(discount.value/100))

      total.value = totalPrice
    }

    // Set total
    const setTotal = () => {
      const totalPrice = (qty.value*price.value) - ((qty.value*price.value)*(discount.value/100))

      total.value = totalPrice
    }
  </script>
@endsection
