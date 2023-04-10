<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  @vite(['resources/js/app.js', 'resources/css/app.css'])
  <title>@yield('title')</title>
</head>
<body>
  <div class="flex lg:hidden p-5 bg-blue-600 text-white">
    <div class="flex-1 text-xl font-bold">AMK</div>
    <div id="menu"><x-feathericon-menu /></div>
    <div id="x" class="hidden"><x-feathericon-x /></div>
  </div>
  <div class="flex gap-5 relative">
    <div id="sidebar" class="hidden absolute lg:relative lg:block z-10">
      @include('components.sidebar')
    </div>
    @yield('content')
  </div>
  <script>
    document.getElementById('menu').addEventListener('click', () => {
      document.getElementById('x').classList.add('block')
      document.getElementById('x').classList.remove('hidden')
      document.getElementById('sidebar').classList.remove('hidden')
      document.getElementById('menu').classList.add('hidden')
    })
    document.getElementById('x').addEventListener('click', () => {
      document.getElementById('x').classList.add('hidden')
      document.getElementById('x').classList.remove('block')
      document.getElementById('sidebar').classList.add('hidden')
      document.getElementById('menu').classList.remove('hidden')
    })
  </script>
</body>
</html>
