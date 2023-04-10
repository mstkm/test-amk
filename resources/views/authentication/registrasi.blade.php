@extends('layouts.auth')

@section('title', 'AMK | Registrasi')

@section('content')
  <div class="font-primary flex flex-col items-center justify-center h-screen">
    <h1 class="text-5xl mb-5">AMK</h1>
    <form action="{{ route('registration-action') }}" method="post" class="w-1/4 mb-5 flex flex-col justify-center items-center">
      @csrf
      <div class="form-control w-full mb-3">
        <label class="label">
          <span class="label-text text-base">Nama</span>
        </label>
        <input name="name" id="name" type="text" placeholder="Type your name" class="input input-bordered w-full focus:outline-none @error('name') border-red-800 @enderror" value="{{ old('name') }}" />
        @error('name')
          <p class="text-xs text-red-800 pl-1">{{ $message }}</p>
        @enderror
      </div>
      <div class="form-control w-full mb-3">
        <label class="label">
          <span class="label-text text-base">Email</span>
        </label>
        <input name="email" id="email" type="email" placeholder="Type your email" class="input input-bordered w-full focus:outline-none @error('email') border-red-800 @enderror" value="{{ old('email') }}" />
        @error('email')
          <p class="text-xs text-red-800 pl-1">{{ $message }}</p>
        @enderror
      </div>
      <div class="form-control w-full mb-3">
        <label class="label">
          <span class="label-text text-base">Password</span>
        </label>
        <input name="password" id="password" type="password" placeholder="Type your password" class="input input-bordered w-full focus:outline-none @error('password') border-red-800 @enderror" />
        @error('password')
          <p class="text-xs text-red-800 pl-1">{{ $message }}</p>
        @enderror
      </div>
      <div class="form-control w-full mb-3">
        <label class="label">
          <span class="label-text text-base">Password Confirmation</span>
        </label>
        <input name="password_confirmation" id="password_confirmation" type="password" placeholder="Type your password confirmation" class="input input-bordered w-full focus:outline-none" />
      </div>
      <div class="w-1/2">
        <button class="btn btn-main mt-3">Daftar</button>
      </div>
    </form>
    <div>
      <span class="text-base">Sudah memiliki akun? </span><a href="{{ route('login') }}" class="text-base text-end text-blue-800"><span>Login</span></a>
    </div>
  </div>
@endsection
