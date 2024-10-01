<?php
function renderDropdown2($id, $name, $options, $selectedValue = null)
{
    $selectedName = '';
    if ($selectedValue !== null) {
        foreach ($options as $option) {
            if ($option['id'] == $selectedValue) {
                $selectedName = $option['name'];
                break;
            }
        }
    }
    ?>
    <div class="relative inline-block text-left w-full">
        <!-- Button to toggle dropdown -->
        <button id="<?php echo htmlspecialchars($id); ?>" type="button"
            class="inline-flex w-full justify-between rounded-md border border-white bg-natural px-4 py-2 text-sm font-medium text-white">
            <?php echo htmlspecialchars($selectedName ? $selectedName : 'Select an option'); ?>
            <svg class="-mr-1 ml-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
            </svg>
        </button>

        <!-- Dropdown menu -->
        <div class="dropdown-menu absolute right-0 z-10 mt-2 min-w-full rounded-md bg-natural hidden">
            <div class="py-1">
                <?php foreach ($options as $option): ?>
                    <a class="block px-4 py-2 text-sm text-contentColor1 hover:text-white"
                        data-value="<?php echo htmlspecialchars($option['id']); ?>">
                        <?php echo htmlspecialchars($option['name']); ?>
                    </a>
                <?php endforeach; ?>
            </div>
        </div>

        <!-- Hidden input field to store selected value -->
        <input type="hidden" id="<?php echo htmlspecialchars($id); ?>_input" name="<?php echo htmlspecialchars($name); ?>"
            value="<?php echo htmlspecialchars($selectedValue); ?>">

    </div>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const button = document.getElementById('<?php echo htmlspecialchars($id); ?>');
            const input = document.getElementById('<?php echo htmlspecialchars($id); ?>_input');
            if (button) { // Ensure the button exists
                const menu = button.nextElementSibling;
                if (menu) { // Ensure the menu exists
                    button.addEventListener('click', () => {
                        menu.classList.toggle('hidden');
                    });

                    menu.querySelectorAll('a').forEach(item => {
                        item.addEventListener('click', (e) => {
                            e.preventDefault();
                            // Update button text and hidden input value
                            const selectedText = item.textContent;
                            button.innerHTML = selectedText + '<svg class="-mr-1 ml-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" /></svg>';
                            input.value = item.getAttribute('data-value'); // Set the hidden input value
                            menu.classList.add('hidden');
                        });
                    });
                }
            }
        });
    </script>
    <?php
}
?>