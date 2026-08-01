<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Console Dashboard — Bimo Aditya</title>
    
    {{-- Import Custom Admin Stylesheet --}}
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
</head>
<body>

    <div class="admin-container">
        
        {{-- ── SIDEBAR ─────────────────────────────────────────────── --}}
        <aside class="sidebar">
            
            {{-- Header --}}
            <div class="sidebar-header">
                <img src="{{ $profile && $profile->photo_path ? asset($profile->photo_path) : asset('images/fotoshot.png') }}" alt="Admin Avatar" class="sidebar-avatar">
                <div class="sidebar-title-container">
                    <span class="sidebar-title">Portfolio Admin</span>
                    <span class="sidebar-subtitle">System Root</span>
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
                    <span>Profile</span>
                </button>
                <button class="nav-tab" onclick="switchTab('experience', this)" id="tab-experience-btn">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                    </svg>
                    <span>Experience</span>
                </button>
                <button class="nav-tab" onclick="switchTab('projects', this)" id="tab-projects-btn">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                    </svg>
                    <span>Projects</span>
                </button>
            </nav>

            {{-- Footer --}}
            <div class="sidebar-footer">
                <a href="/" target="_blank" class="nav-tab" style="padding: 8px 16px; font-family: var(--font-mono); font-size: 0.72rem; text-transform: uppercase;">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                    </svg>
                    <span>Portfolio</span>
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
            
            {{-- Remah Roti / Top Header --}}
            <div class="top-header">
                <div class="breadcrumbs">
                    <span class="root">Console</span>
                    <span class="divider">/</span>
                    <span class="current" id="breadcrumb-section">Overview</span>
                </div>
                
                <div class="header-actions">
                    <div class="search-container">
                        <svg class="search-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                        <input type="text" class="search-input" placeholder="Search resources...">
                    </div>
                    
                    <button class="icon-button">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                        </svg>
                    </button>

                    <button class="icon-button">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
                    </button>

                    <img src="{{ $profile && $profile->photo_path ? asset($profile->photo_path) : asset('images/fotoshot.png') }}" alt="Profile" class="header-avatar">
                </div>
            </div>

            {{-- Validation Alerts --}}
            @if(session('success'))
                <div class="alert alert-success" id="flash-alert">
                    <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4"/></svg>
                    <span>{{ session('success') }}</span>
                </div>
            @endif

            @if($errors->any())
                <div class="alert alert-danger" id="flash-alert-error">
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
                    <p class="welcome-subtitle">Your portfolio systems are running normally. Here's your operational overview.</p>
                </div>

                {{-- Stats Grid --}}
                <div class="overview-stats-grid">
                    
                    {{-- Total Projects --}}
                    <div class="stat-card">
                        <div class="stat-info">
                            <span class="stat-title">Total Projects</span>
                            <div class="stat-value-row">
                                <span class="stat-value">{{ count($projects) }}</span>
                                <span class="stat-subtext">+2 this month</span>
                            </div>
                        </div>
                        <div class="stat-icon-wrapper">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                            </svg>
                        </div>
                    </div>

                    {{-- Months Experience --}}
                    <div class="stat-card">
                        <div class="stat-info">
                            <span class="stat-title">Months Experience</span>
                            <div class="stat-value-row">
                                <span class="stat-value">32</span>
                                <span class="stat-subtext" style="color: var(--text-secondary);">Active Developer</span>
                            </div>
                        </div>
                        <div class="stat-icon-wrapper">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                    </div>

                    {{-- System Status --}}
                    <div class="stat-card">
                        <div class="stat-info">
                            <span class="stat-title">System Status</span>
                            <div class="stat-value-row" style="margin-top: 6px;">
                                <span class="pulse-dot"></span>
                                <span class="stat-subtext status">All Systems Nominal</span>
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
                        <h3 class="milestones-title">Recent Milestones</h3>
                        <a href="#projects" onclick="switchTab('projects', document.getElementById('tab-projects-btn'))" class="milestones-link">
                            <span>View All</span>
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
                            <p style="text-align: center; color: var(--text-muted); font-size: 0.85rem; padding: 20px 0;">Belum ada project terdaftar.</p>
                        @endforelse
                    </div>
                </div>

            </div>

            {{-- ══════════════════════════════════════════════════════
                 TAB: PROFILE & ABOUT ME
                 ══════════════════════════════════════════════════════ --}}
            <div id="tab-profile" class="tab-section">
                <div>
                    <h1 class="welcome-title" style="font-size: 1.8rem;">Profile</h1>
                    <p class="welcome-subtitle">Manage your public portfolio details and identity.</p>
                </div>

                <form action="{{ route('admin.profile.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="profile-grid-container">
                        
                        {{-- Core Identity (Left Card) --}}
                        <div class="admin-card">
                            <div class="profile-avatar-row">
                                <img id="photo-preview" src="{{ $profile && $profile->photo_path ? asset($profile->photo_path) : asset('images/fotoshot.png') }}" alt="Preview" class="profile-avatar-preview">
                                <div class="profile-avatar-info">
                                    <button type="button" class="profile-avatar-upload-btn" onclick="document.getElementById('photo-input').click()">Upload New Photo</button>
                                    <span class="profile-avatar-subtext">JPEG or PNG, max 2MB.</span>
                                    <span id="photo-name" style="font-size: 0.72rem; color: var(--text-muted); font-family: var(--font-mono); margin-top: 2px;"></span>
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
                                    <textarea id="profile-short-bio" name="short_bio" class="form-input" style="min-height: 80px;" required>{{ $profile->short_bio ?? 'I build accessible, pixel-perfect digital experiences for the web.' }}</textarea>
                                </div>
                                
                                <div style="border-top: 1px solid var(--border-thin); padding-top: 20px; display: grid; grid-template-cols: 1fr 1fr; gap: 16px;">
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
                                        <input type="email" name="email" class="form-input" value="{{ $profile->email ?? '' }}" placeholder="email@example.com">
                                    </div>
                                    <div>
                                        <label class="form-label">WhatsApp URL</label>
                                        <input type="text" name="whatsapp" class="form-input" value="{{ $profile->whatsapp ?? '' }}" placeholder="https://wa.me/...">
                                    </div>
                                </div>

                                <div style="border-top: 1px solid var(--border-thin); padding-top: 20px;">
                                    <label class="form-label">Upload CV (PDF)</label>
                                    @if($profile && $profile->cv_path)
                                        <p style="font-family: var(--font-mono); font-size: 0.72rem; color: var(--accent-mint); margin-bottom: 8px; display: flex; align-items: center; gap: 4px;">
                                            <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" style="width: 12px; height: 12px;"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                                            {{ basename($profile->cv_path) }}
                                        </p>
                                    @endif
                                    <button type="button" class="profile-avatar-upload-btn" style="width: 100%; text-align: center; justify-content: center; display: flex; gap: 8px;" onclick="document.getElementById('cv-input').click()">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" style="width: 14px; height: 14px;">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                        </svg>
                                        Select CV File (PDF)
                                    </button>
                                    <input type="file" id="cv-input" name="cv" accept=".pdf" class="hidden" onchange="document.getElementById('cv-file-name').textContent = this.files[0]?.name || ''">
                                    <span id="cv-file-name" style="font-size: 0.72rem; color: var(--text-muted); font-family: var(--font-mono); margin-top: 4px; display: block; text-align: center;"></span>
                                </div>
                            </div>
                        </div>

                        {{-- About Me (Right Card) --}}
                        <div class="admin-card" style="display: flex; flex-direction: column; gap: 20px;">
                            <div class="proj-editor-header">
                                <span class="form-label" style="margin-bottom: 0;">About Me</span>
                                <div class="editor-toolbar" style="border: none; padding: 0;">
                                    <button type="button" class="editor-btn" title="Bold" onclick="wrapText('about-editor', '<b>', '</b>')"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M6 4h8a4 4 0 0 1 4 4 4 4 0 0 1-4 4H6z"/><path d="M6 12h9a4 4 0 0 1 4 4 4 4 0 0 1-4 4H6z"/></svg></button>
                                    <button type="button" class="editor-btn" title="Italic" onclick="wrapText('about-editor', '<i>', '</i>')"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="19" y1="4" x2="10" y2="4"/><line x1="14" y1="20" x2="5" y2="20"/><line x1="15" y1="4" x2="9" y2="20"/></svg></button>
                                    <button type="button" class="editor-btn" title="Link" onclick="wrapText('about-editor', '<a href=\'#\' class=\'font-medium text-slate-200 hover:text-teal-300\'>', '</a>')"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M10 13a5 5 0 0 0 7.54.54l3-3a5 5 0 0 0-7.07-7.07l-1.72 1.71"/><path d="M14 11a5 5 0 0 0-7.54-.54l-3 3a5 5 0 0 0 7.07 7.07l1.71-1.71"/></svg></button>
                                </div>
                            </div>

                            <div style="display: flex; flex-direction: column; gap: 16px; flex: 1;">
                                <div>
                                    <label class="form-label" style="font-size: 0.65rem; color: var(--text-muted);">Paragraph 1</label>
                                    <textarea id="about-editor" name="about_1" class="form-input form-input-editor" style="min-height: 110px;" placeholder="Paragraf pertama deskripsi About..." required>{{ $profile->about_1 ?? '' }}</textarea>
                                </div>

                                <div>
                                    <label class="form-label" style="font-size: 0.65rem; color: var(--text-muted);">Paragraph 2</label>
                                    <textarea name="about_2" class="form-input" style="min-height: 110px;" placeholder="Paragraf kedua deskripsi About...">{{ $profile->about_2 ?? '' }}</textarea>
                                </div>

                                <div>
                                    <label class="form-label" style="font-size: 0.65rem; color: var(--text-muted);">Paragraph 3</label>
                                    <textarea name="about_3" class="form-input" style="min-height: 110px;" placeholder="Paragraf ketiga deskripsi About...">{{ $profile->about_3 ?? '' }}</textarea>
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
                 TAB: EXPERIENCE TIMELINE
                 ══════════════════════════════════════════════════════ --}}
            <div id="tab-experience" class="tab-section">
                
                <div class="exp-timeline-header-row">
                    <div>
                        <h1 class="welcome-title" style="font-size: 1.8rem;">Experience</h1>
                        <p class="welcome-subtitle">Manage your background and work history.</p>
                    </div>
                    <button class="btn btn-primary" onclick="openModal('modal-add-exp')" style="padding: 10px 20px;">+ Add Role</button>
                </div>

                {{-- Timeline Container --}}
                <div class="exp-timeline-container">
                    
                    <span class="exp-timeline-title">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/>
                        </svg>
                        Experience Timeline
                    </span>

                    {{-- Stack of elements --}}
                    <div style="display: flex; flex-direction: column; gap: 16px;">
                        
                        @forelse($experiences as $index => $exp)
                            @if($index === 0)
                                {{-- Active Panel (First Item) --}}
                                <div class="exp-active-panel">
                                    
                                    <div class="exp-active-header">
                                        <div class="exp-collapsed-main">
                                            <span class="exp-collapsed-date">{{ $exp->date_range }}</span>
                                            <h4 class="exp-active-title">{{ $exp->title }}</h4>
                                            <span class="exp-active-meta">{{ $exp->company }}</span>
                                        </div>
                                        
                                        <div class="exp-collapsed-actions">
                                            <span style="font-family: var(--font-mono); font-size: 0.65rem; color: var(--accent-teal); background-color: rgba(16, 185, 129, 0.08); padding: 3px 8px; border-radius: 4px; border: 1px solid rgba(16, 185, 129, 0.15); display: inline-flex; align-items: center; gap: 4px;">
                                                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3" style="width: 8px; height: 8px;"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                                                Live
                                            </span>
                                            
                                            <button class="icon-button" style="color: var(--text-muted); border: 1px solid var(--border-thin);" onclick="openEditExp({{ $exp->id }}, '{{ $exp->start_date }}', '{{ $exp->end_date }}', '{{ addslashes($exp->title) }}', '{{ addslashes($exp->company) }}', '{{ addslashes($exp->company_url ?? '') }}', '{{ addslashes($exp->description) }}', '{{ implode(',', $exp->tags ?? []) }}')">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" style="width: 14px; height: 14px;">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/>
                                                </svg>
                                            </button>

                                            <form action="{{ route('admin.experience.destroy', $exp->id) }}" method="POST" onsubmit="return confirm('Hapus experience ini?')">
                                                @csrf @method('DELETE')
                                                <button type="submit" class="icon-button" style="color: var(--accent-red); border: 1px solid var(--border-thin);">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" style="width: 14px; height: 14px;">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                                    </svg>
                                                </button>
                                            </form>
                                        </div>
                                    </div>

                                    <div style="display: flex; flex-direction: column; gap: 16px;">
                                        <div>
                                            <span class="form-label" style="font-size: 0.65rem;">Description</span>
                                            <div style="background-color: var(--bg-darker); border: 1px solid var(--border-thin); border-radius: 8px; padding: 16px; color: var(--text-primary); font-size: 0.9rem; line-height: 1.6;">
                                                {{ $exp->description }}
                                            </div>
                                        </div>

                                        <div>
                                            <span class="form-label" style="font-size: 0.65rem;">Technologies / Skills</span>
                                            <div class="tech-tags-list" style="margin-top: 4px;">
                                                @foreach($exp->tags ?? [] as $tag)
                                                    <span class="tech-tag" style="font-size: 0.72rem; padding: 4px 12px; background-color: rgba(255,255,255,0.02);">{{ $tag }}</span>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            @else
                                {{-- Collapsed Cards (Subsequent Items) --}}
                                <div class="exp-collapsed-card">
                                    <div class="exp-collapsed-main">
                                        <span class="exp-collapsed-date">{{ $exp->date_range }}</span>
                                        <h4 class="exp-collapsed-title">{{ $exp->title }} <span>· {{ $exp->company }}</span></h4>
                                        <div class="exp-collapsed-tags">
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
                            @endif
                        @empty
                            <div class="exp-collapsed-card" style="justify-content: center; padding: 40px 24px; color: var(--text-muted);">
                                Belum ada riwayat pengalaman kerja. Klik "+ Add Role" untuk menambahkan.
                            </div>
                        @endforelse

                    </div>

                </div>

            </div>

            {{-- ══════════════════════════════════════════════════════
                 TAB: PROJECTS
                 ══════════════════════════════════════════════════════ --}}
            <div id="tab-projects" class="tab-section">
                
                <div>
                    <h1 class="welcome-title" style="font-size: 1.8rem;">Projects</h1>
                    <p class="welcome-subtitle">Deploy and manage entries in your public portfolio registry.</p>
                </div>

                {{-- Two-column form & cover zone --}}
                <form action="{{ route('admin.project.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="admin-card proj-manage-grid">
                        
                        {{-- Left Column: Project Editor --}}
                        <div class="proj-editor-panel">
                            <div>
                                <h3 class="proj-editor-title">Initialize Project</h3>
                                <p class="proj-editor-subtitle">Deploy a new project entry to the public portfolio registry.</p>
                            </div>

                            <div style="display: flex; flex-direction: column; gap: 20px;">
                                <div>
                                    <label for="proj-title" class="form-label">Project Title</label>
                                    <input type="text" id="proj-title" name="title" class="form-input" placeholder="e.g., Quantum Data Visualizer" required>
                                </div>

                                <div style="display: grid; grid-template-cols: 1fr 1fr; gap: 16px;">
                                    <div>
                                        <label class="form-label">Start Date *</label>
                                        <input type="date" name="start_date" class="form-input" required onclick="this.showPicker()">
                                    </div>
                                    <div>
                                        <label class="form-label">End Date</label>
                                        <input type="date" name="end_date" class="form-input" onclick="this.showPicker()">
                                    </div>
                                </div>
                                <div style="margin-top: -10px;">
                                    <label class="form-label">Client / Made At</label>
                                    <input type="text" name="made_at" class="form-input" placeholder="e.g., SMAN 1 Kopang">
                                </div>

                                <div>
                                    <label for="proj-desc" class="form-label">Technical Summary</label>
                                    <textarea id="proj-desc" name="description" class="form-input" placeholder="Briefly describe the architecture, challenges solved, and outcome..."></textarea>
                                </div>

                                <div>
                                    <label class="form-label">Dependencies / Tech Stack</label>
                                    <div class="tags-input-container" id="add-tags-wrapper">
                                        <input type="text" class="tags-text-input" placeholder="Add technology..." id="add-tags-input">
                                        <button type="button" class="tags-add-btn" onclick="addTagPill('add-tags-wrapper', 'add-tags-input', 'add-tags-hidden')">Add</button>
                                    </div>
                                    <input type="hidden" name="tags" id="add-tags-hidden">
                                </div>

                                <div style="display: grid; grid-template-cols: 1fr 1fr; gap: 16px;">
                                    <div>
                                        <label class="form-label">Project URL</label>
                                        <input type="url" name="url" class="form-input" placeholder="https://...">
                                    </div>
                                    <div>
                                        <label class="form-label">Link Label</label>
                                        <input type="text" name="link_label" class="form-input" placeholder="e.g., domain.com">
                                    </div>
                                </div>

                                <div class="flex items-center gap-3">
                                    <label class="toggle-switch">
                                        <input type="checkbox" name="show_on_home" value="1" checked>
                                        <span class="toggle-slider"></span>
                                    </label>
                                    <span class="form-label" style="display: inline; text-transform: none; margin-left: 8px; vertical-align: middle; color: var(--text-secondary);">Show on home screen</span>
                                </div>
                            </div>
                            
                            <div style="display: flex; gap: 12px; margin-top: 12px;">
                                <button type="reset" class="btn btn-secondary" style="flex: 1;">Cancel</button>
                                <button type="submit" class="btn btn-primary" style="flex: 1; justify-content: center; display: inline-flex; gap: 6px;">
                                    <span>Commit Project</span>
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5" style="width: 12px; height: 12px;">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                                    </svg>
                                </button>
                            </div>
                        </div>

                        {{-- Right Column: Cover Asset --}}
                        <div>
                            <span class="form-label">Cover Asset</span>
                            <div class="cover-asset-zone" onclick="document.getElementById('cover-file-input').click()">
                                <svg class="cover-asset-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5m-13.5-9L12 3m0 0l4.5 4.5M12 3v13.5"/>
                                </svg>
                                
                                <div style="display: flex; flex-direction: column; gap: 4px;">
                                    <span class="cover-asset-text-main"><span>Click to browse</span> or drag & drop</span>
                                    <span class="cover-asset-text-sub">PNG, JPG, WebP up to 5MB</span>
                                </div>

                                <img id="cover-preview" class="cover-asset-preview-img" style="display: none;">
                                <span id="cover-file-name" style="font-family: var(--font-mono); font-size: 0.72rem; color: var(--accent-mint); margin-top: 4px; display: block;"></span>
                            </div>
                            <input type="file" id="cover-file-input" name="image" accept="image/*" class="hidden" onchange="previewCoverImage(this)">
                        </div>

                    </div>
                </form>

                {{-- Active Deployments title --}}
                <div class="deployments-title-container">
                    <span class="deployments-title">Active Deployments</span>
                </div>

                {{-- Active Deployments grid --}}
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
                                        <span class="deployment-badge live">Live</span>
                                    @else
                                        <span class="deployment-badge draft">Draft</span>
                                    @endif
                                </div>

                                <button class="deployment-options-btn" onclick="openEditProj({{ $proj->id }}, '{{ $proj->start_date }}', '{{ $proj->end_date }}', '{{ addslashes($proj->title) }}', '{{ addslashes($proj->made_at ?? '') }}', '{{ addslashes($proj->url ?? '') }}', '{{ addslashes($proj->link_label ?? '') }}', '{{ addslashes($proj->description ?? '') }}', '{{ implode(',', $proj->tags ?? []) }}', {{ $proj->show_on_home ? 'true' : 'false' }})">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" style="width: 14px; height: 14px;">
                                        <path d="M10 6a2 2 0 110-4 2 2 0 010 4zM10 12a2 2 0 110-4 2 2 0 010 4zM10 18a2 2 0 110-4 2 2 0 010 4z"/>
                                    </svg>
                                </button>
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
                                <button class="btn btn-secondary" style="padding: 6px 12px; font-size: 0.72rem; border-radius: 6px;" onclick="openEditProj({{ $proj->id }}, '{{ $proj->start_date }}', '{{ $proj->end_date }}', '{{ addslashes($proj->title) }}', '{{ addslashes($proj->made_at ?? '') }}', '{{ addslashes($proj->url ?? '') }}', '{{ addslashes($proj->link_label ?? '') }}', '{{ addslashes($proj->description ?? '') }}', '{{ implode(',', $proj->tags ?? []) }}', {{ $proj->show_on_home ? 'true' : 'false' }})">Edit</button>
                                <form action="{{ route('admin.project.destroy', $proj->id) }}" method="POST" onsubmit="return confirm('Hapus project ini?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn-danger-outline" style="border-radius: 6px; padding: 6px 12px;">Delete</button>
                                </form>
                            </div>
                        </div>
                    @empty
                        <div class="deployment-card" style="grid-column: 1 / -1; align-items: center; justify-content: center; padding: 60px 20px; color: var(--text-muted); font-family: var(--font-mono); font-size: 0.85rem;">
                            Belum ada entri proyek ter-deploy.
                        </div>
                    @endforelse
                </div>

            </div>

        </main>
    </div>

    {{-- ══════════════════════════════════════════════════════════
         MODALS (High-Fidelity Console Dialogs)
         ══════════════════════════════════════════════════════════ --}}

    {{-- Modal: Add Experience --}}
    <div id="modal-add-exp" class="modal-backdrop hidden" onclick="if(event.target===this) closeModal('modal-add-exp')">
        <div class="modal-box">
            <div class="modal-header">
                <span class="modal-title">Deploy Role Entry</span>
                <button onclick="closeModal('modal-add-exp')" class="modal-close-btn">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="width: 18px; height: 18px;"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="12"/></svg>
                </button>
            </div>
            <form action="{{ route('admin.experience.store') }}" method="POST">
                @csrf
                <div class="modal-body" style="display: flex; flex-direction: column; gap: 20px;">
                    <div style="display: grid; grid-template-cols: 1fr 1fr; gap: 16px;">
                        <div>
                            <label class="form-label">Start Date *</label>
                            <input type="date" name="start_date" class="form-input" required onclick="this.showPicker()">
                        </div>
                        <div>
                            <label class="form-label">End Date (Blank = Present)</label>
                            <input type="date" name="end_date" class="form-input" onclick="this.showPicker()">
                        </div>
                    </div>
                    <div style="display: grid; grid-template-cols: 1fr 1fr; gap: 16px;">
                        <div>
                            <label class="form-label">Role Title / Position *</label>
                            <input type="text" name="title" class="form-input" placeholder="e.g., Full Stack Developer" required autocomplete="off">
                        </div>
                        <div>
                            <label class="form-label">Company / Hub *</label>
                            <input type="text" name="company" class="form-input" placeholder="e.g., SMAN 1 Kopang" required autocomplete="off">
                        </div>
                    </div>
                    <div>
                        <label class="form-label">Company URL</label>
                        <input type="url" name="company_url" class="form-input" placeholder="https://..." autocomplete="off">
                    </div>
                    <div>
                        <label class="form-label">Role Summary / Description *</label>
                        <textarea name="description" class="form-input" placeholder="Describe your duties, outcomes, and major achievements in this position..." required></textarea>
                    </div>
                    <div>
                        <label class="form-label">Skills / Keywords</label>
                        <div class="tags-input-container" id="add-exp-tags-wrapper">
                            <input type="text" class="tags-text-input" placeholder="Add keyword..." id="add-exp-tags-input">
                            <button type="button" class="tags-add-btn" onclick="addTagPill('add-exp-tags-wrapper', 'add-exp-tags-input', 'add-exp-tags-hidden')">Add</button>
                        </div>
                        <input type="hidden" name="tags" id="add-exp-tags-hidden">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" onclick="closeModal('modal-add-exp')" class="btn btn-secondary">Cancel</button>
                    <button type="submit" class="btn btn-primary">Deploy Role</button>
                </div>
            </form>
        </div>
    </div>

    {{-- Modal: Edit Experience --}}
    <div id="modal-edit-exp" class="modal-backdrop hidden" onclick="if(event.target===this) closeModal('modal-edit-exp')">
        <div class="modal-box">
            <div class="modal-header">
                <span class="modal-title">Modify Role Entry</span>
                <button onclick="closeModal('modal-edit-exp')" class="modal-close-btn">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="width: 18px; height: 18px;"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="12"/></svg>
                </button>
            </div>
            <form id="edit-exp-form" method="POST">
                @csrf @method('PUT')
                <div class="modal-body" style="display: flex; flex-direction: column; gap: 20px;">
                    <div style="display: grid; grid-template-cols: 1fr 1fr; gap: 16px;">
                        <div>
                            <label class="form-label">Start Date *</label>
                            <input type="date" id="edit-exp-start" name="start_date" class="form-input" required onclick="this.showPicker()">
                        </div>
                        <div>
                            <label class="form-label">End Date (Blank = Present)</label>
                            <input type="date" id="edit-exp-end" name="end_date" class="form-input" onclick="this.showPicker()">
                        </div>
                    </div>
                    <div style="display: grid; grid-template-cols: 1fr 1fr; gap: 16px;">
                        <div>
                            <label class="form-label">Role Title / Position *</label>
                            <input type="text" id="edit-exp-title" name="title" class="form-input" required autocomplete="off">
                        </div>
                        <div>
                            <label class="form-label">Company / Hub *</label>
                            <input type="text" id="edit-exp-company" name="company" class="form-input" required autocomplete="off">
                        </div>
                    </div>
                    <div>
                        <label class="form-label">Company URL</label>
                        <input type="url" id="edit-exp-url" name="company_url" class="form-input" autocomplete="off">
                    </div>
                    <div>
                        <label class="form-label">Role Summary / Description *</label>
                        <textarea id="edit-exp-desc" name="description" class="form-input" required></textarea>
                    </div>
                    <div>
                        <label class="form-label">Skills / Keywords</label>
                        <div class="tags-input-container" id="edit-exp-tags-wrapper">
                            <input type="text" class="tags-text-input" placeholder="Add keyword..." id="edit-exp-tags-input">
                            <button type="button" class="tags-add-btn" onclick="addTagPill('edit-exp-tags-wrapper', 'edit-exp-tags-input', 'edit-exp-tags-hidden')">Add</button>
                        </div>
                        <input type="hidden" name="tags" id="edit-exp-tags-hidden">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" onclick="closeModal('modal-edit-exp')" class="btn btn-secondary">Cancel</button>
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </div>
            </form>
        </div>
    </div>

    {{-- Modal: Edit Project --}}
    <div id="modal-edit-proj" class="modal-backdrop hidden" onclick="if(event.target===this) closeModal('modal-edit-proj')">
        <div class="modal-box">
            <div class="modal-header">
                <span class="modal-title">Modify Project Entry</span>
                <button onclick="closeModal('modal-edit-proj')" class="modal-close-btn">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="width: 18px; height: 18px;"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="12"/></svg>
                </button>
            </div>
            <form id="edit-proj-form" method="POST" enctype="multipart/form-data">
                @csrf @method('PUT')
                <div class="modal-body" style="display: flex; flex-direction: column; gap: 20px;">
                    <div>
                        <label class="form-label">Project Title *</label>
                        <input type="text" id="edit-proj-title" name="title" class="form-input" required autocomplete="off">
                    </div>
                    <div style="display: grid; grid-template-cols: 1fr 1fr; gap: 16px;">
                        <div>
                            <label class="form-label">Start Date *</label>
                            <input type="date" id="edit-proj-start" name="start_date" class="form-input" required onclick="this.showPicker()">
                        </div>
                        <div>
                            <label class="form-label">End Date</label>
                            <input type="date" id="edit-proj-end" name="end_date" class="form-input" onclick="this.showPicker()">
                        </div>
                    </div>
                    <div>
                        <label class="form-label">Client / Made At</label>
                        <input type="text" id="edit-proj-made-at" name="made_at" class="form-input" autocomplete="off">
                    </div>
                    <div>
                        <label class="form-label">Technical Summary</label>
                        <textarea id="edit-proj-desc" name="description" class="form-input" style="min-height: 100px;"></textarea>
                    </div>
                    <div>
                        <label class="form-label">Dependencies / Tech Stack</label>
                        <div class="tags-input-container" id="edit-proj-tags-wrapper">
                            <input type="text" class="tags-text-input" placeholder="Add technology..." id="edit-proj-tags-input">
                            <button type="button" class="tags-add-btn" onclick="addTagPill('edit-proj-tags-wrapper', 'edit-proj-tags-input', 'edit-proj-tags-hidden')">Add</button>
                        </div>
                        <input type="hidden" name="tags" id="edit-proj-tags-hidden">
                    </div>
                    <div style="display: grid; grid-template-cols: 1fr 1fr; gap: 16px;">
                        <div>
                            <label class="form-label">Project URL</label>
                            <input type="url" id="edit-proj-url" name="url" class="form-input" autocomplete="off">
                        </div>
                        <div>
                            <label class="form-label">Link Label</label>
                            <input type="text" id="edit-proj-link-label" name="link_label" class="form-input" autocomplete="off">
                        </div>
                    </div>
                    <div style="display: grid; grid-template-cols: 1fr 1.2fr; gap: 16px; align-items: end;">
                        <div class="flex items-center gap-3" style="padding-bottom: 12px;">
                            <label class="toggle-switch">
                                <input type="checkbox" name="show_on_home" value="1" id="edit-show-home">
                                <span class="toggle-slider"></span>
                            </label>
                            <span class="form-label" style="display: inline; text-transform: none; margin-left: 8px; vertical-align: middle; color: var(--text-secondary);">Show on home</span>
                        </div>
                        <div>
                            <label class="form-label">Ganti Cover Image (opsional)</label>
                            <button type="button" class="profile-avatar-upload-btn" style="width: 100%; text-align: center; justify-content: center; display: flex; gap: 8px;" onclick="document.getElementById('edit-cover-file-input').click()">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" style="width: 14px; height: 14px;">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                                Choose Asset Image
                            </button>
                            <input type="file" id="edit-cover-file-input" name="image" accept="image/*" class="hidden" onchange="document.getElementById('edit-cover-file-name').textContent = this.files[0]?.name || ''">
                            <span id="edit-cover-file-name" style="font-family: var(--font-mono); font-size: 0.72rem; color: var(--accent-mint); margin-top: 4px; display: block; text-align: center;"></span>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" onclick="closeModal('modal-edit-proj')" class="btn btn-secondary">Cancel</button>
                    <button type="submit" class="btn var(--btn-primary) btn-primary">Commit Changes</button>
                </div>
            </form>
        </div>
    </div>

    {{-- ── SCRIPTS ─────────────────────────────────────────────── --}}
    <script>
        // Blade → JS bridge (server-side value)
        const activeTab = '{{ request()->query("tab", "overview") }}';
    </script>
    <script src="{{ asset('js/admin.js') }}"></script>
</body>
</html>

