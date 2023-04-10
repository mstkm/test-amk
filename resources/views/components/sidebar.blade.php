<div class="bg-blue-500 flex flex-col h-screen">
  <div class="p-5">
    <h1 class="text-3xl text-white font-bold">AMK</h1>
  </div>
  <nav class="flex-1 py-5">
    <ul class="flex flex-col flex-1">
      <li>
        <a href="{{ route('dashboard') }}" class="w-60 flex items-center gap-5 px-5 py-3 text-base hover:font-bold hover:bg-white hover:text-blue-800 {{ Request::is('dashboard*') ? ' text-blue-800 bg-white font-bold ' : ' text-white ' }}"><span class="block w-5 h-5"><x-feathericon-grid class="w-full pb-1"/></span> Dashboard</a>
      </li>
      <li>
        <a href="{{ route('customer.index') }}" class="w-60 flex items-center gap-5 px-5 py-3 text-base hover:font-bold hover:bg-white hover:text-blue-800 {{ Request::is('customer*') ? ' text-blue-800 bg-white font-bold ' : ' text-white ' }}"><span class="block w-5 h-5"><x-feathericon-users class="w-full pb-1" /></span> Customers</a>
      </li>
      <li>
        <a href="{{ route('item.index') }}" class="w-60 flex items-center gap-5 px-5 py-3 text-base hover:font-bold hover:bg-white hover:text-blue-800 {{ Request::is('item*') ? ' text-blue-800 bg-white font-bold ' : ' text-white ' }}"><span class="block w-5 h-5"><x-feathericon-archive class="w-full pb-1" /></span> Items</a>
      </li>
      <li>
        <a href="{{ route('transaction.index') }}" class="w-60 flex items-center gap-5 px-5 py-3 text-base hover:font-bold hover:bg-white hover:text-blue-800 {{ Request::is('transaction*') ? ' text-blue-800 bg-white font-bold ' : ' text-white ' }}"><span class="block w-5 h-5"><x-feathericon-shopping-cart class="w-full pb-1" /></span> Transaction</a>
      </li>

      @if ($user->role == 'Admin')
        <li>
          <a href="{{ route('staff.index') }}" class="w-60 flex items-center gap-5 px-5 py-3 text-base hover:font-bold hover:bg-white hover:text-blue-800 {{ Request::is('staff*') ? ' text-blue-800 bg-white font-bold ' : ' text-white ' }}"><span class="block w-5 h-5"><x-feathericon-user class="w-full pb-1" /></span> Staff</a>
        </li>
      @endif
    </ul>
  </nav>
  <div class="p-5 mb-5">
    <div class="dropdown dropdown-top">
      <div class="flex items-center gap-5">
        <div>
          <label tabindex="0" class="btn btn-profile m-1 p-3 h-14 rounded-full hover:text-blue-800 active:text-white"><x-feathericon-user class="h-6 w-6" /></label>
        </div>
        <div>
          <p class="text-base text-white font-bold">{{ $user->name }}</p>
          <p class="text-base text-white">{{ $user->role }}</p>
        </div>
      </div>
      <form action="/logout" method="post">
        @csrf
        <ul tabindex="0" class="dropdown-content menu p-2 shadow bg-base-100 rounded-box w-52">
          <button type="submit" class="btn btn-ghost text-base">Logout</button>
        </ul>
      </form>
    </div>
  </div>
</div>
