<div class="w-full flex-col justify-center p-10">
    <!-- Back Button -->
    <div class="flex justify-end">
        <a href="products"
            class="bg-white text-black px-5 py-2 rounded-full mb-4 inline-block transition-colors duration-300 hover:bg-opacity-80">
            Back to Product List
        </a>
    </div>
    <div class="flex gap-x-10">
        <!-- Product Details Section -->
        <div class="w-1/3 bg-secondary shadow-md rounded-lg p-6 mb-6 lg:mb-0">
            <h2 class="text-white font-semibold text-3xl mb-4">Product Details</h2>

            <h3 class="text-contentColor1 text-xl font-semibold mb-2">
                <?php echo htmlspecialchars($product['product_name']); ?>
            </h3>
            <p class="text-white text-lg mb-2"><?php echo htmlspecialchars($product['description']); ?></p>
            <p class="text-contentColor1 text-lg font-semibold mb-4">Price:
                <span class="text-white">LKR <?php echo number_format($product['price'], 2); ?></span>
            </p>
            <?php if (isset($discount) && $discount): ?>
                <p class="text-contentColor1 text-lg font-semibold mb-4">Discounted Price:
                    <span class="text-white">LKR <?php echo number_format($discount['discounted_price'], 2); ?></span>
                </p>
                <p class="text-contentColor1 text-lg mb-2">Discount End Date:
                    <span class="text-white"><?php echo htmlspecialchars($discount['end_date']); ?></span>
                </p>
            <?php endif; ?>
            <p class="text-contentColor1 text-lg mb-2">Category:
                <span class="text-white"><?php echo htmlspecialchars($product['category']); ?></span>
            </p>
            <p class="text-contentColor1 text-lg mb-2">Target Gender:
                <span class="text-white"><?php echo htmlspecialchars($product['target_gender']); ?></span>
            </p>
            <p class="text-contentColor1 text-lg mb-2">Status:
                <span class="text-white">
                    <?php echo $product['is_active'] ? 'Listed' : 'Not listed'; ?>
                </span>
            </p>
        </div>

        <!-- Product Variants Section -->
        <div class="w-2/3 bg-secondary shadow-md rounded-lg p-6 overflow-y-auto">
            <h4 class="text-white font-semibold text-3xl mb-4">Product Variants</h4>

            <table class="w-full text-white">
                <thead>
                    <tr class="border-b border-contentColor1">
                        <th class="px-4 py-2 text-left text-md font-semibold text-contentColor1">Color</th>
                        <th class="px-4 py-2 text-left text-md font-semibold text-contentColor1">Size</th>
                        <th class="px-4 py-2 text-left text-md font-semibold text-contentColor1">Quantity</th>
                        <th class="px-4 py-2 text-left text-md font-semibold text-contentColor1">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($productVariants as $variant): ?>
                        <tr>
                            <td class="px-4 py-2 text-sm flex items-center">
                                <?php echo htmlspecialchars($variant['color_name']); ?>
                                <span class="block w-5 h-5 ml-4 rounded"
                                    style="background-color: <?php echo htmlspecialchars($variant['color']); ?>;"></span>
                            </td>
                            <td class="px-4 py-2 text-sm"><?php echo htmlspecialchars($variant['size']); ?></td>
                            <td class="px-4 py-2 text-sm flex items-center">
                                <input type="number" name="quantity" id="quantity-<?php echo $variant['id']; ?>"
                                    value="<?php echo htmlspecialchars($variant['quantity']); ?>"
                                    class="block border border-white px-2 py-1 bg-natural text-white rounded w-20 quantity-input outline-none"
                                    disabled>
                                <button class="ml-2 text-contentColor1 hover:opacity-80 enable-button">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="size-6">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                    </svg>
                                </button>
                            </td>
                            <td class="px-4 py-2 text-sm">
                                <a href="javascript:void(0);"
                                    class="bg-white text-black px-3 py-2 rounded-full transition-colors duration-300 hover:bg-gray-200 text-center inline-block"
                                    onclick="updateQuantity(<?php echo $product['product_id']; ?>, <?php echo $variant['id']; ?>)">Update</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Product Images -->
    <div class="w-full bg-secondary shadow-md rounded-lg p-6 mt-6">
        <h4 class="text-white font-semibold text-3xl mb-4">Product Images</h4>
        <div class="flex gap-x-4">
            <?php foreach ($productImages as $image): ?>
                <div class="relative w-32 h-32 p-4 bg-contentColor1 rounded-lg">
                    <img src="<?php echo htmlspecialchars($image['image_url']); ?>" alt="Product Image"
                        class="w-full h-full object-cover rounded-lg">
                </div>
            <?php endforeach; ?>
        </div>
    </div>



    <script>
        document.addEventListener('DOMContentLoaded', function () {
            document.querySelectorAll('.enable-button').forEach(function (button) {
                button.addEventListener('click', function () {
                    const input = this.previousElementSibling;
                    input.disabled = !input.disabled;
                    if (!input.disabled) {
                        input.focus();
                    }
                });
            });
        });
    </script>


    <script>
        function updateQuantity(productId, variantId) {
            let quantityInput = document.getElementById(`quantity-${variantId}`);
            let quantityValue = quantityInput.value;

            let url = `variant/update?productId=${productId}&productVariantId=${variantId}&quantity=${quantityValue}`;

            fetch(url)
                .then(response => response.text())
                .then(data => {
                    console.log('Quantity updated successfully');
                })
                .catch(error => console.error('Error:', error));
        }

    </script>