<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Admin Login | Laky</title>
        <!--favicon icon-->
        <link rel="shortcut icon" href="../assets/favicon.png" type="image/x-icon">
        <script src="https://cdn.tailwindcss.com"></script>
        <script src="https://unpkg.com/lucide@latest"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <style>
        body { font-family: 'Poppins', sans-serif; background-color: #0D1725; }
        </style>
    </head>
    <body class="min-h-screen flex items-center justify-center p-4">
        <div class="w-full max-w-md bg-white/5 backdrop-blur-md rounded-xl border border-white/10 p-8 shadow-lg">
            <div class="text-center mb-8">
                <h1 class="text-3xl font-bold text-white mb-2">Admin Dashboard</h1>
                <p class="text-white/60">Sign in to manage your portfolio</p>
            </div>
            <form id="loginForm" class="space-y-6">
                <div>
                    <label for="email" class="block text-sm font-medium text-white/80 mb-1">Email</label>
                    <input
                        type="email"
                        id="email"
                        name="email"
                        required
                        class="w-full px-4 py-3 bg-white/5 border border-white/10 rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-[#C6FCA6] transition"
                    >
                </div>
                <div>
                    <label for="password" class="block text-sm font-medium text-white/80 mb-1">Password</label>
                    <input
                        type="password"
                        id="password"
                        name="password"
                        required
                        class="w-full px-4 py-3 bg-white/5 border border-white/10 rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-[#C6FCA6] transition"
                    >
                </div>
                <button type="submit" class="w-full bg-gradient-to-r from-[#C6FCA6] to-[#A7FCEE] text-black font-medium py-3 px-4 rounded-lg hover:opacity-90 transition flex items-center justify-center gap-2">
                    Sign In
                    <i data-lucide="log-in" class="w-5 h-5"></i>
                </button>
            </form>
        </div>
        <script>
        lucide.createIcons();
        
        document.getElementById('loginForm').addEventListener('submit', async (e) => {
            e.preventDefault();

            const email = document.getElementById('email').value;
            const password = document.getElementById('password').value;

            try {
                const response = await fetch('api/login.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({ email, password })
                });

                const data = await response.json();

                if (response.ok) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Login Successful!',
                        showConfirmButton: false,
                        timer: 1200
                    }).then(() => {
                        window.location.href = 'dashboard.php';
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Login Failed',
                        text: data.message || 'Invalid credentials'
                    });
                }
            } catch (error) {
                console.error('Error:', error);
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'An error occurred during login'
                });
            }
        });
        </script>
    </body>
</html>
