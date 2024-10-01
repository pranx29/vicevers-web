<?php
include BASE_URL . '/app/views/components/dropdown.php';
include BASE_URL . '/app/views/components/price_range_slider.php';

function renderFilterSidebar($categories, $sizes, $colors, $availability)
{
?>
    <aside class="bg-secondary text-white p-5 space-y-5 rounded-2xl">
        <div class="bg-secondary w-auto h-auto rounded-2xl space-y-5">
            <h3 class="text-white font-thin text-3xl">FILTER PRODUCTS</h3>
            <div class="px-5 space-y-5">
                <?php
                renderCheckboxDropdown('Category', 'category_dd', $categories);
                renderCheckboxDropdown('Size', 'size_dd', $sizes);
                renderCheckboxDropdown('Color', 'color_dd', $colors);
                renderRadioDropdown('Availability', 'availability_dd', $availability);
                renderPriceRangeSlider(500, 10000, 500, 10000);
                ?>
                <div class="flex">
                    <a href="#" id="applyFilterBtn" class="bg-white text-black text-center px-5 py-2 rounded-full transition-colors duration-300 hover:bg-opacity-80 w-full">
                        Apply Filter
                    </a>
                    <script>
                        document.getElementById('applyFilterBtn').addEventListener('click', function(event) {
                            event.preventDefault();
                            const categories = Array.from(document.querySelectorAll('input[name="Category"]:checked')).map(el => el.value);
                            const minPrice = document.getElementById('minPrice').value;
                            const maxPrice = document.getElementById('maxPrice').value;

                            const url = new URL(window.location.href);
                            url.searchParams.set('categories', categories.join(','));
                            url.searchParams.set('minPrice', minPrice);
                            url.searchParams.set('maxPrice', maxPrice);

                            window.location.href = url.toString();
                        });
                    </script>
                </div>
            </div>
        </div>
    </aside>
<?php
}
?>