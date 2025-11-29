@extends('layouts.main')
@section('body')
  <main class="mx-4 my-8">
    <nav>
      <h1 class="text-4xl font-medium">Data Siswa</h1>
      <div class="my-4 flex gap-10">
        <a class="text-blue-700 underline" href="{{ route('dashboard') }}">Dashboard</a>
        <a class="text-blue-700 underline" href="{{ route('siswa.index') }}">Siswa</a>
        <a class="text-blue-700 underline" href="{{ route('absensi.index') }}">Absen</a>
      </div>
    </nav>
    <hr class="border-black border" />
    <section>
      <div class="flex justify-between my-4">
        <a class="px-4 border-2 border-black font-medium text-center border-r-4 border-b-4 hover:scale-105 transition-all"
          href="{{ route('siswa.create') }}">Tambah Data</a>
      </div>
    </section>
    <section>
      <table class="border-2 border-black w-full">
        <tr class="bg-[#ccc]">
          <th class="border-black border-l-2">No</th>
          <th class="border-black border-l-2">Nama</th>
          <th class="border-black border-l-2">Email</th>
          <th class="border-black border-l-2">Alamat</th>
          <th class="border-black border-l-2">Opsi</th>
        </tr>
        @foreach ($siswa as $s)
          <tr class="odd:bg-white even:bg-[#eee] font-medium">
            <td class="border-black border-l-2 p-1">{{ $loop->iteration }}</td>
            <td class="border-black border-l-2 p-1">{{ $s->nama }}</td>
            <td class="border-black border-l-2 p-1">{{ $s->email }}</td>
            <td class="border-black border-l-2 p-1">{{ $s->alamat }}</td>
            <td class="border-black border-l-2 p-1">
              <div class="text-blue-600 underline">
                <a href="{{ route('siswa.edit', $s->id_siswa) }}">edit</a>
                <span class="no-underline text-black">|</span>
                <form class="inline" action="{{ route('siswa.destroy', $s->id_siswa) }}" method="POST"
                  onsubmit="return confirm('Hapus data?')">
                  @csrf
                  @method('DELETE')
                  <button class="underline" type="submit">delete</button>
                </form>
              </div>
            </td>
          </tr>
        @endforeach
      </table>
    </section>
  </main>
@endsection
