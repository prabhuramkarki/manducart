<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Product Carousel</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .cara-wrap {
            display: flex;
            justify-content: center;
            align-items: center;

        }

        .carousel-container {
            position: relative;
            width: 90%;
            margin: 40px auto;
            height: 50vh;
            opacity: 85%;
            overflow: hidden;
        }

        .carousel {
            display: flex;
            transition: transform 0.5s ease-in-out;

        }

        .carousel-item {
            object-fit: contain;
            min-width: 100%;
            box-sizing: border-box;
        }

        .carousel-item img {
            width: 100%;
            height: 100%;
        }

        .controls {
            position: absolute;
            top: 50%;
            width: 100%;
            display: flex;
            justify-content: space-between;
            transform: translateY(-50%);
        }

        button {
            color: #fff;
            border: none;
            padding: 10px;
            cursor: pointer;
        }

        #nextBtn {
            border-radius: 2px 0px 0px 2px;

        }

        #prevBtn {
            border-radius: 0px 2px 2px 0px;

        }
    </style>
</head>

<body>
    <div class="cara-wrap">
        <div class="carousel-container">
            <div class="carousel" id="auto-carousel">
                <div class="carousel-item"><img src="../../images/image3.jpg" alt="Product 1"></div>
                <div class="carousel-item"><img src="../../images/image4.jpg" alt="Product 1"></div>
                <div class="carousel-item"><img src="../../images/image5.jpg" alt="Product 1"></div>
                <div class="carousel-item"><img src="../../images/image6.jpg" alt="Product 1"></div>
                <div class="carousel-item"><img src="../../images/image7.jpg" alt="Product 1"></div>
            </div>

            <div class="controls">
                <button id="prevBtn"><i class="fa-solid fa-angle-left"></i></button>
                <button id="nextBtn"><i class="fa-solid fa-angle-right"></i></button>
            </div>
            <div class="gallrey-text">
                <p>MENS | WOMENS</p>
                <h1>New Arrival</h1>
                <a href="shop.php">
                    <p
                        style="background-color: red; padding: 10px; width: 108px; color: white; border-radius: 7px; margin: 20px; font-size: 15px;">
                        Order Now
                    </p>
                </a>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var currentIndex = 0;
            var items = document.querySelectorAll('.carousel-item');
            var totalItems = items.length;

            // Auto slide the carousel every 3 seconds
            var autoSlide = setInterval(function () {
                nextSlide();
            }, 3000);

            // Previous button click event
            document.getElementById('prevBtn').addEventListener('click', function () {
                clearInterval(autoSlide);
                prevSlide();
            });

            // Next button click event
            document.getElementById('nextBtn').addEventListener('click', function () {
                clearInterval(autoSlide);
                nextSlide();
            });

            function updateCarousel() {
                document.querySelector('.carousel').style.transform = 'translateX(' + (-currentIndex * 100) + '%)';
            }

            function nextSlide() {
                if (currentIndex < totalItems - 1) {
                    currentIndex++;
                } else {
                    currentIndex = 0;
                }
                updateCarousel();
            }

            function prevSlide() {
                if (currentIndex > 0) {
                    currentIndex--;
                } else {
                    currentIndex = totalItems - 1;
                }
                updateCarousel();
            }
        });

    </script>
</body>

</html>