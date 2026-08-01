<!DOCTYPE html>
<html lang="id" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description"
        content="{{ $profile->headline ?? 'Bimo Aditya — Full Stack Developer & UI/UX Designer' }} based in Yogyakarta, Indonesia.">
    <title>{{ $profile->name ?? 'Bimo Aditya' }} — {{ $profile->headline ?? 'Full Stack Developer & UI/UX Designer' }}</title>

    {{-- Google Fonts & Helvetica --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&family=Instrument+Serif:ital@0;1&display=swap" rel="stylesheet">

    {{-- Lucide Icons --}}
    <script src="https://unpkg.com/lucide@latest/dist/umd/lucide.js" defer></script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="antialiased selection:bg-white/20 selection:text-white">

    {{-- Cursor Glow --}}
    <div id="cursor-glow"></div>

    {{-- ═══════════════════════════════════════════════════════
         HERO SECTION — Full Screen
         ═══════════════════════════════════════════════════════ --}}
    <section class="hero-section" id="hero">

        {{-- Background Video Hero --}}
        <video
            id="hero-video"
            class="hero-video"
            autoplay
            muted
            playsinline
            preload="auto"
            style="opacity: 0;"
        >
            <source src="https://d8j0ntlcm91z4.cloudfront.net/user_38xzZboKViGWJOttwIXH07lWA1P/hf_20260328_115001_bcdaa3b4-03de-47e7-ad63-ae3e392c32d4.mp4" type="video/mp4">
        </video>

        {{-- Dark Overlay --}}
        <div class="hero-overlay"></div>

        {{-- ── Navbar ── --}}
        <nav class="navbar-float">
            <div class="navbar-inner liquid-glass">
                {{-- Left: Logo --}}
                <div class="flex items-center gap-2">
                    @if($profile && $profile->photo_path)
                        <div class="w-8 h-8 rounded-full overflow-hidden border border-white/20">
                            <img src="{{ asset($profile->photo_path) }}" alt="{{ $profile->name ?? 'Bimo' }}" class="w-full h-full object-cover">
                        </div>
                    @else
                        <i data-lucide="globe" class="w-6 h-6 text-white"></i>
                    @endif
                    <span class="text-white font-semibold text-lg">{{ $profile->name ?? 'Bimo Aditya' }}</span>
                </div>

                {{-- Center: Nav Links (desktop) --}}
                <div class="nav-links-desktop hidden md:flex items-center gap-8">
                    <a href="#about" class="text-white/80 hover:text-white transition-colors text-sm font-medium" data-i18n="nav_about">About</a>
                    <a href="#experience" class="text-white/80 hover:text-white transition-colors text-sm font-medium" data-i18n="nav_experience">Experience</a>
                    <a href="#projects" class="text-white/80 hover:text-white transition-colors text-sm font-medium" data-i18n="nav_projects">Projects</a>
                </div>

                {{-- Right: Actions --}}
                <div class="flex items-center gap-2">
                    {{-- Language Toggle --}}
                    <button id="lang-toggle" class="toggle-btn lang-toggle text-white/80 hover:text-white" title="Switch Language" aria-label="Switch Language">
                        <span id="lang-label">EN</span>
                    </button>

                    {{-- Theme Toggle --}}
                    <button id="theme-toggle" class="toggle-btn text-white/80 hover:text-white" title="Toggle Theme" aria-label="Toggle Theme">
                        <i data-lucide="moon" id="theme-icon-moon" class="w-4 h-4"></i>
                        <i data-lucide="sun" id="theme-icon-sun" class="w-4 h-4 hidden"></i>
                    </button>

                    {{-- Contact --}}
                    <a href="{{ $profile->whatsapp ?? 'https://wa.me/62895334634949' }}" target="_blank" rel="noreferrer"
                       class="hidden sm:block text-white text-sm font-medium hover:text-white/80 transition-colors px-2"
                       data-i18n="nav_contact">Contact</a>

                    {{-- Admin Login --}}
                    <a href="{{ route('admin.login') }}" class="liquid-glass rounded-full px-6 py-2 text-white text-sm font-medium hover:bg-white/5 transition-colors"
                       title="Admin Panel" id="admin-settings-btn">
                        Login
                    </a>
                </div>
            </div>
        </nav>

        {{-- ── Hero Content ── --}}
        <div class="relative z-10 flex-1 flex flex-col items-center justify-center px-6 py-12 text-center -translate-y-[10%]">

            {{-- Profile Photo (mobile) --}}
            <div class="mb-6 w-20 h-20 rounded-full overflow-hidden border-2 border-white/20 shadow-xl md:hidden animate-fade-in-up">
                <img src="{{ asset($profile->photo_path ?? 'images/fotoshot.png') }}" alt="{{ $profile->name ?? 'Bimo Aditya' }}"
                    class="w-full h-full object-cover">
            </div>

            {{-- Heading --}}
            <h1 class="hero-heading text-5xl md:text-6xl lg:text-7xl text-white mb-4 tracking-tight whitespace-nowrap animate-fade-in-up"
                style="font-family: 'Instrument Serif', serif;">
                {{ $profile->name ?? 'Bimo Aditya Pangestu' }}
            </h1>

            {{-- Headline --}}
            <p class="text-white/70 text-lg md:text-xl mb-8 animate-fade-in-up animate-delay-100"
               data-i18n-dynamic="headline">
                {{ $profile->headline ?? 'Full Stack Developer & UI/UX Designer' }}
            </p>

            {{-- Email Input Bar --}}
            <div class="max-w-xl w-full space-y-4 animate-fade-in-up animate-delay-200">
                <div class="liquid-glass rounded-full pl-6 pr-2 py-2 flex items-center gap-3">
                    <input type="email" id="hero-email-input"
                           class="flex-1 bg-transparent border-none outline-none text-white placeholder:text-white/40 text-base"
                           data-i18n-placeholder="email_placeholder"
                           placeholder="Enter your email">
                    <button id="hero-email-submit"
                            class="bg-white rounded-full p-3 text-black hover:bg-white/90 transition-colors flex-shrink-0"
                            aria-label="Submit email">
                        <i data-lucide="arrow-right" class="w-5 h-5"></i>
                    </button>
                </div>

                {{-- Short Bio --}}
                <p class="text-white/60 text-sm leading-relaxed px-4" data-i18n="hero_subtitle">
                    {{ $profile->short_bio ?? 'I build accessible, pixel-perfect digital experiences for the web. Stay updated with the latest news and insights.' }}
                </p>
            </div>

            {{-- View CV Button --}}
            <div class="mt-6 animate-fade-in-up animate-delay-300">
                <a href="{{ $profile && $profile->cv_path ? asset($profile->cv_path) : asset('pdf/Bimo_Aditya_Pangestu_CV.pdf') }}"
                   target="_blank" rel="noreferrer"
                   class="liquid-glass rounded-full px-8 py-3 text-white text-sm font-medium hover:bg-white/5 transition-colors inline-flex items-center gap-2">
                    <i data-lucide="file-text" class="w-4 h-4"></i>
                    <span data-i18n="hero_cv_btn">View CV</span>
                </a>
            </div>
        </div>

        {{-- ── Social Icons Hero Footer ── --}}
        <div class="relative z-10 flex justify-center gap-4 pb-12 animate-fade-in-up animate-delay-400">
            @if($profile->github_url ?? true)
            <a href="{{ $profile->github_url ?? 'https://github.com/bimbim1214' }}" target="_blank" rel="noreferrer"
               class="liquid-glass rounded-full p-4 text-white/80 hover:text-white hover:bg-white/5 transition-all"
               aria-label="GitHub">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M15 22v-4a4.8 4.8 0 0 0-1-3.02c3.18-.35 6.5-1.5 6.5-7a4.6 4.6 0 0 0-1.39-3.23 4.2 4.2 0 0 0-.1-3.2s-1.1-.35-3.5 1.25a11.9 11.9 0 0 0-6 0C7.1 2.85 6 3.2 6 3.2a4.2 4.2 0 0 0-.1 3.23A4.6 4.6 0 0 0 4.5 9.6c0 5.5 3.3 6.65 6.5 7a4.8 4.8 0 0 0-1 3.03V22"></path>
                    <path d="M9 20c-5 1.5-5-2.5-7-3"></path>
                </svg>
            </a>
            @endif

            @if($profile->linkedin_url ?? true)
            <a href="{{ $profile->linkedin_url ?? 'https://www.linkedin.com/in/bimo-aditya-pangestu' }}" target="_blank" rel="noreferrer"
               class="liquid-glass rounded-full p-4 text-white/80 hover:text-white hover:bg-white/5 transition-all"
               aria-label="LinkedIn">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-2-2 2 2 0 0 0-2 2v7h-4v-7a6 6 0 0 1 6-6z"></path>
                    <rect width="4" height="12" x="2" y="9"></rect>
                    <circle cx="4" cy="4" r="2"></circle>
                </svg>
            </a>
            @endif

            @if($profile->email ?? true)
            <a href="mailto:{{ $profile->email ?? 'bimoadityapangestu@gmail.com' }}"
               class="liquid-glass rounded-full p-4 text-white/80 hover:text-white hover:bg-white/5 transition-all"
               aria-label="Email">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <rect width="20" height="16" x="2" y="4" rx="2"></rect>
                    <path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"></path>
                </svg>
            </a>
            @endif

            @if($profile->whatsapp ?? true)
            <a href="{{ $profile->whatsapp ?? 'https://wa.me/62895334634949' }}" target="_blank" rel="noreferrer"
               class="liquid-glass rounded-full p-4 text-white/80 hover:text-white hover:bg-white/5 transition-all"
               aria-label="WhatsApp">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path>
                </svg>
            </a>
            @endif
        </div>

    </section>

    {{-- ═══════════════════════════════════════════════════════
         CONTENT SECTIONS — With Moving Video Background
         ═══════════════════════════════════════════════════════ --}}
    <div class="content-wrapper">
        
        {{-- Content Moving Video Background --}}
        <video
            class="content-bg-video"
            autoplay
            muted
            loop
            playsinline
            preload="auto"
        >
            <source src="https://d8j0ntlcm91z4.cloudfront.net/user_38xzZboKViGWJOttwIXH07lWA1P/hf_20260429_114316_1c7889ad-2885-410e-b493-98119fee0ddb.mp4" type="video/mp4">
        </video>

        {{-- Backdrop Filter Overlay --}}
        <div class="content-bg-overlay"></div>

        <div class="mx-auto max-w-screen-lg px-6 py-12 md:px-12 md:py-20 lg:px-24 relative z-10">

            {{-- ── About Section ── --}}
            <section id="about" class="mb-16 scroll-mt-16 md:mb-24 lg:mb-36 lg:scroll-mt-24">
                <div class="mb-8">
                    <h2 class="text-sm font-bold uppercase tracking-widest themed-text-primary" data-i18n="section_about">About</h2>
                    <div class="mt-1 w-12 h-0.5 rounded-full" style="background-color: var(--text-accent);"></div>
                </div>
                <div class="themed-text-secondary leading-relaxed space-y-4">
                    @if($profile && ($profile->about_1 || $profile->about_2 || $profile->about_3))
                        @if($profile->about_1)
                            <p data-i18n="about_p1">{!! $profile->about_1 !!}</p>
                        @endif
                        @if($profile->about_2)
                            <p data-i18n="about_p2">{!! $profile->about_2 !!}</p>
                        @endif
                        @if($profile->about_3)
                            <p data-i18n="about_p3">{!! $profile->about_3 !!}</p>
                        @endif
                    @else
                        <p data-i18n="about_p1">
                            Saya adalah fresh graduate dari <span class="font-medium themed-text-primary">Information
                                Technology</span> di Universitas Muhammadiyah Yogyakarta (UMY). Memiliki pengalaman di
                            bidang <span class="font-medium themed-text-primary">coding</span> dan <span
                                class="font-medium themed-text-primary">development</span> dari UI/UX design, serta memiliki
                            kemampuan sebagai Full Stack Developer.
                        </p>
                        <p data-i18n="about_p2">
                            Saya terbiasa bekerja dengan berbagai project, baik secara individu maupun kolaborasi. Saya
                            juga memiliki sertifikasi di bidang <span class="font-medium themed-text-primary">Senior Web
                                Developer</span> dari BNSP, kemampuan bahasa Inggris, serta menguasai berbagai framework
                            dan template dalam pengerjaan project.
                        </p>
                        <p data-i18n="about_p3">
                            Saat ini saya fokus membangun portfolio digital yang mencerminkan skill-skill yang saya
                            miliki, dan terus mengeksplorasi teknologi web modern untuk menciptakan produk yang efektif,
                            inklusif, dan ramah pengguna.
                        </p>
                    @endif
                </div>
            </section>

            {{-- ── Experience Section ── --}}
            <section id="experience" class="mb-16 scroll-mt-16 md:mb-24 lg:mb-36 lg:scroll-mt-24">
                <div class="mb-8">
                    <h2 class="text-sm font-bold uppercase tracking-widest themed-text-primary" data-i18n="section_experience">Experience</h2>
                    <div class="mt-1 w-12 h-0.5 rounded-full" style="background-color: var(--text-accent);"></div>
                </div>
                <div>
                    <ol class="group/list">
                        @forelse($experiences as $exp)
                        <li class="mb-12">
                            <div
                                class="group/item relative grid pb-1 transition-all sm:grid-cols-8 sm:gap-8 md:gap-4 lg:hover:!opacity-100 lg:group-hover/list:opacity-50">
                                <div
                                    class="absolute -inset-x-4 -inset-y-4 z-0 hidden rounded-md transition motion-reduce:transition-none lg:-inset-x-6 lg:block card-hover-bg">
                                </div>
                                <header
                                    class="z-10 mb-2 mt-1 text-xs font-semibold uppercase tracking-wide themed-text-muted sm:col-span-2">
                                    {{ $exp->date_range }}
                                </header>
                                <div class="z-10 sm:col-span-6">
                                    <h3 class="font-medium leading-snug themed-text-primary">
                                        <div>
                                            @if($exp->company_url)
                                            <a class="inline-flex items-baseline font-medium leading-tight themed-text-primary hover:text-teal-300 focus-visible:text-teal-300 group/link text-base"
                                                href="{{ $exp->company_url }}" target="_blank"
                                                rel="noreferrer" aria-label="{{ $exp->title }} at {{ $exp->company }}">
                                                <span
                                                    class="absolute -inset-x-4 -inset-y-2.5 hidden rounded md:-inset-x-6 md:-inset-y-4 lg:block"></span>
                                                <span>{{ $exp->title }} &middot; {{ $exp->company }} <i
                                                        data-lucide="arrow-up-right"
                                                        class="inline-block w-4 h-4 ml-1 transition-transform group-hover/link:-translate-y-1 group-hover/link:translate-x-1"></i></span>
                                            </a>
                                            @else
                                            <span class="font-medium themed-text-primary text-base">{{ $exp->title }} &middot; {{ $exp->company }}</span>
                                            @endif
                                        </div>
                                    </h3>
                                    <p class="mt-2 text-sm leading-normal themed-text-secondary">
                                        {{ $exp->description }}
                                    </p>
                                    <ul class="mt-2 flex flex-wrap" aria-label="Technologies used">
                                        @foreach($exp->tags ?? [] as $tag)
                                        <li class="mr-1.5 mt-2">
                                            <div class="skill-badge">{{ $tag }}</div>
                                        </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </li>
                        @empty
                        {{-- Fallback static entries --}}
                        <li class="mb-12">
                            <div class="group/item relative grid pb-1 transition-all sm:grid-cols-8 sm:gap-8 md:gap-4 lg:hover:!opacity-100 lg:group-hover/list:opacity-50">
                                <div class="absolute -inset-x-4 -inset-y-4 z-0 hidden rounded-md transition motion-reduce:transition-none lg:-inset-x-6 lg:block card-hover-bg"></div>
                                <header class="z-10 mb-2 mt-1 text-xs font-semibold uppercase tracking-wide themed-text-muted sm:col-span-2">Apr 2026 &mdash; May 2026</header>
                                <div class="z-10 sm:col-span-6">
                                    <h3 class="font-medium leading-snug themed-text-primary">
                                        <a class="inline-flex items-baseline font-medium leading-tight themed-text-primary hover:text-teal-300 focus-visible:text-teal-300 group/link text-base" href="http://sipintarsman1kopang.my.id/" target="_blank" rel="noreferrer">
                                            <span class="absolute -inset-x-4 -inset-y-2.5 hidden rounded md:-inset-x-6 md:-inset-y-4 lg:block"></span>
                                            <span>Full Stack Developer &middot; SMAN 1 Kopang <i data-lucide="arrow-up-right" class="inline-block w-4 h-4 ml-1 transition-transform group-hover/link:-translate-y-1 group-hover/link:translate-x-1"></i></span>
                                        </a>
                                    </h3>
                                    <p class="mt-2 text-sm leading-normal themed-text-secondary" data-i18n="exp_fallback_desc">Membuat SIPINTAR SMAN1Kopang — sistem pengelolaan guru dan murid, serta kalkulasi perhitungan point murid.</p>
                                    <ul class="mt-2 flex flex-wrap"><li class="mr-1.5 mt-2"><div class="skill-badge">Laravel</div></li><li class="mr-1.5 mt-2"><div class="skill-badge">MySQL</div></li><li class="mr-1.5 mt-2"><div class="skill-badge">Tailwind CSS</div></li></ul>
                                </div>
                            </div>
                        </li>
                        @endforelse
                    </ol>

                    <div class="mt-12">
                        <a class="inline-flex items-center font-medium leading-tight themed-text-primary font-semibold group"
                            aria-label="View Full Résumé" target="_blank" rel="noreferrer"
                            href="{{ $profile && $profile->cv_path ? asset($profile->cv_path) : asset('pdf/Bimo_Aditya_Pangestu_CV.pdf') }}">
                            <span>
                                <span
                                    class="border-b border-transparent pb-px transition group-hover:border-teal-300 motion-reduce:transition-none"
                                    data-i18n="view_resume_1">View
                                    Full</span>
                                <span class="whitespace-nowrap">
                                    <span
                                        class="border-b border-transparent pb-px transition group-hover:border-teal-300 motion-reduce:transition-none"
                                        data-i18n="view_resume_2">Résumé</span>
                                    <i data-lucide="arrow-right"
                                        class="inline-block w-4 h-4 ml-1 transition-transform group-hover:translate-x-2"></i>
                                </span>
                            </span>
                        </a>
                    </div>
                </div>
            </section>

            {{-- ── Projects Section ── --}}
            <section id="projects" class="mb-16 scroll-mt-16 md:mb-24 lg:mb-36 lg:scroll-mt-24">
                <div class="mb-8">
                    <h2 class="text-sm font-bold uppercase tracking-widest themed-text-primary" data-i18n="section_projects">Projects</h2>
                    <div class="mt-1 w-12 h-0.5 rounded-full" style="background-color: var(--text-accent);"></div>
                </div>
                <div>
                    <ol class="group/list">
                        @forelse($homeProjects as $proj)
                        <li class="mb-12">
                            <div
                                class="group/item relative grid gap-4 pb-1 transition-all sm:grid-cols-8 sm:gap-8 md:gap-4 lg:hover:!opacity-100 lg:group-hover/list:opacity-50">
                                <div
                                    class="absolute -inset-x-4 -inset-y-4 z-0 hidden rounded-md transition motion-reduce:transition-none lg:-inset-x-6 lg:block card-hover-bg">
                                </div>
                                <div class="z-10 sm:order-2 sm:col-span-6">
                                    <h3>
                                        <a class="inline-flex items-baseline font-medium leading-tight themed-text-primary hover:text-teal-300 focus-visible:text-teal-300 group/link text-base"
                                            href="{{ $proj->url ?? route('projects') }}" {{ $proj->url ? 'target="_blank" rel="noreferrer"' : '' }} aria-label="{{ $proj->title }}">
                                            <span
                                                class="absolute -inset-x-4 -inset-y-2.5 hidden rounded md:-inset-x-6 md:-inset-y-4 lg:block"></span>
                                            <span>{{ $proj->title }} <i data-lucide="arrow-up-right"
                                                    class="inline-block w-4 h-4 ml-1 transition-transform group-hover/link:-translate-y-1 group-hover/link:translate-x-1"></i></span>
                                        </a>
                                    </h3>
                                    <p class="mt-2 text-sm leading-normal themed-text-secondary">{{ $proj->description }}</p>
                                    <ul class="mt-2 flex flex-wrap" aria-label="Technologies used">
                                        @foreach($proj->tags ?? [] as $tag)
                                        <li class="mr-1.5 mt-2">
                                            <div class="skill-badge">{{ $tag }}</div>
                                        </li>
                                        @endforeach
                                    </ul>
                                </div>
                                <div class="z-10 sm:order-1 sm:col-span-2">
                                    <div
                                        class="w-full aspect-video sm:aspect-auto sm:h-16 rounded border-2 themed-border transition group-hover/item:border-slate-200/30 overflow-hidden"
                                        style="background-color: var(--bg-secondary);">
                                        @if($proj->image_path)
                                            <img src="{{ asset($proj->image_path) }}" alt="{{ $proj->title }}" class="w-full h-full object-cover">
                                        @else
                                            <div class="w-full h-full flex items-center justify-center themed-text-muted">
                                                <i data-lucide="laptop" class="w-6 h-6"></i>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </li>
                        @empty
                        {{-- Fallback static entry --}}
                        <li class="mb-12">
                            <div class="group/item relative grid gap-4 pb-1 transition-all sm:grid-cols-8 sm:gap-8 md:gap-4 lg:hover:!opacity-100 lg:group-hover/list:opacity-50">
                                <div class="absolute -inset-x-4 -inset-y-4 z-0 hidden rounded-md transition motion-reduce:transition-none lg:-inset-x-6 lg:block card-hover-bg"></div>
                                <div class="z-10 sm:order-2 sm:col-span-6">
                                    <h3><a class="inline-flex items-baseline font-medium leading-tight themed-text-primary hover:text-teal-300 focus-visible:text-teal-300 group/link text-base" href="{{ route('projects') }}" aria-label="SIPINTAR SMAN1Kopang"><span class="absolute -inset-x-4 -inset-y-2.5 hidden rounded md:-inset-x-6 md:-inset-y-4 lg:block"></span><span>SIPINTAR SMAN1Kopang <i data-lucide="arrow-up-right" class="inline-block w-4 h-4 ml-1 transition-transform group-hover/link:-translate-y-1 group-hover/link:translate-x-1"></i></span></a></h3>
                                    <p class="mt-2 text-sm leading-normal themed-text-secondary" data-i18n="proj_fallback_desc">Sistem pengelolaan guru, murid, serta kalkulasi perhitungan poin murid terintegrasi untuk SMA Negeri 1 Kopang.</p>
                                    <ul class="mt-2 flex flex-wrap"><li class="mr-1.5 mt-2"><div class="skill-badge">Laravel</div></li><li class="mr-1.5 mt-2"><div class="skill-badge">PHP</div></li></ul>
                                </div>
                                <div class="z-10 sm:order-1 sm:col-span-2"><div class="w-full aspect-video sm:aspect-auto sm:h-16 rounded border-2 themed-border transition group-hover/item:border-slate-200/30 flex items-center justify-center overflow-hidden themed-text-muted" style="background-color: var(--bg-secondary);"><i data-lucide="laptop" class="w-6 h-6"></i></div></div>
                            </div>
                        </li>
                        @endforelse
                    </ol>
                    <div class="mt-12">
                        <a class="inline-flex items-center font-medium leading-tight themed-text-primary font-semibold group"
                            aria-label="View Project Archive" href="{{ route('projects') }}">
                            <span>
                                <span
                                    class="border-b border-transparent pb-px transition group-hover:border-teal-300 motion-reduce:transition-none"
                                    data-i18n="view_projects_1">View
                                    Full Project</span>
                                <span class="whitespace-nowrap">
                                    <span
                                        class="border-b border-transparent pb-px transition group-hover:border-teal-300 motion-reduce:transition-none"
                                        data-i18n="view_projects_2">Archive</span>
                                    <i data-lucide="arrow-right"
                                        class="inline-block w-4 h-4 ml-1 transition-transform group-hover:translate-x-2"></i>
                                </span>
                            </span>
                        </a>
                    </div>
                </div>
            </section>

            {{-- ── Education Section ── --}}
            <section id="education" class="mb-16 scroll-mt-16 md:mb-24 lg:mb-36 lg:scroll-mt-24">
                <div class="mb-8">
                    <h2 class="text-sm font-bold uppercase tracking-widest themed-text-primary" data-i18n="section_education">Education</h2>
                    <div class="mt-1 w-12 h-0.5 rounded-full" style="background-color: var(--text-accent);"></div>
                </div>
                <div>
                    <ol class="group/list">
                        <li class="mb-12">
                            <div
                                class="group/item relative grid pb-1 transition-all sm:grid-cols-8 sm:gap-8 md:gap-4 lg:hover:!opacity-100 lg:group-hover/list:opacity-50">
                                <div
                                    class="absolute -inset-x-4 -inset-y-4 z-0 hidden rounded-md transition motion-reduce:transition-none lg:-inset-x-6 lg:block card-hover-bg">
                                </div>
                                <header
                                    class="z-10 mb-2 mt-1 text-xs font-semibold uppercase tracking-wide themed-text-muted sm:col-span-2">
                                    Oct 2022 &mdash; Apr 2026
                                </header>
                                <div class="z-10 sm:col-span-6">
                                    <h3 class="font-medium leading-snug themed-text-primary">
                                        <div>
                                            <div
                                                class="inline-flex items-baseline font-medium leading-tight themed-text-primary text-base">
                                                <span>Information Technology</span>
                                            </div>
                                        </div>
                                    </h3>
                                    <p class="mt-2 text-sm leading-normal themed-text-secondary">
                                        Universitas Muhammadiyah Yogyakarta (UMY)
                                    </p>
                                </div>
                            </div>
                        </li>

                        <li class="mb-12">
                            <div
                                class="group/item relative grid pb-1 transition-all sm:grid-cols-8 sm:gap-8 md:gap-4 lg:hover:!opacity-100 lg:group-hover/list:opacity-50">
                                <div
                                    class="absolute -inset-x-4 -inset-y-4 z-0 hidden rounded-md transition motion-reduce:transition-none lg:-inset-x-6 lg:block card-hover-bg">
                                </div>
                                <header
                                    class="z-10 mb-2 mt-1 text-xs font-semibold uppercase tracking-wide themed-text-muted sm:col-span-2">
                                    Feb 2024 &mdash; Feb 2027
                                </header>
                                <div class="z-10 sm:col-span-6">
                                    <h3 class="font-medium leading-snug themed-text-primary">
                                        <div>
                                            <div
                                                class="inline-flex items-baseline font-medium leading-tight themed-text-primary text-base">
                                                <span data-i18n="edu_cert">Senior Web Developer (Certification)</span>
                                            </div>
                                        </div>
                                    </h3>
                                    <p class="mt-2 text-sm leading-normal themed-text-secondary" data-i18n="edu_cert_org">
                                        Badan Nasional Sertifikasi Profesi (BNSP)
                                    </p>
                                </div>
                            </div>
                        </li>
                    </ol>
                </div>
            </section>

            {{-- ═══════════════════════════════════════════════════════
                 LIQUID GLASS FOOTER — 12 Column Grid Card
                 ═══════════════════════════════════════════════════════ --}}
            <footer class="liquid-glass w-full rounded-3xl p-6 md:p-10 text-white/70 mt-16 md:mt-32 shadow-2xl">
                
                {{-- Top Grid (12 Columns) --}}
                <div class="grid grid-cols-1 md:grid-cols-12 gap-10 md:gap-12 mb-10">
                    
                    {{-- First Column: Logo & Description (col-span-5) --}}
                    <div class="md:col-span-5 flex flex-col justify-between">
                        <div>
                            <div class="flex items-center gap-3 mb-4 text-white">
                                <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 256 256" fill="currentColor">
                                    <path d="M 4.688 136 C 68.373 136 120 187.627 120 251.312 C 120 252.883 119.967 254.445 119.905 256 L 0 256 L 0 136.096 C 1.555 136.034 3.117 136 4.688 136 Z M 251.312 136 C 252.883 136 254.445 136.034 256 136.096 L 256 256 L 136.095 256 C 136.032 254.438 136.001 252.875 136 251.312 C 136 187.627 187.627 136 251.312 136 Z M 119.905 0 C 119.967 1.555 120 3.117 120 4.688 C 120 68.373 68.373 120 4.687 120 C 3.117 120 1.555 119.967 0 119.905 L 0 0 Z M 256 119.905 C 254.445 119.967 252.883 120 251.312 120 C 187.627 120 136 68.373 136 4.687 C 136 3.117 136.033 1.555 136.095 0 L 256 0 Z" />
                                </svg>
                                <span class="text-xl font-medium tracking-wide uppercase">{{ $profile->name ?? 'BIMO ADITYA' }}</span>
                            </div>
                            <p class="text-sm leading-relaxed max-w-sm text-white/60" data-i18n="footer_desc">
                                {{ $profile->headline ?? 'Full Stack Developer & UI/UX Designer' }} based in Yogyakarta. Crafting pixel-perfect, accessible, and high-performance digital experiences.
                            </p>
                        </div>
                    </div>

                    {{-- Links Section (col-span-7: 3-column grid inside) --}}
                    <div class="md:col-span-7 grid grid-cols-1 sm:grid-cols-3 gap-8">
                        {{-- Col 1: Discover --}}
                        <div>
                            <h4 class="text-sm uppercase tracking-wider text-white font-medium mb-4" data-i18n="footer_col1_title">Discover</h4>
                            <ul class="text-xs space-y-2.5 text-white/60">
                                <li><a href="#about" class="hover:text-white transition-colors" data-i18n="nav_about">About</a></li>
                                <li><a href="#experience" class="hover:text-white transition-colors" data-i18n="nav_experience">Experience</a></li>
                                <li><a href="#projects" class="hover:text-white transition-colors" data-i18n="nav_projects">Projects</a></li>
                                <li><a href="#education" class="hover:text-white transition-colors" data-i18n="section_education">Education</a></li>
                                <li><a href="{{ route('projects') }}" class="hover:text-white transition-colors" data-i18n="view_projects_2">Archive</a></li>
                            </ul>
                        </div>

                        {{-- Col 2: The Mission --}}
                        <div>
                            <h4 class="text-sm uppercase tracking-wider text-white font-medium mb-4" data-i18n="footer_col2_title">The Mission</h4>
                            <ul class="text-xs space-y-2.5 text-white/60">
                                <li><a href="{{ $profile && $profile->cv_path ? asset($profile->cv_path) : asset('pdf/Bimo_Aditya_Pangestu_CV.pdf') }}" target="_blank" class="hover:text-white transition-colors" data-i18n="hero_cv_btn">View CV</a></li>
                                <li><a href="https://laravel.com/" target="_blank" rel="noreferrer" class="hover:text-white transition-colors">Laravel Stack</a></li>
                                <li><a href="https://tailwindcss.com/" target="_blank" rel="noreferrer" class="hover:text-white transition-colors">Tailwind CSS</a></li>
                                <li><a href="{{ route('admin.login') }}" class="hover:text-white transition-colors">Admin Portal</a></li>
                            </ul>
                        </div>

                        {{-- Col 3: Concierge --}}
                        <div>
                            <h4 class="text-sm uppercase tracking-wider text-white font-medium mb-4" data-i18n="footer_col3_title">Concierge</h4>
                            <ul class="text-xs space-y-2.5 text-white/60">
                                <li><a href="{{ $profile->whatsapp ?? 'https://wa.me/62895334634949' }}" target="_blank" class="hover:text-white transition-colors" data-i18n="nav_contact">Get in Touch</a></li>
                                <li><a href="mailto:{{ $profile->email ?? 'bimoadityapangestu@gmail.com' }}" class="hover:text-white transition-colors">Email Me</a></li>
                                <li><a href="{{ $profile->github_url ?? 'https://github.com/bimbim1214' }}" target="_blank" class="hover:text-white transition-colors">GitHub Repository</a></li>
                                <li><a href="{{ $profile->linkedin_url ?? 'https://www.linkedin.com/in/bimo-aditya-pangestu' }}" target="_blank" class="hover:text-white transition-colors">LinkedIn Profile</a></li>
                            </ul>
                        </div>
                    </div>
                </div>

                {{-- Bottom Bar --}}
                <div class="pt-6 border-t border-white/10 flex flex-col md:flex-row items-center justify-between gap-6 md:gap-4">
                    <p class="text-[10px] uppercase tracking-widest opacity-50">
                        Coded in VS Code by {{ $profile->name ?? 'Bimo Aditya' }} &middot; Built with Laravel & Tailwind CSS
                    </p>
                    <div class="flex items-center gap-4">
                        <span class="text-[10px] uppercase tracking-widest opacity-50" data-i18n="footer_join">Join the Journey:</span>
                        <div class="flex items-center gap-3">
                            <a href="{{ $profile->whatsapp ?? 'https://wa.me/62895334634949' }}" target="_blank" rel="noreferrer" class="opacity-70 hover:opacity-100 transition-colors hover:text-white" aria-label="WhatsApp">
                                <i data-lucide="phone" class="w-4 h-4"></i>
                            </a>
                            <a href="{{ $profile->github_url ?? 'https://github.com/bimbim1214' }}" target="_blank" rel="noreferrer" class="opacity-70 hover:opacity-100 transition-colors hover:text-white" aria-label="GitHub">
                                <i data-lucide="github" class="w-4 h-4"></i>
                            </a>
                            <a href="{{ $profile->linkedin_url ?? 'https://www.linkedin.com/in/bimo-aditya-pangestu' }}" target="_blank" rel="noreferrer" class="opacity-70 hover:opacity-100 transition-colors hover:text-white" aria-label="LinkedIn">
                                <i data-lucide="linkedin" class="w-4 h-4"></i>
                            </a>
                            <a href="mailto:{{ $profile->email ?? 'bimoadityapangestu@gmail.com' }}" class="opacity-70 hover:opacity-100 transition-colors hover:text-white" aria-label="Email">
                                <i data-lucide="mail" class="w-4 h-4"></i>
                            </a>
                            <a href="#" class="opacity-70 hover:opacity-100 transition-colors hover:text-white" aria-label="Globe">
                                <i data-lucide="globe" class="w-4 h-4"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </footer>

        </div>
    </div>

    {{-- ═══════════════════════════════════════════════════════
         SCRIPTS
         ═══════════════════════════════════════════════════════ --}}
    <script>
        document.addEventListener('DOMContentLoaded', () => {

            // ─── Initialize Lucide Icons ──────────────────────
            if (typeof lucide !== 'undefined') {
                lucide.createIcons();
            }

            // ─── Cursor Glow Effect ──────────────────────────
            const cursorGlow = document.getElementById('cursor-glow');
            if (cursorGlow) {
                document.addEventListener('mousemove', (e) => {
                    cursorGlow.style.opacity = '1';
                    cursorGlow.style.left = e.clientX + 'px';
                    cursorGlow.style.top = e.clientY + 'px';
                });
                document.addEventListener('mouseleave', () => {
                    cursorGlow.style.opacity = '0';
                });
            }

            // ─── Hero Video Fade System ──────────────────────
            const video = document.getElementById('hero-video');
            if (video) {
                let animFrameId = null;
                let fadingOutRef = false;

                function cancelAnim() {
                    if (animFrameId) {
                        cancelAnimationFrame(animFrameId);
                        animFrameId = null;
                    }
                }

                function fadeVideo(from, to, duration, onDone) {
                    cancelAnim();
                    const start = performance.now();
                    const startOpacity = from;
                    const delta = to - from;

                    function step(now) {
                        const elapsed = now - start;
                        const progress = Math.min(elapsed / duration, 1);
                        video.style.opacity = startOpacity + delta * progress;
                        if (progress < 1) {
                            animFrameId = requestAnimationFrame(step);
                        } else {
                            animFrameId = null;
                            if (onDone) onDone();
                        }
                    }
                    animFrameId = requestAnimationFrame(step);
                }

                video.addEventListener('canplay', function onFirstCanPlay() {
                    video.removeEventListener('canplay', onFirstCanPlay);
                    fadeVideo(0, 1, 500);
                }, { once: true });

                if (video.readyState >= 3) {
                    fadeVideo(0, 1, 500);
                }

                video.addEventListener('timeupdate', () => {
                    if (fadingOutRef) return;
                    if (video.duration && video.currentTime >= video.duration - 0.55) {
                        fadingOutRef = true;
                        const currentOp = parseFloat(video.style.opacity) || 1;
                        fadeVideo(currentOp, 0, 500);
                    }
                });

                video.addEventListener('ended', () => {
                    video.style.opacity = '0';
                    setTimeout(() => {
                        video.currentTime = 0;
                        video.play();
                        fadingOutRef = false;
                        fadeVideo(0, 1, 500);
                    }, 100);
                });
            }

            // ─── Scroll Spy ─────────────────────────────────
            const sections = document.querySelectorAll('section[id]:not(#hero)');
            const navAnchors = document.querySelectorAll('.navbar-float a[href^="#"]');

            if (sections.length && navAnchors.length) {
                const observerOptions = {
                    root: null,
                    rootMargin: '-40% 0px -40% 0px',
                    threshold: 0
                };

                const observerCallback = (entries) => {
                    entries.forEach(entry => {
                        if (entry.isIntersecting) {
                            const id = entry.target.getAttribute('id');
                            navAnchors.forEach(item => {
                                if (item.getAttribute('href') === `#${id}`) {
                                    item.classList.add('text-white');
                                    item.classList.remove('text-white/80');
                                } else if (item.getAttribute('href').startsWith('#')) {
                                    item.classList.remove('text-white');
                                    item.classList.add('text-white/80');
                                }
                            });
                        }
                    });
                };

                const observer = new IntersectionObserver(observerCallback, observerOptions);
                sections.forEach(sec => observer.observe(sec));
            }

            // ─── Dark / Light Mode Toggle ────────────────────
            const themeToggle = document.getElementById('theme-toggle');
            const moonIcon = document.getElementById('theme-icon-moon');
            const sunIcon = document.getElementById('theme-icon-sun');

            function setTheme(mode) {
                if (mode === 'light') {
                    document.documentElement.classList.add('light');
                    if (moonIcon) moonIcon.classList.add('hidden');
                    if (sunIcon) sunIcon.classList.remove('hidden');
                } else {
                    document.documentElement.classList.remove('light');
                    if (moonIcon) moonIcon.classList.remove('hidden');
                    if (sunIcon) sunIcon.classList.add('hidden');
                }
                localStorage.setItem('theme', mode);
            }

            const savedTheme = localStorage.getItem('theme') || 'dark';
            setTheme(savedTheme);

            if (themeToggle) {
                themeToggle.addEventListener('click', () => {
                    const current = document.documentElement.classList.contains('light') ? 'light' : 'dark';
                    setTheme(current === 'light' ? 'dark' : 'light');
                    if (typeof lucide !== 'undefined') lucide.createIcons();
                });
            }

            // ─── Language Translation (ID / EN) ──────────────
            const langToggle = document.getElementById('lang-toggle');
            const langLabel = document.getElementById('lang-label');

            const translations = {
                en: {
                    nav_about: 'About',
                    nav_experience: 'Experience',
                    nav_projects: 'Projects',
                    nav_contact: 'Contact',
                    section_about: 'About',
                    section_experience: 'Experience',
                    section_projects: 'Projects',
                    section_education: 'Education',
                    hero_subtitle: '{{ $profile->short_bio ?? "I build accessible, pixel-perfect digital experiences for the web. Stay updated with the latest news and insights." }}',
                    hero_cv_btn: 'View CV',
                    email_placeholder: 'Enter your email',
                    about_p1: 'I am a fresh graduate from <span class="font-medium themed-text-primary">Information Technology</span> at Universitas Muhammadiyah Yogyakarta (UMY). Experienced in <span class="font-medium themed-text-primary">coding</span> and <span class="font-medium themed-text-primary">development</span> including UI/UX design, with skills as a Full Stack Developer.',
                    about_p2: 'I am accustomed to working on various projects, both individually and collaboratively. I also hold a <span class="font-medium themed-text-primary">Senior Web Developer</span> certification from BNSP, English proficiency, and mastery of various frameworks and templates.',
                    about_p3: 'Currently focused on building a digital portfolio that reflects my skills, while continuously exploring modern web technologies to create effective, inclusive, and user-friendly products.',
                    view_resume_1: 'View Full',
                    view_resume_2: 'Résumé',
                    view_projects_1: 'View Full Project',
                    view_projects_2: 'Archive',
                    exp_fallback_desc: 'Built SIPINTAR SMAN1Kopang — a teacher and student management system with student point calculation.',
                    proj_fallback_desc: 'Integrated teacher, student management, and student point calculation system for SMA Negeri 1 Kopang.',
                    edu_cert: 'Senior Web Developer (Certification)',
                    edu_cert_org: 'National Professional Certification Agency (BNSP)',
                    footer_desc: '{{ $profile->headline ?? "Full Stack Developer & UI/UX Designer" }} based in Yogyakarta. Crafting pixel-perfect, accessible, and high-performance digital experiences.',
                    footer_col1_title: 'Discover',
                    footer_col2_title: 'The Mission',
                    footer_col3_title: 'Concierge',
                    footer_join: 'Join the Journey:',
                },
                id: {
                    nav_about: 'Tentang',
                    nav_experience: 'Pengalaman',
                    nav_projects: 'Proyek',
                    nav_contact: 'Kontak',
                    section_about: 'Tentang',
                    section_experience: 'Pengalaman',
                    section_projects: 'Proyek',
                    section_education: 'Pendidikan',
                    hero_subtitle: '{{ $profile->short_bio ?? "Saya membangun pengalaman digital yang dapat diakses, pixel-perfect untuk web. Tetap terupdate dengan berita dan wawasan terbaru." }}',
                    hero_cv_btn: 'Lihat CV',
                    email_placeholder: 'Masukkan email Anda',
                    about_p1: 'Saya adalah fresh graduate dari <span class="font-medium themed-text-primary">Information Technology</span> di Universitas Muhammadiyah Yogyakarta (UMY). Memiliki pengalaman di bidang <span class="font-medium themed-text-primary">coding</span> dan <span class="font-medium themed-text-primary">development</span> dari UI/UX design, serta memiliki kemampuan sebagai Full Stack Developer.',
                    about_p2: 'Saya terbiasa bekerja dengan berbagai project, baik secara individu maupun kolaborasi. Saya juga memiliki sertifikasi di bidang <span class="font-medium themed-text-primary">Senior Web Developer</span> dari BNSP, kemampuan bahasa Inggris, serta menguasai berbagai framework dan template dalam pengerjaan project.',
                    about_p3: 'Saat ini saya fokus membangun portfolio digital yang mencerminkan skill-skill yang saya miliki, dan terus mengeksplorasi teknologi web modern untuk menciptakan produk yang efektif, inklusif, dan ramah pengguna.',
                    view_resume_1: 'Lihat',
                    view_resume_2: 'CV Lengkap',
                    view_projects_1: 'Lihat Semua',
                    view_projects_2: 'Proyek',
                    exp_fallback_desc: 'Membuat SIPINTAR SMAN1Kopang — sistem pengelolaan guru dan murid, serta kalkulasi perhitungan point murid.',
                    proj_fallback_desc: 'Sistem pengelolaan guru, murid, serta kalkulasi perhitungan poin murid terintegrasi untuk SMA Negeri 1 Kopang.',
                    edu_cert: 'Senior Web Developer (Sertifikasi)',
                    edu_cert_org: 'Badan Nasional Sertifikasi Profesi (BNSP)',
                    footer_desc: '{{ $profile->headline ?? "Full Stack Developer & UI/UX Designer" }} berdomisili di Yogyakarta. Membangun pengalaman digital yang responsif, terakses, dan berkinerja tinggi.',
                    footer_col1_title: 'Jelajahi',
                    footer_col2_title: 'Misi',
                    footer_col3_title: 'Layanan',
                    footer_join: 'Ikuti Perjalanan:',
                }
            };

            function setLang(lang) {
                document.querySelectorAll('[data-i18n]').forEach(el => {
                    const key = el.getAttribute('data-i18n');
                    if (translations[lang] && translations[lang][key]) {
                        el.innerHTML = translations[lang][key];
                    }
                });

                document.querySelectorAll('[data-i18n-placeholder]').forEach(el => {
                    const key = el.getAttribute('data-i18n-placeholder');
                    if (translations[lang] && translations[lang][key]) {
                        el.placeholder = translations[lang][key];
                    }
                });

                document.documentElement.lang = lang;

                if (langLabel) {
                    langLabel.textContent = lang === 'en' ? 'EN' : 'ID';
                }

                localStorage.setItem('lang', lang);
            }

            const savedLang = localStorage.getItem('lang') || 'en';
            setLang(savedLang);

            if (langToggle) {
                langToggle.addEventListener('click', () => {
                    const current = localStorage.getItem('lang') || 'en';
                    setLang(current === 'en' ? 'id' : 'en');
                });
            }

            // ─── Email Submit ────────────────
            const emailInput = document.getElementById('hero-email-input');
            const emailSubmit = document.getElementById('hero-email-submit');
            if (emailSubmit && emailInput) {
                emailSubmit.addEventListener('click', () => {
                    const email = emailInput.value.trim();
                    if (email) {
                        window.location.href = `mailto:{{ $profile->email ?? 'bimoadityapangestu@gmail.com' }}?subject=Contact from Portfolio&body=Hi, my email is ${encodeURIComponent(email)}`;
                        emailInput.value = '';
                    }
                });
                emailInput.addEventListener('keypress', (e) => {
                    if (e.key === 'Enter') emailSubmit.click();
                });
            }

        });
    </script>

</body>

</html>