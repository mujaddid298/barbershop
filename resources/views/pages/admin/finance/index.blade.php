@extends('layouts.admin')

@section('title', 'Laporan Keuangan — Men\'s Hair Studio')

@section('content')
    <div class="flex-1 bg-[#161616] min-h-screen px-4 md:px-8 py-5 md:py-7 rounded-2xl">

        <!-- Header -->
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-7">
            <div>
                <p class="text-[9px] tracking-[3px] uppercase text-[#888]">Laporan & Analisis</p>
                <h1 class="text-xl font-medium text-[#eee] mt-1">Keuangan Studio</h1>
            </div>

            <!-- Filters & Export -->
            <div class="flex flex-wrap items-center gap-3">
                <form method="GET" action="{{ route('admin.finance.index') }}" id="filterForm"
                    class="flex items-center gap-2">
                    <select name="period" onchange="document.getElementById('filterForm').submit()"
                        class="bg-[#222] border border-[#2E2E2E] rounded-md px-3 py-2 text-[12px] text-white focus:outline-none focus:border-[#C9A84C]/50 cursor-pointer">
                        @foreach ($availableMonths as $month)
                            <option value="{{ $month['value'] }}"
                                {{ $selectedPeriod == $month['value'] ? 'selected' : '' }}>
                                {{ $month['label'] }}
                            </option>
                        @endforeach
                    </select>
                </form>

                <a href="{{ route('admin.finance.export', ['period' => $selectedPeriod]) }}"
                    class="inline-flex items-center gap-2 px-4 py-2 rounded-md border border-[rgba(201,168,76,0.25)] bg-[rgba(201,168,76,0.08)] hover:bg-[rgba(201,168,76,0.15)] text-[#C9A84C] text-[12px] font-semibold tracking-wider transition-colors duration-150 cursor-pointer">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                    </svg>
                    Ekspor CSV / Excel
                </a>
            </div>
        </div>

        <!-- Stats Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-7 text-white">
            <div class="bg-[#222] border border-[#2E2E2E] rounded-lg px-5 py-4">
                <p class="text-[9px] tracking-[2px] uppercase text-[#888] mb-1.5">Pendapatan Bersih</p>
                <p class="text-2xl  font-bold"
                    style="background: linear-gradient(135deg,#C9A84C,#E2C97E); -webkit-background-clip:text; -webkit-text-fill-color:transparent; background-clip:text;">
                    Rp {{ number_format($totalIncome, 0, ',', '.') }}
                </p>
                <span class="text-[10px] text-gray-500 block mt-1">Total seluruh pemasukan bersih</span>
            </div>
            <div class="bg-[#222] border border-[#2E2E2E] rounded-lg px-5 py-4">
                <p class="text-[9px] tracking-[2px] uppercase text-[#888] mb-1.5">Pendapatan Online</p>
                <p class="text-2xl  font-bold text-[#7aaef5]">
                    Rp {{ number_format($onlineIncome, 0, ',', '.') }}
                </p>
                <span class="text-[10px] text-gray-500 block mt-1">booking online</span>
            </div>
            <div class="bg-[#222] border border-[#2E2E2E] rounded-lg px-5 py-4">
                <p class="text-[9px] tracking-[2px] uppercase text-[#888] mb-1.5">Pendapatan Offline</p>
                <p class="text-2xl  font-bold text-amber-500">
                    Rp {{ number_format($offlineIncome, 0, ',', '.') }}
                </p>
                <span class="text-[10px] text-gray-500 block mt-1">Booking Offline</span>
            </div>
            <div class="bg-[#222] border border-[#2E2E2E] rounded-lg px-5 py-4">
                <p class="text-[9px] tracking-[2px] uppercase text-[#888] mb-1.5">Diskon & Transaksi</p>
                <p class="text-2xl  font-bold text-red-400">
                    Rp {{ number_format($totalDiscount, 0, ',', '.') }}
                </p>
                <span class="text-[10px] text-gray-500 block mt-1">Dari {{ $totalTransactions }} total transaksi</span>
            </div>
        </div>

        <!-- Transactions Table Card -->
        <div class="bg-[#222] border border-[#2E2E2E] rounded-lg p-5">
            <div class="flex items-center justify-between mb-5 pb-3 border-b border-[#2E2E2E]">
                <h3 class="text-sm font-semibold tracking-wider text-[#ccc] uppercase">Transaksi Keuangan</h3>
                <span class="text-[10px] text-gray-500">Periode: {{ $selectedPeriod }}</span>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full border-collapse">
                    <thead>
                        <tr class="text-left border-b border-[#2E2E2E]">
                            <th class="text-[9px] tracking-[2px] uppercase font-normal text-[#888] pb-3 px-3">No</th>
                            <th class="text-[9px] tracking-[2px] uppercase font-normal text-[#888] pb-3 px-3">Tanggal</th>
                            <th class="text-[9px] tracking-[2px] uppercase font-normal text-[#888] pb-3 px-3">Tipe</th>
                            <th class="text-[9px] tracking-[2px] uppercase font-normal text-[#888] pb-3 px-3">Pelanggan</th>
                            <th class="text-[9px] tracking-[2px] uppercase font-normal text-[#888] pb-3 px-3">Barber</th>
                            <th class="text-[9px] tracking-[2px] uppercase font-normal text-[#888] pb-3 px-3">Layanan</th>
                            <th class="text-[9px] tracking-[2px] uppercase font-normal text-[#888] pb-3 px-3 text-right">
                                Harga Asli</th>
                            <th class="text-[9px] tracking-[2px] uppercase font-normal text-[#888] pb-3 px-3 text-right">
                                Diskon</th>
                            <th class="text-[9px] tracking-[2px] uppercase font-normal text-[#888] pb-3 px-3 text-right">
                                Bersih</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-[#2a2a2a]">
                        @forelse ($records as $index => $row)
                            <tr class="group hover:bg-white/[0.01] transition-colors duration-100 text-[13px]">
                                <!-- Number -->
                                <td class="px-3 py-3.5 text-gray-500 font-mono">
                                    {{ $index + 1 }}
                                </td>

                                <!-- Date -->
                                <td class="px-3 py-3.5 text-gray-300">
                                    {{ \Carbon\Carbon::parse($row->date)->format('d M Y') }}
                                </td>

                                <!-- Type -->
                                <td class="px-3 py-3.5">
                                    @if ($row->type === 'Online')
                                        <span
                                            class="inline-flex px-2 py-0.5 rounded text-[10px] tracking-wider uppercase bg-blue-500/10 border border-blue-500/20 text-[#7aaef5] font-bold">
                                            Online
                                        </span>
                                    @else
                                        <span
                                            class="inline-flex px-2 py-0.5 rounded text-[10px] tracking-wider uppercase bg-amber-500/10 border border-amber-500/20 text-amber-500 font-bold">
                                            Offline
                                        </span>
                                    @endif
                                </td>

                                <!-- Customer -->
                                <td class="px-3 py-3.5 font-semibold text-[#ddd]">
                                    {{ $row->customer_name }}
                                </td>

                                <!-- Barber -->
                                <td class="px-3 py-3.5 text-gray-300">
                                    {{ $row->barber_name }}
                                </td>

                                <!-- Service -->
                                <td class="px-3 py-3.5 text-gray-300">
                                    {{ $row->service_name }}
                                </td>

                                <!-- Price -->
                                <td class="px-3 py-3.5 text-right font-mono text-gray-400">
                                    Rp {{ number_format($row->amount, 0, ',', '.') }}
                                </td>

                                <!-- Discount -->
                                <td class="px-3 py-3.5 text-right font-mono text-red-400">
                                    {{ $row->discount > 0 ? '-Rp ' . number_format($row->discount, 0, ',', '.') : '-' }}
                                </td>

                                <!-- Net -->
                                <td class="px-3 py-3.5 text-right font-mono text-emerald-400 font-semibold">
                                    Rp {{ number_format($row->net_amount, 0, ',', '.') }}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="9" class="py-12 text-center text-gray-500 text-xs italic">
                                    Belum ada catatan keuangan pada periode ini.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>
@endsection
