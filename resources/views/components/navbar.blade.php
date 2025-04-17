<nav
    id="navbar"
    class="fixed top-0 left-0 z-50 flex w-full items-center justify-between gap-4 px-4 py-3 transition-colors duration-300 bg-transparent text-black"
>
    <div class="w-full">
        <a href="#" class="text-xl font-semibold text-white">
            Villa Puncak VIP
        </a>
    </div>

    <div class="hidden w-full items-center gap-4 text-sm font-medium text-white md:flex">
        <a href="#">Beranda</a>
        <a href="#">Tentang Kami</a>
        <a href="#">Kontak</a>
    </div>

    <div class="hidden w-full items-center justify-between gap-2 md:flex">
        <div class="relative w-full">
            <button
                onclick="handleSearch()"
                class="absolute top-1/2 left-3 flex -translate-y-1/2 items-center text-gray-600 hover:text-black"
            >
                <!-- Ikon Search -->
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                     stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M21 21l-4.35-4.35M10 18a8 8 0 100-16 8 8 0 000 16z" />
                </svg>
            </button>

            <input
                type="text"
                placeholder="Cek booking anda di sini..."
                class="w-full rounded-md border border-gray-300 bg-white py-2 pr-4 pl-9 text-sm text-gray-900 focus:ring-1 focus:ring-yellow-500 focus:outline-none"
            />
        </div>
    </div>

    <div class="md:hidden">
        <!-- Ikon Menu / Hamburger -->
        <button>
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none"
                 viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M4 6h16M4 12h16M4 18h16"/>
            </svg>
        </button>
    </div>
</nav>

<script>
    // Scroll logic
    window.addEventListener('scroll', function () {
        const navbar = document.getElementById('navbar');
        if (window.scrollY > 50) {
            navbar.classList.add('bg-black', 'text-white', 'shadow-lg');
            navbar.classList.remove('bg-transparent', 'text-black');
        } else {
            navbar.classList.remove('bg-black', 'text-white', 'shadow-lg');
            navbar.classList.add('bg-transparent', 'text-black');
        }
    });
</script>
