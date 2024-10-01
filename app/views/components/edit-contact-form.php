<?php

function renderEditContactFrom($contact)
{
    ?>
    <form class="contact-edit-form flex flex-col gap-y-5 bg-[#101112] rounded-2xl p-10" action="" method="POST">
        <div>
            <h3 class="text-white font-thin text-3xl">Edit Contact</h3>
        </div>
        <div>
            <label for="street" class="block text-sm font-medium text-contentColor1">Street</label>
            <input type="text" name="street" required value="<?= htmlspecialchars($contact['street'])?>"
                class="mt-1 flex rounded-md border border-white px-3 py-2 bg-natural text-white sm:text-sm outline-none placeholder-white h-10 w-full">
        </div>
        <div class="flex flex-wrap justify-between gap-5">
            <div>
                <label for="postalCode" class="block text-sm font-medium text-contentColor1">Postal Code</label>
                <input type="text" name="postalCode" required value="<?= htmlspecialchars($contact['postal_code'])?>"
                    class="mt-1 block w-full rounded-md border border-white px-3 py-2 bg-natural text-white sm:text-sm outline-none placeholder-white h-10">
            </div>
            <div>
                <label for="city" class="block text-sm font-medium text-contentColor1">City</label>
                <input type="text" name="city"required value="<?= htmlspecialchars($contact['city'])?>"
                    class="mt-1 flex rounded-md border border-white px-3 py-2 bg-natural text-white sm:text-sm outline-none placeholder-white h-10">
            </div>
        </div>
        <div>
            <label for="phoneNumber" class="block text-sm font-medium text-contentColor1">Phone Number</label>
            <input type="text" name="phoneNumber" required value="<?= htmlspecialchars($contact['phone_number'])?>"
                class="mt-1 block w-full rounded-md border border-white px-3 py-2 bg-natural text-white sm:text-sm outline-none placeholder-white h-10">
        </div>
        <div class="flex gap-x-5 justify-end mt-5">
            <button type="button"
                class="cancel-button underline text-white rounded-full transition-colors duration-300 hover:bg-opacity-80">
                Cancel
            </button>
            <input type="hidden" name="contact_id" value="<?= htmlspecialchars($contact['contact_id'])?>">
            <button type="submit"
                class="bg-white text-black px-4 py-1 rounded-full transition-colors duration-300 hover:bg-opacity-80">
                Save
            </button>
        </div>
    </form>

    <?php
}


