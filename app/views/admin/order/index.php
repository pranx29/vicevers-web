<div class="w-full h-screen flex justify-center p-10 gap-x-5">
    <!-- Display All Orders in Table -->
    <div class="w-full h-full bg-secondary shadow-md rounded-lg p-6 overflow-y-auto">
        <h2 class="text-white font-semibold text-3xl mb-4">Order List</h2>
        <table class="min-w-full table-auto text-white rounded-lg">
            <thead>
                <tr class="border-b border-contentColor1">
                    <th class="px-6 py-3 text-left text-md font-semibold text-contentColor1">Order ID</th>
                    <th class="px-6 py-3 text-left text-md font-semibold text-contentColor1">User ID</th>
                    <th class="px-6 py-3 text-left text-md font-semibold text-contentColor1">Order Date</th>
                    <th class="px-6 py-3 text-left text-md font-semibold text-contentColor1">Total Amount</th>
                    <th class="px-6 py-3 text-left text-md font-semibold text-contentColor1">Delivery Status</th>
                    <th class="px-6 py-3 text-md font-semibold text-contentColor1 text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                require_once BASE_URL . '/app/views/components/order-item.php';
                foreach ($orders as $order) {
                    renderOrderItem($order);
                }
                ?>
            </tbody>
        </table>
    </div>
</div>
