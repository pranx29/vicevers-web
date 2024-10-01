<div class="w-full h-screen flex flex-col justify-center p-10">
    <div class="w-full flex justify-end mb-4">
        <a href="products/add"
            class="bg-white text-black px-5 py-2 rounded-full transition-colors duration-30 0hover:bg-opacity-80">
            Add Product
        </a>
    </div>
    <div class="w-full bg-secondary shadow-md rounded-lg p-6 overflow-y-auto">
        <h2 class="text-white font-semibold text-3xl mb-4">Product List</h2>
        <table class="min-w-full table-auto text-white rounded-lg">
            <thead>
                <tr class="border-b border-contentColor1">
                    <th class="px-6 py-3 text-left text-md font-semibold text-contentColor1 whitespace-nowrap">Product
                        ID</th>
                    <th class="px-6 py-3 text-left text-md font-semibold text-contentColor1 whitespace-nowrap">Product
                        Name</th>
                    <th class="px-6 py-3 text-left text-md font-semibold text-contentColor1 whitespace-nowrap">Category
                    </th>
                    <th class="px-6 py-3 text-left text-md font-semibold text-contentColor1 whitespace-nowrap">Target
                        Gender</th>
                    <th class="px-6 py-3 text-left text-md font-semibold text-contentColor1 whitespace-nowrap">Price
                    </th>
                    <th class="px-6 py-3 text-left text-md font-semibold text-contentColor1 whitespace-nowrap">Status
                    </th>
                    <th class="px-6 py-3 text-left text-md font-semibold text-contentColor1">Action</th>
                </tr>
            </thead>
            <tbody>
                <!-- Example Row -->
                <?php foreach ($products as $product): ?>
                    <tr class="border-b border-contentColor1"></tr>
                    <td class="px-6 py-4 whitespace-nowrap text-sm"><?= $product['id'] ?></td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm"><?= $product['name'] ?></td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm"><?= $product['category'] ?></td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm"><?= $product['target_gender'] ?></td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm"><?= $product['price'] ?></td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                        <?= $product['is_active'] ? 'Listed' : 'Not Listed' ?>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm relative">
                        <button type="button" class="text-white" id="menu-button-<?= $product['id'] ?>">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M12 6.75a.75.75 0 1 1 0-1.5.75.75 0 0 1 0 1.5ZM12 12.75a.75.75 0 1 1 0-1.5.75.75 0 0 1 0 1.5ZM12 18.75a.75.75 0 1 1 0-1.5.75.75 0 0 1 0 1.5Z" />
                            </svg>
                        </button>
                        <div class="origin-top-right absolute top-12 right-12 mt-2 w-36 rounded-md shadow-lg bg-natural hidden z-50"
                            id="menu-<?= $product['id'] ?>">
                            <div class="py-1">
                                <a href="products/add-variant?productId=<?= $product['id'] ?>"
                                    class="text-white block px-4 py-2 text-sm hover:opacity-75">
                                    Add Variant
                                </a>
                                <a href="products/add-discount?productId=<?= $product['id'] ?>"
                                    class="text-white block px-4 py-2 text-sm hover:opacity-75">
                                    Add Discount
                                </a>
                                <a href="products/details?productId=<?= $product['id'] ?>"
                                    class="text-white block px-4 py-2 text-sm hover:opacity-75">View</a>
                                <a href="products/edit?productId=<?= $product['id'] ?>"
                                    class="text-white block px-4 py-2 text-sm hover:opacity-75">Edit</a>
                            </div>
                        </div>
                        <script>
                            document.getElementById('menu-button-<?= $product['id'] ?>').addEventListener('click', function () {
                                var menu = document.getElementById('menu-<?= $product['id'] ?>');
                                menu.classList.toggle('hidden');
                            });
                        </script>
                    </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>