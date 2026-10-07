@extends('layouts.admin')

@section('title', 'Edit User — Men\'s Hair Studio')

@section('content')

    <div class="flex-1 bg-[#161616] min-h-screen px-8 py-7 rounded-2xl">

        <div class="flex items-center justify-between mb-7">
            <div>
                <p class="text-[9px] tracking-[3px] uppercase text-white">Manajemen / Pengguna</p>
                <h1 class="text-xl font-medium text-[#eee] mt-1">Edit User</h1>
            </div>
            <a href="{{ route('admin.datauser') }}"
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

            <form method="POST" action="{{ route('admin.users.update', $user) }}" class="space-y-4">
                @csrf
                @method('PUT')

                {{-- Nama --}}
                <div>
                    <label class="block text-[9px] tracking-[2px] uppercase text-white mb-2">Nama Lengkap</label>
                    <input type="text" name="name" value="{{ old('name', $user->name) }}"
                        placeholder="contoh: Budi Santoso"
                        class="w-full bg-[#222] border border-[#2E2E2E] rounded-md px-4 py-2.5 text-[12px] text-white placeholder-[#444] focus:outline-none focus:border-[rgba(201,168,76,0.45)] transition-colors duration-150 @error('name') border-[rgba(220,60,60,0.4)] @enderror" />
                </div>

                {{-- Email --}}
                <div>
                    <label class="block text-[9px] tracking-[2px] uppercase text-white mb-2">Email</label>
                    <input type="email" name="email" value="{{ old('email', $user->email) }}"
                        placeholder="contoh: budi@email.com"
                        class="w-full bg-[#222] border border-[#2E2E2E] rounded-md px-4 py-2.5 text-[12px] text-white placeholder-[#444] focus:outline-none focus:border-[rgba(201,168,76,0.45)] transition-colors duration-150 @error('email') border-[rgba(220,60,60,0.4)] @enderror" />
                </div>

                {{-- No HP --}}
                <div>
                    <label class="block text-[9px] tracking-[2px] uppercase text-white mb-2">
                        Nomor Telepon <span class="normal-case tracking-normal text-[#555]">(opsional)</span>
                    </label>
                    <input type="text" name="nohp" value="{{ old('nohp', $user->nohp) }}"
                        placeholder="contoh: 08123456789"
                        class="w-full bg-[#222] border border-[#2E2E2E] rounded-md px-4 py-2.5 text-[12px] text-white placeholder-[#444] focus:outline-none focus:border-[rgba(201,168,76,0.45)] transition-colors duration-150 @error('nohp') border-[rgba(220,60,60,0.4)] @enderror" />
                </div>

                {{-- Password --}}
                <div>
                    <label class="block text-[9px] tracking-[2px] uppercase text-white mb-2">
                        Password <span class="normal-case tracking-normal text-[#555]">(kosongkan jika tidak diubah)</span>
                    </label>
                    <div class="relative">
                        <input type="password" name="password" id="password"
                            placeholder="Minimal 8 karakter"
                            class="w-full bg-[#222] border border-[#2E2E2E] rounded-md px-4 py-2.5 pr-10 text-[12px] text-white placeholder-[#444] focus:outline-none focus:border-[rgba(201,168,76,0.45)] transition-colors duration-150 @error('password') border-[rgba(220,60,60,0.4)] @enderror" />
                        <button type="button" onclick="togglePassword('password','eye-password')"
                            class="absolute right-3 top-1/2 -translate-y-1/2 text-[#555] hover:text-[#999] transition-colors">
                            <svg id="eye-password" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/>
                            </svg>
                        </button>
                    </div>
                </div>

                {{-- Konfirmasi Password --}}
                <div>
                    <label class="block text-[9px] tracking-[2px] uppercase text-white mb-2">Konfirmasi Password</label>
                    <div class="relative">
                        <input type="password" name="password_confirmation" id="password_confirmation"
                            placeholder="Ulangi password baru"
                            class="w-full bg-[#222] border border-[#2E2E2E] rounded-md px-4 py-2.5 pr-10 text-[12px] text-white placeholder-[#444] focus:outline-none focus:border-[rgba(201,168,76,0.45)] transition-colors duration-150" />
                        <button type="button" onclick="togglePassword('password_confirmation','eye-confirm')"
                            class="absolute right-3 top-1/2 -translate-y-1/2 text-[#555] hover:text-[#999] transition-colors">
                            <svg id="eye-confirm" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/>
                            </svg>
                        </button>
                    </div>
                </div>

                {{-- Role --}}
                <div>
                    <label class="block text-[9px] tracking-[2px] uppercase text-white mb-2">Role</label>
                    <div class="flex gap-3">
                        <label class="flex items-center gap-2 cursor-pointer group">
                            <input type="radio" name="role" value="user"
                                {{ old('role', $user->role) == 'user' ? 'checked' : '' }}
                                class="accent-[#C9A84C]" />
                            <span class="text-[12px] text-[#ccc] group-hover:text-white transition-colors">User</span>
                        </label>
                        <label class="flex items-center gap-2 cursor-pointer group">
                            <input type="radio" name="role" value="admin"
                                {{ old('role', $user->role) == 'admin' ? 'checked' : '' }}
                                class="accent-[#C9A84C]" />
                            <span class="text-[12px] text-[#ccc] group-hover:text-white transition-colors">Admin</span>
                        </label>
                    </div>
                </div>

                {{-- Status --}}
                <div>
                    <label class="block text-[9px] tracking-[2px] uppercase text-white mb-2">Status</label>
                    <div class="flex gap-3">
                        <label class="flex items-center gap-2 cursor-pointer group">
                            <input type="radio" name="status" value="aktif"
                                {{ old('status', $user->status) == 'aktif' ? 'checked' : '' }}
                                class="accent-[#C9A84C]" />
                            <span class="text-[12px] text-[#ccc] group-hover:text-white transition-colors">Aktif</span>
                        </label>
                        <label class="flex items-center gap-2 cursor-pointer group">
                            <input type="radio" name="status" value="nonaktif"
                                {{ old('status', $user->status) == 'nonaktif' ? 'checked' : '' }}
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
                            Simpan Perubahan
                        </span>
                    </button>
                    <a href="{{ route('admin.datauser') }}"
                        class="px-5 py-2.5 rounded-md border border-[#2E2E2E] text-[12px] text-[#666] hover:text-[#999] transition-colors duration-150">
                        Batal
                    </a>
                </div>
            </form>
        </div>

    </div>

    <script>
        function togglePassword(fieldId, iconId) {
            const field = document.getElementById(fieldId);
            const icon  = document.getElementById(iconId);
            const isHidden = field.type === 'password';
            field.type = isHidden ? 'text' : 'password';
            icon.innerHTML = isHidden
                ? `<path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24"/><line x1="1" y1="1" x2="23" y2="23"/>`
                : `<path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/>`;
        }
    </script>

@endsection