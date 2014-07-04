<?php
$font_dir = get_template_directory_uri() . '/lib/fonts/museo300/';
?>

@font-face {

 font-family: 'Museo';
    src: url('<?php echo $font_dir; ?>museo300-regular-webfont.eot');
    src: url('<?php echo $font_dir; ?>museo300-regular-webfont.eot?#iefix') format('embedded-opentype'),
         url('<?php echo $font_dir; ?>museo300-regular-webfont.woff') format('woff'),
         url('<?php echo $font_dir; ?>museo300-regular-webfont.ttf') format('truetype'),
         url('<?php echo $font_dir; ?>museo300-regular-webfont.svg#museo_300regular') format('svg');
    font-weight: normal;
    font-style: normal;
}