<div class="w-full pr-5 py-10">
    <!-- Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6 mb-8">
        <div class="bg-secondary p-6 shadow rounded-lg text-center">
            <h3 class="text-lg font-semibold text-contentColor1">Total Orders</h3>
            <p class="mt-2 text-2xl font-bold text-white"><?= $totalOrders ?></p>
        </div>
        <div class="bg-secondary p-6 shadow rounded-lg text-center">
            <h3 class="text-lg font-semibold text-contentColor1">Total Customers</h3>
            <p class="mt-2 text-2xl font-bold text-white"><?= $totalCustomers ?></p>
        </div>
        <div class="bg-secondary p-6 shadow rounded-lg text-center">
            <h3 class="text-lg font-semibold text-contentColor1">Total Sales</h3>
            <p class="mt-2 text-2xl font-bold text-white">LKR <?= number_format($totalSales, 2) ?></p>
        </div>
        <div class="bg-secondary p-6 shadow rounded-lg text-center">
            <h3 class="text-lg font-semibold text-contentColor1">Total Products</h3>
            <p class="mt-2 text-2xl font-bold text-white"><?= $totalProducts ?></p>
        </div>
    </div>

    <!-- Best Sellers Table -->
    <div class="bg-secondary shadow-md rounded-lg p-6 mb-8">
        <h2 class="text-white font-semibold text-3xl mb-4">BEST SELLERS</h2>
        <table class="min-w-full table-auto text-contentColor1">
            <thead>
                <tr class="border-b border-contentColor1">
                    <th class="px-6 py-3 text-left text-md font-semibold">Product Name</th>
                    <th class="px-6 py-3 text-left text-md font-semibold">Price</th>
                    <th class="px-6 py-3 text-left text-md font-semibold">Sold</th>
                    <th class="px-6 py-3 text-left text-md font-semibold">Sales</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($bestSellers as $product): ?>
                    <tr class="text-white">
                        <td class="px-6 py-4 "><?= $product['name'] ?></td>
                        <td class="px-6 py-4">LKR <?= number_format($product['price'], 2) ?></td>
                        <td class="px-6 py-4"><?= $product['sold'] ?></td>
                        <td class="px-6 py-4">LKR <?= number_format($product['sales'], 2) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <div class="flex gap-x-10 mb-8">
        <!-- Low Stock Products Table -->
        <div class="bg-secondary shadow-md rounded-lg p-6">
            <h2 class="text-white font-semibold text-3xl mb-4">LOW STOCK PRODUCTS</h2>
            <table class="min-w-full table-auto text-contentColor1">
                <thead>
                    <tr class="border-b border-contentColor1 ">
                        <th class="px-6 py-3 text-left text-md font-semibold">Product Name</th>
                        <th class="px-6 py-3 text-left text-md font-semibold">Color</th>
                        <th class="px-6 py-3 text-left text-md font-semibold">Size</th>
                        <th class="px-6 py-3 text-left text-md font-semibold">Quantity Left</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($lowStockProducts as $product): ?>
                        <tr class="border-b border-contentColor1 "></tr>
                        <td class="px-6 py-4 text-white"><?= $product['name'] ?></td>
                        <td class="px-6 py-4 text-white"><?= $product['color'] ?></td>
                        <td class="px-6 py-4 text-white"><?= $product['size'] ?></td>
                        <td class="px-6 py-4 text-white"><?= $product['quantity_left'] ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <!-- Monthly Sales Table -->
        <div class="bg-secondary shadow-md rounded-lg p-6">
            <h2 class="text-white font-semibold text-3xl mb-4">MONTHLY SALES</h2>
            <table class="min-w-full table-auto text-contentColor1">
                <thead>
                    <tr class="border-b border-contentColor1">
                        <th class="px-6 py-3 text-left text-md font-semibold">Month</th>
                        <th class="px-6 py-3 text-left text-md font-semibold">Sales</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($monthlySales as $month): ?>
                        <tr class="border-b border-white"></tr>
                        <td class="px-6 py-4 text-white"><?= $month['order_month'] ?></td>
                        <td class="px-6 py-4 text-white">LKR <?= number_format($month['sales'], 2) ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>