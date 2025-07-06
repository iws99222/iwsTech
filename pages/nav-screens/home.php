<!DOCTYPE html>
<html lang="en">

<head>
    <?php include '../../pages/components/header.html'?>
    <link rel="stylesheet" href="../../styles/home.css" />
    <!-- the above style is the responsible for the product styling -->
    <link rel="stylesheet" href="../../styles/product-card-categories-list.css">
</head>

<body>
    <div class="main-home-container">
        <div class="top-container">
            <!-- <!-- description container   -->
            <div class="desc-container">
                <h1>iwstech – Quality PC Components at Great Prices</h1>
                <p>
                    Explore our wide selection of high-performance PC parts including
                    processors, graphics cards, motherboards, RAM, storage, and more – all
                    at competitive prices.
                </p>
            </div>
        </div>
        <!-- middle slider section -->
        <div class="middle-container">
            <section class="slider-controls-section">
                <!-- slider btn previous -->
                <button class="btn-slide-prev">
                    <img src="../../drawables/icons/ic-left.png" />
                </button>
                <!-- slider container -->
                <section class="slider-container">
                    <!-- first slide page -->
                    <div class="slide first-page">
                        <div class="text-section">
                            <h1>Your PC<br>Your Rules</h1>
                            <p>Start Building Today!</p>
                            <!-- scroll to products -->
                            <a href="#latest_products"><button class="shop-btn">Shop now</button></a>
                        </div>
                        <div class="image-section">
                            <img src="../../drawables/slideshow/case.webp" alt="Gaming Gear">
                        </div>
                    </div>
                    <!-- second slide page -->
                    <div class="slide second-page">
                        <div class="text-section">
                            <h1>BIG iwstech SALES</h1>
                            <p>UP TO 50% OFF</p>
                            <!-- scroll to products -->
                            <a href="#latest_products"><button class="shop-btn">Shop now</button></a>
                        </div>
                    </div>
                    <!-- third slide page -->
                    <div class="slide third-page">
                        <div class="text-section">
                            <h1>🎮 Gaming Essentials</h1>
                            <p>Level up your gameplay with top-tier gear — precision, comfort, and immersive sound.</p>
                            <!-- scroll to products -->
                            <a href="#latest_products"><button class="shop-btn">Shop now</button></a>
                        </div>
                        <div class="image-section">
                            <img src="../../drawables/slideshow/headset.webp" alt="Gaming Gear">
                            <img src="../../drawables/slideshow/keyboard.webp" alt="Gaming Gear">
                        </div>
                    </div>
                    <!-- fourth slide page -->
                    <div class="slide fourth-page">
                        <div class="text-section">
                            <p id="t">Where we run,<br>
                                others follow.
                            </p>
                            <h2>But Never Catch</h2>
                            <!-- scroll to products -->
                            <a href="#latest_products"><button class="shop-btn">Shop now</button></a>
                        </div>
                        <div class="image-section">
                            <img src="../../drawables/slideshow/slider-4.webp" alt="slider_4_img" />
                        </div>
                    </div>
                </section>
                <!-- slider btn next -->
                <button class="btn-slide-next">
                    <img src="../../drawables/icons/ic-right.png" />
                </button>
            </section>
            <!-- slider dots will be generated in js -->
            <div class="slider-dots-container"></div>
        </div>

        <!-- bottom marquee container -->
        <div class="bottom-container">
            <!-- marquee text -->
            <marquee id="my-marquee" behavior="scroll" direction="left" scrollamount="5">
                🔥 Flash Sale: Up to 30% OFF on CPUs, SSDs, Gaming Monitors, and more! |
                🖥️ Build Your Dream PC Today! | 🚀 Free Shipping on Orders Over $50 | 🛒
                Shop Now Before It’s Gone! 🔧💻🎧
            </marquee>
        </div>

        <!-- latest products heading -->
        <h1 id="latest_products" class="latest-items-txt">Latest Products</h1>

        <!-- preparing the query to retrieve the last 4 items -->
        <?php
                $getProductsQuery = '
                SELECT *
                FROM Products
                order by productID desc
                limit 4;
                ';
            // we want to include the getAllProducts.php
            // in order to retrieve the products with respect to
            // query gemer
            include '../../database/getProducts.php'; ?>
    </div>
</body>

</html>