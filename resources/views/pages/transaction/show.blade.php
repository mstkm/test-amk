@extends('layouts.main')

@section('title', 'AMK | Dashboard')

@section('content')
  <div class="p-5 w-full h-screen overflow-auto relative">
    <div>
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
        <div class="mt-5 flex gap-3">
          <div class="w-fit">
            <a href="{{ route('transaction.index') }}" class="btn border-0">Kembali</a>
          </div>

          <!-- kondisi admin atau bukan -->
          @if ($user->role == 'Admin')
            <div class="w-fit">
              <a href="{{ route('transaction.edit', $order->id) }}" class="btn btn-warning"><x-feathericon-edit /></a>
            </div>
            <div>
              <div>
                <!-- The button to open modal -->
                <a href="#my-modal-2" class="btn btn-error"><x-feathericon-trash-2 /></a>
                <!-- Put this part before </body> tag -->
                <div class="modal" id="my-modal-2">
                  <div class="modal-box w-fit">
                    <h3 class="font-bold text-lg mb-5 text-center">Apakah anda yakin?</h3>
                    <div class="flex gap-5">
                      <div class="w-fit">
                        <a href="#" class="btn border-0">Kembali</a>
                      </div>
                      <div>
                        <form action="{{ route('transaction.destroy', $order->id) }}" method="post">
                          @csrf
                          @method('delete')
                          <button class="btn btn-error">Hapus</button>
                        </form>
                      </div>
                    </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          @endif
        </div>
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
              @if ($user->role == 'Admin')
                <th class="text-base">Edit</th>
              @endif
            </tr>
          </thead>
          <tbody>
            @forelse ($order_items as $order_item)
              <tr>
                <td>{{ $order_item->item->name }}</td>
                <td>{{ $order_item->qty }}</td>
                <td>Rp{{ number_format($order_item->price, '2', ',', '.') }}</td>
                @if ( $order_item->discount)
                  <td>{{ $order_item->discount }}%</td>
                @else
                  <td>-</td>
                @endif
                @if ( $order_item->note)
                  <td>{{ $order_item->note }}</td>
                @else
                  <td>-</td>
                @endif
                <td>Rp{{ number_format($order_item->total, '2', ',', '.') }}</td>
                @if ($user->role == 'Admin')
                  <td>
                    <div class="w-fit">
                      <a href="{{ route('show-edit-order-item', $order_item->id) }}" class="btn btn-warning"><x-feathericon-edit /></a>
                    </div>
                  </td>
                @endif
              </tr>
            @empty
              <tr>
                <td colspan="6" class="text-base text-center">No Data.</td>
              </tr>
            @endforelse
            <tr>
              <td colspan="5" class="text-base font-bold">Subtotal</td>
              <td>Rp{{ number_format($order->subtotal, '2', ',', '.') }}</td>
            </tr>
            <tr>
              <td colspan="5" class="text-base font-bold">Order Discount</td>
              @if ($order->discount)
                <td>{{ $order->discount }}%</td>
              @else
                <td>-</td>
              @endif
            </tr>
            <tr class="font-bold">
              <td colspan="5" class="text-base">Total</td>
              <td>Rp{{ number_format($order->total, '2', ',', '.') }}</td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>

@endsection
