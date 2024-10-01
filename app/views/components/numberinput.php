<!-- numberinput.php -->
<?php
function getNumberInput($labelText, $inputId, $inputName, $placeholder = '', $min = 0, $max = null, $step = 1, $value = null, $height = 40) {
    ?>
    <div class="mt-4 ">
        <label for="<?php echo htmlspecialchars($inputId); ?>" class="block text-sm font-mediu text-contentColor1">
            <?php echo htmlspecialchars($labelText); ?>
        </label>
        <input type="number" id="<?php echo htmlspecialchars($inputId); ?>" name="<?php echo htmlspecialchars($inputName); ?>"
                placeholder="<?php echo htmlspecialchars($placeholder); ?>" 
                min="<?php echo htmlspecialchars($min); ?>" 
                max="<?php echo htmlspecialchars($max); ?>" 
                step="<?php echo htmlspecialchars($step); ?>" 
                value="<?php echo htmlspecialchars($value); ?>"
                class="w-full rounded-md border border-white px-3 py-2 text-white sm:text-sm bg-natural outline-none" 
                style="height: <?php echo htmlspecialchars($height); ?>px;">
    </div>
    <?php
}
?>
