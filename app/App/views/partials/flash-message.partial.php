<?php if(isset($_SESSION['success_message'])) : ?>
    <div class="message bg-green-100 p-3 my-3">
        <?= $_SESSION['success_message'] ?>
    </div>
<?php unset($_SESSION['success_message']) ?>
<?php endif; ?>

<?php if(isset($_SESSION['error_message'])) : ?>
    <div class="message bg-red-100 p-3 my-3">
        <?= $_SESSION['error_message'] ?>
    </div>
    <?php unset($_SESSION['error_message']) ?>
<?php endif; ?>

<?php if(isset($_SESSION['warning_message'])) : ?>
    <div class="message bg-yellow-100 p-3 my-3">
        <?= $_SESSION['warning_message'] ?>
    </div>
    <?php unset($_SESSION['warning_message']) ?>
<?php endif; ?>

<?php if(isset($_SESSION['info_message'])) : ?>
    <div class="message bg-blue-100 p-3 my-3">
        <?= $_SESSION['info_message'] ?>
    </div>
    <?php unset($_SESSION['info_message']) ?>
<?php endif; ?>
