@extends('layouts.main')
@section('body')
  <main class="mx-4 my-8">
    <nav>
      <h1 class="text-4xl font-medium">Tambah Data Siswa</h1>
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
          href="{{ route('siswa.index') }}">Kembali</a>
      </div>
    </section>
    <section>
      <form class="py-4 px-64 border-2 border-black flex flex-col gap-5"
        action="{{ route('siswa.update', $siswa->id_siswa) }}" method="POST">
        @csrf
        @method('PUT')
        <h1 class="text-center font-bold text-xl mb-4">Edit</h1>
        <label class="text-sm font-medium w-64" for="nama">Nama</label>
        <input class="border-2 border-black outline-none p-1" type="text" name="nama" id="nama"
          value="{{ $siswa->nama }}" maxlength="255" required>
        <label class="text-sm font-medium w-64" for="email">Email</label>
        <input class="border-2 border-black outline-none p-1" type="email" name="email" id="email"
          value="{{ $siswa->email }}" maxlength="255" required>
        <label class="text-sm font-medium w-64" for="alamat">Alamat</label>
        <input class="border-2 border-black outline-none p-1" type="text" name="alamat" id="alamat"
          value="{{ $siswa->alamat }}" maxlength="255" required>
        <label class="text-sm font-medium w-64" for="notelp">No. Telp</label>
        <input class="border-2 border-black outline-none p-1" type="text" name="notelp" id="notelp"
          value="{{ $siswa->notelp }}" maxlength="255" required>
        <button
          class="border-2 border-black px-4 font-medium self-center mt-2 border-r-4 border-b-4 hover:scale-105 transition-all"
          type="submit">Edit</button>
      </form>
    </section>
  </main>
@endsection
