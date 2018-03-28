<!DOCTYPE html>
<html lang="en">
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $site_title; ?></title>
    <meta name="description" content="<?= $site_desc; ?>" />
    <meta name="keywords" content="<?= $site_keywords; ?>" />

    <!-- SITE INDEX -->
    <?php if (isset($site_index) && $site_index == 1): ?>
        <meta name="robots" content="index, follow" />
    <?php else: ?>
        <meta name="robots" content="noindex, nofollow" />
    <?php endif ?>
   
    

    <?= $this->Html->meta('icon') ?>
    <?= $this->Html->css('general.css') ?>
    <?= $this->Html->css('fonts.css') ?>
    <?= $this->Html->css('media.css') ?>
    <?= $this->Html->css('bootstrap.min.css') ?>
    <?= $this->Html->css('owl.carousel.css') ?>
    <?= $this->Html->css('jquery.fancybox.css') ?>
    
    <script src="//yastatic.net/es5-shims/0.0.2/es5-shims.min.js"></script>
    <script src="//yastatic.net/share2/share.js"></script>
    <script type="text/javascript">var RS = "<?= RS ?>";</script>
    <?= $intro_head['head_scr']; ?>
</head>
<body class="body">
    <div id="wrapper">
        <?php require('inc/header.php') ?> <!-- HEADER -->
        <?php require('inc/mob_menu.php'); ?>

        <?php

            if (LA != 'home') {
                 include('inc/low_banner.php');
            }
        ?>
        <div id="content_wrapper">
            <?php
                echo $this->fetch('content');   /*CONTENT*/
            ?>
        </div>

        <?php require('inc/footer.php') ?> <!-- FOOTER -->
    </div>


    <!-- <script src="//yastatic.net/es5-shims/0.0.2/es5-shims.min.js"></script>
    <script src="//yastatic.net/share2/share.js"></script>
    <div class="ya-share2" data-services="vkontakte,facebook,odnoklassniki,gplus,twitter,linkedin" data-size="s"></div> -->

    
    <?php require("modals/view.modals.php");  ?> 
    <?= $intro_foot['foot_scr']; ?>
</body>
    <?= $this->Html->script('jquery-1.9.1.min.js') ?>
    <?= $this->Html->script('nicescroll.js') ?>
    <?= $this->Html->script('bootstrap.min.js') ?>
    <?= $this->Html->script('owl.carousel.js') ?>
    <?= $this->Html->script('fliplightbox.min.js') ?>
    <?= $this->Html->script('jquery.fancybox.pack.js') ?>
    <?= $this->Html->script('jquery.fancybox.js') ?>
    <?= $this->Html->script('custom.js') ?>
    
</html>