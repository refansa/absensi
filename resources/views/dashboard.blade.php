@extends('layouts.main')
@section('body')
  <main class="mx-4 my-8">
    <nav>
      <h1 class="text-4xl font-medium">Absensi XII RPL</h1>
      <div class="my-4 flex gap-10">
        <a class="text-blue-700 underline" href="{{ route('dashboard') }}">Dashboard</a>
        <a class="text-blue-700 underline" href="{{ route('siswa.index') }}">Siswa</a>
        <a class="text-blue-700 underline" href="{{ route('absensi.index') }}">Absen</a>
      </div>
    </nav>
    <hr class="border-black border" />
    <section>
      <div class="flex justify-between my-4">
        <h2 class="text-2xl font-medium">Absensi Hari Ini</h2>
        <a class="px-4 border-2 border-black font-medium text-center border-r-4 border-b-4 hover:scale-105 transition-all"
          href="{{ route('absensi.create') }}">Absen</a>
      </div>
    </section>
    <section>
      <table class="border-2 border-black w-full">
        <tr class="bg-[#ccc]">
          <th class="border-black border-l-2">No</th>
          <th class="border-black border-l-2">Nama</th>
          <th class="border-black border-l-2">Keterangan</th>
          <th class="border-black border-l-2">Tanggal</th>
        </tr>
        @foreach ($absensi as $a)
          <tr class="odd:bg-white even:bg-[#eee] font-medium">
            <td class="border-black border-l-2 p-1">{{ $loop->iteration }}</td>
            <td class="border-black border-l-2 p-1">{{ $a->siswa->nama }}</td>
            <td class="border-black border-l-2 p-1">{{ $a->keterangan }}</td>
            <td class="border-black border-l-2 p-1">{{ $a->formatTanggal() }}</td>
          </tr>
        @endforeach
      </table>
    </section>
  </main>
@endsection
