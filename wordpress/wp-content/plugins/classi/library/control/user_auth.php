<?php
global $pagenow;
// check to prevent php "notice: undefined index" msg
if (isset($_GET['action']))
    $theaction = $_GET['action']; else
    $theaction = '';

// if the user is on the login page, then let the site begin
if ($pagenow == 'wp-login.php' && $theaction != 'logout' && !isset($_GET['key'])) :
    add_action('init', 'cc_login_init', 98);
endif;

/**
 * Function Name:  cc_login_init
 * Description: This function gets the 
 * Page request and routes to 
 * Particular page
 */
function cc_login_init() {
    nocache_headers(); //cache clear

    if (isset($_REQUEST['action'])) :
        $action = $_REQUEST['action'];
    else :
        $action = 'login';
    endif;
    switch ($action) :
        case 'lostpassword' :
        case 'retrievepassword' :
            cc_show_password();
            break;
        case 'register':
        case 'login':
        default:
            cc_show_login();
            break;
    endswitch;
    exit;
}

function cc_login_proceed_form() {

    global $posted;
    if (isset($_REQUEST['redirect_to']))
        $redirect_to = $_REQUEST['redirect_to'];
    else
        $redirect_to = admin_url();
    if (is_ssl() && force_ssl_login() && !force_ssl_admin() && ( 0 !== strpos($redirect_to, 'https') ) && ( 0 === strpos($redirect_to, 'http') ))
        $secure_cookie = false;
    else
        $secure_cookie = '';

    $user = wp_signon('', $secure_cookie);
    $redirect_to = apply_filters('login_redirect', $redirect_to, isset($_REQUEST['redirect_to']) ? $_REQUEST['redirect_to'] : '', $user);
    if (!is_wp_error($user)) {
        if (user_can($user, 'manage_options')) :
            $redirect_to = admin_url();
        endif;
        wp_safe_redirect($redirect_to);
        exit;
    }
    $errors = $user;
    return $errors;
}

function cc_reg_proceed_form($success_redirect = '') {

    if (!$success_redirect)
        $success_redirect = site_url();
    $multi_site = WP_ALLOW_MULTISITE;
    if (get_option('users_can_register') || $multi_site == true) :

        global $posted;

        $posted = array();
        $errors = new WP_Error();

        if (isset($_POST['register']) && $_POST['register']) {

            require_once( ABSPATH . WPINC . '/registration.php');

            // Get (and clean) data
            $fields = array(
                'your_username',
                'your_email',
                'your_password',
                'your_password_2'
            );
            foreach ($fields as $field) {
                $posted[$field] = stripslashes(trim($_POST[$field]));
            }

            $user_login = sanitize_user($posted['your_username']);
            $user_email = apply_filters('user_registration_email', $posted['your_email']);

            // Check the username
            if ($posted['your_username'] == '')
                $errors->add('empty_username', __('<strong>ERROR</strong>: ' . ERR_ENTER_NAME, THEME_SLUG));
            elseif (!validate_username($posted['your_username'])) {
                $errors->add('invalid_username', __('<strong>ERROR</strong>: ' . ERR_INVILID_NM, THEME_SLUG));
                $posted['your_username'] = '';
            } elseif (username_exists($posted['your_username']))
                $errors->add('username_exists', __('<strong>ERROR</strong>: ' . ERR_ALREADY_REGISTERED, THEME_SLUG));

            // Check the e-mail address
            if ($posted['your_email'] == '') {
                $errors->add('empty_email', __('<strong>ERROR</strong>: ' . ERR_TYPE_EMAIL, THEME_SLUG));
            } elseif (!is_email($posted['your_email'])) {
                $errors->add('invalid_email', __('<strong>ERROR</strong>: ' . ERR_WRONG_EMAIL, THEME_SLUG));
                $posted['your_email'] = '';
            } elseif (email_exists($posted['your_email']))
                $errors->add('email_exists', __('<strong>ERROR</strong>: ' . ERR_ALREADY_EMAIL, THEME_SLUG));

            // Check Passwords match
            if ($posted['your_password'] == '')
                $errors->add('empty_password', __('<strong>ERROR</strong>: ' . ERR_ENTER_PW, THEME_SLUG));
            elseif ($posted['your_password_2'] == '')
                $errors->add('empty_password', __('<strong>ERROR</strong>: ' . ERR_ENTER_PWAGAIN, THEME_SLUG));
            elseif ($posted['your_password'] !== $posted['your_password_2'])
                $errors->add('wrong_password', __('<strong>ERROR</strong>: ' . ERR_PW_DONTMATCH, THEME_SLUG));

            do_action('register_post', $posted['your_username'], $posted['your_email'], $errors);
            $errors = apply_filters('registration_errors', $errors, $posted['your_username'], $posted['your_email']);

            if (!$errors->get_error_code()) {
                $user_pass = $posted['your_password'];
                $user_id = wp_create_user($posted['your_username'], $user_pass, $posted['your_email']);
                if (!$user_id) {
                    $errors->add('registerfail', sprintf(__('<strong>ERROR</strong>: '.ERR_CONTACT.'</a> !', THEME_SLUG), get_option('admin_email')));
                    return array('errors' => $errors, 'posted' => $posted);
                }

                // Change role
                wp_update_user(array('ID' => $user_id, 'role' => 'contributor'));

                wp_new_user_notification($user_id, $user_pass);

                $secure_cookie = is_ssl() ? true : false;

                wp_set_auth_cookie($user_id, true, $secure_cookie);

                ### Redirect
                wp_redirect($success_redirect);
                exit;
            } else {
                return array('errors' => $errors, 'posted' => $posted);
            }
        }
    endif;
}

