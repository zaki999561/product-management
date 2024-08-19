<!-- resources/views/layouts/app.blade.php -->

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>@yield('title', '受注管理システム')</title>
</head>
<body>
    <div class="container">
        <header>
            <h1 style="font-size:1.25rem;">受注管理システム</h1>
        </header>

        <main>
            @yield('content')
        </main>

        
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
