<div class="w-full flex justify-center items-start p-10 gap-x-10">
    <div class="w-full max-w-lg bg-secondary shadow-md rounded-lg p-6">
        <h2 class="text-white font-semibold text-3xl mb-4">ADD DISCOUNT</h2>
        <form action="" method="POST">
            <input type="hidden" name="product_id" value="<?= htmlspecialchars($product['product_id']) ?>" />

            <!-- Error Container -->
            <?php if (isset($error) && !empty($error)): ?>
                <div id="error-container" class="mb-4 p-3 bg-red-500 text-white rounded-md">
                    <?= htmlspecialchars($error) ?>
                </div>
            <?php endif; ?>

            <!-- Product Name -->
            <div class="my-4">
                <label for="product_name" class="block text-sm font-medium text-contentColor1">Product Name</label>
                <p
                    class="mt-1 block w-full rounded-md border border-white px-3 py-2 bg-natural text-white sm:text-sm h-10">
                    <?= isset($product['product_name']) ? htmlspecialchars($product['product_name']) : 'N/A' ?>
                </p>
            </div>

            <div class="grid grid-cols-1 gap-4 text-sm">
                <div>
                    <label for="discount_percentage" class="block text-sm font-medium text-contentColor1">Discount
                        Percentage (%)</label>
                    <input type="number" id="discount_percentage" name="discount_percentage" min="0" max="100"
                        step="0.1" required
                        class="mt-1 block w-full rounded-md border border-white px-3 py-2 bg-natural text-white sm:text-sm h-10 focus:outline-none">
                </div>

                <div>
                    <label for="start_date" class="block text-sm font-medium text-contentColor1">Start Date</label>
                    <input type="date" id="start_date" name="start_date" required
                        class="block border border-white px-2 pt-2 bg-natural text-white rounded w-full outline-none placeholder-contentColor1">
                </div>

                <div>
                    <label for="end_date" class="block text-sm font-medium text-contentColor1">End Date</label>
                    <input type="date" id="end_date" name="end_date" required
                        class="block border border-white px-2 pt-2 bg-natural text-white rounded w-full outline-none placeholder-contentColor1">
                </div>

                <div class="flex items-center">
                    <input type="checkbox" id="is_active" name="is_active" value="1" class="mr-2 leading-tight" checked>
                    <label for="is_active" class="text-contentColor1">Is Active</label>
                </div>
            </div>

            <div class="flex justify-end mt-5">
                <button type="submit" class="bg-white text-black px-10 py-2 rounded-full">Add Discount</button>
            </div>
        </form>
    </div>
    <div class="w-full bg-secondary shadow-md rounded-lg p-6 mb-6">
        <h2 class="text-white font-semibold text-3xl mb-4">DISCOUNT HISTORY</h2>
        <table class="w-full text-white">
            <thead>
                <tr class="border-b border-white">
                    <th class="p-2 text-left">Percentage</th>
                    <th class="p-2 text-left">Start Date</th>
                    <th class="p-2 text-left">End Date</th>
                    <th class="p-2 text-left">Active</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($discounts)): ?>
                    <?php foreach ($discounts as $discount): ?>
                        <tr>
                            <td class="p-2"><?= htmlspecialchars($discount['discount_percentage']) ?>%</td>
                            <td class="p-2"><?= htmlspecialchars($discount['start_date']) ?></td>
                            <td class="p-2"><?= htmlspecialchars($discount['end_date']) ?></td>
                            <td class="p-2"><?= $discount['is_active'] ? 'Yes' : 'No' ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="4" class="border-b border-white p-2 text-center">No discount history available.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

</div>