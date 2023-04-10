@extends('layouts.main')

@section('title', 'AMK | Dashboard')

@section('content')
  <div class="p-5 w-full">
    <h1 class="text-3xl font-bold mb-12">Data Item</h1>

    <div class="w-full">
      <table>
        <tbody>
          <tr>
            <td>Name</td>
            <td><div class="px-5 py-3">:</div></td>
            <td>{{ $item->name }}</td>
          </tr>
          <tr>
            <td>Price</td>
            <td><div class="px-5 py-3">:</div></td>
            <td>{{ $item->price }}</td>
          </tr>
          <tr>
            <td class="align-top"><div class="py-3">Description</div></td>
            <td class="align-top"><div class="px-5 py-3">:</div></td>
            <td><div class="py-3">{{ $item->description }}</div></td>
          </tr>
        </tbody>
      </table>
    </div>
    <div class="mt-5 flex gap-3">
      <div class="w-fit">
        <a href="{{ route('item.index') }}" class="btn border-0">Kembali</a>
      </div>

      <!-- kondisi admin atau bukan -->
      @if ($user->role == 'Admin')
      <div class="w-fit">
        <a href="{{ route('item.edit', $item->id) }}" class="btn btn-warning"><x-feathericon-edit /></a>
      </div>
      <div>
        <div>
          <!-- The button to open modal -->
          <a href="#my-modal-2" class="btn btn-error"><x-feathericon-trash-2 /></a>
          <!-- Put this part before </body> tag -->
          <div class="modal" id="my-modal-2">
            <div class="modal-box w-fit">
              <h3 class="font-bold text-lg mb-5 text-center">Apakah anda yakin?</h3>
              <div class="flex gap-5">
                <div class="w-fit">
                  <a href="#" class="btn border-0">Kembali</a>
                </div>
                <div>
                  <form action="{{ route('item.destroy', $item->id) }}" method="post">
                    @csrf
                    @method('delete')
                    <button class="btn btn-error">Hapus</button>
                  </form>
                </div>
              </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      @endif
    </div>
@endsection
