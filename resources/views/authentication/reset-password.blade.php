@extends('layouts.auth')

@section('title', 'AMK | Lupa Password')

@section('content')
  <div class="font-primary flex flex-col items-center justify-center h-screen">
    <h1 class="text-5xl mb-5">AMK</h1>
    <form action="" method="" class="w-1/4 mb-5 flex flex-col justify-center items-center">
      @csrf
      <div class="form-control w-full mb-3">
        <label class="label">
          <span class="label-text text-base">New Password</span>
        </label>
        <input name="password" id="password" type="password" placeholder="Type your password" class="input input-bordered w-full focus:outline-none" />
      </div>
      <div class="form-control w-full mb-3">
        <label class="label">
          <span class="label-text text-base">New Password Confirmation</span>
        </label>
        <input name="password_confirmation" id="password_confirmation" type="password" placeholder="Type your password confirmation" class="input input-bordered w-full focus:outline-none" />
      </div>
      <div class="w-1/2">
        <button class="btn btn-main mt-3">Reset Password</button>
      </div>
    </form>
  </div>
@endsection
