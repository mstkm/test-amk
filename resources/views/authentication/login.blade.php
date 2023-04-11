@extends('layouts.auth')

@section('title', 'AMK | Login')

@section('content')
  <div class="font-primary flex flex-col items-center justify-center h-screen">
    <h1 class="text-5xl mb-5">AMK</h1>
    <form action="{{ route('login-action') }}" method="post" class="w-3/4 md:w-2/4 lg:w-1/4 mb-5 flex flex-col justify-center items-center">
      @csrf
      @if (session('success'))
        <div class="alert alert-success shadow-lg my-3">
          <div>
            <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current flex-shrink-0 h-6 w-6" fill="none" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
            <span>{{ session('success') }}</span>
          </div>
        </div>
      @endif
      @if (session('loginError'))
        <div class="alert alert-error shadow-lg my-3">
          <div>
            <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current flex-shrink-0 h-6 w-6" fill="none" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
            <span>{{ session('loginError') }}</span>
          </div>
        </div>
      @endif
      <div class="form-control w-full mb-3">
        <label class="label">
          <span class="label-text text-base">Email</span>
        </label>
        <input name="email" id="email" type="email" placeholder="Type your email" class="input input-bordered w-full focus:outline-none @error('email') border-red-800 @enderror" />
        @error('email')
          <p class="text-sm text-red-800">{{ $message }}</p>
        @enderror
      </div>
      <div class="form-control w-full mb-3">
        <label class="label">
          <span class="label-text text-base">Password</span>
        </label>
        <input name="password" id="password" type="password" placeholder="Type your password" class="input input-bordered w-full focus:outline-none @error('email') border-red-800 @enderror" />
        @error('email')
          <p class="text-sm text-red-800">{{ $message }}</p>
        @enderror
        <a href="{{ route('forgot-password') }}" class="text-end text-blue-800">Lupa password?</a>
      </div>
      <div class="w-1/2">
        <button class="btn btn-main mt-3">Login</button>
      </div>
    </form>
    <div>
      <span class="text-base">Belum memiliki akun? </span><a href="{{ route('registration') }}" class="text-base text-end text-blue-800"><span>Registrasi</span></a>
    </div>
  </div>
@endsection
