<?php
function renderContactCard($contact)
{
    ?>
    <div class="contact px-3 py-5 hover:bg-[#101112] w-1/6 rounded-2xl transition-colors duration-300"
        data-contact-id="<?= $contact['contact_id'] ?>">
        <div class="flex justify-end">
            <button class="edit-button text-contentColor1 hover:opacity-80 transition-opacity duration-300"
                onclick="toggleOverlay('contact-overlay')">
                <!-- SVG Icon -->
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                    stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                </svg>
            </button>
        </div>
        <p class="street text-white"><?php echo htmlspecialchars($contact['street']); ?></p>
        <p class="city text-white"><?php echo htmlspecialchars($contact['city']); ?></p>
        <p class="postal-code text-white"><?php echo htmlspecialchars($contact['postal_code']); ?></p>
        <p class="phone-number text-white"><?php echo htmlspecialchars($contact['phone_number']); ?></p>
    </div>
    <?php
}
