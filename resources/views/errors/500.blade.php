<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Server Error - TechNews</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        *,
        *::before,
        *::after {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: #f9fafb;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 24px;
            color: #111827;
        }

        .brand {
            font-size: 22px;
            font-weight: 800;
            color: #2563eb;
            margin-bottom: 48px;
            letter-spacing: -0.5px;
            text-decoration: none;
        }

        .error-box {
            text-align: center;
            max-width: 480px;
        }

        .error-code {
            font-size: 120px;
            font-weight: 800;
            line-height: 1;
            color: #e5e7eb;
            letter-spacing: -4px;
            margin-bottom: 16px;
        }

        .error-title {
            font-size: 24px;
            font-weight: 700;
            color: #111827;
            margin-bottom: 12px;
        }

        .error-desc {
            font-size: 15px;
            color: #6b7280;
            line-height: 1.6;
            margin-bottom: 32px;
        }

        .btn-primary {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: #2563eb;
            color: white;
            padding: 10px 24px;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 600;
            transition: background .2s;
            text-decoration: none;
        }

        .btn-primary:hover {
            background: #1d4ed8;
        }

        .divider {
            width: 60px;
            height: 4px;
            border-radius: 2px;
            background: #dc2626;
            margin: 0 auto 32px;
        }
    </style>
</head>

<body>
    <a href="/" class="brand">TechNews</a>

    <div class="error-box">
        <div class="error-code">500</div>
        <div class="divider"></div>
        <h1 class="error-title">Terjadi Kesalahan Server</h1>
        <p class="error-desc">
            Maaf, terjadi kesalahan pada server kami. Tim kami sudah diberitahu.
            Silakan coba beberapa saat lagi.
        </p>
        <a href="/" class="btn-primary">
            <i class="fas fa-home"></i> Kembali ke Beranda
        </a>
    </div>
</body>

</html>