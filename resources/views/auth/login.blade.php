@extends('layouts.layout')

@section('title', 'Masuk — Men\'s Hair Studio')

@section('content')
    <div class="min-h-screen flex items-center justify-center p-4">
        <div class="w-full max-w-4xl">



            <div class="grid grid-cols-1 md:grid-cols-2 gap-0 overflow-hidden rounded-lg border border-[#2E2E2E] shadow-2xl">


                <div class="relative bg-[#1A1A1A] p-8 md:p-10 flex flex-col justify-center" style="min-height:520px;">
                    <div class="flex items-center gap-3 mb-3 fade-up">
                        <div class="barber-accent" style="height:28px; width:4px;"></div>
                        <span class="text-xs tracking-widest uppercase text-gold font-medium">Men's Hair Studio</span>
                    </div>
                    <h1 class="font-display text-3xl font-bold text-white mb-2">Selamat Datang</h1>
                    <p class="text-sm text-[#888] leading-relaxed">
                        Upgrade gaya lo di sini!<br>
                        Potongan rapi, fresh, dan pastinya bikin makin pede.
                    </p>
                    @if (session('success'))
                        <div class="mb-4 px-4 py-3 rounded bg-[#1C2A1C] border border-green-700 text-green-400 text-sm">
                            {{ session('success') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('login') }}" class="space-y-5 fade-up-2">
                        @csrf

                        <div>
                            <label class="block text-xs uppercase tracking-widest text-[#888] mb-2">Email</label>
                            <input type="email" name="email" value="{{ old('email') }}" placeholder="contoh@email.com"
                                class="input-field {{ $errors->has('email') ? 'is-error' : '' }}" autocomplete="email" />
                            @error('email')
                                <p class="mt-1 text-xs text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <div class="flex justify-between items-center mb-2">
                                <label class="text-xs uppercase tracking-widest text-[#888]">Password</label>
                                <a href="#" class="text-xs text-gold hover:underline">
                                    Lupa Password?
                                </a>
                            </div>
                            <input type="password" name="password" placeholder="Minimal 8 karakter"
                                class="input-field {{ $errors->has('password') ? 'is-error' : '' }}"
                                autocomplete="current-password" />
                            @error('password')
                                <p class="mt-1 text-xs text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex items-center gap-2">
                            <input type="checkbox" name="remember" id="remember"
                                class="accent-[#C9A84C] w-4 h-4 rounded" />
                            <label for="remember" class="text-xs text-[#888] cursor-pointer">Ingat saya</label>
                        </div>

                        <button type="submit" class="btn-primary">Masuk</button>
                        <div class="divider">atau</div>

                        <p class="text-center text-sm text-[#666]">
                            Belum punya akun?
                            <a href="{{ route('register') }}" class="text-gold hover:underline font-medium">Daftar</a>
                        </p>
                    </form>
                </div>

                <div class="hidden md:flex relative overflow-hidden " style="min-height:520px;">

                    @if (file_exists(public_path('images/fotocukur.jpeg')))
                        <img src="{{ asset('images/fotocukur.jpeg') }}" alt="Barber"
                            class="absolute inset-0 w-full h-full object-cover" />
                    @else
                        <div class="flex flex-col items-center justify-center w-full h-full">
                            <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="#444"
                                stroke-width="1.5">
                                <rect x="3" y="3" width="18" height="18" rx="2" />
                                <circle cx="8.5" cy="8.5" r="1.5" />
                                <polyline points="21 15 16 10 5 21" />
                            </svg>

                            <span style="color:#555; font-size:12px; letter-spacing:2px; text-transform:uppercase;">
                                Foto Barber Shop
                            </span>
                        </div>
                    @endif

                </div>

            </div>

            <p class="text-center text-[#444] text-xs mt-6 tracking-widest fade-up-3">
                © {{ date('Y') }} MEN'S HAIR STUDIO — ALL RIGHTS RESERVED
            </p>
        </div>
    </div>
@endsection
