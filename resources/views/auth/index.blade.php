<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login - Porto Web Dewangga</title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>

    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: #ffffff;
            overflow-x: hidden;
        }
        
        .login-container {
            min-height: 100vh;
        }
        
        /* KANVAS VISUAL: Menggunakan Mesh Gradient CSS murni */
        .login-visual {
            background-color: #0f172a;
            background-image: 
                radial-gradient(at 0% 0%, hsla(253, 66%, 18%, 1) 0px, transparent 50%),
                radial-gradient(at 50% 0%, hsla(225, 75%, 20%, 1) 0px, transparent 50%),
                radial-gradient(at 100% 0%, hsla(190, 90%, 25%, 1) 0px, transparent 50%),
                radial-gradient(at 0% 100%, hsla(260, 80%, 20%, 1) 0px, transparent 50%),
                radial-gradient(at 100% 100%, hsla(180, 70%, 20%, 1) 0px, transparent 50%);
            position: relative;
            min-height: 30vh;
        }

        @media (min-width: 992px) {
            .login-visual {
                min-height: 100vh;
            }
        }
        
        /* SEKSI FORM LOGIN */
        .login-form-section {
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: #ffffff;
            min-height: 70vh;
        }

        @media (min-width: 992px) {
            .login-form-section {
                min-height: 100vh;
            }
        }

        .login-card {
            width: 100%;
            max-width: 400px;
            padding: 2rem;
        }

        /* TOMBOL GOOGLE INTERAKTIF */
        .btn-google {
            background-color: #ffffff;
            color: #374151;
            border: 1px solid #e5e7eb !important;
            padding: 12px 24px;
            font-weight: 600;
            border-radius: 12px;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            text-decoration: none;
        }
        
        .btn-google:hover {
            background-color: #f9fafb;
            color: #111827;
            border-color: #cbd5e1 !important;
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.05);
        }

        .btn-google:active {
            transform: translateY(0);
        }

        /* GRADASI TEXT LOGO */
        .brand-logo {
            font-weight: 800;
            letter-spacing: -0.5px;
            background: linear-gradient(45deg, #6366f1, #06b6d4);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        /* SPINNER ANIMASI LOADING */
        .spinner {
            display: none;
            width: 18px;
            height: 18px;
            border: 2px solid #4b5563;
            border-top-color: transparent;
            border-radius: 50%;
            animation: spin 0.75s linear infinite;
        }

        @keyframes spin {
            to { transform: rotate(360deg); }
        }

        /* Kustomisasi alert agar lebih serasi dengan UI */
        .alert {
            border-radius: 10px;
            font-size: 13px;
            font-weight: 500;
        }
    </style>
</head>
<body>

    <div class="container-fluid p-0">
        <div class="row g-0 login-container">
            
            <div class="col-12 col-lg-6 login-visual d-flex align-items-center justify-content-center p-5 text-white text-center text-lg-start">
                <div class="position-relative animate__animated animate__fadeInLeft" style="z-index: 2; max-width: 500px;">
                    <span class="badge bg-white bg-opacity-10 text-white mb-3 px-3 py-2 rounded-pill fs-7" style="backdrop-filter: blur(5px);">
                        Portofolio Digital
                    </span>
                    <h1 class="display-5 fw-bold mb-3 text-white">Kelola Kreativitas Tanpa Batas.</h1>
                    <p class="lead text-white-50 fs-6 m-0">Selamat datang di platform terintegrasi Porto Web. Tempat terbaik untuk mengamankan dan menampilkan mahakarya Anda.</p>
                </div>
            </div>

            <div class="col-12 col-lg-6 login-form-section p-4">
                <div class="login-card animate__animated animate__fadeInRight">
                    
                    <div class="d-inline-flex align-items-center justify-content-center rounded-3 mb-4" style="width: 48px; height: 48px; background-color: #f1f5f9;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="bi bi-person-badge text-primary" viewBox="0 0 16 16">
                            <path d="M6.5 2a.5.5 0 0 0 0 1h3a.5.5 0 0 0 0-1zM11 8a3 3 0 1 1-6 0 3 3 0 0 1 6 0"/>
                            <path d="M4.5 0A2.5 2.5 0 0 0 2 2.5V14a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V2.5A2.5 2.5 0 0 0 11.5 0zM3 2.5A1.5 1.5 0 0 1 4.5 1h7A1.5 1.5 0 0 1 13 2.5v12a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1z"/>
                        </svg>
                    </div>

                    <h1 class="h2 mb-2 brand-logo">Porto Web</h1>
                    <p class="text-muted mb-4" style="font-size: 14px;">Silakan masuk menggunakan akun Google Anda untuk mengakses sistem dashboard.</p>
                    
                    @if (Session::has('error'))
                        <div class="alert alert-danger alert-dismissible fade show mb-4" role="alert">
                            {{ Session::get('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    
                    <div class="d-grid">
                        <a href="{{ url('auth/redirect') }}" id="btnLogin" class="btn btn-google d-flex align-items-center justify-content-center gap-3">
                            <img id="googleLogo" width="18px" height="18px" alt="Google Logo" src="https://upload.wikimedia.org/wikipedia/commons/thumb/5/53/Google_%22G%22_Logo.svg/512px-Google_%22G%22_Logo.svg.png" />
                            <div id="btnSpinner" class="spinner"></div>
                            <span id="btnText">Masuk dengan Google</span>
                        </a>
                    </div>

                    <div class="mt-5 pt-4 border-top text-center text-lg-start">
                        <p class="text-muted m-0" style="font-size: 11px;">&copy; {{ date('Y') }} Dewangga. All rights reserved.</p>
                    </div>
                    
                </div>
            </div>

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>

    <script>
        document.getElementById('btnLogin').addEventListener('click', function(e) {
            const googleLogo = document.getElementById('googleLogo');
            const btnSpinner = document.getElementById('btnSpinner');
            const btnText = document.getElementById('btnText');

            googleLogo.style.display = 'none';
            btnSpinner.style.display = 'block';
            btnText.innerText = 'Menghubungkan akun...';
        });
    </script>
</body>
</html>