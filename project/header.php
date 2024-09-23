
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
 <link rel="stylesheet" href="styles1.css" type= "text/css">

</head>
<body>
<header>
<div class="flex">
 
    <nav class="navbar">
        <p>Green<img src="download.jpg" alt="Tea">Tea</p>
        <a href="home.php">Home</a>
        <a href="viewproduct.php">Products</a>
        <a href="order.php">Orders</a>
        <a href="about.php">About Us</a>
        <a href="contact.php">Contact Us</a>
        <!-- Moved images to the end -->
        <img src="download.png" alt="Image 1" class="small-logo">
        <img src="4240564.png" alt="Image 2" class="small-logo">
        <img src="download (1).png" alt="Image 3" class="small-logo">
    </nav>
</div>
       
    <div class="slider">
    <div class="slides">
        <div class="slide fade">
            <img src="images.jpg" alt="Kenyan Coffee 1">
            <p class="caption">The best of Kenyan coffee</p>
        </div>
        <div class="slide fade">
            <img src="istockphoto-1441569995-170667a.webp" alt="Kenyan Coffee 2">
            <p class="caption">The best of Kenyan coffee</p>
        </div>
        <div class="slide fade">
            <img src="download (4).jpg" alt="Kenyan Coffee 3">
            <p class="caption">The best of Kenyan coffee</p>
        </div>
    </div>
    <a class="prev" onclick="changeSlide(-1)">&#10094;</a>
    <a class="next" onclick="changeSlide(1)">&#10095;</a>
</div>
<script src="script.js"></script>
</script>

</body>
</html>