function cc_login_form() {
    ?>
    <h1><?php echo SIGN_OR_CREATE; ?></h1>
    <div id="loginform">
        <form id="loginform" action="<?php bloginfo('url') ?>/wp-login.php" method="post">
            <h1 class="form_tag"><?php echo SIGN_IN; ?></h1>
            <div class="label">
                <label for="username"><?php echo USER_NAME; ?><span class="required">*</span></label>
            </div>
            <div class="row">
                <input type="text" name="log" id="username" value="<?php echo esc_attr(stripslashes($user_login)); ?>"/>
            </div>
            <div class="label">
                <label for="password"><?php echo PW; ?><span class="required">*</span></label>
            </div>
            <div class="row">
                <input type="password" name="pwd" id="password"/>
            </div>
            <input class="submit" type="submit" name="login" value="Log In"/>
            <a href="<?php echo site_url('wp-login.php?action=lostpassword'); ?>" class="forgot_password" ><?php echo LST_PW; ?></a>
            <input type="hidden" name="redirect_to" value="<?php echo $_SERVER['REQUEST_URI']; ?>" />
            <input type="hidden" name="user-cookie" value="1" />	
    </div>  
    <?php
}

function cc_reg_form() {
    global $posted;
    $multi_site = WP_ALLOW_MULTISITE;
    if (get_option('users_can_register') || $multi_site == true) :
        if (!$action)
            $action = site_url('wp-login.php?action=register');
        ?>
        <div id="register">
            <form id="register" name="registration" action="<?php echo $action; ?>" method="post">
                <h1 class="form_tag"><?php echo CREATE_AC; ?></h1>
                <div class="label">
                    <label for="username"><?php echo UNM; ?><span class="required">*</span></label>
                </div>
                <div class="row">
                    <input type="text" name="your_username" id="username" value="<?php if (isset($posted['your_username'])) echo $posted['your_username']; ?>"/>
                </div>
                <div class="label">
                    <label for="email"><?php echo EMAIL; ?><span class="required">*</span></label>
                </div>
                <div class="row">
                    <input type="text" name="your_email" id="email" value="<?php if (isset($posted['your_email'])) echo $posted['your_email']; ?>"/>
                </div>
                <div class="label">
                    <label for="password1"><?php echo ENTR_PW; ?><span class="required">*</span></label>
                </div>
                <div class="row">
                    <input type="password" name="your_password" id="password1" value=""/>
                </div>
                <div class="label">
                    <label for="password2"><?php echo ENTR_PW_AGAIN; ?><span class="required">*</span></label>
                </div>
                <div class="row">
                    <input type="password" name="your_password_2" id="password2" value=""/>
                </div>
                <input type="submit" name="register" value="<?php echo REGISTER; ?>" class="submit" tabindex="103" />
                <input type="hidden" name="user-cookie" value="1" />
            </form>
        </div>
        <?php
    endif;
}

