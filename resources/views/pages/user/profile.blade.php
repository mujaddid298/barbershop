<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Saya · Men's Hair Studio</title>
    <link rel="icon" type="image/png" href="{{ asset('icons/mens.png') }}">

    <meta name="description" content="Kelola profil akun Anda di Men's Hair Studio Barbershop">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        :root {
            --gold: #C9A84C;
            --gold-light: #E2C97E;
            --charcoal: #252525;
            --dark: #1C1C1C;
            --surface: #2E2E2E;
            --border: #3D3D3D;
            --muted: #8A8A8A;
            --text: #F0EDE8;
        }

        body {
            background-color: var(--dark);
            color: var(--text);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .floating-bar {
            background: rgba(28, 28, 28, 0.96);
            backdrop-filter: blur(10px);
            border-bottom: 1px solid var(--border);
        }

        .glass-panel {
            background: rgba(46, 46, 46, 0.6);
            backdrop-filter: blur(12px);
            border: 1px solid var(--border);
        }

        .profile-input {
            background: transparent;
            border: 1px solid var(--border);
            border-radius: 0.75rem;
            padding: 0.75rem 1rem;
            font-size: 0.875rem;
            color: var(--text);
            outline: none;
            width: 100%;
            transition: border-color 0.3s ease, box-shadow 0.3s ease;
        }

        .profile-input:focus {
            border-color: var(--gold);
            box-shadow: 0 0 0 3px rgba(201, 168, 76, 0.1);
        }

        .profile-input:disabled {
            color: var(--muted);
            cursor: not-allowed;
        }

        .profile-input::placeholder {
            color: #5A5A5A;
        }

        .btn-gold {
            background: var(--gold);
            color: var(--dark);
            font-weight: 600;
            transition: all 0.3s ease;
            cursor: pointer;
            border: none;
        }

        .btn-gold:hover {
            background: var(--gold-light);
            transform: translateY(-2px);
        }

        .btn-outline {
            background: transparent;
            color: var(--gold);
            border: 1px solid var(--gold);
            font-weight: 600;
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .btn-outline:hover {
            background: var(--gold);
            color: var(--dark);
        }

        .btn-danger {
            background: transparent;
            color: #F87171;
            border: 1px solid rgba(248, 113, 113, 0.3);
            font-weight: 600;
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .btn-danger:hover {
            background: #F87171;
            color: var(--dark);
        }

        /* Tab system */
        .tab-btn {
            position: relative;
            padding: 0.75rem 1.5rem;
            font-size: 0.8rem;
            font-weight: 600;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            color: var(--muted);
            background: transparent;
            border: none;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .tab-btn:hover {
            color: var(--text);
        }

        .tab-btn.active {
            color: var(--gold);
        }

        .tab-btn.active::after {
            content: '';
            position: absolute;
            bottom: -1px;
            left: 0;
            right: 0;
            height: 2px;
            background: var(--gold);
            border-radius: 1px;
        }

        .tab-panel {
            display: none;
            animation: fadeSlideIn 0.4s ease forwards;
        }

        .tab-panel.active {
            display: block;
        }

        @keyframes fadeSlideIn {
            from {
                opacity: 0;
                transform: translateY(12px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Avatar upload area */
        .avatar-upload {
            position: relative;
            width: 140px;
            height: 140px;
            border-radius: 50%;
            overflow: hidden;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .avatar-upload:hover .avatar-overlay {
            opacity: 1;
        }

        .avatar-overlay {
            position: absolute;
            inset: 0;
            background: rgba(0, 0, 0, 0.65);
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            opacity: 0;
            transition: opacity 0.3s ease;
            gap: 4px;
        }




        /* Custom scrollbar */
        ::-webkit-scrollbar {
            width: 6px;
        }

        ::-webkit-scrollbar-track {
            background: var(--dark);
        }

        ::-webkit-scrollbar-thumb {
            background: var(--border);
            border-radius: 3px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: var(--gold);
        }

        /* File input styling */
        input[type="file"] {
            display: none;
        }

        textarea.profile-input {
            resize: vertical;
            min-height: 80px;
        }
    </style>
</head>

<body>

    <x-header-user />

    <!-- MAIN CONTENT -->
    <main class="flex-grow pt-28 pb-12 md:py-[150px] px-4 md:px-8">
        <div class="max-w-4xl mx-auto">

            <!-- Page Header -->
            <div class="mb-10">
                <span class="text-xs tracking-[0.2em] text-[#C9A84C] uppercase font-semibold">Akun Saya</span>
                <h1 class=" text-3xl md:text-4xl font-bold mt-1 text-[#F0EDE8]">Profil Pengguna</h1>
                <p class="text-sm text-gray-400 mt-2">Kelola informasi profil dan keamanan akun Anda.</p>
            </div>
            <!-- SUCCESS/ERROR -->
            @if (session('success'))
                <div id="success"
                    class="mb-4 px-5 py-4 rounded-xl bg-emerald-500/10 border border-emerald-500/30 text-emerald-300">
                    <div class="flex items-center gap-3">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2">
                            <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14" />
                            <polyline points="22 4 12 14.01 9 11.01" />
                        </svg>

                        <span class="text-sm font-medium">
                            {{ session('success') }}
                        </span>
                    </div>
                </div>
            @endif
            <!-- Profile Card Header -->
            <div class="glass-panel rounded-3xl p-6 md:p-8 mb-6 relative overflow-hidden">

                <div class="flex flex-col md:flex-row items-center gap-6 relative z-10">
                    <!-- Avatar -->
                    <div class="avatar-upload border-2 border-[#3D3D3D] hover:border-[#C9A84C] transition-colors"
                        onclick="document.getElementById('fotoInput').click()">
                        @if ($user->foto)
                            <img id="avatarPreview" src="{{ asset('storage/' . $user->foto) }}"
                                alt="{{ $user->name }}" class="w-full h-full object-cover">
                        @else
                            <div id="avatarPreview" class="w-full h-full flex items-center justify-center bg-[#252525]">
                                <span
                                    class=" text-4xl font-bold text-[#C9A84C]">{{ strtoupper(substr($user->name, 0, 2)) }}</span>
                            </div>
                        @endif
                        <div class="avatar-overlay">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#C9A84C"
                                stroke-width="1.5">
                                <path
                                    d="M23 19a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h4l2-3h6l2 3h4a2 2 0 0 1 2 2z" />
                                <circle cx="12" cy="13" r="4" />
                            </svg>
                            <span class="text-[10px] text-[#C9A84C] font-semibold tracking-wider uppercase">Ubah
                                Foto</span>
                        </div>
                    </div>

                    <!-- User Info -->
                    <div class="text-center md:text-left flex-1">
                        <h2 class=" text-2xl font-bold text-[#F0EDE8]">{{ $user->name }}</h2>
                        <p class="text-sm text-gray-400 mt-1 flex items-center justify-center md:justify-start gap-2">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2">
                                <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z" />
                                <polyline points="22,6 12,13 2,6" />
                            </svg>
                            {{ $user->email }}
                        </p>
                        <div class="flex items-center justify-center md:justify-start gap-3 mt-3">
                            <span
                                class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-[10px] font-semibold tracking-wider uppercase bg-green-500/10 border border-green-500/30   text-green-500">

                                {{ ucfirst($user->status ?? 'aktif') }}
                            </span>
                            <span class="text-xs text-gray-400">
                                Bergabung {{ $user->created_at->translatedFormat('d F Y') }}
                            </span>
                        </div>
                    </div>

                    <!-- Quick Action -->
                    <div class="hidden md:flex flex-col items-end gap-2">
                        <a href="{{ route('user.booking.create') }}"
                            class="btn-gold px-5 py-2.5 rounded-xl text-xs tracking-wider uppercase flex items-center gap-2">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2">
                                <rect x="3" y="4" width="18" height="18" rx="2" ry="2" />
                                <line x1="16" y1="2" x2="16" y2="6" />
                                <line x1="8" y1="2" x2="8" y2="6" />
                                <line x1="3" y1="10" x2="21" y2="10" />
                            </svg>
                            Booking Baru
                        </a>
                    </div>
                </div>
            </div>

            <!-- Tabs -->
            <div class="glass-panel rounded-3xl overflow-hidden relative">


                <!-- Tab Navigation -->
                <div class="flex border-b border-[#3D3D3D]">
                    <button type="button" class="tab-btn active" onclick="switchTab('info', this)">
                        Informasi
                    </button>
                    <button type="button" class="tab-btn" onclick="switchTab('security', this)">
                        Keamanan
                    </button>
                </div>

                <!-- Tab Panel: Info -->
                <div id="tab-info" class="tab-panel active p-6 md:p-8">
                    <form method="POST" action="{{ route('user.profile.update') }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <input type="file" name="foto" id="fotoInput"
                            accept="image/jpeg,image/png,image/jpg,image/webp" onchange="previewAvatar(event)">

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Name -->
                            <div class="flex flex-col gap-2">
                                <label class="text-xs tracking-widest uppercase text-gray-400 font-semibold">Nama
                                    Lengkap</label>
                                <input type="text" name="name" value="{{ old('name', $user->name) }}"
                                    class="profile-input" placeholder="Masukkan nama lengkap">
                                @error('name')
                                    <span class="text-xs text-red-400">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Email -->
                            <div class="flex flex-col gap-2">
                                <label
                                    class="text-xs tracking-widest uppercase text-gray-400 font-semibold">Email</label>
                                <input type="email" name="email" value="{{ old('email', $user->email) }}"
                                    class="profile-input" placeholder="Masukkan email">
                                @error('email')
                                    <span class="text-xs text-red-400">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Phone -->
                            <div class="flex flex-col gap-2">
                                <label class="text-xs tracking-widest uppercase text-gray-400 font-semibold">Nomor
                                    WhatsApp</label>
                                <input type="tel" name="nohp" value="{{ old('nohp', $user->nohp) }}"
                                    class="profile-input" placeholder="Contoh: 081234567890">
                                @error('nohp')
                                    <span class="text-xs text-red-400">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Role (read only) -->
                            <div class="flex flex-col gap-2">
                                <label
                                    class="text-xs tracking-widest uppercase text-gray-400 font-semibold">Role</label>
                                <input type="text" value="{{ ucfirst($user->role) }}" disabled
                                    class="profile-input">
                            </div>

                            <!-- Address -->
                            <div class="flex flex-col gap-2 md:col-span-2">
                                <label
                                    class="text-xs tracking-widest uppercase text-gray-400 font-semibold">Alamat</label>
                                <textarea name="alamat" class="profile-input" placeholder="Masukkan alamat lengkap (opsional)">{{ old('alamat', $user->alamat) }}</textarea>
                                @error('alamat')
                                    <span class="text-xs text-red-400">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <!-- Photo preview info -->
                        <div id="photoPreviewInfo"
                            class="hidden mt-4 p-3 rounded-xl bg-[#C9A84C]/5 border border-[#C9A84C]/20 text-xs text-[#C9A84C] flex items-center gap-2">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="2">
                                <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z" />
                                <polyline points="14 2 14 8 20 8" />
                            </svg>
                            <span id="photoFileName">Foto baru dipilih</span>
                        </div>

                        <!-- Actions -->
                        <div class="flex flex-col sm:flex-row items-center gap-3 mt-8 pt-6 border-t border-[#3D3D3D]">
                            <button type="submit"
                                class="btn-gold px-8 py-3 rounded-xl text-sm tracking-wider uppercase w-full sm:w-auto flex items-center justify-center gap-2">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="2">
                                    <path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z" />
                                    <polyline points="17 21 17 13 7 13 7 21" />
                                    <polyline points="7 3 7 8 15 8" />
                                </svg>
                                Simpan Perubahan
                            </button>

                            @if ($user->foto)
                                <button type="button" onclick="confirmDeleteFoto()"
                                    class="btn-danger px-6 py-3 rounded-xl text-sm tracking-wider uppercase w-full sm:w-auto flex items-center justify-center gap-2">
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none"
                                        stroke="currentColor" stroke-width="2">
                                        <polyline points="3 6 5 6 21 6" />
                                        <path
                                            d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2" />
                                    </svg>
                                    Hapus Foto
                                </button>
                            @endif
                        </div>
                    </form>
                </div>

                <div id="tab-security" class="tab-panel p-6 md:p-8">
                    <form method="POST" action="{{ route('user.profile.password') }}">
                        @csrf
                        @method('PUT')

                        <div class="max-w-md">
                            <div class="mb-6">
                                <h3 class=" text-xl font-bold text-[#F0EDE8] flex items-center gap-2">
                                    Ubah Password
                                </h3>
                                <p class="text-xs text-gray-400 mt-1">Pastikan password baru minimal 8 karakter dan
                                    berbeda dari sebelumnya.</p>
                            </div>

                            <div class="flex flex-col gap-5">
                                <!-- Current Password -->
                                <div class="flex flex-col gap-2">
                                    <label
                                        class="text-xs tracking-widest uppercase text-gray-400 font-semibold">Password
                                        Lama</label>
                                    <div class="relative">
                                        <input type="password" name="current_password" id="currentPassword"
                                            class="profile-input pr-10" placeholder="Masukkan password lama">
                                        <button type="button"
                                            class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-[#C9A84C] transition"
                                            onclick="togglePassword('currentPassword', this)">
                                            <svg class="eye-open" width="16" height="16" viewBox="0 0 24 24"
                                                fill="none" stroke="currentColor" stroke-width="2">
                                                <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z" />
                                                <circle cx="12" cy="12" r="3" />
                                            </svg>
                                            <svg class="eye-closed hidden" width="16" height="16"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                stroke-width="2">
                                                <path
                                                    d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24" />
                                                <line x1="1" y1="1" x2="23" y2="23" />
                                            </svg>
                                        </button>
                                    </div>
                                    @error('current_password')
                                        <span class="text-xs text-red-400">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- New Password -->
                                <div class="flex flex-col gap-2">
                                    <label
                                        class="text-xs tracking-widest uppercase text-gray-400 font-semibold">Password
                                        Baru</label>
                                    <div class="relative">
                                        <input type="password" name="password" id="newPassword"
                                            class="profile-input pr-10" placeholder="Minimal 8 karakter">
                                        <button type="button"
                                            class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-[#C9A84C] transition"
                                            onclick="togglePassword('newPassword', this)">
                                            <svg class="eye-open" width="16" height="16" viewBox="0 0 24 24"
                                                fill="none" stroke="currentColor" stroke-width="2">
                                                <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z" />
                                                <circle cx="12" cy="12" r="3" />
                                            </svg>
                                            <svg class="eye-closed hidden" width="16" height="16"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                stroke-width="2">
                                                <path
                                                    d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24" />
                                                <line x1="1" y1="1" x2="23" y2="23" />
                                            </svg>
                                        </button>
                                    </div>
                                    @error('password')
                                        <span class="text-xs text-red-400">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- Confirm New Password -->
                                <div class="flex flex-col gap-2">
                                    <label
                                        class="text-xs tracking-widest uppercase text-gray-400 font-semibold">Konfirmasi
                                        Password Baru</label>
                                    <div class="relative">
                                        <input type="password" name="password_confirmation" id="confirmPassword"
                                            class="profile-input pr-10" placeholder="Ulangi password baru">
                                        <button type="button"
                                            class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-[#C9A84C] transition"
                                            onclick="togglePassword('confirmPassword', this)">
                                            <svg class="eye-open" width="16" height="16" viewBox="0 0 24 24"
                                                fill="none" stroke="currentColor" stroke-width="2">
                                                <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z" />
                                                <circle cx="12" cy="12" r="3" />
                                            </svg>
                                            <svg class="eye-closed hidden" width="16" height="16"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                stroke-width="2">
                                                <path
                                                    d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24" />
                                                <line x1="1" y1="1" x2="23" y2="23" />
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <!-- Password Strength Indicator -->
                            <div class="mt-4 p-4 rounded-xl bg-[#1C1C1C] border border-[#3D3D3D]">
                                <div class="text-[10px] uppercase text-gray-400 tracking-wider font-semibold mb-3">
                                    Kekuatan Password</div>
                                <div class="flex gap-1.5 mb-2">
                                    <div id="str1"
                                        class="h-1 flex-1 rounded-full bg-[#3D3D3D] transition-colors duration-300">
                                    </div>
                                    <div id="str2"
                                        class="h-1 flex-1 rounded-full bg-[#3D3D3D] transition-colors duration-300">
                                    </div>
                                    <div id="str3"
                                        class="h-1 flex-1 rounded-full bg-[#3D3D3D] transition-colors duration-300">
                                    </div>
                                    <div id="str4"
                                        class="h-1 flex-1 rounded-full bg-[#3D3D3D] transition-colors duration-300">
                                    </div>
                                </div>
                                <div id="strLabel" class="text-[10px] text-gray-400"></div>
                            </div>

                            <div class="mt-8 pt-6 border-t border-[#3D3D3D]">
                                <button type="submit"
                                    class="btn-gold px-8 py-3 rounded-xl text-sm tracking-wider uppercase flex items-center gap-2">
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none"
                                        stroke="currentColor" stroke-width="2">
                                        <rect x="3" y="11" width="18" height="11" rx="2"
                                            ry="2" />
                                        <path d="M7 11V7a5 5 0 0 1 10 0v4" />
                                    </svg>
                                    Ubah Password
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>

    <!-- Delete Photo Form (hidden) -->
    <form id="deleteFotoForm" method="POST" action="{{ route('user.profile.delete-foto') }}" class="hidden">
        @csrf
        @method('DELETE')
    </form>

    <x-footer />

    <script>
        // Tab switching
        function switchTab(tabName, btn) {
            document.querySelectorAll('.tab-panel').forEach(p => p.classList.remove('active'));
            document.querySelectorAll('.tab-btn').forEach(b => b.classList.remove('active'));

            document.getElementById(`tab-${tabName}`).classList.add('active');
            btn.classList.add('active');
        }

        // Avatar preview
        function previewAvatar(event) {
            const file = event.target.files[0];
            if (!file) return;

            const reader = new FileReader();
            reader.onload = function(e) {
                const preview = document.getElementById('avatarPreview');
                if (preview.tagName === 'IMG') {
                    preview.src = e.target.result;
                } else {
                    // Replace the initials div with an img
                    const img = document.createElement('img');
                    img.id = 'avatarPreview';
                    img.src = e.target.result;
                    img.className = 'w-full h-full object-cover';
                    img.alt = 'Preview';
                    preview.parentNode.replaceChild(img, preview);
                }
            };
            reader.readAsDataURL(file);

            // Show file info
            const info = document.getElementById('photoPreviewInfo');
            const fileName = document.getElementById('photoFileName');
            info.classList.remove('hidden');
            info.classList.add('flex');
            fileName.textContent = `Foto baru: ${file.name} (${(file.size / 1024).toFixed(1)} KB)`;
        }

        // Toggle password visibility
        function togglePassword(inputId, btn) {
            const input = document.getElementById(inputId);
            const eyeOpen = btn.querySelector('.eye-open');
            const eyeClosed = btn.querySelector('.eye-closed');

            if (input.type === 'password') {
                input.type = 'text';
                eyeOpen.classList.add('hidden');
                eyeClosed.classList.remove('hidden');
            } else {
                input.type = 'password';
                eyeOpen.classList.remove('hidden');
                eyeClosed.classList.add('hidden');
            }
        }

        // Password strength indicator
        const newPasswordInput = document.getElementById('newPassword');
        if (newPasswordInput) {
            newPasswordInput.addEventListener('input', function() {
                const val = this.value;
                let score = 0;

                if (val.length >= 8) score++;
                if (/[A-Z]/.test(val)) score++;
                if (/[0-9]/.test(val)) score++;
                if (/[^A-Za-z0-9]/.test(val)) score++;

                const colors = ['#3D3D3D', '#F87171', '#FBBF24', '#60A5FA', '#34D399'];
                const labels = ['', 'Lemah', 'Cukup', 'Kuat', 'Sangat Kuat'];

                for (let i = 1; i <= 4; i++) {
                    const bar = document.getElementById(`str${i}`);
                    bar.style.backgroundColor = i <= score ? colors[score] : '#3D3D3D';
                }

                document.getElementById('strLabel').textContent = val.length > 0 ? labels[score] : '';
            });
        }

        // Delete photo confirmation
        function confirmDeleteFoto() {
            if (confirm('Yakin ingin menghapus foto profil?')) {
                document.getElementById('deleteFotoForm').submit();
            }
        }

        const success = document.getElementById('success');
        if (success) {
            setTimeout(() => {
                success.classList.add('hide');
                setTimeout(() => success.remove(), 400);
            }, 4000);
        }

        // Show security tab if there are password errors
        @if ($errors->has('current_password') || $errors->has('password'))
            switchTab('security', document.querySelectorAll('.tab-btn')[1]);
        @endif
    </script>
</body>

</html>
