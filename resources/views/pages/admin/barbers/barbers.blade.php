@extends('layouts.admin')

@section('title', 'Barber — Men\'s Hair Studio')

@section('content')

    <div class="flex-1 bg-[#161616] min-h-screen px-8 py-7 rounded-2xl">

        <div class="flex items-center justify-between mb-7">
            <div>
                <p class="text-[9px] tracking-[3px] uppercase text-white">Manajemen</p>
                <h1 class="text-xl font-medium text-[#eee] mt-1">Barber</h1>
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
            <div class="bg-[#222]  rounded-lg px-4 py-3.5">
                <p class="text-[9px] tracking-[2px] uppercase mb-1.5 text-gray-400">Total Barber</p>
                <p class="text-[22px] font-medium"
                    style="background: linear-gradient(135deg,#C9A84C,#E2C97E); -webkit-background-clip:text; -webkit-text-fill-color:transparent; background-clip:text;">
                    {{ $totalCount }}
                </p>
            </div>
            <div class=" bg-[#222]  rounded-lg px-4 py-3.5">
                <p class="text-[9px] tracking-[2px] uppercase mb-1.5 text-gray-400">Aktif</p>
                <p class="text-[22px] font-medium text-[#4caf76]">
                    {{ $aktifCount }}
                </p>
            </div>
            <div class="bg-[#222]  rounded-lg px-4 py-3.5 ">
                <p class="text-[9px] tracking-[2px] uppercase mb-1.5 text-gray-400">Tidak Aktif</p>
                <p class="text-[22px] font-medium text-[#e06060]">
                    {{ $nonaktifCount }}
                </p>
            </div>
        </div>

        {{-- Search & Add --}}
        <form method="GET" action="{{ route('admin.barber') }}" class="flex gap-3 mb-6">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama barber..."
                class="flex-1 bg-[#222] border border-[#2E2E2E] rounded-md px-4 py-2 text-[12px] text-[#ccc] placeholder-[#555] focus:outline-none focus:border-[rgba(201,168,76,0.4)] transition-colors duration-150" />
            <button type="submit"
                class="px-4 py-2 rounded-md bg-[#222] border border-[#2E2E2E] text-[11px] text-white hover:border-[rgba(201,168,76,0.35)] hover:text-[#C9A84C] transition-colors duration-150 cursor-pointer">
                Cari
            </button>
            @if (request('search'))
                <a href="{{ route('admin.barber') }}"
                    class="px-4 py-2 rounded-md bg-[#222] border border-[#2E2E2E] text-[11px] text-[#666] hover:text-[#999] transition-colors duration-150">
                    Reset
                </a>
            @endif

            <a href="{{ route('admin.barber.create') }}"
                class="flex items-center gap-2 px-4 py-2 rounded-md border transition-colors duration-150"
                style="background: rgba(201,168,76,0.08); border-color: rgba(201,168,76,0.25);">
                <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="#C9A84C" stroke-width="2">
                    <line x1="12" y1="5" x2="12" y2="19" />
                    <line x1="5" y1="12" x2="19" y2="12" />
                </svg>
                <span class="text-[12px] font-medium"
                    style="background: linear-gradient(135deg,#C9A84C,#E2C97E,#C9A84C);
                           -webkit-background-clip:text; -webkit-text-fill-color:transparent; background-clip:text;">
                    Tambah Barber
                </span>
            </a>
        </form>

        {{-- Table --}}
        <div class="flex items-center gap-3 mb-3">
            <p class="text-[9px] tracking-[3px] uppercase text-white">Daftar Barber</p>
            <div class="flex-1 border-t border-[#2E2E2E]"></div>
        </div>

        @if ($barbers->isNotEmpty())
            <table class="w-full border-collapse">
                <thead>
                    <tr>
                        <th
                            class="text-[9px] tracking-[2px] uppercase font-normal text-left px-3 pb-2.5 border-b border-[#2E2E2E] text-white">
                            Barber</th>
                        <th
                            class="text-[9px] tracking-[2px] uppercase font-normal text-left px-3 pb-2.5 border-b border-[#2E2E2E] text-white">
                            Status</th>
                        <th
                            class="text-[9px] tracking-[2px] uppercase font-normal text-left px-3 pb-2.5 border-b border-[#2E2E2E] text-white">
                            Keahlian</th>
                        <th class="border-b border-[#2E2E2E]"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($barbers as $barber)
                        <tr class="group hover:bg-white/[0.02] transition-colors duration-100">
                            <td class="px-3 py-3 border-b border-[#222]">
                                <div class="flex items-center gap-3">
                                    @if ($barber->foto)
                                        <button type="button"
                                            onclick="openFotoModal('{{ asset('storage/' . $barber->foto) }}', '{{ addslashes($barber->nama) }}')"
                                            class="w-[36px] h-[36px] rounded-full flex-shrink-0 overflow-hidden border border-[#2E2E2E] hover:border-[rgba(201,168,76,0.5)] hover:ring-1 hover:ring-[rgba(201,168,76,0.25)] transition-all duration-150 cursor-zoom-in focus:outline-none">
                                            <img src="{{ asset('storage/' . $barber->foto) }}" alt="{{ $barber->nama }}"
                                                class="w-full h-full object-cover" />
                                        </button>
                                    @else
                                        <div class="w-[36px] h-[36px] rounded-full flex items-center justify-center text-[13px] font-semibold text-[#111] flex-shrink-0"
                                            style="background: linear-gradient(135deg,#B8942A,#C9A84C);">
                                            {{ strtoupper(substr($barber->nama, 0, 1)) }}
                                        </div>
                                    @endif
                                    <span class="text-[13px] text-[#ddd]">{{ $barber->nama }}</span>
                                </div>
                            </td>
                            <td class="px-3 py-3 border-b border-[#222]">
                                @if ($barber->status)
                                    <span
                                        class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded text-[10px] tracking-widest"
                                        style="background:rgba(76,175,118,0.1); color:#4caf76; border:0.5px solid rgba(76,175,118,0.25);">

                                        Aktif
                                    </span>
                                @else
                                    <span
                                        class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded text-[10px] tracking-widest"
                                        style="background:rgba(220,60,60,0.08); color:#e06060; border:0.5px solid rgba(220,60,60,0.2);">

                                        Tidak Aktif
                                    </span>
                                @endif
                            </td>
                            <td class="px-3 py-3 border-b border-[#222]">
                                <div class="flex items-center gap-2.5">

                                    <span class="text-[13px] text-[#ddd]">{{ $barber->keahlian }}</span>
                                </div>
                            </td>
                            <td class="px-3 py-3 border-b border-[#222] text-right">
                                <a href="{{ route('admin.barber.edit', $barber) }}"
                                    class="inline-flex px-2.5 py-1 rounded text-[10px] text-white border border-[#2E2E2E] hover:border-[rgba(201,168,76,0.35)] hover:text-[#C9A84C] transition-colors duration-150 ml-1">
                                    Edit
                                </a>
                                <form method="POST" action="{{ route('admin.barber.destroy', $barber) }}" class="inline">
                                    @csrf @method('DELETE')
                                    <button type="submit" onclick="return confirm('Hapus barber ini?')"
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
                    {{ request('search') ? 'Barber tidak ditemukan.' : 'Belum ada barber.' }}
                </p>
                @if (!request('search'))
                    <a href="{{ route('admin.barber.create') }}"
                        class="inline-flex items-center gap-1.5 mt-4 text-[11px] transition-colors duration-150"
                        style="color:#C9A84C;">
                        + Tambah barber pertama
                    </a>
                @endif
            </div>
        @endif

    </div>


    <div id="foto-modal" class="fixed inset-0 z-[999] flex items-center justify-center p-4"
        style="opacity:0; pointer-events:none; transition: opacity 0.2s ease;">

        {{-- Backdrop --}}
        <div class="absolute inset-0 bg-black/75 backdrop-blur-[6px]" onclick="closeFotoModal()"></div>

        {{-- Card --}}
        <div id="foto-modal-card" class="relative z-10 flex flex-col items-center"
            style="transform: scale(0.88); transition: transform 0.25s cubic-bezier(0.34,1.4,0.64,1);">

            {{-- Tombol tutup --}}
            <button type="button" onclick="closeFotoModal()"
                class="absolute -top-3.5 -right-3.5 w-7 h-7 rounded-full flex items-center justify-center transition-colors duration-150 focus:outline-none z-20"
                style="background:#1c1c1c; border:0.5px solid #333; color:#555;" onmouseenter="this.style.color='#ccc'"
                onmouseleave="this.style.color='#555'">
                <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                    stroke-width="2.5">
                    <line x1="18" y1="6" x2="6" y2="18" />
                    <line x1="6" y1="6" x2="18" y2="18" />
                </svg>
            </button>

            {{-- Bingkai foto --}}
            <div class="rounded-2xl overflow-hidden"
                style="box-shadow: 0 32px 80px rgba(0,0,0,0.85), 0 0 0 0.5px rgba(201,168,76,0.2), inset 0 0 0 0.5px rgba(255,255,255,0.05);">
                <img id="foto-modal-img" src="" alt="" class="block w-[280px] h-[280px] object-cover" />
            </div>

            {{-- Label nama --}}
            <div class="mt-3 px-5 py-2 rounded-lg" style="background:rgba(18,18,18,0.97); border:0.5px solid #2a2a2a;">
                <p id="foto-modal-name" class="text-[10px] tracking-[3px] uppercase text-center"
                    style="background: linear-gradient(135deg,#C9A84C,#E2C97E); -webkit-background-clip:text; -webkit-text-fill-color:transparent; background-clip:text;">
                </p>
            </div>
        </div>
    </div>

    <style>
        #foto-modal.open {
            opacity: 1 !important;
            pointer-events: auto !important;
        }

        #foto-modal.open #foto-modal-card {
            transform: scale(1) !important;
        }
    </style>

    <script>
        const fotoModal = document.getElementById('foto-modal');
        const fotoModalImg = document.getElementById('foto-modal-img');
        const fotoModalName = document.getElementById('foto-modal-name');

        function openFotoModal(src, name) {
            fotoModalImg.src = src;
            fotoModalImg.alt = name;
            fotoModalName.textContent = name;
            fotoModal.classList.add('open');
            document.body.style.overflow = 'hidden';
        }

        function closeFotoModal() {
            fotoModal.classList.remove('open');
            document.body.style.overflow = '';
        }

        document.addEventListener('keydown', e => {
            if (e.key === 'Escape') closeFotoModal();
        });
    </script>

@endsection
