<?php
session_start(); // Start the session

// Database configuration
$servername = "localhost"; // Database server name
$username = "root";         // Database username
$password = "";             // Database password
$dbname = "grocery";        // Database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Initialize the cart if it doesn't exist
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['item'])) {
    $item = $_POST['item'];
    $price = intval($_POST['price']); // Ensure price is an integer
    $quantity = intval($_POST['quantity']); // Ensure quantity is an integer
    $image = $_POST['image']; // Get the image URL

    // Calculate total price
    $totalPrice = $price * $quantity;

    // Add the item to the cart
    $_SESSION['cart'][] = [
        'item' => $item,
        'price' => $price,
        'quantity' => $quantity,
        'totalprice' => $totalPrice, // Store total price
        'image' => $image
    ];

    // Insert into database
    $stmt = $conn->prepare("INSERT INTO cart (item, price, quantity, totalprice, image) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("siiis", $item, $price, $quantity, $totalPrice, $image);
    $stmt->execute();
    $stmt->close();

    // Redirect to the cart page
    header("Location: cart.php");
    exit();
}
?>
<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Groco</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css">
    <link rel="stylesheet" href="style.css" type="text/css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet"href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"/>
</head>
<body>
<div class="header">
    <header class="header">
        <a href="#" class="logo"><i class="fas fa-shopping-basket"></i>groco</a>
        <nav class="navbar">
            <a href="#home">home</a>
            <a href="#features">features</a>
            <a href="#categories">categories </a>
            <a href="#review">review</a>
        
                        <a href="#blogs">blogs</a>
        </nav>
        <div class="icons">
            <a href="cart.php">
    <div class="fas fa-shopping-cart" id="cart-btn"></div>
</a>
            <a href="login.php" class="logout-button">Logout</a>
        </div>
        <form action="" class="search-form">
            <input type="search" id="search-box" placeholder="search here">
            <label for="search-box" class="fas fa-search"></label>
        </form>
    </header>
</div>




<script src="script.js"></script>

<section class="home " id ="home">
    <div class ="content">
        <h3>fresh and <span > organic </span> products for your</h3>
        <p>"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur."</p>

</div>
</section>

<center>
<section class="features" id="features">
    <div class="features-logo">
    <h1 >  our <span> features </span> </h1>
    
</center>
<section class="container">
    <div class="row">
        <div class="col-md-4"> <!-- Each box takes up 4 columns on medium and larger screens -->
            <div class="box">
                <img src="istockphoto-182035304-1024x1024.jpg" alt="">
                <h3>Fresh and organic</h3>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>
                <a href="#" class="btn">Read more</a>
            </div>
        </div>

        <div class="col-md-4">
            <div class="box">
                <img src="download (7).jpeg" alt="">
                <h3>Free delivery</h3>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>
                <a href="#" class="btn">Read more</a>
            </div>
        </div>

        <div class="col-md-4">
            <div class="box">
                <img src="WP_Easy_Payment_and_Checkout_Illustrative_Banner.jpg" alt="">
                <h3>Easy payment</h3>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>
                <a href="#" class="btn">Read more</a>
            </div>
        </div>
    </div>
</section>



<section class="products" id="products">
    <h1 class="heading"> our <span>products</span></h1>
    <div class="container">
        <div class="row product-slider">
            <div class="col-md-3 col-sm-6 mb-4">
                <div class="box">
                    <img src="images.jpeg" class="img-fluid" alt="">
                    <h3>Fresh Orange</h3>
                    <div class="price">10</div> 
                    <div class="stars">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star-half-alt"></i>
                    </div>
                    <form method="POST">
                        <input type="hidden" name="item" value="Fresh Orange">
                        <input type="hidden" name="price" value="5"> <!-- Price as integer -->
                        <input type="hidden" name="image" value="images.jpeg"> <!-- Image URL -->
                        <input type="number" name="quantity" value="1" min="1" class="form-control" style="width: 60px; display: inline-block;">
                        <button type="submit" class="btn btn-primary">Add to Cart</button>
                    </form>
                </div>
            </div>

            <div class="col-md-3 col-sm-6 mb-4">
                <div class="box">
                    <img src="download (9).jpeg" class="img-fluid" alt="">
                    <h3>Fresh Cabbage</h3>
                    <div class="price">15</div> <!-- Price as integer -->
                    <div class="stars">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star-half-alt"></i>
                    </div>
                    <form method="POST">
                        <input type="hidden" name="item" value="Fresh Cabbage">
                        <input type="hidden" name="price" value="5"> <!-- Price as integer -->
                        <input type="hidden" name="image" value="download (9).jpeg"> <!-- Image URL -->
                        <input type="number" name="quantity" value="1" min="1" class="form-control" style="width: 60px; display: inline-block;">
                        <button type="submit" class="btn btn-primary">Add to Cart</button>
                    </form>
                </div>
            </div>

            <div class="col-md-3 col-sm-6 mb-4">
                <div class="box">
                    <img src="download (8).jpeg" class="img-fluid" alt="">
                    <h3>Onions</h3>
                    <div class="price">20</div> <!-- Price as integer -->
                    <div class="stars">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star-half-alt"></i>
                    </div>
                    <form method="POST">
                        <input type="hidden" name="item" value="Onions">
                        <input type="hidden" name="price" value="5"> <!-- Price as integer -->
                        <input type="hidden" name="image" value="download (8).jpeg"> <!-- Image URL -->
                        <input type="number" name="quantity" value="1" min="1" class="form-control" style="width: 60px; display: inline-block;">
                        <button type="submit" class="btn btn-primary">Add to Cart</button>
                    </form>
                </div>
            </div>

            <div class="col-md-3 col-sm-6 mb-4">
                <div class="box">
                    <img src="download (10).jpeg" class="img-fluid" alt="">
                    <h3>Fresh Cucumber</h3>
                    <div class="price">18</div> <!-- Price as integer -->
                    <div class="stars">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star-half-alt"></i>
                    </div>
                    <form method="POST">
                        <input type="hidden" name="item" value="Fresh Cucumber">
                        <input type="hidden" name="price" value="5"> <!-- Price as integer -->
                        <input type="hidden" name="image" value="download (10).jpeg"> <!-- Image URL -->
                        <input type="number" name="quantity" value="1" min="1" class="form-control" style="width: 60px; display: inline-block;">
                        <button type="submit" class="btn btn-primary">Add to Cart</button>
                    </form>
                </div>
            </div>

            <div class="col-md-3 col-sm-6 mb-4">
                <div class="box">
                    <img src="download (11).jpeg" class="img-fluid" alt="">
                    <h3>Fresh Potatoes</h3>
                    <div class="price">15</div> <!-- Price as integer -->
                    <div class="stars">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star-half-alt"></i>
                    </div>
                    <form method="POST">
                        <input type="hidden" name="item" value="Fresh Potatoes">
                        <input type="hidden" name="price" value="5"> <!-- Price as integer -->
                        <input type="hidden" name="image" value="download (11).jpeg"> <!-- Image URL -->
                        <input type="number" name="quantity" value="1" min="1" class="form-control" style="width: 60px; display: inline-block;">
                        <button type="submit" class="btn btn-primary">Add to Cart</button>
                    </form>
                </div>
            </div>

            <div class="col-md-3 col-sm-6 mb-4">
                <div class="box">
                    <img src="download (12).jpeg" class="img-fluid" alt="">
                    <h3>Fresh Carrots</h3>
                    <div class="price">19</div> <!-- Price as integer -->
                    <div class="stars">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star-half-alt"></i>
                    </div>
                    <form method="POST">
                        <input type="hidden" name="item" value="Fresh Carrots">
                        <input type="hidden" name="price" value="5"> <!-- Price as integer -->
                        <input type="hidden" name="image" value="download (12).jpeg"> <!-- Image URL -->
                        <input type="number" name="quantity" value="1" min="1" class="form-control" style="width: 60px; display: inline-block;">
                        <button type="submit" class="btn btn-primary">Add to Cart</button>
                    </form>
                </div>
            </div>

            <div class="col-md-3 col-sm-6 mb-4">
                <div class="box">
                    <img src="download (13).jpeg" class="img-fluid" alt="">
                    <h3>Fresh Avocado</h3>
                    <div class="price">20</div> <!-- Price as integer -->
                    <div class="stars">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star-half-alt"></i>
                    </div>
                    <form method="POST">
                        <input type="hidden" name="item" value="Fresh Avocado">
                        <input type="hidden" name="price" value="5"> <!-- Price as integer -->
                        <input type="hidden" name="image" value="download (13).jpeg"> <!-- Image URL -->
                        <input type="number" name="quantity" value="1" min="1" class="form-control" style="width: 60px; display: inline-block;">
                        <button type="submit" class="btn btn-primary">Add to Cart</button>
                    </form>
                </div>
            </div>

            <div class="col-md-3 col-sm-6 mb-4">
                <div class="box">
                    <img src="download (14).jpeg" class="img-fluid" alt="">
                    <h3>Green Lemon</h3>
                    <div class="price">16</div> <!-- Price as integer -->
                    <div class="stars">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star-half-alt"></i>
                    </div>
                    <form method="POST">
                        <input type="hidden" name="item" value="Green Lemon">
                        <input type="hidden" name="price" value="5"> <!-- Price as integer -->
                        <input type="hidden" name="image" value="download (14).jpeg"> <!-- Image URL -->
                        <input type="number" name="quantity" value="1" min="1" class="form-control" style="width: 60px; display: inline-block;">
                        <button type="submit" class="btn btn-primary">Add to Cart</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="categories" id="categories">
   
<h1 class="heading text-center">Product <span>Categories</span></h1>
<div class="container">
    <div class="row">
        <div class="col-md-3 col-sm-6 mb-4">
            <div class="box text-center">
                <img src="download (16).jpeg" class="img-fluid" alt="">
                <h3>Fresh Fruits</h3>
                <p>Up to 45% off</p>
            
            </div>
        </div>
        <div class="col-md-3 col-sm-6 mb-4">
            <div class="box text-center">
                <img src="download (15).jpeg" class="img-fluid" alt="">
                <h3>Fresh Vegetables</h3>
                <p>Up to 45% off</p>
            
            </div>
        </div>
        <div class="col-md-3 col-sm-6 mb-4">
            <div class="box text-center">
                <img src="download (17).jpeg" class="img-fluid" alt="">
                <h3>Dairy Products</h3>
                <p>Up to 45% off</p>
            
            </div>
        </div>
        <div class="col-md-3 col-sm-6 mb-4">
            <div class="box text-center">
                <img src="download (18).jpeg" class="img-fluid" alt="">
                <h3>Fresh Meat</h3>
                <p>Up to 45% off</p>
                
            </div>
        </div>
    </div>
</div>
</section>
<section class="review" id="review">
    <h1 class="heading">Customer's<span> review </span> </h1>

    <div class="swiper review-slider">
        <div class="swiper-wrapper">
            <div class="swiper-slide box">
<img src="images (1).jpeg" alt="">
<p>"I've been shopping at GreenMart for over a year now, and it's always a pleasant experience. The produce is always fresh, and the variety is impressive, especially the organic options. The staff are friendly and always willing to help, making my shopping trips quick and enjoyable.</p>
<h3>Melisaa Deo </h3>
<div class="stars">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star-half-alt"></i>
                </div>
                <a href="#" class="btn"> Read More</a>
</div>
</div>
</div>

<div class="review-slider">
        <div class="wrapper">
            <div class="box">
<img src="download (20).jpeg" alt="">
<p>"I've been shopping at GreenMart for over a year now, and it's always a pleasant experience. The produce is always fresh, and the variety is impressive, especially the organic options. The staff are friendly and always willing to help, making my shopping trips quick and enjoyable.</p>
<h3> Lee </h3>
<div class="stars">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star-half-alt"></i>
                </div>

</div>
</div>
</div>

<div class="review-slider">
        <div class="wrapper">
            <div class="swiper-slide box">
<img src="download (21).jpeg" alt="">
<p>"I've been shopping at GreenMart for over a year now, and it's always a pleasant experience. The produce is always fresh, and the variety is impressive, especially the organic options. The staff are friendly and always willing to help, making my shopping trips quick and enjoyable.</p>
<h3>Awi </h3>
<div class="stars">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star-half-alt"></i>
                </div>
        
</div>
</div>
</div>


</section>

<section class="blogs" id="blogs">
    <h1 class="heading"> our <span> blogs </span> </h1>
    
    <div class="box-container">
        <div class="box">
            <img src="download (23).jpeg" alt ="">
            <div class="content1">
                <div class="icons">
                    <a href="#"><i class="fas fa-user"></i> by user </a>
                    <a href="#"><i class="fas fa-calendar"></i> 21st July 2024</a>
        <h3>Fresh and organic vegetables and fruits </h3>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>
        <a href="#" class="btn"> Read More</a>

</div>
</div>
</div>
</div> 

<div class="box-container">
        <div class="box">
            <img src="images (2).jpeg" alt ="">
            <div class="content1">
                <div class="icons">
                    <a href="#"><i class="fas fa-user"></i> by user </a>
                    <a href="#"><i class="fas fa-calendar"></i> 21st July 2024</a>
        <h3>Fresh and organic vegetables and fruits </h3>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>
        <a href="#" class="btn"> Read More</a>

</div>
</div>
</div>
</div> 

<div class="box-container">
        <div class="box">
            <img src="download (24).jpeg" alt ="">
            <div class="content1">
                <div class="icons">
                    <a href="#"><i class="fas fa-user"></i> by user </a>
                    <a href="#"><i class="fas fa-calendar"></i> 21st July 2024</a>
        <h3>Fresh and organic vegetables and fruits </h3>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>
        <a href="#" class="btn"> Read More</a>

</div>
</div>
</div>
</div> 

<section class="footer">
<div class ="box-container">
    <div class="box">
        <h3> groco <i class="fas fa-shopping-basket"></i></h3>
        <p> Lorem Lorem ipsum dolor sit amet, consectetur adipiscing elit</p>

        <div class="share">
            <a href="#" class="fab fa-facebook"></a>
            <a href="#" class="fab fa-twitter"></a>
            <a href="#" class="fab fa-instagram"></a>
            <a href="#" class="fab fa-linkedin"></a>
        
</div>

</div>

<div class="box">
        <h3> contact info </h3>

            <a href="#" class="links"> <i class="fas fa-phone"></i>0712435758664</a>
            <a href="#" class="links"> <i class="fas fa-phone"></i>071423749375</a>
            <a href="#" class="links"> <i class="fas fa-envelope"></i>j@gmail.com</a>
            <a href="#" class="links"> <i class="fas fa-map-marker-alt">Thika, Kiambu</i></a>
      

</div>


<div class="box">
        <h3> quick links </h3>

            <a href="#home" class="links"> <i class="fas fa-arrow-right"></i>home</a>
            
            <a href="#features" class="links"> <i class="fas fa-arrow-right"></i>features</a>

            <a href="#products" class="links"> <i class="fas fa-arrow-right"></i>products</a>
            
            <a href="#categories" class="links"> <i class="fas fa-arrow-right"></i>categories</a>
            
            <a href="#reviews" class="links"> <i class="fas fa-arrow-right"></i>reviews </a>
            
            <a href="#blogs" class="links"> <i class="fas fa-arrow-right"></i>blogs</a>

</div>
</div>

</div>
</div>

</section>

</body>
</html>

