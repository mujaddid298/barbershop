@extends('layouts.admin')

@section('title', 'Tambah Layanan — Men\'s Hair Studio')

@section('content')

    <div class="flex-1 bg-[#161616] min-h-screen  px-8 py-7 rounded-2xl">

        <div class="flex items-center justify-between mb-7">
            <div>
                <p class="text-[9px] tracking-[3px] uppercase text-white    ">Manajemen / Layanan</p>
                <h1 class="text-xl font-medium text-[#eee] mt-1">Tambah Layanan</h1>
            </div>
            <a href="{{ route('admin.layanan') }}"
                class="flex items-center gap-2 px-4 py-2 rounded-md border border-[#2E2E2E] text-[11px] text-white hover:text-[#999] hover:border-[#3a3a3a] transition-colors duration-150">
                <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <polyline points="15 18 9 12 15 6"/>
                </svg>
                Kembali
            </a>
        </div>

        <div class="max-w-xl">
            @if ($errors->any())
                <div class="mb-5 px-4 py-3 rounded-md text-[11px] text-[#e06060] border border-[rgba(220,60,60,0.25)] bg-[rgba(220,60,60,0.06)]">
                    <ul class="space-y-1">
                        @foreach ($errors->all() as $error)
                            <li>• {{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('admin.layanan.store') }}" class="space-y-5">
                @csrf

                <div>
                    <label class="block text-[10px] tracking-[2px] uppercase text-gray-400 font-semibold mb-2">Nama Layanan</label>
                    <input type="text" name="nama" value="{{ old('nama') }}"
                        placeholder="contoh: Haircut & Styling"
                        class="w-full bg-[#1e1e1e] border border-[#2E2E2E] rounded-xl px-4 py-3 text-[12px] text-white placeholder-[#555] focus:outline-none focus:border-[#C9A84C]/80 focus:ring-1 focus:ring-[#C9A84C]/30 transition-all duration-150 @error('nama') border-red-500/50 @enderror" />
                </div>

                <div>
                    <label class="block text-[10px] tracking-[2px] uppercase text-gray-400 font-semibold mb-2">Deskripsi <span class="normal-case tracking-normal text-gray-600">(opsional)</span></label>
                    <textarea name="deskripsi" rows="4"
                        placeholder="Deskripsi singkat layanan..."
                        class="w-full bg-[#1e1e1e] border border-[#2E2E2E] rounded-xl px-4 py-3 text-[12px] text-[#ccc] placeholder-[#555] focus:outline-none focus:border-[#C9A84C]/80 focus:ring-1 focus:ring-[#C9A84C]/30 transition-all duration-150 resize-none h-28">{{ old('deskripsi') }}</textarea>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-[10px] tracking-[2px] uppercase text-gray-400 font-semibold mb-2">Harga (Rp)</label>
                        <input type="number" name="harga" value="{{ old('harga') }}" min="0"
                            placeholder="50000"
                            class="w-full bg-[#1e1e1e] border border-[#2E2E2E] rounded-xl px-4 py-3 text-[12px] text-[#ccc] placeholder-[#555] focus:outline-none focus:border-[#C9A84C]/80 focus:ring-1 focus:ring-[#C9A84C]/30 transition-all duration-150 @error('harga') border-red-500/50 @enderror" />
                    </div>
                    <div>
                        <label class="block text-[10px] tracking-[2px] uppercase text-gray-400 font-semibold mb-2">Durasi (Menit)</label>
                        <input type="number" name="durasi" value="{{ old('durasi') }}" min="1"
                            placeholder="30"
                            class="w-full bg-[#1e1e1e] border border-[#2E2E2E] rounded-xl px-4 py-3 text-[12px] text-[#ccc] placeholder-[#555] focus:outline-none focus:border-[#C9A84C]/80 focus:ring-1 focus:ring-[#C9A84C]/30 transition-all duration-150 @error('durasi') border-red-500/50 @enderror" />
                    </div>
                </div>

                <div class="flex items-center gap-3 pt-4">
                    <button type="submit"
                        class="flex items-center gap-2 px-6 py-3 rounded-xl border transition-all duration-150 cursor-pointer hover:scale-[1.02] bg-[#C9A84C]/10 border-[#C9A84C]/30 hover:bg-[#C9A84C]/20">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#C9A84C" stroke-width="2">
                            <line x1="12" y1="5" x2="12" y2="19" />
                            <line x1="5" y1="12" x2="19" y2="12" />
                        </svg>
                        <span class="text-[12px] font-semibold text-[#C9A84C]">
                            Simpan Layanan
                        </span>
                    </button>
                    <a href="{{ route('admin.layanan') }}"
                        class="px-6 py-3 rounded-xl border border-[#2E2E2E] text-[12px] text-gray-400 hover:text-white hover:bg-white/[0.02] transition-all duration-150 text-center font-medium">
                        Batal
                    </a>
                </div>
            </form>
        </div>

    </div>

@endsection