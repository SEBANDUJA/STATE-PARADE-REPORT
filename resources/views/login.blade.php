<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SPRMS | Home </title>
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
        
        /* Navigation Bar Styles */
        .navbar {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            background-color: rgba(0, 0, 0, 0.7);
            padding: 15px 30px;
            z-index: 100;
            display: flex;
            justify-content: flex-start;
            align-items: center;
        }
        
        .nav-links {
            display: flex;
            gap: 20px;
        }
        
        .nav-links a {
            color: white;
            text-decoration: none;
            font-size: 1rem;
            text-transform: uppercase;
            letter-spacing: 1px;
            padding: 5px 10px;
            border-radius: 3px;
            transition: all 0.3s ease;
        }
        
        .nav-links a:hover {
            background-color: rgba(255, 255, 255, 0.2);
        }
        
        /* Slider Container */
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
        
        /* Slider Navigation Arrows */
        .slider-nav {
            position: absolute;
            top: 50%;
            width: 100%;
            display: flex;
            justify-content: space-between;
            z-index: 20;
            transform: translateY(-50%);
        }
        
        .slider-arrow {
            color: white;
            font-size: 2.5rem;
            cursor: pointer;
            padding: 0 20px;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
            transition: all 0.3s ease;
            user-select: none;
        }
        
        .slider-arrow:hover {
            transform: scale(1.2);
        }
        
        /* Content Styles */
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
            padding-top: 70px; /* To account for navbar */
        }
        
        .title-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-bottom: 30px;
        }
        
        h1 {
            font-size: 3.2rem;
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
        
        /* Responsive Styles */
        @media (max-width: 768px) {
            .navbar {
                padding: 10px 15px;
            }
            
            .nav-links {
                gap: 10px;
            }
            
            .nav-links a {
                font-size: 0.8rem;
                padding: 3px 6px;
            }
            
            h1 {
                font-size: 2rem;
            }
            
            .login-btn {
                padding: 12px 30px;
                font-size: 1rem;
            }
            
            .slider-arrow {
                font-size: 2rem;
                padding: 0 10px;
            }
        }
    </style>
</head>
<body>
    <!-- Navigation Bar -->
    
    <!-- Image Slider -->
    <div class="slider-container">
        <!-- Slides using local images -->
        <div class="slide active" style="background-image: url('images/wildfire.jpg');"></div>
        <div class="slide" style="background-image: url('images/pixabay.jpg');"></div>
        <div class="slide" style="background-image: url('images/pic2.jpg');"></div>
        <div class="slide" style="background-image: url('images/pic1.jpg');"></div>
        <div class="slide" style="background-image: url('images/parade57.jpg');"></div>
        
        <!-- Slider Navigation Arrows -->
        <div class="slider-nav">
            <div class="slider-arrow prev" onclick="prevSlide()">&#10094;</div>
            <div class="slider-arrow next" onclick="nextSlide()">&#10095;</div>
        </div>
        
        <!-- Content Overlay -->
        <div class="content">
            <div class="title-container">
                <h1>STATE PARADE REPORT (SPRMS)</h1>
                <button class="login-btn" onclick="window.location.href='/login'">LOGIN</button>
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
            let slideInterval;
            
            // Preload images
            function preloadImages() {
                const images = [
                    'images/wildfire.jpg',
                    'images/pixabay.jpg',
                    'images/pic2.jpg',
                    'images/pic1.jpg',
                    'images/parade57.jpg'
                ];
                
                images.forEach(image => {
                    const img = new Image();
                    img.src = image;
                });
            }
            
            // Initialize first slide
            function initSlider() {
                slides[currentSlide].classList.add('active');
                preloadImages();
                slideInterval = setInterval(nextSlide, 5000);
            }
            
            // Change to next slide
            function nextSlide() {
                goToSlide((currentSlide + 1) % slides.length);
            }
            
            // Change to previous slide
            function prevSlide() {
                goToSlide((currentSlide - 1 + slides.length) % slides.length);
            }
            
            // Go to specific slide
            function goToSlide(n) {
                clearInterval(slideInterval);
                slides[currentSlide].classList.remove('active');
                currentSlide = n;
                slides[currentSlide].classList.add('active');
                slideInterval = setInterval(nextSlide, 5000);
            }
            
            // Initialize slider
            initSlider();
            
            // Make functions available globally for arrow clicks
            window.nextSlide = nextSlide;
            window.prevSlide = prevSlide;
            
            // Login button functionality
            const loginBtn = document.querySelector('.login-btn');
            loginBtn.addEventListener('click', function() {
                window.location.href = '/login';
            });
        });
    </script>
</body>
</html>