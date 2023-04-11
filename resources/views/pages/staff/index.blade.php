@extends('layouts.main')

@section('title', 'AMK | Dashboard')

@section('content')
  <div class="p-5 w-full h-screen overflow-auto relative">
    <h1 class="text-3xl font-bold mb-12">Staff</h1>

   <div>
    <div class="overflow-x-auto">
      <table class="table w-full">
        <thead>
          <tr>
            <th class="text-base">ID</th>
            <th class="text-base">Name</th>
            <th class="text-base">Email</th>
            <th class="text-base">Verifikasi</th>
          </tr>
        </thead>
        <tbody>
          @forelse ($staff as $s)
            <tr>
            <td class="text-base">{{ $s->id }}</td>
            <td class="text-base">{{ $s->name }}</td>
            <td class="text-base">{{ $s->email }}</td>
            <td>
              @if ($s->verified)
                <div class="w-12">
                  <div class="btn btn-circle btn-success text-white"><x-feathericon-check-circle /></div>
                </div>
              @else
              <div class="w-12">
                <!-- The button to open modal -->
                <label for="my-modal">
                  <div class="btn btn-circle btn-error text-white">
                    <x-feathericon-alert-circle />
                  </div>
                </label>

                <!-- Put this part before </body> tag -->
                <input type="checkbox" id="my-modal" class="modal-toggle" />
                <div class="modal">
                  <div class="modal-box">
                    <div class="bg-white rounded p-5 flex flex-col gap-5 items-center justify-center">
                      <p class="text-lg font-bold">Verifikasi Staff Ini?</p>
                      <div class="flex gap-5">
                        <div>
                          <label for="my-modal" class="btn btn-error">Kembali!</label>
                        </div>
                        <div>
                          <form action="{{ route('staff.update', $s->id) }}" method="post">
                            @csrf
                            @method('put')
                            <button class="btn btn-main">Verifikasi</button>
                          </form>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              @endif
            </td>
          @empty
              <td class="text-base text-center" colspan="4">No Data</td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>

  <script>
    const showModal = () => {
      document.getElementById('modal-verified').style.display = 'flex'
    }
  </script>

@endsection
