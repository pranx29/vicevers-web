<?php
function renderCartItem($cartItemId, $imageUrl, $productName, $price, $color, $size, $quantity, $discountedPrice)
{
    ?>
    <div class="cart-item flex justify-between items-center gap-y-5 bg-secondary p-5 rounded-3xl"
        data-cart-item-id="<?= htmlspecialchars($cartItemId); ?>"
        data-discounted-price="<?php echo htmlspecialchars($discountedPrice); ?>"
        data-price="<?php echo htmlspecialchars($price); ?>">
        <div class="flex gap-x-5 w-[25%]">
            <div>
                <img src="<?php echo htmlspecialchars($imageUrl); ?>" alt="product" class="w-24 h-24 object-contain">
            </div>
            <div class="flex-1 text-contentColor1">
                <h4 class="font-bold text-contentColor1"><?php echo htmlspecialchars($productName); ?></h4>
                <p class="price font-medium text-contentColor1">
                    Price:
                    <?php if ($discountedPrice !== null): ?>
                        <span class="line-through text-contentColor1"><?php echo htmlspecialchars($price); ?></span>
                        <span class="text-white"><?php echo htmlspecialchars($discountedPrice); ?></span>
                    <?php else: ?>
                        <?php echo htmlspecialchars($price); ?>
                    <?php endif; ?>
                </p>
                <p class="font-medium text-contentColor1">Color: <?php echo htmlspecialchars($color); ?></p>
                <p class="font-medium text-contentColor1">Size: <?php echo htmlspecialchars($size); ?></p>
            </div>
        </div>

        <div class="flex w-[65%] justify-around">
            <div
                class="quantity-control flex items-center p-2 border border-white rounded-md shadow-sm text-contentColor1 text-xs w-24 justify-between">
                <button class="decrement-button w-4 h-4 items-center rounded-md text-xl flex justify-center">-</button>
                <input id="quantity" type="text" value="<?php echo htmlspecialchars($quantity); ?>"
                    class="quantity-input w-4 text-center bg-transparent" readonly>
                <button class="increment-button w-4 h-4 items-center rounded-md text-xl flex justify-center">+</button>
            </div>
            <div class="total-amount text-contentColor1">
                <p id="">
                    LKR
                    <?php
                    if ($discountedPrice !== null) {
                        echo htmlspecialchars($discountedPrice * $quantity);
                    } else {
                        echo htmlspecialchars($price * $quantity);
                    }
                    ?>
                </p>
            </div>
        </div>
        <div class="w-[10%]">
            <button class="remove-button text-white rounded-lg underline">Remove</button>
        </div>
    </div>
    <?php
}

function renderCartItem2($cartItem)
{ ?>
    <div class="order-item flex justify-between items-center gap-5 bg-secondary p-5 rounded-3xl"
        data-price="<?= htmlspecialchars($cartItem['price']) ?>"
        data-discounted-price="<?= htmlspecialchars($cartItem['discounted_price']) ?>"
        data-quantity="<?= htmlspecialchars($cartItem['quantity']) ?>">
        <div class="flex items-start gap-5">
            <img src="<?= htmlspecialchars($cartItem['image_url']) ?>" alt="Product Image" class="w-16 h-16 object-contain">
            <div class="flex flex-col text-contentColor1 items-start justify-start">
                <h4 class="text-contentColor1"><?= htmlspecialchars($cartItem['product_name']) ?></h4>
                <p class="details font-medium">
                    <?= htmlspecialchars($cartItem['color_name']) . ' | ' . htmlspecialchars($cartItem['size_label']) . ' | ' . htmlspecialchars($cartItem['quantity']) . ' Units' ?>
                </p>
            </div>
        </div>
        <h4 class="text-contentColor1">
            <?php if (isset($cartItem['discounted_price']) && $cartItem['discounted_price'] !== null): ?>
                <span class="line-through text-contentColor1"><?= htmlspecialchars($cartItem['price']) ?></span>
                <span class="text-white"><?= htmlspecialchars($cartItem['discounted_price']) ?></span>
            <?php else: ?>
                <?= htmlspecialchars($cartItem['price']) ?>
            <?php endif; ?>
        </h4>
    </div>
    <?php
}


