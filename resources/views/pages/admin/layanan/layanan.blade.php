@extends('layouts.admin')

@section('title', 'Layanan — Men\'s Hair Studio')

@section('content')

    <div class="flex-1 bg-[#161616] min-h-screen px-8 py-7 rounded-2xl">

        <div class="flex items-center justify-between mb-7">
            <div>
                <p class="text-[9px] tracking-[3px] uppercase text-white">Manajemen</p>
                <h1 class="text-xl font-medium text-[#eee] mt-1">Layanan</h1>
            </div>
        </div>

        {{-- Flash Message --}}
        @if (session('success'))
            <div
                class="mb-5 px-4 py-3 rounded-md text-[11px] text-[#4caf76] border border-[rgba(76,175,118,0.25)] bg-[rgba(76,175,118,0.07)]">
                {{ session('success') }}
            </div>
        @endif

        {{-- Stats --}}
        <div class="grid grid-cols-3 gap-3 mb-7 text-white">
            <div class="bg-[#222] border border-[#2E2E2E] rounded-lg px-4 py-3.5">
                <p class="text-[9px] tracking-[2px] uppercase mb-1.5">Total Layanan</p>
                <p class="text-[22px] font-medium"
                    style="background: linear-gradient(135deg,#C9A84C,#E2C97E); -webkit-background-clip:text; -webkit-text-fill-color:transparent; background-clip:text;">
                    {{ $layanans->count() }}
                </p>
            </div>
            <div class="bg-[#222] border border-[#2E2E2E] rounded-lg px-4 py-3.5">
                <p class="text-[9px] tracking-[2px] uppercase mb-1.5">Harga Terendah</p>
                <p class="text-[22px] font-medium text-[#7aaef5]">
                    Rp {{ $layanans->min('harga') ? number_format($layanans->min('harga'), 0, ',', '.') : '—' }}
                </p>
            </div>
            <div class="bg-[#222] border border-[#2E2E2E] rounded-lg px-4 py-3.5">
                <p class="text-[9px] tracking-[2px] uppercase mb-1.5">Harga Tertinggi</p>
                <p class="text-[22px] font-medium text-[#C9A84C]">
                    Rp {{ $layanans->max('harga') ? number_format($layanans->max('harga'), 0, ',', '.') : '—' }}
                </p>
            </div>
        </div>

        {{-- Search & Add --}}
        <form method="GET" action="{{ route('admin.layanan') }}" class="flex gap-3 mb-6">
            <input type="text" name="search" value="{{ request('search') }}"
                placeholder="Cari nama atau deskripsi layanan..."
                class="flex-1 bg-[#222] border border-[#2E2E2E] rounded-md px-4 py-2 text-[12px] text-[#ccc] placeholder-[#555] focus:outline-none focus:border-[rgba(201,168,76,0.4)] transition-colors duration-150" />
            <button type="submit"
                class="px-4 py-2 rounded-md bg-[#222] border border-[#2E2E2E] text-[11px] text-white hover:border-[rgba(201,168,76,0.35)] hover:text-[#C9A84C] transition-colors duration-150 cursor-pointer">
                Cari
            </button>
            @if (request('search'))
                <a href="{{ route('admin.layanan') }}"
                    class="px-4 py-2 rounded-md bg-[#222] border border-[#2E2E2E] text-[11px] text-[#666] hover:text-[#999] transition-colors duration-150">
                    Reset
                </a>
            @endif

            <a href="{{ route('admin.layanan.create') }}"
                class="flex items-center gap-2 px-4 py-2 rounded-md border transition-colors duration-150"
                style="background: rgba(201,168,76,0.08); border-color: rgba(201,168,76,0.25);">
                <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="#C9A84C" stroke-width="2">
                    <line x1="12" y1="5" x2="12" y2="19" />
                    <line x1="5" y1="12" x2="19" y2="12" />
                </svg>
                <span class="text-[12px] font-medium"
                    style="background: linear-gradient(135deg,#C9A84C,#E2C97E,#C9A84C);
                           -webkit-background-clip:text; -webkit-text-fill-color:transparent; background-clip:text;">
                    Tambah Layanan
                </span>
            </a>
        </form>

        {{-- Table --}}
        <div class="flex items-center gap-3 mb-3">
            <p class="text-[9px] tracking-[3px] uppercase text-white">Daftar Layanan</p>
            <div class="flex-1 border-t border-[#2E2E2E]"></div>
        </div>

        @if ($layanans->isNotEmpty())
            <table class="w-full border-collapse">
                <thead>
                    <tr>
                        <th
                            class="text-[9px] tracking-[2px] uppercase font-normal text-left px-3 pb-2.5 border-b border-[#2E2E2E] text-white">
                            Layanan</th>
                        <th
                            class="text-[9px] tracking-[2px] uppercase font-normal text-left px-3 pb-2.5 border-b border-[#2E2E2E] text-white">
                            Deskripsi</th>
                        <th
                            class="text-[9px] tracking-[2px] uppercase font-normal text-left px-3 pb-2.5 border-b border-[#2E2E2E] text-white">
                            Harga</th>
                        <th
                            class="text-[9px] tracking-[2px] uppercase font-normal text-left px-3 pb-2.5 border-b border-[#2E2E2E] text-white">
                            Durasi</th>
                        <th class="border-b border-[#2E2E2E]"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($layanans as $layanan)
                        <tr class="group hover:bg-white/[0.02] transition-colors duration-100">
                            <td class="px-3 py-3 border-b border-[#222]">
                                <div class="flex items-center gap-2.5">

                                    <span class="text-[13px] text-[#ddd]">{{ $layanan->nama }}</span>
                                </div>
                            </td>
                            <td class="px-3 py-3 border-b border-[#222] text-[11px] text-white max-w-[220px]">
                                <span class="block truncate">{{ $layanan->deskripsi ?: '—' }}</span>
                            </td>
                            <td class="px-3 py-3 border-b border-[#222]">
                                <span class="text-[12px] font-medium"
                                    style="background: linear-gradient(135deg,#C9A84C,#E2C97E); -webkit-background-clip:text; -webkit-text-fill-color:transparent; background-clip:text;">
                                    Rp {{ number_format($layanan->harga, 0, ',', '.') }}
                                </span>
                            </td>
                            <td class="px-3 py-3 border-b border-[#222]">
                                <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded text-[10px] tracking-widest"
                                    style="background:rgba(122,174,245,0.1); color:#7aaef5; border:0.5px solid rgba(122,174,245,0.25);">
                                    {{ $layanan->durasi }} mnt
                                </span>
                            </td>
                            <td class="px-3 py-3 border-b border-[#222] text-right">
                                <a href="{{ route('admin.layanan.edit', $layanan) }}"
                                    class="inline-flex px-2.5 py-1 rounded text-[10px] text-white border border-[#2E2E2E] hover:border-[rgba(201,168,76,0.35)] hover:text-[#C9A84C] transition-colors duration-150 ml-1">
                                    Edit
                                </a>
                                <form method="POST" action="{{ route('admin.layanan.destroy', $layanan) }}"
                                    class="inline">
                                    @csrf @method('DELETE')
                                    <button type="submit" onclick="return confirm('Hapus layanan ini?')"
                                        class="inline-flex px-2.5 py-1 rounded text-[10px] text-white border border-[#2E2E2E] hover:border-[rgba(220,60,60,0.4)] hover:text-[#e06060] transition-colors duration-150 ml-1 bg-transparent cursor-pointer">
                                        Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <div class="py-16 text-center">
                <p class="text-[11px] text-[#444] tracking-widest uppercase">
                    {{ request('search') ? 'Layanan tidak ditemukan.' : 'Belum ada layanan.' }}
                </p>
                @if (!request('search'))
                    <a href="{{ route('admin.layanan.create') }}"
                        class="inline-flex items-center gap-1.5 mt-4 text-[11px] transition-colors duration-150"
                        style="color:#C9A84C;">
                        + Tambah layanan pertama
                    </a>
                @endif
            </div>
        @endif

    </div>

@endsection
