<!DOCTYPE html>
<html class="dark" lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Project Archive — {{ $profile->name ?? 'Bimo Aditya Pangestu' }}">
    <title>ORBIS.NFT Archive — {{ $profile->name ?? 'Bimo Aditya Pangestu' }}</title>
    
    {{-- Google Fonts: Anton, Condiment --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Anton&family=Condiment&display=swap" rel="stylesheet" />
    
    {{-- Lucide Icons --}}
    <script src="https://unpkg.com/lucide@latest"></script>
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body {
            background-color: #010828;
            color: #EFF4FF;
            margin: 0;
            padding: 0;
            font-family: ui-monospace, SFMono-Regular, Menlo, Monaco, Consolas, "Liberation Mono", "Courier New", monospace;
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

        .anton-text {
            font-family: 'Anton', sans-serif;
            text-transform: uppercase;
        }

        .cursive-text {
            font-family: 'Condiment', cursive;
            color: #6FFF00;
        }
    </style>
</head>
<body class="selection:bg-accent-neon selection:text-void-black">
    <div class="grain-overlay"></div>

    <div class="mx-auto min-h-screen max-w-[1831px] px-6 py-12 md:px-12 md:py-20 lg:px-24">
        <div>
            <a class="group mb-6 inline-flex items-center font-mono text-xs uppercase tracking-widest text-accent-neon hover:underline" href="/">
                <i data-lucide="arrow-left" class="mr-2 h-4 w-4 transition-transform group-hover:-translate-x-2"></i>
                Return to Orbis Main Vault
            </a>
            
            <div class="mb-12">
                <span class="font-mono text-accent-neon text-xs uppercase tracking-[0.5em] block mb-2">Master Index</span>
                <h1 class="anton-text text-5xl md:text-7xl text-white">Full Project <span class="cursive-text normal-case text-4xl md:text-6xl">Archive</span></h1>
            </div>

            <div class="mt-8 overflow-x-auto liquid-glass p-6 rounded-3xl border border-white/10">
                <table class="w-full border-collapse text-left font-mono">
                    <thead class="border-b border-white/10 text-xs uppercase text-white/40 tracking-widest">
                        <tr>
                            <th class="py-4 pr-8">Year</th>
                            <th class="py-4 pr-8">Project</th>
                            <th class="hidden py-4 pr-8 lg:table-cell">Made at</th>
                            <th class="hidden py-4 pr-8 lg:table-cell">Built with</th>
                            <th class="hidden py-4 sm:table-cell">Link</th>
                        </tr>
                    </thead>
                    <tbody class="text-sm divide-y divide-white/5">
                        @forelse($projects as $proj)
                        <tr class="hover:bg-white/[0.02] transition-colors">
                            <td class="py-5 pr-4 align-top text-accent-neon font-bold">
                                {{ $proj->year }}
                            </td>
                            <td class="py-5 pr-4 align-top font-medium text-white">
                                <div class="anton-text text-lg tracking-wide mb-1">{{ $proj->title }}</div>
                                <p class="text-xs text-white/60 font-mono normal-case max-w-md mb-2">{{ $proj->description }}</p>
                                @if($proj->url)
                                <a class="inline-flex items-center text-xs text-accent-neon sm:hidden hover:underline" href="{{ $proj->url }}" target="_blank" rel="noreferrer">
                                    <span>Visit Project</span>
                                    <i data-lucide="arrow-up-right" class="w-3 h-3 ml-1"></i>
                                </a>
                                @endif
                            </td>
                            <td class="hidden py-5 pr-4 align-top text-xs text-white/60 lg:table-cell">
                                {{ $proj->made_at ?? '—' }}
                            </td>
                            <td class="hidden py-5 pr-4 align-top lg:table-cell">
                                <div class="flex flex-wrap gap-1.5">
                                    @foreach($proj->tags ?? [] as $tag)
                                    <span class="text-[9px] font-mono px-2 py-0.5 bg-white/5 border border-white/10 text-white/70 rounded-full">{{ $tag }}</span>
                                    @endforeach
                                </div>
                            </td>
                            <td class="hidden py-5 align-top sm:table-cell text-xs">
                                @if($proj->url)
                                <a class="inline-flex items-center text-accent-neon hover:underline" href="{{ $proj->url }}" target="_blank" rel="noreferrer">
                                    <span>{{ $proj->link_label ?? 'Visit Link' }}</span>
                                    <i data-lucide="arrow-up-right" class="w-3.5 h-3.5 ml-1"></i>
                                </a>
                                @else
                                <span class="text-white/30">—</span>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr class="hover:bg-white/[0.02]">
                            <td class="py-5 pr-4 align-top text-accent-neon font-bold">2026</td>
                            <td class="py-5 pr-4 align-top text-white">
                                <div class="anton-text text-lg">SIPINTAR SMAN1Kopang</div>
                                <p class="text-xs text-white/60 font-mono normal-case mb-2">Integrated school system for SMAN 1 Kopang.</p>
                            </td>
                            <td class="hidden py-5 pr-4 align-top text-xs text-white/60 lg:table-cell">SMAN 1 Kopang</td>
                            <td class="hidden py-5 pr-4 align-top lg:table-cell">
                                <span class="text-[9px] font-mono px-2 py-0.5 bg-white/5 border border-white/10 text-white/70 rounded-full">LARAVEL</span>
                            </td>
                            <td class="hidden py-5 align-top sm:table-cell text-xs">
                                <a class="inline-flex items-center text-accent-neon hover:underline" href="http://sipintarsman1kopang.my.id/" target="_blank">
                                    <span>sipintarsman1kopang.my.id</span>
                                    <i data-lucide="arrow-up-right" class="w-3.5 h-3.5 ml-1"></i>
                                </a>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            if (typeof lucide !== 'undefined') { lucide.createIcons(); }
        });
    </script>
</body>
</html>