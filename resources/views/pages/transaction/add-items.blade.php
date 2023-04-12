@extends('layouts.main')

@section('title', 'AMK | Dashboard')

@section('content')
  <div class="p-5 w-full h-screen overflow-auto">
    <h1 class="text-3xl font-bold mb-12">Transaksi</h1>

    <!-- Data Order -->
    <div class="mb-5">
    <table>
      <tr>
        <td>Code</td>
        <td class="pl-5 pr-3">:</td>
        <td>{{ $order->code }}</td>
      </tr>
      <tr>
        <td>Date</td>
        <td class="pl-5 pr-3">:</td>
        <td>{{ $order->date }}</td>
      </tr>
      <tr>
        <td>Name</td>
        <td class="pl-5 pr-3">:</td>
        <td>{{ $order->customer->name }}</td>
      </tr>
      <tr>
        <td>Phone</td>
        <td class="pl-5 pr-3">:</td>
        <td>{{ $order->customer->phone }}</td>
      </tr>
      <tr>
        <td>Address</td>
        <td class="pl-5 pr-3">:</td>
        <td>{{ $order->address }}</td>
      </tr>
    </table>
    </div>

    <!-- Pilih Item -->
    <div class="mb-7">
      <p class="text-xl font-bold mb-5">Order Item</p>
      <form action="{{ route('store-items') }}" method="post" >
        @csrf
        <div class="flex flex-wrap wrap gap-3 mb-3">
          <!-- Order Id -->
          <div class="hidden">
            <input name="order_id" id="order_id" type="text" placeholder="Type here" class="input input-bordered w-full max-w-xs " value="{{ $order->id }}" />
          </div>
          <!-- Item -->
          <div class="form-control w-full max-w-xs">
            <label class="label">
              <span class="label-text text-base">Item</span>
            </label>
            <select onchange="getItem(value)" name="item_id" id="item_id" class="select select-bordered text-base focus:outline-none @error('item_id') border-red-800 @enderror">
              <option disabled selected hidden value="{{ null }}">Pilih Item</option>
              @foreach ($items as $item)
                @if (old('item_id') == $item->id)
                  <option value="{{ $item->id }}" selected>{{ $item->name }}</option>
                @else
                  <option value="{{ $item->id }}">{{ $item->name }}</option>
                @endif
              @endforeach
            </select>
            @error('item_id')
              <p class="text-sm text-red-800">{{ $message }}</p>
            @enderror
          </div>
          <!-- Qty -->
          <div class="form-control w-full max-w-xs">
            <label class="label">
              <span class="label-text text-base">Qty</span>
            </label>
            <input name="qty" id="qty" type="number" placeholder="Qty" class="input input-bordered w-full max-w-xs focus:outline-none @error('qty') border-red-800 @enderror" onchange="setTotal()" value="{{ old('qty') }}" />
            @error('qty')
              <p class="text-sm text-red-800">{{ $message }}</p>
            @enderror
          </div>
          <!-- Price -->
          <div class="form-control w-full max-w-xs">
            <label class="label">
              <span class="label-text text-base">Price (Rp)</span>
            </label>
            <input name="price" id="price" type="number" placeholder="Price" class="input input-bordered w-full max-w-xs focus:outline-none @error('price') border-red-800 @enderror" onchange="setTotal()" value="{{ old('price') }}"/>
            @error('price')
              <p class="text-sm text-red-800">{{ $message }}</p>
            @enderror
          </div>
          <!-- Discount -->
          <div class="form-control w-full max-w-xs">
            <label class="label">
              <span class="label-text text-base">Discount (%)</span>
            </label>
            <input name="discount" id="discount" type="number" placeholder="Discount" class="input input-bordered w-full max-w-xs focus:outline-none @error('discount') border-red-800 @enderror" onchange="setTotal()" value="{{ old('discount') }}" />
            @error('discount')
              <p class="text-sm text-red-800">{{ $message }}</p>
            @enderror
          </div>
          <!-- Total -->
          <div class="form-control w-full max-w-xs">
            <label class="label">
              <span class="label-text text-base">Total (Rp)</span>
            </label>
            <input name="total" id="total" type="number" placeholder="Total" class="input input-bordered w-full max-w-xs focus:outline-none @error('total') border-red-800 @enderror" value="{{ old('total') }}" />
            @error('total')
              <p class="text-sm text-red-800">{{ $message }}</p>
            @enderror
          </div>
          <!-- Note -->
          <div class="form-control w-full max-w-xs">
            <label class="label">
              <span class="label-text text-base">Note</span>
            </label>
            <input name="note" id="note" type="text" placeholder="Note" class="input input-bordered w-full max-w-xs focus:outline-none @error('note') border-red-800 @enderror" value="{{ old('note') }}" />
            @error('note')
              <p class="text-sm text-red-800">{{ $message }}</p>
            @enderror
          </div>
        </div>
        <div class="w-fit">
          <button type="submit" class="btn btn-main">Tambah Item</button>
        </div>
      </form>
    </div>

    <!-- Item yang di pesan -->
    <div class="overflow-x-auto">
      <table class="table w-full">
        <thead>
          <tr>
            <th class="text-base">Item</th>
            <th class="text-base">Qty</th>
            <th class="text-base">Price</th>
            <th class="text-base">Discount</th>
            <th class="text-base">Note</th>
            <th class="text-base">Total</th>
          </tr>
        </thead>
        <tbody>
          @forelse ($order_items as $order_item)
            <tr>
              <td>{{ $order_item->item->name }}</td>
              <td>{{ $order_item->qty }}</td>
              <td>Rp{{ number_format($order_item->price, '2', ',', '.') }}</td>
              <td>{{ $order_item->discount }}%</td>
              @if ($order_item->note)
                <td>{{ $order_item->note }}</td>
              @else
                <td>-</td>
              @endif
              <td>Rp{{ number_format($order_item->total, '2', ',', '.') }}</td>
            </tr>
          @empty
            <tr>
              <td colspan="6" class="text-base text-center">Belum ada item yang di pesan. Silahkan pesan item!</td>
            </tr>
          @endforelse
          <tr>
            <td colspan="5" class="text-base font-bold">Subtotal</td>
            <td id="subtotal"></td>
          </tr>
          <form action="{{ route('transaction.update', $order->id) }}" method="post">
            @csrf
            @method('put')
            <tr>
              <td colspan="5" class="text-base font-bold">Masukkan Discount (%)</td>
              <td>
                <div class="w-24">
                  <!-- Order Subtotal -->
                  <input name="order_subtotal" id="order_subtotal" type="number" placeholder="Discount" class="input focus:outline-none" value="{{ old('order_subtotal') }}" hidden>
                  <!-- Order Discount -->
                  <input name="order_discount" id="order_discount" type="number" placeholder="Discount" class="input focus:outline-none" onchange="setOrderTotal()">
                   <!-- Order Total -->
                   <input name="order_total" id="order_total" type="number" placeholder="Total" class="input focus:outline-none" value="{{ old('order_total') }}" hidden>
                </div>
              </td>
            </tr>
            <tr id="trTotal" class="font-bold">
              <td colspan="5" class="text-base">TOTAL</td>
              <td id="order-total"></td>
            </tr>
            <tr>
              <td colspan="5"></td>
              <td>
                <div class="w-fit">
                  <button type="submit" class="btn btn-main px-8">Submit</button>
                </div>
              </td>
            </tr>
          </form>
        </tbody>
      </table>
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

    // Subtotal
    const orderItems = {{ Js::from($order_items) }}
    let subtotal = 0
    orderItems.forEach(item => {
      subtotal = subtotal + item.total
    });
    order_subtotal.value = subtotal

    // Subtotal Node
    const subtotalFormat = new Intl.NumberFormat('en-DE').format(subtotal)
    const subtotalFix = 'Rp' + subtotalFormat + ',00'
    const subtotalNode = document.createTextNode(subtotalFix)
    document.getElementById('subtotal').appendChild(subtotalNode)

    // Order Total
    order_total.value = subtotal

    order_total.value = order_total.value - (order_total.value*order_discount.value/100)
    const orderTotalFormat = new Intl.NumberFormat('en-DE').format(order_total.value)
    const orderTotalFix = 'Rp' + orderTotalFormat + ',00'
    const orderTotalNode = document.createTextNode(orderTotalFix)
    document.getElementById('order-total').appendChild(orderTotalNode)

    // Order discount change
    const setOrderTotal = () => {
      order_total.value = subtotal

      document.getElementById('order-total').remove()
      const tdEl = document.createElement('td')
      tdEl.setAttribute('id', "order-total")
      document.getElementById('trTotal').appendChild(tdEl)

      order_total.value = order_total.value - (order_total.value*order_discount.value/100)
      const orderTotalFormat = new Intl.NumberFormat('en-DE').format(order_total.value)
      const orderTotalFix = 'Rp' + orderTotalFormat + ',00'
      const orderTotalNode = document.createTextNode(orderTotalFix)
      document.getElementById('order-total').appendChild(orderTotalNode)
    }


    </script>
@endsection
