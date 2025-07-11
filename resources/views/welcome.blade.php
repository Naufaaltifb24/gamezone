<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>GameZone - Welcome</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@600&display=swap" rel="stylesheet" />
  <style>
    body {
      font-family: 'Orbitron', sans-serif;
    }
  </style>
</head>
<body class="d-flex align-items-center justify-content-center vh-100 text-center">

  <div class="p-5 rounded bg-body-secondary text-body">
    <h1 class="display-4 text-success mb-4">🎮 GameZone</h1>
    <div class="d-grid gap-2 d-sm-flex justify-content-sm-center">
      <a href="{{ route('login') }}" class="btn btn-outline-dark px-4">Login</a>
      <a href="{{ route('register') }}" class="btn btn-outline-primary px-4">Register</a>
    </div>
    <button class="btn btn-link mt-4" onclick="toggleTheme()">🌓 Toggle Theme</button>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

  <script>
    // Atur tema saat halaman dimuat
    document.addEventListener('DOMContentLoaded', () => {
        const savedTheme = localStorage.getItem('theme') || 'dark';
        document.documentElement.setAttribute('data-bs-theme', savedTheme);
    });

    // Tombol toggle tema
    function toggleTheme() {
        const html = document.documentElement;
        const currentTheme = html.getAttribute('data-bs-theme');
        const newTheme = currentTheme === 'dark' ? 'light' : 'dark';
        html.setAttribute('data-bs-theme', newTheme);
        localStorage.setItem('theme', newTheme);
    }
  </script>
</body>
</html>
