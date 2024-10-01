<?php
require_once BASE_URL . '/app/views/components/sidebar.php';
require_once BASE_URL . '/app/views/components/dropdown2.php';
require_once BASE_URL . '/app/views/components/product_card.php';
$availability = ['In Stock', 'Out of Stock'];
$sortOptions = [
    ['id' => 0, 'name' => 'Featured'],
    ['id' => 1, 'name' => 'Best Selling'],
    ['id' => 2, 'name' => 'Newest First'],
    ['id' => 3, 'name' => 'Oldest First']
];
?>

<div class="h-auto flex flex-row mt-[88px] mb-24 gap-x-5">
    <div class="h-full w-1/3 p-5 space-y-5">
        <div>
            <h2 class="text-white font-semibold text-4xl">MEN'S FASHION</h2>
        </div>
        <?php renderFilterSidebar($categories, $sizes, $colors, $availability); ?>
    </div>
    <div class="w-full flex flex-col gap-y-10">
        <div class="flex justify-end items-center gap-3 px-5">
            <span class="text-contentColor1">Sort by</span>
            <div class="w-36">
                <div class="relative inline-block text-left w-full">
                    <button id="sortDropdown" type="button"
                        class="inline-flex w-full justify-between rounded-md border border-white bg-natural px-4 py-2 text-sm font-medium text-white">
                        <?= isset($sortby) ? htmlspecialchars($sortby) : htmlspecialchars($sortOptions[0]['name']) ?>
                        <svg class="-mr-1 ml-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>

                    <div class="dropdown-menu absolute right-0 z-10 mt-2 min-w-full rounded-md bg-natural hidden">
                        <div class="py-1">
                            <?php foreach ($sortOptions as $option): ?>
                                <a href="products/mens-wear?sortby=<?= htmlspecialchars($option['name']); ?>"
                                    class="block px-4 py-2 text-sm text-contentColor1 hover:text-white"
                                    data-value="<?= htmlspecialchars($option['id']); ?>">
                                    <?= htmlspecialchars($option['name']); ?>
                                </a>
                            <?php endforeach; ?>
                        </div>
                    </div>

                    <input type="hidden" id="sortDropdown_input" name="sort"
                        value="<?= htmlspecialchars($selectedValue); ?>">
                </div>

            </div>
        </div>
        <div class="space-x-2">
            <!-- Applied Filter Button
            <span class="text-contentColor1">Applied Filter:</span>
            <button class="bg-secondary p-2 rounded-full text-white hover:opacity-80 transition-colors">
                
                <span class="flex flex-row gap-x-2 items-center justify-center mx-1">
                    Shirt
                    <img src="assets/images/x.svg" alt="close" class="w-4 h-4 ml-2">
                </span>
                
            </button>
            -->
        </div>
        <div class="flex flex-wrap justify-around gap-y-10">
            <?php foreach ($products as $product) {
                renderProductCard2($product);
            } ?>
        </div>
    </div>
</div>


<script>
    function handleCardClick(productId) {
        window.location.href = 'product/?productId=' + productId;
    }


    function handleAddToCartClick(productId) {

        const selectedColor = document.querySelector('input[name="color' + productId + '"]:checked');
        const selectedSize = document.querySelector('input[name="size' + productId + '"]:checked');

        if (!selectedColor || !selectedSize) {
            alert('Please select a color and size.');
            return;
        } else {
            const colorId = selectedColor.value;
            const sizeId = selectedSize.value;
            const quantity = 1;

            const url = `cart/add?productId=${encodeURIComponent(productId)}&sizeId=${encodeURIComponent(sizeId)}&colorId=${encodeURIComponent(colorId)}&quantity=${encodeURIComponent(quantity)}`;

            console.log('Request URL:', url);

            fetch(url, { method: 'GET' })
                .then(response => response.text())
                .then(data => {
                    let parsedData = JSON.parse(data);
                    if (parsedData.success) {
                        let itemsCountElement = document.getElementById('items-count');
                        itemsCountElement.innerText = parseInt(itemsCountElement.innerText) + 1;
                        console.log(parsedData.message);

                    } else {
                        alert(parsedData.message);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('An error occurred. Please try again later.');
                });

        }
    }
</script>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const button = document.getElementById('sortDropdown');
        const input = document.getElementById('sortDropdown_input');
        const menu = button.nextElementSibling;

        button.addEventListener('click', () => {
            menu.classList.toggle('hidden');
        });

        menu.querySelectorAll('a').forEach(item => {
            item.addEventListener('click', (e) => {
                button.innerHTML = `${item.textContent}<svg class="-mr-1 ml-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" /></svg>`;
                input.value = item.getAttribute('data-value');
                menu.classList.add('hidden');
            });
        });
    });
</script>