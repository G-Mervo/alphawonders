<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="No-Index, No-Follow">
    <meta name="author" content="alphawonders">

    <link rel="icon" type="image/png" href="<?= base_url('/assets/icon/awlogo.png'); ?>">
    <title><?= esc($title); ?></title>

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome 6 -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">

    <style>
        :root {
            --sidebar-width: 250px;
            --sidebar-bg: #1a1a2e;
            --sidebar-hover: #16213e;
            --sidebar-active: #0f3460;
            --topbar-height: 56px;
        }
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f4f6f9;
        }

        /* Sidebar */
        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            width: var(--sidebar-width);
            height: 100vh;
            background: var(--sidebar-bg);
            color: #c2c7d0;
            z-index: 1040;
            transition: transform 0.3s;
            overflow-y: auto;
        }
        .sidebar-brand {
            height: var(--topbar-height);
            display: flex;
            align-items: center;
            padding: 0 1rem;
            background: rgba(0,0,0,0.15);
        }
        .sidebar-brand img {
            width: 36px;
            height: 36px;
            margin-right: 10px;
        }
        .sidebar-brand span {
            font-size: 1.1rem;
            font-weight: 600;
            color: #fff;
        }
        .sidebar .nav-link {
            color: #c2c7d0;
            padding: 0.65rem 1rem;
            border-left: 3px solid transparent;
            font-size: 0.92rem;
        }
        .sidebar .nav-link:hover {
            background: var(--sidebar-hover);
            color: #fff;
        }
        .sidebar .nav-link.active {
            background: var(--sidebar-active);
            color: #fff;
            border-left-color: #e94560;
        }
        .sidebar .nav-link i {
            width: 22px;
            text-align: center;
            margin-right: 8px;
        }
        .sidebar .nav-section {
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            color: #6c757d;
            padding: 1rem 1rem 0.4rem;
        }

        /* Topbar */
        .topbar {
            position: fixed;
            top: 0;
            left: var(--sidebar-width);
            right: 0;
            height: var(--topbar-height);
            background: #fff;
            border-bottom: 1px solid #dee2e6;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 1.5rem;
            z-index: 1030;
        }

        /* Content */
        .main-content {
            margin-left: var(--sidebar-width);
            margin-top: var(--topbar-height);
            padding: 1.5rem;
            min-height: calc(100vh - var(--topbar-height));
        }

        /* Mobile */
        @media (max-width: 991.98px) {
            .sidebar {
                transform: translateX(-100%);
            }
            .sidebar.show {
                transform: translateX(0);
            }
            .topbar {
                left: 0;
            }
            .main-content {
                margin-left: 0;
            }
        }

        .sidebar-backdrop {
            display: none;
        }
        @media (max-width: 991.98px) {
            .sidebar-backdrop.show {
                display: block;
                position: fixed;
                inset: 0;
                background: rgba(0,0,0,0.4);
                z-index: 1035;
            }
        }
    </style>

    <!-- TinyMCE (only load on blog form pages) -->
    <script src="<?= base_url('assets/plugins/tinymce_5.0.13/js/tinymce/tinymce.min.js'); ?>"></script>
    <script>
        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', initTinyMCE);
        } else {
            initTinyMCE();
        }
        function initTinyMCE() {
            var el = document.getElementById('blogtxtarea');
            if (el) {
                tinymce.init({
                    selector: '#blogtxtarea',
                    height: 300,
                    plugins: [
                        'advlist autolink link image lists charmap preview hr anchor pagebreak',
                        'searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking',
                        'table directionality emoticons template paste'
                    ],
                    toolbar: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | preview media | forecolor backcolor emoticons',
                    automatic_uploads: true,
                    image_title: true,
                    file_picker_types: 'image',
                    file_picker_callback: function(cb, value, meta) {
                        var input = document.createElement('input');
                        input.setAttribute('type', 'file');
                        input.setAttribute('accept', 'image/*');
                        input.onchange = function() {
                            var file = this.files[0];
                            var reader = new FileReader();
                            reader.readAsDataURL(file);
                            reader.onload = function () {
                                var id = 'blobid' + (new Date()).getTime();
                                var blobCache = tinymce.activeEditor.editorUpload.blobCache;
                                var base64 = reader.result.split(',')[1];
                                var blobInfo = blobCache.create(id, file, base64);
                                blobCache.add(blobInfo);
                                cb(blobInfo.blobUri(), { title: file.name });
                            };
                        };
                        input.click();
                    }
                });
            }
        }
    </script>
