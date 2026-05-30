<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Admin Dashboard - Porto Web</title>
  
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">

  <link rel="stylesheet" href="{{ asset('admin') }}/vendors/mdi/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="{{ asset('admin') }}/vendors/base/vendor.bundle.base.css">
  <link rel="stylesheet" href="{{ asset('admin') }}/vendors/datatables.net-bs4/dataTables.bootstrap4.css">
  <link rel="stylesheet" href="{{ asset('admin') }}/css/style.css">
  <link rel="shortcut icon" href="{{ asset('admin') }}/images/favicon.png" />

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote-bs5.min.css" />
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tokenfield/0.12.0/css/bootstrap-tokenfield.css" integrity="sha512-wcf2ifw+8xI4FktrSorGwO7lgRzGx1ld97ySj1pFADZzFdcXTIgQhHMTo7tQIADeYdRRnAjUnF00Q5WTNmL3+A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

  <style>
    body {
      font-family: 'Plus Jakarta Sans', sans-serif !important;
      background-color: #f8fafc;
    }
    .navbar {
      box-shadow: 0 2px 15px rgba(0, 0, 0, 0.02);
      border-bottom: 1px solid #e2e8f0;
    }
    .navbar .navbar-brand-wrapper {
      background: #ffffff !important;
    }
    .sidebar {
      border-right: 1px solid #e2e8f0;
      background: #ffffff !important;
    }
    .sidebar .nav .nav-item .nav-link {
      border-radius: 8px;
      margin: 2px 15px;
      padding: 12px 20px;
      color: #64748b;
      transition: all 0.2s ease;
    }
    .sidebar .nav .nav-item .nav-link:hover, 
    .sidebar .nav .nav-item.active .nav-link {
      background: #f1f5f9 !important;
      color: #4f46e5 !important;
    }
    .sidebar .nav .nav-item .nav-link .menu-icon {
      color: inherit !important;
    }
    .content-wrapper {
      background: #f8fafc !important;
      padding: 2rem !important;
    }
    .main-card-wrapper {
      border: none !important;
      border-radius: 16px !important;
      box-shadow: 0 4px 25px rgba(0, 0, 0, 0.02) !important;
      background: #ffffff;
    }
    .footer {
      background: #ffffff !important;
      border-top: 1px solid #e2e8f0;
      padding: 20px !important;
    }
    .brand-text {
      font-weight: 800;
      font-size: 19px;
      letter-spacing: -0.5px;
      background: linear-gradient(45deg, #4f46e5, #06b6d4);
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
      text-decoration: none;
    }
    .tokenfield .token {
      margin: -1px 1px 1px 1px;
      height: 25px;
      line-height: 22px;
      color: #fff;
      background-color: #0b5ed7
    }
    .tokenfield .token a {
      color: #FFFFFF;
      text-decoration: none;
    }
  </style>
</head>

<body>
  <div class="container-scroller">
    <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
      <div class="navbar-brand-wrapper d-flex justify-content-center align-items-center">
        <div class="navbar-brand-inner-wrapper d-flex justify-content-between align-items-center w-100 px-3">  
          <a class="brand-text" href="#">PortoDashboard</a>
          <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
            <span class="mdi mdi-sort-variant"></span>
          </button>
        </div>  
      </div>
      <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
        <ul class="navbar-nav navbar-nav-right">
          <li class="nav-item nav-profile dropdown">
            <a class="nav-link dropdown-toggle d-flex align-items-center gap-2" href="#" data-bs-toggle="dropdown" id="profileDropdown">
              <img src="{{ asset('admin') }}/images/faces/{{ Auth::user()->avatar }}" alt="profile" class="rounded-circle" style="width: 35px; height: 35px; object-fit: cover; border: 2px solid #e2e8f0;"/>
              <span class="nav-profile-name fw-semibold text-dark">{{ Auth::user()->name }}</span>
            </a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown shadow-sm border-0 mt-2" aria-labelledby="profileDropdown">
              <a class="dropdown-item py-2 text-danger" href="{{ url('auth/logout') }}">
                <i class="mdi mdi-logout text-danger me-2"></i>
                Logout
              </a>
            </div>
          </li>
        </ul>
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
          <span class="mdi mdi-menu"></span>
        </button>
      </div>
    </nav>
    
    <div class="container-fluid page-body-wrapper">
      <nav class="sidebar sidebar-offcanvas" id="sidebar">
        <ul class="nav pt-3">
          <li class="nav-item {{ Request::is('dashboard/halaman*') ? 'active' : '' }}">
            <a class="nav-link d-flex align-items-center" href="{{ route('halaman.index') }}">
              <i class="mdi mdi-file-document-box-outline menu-icon me-3 fs-5"></i>
              <span class="menu-title fw-medium">Halaman</span>
            </a>
          </li>
          
          <li class="nav-item {{ Request::is('dashboard/experience*') ? 'active' : '' }}">
            <a class="nav-link d-flex align-items-center" href="{{ route('experience.index') }}">
              <i class="mdi mdi-briefcase-outline menu-icon me-3 fs-5"></i>
              <span class="menu-title fw-medium">Experience</span>
            </a>
          </li>

          <li class="nav-item {{ Request::is('dashboard/education*') ? 'active' : '' }}">
            <a class="nav-link d-flex align-items-center" href="{{ route('education.index') }}">
              <i class="mdi mdi-school menu-icon me-3 fs-5"></i>
              <span class="menu-title fw-medium">Education</span>
            </a>
          </li>

          <li class="nav-item {{ Request::is('dashboard/project*') ? 'active' : '' }}">
            <a class="nav-link d-flex align-items-center" href="{{ route('project.index') }}">
              <i class="mdi mdi-code-tags menu-icon me-3 fs-5"></i>
              <span class="menu-title fw-medium">Project</span>
            </a>
          </li>

          <li class="nav-item {{ Request::is('dashboard/skills*') ? 'active' : '' }}">
            <a class="nav-link d-flex align-items-center" href="{{ route('skill.index') }}">
              <i class="mdi mdi-lightbulb-on-outline menu-icon me-3 fs-5"></i>
              <span class="menu-title fw-medium">Skills</span>
            </a>
          </li>

          <li class="nav-item {{ Request::is('dashboard/interest*') ? 'active' : '' }}">
            <a class="nav-link d-flex align-items-center" href="{{ route('interest.index') }}">
              <i class="mdi mdi-heart-pulse menu-icon me-3 fs-5"></i>
              <span class="menu-title fw-medium">Interest</span>
            </a>
          </li>

          <li class="nav-item {{ Request::is('dashboard/certification*') ? 'active' : '' }}">
            <a class="nav-link d-flex align-items-center" href="{{ route('certification.index') }}">
              <i class="mdi mdi-certificate menu-icon me-3 fs-5"></i>
              <span class="menu-title fw-medium">Certification</span>
            </a>
          </li>

          <li class="nav-item {{ Request::is('dashboard/profile*') ? 'active' : '' }}">
            <a class="nav-link d-flex align-items-center" href="{{ route('profile.index') }}">
              <i class="mdi mdi-account menu-icon me-3 fs-5"></i>
              <span class="menu-title fw-medium">Profile Setting</span>
            </a>
          </li>

          <li class="nav-item {{ Request::is('dashboard/pengaturanhalaman*') ? 'active' : '' }}">
            <a class="nav-link d-flex align-items-center" href="{{ route('pengaturanhalaman.index') }}">
              <i class="mdi mdi-file-document-box menu-icon me-3 fs-5"></i>
              <span class="menu-title fw-medium">Page Setting</span>
            </a>
          </li>

        </ul>
      </nav>
      
      <div class="main-panel">
        <div class="content-wrapper">
          <div class="row">
            <div class="col-md-12 stretch-card">
              <div class="card main-card-wrapper">
                <div class="card-body p-4 p-md-5">
                  @yield('konten')
                </div>
              </div>
            </div>
          </div>
        </div>
        
        <footer class="footer">
          <div class="d-sm-flex justify-content-center justify-content-sm-between">
            <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright © Porto Web {{ date('Y') }}</span>
            <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center text-muted small">Handcrafted with <i class="mdi mdi-heart text-danger"></i></span>
          </div>
        </footer>
      </div>
    </div>
  </div>

  <script src="{{ asset('admin') }}/vendors/base/vendor.bundle.base.js"></script>
  <script src="{{ asset('admin') }}/vendors/chart.js/Chart.min.js"></script>
  <script src="{{ asset('admin') }}/vendors/datatables.net/jquery.dataTables.js"></script>
  <script src="{{ asset('admin') }}/vendors/datatables.net-bs4/dataTables.bootstrap4.js"></script>
  <script src="{{ asset('admin') }}/js/off-canvas.js"></script>
  <script src="{{ asset('admin') }}/js/hoverable-collapse.js"></script>
  <script src="{{ asset('admin') }}/js/template.js"></script>
  <script src="{{ asset('admin') }}/js/dashboard.js"></script>
  <script src="{{ asset('admin') }}/js/data-table.js"></script>
  <script src="{{ asset('admin') }}/js/jquery.dataTables.js"></script>
  <script src="{{ asset('admin') }}/js/dataTables.bootstrap4.js"></script>
  <script src="{{ asset('admin') }}/js/jquery.cookie.js" type="text/javascript"></script>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote-bs5.min.js"></script>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tokenfield/0.12.0/bootstrap-tokenfield.js"></script>

  <script>
    $(document).ready(function() {
        $('.summernote').summernote({
          height: 250,
          toolbar: [
            ['style', ['style']],
            ['font', ['bold', ['underline', 'clear']]],
            ['color', ['color']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['table', ['table']],
            ['insert', ['link', 'picture']],
            ['view', ['fullscreen', 'codeview', 'help']]
          ]
        });
    }); 
  </script>
  <script>
    $(document).ready(function() {
      // PERBAIKAN: Menggunakan satu blok inisialisasi .skill asli bawaan Anda, 
      // namun ditambahkan pengaman ?? '' agar tidak memicu error di halaman lain.
      $('.skill').tokenfield({
        autocomplete: {
          source: [{!! $skill ?? '' !!}],
          delay: 100
        },
        showAutocompleteOnFocus: true
      });
    });
  </script>
</body>
</html>