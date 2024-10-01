<?php
function renderProductDetails($product)
{
    $productId = htmlspecialchars($product['product_id']);
    $name = htmlspecialchars($product['product_name']);
    $price = htmlspecialchars($product['price']);
    $description = htmlspecialchars($product['description']);
    $discountedPrice = $product['discounted_price'];
    $colors = $product['colors'];
    $sizes = $product['sizes'];
    ?>
    <div id="product" class="product-details-container flex flex-col space-y-5"
        data-product-id="<?= htmlspecialchars($productId) ?>">
        <div class="text-contentColor1">
            <h2 class="font-semibold text-4xl"><?php echo $name; ?></h2>
            <?php if ($discountedPrice): ?>
                <p class="font-semibold text-3xl">
                    <span class="line-through"><?php echo $price; ?></span>
                    <span class="text-white"><?php echo htmlspecialchars($discountedPrice)?></span>
                </p>
            <?php else: ?>
                <p class="font-semibold text-3xl"><?php echo $price; ?></p>
            <?php endif; ?>
        </div>
        <p class="text-white font-thin text-2xl"><?php echo $description; ?></p>

        <div class="color-container flex flex-col gap-y-2 font-semibold text-xl">
            <span class="text-contentColor1">Color</span>
            <div class="flex gap-x-2">
                <?php foreach ($colors as $color): ?>
                    <label>
                        <input type="radio" name="color" class="hidden peer" value="<?= htmlspecialchars($color['id']) ?>">
                        <div class="w-10 h-10 rounded-sm peer-checked:border peer-checked:border-white"
                            style="background-color: <?= htmlspecialchars($color['color_code']) ?>"></div>
                    </label>
                <?php endforeach; ?>
            </div>
        </div>

        <div class="size-container flex flex-col gap-y-2 font-semibold text-xl text-contentColor1">
            <span>Size</span>
            <div class="flex gap-x-2">
                <?php foreach ($sizes as $size): ?>
                    <label>
                        <input type="radio" name="size" class="hidden peer" value="<?= htmlspecialchars($size['id']) ?>">
                        <div
                            class="text-xl font-normal w-10 h-10 rounded-sm border border-white peer-checked:bg-white peer-checked:text-black flex justify-center items-center peer-default:text-white">
                            <?= htmlspecialchars($size['name']) ?>
                        </div>
                    </label>
                <?php endforeach; ?>
            </div>
        </div>

        <div class="stock-status">
            <p class="text-white font-semibold text-xl">In stock</p>
        </div>

        <div>
            <button onclick="handleAddToCartClick()"
                class="bg-white text-black px-5 py-3 rounded-full transition-colors duration-300 hover:bg-opacity-80 w-full flex justify-center items-center">ADD
                TO CART</button>
        </div>
    </div>
    <?php
}
?>