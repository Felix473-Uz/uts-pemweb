<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: #D6C7AE; /* Krem lembut sebagai latar belakang */
            color: #2E2E2E; /* Abu-abu tua untuk teks */
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }
        .container {
            max-width: 700px;
            background: #2E2E2E; /* Abu-abu tua untuk kontainer */
            border-radius: 15px;
            padding: 30px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
        }
        h1 {
            font-weight: 600;
            color: #F5EFE6; /* Kuning mustard untuk judul */
            text-align: center;
            margin-bottom: 20px;
        }
        .alert {
            border-radius: 10px;
            background: #F5F5DC; /* Krem lembut untuk alert */
            border: 1px solid #355E3B; /* Border hijau hutan */
            color: #2E2E2E;
        }
        .alert-success strong {
            color: #0f74e7; /* Kuning mustard untuk teks penting */
        }
        .form-control, .form-check-input {
            background: #F5F5DC; /* Krem lembut untuk input */
            border: 1px solid #2E2E2E; /* Border abu-abu tua */
            color: #2E2E2E;
            border-radius: 8px;
            transition: all 0.3s ease;
        }
        .form-control:focus {
            background: #F5F5DC;
            border-color: #D4A017; /* Kuning mustard saat fokus */
            box-shadow: 0 0 10px rgba(212, 160, 23, 0.3);
            color: #2E2E2E;
        }
        .form-label {
            color: #F5EFE6; /* Kuning mustard untuk label */
            font-weight: 400;
        }
        .form-check-label {
            color: #F5F5DC; /* Krem lembut untuk label radio */
            margin-left: 10px;
        }
        .btn-primary {
            background: #355E3B; /* Hijau hutan untuk tombol utama */
            border: none;
            color: #F5F5DC; /* Krem lembut untuk teks */
            font-weight: 600;
            padding: 10px 20px;
            border-radius: 8px;
            transition: all 0.3s ease;
        }
        .btn-primary:hover {
            background: #2a4b30; /* Sedikit lebih gelap saat hover */
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(53, 94, 59, 0.4);
        }
        .btn-primary:disabled {
            background: #1f3624;
            cursor: not-allowed;
        }
        .btn-secondary {
            background: #F5F5DC; /* Krem lembut untuk tombol sekunder */
            border: 1px solid #2E2E2E; /* Border abu-abu tua */
            color: #2E2E2E;
            font-weight: 600;
            padding: 10px 20px;
            border-radius: 8px;
            transition: all 0.3s ease;
        }
        .btn-secondary:hover {
            background: #e8e8c8; /* Sedikit lebih gelap saat hover */
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(46, 46, 46, 0.2);
        }
        .btn-outline-dark {
            color: #2E2E2E;
            border-color: #2E2E2E;
        }
        .btn-outline-dark:hover {
            background: #D4A017;
            color: #2E2E2E;
        }
        .text-danger {
            color: #e57373 !important; /* Merah lembut untuk error */
        }
        textarea.form-control {
            resize: vertical;
            min-height: 100px;
        }
        @media (max-width: 576px) {
            .container {
                padding: 20px;
            }
            h1 {
                font-size: 1.8rem;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>{{ $title }}</h1>

        <!-- Menampilkan pesan error atau hasil -->
        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        @if (session('result'))
            <div class="alert alert-success">
                <strong>Hasil {{ session('result.action') === 'encrypt' ? 'Enkripsi' : 'Dekripsi' }}:</strong><br>
                <p><strong>Input:</strong> {{ session('result.text') }}</p>
                <p><strong>Output:</strong> {{ session('result.output') }}
                    <button type="button" class="btn btn-sm btn-outline-dark ms-2" onclick="navigator.clipboard.writeText('{{ session('result.output') }}').then(() => alert('Hasil disalin ke clipboard!'))">Salin</button>
                </p>
            </div>
        @endif

        <!-- Formulir untuk enkripsi/dekripsi -->
        <form action="{{ route('penyewa.process_encryption') }}" method="POST" class="mt-4" id="encryptionForm">
            @csrf
            <div class="mb-3">
                <label for="text" class="form-label">Masukkan Teks</label>
                <textarea class="form-control" id="text" name="text" rows="4" required></textarea>
                @error('text')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Aksi</label><br>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="action" id="encrypt" value="encrypt" checked>
                    <label class="form-check-label" for="encrypt">Enkripsi</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="action" id="decrypt" value="decrypt">
                    <label class="form-check-label" for="decrypt">Dekripsi</label>
                </div>
                @error('action')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="d-flex justify-content-between">
                <button type="submit" class="btn btn-primary" id="processBtn">
                    <span class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
                    <i class="bi bi-lock-fill me-2"></i>Proses
                </button>
                <a href="{{ route('penyewa.penyewa') }}" class="btn btn-secondary">Kembali ke Profil</a>
            </div>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.getElementById('encryptionForm').addEventListener('submit', function() {
            const btn = document.getElementById('processBtn');
            btn.querySelector('.spinner-border').classList.remove('d-none');
            btn.disabled = true;
            btn.querySelector('i').classList.add('d-none'); // Sembunyikan ikon saat loading
        });
    </script>
</body>
</html>