<?php
require_once BASE_URL . '/app/views/components/dropdown2.php';
require_once BASE_URL . '/app/views/components/cart_item.php';

$optionsA = [];
foreach ($contactinfo as $index => $info) {
    $address = $info['street'] . ', ' . $info['city'] . ', ' . $info['postal_code'];
    $optionsA[] = [
        'id' => $info['contact_id'],
        'name' => $address,
    ];
}

?>

<div class="p-20 flex ">
    <div class="checkout-details w-1/2">
        <form class="flex justify-between flex-col gap-y-5" id="checkout-form" action="<?= HOME_URL ?>checkout/cart"
            method="POST">
            <h2 class="text-white font-semibold text-4xl">CHECKOUT</h2>
            <div class="flex flex-col gap-y-5 bg-secondary rounded-2xl p-5 w-[75%]">
                <h3 class="text-white font-thin text-3xl">DELIVERY</h3>
                <div class="account-container">
                    <h5 class="text-contentColor1 font-semibold">Account</h5>
                    <p class="text-white">
                        <?= htmlspecialchars($user['email']) ?>
                    </p>
                </div>

                <div class="address-container space-y-2">
                    <h5 class="text-contentColor1 font-semibold">Ship To</h5>
                    <?php if (!empty($optionsA)): ?>
                        <?php renderDropdown2('addressDD', 'address', $optionsA, $optionsA[0]['id']); ?>
                        <?php else: ?>
                            <a href="<?= HOME_URL ?>account" class="bg-white text-black px-5 py-3 rounded-full transition-colors duration-300 hover:bg-opacity-80 w-full text-center block">
                                Add Address
                            </a>
                        <?php endif; ?>
                </div>
                <div class="shipping-container space-y-2">
                    <h5 class="text-contentColor1 font-semibold">Shipping Method</h5>
                    <div
                        class="flex justify-between items-center w-full rounded-md border border-white bg-natural px-4 py-2 text-sm font-medium text-white">
                        <div>
                            <p>Standard</p>
                            <p>2-3 Business Days</p>
                            <input type="hidden" name="shippingMethod" value="Standard">
                        </div>
                        <p id="shipping-method" data-price="399">LKR 399</p>
                    </div>
                </div>
                <h3 class="text-white font-thin text-3xl mt-5">PAYMENT</h3>
                <div>
                    <label for="cardHolder" class="block text-sm font-medium text-contentColor1">Card Holder</label>
                    <input type="text" name="cardHolder" id="cardHolder" required
                        class="mt-2 block w-full rounded-md border border-white px-3 py-2 bg-natural text-white sm:text-sm outline-none placeholder-white h-10"
                        pattern="[A-Za-z\s]+" title="Card holder name can contain only letters and spaces">
                </div>
                <div>
                    <label for="cardNumber" class="block text-sm font-medium text-contentColor1">Card Number</label>
                    <input type="text" name="cardNumber" id="cardNumber" required
                        class="mt-2 block w-full rounded-md border border-white px-3 py-2 bg-natural text-white sm:text-sm outline-none placeholder-white h-10"
                        pattern="\d{16}" title="Card number must be 16 digits">
                </div>
                <div class="flex space-x-4 mb-4">
                    <div class="flex-1">
                        <label for="expirationDate" class="block text-sm font-medium text-contentColor1">Expiration
                            Date</label>
                        <input type="text" id="expirationDate" name="expirationDate" required
                            class="mt-2 block w-full rounded-md border border-white px-3 py-2 bg-natural text-white sm:text-sm outline-none placeholder-white h-10"
                            pattern="\d{2}/\d{2}" title="Expiration date must be in MM/YY format">
                    </div>
                    <div class="flex-1">
                        <label for="cvv" class="block text-sm font-medium text-contentColor1">CVV</label>
                        <input type="text" id="cvv" name="cvv" required
                            class="mt-2 block w-full rounded-md border border-white px-3 py-2 bg-natural text-white sm:text-sm outline-none placeholder-white h-10"
                            pattern="\d{3}" title="CVV must be 3 digits">
                    </div>
                </div>
            </div>
            <div class="flex flex-col w-[75%]">
                <button type="submit"
                    class="bg-white text-black px-5 py-3 rounded-full transition-colors duration-300 hover:bg-opacity-80 w-full text-center">
                    PAY NOW
                </button>
            </div>
        </form>
    </div>


    <div class="order-details w-1/2 space-y-5">
        <h3 class="text-white font-thin text-3xl mt-20">ORDER SUMMARY</h3>
        <div class="order-item-container flex gap-y-5 flex-col max-h-[calc(4*100px)] overflow-y-auto">
            <?php
            foreach ($cartItems as $item) {
                renderCartItem2($item);
            }
            ?>
        </div>
        <div class="flex flex-col gap-y-2">
            <div class="flex justify-between text-contentColor1">
                <h4>Subtotal</h4>
                <p id="subtotal">LKR 0.00</p>
            </div>
            <div class="flex justify-between text-contentColor1">
                <h4>Shipping</h4>
                <p id="shipping">LKR 0.00</p>
            </div>
            <div class="flex justify-between text-contentColor1 font-semibold">
                <h4>Total</h4>
                <p id="total">LKR 0.00</p>
            </div>
        </div>
        <!-- Error Container -->
        <?php if (isset($error) && !empty($error)): ?>
            <div id="error-container" class="mb-4 p-3 bg-red-500 text-white rounded-md">
                <?= htmlspecialchars($error) ?>
            </div>
        <?php endif; ?>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        let subtotal = 0;
        const items = document.querySelectorAll('.order-item');

        items.forEach(item => {
            let price = parseFloat(item.getAttribute('data-price').replace('LKR ', ''));
            const quantity = parseInt(item.getAttribute('data-quantity'));
            const discountedPrice = item.getAttribute('data-discounted-price');
            if (discountedPrice !== null && !isNaN(parseFloat(discountedPrice))) {
                price = parseFloat(discountedPrice);
                console.log(price);
            }
            subtotal += price * quantity;
        });


        let shippingCost = parseFloat(document.getElementById('shipping-method').getAttribute('data-price'));
        const total = subtotal + shippingCost;

        document.getElementById('subtotal').textContent = 'LKR ' + subtotal.toFixed(2);
        document.getElementById('shipping').textContent = 'LKR ' + shippingCost.toFixed(2);
        document.getElementById('total').textContent = 'LKR ' + total.toFixed(2);
    });
</script>