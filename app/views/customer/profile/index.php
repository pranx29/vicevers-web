<?php require_once BASE_URL . '/app/views/components/contact-card.php' ?>
<?php require_once BASE_URL . '/app/views/components/edit-contact-form.php' ?>;

<div class="px-20 space-y-10">
    <!-- Profile Details Section -->
    <div class="profile-details flex flex-col bg-secondary rounded-2xl p-5 gap-y-5">
        <button class="edit-button text-contentColor1 flex justify-end hover:opacity-80 transition-opacity duration-300"
            onclick="toggleOverlay('profile-overlay')">
            <!-- SVG Icon -->
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                stroke="currentColor" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
            </svg>
        </button>
        <div class="flex flex-col gap-y-5">
            <!-- Profile Information -->
            <div class="name-containe">
                <h5 class="text-contentColor1 font-semibold">Name</h5>
                <p class="text-white"><?= htmlspecialchars($user['fname']) . ' ' . htmlspecialchars($user['lname']) ?>
                </p>
            </div>
            <div class="email-container">
                <h5 class="text-contentColor1 font-semibold">Email</h5>
                <p class="text-white"><?= htmlspecialchars($user['email']) ?>
                </p>
            </div>
        </div>
    </div>

    <!-- Contact Details Section -->
    <div class="contact-details flex flex-col bg-secondary rounded-2xl p-5 gap-y-2">
        <div class="flex justify-between">
            <h5 class="text-contentColor1 font-semibold">Contact</h5>
            <button class="add-button text-white bg-secondary hover:opacity-80 transition-opacity duration-300"
                onclick="toggleOverlay('add-contact-overlay')">
                <!-- SVG Icon -->
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                    stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                </svg>
            </button>
        </div>
        <div class="contact-container flex gap-5">
            <?php foreach ($contactInfo as $contact) {
                renderContactCard($contact); ?>
            <?php } ?>
        </div>
    </div>
</div>

<!-- Overlays -->
<div id="profile-overlay"
    class="overlay fixed inset-0 bg-black bg-opacity-50 z-50 hidden transition-opacity duration-300 ease-in-out">
    <div class="edit-profile-container flex w-full h-full justify-center items-center z-[100]">
        <form id="edit-profile-form" class="flex flex-col gap-y-5 bg-[#101112] rounded-2xl p-10" action="account/update"
            method="GET">
            <div>
                <h3 class="text-white font-thin text-3xl">Edit Profile</h3>
            </div>
            <div class="flex flex-wrap justify-between gap-5">
                <div>
                    <label for="fname" class="block text-sm font-medium text-contentColor1">First Name</label>
                    <input type="text" name="fname" required value="<?= htmlspecialchars($user['fname']) ?>"
                        class="mt-1 flex rounded-md border border-white px-3 py-2 bg-natural text-white sm:text-sm outline-none placeholder-white h-10">
                </div>
                <div>
                    <label for="lname" class="block text-sm font-medium text-contentColor1">Last Name</label>
                    <input type="text" name="lname" value="<?= htmlspecialchars($user['lname']) ?>"
                        class="mt-1 flex rounded-md border border-white px-3 py-2 bg-natural text-white sm:text-sm outline-none placeholder-white h-10">
                </div>
            </div>
            <div>
                <label for="email" class="block text-sm font-medium text-contentColor1">Email</label>
                <input type="email" name="email" required value="<?= htmlspecialchars($user['email']) ?>" readonly
                    class="mt-1 block w-full rounded-md border border-white px-3 py-2 bg-natural text-white sm:text-sm outline-none placeholder-white h-10">
            </div>
            <div class="flex gap-x-5 justify-end mt-5">
                <div class="error-message flex justify-start items-center gap-x-2 w-full">

                </div>
                <button type="button"
                    class="cancel-button underline text-white rounded-full transition-colors duration-300 hover:bg-opacity-80">
                    Cancel
                </button>
                <button type="submit"
                    class="bg-white text-black px-4 py-1 rounded-full transition-colors duration-300 hover:bg-opacity-80">
                    Save
                </button>
            </div>
        </form>
    </div>
</div>

