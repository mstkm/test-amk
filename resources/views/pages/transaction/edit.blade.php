@extends('layouts.main')

@section('title', 'AMK | Dashboard')

@section('content')
  <div class="p-5 w-full h-screen overflow-auto">
    <h1 class="text-3xl font-bold mb-12">Edit Transaksi</h1>

    <!-- Form -->
    <div>
      <form action="{{ route('edit-order', $order->id) }}" method="post">
        @csrf
        @method('put')
        <!-- Order -->
        <div>
          <!-- Code -->
          <div class="form-control w-full max-w-lg mb-3">
            <label class="label">
              <span class="label-text text-base">Code</span>
            </label>
            <input name="code" id="code" type="text" placeholder="Type code" class="input input-bordered w-full max-w-lg focus:outline-none text-base @error('code') border-red-800 @enderror" value="{{ old('code', $order->code) }}" />
            @error('code')
              <p class="text-sm text-red-800">{{ $message }}</p>
            @enderror
          </div>
          <!-- Date -->
          <div class="form-control w-full max-w-lg mb-3">
            <label class="label">
              <span class="label-text text-base">Date</span>
            </label>
            <input name="date" id="date" type="date" placeholder="Type here" class="input input-bordered w-full max-w-lg focus:outline-none text-base @error('date') border-red-800 @enderror" value="{{ old('date', $order->date) }}" />
            @error('date')
              <p class="text-sm text-red-800">{{ $message }}</p>
            @enderror
          </div>
          <!-- Customer -->
          <div class="form-control w-full max-w-lg mb-3">
            <label class="label">
              <span class="label-text text-base">Customer</span>
            </label>
            <select name="customer_id" id="customer_id" onchange="getCustomer(value)" class="select select-bordered focus:outline-none text-base @error('customer_id') border-red-800 @enderror" value="{{ old('customer_id', $order->customer_id) }}">
              @if ($order->customer_id)
                <option value="{{ $order->customer_id }}" selected hidden>{{ $order->customer->name }}</option>
              @else
                <option disabled selected hidden>Pilih Customer</option>
              @endif
              @foreach ($customers as $customer)
                  <option value="{{ $customer->id }}">{{ $customer->name }}</option>
              @endforeach
            </select>
            @error('customer_id')
              <p class="text-sm text-red-800">{{ $message }}</p>
            @enderror
          </div>
          <!-- Address -->
          <div class="form-control w-full max-w-lg mb-3">
            <label class="label">
              <span class="label-text text-base">Address</span>
            </label>
            <textarea name="address" id="address" class="textarea textarea-bordered h-24 text-base @error('address') border-red-800 @enderror" placeholder="Type addresss">{{ old('address', $order->address) }}</textarea>
            @error('address')
              <p class="text-sm text-red-800">{{ $message }}</p>
            @enderror
          </div>
        </div>
        <div class="w-fit mt-8">
          <button type="submit" class="btn btn-main">Submit</button>
        </div>
      </form>
    </div>

  </div>

  <script>
    const getCustomer = async (id) => {
      const response = await fetch('/transaction/selectCustomer?id='+id)
      const data = await response.json()
      const customer = data.customer[0]

      address.value = customer.address
    }
  </script>
@endsection
