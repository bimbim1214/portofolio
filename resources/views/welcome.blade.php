<!DOCTYPE html>
<html class="dark" lang="en">

<head>
    <script>
        (function () {
            try {
                if (localStorage.getItem('orbis-theme') === 'light') document.documentElement.classList.add('light');
                var l = localStorage.getItem('orbis-lang');
                if (l === 'id' || l === 'en') document.documentElement.lang = l;
            } catch (e) {}
        })();
    </script>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <meta name="description" content="{{ $profile->headline ?? 'Bimo Aditya Pangestu — Full Stack Developer & UI/UX Designer' }} portfolio." />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>ORBIS.NFT | {{ $profile->name ?? 'Bimo Aditya Pangestu' }} Portfolio</title>

    {{-- Google Fonts: Anton, Condiment, Material Symbols Outlined --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Anton&family=Condiment&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet" />

    {{-- Lucide Icons & Framer Motion JS --}}
    <script src="https://unpkg.com/lucide@latest"></script>
    <script src="https://cdn.jsdelivr.net/npm/motion@10.16.2/dist/motion.js"></script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body {
            background-color: var(--bg-primary);
            color: var(--text-secondary);
            margin: 0;
            padding: 0;
            scroll-behavior: smooth;
            font-family: ui-monospace, SFMono-Regular, Menlo, Monaco, Consolas, "Liberation Mono", "Courier New", monospace;
            overflow-x: hidden;
        }

        .liquid-glass {
            background: rgba(255, 255, 255, 0.03);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        .grain-overlay {
            position: fixed;
            inset: 0;
            z-index: 50;
            pointer-events: none;
            opacity: 0.06;
            background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 200 200' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='noiseFilter'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.65' numOctaves='3' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23noiseFilter)'/%3E%3C/svg%3E");
        }

        .section-video {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            z-index: -1;
        }

        .video-container {
            position: relative;
            width: 100%;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
        }

        .anton-text {
            font-family: 'Anton', sans-serif;
            text-transform: uppercase;
        }

        .cursive-text {
            font-family: 'Condiment', cursive;
            color: #6FFF00;
        }

        .rarity-bar {
            height: 4px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 2px;
            overflow: hidden;
        }

        .rarity-fill {
            height: 100%;
            background: #6FFF00;
        }

        .max-container {
            max-width: 1831px;
            margin-left: auto;
            margin-right: auto;
            width: 100%;
            padding-left: 2rem;
            padding-right: 2rem;
        }

        /* Framer Motion utility states */
        .motion-fade-up {
            opacity: 0;
            transform: translateY(30px);
            transition: opacity 0.8s cubic-bezier(0.16, 1, 0.3, 1), transform 0.8s cubic-bezier(0.16, 1, 0.3, 1);
        }

        .motion-fade-up.in-view {
            opacity: 1;
            transform: translateY(0);
        }

        /* Certificate card: raised + light sweep on hover */
        .cert-card {
            transition: transform 0.5s cubic-bezier(0.22, 1, 0.36, 1),
                box-shadow 0.5s cubic-bezier(0.22, 1, 0.36, 1),
                border-color 0.5s ease;
            will-change: transform;
        }

        .cert-card:hover {
            transform: translateY(-8px);
            box-shadow:
                0 24px 60px -15px rgba(0, 0, 0, 0.6),
                0 0 45px -12px rgba(111, 255, 0, 0.3);
        }

        .cert-card::after {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 55%;
            height: 100%;
            background: linear-gradient(105deg,
                    transparent 0%,
                    rgba(255, 255, 255, 0.12) 40%,
                    rgba(255, 255, 255, 0.28) 50%,
                    rgba(255, 255, 255, 0.12) 60%,
                    transparent 100%);
            transform: skewX(-20deg);
            transition: left 0.8s ease;
            pointer-events: none;
            z-index: 1;
        }

        .cert-card:hover::after {
            left: 130%;
        }

        /* ═══════════════════════════════════════════════════
           LIGHT MODE OVERRIDES
           ═══════════════════════════════════════════════════ */
        :root.light .text-white {
            color: #0f172a;
        }

        :root.light .text-white\/30 {
            color: rgba(15, 23, 42, 0.3);
        }

        :root.light .text-white\/40 {
            color: rgba(15, 23, 42, 0.4);
        }

        :root.light .text-white\/60 {
            color: rgba(15, 23, 42, 0.6);
        }

        :root.light .text-white\/80 {
            color: rgba(15, 23, 42, 0.8);
        }

        :root.light .text-accent-neon,
        :root.light .cursive-text {
            color: #0d9488;
        }

        :root.light .bg-white\/5 {
            background-color: rgba(15, 23, 42, 0.05);
        }

        :root.light .bg-white\/10 {
            background-color: rgba(15, 23, 42, 0.08);
        }

        :root.light .bg-white\/\[0\.08\] {
            background-color: rgba(15, 23, 42, 0.08);
        }

        :root.light .bg-void-black\/40 {
            background-color: rgba(248, 250, 252, 0.35);
        }

        :root.light .bg-void-black\/70 {
            background-color: rgba(248, 250, 252, 0.72);
        }

        :root.light .from-void-black {
            --tw-gradient-from: #f8fafc;
        }

        :root.light .from-void-black\/80 {
            --tw-gradient-from: rgba(248, 250, 252, 0.85);
        }

        :root.light .border-white\/5 {
            border-color: rgba(15, 23, 42, 0.08);
        }

        :root.light .border-white\/10 {
            border-color: rgba(15, 23, 42, 0.12);
        }

        :root.light .border-white\/15 {
            border-color: rgba(15, 23, 42, 0.15);
        }

        :root.light .border-white\/20 {
            border-color: rgba(15, 23, 42, 0.2);
        }

        :root.light .liquid-glass {
            border-color: rgba(15, 23, 42, 0.12);
        }

        :root.light input::placeholder,
        :root.light textarea::placeholder {
            color: rgba(15, 23, 42, 0.35);
        }

        :root.light .motion-fade-up.in-view {
            color: inherit;
        }

        /* ═══════════════════════════════════════════════════
           CERTIFICATE MODAL (LIGHTBOX)
           ═══════════════════════════════════════════════════ */
        #cert-modal {
            opacity: 0;
            pointer-events: none;
            transition: opacity 0.3s ease;
        }

        #cert-modal.open {
            opacity: 1;
            pointer-events: auto;
        }

        #cert-modal .cert-modal-inner {
            transform: scale(0.92) translateY(16px);
            opacity: 0;
            transition: transform 0.4s cubic-bezier(0.16, 1, 0.3, 1), opacity 0.3s ease;
        }

        #cert-modal.open .cert-modal-inner {
            transform: scale(1) translateY(0);
            opacity: 1;
        }

        #cert-modal .cert-modal-img {
            opacity: 0;
            transform: scale(0.96);
            transition: opacity 0.4s ease 0.05s, transform 0.4s cubic-bezier(0.16, 1, 0.3, 1) 0.05s;
        }

        #cert-modal.open .cert-modal-img {
            opacity: 1;
            transform: scale(1);
        }

        /* ═══════════════════════════════════════════════════
           PROJECT MODAL (FLOATING CARD / LIGHTBOX)
           ═══════════════════════════════════════════════════ */
        #project-modal {
            opacity: 0;
            pointer-events: none;
            transition: opacity 0.3s ease;
        }

        #project-modal.open {
            opacity: 1;
            pointer-events: auto;
        }

        #project-modal .project-modal-inner {
            transform: scale(0.92) translateY(16px);
            opacity: 0;
            transition: transform 0.4s cubic-bezier(0.16, 1, 0.3, 1), opacity 0.3s ease;
            height: 80vh !important;
            max-height: 600px !important;
            min-height: 0 !important;
            display: flex !important;
            flex-direction: column !important;
        }

        #project-modal.open .project-modal-inner {
            transform: scale(1) translateY(0);
            opacity: 1;
        }

        #project-modal .project-modal-body {
            flex: 1 1 0% !important;
            min-height: 0 !important;
            overflow-y: auto !important;
        }

        .custom-scrollbar::-webkit-scrollbar {
            width: 6px;
        }
        .custom-scrollbar::-webkit-scrollbar-track {
            background: rgba(255, 255, 255, 0.03);
            border-radius: 9999px;
        }
        .custom-scrollbar::-webkit-scrollbar-thumb {
            background: rgba(111, 255, 0, 0.3);
            border-radius: 9999px;
        }
        .custom-scrollbar::-webkit-scrollbar-thumb:hover {
            background: rgba(111, 255, 0, 0.6);
        }

        body.modal-open nav {
            opacity: 0 !important;
            pointer-events: none !important;
            transform: translate(-50%, -20px) !important;
            transition: opacity 0.3s ease, transform 0.3s ease;
        }

        @media (prefers-reduced-motion: reduce) {
            #cert-modal,
            #cert-modal .cert-modal-inner,
            #cert-modal .cert-modal-img,
            #project-modal,
            #project-modal .project-modal-inner {
                transition: none;
            }
        }
    </style>
</head>

