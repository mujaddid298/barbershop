@extends('layouts.admin')

@section('title', 'Edit Hasil Karya — Men\'s Hair Studio')

@section('content')

    <div class="flex-1 bg-[#161616] min-h-screen px-8 py-7 rounded-2xl">

        <div class="flex items-center justify-between mb-7">
            <div>
                <p class="text-[9px] tracking-[3px] uppercase text-white">Manajemen / Hasil Karya</p>
                <h1 class="text-xl font-medium text-[#eee] mt-1">Edit Hasil Karya</h1>
            </div>
            <a href="{{ route('admin.hasil-karya.index') }}"
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

            <form method="POST" action="{{ route('admin.hasil-karya.update', $hasilKarya->id) }}" enctype="multipart/form-data" class="space-y-4">
                @csrf
                @method('PUT')

                {{-- Judul --}}
                <div>
                    <label class="block text-[9px] tracking-[2px] uppercase text-white mb-2">Judul Hasil Karya</label>
                    <input type="text" name="judul" value="{{ old('judul', $hasilKarya->judul) }}"
                        placeholder="contoh: Slick Back dengan High Fade"
                        class="w-full bg-[#222] border border-[#2E2E2E] rounded-md px-4 py-2.5 text-[12px] text-white placeholder-[#444] focus:outline-none focus:border-[rgba(201,168,76,0.45)] transition-colors duration-150 @error('judul') border-[rgba(220,60,60,0.4)] @enderror" required />
                </div>

                {{-- Barber ID --}}
                <div>
                    <label class="block text-[9px] tracking-[2px] uppercase text-white mb-2">Barber Pembuat <span class="normal-case tracking-normal text-[#555]">(opsional)</span></label>
                    <select name="barber_id"
                        class="w-full bg-[#222] border border-[#2E2E2E] rounded-md px-4 py-2.5 text-[12px] text-white focus:outline-none focus:border-[rgba(201,168,76,0.45)] transition-colors duration-150 @error('barber_id') border-[rgba(220,60,60,0.4)] @enderror">
                        <option value="">-- Pilih Barber --</option>
                        @foreach ($barbers as $barber)
                            <option value="{{ $barber->id }}" {{ old('barber_id', $hasilKarya->barber_id) == $barber->id ? 'selected' : '' }}>
                                {{ $barber->nama }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Deskripsi --}}
                <div>
                    <label class="block text-[9px] tracking-[2px] uppercase text-white mb-2">Deskripsi / Detail Karya</label>
                    <textarea name="deskripsi" rows="4" placeholder="contoh: Gaya rambut modern dengan potongan tipis..."
                        class="w-full bg-[#222] border border-[#2E2E2E] rounded-md px-4 py-2.5 text-[12px] text-white placeholder-[#444] focus:outline-none focus:border-[rgba(201,168,76,0.45)] transition-colors duration-150 @error('deskripsi') border-[rgba(220,60,60,0.4)] @enderror">{{ old('deskripsi', $hasilKarya->deskripsi) }}</textarea>
                </div>

                {{-- Foto --}}
                <div>
                    <label class="block text-[9px] tracking-[2px] uppercase text-white mb-2">
                        Foto Karya <span class="normal-case tracking-normal text-[#555]">(opsional, pilih jika ingin mengganti)</span>
                    </label>

                    <label for="foto-input"
                        class="flex flex-col items-center justify-center gap-2 w-full h-[300px] rounded-md border border-dashed border-[#2E2E2E] cursor-pointer hover:border-[rgba(201,168,76,0.35)] transition-colors duration-150 relative overflow-hidden"
                        id="foto-label">
                        
                        @if ($hasilKarya->foto)
                            <img id="foto-preview" src="{{ asset('storage/' . $hasilKarya->foto) }}" alt="preview"
                                class="absolute inset-0 w-full h-full object-cover rounded-md" />
                            <div id="foto-placeholder" class="flex flex-col items-center gap-1.5 pointer-events-none hidden">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#555" stroke-width="1.5">
                                    <rect x="3" y="3" width="18" height="18" rx="2" ry="2"/>
                                    <circle cx="8.5" cy="8.5" r="1.5"/>
                                    <polyline points="21 15 16 10 5 21"/>
                                </svg>
                                <span class="text-[10px] text-[#555]">Klik untuk pilih foto karya</span>
                            </div>
                        @else
                            <img id="foto-preview" src="#" alt="preview"
                                class="absolute inset-0 w-full h-full object-cover hidden rounded-md" />
                            <div id="foto-placeholder" class="flex flex-col items-center gap-1.5 pointer-events-none">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#555" stroke-width="1.5">
                                    <rect x="3" y="3" width="18" height="18" rx="2" ry="2"/>
                                    <circle cx="8.5" cy="8.5" r="1.5"/>
                                    <polyline points="21 15 16 10 5 21"/>
                                </svg>
                                <span class="text-[10px] text-[#555]">Klik untuk pilih foto karya</span>
                            </div>
                        @endif
                    </label>
                    <input type="file" name="foto" id="foto-input" accept="image/*" class="hidden"
                        onchange="previewFoto(this)" />
                </div>

                <div class="flex items-center gap-3 pt-2">
                    <button type="submit"
                        class="flex items-center gap-2 px-5 py-2.5 rounded-md border transition-colors duration-150 cursor-pointer"
                        style="background: rgba(201,168,76,0.08); border-color: rgba(201,168,76,0.3);">
                        <span class="text-[12px] font-medium"
                            style="background: linear-gradient(135deg,#C9A84C,#E2C97E);
                                   -webkit-background-clip:text; -webkit-text-fill-color:transparent; background-clip:text;">
                            Perbarui Karya
                        </span>
                    </button>
                    <a href="{{ route('admin.hasil-karya.index') }}"
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
