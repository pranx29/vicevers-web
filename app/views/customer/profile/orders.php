<?php
require_once BASE_URL . '/app/views/components/order-card.php';
?>

<div class="px-20 py-10 space-y-10">
    <div>
        <div class="cart-header flex flex-col gap-y-1 pb-5">
            <div class="cart-header flex text-contentColor1 justify-around w-[90%]">
                <h5>Order ID</h5>
                <h5>Date</h5>
                <h5>Delivery Status</h5>
                <h5>Total Amount</h5>
            </div>
            <div class="seperator w-full h-[1px] bg-contentColor1"></div>
        </div>
        <div class="cart-item-container flex gap-y-5 flex-col max-h-[calc(4*160px)] overflow-y-auto">

            <?php foreach ($orders as $order): ?>
                <?php renderOrderCard($order) ?>
            <?php endforeach; ?>

        </div>
    </div>
</div>

<div id="order-overlay"
    class="overlay fixed inset-0 bg-black bg-opacity-50 z-50 hidden transition-opacity duration-300 ease-in-out">
    <div class="w-full h-full flex items-center justify-center">
        <div class="w-1/2 bg-secondary shadow-md rounded-lg p-6 " id="order-details-container">
            <div class="flex justify-end mb-4">
                <button onclick="toggleOverlay()" class="focus:outline-none">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <div id="order-details"></div>
        </div>
    </div>
</div>

<script>
    function toggleOverlay() {
        const overlay = document.getElementById('order-overlay');
        const isVisible = !overlay.classList.contains('hidden');

        overlay.classList.toggle('hidden');
        document.body.style.overflow = isVisible ? 'auto' : 'hidden';
    };

    function getOrderDetails(orderId) {
        fetch(`account/order-detail?orderId=${orderId}`)
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    const orderDetails = `
                        <h2 class="text-white font-thin text-3xl mb-4">Order Details</h2>
                        <p class="text-contentColor1 font-semibold mb-2">Order ID: <span class=text-white>${data.order.order_id}</span></p>
                        <p class="text-contentColor1 font-semibold mb-2">Date: <span class="text-white">${data.order.order_date}</span></p>
                        <p class="text-contentColor1 font-semibold mb-2">Total Amount: <span class="text-white">LKR ${parseFloat(data.order.total_amount).toFixed(2)}</span></p>
                        <p class="text-contentColor1 font-semibold mb-4">Order Status: <span class="text-white">${data.order.status}</span></p>

                        <h4 class="text-white font-thin text-2xl mb-4">Order Items</h4>
                        <table class="w-full text-white mb-4">
                            <thead>
                                <tr class="border-b border-contentColor1">
                                    <th class="px-4 py-2 text-left text-contentColor1">Product Name</th>
                                    <th class="px-4 py-2 text-left text-contentColor1">Color</th>
                                    <th class="px-4 py-2 text-left text-contentColor1">Size</th>
                                    <th class="px-4 py-2 text-left text-contentColor1">Quantity</th>
                                    <th class="px-4 py-2 text-left text-contentColor1">Value</th>
                                </tr>
                            </thead>
                            <tbody>
                                ${data.orderItems.map(item => `
                                    <tr>
                                        <td class="px-4 py-2 text-sm"><span class="text-white">${item.product_name}</span></td>
                                        <td class="px-4 py-2 text-sm"><span class="text-white">${item.color}</span></td>
                                        <td class="px-4 py-2 text-sm"><span class="text-white">${item.size}</span></td>
                                        <td class="px-4 py-2 text-sm"><span class="text-white">${item.quantity}</span></td>
                                        <td class="px-4 py-2 text-sm"><span class="text-white">LKR ${parseFloat(item.value).toFixed(2)}</span></td>
                                    </tr>
                                `).join('')}
                            </tbody>
                        </table>

                        <div class="flex justify-end">
                            <table class="text-white">
                                <tbody>
                                    <tr class="border-t border-contentColor1">
                                        <td class="px-4 py-2 text-right text-contentColor1">Subtotal:</td>
                                        <td class="px-4 py-2 text-sm text-white">LKR ${parseFloat(data.order.total_amount - 399).toFixed(2)}</td>
                                    </tr>
                                    <tr>
                                        <td class="px-4 py-2 text-right text-contentColor1">Delivery Charge:</td>
                                        <td class="px-4 py-2 text-sm text-white">LKR 399</td>
                                    </tr>
                                    <tr>
                                        <td class="px-4 py-2 text-right text-contentColor1">Total:</td>
                                        <td class="px-4 py-2 text-sm text-white">LKR ${(parseFloat(data.order.total_amount)).toFixed(2)}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    `;

                    document.getElementById('order-details').innerHTML = orderDetails;
                    toggleOverlay();
                } else {
                    alert(data.message); // Show an alert if there's an error
                }
            })
            .catch(error => {
                console.error('Error fetching order details:', error);
            });
    }
</script>