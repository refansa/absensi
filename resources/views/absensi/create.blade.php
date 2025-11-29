@extends('layouts.main')
@section('body')
  <main class="mx-4 my-8">
    <nav>
      <h1 class="text-4xl font-medium">Tambah Data Absen</h1>
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
          href="{{ route('absensi.index') }}">Kembali</a>
      </div>
    </section>
    <section>
      <form class="py-4 px-64 border-2 border-black flex flex-col gap-5" action="{{ route('absensi.store') }}"
        method="POST">
        @csrf
        <h1 class="text-center font-bold text-xl mb-4">Tambah</h1>
        <label class="text-sm font-medium w-64" for="siswa">Siswa</label>
        <select class="border-2 border-black outline-none p-1 bg-white h-9" name="id_siswa" id="siswa" required>
          @foreach ($siswa as $s)
            <option value="{{ $s->id_siswa }}">{{ $s->nama }}</option>
          @endforeach
        </select>
        <label class="text-sm font-medium w-64" for="keterangan">Keterangan</label>
        <select class="border-2 border-black outline-none p-1 bg-white h-9" name="keterangan" id="keterangan" required>
          @foreach (['Masuk', 'Izin', 'Sakit', 'Alfa'] as $value)
            <option value="{{ $value }}">{{ $value }}</option>
          @endforeach
        </select>
        <label class="text-sm font-medium w-64" for="tanggal">Tanggal</label>
        <input class="border-2 border-black outline-none p-1" type="datetime-local" name="tanggal" id="tanggal"
          required>
        <button
          class="border-2 border-black px-4 font-medium self-center mt-2 border-r-4 border-b-4 hover:scale-105 transition-all"
          type="submit">Tambah</button>
      </form>
    </section>
  </main>
@endsection
