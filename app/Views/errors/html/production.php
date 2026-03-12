<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="noindex">
    <title>Something went wrong | Alphawonders</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #f8f9fa;
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
            color: #333;
        }
        .container {
            text-align: center;
            max-width: 520px;
            padding: 2rem;
        }
        .icon {
            font-size: 3.5rem;
            margin-bottom: 1.5rem;
            opacity: 0.6;
        }
        h1 {
            font-size: 1.75rem;
            font-weight: 600;
            margin-bottom: 0.75rem;
            color: #1a1a2e;
        }
        p {
            font-size: 1rem;
            color: #666;
            line-height: 1.6;
            margin-bottom: 2rem;
        }
        .actions {
            display: flex;
            gap: 1rem;
            justify-content: center;
            flex-wrap: wrap;
        }
        a {
            display: inline-block;
            padding: 0.625rem 1.5rem;
            border-radius: 0.375rem;
            text-decoration: none;
            font-size: 0.9rem;
            font-weight: 500;
            transition: opacity 0.2s;
        }
        a:hover { opacity: 0.85; }
        .btn-primary {
            background: #1a1a2e;
            color: #fff;
        }
        .btn-secondary {
            background: #e9ecef;
            color: #333;
        }
        .footer {
            margin-top: 3rem;
            font-size: 0.8rem;
            color: #aaa;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="icon">&#9888;</div>
        <h1>Something went wrong</h1>
        <p>We're sorry, but something unexpected happened. Our team has been notified. Please try again in a moment.</p>
        <div class="actions">
            <a href="/" class="btn-primary">Go to Homepage</a>
            <a href="javascript:history.back()" class="btn-secondary">Go Back</a>
        </div>
        <div class="footer">&copy; <?= date('Y'); ?> Alphawonders Solutions</div>
    </div>
</body>
</html>
