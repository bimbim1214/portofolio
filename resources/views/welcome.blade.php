<!DOCTYPE html>
<html class="dark" lang="en">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <meta name="description" content="{{ $profile->headline ?? 'Bimo Aditya Pangestu — Full Stack Developer & UI/UX Designer' }} portfolio." />
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
            background-color: #010828;
            color: #EFF4FF;
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
    </style>
</head>

<body class="selection:bg-accent-neon selection:text-void-black">
    <div class="grain-overlay"></div>

    {{-- Navigation --}}
    <nav class="fixed top-6 left-1/2 -translate-x-1/2 z-[60] w-[95%] max-w-[1831px] flex items-center justify-between px-8 py-4 rounded-full liquid-glass">
        <div class="flex items-center gap-4 cursor-pointer" onclick="window.scrollTo({top: 0, behavior: 'smooth'})">
            <span class="anton-text text-2xl tracking-tighter">ORBIS.NFT</span>
            <span class="text-accent-neon text-xs font-mono uppercase tracking-[0.2em] hidden md:block border-l border-white/20 pl-4">Digital Collection</span>
        </div>
        <div class="hidden md:flex items-center gap-10 font-mono text-sm uppercase tracking-widest">
            <a class="hover:text-accent-neon transition-colors" href="#projects">Work</a>
            <a class="hover:text-accent-neon transition-colors" href="#about">Experience</a>
            <a class="hover:text-accent-neon transition-colors" href="#certifications">Expertise</a>
        </div>
        <a href="#contact" class="px-6 py-2 rounded-full border border-white/20 font-mono text-xs uppercase tracking-widest hover:bg-accent-neon hover:text-void-black hover:border-accent-neon transition-all">
            Get Access
        </a>
    </nav>

    {{-- Section 1: Hero --}}
    <section class="video-container" id="hero">
        <video autoplay class="section-video" loop muted playsinline>
            <source src="https://d8j0ntlcm91z4.cloudfront.net/user_38xzZboKViGWJOttwIXH07lWA1P/hf_20260331_045634_e1c98c76-1265-4f5c-882a-4276f2080894.mp4" type="video/mp4" />
        </video>
        <div class="absolute inset-0 bg-void-black/40 z-0"></div>
        <div class="max-container relative z-10 text-center space-y-6 motion-fade-up">
            <p class="font-mono text-accent-neon text-sm uppercase tracking-[0.4em] mb-4">Space Archetype 001</p>
            <h1 class="anton-text text-[8vw] md:text-[6.5vw] leading-[0.9] text-white">
                Beyond earth and <br />
                <span class="inline-flex items-center gap-4">
                    ( its ) <span class="cursive-text normal-case text-[5vw] md:text-[4vw]">Nft collection</span>
                </span><br />
                familiar boundaries
            </h1>
            <div class="flex flex-col items-center gap-8 mt-12">
                <p class="max-w-2xl text-secondary text-sm md:text-base leading-relaxed font-mono uppercase tracking-wide">
                    Crafted by <span class="text-white">{{ $profile->name ?? 'Bimo Aditya Pangestu' }}</span> — {{ $profile->headline ?? 'Full Stack Developer & UI/UX Designer building the infrastructure of the digital frontier.' }}
                </p>
                <div class="flex gap-4">
                    <a href="#projects" class="px-10 py-4 bg-accent-neon text-void-black anton-text text-xl hover:scale-105 transition-transform rounded-sm inline-block">
                        MINT PORTFOLIO
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
                <div class="inline-block px-4 py-1 border border-accent-neon/30 rounded-full text-accent-neon font-mono text-xs uppercase tracking-widest">
                    Origin Story
                </div>
                <h2 class="anton-text text-6xl md:text-8xl leading-tight text-white">
                    Hello!<br />
                    I'm <span class="cursive-text normal-case text-5xl md:text-7xl block md:inline">Bimo</span>
                </h2>
                <div class="space-y-6 text-secondary font-mono text-sm uppercase tracking-loose max-w-lg">
                    <p>
                        {{ $profile->short_bio ?? 'As an Information Technology graduate from UMY and BNSP-certified Senior Web Developer, I bridge the gap between complex backend architecture and immersive frontend aesthetics. I specialize in building accessible, high-performance digital ecosystems that prioritize human-centric interaction.' }}
                    </p>
                </div>
                <div class="grid grid-cols-2 gap-4 pt-4">
                    <div class="liquid-glass p-4 rounded-xl border border-white/10">
                        <p class="text-accent-neon anton-text text-3xl">4+</p>
                        <p class="font-mono text-[10px] uppercase text-white/60">Years Experience</p>
                    </div>
                    <div class="liquid-glass p-4 rounded-xl border border-white/10">
                        <p class="text-accent-neon anton-text text-3xl">12+</p>
                        <p class="font-mono text-[10px] uppercase text-white/60">Major Missions</p>
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
                    <span class="font-mono text-accent-neon text-xs uppercase tracking-[0.5em]">Selected Archives</span>
                    <h2 class="anton-text text-6xl md:text-7xl text-white">Project <span class="cursive-text normal-case text-5xl md:text-6xl">Vault</span></h2>
                </div>
                <p class="max-w-xs text-xs font-mono uppercase text-secondary/60 leading-relaxed">
                    A curated selection of high-rarity digital assets and functional infrastructures developed for various sectors.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">

                {{-- Project 1: SIPINTAR --}}
                <div class="liquid-glass rounded-3xl overflow-hidden group border border-white/5 hover:border-accent-neon/30 transition-all duration-500 motion-fade-up">
                    <div class="relative aspect-[4/5]">
                        <video autoplay class="absolute inset-0 w-full h-full object-cover grayscale group-hover:grayscale-0 transition-all duration-700" loop muted playsinline>
                            <source src="https://d8j0ntlcm91z4.cloudfront.net/user_38xzZboKViGWJOttwIXH07lWA1P/hf_20260331_053923_22c0a6a5-313c-474c-85ff-3b50d25e944a.mp4" type="video/mp4" />
                        </video>
                        <div class="absolute inset-0 bg-gradient-to-t from-void-black via-transparent to-transparent"></div>
                        <div class="absolute bottom-0 left-0 right-0 p-8 space-y-4">
                            <div class="flex justify-between items-end">
                                <div>
                                    <p class="text-[10px] font-mono uppercase text-accent-neon tracking-widest mb-1">Web Application</p>
                                    <h3 class="anton-text text-3xl text-white">SIPINTAR</h3>
                                </div>
                                <div class="text-right">
                                    <p class="text-[10px] font-mono text-white/40 uppercase">Rarity</p>
                                    <p class="font-mono text-white text-sm">EPIC</p>
                                </div>
                            </div>
                            <div class="space-y-2">
                                <div class="rarity-bar"><div class="rarity-fill w-[88%]"></div></div>
                                <div class="flex justify-between text-[10px] font-mono text-white/40">
                                    <span>UTILITY: CORE</span>
                                    <span>88%</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="p-8 space-y-4">
                        <p class="text-xs text-secondary/80 font-mono uppercase leading-relaxed h-12 overflow-hidden">Integrated school information system for SMAN 1 Kopang.</p>
                        <div class="flex flex-wrap gap-2">
                            <span class="text-[9px] font-mono px-2 py-1 bg-white/5 border border-white/10 text-white/60">LARAVEL</span>
                            <span class="text-[9px] font-mono px-2 py-1 bg-white/5 border border-white/10 text-white/60">MYSQL</span>
                        </div>
                    </div>
                </div>

                {{-- Project 2: SKRIPSI PLATFORM --}}
                <div class="liquid-glass rounded-3xl overflow-hidden group border border-white/5 hover:border-accent-neon/30 transition-all duration-500 motion-fade-up">
                    <div class="relative aspect-[4/5]">
                        <video autoplay class="absolute inset-0 w-full h-full object-cover grayscale group-hover:grayscale-0 transition-all duration-700" loop muted playsinline>
                            <source src="https://d8j0ntlcm91z4.cloudfront.net/user_38xzZboKViGWJOttwIXH07lWA1P/hf_20260331_054411_511c1b7a-fb2f-42ef-bf6c-32c0b1a06e79.mp4" type="video/mp4" />
                        </video>
                        <div class="absolute inset-0 bg-gradient-to-t from-void-black via-transparent to-transparent"></div>
                        <div class="absolute bottom-0 left-0 right-0 p-8 space-y-4">
                            <div class="flex justify-between items-end">
                                <div>
                                    <p class="text-[10px] font-mono uppercase text-accent-neon tracking-widest mb-1">Research & Dev</p>
                                    <h3 class="anton-text text-3xl text-white">SKRIPSI PLATFORM</h3>
                                </div>
                                <div class="text-right">
                                    <p class="text-[10px] font-mono text-white/40 uppercase">Rarity</p>
                                    <p class="font-mono text-white text-sm">LEGENDARY</p>
                                </div>
                            </div>
                            <div class="space-y-2">
                                <div class="rarity-bar"><div class="rarity-fill w-[94%]"></div></div>
                                <div class="flex justify-between text-[10px] font-mono text-white/40">
                                    <span>UTILITY: RESEARCH</span>
                                    <span>94%</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="p-8 space-y-4">
                        <p class="text-xs text-secondary/80 font-mono uppercase leading-relaxed h-12 overflow-hidden">Collaborative thesis management for university workflows.</p>
                        <div class="flex flex-wrap gap-2">
                            <span class="text-[9px] font-mono px-2 py-1 bg-white/5 border border-white/10 text-white/60">POSTGRES</span>
                            <span class="text-[9px] font-mono px-2 py-1 bg-white/5 border border-white/10 text-white/60">ALPINE.JS</span>
                        </div>
                    </div>
                </div>

                {{-- Project 3: NEO ARCHIVE --}}
                <div class="liquid-glass rounded-3xl overflow-hidden group border border-white/5 hover:border-accent-neon/30 transition-all duration-500 motion-fade-up">
                    <div class="relative aspect-[4/5]">
                        <video autoplay class="absolute inset-0 w-full h-full object-cover grayscale group-hover:grayscale-0 transition-all duration-700" loop muted playsinline>
                            <source src="https://d8j0ntlcm91z4.cloudfront.net/user_38xzZboKViGWJOttwIXH07lWA1P/hf_20260331_055427_ac7035b5-9f3b-4289-86fc-941b2432317d.mp4" type="video/mp4" />
                        </video>
                        <div class="absolute inset-0 bg-gradient-to-t from-void-black via-transparent to-transparent"></div>
                        <div class="absolute bottom-0 left-0 right-0 p-8 space-y-4">
                            <div class="flex justify-between items-end">
                                <div>
                                    <p class="text-[10px] font-mono uppercase text-accent-neon tracking-widest mb-1">Coming Soon</p>
                                    <h3 class="anton-text text-3xl text-white">NEO ARCHIVE</h3>
                                </div>
                                <div class="text-right">
                                    <p class="text-[10px] font-mono text-white/40 uppercase">Status</p>
                                    <p class="font-mono text-white text-sm">ENCRYPTED</p>
                                </div>
                            </div>
                            <div class="space-y-2">
                                <div class="rarity-bar"><div class="rarity-fill w-[15%]"></div></div>
                                <div class="flex justify-between text-[10px] font-mono text-white/40">
                                    <span>DECRYPTING...</span>
                                    <span>15%</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="p-8 space-y-4">
                        <p class="text-xs text-secondary/80 font-mono uppercase leading-relaxed h-12 overflow-hidden">New experimental project currently under development.</p>
                        <div class="flex flex-wrap gap-2">
                            <span class="text-[9px] font-mono px-2 py-1 bg-white/5 border border-white/10 text-white/60">THREE.JS</span>
                            <span class="text-[9px] font-mono px-2 py-1 bg-white/5 border border-white/10 text-white/60">WEBGL</span>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    {{-- Section 4: Certifications (Credentials Verified) --}}
    <section class="py-32 bg-surface border-t border-white/5" id="certifications">
        <div class="max-container">
            <div class="flex flex-col md:flex-row md:items-end justify-between mb-20 gap-8 motion-fade-up">
                <div class="space-y-4">
                    <span class="font-mono text-accent-neon text-xs uppercase tracking-[0.5em]">Qualified Archives</span>
                    <h2 class="anton-text text-6xl md:text-7xl text-white">Credentials <span class="cursive-text normal-case text-5xl md:text-6xl">Verified</span></h2>
                </div>
                <p class="max-w-xs text-xs font-mono uppercase text-secondary/60 leading-relaxed">
                    Professional validations and industry-standard certifications acquired through rigorous assessment.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                @forelse($certifications as $cert)
                <div class="liquid-glass rounded-3xl overflow-hidden group border border-white/5 hover:border-accent-neon/30 transition-all duration-500 p-8 flex flex-col justify-between min-h-[300px] motion-fade-up">
                    <div class="flex justify-between items-start">
                        <div class="w-12 h-12 rounded-xl bg-white/5 border border-white/10 flex items-center justify-center">
                            <span class="material-symbols-outlined text-accent-neon">{{ $cert->icon ?? 'verified_user' }}</span>
                        </div>
                        <div class="px-3 py-1 rounded-full border border-accent-neon/30 text-accent-neon text-[10px] font-mono uppercase tracking-widest">
                            Verified
                        </div>
                    </div>
                    <div class="mt-12 space-y-2">
                        <p class="text-[10px] font-mono uppercase text-secondary/60 tracking-widest">Issuing Org: {{ $cert->issuer }}</p>
                        <h3 class="anton-text text-3xl md:text-4xl text-white">{{ $cert->title }}</h3>
                        <p class="text-xs font-mono text-white/40 uppercase tracking-tighter">{{ $cert->issuer_full ?? $cert->issuer }}</p>
                    </div>
                </div>
                @empty
                {{-- Cert 1: BNSP --}}
                <div class="liquid-glass rounded-3xl overflow-hidden group border border-white/5 hover:border-accent-neon/30 transition-all duration-500 p-8 flex flex-col justify-between min-h-[300px] motion-fade-up">
                    <div class="flex justify-between items-start">
                        <div class="w-12 h-12 rounded-xl bg-white/5 border border-white/10 flex items-center justify-center">
                            <span class="material-symbols-outlined text-accent-neon">verified_user</span>
                        </div>
                        <div class="px-3 py-1 rounded-full border border-accent-neon/30 text-accent-neon text-[10px] font-mono uppercase tracking-widest">
                            Verified
                        </div>
                    </div>
                    <div class="mt-12 space-y-2">
                        <p class="text-[10px] font-mono uppercase text-secondary/60 tracking-widest">Issuing Org: BNSP</p>
                        <h3 class="anton-text text-3xl md:text-4xl text-white">SENIOR WEB DEVELOPER</h3>
                        <p class="text-xs font-mono text-white/40 uppercase tracking-tighter">Badan Nasional Sertifikasi Profesi</p>
                    </div>
                </div>

                {{-- Cert 2: Certiport --}}
                <div class="liquid-glass rounded-3xl overflow-hidden group border border-white/5 hover:border-accent-neon/30 transition-all duration-500 p-8 flex flex-col justify-between min-h-[300px] motion-fade-up">
                    <div class="flex justify-between items-start">
                        <div class="w-12 h-12 rounded-xl bg-white/5 border border-white/10 flex items-center justify-center">
                            <span class="material-symbols-outlined text-accent-neon">terminal</span>
                        </div>
                        <div class="px-3 py-1 rounded-full border border-accent-neon/30 text-accent-neon text-[10px] font-mono uppercase tracking-widest">
                            Verified
                        </div>
                    </div>
                    <div class="mt-12 space-y-2">
                        <p class="text-[10px] font-mono uppercase text-secondary/60 tracking-widest">Issuing Org: Certiport</p>
                        <h3 class="anton-text text-3xl md:text-4xl text-white">SOFTWARE DEVELOPMENT</h3>
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
            <h2 class="anton-text text-5xl md:text-7xl lg:text-8xl text-white">Let's build <span class="cursive-text normal-case">together</span></h2>
            
            {{-- Contact Card Container (Rectangular Liquid Glass Card like Certificate & Image 2) --}}
            <div class="liquid-glass rounded-3xl border border-white/10 p-8 sm:p-10 text-left max-w-xl mx-auto shadow-2xl relative overflow-hidden backdrop-blur-xl">
                {{-- Top Header Row --}}
                <div class="mb-2">
                    <h3 class="text-2xl font-bold text-white tracking-tight">Contact</h3>
                </div>
                <p class="text-xs sm:text-sm font-mono text-white/60 mb-6 leading-relaxed">
                    Have something to discuss? Send me a message and let's talk.
                </p>

                {{-- Contact Form --}}
                <form id="contact-form" onsubmit="handleFormSubmit(event)" class="space-y-4">
                    {{-- Name Input --}}
                    <div class="relative">
                        <div class="absolute left-4 top-1/2 -translate-y-1/2 text-white/40 pointer-events-none">
                            <i data-lucide="user" class="w-4 h-4"></i>
                        </div>
                        <input type="text" id="contact-name" required placeholder="Your Name"
                            class="w-full bg-white/5 border border-white/10 rounded-2xl py-3.5 pl-11 pr-4 text-sm text-white placeholder:text-white/30 focus:outline-none focus:border-accent-neon focus:bg-white/[0.08] transition-all" />
                    </div>

                    {{-- Email Input --}}
                    <div class="relative">
                        <div class="absolute left-4 top-1/2 -translate-y-1/2 text-white/40 pointer-events-none">
                            <i data-lucide="mail" class="w-4 h-4"></i>
                        </div>
                        <input type="email" id="contact-email" required placeholder="Your Email"
                            class="w-full bg-white/5 border border-white/10 rounded-2xl py-3.5 pl-11 pr-4 text-sm text-white placeholder:text-white/30 focus:outline-none focus:border-accent-neon focus:bg-white/[0.08] transition-all" />
                    </div>

                    {{-- Message Input --}}
                    <div class="relative">
                        <div class="absolute left-4 top-4 text-white/40 pointer-events-none">
                            <i data-lucide="message-square" class="w-4 h-4"></i>
                        </div>
                        <textarea id="contact-message" rows="3" required placeholder="Your Message"
                            class="w-full bg-white/5 border border-white/10 rounded-2xl py-3.5 pl-11 pr-4 text-sm text-white placeholder:text-white/30 focus:outline-none focus:border-accent-neon focus:bg-white/[0.08] transition-all resize-none"></textarea>
                    </div>

                    {{-- Submit Button --}}
                    <button type="submit" id="contact-submit-btn"
                        class="w-full bg-white text-void-black font-semibold rounded-2xl py-3.5 px-6 flex items-center justify-center gap-2 hover:bg-accent-neon hover:scale-[1.02] active:scale-[0.98] transition-all duration-300 shadow-lg cursor-pointer">
                        <i data-lucide="send" class="w-4 h-4"></i>
                        <span>Send Message</span>
                    </button>
                </form>

                {{-- Status Alert --}}
                <div id="contact-alert" class="hidden mt-4 p-3 rounded-xl bg-accent-neon/20 border border-accent-neon text-accent-neon text-xs font-mono text-center">
                    Message received! Thank you for reaching out.
                </div>

                {{-- Divider --}}
                <div class="mt-8 pt-6 border-t border-white/10">
                    <p class="text-[10px] font-mono uppercase text-white/40 tracking-widest text-center mb-4">Direct Channels</p>
                    
                    {{-- Circular Contact Field Buttons (Email, WA, GitHub, LinkedIn) --}}
                    <div class="flex items-center justify-center gap-4">
                        {{-- Email --}}
                        <a href="mailto:{{ $profile->email ?? 'bimoadityapangestu@gmail.com' }}"
                            class="w-12 h-12 rounded-full liquid-glass border border-white/15 flex items-center justify-center text-white/80 hover:text-accent-neon hover:border-accent-neon hover:scale-110 transition-all shadow-md group"
                            title="Send Email: {{ $profile->email ?? 'bimoadityapangestu@gmail.com' }}">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 group-hover:rotate-12 transition-transform" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <rect width="20" height="16" x="2" y="4" rx="2"/>
                                <path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"/>
                            </svg>
                        </a>

                        {{-- WhatsApp --}}
                        <a href="{{ $profile->whatsapp ?? 'https://wa.me/62895334634949' }}" target="_blank" rel="noreferrer"
                            class="w-12 h-12 rounded-full liquid-glass border border-white/15 flex items-center justify-center text-white/80 hover:text-accent-neon hover:border-accent-neon hover:scale-110 transition-all shadow-md group"
                            title="Chat via WhatsApp">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 group-hover:rotate-12 transition-transform" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/>
                            </svg>
                        </a>

                        {{-- GitHub --}}
                        <a href="{{ $profile->github_url ?? 'https://github.com/bimbim1214' }}" target="_blank" rel="noreferrer"
                            class="w-12 h-12 rounded-full liquid-glass border border-white/15 flex items-center justify-center text-white/80 hover:text-accent-neon hover:border-accent-neon hover:scale-110 transition-all shadow-md group"
                            title="GitHub Repository">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 group-hover:rotate-12 transition-transform" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M15 22v-4a4.8 4.8 0 0 0-1-3.02c3.18-.35 6.5-1.5 6.5-7a4.6 4.6 0 0 0-1.39-3.23 4.2 4.2 0 0 0-.1-3.2s-1.1-.35-3.5 1.25a11.9 11.9 0 0 0-6 0C7.1 2.85 6 3.2 6 3.2a4.2 4.2 0 0 0-.1 3.23A4.6 4.6 0 0 0 4.5 9.6c0 5.5 3.3 6.65 6.5 7a4.8 4.8 0 0 0-1 3.03V22"></path>
                                <path d="M9 20c-5 1.5-5-2.5-7-3"></path>
                            </svg>
                        </a>

                        {{-- LinkedIn --}}
                        <a href="{{ $profile->linkedin_url ?? 'https://www.linkedin.com/in/bimo-aditya-pangestu' }}" target="_blank" rel="noreferrer"
                            class="w-12 h-12 rounded-full liquid-glass border border-white/15 flex items-center justify-center text-white/80 hover:text-accent-neon hover:border-accent-neon hover:scale-110 transition-all shadow-md group"
                            title="LinkedIn Profile">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 group-hover:rotate-12 transition-transform" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-2-2 2 2 0 0 0-2 2v7h-4v-7a6 6 0 0 1 6-6z"></path>
                                <rect width="4" height="12" x="2" y="9"></rect>
                                <circle cx="4" cy="4" r="2"></circle>
                            </svg>
                        </a>
                    </div>
                </div>

            </div>

            <p class="text-[10px] font-mono uppercase text-white/40 tracking-[0.3em] pt-2">Operational 24/7 in the digital ether</p>
        </div>
    </section>

    {{-- Footer --}}
    <footer class="bg-surface py-12 border-t border-white/5 relative z-20">
        <div class="max-container flex flex-col md:flex-row justify-between items-center gap-8">
            <div class="font-mono text-[10px] uppercase text-white/30 tracking-[0.2em]">
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

    {{-- Scripts: Lucide Icons, Copy Email Logic, & Framer Motion Scroll Observer --}}
    <script>
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

        // Form submission handling logic — Opens user's email client directly with prefilled details
        function handleFormSubmit(e) {
            e.preventDefault();
            const btn = document.getElementById('contact-submit-btn');
            const alert = document.getElementById('contact-alert');
            const name = document.getElementById('contact-name').value.trim();
            const email = document.getElementById('contact-email').value.trim();
            const message = document.getElementById('contact-message').value.trim();

            const targetEmail = "{{ $profile->email ?? 'bimoadityapangestu@gmail.com' }}";
            const subject = encodeURIComponent(`Portfolio Message from ${name}`);
            const body = encodeURIComponent(`Halo Bimo,\n\nNama: ${name}\nEmail: ${email}\n\nPesan:\n${message}\n\n---\nDikirim dari Form Kontak Portfolio`);

            const mailtoUrl = `mailto:${targetEmail}?subject=${subject}&body=${body}`;

            if (btn) {
                btn.innerHTML = '<i data-lucide="check" class="w-4 h-4 text-accent-neon"></i><span class="text-accent-neon">Membuka Email...</span>';
                if (typeof lucide !== 'undefined') lucide.createIcons();
            }

            if (alert) {
                alert.innerText = `Aplikasi email Anda sedang dibuka untuk mengirim pesan langsung ke ${targetEmail}.`;
                alert.classList.remove('hidden');
            }

            // Launch default mail client directly
            window.location.href = mailtoUrl;

            setTimeout(() => {
                if (btn) {
                    btn.innerHTML = '<i data-lucide="send" class="w-4 h-4"></i><span>Send Message</span>';
                    if (typeof lucide !== 'undefined') lucide.createIcons();
                }
            }, 3000);
        }

        // Framer Motion Style Scroll Observer
        document.addEventListener('DOMContentLoaded', () => {
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
        });
    </script>
</body>

</html>