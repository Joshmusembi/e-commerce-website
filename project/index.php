<!DOCTYPE html>
<html>
<head>
    <title>Home Page</title>
</head>
<body style="margin: 0; font-family: 'Helvetica Neue', Arial, sans-serif; background: #f0f0f0; display: flex; justify-content: center; align-items: center; height: 100vh;">

    <div class="hero" style="text-align: center; background: linear-gradient(90deg, #4CAF50 50%, #ADD8E6 50%); width: 80%; padding: 50px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); border-radius: 15px; animation: fadeIn 1s ease-in-out;">
        <img src="./download.jfif" alt="Logo" style="width: 100px; height: auto; margin-bottom: 20px; animation: float 3s ease-in-out infinite;">
        <h1 style="color: white; margin: 0; font-size: 3em; text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.2);">Welcome to Our Platform</h1>
        <p style="color: white; font-size: 1.2em; margin-top: 10px; margin-bottom: 30px;">Join us today and enjoy our services.</p>
        <div style="display: flex; justify-content: center; gap: 20px;">
            <a href="signup.php" class="button" style="background: #FFEB3B; color: #333; padding: 15px 30px; text-decoration: none; border-radius: 5px; font-size: 1.2em; transition: background 0.3s;">Sign Up</a>
            <a href="login.php" class="button" style="background: #FFEB3B; color: #333; padding: 15px 30px; text-decoration: none; border-radius: 5px; font-size: 1.2em; transition: background 0.3s;">Login</a>
        </div>
    </div>

    <script>
        document.querySelectorAll('.button').forEach(button => {
            button.addEventListener('mouseover', () => {
                button.style.background = '#FFC107';
            });
            button.addEventListener('mouseout', () => {
                button.style.background = '#FFEB3B';
            });
        });
    </script>

    <style>
        @keyframes fadeIn {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }
        @keyframes float {
            0%, 100% {
                transform: translateY(0);
            }
            50% {
                transform: translateY(-10px);
            }
        }
    </style>

</body>
</html>
