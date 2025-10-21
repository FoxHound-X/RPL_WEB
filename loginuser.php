<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gratify - Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: {
                            900: '#1E1B4B',
                            800: '#312E81',
                            700: '#3730A3'
                        }
                    }
                }
            }
        }
    </script>
    <link rel="stylesheet" href="styles.css">
</head>
<body class="bg-gradient-to-br from-primary-900 via-primary-800 to-primary-700 min-h-screen flex items-center justify-center p-4 overflow-hidden">
    
    <!-- Background Stars -->
    <div class="star star-1"></div>
    <div class="star star-2"></div>
    <div class="star star-3"></div>
    <div class="star star-4"></div>
    <div class="star star-5"></div>
    <div class="star star-6"></div>
    
    <!-- Main Login Container -->
    <div class="relative z-10 w-full max-w-md">
        <!-- Card Container -->
        <div class="bg-white/5 backdrop-blur-xl rounded-3xl p-8 shadow-2xl border border-white/10 max-w-md w-full mx-auto">
            
            <!-- Logo & Title -->
            <div class="text-center mb-8">
                <h1 class="text-4xl font-bold text-white tracking-tight mb-2">Gratify</h1>
                <div class="w-24 h-1 bg-gradient-to-r from-white/50 to-transparent mx-auto rounded-full"></div>
            </div>
            
            <!-- Form -->
            <form id="formlogin" method="POST" action="proses_login_user.php" class="space-y-6">
                <!-- Email Field -->
                <div>
                    <label class="block text-white/80 text-sm font-medium mb-2">Email</label>
                    <div class="relative">
                        <input 
                            type="text" 
                            id="username"
                            name="username"
                            class="w-full px-4 py-3 bg-white/10 border border-white/20 rounded-xl text-white placeholder-white/60 focus:outline-none focus:ring-2 focus:ring-white/30 focus:border-transparent transition-all duration-300 peer"
                            placeholder="Username"
                        >
                        <div class="absolute inset-0 rounded-xl bg-white/5 pointer-events-none opacity-0 peer-focus:opacity-100 transition-opacity duration-300"></div>
                    </div>
                </div>
                
                <!-- Password Field -->
                <div>
                    <label class="block text-white/80 text-sm font-medium mb-2">Password</label>
                    <div class="relative">
                        <input 
                            type="password"
                            id="password"
                            name="password" 
                            class="w-full px-4 py-3 bg-white/10 border border-white/20 rounded-xl text-white placeholder-white/60 focus:outline-none focus:ring-2 focus:ring-white/30 focus:border-transparent transition-all duration-300 peer"
                            placeholder="Password"
                        >
                        <div class="absolute inset-0 rounded-xl bg-white/5 pointer-events-none opacity-0 peer-focus:opacity-100 transition-opacity duration-300"></div>
                    </div>
                </div>
                
                <!-- Login Button -->
                <button 
                    type="submit"
                    class="w-full py-3.5 bg-white/90 hover:bg-white text-primary-900 font-semibold rounded-xl shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition-all duration-300 flex items-center justify-center gap-2"
                >
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path>
                    </svg>
                    Login
                </button>
                
                <!-- Forgot Password -->
                <div class="text-center">
                    <a href="#" class="text-white/70 hover:text-white transition-colors duration-200 text-sm font-medium">
                        Forgot your password?
                    </a>
                </div>
            </form>
        </div>
    </div>

</body>

<style>
  /* Custom Stars Animation */
.star {
    position: absolute;
    background: rgba(255, 255, 255, 0.8);
    border-radius: 50%;
    animation: twinkle 3s infinite ease-in-out;
}

.star-1 {
    width: 4px;
    height: 4px;
    top: 10%;
    left: 10%;
    animation-delay: 0s;
}

.star-2 {
    width: 3px;
    height: 3px;
    top: 20%;
    right: 15%;
    animation-delay: 0.5s;
}

.star-3 {
    width: 5px;
    height: 5px;
    bottom: 30%;
    left: 20%;
    animation-delay: 1s;
}

.star-4 {
    width: 2px;
    height: 2px;
    top: 60%;
    right: 25%;
    animation-delay: 1.5s;
}

.star-5 {
    width: 4px;
    height: 4px;
    bottom: 15%;
    left: 70%;
    animation-delay: 2s;
}

.star-6 {
    width: 3px;
    height: 3px;
    top: 80%;
    left: 80%;
    animation-delay: 2.5s;
}

@keyframes twinkle {
    0%, 100% { 
        opacity: 0.3;
        transform: scale(1);
    }
    50% { 
        opacity: 1;
        transform: scale(1.2);
    }
}

/* Custom Input Focus Effects */
input:focus {
    box-shadow: 
        0 0 0 1px rgba(255, 255, 255, 0.3),
        0 0 0 4px rgba(255, 255, 255, 0.1);
}

/* Glassmorphism Enhancement */
.bg-white\/5 {
    backdrop-filter: blur(20px);
    -webkit-backdrop-filter: blur(20px);
}

/* Button Hover Effect */
button:hover {
    box-shadow: 
        0 10px 25px rgba(255, 255, 255, 0.1),
        0 4px 12px rgba(0, 0, 0, 0.1);
}

/* Responsive Adjustments */
@media (max-width: 640px) {
    .max-w-md {
        margin: 1rem;
    }
    
    h1 {
        font-size: 2.25rem !important;
    }
}
</style>

</html>