@extends('layouts.auth')

@section('title', 'AMK | Lupa Password')

@section('content')
  <div class="font-primary flex flex-col items-center justify-center h-screen">
    <h1 class="text-5xl mb-5">AMK</h1>
    <form action="/forgot-password" method="post" class="w-3/4 md:w-2/4 lg:w-1/4 mb-5 flex flex-col justify-center items-center">
      @csrf
      <p class="px-1 mb-3">Lupa password? Kami akan mengirimkan link reset password melalui email.</p>
      <div class="form-control w-full mb-3">
        <label class="label">
          <span class="label-text text-base">Email</span>
        </label>
        <input name="email" id="email" type="email" placeholder="Type your email" class="input input-bordered w-full focus:outline-none @error('email') border-red-800 @enderror" />
        @error('email')
          <p class="text-xs text-red-800 pl-1">{{ $message }}</p>
        @enderror
      </div>
      <div class="w-1/2">
        <button class="btn btn-main mt-3">Send</button>
      </div>
      @if(session()->has('status'))
        <p class="text-green-800 mt-2 text-center">{{ session('status') }}</p>
      @endif
      @if(session()->has('email'))
        <p class="text-red-800 mt-2 text-center">{{ session('status') }}</p>
      @endif
    </form>
  </div>
@endsection
