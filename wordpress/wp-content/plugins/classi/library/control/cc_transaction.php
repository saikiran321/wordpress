<?php
/**
 * Transaction handler and store payment transaction 
 */
if (isset($_REQUEST['rtype']) && $_REQUEST['rtype'] == 'tstatus') {
    get_header();
    ?>
    <!--Start Cotent Wrapper-->
    <div class="content_wrapper">
        <div class="container_24">
            <div class="grid_24">
                <div class="grid_17 alpha">
                    <!--Start Cotent-->
                    <div class="content">
                        <h1 class="page_title"><?php echo PMT_TRANSACTION; ?></h1>
                        <?php
                        global $current_user;
                        get_currentuserinfo();

                        $to_admin = get_option('admin_email');
                        $store_name = get_option('blogname');

                        //Getting paypal response values
                        $item_name = $_REQUEST['item_name'];
                        $item_number = $_REQUEST['item_number'];
                        $payment_status = $_REQUEST['payment_status'];
                        $payment_amount = $_REQUEST['mc_gross'];
                        $payment_currency = $_REQUEST['mc_currency'];
                        $txn_id = $_REQUEST['txn_id'];
                        $receiver_email = $_REQUEST['receiver_email'];
                        $payer_email = $_REQUEST['payer_email'];
                        $payment_method = $_REQUEST['pay_method'];
                        global $wpdb;
                        $post_id = $_REQUEST['post_id'];
                        if ($post_id != '') {
                            $return_value = $wpdb->get_row("select * from $wpdb->posts where ID = '" . $post_id . "'");
                        }
                        $post_author = $return_value->post_author;
                        $userid = $current_user->ID;
                        $post_title = $_REQUEST['post_title'];
                        if ($payment_status == 'Completed') {
                            $status = 1;
                            $post_status_to_admin = "Payment Received";
                            $post_status_to_client = "Your @" . $store_name . " is successfully completed.";
                        }

                        $pay_date = current_time('mysql');
                        $user_name = $current_user->user_login;
                        $billing_name = $current_user->display_name;
                        $billing_add = '';
                        $sql = "select * from $transection_table_name where paypal_transection_id='$txn_id'";
                        $sql_stat = $wpdb->get_row($sql);

                        //Inserting transaction details in transaction table
                        global $transection_table_name;
                        if (empty($sql_stat)):
                            $wpdb->insert($transection_table_name, array(
                                "user_id" => $userid,
                                "post_id" => $post_id,
                                "post_title" => $post_title,
                                "status" => $status,
                                "payment_method" => $payment_method,
                                "payable_amt" => $payment_amount,
                                "payment_date" => $pay_date,
                                "paypal_transection_id" => $txn_id,
                                "user_name" => $user_name,
                                "pay_email" => $payer_email,
                                "billing_name" => $billing_name,
                                "billing_add" => $billing_add
                            ));
                        endif;

                        //set post pending to publish
                        if (($post_id != '') && ($status == 1)):
                            global $wpdb;
                            $post_status = cc_get_option('cc_paidad');
                            if ($post_status == 'pending'):
                                $post_status = 'pending';
                            elseif ($post_status == 'publish'):
                                $post_status = 'publish';
                            elseif ($post_status == ''):
                                $post_status = 'publish';
                            endif;
                            $my_post = array(
                                'ID' => $post_id,
                                'post_status' => $post_status
                            );
                            wp_update_post($my_post);
                        endif;

                        /**
                         * Send transaction notification to admin or client
                         */
                        $transaction_details .= "--------------------------------------------------------------------------------\r";
                        $transaction_details .= "Payment Details for Listing ID #$post_id\r";
                        $transaction_details .= "--------------------------------------------------------------------------------\r";
                        $transaction_details .= "Listing Title: $post_title \r";
                        $transaction_details .= "--------------------------------------------------------------------------------\r";
                        $transaction_details .= "Trans ID: $txn_id\r";
                        $transaction_details .= "Status: $payment_status\r";
                        $transaction_details .= "Date: $pay_date\r";
                        $transaction_details .= "Payment Method: $payment_method\r";
                        $transaction_details .= "--------------------------------------------------------------------------------\r";
                        $transaction_details = __($transaction_details, THEME_SLUG);
                        $subject = __("Listing Submitted and Payment Success Confirmation Email", THEME_SLUG);

                        $site_name = get_option('blogname');
                        $fromEmail = 'Admin';
                        $filecontent = $transaction_details;
                        global $wpdb;
                        $placeinfosql = "SELECT ID, post_title, guid, post_author from $wpdb->posts where ID =$post_id";
                        $placeinfo = $wpdb->get_results($placeinfosql);
                        foreach ($placeinfo as $placeinfoObj) {
                            $post_link = $placeinfoObj->guid;
                            $post_title = '<a href="' . $post_link . '">' . $placeinfoObj->post_title . '</a>';
                            $authorinfo = $placeinfoObj->post_author;
                            $userInfo = cc_get_author_info($authorinfo);
                            $to_name = $userInfo->user_nicename;
                            $to_email = $userInfo->user_email;
                            $user_email = $userInfo->user_email;
                        }

                        $headers = 'From: ' . $fromEmail . ' <' . $to_admin . '>' . "\r\n" . 'Reply-To: ' . $fromEmail;
                        //mail($to_admin, $subject, $filecontent, $headers);
                        wp_mail($to_admin, $subject, $filecontent, $headers); //email to admin

                        $subject = "Listing Submitted and Payment Success Confirmation Email";

                        $transaction_details .= "Information Submitted URL\r";
                        $transaction_details .= "--------------------------------------------------------------------------------\r";
                        $transaction_details .= "Site Name: $store_name----------------------------------------------------------\r";
                        $transaction_details .= "--------------------------------------------------------------------------------\r";
                        $transaction_details .= "$post_title\r";
                        $transaction_details = __($transaction_details, THEME_SLUG);
                        $content = $transaction_details;
                        $headers = 'From: ' . $to_admin . ' <' . $user_email . '>' . "\r\n" . 'Reply-To: ' . $to_admin;
                        wp_mail($user_email, $subject, $content, $headers); //email to client
                        //Displaying transaction status to user
                        echo POST_NAME."&nbsp;&nbsp;<b>" . $item_name . '</b><br/>';
                        //echo "Your Post Number:&nbsp;&nbsp;<b>" . $item_number . '</b><br/>';
                        echo PMT_STATUS."&nbsp;&nbsp;<b>" . $payment_status . '</b><br/>';
                        echo PMT_AMT."&nbsp;&nbsp;<b>" . $payment_amount . '</b><br/>';
                        echo PMT_CURRENCY."&nbsp;&nbsp;<b>" . $payment_currency . '</b><br/>';
                        echo TRANS_ID."&nbsp;&nbsp;<b>" . $txn_id . '</b><br/>';
                        echo PAYER_EMAIL."&nbsp;&nbsp;<b>" . $payer_email . '</b><br/>';
                        
                        $total_amount = $payment_amount;
                        $upgrade_meta_values = get_post_meta($post_id, 'cc_add_type', true);
                        if ($upgrade_meta_values == "free") {
                            cc_upgrade_listing($post_id, $total_amount);
                        }
                        ?>
                    </div>
                    <!--End Cotent-->
                </div>
                <div class="grid_7 omega">
                <?php get_sidebar(); ?>
                </div>
            </div>
            <div class="clear"></div>
        </div>
    </div>
    <!--End Cotent Wrapper-->
    <?php
    get_footer();
}
?>