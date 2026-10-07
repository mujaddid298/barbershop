@extends('layouts.admin')

@section('title', 'Manajemen Promosi — Men\'s Hair Studio')

@section('content')

    <div class="flex-grow bg-[#161616] min-h-screen px-8 py-7 rounded-2xl">

        <div class="flex items-center justify-between mb-7">
            <div>
                <p class="text-[9px] tracking-[3px] uppercase text-white">Manajemen</p>
                <h1 class="text-xl font-medium text-[#eee] mt-1">Promosi & Diskon</h1>
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
                <p class="text-[9px] tracking-[2px] uppercase mb-1.5">Total Promo</p>
                <p class="text-[22px] font-medium"
                    style="background: linear-gradient(135deg,#C9A84C,#E2C97E); -webkit-background-clip:text; -webkit-text-fill-color:transparent; background-clip:text;">
                    {{ $promos->total() }}
                </p>
            </div>
            <div class="bg-[#222] border border-[#2E2E2E] rounded-lg px-4 py-3.5">
                <p class="text-[9px] tracking-[2px] uppercase mb-1.5">Promo Aktif</p>
                <p class="text-[22px] font-medium text-[#7aaef5]">
                    {{ \App\Models\Promo::where('status', true)->count() }}
                </p>
            </div>
            <div class="bg-[#222] border border-[#2E2E2E] rounded-lg px-4 py-3.5">
                <p class="text-[9px] tracking-[2px] uppercase mb-1.5">Total Penggunaan</p>
                <p class="text-[22px] font-medium text-[#C9A84C]">
                    {{ \App\Models\Promo::sum('terpakai') }} kali
                </p>
            </div>
        </div>

        {{-- Search & Add --}}
        <form method="GET" action="{{ route('admin.promo') }}" class="flex gap-3 mb-6">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari kode atau nama promo..."
                class="flex-1 bg-[#222] border border-[#2E2E2E] rounded-md px-4 py-2 text-[12px] text-[#ccc] placeholder-[#555] focus:outline-none focus:border-[rgba(201,168,76,0.4)] transition-colors duration-150" />
            <button type="submit"
                class="px-4 py-2 rounded-md bg-[#222] border border-[#2E2E2E] text-[11px] text-white hover:border-[rgba(201,168,76,0.35)] hover:text-[#C9A84C] transition-colors duration-150 cursor-pointer">
                Cari
            </button>
            @if (request('search'))
                <a href="{{ route('admin.promo') }}"
                    class="px-4 py-2 rounded-md bg-[#222] border border-[#2E2E2E] text-[11px] text-[#666] hover:text-[#999] transition-colors duration-150">
                    Reset
                </a>
            @endif

            <a href="{{ route('admin.promo.create') }}"
                class="flex items-center gap-2 px-4 py-2 rounded-md border transition-colors duration-150"
                style="background: rgba(201,168,76,0.08); border-color: rgba(201,168,76,0.25);">
                <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="#C9A84C" stroke-width="2">
                    <line x1="12" y1="5" x2="12" y2="19" />
                    <line x1="5" y1="12" x2="19" y2="12" />
                </svg>
                <span class="text-[12px] font-medium"
                    style="background: linear-gradient(135deg,#C9A84C,#E2C97E,#C9A84C);
                           -webkit-background-clip:text; -webkit-text-fill-color:transparent; background-clip:text;">
                    Tambah Promo
                </span>
            </a>
        </form>

        {{-- Table --}}
        <div class="flex items-center gap-3 mb-3">
            <p class="text-[9px] tracking-[3px] uppercase text-white">Daftar Promo</p>
            <div class="flex-1 border-t border-[#2E2E2E]"></div>
        </div>

        @if ($promos->isNotEmpty())
            <div class="overflow-x-auto">
                <table class="w-full border-collapse">
                    <thead>
                        <tr>
                            <th
                                class="text-[9px] tracking-[2px] uppercase font-normal text-left px-3 pb-2.5 border-b border-[#2E2E2E] text-white">
                                Kode & Nama</th>
                            <th
                                class="text-[9px] tracking-[2px] uppercase font-normal text-left px-3 pb-2.5 border-b border-[#2E2E2E] text-white">
                                Potongan</th>
                            <th
                                class="text-[9px] tracking-[2px] uppercase font-normal text-left px-3 pb-2.5 border-b border-[#2E2E2E] text-white">
                                Min. Transaksi</th>
                            <th
                                class="text-[9px] tracking-[2px] uppercase font-normal text-left px-3 pb-2.5 border-b border-[#2E2E2E] text-white">
                                Kuota (Terpakai)</th>
                            <th
                                class="text-[9px] tracking-[2px] uppercase font-normal text-left px-3 pb-2.5 border-b border-[#2E2E2E] text-white">
                                Masa Berlaku</th>
                            <th
                                class="text-[9px] tracking-[2px] uppercase font-normal text-left px-3 pb-2.5 border-b border-[#2E2E2E] text-white">
                                Status</th>
                            <th class="border-b border-[#2E2E2E]"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($promos as $promo)
                            <tr class="group hover:bg-white/[0.02] transition-colors duration-100">
                                <td class="px-3 py-4 border-b border-[#222]">
                                    <div class="flex flex-col">
                                        <span
                                            class="text-[13px] font-bold text-[#C9A84C] tracking-wide">{{ $promo->kode }}</span>
                                        <span class="text-[11px] text-[#aaa] mt-0.5">{{ $promo->nama }}</span>
                                    </div>
                                </td>
                                <td class="px-3 py-4 border-b border-[#222]">
                                    @if ($promo->tipe === 'persentase')
                                        <span class="text-[12px] font-medium text-[#7aaef5]">
                                            {{ $promo->nominal }}%
                                        </span>
                                    @else
                                        <span class="text-[12px] font-medium text-[#7aaef5]">
                                            Rp {{ number_format($promo->nominal, 0, ',', '.') }}
                                        </span>
                                    @endif
                                </td>
                                <td class="px-3 py-4 border-b border-[#222]">
                                    <span class="text-[11px] text-white">
                                        Rp {{ number_format($promo->minimal_transaksi, 0, ',', '.') }}
                                    </span>
                                </td>
                                <td class="px-3 py-4 border-b border-[#222]">
                                    <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded text-[10px]"
                                        style="background:rgba(201,168,76,0.1); color:#C9A84C; border:0.5px solid rgba(201,168,76,0.25);">
                                        {{ $promo->terpakai }} / {{ $promo->kuota === 0 ? '∞' : $promo->kuota }}
                                    </span>
                                </td>
                                <td class="px-3 py-4 border-b border-[#222] text-[11px] text-white">
                                    @if ($promo->mulai_berlaku || $promo->akhir_berlaku)
                                        <span class="block text-[10px]">
                                            {{ $promo->mulai_berlaku ? $promo->mulai_berlaku->format('d/m/Y') : '—' }} s/d
                                            {{ $promo->akhir_berlaku ? $promo->akhir_berlaku->format('d/m/Y') : '—' }}
                                        </span>
                                    @else
                                        <span class="text-white">Selamanya</span>
                                    @endif
                                </td>
                                <td class="px-3 py-4 border-b border-[#222]">
                                    @php
                                        $today = now()->startOfDay();
                                        $isExpired =
                                            $promo->akhir_berlaku && $promo->akhir_berlaku->endOfDay()->lt($today);
                                        $isFull = $promo->kuota > 0 && $promo->terpakai >= $promo->kuota;
                                        $isActive = $promo->status && !$isExpired && !$isFull;
                                    @endphp
                                    @if ($isActive)
                                        <span
                                            class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-[9px] font-semibold bg-emerald-500/10 text-emerald-400 border border-emerald-500/20">
                                            <span class="w-1 h-1 rounded-full bg-emerald-400"></span>
                                            Aktif
                                        </span>
                                    @else
                                        <span
                                            class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-[9px] font-semibold bg-rose-500/10 text-rose-400 border border-rose-500/20">
                                            <span class="w-1 h-1 rounded-full bg-rose-400"></span>
                                            @if (!$promo->status)
                                                Nonaktif
                                            @elseif ($isExpired)
                                                Kedaluwarsa
                                            @else
                                                Kuota Habis
                                            @endif
                                        </span>
                                    @endif
                                </td>
                                <td class="px-3 py-4 border-b border-[#222] text-right">
                                    <a href="{{ route('admin.promo.edit', $promo) }}"
                                        class="inline-flex px-2.5 py-1 rounded text-[10px] text-white border border-[#2E2E2E] hover:border-[rgba(201,168,76,0.35)] hover:text-[#C9A84C] transition-colors duration-150 ml-1">
                                        Edit
                                    </a>
                                    <form method="POST" action="{{ route('admin.promo.destroy', $promo) }}"
                                        class="inline">
                                        @csrf @method('DELETE')
                                        <button type="submit"
                                            onclick="return confirm('Hapus promo {{ $promo->kode }} ini?')"
                                            class="inline-flex px-2.5 py-1 rounded text-[10px] text-white border border-[#2E2E2E] hover:border-[rgba(220,60,60,0.4)] hover:text-[#e06060] transition-colors duration-150 ml-1 bg-transparent cursor-pointer">
                                            Hapus
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="mt-5 text-white">
                {{ $promos->links() }}
            </div>
        @else
            <div class="py-16 text-center">
                <p class="text-[11px] text-[#444] tracking-widest uppercase">
                    {{ request('search') ? 'Promo tidak ditemukan.' : 'Belum ada promo yang terdaftar.' }}
                </p>
                @if (!request('search'))
                    <a href="{{ route('admin.promo.create') }}"
                        class="inline-flex items-center gap-1.5 mt-4 text-[11px] transition-colors duration-150"
                        style="color:#C9A84C;">
                        + Tambah promo pertama
                    </a>
                @endif
            </div>
        @endif

    </div>

@endsection
