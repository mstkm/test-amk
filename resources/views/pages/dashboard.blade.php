@extends('layouts.main')

@section('title', 'AMK | Dashboard')

@section('content')
  <div class="pt-5 pb-10 px-5 h-screen overflow-auto w-full">
    <h1 class="text-3xl font-bold mb-10">Dasboard</h1>
    <div class="flex gap-8 flex-wrap mb-10">
      <div class="p-5 bg-green-500 rounded h-52 w-52 flex flex-col">
        <p class="text-white text-base flex-1">Jumlah Customer</p>
        <div class="flex flex-2 items-center text-base text-white">
          <div class="flex-1">
            <x-feathericon-users />
          </div>
          <div>
            <p>{{ $customers->count() }}</p>
          </div>
        </div>
      </div>
      <div class="p-5 bg-red-500 rounded h-52 w-52 flex flex-col">
        <p class="text-white text-base flex-1">Jumlah Item</p>
        <div class="flex flex-2 items-center text-base text-white">
          <div class="flex-1">
            <x-feathericon-archive />
          </div>
          <div>
            <p>{{ $items->count() }}</p>
          </div>
        </div>
      </div>
      <div class="p-5 bg-purple-500 rounded h-52 w-52 flex flex-col">
        <p class="text-white text-base flex-1">Jumlah Transaksi</p>
        <div class="flex flex-2 items-center text-base text-white">
          <div class="flex-1">
            <x-feathericon-shopping-cart />
          </div>
          <div>
            <p>{{ $orders->count() }}</p>
          </div>
        </div>
      </div>
      @if ($user->role == 'Admin')
        <div class="p-5 bg-blue-500 rounded h-52 w-52 flex flex-col">
          <p class="text-white text-base flex-1">Jumlah Staff</p>
          <div class="flex flex-2 items-center text-base text-white">
            <div class="flex-1">
              <x-feathericon-user />
            </div>
            <div>
              <p>{{ $staff->count() }}</p>
            </div>
          </div>
        </div>
      @endif
    </div>
    <div class="w-3/4"><canvas id="chart"></canvas></div>
  </div>

  <script>
    const orders = {{ Js::from($orders) }}

    let totalJanuari = 0
    let totalFebruari = 0
    let totalMaret = 0
    let totalApril = 0
    let totalMei = 0
    let totalJuni = 0
    let totalJuli = 0
    let totalAgustus = 0
    let totalSeptember = 0
    let totalOktober = 0
    let totalNovember = 0
    let totalDesember = 0

    orders.forEach((order) => {
      if (order.date.split('-')[0]+order.date.split('-')[1] == '202301') {
        totalJanuari = totalJanuari + order.total
      }
      if (order.date.split('-')[0]+order.date.split('-')[1] == '202302') {
        totalFebruari = totalFebruari + order.total
      }
      if (order.date.split('-')[0]+order.date.split('-')[1] == '202303') {
        totalMaret = totalMaret + order.total
      }
      if (order.date.split('-')[0]+order.date.split('-')[1] == '202304') {
        totalApril = totalApril + order.total
      }
      if (order.date.split('-')[0]+order.date.split('-')[1] == '202305') {
        totalMei = totalMei + order.total
      }
      if (order.date.split('-')[0]+order.date.split('-')[1] == '202306') {
        totalJuni = totalJuni + order.total
      }
      if (order.date.split('-')[0]+order.date.split('-')[1] == '202307') {
        totalJuli = totalJuli + order.total
      }
      if (order.date.split('-')[0]+order.date.split('-')[1] == '202308') {
        totalAgustus = totalAgustus + order.total
      }
      if (order.date.split('-')[0]+order.date.split('-')[1] == '202309') {
        totalSeptember = totalSeptember + order.total
      }
      if (order.date.split('-')[0]+order.date.split('-')[1] == '202310') {
        totalOktober = totalOktober + order.total
      }
      if (order.date.split('-')[0]+order.date.split('-')[1] == '202311') {
        totalNovember = totalNovember + order.total
      }
      if (order.date.split('-')[0]+order.date.split('-')[1] == '202312') {
        totalDesember = totalDesember + order.total
      }
    });
    console.log(totalApril)
  </script>
@endsection
