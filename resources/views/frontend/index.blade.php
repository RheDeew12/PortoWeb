<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <title>{{ $profile['_nama'] ?? 'Portofolio Personal' }} - {{ $profile['_gelar'] ?? 'Resume' }}</title>
        <link rel="icon" type="image/x-icon" href="{{ asset('assets/img/favicon.ico') }}" />

        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Plus+Jakarta+Sans:wght@700;800&family=Space+Mono:wght@400;700&display=swap" rel="stylesheet">

        <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
        <link href="{{ asset('frontend/css/styles.css') }}" rel="stylesheet" />

        <style>
            :root {
                --bg-main: #060a12;
                --bg-card: #0d1220;
                --accent-blue: #6366f1;
                --accent-purple: #a855f7;
                --accent-cyan: #22d3ee;
                --text-light: #f1f5f9;
                --text-muted: #94a3b8;
                --header-height: 68px;
            }

            *, *::before, *::after { box-sizing: border-box; }

            html { scroll-padding-top: calc(var(--header-height) + 1.5rem); }

            body {
                font-family: 'Inter', sans-serif;
                color: var(--text-muted);
                background-color: var(--bg-main);
                scroll-behavior: smooth;
                padding-top: var(--header-height);
                margin: 0;
            }

            h1, h2, h3, h4, h5, h6 {
                font-family: 'Plus Jakarta Sans', sans-serif !important;
                color: var(--text-light) !important;
                font-weight: 800;
                letter-spacing: -0.03em !important;
            }

            /* ================================================
               FUTURISTIC TOP HEADER
            ================================================ */
            #topNav {
                position: fixed;
                top: 0;
                left: 0;
                right: 0;
                z-index: 1000;
                height: var(--header-height);
                background: rgba(6, 10, 18, 0.75);
                backdrop-filter: blur(20px);
                -webkit-backdrop-filter: blur(20px);
                border-bottom: 1px solid rgba(99, 102, 241, 0.18);
            }

            /* Animated scanline accent on bottom border */
            #topNav::after {
                content: '';
                position: absolute;
                bottom: -1px;
                left: 0;
                height: 1px;
                width: 30%;
                background: linear-gradient(90deg, transparent, var(--accent-cyan), var(--accent-blue), transparent);
                animation: scanline 4s ease-in-out infinite;
            }

            @keyframes scanline {
                0%   { left: -30%; }
                100% { left: 130%; }
            }

            .topnav-inner {
                max-width: 1400px;
                margin: 0 auto;
                height: 100%;
                display: flex;
                align-items: center;
                justify-content: space-between;
                padding: 0 2rem;
                gap: 1.5rem;
            }

            /* Logo / Brand */
            .topnav-brand {
                display: flex;
                align-items: center;
                gap: 0.75rem;
                text-decoration: none;
                flex-shrink: 0;
            }

            .topnav-name {
                font-family: 'Plus Jakarta Sans', sans-serif;
                font-weight: 800;
                font-size: 1.05rem;
                color: var(--text-light);
                letter-spacing: -0.02em;
            }

            .topnav-name span {
                color: var(--accent-blue);
            }

            /* Nav links */
            .topnav-links {
                display: flex;
                align-items: center;
                gap: 0.25rem;
                list-style: none;
                margin: 0;
                padding: 0;
            }

            .topnav-links .nav-link {
                font-family: 'Space Mono', monospace;
                font-size: 0.75rem;
                font-weight: 700;
                letter-spacing: 0.08em;
                text-transform: uppercase;
                color: #475569;
                padding: 0.4rem 0.9rem;
                border-radius: 8px;
                border: 1px solid transparent;
                transition: all 0.25s ease;
                text-decoration: none;
                position: relative;
                white-space: nowrap;
            }

            .topnav-links .nav-link::before {
                content: attr(data-index);
                font-size: 0.58rem;
                color: var(--accent-cyan);
                position: absolute;
                top: 3px;
                left: 6px;
                opacity: 0;
                transition: opacity 0.2s ease;
            }

            .topnav-links .nav-link:hover,
            .topnav-links .nav-link.active {
                color: var(--text-light);
                background: rgba(99, 102, 241, 0.1);
                border-color: rgba(99, 102, 241, 0.25);
            }

            .topnav-links .nav-link:hover::before,
            .topnav-links .nav-link.active::before {
                opacity: 1;
            }

            /* Status dot */
            .topnav-status {
                display: flex;
                align-items: center;
                gap: 0.5rem;
                font-family: 'Space Mono', monospace;
                font-size: 0.7rem;
                color: #34d399;
                flex-shrink: 0;
                border: 1px solid rgba(52, 211, 153, 0.2);
                background: rgba(52, 211, 153, 0.05);
                padding: 0.3rem 0.8rem;
                border-radius: 20px;
            }

            .topnav-status-dot {
                width: 7px;
                height: 7px;
                border-radius: 50%;
                background: #34d399;
                box-shadow: 0 0 6px #34d399;
                animation: pulse-dot 2s ease-in-out infinite;
            }

            @keyframes pulse-dot {
                0%, 100% { opacity: 1; transform: scale(1); }
                50%       { opacity: 0.5; transform: scale(0.85); }
            }

            /* Mobile hamburger */
            .topnav-toggler {
                display: none;
                background: none;
                border: 1px solid rgba(255,255,255,0.1);
                border-radius: 8px;
                padding: 0.4rem 0.6rem;
                cursor: pointer;
                color: var(--text-muted);
                font-size: 1rem;
                transition: all 0.2s ease;
            }

            .topnav-toggler:hover {
                background: rgba(99,102,241,0.1);
                color: var(--text-light);
                border-color: var(--accent-blue);
            }

            /* Mobile dropdown */
            .topnav-collapse {
                display: flex;
                align-items: center;
                gap: 1.5rem;
                flex: 1;
                justify-content: center;
            }

            @media (max-width: 991px) {
                .topnav-toggler { display: block; }
                .topnav-status  { display: none; }

                .topnav-collapse {
                    display: none;
                    position: absolute;
                    top: var(--header-height);
                    left: 0;
                    right: 0;
                    background: rgba(6, 10, 18, 0.97);
                    backdrop-filter: blur(20px);
                    border-bottom: 1px solid rgba(99,102,241,0.15);
                    flex-direction: column;
                    align-items: stretch;
                    padding: 1rem 1.5rem;
                    gap: 0;
                }

                .topnav-collapse.open { display: flex; }

                .topnav-links {
                    flex-direction: column;
                    width: 100%;
                }

                .topnav-links .nav-link {
                    padding: 0.75rem 1rem;
                    border-radius: 8px;
                    font-size: 0.8rem;
                }
            }

            /* ================================================
               SECTIONS
            ================================================ */
            .resume-section {
                padding-top: 5rem !important;
                padding-bottom: 5rem !important;
                border-bottom: 1px solid rgba(255, 255, 255, 0.03);
                max-width: 1400px;
                margin: 0 auto;
            }

            /* ================================================
               HERO
            ================================================ */
            .hero-card-frame {
                position: relative;
                background: #0d1322;
                border: 1px solid rgba(255, 255, 255, 0.08);
                border-radius: 24px;
                padding: 12px;
                transform: rotate(2deg);
                transition: transform 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275), border-color 0.3s ease;
            }

            .hero-card-frame:hover {
                transform: rotate(0deg) scale(1.02);
                border-color: var(--accent-blue);
            }

            .hero-card-frame img {
                border-radius: 16px;
                object-fit: cover;
                background-color: #1a233a;
                width: 100%;
                height: 100%;
                display: block;
            }

            .experience-badge {
                position: absolute;
                bottom: 25px;
                left: -20px;
                background: var(--bg-card);
                border: 1px solid rgba(255, 255, 255, 0.1);
                padding: 0.75rem 1.25rem;
                border-radius: 12px;
            }

            /* ================================================
               BUTTONS
            ================================================ */
            .btn-gradient-primary {
                display: inline-flex;
                align-items: center;
                background: linear-gradient(135deg, var(--accent-blue), var(--accent-purple));
                color: #fff !important;
                font-weight: 600;
                padding: 0.75rem 1.75rem;
                border-radius: 12px;
                border: none;
                text-decoration: none;
                transition: all 0.3s ease;
            }

            .btn-gradient-primary:hover {
                transform: translateY(-2px);
                filter: brightness(1.1);
            }

            .btn-outline-custom {
                display: inline-flex;
                align-items: center;
                background: transparent;
                color: var(--text-light) !important;
                font-weight: 600;
                padding: 0.75rem 1.75rem;
                border-radius: 12px;
                border: 1px solid rgba(255, 255, 255, 0.15);
                text-decoration: none;
                transition: all 0.3s ease;
            }

            .btn-outline-custom:hover {
                background: rgba(255, 255, 255, 0.05);
                border-color: rgba(255, 255, 255, 0.4);
                transform: translateY(-2px);
            }

            /* ================================================
               GLASS CARD
            ================================================ */
            .glass-panel {
                background-color: var(--bg-card);
                border: 1px solid rgba(255, 255, 255, 0.05);
                border-radius: 18px;
            }

            /* ================================================
               TECH BOX
            ================================================ */
            .tech-box-item {
                background: #0f1524;
                border: 1px solid rgba(255, 255, 255, 0.04);
                border-radius: 16px;
                padding: 1.5rem;
                text-align: center;
                transition: all 0.3s ease;
            }

            .tech-box-item:hover {
                border-color: var(--accent-blue);
                transform: translateY(-4px);
            }

            /* ================================================
               PROJECT CARD
            ================================================ */
            .portfolio-card {
                background: var(--bg-card);
                border: 1px solid rgba(255, 255, 255, 0.05);
                border-radius: 20px;
                overflow: hidden;
                transition: all 0.4s cubic-bezier(0.16, 1, 0.3, 1);
            }

            .portfolio-card:hover {
                transform: translateY(-6px);
                border-color: rgba(99, 102, 241, 0.3);
            }

            .portfolio-img {
                width: 100%;
                max-height: 220px;
                object-fit: cover;
                border-bottom: 1px solid rgba(255, 255, 255, 0.05);
                display: block;
            }

            /* ================================================
               TIMELINE
            ================================================ */
            .timeline-container {
                border-left: 2px solid rgba(255, 255, 255, 0.05);
                padding-left: 2rem;
            }

            .timeline-item {
                position: relative;
            }

            .timeline-item::before {
                content: '';
                position: absolute;
                left: -2.6rem;
                top: 0.5rem;
                width: 14px;
                height: 14px;
                border-radius: 50%;
                background: var(--bg-main);
                border: 3px solid var(--accent-blue);
            }

            .timeline-date-badge {
                color: #a855f7;
                background: rgba(168, 85, 247, 0.1);
                font-weight: 600;
                padding: 0.3rem 0.8rem;
                border-radius: 8px;
                font-size: 0.85rem;
                white-space: nowrap;
            }

            /* ================================================
               INFO LIST
            ================================================ */
            .info-list { display: flex; flex-direction: column; }

            .info-list-row {
                border-bottom: 1px solid rgba(255, 255, 255, 0.04);
                padding: 0.85rem 0;
                display: flex;
                justify-content: space-between;
                align-items: center;
                flex-wrap: wrap;
                gap: 0.5rem;
            }

            .info-list-row:last-child { border: none; }

            /* ================================================
               BADGE & SOCIAL
            ================================================ */
            .badge-tool {
                background: rgba(99, 102, 241, 0.1);
                color: #818cf8;
                border: 1px solid rgba(99, 102, 241, 0.2);
                font-size: 0.78rem;
                font-weight: 500;
                padding: 0.3rem 0.7rem;
                border-radius: 6px;
                display: inline-block;
            }

            .social-icon {
                display: inline-flex;
                align-items: center;
                justify-content: center;
                width: 40px;
                height: 40px;
                border-radius: 10px;
                background: rgba(255,255,255,0.05);
                border: 1px solid rgba(255,255,255,0.1);
                color: var(--text-light) !important;
                text-decoration: none;
                transition: all 0.3s ease;
                margin-right: 0.5rem;
            }

            .social-icon:hover {
                background: var(--accent-blue);
                border-color: var(--accent-blue);
                transform: translateY(-2px);
            }
        </style>
    </head>

    <body id="page-top">

        {{-- ================================================
             FUTURISTIC TOP HEADER
        ================================================ --}}
        <header id="topNav">
            <div class="topnav-inner">

                {{-- Brand --}}
                @php
                    $nama_lengkap = $profile['_nama'] ?? 'Dev Portfolio';
                    $arr_nama = explode(' ', $nama_lengkap);
                    $nama_belakang = array_pop($arr_nama);
                    $nama_depan = implode(' ', $arr_nama);
                @endphp
                <a class="topnav-brand js-scroll-trigger" href="#page-top">
                    <div class="topnav-name">{{ $nama_depan }} <span>{{ $nama_belakang }}</span></div>
                </a>

                {{-- Mobile toggle --}}
                <button class="topnav-toggler" id="navToggler" aria-label="Toggle navigation">
                    <i class="fa fa-bars"></i>
                </button>

                {{-- Nav + status --}}
                <div class="topnav-collapse" id="navCollapse">
                    <ul class="topnav-links">
                        <li><a class="nav-link js-scroll-trigger" href="#about"          data-index="01">About</a></li>
                        <li><a class="nav-link js-scroll-trigger" href="#experience"     data-index="02">Experience</a></li>
                        <li><a class="nav-link js-scroll-trigger" href="#education"      data-index="03">Education</a></li>
                        <li><a class="nav-link js-scroll-trigger" href="#projects"       data-index="04">Projects</a></li>
                        <li><a class="nav-link js-scroll-trigger" href="#interests"      data-index="05">Skills</a></li>
                        <li><a class="nav-link js-scroll-trigger" href="#certifications" data-index="06">Certs</a></li>
                    </ul>

                    <div class="topnav-status">
                        <span class="topnav-status-dot"></span>
                        Open to Work
                    </div>
                </div>

            </div>
        </header>

        {{-- ================================================
             MAIN CONTENT
        ================================================ --}}
        <div class="container-fluid p-0">

            {{-- ABOUT --}}
            <section class="resume-section d-flex align-items-center px-3 px-md-5" id="about" style="min-height: 100vh;">
                <div class="w-100">
                    <div class="row align-items-center g-5">

                        <div class="col-lg-7 text-start" data-aos="fade-right" data-aos-duration="1000">
                            <span class="badge px-3 py-2 mb-3 rounded-pill"
                                  style="background: rgba(99,102,241,0.1); color: #818cf8; font-weight: 600; font-size: 0.85rem; letter-spacing: 0.05em;">
                                {{ $profile['_gelar'] ?? 'Full Stack Developer' }}
                            </span>

                            <h1 class="mb-3 text-white" style="font-size: clamp(2.5rem, 5vw, 4.8rem); line-height: 1.05; font-weight: 800;">
                                {{ $nama_depan }} <span style="color: var(--accent-blue);">{{ $nama_belakang }}</span>
                            </h1>

                            <h3 class="mb-4 text-white opacity-75 fs-4 fw-medium">{{ $profile['_gelar'] ?? 'Software Engineer' }}</h3>

                            <div class="mb-5 text-muted" style="line-height: 1.8; font-size: 1.05rem; max-width: 620px;">
                                @if($about_content)
                                    {!! $about_content->isi !!}
                                @else
                                    <p>I build modern, responsive, and scalable web applications with clean architecture and bring ideas to life on the web.</p>
                                @endif
                            </div>

                            <div class="d-flex flex-wrap gap-3 mb-5">
                                <a href="#projects" class="btn-gradient-primary js-scroll-trigger">
                                    View My Work <i class="fa fa-arrow-right ms-2 small"></i>
                                </a>
                                <a href="mailto:{{ $profile['_email'] ?? 'name@email.com' }}" class="btn-outline-custom">
                                    Contact Me
                                </a>
                            </div>

                            <div class="d-flex gap-2">
                                @if(isset($profile['_linkedin']))
                                    <a class="social-icon" href="{{ $profile['_linkedin'] }}" target="_blank" aria-label="LinkedIn">
                                        <i class="fab fa-linkedin-in"></i>
                                    </a>
                                @endif
                                @if(isset($profile['_github']))
                                    <a class="social-icon" href="{{ $profile['_github'] }}" target="_blank" aria-label="GitHub">
                                        <i class="fab fa-github"></i>
                                    </a>
                                @endif
                            </div>
                        </div>

                        <div class="col-lg-5 d-flex justify-content-center" data-aos="fade-left" data-aos-duration="1000">
                            <div class="hero-card-frame" style="width: 300px; height: 360px; flex-shrink: 0;">
                                @if(isset($profile['_foto']) && file_exists(public_path('admin/images/profile/' . $profile['_foto'])))
                                    <img src="{{ asset('admin/images/profile/' . $profile['_foto']) }}" alt="Profile" />
                                @else
                                    <img src="{{ asset('assets/img/profile.jpg') }}" alt="Default" />
                                @endif
                                <div class="experience-badge d-flex align-items-center gap-2">
                                    <span class="fs-4 fw-bold text-white">1+</span>
                                    <span class="text-muted lh-sm" style="font-size: 0.75rem; font-weight: 500;">Years<br>Experience</span>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="row mt-5 pt-4" data-aos="fade-up">
                        <div class="col-12">
                            <div class="glass-panel p-4 p-md-5">
                                <h4 class="mb-4 fs-5 text-white">
                                    <i class="fa fa-user-check text-primary me-2"></i>Personal Overview
                                </h4>
                                <div class="info-list">
                                    <div class="info-list-row">
                                        <span class="text-muted">Email</span>
                                        <span class="text-white fw-medium">{{ $profile['_email'] ?? '-' }}</span>
                                    </div>
                                    <div class="info-list-row">
                                        <span class="text-muted">Location</span>
                                        <span class="text-white fw-medium">{{ $profile['_alamat'] ?? '-' }}</span>
                                    </div>
                                    <div class="info-list-row">
                                        <span class="text-muted">Availability</span>
                                        <span class="fw-semibold" style="color: #34d399;">
                                            <i class="fa fa-circle me-1" style="font-size: 0.6rem;"></i> Available for Work
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            {{-- EXPERIENCE --}}
            <section class="resume-section px-3 px-md-5" id="experience">
                <div>
                    <h2 class="mb-5 text-white" data-aos="fade-right">
                        <i class="fa fa-briefcase text-primary me-3"></i>Work Journey
                    </h2>
                    <div class="timeline-container">
                        @forelse($experience as $exp)
                            <div class="timeline-item mb-5" data-aos="fade-up">
                                <div class="d-flex flex-column flex-md-row justify-content-between gap-2 mb-2">
                                    <div>
                                        <h3 class="mb-0 text-white fs-4 fw-bold">{{ $exp->judul }}</h3>
                                        <div class="text-muted fw-semibold mb-2" style="font-size: 1rem;">{{ $exp->info1 }}</div>
                                    </div>
                                    <div class="flex-shrink-0">
                                        <span class="timeline-date-badge">
                                            {{ \Carbon\Carbon::parse($exp->tgl_mulai)->isoFormat('MMM Y') }} -
                                            {{ $exp->tgl_akhir ? \Carbon\Carbon::parse($exp->tgl_akhir)->isoFormat('MMM Y') : 'Present' }}
                                        </span>
                                    </div>
                                </div>
                                <div class="text-muted" style="line-height: 1.75;">{!! $exp->isi !!}</div>
                            </div>
                        @empty
                            <p class="text-muted">Belum ada riwayat pengalaman kerja.</p>
                        @endforelse
                    </div>
                </div>
            </section>

            {{-- EDUCATION --}}
            <section class="resume-section px-3 px-md-5" id="education">
                <div>
                    <h2 class="mb-5 text-white" data-aos="fade-right">
                        <i class="fa fa-graduation-cap text-primary me-3"></i>Education
                    </h2>
                    <div class="timeline-container">
                        @forelse($education as $edu)
                            <div class="timeline-item mb-5" data-aos="fade-up">
                                <div class="d-flex flex-column flex-md-row justify-content-between gap-2 mb-2">
                                    <div>
                                        <h3 class="mb-1 text-white fs-4 fw-bold">{{ $edu->info1 }}</h3>
                                        <div class="text-muted fw-semibold mb-2" style="font-size: 0.95rem;">{{ $edu->judul }}</div>
                                    </div>
                                    <div class="flex-shrink-0">
                                        <span class="timeline-date-badge">
                                            {{ \Carbon\Carbon::parse($edu->tgl_mulai)->isoFormat('Y') }} -
                                            {{ $edu->tgl_akhir ? \Carbon\Carbon::parse($edu->tgl_akhir)->isoFormat('Y') : 'Masa Studi' }}
                                        </span>
                                    </div>
                                </div>
                                @if($edu->info2)
                                    <div class="text-muted small mb-2"><i class="fa fa-university me-1"></i> {{ $edu->info2 }}</div>
                                @endif
                                @if($edu->info3)
                                    <span class="badge mb-3"
                                          style="background: rgba(99,102,241,0.1); color: #818cf8; border: 1px solid rgba(99,102,241,0.25); padding: 0.35rem 0.8rem; border-radius: 20px; font-size: 0.78rem; font-weight: 600;">
                                        GPA: {{ $edu->info3 }}
                                    </span>
                                @endif
                                <div class="text-muted small" style="line-height: 1.7;">{!! $edu->isi !!}</div>
                            </div>
                        @empty
                            <p class="text-muted">Belum ada riwayat pendidikan.</p>
                        @endforelse
                    </div>
                </div>
            </section>

            {{-- PROJECTS --}}
            <section class="resume-section px-3 px-md-5" id="projects">
                <div>
                    <h2 class="mb-5 text-white" data-aos="fade-right">
                        <i class="fa fa-code text-primary me-3"></i>Featured Projects
                    </h2>
                    <div class="row g-4">
                        @forelse($projects as $project)
                            <div class="col-md-6 d-flex align-items-stretch" data-aos="fade-up">
                                <div class="portfolio-card w-100 d-flex flex-column">
                                    @if($project->image)
                                        <img src="{{ asset('admin/images/projects/' . $project->image) }}"
                                             class="portfolio-img" alt="{{ $project->title }}">
                                    @endif
                                    <div class="d-flex flex-column flex-grow-1 p-4">
                                        <h4 class="fw-bold text-white mb-2 fs-5">{{ $project->title }}</h4>
                                        <div class="text-muted mb-4 flex-grow-1" style="font-size: 0.88rem; line-height: 1.65;">
                                            {!! strip_tags($project->description) !!}
                                        </div>
                                        @if($project->tools)
                                            <div class="mb-4 d-flex flex-wrap gap-2">
                                                @foreach(explode(',', $project->tools) as $tool)
                                                    <span class="badge-tool">{{ trim($tool) }}</span>
                                                @endforeach
                                            </div>
                                        @endif
                                        <div class="d-flex gap-2 flex-wrap mt-auto">
                                            @if($project->link_github)
                                                <a href="{{ $project->link_github }}" target="_blank" class="btn-outline-custom" style="padding: 0.5rem 1rem; font-size: 0.85rem;">
                                                    <i class="fab fa-github me-1"></i> Repository
                                                </a>
                                            @endif
                                            @if($project->link_live)
                                                <a href="{{ $project->link_live }}" target="_blank" class="btn-gradient-primary" style="padding: 0.5rem 1rem; font-size: 0.85rem;">
                                                    <i class="fa fa-external-link-alt me-1"></i> Live Demo
                                                </a>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="col-12"><p class="text-muted">Belum ada karya proyek yang diunggah.</p></div>
                        @endforelse
                    </div>
                </div>
            </section>

            {{-- INTERESTS --}}
            <section class="resume-section px-3 px-md-5" id="interests">
                <div data-aos="fade-up">
                    <h2 class="mb-5 text-white">
                        <i class="fa fa-shapes text-primary me-3"></i>Technologies &amp; Fields
                    </h2>
                    <div class="mb-5 text-muted" style="line-height: 1.85; font-size: 1.05rem;">
                        @if($interest_content)
                            {!! $interest_content->isi !!}
                        @else
                            <p>Apart from core software craftsmanship, I focus heavily on full-stack architecture, clean code practices, and robust automation ecosystems.</p>
                        @endif
                    </div>
                    @if($interests_tags)
                        <div class="row row-cols-2 row-cols-md-4 g-3">
                            @foreach(explode(',', $interests_tags) as $tag)
                                <div class="col">
                                    <div class="tech-box-item">
                                        <i class="fa fa-cube text-primary mb-2 fs-4 d-block"></i>
                                        <span class="text-white fw-medium small">{{ trim($tag) }}</span>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </section>

            {{-- CERTIFICATIONS --}}
            <section class="resume-section px-3 px-md-5" id="certifications">
                <div>
                    <h2 class="mb-5 text-white" data-aos="fade-right">
                        <i class="fa fa-certificate text-primary me-3"></i>Credentials &amp; Achievements
                    </h2>
                    @if($award_content)
                        <div class="mb-5 text-muted" style="line-height: 1.8;" data-aos="fade-up">{!! $award_content->isi !!}</div>
                    @endif
                    <ul class="list-unstyled mb-0">
                        @forelse($certifications as $cert)
                            <li class="mb-4 d-flex align-items-start gap-3" data-aos="fade-up">
                                <span class="text-warning mt-1" style="font-size: 1.2rem; flex-shrink: 0;">
                                    <i class="fas fa-trophy"></i>
                                </span>
                                <div>
                                    <span class="fw-bold text-white d-block mb-1 fs-5" style="line-height: 1.3;">{{ $cert->name }}</span>
                                    <span class="text-muted fw-medium d-block mb-2" style="font-size: 0.9rem;">Issued by {{ $cert->issuing_org }}</span>
                                    <div class="text-muted d-flex flex-wrap align-items-center gap-2" style="font-size: 0.85rem;">
                                        <span><i class="far fa-calendar-alt me-1"></i>{{ \Carbon\Carbon::parse($cert->issued_date)->isoFormat('MMMM Y') }}</span>
                                        @if($cert->credential_id)
                                            <span>|</span>
                                            <span>ID: <code class="text-light px-2 py-1 rounded" style="background: rgba(255,255,255,0.06); border: 1px solid rgba(255,255,255,0.1); font-size: 0.8rem;">{{ $cert->credential_id }}</code></span>
                                        @endif
                                        @if($cert->credential_url)
                                            <span>|</span>
                                            <a href="{{ $cert->credential_url }}" target="_blank" class="text-decoration-none fw-medium" style="color: var(--accent-blue);">
                                                Verify <i class="fa fa-external-link-alt ms-1" style="font-size: 9px"></i>
                                            </a>
                                        @endif
                                        @if($cert->file_cert)
                                            <span>|</span>
                                            <a href="{{ asset('admin/images/certifications/' . $cert->file_cert) }}" target="_blank" class="text-decoration-none fw-medium text-success">
                                                View PDF <i class="fa fa-file-pdf ms-1" style="font-size: 9px"></i>
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            </li>
                        @empty
                            <p class="text-muted">Belum ada data sertifikasi terdaftar.</p>
                        @endforelse
                    </ul>
                </div>
            </section>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
        <script src="{{ asset('frontend/js/scripts.js') }}"></script>
        <script>
            AOS.init({ once: true, mirror: false });

            // Mobile nav toggle
            const toggler = document.getElementById('navToggler');
            const collapse = document.getElementById('navCollapse');
            toggler.addEventListener('click', () => {
                collapse.classList.toggle('open');
            });

            // Close mobile nav on link click
            document.querySelectorAll('.js-scroll-trigger').forEach(link => {
                link.addEventListener('click', () => collapse.classList.remove('open'));
            });

            // Active nav link on scroll
            const sections = document.querySelectorAll('section[id]');
            const navLinks = document.querySelectorAll('#topNav .nav-link');
            const headerH = parseInt(getComputedStyle(document.documentElement).getPropertyValue('--header-height'));

            const observer = new IntersectionObserver(entries => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        navLinks.forEach(l => l.classList.remove('active'));
                        const active = document.querySelector(`#topNav a[href="#${entry.target.id}"]`);
                        if (active) active.classList.add('active');
                    }
                });
            }, { rootMargin: `-${headerH}px 0px -60% 0px` });

            sections.forEach(s => observer.observe(s));

            // Smooth scroll
            document.querySelectorAll('.js-scroll-trigger').forEach(link => {
                link.addEventListener('click', e => {
                    const target = link.getAttribute('href');
                    if (target && target.startsWith('#')) {
                        e.preventDefault();
                        const el = document.querySelector(target);
                        if (el) el.scrollIntoView({ behavior: 'smooth' });
                    }
                });
            });
        </script>
    </body>
</html>