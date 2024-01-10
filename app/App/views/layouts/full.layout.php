<?php loadPartial('head'); ?>
<?php loadPartial('navbar'); ?>

<?php if (isset($viewName)) {
    if (!isset($data)) $data = [];
    loadView($viewName, $data);
} ?>

<?php loadPartial('bottom-banner'); ?>
<?php loadPartial('footer'); ?>