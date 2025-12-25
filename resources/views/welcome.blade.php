<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Astro Wedding Project</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=playfair-display:400,600,700|inter:300,400,500,600" rel="stylesheet" />

    <!-- AOS CSS -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    <!-- Scripts & Styles (Vite) -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-900 text-white min-h-screen font-sans">

    <!-- Header dengan Login / Register -->
    <header class="fixed top-0 left-0 right-0 z-50 bg-gray-900/80 backdrop-blur-md border-b border-indigo-900/50">
        <div class="max-w-7xl mx-auto px-6 py-4">
            <nav class="flex justify-between items-center">
                <a href="{{ url('/') }}" class="text-2xl font-bold" style="font-family: 'Playfair Display', serif; color: #c8a2c8;">
                    Astro Wedding Project
                </a>

                <div class="flex items-center gap-4 text-sm">
                    @if (Route::has('login'))
                        @auth
                            <a href="{{ url('/dashboard') }}"
                               class="px-5 py-2 border border-indigo-700 rounded-md hover:bg-indigo-700 transition">
                                Dashboard
                            </a>
                        @else
                            <a href="{{ route('login') }}"
                               class="px-5 py-2 text-indigo-300 hover:text-white transition">
                                Log in
                            </a>

                            @if (Route::has('register'))
                                <a href="{{ route('register') }}"
                                   class="px-5 py-2 bg-indigo-700 text-white rounded-md hover:bg-indigo-600 transition shadow-md">
                                    Register
                                </a>
                            @endif
                        @endauth
                    @endif
                </div>
            </nav>
        </div>
    </header>

    <!-- Spacer -->
    <div class="h-20"></div>

    <!-- Section 1: Hero dengan Background Galaxy -->
    <section class="relative min-h-screen flex items-center justify-center text-center px-6 overflow-hidden"
             style="background-image: url('https://png.pngtree.com/background/20250314/original/pngtree-swirling-purples-blues-and-starry-galaxy-theme-picture-image_16378427.jpg'); background-size: cover; background-position: center;"
             data-aos="fade-up">
        <div class="absolute inset-0 bg-gray-900/60"></div> <!-- Overlay agar teks tetap terbaca -->
        <div class="relative z-10 max-w-4xl">
            <h1 class="text-5xl md:text-7xl font-bold mb-6" style="font-family: 'Playfair Display', serif; color: #e0e7ff;">
                Astro Wedding Project
            </h1>
            <p class="text-xl md:text-2xl mb-10 max-w-2xl mx-auto text-indigo-200">
                Perjalanan kosmik menuju hari pernikahan impian Anda. Temukan undangan digital, 3D, dan cetak bertema bintang yang memukau.
            </p>
            <a href="#services" class="inline-block bg-indigo-700 text-white px-8 py-4 rounded-full text-lg font-medium hover:bg-indigo-600 transition duration-300 shadow-lg">
                Jelajahi Koleksi
            </a>
        </div>
    </section>

    <!-- Section 2: About -->
    <section class="py-24 px-6 bg-gray-800" data-aos="fade-up" data-aos-delay="200">
        <div class="max-w-4xl mx-auto text-center">
            <h2 class="text-4xl md:text-5xl font-bold mb-8" style="font-family: 'Playfair Display', serif; color: #c8a2c8;">
                Tentang Kami
            </h2>
            <p class="text-lg md:text-xl leading-relaxed text-gray-300">
                Astro Wedding Project menghadirkan sentuhan langit malam dan keajaiban kosmos pada momen spesial Anda.
                Kami menggabungkan desain modern yang bersih dengan tema celestial untuk pengalaman pernikahan tak terlupakan.
            </p>
        </div>
    </section>

    <!-- Section 3: Services dengan Contoh Gambar Template -->
    <section id="services" class="py-24 px-6 bg-gray-900" data-aos="fade-up">
        <div class="max-w-6xl mx-auto">
            <h2 class="text-4xl md:text-5xl font-bold text-center mb-12" style="font-family: 'Playfair Display', serif; color: #c8a2c8;">
                Layanan & Template Undangan
            </h2>
            <p class="text-center text-lg mb-16 max-w-2xl mx-auto text-gray-400">
                Pilih template undangan yang sesuai visi pernikahan Anda — digital interaktif, 3D memukau, atau cet gargasi premium.
            </p>
            <div class="grid md:grid-cols-3 gap-10">
                <!-- Website/Digital -->
                <div class="bg-gray-800 rounded-2xl shadow-2xl overflow-hidden transform hover:scale-105 transition duration-300" data-aos="flip-left" data-aos-delay="100">
                    <img src="https://i.etsystatic.com/35922946/r/il/913dca/4313723648/il_fullxfull.4313723648_4ug9.jpg" alt="Contoh Undangan Website Celestial" class="w-full h-64 object-cover">
                    <div class="p-8">
                        <h3 class="text-2xl font-bold mb-4" style="font-family: 'Playfair Display', serif; color: #c8a2c8;">Undangan Website</h3>
                        <p class="text-gray-400">Undangan digital interaktif dengan RSVP, galeri, peta, dan animasi bintang.</p>
                    </div>
                </div>

                <!-- 3D Interaktif -->
                <div class="bg-gray-800 rounded-2xl shadow-2xl overflow-hidden transform hover:scale-105 transition duration-300" data-aos="flip-left" data-aos-delay="200">
                    <img src="https://i.etsystatic.com/36879332/r/il/5587e7/6674389589/il_fullxfull.6674389589_lr8r.jpg" alt="Contoh Undangan 3D Celestial" class="w-full h-64 object-cover">
                    <div class="p-8">
                        <h3 class="text-2xl font-bold mb-4" style="font-family: 'Playfair Display', serif; color: #c8a2c8;">Undangan 3D Interaktif</h3>
                        <p class="text-gray-400">Pengalaman immersive dengan model 3D planet, bintang, dan animasi kosmik.</p>
                    </div>
                </div>

                <!-- Printed -->
                <div class="bg-gray-800 rounded-2xl shadow-2xl overflow-hidden transform hover:scale-105 transition duration-300" data-aos="flip-left" data-aos-delay="300">
                    <img src="https://i.etsystatic.com/13750686/r/il/cffefb/1587424934/il_fullxfull.1587424934_crlt.jpg" alt="Contoh Undangan Cetak Starry Night" class="w-full h-64 object-cover">
                    <div class="p-8">
                        <h3 class="text-2xl font-bold mb-4" style="font-family: 'Playfair Display', serif; color: #c8a2c8;">Undangan Cetak Premium</h3>
                        <p class="text-gray-400">Desain cetak berkualitas tinggi dengan foil emas dan elemen bertema astro.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Section 4: Vendors dengan Gambar Placeholder Elegan -->
    <section class="py-24 px-6 bg-gray-800" data-aos="fade-up">
        <div class="max-w-6xl mx-auto">
            <h2 class="text-4xl md:text-5xl font-bold text-center mb-12" style="font-family: 'Playfair Display', serif; color: #c8a2c8;">
                Vendor Partner Terpercaya
            </h2>
            <p class="text-center text-lg mb-16 max-w-2xl mx-auto text-gray-400">
                Kami bekerja sama dengan vendor terbaik untuk setiap detail pernikahan Anda.
            </p>
            <div class="grid md:grid-cols-3 gap-10">
                <div class="text-center" data-aos="zoom-in" data-aos-delay="100">
                    <img src="https://www.shutterstock.com/image-vector/elegant-botanique-logo-collection-hand-600nw-2141914789.jpg" alt="Vendor 1" class="w-40 h-40 mx-auto mb-6 rounded-full object-cover border-4 border-indigo-900">
                    <h3 class="text-xl font-bold" style="font-family: 'Playfair Display', serif; color: #c8a2c8;">Stellar Florist</h3>
                    <p class="text-gray-400 mt-2">Dekorasi bunga bertema galaksi</p>
                </div>
                <div class="text-center" data-aos="zoom-in" data-aos-delay="200">
                    <img src="https://thumbs.dreamstime.com/b/wedding-catering-logo-elegant-gourmet-banquet-emblem-crafted-events-premium-hospitality-brands-professional-culinary-404866301.jpg" alt="Vendor 2" class="w-40 h-40 mx-auto mb-6 rounded-full object-cover border-4 border-indigo-900">
                    <h3 class="text-xl font-bold" style="font-family: 'Playfair Display', serif; color: #c8a2c8;">Cosmic Capture</h3>
                    <p class="text-gray-400 mt-2">Fotografi malam berbintang</p>
                </div>
                <div class="text-center" data-aos="zoom-in" data-aos-delay="300">
                    <img src="https://thumbs.dreamstime.com/z/decorative-oval-emblem-featuring-intricate-scrollwork-placeholder-text-isolated-clean-white-background-elegant-oval-417833177.jpg" alt="Vendor 3" class="w-40 h-40 mx-auto mb-6 rounded-full object-cover border-4 border-indigo-900">
                    <h3 class="text-xl font-bold" style="font-family: 'Playfair Display', serif; color: #c8a2c8;">Nebula Venue</h3>
                    <p class="text-gray-400 mt-2">Lokasi outdoor langit malam terbaik</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Section 5: Contact -->
    <section class="py-24 px-6 bg-gradient-to-t from-gray-900 to-gray-800" data-aos="fade-up">
        <div class="max-w-4xl mx-auto text-center">
            <h2 class="text-4xl md:text-5xl font-bold mb-8" style="font-family: 'Playfair Display', serif; color: #c8a2c8;">
                Hubungi Kami
            </h2>
            <p class="text-lg md:text-xl mb-12 max-w-2xl mx-auto text-gray-400">
                Siap memulai perjalanan kosmik pernikahan Anda? Mari wujudkan mimpi Anda.
            </p>
            <div class="flex flex-col sm:flex-row gap-6 justify-center">
                <a href="mailto:fityanalgifariyogaswarabelajar@gmail.com" class="bg-indigo-700 text-white px-10 py-5 rounded-full text-lg font-medium hover:bg-indigo-600 transition duration-300 shadow-lg">
                    Kirim Email
                </a>
                <a href="https://wa.me/6287737424300" target="_blank" class="border-2 border-indigo-700 text-indigo-300 px-10 py-5 rounded-full text-lg font-medium hover:bg-indigo-700 hover:text-white transition duration-300">
                    WhatsApp Kami
                </a>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-900 text-gray-400 py-10 text-center border-t border-indigo-900/50">
        <p>&copy; {{ date('Y') }} Astro Wedding Project. All rights reserved.</p>
    </footer>

    <!-- AOS JS -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({
            once: true,
            duration: 1000,
        });
    </script>
</body>
</html>