</head>
<body>

<?php
    $currentUri = uri_string();
    $fullName = session()->get('fullName') ?? 'Admin';
    $username = session()->get('username') ?? 'admin';
?>

<!-- Sidebar Backdrop (mobile) -->
<div class="sidebar-backdrop" id="sidebarBackdrop" onclick="toggleSidebar()"></div>

<!-- Sidebar -->
<nav class="sidebar" id="sidebar">
    <div class="sidebar-brand">
        <img src="<?= base_url('/assets/icon/awlogo.png'); ?>" alt="AW">
        <span>Alphawonders</span>
    </div>
    <div class="nav-section">Main</div>
    <ul class="nav flex-column">
        <li class="nav-item">
            <a class="nav-link <?= ($currentUri === 'aw-cp' || $currentUri === '') ? 'active' : ''; ?>" href="<?= base_url('aw-cp'); ?>">
                <i class="fa-solid fa-gauge-high"></i> Dashboard
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link <?= str_starts_with($currentUri, 'aw-cp/blog') ? 'active' : ''; ?>" href="<?= base_url('aw-cp/blog'); ?>">
                <i class="fa-solid fa-newspaper"></i> Blog
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link <?= $currentUri === 'aw-cp/messages' ? 'active' : ''; ?>" href="<?= base_url('aw-cp/messages'); ?>">
                <i class="fa-solid fa-envelope"></i> Messages
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link <?= $currentUri === 'aw-cp/services' ? 'active' : ''; ?>" href="<?= base_url('aw-cp/services'); ?>">
                <i class="fa-solid fa-wrench"></i> Services
            </a>
        </li>
    </ul>
    <div class="nav-section">Analytics</div>
    <ul class="nav flex-column">
        <li class="nav-item">
            <a class="nav-link <?= $currentUri === 'aw-cp/users_analytics' ? 'active' : ''; ?>" href="<?= base_url('aw-cp/users_analytics'); ?>">
                <i class="fa-solid fa-users"></i> Users
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link <?= $currentUri === 'aw-cp/visits_analytics' ? 'active' : ''; ?>" href="<?= base_url('aw-cp/visits_analytics'); ?>">
                <i class="fa-solid fa-chart-line"></i> Visits
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link <?= $currentUri === 'aw-cp/interactions_analytics' ? 'active' : ''; ?>" href="<?= base_url('aw-cp/interactions_analytics'); ?>">
                <i class="fa-solid fa-chart-bar"></i> Interactions
            </a>
        </li>
    </ul>
    <div class="nav-section">System</div>
    <ul class="nav flex-column">
        <li class="nav-item">
            <a class="nav-link <?= $currentUri === 'aw-cp/products' ? 'active' : ''; ?>" href="<?= base_url('aw-cp/products'); ?>">
                <i class="fa-solid fa-box"></i> Products
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link <?= $currentUri === 'aw-cp/settings' ? 'active' : ''; ?>" href="<?= base_url('aw-cp/settings'); ?>">
                <i class="fa-solid fa-gear"></i> Settings
            </a>
        </li>
    </ul>
</nav>

<!-- Topbar -->
<div class="topbar">
    <button class="btn btn-link text-dark d-lg-none p-0 me-3" onclick="toggleSidebar()">
        <i class="fa-solid fa-bars fa-lg"></i>
    </button>
    <div class="d-none d-lg-block"></div>
    <div class="dropdown">
        <a class="btn btn-link text-dark text-decoration-none dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
            <i class="fa-solid fa-user-circle me-1"></i> <?= esc($fullName); ?>
        </a>
        <ul class="dropdown-menu dropdown-menu-end">
            <li><span class="dropdown-item-text text-muted small">Signed in as <?= esc($username); ?></span></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="<?= base_url('aw-cp/settings'); ?>"><i class="fa-solid fa-gear me-2"></i>Settings</a></li>
            <li><a class="dropdown-item" href="<?= base_url('/'); ?>" target="_blank"><i class="fa-solid fa-globe me-2"></i>View Site</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item text-danger" href="<?= base_url('aw-cp/logout'); ?>"><i class="fa-solid fa-right-from-bracket me-2"></i>Logout</a></li>
        </ul>
    </div>
</div>

<!-- Main Content -->
<div class="main-content">
