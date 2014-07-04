<?php
$sponsor_banner1 = get_theme_option('sponsor_banner_one');
$sponsor_banner2 = get_theme_option('sponsor_banner_two');
$sponsor_banner3 = get_theme_option('sponsor_banner_three');
$sponsor_banner4 = get_theme_option('sponsor_banner_four');
$sponsor_banner5 = get_theme_option('sponsor_banner_five');
$sponsor_banner6 = get_theme_option('sponsor_banner_six');
?>

<?php if(!$sponsor_banner1 && !$sponsor_banner2 && !$sponsor_banner3 && !$sponsor_banner4 && !$sponsor_banner5 && !$sponsor_banner6): ?>
<?php else: ?>
<aside id="sponsorbox" class="widget">
<h3 class="widget-title"><?php _e('Advertisment', TEMPLATE_DOMAIN); ?></h3>
<div id="sponsorlinks">

<?php if($sponsor_banner1 == '') { ?>
<?php { /* nothing */ } ?>
<?php } else { ?>
<?php echo stripcslashes($sponsor_banner1); ?>
<?php } ?>

<?php if($sponsor_banner2 == '') { ?>
<?php { /* nothing */ } ?>
<?php } else { ?>
<?php echo stripcslashes($sponsor_banner2); ?>
<?php } ?>

<?php if($sponsor_banner3 == '') { ?>
<?php { /* nothing */ } ?>
<?php } else { ?>
<?php echo stripcslashes($sponsor_banner3); ?>
<?php } ?>

<?php if($sponsor_banner4 == '') { ?>
<?php { /* nothing */ } ?>
<?php } else { ?>
<?php echo stripcslashes($sponsor_banner4); ?>
<?php } ?>

<?php if($sponsor_banner5 == '') { ?>
<?php { /* nothing */ } ?>
<?php } else { ?>
<?php echo stripcslashes($sponsor_banner5); ?>
<?php } ?>

<?php if($sponsor_banner6 == '') { ?>
<?php { /* nothing */ } ?>
<?php } else { ?>
<?php echo stripcslashes($sponsor_banner6); ?>
<?php } ?>

</div><!-- SPONSOR LINKS END -->
<div class="sidepagedown"></div></aside><!-- SPONSORBOX END -->
<?php endif; ?>