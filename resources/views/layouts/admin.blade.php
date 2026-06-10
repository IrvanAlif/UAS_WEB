<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Panel') - TechNews</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        *,
        *::before,
        *::after {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        :root {
            --primary: #2563eb;
            --primary-dark: #1d4ed8;
            --sidebar-bg: #fff;
            --sidebar-w: 240px;
            --text: #111827;
            --text-muted: #6b7280;
            --border: #e5e7eb;
            --bg: #f9fafb;
            --radius: 8px;
            --shadow: 0 1px 3px rgba(0, 0, 0, .1);
        }

        body {
            font-family: 'Inter', sans-serif;
            background: var(--bg);
            color: var(--text);
            display: flex;
            min-height: 100vh;
        }

        /* Sidebar */
        .sidebar {
            width: var(--sidebar-w);
            background: var(--sidebar-bg);
            border-right: 1px solid var(--border);
            display: flex;
            flex-direction: column;
            position: fixed;
            top: 0;
            left: 0;
            height: 100vh;
            z-index: 50;
        }

        .sidebar-header {
            padding: 24px 20px;
            border-bottom: 1px solid var(--border);
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .sidebar-logo {
            width: 36px;
            height: 36px;
            background: var(--primary);
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 16px;
            font-weight: 800;
        }

        .sidebar-title {
            font-size: 15px;
            font-weight: 700;
        }

        .sidebar-subtitle {
            font-size: 12px;
            color: var(--text-muted);
        }

        .sidebar-nav {
            flex: 1;
            padding: 16px 12px;
        }

        .sidebar-nav a {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 10px 12px;
            border-radius: var(--radius);
            font-size: 14px;
            font-weight: 500;
            color: var(--text-muted);
            transition: all .15s;
            margin-bottom: 4px;
        }

        .sidebar-nav a:hover,
        .sidebar-nav a.active {
            background: #eff6ff;
            color: var(--primary);
        }

        .sidebar-nav a i {
            width: 18px;
            text-align: center;
        }

        .sidebar-footer {
            padding: 16px 12px;
            border-top: 1px solid var(--border);
        }

        .sidebar-user {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 10px 12px;
            margin-bottom: 8px;
        }

        .user-avatar {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background: var(--primary);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 700;
            font-size: 14px;
            flex-shrink: 0;
        }

        .user-name {
            font-size: 13px;
            font-weight: 600;
        }

        .user-role {
            font-size: 11px;
            color: var(--text-muted);
            text-transform: uppercase;
            letter-spacing: .5px;
        }

        .sidebar-footer a {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 10px 12px;
            border-radius: var(--radius);
            font-size: 14px;
            font-weight: 500;
            color: var(--text-muted);
            transition: all .15s;
            margin-bottom: 2px;
        }

        .sidebar-footer a:hover {
            color: var(--text);
            background: var(--bg);
        }

        .logout-link {
            color: #dc2626 !important;
        }

        .logout-link:hover {
            background: #fee2e2 !important;
        }

        /* Main content */
        .main {
            margin-left: var(--sidebar-w);
            flex: 1;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        .topbar {
            background: var(--sidebar-bg);
            border-bottom: 1px solid var(--border);
            padding: 0 32px;
            height: 64px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: sticky;
            top: 0;
            z-index: 40;
        }

        .topbar-title {
            font-size: 22px;
            font-weight: 700;
        }

        .topbar-right {
            display: flex;
            align-items: center;
            gap: 16px;
        }

        .topbar-search {
            padding: 8px 16px;
            border: 1px solid var(--border);
            border-radius: 20px;
            font-size: 14px;
            outline: none;
            width: 220px;
            font-family: inherit;
        }

        .topbar-search:focus {
            border-color: var(--primary);
        }

        .content {
            padding: 32px;
            flex: 1;
        }

        .btn-new {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: var(--primary);
            color: white;
            padding: 10px 20px;
            border-radius: var(--radius);
            font-size: 14px;
            font-weight: 600;
            border: none;
            cursor: pointer;
            transition: background .2s;
            font-family: inherit;
            text-decoration: none;
        }

        .btn-new:hover {
            background: var(--primary-dark);
        }

        /* Cards */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 24px;
            margin-bottom: 32px;
        }

        .stat-card {
            background: var(--sidebar-bg);
            border: 1px solid var(--border);
            border-radius: 12px;
            padding: 24px;
            display: flex;
            align-items: center;
            gap: 16px;
        }

        .stat-icon {
            width: 52px;
            height: 52px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 22px;
        }

        .stat-label {
            font-size: 11px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: .5px;
            color: var(--text-muted);
        }

        .stat-value {
            font-size: 32px;
            font-weight: 800;
            line-height: 1;
            margin-top: 4px;
        }

        .stat-badge {
            font-size: 11px;
            font-weight: 600;
            padding: 2px 8px;
            border-radius: 12px;
            display: inline-block;
            margin-top: 6px;
        }

        /* Table */
        .table-card {
            background: var(--sidebar-bg);
            border: 1px solid var(--border);
            border-radius: 12px;
            overflow: hidden;
        }

        .table-card-header {
            padding: 20px 24px;
            border-bottom: 1px solid var(--border);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .table-card-title {
            font-size: 16px;
            font-weight: 700;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th {
            text-align: left;
            padding: 12px 24px;
            font-size: 11px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: .5px;
            color: var(--text-muted);
            background: var(--bg);
            border-bottom: 1px solid var(--border);
        }

        td {
            padding: 16px 24px;
            border-bottom: 1px solid var(--border);
            font-size: 14px;
            vertical-align: middle;
        }

        tr:last-child td {
            border-bottom: none;
        }

        tr:hover td {
            background: #f9fafb;
        }

        .badge {
            display: inline-block;
            padding: 3px 10px;
            border-radius: 12px;
            font-size: 12px;
            font-weight: 500;
        }

        .action-btns {
            display: flex;
            gap: 8px;
        }

        .btn-edit,
        .btn-delete {
            width: 32px;
            height: 32px;
            border-radius: 6px;
            border: none;
            cursor: pointer;
            font-size: 13px;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all .15s;
        }

        .btn-edit {
            background: #dbeafe;
            color: #2563eb;
        }

        .btn-edit:hover {
            background: #bfdbfe;
        }

        .btn-delete {
            background: #fee2e2;
            color: #dc2626;
        }

        .btn-delete:hover {
            background: #fecaca;
        }

        /* Forms */
        .form-card {
            background: var(--sidebar-bg);
            border: 1px solid var(--border);
            border-radius: 12px;
            padding: 32px;
            max-width: 760px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-label {
            display: block;
            font-size: 13px;
            font-weight: 600;
            color: #374151;
            margin-bottom: 6px;
        }

        .form-control {
            width: 100%;
            padding: 10px 14px;
            border: 1.5px solid var(--border);
            border-radius: 8px;
            font-size: 14px;
            outline: none;
            transition: border-color .2s;
            font-family: inherit;
        }

        .form-control:focus {
            border-color: var(--primary);
        }

        textarea.form-control {
            resize: vertical;
            min-height: 200px;
        }

        .form-hint {
            font-size: 12px;
            color: var(--text-muted);
            margin-top: 4px;
        }

        .form-actions {
            display: flex;
            gap: 12px;
            margin-top: 28px;
        }

        .btn-primary {
            padding: 10px 24px;
            background: var(--primary);
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            font-family: inherit;
            transition: background .2s;
        }

        .btn-primary:hover {
            background: var(--primary-dark);
        }

        .btn-secondary {
            padding: 10px 24px;
            background: white;
            color: var(--text);
            border: 1.5px solid var(--border);
            border-radius: 8px;
            font-size: 14px;
            font-weight: 500;
            cursor: pointer;
            font-family: inherit;
            transition: all .2s;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
        }

        .btn-secondary:hover {
            border-color: var(--primary);
            color: var(--primary);
        }

        .invalid-feedback {
            font-size: 12px;
            color: #dc2626;
            margin-top: 4px;
        }

        .is-invalid {
            border-color: #dc2626 !important;
        }

        /* Alert */
        .alert {
            padding: 12px 16px;
            border-radius: 8px;
            margin-bottom: 20px;
            font-size: 14px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .alert-success {
            background: #d1fae5;
            color: #065f46;
            border: 1px solid #a7f3d0;
        }

        .alert-danger {
            background: #fee2e2;
            color: #991b1b;
            border: 1px solid #fecaca;
        }

        /* Pagination */
        .pagination {
            display: flex;
            gap: 4px;
            margin-top: 20px;
            justify-content: flex-end;
        }

        .pagination a,
        .pagination span {
            padding: 6px 12px;
            border: 1px solid var(--border);
            border-radius: 6px;
            font-size: 13px;
            color: var(--text-muted);
        }

        .pagination a:hover {
            background: var(--bg);
        }

        .pagination .active span {
            background: var(--primary);
            color: white;
            border-color: var(--primary);
        }

        /* Footer */
        .admin-footer {
            border-top: 1px solid var(--border);
            padding: 20px 32px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 12px;
            color: var(--text-muted);
            background: var(--sidebar-bg);
        }

        /* Image preview */
        .img-preview {
            max-width: 200px;
            max-height: 150px;
            border-radius: 8px;
            margin-top: 8px;
            display: none;
            border: 1px solid var(--border);
        }
    </style>
    @stack('styles')
</head>

<body>

    <aside class="sidebar">
        <div class="sidebar-header">
            <div class="sidebar-logo">T</div>
            <div>
                <div class="sidebar-title">Admin Panel</div>
                <div class="sidebar-subtitle">TechNews Editorial</div>
            </div>
        </div>
        <nav class="sidebar-nav">
            <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <i class="fas fa-chart-bar"></i> Dashboard
            </a>
            <a href="{{ route('admin.articles.index') }}" class="{{ request()->routeIs('admin.articles*') ? 'active' : '' }}">
                <i class="fas fa-newspaper"></i> Kelola Artikel
            </a>
            <a href="{{ route('admin.categories.index') }}" class="{{ request()->routeIs('admin.categories*') ? 'active' : '' }}">
                <i class="fas fa-tags"></i> Kelola Kategori
            </a>
        </nav>
        <div class="sidebar-footer">
            <div class="sidebar-user">
                <div class="user-avatar">{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}</div>
                <div>
                    <div class="user-name">{{ Auth::user()->name }}</div>
                    <div class="user-role">Verified Admin</div>
                </div>
            </div>
            <a href="{{ route('home') }}" target="_blank">
                <i class="fas fa-external-link-alt"></i> Lihat Website
            </a>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="logout-link" style="width:100%; background:none; border:none; cursor:pointer; text-align:left; font-family:inherit; display:flex; align-items:center; gap:10px; padding:10px 12px; border-radius:8px; font-size:14px; font-weight:500; color:#dc2626;">
                    <i class="fas fa-sign-out-alt"></i> Logout
                </button>
            </form>
        </div>
    </aside>

    <div class="main">
        <div class="topbar">
            <h1 class="topbar-title">@yield('page-title', 'Dashboard')</h1>
            <div class="topbar-right">
                <form action="{{ route('admin.articles.index') }}" method="GET" style="display:flex;">
                    <input type="text" name="search" class="topbar-search"
                        placeholder="Cari artikel..."
                        value="{{ request('search') }}">
                </form>
                @yield('topbar-action')
            </div>
        </div>

        <div class="content">
            @if(session('success'))
            <div class="alert alert-success">
                <i class="fas fa-check-circle"></i> {{ session('success') }}
            </div>
            @endif
            @if(session('error'))
            <div class="alert alert-danger">
                <i class="fas fa-exclamation-circle"></i> {{ session('error') }}
            </div>
            @endif

            @yield('content')
        </div>

        <footer class="admin-footer">
            <span>TechNews Admin</span>
            <span>© {{ date('Y') }} TechNews Platform. All rights reserved.</span>
        </footer>
    </div>

    @stack('scripts')
</body>

</html>