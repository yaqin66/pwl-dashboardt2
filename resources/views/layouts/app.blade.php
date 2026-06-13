<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', config('app.name', 'Laravel'))</title>

    <!-- Google Font: Inter -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">
    
    <style>
        /* Modern Custom CSS Override */
        body {
            font-family: 'Inter', sans-serif !important;
            background-color: #f8fafc;
        }
        .content-wrapper {
            background-color: #f8fafc !important;
        }
        
        /* Navbar */
        .main-header {
            border-bottom: none !important;
            box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1), 0 1px 2px 0 rgba(0, 0, 0, 0.06) !important;
            background-color: #ffffff !important;
        }

        /* Sidebar */
        .main-sidebar {
            background-color: #0f172a !important;
            box-shadow: 4px 0 10px rgba(0, 0, 0, 0.05) !important;
        }
        .brand-link {
            border-bottom: 1px solid rgba(255,255,255,0.05) !important;
            color: #f8fafc !important;
            font-weight: 600 !important;
        }
        .sidebar .user-panel {
            border-bottom: 1px solid rgba(255,255,255,0.05) !important;
        }
        .sidebar .nav-sidebar > .nav-item {
            margin-bottom: 4px;
        }
        .sidebar .nav-sidebar .nav-link {
            border-radius: 8px !important;
            margin: 0 8px;
            color: #94a3b8 !important;
            transition: all 0.2s ease;
        }
        .sidebar .nav-sidebar .nav-link:hover {
            background-color: rgba(255,255,255,0.05) !important;
            color: #f8fafc !important;
        }
        .sidebar .nav-sidebar .nav-link.active {
            background-color: #4f46e5 !important;
            color: #ffffff !important;
            box-shadow: 0 4px 6px -1px rgba(79, 70, 229, 0.4) !important;
        }
        .nav-treeview > .nav-item > .nav-link {
            padding-left: 2rem !important;
        }

        /* Cards */
        .card {
            border-radius: 12px !important;
            border: none !important;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05), 0 2px 4px -1px rgba(0, 0, 0, 0.03) !important;
            transition: box-shadow 0.3s ease;
        }
        .card:hover {
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.05), 0 4px 6px -2px rgba(0, 0, 0, 0.02) !important;
        }
        .card-header {
            background-color: transparent !important;
            border-bottom: 1px solid #f1f5f9 !important;
            padding: 1.25rem 1.5rem !important;
        }
        .card-title {
            font-weight: 600 !important;
            color: #1e293b !important;
        }
        
        /* Info Boxes */
        .info-box {
            border-radius: 12px !important;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05), 0 2px 4px -1px rgba(0, 0, 0, 0.03) !important;
            border: none !important;
            padding: 1rem !important;
            transition: transform 0.2s ease;
        }
        .info-box:hover {
            transform: translateY(-2px);
        }
        .info-box .info-box-icon {
            border-radius: 10px !important;
            width: 60px !important;
            height: 60px !important;
            font-size: 1.5rem !important;
        }
        .info-box-text {
            color: #64748b !important;
            font-weight: 500 !important;
            text-transform: capitalize !important;
            letter-spacing: 0.5px;
        }
        .info-box-number {
            color: #1e293b !important;
            font-size: 1.5rem !important;
            font-weight: 700 !important;
        }
        
        /* Tables */
        .table th {
            border-top: none !important;
            border-bottom: 2px solid #f1f5f9 !important;
            color: #64748b !important;
            font-weight: 600 !important;
            text-transform: uppercase;
            font-size: 0.75rem;
            letter-spacing: 0.05em;
        }
        .table td {
            vertical-align: middle !important;
            color: #334155;
            border-color: #f1f5f9 !important;
        }
        
        /* Buttons */
        .btn {
            border-radius: 8px !important;
            font-weight: 500 !important;
            padding: 0.375rem 1rem;
        }
        .btn-sm, .btn-xs {
            padding: 0.25rem 0.5rem !important;
        }
        .btn-primary {
            background-color: #4f46e5 !important;
            border-color: #4f46e5 !important;
            box-shadow: 0 2px 4px rgba(79, 70, 229, 0.3);
        }
        .btn-primary:hover {
            background-color: #4338ca !important;
            border-color: #4338ca !important;
            transform: translateY(-1px);
        }
        .badge {
            padding: 0.35em 0.65em;
            border-radius: 6px;
            font-weight: 500;
        }
        
        /* Header Title */
        .content-header h1 {
            font-weight: 700;
            color: #0f172a;
            font-size: 1.5rem;
        }
    </style>

    @stack('styles')
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

    <!-- Navbar -->
    @include('layouts.partials.navbar')
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    @include('layouts.partials.sidebar')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>@yield('page-title')</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            @yield('breadcrumb')
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                @yield('content')
            </div>
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    @include('layouts.partials.footer')

</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>

@stack('scripts')
</body>
</html>
