<?php

class cc_manage_currency {

    function cc_currency() {
        global $wpdb, $currency_tbl_name;
        $sql = "SELECT * FROM  $currency_tbl_name";
        $currencys = $wpdb->get_results($sql);
   
        if (file_exists(VIEWPATH . "currency.php")):
            require_once(VIEWPATH . "currency.php");
        endif;
    }

}

?>
