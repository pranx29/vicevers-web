<?php

function renderOrderCard($order)
{
    ?>
    <div class="cart-item flex justify-between items-center gap-y-5 bg-secondary p-5 rounded-3xl">
        <div class="w-[90%] flex justify-around">
            <p class="text-white"><?= htmlspecialchars($order['order_id']) ?></p>
            <p class="text-white"><?= htmlspecialchars($order['order_date']) ?></p>
            <p class="text-white"><?= htmlspecialchars($order['delivery_status']) ?></p>
            <p class="text-white"><?= htmlspecialchars($order['total_amount']) ?></p>
        </div>
        <div>
            <button onclick="getOrderDetails(<?= $order['order_id'] ?>)"
                class="view-button text-white rounded-lg underline transition-opacity duration-300 hover:opacity-80">View
                Order
            </button>
        </div>
    </div>

    <?php
}

