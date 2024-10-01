<!DOCTYPE html>
<html lang="en" class="scroll-smooth">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>ViceVersa - <?php echo $title ?></title>
    <base href="localhost/Ecommerce/public/">
    <link href="assets/css/styles.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@100;200;300;400;600;700&display=swap"
        rel="stylesheet" />
</head>

<body class="bg-gradient-neutral-to-primary font-sans">

    <header class="bg-gradient-neutral-to-primary fixed top-0 left-0 right-0 z-50">
        <div class="w-full flex justify-between p-5 items-center">
            <!-- Hamburger Icon for Mobile Menu -->
            <div class="md:hidden flex items-center">
                <button id="menu-button" class="text-contentColor1 focus:outline-none">
                    <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16m-7 6h7" />
                    </svg>
                </button>
            </div>

            <!-- Logo -->
            <a href="">
                <img src="assets/images/logo.svg" alt="ViceVersa Logo" />
            </a>

            <nav class="hidden md:flex md:items-center md:space-x-5 py-1 px-3 bg-secondary rounded-full">
                <ul class="flex space-x-5 list-none">
                    <li
                        class="bg-transparent hover:bg-white text-contentColor1 hover:text-black transition-colors duration-300 px-5 py-2 rounded-full">
                        <a href="">Home</a>
                    </li>
                    <li
                        class="bg-transparent hover:bg-white text-contentColor1 hover:text-black transition-colors duration-300 px-5 py-2 rounded-full">
                        <a href="products/mens-wear">Mens</a>
                    </li>
                    <li
                        class="bg-transparent hover:bg-white text-contentColor1 hover:text-black transition-colors duration-300 px-5 py-2 rounded-full">
                        <a href="products/womens-wear">Womens</a>
                    </li>
                    <li
                        class="bg-transparent hover:bg-white text-contentColor1 hover:text-black transition-colors duration-300 px-5 py-2 rounded-full">
                        <a href="contact">Contact</a>
                    </li>
                </ul>
            </nav>

            <div class="flex items-center space-x-5">
                <!-- Cart Icon -->
                <div id="cart-button"
                    class="relative p-2 rounded-full bg-secondary text-contentColor1 hover:bg-white hover:text-black transition-colors duration-300">
                    <a href="cart" aria-label="Cart" class="flex items-center justify-center">
                        <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke-width="2" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 0 0-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 0 0-16.536-1.84M7.5 14.25 5.106 5.272M6 20.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Zm12.75 0a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Z" />
                        </svg>
                    </a>
                    <!-- Badge for item count -->
                    <span id="items-count"
                        class="absolute bottom-0 right-0 bg-secondary text-white text-xs font-bold rounded-full w-5 h-5 flex items-center justify-center">
                        <?= isset($_SESSION['items_count']) ? $_SESSION['items_count'] : 0; ?>
                    </span>
                    </span>

                </div>

                <?php if (isset($_SESSION['logged_in'])) { ?>
                    <div
                        class="relative p-2 rounded-full bg-secondary text-contentColor1 hover:bg-white hover:text-black transition-colors duration-300">
                        <a href="account" class="block">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                                stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M17.982 18.725A7.488 7.488 0 0 0 12 15.75a7.488 7.488 0 0 0-5.982 2.975m11.963 0a9 9 0 1 0-11.963 0m11.963 0A8.966 8.966 0 0 1 12 21a8.966 8.966 0 0 1-5.982-2.275M15 9.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                            </svg>
                        </a>
                    </div>
                <?php } else { ?>
                    <!-- Login Button -->
                    <div
                        class="bg-secondary px-5 py-2 rounded-full hover:bg-white text-contentColor1 hover:text-black transition-colors duration-300">
                        <a class="block" href="account">Login</a>
                    </div>
                <?php } ?>

            </div>
        </div>

        <!-- Mobile Navigation Menu -->
        <?php include BASE_URL . '/app/views/components/nav-mobile.php' ?>

    </header>