function cc_show_login() {
    global $posted, $errors;

    if (isset($_POST['register']) && $_POST['register']) {
        $result = cc_reg_proceed_form();

        $errors = $result['errors'];
        $posted = $result['posted'];
    } elseif (isset($_POST['login']) && $_POST['login']) {

        $errors = cc_login_proceed_form();
    }

    // Clear errors if loggedout is set.
    if (!empty($_GET['loggedout']))
        $errors = new WP_Error();

    // If cookies are disabled we can't log in even with a valid user+pass
    if (isset($_POST['testcookie']) && empty($_COOKIE[TEST_COOKIE]))
        $errors->add('test_cookie', TEST_COOKIE);

    if (isset($_GET['loggedout']) && TRUE == $_GET['loggedout'])
        $notify = U_LOGGEDOUT;

    elseif (isset($_GET['registration']) && 'disabled' == $_GET['registration'])
        $errors->add('registerdisabled', REGISTR_NT_ALWD);

    elseif (isset($_GET['checkemail']) && 'confirm' == $_GET['checkemail'])
        $notify = CHECK_EMAIL;

    elseif (isset($_GET['checkemail']) && 'newpass' == $_GET['checkemail'])
        $notify = CHECK_EMAIL_FOPW;

    elseif (isset($_GET['checkemail']) && 'registered' == $_GET['checkemail'])
        $notify = REG_CMPLETE;
    if (is_user_logged_in()) {
        wp_redirect(site_url());
    }
    if (is_user_logged_in()) {
        global $wpdb, $current_user;
        $userRole = ($current_user->data->wp_capabilities);
        $role = key($userRole);
        unset($userRole);
        $edit_anchr = '';
        switch ($role) {
            case ('administrator' || 'editor' || 'contributor' || 'author'):
                break;
            default:
                break;
        }
    }
    get_header();
    ?>
    <!--Start Cotent Wrapper-->
    <div class="content_wrapper">
        <div class="container_24">
            <div class="grid_24">
                <div class="grid_17 alpha">
                    <!--Start Cotent-->
                    <div class="content">
                        <h1 class="page_title"><?php the_title(); ?></h1>
                        <?php
                        if (isset($notify) && !empty($notify)) {
                            echo '<p class="success">' . $notify . '</p>';
                        }
                        //Showing login or register error
                        if (isset($errors) && sizeof($errors) > 0 && $errors->get_error_code()) :
                            echo '<ul id="error" class="error">';
                            foreach ($errors->errors as $error) {
                                echo '<li>' . $error[0] . '</li>';
                            }
                            echo '</ul>';
                        endif;
                        cc_login_form();
                        cc_reg_form();
                        ?>
                        <div class="clear"></div>
                    </div>
                    <!--End Cotent-->
                </div>
                <div class="grid_7 omega">
                    <?php get_sidebar('ad'); ?>
                </div>
            </div>
            <div class="clear"></div>
        </div>
    </div>
    <!--End Cotent Wrapper-->
    <?php
    get_footer();
}

/**
 * Function Name:  cc_show_password
 * Description: This function creates
 * The forgot password page
 */
function cc_show_password() {
    $errors = new WP_Error();

    if (isset($_POST['user_login']) && $_POST['user_login']) {
        $errors = retrieve_password();

        if (!is_wp_error($errors)) {
            wp_redirect('wp-login.php?checkemail=confirm');
            exit();
        }
    }

    if (isset($_GET['error']) && 'invalidkey' == $_GET['error'])
        $errors->add('invalidkey', SORRY_THAT);

    do_action('lost_password');
    do_action('lostpassword_post');
//Call header.php
    get_header();
    ?>
    <!--Start Cotent Wrapper-->
    <div class="content_wrapper">
        <div class="container_24">
            <div class="grid_24">
                <div class="grid_17 alpha">
                    <!--Start Cotent-->
                    <div class="content">
                        <?php
                        if (isset($notify) && !empty($notify)) {
                            echo '<p class="success">' . $notify . '</p>';
                        }
                        ?>
                        <?php
                        if ($errors && sizeof($errors) > 0 && $errors->get_error_code()) :
                            echo '<ul class="error">';
                            foreach ($errors->errors as $error) {
                                echo '<li>' . $error[0] . '</li>';
                            }
                            echo '</ul>';
                        endif;
                        ?>
                        <?php cc_lost_pw(); ?>  
                        <div class="clear"></div>
                    </div>
                    <!--End Cotent-->
                </div>
                <div class="grid_7 omega">
                    <?php get_sidebar('ad'); ?>
                </div>
            </div>
            <div class="clear"></div>
        </div>
    </div>
    <!--End Cotent Wrapper-->
    <?php
//Call footer.php
    get_footer();
}
function cc_lost_pw() {
    ?>
    <div id="fotget_pw">
        <div class="line" style="margin-top: 15px; margin-bottom: 15px;"></div>
        <h3><?php echo FORGOT_PW; ?></h3>        
        <form method="post" action="<?php echo site_url('wp-login.php?action=lostpassword', 'login_post') ?>" class="wp-user-form">
            <div class="row">
                <label for="user_login" class="hide"><?php echo ENTER_EMAIL_UNM; ?>: </label><br/>               
                <input type="text" name="user_login" value="" size="20" id="user_login" />
            </div>
            <div class="row">
                <?php do_action('login_form', 'resetpass'); ?>
                <input type="submit" name="user-submit" value="<?php echo RESET_PW; ?>" class="user-submit" />
                <?php
                $reset = $_GET['reset'];
                if ($reset == true) {
                    echo '<p>' . A_MSG_SENT . '</p>';
                }
                ?>
                <input type="hidden" name="redirect_to" value="<?php echo $_SERVER['REQUEST_URI']; ?>?reset=true" />
                <input type="hidden" name="user-cookie" value="1" />
            </div>
        </form>
    </div>
    <?php
}