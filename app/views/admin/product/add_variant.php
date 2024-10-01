<?php
require_once BASE_URL . '/app/views/components/dropdown2.php';
require_once BASE_URL . '/app/views/components/numberinput.php';
?>

<div class="w-full flex justify-center items-center p-10">
    <div class="w-full max-w-lg bg-secondary shadow-md rounded-lg p-6">
        <h2 class="text-white font-semibold text-3xl mb-4">Add Product Variant</h2>
        <form id="add-product-variant-form"
            action="<?= HOME_URL ?>/products/add-variant?productId=<?= htmlspecialchars($product['product_id']) ?>"
            method="post" enctype="multipart/form-data">

            <!-- Error Container -->
            <?php if (isset($error) && !empty($error)): ?>
                <div id="error-container" class="mb-4 p-3 bg-red-500 text-white rounded-md">
                    <?= htmlspecialchars($error) ?>
                </div>
            <?php endif; ?>

            <!-- Hidden Product ID -->
            <input type="hidden" name="productId" value="1" />

            <!-- Product Name -->
            <div class="my-4">
                <label for="product_name" class="block text-sm font-medium text-contentColor1">Product Name</label>
                <p
                    class="mt-1 block w-full rounded-md border border-white px-3 py-2 bg-natural text-white sm:text-sm h-10">
                    <?= isset($product['product_name']) ? htmlspecialchars($product['product_name']) : 'N/A' ?>
                </p>
            </div>

            <!-- Color -->
            <div class="my-4">
                <label for="color" class="block text-sm font-medium text-contentColor1">Color</label>
                <?php renderDropdown2('color_dd', 'color', $colors, 1); ?>
            </div>

            <!-- Stock -->
            <div class="my-4">
                <label class="block text-contentColor1 mb-2 text-sm font-medium">Size</label>
                <div class="bg-natural border border-white rounded-md p-4">
                    <div class="space-y-2 text-sm">
                        <?php foreach ($sizes as $size): ?>
                            <div class="flex items-center gap-x-2 text-white">
                                <div class="flex items-center gap-x-4 w-full">
                                    <input type="checkbox" id="size-<?php echo htmlspecialchars($size['id']); ?>"
                                        name="size[]" value="<?php echo htmlspecialchars($size['id']); ?>"
                                        class="text-white size-checkbox"
                                        data-size-id="<?php echo htmlspecialchars($size['id']); ?>" />
                                    <label for="size-<?php echo htmlspecialchars($size['id']); ?>"
                                        class="flex-1"><?php echo htmlspecialchars($size['name']); ?></label>

                                    <!-- Quantity input, initially hidden -->
                                    <div id="quantity-<?php echo htmlspecialchars($size['id']); ?>"
                                        class="quantity-container hidden flex-1">
                                        <input type="number" name="<?= $size['id'] . '_quantity' ?>" min="1" value=""
                                            placeholder="Quantity"
                                            class="block border border-white px-2 py-1 bg-natural text-white rounded w-full outline-none placeholder-contentColor1" />
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>

            <!-- Image Upload -->
            <label class="block text-contentColor1 text-sm font-medium">Images</label>
            <div class="flex py-4 gap-x-4 justify-end">
                <!-- Image Preview Section -->
                <div id="imagePreviewContainer" class="flex space-x-4 overflow-x-auto">
                </div>

                <input type="hidden" id="imageUrls" name="imageUrls" />

                <!-- File Input Section with Upload Icon -->
                <div class="flex w-1/6 justify-stretch">
                    <label for="fileInput"
                        class="cursor-pointer bg-gray-100 p-4 rounded-lg shadow-md flex flex-col items-center justify-center space-y-2 transition duration-150 w-full hover:opacity-90">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M6.827 6.175A2.31 2.31 0 0 1 5.186 7.23c-.38.054-.757.112-1.134.175C2.999 7.58 2.25 8.507 2.25 9.574V18a2.25 2.25 0 0 0 2.25 2.25h15A2.25 2.25 0 0 0 21.75 18V9.574c0-1.067-.75-1.994-1.802-2.169a47.865 47.865 0 0 0-1.134-.175 2.31 2.31 0 0 1-1.64-1.055l-.822-1.316a2.192 2.192 0 0 0-1.736-1.039 48.774 48.774 0 0 0-5.232 0 2.192 2.192 0 0 0-1.736 1.039l-.821 1.316Z" />
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M16.5 12.75a4.5 4.5 0 1 1-9 0 4.5 4.5 0 0 1 9 0ZM18.75 10.5h.008v.008h-.008V10.5Z" />
                        </svg>

                        <span class="text-sm text-natural">Upload</span>
                        <input type="file" id="fileInput" name="image[]" accept="image/*" class="hidden" multiple>
                    </label>
                </div>
            </div>

            <!-- Submit Button -->
            <div class="flex justify-end mt-5">
                <button type="submit" class="bg-white text-black px-10 py-2 rounded-full">ADD</button>
            </div>
        </form>
    </div>
</div>

<script type="module" src="<?= HOME_URL ?>/public/assets/js/add-image.js"></script>


<script>
    document.querySelectorAll('.size-checkbox').forEach(function (checkbox) {
        checkbox.addEventListener('change', function () {
            var sizeId = this.getAttribute('data-size-id');
            var quantityContainer = document.getElementById('quantity-' + sizeId);

            if (this.checked) {
                quantityContainer.classList.remove('hidden');
            } else {
                quantityContainer.classList.add('hidden');
                quantityContainer.querySelector('input').value = '';
            }
        });
    });

</script>