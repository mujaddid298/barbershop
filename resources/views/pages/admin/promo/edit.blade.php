@extends('layouts.admin')

@section('title', 'Edit Promo — Men\'s Hair Studio')

@section('content')

    <div class="flex-grow bg-[#161616] min-h-screen px-8 py-7 rounded-2xl">

        <div class="flex items-center justify-between mb-7">
            <div>
                <p class="text-[9px] tracking-[3px] uppercase text-white">Manajemen / Promo</p>
                <h1 class="text-xl font-medium text-[#eee] mt-1">Edit Promo</h1>
            </div>
            <a href="{{ route('admin.promo') }}"
                class="flex items-center gap-2 px-4 py-2 rounded-md border border-[#2E2E2E] text-[11px] text-white hover:text-[#999] hover:border-[#3a3a3a] transition-colors duration-150">
                <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <polyline points="15 18 9 12 15 6"/>
                </svg>
                Kembali
            </a>
        </div>

        <div class="max-w-2xl">
            @if ($errors->any())
                <div class="mb-5 px-4 py-3 rounded-md text-[11px] text-[#e06060] border border-[rgba(220,60,60,0.25)] bg-[rgba(220,60,60,0.06)]">
                    <ul class="space-y-1">
                        @foreach ($errors->all() as $error)
                            <li>• {{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('admin.promo.update', $promo) }}" class="space-y-5">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-[9px] tracking-[2px] uppercase text-white mb-2">Kode Promo</label>
                        <input type="text" name="kode" value="{{ old('kode', $promo->kode) }}"
                            placeholder="contoh: HEMAT10"
                            class="w-full bg-[#222] border border-[#2E2E2E] rounded-md px-4 py-2.5 text-[12px] text-white placeholder-[#444] focus:outline-none focus:border-[rgba(201,168,76,0.45)] transition-colors duration-150" />
                        <span class="text-[9px] text-gray-500 mt-1 block">Akan otomatis diubah ke HURUF KAPITAL.</span>
                    </div>

                    <div>
                        <label class="block text-[9px] tracking-[2px] uppercase text-white mb-2">Nama Promo</label>
                        <input type="text" name="nama" value="{{ old('nama', $promo->nama) }}"
                            placeholder="contoh: Diskon Grand Opening"
                            class="w-full bg-[#222] border border-[#2E2E2E] rounded-md px-4 py-2.5 text-[12px] text-white placeholder-[#444] focus:outline-none focus:border-[rgba(201,168,76,0.45)] transition-colors duration-150" />
                    </div>
                </div>

                <div>
                    <label class="block text-[9px] tracking-[2px] uppercase text-white mb-2">Deskripsi <span class="normal-case tracking-normal">(opsional)</span></label>
                    <textarea name="deskripsi" rows="3"
                        placeholder="Detail penjelasan mengenai promo ini..."
                        class="w-full bg-[#222] border border-[#2E2E2E] rounded-md px-4 py-2.5 text-[12px] text-[#ccc] placeholder-[#444] focus:outline-none focus:border-[rgba(201,168,76,0.45)] transition-colors duration-150 resize-none">{{ old('deskripsi', $promo->deskripsi) }}</textarea>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div>
                        <label class="block text-[9px] tracking-[2px] uppercase text-white mb-2">Tipe Diskon</label>
                        <select name="tipe"
                            class="w-full bg-[#222] border border-[#2E2E2E] rounded-md px-4 py-2.5 text-[12px] text-[#ccc] focus:outline-none focus:border-[rgba(201,168,76,0.45)] transition-colors duration-150">
                            <option value="nominal" {{ old('tipe', $promo->tipe) === 'nominal' ? 'selected' : '' }}>Nominal (Rupiah)</option>
                            <option value="persentase" {{ old('tipe', $promo->tipe) === 'persentase' ? 'selected' : '' }}>Persentase (%)</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-[9px] tracking-[2px] uppercase text-white mb-2">Nominal Diskon</label>
                        <input type="number" name="nominal" value="{{ old('nominal', $promo->nominal) }}" min="1"
                            placeholder="10000 atau 10"
                            class="w-full bg-[#222] border border-[#2E2E2E] rounded-md px-4 py-2.5 text-[12px] text-[#ccc] placeholder-[#444] focus:outline-none focus:border-[rgba(201,168,76,0.45)] transition-colors duration-150" />
                    </div>

                    <div>
                        <label class="block text-[9px] tracking-[2px] uppercase text-white mb-2">Minimal Transaksi (Rp)</label>
                        <input type="number" name="minimal_transaksi" value="{{ old('minimal_transaksi', $promo->minimal_transaksi) }}" min="0"
                            placeholder="0"
                            class="w-full bg-[#222] border border-[#2E2E2E] rounded-md px-4 py-2.5 text-[12px] text-[#ccc] placeholder-[#444] focus:outline-none focus:border-[rgba(201,168,76,0.45)] transition-colors duration-150" />
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div>
                        <label class="block text-[9px] tracking-[2px] uppercase text-white mb-2">Kuota Penggunaan</label>
                        <input type="number" name="kuota" value="{{ old('kuota', $promo->kuota) }}" min="0"
                            placeholder="0"
                            class="w-full bg-[#222] border border-[#2E2E2E] rounded-md px-4 py-2.5 text-[12px] text-[#ccc] placeholder-[#444] focus:outline-none focus:border-[rgba(201,168,76,0.45)] transition-colors duration-150" />
                        <span class="text-[9px] text-gray-500 mt-1 block">Isi 0 untuk penggunaan tanpa batas.</span>
                    </div>

                    <div>
                        <label class="block text-[9px] tracking-[2px] uppercase text-white mb-2">Mulai Berlaku <span class="normal-case tracking-normal">(opsional)</span></label>
                        <input type="date" name="mulai_berlaku" value="{{ old('mulai_berlaku', $promo->mulai_berlaku ? $promo->mulai_berlaku->format('Y-m-d') : '') }}"
                            class="w-full bg-[#222] border border-[#2E2E2E] rounded-md px-4 py-2.5 text-[12px] text-[#ccc] focus:outline-none focus:border-[rgba(201,168,76,0.45)] transition-colors duration-150" />
                    </div>

                    <div>
                        <label class="block text-[9px] tracking-[2px] uppercase text-white mb-2">Akhir Berlaku <span class="normal-case tracking-normal">(opsional)</span></label>
                        <input type="date" name="akhir_berlaku" value="{{ old('akhir_berlaku', $promo->akhir_berlaku ? $promo->akhir_berlaku->format('Y-m-d') : '') }}"
                            class="w-full bg-[#222] border border-[#2E2E2E] rounded-md px-4 py-2.5 text-[12px] text-[#ccc] focus:outline-none focus:border-[rgba(201,168,76,0.45)] transition-colors duration-150" />
                    </div>
                </div>

                <div>
                    <label class="block text-[9px] tracking-[2px] uppercase text-white mb-2">Status Promo</label>
                    <select name="status"
                        class="w-full bg-[#222] border border-[#2E2E2E] rounded-md px-4 py-2.5 text-[12px] text-[#ccc] focus:outline-none focus:border-[rgba(201,168,76,0.45)] transition-colors duration-150">
                        <option value="1" {{ old('status', $promo->status) ? 'selected' : '' }}>Aktif</option>
                        <option value="0" {{ !old('status', $promo->status) ? 'selected' : '' }}>Nonaktif</option>
                    </select>
                </div>

                <div class="flex items-center gap-3 pt-2">
                    <button type="submit"
                        class="flex items-center gap-2 px-5 py-2.5 rounded-md border transition-colors duration-150 cursor-pointer"
                        style="background: rgba(201,168,76,0.08); border-color: rgba(201,168,76,0.3);">
                        <span class="text-[12px] font-medium"
                            style="background: linear-gradient(135deg,#C9A84C,#E2C97E);
                                   -webkit-background-clip:text; -webkit-text-fill-color:transparent; background-clip:text;">
                            Perbarui Promo
                        </span>
                    </button>
                    <a href="{{ route('admin.promo') }}"
                        class="px-5 py-2.5 rounded-md border border-[#2E2E2E] text-[12px] text-[#666] hover:text-[#999] transition-colors duration-150">
                        Batal
                    </a>
                </div>
            </form>
        </div>

    </div>

@endsection
