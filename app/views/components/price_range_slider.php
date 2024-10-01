<?php
function renderPriceRangeSlider($minValue = 500, $maxValue = 10000, $initialMin = 500, $initialMax = 500) {
    ?>
    <div class="text-contentColor1 flex space-y-5 flex-col">
        <h3 class="font-medium text-lg w-full text-left">Price</h3>
        <div class="mb-4">
            <input id="priceRange" type="range" min="<?php echo $minValue; ?>" max="<?php echo $maxValue; ?>" value="<?php echo $initialMax; ?>" class="w-full appearance-none h-2 bg-gray-300 rounded-lg cursor-pointer">
            <div class="flex justify-between text-white mt-2">
                <span id="rangeMin">LKR <?php echo $initialMin; ?></span>
                <span id="rangeMax">LKR <?php echo $initialMax; ?></span>
            </div>
        </div>
        <div class="flex items-center justify-between mb-4 text-[12px]">
            <div class="flex items-center">
                <input id="minPrice" type="number" min="<?php echo $minValue; ?>" value="<?php echo $initialMin; ?>" class="bg-natural w-20 p-2 rounded-full outline-none appearance-none">
            </div>
            <div class="w-5 bg-white h-[1px]"></div>
            <div class="flex items-center">
                <input id="maxPrice" type="number" min="<?php echo $maxValue; ?>" value="<?php echo $initialMax; ?>" class="bg-natural w-20 p-2 rounded-full outline-none appearance-none">
            </div>
        </div>
        <script>
            document.addEventListener('DOMContentLoaded', () => {
                const priceRange = document.getElementById('priceRange');
                const minPriceInput = document.getElementById('minPrice');
                const maxPriceInput = document.getElementById('maxPrice');
                const rangeMin = document.getElementById('rangeMin');
                const rangeMax = document.getElementById('rangeMax');

                function updateMaxPrice() {
                    const sliderValue = parseInt(priceRange.value);
                    maxPriceInput.value = sliderValue;
                    rangeMin.textContent = `LKR ${minPriceInput.value}`;
                    rangeMax.textContent = `LKR ${sliderValue}`;
                }

                priceRange.addEventListener('input', updateMaxPrice);
                maxPriceInput.addEventListener('input', () => {
                    priceRange.value = maxPriceInput.value;
                    updateMaxPrice();
                });

                updateMaxPrice();
            });
        </script>
    </div>
    <?php
}
?>