<div id="contact-overlay"
    class="overlay fixed inset-0 bg-black bg-opacity-50 z-50 hidden transition-opacity duration-300 ease-in-out">
    <div class="edit-contact-container flex w-full h-full justify-center items-center z-[100]">
        <div class="form-wrapper flex flex-col gap-y-5 bg-[#101112] rounded-2xl p-10">
            <div>
                <h3 class="text-white font-thin text-3xl">Edit Contact</h3>
            </div>
            <form class="contact-edit-form flex flex-col gap-y-5" data-contact-id="" action="" method="POST">
                <div>
                    <label for="street" class="block text-sm font-medium text-contentColor1">Street</label>
                    <input type="text" name="street" required pattern="^[a-zA-Z0-9\s,.'-]{3,}$"
                        title="Street address must be at least 3 characters long and can include letters, numbers, spaces, and punctuation."
                        class="mt-1 flex rounded-md border border-white px-3 py-2 bg-natural text-white sm:text-sm outline-none placeholder-white h-10 w-full">
                </div>
                <div class="flex flex-wrap justify-between gap-5">
                    <div>
                        <label for="postalCode" class="block text-sm font-medium text-contentColor1">Postal Code</label>
                        <input type="text" name="postalCode" required pattern="^\d{5}$"
                            title="Please enter a valid 5-digit postal code"
                            class="mt-1 block w-full rounded-md border border-white px-3 py-2 bg-natural text-white sm:text-sm outline-none placeholder-white h-10">
                    </div>
                    <div>
                        <label for="city" class="block text-sm font-medium text-contentColor1">City</label>
                        <input type="text" name="city" required pattern="^[a-zA-Z\s]+$"
                            title="City can only contain letters"
                            class="mt-1 flex rounded-md border border-white px-3 py-2 bg-natural text-white sm:text-sm outline-none placeholder-white h-10">
                    </div>
                </div>
                <div>
                    <label for="phoneNumber" class="block text-sm font-medium text-contentColor1">Phone Number</label>
                    <input type="text" name="phoneNumber" required pattern="^\d{10}$"
                        title="Please enter a valid 10-digit phone number"
                        class="mt-1 block w-full rounded-md border border-white px-3 py-2 bg-natural text-white sm:text-sm outline-none placeholder-white h-10">
                </div>
                <div class="flex gap-x-5 justify-end mt-5">
                    <div class="error-message flex justify-start items-center gap-x-2 w-full">

                    </div>
                    <button type="button"
                        class="cancel-button underline text-white rounded-full transition-colors duration-300 hover:bg-opacity-80">
                        Cancel
                    </button>
                    <button type="submit"
                        class="bg-white text-black px-4 py-1 rounded-full transition-colors duration-300 hover:bg-opacity-80">
                        Save
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<div id="add-contact-overlay"
    class="overlay fixed inset-0 bg-black bg-opacity-50 z-50 hidden transition-opacity duration-300 ease-in-out">
    <div class="add-address-container flex w-full h-full justify-center items-center z-[100]">
        <div class="form-wrapper flex flex-col gap-y-5 bg-[#101112] rounded-2xl p-10">
            <div>
                <h3 class="text-white font-thin text-3xl">Add Address</h3>
            </div>
            <form class="address-add-form flex flex-col gap-y-5" action="<?= HOME_URL . 'account/add-address' ?>"
                method="POST">
                <div>
                    <label for="street" class="block text-sm font-medium text-contentColor1">Street</label>
                    <input type="text" name="street" required pattern="^[a-zA-Z0-9\s,.'-]{3,}$"
                        title="Please enter a valid street address"
                        class="mt-1 flex rounded-md border border-white px-3 py-2 bg-natural text-white sm:text-sm outline-none placeholder-white h-10 w-full">
                </div>
                <div class="flex flex-wrap justify-between gap-5">
                    <div>
                        <label for="postal_code" class="block text-sm font-medium text-contentColor1">Postal
                            Code</label>
                        <input type="text" name="postal_code" required pattern="^\d{5}$"
                            title="Please enter a valid 5-digit postal code"
                            class="mt-1 block w-full rounded-md border border-white px-3 py-2 bg-natural text-white sm:text-sm outline-none placeholder-white h-10">
                    </div>
                    <div>
                        <label for="city" class="block text-sm font-medium text-contentColor1">City</label>
                        <input type="text" name="city" required pattern="^[a-zA-Z\s]+$"
                            title="City can only contain letters"
                            class="mt-1 flex rounded-md border border-white px-3 py-2 bg-natural text-white sm:text-sm outline-none placeholder-white h-10">
                    </div>
                </div>
                <div>
                    <label for="phone_number" class="block text-sm font-medium text-contentColor1">Phone Number</label>
                    <input type="text" name="phone_number" required pattern="^\d{10}$"
                        title="Please enter a valid 10-digit phone number"
                        class="mt-1 block w-full rounded-md border border-white px-3 py-2 bg-natural text-white sm:text-sm outline-none placeholder-white h-10">
                </div>
                <div class="flex gap-x-5 justify-end mt-5">
                    <div class="error-message flex justify-start items-center gap-x-2 w-full">

                    </div>
                    <button type="button"
                        class="cancel-button underline text-white rounded-full transition-colors duration-300 hover:bg-opacity-80">
                        Cancel
                    </button>
                    <button type="submit"
                        class="bg-white text-black px-4 py-1 rounded-full transition-colors duration-300 hover:bg-opacity-80">
                        Add
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    document.querySelectorAll('.cancel-button').forEach(button => {
        button.addEventListener('click', () => {
            document.querySelectorAll('.overlay').forEach(overlay => {
                overlay.classList.add('hidden');
            });
            document.body.style.overflow = 'auto';
        });
    });

    function toggleOverlay(id) {
        const overlay = document.getElementById(id);
        const isVisible = !overlay.classList.contains('hidden');

        overlay.classList.toggle('hidden');
        document.body.style.overflow = isVisible ? 'auto' : 'hidden';
    }

    contactDetails = document.querySelector('.contact-details');
    contactForm = document.querySelector('.contact-edit-form');
    contactDetails.querySelectorAll('.edit-button').forEach(button => {
        const form = document.querySelector('.contact-edit-form');
        street = form.querySelector('input[name="street"]');
        postalCode = form.querySelector('input[name="postalCode"]');
        city = form.querySelector('input[name="city"]');
        phoneNumber = form.querySelector('input[name="phoneNumber"]');
        contactId = form.getAttribute('data-contact-id');

        button.addEventListener('click', () => {
            contactId = button.parentElement.parentElement.getAttribute('data-contact-id');
            console.log(contactId.value);
            street.value = button.parentElement.parentElement.querySelector('.street').textContent;
            postalCode.value = button.parentElement.parentElement.querySelector('.postal-code').textContent;
            city.value = button.parentElement.parentElement.querySelector('.city').textContent;
            phoneNumber.value = button.parentElement.parentElement.querySelector('.phone-number').textContent;
            contactForm.setAttribute('data-contact-id', contactId);
            toggleOverlay('profile-overlay');
        });
    });

    contactFrom = document.querySelector('.contact-edit-form');
    contactFrom.addEventListener('submit', (event) => {
        event.preventDefault();
        street = contactFrom.querySelector('input[name="street"]').value;
        postalCode = contactFrom.querySelector('input[name="postalCode"]').value;
        city = contactFrom.querySelector('input[name="city"]').value;
        phoneNumber = contactFrom.querySelector('input[name="phoneNumber"]').value;
        contactId = contactFrom.getAttribute('data-contact-id');

        const url = `account/update?contactId=${contactId}&street=${encodeURIComponent(street)}&postalCode=${encodeURIComponent(postalCode)}&city=${encodeURIComponent(city)}&phoneNumber=${encodeURIComponent(phoneNumber)}&type=contact`;

        console.log('Request URL:', url);

        fetch(url, { method: 'GET' })
            .then(response => response.text())
            .then(data => {
                let parsedData = JSON.parse(data);
                if (parsedData.success) {
                    location.reload();
                } else {
                    errorContainer = contactFrom.querySelector('.error-message');
                    errorContainer.innerHTML = '<div class="text-white">' +
                        '<svg class="" width="24" height="24" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true" focusable="false">' +
                        '<path fill-rule="evenodd" clip-rule="evenodd" d="M12 3C7.02944 3 3 7.02944 3 12C3 16.9706 7.02944 21 12 21C16.9706 21 21 16.9706 21 12C21 7.02944 16.9706 3 12 3ZM1 12C1 5.92487 5.92487 1 12 1C18.0751 1 23 5.92487 23 12C23 18.0751 18.0751 23 12 23C5.92487 23 1 18.0751 1 12ZM13.25 17.25C13.25 17.9404 12.6904 18.5 12 18.5C11.3096 18.5 10.75 17.9404 10.75 17.25C10.75 16.5596 11.3096 16 12 16C12.6904 16 13.25 16.5596 13.25 17.25ZM13 15V6H11V15H13Z"></path>' +
                        '</svg>' +
                        '</div>' +
                        '<span class="text-white">' + parsedData.message + '</span>';
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('An error occurred. Please try again later.');
            });
    });

    // Profile Edit Form
    profileForm = document.getElementById('edit-profile-form');
    profileForm.addEventListener('submit', (event) => {
        event.preventDefault();
        fname = profileForm.querySelector('input[name="fname"]').value;
        lname = profileForm.querySelector('input[name="lname"]').value;
        email = profileForm.querySelector('input[name="email"]').value;

        const url = `account/update?fname=${encodeURIComponent(fname)}&lname=${encodeURIComponent(lname)}&email=${encodeURIComponent(email)}&type=profile`;

        console.log('Request URL:', url);

        fetch(url, { method: 'GET' })
            .then(response => response.text())
            .then(data => {
                let parsedData = JSON.parse(data);
                if (parsedData.success) {
                    location.reload();
                } else {
                    errorContainer = addContactForm.querySelector('.error-message');
                    errorContainer.innerHTML = '<div class="text-white">' +
                        '<svg class="" width="24" height="24" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true" focusable="false">' +
                        '<path fill-rule="evenodd" clip-rule="evenodd" d="M12 3C7.02944 3 3 7.02944 3 12C3 16.9706 7.02944 21 12 21C16.9706 21 21 16.9706 21 12C21 7.02944 16.9706 3 12 3ZM1 12C1 5.92487 5.92487 1 12 1C18.0751 1 23 5.92487 23 12C23 18.0751 18.0751 23 12 23C5.92487 23 1 18.0751 1 12ZM13.25 17.25C13.25 17.9404 12.6904 18.5 12 18.5C11.3096 18.5 10.75 17.9404 10.75 17.25C10.75 16.5596 11.3096 16 12 16C12.6904 16 13.25 16.5596 13.25 17.25ZM13 15V6H11V15H13Z"></path>' +
                        '</svg>' +
                        '</div>' +
                        '<span class="text-white">' + parsedData.message + '</span>';
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('An error occurred. Please try again later.');
            });

    });
</script>

<script>
    // Add Contact Form
    addContactForm = document.querySelector('.address-add-form');
    addContactForm.addEventListener('submit', (event) => {
        event.preventDefault();
        street = addContactForm.querySelector('input[name="street"]').value;
        postalCode = addContactForm.querySelector('input[name="postal_code"]').value;
        city = addContactForm.querySelector('input[name="city"]').value;
        phoneNumber = addContactForm.querySelector('input[name="phone_number"]').value;

        const url = `account/add-address?street=${encodeURIComponent(street)}&postalCode=${encodeURIComponent(postalCode)}&city=${encodeURIComponent(city)}&phoneNumber=${encodeURIComponent(phoneNumber)}`;

        console.log('Request URL:', url);

        fetch(url, { method: 'POST' })
            .then(response => response.text())
            .then(data => {
                let parsedData = JSON.parse(data);
                if (parsedData.success) {
                    location.reload();
                } else {
                    errorContainer = addContactForm.querySelector('.error-message');
                    errorContainer.innerHTML = '<div class="text-white">' +
                        '<svg class="" width="24" height="24" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true" focusable="false">' +
                        '<path fill-rule="evenodd" clip-rule="evenodd" d="M12 3C7.02944 3 3 7.02944 3 12C3 16.9706 7.02944 21 12 21C16.9706 21 21 16.9706 21 12C21 7.02944 16.9706 3 12 3ZM1 12C1 5.92487 5.92487 1 12 1C18.0751 1 23 5.92487 23 12C23 18.0751 18.0751 23 12 23C5.92487 23 1 18.0751 1 12ZM13.25 17.25C13.25 17.9404 12.6904 18.5 12 18.5C11.3096 18.5 10.75 17.9404 10.75 17.25C10.75 16.5596 11.3096 16 12 16C12.6904 16 13.25 16.5596 13.25 17.25ZM13 15V6H11V15H13Z"></path>' +
                        '</svg>' +
                        '</div>' +
                        '<span class="text-white">' + parsedData.message + '</span>';
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('An error occurred. Please try again later.');
            });

    });
</script>