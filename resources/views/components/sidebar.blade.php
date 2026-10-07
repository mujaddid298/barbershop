@props(['user', 'menus'])

<style>
    @keyframes barber-scroll {
        from {
            background-position: 0 0;
        }

        to {
            background-position: 0 36px;
        }
    }
</style>

<aside id="sidebar-container" class="fixed inset-y-0 left-0 z-50 w-[230px] min-w-[230px] bg-[#C9A84C] border-r border-[#2E2E2E] flex flex-col min-h-screen transition-transform duration-300 -translate-x-full md:translate-x-0 md:static">

    {{-- Logo --}}
    <div class="flex items-center gap-3 px-5 py-6 border-b border-[#2E2E2E]">
        <div class="w-1 h-7 rounded-sm flex-shrink-0"
            style="background: repeating-linear-gradient(-45deg, #CC2B2B 0px, #CC2B2B 6px, #fff 6px, #fff 12px, #1A4FA0 12px, #1A4FA0 18px);
                    animation: barber-scroll 2.5s linear infinite;">
        </div>
        <div>
            <span class="font-display text-[13px] font-bold block leading-tight"
                style="background: linear-gradient(135deg, #2E2E2E, #2E2E2E, #2E2E2E);
                         -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;">
                Men's Hair Studio
            </span>
            <span class="text-[9px] tracking-[3px] uppercase block mt-0.5 opacity-60"
                style="background: linear-gradient(135deg, #2E2E2E, #2E2E2E, #2E2E2E);
                         -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;">
                Barbershop
            </span>
        </div>
    </div>

    {{-- Navigation --}}
    <nav class="flex-1 flex flex-col gap-0.5 px-2.5 py-4">

        @foreach ($menus as $menu)
            @if (isset($menu['header']))
                <p class="text-[9px] tracking-[2.5px] uppercase text-black px-2.5 pt-2.5 pb-1.5 mt-1.5">
                    {{ $menu['header'] }}
                </p>
                @continue
            @endif

            @if (isset($menu['divider']))
                <hr class="border-none border-t border-[#B89235] mx-2.5 my-2.5" />
                @continue
            @endif

            @php $active = request()->routeIs($menu['route'] . '*'); @endphp

            <a href="{{ route($menu['route']) }}"
                class="flex items-center gap-2.5 px-2.5 py-[9px] rounded-md no-underline transition-all duration-200
                {{ $active ? 'bg-[#B89235] text-[#B89235] shadow-sm' : 'hover:bg-[#B89235] hover:text-[#111]' }}">

                <span class="w-4 h-4 flex-shrink-0 {{ $active ? 'text-white' : 'text-[#B89235]' }}">
                    {!! $menu['icon'] !!}
                </span>

                @if ($active)
                    <span class="text-[13px] font-medium"
                        style="background: linear-gradient(135deg,#2E2E2E,#2E2E2E,#2E2E2E);
                                -webkit-background-clip:text; -webkit-text-fill-color:transparent; background-clip:text;">
                        {{ $menu['title'] }}
                    </span>
                @else
                    <span class="text-[13px] text-[#2E2E2E]">{{ $menu['title'] }}</span>
                @endif

                @if (!empty($menu['badge']))
                    <span
                        class="ml-auto bg-[rgba(201,168,76,0.15)] text-black text-[10px] font-medium px-1.5 py-0.5 rounded-sm tracking-wide">
                        {{ $menu['badge'] }}
                    </span>
                @endif

            </a>
        @endforeach

    </nav>

    <div class="flex items-center gap-2.5 px-3.5 py-3.5 border-t border-[#B89235]">
        <div class="w-8 h-8 rounded-full flex items-center justify-center text-xs font-medium text-[#111] flex-shrink-0"
            style="background: linear-gradient(135deg, #B89235, #B89235);">
            {{ strtoupper(substr($user->name, 0, 1)) }}
        </div>
        <div class="flex-1 min-w-0">
            <p class="text-xs text-black font-medium truncate">{{ $user->name }}</p>
            <p class="text-[10px] text-[#555] uppercase tracking-widest">
                {{ $user->role ?? 'Admin' }}
            </p>
        </div>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit"
                class="bg-transparent border-none cursor-pointer text-[#555] hover:text-white transition-colors duration-150 p-1">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                    stroke-width="1.5">
                    <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4" />
                    <polyline points="16 17 21 12 16 7" />
                    <line x1="21" y1="12" x2="9" y2="12" />
                </svg>
            </button>
        </form>
    </div>

</aside>
