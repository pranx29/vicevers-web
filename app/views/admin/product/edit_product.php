<?php
require_once BASE_URL . '/app/views/components/dropdown2.php';
?>
<div class="w-full flex justify-center items-center p-10">
    <div class="w-full max-w-lg bg-secondary shadow-md rounded-lg p-6">
        <h2 class="text-white font-semibold text-3xl mb-4">Edit Product</h2>
        <form id="editProductForm" action="" method="POST">

            <!-- Error Container -->
            <?php if (isset($error) && !empty($error)): ?>
            <div id="errorContainer" class="mb-4 p-3 bg-red-500 text-white rounded-md">
                <?= htmlspecialchars($error) ?>
            </div>
            <?php endif; ?>

            <!-- Hidden Product ID -->
            <input type="hidden" name="productId" value="<?= isset($product['product_id']) ? htmlspecialchars($product['product_id']) : '' ?>">

            <!-- Product Name -->
            <div class="my-4">
                <label for="productName" class="block text-sm font-medium text-contentColor1">Product Name</label>
                <input type="text" id="productName" name="productName" required
                    value="<?= isset($product['product_name']) ? htmlspecialchars($product['product_name']) : '' ?>"
                    class="mt-1 block w-full max-w-md rounded-md border border-white px-3 py-2 bg-natural text-white sm:text-sm outline-none placeholder-white h-10">
            </div>

            <!-- Description -->
            <div class="my-4">
                <label for="description" class="block text-sm font-medium text-contentColor1">Description</label>
                <textarea id="description" name="description" required
                    class="mt-1 block w-full max-w-md rounded-md border border-white px-3 py-2 bg-natural text-white sm:text-sm outline-none placeholder-white h-24"><?= isset($product['description']) ? htmlspecialchars($product['description']) : '' ?></textarea>
            </div>

            <!-- Category -->
            <div class="my-4 max-w-md">
                <label for="category" class="block text-sm font-medium text-contentColor1">Category</label>
                <?php renderDropdown2('category_dd', 'category', $categories, isset($product['category_id']) ? $product['category_id'] : 1); ?>
            </div>

            <!-- Target Gender -->
            <div class="my-4 max-w-md">
                <label for="gender" class="block text-sm font-medium text-contentColor1">Target Gender</label>
                <?php 
                $selectedGender = isset($product['target_gender']) ? $product['target_gender'] : 1;
                if ($genders[0]['name'] == $selectedGender) {
                    $selectedGender = $genders[0]['id'];
                } else{
                    $selectedGender = $genders[1]['id'];
                }
                renderDropdown2('gender_dd', 'gender', $genders, $selectedGender); 
                ?>
            </div>

            <!-- Price -->
            <div class="my-4">
                <label for="price" class="block text-sm font-medium text-contentColor1">Price</label>
                <input type="number" id="price" name="price" required min="1"
                    value="<?= isset($product['price']) ? htmlspecialchars($product['price']) : '' ?>"
                    class="mt-1 block w-full max-w-md rounded-md border border-white px-3 py-2 bg-natural text-white sm:text-sm outline-none placeholder-white h-10">
            </div>

            <!-- Publish on website -->
            <div class="my-4 flex items-center gap-5">
                <label for="publish" class="block text-sm font-medium text-contentColor1">Publish on website</label>
                <input type="checkbox" id="publish" name="isActive" value="1" <?= isset($product['is_active']) && $product['is_active'] ? 'checked' : '' ?> class="text-white text-2xl" />
            </div>

            <!-- Button -->
            <div class="flex justify-end mt-6">
                <button type="submit" class="bg-white text-black px-10 py-2 rounded-full">UPDATE</button>
            </div>
        </form>
    </div>
</div>
