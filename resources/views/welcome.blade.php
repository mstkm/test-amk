<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  @vite(['resources/js/app.js', 'resources/css/app.css'])
  <title>AMK</title>
</head>
<body>
  <div class="flex flex-col gap-5 justify-center items-center h-screen font-primary">
    <h1 class="text-3xl font-bold">
      Selamat Datang di AMK!
    </h1>
    <div class="flex gap-3 items-center">
      <a href="{{ route('login') }}" class="btn btn-main">Login</a>
    </div>
  </div>
</body>
</html>
