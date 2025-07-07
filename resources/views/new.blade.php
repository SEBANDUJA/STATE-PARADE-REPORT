<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SPRMS State Parade Report</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Arial', sans-serif;
        }
        
        body, html {
            height: 100%;
            overflow: hidden;
        }
        
        .slider-container {
            position: relative;
            width: 100%;
            height: 100vh;
            overflow: hidden;
        }
        
        .slide {
            position: absolute;
            width: 100%;
            height: 100%;
            background-size: cover;
            background-position: center;
            opacity: 0;
            transition: opacity 1s ease-in-out;
        }
        
        .slide.active {
            opacity: 1;
        }
        
        .content {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            background-color: rgba(0, 0, 0, 0.5);
            color: white;
            text-align: center;
            z-index: 10;
        }
        
        .title-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-bottom: 30px;
        }
        
        h1 {
            font-size: 3.5rem;
            text-transform: uppercase;
            margin-bottom: 10px;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
            letter-spacing: 3px;
        }
        
        .login-btn {
            padding: 15px 40px;
            background-color: #0066cc;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 1.2rem;
            cursor: pointer;
            text-transform: uppercase;
            font-weight: bold;
            transition: all 0.3s ease;
            margin-top: 20px;
        }
        
        .login-btn:hover {
            background-color: #0052a3;
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
        }
        
        .copyright {
            position: absolute;
            bottom: 20px;
            width: 100%;
            text-align: center;
            color: rgba(255, 255, 255, 0.8);
            font-size: 0.9rem;
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.5);
        }
        
        @media (max-width: 768px) {
            h1 {
                font-size: 2rem;
            }
            
            .login-btn {
                padding: 12px 30px;
                font-size: 1rem;
            }
        }
    </style>
</head>
<body>
    <div class="slider-container">
        <!-- Slides using local images -->
        <div class="slide active" style="background-image: url('images/parade1.jpg');"></div>
        <div class="slide" style="background-image: url('images/parade2.jpg');"></div>
        <div class="slide" style="background-image: url('images/parade3.jpg');"></div>
        <div class="slide" style="background-image: url('images/parade4.jpg');"></div>
        
        <!-- Content -->
        <div class="content">
            <div class="title-container">
                <h1>STATE PARADE REPORT (SPRMS)</h1>
                <button class="login-btn">LOGIN</button>
            </div>
            <div class="copyright">
                &copy; 2025 SPRMS State Parade Report. All Rights Reserved.
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const slides = document.querySelectorAll('.slide');
            let currentSlide = 0;
            
            // Preload images
            function preloadImages() {
                const images = [
                    'images/wildfire.jpg',
                    'images/parade2.jpg',
                    'images/parade3.jpg',
                    'images/parade4.jpg'
                ];
                
                images.forEach(image => {
                    const img = new Image();
                    img.src = image;
                });
            }
            
            // Initialize first slide
            slides[currentSlide].classList.add('active');
            preloadImages();
            
            // Change slide every 5 seconds
            setInterval(nextSlide, 5000);
            
            function nextSlide() {
                slides[currentSlide].classList.remove('active');
                currentSlide = (currentSlide + 1) % slides.length;
                slides[currentSlide].classList.add('active');
            }
            
            // Login button functionality
            const loginBtn = document.querySelector('.login-btn');
            loginBtn.addEventListener('click', function() {
                // In a real implementation, you would redirect to a login page:
                window.location.href = '/login';
                // For demo:
                // alert('Redirecting to login page...');
            });
        });
    </script>
</body>
</html>