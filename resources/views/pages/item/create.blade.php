@extends('layouts.main')

@section('title', 'AMK | Dashboard')

@section('content')
  <div class="p-5 w-full">
    <h1 class="text-3xl font-bold mb-12">Tambah Item</h1>

    <form action="{{ route('item.store') }}" method="post">
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
          <span class="label-text text-base">Price</span>
        </label>
        <input name="price" id="price" type="number" class="input input-bordered w-full max-w-lg focus:outline-none text-base @error('price') border border-red-800 @enderror" placeholder="Type price" value="{{ old('price') }}" />
        @error('price')
          <p class="text-sm text-red-800">{{ $message }}</p>
        @enderror
      </div>
      <div class="form-control w-full max-w-lg mb-3">
        <label class="label">
          <span class="label-text text-base">Description</span>
        </label>
        <textarea name="description" id="description" type="number" placeholder="Type description" class="textarea textarea-bordered h-24 w-full max-w-lg focus:outline-none text-base @error('description') border border-red-800 @enderror">{{ old('description') }}</textarea>
        @error('description')
          <p class="text-sm text-red-800">{{ $message }}</p>
        @enderror
      </div>
      <div class="flex gap-3">
        <div class="w-fit mt-5">
          <a href="{{ route('item.index') }}" class="btn border-0">Kembali</a>
        </div>
        <div class="w-fit mt-5">
          <button type="submit" class="btn btn-main">Submit</button>
        </div>
      </div>
    </form>
@endsection
