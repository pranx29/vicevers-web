<?php
include BASE_URL . '/app/views/components/cart_item.php';

?>

<div class="cart-container flex flex-col p-20 mt-[88px] gap-y-5">
    <h2 class="text-white font-semibold text-4xl">MY CART</h2>
    <div class="cart-empty"> </div>
    <div class="cart-content">
        <div class="cart-header flex flex-col gap-y-1 pb-5">
            <div class="cart-header flex text-contentColor1 justify-around w-[88%]">
                <h5>Product</h5>
                <h5>Quantity</h5>
                <h5>Total</h5>
            </div>
            <div class="seperator w-full h-[1px] bg-contentColor1"></div>
        </div>
        <div class="cart-item-container flex gap-y-5 flex-col max-h-[calc(4*160px)] overflow-y-auto">
            <?php $totalPrice = 0; ?>
            <?php foreach ($cartProducts as $product): ?>
                <?php $totalPrice += $product['price'] * $product['quantity'];
                renderCartItem(
                    $product['cart_item_id'],
                    $product['image_url'],
                    $product['product_name'],
                    $product['price'],
                    $product['color_name'],
                    $product['size_label'],
                    $product['quantity'],
                    $product['discounted_price']
                ); ?>
            <?php endforeach; ?>
        </div>
        <div class="flex justify-end">
            <a id="checkout-button" href="checkout"
                class="bg-white text-black px-5 py-3 rounded-full mt-10 transition-colors duration-300 inline-flex items-center justify-center hover:bg-opacity-80">CHECKOUT
                » LKR <?= $totalPrice ?>
            </a>
        </div>
    </div>
</div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        function handleCartItemEvents() {
            document.querySelectorAll('.cart-item').forEach(cartItem => {
                const decrementButton = cartItem.querySelector('.decrement-button');
                const incrementButton = cartItem.querySelector('.increment-button');
                const quantityInput = cartItem.querySelector('.quantity-input');
                const removeButton = cartItem.querySelector('.remove-button');

                incrementButton.addEventListener('click', () => {
                    let currentValue = parseInt(quantityInput.value);
                    quantityInput.value = currentValue + 1;
                    updateCartData(cartItem.getAttribute('data-cart-item-id'), quantityInput.value);

                });

                decrementButton.addEventListener('click', () => {
                    let currentValue = parseInt(quantityInput.value);
                    if (currentValue > 1) {
                        quantityInput.value = currentValue - 1;
                    }
                    updateCartData(cartItem.getAttribute('data-cart-item-id'), quantityInput.value);

                });


                removeButton.addEventListener('click', () => {
                    const cartItemId = cartItem.getAttribute('data-cart-item-id');
                    fetch(`cart/remove?cartItemId=${cartItemId}`)
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                const itemsCount = document.querySelector('#items-count');
                                itemsCount.innerHTML = parseInt(itemsCount.innerHTML) - 1;
                                cartItem.remove();
                                updateTotal();
                                displayEmptyCartMessage();
                                console.log(data.message);
                            } else {
                                alert(data.message);
                            }
                        });
                });

            });
        }

        function updateTotal() {
            let total = 0;
            document.querySelectorAll('.cart-item').forEach(cartItem => {
                let price = cartItem.getAttribute('data-price');
                const discountedPrice = cartItem.getAttribute('data-discounted-price');
                if (discountedPrice !== null && !isNaN(parseFloat(discountedPrice))) {
                    price = parseFloat(discountedPrice);
                    console.log(price);
                }
                console.log(discountedPrice);
                const totalAmount = cartItem.querySelector('.total-amount');
                const quantityInput = cartItem.querySelector('.quantity-input');
                const quantity = parseInt(quantityInput.value);
                totalAmount.innerHTML = 'LKR ' + quantity * parseFloat(price);
                total += quantity * parseFloat(price);
            });
            const checkoutButton = document.querySelector('#checkout-button');
            checkoutButton.innerHTML = `CHECKOUT » LKR ${total}`;
        }

        //function to display cart empty message
        function displayEmptyCartMessage() {
            const cartItemContainer = document.querySelector('.cart-item-container');
            const emptyCart = document.querySelector('.cart-empty');
            const cartContent = document.querySelector('.cart-content');
            if (cartItemContainer.getElementsByClassName('cart-item').length === 0) {
                cartContent.style.display = 'none';
                emptyCart.innerHTML = '<div class="flex flex-col justify-center items-center text-white p-5">' +
                    '<p class="text-3xl font-bold">Your cart is currently empty.</p>' +
                    '<p><a class="text-contentColor1 underline" href="#best-sellers">Continue shopping</a></p>' +
                    '</div>';
            }
        }

        function updateCartData(cartItemId, quantity) {
            fetch(`cart/update?cartItemId=${cartItemId}&quantity=${quantity}`)
                .then(response => {
                    if (!response.ok) {
                        throw new Error(`HTTP error! Status: ${response.status}`);
                    }
                    return response.json();
                })
                .then(data => {
                    if (data.success) {
                        updateTotal();
                        console.log(data.message);
                    } else {
                        alert(data.message);
                    }
                })
                .catch(error => {
                    console.error('Error updating cart:', error);
                    alert('There was an error updating the cart. Please try again.');
                });
        }

        handleCartItemEvents();
        displayEmptyCartMessage();
    });
</script>