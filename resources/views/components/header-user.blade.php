<nav id="navbar"
    class="floating-bar fixed top-4 left-1/2 -translate-x-1/2 w-[95%] max-w-7xl z-50 bg-[#1E1E1E]/90 border border-[#3A3A3A] rounded-2xl shadow-lg backdrop-blur-md transition-transform duration-300">

    <div class="px-4 md:px-8">
        <div class="py-4 flex items-center justify-between">

            <!-- Logo -->
            <a href="{{ route('user.dashboard') }}" class="flex items-center gap-3">
                <img src="{{ asset('icons/mens.png') }}" alt="" width="50">
                <div>
                    <div class="text-sm font-bold tracking-[0.25em] text-[#C9A84C] leading-none">
                        MEN'S HAIR STUDIO
                    </div>

                    <div class="text-[10px] tracking-[0.35em] text-gray-400 mt-1">
                        BARBERSHOP
                    </div>
                </div>
            </a>

            <!-- Action Links -->
            <div class="flex items-center gap-4 md:gap-6 text-[#F0EDE8]">
                <a href="{{ route('user.booking.history') }}"
                    class="text-xs md:text-sm font-semibold flex items-center gap-2 hover:text-[#C9A84C] transition duration-300"
                    title="Riwayat Booking">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M12 8v4l3 3" />
                        <path d="M3.05 11a9 9 0 1 0 .5-4.5" />
                        <polyline points="1 7 3 9 5 7" />
                    </svg>
                    <span class="hidden sm:inline">Riwayat Booking</span>
                </a>
                <a href="{{ route('user.dashboard') }}"
                    class="text-xs md:text-sm font-semibold flex items-center gap-2 hover:text-[#C9A84C] transition duration-300"
                    title="Kembali ke Beranda">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="19" y1="12" x2="5" y2="12"></line>
                        <polyline points="12 19 5 12 12 5"></polyline>
                    </svg>
                    <span class="hidden sm:inline">Beranda</span>
                </a>
            </div>

        </div>
    </div>
</nav>

<script>
    let lastScrollTop = 0;
    const navbar = document.getElementById("navbar");

    window.addEventListener("scroll", function() {
        let scrollTop = window.pageYOffset || document.documentElement.scrollTop;

        if (scrollTop > lastScrollTop) {
            navbar.classList.add("-translate-y-[150%]");
        } else {
            navbar.classList.remove("-translate-y-[150%]");
        }

        lastScrollTop = scrollTop <= 0 ? 0 : scrollTop;
    });
</script>
