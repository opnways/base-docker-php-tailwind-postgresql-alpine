<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mi Aplicación MVC</title>
    <link href="/dist/main.css" rel="stylesheet">
    <script src="/dist/alpine.min.js" defer></script>
</head>
<body class="bg-gray-100 text-gray-800" x-data>
    <div class="container mx-auto py-8">
        <?= $content ?>
    </div>
</body>
</html>