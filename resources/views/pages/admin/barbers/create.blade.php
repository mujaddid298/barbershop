@extends('layouts.admin')

@section('title', 'Tambah Barber — Men\'s Hair Studio')

@section('content')

    <div class="flex-1 bg-[#161616] min-h-screen px-8 py-7 rounded-2xl">

        <div class="flex items-center justify-between mb-7">
            <div>
                <p class="text-[9px] tracking-[3px] uppercase text-white">Manajemen / Barber</p>
                <h1 class="text-xl font-medium text-[#eee] mt-1">Tambah Barber</h1>
            </div>
            <a href="{{ route('admin.barber') }}"
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

            <form method="POST" action="{{ route('admin.barber.store') }}" enctype="multipart/form-data" class="space-y-4">
                @csrf

                {{-- Nama --}}
                <div>
                    <label class="block text-[9px] tracking-[2px] uppercase text-white mb-2">Nama Barber</label>
                    <input type="text" name="nama" value="{{ old('nama') }}"
                        placeholder="contoh: Reza Aditya"
                        class="w-full bg-[#222] border border-[#2E2E2E] rounded-md px-4 py-2.5 text-[12px] text-white placeholder-[#444] focus:outline-none focus:border-[rgba(201,168,76,0.45)] transition-colors duration-150 @error('nama') border-[rgba(220,60,60,0.4)] @enderror" />
                </div>

                {{-- Keahlian --}}
                <div>
                    <label class="block text-[9px] tracking-[2px] uppercase text-white mb-2">Keahlian Barber</label>
                    <input type="text" name="keahlian" value="{{ old('keahlian') }}"
                        placeholder="contoh: Classic Cut, Pompadour, Fade Style"
                        class="w-full bg-[#222] border border-[#2E2E2E] rounded-md px-4 py-2.5 text-[12px] text-white placeholder-[#444] focus:outline-none focus:border-[rgba(201,168,76,0.45)] transition-colors duration-150 @error('keahlian') border-[rgba(220,60,60,0.4)] @enderror" />
                </div>

                {{-- Foto --}}
                <div>
                    <label class="block text-[9px] tracking-[2px] uppercase text-white mb-2">
                        Foto <span class="normal-case tracking-normal text-[#555]">(opsional, maks. 2MB)</span>
                    </label>

                    <label for="foto-input"
                        class="flex flex-col items-center justify-center gap-2 w-full h-[300px] rounded-md border border-dashed border-[#2E2E2E] cursor-pointer hover:border-[rgba(201,168,76,0.35)] transition-colors duration-150 relative overflow-hidden"
                        id="foto-label">
                        <img id="foto-preview" src="#" alt="preview"
                            class="absolute inset-0 w-full h-full object-cover hidden rounded-md" />

                        <div id="foto-placeholder" class="flex flex-col items-center gap-1.5 pointer-events-none">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#555" stroke-width="1.5">
                                <rect x="3" y="3" width="18" height="18" rx="2" ry="2"/>
                                <circle cx="8.5" cy="8.5" r="1.5"/>
                                <polyline points="21 15 16 10 5 21"/>
                            </svg>
                            <span class="text-[10px] text-[#555]">Klik untuk pilih foto</span>
                        </div>
                    </label>
                    <input type="file" name="foto" id="foto-input" accept="image/*" class="hidden"
                        onchange="previewFoto(this)" />
                </div>

                {{-- Status --}}
                <div>
                    <label class="block text-[9px] tracking-[2px] uppercase text-white mb-2">Status</label>
                    <div class="flex gap-3">
                        <label class="flex items-center gap-2 cursor-pointer group">
                            <input type="radio" name="status" value="1"
                                {{ old('status', '1') == '1' ? 'checked' : '' }}
                                class="accent-[#C9A84C]" />
                            <span class="text-[12px] text-[#ccc] group-hover:text-white transition-colors">Aktif</span>
                        </label>
                        <label class="flex items-center gap-2 cursor-pointer group">
                            <input type="radio" name="status" value="0"
                                {{ old('status') == '0' ? 'checked' : '' }}
                                class="accent-[#C9A84C]" />
                            <span class="text-[12px] text-[#ccc] group-hover:text-white transition-colors">Tidak Aktif</span>
                        </label>
                    </div>
                </div>

                <div class="flex items-center gap-3 pt-2">
                    <button type="submit"
                        class="flex items-center gap-2 px-5 py-2.5 rounded-md border transition-colors duration-150 cursor-pointer"
                        style="background: rgba(201,168,76,0.08); border-color: rgba(201,168,76,0.3);">
                        <span class="text-[12px] font-medium"
                            style="background: linear-gradient(135deg,#C9A84C,#E2C97E);
                                   -webkit-background-clip:text; -webkit-text-fill-color:transparent; background-clip:text;">
                            Simpan Barber
                        </span>
                    </button>
                    <a href="{{ route('admin.barber') }}"
                        class="px-5 py-2.5 rounded-md border border-[#2E2E2E] text-[12px] text-[#666] hover:text-[#999] transition-colors duration-150">
                        Batal
                    </a>
                </div>
            </form>
        </div>

    </div>

    <script>
        function previewFoto(input) {
            const preview = document.getElementById('foto-preview');
            const placeholder = document.getElementById('foto-placeholder');
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = e => {
                    preview.src = e.target.result;
                    preview.classList.remove('hidden');
                    placeholder.classList.add('hidden');
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>

@endsection