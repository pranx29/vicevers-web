<div class="w-full flex-col justify-center p-10">
    <!-- Back Button -->
    <div class="flex justify-end">
        <a href="orders"
            class="bg-white text-black px-5 py-2 rounded-full mb-4 inline-block transition-colors duration-300 hover:bg-opacity-80">
            Back to Order List
        </a>
    </div>
    <div class="flex gap-x-10">
        <!-- Order Details Section -->
        <div class="w-1/3 bg-secondary shadow-md rounded-lg p-6 mb-6 lg:mb-0">
            <h2 class="text-white font-semibold text-3xl mb-4">Order Details</h2>

            <h3 class="text-contentColor1 font-semibold mb-2">
                Order ID: <?php echo htmlspecialchars($order['order_id']); ?>
            </h3>
            <p class="text-contentColor1 font-semibold mb-2">Date: <?php echo htmlspecialchars($order['order_date']); ?>
            </p>
            <p class="text-contentColor1 font-semibold mb-2">Total Amount:
                <span class="text-white">LKR <?php echo number_format($order['total_amount'], 2); ?></span>
            </p>
            <p class="text-contentColor1 font-semibold mb-2">Order Status:
                <span class="text-white"><?php echo htmlspecialchars($order['status']); ?></span>
            </p>
        </div>

        <!-- Order Items Section -->
        <div class="w-2/3 bg-secondary shadow-md rounded-lg p-6 overflow-y-auto">
            <h4 class="text-white font-semibold text-3xl mb-4">Order Items</h4>

            <table class="w-full text-white">
                <thead>
                    <tr class="border-b border-contentColor1">
                        <th class="px-4 py-2 text-left text-md font-semibold text-contentColor1">Product Name</th>
                        <th class="px-4 py-2 text-left text-md font-semibold text-contentColor1">Color</th>
                        <th class="px-4 py-2 text-left text-md font-semibold text-contentColor1">Size</th>
                        <th class="px-4 py-2 text-left text-md font-semibold text-contentColor1">Quantity</th>
                        <th class="px-4 py-2 text-left text-md font-semibold text-contentColor1">Value</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($orderItems as $item): ?>
                        <tr>
                            <td class="px-4 py-2 text-sm"><?php echo htmlspecialchars($item['product_name']); ?></td>
                            <td class="px-4 py-2 text-sm"><?php echo htmlspecialchars($item['color']); ?></td>
                            <td class="px-4 py-2 text-sm"><?php echo htmlspecialchars($item['size']); ?></td>
                            <td class="px-4 py-2 text-sm"><?php echo htmlspecialchars($item['quantity']); ?></td>
                            <td class="px-4 py-2 text-sm">LKR <?php echo number_format($item['value'], 2); ?></td>
                        </tr>
                    <?php endforeach; ?>
                    <tr class="border-t border-contentColor1">
                        <td colspan="4" class="px-4 py-2 text-right text-md font-semibold text-contentColor1">Subtotal:
                        </td>
                        <td class="px-4 py-2 text-sm">LKR <?php echo number_format($order['total_amount'], 2); ?></td>
                    </tr>
                    <tr>
                        <td colspan="4" class="px-4 py-2 text-right text-md font-semibold text-contentColor1">Delivery
                            Charge:</td>
                        <td class="px-4 py-2 text-sm">LKR 399</td>
                    </tr>
                    <tr>
                        <td colspan="4" class="px-4 py-2 text-right text-md font-semibold text-contentColor1">Total:
                        </td>
                        <td class="px-4 py-2 text-sm">LKR <?php echo number_format($order['total_amount'] + 399, 2); ?>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Delivery Details -->
    <div class="w-full bg-secondary shadow-md rounded-lg p-6 mt-6">
        <h4 class="text-white font-semibold text-3xl mb-4">Delivery Details</h4>
        <div class=" text-white">
            <p class="mb-2">Customer Name:
                <?php echo htmlspecialchars($delivery['first_name'] . ' ' . $delivery['last_name']); ?>
            </p>
            <p class="mb-2">Address: <?php echo htmlspecialchars($delivery['street']); ?></p>
            <p class="mb-2">City: <?php echo htmlspecialchars($delivery['city']); ?></p>
            <p class="mb-2">Postal Code: <?php echo htmlspecialchars($delivery['postal_code']); ?></p>
            <p class="mb-2">Delivery Status:
                <span class="text-white"><?php echo htmlspecialchars($delivery['status']); ?></span>
            </p>
            <?php if ($delivery['status'] == 'Pending'): ?>
                <a href="orders/update?orderId=<?php echo $order['order_id']; ?>&status=Shipped"
                    class="bg-white text-black px-3 py-1 rounded-full mb-4 inline-block transition-colors duration-300 hover:bg-opacity-80 mt-2">
                    Mark as Shipped
                </a>
            <?php elseif ($delivery['status'] == 'Shipped'): ?>
                <a href="orders/update?orderId=<?php echo $order['order_id']; ?>&status=Delivered"
                    class="bg-white text-black px-3 py-1 rounded-full mb-4 inline-block transition-colors duration-300 hover:bg-opacity-80 mt-2">
                    Mark as Delivered
                </a>
            <?php endif; ?>
            </p>
        </div>
    </div>
</div>
