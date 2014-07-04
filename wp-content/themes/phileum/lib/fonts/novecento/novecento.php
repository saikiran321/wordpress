<?php
$font_loc = get_template_directory_uri() . '/lib/fonts/novecento/';
?>


@font-face {
    font-family: 'Novecento';
    src: url('<?php echo $font_loc; ?>novecentowide-bold-webfont.eot');
    src: url('<?php echo $font_loc; ?>novecentowide-bold-webfont.eot?#iefix') format('embedded-opentype'),
         url('<?php echo $font_loc; ?>novecentowide-bold-webfont.woff') format('woff'),
         url('<?php echo $font_loc; ?>novecentowide-bold-webfont.ttf') format('truetype'),
         url('<?php echo $font_loc; ?>novecentowide-bold-webfont.svg#novecento_wide_bookbold') format('svg');
    font-weight: normal;
    font-style: normal;

}