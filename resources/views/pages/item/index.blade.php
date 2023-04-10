@extends('layouts.main')

@section('title', 'AMK | Dashboard')

@section('content')
  <div class="p-5 w-full h-screen overflow-auto">
    <h1 class="text-3xl font-bold mb-12">Items</h1>

   <div class="mb-5">
      @if (session('success'))
      <div class="alert alert-success shadow-lg w-fit pr-5" id="alert-success">
        <div>
          <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current flex-shrink-0 h-6 w-6" fill="none" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
          <span>{{ session('success') }}</span>
        </div>
      </div>
      @endif
      @if (session('delete'))
        <div class="alert alert-error shadow-lg w-fit pr-5" id="alert-delete">
          <div>
            <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current flex-shrink-0 h-6 w-6" fill="none" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
            <span>{{ session('delete') }}</span>
          </div>
        </div>
      @endif
   </div>

    <div class="flex gap-3 mb-5">
      <div class="md:flex-1">
        @if ($user->role == 'Admin')
          <div class="w-fit">
            <a href="{{ route('item.create') }}" for="my-modal-3" class="btn btn-main"><x-feathericon-plus class="lg:mr-3" /> <span class="hidden lg:block">Tambah Item</span></a>
          </div>
        @endif
      </div>
      <div class="w-60 md:w-fit">
        <form action="{{ route('search-item') }}" method="post">
          @csrf
          <div class="form-control relative">
            <input name="keyword" type="text" placeholder="Search…" class="input input-bordered focus:outline-none" />
              <div class="absolute right-0">
                <button type="submit" class="btn btn-main">
                  <x-feathericon-search />
                </button>
              </div>
          </div>
        </form>
      </div>
      <div class="w-fit">
        <a href="{{ route('item.index') }}" class="btn btn-main"><x-feathericon-refresh-cw class="h-6 w-6" /></a>
      </div>
    </div>
    <!-- Table -->
    <div class="overflow-x-auto">
      <table class="table w-full">
        <!-- head -->
        <thead>
          <tr>
            <th class="text-base">Name</th>
            <th class="text-base">Price</th>
            <th class="text-base">Description</th>
            <th class="text-base">Details</th>
          </tr>
        </thead>
        <tbody>
          <!-- row 1 -->
          @forelse ($items as $item )
            <tr>
              <td class="text-base align-top">{{ $item->name }}</td>
              <td class="text-base align-top">{{ $item->price }}</td>
              <td class="text-base whitespace-normal align-top">{{ $item->description }}</td>
              <td class="text-base align-top">
                <a href="{{ route('item.show', $item->id) }}" class="btn btn-outline btn-info"><x-feathericon-eye /></a>
              </td>
            </tr>
          @empty
            <tr>
              <td class="text-base text-center" colspan="4">No data.</td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>

  <script>
    const alertSuccess = document.getElementById('alert-success')
    const alertDelete = document.getElementById('alert-delete')

    if (alertSuccess) {
      setTimeout(() => {
        alertSuccess.style.display = 'none';
      }, 5000);
    }

    if (alertDelete) {
      setTimeout(() => {
        alertDelete.style.display = 'none';
      }, 5000);
    }
  </script>
@endsection
