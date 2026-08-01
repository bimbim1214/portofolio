<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="All Projects - {{ $profile->name ?? 'Bimo Aditya' }}">
    <title>All Projects - {{ $profile->name ?? 'Bimo Aditya' }}</title>
    
    {{-- Google Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    {{-- Lucide Icons --}}
    <script src="https://unpkg.com/lucide@latest/dist/umd/lucide.js" defer></script>
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-slate-900 leading-relaxed text-slate-400 antialiased selection:bg-teal-300/30 selection:text-teal-300">
    
    {{-- Cursor Glow --}}
    <div id="cursor-glow"></div>

    <div class="mx-auto min-h-screen max-w-screen-xl px-6 py-12 md:px-12 md:py-20 lg:px-24 lg:py-0">
        <div class="lg:py-24">
            <a class="group mb-2 inline-flex items-center font-semibold leading-tight text-teal-300" href="/">
                <i data-lucide="arrow-left" class="mr-1 h-4 w-4 transition-transform group-hover:-translate-x-2"></i>
                {{ $profile->name ?? 'Bimo Aditya' }}
            </a>
            <h1 class="text-4xl font-bold tracking-tight text-slate-200 sm:text-5xl">All Projects</h1>

            <div class="mt-12 sm:mt-24 overflow-x-auto">
                <table class="mt-12 w-full border-collapse text-left">
                    <thead class="sticky top-0 z-10 border-b border-slate-300/10 bg-slate-900/75 px-6 py-5 backdrop-blur">
                        <tr>
                            <th class="py-4 pr-8 text-sm font-semibold text-slate-200">Year</th>
                            <th class="py-4 pr-8 text-sm font-semibold text-slate-200">Project</th>
                            <th class="hidden py-4 pr-8 text-sm font-semibold text-slate-200 lg:table-cell">Made at</th>
                            <th class="hidden py-4 pr-8 text-sm font-semibold text-slate-200 lg:table-cell">Built with</th>
                            <th class="hidden py-4 pr-8 text-sm font-semibold text-slate-200 sm:table-cell">Link</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($projects as $proj)
                        <tr class="border-b border-slate-300/10 last:border-none">
                            <td class="py-4 pr-4 align-top text-sm">
                                <div class="translate-y-px">{{ $proj->year }}</div>
                            </td>
                            <td class="py-4 pr-4 align-top font-semibold leading-snug text-slate-200">
                                <div class="block sm:hidden mb-1">
                                    @if($proj->url)
                                    <a class="inline-flex items-baseline font-medium leading-tight text-slate-200 hover:text-teal-300 focus-visible:text-teal-300 sm:hidden group/link text-base" href="{{ $proj->url }}" target="_blank" rel="noreferrer">
                                        <span>{{ $proj->title }} <i data-lucide="arrow-up-right" class="inline-block w-4 h-4 ml-1 transition-transform group-hover/link:-translate-y-1 group-hover/link:translate-x-1"></i></span>
                                    </a>
                                    @else
                                    <span>{{ $proj->title }}</span>
                                    @endif
                                </div>
                                <div class="hidden sm:block">{{ $proj->title }}</div>
                            </td>
                            <td class="hidden py-4 pr-4 align-top text-sm lg:table-cell">
                                <div class="translate-y-px whitespace-nowrap">{{ $proj->made_at ?? '—' }}</div>
                            </td>
                            <td class="hidden py-4 pr-4 align-top lg:table-cell">
                                <ul class="flex -translate-y-1.5 flex-wrap">
                                    @foreach($proj->tags ?? [] as $tag)
                                    <li class="my-1 mr-1.5"><div class="skill-badge">{{ $tag }}</div></li>
                                    @endforeach
                                </ul>
                            </td>
                            <td class="hidden py-4 align-top sm:table-cell">
                                <ul class="translate-y-1">
                                    @if($proj->url)
                                    <li class="mb-1 flex items-center">
                                        <a class="inline-flex items-baseline font-medium leading-tight text-slate-400 hover:text-teal-300 focus-visible:text-teal-300 text-sm group/link" href="{{ $proj->url }}" target="_blank" rel="noreferrer">
                                            <span>{{ $proj->link_label ?? $proj->url }} <i data-lucide="arrow-up-right" class="inline-block w-3 h-3 ml-1 transition-transform group-hover/link:-translate-y-1 group-hover/link:translate-x-1"></i></span>
                                        </a>
                                    </li>
                                    @else
                                    <li class="mb-1 text-slate-600 text-sm">—</li>
                                    @endif
                                </ul>
                            </td>
                        </tr>
                        @empty
                        {{-- Fallback static rows --}}
                        <tr class="border-b border-slate-300/10 last:border-none">
                            <td class="py-4 pr-4 align-top text-sm"><div class="translate-y-px">2026</div></td>
                            <td class="py-4 pr-4 align-top font-semibold leading-snug text-slate-200">
                                <div class="block sm:hidden mb-1"><a class="inline-flex items-baseline font-medium leading-tight text-slate-200 hover:text-teal-300 focus-visible:text-teal-300 sm:hidden group/link text-base" href="http://sipintarsman1kopang.my.id/" target="_blank" rel="noreferrer"><span>SIPINTAR SMAN1Kopang <i data-lucide="arrow-up-right" class="inline-block w-4 h-4 ml-1 transition-transform group-hover/link:-translate-y-1 group-hover/link:translate-x-1"></i></span></a></div>
                                <div class="hidden sm:block">SIPINTAR SMAN1Kopang</div>
                            </td>
                            <td class="hidden py-4 pr-4 align-top text-sm lg:table-cell"><div class="translate-y-px whitespace-nowrap">SMAN 1 Kopang</div></td>
                            <td class="hidden py-4 pr-4 align-top lg:table-cell"><ul class="flex -translate-y-1.5 flex-wrap"><li class="my-1 mr-1.5"><div class="skill-badge">Laravel</div></li><li class="my-1 mr-1.5"><div class="skill-badge">Tailwind CSS</div></li></ul></td>
                            <td class="hidden py-4 align-top sm:table-cell"><ul class="translate-y-1"><li class="mb-1 flex items-center"><a class="inline-flex items-baseline font-medium leading-tight text-slate-400 hover:text-teal-300 focus-visible:text-teal-300 text-sm group/link" href="http://sipintarsman1kopang.my.id/" target="_blank" rel="noreferrer"><span>sipintarsman1kopang.my.id <i data-lucide="arrow-up-right" class="inline-block w-3 h-3 ml-1 transition-transform group-hover/link:-translate-y-1 group-hover/link:translate-x-1"></i></span></a></li></ul></td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- Script for Lucide Icons and Cursor Glow --}}
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            if (typeof lucide !== 'undefined') { lucide.createIcons(); }
            const cursorGlow = document.getElementById('cursor-glow');
            if (cursorGlow) {
                document.addEventListener('mousemove', (e) => {
                    cursorGlow.style.opacity = '1';
                    cursorGlow.style.left = e.clientX + 'px';
                    cursorGlow.style.top = e.clientY + 'px';
                });
                document.addEventListener('mouseleave', () => { cursorGlow.style.opacity = '0'; });
            }
        });
    </script>
</body>
</html>