<body class="selection:bg-accent-neon selection:text-void-black">
    <div class="grain-overlay"></div>

    {{-- Navigation --}}
    <nav class="!fixed top-6 left-1/2 -translate-x-1/2 z-[60] w-[95%] max-w-[1831px] flex items-center justify-between px-8 py-4 rounded-full liquid-glass transition-all duration-300">
        <div class="flex items-center gap-4 cursor-pointer" onclick="window.scrollTo({top: 0, behavior: 'smooth'})">
            <span class="anton-text text-2xl tracking-tighter">PORTOFOLIO</span>
            <span class="text-accent-neon text-xs font-mono uppercase tracking-[0.2em] hidden md:block border-l border-white/20 pl-4">Bimo Aditya Pangestu</span>
        </div>
        <div class="hidden md:flex items-center gap-10 font-mono text-sm uppercase tracking-widest">
            <a class="hover:text-accent-neon transition-colors" href="#projects" data-i18n="nav.work">Work</a>
            <a class="hover:text-accent-neon transition-colors" href="#about" data-i18n="nav.experience">Experience</a>
            <a class="hover:text-accent-neon transition-colors" href="#certifications" data-i18n="nav.expertise">Expertise</a>
        </div>
        <div class="flex items-center gap-3">
            <button id="theme-toggle" type="button" class="toggle-btn" title="Toggle theme" aria-label="Toggle theme">
                <span id="theme-icon" class="material-symbols-outlined text-base">dark_mode</span>
            </button>
            <button id="lang-toggle" type="button" class="lang-toggle toggle-btn border border-white/20 text-white font-mono" title="Language">EN</button>
            <a href="#contact" class="px-6 py-2 rounded-full border border-white/20 font-mono text-xs uppercase tracking-widest hover:bg-accent-neon hover:text-void-black hover:border-accent-neon transition-all" data-i18n="nav.access">
                Get Access
            </a>
        </div>
    </nav>

    {{-- Section 1: Hero --}}
    <section class="video-container" id="hero">
        <video autoplay class="section-video" loop muted playsinline>
            <source src="https://d8j0ntlcm91z4.cloudfront.net/user_38xzZboKViGWJOttwIXH07lWA1P/hf_20260331_045634_e1c98c76-1265-4f5c-882a-4276f2080894.mp4" type="video/mp4" />
        </video>
        <div class="absolute inset-0 bg-void-black/40 z-0"></div>
        <div class="max-container relative z-10 text-center space-y-6 motion-fade-up">
            <p class="font-mono text-accent-neon text-sm uppercase tracking-[0.4em] mb-4" data-i18n="hero.archetype">Space Archetype 001</p>
            <h1 class="anton-text text-[8vw] md:text-[6.5vw] leading-[0.9] text-white">
                <span data-i18n="hero.title1">Beyond earth and</span> <br />
                <span class="inline-flex items-center gap-4">
                     <span class="cursive-text normal-case text-[5vw] md:text-[4vw]" data-i18n="hero.title2">Nft collection</span>
                </span><br />
                <span data-i18n="hero.title3">familiar boundaries</span>
            </h1>
            <div class="flex flex-col items-center gap-8 mt-12">
                <p class="max-w-2xl text-secondary text-sm md:text-base leading-relaxed font-mono uppercase tracking-wide">
                    <span data-i18n="hero.crafted">Crafted by</span> <span class="text-white">{{ $profile->name ?? 'Bimo Aditya Pangestu' }}</span> — {{ $profile->headline ?? 'Full Stack Developer & UI/UX Designer building the infrastructure of the digital frontier.' }}
                </p>
                <div class="flex gap-4">
                    <a href="{{ route('download.cv') }}" target="_blank" rel="noopener noreferrer" class="px-10 py-4 bg-accent-neon text-void-black anton-text text-xl hover:scale-105 transition-transform rounded-sm inline-flex items-center gap-3 shadow-lg shadow-accent-neon/20 cursor-pointer" data-i18n="hero.mint">
                        <span>MINT PORTFOLIO / CV</span>
                        <span class="material-symbols-outlined text-xl">open_in_new</span>
                    </a>
                </div>
            </div>
        </div>
    </section>

    {{-- Section 2: About / Origin Story --}}
    <section class="video-container" id="about">
        <video autoplay class="section-video" loop muted playsinline>
            <source src="https://d8j0ntlcm91z4.cloudfront.net/user_38xzZboKViGWJOttwIXH07lWA1P/hf_20260331_151551_992053d1-3d3e-4b8c-abac-45f22158f411.mp4" type="video/mp4" />
        </video>
        <div class="absolute inset-0 bg-gradient-to-r from-void-black/80 to-transparent z-0"></div>
        <div class="max-container relative z-10 grid grid-cols-1 md:grid-cols-2 gap-20 items-center">
            <div class="space-y-8 motion-fade-up">
                <div class="inline-block px-4 py-1 border border-accent-neon/30 rounded-full text-accent-neon font-mono text-xs uppercase tracking-widest" data-i18n="about.origin">
                    Origin Story
                </div>
                <h2 class="anton-text text-6xl md:text-8xl leading-tight text-white">
                    <span data-i18n="about.hello">Hello!</span><br />
                    <span data-i18n="about.im">I'm</span> <span class="cursive-text normal-case text-5xl md:text-7xl block md:inline">Bimo</span>
                </h2>
                <div class="space-y-6 text-secondary font-mono text-sm uppercase tracking-loose max-w-lg">
                    <p data-i18n="about.paragraph">
                        As an Information Technology graduate from UMY and BNSP-certified Senior Web Developer, I bridge the gap between complex backend architecture and immersive frontend aesthetics. I specialize in building accessible, high-performance digital ecosystems that prioritize human-centric interaction.
                    </p>
                </div>
                <div class="grid grid-cols-2 gap-4 pt-4">
                    <div class="liquid-glass p-4 rounded-xl border border-white/10">
                        <p class="text-accent-neon anton-text text-3xl">{{ count($experiences) > 0 ? count($experiences) . '+' : '4+' }}</p>
                        <p class="font-mono text-[10px] uppercase text-white/60" data-i18n="about.years">Career Roles</p>
                    </div>
                    <div class="liquid-glass p-4 rounded-xl border border-white/10">
                        <p class="text-accent-neon anton-text text-3xl">{{ ($allProjectsCount ?? count($homeProjects)) }}+</p>
                        <p class="font-mono text-[10px] uppercase text-white/60" data-i18n="about.missions">Major Missions</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Section 3: Projects (Project Vault) --}}
    <section class="py-32 bg-surface" id="projects">
        <div class="max-container">
            <div class="flex flex-col md:flex-row md:items-end justify-between mb-20 gap-8 motion-fade-up">
                <div class="space-y-4">
                    <span class="font-mono text-accent-neon text-xs uppercase tracking-[0.5em]" data-i18n="projects.selected">Selected Archives</span>
                    <h2 class="anton-text text-6xl md:text-7xl text-white"><span data-i18n="projects.vault">Project</span> <span class="cursive-text normal-case text-5xl md:text-6xl" data-i18n="projects.vaultCur">Vault</span></h2>
                </div>
                <p class="max-w-xs text-xs font-mono uppercase text-secondary/60 leading-relaxed" data-i18n="projects.desc">
                    A curated selection of high-rarity digital assets and functional infrastructures developed for various sectors.
                </p>
            </div>

            {{-- First 3 projects (always visible) --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8" id="projects-initial-grid">

                {{-- Project 1: SIPINTAR --}}
                <div class="project-card liquid-glass rounded-3xl overflow-hidden group border border-white/5 hover:border-accent-neon/30 transition-all duration-500 motion-fade-up cursor-pointer"
                    role="button" tabindex="0" aria-label="View project details for SIPINTAR SMAN1Kopang"
                    data-project-title="SIPINTAR SMAN1Kopang"
                    data-project-cat="Web Application"
                    data-project-rarity="EPIC"
                    data-project-desc="Mengembangkan sistem pembinaan integritas dan karakter siswa berbasis web dari sisi frontend, backend, hingga integrasi
database. Membangun fitur autentikasi, pengelolaan data, validasi formulir, serta merancang tampilan responsif sesuai identitas
sekolah. Melakukan testing, debugging, deployment, dan konfigurasi aplikasi pada server produksi."
                    data-project-src="{{ asset('images/projects/sipintar.png') }}"
                    data-project-url="https://sipintarsman1kopang.my.id/login"
                    data-project-tags="LARAVEL,MYSQL,PHP">
                    <div class="relative aspect-[4/5] overflow-hidden">
                        <img src="{{ asset('images/projects/sipintar.png') }}" alt="SIPINTAR SMAN1Kopang" class="absolute inset-0 w-full h-full object-cover grayscale group-hover:grayscale-0 group-hover:scale-105 transition-all duration-700" />
                        <div class="absolute inset-0 bg-gradient-to-t from-void-black via-void-black/30 to-transparent"></div>
                        <div class="absolute bottom-0 left-0 right-0 p-8 space-y-4">
                            <div class="flex justify-between items-end">
                                <div>
                                    <p class="text-[10px] font-mono uppercase text-accent-neon tracking-widest mb-1" data-i18n="projects.p1.cat">Web Application</p>
                                    <h3 class="anton-text text-3xl text-white">SIPINTAR</h3>
                                </div>
                                <div class="text-right">
                                    <p class="text-[10px] font-mono text-white/40 uppercase" data-i18n="projects.rarity">Rarity</p>
                                    <p class="font-mono text-white text-sm" data-i18n="projects.p1.epic">EPIC</p>
                                </div>
                            </div>
                            <div class="space-y-2">
                                <div class="rarity-bar"><div class="rarity-fill w-[88%]"></div></div>
                                <div class="flex justify-between text-[10px] font-mono text-white/40">
                                    <span data-i18n="projects.p1.util">UTILITY: SCHOOL SYSTEM</span>
                                    <span>88%</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="p-8 space-y-4">
                        <p class="text-xs text-secondary/80 font-mono uppercase leading-relaxed h-12 overflow-hidden" data-i18n="projects.p1.desc">Integrated school information system for SMAN 1 Kopang.</p>
                        <div class="flex flex-wrap gap-2">
                            <span class="text-[9px] font-mono px-2 py-1 bg-white/5 border border-white/10 text-white/60">LARAVEL</span>
                            <span class="text-[9px] font-mono px-2 py-1 bg-white/5 border border-white/10 text-white/60">MYSQL</span>
                            <span class="text-[9px] font-mono px-2 py-1 bg-white/5 border border-white/10 text-white/60">PHP</span>
                        </div>
                    </div>
                </div>

                {{-- Project 2: PROFIL SMAN 1 KOPANG --}}
                <div class="project-card liquid-glass rounded-3xl overflow-hidden group border border-white/5 hover:border-accent-neon/30 transition-all duration-500 motion-fade-up cursor-pointer"
                    role="button" tabindex="0" aria-label="View project details for Profil SMAN 1 Kopang"
                    data-project-title="Profil SMAN 1 Kopang"
                    data-project-cat="Web Application"
                    data-project-rarity="LEGENDARY"
                    data-project-desc="Website resmi profil SMA Negeri 1 Kopang yang menyajikan informasi sekolah, berita, pengumuman, dan galeri kegiatan."
                    data-project-src="{{ asset('images/projects/profileSMAN.png') }}"
                    data-project-url="https://smanegeri1kopang.sch.id/"
                    data-project-tags="WEB DEVELOPMENT,PHP,TAILWIND CSS">
                    <div class="relative aspect-[4/5] overflow-hidden">
                        <img src="{{ asset('images/projects/profileSMAN.png') }}" alt="Website Profil SMAN 1 Kopang" class="absolute inset-0 w-full h-full object-cover grayscale group-hover:grayscale-0 group-hover:scale-105 transition-all duration-700" />
                        <div class="absolute inset-0 bg-gradient-to-t from-void-black via-void-black/30 to-transparent"></div>
                        <div class="absolute bottom-0 left-0 right-0 p-8 space-y-4">
                            <div class="flex justify-between items-end">
                                <div>
                                    <p class="text-[10px] font-mono uppercase text-accent-neon tracking-widest mb-1" data-i18n="projects.p2.cat">Web Application</p>
                                    <h3 class="anton-text text-3xl text-white">PROFIL SMAN 1 KOPANG</h3>
                                </div>
                                <div class="text-right">
                                    <p class="text-[10px] font-mono text-white/40 uppercase" data-i18n="projects.rarity">Rarity</p>
                                    <p class="font-mono text-white text-sm" data-i18n="projects.p2.legendary">LEGENDARY</p>
                                </div>
                            </div>
                            <div class="space-y-2">
                                <div class="rarity-bar"><div class="rarity-fill w-[94%]"></div></div>
                                <div class="flex justify-between text-[10px] font-mono text-white/40">
                                    <span data-i18n="projects.p2.util">UTILITY: SCHOOL PORTAL</span>
                                    <span>94%</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="p-8 space-y-4">
                        <p class="text-xs text-secondary/80 font-mono uppercase leading-relaxed h-12 overflow-hidden" data-i18n="projects.p2.desc">Official website profile for SMAN 1 Kopang presenting school news, info, announcements, and activity gallery.</p>
                        <div class="flex flex-wrap gap-2">
                            <span class="text-[9px] font-mono px-2 py-1 bg-white/5 border border-white/10 text-white/60">WEB DEVELOPMENT</span>
                            <span class="text-[9px] font-mono px-2 py-1 bg-white/5 border border-white/10 text-white/60">PHP</span>
                            <span class="text-[9px] font-mono px-2 py-1 bg-white/5 border border-white/10 text-white/60">TAILWIND CSS</span>
                        </div>
                    </div>
                </div>

                {{-- Project 3: AUDIT SYSTEM --}}
                <div class="project-card liquid-glass rounded-3xl overflow-hidden group border border-white/5 hover:border-accent-neon/30 transition-all duration-500 motion-fade-up cursor-pointer"
                    role="button" tabindex="0" aria-label="View project details for System Audit App"
                    data-project-title="System Audit App"
                    data-project-cat="Web Application"
                    data-project-rarity="EPIC"
                    data-project-desc="Platform sistem audit terintegrasi untuk pengelolaan, evaluasi, pelaporan, dan manajemen audit."
                    data-project-src="{{ asset('images/projects/audit.png') }}"
                    data-project-url="https://audit2019.ur-braindevpro.com/"
                    data-project-tags="LARAVEL,MYSQL,PHP">
                    <div class="relative aspect-[4/5] overflow-hidden">
                        <img src="{{ asset('images/projects/audit.png') }}" alt="Audit System App" class="absolute inset-0 w-full h-full object-cover grayscale group-hover:grayscale-0 group-hover:scale-105 transition-all duration-700" />
                        <div class="absolute inset-0 bg-gradient-to-t from-void-black via-void-black/30 to-transparent"></div>
                        <div class="absolute bottom-0 left-0 right-0 p-8 space-y-4">
                            <div class="flex justify-between items-end">
                                <div>
                                    <p class="text-[10px] font-mono uppercase text-accent-neon tracking-widest mb-1" data-i18n="projects.p3.cat">Web Application</p>
                                    <h3 class="anton-text text-3xl text-white">PROJEK AUDIT</h3>
                                </div>
                                <div class="text-right">
                                    <p class="text-[10px] font-mono text-white/40 uppercase" data-i18n="projects.rarity">Rarity</p>
                                    <p class="font-mono text-white text-sm" data-i18n="projects.p3.epic">EPIC</p>
                                </div>
                            </div>
                            <div class="space-y-2">
                                <div class="rarity-bar"><div class="rarity-fill w-[90%]"></div></div>
                                <div class="flex justify-between text-[10px] font-mono text-white/40">
                                    <span data-i18n="projects.p3.util">UTILITY: SYSTEM AUDIT</span>
                                    <span>90%</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="p-8 space-y-4">
                        <p class="text-xs text-secondary/80 font-mono uppercase leading-relaxed h-12 overflow-hidden" data-i18n="projects.p3.desc">Integrated audit management platform for tracking, evaluating, and reporting audit compliance and findings.</p>
                        <div class="flex flex-wrap gap-2">
                            <span class="text-[9px] font-mono px-2 py-1 bg-white/5 border border-white/10 text-white/60">LARAVEL</span>
                            <span class="text-[9px] font-mono px-2 py-1 bg-white/5 border border-white/10 text-white/60">MYSQL</span>
                            <span class="text-[9px] font-mono px-2 py-1 bg-white/5 border border-white/10 text-white/60">PHP</span>
                        </div>
                    </div>
                </div>

            </div>

            {{-- More Projects (hidden by default, revealed on expand) --}}
            <div id="projects-more" class="overflow-hidden transition-all duration-700 ease-in-out" style="max-height: 0; opacity: 0;">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8 pt-8">

                    {{-- Project 4: UI/UX DESIGN --}}
                    <div class="project-card liquid-glass rounded-3xl overflow-hidden group border border-white/5 hover:border-accent-neon/30 transition-all duration-500 motion-fade-up cursor-pointer"
                        role="button" tabindex="0" aria-label="View project details for UI/UX Design Bantulpedia"
                        data-project-title="UI/UX Design — Bantulpedia"
                        data-project-cat="UI/UX Design"
                        data-project-rarity="RARE"
                        data-project-desc="Mendesain antarmuka pengguna (UI/UX) untuk aplikasi Bantulpedia menggunakan Figma. Merancang wireframe, prototype interaktif, komponen desain sistem, dan alur pengguna yang intuitif untuk aplikasi informasi daerah Bantul."
                        data-project-src="{{ asset('images/projects/designbantulpedia.png') }}"
                        data-project-url="https://www.figma.com/design/KKYYQEccr79Qti7S8DvR5A/Untitled--Copy-?node-id=0-1&t=5N7coDOZfrqZPaiR-1"
                        data-project-tags="FIGMA,UI/UX DESIGN,PROTOTYPING">
                        <div class="relative aspect-[4/5] overflow-hidden">
                            <img src="{{ asset('images/projects/designbantulpedia.png') }}" alt="UI/UX Design Bantulpedia" class="absolute inset-0 w-full h-full object-cover grayscale group-hover:grayscale-0 group-hover:scale-105 transition-all duration-700" />
                            <div class="absolute inset-0 bg-gradient-to-t from-void-black via-void-black/30 to-transparent"></div>
                            <div class="absolute bottom-0 left-0 right-0 p-8 space-y-4">
                                <div class="flex justify-between items-end">
                                    <div>
                                        <p class="text-[10px] font-mono uppercase text-accent-neon tracking-widest mb-1">UI/UX Design</p>
                                        <h3 class="anton-text text-3xl text-white">UI/UX DESIGN</h3>
                                    </div>
                                    <div class="text-right">
                                        <p class="text-[10px] font-mono text-white/40 uppercase">Rarity</p>
                                        <p class="font-mono text-white text-sm">RARE</p>
                                    </div>
                                </div>
                                <div class="space-y-2">
                                    <div class="rarity-bar"><div class="rarity-fill w-[85%]"></div></div>
                                    <div class="flex justify-between text-[10px] font-mono text-white/40">
                                        <span>UTILITY: DESIGN SYSTEM</span>
                                        <span>85%</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="p-8 space-y-4">
                            <p class="text-xs text-secondary/80 font-mono uppercase leading-relaxed h-12 overflow-hidden">UI/UX design prototype for Bantulpedia regional info app using Figma.</p>
                            <div class="flex flex-wrap gap-2">
                                <span class="text-[9px] font-mono px-2 py-1 bg-white/5 border border-white/10 text-white/60">FIGMA</span>
                                <span class="text-[9px] font-mono px-2 py-1 bg-white/5 border border-white/10 text-white/60">UI/UX DESIGN</span>
                                <span class="text-[9px] font-mono px-2 py-1 bg-white/5 border border-white/10 text-white/60">PROTOTYPING</span>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            {{-- Show More / Show Less Button — Bottom Right --}}
            <div class="flex justify-end mt-8">
                <button id="projects-toggle-btn"
                    onclick="toggleMoreProjects()"
                    class="group flex items-center gap-2 px-4 py-2 rounded-full liquid-glass border border-white/10 hover:border-accent-neon/50 text-white/60 hover:text-accent-neon transition-all duration-300 text-[11px] font-mono uppercase tracking-wider whitespace-nowrap">
                    <span id="projects-toggle-label">Tampilkan lebih banyak</span>
                    <i id="projects-toggle-icon" data-lucide="chevron-down" class="w-4 h-4 transition-transform duration-300 group-hover:translate-y-0.5"></i>
                </button>
            </div>

        </div>
    </section>

    {{-- Section 4: Certifications (Credentials Verified) --}}
    <section class="py-32 bg-surface border-t border-white/5" id="certifications">
        <div class="max-container">
            <div class="flex flex-col md:flex-row md:items-end justify-between mb-20 gap-8 motion-fade-up">
                <div class="space-y-4">
                    <span class="font-mono text-accent-neon text-xs uppercase tracking-[0.5em]" data-i18n="certs.qualified">Qualified Archives</span>
                    <h2 class="anton-text text-6xl md:text-7xl text-white"><span data-i18n="certs.credentials">Credentials</span> <span class="cursive-text normal-case text-5xl md:text-6xl" data-i18n="certs.verified">Verified</span></h2>
                </div>
                <p class="max-w-xs text-xs font-mono uppercase text-secondary/60 leading-relaxed" data-i18n="certs.desc">
                    Professional validations and industry-standard certifications acquired through rigorous assessment.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                @forelse($certifications as $cert)
                <?php
                    $certImg = $cert->imageUrl ? asset($cert->imageUrl) : asset('images/certificates/SENIOR_WEB_DEVELOPER.jpg');
                    $certVideos = [
                        1 => 'https://d8j0ntlcm91z4.cloudfront.net/user_38xzZboKViGWJOttwIXH07lWA1P/hf_20260331_053923_22c0a6a5-313c-474c-85ff-3b50d25e944a.mp4',
                        2 => 'https://d8j0ntlcm91z4.cloudfront.net/user_38xzZboKViGWJOttwIXH07lWA1P/hf_20260331_054411_511c1b7a-fb2f-42ef-bf6c-32c0b1a06e79.mp4',
                    ];
                    $videoUrl = $certVideos[$cert->sort_order] ?? $certVideos[1];
                ?>
                <div class="cert-card liquid-glass rounded-3xl overflow-hidden group border border-white/5 hover:border-accent-neon/30 transition-all duration-500 p-8 flex flex-col justify-between min-h-[280px] motion-fade-up cursor-pointer relative"
                    role="button" tabindex="0" aria-label="Open certificate {{ $cert->title }}"
                    data-cert-title="{{ $cert->title }}"
                    data-cert-src="{{ $certImg }}">
                    {{-- Top Header Row --}}
                    <div class="flex justify-between items-start">
                        <div class="w-12 h-12 rounded-xl bg-white/5 border border-white/10 flex items-center justify-center">
                            <span class="material-symbols-outlined text-accent-neon text-2xl">{{ $cert->icon ?? 'verified_user' }}</span>
                        </div>
                        <div class="flex items-center gap-3">
                            <div class="px-3 py-1 rounded-full border border-accent-neon/30 bg-accent-neon/10 text-accent-neon text-[10px] font-mono uppercase tracking-widest flex items-center gap-1.5" data-i18n="certs.badge">
                                <span class="w-1.5 h-1.5 rounded-full bg-accent-neon animate-pulse"></span>
                                Verified
                            </div>
                            {{-- Small Square Video Frame --}}
                            <div class="relative w-16 h-16 md:w-20 md:h-20 rounded-xl overflow-hidden shrink-0 border border-white/15 bg-white/5 shadow-md group-hover:border-accent-neon/50 transition-all duration-500">
                                <video autoplay loop muted playsinline poster="{{ $certImg }}" class="w-full h-full object-cover grayscale group-hover:grayscale-0 group-hover:scale-110 transition-all duration-700">
                                    <source src="{{ $videoUrl }}" type="video/mp4" />
                                    <img src="{{ $certImg }}" alt="{{ $cert->title }}" class="w-full h-full object-cover" />
                                </video>
                            </div>
                        </div>
                    </div>
                    {{-- Bottom Text --}}
                    <div class="mt-10 space-y-2">
                        <p class="text-[10px] font-mono uppercase text-secondary/60 tracking-widest"><span data-i18n="certs.issuingOrg">Issuing Org:</span> {{ $cert->issuer }}</p>
                        <h3 class="anton-text text-3xl md:text-4xl text-white group-hover:text-accent-neon transition-colors duration-300">{{ $cert->title }}</h3>
                        <p class="text-xs font-mono text-white/40 uppercase tracking-tighter">{{ $cert->issuer_full ?? $cert->issuer }}</p>
                    </div>
                </div>
                @empty
                {{-- Cert 1: BNSP --}}
                <div class="cert-card liquid-glass rounded-3xl overflow-hidden group border border-white/5 hover:border-accent-neon/30 transition-all duration-500 p-8 flex flex-col justify-between min-h-[280px] motion-fade-up cursor-pointer relative"
                    role="button" tabindex="0" aria-label="Open certificate SENIOR WEB DEVELOPER"
                    data-cert-title="SENIOR WEB DEVELOPER"
                    data-cert-src="{{ asset('images/certificates/SENIOR_WEB_DEVELOPER.jpg') }}">
                    <div class="flex justify-between items-start">
                        <div class="w-12 h-12 rounded-xl bg-white/5 border border-white/10 flex items-center justify-center">
                            <span class="material-symbols-outlined text-accent-neon text-2xl">verified_user</span>
                        </div>
                        <div class="flex items-center gap-3">
                            <div class="px-3 py-1 rounded-full border border-accent-neon/30 bg-accent-neon/10 text-accent-neon text-[10px] font-mono uppercase tracking-widest flex items-center gap-1.5" data-i18n="certs.badge">
                                <span class="w-1.5 h-1.5 rounded-full bg-accent-neon animate-pulse"></span>
                                Verified
                            </div>
                            <div class="relative w-16 h-16 md:w-20 md:h-20 rounded-xl overflow-hidden shrink-0 border border-white/15 bg-white/5 shadow-md group-hover:border-accent-neon/50 transition-all duration-500">
                                <video autoplay loop muted playsinline poster="{{ asset('images/certificates/SENIOR_WEB_DEVELOPER.jpg') }}" class="w-full h-full object-cover grayscale group-hover:grayscale-0 group-hover:scale-110 transition-all duration-700">
                                    <source src="https://d8j0ntlcm91z4.cloudfront.net/user_38xzZboKViGWJOttwIXH07lWA1P/hf_20260331_053923_22c0a6a5-313c-474c-85ff-3b50d25e944a.mp4" type="video/mp4" />
                                    <img src="{{ asset('images/certificates/SENIOR_WEB_DEVELOPER.jpg') }}" alt="SENIOR WEB DEVELOPER" class="w-full h-full object-cover" />
                                </video>
                            </div>
                        </div>
                    </div>
                    <div class="mt-10 space-y-2">
                        <p class="text-[10px] font-mono uppercase text-secondary/60 tracking-widest"><span data-i18n="certs.issuingOrg">Issuing Org:</span> BNSP</p>
                        <h3 class="anton-text text-3xl md:text-4xl text-white group-hover:text-accent-neon transition-colors duration-300">SENIOR WEB DEVELOPER</h3>
                        <p class="text-xs font-mono text-white/40 uppercase tracking-tighter">Badan Nasional Sertifikasi Profesi</p>
                    </div>
                </div>

                {{-- Cert 2: Certiport --}}
                <div class="cert-card liquid-glass rounded-3xl overflow-hidden group border border-white/5 hover:border-accent-neon/30 transition-all duration-500 p-8 flex flex-col justify-between min-h-[280px] motion-fade-up cursor-pointer relative"
                    role="button" tabindex="0" aria-label="Open certificate SOFTWARE DEVELOPMENT"
                    data-cert-title="SOFTWARE DEVELOPMENT"
                    data-cert-src="{{ asset('images/certificates/SOFTWARE_DEVELOPMENT.jpg') }}">
                    <div class="flex justify-between items-start">
                        <div class="w-12 h-12 rounded-xl bg-white/5 border border-white/10 flex items-center justify-center">
                            <span class="material-symbols-outlined text-accent-neon text-2xl">terminal</span>
                        </div>
                        <div class="flex items-center gap-3">
                            <div class="px-3 py-1 rounded-full border border-accent-neon/30 bg-accent-neon/10 text-accent-neon text-[10px] font-mono uppercase tracking-widest flex items-center gap-1.5" data-i18n="certs.badge">
                                <span class="w-1.5 h-1.5 rounded-full bg-accent-neon animate-pulse"></span>
                                Verified
                            </div>
                            <div class="relative w-16 h-16 md:w-20 md:h-20 rounded-xl overflow-hidden shrink-0 border border-white/15 bg-white/5 shadow-md group-hover:border-accent-neon/50 transition-all duration-500">
                                <video autoplay loop muted playsinline poster="{{ asset('images/certificates/SOFTWARE_DEVELOPMENT.jpg') }}" class="w-full h-full object-cover grayscale group-hover:grayscale-0 group-hover:scale-110 transition-all duration-700">
                                    <source src="https://d8j0ntlcm91z4.cloudfront.net/user_38xzZboKViGWJOttwIXH07lWA1P/hf_20260331_054411_511c1b7a-fb2f-42ef-bf6c-32c0b1a06e79.mp4" type="video/mp4" />
                                    <img src="{{ asset('images/certificates/SOFTWARE_DEVELOPMENT.jpg') }}" alt="SOFTWARE DEVELOPMENT" class="w-full h-full object-cover" />
                                </video>
                            </div>
                        </div>
                    </div>
                    <div class="mt-10 space-y-2">
                        <p class="text-[10px] font-mono uppercase text-secondary/60 tracking-widest"><span data-i18n="certs.issuingOrg">Issuing Org:</span> Certiport</p>
                        <h3 class="anton-text text-3xl md:text-4xl text-white group-hover:text-accent-neon transition-colors duration-300">SOFTWARE DEVELOPMENT</h3>
                        <p class="text-xs font-mono text-white/40 uppercase tracking-tighter">Pearson VUE Authorized Center</p>
                    </div>
                </div>
                @endforelse
            </div>
        </div>
    </section>

    {{-- Section 5: CTA & Contact Form (Let's build together) --}}
    <section class="video-container min-h-[90vh] py-20" id="contact">
        <video autoplay class="section-video" loop muted playsinline>
            <source src="https://d8j0ntlcm91z4.cloudfront.net/user_38xzZboKViGWJOttwIXH07lWA1P/hf_20260331_055729_72d66327-b59e-4ae9-bb70-de6ccb5ecdb0.mp4" type="video/mp4" />
        </video>
        <div class="absolute inset-0 bg-void-black/70 z-0"></div>
        <div class="max-container relative z-10 text-center space-y-8 motion-fade-up my-auto">
            <h2 class="anton-text text-5xl md:text-7xl lg:text-8xl text-white"><span data-i18n="contact.build">Let's build</span> <span class="cursive-text normal-case" data-i18n="contact.together">together</span></h2>
            
            {{-- Contact Card Container (Rectangular Liquid Glass Card like Certificate & Image 2) --}}
            <div class="liquid-glass rounded-3xl border border-white/10 p-8 sm:p-10 text-left max-w-xl mx-auto shadow-2xl relative overflow-hidden backdrop-blur-xl">
                {{-- Top Header Row --}}
                <div class="mb-2">
                    <h3 class="text-2xl font-bold text-white tracking-tight" data-i18n="contact.title">Contact</h3>
                </div>
                <p class="text-xs sm:text-sm font-mono text-white/60 mb-6 leading-relaxed" data-i18n="contact.desc">
                    Have something to discuss? Send me a message and let's talk.
                </p>

                {{-- Contact Form --}}
                <form id="contact-form" onsubmit="handleFormSubmit(event)" class="space-y-4">
                    {{-- Name Input --}}
                    <div class="relative">
                        <div class="absolute left-4 top-1/2 -translate-y-1/2 text-white/40 pointer-events-none">
                            <i data-lucide="user" class="w-4 h-4"></i>
                        </div>
                        <input type="text" id="contact-name" required placeholder="Your Name" data-i18n-ph="contact.namePh"
                            class="w-full bg-white/5 border border-white/10 rounded-2xl py-3.5 pl-11 pr-4 text-sm text-white placeholder:text-white/30 focus:outline-none focus:border-accent-neon focus:bg-white/[0.08] transition-all" />
                    </div>

                    {{-- Email Input --}}
                    <div class="relative">
                        <div class="absolute left-4 top-1/2 -translate-y-1/2 text-white/40 pointer-events-none">
                            <i data-lucide="mail" class="w-4 h-4"></i>
                        </div>
                        <input type="email" id="contact-email" required placeholder="Your Email" data-i18n-ph="contact.emailPh"
                            class="w-full bg-white/5 border border-white/10 rounded-2xl py-3.5 pl-11 pr-4 text-sm text-white placeholder:text-white/30 focus:outline-none focus:border-accent-neon focus:bg-white/[0.08] transition-all" />
                    </div>

                    {{-- Message Input --}}
                    <div class="relative">
                        <div class="absolute left-4 top-4 text-white/40 pointer-events-none">
                            <i data-lucide="message-square" class="w-4 h-4"></i>
                        </div>
                        <textarea id="contact-message" rows="3" required placeholder="Your Message" data-i18n-ph="contact.msgPh"
                            class="w-full bg-white/5 border border-white/10 rounded-2xl py-3.5 pl-11 pr-4 text-sm text-white placeholder:text-white/30 focus:outline-none focus:border-accent-neon focus:bg-white/[0.08] transition-all resize-none"></textarea>
                    </div>

                    {{-- Submit Button --}}
                    <button type="submit" id="contact-submit-btn"
                        class="w-full bg-white text-void-black font-semibold rounded-2xl py-3.5 px-6 flex items-center justify-center gap-2 hover:bg-accent-neon hover:scale-[1.02] active:scale-[0.98] transition-all duration-300 shadow-lg cursor-pointer">
                        <i data-lucide="send" class="w-4 h-4"></i>
                        <span data-i18n="contact.send">Send Message</span>
                    </button>
                </form>

                {{-- Status Alert --}}
                <div id="contact-alert" class="hidden mt-4 p-3 rounded-xl bg-accent-neon/20 border border-accent-neon text-accent-neon text-xs font-mono text-center" data-i18n="contact.received">
                    Message received! Thank you for reaching out.
                </div>

                {{-- Divider --}}
                <div class="mt-8 pt-6 border-t border-white/10">
                    <p class="text-[10px] font-mono uppercase text-white/40 tracking-widest text-center mb-4" data-i18n="contact.direct">Direct Channels</p>
                    
                    {{-- Circular Contact Field Buttons (Email, WA, GitHub, LinkedIn) --}}
                    <div class="flex items-center justify-center gap-4">
                        {{-- Email --}}
                        <a href="mailto:{{ $profile->email ?? 'bimoadityapangestu@gmail.com' }}"
                            class="w-12 h-12 rounded-full liquid-glass border border-white/15 flex items-center justify-center text-white/80 hover:text-accent-neon hover:border-accent-neon hover:scale-110 transition-all shadow-md group"
                            data-i18n-title="contact.emailTitle">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 group-hover:rotate-12 transition-transform" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <rect width="20" height="16" x="2" y="4" rx="2"/>
                                <path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"/>
                            </svg>
                        </a>

                        {{-- WhatsApp --}}
                        <a href="{{ $profile->whatsapp ?? 'https://wa.me/62895334634949' }}" target="_blank" rel="noreferrer"
                            class="w-12 h-12 rounded-full liquid-glass border border-white/15 flex items-center justify-center text-white/80 hover:text-accent-neon hover:border-accent-neon hover:scale-110 transition-all shadow-md group"
                            data-i18n-title="contact.waTitle">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 group-hover:rotate-12 transition-transform" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/>
                            </svg>
                        </a>

                        {{-- GitHub --}}
                        <a href="{{ $profile->github_url ?? 'https://github.com/bimbim1214' }}" target="_blank" rel="noreferrer"
                            class="w-12 h-12 rounded-full liquid-glass border border-white/15 flex items-center justify-center text-white/80 hover:text-accent-neon hover:border-accent-neon hover:scale-110 transition-all shadow-md group"
                            data-i18n-title="contact.ghTitle">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 group-hover:rotate-12 transition-transform" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M15 22v-4a4.8 4.8 0 0 0-1-3.02c3.18-.35 6.5-1.5 6.5-7a4.6 4.6 0 0 0-1.39-3.23 4.2 4.2 0 0 0-.1-3.2s-1.1-.35-3.5 1.25a11.9 11.9 0 0 0-6 0C7.1 2.85 6 3.2 6 3.2a4.2 4.2 0 0 0-.1 3.23A4.6 4.6 0 0 0 4.5 9.6c0 5.5 3.3 6.65 6.5 7a4.8 4.8 0 0 0-1 3.03V22"></path>
                                <path d="M9 20c-5 1.5-5-2.5-7-3"></path>
                            </svg>
                        </a>

                        {{-- LinkedIn --}}
                        <a href="{{ $profile->linkedin_url ?? 'https://www.linkedin.com/in/bimo-aditya-pangestu' }}" target="_blank" rel="noreferrer"
                            class="w-12 h-12 rounded-full liquid-glass border border-white/15 flex items-center justify-center text-white/80 hover:text-accent-neon hover:border-accent-neon hover:scale-110 transition-all shadow-md group"
                            data-i18n-title="contact.liTitle">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 group-hover:rotate-12 transition-transform" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-2-2 2 2 0 0 0-2 2v7h-4v-7a6 6 0 0 1 6-6z"></path>
                                <rect width="4" height="12" x="2" y="9"></rect>
                                <circle cx="4" cy="4" r="2"></circle>
                            </svg>
                        </a>
                    </div>
                </div>

            </div>

            <p class="text-[10px] font-mono uppercase text-white/40 tracking-[0.3em] pt-2" data-i18n="contact.opStatus">Operational 24/7 in the digital ether</p>
        </div>
    </section>

    {{-- Footer --}}
    <footer class="bg-surface py-12 border-t border-white/5 relative z-20">
        <div class="max-container flex flex-col md:flex-row justify-between items-center gap-8">
            <div class="font-mono text-[10px] uppercase text-white/30 tracking-[0.2em]" data-i18n="footer.copyright">
                © 2024 ORBIS.NFT BY BIMO ADITYA PANGESTU. ALL SYSTEMS NOMINAL.
            </div>
            <!-- <div class="flex items-center gap-4">
                <a class="w-10 h-10 flex items-center justify-center rounded-full border border-white/10 hover:border-accent-neon hover:text-accent-neon transition-colors" href="{{ $profile->github_url ?? 'https://github.com/bimbim1214' }}" target="_blank" rel="noreferrer">
                    <i class="w-4 h-4" data-lucide="github"></i>
                </a>
                <a class="w-10 h-10 flex items-center justify-center rounded-full border border-white/10 hover:border-accent-neon hover:text-accent-neon transition-colors" href="{{ $profile->linkedin_url ?? 'https://www.linkedin.com/in/bimo-aditya-pangestu' }}" target="_blank" rel="noreferrer">
                    <i class="w-4 h-4" data-lucide="linkedin"></i>
                </a>
                <a class="w-10 h-10 flex items-center justify-center rounded-full border border-white/10 hover:border-accent-neon hover:text-accent-neon transition-colors" href="{{ $profile->whatsapp ?? 'https://wa.me/62895334634949' }}" target="_blank" rel="noreferrer">
                    <i class="w-4 h-4" data-lucide="phone"></i>
                </a>
            </div> -->
        </div>
    </footer>

    {{-- Project Details Modal (Card Besar Melayang) --}}
    <div id="project-modal" class="fixed inset-0 z-[100] flex items-center justify-center p-4 sm:p-6 pt-20 sm:pt-24 pb-8" aria-hidden="true">
        <div id="project-modal-overlay" class="absolute inset-0 bg-black/75 backdrop-blur-md"></div>
        <div class="project-modal-inner relative liquid-glass rounded-3xl border border-white/15 max-w-2xl w-full h-[80vh] max-h-[600px] shadow-2xl backdrop-blur-2xl p-6 sm:p-8 flex flex-col min-h-0 overflow-hidden">
            {{-- Circular Close Button (Pojok Kanan Atas Card) --}}
            <button id="project-modal-close" type="button"
                class="absolute top-4 right-4 z-30 w-10 h-10 rounded-full liquid-glass border border-white/20 flex items-center justify-center text-white/90 hover:text-accent-neon hover:border-accent-neon hover:rotate-90 hover:scale-110 transition-all duration-300 cursor-pointer shadow-xl bg-void-black/70 backdrop-blur-md"
                aria-label="Close project modal">
                <i data-lucide="x" class="w-5 h-5"></i>
            </button>
            
            <div class="project-modal-body overflow-y-auto custom-scrollbar flex-1 min-h-0 pr-2 space-y-6">
                {{-- Large Image Container --}}
                <div class="relative w-full aspect-video rounded-2xl overflow-hidden border border-white/10 shadow-lg shrink-0">
                    <img id="project-modal-img" class="w-full h-full object-cover" src="" alt="" />
                    <div class="absolute inset-0 bg-gradient-to-t from-void-black/80 via-transparent to-transparent"></div>
                    <span id="project-modal-rarity" class="absolute bottom-3 left-3 px-3 py-1 bg-accent-neon/20 border border-accent-neon text-accent-neon text-xs font-mono rounded-full uppercase tracking-wider"></span>
                </div>

                {{-- Header --}}
                <div class="shrink-0">
                    <p id="project-modal-cat" class="text-xs font-mono uppercase text-accent-neon tracking-widest mb-1"></p>
                    <h3 id="project-modal-title" class="anton-text text-3xl sm:text-4xl text-white"></h3>
                </div>

                {{-- Description (Scrollable) --}}
                <div class="shrink-0">
                    <p id="project-modal-desc" class="text-xs sm:text-sm font-mono text-white/80 leading-relaxed whitespace-pre-line break-words"></p>
                </div>

                {{-- Tech Stack Tags --}}
                <div class="shrink-0">
                    <p class="text-[10px] font-mono uppercase text-white/40 tracking-widest mb-2" data-i18n="projects.modal.tech">Technologies Used</p>
                    <div id="project-modal-tags" class="flex flex-wrap gap-2"></div>
                </div>

                {{-- External Link Action Button --}}
                <div class="pt-2 shrink-0">
                    <a id="project-modal-link" href="#" target="_blank" rel="noreferrer"
                        class="inline-flex items-center justify-center gap-2 w-full py-3.5 px-6 bg-accent-neon text-void-black anton-text text-lg rounded-xl hover:scale-[1.02] active:scale-[0.98] transition-all shadow-lg">
                        <span data-i18n="projects.modal.visit">KUNJUNGI WEBSITE</span>
                        <i data-lucide="external-link" class="w-5 h-5"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>

    {{-- Certificate Modal (Lightbox) --}}
    <div id="cert-modal" class="fixed inset-0 z-[100] flex items-center justify-center p-4 sm:p-6 pt-20 sm:pt-24 pb-8" aria-hidden="true">
        <div id="cert-modal-overlay" class="absolute inset-0 bg-black/60"></div>
        <div class="cert-modal-inner relative liquid-glass rounded-3xl border border-white/10 max-w-xl w-full h-[75vh] max-h-[580px] shadow-2xl backdrop-blur-xl p-6 flex flex-col overflow-hidden">
            <button id="cert-modal-close" type="button"
                class="absolute top-4 right-4 z-30 w-10 h-10 rounded-full liquid-glass border border-white/20 flex items-center justify-center text-white/90 hover:text-accent-neon hover:border-accent-neon hover:rotate-90 hover:scale-110 transition-all duration-300 cursor-pointer shadow-xl bg-void-black/70 backdrop-blur-md"
                aria-label="Close certificate">
                <i data-lucide="x" class="w-5 h-5"></i>
            </button>
            <div class="relative flex-1 min-h-0 flex items-center justify-center overflow-hidden">
                <img id="cert-modal-img" class="cert-modal-img max-w-full max-h-full w-auto h-auto object-contain rounded-xl" src="" alt="" />
            </div>
        </div>
    </div>

    {{-- Scripts: Lucide Icons, Copy Email Logic, & Framer Motion Scroll Observer --}}
    <script>
        // ─── Theme (Dark / Light) Toggle ─────────────────────────────────────
        const themeToggle = document.getElementById('theme-toggle');
        const themeIcon = document.getElementById('theme-icon');

        function applyTheme() {
            const isLight = document.documentElement.classList.contains('light');
            if (themeIcon) themeIcon.textContent = isLight ? 'dark_mode' : 'light_mode';
        }

        if (themeToggle) {
            themeToggle.addEventListener('click', () => {
                const isLight = document.documentElement.classList.toggle('light');
                try { localStorage.setItem('orbis-theme', isLight ? 'light' : 'dark'); } catch (e) {}
                applyTheme();
            });
        }

        // ─── Language (EN / ID) Toggle ───────────────────────────────────────
        const translations = {
            en: {
                'nav.work': 'Work',
                'nav.experience': 'Experience',
                'nav.expertise': 'Expertise',
                'nav.access': 'Get Access',
                'hero.archetype': 'Space Archetype 001',
                'hero.title1': 'Beyond earth and',
                'hero.title2': 'Nft collection',
                'hero.title3': 'familiar boundaries',
                'hero.crafted': 'Crafted by',
                'hero.mint': 'MINT PORTFOLIO',
                'about.origin': 'Origin Story',
                'about.hello': 'Hello!',
                'about.im': "I'm",
                'about.paragraph': 'As an Information Technology graduate from UMY and BNSP-certified Senior Web Developer, I bridge the gap between complex backend architecture and immersive frontend aesthetics. I specialize in building accessible, high-performance digital ecosystems that prioritize human-centric interaction.',
                'about.years': 'Years Experience',
                'about.missions': 'Major Missions',
                'projects.selected': 'Selected Archives',
                'projects.vault': 'Project',
                'projects.vaultCur': 'Vault',   
                'projects.desc': 'A curated selection of high-rarity digital assets and functional infrastructures developed for various sectors.',
                'projects.rarity': 'Rarity',
                'projects.p1.cat': 'Web Application',
                'projects.p1.epic': 'EPIC',
                'projects.p1.util': 'UTILITY: CORE',
                'projects.p1.desc': 'Integrated school information system for SMAN 1 Kopang.',
                'projects.p2.cat': 'Web Application',
                'projects.p2.legendary': 'LEGENDARY',
                'projects.p2.util': 'UTILITY: SCHOOL PORTAL',
                'projects.p2.desc': 'Official website profile for SMAN 1 Kopang presenting school news, info, announcements, and activity gallery.',
                'projects.p3.cat': 'Web Application',
                'projects.p3.epic': 'EPIC',
                'projects.p3.util': 'UTILITY: SYSTEM AUDIT',
                'projects.p3.desc': 'Integrated audit management platform for tracking, evaluating, and reporting audit compliance and findings.',
                'projects.modal.tech': 'Technologies Used',
                'projects.modal.visit': 'VISIT WEBSITE',
                'certs.qualified': 'Qualified Archives',
                'certs.credentials': 'Credentials',
                'certs.verified': 'Verified',
                'certs.desc': 'Professional validations and industry-standard certifications acquired through rigorous assessment.',
                'certs.badge': 'Verified',
                'certs.issuingOrg': 'Issuing Org:',
                'contact.build': "Let's build",
                'contact.together': 'together',
                'contact.title': 'Contact',
                'contact.desc': "Have something to discuss? Send me a message and let's talk.",
                'contact.namePh': 'Your Name',
                'contact.emailPh': 'Your Email',
                'contact.msgPh': 'Your Message',
                'contact.send': 'Send Message',
                'contact.received': 'Message received! Thank you for reaching out.',
                'contact.direct': 'Direct Channels',
                'contact.emailTitle': 'Send Email',
                'contact.waTitle': 'Chat via WhatsApp',
                'contact.ghTitle': 'GitHub Repository',
                'contact.liTitle': 'LinkedIn Profile',
                'contact.opStatus': 'Operational 24/7 in the digital ether',
                'footer.copyright': '© 2024 ORBIS.NFT BY BIMO ADITYA PANGESTU. ALL SYSTEMS NOMINAL.',
                'js.subject': 'Portfolio Message from {name}',
                'js.body': 'Hello Bimo,\n\nName: {name}\nEmail: {email}\n\nMessage:\n{message}\n\n---\nSent from Portfolio Contact Form',
                'js.opening': 'Opening Email...',
                'js.alert': 'Your email application is opening to send a message directly to {email}.'
            },
            id: {
                'nav.work': 'Karya',
                'nav.experience': 'Pengalaman',
                'nav.expertise': 'Keahlian',
                'nav.access': 'Hubungi',
                'hero.archetype': 'Space Archetype 001',
                'hero.title1': 'Melampaui bumi dan',
                'hero.title2': 'Koleksi Nft',
                'hero.title3': 'batas-batas yang dikenal',
                'hero.crafted': 'Dibuat oleh',
                'hero.mint': 'MINT PORTOFOLIO',
                'about.origin': 'Kisah Awal',
                'about.hello': 'Halo!',
                'about.im': 'Saya',
                'about.paragraph': 'Sebagai lulusan Teknologi Informasi UMY dan Senior Web Developer bersertifikasi BNSP, saya menjembatani kesenjangan antara arsitektur backend yang kompleks dan estetika frontend yang imersif. Saya spesialis dalam membangun ekosistem digital yang mudah diakses dan berkinerja tinggi dengan fokus pada interaksi yang berpusat pada manusia.',
                'about.years': 'Tahun Pengalaman',
                'about.missions': 'Misi Besar',
                'projects.selected': 'Arsip Terpilih',
                'projects.vault': 'Proyek',
                'projects.vaultCur': 'Tersimpan',
                'projects.desc': 'Seleksi aset digital bernilai tinggi dan infrastruktur fungsional yang dikembangkan untuk berbagai sektor.',
                'projects.rarity': 'Kelangkaan',
                'projects.p1.cat': 'Aplikasi Web',
                'projects.p1.epic': 'EPIC',
                'projects.p1.util': 'FUNGSI: INTI',
                'projects.p1.desc': 'Sistem informasi sekolah terintegrasi untuk SMAN 1 Kopang.',
                'projects.p2.cat': 'Aplikasi Web',
                'projects.p2.legendary': 'LEGENDA',
                'projects.p2.util': 'FUNGSI: PORTAL SEKOLAH',
                'projects.p2.desc': 'Website resmi profil SMAN 1 Kopang yang menyajikan informasi sekolah, berita, pengumuman, dan galeri kegiatan.',
                'projects.p3.cat': 'Aplikasi Web',
                'projects.p3.epic': 'EPIC',
                'projects.p3.util': 'FUNGSI: AUDIT SISTEM',
                'projects.p3.desc': 'Platform sistem audit terintegrasi untuk pengelolaan, evaluasi, pelaporan, dan manajemen audit.',
                'projects.modal.tech': 'Teknologi Terpakai',
                'projects.modal.visit': 'KUNJUNGI WEBSITE',
                'certs.qualified': 'Arsip Berkualifikasi',
                'certs.credentials': 'Kredensial',
                'certs.verified': 'Terverifikasi',
                'certs.desc': 'Validasi profesional dan sertifikasi standar industri yang diperoleh melalui penilaian ketat.',
                'certs.badge': 'Terverifikasi',
                'certs.issuingOrg': 'Lembaga Penerbit:',
                'contact.build': 'Mari bangun',
                'contact.together': 'bersama',
                'contact.title': 'Kontak',
                'contact.desc': 'Ada sesuatu yang ingin didiskusikan? Kirim pesan dan mari berbicara.',
                'contact.namePh': 'Nama Anda',
                'contact.emailPh': 'Email Anda',
                'contact.msgPh': 'Pesan Anda',
                'contact.send': 'Kirim Pesan',
                'contact.received': 'Pesan diterima! Terima kasih telah menghubungi.',
                'contact.direct': 'Saluran Langsung',
                'contact.emailTitle': 'Kirim Email',
                'contact.waTitle': 'Chat via WhatsApp',
                'contact.ghTitle': 'Repositori GitHub',
                'contact.liTitle': 'Profil LinkedIn',
                'contact.opStatus': 'Beroperasi 24/7 di eter digital',
                'footer.copyright': '© 2024 ORBIS.NFT OLEH BIMO ADITYA PANGESTU. SEMUA SISTEM NOMINAL.',
                'js.subject': 'Pesan Portofolio dari {name}',
                'js.body': 'Halo Bimo,\n\nNama: {name}\nEmail: {email}\n\nPesan:\n{message}\n\n---\nDikirim dari Formulir Kontak Portofolio',
                'js.opening': 'Membuka Email...',
                'js.alert': 'Aplikasi email Anda sedang dibuka untuk mengirim pesan langsung ke {email}.'
            }
        };

        const langToggle = document.getElementById('lang-toggle');

        function currentLang() {
            let l = 'en';
            try { l = localStorage.getItem('orbis-lang') || 'en'; } catch (e) {}
            return l === 'id' ? 'id' : 'en';
        }

        function applyLang() {
            const lang = currentLang();
            const dict = translations[lang];
            document.documentElement.lang = lang;
            if (langToggle) langToggle.textContent = lang.toUpperCase();
            document.querySelectorAll('[data-i18n]').forEach(el => {
                const key = el.getAttribute('data-i18n');
                if (dict[key]) el.textContent = dict[key];
            });
            document.querySelectorAll('[data-i18n-ph]').forEach(el => {
                const key = el.getAttribute('data-i18n-ph');
                if (dict[key]) el.setAttribute('placeholder', dict[key]);
            });
            document.querySelectorAll('[data-i18n-title]').forEach(el => {
                const key = el.getAttribute('data-i18n-title');
                if (dict[key]) el.setAttribute('title', dict[key]);
            });
        }

        if (langToggle) {
            langToggle.addEventListener('click', () => {
                const next = currentLang() === 'id' ? 'en' : 'id';
                try { localStorage.setItem('orbis-lang', next); } catch (e) {}
                applyLang();
            });
        }

        lucide.createIcons();

        // Copy email logic with feedback
        const copyBtn = document.getElementById('copy-email');
        const emailAddr = document.getElementById('email-address');
        if (copyBtn && emailAddr) {
            copyBtn.addEventListener('click', () => {
                const email = emailAddr.innerText.trim();
                navigator.clipboard.writeText(email).then(() => {
                    copyBtn.innerHTML = '<i data-lucide="check" class="w-4 h-4 text-accent-neon"></i>';
                    lucide.createIcons();
                    setTimeout(() => {
                        copyBtn.innerHTML = '<i data-lucide="copy" class="w-4 h-4"></i>';
                        lucide.createIcons();
                    }, 2000);
                });
            });
        }

        // Form submission handling logic — Sends email via backend API with live feedback
        async function handleFormSubmit(e) {
            e.preventDefault();
            const btn = document.getElementById('contact-submit-btn');
            const alertBox = document.getElementById('contact-alert');
            const name = document.getElementById('contact-name').value.trim();
            const email = document.getElementById('contact-email').value.trim();
            const message = document.getElementById('contact-message').value.trim();
            const csrfToken = document.querySelector('meta[name="csrf-token"]')?.content || "{{ csrf_token() }}";

            if (btn) {
                btn.disabled = true;
                btn.innerHTML = `<span class="inline-block animate-spin mr-2">⚡</span><span>Sending Message...</span>`;
            }

            try {
                const response = await fetch("{{ route('contact.send') }}", {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': csrfToken
                    },
                    body: JSON.stringify({ name, email, message })
                });

                const data = await response.json();

                if (response.ok && data.success) {
                    if (btn) {
                        btn.innerHTML = `<i data-lucide="check" class="w-4 h-4 text-accent-neon"></i><span class="text-accent-neon">Sent!</span>`;
                        if (typeof lucide !== 'undefined') lucide.createIcons();
                    }
                    if (alertBox) {
                        alertBox.innerText = data.message;
                        alertBox.className = "mt-4 p-4 rounded-xl bg-accent-neon/20 border border-accent-neon text-accent-neon text-xs font-mono text-center";
                        alertBox.classList.remove('hidden');
                    }
                    document.getElementById('contact-form').reset();
                } else {
                    if (alertBox) {
                        alertBox.innerText = data.message || "Failed to send message.";
                        alertBox.className = "mt-4 p-4 rounded-xl bg-amber-500/20 border border-amber-500 text-amber-300 text-xs font-mono text-center";
                        alertBox.classList.remove('hidden');
                    }
                    if (data.fallback_url) {
                        setTimeout(() => { window.location.href = data.fallback_url; }, 2500);
                    }
                }
            } catch (err) {
                const targetEmail = "creatifbimbim@gmail.com";
                const mailtoUrl = `mailto:${targetEmail}?subject=${encodeURIComponent('Portfolio Message from ' + name)}&body=${encodeURIComponent("Nama: " + name + "\nEmail: " + email + "\n\nPesan:\n" + message)}`;
                if (alertBox) {
                    alertBox.innerText = "Opening email application to send message directly...";
                    alertBox.className = "mt-4 p-4 rounded-xl bg-accent-neon/20 border border-accent-neon text-accent-neon text-xs font-mono text-center";
                    alertBox.classList.remove('hidden');
                }
                window.location.href = mailtoUrl;
            } finally {
                setTimeout(() => {
                    if (btn) {
                        btn.disabled = false;
                        btn.innerHTML = `<i data-lucide="send" class="w-4 h-4"></i><span>Send Message</span>`;
                        if (typeof lucide !== 'undefined') lucide.createIcons();
                    }
                }, 4000);
            }
        }

        // ─── Toggle More Projects ─────────────────────────────────────────────
        let projectsExpanded = false;
        function toggleMoreProjects() {
            const more = document.getElementById('projects-more');
            const label = document.getElementById('projects-toggle-label');
            const icon = document.getElementById('projects-toggle-icon');

            if (!more) return;

            projectsExpanded = !projectsExpanded;

            if (projectsExpanded) {
                // Expand: first set max-height to scrollHeight, then fade in
                more.style.maxHeight = more.scrollHeight + 'px';
                more.style.opacity = '1';
                label.textContent = 'Tampilkan lebih sedikit';
                if (icon) {
                    icon.style.transform = 'rotate(180deg)';
                }
                // Re-init lucide icons for newly revealed cards
                setTimeout(() => {
                    if (typeof lucide !== 'undefined') lucide.createIcons();
                }, 100);
            } else {
                // Collapse: animate back to 0
                more.style.maxHeight = '0';
                more.style.opacity = '0';
                label.textContent = 'Tampilkan lebih banyak';
                if (icon) {
                    icon.style.transform = 'rotate(0deg)';
                }
            }
        }

        // ─── Project Modal (Floating Card / Lightbox) ─────────────────────────
        const projectModal = document.getElementById('project-modal');
        const projectModalImg = document.getElementById('project-modal-img');
        const projectModalTitle = document.getElementById('project-modal-title');
        const projectModalCat = document.getElementById('project-modal-cat');
        const projectModalRarity = document.getElementById('project-modal-rarity');
        const projectModalDesc = document.getElementById('project-modal-desc');
        const projectModalTags = document.getElementById('project-modal-tags');
        const projectModalLink = document.getElementById('project-modal-link');

        function openProjectModal(el) {
            const title = el.getAttribute('data-project-title') || '';
            const cat = el.getAttribute('data-project-cat') || '';
            const rarity = el.getAttribute('data-project-rarity') || '';
            const desc = el.getAttribute('data-project-desc') || '';
            const src = el.getAttribute('data-project-src') || '';
            const url = el.getAttribute('data-project-url') || '#';
            const tagsStr = el.getAttribute('data-project-tags') || '';
            const tags = tagsStr.split(',').filter(Boolean);

            if (projectModalImg) {
                projectModalImg.src = src;
                projectModalImg.alt = title;
            }
            if (projectModalTitle) projectModalTitle.textContent = title;
            if (projectModalCat) projectModalCat.textContent = cat;
            if (projectModalRarity) projectModalRarity.textContent = rarity;
            if (projectModalDesc) projectModalDesc.textContent = desc;
            if (projectModalLink) projectModalLink.href = url;

            if (projectModalTags) {
                projectModalTags.innerHTML = tags.map(tag => 
                    `<span class="text-[10px] font-mono px-2.5 py-1 bg-white/10 border border-white/15 text-accent-neon rounded-md">${tag.trim()}</span>`
                ).join('');
            }

            if (projectModal) {
                projectModal.classList.add('open');
                projectModal.setAttribute('aria-hidden', 'false');
            }
            document.body.classList.add('modal-open');
            document.body.style.overflow = 'hidden';
            if (typeof lucide !== 'undefined') lucide.createIcons();
        }

        function closeProjectModal() {
            if (projectModal) {
                projectModal.classList.remove('open');
                projectModal.setAttribute('aria-hidden', 'true');
            }
            document.body.classList.remove('modal-open');
            document.body.style.overflow = '';
        }

        // ─── Certificate Modal (Lightbox) ────────────────────────────────────
        const certModal = document.getElementById('cert-modal');
        const certModalImg = document.getElementById('cert-modal-img');
        const certModalTitle = document.getElementById('cert-modal-title');

        function openCertModal(el) {
            const src = el.getAttribute('data-cert-src');
            const title = el.getAttribute('data-cert-title') || '';
            if (!src) return;
            if (certModalImg) certModalImg.src = src;
            if (certModalImg) certModalImg.alt = title;
            if (certModalTitle) certModalTitle.textContent = title;
            if (certModal) {
                certModal.classList.add('open');
                certModal.setAttribute('aria-hidden', 'false');
            }
            document.body.classList.add('modal-open');
            document.body.style.overflow = 'hidden';
        }

        function closeCertModal() {
            if (certModal) {
                certModal.classList.remove('open');
                certModal.setAttribute('aria-hidden', 'true');
            }
            document.body.classList.remove('modal-open');
            document.body.style.overflow = '';
        }

        // Framer Motion Style Scroll Observer
        document.addEventListener('DOMContentLoaded', () => {
            applyTheme();
            applyLang();

            const motionElements = document.querySelectorAll('.motion-fade-up');
            const observer = new IntersectionObserver((entries) => {
                entries.forEach((entry, index) => {
                    if (entry.isIntersecting) {
                        setTimeout(() => {
                            entry.target.classList.add('in-view');
                        }, index * 100);
                    }
                });
            }, { threshold: 0.15 });

            motionElements.forEach(el => observer.observe(el));

            // Open modal on card click / keyboard (Enter, Space)
            document.addEventListener('click', (e) => {
                const projectCard = e.target.closest('[data-project-src]');
                if (projectCard) {
                    openProjectModal(projectCard);
                    return;
                }
                const certCard = e.target.closest('[data-cert-src]');
                if (certCard) openCertModal(certCard);
            });

            document.addEventListener('keydown', (e) => {
                const t = e.target;
                if (t && t.closest) {
                    if (t.closest('[data-project-src]') && (e.key === 'Enter' || e.key === ' ')) {
                        e.preventDefault();
                        openProjectModal(t.closest('[data-project-src]'));
                        return;
                    }
                    if (t.closest('[data-cert-src]') && (e.key === 'Enter' || e.key === ' ')) {
                        e.preventDefault();
                        openCertModal(t.closest('[data-cert-src]'));
                        return;
                    }
                }
                if (e.key === 'Escape') {
                    closeProjectModal();
                    closeCertModal();
                }
            });

            // Close on overlay click or close button
            const certOverlay = document.getElementById('cert-modal-overlay');
            const certCloseBtn = document.getElementById('cert-modal-close');
            if (certOverlay) certOverlay.addEventListener('click', closeCertModal);
            if (certCloseBtn) certCloseBtn.addEventListener('click', closeCertModal);

            const projOverlay = document.getElementById('project-modal-overlay');
            const projCloseBtn = document.getElementById('project-modal-close');
            if (projOverlay) projOverlay.addEventListener('click', closeProjectModal);
            if (projCloseBtn) projCloseBtn.addEventListener('click', closeProjectModal);
        });
    </script>
</body>

</html>