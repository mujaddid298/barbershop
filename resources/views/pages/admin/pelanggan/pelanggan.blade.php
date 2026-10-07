@extends('layouts.admin')

@section('title', 'dashboard — Men\'s Hair Studio')

@section('content')


    <div class="flex-1 bg-[#161616] min-h-screen px-4 md:px-8 py-5 md:py-7 rounded-2xl">

        <div class="flex items-center justify-between mb-7">
            <div>
                <p class="text-[9px] tracking-[3px] uppercase text-white">Manajemen</p>
                <h1 class="text-xl font-medium text-[#eee] mt-1">Pengguna</h1>
            </div>

        </div>

        {{-- Stats --}}
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-3 mb-7 text-white">
            <div class="bg-[#222] border border-[#2E2E2E] rounded-lg px-4 py-3.5">
                <p class="text-[9px] tracking-[2px] uppercase  mb-1.5">Total Pengguna</p>
                <p class="text-[22px] font-medium"
                    style="background: linear-gradient(135deg,#C9A84C,#E2C97E); -webkit-background-clip:text; -webkit-text-fill-color:transparent; background-clip:text;">
                    {{ $users->count() }}
                </p>
            </div>
            <div class="bg-[#222] border border-[#2E2E2E] rounded-lg px-4 py-3.5">
                <p class="text-[9px] tracking-[2px] uppercase mb-1.5">Admin</p>
                <p class="text-[22px] font-medium text-[#C9A84C]">{{ $admins->count() }}</p>
            </div>
            <div class="bg-[#222] border border-[#2E2E2E] rounded-lg px-4 py-3.5">
                <p class="text-[9px] tracking-[2px] uppercase mb-1.5">User</p>
                <p class="text-[22px] font-medium text-[#7aaef5]">{{ $regularUsers->count() }}</p>
            </div>
        </div>

        {{-- Search & Filter --}}
        <div class="flex flex-col sm:flex-row gap-3 mb-6">
            <input type="text" placeholder="Cari nama atau email..."
                class="flex-1 bg-[#222] border border-[#2E2E2E] rounded-md px-4 py-2 text-[12px] text-[#ccc] placeholder-[#555] focus:outline-none focus:border-[rgba(201,168,76,0.4)] transition-colors duration-150" />
            <select
                class="bg-[#222] border border-[#2E2E2E] rounded-md px-3 py-2 text-[11px] text-white focus:outline-none cursor-pointer">
                <option value="">Semua Role</option>
                <option value="admin">Admin</option>
                <option value="user">User</option>
            </select>

            <a href="{{ route('admin.users.create') }}"
                class="flex items-center gap-2 px-4 py-2 rounded-md border transition-colors duration-150"
                style="background: rgba(201,168,76,0.08); border-color: rgba(201,168,76,0.25);">
                <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="#C9A84C" stroke-width="2">
                    <line x1="12" y1="5" x2="12" y2="19" />
                    <line x1="5" y1="12" x2="19" y2="12" />
                </svg>
                <span class="text-[12px] font-medium"
                    style="background: linear-gradient(135deg,#C9A84C,#E2C97E,#C9A84C);
                            -webkit-background-clip:text; -webkit-text-fill-color:transparent; background-clip:text;">
                    Tambah User
                </span>
            </a>
        </div>

        @if ($admins->isNotEmpty())
            <div class="flex items-center gap-3 mb-3">
                <p class="text-[9px] tracking-[3px] uppercase ">Administrator</p>
                <div class="flex-1 border-t border-[#2E2E2E]"></div>
            </div>

            <div class="overflow-x-auto mb-7">
                <table class="w-full border-collapse">
                    <thead>
                        <tr>
                            <th
                                class="text-[9px] tracking-[2px] uppercase font-normal text-left px-3 pb-2.5 border-b border-[#2E2E2E]">
                                Pengguna</th>
                            <th
                                class="text-[9px] tracking-[2px] uppercase font-normal text-left px-3 pb-2.5 border-b border-[#2E2E2E]">
                                Nomer telepon</th>
                            <th
                                class="text-[9px] tracking-[2px] uppercase font-normal text-left px-3 pb-2.5 border-b border-[#2E2E2E]">
                                Role</th>
                            <th
                                class="text-[9px] tracking-[2px] uppercase font-normal text-left px-3 pb-2.5 border-b border-[#2E2E2E]">
                                Status</th>
                            <th
                                class="text-[9px] tracking-[2px] uppercase font-normal text-left px-3 pb-2.5 border-b border-[#2E2E2E]">
                                Bergabung</th>
                            <th class="border-b border-[#2E2E2E]"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($admins as $user)
                            <tr class="group hover:bg-white/[0.02] transition-colors duration-100">
                                <td class="px-3 py-3 border-b border-[#222]">
                                    <div class="flex items-center gap-2.5">
                                        <div class="w-[30px] h-[30px] rounded-full flex items-center justify-center text-[11px] font-medium text-[#111] flex-shrink-0"
                                            style="background: linear-gradient(135deg,#B8942A,#C9A84C);">
                                            {{ strtoupper(substr($user->name, 0, 1)) }}
                                        </div>
                                        <div>
                                            <span class="text-[13px] text-[#ddd] block">{{ $user->name }}</span>
                                            <span class="text-[10px] block mt-0.5">{{ $user->email }}</span>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-3 py-3 border-b border-[#222] text-[11px] text-white">
                                    {{ $user->nohp ?: 'belum diisi' }}s
                                </td>
                                <td class="px-3 py-3 border-b border-[#222]">
                                    <span
                                        class="inline-flex items-center px-2.5 py-1 rounded text-[10px] tracking-widest uppercase"
                                        style="background:rgba(201,168,76,0.12); color:#C9A84C; border:0.5px solid rgba(201,168,76,0.3);">
                                        Admin
                                    </span>
                                </td>
                                <td class="px-3 py-3 border-b border-[#222]">
                                    <span
                                        class="inline-flex items-center px-2.5 py-1 rounded text-[10px] tracking-widest uppercase
                                        {{ $user->status == 'aktif'
                                            ? 'bg-green-500/20 text-green-400 border border-green-500/30'
                                            : 'bg-gray-500/20 text-gray-400 border border-gray-500/30' }}">
                                        {{ $user->status }}
                                    </span>
                                </td>
                                <td class="px-3 py-3 border-b border-[#222] text-[11px] text-white">
                                    {{ $user->created_at->format('d M Y') }}
                                </td>
                                <td class="px-3 py-3 border-b border-[#222] text-right">
                                    <a href="{{ route('admin.users.edit', $user) }}"
                                        class="inline-flex px-2.5 py-1 rounded text-[10px] text-white border border-[#2E2E2E] hover:border-[rgba(201,168,76,0.35)] hover:text-[#C9A84C] transition-colors duration-150 ml-1">
                                        Edit
                                    </a>
                                    <form method="POST" action="{{ route('admin.users.destroy', $user) }}" class="inline">
                                        @csrf @method('DELETE')
                                        <button type="submit" onclick="return confirm('Hapus pengguna ini?')"
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
        @endif

        {{-- ── User Section ── --}}
        @if ($regularUsers->isNotEmpty())
            <div class="flex items-center gap-3 mb-3">
                <p class="text-[9px] tracking-[3px] uppercase ">User</p>
                <div class="flex-1 border-t border-[#2E2E2E]"></div>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full border-collapse">
                    <thead>
                        <tr>
                            <th
                                class="text-[9px] tracking-[2px] uppercase font-normal text-left px-3 pb-2.5 border-b border-[#2E2E2E]">
                                Pengguna</th>
                            <th
                                class="text-[9px] tracking-[2px] uppercase font-normal text-left px-3 pb-2.5 border-b border-[#2E2E2E]">
                                Nomer telepon</th>
                            <th
                                class="text-[9px] tracking-[2px] uppercase font-normal text-left px-3 pb-2.5 border-b border-[#2E2E2E]">
                                Role</th>
                            <th
                                class="text-[9px] tracking-[2px] uppercase font-normal text-left px-3 pb-2.5 border-b border-[#2E2E2E]">
                                Status</th>
                            <th
                                class="text-[9px] tracking-[2px] uppercase font-normal text-left px-3 pb-2.5 border-b border-[#2E2E2E]">
                                Bergabung</th>
                            <th class="border-b border-[#2E2E2E]"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($regularUsers as $user)
                            <tr class="group hover:bg-white/[0.02] transition-colors duration-100">
                                <td class="px-3 py-3 border-b border-[#222]">
                                    <div class="flex items-center gap-2.5">
                                        <div class="w-[30px] h-[30px] rounded-full flex items-center justify-center text-[11px] font-medium flex-shrink-0"
                                            style="background:rgba(58,92,160,0.25); color:#7aaef5;">
                                            {{ strtoupper(substr($user->name, 0, 1)) }}
                                        </div>
                                        <div>
                                            <span class="text-[13px] text-[#ddd] block">{{ $user->name }}</span>
                                            <span class="text-[10px] block mt-0.5">{{ $user->email }}</span>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-3 py-3 border-b border-[#222] text-[11px] text-white">
                                    {{ $user->nohp ?: 'belum diisi' }}
                                </td>
                                <td class="px-3 py-3 border-b border-[#222]">
                                    <span
                                        class="inline-flex items-center px-2.5 py-1 rounded text-[10px] tracking-widest uppercase"
                                        style="background:rgba(58,92,160,0.15); color:#7aaef5; border:0.5px solid rgba(58,92,160,0.35);">
                                        User
                                    </span>
                                </td>
                                <td class="px-3 py-3 border-b border-[#222]">
                                    <span
                                        class="inline-flex items-center px-2.5 py-1 rounded text-[10px] tracking-widest uppercase
                                        {{ $user->status == 'aktif'
                                            ? 'bg-green-500/20 text-green-400 border border-green-500/30'
                                            : 'bg-gray-500/20 text-gray-400 border border-gray-500/30' }}">
                                        {{ $user->status }}
                                    </span>
                                </td>
                                <td class="px-3 py-3 border-b border-[#222] text-[11px] text-white">
                                    {{ $user->created_at->format('d M Y') }}
                                </td>
                                <td class="px-3 py-3 border-b border-[#222] text-right">
                                    <a href="{{ route('admin.users.edit', $user) }}"
                                        class="inline-flex px-2.5 py-1 rounded text-[10px] text-[#888] border border-[#2E2E2E] hover:border-[rgba(201,168,76,0.35)] hover:text-[#C9A84C] transition-colors duration-150 ml-1">
                                        Edit
                                    </a>
                                    <form method="POST" action="{{ route('admin.users.destroy', $user) }}" class="inline">
                                        @csrf @method('DELETE')
                                        <button type="submit" onclick="return confirm('Hapus pengguna ini?')"
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
        @endif

    </div>



@endsection
