<?php
function renderOrderItem($order)
{
    $orderId = htmlspecialchars($order['order_id']);
    $userId = htmlspecialchars($order['user_id']);
    $orderDate = htmlspecialchars($order['order_date']);
    $totalAmount = htmlspecialchars($order['total_amount']);
    $deliveryStatus = htmlspecialchars($order['delivery_status']);
    ?>

    <tr class="border-b border-contentColor1">
        <td class="px-6 py-4 whitespace-nowrap text-sm"><?php echo $orderId; ?></td>
        <td class="px-6 py-4 whitespace-nowrap text-sm"><?php echo $userId; ?></td>
        <td class="px-6 py-4 whitespace-nowrap text-sm"><?php echo $orderDate; ?></td>
        <td class="px-6 py-4 whitespace-nowrap text-sm"><?php echo $totalAmount; ?></td>
        <td class="px-6 py-4 whitespace-nowrap text-sm"><?php echo $deliveryStatus; ?></td>
        <td class="px-6 py-4 whitespace-nowrap text-sm text-center">
            <button type="button" class="text-white" id="order-menu-button-<?php echo $orderId; ?>">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M12 6.75a.75.75 0 1 1 0-1.5.75.75 0 0 1 0 1.5ZM12 12.75a.75.75 0 1 1 0-1.5.75.75 0 0 1 0 1.5ZM12 18.75a.75.75 0 1 1 0-1.5.75.75 0 0 1 0 1.5Z" />
                </svg>
            </button>
            <div class="origin-top-right absolute right-24 mt-2 w-36 rounded-md shadow-lg bg-natural hidden"
                id="order-menu-<?php echo $orderId; ?>">
                <div class="py-1">
                    <a href="orders/details?orderId=<?php echo $orderId; ?>"
                        class="text-white block px-4 py-2 text-sm hover:opacity-75">
                        View
                    </a>
                </div>
            </div>
            <script>
                document.getElementById('order-menu-button-<?php echo $orderId; ?>').addEventListener('click', function () {
                    var menu = document.getElementById('order-menu-<?php echo $orderId; ?>');
                    menu.classList.toggle('hidden');
                });
            </script>
        </td>
    </tr>
    <?php
}
?>