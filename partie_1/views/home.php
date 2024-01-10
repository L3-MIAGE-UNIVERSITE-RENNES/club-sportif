<?php require('../controllers/auth/guard.php'); ?><!DOCTYPE html>
<?php ob_start(); ?>
<div class="d-flex justify-content-center align-items-center mt-5">
    <div class="card mx-auto w-50">
        <p class="display-4 text-center font-weight-bold m-auto">BIENVENUE</p>
    </div>
</div
<?php $content = ob_get_clean(); ?>

<?php require('layout.php') ?>