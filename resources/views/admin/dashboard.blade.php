<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Console Dashboard — Orbis Portfolio Administration</title>
    
    {{-- Custom Admin Stylesheet --}}
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
    
    {{-- Google Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Anton&family=Condiment&family=Fira+Code:wght@400;500;600&family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet" />

    <style>
        .anton-text {
            font-family: 'Anton', sans-serif;
            text-transform: uppercase;
        }
        .cursive-text {
            font-family: 'Condiment', cursive;
            color: #6FFF00;
        }
        .cert-badge-active {
            background-color: rgba(111, 255, 0, 0.1);
            color: #6FFF00;
            border: 1px solid rgba(111, 255, 0, 0.3);
            padding: 2px 8px;
            border-radius: 12px;
            font-size: 0.65rem;
            font-family: var(--font-mono);
            text-transform: uppercase;
        }

        /* Modal Overlay & Dialog Styles */
        .modal-overlay {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: rgba(3, 7, 18, 0.85);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            z-index: 99999;
            display: none;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .modal-overlay.active {
            display: flex;
            animation: modalFadeIn 0.2s ease-out;
        }

        @keyframes modalFadeIn {
            from { opacity: 0; transform: scale(0.97); }
            to { opacity: 1; transform: scale(1); }
        }

        .modal-card {
            background-color: var(--bg-card);
            border: 1px solid var(--border-focus);
            border-radius: 20px;
            width: 100%;
            max-width: 600px;
            max-height: 90vh;
            overflow-y: auto;
            box-shadow: 0 25px 60px rgba(0, 0, 0, 0.8), 0 0 40px rgba(156, 252, 230, 0.1);
            display: flex;
            flex-direction: column;
        }

        .modal-header {
            padding: 20px 24px;
            border-bottom: 1px solid var(--border-thin);
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: var(--bg-card-alt);
        }

        .modal-title {
            font-size: 1.1rem;
            font-weight: 700;
            color: var(--text-primary);
            font-family: var(--font-ui);
        }

        .modal-close-btn {
            background: transparent;
            border: none;
            color: var(--text-muted);
            font-size: 1.6rem;
            cursor: pointer;
            line-height: 1;
            padding: 0;
        }

        .modal-close-btn:hover {
            color: var(--accent-mint);
        }

        .modal-body {
            padding: 24px;
            flex: 1;
            overflow-y: auto;
        }

        .modal-footer {
            padding: 16px 24px;
            border-top: 1px solid var(--border-thin);
            display: flex;
            justify-content: flex-end;
            gap: 12px;
            background-color: var(--bg-card-alt);
        }
    </style>
</head>
<body>

    <div class="admin-container">
        
        {{-- ── SIDEBAR ─────────────────────────────────────────────── --}}
        <aside class="sidebar">
            
            {{-- Header --}}
            <div class="sidebar-header">
                <img src="{{ $profile && $profile->photo_path ? asset($profile->photo_path) : asset('images/fotoshot.png') }}" alt="Admin Avatar" class="sidebar-avatar">
                <div class="sidebar-title-container">
                    <span class="sidebar-title">{{ $profile->name ?? 'Bimo Aditya' }}</span>
                    <span class="sidebar-subtitle" style="color: #6FFF00;">System Root</span>
                </div>
            </div>

            {{-- Nav Tabs --}}
            <nav class="sidebar-nav">
                <button class="nav-tab active" onclick="switchTab('overview', this)" id="tab-overview-btn">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v4a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v4a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v4a2 2 0 01-2 2H6a2 2 0 01-2-2v-4zM14 16a2 2 0 012-2h2a2 2 0 012 2v4a2 2 0 01-2 2h-2a2 2 0 01-2-2v-4z"/>
                    </svg>
                    <span>Overview</span>
                </button>

                <button class="nav-tab" onclick="switchTab('profile', this)" id="tab-profile-btn">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                    </svg>
                    <span>Profile Identity</span>
                </button>

                <button class="nav-tab" onclick="switchTab('projects', this)" id="tab-projects-btn">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                    </svg>
                    <span>Projects Vault</span>
                </button>

                <button class="nav-tab" onclick="switchTab('certifications', this)" id="tab-certifications-btn">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/>
                    </svg>
                    <span>Certifications</span>
                </button>

                <button class="nav-tab" onclick="switchTab('experience', this)" id="tab-experience-btn">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                    </svg>
                    <span>Experience Log</span>
                </button>

                <button class="nav-tab" onclick="switchTab('cv', this)" id="tab-cv-btn">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                    <span>CV Manager</span>
                </button>
            </nav>

            {{-- Footer --}}
            <div class="sidebar-footer">
                <a href="/" target="_blank" class="nav-tab" style="padding: 8px 16px; font-family: var(--font-mono); font-size: 0.72rem; text-transform: uppercase;">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                    </svg>
                    <span>Portfolio Site</span>
                </a>
                <form action="{{ route('admin.logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="nav-tab" style="color: var(--accent-red); padding: 8px 16px; font-family: var(--font-mono); font-size: 0.72rem; text-transform: uppercase; width: 100%;">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                        </svg>
                        <span>Logout</span>
                    </button>
                </form>
            </div>
        </aside>

        {{-- ── MAIN CONTENT ────────────────────────────────────────── --}}
        <main class="main-content">
            
            {{-- Top Header --}}
            <div class="top-header">
                <div class="breadcrumbs">
                    <span class="root">Console</span>
                    <span class="divider">/</span>
                    <span class="current" id="breadcrumb-section">Overview</span>
                </div>

                <div class="header-actions">
                    <img src="{{ $profile && $profile->photo_path ? asset($profile->photo_path) : asset('images/fotoshot.png') }}" alt="Profile" class="header-avatar">
                </div>
            </div>

            {{-- Flash Alerts --}}
            @if(session('success'))
                <div class="alert alert-success" id="flash-alert" style="margin-bottom: 0;">
                    <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4"/></svg>
                    <span>{{ session('success') }}</span>
                </div>
            @endif

            @if($errors->any())
                <div class="alert alert-danger" id="flash-alert-error" style="margin-bottom: 0;">
                    <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                    <span>{{ $errors->first() }}</span>
                </div>
            @endif

            {{-- ══════════════════════════════════════════════════════
                 TAB: OVERVIEW
                 ══════════════════════════════════════════════════════ --}}
            <div id="tab-overview" class="tab-section active">
                <div>
                    <h1 class="welcome-title">Welcome back, <span>{{ explode(' ', $profile->name ?? 'Bimo')[0] }}</span>.</h1>
                    <p class="welcome-subtitle">Orbis portfolio control center and operational overview.</p>
                </div>

                {{-- Stats Grid --}}
                <div class="overview-stats-grid">
                    <div class="stat-card">
                        <div class="stat-info">
                            <span class="stat-title">Total Projects</span>
                            <div class="stat-value-row">
                                <span class="stat-value">{{ count($projects) }}</span>
                                <span class="stat-subtext">Vault Entries</span>
                            </div>
                        </div>
                        <div class="stat-icon-wrapper success">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                            </svg>
                        </div>
                    </div>

                    <div class="stat-card">
                        <div class="stat-info">
                            <span class="stat-title">Certifications</span>
                            <div class="stat-value-row">
                                <span class="stat-value">{{ count($certifications) }}</span>
                                <span class="stat-subtext">Verified Archives</span>
                            </div>
                        </div>
                        <div class="stat-icon-wrapper success">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/>
                            </svg>
                        </div>
                    </div>

                    <div class="stat-card">
                        <div class="stat-info">
                            <span class="stat-title">System Status</span>
                            <div class="stat-value-row" style="margin-top: 6px;">
                                <span class="pulse-dot"></span>
                                <span class="stat-subtext status">Online</span>
                            </div>
                        </div>
                        <div class="stat-icon-wrapper success">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                    </div>
                </div>

                {{-- Recent Milestones --}}
                <div class="admin-card milestones-card">
                    <div class="milestones-header">
                        <h3 class="milestones-title">Recent Project Milestones</h3>
                        <a href="#projects" onclick="switchTab('projects', document.getElementById('tab-projects-btn'))" class="milestones-link">
                            <span>View Vault</span>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" style="width: 12px; height: 12px;">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
                            </svg>
                        </a>
                    </div>

                    <div class="milestones-list">
                        @forelse($latestProjects as $proj)
                            <div class="milestone-item">
                                <span class="milestone-date">{{ $proj->year }}</span>
                                <div class="milestone-content">
                                    <h4 class="milestone-role-title">{{ $proj->title }} <span>· {{ $proj->made_at }}</span></h4>
                                    <p class="milestone-description">{{ $proj->description }}</p>
                                    <ul class="tech-tags-list">
                                        @foreach($proj->tags ?? [] as $tag)
                                            <li class="tech-tag">{{ $tag }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        @empty
                            <p style="text-align: center; color: var(--text-muted); font-size: 0.85rem; padding: 20px 0;">No registered projects.</p>
                        @endforelse
                    </div>
                </div>
            </div>

            {{-- ══════════════════════════════════════════════════════
                 TAB: PROFILE IDENTITY
                 ══════════════════════════════════════════════════════ --}}
            <div id="tab-profile" class="tab-section">
                <div>
                    <h1 class="welcome-title" style="font-size: 1.8rem;">Profile Identity</h1>
                    <p class="welcome-subtitle">Manage public portfolio details, avatar, and contact channels.</p>
                </div>

                <form action="{{ route('admin.profile.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="profile-grid-container">
                        <div class="admin-card">
                            <div class="profile-avatar-row">
                                <img id="photo-preview" src="{{ $profile && $profile->photo_path ? asset($profile->photo_path) : asset('images/fotoshot.png') }}" alt="Preview" class="profile-avatar-preview">
                                <div class="profile-avatar-info">
                                    <button type="button" class="profile-avatar-upload-btn" onclick="document.getElementById('photo-input').click()">Upload New Photo</button>
                                    <span class="profile-avatar-subtext">JPEG or PNG, max 2MB.</span>
                                </div>
                                <input type="file" id="photo-input" name="photo" accept="image/*" class="hidden" onchange="previewPhoto(this)">
                            </div>

                            <div style="display: flex; flex-direction: column; gap: 20px;">
                                <div>
                                    <label for="profile-name" class="form-label">Display Name</label>
                                    <input type="text" id="profile-name" name="name" class="form-input" value="{{ $profile->name ?? 'Bimo Aditya Pangestu' }}" required>
                                </div>

                                <div>
                                    <label for="profile-headline" class="form-label">Headline / Title</label>
                                    <input type="text" id="profile-headline" name="headline" class="form-input" value="{{ $profile->headline ?? 'Full Stack Developer & UI/UX Designer' }}" required>
                                </div>

                                <div>
                                    <label for="profile-short-bio" class="form-label">Short Bio (Mission Statement)</label>
                                    <textarea id="profile-short-bio" name="short_bio" class="form-input" style="min-height: 80px;" required>{{ $profile->short_bio ?? 'Full Stack Developer & UI/UX Designer building the infrastructure of the digital frontier.' }}</textarea>
                                </div>
                                
                                <div style="border-top: 1px solid var(--border-thin); padding-top: 20px; display: grid; grid-template-columns: 1fr 1fr; gap: 16px;">
                                    <div>
                                        <label class="form-label">GitHub URL</label>
                                        <input type="url" name="github_url" class="form-input" value="{{ $profile->github_url ?? '' }}" placeholder="https://github.com/...">
                                    </div>
                                    <div>
                                        <label class="form-label">LinkedIn URL</label>
                                        <input type="url" name="linkedin_url" class="form-input" value="{{ $profile->linkedin_url ?? '' }}" placeholder="https://linkedin.com/in/...">
                                    </div>
                                    <div>
                                        <label class="form-label">Email</label>
                                        <input type="email" name="email" class="form-input" value="{{ $profile->email ?? '' }}" placeholder="creatifbimbim@gmail.com">
                                    </div>
                                    <div>
                                        <label class="form-label">WhatsApp URL</label>
                                        <input type="text" name="whatsapp" class="form-input" value="{{ $profile->whatsapp ?? '' }}" placeholder="https://wa.me/...">
                                    </div>
                                </div>

                                <div style="border-top: 1px solid var(--border-thin); padding-top: 20px;">
                                    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 8px;">
                                        <label class="form-label" style="margin-bottom: 0;">Curriculum Vitae (CV)</label>
                                        @if($cvFile)
                                            <a href="{{ route('download.cv') }}?v={{ $cvFile->updated_at->timestamp }}" target="_blank" style="font-size: 0.72rem; color: var(--accent-mint); text-decoration: none; font-family: var(--font-mono); display: inline-flex; align-items: center; gap: 4px;">
                                                <span class="material-symbols-outlined" style="font-size: 14px;">visibility</span>
                                                <span>Lihat CV</span>
                                            </a>
                                        @endif
                                    </div>
                                    @if($cvFile)
                                        <div style="background: rgba(156, 252, 230, 0.05); border: 1px dashed rgba(156, 252, 230, 0.25); border-radius: 8px; padding: 10px 12px; margin-bottom: 10px; display: flex; align-items: center; justify-content: space-between;">
                                            <div style="display: flex; align-items: center; gap: 8px; overflow: hidden;">
                                                <span class="material-symbols-outlined" style="color: var(--accent-mint); font-size: 18px;">picture_as_pdf</span>
                                                <span style="font-family: var(--font-mono); font-size: 0.75rem; color: var(--text-primary); white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                                                    {{ $cvFile->original_name }}
                                                </span>
                                            </div>
                                            <span class="cert-badge-active" style="font-size: 0.6rem; padding: 1px 6px;">Aktif</span>
                                        </div>
                                    @else
                                        <p style="font-family: var(--font-mono); font-size: 0.72rem; color: var(--text-muted); margin-bottom: 10px;">
                                            Menggunakan file CV default (bawaan).
                                        </p>
                                    @endif
                                    <button type="button" class="profile-avatar-upload-btn" style="width: 100%; text-align: center; justify-content: center; display: flex; align-items: center; gap: 8px;" onclick="switchTab('cv', document.getElementById('tab-cv-btn'))">
                                        <span class="material-symbols-outlined" style="font-size: 16px;">upload_file</span>
                                        <span>Kelola &amp; Upload di CV Manager</span>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="admin-card" style="display: flex; flex-direction: column; gap: 20px;">
                            <span class="form-label">About Me Paragraphs</span>

                            <div style="display: flex; flex-direction: column; gap: 16px; flex: 1;">
                                <div>
                                    <label class="form-label" style="font-size: 0.65rem; color: var(--text-muted);">Paragraph 1</label>
                                    <textarea name="about_1" class="form-input" style="min-height: 110px;" required>{{ $profile->about_1 ?? '' }}</textarea>
                                </div>

                                <div>
                                    <label class="form-label" style="font-size: 0.65rem; color: var(--text-muted);">Paragraph 2</label>
                                    <textarea name="about_2" class="form-input" style="min-height: 110px;">{{ $profile->about_2 ?? '' }}</textarea>
                                </div>

                                <div>
                                    <label class="form-label" style="font-size: 0.65rem; color: var(--text-muted);">Paragraph 3</label>
                                    <textarea name="about_3" class="form-input" style="min-height: 110px;">{{ $profile->about_3 ?? '' }}</textarea>
                                </div>
                            </div>

                            <div class="profile-footer-actions">
                                <button type="submit" class="btn btn-primary">Save Identity</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

            {{-- ══════════════════════════════════════════════════════
                 TAB: PROJECTS VAULT
                 ══════════════════════════════════════════════════════ --}}
            <div id="tab-projects" class="tab-section">
                <div class="exp-timeline-header-row">
                    <div>
                        <h1 class="welcome-title" style="font-size: 1.8rem;">Projects Vault</h1>
                        <p class="welcome-subtitle">Deploy and manage project entries in your public portfolio registry.</p>
                    </div>
                    <button class="btn btn-primary" onclick="openModal('modal-add-proj')" style="padding: 10px 20px;">+ Add Project</button>
                </div>

                {{-- Projects Grid --}}
                <div class="deployments-grid">
                    @forelse($projects as $proj)
                        <div class="deployment-card">
                            <div class="deployment-media">
                                @if($proj->image_path)
                                    <img src="{{ asset($proj->image_path) }}" alt="{{ $proj->title }}" class="deployment-img">
                                @else
                                    <div class="deployment-placeholder-icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                        </svg>
                                    </div>
                                @endif

                                <div class="deployment-badge-container">
                                    @if($proj->show_on_home)
                                        <span class="deployment-badge live">Home Live</span>
                                    @else
                                        <span class="deployment-badge draft">Draft</span>
                                    @endif
                                </div>
                            </div>

                            <div class="deployment-body">
                                <div class="deployment-meta-row">
                                    <span>{{ $proj->year }}</span>
                                    <span>·</span>
                                    <span>{{ $proj->made_at ?? 'Independent' }}</span>
                                </div>
                                <h4 class="deployment-card-title">{{ $proj->title }}</h4>
                                <p class="deployment-card-desc">{{ $proj->description ?? 'No project details provided.' }}</p>
                                
                                <div class="deployment-card-tags">
                                    @foreach($proj->tags ?? [] as $tag)
                                        <span class="deployment-card-tag">{{ $tag }}</span>
                                    @endforeach
                                </div>
                            </div>

                            <div class="deployment-footer">
                                <button class="btn-edit-outline" onclick="openEditProj({{ $proj->id }}, '{{ $proj->start_date }}', '{{ $proj->end_date }}', '{{ addslashes($proj->title) }}', '{{ addslashes($proj->made_at ?? '') }}', '{{ addslashes($proj->url ?? '') }}', '{{ addslashes($proj->link_label ?? '') }}', '{{ addslashes($proj->description ?? '') }}', '{{ implode(',', $proj->tags ?? []) }}', {{ $proj->show_on_home ? 'true' : 'false' }})">Edit</button>
                                <form action="{{ route('admin.project.destroy', $proj->id) }}" method="POST" onsubmit="return confirm('Hapus project ini?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn-danger-outline">Delete</button>
                                </form>
                            </div>
                        </div>
                    @empty
                        <div class="exp-collapsed-card" style="justify-content: center; padding: 40px 24px; color: var(--text-muted); grid-column: 1 / -1;">
                            Belum ada project terdaftar.
                        </div>
                    @endforelse
                </div>
            </div>

            {{-- ══════════════════════════════════════════════════════
                 TAB: CERTIFICATIONS ARCHIVE
                 ══════════════════════════════════════════════════════ --}}
            <div id="tab-certifications" class="tab-section">
                <div class="exp-timeline-header-row">
                    <div>
                        <h1 class="welcome-title" style="font-size: 1.8rem;">Certifications</h1>
                        <p class="welcome-subtitle">Manage professional credentials and verified industry standards.</p>
                    </div>
                    <button class="btn btn-primary" onclick="openModal('modal-add-cert')" style="padding: 10px 20px;">+ Add Certification</button>
                </div>

                {{-- Certifications Grid --}}
                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(360px, 1fr)); gap: 20px;">
                    @forelse($certifications as $cert)
                        <div class="admin-card" style="display: flex; flex-direction: column; justify-content: space-between; gap: 16px;">
                            <div style="display: flex; justify-content: space-between; align-items: flex-start;">
                                <div style="display: flex; items-center; gap: 12px;">
                                    <div style="width: 44px; height: 44px; border-radius: 12px; background-color: rgba(255,255,255,0.03); border: 1px solid var(--border-thin); display: flex; align-items: center; justify-content: center;">
                                        <span class="material-symbols-outlined" style="color: var(--accent-mint); font-size: 22px;">{{ $cert->icon ?? 'verified_user' }}</span>
                                    </div>
                                    <div>
                                        <span style="font-family: var(--font-mono); font-size: 0.7rem; color: var(--accent-mint); text-transform: uppercase;">{{ $cert->issuer }}</span>
                                        <h4 style="font-family: 'Anton', sans-serif; font-size: 1.5rem; color: var(--text-primary); text-transform: uppercase;">{{ $cert->title }}</h4>
                                    </div>
                                </div>
                                <span class="cert-badge-active">Verified</span>
                            </div>

                            <p style="font-family: var(--font-mono); font-size: 0.75rem; color: var(--text-muted);">
                                {{ $cert->issuer_full ?? $cert->issuer }}
                            </p>

                            <div style="border-top: 1px solid var(--border-thin); padding-top: 12px; display: flex; justify-content: flex-end; gap: 8px;">
                                <button class="btn-edit-outline" onclick="openEditCert({{ $cert->id }}, '{{ addslashes($cert->title) }}', '{{ addslashes($cert->issuer) }}', '{{ addslashes($cert->issuer_full ?? '') }}', '{{ addslashes($cert->icon ?? 'verified_user') }}', {{ $cert->is_active ? 'true' : 'false' }})">Edit</button>
                                <form action="{{ route('admin.certification.destroy', $cert->id) }}" method="POST" onsubmit="return confirm('Hapus sertifikat ini?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn-danger-outline">Delete</button>
                                </form>
                            </div>
                        </div>
                    @empty
                        <div class="exp-collapsed-card" style="justify-content: center; padding: 40px 24px; color: var(--text-muted); grid-column: 1 / -1;">
                            Belum ada sertifikat terdaftar.
                        </div>
                    @endforelse
                </div>
            </div>

            {{-- ══════════════════════════════════════════════════════
                 TAB: CV MANAGER
                 ══════════════════════════════════════════════════════ --}}
            <div id="tab-cv" class="tab-section">
                <div>
                    <h1 class="welcome-title" style="font-size: 1.8rem;">CV Manager</h1>
                    <p class="welcome-subtitle">Upload dan kelola file CV Anda. CV aktif akan langsung tersedia di halaman portfolio.</p>
                </div>

                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 24px; margin-top: 8px;">

                    {{-- Card: Upload CV Baru --}}
                    <div class="admin-card" style="display: flex; flex-direction: column; gap: 20px;">
                        <div>
                            <span class="form-label" style="font-size: 0.9rem;">Upload CV Baru</span>
                            <p style="font-family: var(--font-mono); font-size: 0.72rem; color: var(--text-muted); margin-top: 4px;">
                                Unggah file PDF baru. CV lama akan otomatis terhapus dan digantikan oleh yang baru.
                            </p>
                        </div>

                        <form action="{{ route('admin.cv.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            {{-- Drop zone visual --}}
                            <div id="cv-drop-zone" style="border: 2px dashed rgba(156, 252, 230, 0.25); border-radius: 12px; padding: 32px 20px; text-align: center; cursor: pointer; transition: border-color 0.2s, background 0.2s;"
                                 onclick="document.getElementById('cv-file-upload').click()"
                                 ondragover="event.preventDefault(); this.style.borderColor='rgba(156,252,230,0.7)'; this.style.background='rgba(156,252,230,0.04)';"
                                 ondragleave="this.style.borderColor='rgba(156,252,230,0.25)'; this.style.background='';"
                                 ondrop="event.preventDefault(); this.style.borderColor='rgba(156,252,230,0.25)'; this.style.background=''; handleCvDrop(event);">
                                <span class="material-symbols-outlined" style="font-size: 40px; color: rgba(156,252,230,0.4); display: block; margin-bottom: 12px;">upload_file</span>
                                <p style="font-family: var(--font-mono); font-size: 0.78rem; color: var(--text-secondary);">Klik atau drag &amp; drop file PDF di sini</p>
                                <p style="font-family: var(--font-mono); font-size: 0.68rem; color: var(--text-muted); margin-top: 4px;">Format PDF · Maks 20 MB</p>
                            </div>
                            <input type="file" id="cv-file-upload" name="cv" accept=".pdf,application/pdf" class="hidden"
                                   onchange="previewCvFile(this)">

                            {{-- Preview file terpilih --}}
                            <div id="cv-selected-preview" style="display: none; background: rgba(156,252,230,0.05); border: 1px solid rgba(156,252,230,0.2); border-radius: 8px; padding: 12px 16px; display: none; align-items: center; gap: 12px; margin-top: 12px;">
                                <span class="material-symbols-outlined" style="color: var(--accent-mint); font-size: 28px; flex-shrink: 0;">picture_as_pdf</span>
                                <div style="flex: 1; overflow: hidden;">
                                    <p id="cv-selected-name" style="font-family: var(--font-mono); font-size: 0.78rem; color: var(--text-primary); white-space: nowrap; overflow: hidden; text-overflow: ellipsis;"></p>
                                    <p id="cv-selected-size" style="font-family: var(--font-mono); font-size: 0.68rem; color: var(--text-muted); margin-top: 2px;"></p>
                                </div>
                                <button type="button" onclick="clearCvFile()" style="background: none; border: none; color: var(--text-muted); cursor: pointer; padding: 4px;">
                                    <span class="material-symbols-outlined" style="font-size: 18px;">close</span>
                                </button>
                            </div>

                            @if($errors->has('cv'))
                                <p style="font-family: var(--font-mono); font-size: 0.72rem; color: var(--accent-red); margin-top: 8px;">
                                    {{ $errors->first('cv') }}
                                </p>
                            @endif

                            <button type="submit" class="btn btn-primary" style="width: 100%; margin-top: 16px; justify-content: center;">
                                <span class="material-symbols-outlined" style="font-size: 16px;">upload</span>
                                Upload &amp; Simpan CV
                            </button>
                        </form>
                    </div>

                    {{-- Card: Status CV Aktif --}}
                    <div class="admin-card" style="display: flex; flex-direction: column; gap: 20px;">
                        <div>
                            <span class="form-label" style="font-size: 0.9rem;">Status CV Aktif</span>
                            <p style="font-family: var(--font-mono); font-size: 0.72rem; color: var(--text-muted); margin-top: 4px;">
                                CV di bawah ini yang saat ini tampil ke pengunjung portfolio Anda.
                            </p>
                        </div>

                        @if($cvFile)
                            {{-- CV tersedia --}}
                            <div style="background: rgba(156, 252, 230, 0.05); border: 1px solid rgba(156, 252, 230, 0.2); border-radius: 12px; padding: 24px; display: flex; flex-direction: column; gap: 16px; flex: 1;">
                                <div style="display: flex; align-items: center; gap: 12px;">
                                    <span class="material-symbols-outlined" style="color: var(--accent-mint); font-size: 40px;">picture_as_pdf</span>
                                    <div style="overflow: hidden;">
                                        <p style="font-family: var(--font-mono); font-size: 0.85rem; color: var(--text-primary); white-space: nowrap; overflow: hidden; text-overflow: ellipsis; font-weight: 600;">
                                            {{ $cvFile->original_name }}
                                        </p>
                                        <p style="font-family: var(--font-mono); font-size: 0.7rem; color: var(--text-muted); margin-top: 2px;">
                                            {{ $cvFile->file_size_formatted }} &nbsp;·&nbsp;
                                            Diupload {{ $cvFile->created_at->diffForHumans() }}
                                        </p>
                                    </div>
                                </div>

                                <div style="display: flex; gap: 4px;">
                                    <span class="cert-badge-active" style="display: inline-flex; align-items: center; gap: 4px;">
                                        <span style="width: 6px; height: 6px; background: #6FFF00; border-radius: 50%; display: inline-block;"></span>
                                        Aktif
                                    </span>
                                </div>

                                <div style="display: flex; gap: 10px; margin-top: auto;">
                                    <a href="{{ route('download.cv') }}?v={{ $cvFile->updated_at->timestamp }}" target="_blank" class="btn btn-secondary" style="flex: 1; justify-content: center; text-decoration: none; text-align: center;">
                                        <span class="material-symbols-outlined" style="font-size: 15px;">visibility</span>
                                        Lihat CV
                                    </a>
                                    <form action="{{ route('admin.cv.destroy') }}" method="POST" style="flex: 1;"
                                          onsubmit="return confirm('Hapus CV aktif? Tombol download di halaman user tidak akan tersedia sampai Anda upload CV baru.')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn" style="width: 100%; background: rgba(248, 113, 113, 0.1); color: var(--accent-red); border: 1px solid rgba(248,113,113,0.3); justify-content: center;">
                                            <span class="material-symbols-outlined" style="font-size: 15px;">delete</span>
                                            Hapus CV
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @else
                            {{-- Tidak ada CV --}}
                            <div style="flex: 1; display: flex; flex-direction: column; align-items: center; justify-content: center; gap: 16px; background: rgba(255,255,255,0.02); border: 1px dashed rgba(255,255,255,0.08); border-radius: 12px; padding: 40px 20px; text-align: center;">
                                <span class="material-symbols-outlined" style="font-size: 48px; color: rgba(255,255,255,0.15);">description</span>
                                <div>
                                    <p style="font-family: var(--font-mono); font-size: 0.82rem; color: var(--text-secondary);">Belum ada CV yang diupload</p>
                                    <p style="font-family: var(--font-mono); font-size: 0.7rem; color: var(--text-muted); margin-top: 4px;">
                                        Upload CV Anda menggunakan form di sebelah kiri.
                                    </p>
                                </div>
                                @if(file_exists(public_path('pdf/Bimo_Aditya_Pangestu_CV.pdf')))
                                    <p style="font-family: var(--font-mono); font-size: 0.68rem; color: rgba(156,252,230,0.5); border-top: 1px solid rgba(255,255,255,0.06); padding-top: 12px; margin-top: 4px;">
                                        ℹ️ Halaman user saat ini menggunakan CV bawaan (Bimo_Aditya_Pangestu_CV.pdf)
                                    </p>
                                @endif
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            {{-- ══════════════════════════════════════════════════════
                 TAB: EXPERIENCE TIMELINE
                 ══════════════════════════════════════════════════════ --}}
            <div id="tab-experience" class="tab-section">
                <div class="exp-timeline-header-row">
                    <div>
                        <h1 class="welcome-title" style="font-size: 1.8rem;">Experience Log</h1>
                        <p class="welcome-subtitle">Manage background and career work history.</p>
                    </div>
                    <button class="btn btn-primary" onclick="openModal('modal-add-exp')" style="padding: 10px 20px;">+ Add Role</button>
                </div>

                {{-- Timeline Container --}}
                <div class="exp-timeline-container">
                    <span class="exp-timeline-title">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/>
                        </svg>
                        Experience Log Stack
                    </span>

                    <div style="display: flex; flex-direction: column; gap: 16px;">
                        @forelse($experiences as $exp)
                            <div class="exp-collapsed-card">
                                <div class="exp-collapsed-main">
                                    <span class="exp-collapsed-date">{{ $exp->date_range }}</span>
                                    <h4 class="exp-collapsed-title">{{ $exp->title }} <span>· {{ $exp->company }}</span></h4>
                                    <p style="font-size: 0.85rem; color: var(--text-secondary); margin-top: 4px;">{{ $exp->description }}</p>
                                    <div class="exp-collapsed-tags" style="margin-top: 8px;">
                                        @foreach($exp->tags ?? [] as $tag)
                                            <span class="exp-collapsed-tag">{{ $tag }}</span>
                                        @endforeach
                                    </div>
                                </div>
                                
                                <div class="exp-collapsed-actions">
                                    <button class="btn-edit-outline" onclick="openEditExp({{ $exp->id }}, '{{ $exp->start_date }}', '{{ $exp->end_date }}', '{{ addslashes($exp->title) }}', '{{ addslashes($exp->company) }}', '{{ addslashes($exp->company_url ?? '') }}', '{{ addslashes($exp->description) }}', '{{ implode(',', $exp->tags ?? []) }}')">Edit</button>
                                    <form action="{{ route('admin.experience.destroy', $exp->id) }}" method="POST" onsubmit="return confirm('Hapus experience ini?')">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="btn-danger-outline">Delete</button>
                                    </form>
                                </div>
                            </div>
                        @empty
                            <div class="exp-collapsed-card" style="justify-content: center; padding: 40px 24px; color: var(--text-muted);">
                                Belum ada riwayat pengalaman kerja. Klik "+ Add Role" untuk menambahkan.
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>

        </main>
    </div>

    {{-- ── POPUP MODALS ──────────────────────────────────────────────────────────── --}}

    {{-- MODAL: ADD PROJECT --}}
    <div id="modal-add-proj" class="modal-overlay" onclick="closeModalOnBackdrop(event, 'modal-add-proj')">
        <div class="modal-card" style="max-width: 680px;">
            <div class="modal-header">
                <h3 class="modal-title">Initialize New Project</h3>
                <button type="button" class="modal-close-btn" onclick="closeModal('modal-add-proj')">&times;</button>
            </div>
            <form action="{{ route('admin.project.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px; margin-bottom: 16px;">
                        <div>
                            <label class="form-label">Project Title *</label>
                            <input type="text" name="title" class="form-input" placeholder="UI/UX Design Bantulpedia" required>
                        </div>
                        <div>
                            <label class="form-label">Client / Made At</label>
                            <input type="text" name="made_at" class="form-input" placeholder="Figma Community / SMAN 1 Kopang">
                        </div>
                    </div>

                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px; margin-bottom: 16px;">
                        <div>
                            <label class="form-label">Start Date *</label>
                            <input type="date" name="start_date" class="form-input" required onclick="this.showPicker()">
                        </div>
                        <div>
                            <label class="form-label">End Date</label>
                            <input type="date" name="end_date" class="form-input" onclick="this.showPicker()">
                        </div>
                    </div>

                    <div style="margin-bottom: 16px;">
                        <label class="form-label">Description</label>
                        <textarea name="description" class="form-input" style="min-height: 90px;" placeholder="Brief summary of features..."></textarea>
                    </div>

                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px; margin-bottom: 16px;">
                        <div>
                            <label class="form-label">Project URL</label>
                            <input type="url" name="url" class="form-input" placeholder="https://figma.com/...">
                        </div>
                        <div>
                            <label class="form-label">Link Label</label>
                            <input type="text" name="link_label" class="form-input" placeholder="figma.com">
                        </div>
                    </div>

                    <div style="margin-bottom: 16px;">
                        <label class="form-label">Tech Tags (comma separated)</label>
                        <input type="text" name="tags" class="form-input" placeholder="Figma, UI/UX, Mobile Design">
                    </div>

                    <div style="margin-bottom: 16px;">
                        <label class="form-label">Cover Image Asset</label>
                        <input type="file" name="image" accept="image/*" class="form-input">
                    </div>

                    <div style="display: flex; align-items: center; gap: 10px;">
                        <input type="checkbox" id="add-proj-home" name="show_on_home" value="1" checked style="width: 16px; height: 16px; accent-color: var(--accent-mint); cursor: pointer;">
                        <label for="add-proj-home" class="form-label" style="margin-bottom: 0; cursor: pointer; text-transform: none;">Show on homepage grid</label>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" onclick="closeModal('modal-add-proj')">Cancel</button>
                    <button type="submit" class="btn btn-primary">Commit Project</button>
                </div>
            </form>
        </div>
    </div>

    {{-- MODAL: EDIT PROJECT --}}
    <div id="modal-edit-proj" class="modal-overlay" onclick="closeModalOnBackdrop(event, 'modal-edit-proj')">
        <div class="modal-card" style="max-width: 680px;">
            <div class="modal-header">
                <h3 class="modal-title">Edit Project Entry</h3>
                <button type="button" class="modal-close-btn" onclick="closeModal('modal-edit-proj')">&times;</button>
            </div>
            <form id="form-edit-proj" method="POST" enctype="multipart/form-data">
                @csrf @method('PUT')
                <div class="modal-body">
                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px; margin-bottom: 16px;">
                        <div>
                            <label class="form-label">Title *</label>
                            <input type="text" id="edit-proj-title" name="title" class="form-input" required>
                        </div>
                        <div>
                            <label class="form-label">Made At / Client</label>
                            <input type="text" id="edit-proj-madeat" name="made_at" class="form-input">
                        </div>
                    </div>

                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px; margin-bottom: 16px;">
                        <div>
                            <label class="form-label">Start Date *</label>
                            <input type="date" id="edit-proj-start" name="start_date" class="form-input" required onclick="this.showPicker()">
                        </div>
                        <div>
                            <label class="form-label">End Date</label>
                            <input type="date" id="edit-proj-end" name="end_date" class="form-input" onclick="this.showPicker()">
                        </div>
                    </div>

                    <div style="margin-bottom: 16px;">
                        <label class="form-label">Description</label>
                        <textarea id="edit-proj-desc" name="description" class="form-input" style="min-height: 90px;"></textarea>
                    </div>

                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px; margin-bottom: 16px;">
                        <div>
                            <label class="form-label">Project URL</label>
                            <input type="url" id="edit-proj-url" name="url" class="form-input">
                        </div>
                        <div>
                            <label class="form-label">Link Label</label>
                            <input type="text" id="edit-proj-linklabel" name="link_label" class="form-input">
                        </div>
                    </div>

                    <div style="margin-bottom: 16px;">
                        <label class="form-label">Tags (comma separated)</label>
                        <input type="text" id="edit-proj-tags" name="tags" class="form-input">
                    </div>

                    <div style="margin-bottom: 16px;">
                        <label class="form-label">Update Cover Image Asset</label>
                        <input type="file" name="image" accept="image/*" class="form-input">
                    </div>

                    <div style="display: flex; align-items: center; gap: 10px;">
                        <input type="checkbox" id="edit-proj-home" name="show_on_home" value="1" style="width: 16px; height: 16px; accent-color: var(--accent-mint); cursor: pointer;">
                        <label for="edit-proj-home" class="form-label" style="margin-bottom: 0; cursor: pointer; text-transform: none;">Show on homepage grid</label>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" onclick="closeModal('modal-edit-proj')">Cancel</button>
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </div>
            </form>
        </div>
    </div>

    {{-- MODAL: ADD CERTIFICATION --}}
    <div id="modal-add-cert" class="modal-overlay" onclick="closeModalOnBackdrop(event, 'modal-add-cert')">
        <div class="modal-card">
            <div class="modal-header">
                <h3 class="modal-title">Add New Certification</h3>
                <button type="button" class="modal-close-btn" onclick="closeModal('modal-add-cert')">&times;</button>
            </div>
            <form action="{{ route('admin.certification.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px; margin-bottom: 16px;">
                        <div>
                            <label class="form-label">Certification Title *</label>
                            <input type="text" name="title" class="form-input" placeholder="e.g., SENIOR WEB DEVELOPER" required>
                        </div>
                        <div>
                            <label class="form-label">Issuing Org Code *</label>
                            <input type="text" name="issuer" class="form-input" placeholder="e.g., BNSP" required>
                        </div>
                    </div>

                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px; margin-bottom: 16px;">
                        <div>
                            <label class="form-label">Full Issuing Org Name</label>
                            <input type="text" name="issuer_full" class="form-input" placeholder="e.g., Badan Nasional Sertifikasi Profesi">
                        </div>
                        <div>
                            <label class="form-label">Icon Name (Material Symbol)</label>
                            <input type="text" name="icon" class="form-input" placeholder="e.g., verified_user, terminal">
                        </div>
                    </div>

                    <div style="display: flex; align-items: center; gap: 10px;">
                        <input type="checkbox" id="add_cert_active" name="is_active" value="1" checked style="width: 16px; height: 16px; accent-color: var(--accent-mint); cursor: pointer;">
                        <label for="add_cert_active" class="form-label" style="margin-bottom: 0; cursor: pointer; text-transform: none;">Active / Display on public site</label>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" onclick="closeModal('modal-add-cert')">Cancel</button>
                    <button type="submit" class="btn btn-primary">Add Certification</button>
                </div>
            </form>
        </div>
    </div>

    {{-- MODAL: EDIT CERTIFICATION --}}
    <div id="modal-edit-cert" class="modal-overlay" onclick="closeModalOnBackdrop(event, 'modal-edit-cert')">
        <div class="modal-card">
            <div class="modal-header">
                <h3 class="modal-title">Edit Certification</h3>
                <button type="button" class="modal-close-btn" onclick="closeModal('modal-edit-cert')">&times;</button>
            </div>
            <form id="form-edit-cert" method="POST">
                @csrf @method('PUT')
                <div class="modal-body">
                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px; margin-bottom: 16px;">
                        <div>
                            <label class="form-label">Certification Title *</label>
                            <input type="text" id="edit-cert-title" name="title" class="form-input" required>
                        </div>
                        <div>
                            <label class="form-label">Issuing Org Code *</label>
                            <input type="text" id="edit-cert-issuer" name="issuer" class="form-input" required>
                        </div>
                    </div>

                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px; margin-bottom: 16px;">
                        <div>
                            <label class="form-label">Full Issuing Org Name</label>
                            <input type="text" id="edit-cert-issuerfull" name="issuer_full" class="form-input">
                        </div>
                        <div>
                            <label class="form-label">Material Symbol Icon</label>
                            <input type="text" id="edit-cert-icon" name="icon" class="form-input">
                        </div>
                    </div>

                    <div style="display: flex; align-items: center; gap: 10px;">
                        <input type="checkbox" id="edit-cert-active" name="is_active" value="1" style="width: 16px; height: 16px; accent-color: var(--accent-mint); cursor: pointer;">
                        <label for="edit-cert-active" class="form-label" style="margin-bottom: 0; cursor: pointer; text-transform: none;">Active / Display on public site</label>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" onclick="closeModal('modal-edit-cert')">Cancel</button>
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </div>
            </form>
        </div>
    </div>

    {{-- MODAL: EDIT EXPERIENCE --}}
    <div id="modal-edit-exp" class="modal-overlay" onclick="closeModalOnBackdrop(event, 'modal-edit-exp')">
        <div class="modal-card">
            <div class="modal-header">
                <h3 class="modal-title">Edit Experience Role</h3>
                <button type="button" class="modal-close-btn" onclick="closeModal('modal-edit-exp')">&times;</button>
            </div>
            <form id="form-edit-exp" method="POST">
                @csrf @method('PUT')
                <div class="modal-body">
                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px; margin-bottom: 16px;">
                        <div>
                            <label class="form-label">Job Title *</label>
                            <input type="text" id="edit-exp-title" name="title" class="form-input" required>
                        </div>
                        <div>
                            <label class="form-label">Company Name *</label>
                            <input type="text" id="edit-exp-company" name="company" class="form-input" required>
                        </div>
                    </div>

                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px; margin-bottom: 16px;">
                        <div>
                            <label class="form-label">Start Date *</label>
                            <input type="date" id="edit-exp-start" name="start_date" class="form-input" required onclick="this.showPicker()">
                        </div>
                        <div>
                            <label class="form-label">End Date</label>
                            <input type="date" id="edit-exp-end" name="end_date" class="form-input" onclick="this.showPicker()">
                        </div>
                    </div>

                    <div style="margin-bottom: 16px;">
                        <label class="form-label">Description</label>
                        <textarea id="edit-exp-desc" name="description" class="form-input" style="min-height: 90px;"></textarea>
                    </div>

                    <div style="margin-bottom: 16px;">
                        <label class="form-label">Tags (comma separated)</label>
                        <input type="text" id="edit-exp-tags" name="tags" class="form-input">
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" onclick="closeModal('modal-edit-exp')">Cancel</button>
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </div>
            </form>
        </div>
    </div>

    {{-- MODAL: ADD EXPERIENCE --}}
    <div id="modal-add-exp" class="modal-overlay" onclick="closeModalOnBackdrop(event, 'modal-add-exp')">
        <div class="modal-card">
            <div class="modal-header">
                <h3 class="modal-title">Add Experience Role</h3>
                <button type="button" class="modal-close-btn" onclick="closeModal('modal-add-exp')">&times;</button>
            </div>
            <form action="{{ route('admin.experience.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px; margin-bottom: 16px;">
                        <div>
                            <label class="form-label">Job Title *</label>
                            <input type="text" name="title" class="form-input" placeholder="Senior Web Developer" required>
                        </div>
                        <div>
                            <label class="form-label">Company Name *</label>
                            <input type="text" name="company" class="form-input" placeholder="BrainDevPro" required>
                        </div>
                    </div>

                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px; margin-bottom: 16px;">
                        <div>
                            <label class="form-label">Start Date *</label>
                            <input type="date" name="start_date" class="form-input" required onclick="this.showPicker()">
                        </div>
                        <div>
                            <label class="form-label">End Date</label>
                            <input type="date" name="end_date" class="form-input" onclick="this.showPicker()">
                        </div>
                    </div>

                    <div style="margin-bottom: 16px;">
                        <label class="form-label">Description</label>
                        <textarea name="description" class="form-input" style="min-height: 90px;" placeholder="Describe key achievements..."></textarea>
                    </div>

                    <div style="margin-bottom: 16px;">
                        <label class="form-label">Tags (comma separated)</label>
                        <input type="text" name="tags" class="form-input" placeholder="Laravel, Vue.js, TailwindCSS">
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" onclick="closeModal('modal-add-exp')">Cancel</button>
                    <button type="submit" class="btn btn-primary">Add Role</button>
                </div>
            </form>
        </div>
    </div>

    {{-- JavaScript --}}
    <script>
        function switchTab(tabName, element) {
            document.querySelectorAll('.tab-section').forEach(el => el.classList.remove('active'));
            document.querySelectorAll('.nav-tab').forEach(el => el.classList.remove('active'));

            const targetSection = document.getElementById('tab-' + tabName);
            const targetBtn = element || document.getElementById('tab-' + tabName + '-btn');

            if (targetSection) targetSection.classList.add('active');
            if (targetBtn) targetBtn.classList.add('active');

            const breadcrumb = document.getElementById('breadcrumb-section');
            if (breadcrumb) breadcrumb.textContent = tabName.charAt(0).toUpperCase() + tabName.slice(1);
        }

        function openModal(modalId) {
            const modal = document.getElementById(modalId);
            if (modal) modal.classList.add('active');
        }

        function closeModal(modalId) {
            const modal = document.getElementById(modalId);
            if (modal) modal.classList.remove('active');
        }

        function closeModalOnBackdrop(event, modalId) {
            if (event.target.id === modalId) closeModal(modalId);
        }

        function previewPhoto(input) {
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = e => document.getElementById('photo-preview').src = e.target.result;
                reader.readAsDataURL(input.files[0]);
            }
        }

        function openEditExp(id, start, end, title, company, companyUrl, desc, tags) {
            document.getElementById('form-edit-exp').action = '/admin/experience/' + id;
            document.getElementById('edit-exp-start').value = start || '';
            document.getElementById('edit-exp-end').value = end || '';
            document.getElementById('edit-exp-title').value = title || '';
            document.getElementById('edit-exp-company').value = company || '';
            document.getElementById('edit-exp-desc').value = desc || '';
            document.getElementById('edit-exp-tags').value = tags || '';
            openModal('modal-edit-exp');
        }

        function openEditProj(id, start, end, title, madeAt, url, linkLabel, desc, tags, showHome) {
            document.getElementById('form-edit-proj').action = '/admin/project/' + id;
            document.getElementById('edit-proj-start').value = start || '';
            document.getElementById('edit-proj-end').value = end || '';
            document.getElementById('edit-proj-title').value = title || '';
            document.getElementById('edit-proj-madeat').value = madeAt || '';
            document.getElementById('edit-proj-url').value = url || '';
            document.getElementById('edit-proj-linklabel').value = linkLabel || '';
            document.getElementById('edit-proj-desc').value = desc || '';
            document.getElementById('edit-proj-tags').value = tags || '';
            document.getElementById('edit-proj-home').checked = !!showHome;
            openModal('modal-edit-proj');
        }

        function openEditCert(id, title, issuer, issuerFull, icon, isActive) {
            document.getElementById('form-edit-cert').action = '/admin/certification/' + id;
            document.getElementById('edit-cert-title').value = title || '';
            document.getElementById('edit-cert-issuer').value = issuer || '';
            document.getElementById('edit-cert-issuerfull').value = issuerFull || '';
            document.getElementById('edit-cert-icon').value = icon || 'verified_user';
            document.getElementById('edit-cert-active').checked = !!isActive;
            openModal('modal-edit-cert');
        }

        document.addEventListener('DOMContentLoaded', () => {
            const urlParams = new URLSearchParams(window.location.search);
            const tabParam = urlParams.get('tab');
            if (tabParam && ['overview', 'profile', 'projects', 'certifications', 'experience', 'cv'].includes(tabParam)) {
                switchTab(tabParam, document.getElementById('tab-' + tabParam + '-btn'));
            }
        });

        /* ── CV File Preview Helpers ─────────────────────────────── */
        function previewCvFile(input) {
            if (input.files && input.files[0]) {
                const file = input.files[0];
                const preview = document.getElementById('cv-selected-preview');
                document.getElementById('cv-selected-name').textContent = file.name;
                document.getElementById('cv-selected-size').textContent = formatBytes(file.size);
                preview.style.display = 'flex';
            }
        }

        function handleCvDrop(event) {
            const files = event.dataTransfer.files;
            if (files.length > 0) {
                const input = document.getElementById('cv-file-upload');
                // DataTransfer trick to assign dropped file to input
                const dt = new DataTransfer();
                dt.items.add(files[0]);
                input.files = dt.files;
                previewCvFile(input);
            }
        }

        function clearCvFile() {
            const input = document.getElementById('cv-file-upload');
            input.value = '';
            document.getElementById('cv-selected-preview').style.display = 'none';
        }

        function formatBytes(bytes) {
            if (bytes >= 1048576) return (bytes / 1048576).toFixed(2) + ' MB';
            return (bytes / 1024).toFixed(1) + ' KB';
        }
    </script>
</body>
</html>
