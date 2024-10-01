<div class="w-full h-screen flex justify-center p-10">
    <div class="w-full bg-secondary shadow-md rounded-lg p-6 overflow-y-auto">
        <h2 class="text-white font-semibold text-3xl mb-4">Customer List</h2>
        <table class="min-w-full table-auto text-white rounded-lg">
            <thead>
                <tr class="border-b border-contentColor1">
                    <th class="px-6 py-3 text-left text-md font-semibold text-contentColor1 whitespace-nowrap">User ID
                    </th>
                    <th class="px-6 py-3 text-left text-md font-semibold text-contentColor1 whitespace-nowrap">First
                        Name</th>
                    <th class="px-6 py-3 text-left text-md font-semibold text-contentColor1 whitespace-nowrap">Last Name
                    </th>
                    <th class="px-6 py-3 text-left text-md font-semibold text-contentColor1">Email</th>
                    <th class="px-6 py-3 text-left text-md font-semibold text-contentColor1 whitespace-nowrap">
                        Registration Date</th>
                    <th class="px-6 py-3 text-left text-md font-semibold text-contentColor1">Status</th>
                    <th class="px-6 py-3 text-left text-md font-semibold text-contentColor1">Action</th>
                </tr>
            </thead>
            <tbody>
                <tr class="border-b border-contentColor1">
                    <td class="px-6 py-4 whitespace-nowrap text-sm"><?= $customers[0]['id'] ?></td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm"><?= $customers[0]['fname'] ?></td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm"><?= $customers[0]['lname'] ?></td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm"><?= $customers[0]['email'] ?></td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm"><?= $customers[0]['registration_date'] ?></td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                        <?= $customers[0]['is_active'] ? 'Active' : 'Inactive' ?>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                        <a href="customer/status?customer_id=<?= $customers[0]['id'] ?>&status=<?= $customers[0]['is_active'] ? 0 : 1 ?>"
                            class="bg-white text-black px-3 py-2 rounded-full transition-colors duration-300 hover:bg-gray-200 text-center inline-block w-24">
                            <?= $customers[0]['is_active'] ? 'Deactivate' : 'Activate' ?>
                        </a>
                    </td>
                </tr>

            </tbody>
        </table>
    </div>
</div>