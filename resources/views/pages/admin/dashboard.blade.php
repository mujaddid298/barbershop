@extends('layouts.admin')

@section('title', 'Manajemen Antrean — Men\'s Hair Studio')

@section('content')
    <div class="flex-1 bg-[#161616] min-h-screen px-4 md:px-8 py-5 md:py-7 rounded-2xl">

        <!-- Header -->
        <div class="flex items-center justify-between mb-7">
            <div>
                <p class="text-[9px] tracking-[3px] uppercase text-[#555]">Manajemen</p>
                <h1 class="text-xl font-medium text-[#eee] mt-1">Antrean Hari Ini</h1>
            </div>
            <div>
                <a href="{{ route('live-antrian') }}" target="_blank"
                    class="inline-flex items-center gap-2 px-4 py-2 rounded-md border border-[rgba(201,168,76,0.25)] bg-[rgba(201,168,76,0.08)] hover:bg-[rgba(201,168,76,0.15)] text-[#C9A84C] text-xs font-semibold tracking-wider transition-colors duration-150">
                    <span class="w-1.5 h-1.5 rounded-full bg-red-500 animate-pulse"></span>
                    Buka Live Monitor
                </a>
            </div>
        </div>

        <!-- Success Alert -->
        @if (session('success'))
            <div
                class="mb-6 px-4 py-3 bg-emerald-500/10 border border-emerald-500/25 rounded-lg text-emerald-400 text-xs flex items-center justify-between">
                <div class="flex items-center gap-2">
                    <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <span>{{ session('success') }}</span>
                </div>
            </div>
        @endif

        <!-- Stats Grid -->
        <div class="grid grid-cols-2 sm:grid-cols-4 gap-3 mb-7 text-white">
            <div class="bg-[#222] border border-[#2E2E2E] rounded-lg px-4 py-3.5">
                <p class="text-[9px] tracking-[2px] uppercase text-[#888] mb-1.5">Menunggu</p>
                <p class="text-[22px] font-medium text-[#C9A84C]">{{ $waitingCount }}</p>
            </div>
            <div class="bg-[#222] border border-[#2E2E2E] rounded-lg px-4 py-3.5">
                <p class="text-[9px] tracking-[2px] uppercase text-[#888] mb-1.5">Sedang Dipangkas</p>
                <p class="text-[22px] font-medium text-[#7aaef5]">{{ $activeCount }}</p>
            </div>
            <div class="bg-[#222] border border-[#2E2E2E] rounded-lg px-4 py-3.5">
                <p class="text-[9px] tracking-[2px] uppercase text-[#888] mb-1.5">Selesai</p>
                <p class="text-[22px] font-medium text-emerald-500">{{ $completedCount }}</p>
            </div>
            <div class="bg-[#222] border border-[#2E2E2E] rounded-lg px-4 py-3.5">
                <p class="text-[9px] tracking-[2px] uppercase text-[#888] mb-1.5">Batal</p>
                <p class="text-[22px] font-medium text-red-500">{{ $canceledCount }}</p>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Queue Management Table -->
            <div class="lg:col-span-2 bg-[#222] border border-[#2E2E2E] rounded-lg p-5">
                <div class="flex items-center justify-between mb-4 pb-3 border-b border-[#2E2E2E]">
                    <h3 class="text-sm font-semibold tracking-wider text-[#ccc] uppercase">Daftar Antrean</h3>
                    <span class="text-[10px] text-gray-500">{{ date('d M Y') }}</span>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full border-collapse">
                        <thead>
                            <tr class="text-left border-b border-[#2E2E2E]">
                                <th class="text-[9px] tracking-[2px] uppercase font-normal text-[#888] pb-3 px-3">No.
                                    Antrean</th>
                                <th class="text-[9px] tracking-[2px] uppercase font-normal text-[#888] pb-3 px-3">Pelanggan
                                </th>
                                <th class="text-[9px] tracking-[2px] uppercase font-normal text-[#888] pb-3 px-3">Layanan
                                </th>
                                <th class="text-[9px] tracking-[2px] uppercase font-normal text-[#888] pb-3 px-3">Barber
                                </th>
                                <th class="text-[9px] tracking-[2px] uppercase font-normal text-[#888] pb-3 px-3">Jam
                                    Booking</th>
                                <th class="text-[9px] tracking-[2px] uppercase font-normal text-[#888] pb-3 px-3">Status
                                </th>
                                <th
                                    class="text-[9px] tracking-[2px] uppercase font-normal text-[#888] pb-3 px-3 text-right">
                                    Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-[#2a2a2a]">
                            @forelse ($queues as $queue)
                                <tr class="group hover:bg-white/[0.01] transition-colors duration-100">
                                    <!-- Queue Number -->
                                    <td class="px-3 py-3.5 font-serif font-extrabold text-[#C9A84C] text-lg">
                                        #{{ sprintf('%02d', $queue->nomor_antrian) }}
                                    </td>

                                    <!-- Customer Details -->
                                    <td class="px-3 py-3.5">
                                        <div class="text-[13px] text-[#ddd] font-semibold">{{ $queue->nama_customer }}</div>
                                        <div class="text-[10px] text-gray-500 mt-0.5 uppercase tracking-wider font-mono">
                                            @if ($queue->tipe === 'online')
                                                <span class="text-emerald-500">online</span>
                                            @else
                                                <span class="text-amber-500">offline</span>
                                            @endif
                                        </div>
                                    </td>

                                    <!-- Service -->
                                    <td class="px-3 py-3.5">
                                        <span class="text-xs text-gray-300">
                                            {{ $queue->booking && $queue->booking->layanan ? $queue->booking->layanan->nama : ($queue->layanan ? $queue->layanan->nama : 'Pangkas Rambut') }}
                                        </span>
                                        <span class="text-[10px] text-gray-500 block mt-0.5">{{ $queue->durasi }}
                                            Menit</span>
                                    </td>

                                    <!-- Barber -->
                                    <td class="px-3 py-3.5 text-xs text-gray-300">
                                        {{ $queue->barber ? $queue->barber->nama : '-' }}
                                    </td>

                                    <!-- Schedule -->
                                    <td class="px-3 py-3.5 text-xs font-mono text-gray-400">
                                        {{ $queue->booking ? \Carbon\Carbon::createFromFormat('H:i:s', $queue->booking->jam)->format('H:i') : '-' }}
                                        WIB
                                    </td>

                                    <!-- Status Badge -->
                                    <td class="px-3 py-3.5">
                                        @if ($queue->status === 'waiting')
                                            <span
                                                class="inline-flex px-2.5 py-0.5 rounded-full text-[9px] tracking-wider uppercase bg-amber-500/10 border border-amber-500/20 text-amber-500 font-bold">
                                                Menunggu
                                            </span>
                                        @elseif ($queue->status === 'dipanggil')
                                            <span
                                                class="inline-flex px-2.5 py-0.5 rounded-full text-[9px] tracking-wider uppercase bg-blue-500/10 border border-blue-500/20 text-blue-500 font-bold animate-pulse">
                                                Dipotong
                                            </span>
                                        @elseif ($queue->status === 'selesai')
                                            <span
                                                class="inline-flex px-2.5 py-0.5 rounded-full text-[9px] tracking-wider uppercase bg-emerald-500/10 border border-emerald-500/20 text-emerald-500 font-bold">
                                                Selesai
                                            </span>
                                        @elseif ($queue->status === 'batal')
                                            <span
                                                class="inline-flex px-2.5 py-0.5 rounded-full text-[9px] tracking-wider uppercase bg-red-500/10 border border-red-500/20 text-red-500 font-bold">
                                                Batal
                                            </span>
                                        @endif
                                    </td>

                                    <!-- Actions -->
                                    <td class="px-3 py-3.5 text-right whitespace-nowrap">
                                        @if ($queue->status === 'waiting')
                                            <!-- Call / Start cutting -->
                                            <form method="POST"
                                                action="{{ route('admin.antrian.update-status', $queue->id) }}"
                                                class="inline">
                                                @csrf
                                                <input type="hidden" name="status" value="dipanggil">
                                                <button type="submit"
                                                    class="inline-flex px-3 py-1 rounded text-[10px] bg-blue-500/10 text-blue-400 border border-blue-500/25 hover:bg-blue-500/20 hover:text-white transition-colors duration-150 cursor-pointer">
                                                    Mulai Pangkas
                                                </button>
                                            </form>

                                            <!-- Cancel -->
                                            <form method="POST"
                                                action="{{ route('admin.antrian.update-status', $queue->id) }}"
                                                class="inline ml-1">
                                                @csrf
                                                <input type="hidden" name="status" value="batal">
                                                <button type="submit" onclick="return confirm('Batalkan antrean ini?')"
                                                    class="inline-flex px-3 py-1 rounded text-[10px] bg-red-500/10 text-red-400 border border-red-500/25 hover:bg-red-500/20 hover:text-white transition-colors duration-150 cursor-pointer">
                                                    Batal
                                                </button>
                                            </form>
                                        @elseif ($queue->status === 'dipanggil')
                                            <!-- Mark Complete -->
                                            <form method="POST"
                                                action="{{ route('admin.antrian.update-status', $queue->id) }}"
                                                class="inline">
                                                @csrf
                                                <input type="hidden" name="status" value="selesai">
                                                <button type="submit"
                                                    class="inline-flex px-3 py-1 rounded text-[10px] bg-emerald-500/10 text-emerald-400 border border-emerald-500/25 hover:bg-emerald-500/20 hover:text-white transition-colors duration-150 cursor-pointer">
                                                    Selesai
                                                </button>
                                            </form>

                                            <!-- Cancel -->
                                            <form method="POST"
                                                action="{{ route('admin.antrian.update-status', $queue->id) }}"
                                                class="inline ml-1">
                                                @csrf
                                                <input type="hidden" name="status" value="batal">
                                                <button type="submit" onclick="return confirm('Batalkan antrean ini?')"
                                                    class="inline-flex px-3 py-1 rounded text-[10px] bg-red-500/10 text-red-400 border border-red-500/25 hover:bg-red-500/20 hover:text-white transition-colors duration-150 cursor-pointer">
                                                    Batal
                                                </button>
                                            </form>
                                        @else
                                            <span class="text-[10px] text-gray-600 italic">Tidak ada aksi</span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="py-10 text-center text-gray-500 text-xs italic">
                                        Belum ada antrean masuk untuk hari ini.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Form Input Pelanggan Offline -->
            <div class="lg:col-span-1 bg-[#222] border border-[#2E2E2E] rounded-lg p-5 h-fit">
                <div class="flex items-center justify-between mb-4 pb-3 border-b border-[#2E2E2E]">
                    <h3 class="text-sm font-semibold tracking-wider text-[#ccc] uppercase">Input Pelanggan Offline</h3>
                </div>

                <!-- Validation Errors -->
                @if ($errors->any())
                    <div class="mb-4 p-3 bg-red-500/10 border border-red-500/25 rounded-lg text-red-400 text-xs">
                        <ul class="list-disc pl-4 space-y-1">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('admin.antrian.offline.store') }}" class="space-y-4">
                    @csrf

                    <!-- Nama Customer -->
                    <div>
                        <label for="nama_customer"
                            class="block text-[10px] uppercase tracking-wider text-gray-400 mb-1.5 font-medium">Nama
                            Pelanggan</label>
                        <input type="text" name="nama_customer" id="nama_customer"
                            placeholder="Masukkan nama pelanggan" value="{{ old('nama_customer') }}"
                            class="w-full bg-[#1A1A1A] border border-[#2E2E2E] rounded-lg px-3.5 py-2.5 text-xs text-white placeholder-gray-600 focus:outline-none focus:border-[#C9A84C] focus:ring-1 focus:ring-[#C9A84C]/25 transition duration-150"
                            required>
                    </div>

                    <!-- Pilihan Barber -->
                    <div>
                        <label for="barber_id"
                            class="block text-[10px] uppercase tracking-wider text-gray-400 mb-1.5 font-medium">Barber</label>
                        <select name="barber_id" id="barber_id"
                            class="w-full bg-[#1A1A1A] border border-[#2E2E2E] rounded-lg px-3.5 py-2.5 text-xs text-white focus:outline-none focus:border-[#C9A84C] focus:ring-1 focus:ring-[#C9A84C]/25 transition duration-150"
                            required>
                            <option value="" disabled selected>Pilih Barber</option>
                            @foreach ($barbers as $barber)
                                <option value="{{ $barber->id }}"
                                    {{ old('barber_id') == $barber->id ? 'selected' : '' }}>
                                    {{ $barber->nama }} ({{ $barber->keahlian }})
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Pilihan Layanan -->
                    <div>
                        <label for="layanan_id"
                            class="block text-[10px] uppercase tracking-wider text-gray-400 mb-1.5 font-medium">Layanan</label>
                        <select name="layanan_id" id="layanan_id"
                            class="w-full bg-[#1A1A1A] border border-[#2E2E2E] rounded-lg px-3.5 py-2.5 text-xs text-white focus:outline-none focus:border-[#C9A84C] focus:ring-1 focus:ring-[#C9A84C]/25 transition duration-150"
                            required>
                            <option value="" disabled selected>Pilih Layanan</option>
                            @foreach ($layanans as $layanan)
                                <option value="{{ $layanan->id }}"
                                    {{ old('layanan_id') == $layanan->id ? 'selected' : '' }}>
                                    {{ $layanan->nama }} (Rp {{ number_format($layanan->harga, 0, ',', '.') }} ·
                                    {{ $layanan->durasi }} Mins)
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Submit Button -->
                    <button type="submit"
                        class="w-full bg-[#C9A84C] hover:bg-[#E2C97E] active:scale-[0.98] text-black font-semibold text-xs tracking-widest uppercase py-3 rounded-lg transition-all duration-150 cursor-pointer mt-2 flex items-center justify-center gap-1.5">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"></path>
                        </svg>
                        Tambah Antrean
                    </button>
                </form>
            </div>
        </div>

        <!-- Row 4: Financial Charts & Summary -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mt-6">
            <!-- Income Graph -->
            <div class="lg:col-span-2 bg-[#222] border border-[#2E2E2E] rounded-lg p-5">
                <div class="flex items-center justify-between mb-4 pb-3 border-b border-[#2E2E2E]">
                    <h3 class="text-sm font-semibold tracking-wider text-[#ccc] uppercase">Grafik Pendapatan (30 Hari Terakhir)</h3>
                    <span class="text-[10px] text-gray-500">Online & Offline</span>
                </div>
                <div class="relative w-full h-[300px]">
                    <canvas id="incomeChart"></canvas>
                </div>
            </div>

            <!-- Recent Transactions Table -->
            <div class="lg:col-span-1 bg-[#222] border border-[#2E2E2E] rounded-lg p-5 flex flex-col justify-between">
                <div>
                    <div class="flex items-center justify-between mb-4 pb-3 border-b border-[#2E2E2E]">
                        <h3 class="text-sm font-semibold tracking-wider text-[#ccc] uppercase">Transaksi Selesai Terbaru</h3>
                    </div>
                    <div class="space-y-3.5">
                        @forelse ($recentTransactions as $tx)
                            <div class="flex items-center justify-between text-xs py-1.5 border-b border-[#2a2a2a] last:border-0">
                                <div>
                                    <div class="font-semibold text-gray-200">{{ $tx->customer_name }}</div>
                                    <div class="text-[10px] text-gray-500 mt-0.5">{{ $tx->service_name }} · {{ $tx->date }}</div>
                                </div>
                                <div class="text-right">
                                    <div class="font-bold font-mono text-emerald-400">Rp {{ number_format($tx->net_amount, 0, ',', '.') }}</div>
                                    <span class="text-[9px] tracking-wider uppercase px-1.5 py-0.5 rounded font-mono font-bold inline-block mt-0.5 {{ $tx->type === 'Online' ? 'bg-blue-500/10 text-[#7aaef5]' : 'bg-amber-500/10 text-amber-500' }}">
                                        {{ $tx->type }}
                                    </span>
                                </div>
                            </div>
                        @empty
                            <div class="text-center text-gray-500 text-xs italic py-10">Belum ada transaksi selesai.</div>
                        @endforelse
                    </div>
                </div>
                <div class="pt-4 mt-4 border-t border-[#2E2E2E]">
                    <a href="{{ route('admin.finance.index') }}" class="block text-center text-xs font-semibold uppercase tracking-wider text-[#C9A84C] hover:text-[#E2C97E] transition-colors duration-150">
                        Lihat Laporan Lengkap →
                    </a>
                </div>
            </div>
        </div>

    </div>

    <!-- Chart.js Script -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const canvas = document.getElementById('incomeChart');
            if (!canvas) return;
            const ctx = canvas.getContext('2d');
            
            // Generate chart gradient
            const gradient = ctx.createLinearGradient(0, 0, 0, 300);
            gradient.addColorStop(0, 'rgba(201, 168, 76, 0.4)');
            gradient.addColorStop(1, 'rgba(201, 168, 76, 0.0)');

            const labels = @json($chartLabels);
            const data = @json($chartData);

            new Chart(ctx, {
                type: 'line',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Pendapatan Harian',
                        data: data,
                        borderColor: '#C9A84C',
                        borderWidth: 2,
                        backgroundColor: gradient,
                        fill: true,
                        tension: 0.3,
                        pointBackgroundColor: '#C9A84C',
                        pointBorderColor: '#161616',
                        pointHoverRadius: 6,
                        pointHoverBackgroundColor: '#E2C97E'
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false
                        },
                        tooltip: {
                            backgroundColor: '#222',
                            titleColor: '#fff',
                            bodyColor: '#ccc',
                            borderColor: '#2E2E2E',
                            borderWidth: 1,
                            callbacks: {
                                label: function(context) {
                                    return 'Pendapatan: Rp ' + context.raw.toLocaleString('id-ID');
                                }
                            }
                        }
                    },
                    scales: {
                        x: {
                            grid: {
                                color: 'rgba(255, 255, 255, 0.05)',
                                borderColor: '#2E2E2E'
                            },
                            ticks: {
                                color: '#888',
                                font: {
                                    size: 10
                                }
                            }
                        },
                        y: {
                            grid: {
                                color: 'rgba(255, 255, 255, 0.05)',
                                borderColor: '#2E2E2E'
                            },
                            ticks: {
                                color: '#888',
                                font: {
                                    size: 10
                                },
                                callback: function(value) {
                                    if (value >= 1000000) {
                                        return (value / 1000000) + 'jt';
                                    } else if (value >= 1000) {
                                        return (value / 1000) + 'k';
                                    }
                                    return value;
                                }
                            }
                        }
                    }
                }
            });
        });
    </script>
@endsection
