<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="No-Index, No-Follow">
    <title>Login | Alphawonders</title>
    <link rel="icon" type="image/png" href="<?= base_url('/assets/icon/awlogo.png'); ?>">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #1a1a2e 0%, #16213e 50%, #0f3460 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .login-card {
            max-width: 420px;
            width: 100%;
            border: none;
            border-radius: 12px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.3);
        }
        .login-card .card-body {
            padding: 2.5rem;
        }
        .login-logo {
            width: 60px;
            height: 60px;
        }
        .btn-login {
            background: #0f3460;
            border-color: #0f3460;
            padding: 0.6rem;
            font-size: 1.05rem;
        }
        .btn-login:hover {
            background: #1a1a2e;
            border-color: #1a1a2e;
        }
    </style>
</head>
<body>
    <div class="card login-card">
        <div class="card-body">
            <div class="text-center mb-4">
                <img src="<?= base_url('/assets/icon/awlogo.png'); ?>" alt="Alphawonders" class="login-logo mb-3">
                <h4 class="fw-bold">Alphawonders</h4>
                <p class="text-muted">Sign in to your dashboard</p>
            </div>

            <?php if (session()->getFlashdata('error')): ?>
                <div class="alert alert-danger py-2"><?= session()->getFlashdata('error'); ?></div>
            <?php endif; ?>

            <form method="post" action="<?= base_url('aw-cp/login'); ?>">
                <?= csrf_field() ?>
                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" class="form-control" id="username" name="username" required autofocus>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>
                <div class="d-grid mt-4">
                    <button type="submit" class="btn btn-primary btn-login text-white">Sign In</button>
                </div>
            </form>

            <div class="text-center mt-4">
                <a href="<?= base_url('/'); ?>" class="text-muted small">Back to website</a>
            </div>
        </div>
    </div>
</body>
</html>
