<?php
global $bp_active,$options;
foreach ($options as $value) {
if (get_option( $value['id'] ) === FALSE) {
$$value['id'] = $value['default'];
} else {
$$value['id'] = get_option( $value['id'] ); }
}
?>