@extends('layouts.main')

@section('title', 'AMK | Dashboard')

@section('content')
  <div class="p-5 w-full">
    <h1 class="text-3xl font-bold mb-12">Tambah Customers</h1>

    <form action="{{ route('customer.store') }}" method="post">
      @csrf
      <div class="form-control w-full max-w-lg mb-3">
        <label class="label">
          <span class="label-text text-base">Name</span>
        </label>
        <input name="name" id="name" type="text" placeholder="Type name" class="input input-bordered w-full max-w-lg focus:outline-none text-base @error('name') border border-red-800 @enderror" value="{{ old('name') }}" />
        @error('name')
          <p class="text-sm text-red-800">{{ $message }}</p>
        @enderror
      </div>
      <div class="form-control mb-3">
        <label class="label">
          <span class="label-text text-base">Address</span>
        </label>
        <textarea name="address" id="address" class="textarea textarea-bordered h-24 w-full max-w-lg focus:outline-none text-base @error('name') border border-red-800 @enderror" placeholder="Type address">{{ old('address') }}</textarea>
        @error('address')
          <p class="text-sm text-red-800">{{ $message }}</p>
        @enderror
      </div>
      <div class="form-control w-full max-w-lg mb-3">
        <label class="label">
          <span class="label-text text-base">Phone</span>
        </label>
        <input name="phone" id="phone" type="number" placeholder="Type phone" class="input input-bordered w-full max-w-lg focus:outline-none text-base @error('name') border border-red-800 @enderror" value="{{ old('phone') }}" />
        @error('phone')
          <p class="text-sm text-red-800">{{ $message }}</p>
        @enderror
      </div>
      <div class="flex gap-3">
        <div class="w-fit mt-5">
          <a href="{{ route('customer.index') }}" class="btn border-0">Kembali</a>
        </div>
        <div class="w-fit mt-5">
          <button type="submit" class="btn btn-main">Submit</button>
        </div>
      </div>
    </form>
@endsection
