<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - SSRI</title>
    <link rel="stylesheet" href="login.css">
</head>
<body>
    <div class="bg-particles">
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
    </div>

    <div class="login-container">
        <div class="logo-section">
            <img src="logo/logo.png" alt="Logo Nexus Business" class="logo">
            <h1 class="company-name">LUMORA Ltd.</h1>
            <p class="company-tagline">Professional Solutions</p>
        </div>

        <!-- Form login dengan method & action -->
        <form id="loginForm" method="POST" action="proses_login.php">
            <div class="form-group">
                <label autocomplete="off" class="form-label" for="username">Username</label>
                <input 
                    type="text" 
                    id="username" 
                    name="username" 
                    class="form-input" 
                    placeholder="Masukkan username Anda"
                    required
                >
            </div>

            <div class="form-group">
                <label autocomplete="off" class="form-label" for="password">Password</label>
                <input 
                    type="password" 
                    id="password" 
                    name="password" 
                    class="form-input" 
                    placeholder="Masukkan password Anda"
                    required
                >
            </div>

            <button type="submit" class="login-button">
                Masuk
            </button>
        </form>

        <div class="form-footer">
            <a href="#" class="forgot-password">Lupa Password?</a>
        </div>
    </div>
</body>
</html>
