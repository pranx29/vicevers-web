<!-- textinput.php -->
<?php
function getTextInput($labelText, $inputId, $inputName, $placeholder = '', $rows = 1, $height = 40)
{
?>
    <div class="mb-4">
        <label for="<?php echo htmlspecialchars($inputId); ?>" class="block text-sm font-medium text-contentColor1">
            <?php echo htmlspecialchars($labelText); ?>
        </label>
        <?php if ($rows > 1) : ?>
            <textarea id="<?php echo htmlspecialchars($inputId); ?>" name="<?php echo htmlspecialchars($inputName); ?>" rows="<?php echo htmlspecialchars($rows); ?>" placeholder="<?php echo htmlspecialchars($placeholder); ?>" class="mt-1 block w-full rounded-md border border-white px-3 py-2 text-white bg-natural sm:text-sm outline-none placeholder-contentColor1" style="height: <?php echo htmlspecialchars($height); ?>px;">

            </textarea>
        <?php else : ?>
            <input type="text" id="<?php echo htmlspecialchars($inputId); ?>" name="<?php echo htmlspecialchars($inputName); ?>" placeholder="<?php echo htmlspecialchars($placeholder); ?>" class="mt-1 block w-full rounded-md border border-white px-3 py-2 bg-natural text-white sm:text-sm outline-none" style="height: <?php echo htmlspecialchars($height); ?>px;">
        <?php endif; ?>
    </div>
<?php
}
?>