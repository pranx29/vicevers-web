<?php require_once BASE_URL . '/app/views/components/product_card.php' ?>
<div class="flex-col space-y-16">
    <section class="flex flex-col items-center justify-center h-screen">
        <div class="text-center w-full max-w-4xl">
            <h1 class="text-3xl sm:text-4xl md:text-5xl font-extrabold text-white">
                <span class="font-black text-contentColor1">Style Redefined:</span>
                Trendy Fashion for Every Wardrobe
            </h1>
            <p class="text-base sm:text-lg md:text-xl text-contentColor1 mt-5 font-semibold">
                Discover the perfect blend of contemporary trends and timeless style.
                From everyday essentials to standout pieces, our collection elevates
                your wardrobe with versatile, fashionable options. Explore our best
                sellers and new arrivals to redefine your look today!
            </p>
            <a href="#best-sellers"
                class="bg-white text-black px-5 py-3 rounded-full mt-10 transition-colors duration-300 inline-flex items-center justify-center hover:bg-opacity-80">
                <span class="text-sm sm:text-base md:text-xl mr-3">EXPLORE COLLECTIONS</span>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                    stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="m9 12.75 3 3m0 0 3-3m-3 3v-7.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                </svg>
            </a>
        </div>
    </section>`

    <!-- Best Sellers Section -->
    <section class="scroll-m-40" id="best-sellers">
        <div class="container mx-auto flex-col space-y-10">
            <h2 class="text-white font-semibold text-4xl">
                BEST SELLERS</h2>
            <div class="container mx-auto grid xs:grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-10">
                <?php foreach ($bestSellers as $product):
                    renderProductCard(
                        $product['product_id'],
                        $product['product_name'],
                        $product['price'],
                        $product['image_url']
                    );
                endforeach; ?>
            </div>
        </div>
    </section>

    <!--Exclusive Offers Section-->
    <section class="scroll-m-40" id="best-sellers">
        <div class="container mx-auto flex-col space-y-10">
            <h2 class="text-white font-semibold text-4xl">
                EXCLUSIVE OFFERS</h2>
            <div class="container mx-auto grid xs:grid-cols-1
        sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-10">

                <?php foreach ($exclusiveOffers as $product):
                    renderProductCard(
                        $product['product_id'],
                        $product['product_name'],
                        $product['price'],
                        $product['image_url'],
                        number_format($product['discounted_price'], 2)
                    );
                endforeach; ?>
            </div>
        </div>
    </section>
</div>

<script>
    function handleCardClick(productId) {
        window.location.href = 'product/?productId=' + productId; 
    }
</script>