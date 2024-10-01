<?php
function renderDropdown($name, $id, $menus, $icon)
{
    $buttonId = $id . 'Button';
    $menuId = $id . 'Menu';
    $arrowId = $id . 'Arrow';
?>
    <div class="space-y-5">
        <!-- Dropdown Button -->
        <button id="<?php echo $buttonId; ?>"
            class="flex justify-start items-center space-x-4 hover:text-white text-contentColor1 w-full">
            <div>
                <?php echo $icon; ?>
            </div>
            <span class="font-medium text-lg w-full text-left"><?php echo $name ?></span>
            <!-- Down Arrow -->
            <div>
                <svg id="<?php echo $arrowId; ?>" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                    stroke="currentColor" class="size-4 transition-transform duration-200">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 9l-7.5 7.5L4.5 9" />
                </svg>
            </div>
        </button>

        <!-- Dropdown Menu -->
        <div id="<?php echo $menuId; ?>" class="hidden mt-2 space-y-2">
            <?php foreach ($menus as $menu): ?>
                <a href="<?php echo htmlspecialchars($menu['href']); ?>" id="<?php echo $menu['menuId']; ?>"
                    class="flex menus-center justify-start px-10 py-2 text-contentColor1 hover:text-white">
                    <?php echo htmlspecialchars($menu['text']); ?>
                </a>
            <?php endforeach; ?>
        </div>
    </div>

    <script>
        document.getElementById('<?php echo $buttonId; ?>').addEventListener('click', function() {
            const menu = document.getElementById('<?php echo $menuId; ?>');
            menu.classList.toggle('hidden');
            const arrow = document.getElementById('<?php echo $arrowId; ?>');
            arrow.classList.toggle('rotate-180');
        });
    </script>
<?php
}

function renderCheckboxDropdown($name, $id, $menus)
{
    $buttonId = $id . 'Button';
    $menuId = $id . 'Menu';
    $arrowId = $id . 'Arrow';
?>
    <div class="space-y-2">
        <!-- Dropdown Button -->
        <button id="<?php echo $buttonId; ?>"
            class="flex justify-start items-center space-x-4 hover:text-white text-contentColor1 w-full">
            <span class="font-medium text-lg w-full text-left"><?php echo $name; ?></span>
            <!-- Down Arrow -->
            <div>
                <svg id="<?php echo $arrowId; ?>" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                    stroke="currentColor" class="size-4 transition-transform duration-200">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 9l-7.5 7.5L4.5 9" />
                </svg>
            </div>
        </button>

        <!-- Dropdown Menu -->
        <div id="<?php echo $menuId; ?>" class="hidden space-y-2">
            <?php foreach ($menus as $menu): ?>
                <label class="flex items-center justify-start px-5 py-2 text-white">
                    <input type="checkbox"
                        name="<?php echo htmlspecialchars($name); ?>"
                        value="<?php echo htmlspecialchars($menu['id']); ?>"
                        class="mr-2 h-5 w-5 text-black border-gray-300 rounded-sm focus:ring-0 checked:bg-black checked:border-black">
                    <?php echo htmlspecialchars($menu['name']); ?>
                </label>
            <?php endforeach; ?>
        </div>

    </div>

    <script>
        document.getElementById('<?php echo $buttonId; ?>').addEventListener('click', function() {
            const menu = document.getElementById('<?php echo $menuId; ?>');
            menu.classList.toggle('hidden');
            const arrow = document.getElementById('<?php echo $arrowId; ?>');
            arrow.classList.toggle('rotate-180');
        });
    </script>
<?php
}
function renderRadioDropdown($name, $id, $options)
{
    $buttonId = $id . 'Button';
    $menuId = $id . 'Menu';
    $arrowId = $id . 'Arrow';
    
?>
    <div class="space-y-2">
        <!-- Dropdown Button -->
        <button id="<?php echo $buttonId; ?>"
            class="flex justify-start items-center space-x-4 hover:text-white text-contentColor1 w-full">
            <span class="font-medium text-lg w-full text-left"><?php echo $name; ?></span>
            <!-- Down Arrow -->
            <div>
                <svg id="<?php echo $arrowId; ?>" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                    stroke="currentColor" class="size-4 transition-transform duration-200">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 9l-7.5 7.5L4.5 9" />
                </svg>
            </div>
        </button>

        <!-- Dropdown Menu -->
        <div id="<?php echo $menuId; ?>" class="hidden space-y-2">
            <?php foreach ($options as $option_id => $option_name): ?>
                <label class="flex items-center justify-start px-5 py-2 text-white">
                    <input type="radio"
                        name="<?php echo htmlspecialchars($name); ?>"
                        value="<?php echo htmlspecialchars($option_id); ?>"
                        class="mr-2 h-5 w-5 text-black border-gray-300 rounded-sm focus:ring-0 checked:bg-black checked:border-black">
                    <?php echo htmlspecialchars($option_name); ?>
                </label>
            <?php endforeach; ?>
        </div>

    </div>

    <script>
        document.getElementById('<?php echo $buttonId; ?>').addEventListener('click', function() {
            const menu = document.getElementById('<?php echo $menuId; ?>');
            menu.classList.toggle('hidden');
            const arrow = document.getElementById('<?php echo $arrowId; ?>');
            arrow.classList.toggle('rotate-180');
        });
    </script>
<?php
}
?>

