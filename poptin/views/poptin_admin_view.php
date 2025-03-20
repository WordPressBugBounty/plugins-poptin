<?php
// Prevent direct file access
if (!defined('ABSPATH')) {
    exit;
}

if (!current_user_can('manage_options')) {
    wp_die(__('You do not have sufficient permissions to access this page.'));
}

$poptinidcheck = get_option('poptin_id', (isset($myOption_def) ? $myOption_def : false));

$poptin_marketplace_token_check = get_option('poptin_marketplace_token', (isset($myOption_def) ? $myOption_def : false));
$poptin_marketplace_email_id_check = get_option('poptin_marketplace_email_id', (isset($myOption_def) ? $myOption_def : false));
$go_to_dashboard_url = "https://app.popt.in/";

/**
 * We need to pre-fill the email ID of the WP Admin site.
 * The same would be stored in an option as well, for confirmation purposes.
 * Everything looks settled here now.
 */
$admin_email = get_bloginfo('admin_email');


if ($poptin_marketplace_token_check && $poptin_marketplace_email_id_check) {
    $go_to_dashboard_url = admin_url("admin.php?page=Poptin&poptin_logmein=true");
}

?>
<script type="text/javascript">
    <?php if ($poptin_marketplace_token_check && $poptin_marketplace_email_id_check) { ?>
        var do_auto_login = false;
    <?php } else { ?>
        var do_auto_login = false;
    <?php } ?>
</script>
<!-- Main wrapper -->
<div class="poptin-overlay"></div>

<div class="poptin">

    <div class="wrap">

        <h1></h1>
        <div class="poptinWrap d-flex">
            <div class="poptinContentBox">
                <div class="poptinLogo">
                    <img src="<?php echo POPTIN_URL . '/assets/images/poptinlogo.png' ?>" width="147px" />
                </div>

                <div class="poptinLogged" style="<?php echo ($poptinidcheck ? 'display:block' : 'display:none') ?>">
                    <div class="poptinView">
                        <div class="title"><?php _e("You’re All Set 🎉", 'ppbase'); ?></div>
                        <h4 class="description">
                            <?php _e(" Poptin is installed on your website ", 'ppbase'); ?>
                        </h4>

                        <!-- <form id="" class="ppFormRegister ppForm" action="" target="" method="POST"> -->
                        <a class="cbutton dashboard-link goto_dashboard_button_pp_updatable" href="<?php echo esc_url($go_to_dashboard_url) ?>" target="_blank">
                            Go to your Dashboard <img src="<?php echo POPTIN_URL . '/assets/images/polygon.svg' ?>" alt="">
                        </a>
                        <div class="other-links d-flex justify-center">
                            <span><?php _e("Click on the button to create and manage your poptins", "ppbase"); ?> </span>
                        </div>

                        <div class="footer">
                            <div class="important-note d-flex justify-start">
                                <img src="<?php echo POPTIN_URL . '/assets/images/important-note.png' ?>" width="24px" height="24px" />
                                <p>
                                    <b>Note: </b> If you have a cache plugin, please delete cache so the code will be updated.
                                    If you use WP-Rocket, <a href="https://help.poptin.com/article/show/87331-how-to-exclude-poptin-s-snippet-from-wp-rocket" target="_blank"> follow this guide</a>.
                                </p>
                            </div>
                            <div class="pplogout">
                                <a href="#">
                                    Deactivate poptin >
                                </a>
                            </div>
                        </div>
                        <!-- </form> -->
                    </div>
                </div>
                <div class="ppaccountmanager" style="<?php echo ($poptinidcheck ? 'display:none' : 'display:block') ?>">

                    <div class="poptinView popotinRegister">
                        <div class="title"><?php _e("Sign Up for Free", 'ppbase'); ?></div>
                        <h4 class="description"><?php _e("👉 Create beautiful pop ups and forms", 'ppbase'); ?></h4>

                        <form id="registration_form" class="ppFormRegister ppForm" action="" target="" method="POST">
                            <div class="tooltip-enable">
                                <div class="tooltip d-flex align-center" id="oopsiewrongemailid" style="display: none;">
                                    <img src="<?php echo POPTIN_URL . '/assets/images/squircle.png' ?>" width="24px" />
                                    Oopsie... Please enter a valid email address
                                </div>
                                <div class="input-controls">
                                    <input class="poptin_input" type="text" name="email" id="poptinRegisterEmail" autofocus name="email" value="">
                                    <label>Enter your email</label>
                                </div>
                                <!-- <input class="poptin_input" type="text" id="poptinRegisterEmail" name="email" placeholder="Enter your email" autofocus value="<?php ?>" placeholder="example@poptin.com" /> -->
                            </div>

                            <input type="hidden" name="action" class="poptin_input" value="poptin_register" />
                            <input type="hidden" name="register" class="poptin_input" value="true" />
                            <input type="hidden" name="security" class="poptin_input" value="<?php echo wp_create_nonce("poptin-fe-register"); ?>" />
                            <button class="ppSubmit pp_signup_btn poptin_signup_button">
                                <span class="text-content">
                                    Sign Up <img src="<?php echo POPTIN_URL . '/assets/images/polygon.svg' ?>" alt="">
                                </span>

                                <span class="loader" style="display: none;">
                                    <div class="lds-ellipsis">
                                        <div></div>
                                        <div></div>
                                        <div></div>
                                        <div></div>
                                    </div>
                                </span>
                            </button>
                            <div class="other-links">
                                <a href="#" class="ppLogin"><?php _e("Already have an account?", "ppbase"); ?> </a>
                            </div>
                        </form>
                    </div>
                    <div class="poptinView popotinLogin" style="display: none;">
                        <div class="title"><?php _e("You Look Familiar", 'ppbase'); ?></div>

                        <form id="map_poptin_id_form" class="ppFormLogin ppForm">
                            <div class="user-id d-flex justify-end">
                                <a href="#" data-toggle="modal" data-keyboard="true" class="wheremyid"><?php _e("Where is my user ID?", 'ppbase'); ?></a>
                            </div>
                            <div class="tooltip-enable">
                                <div class="tooltip d-flex align-center" id="oopsiewrongid" style="display: none;">
                                    <img src="<?php echo POPTIN_URL . '/assets/images/squircicle-error.svg' ?>" width="24px" />
                                    <div>
                                        Oopsie... Wrong user ID. <a href="#" data-toggle="modal" class="wheremyid"><?php _e("Where is my user ID?", 'ppbase'); ?></a>
                                    </div>

                                </div>
                                <div class="input-controls">
                                    <input type="text" class="poptin_input" autofocus id="poptinUserId">
                                    <label>Enter your User ID</label>
                                </div>
                            </div>
                            <button class="ppSubmit poptin_submit_button">
                                <span class="text-content">
                                    Connect <img src="<?php echo POPTIN_URL . '/assets/images/polygon.svg' ?>" alt="">
                                </span>
                                <span class="loader" style="display: none;">
                                    <div class="lds-ellipsis">
                                        <div></div>
                                        <div></div>
                                        <div></div>
                                        <div></div>
                                    </div>
                                </span>
                            </button>
                            <input type="hidden" id="ppFormIdRegister" value="<?php echo wp_create_nonce("ppFormIdRegister") ?>">
                            <div class="other-links">
                                <a href="#" class="ppRegister"><?php _e("Or, create a new Poptin account", "ppbase"); ?> </a>
                            </div>
                        </form>
                    </div>
                    <div class="poptinContentFoot d-flex justify-space-between align-center poptinWalkthroughVideoTrigger">

                        <div class="play-button d-flex align-center justify-center">
                            <!-- sg oidsioguoi dsg -->
                            <img src="<?php echo POPTIN_URL . '/assets/images/play-icon.svg' ?>" width="150px" />
                        </div>
                        <span>
                            <?php _e("Watch this short demo to learn more", "ppbase") ?>
                        </span>
                    </div>
                </div>
            </div>
            <div class="poptinFeaturesBox">
                <div class="poptinFeatures">
                    <div class="poptinFeaturesTitle">
                        <?php _e("Here’s What Poptin Can Do For You", "ppbase") ?>
                    </div>
                    <div>
                        <div class="poptinFeaturesList d-flex justify-space-between">
                            <ul>
                                <li>
                                    <img src="<?php echo POPTIN_URL . '/assets/images/list-icon.svg' ?>" />
                                    <?php _e("Drag & Drop Editor", "ppbase") ?>
                                </li>
                                <li>
                                    <img src="<?php echo POPTIN_URL . '/assets/images/list-icon.svg' ?>" />
                                    <?php _e("50+ Integrations", "ppbase") ?>
                                </li>
                                <li>
                                    <img src="<?php echo POPTIN_URL . '/assets/images/list-icon.svg' ?>" />
                                    <?php _e("A/B Testing", "ppbase") ?>
                                </li>
                                <li>
                                    <img src="<?php echo POPTIN_URL . '/assets/images/list-icon.svg' ?>" />
                                    <?php _e("Autoresponders", "ppbase") ?>
                                </li>
                                <li>
                                    <img src="<?php echo POPTIN_URL . '/assets/images/list-icon.svg' ?>" />
                                    <?php _e("Behavioral triggers", "ppbase") ?>
                                </li>
                            </ul>
                            <ul>
                                <li>
                                    <img src="<?php echo POPTIN_URL . '/assets/images/list-icon.svg' ?>" />
                                    <?php _e("Beautiful Pop Up Templates", "ppbase") ?>
                                </li>
                                <li>
                                    <img src="<?php echo POPTIN_URL . '/assets/images/list-icon.svg' ?>" />
                                    <?php _e("Built-in Analytics", "ppbase") ?>
                                </li>
                                <li>
                                    <img src="<?php echo POPTIN_URL . '/assets/images/list-icon.svg' ?>" />
                                    <?php _e("Manage Accounts", "ppbase") ?>
                                </li>
                                <li>
                                    <img src="<?php echo POPTIN_URL . '/assets/images/list-icon.svg' ?>" />
                                    <?php _e("Exit-intent Technology", "ppbase") ?>
                                </li>
                                <li>
                                    <img src="<?php echo POPTIN_URL . '/assets/images/list-icon.svg' ?>" />
                                    <?php _e("Targeting rules", "ppbase") ?>
                                </li>
                            </ul>
                        </div>
                        <div class="poptinTestimonials d-flex align-center flex-column">
                            <div class="d-flex align-center justify-center">
                                <img src="<?php echo POPTIN_URL . '/assets/images/Yuval-Haimov.png' ?>" alt="" width="52px">
                                <div class="poptinNameCompany">
                                    <div class="name"><?php _e("Yuval Haimov", "ppbase") ?></div>
                                    <div class="position"><?php _e("CEO, ClickCease", "ppbase") ?></div>
                                </div>
                            </div>
                            <div class="review">
                                <?php _e("From the moment I signed up everything was easy to use. We started converting more leads instantly. They update poptin all the time and add more and more features.", "ppbase") ?>
                            </div>
                            <div class="bar"></div>
                        </div>
                    </div>
                </div>
                <img src="<?php echo POPTIN_URL . '/assets/images/poptinWrapBg.png' ?>" alt="" srcset="">
            </div>
        </div>
        <div class="poptinWrap" id="customersWrap" style="<?php echo ($poptinidcheck ? 'display:none' : 'display:block') ?>">
            <div class="title d-flex align-center justify-center">
                <?php _e("Our customers", "ppbase") ?> <img src="<?php echo POPTIN_URL . '/assets/images/heart.svg' ?>" alt="" width="26px" height="21px" style="margin: 0px 6px"> <?php _e("Poptin", "ppbase") ?> </div>
            <div class="customersReview">
                <div class="poptinCustomer">
                    <div class="d-flex align-center">
                        <img src="<?php echo POPTIN_URL . '/assets/images/Deepak-Shukla.png' ?>" alt="" width="52px">
                        <div class="poptinNameCompany">
                            <div class="name">Deepak Shukla</div>
                            <div class="position">CEO, Pearl Lemon</div>
                        </div>
                    </div>
                    <div class="review">
                        Been v.impressed with Poptin and the team behind it so far.
                        Great responses times from support.
                        The road map looks great. I highly recommend.
                    </div>
                </div>
                <div class="poptinCustomer">
                    <div class="d-flex align-center">
                        <img src="<?php echo POPTIN_URL . '/assets/images/Liraz-P.png' ?>" alt="" width="52px">
                        <div class="poptinNameCompany">
                            <div class="name"> Liraz Postan </div>
                            <div class="position">
                                CEO, LP Marketing Services</div>
                        </div>
                    </div>
                    <div class="review">
                        The software is easy to use, super friendly UI, the support team was always there to solve any issue and product is always supporting RTM opportunities: Black Friday deals etc.
                    </div>
                </div>
                <div class="poptinCustomer">
                    <div class="d-flex align-center">
                        <img src="<?php echo POPTIN_URL . '/assets/images/Michael-Kamleitner.png' ?>" alt="" width="52px">
                        <div class="poptinNameCompany">
                            <div class="name">Michael Kamleitner </div>
                            <div class="position">CEO, Walls.io</div>
                        </div>
                    </div>
                    <div class="review">
                        Getting started with poptin was a breeze – we've implemented the widget and connected it to our newsletter within minutes. Our site's conversion rate skyrocketed!
                    </div>
                </div>
                <div class="poptinCustomer">
                    <div class="d-flex align-center">
                        <img src="<?php echo POPTIN_URL . '/assets/images/Ramesh-Gurung.png' ?>" alt="" width="52px">
                        <div class="poptinNameCompany">
                            <div class="name">Ramesh Gurung </div>
                            <div class="position">CEO, nepalpyramids</div>
                        </div>
                    </div>
                    <div class="review">
                        Have tried many other popup plugins but unfortunately, nothing actually worked for me. The only plugin that really worked with the easiest interface is Poptin. Thank you so much.
                    </div>
                </div>
                <div class="poptinCustomer">
                    <div class="d-flex align-center">
                        <img src="<?php echo POPTIN_URL . '/assets/images/Roy-Povarchik.png' ?>" alt="" width="52px">
                        <div class="poptinNameCompany">
                            <div class="name">Roy Povarchik</div>
                            <div class="position">CEO, stardom.io</div>
                        </div>
                    </div>
                    <div class="review">
                        Poptin was a crucial tool in growing our mailing list and following for our podcast “Strike Gold”. Its A/B testing features helped us improve our messaging and offer to our listeners.
                    </div>
                </div>
                <div class="poptinCustomer">
                    <div class="d-flex align-center">
                        <img src="<?php echo POPTIN_URL . '/assets/images/Myriam-Plamondon.png' ?>" alt="" width="52px">
                        <div class="poptinNameCompany">
                            <div class="name">Myriam Plamondon</div>
                            <div class="position">Founder, Talent Fou</div>
                        </div>
                    </div>
                    <div class="review">
                        Integrates flawlessly with WordPress. This plugin integrates very easily, you don’t have anything to do except activating it.
                    </div>
                </div>
            </div>
            <div class="marketplace d-flex justify-center">
                <div class="d-flex align-center">
                    <div class="pipe"></div>
                    <div>
                        <img src="<?php echo POPTIN_URL . '/assets/images/capterra-inc.svg' ?>" alt="">
                        <div class="d-flex align-center">(4.8/5) <img src="<?php echo POPTIN_URL . '/assets/images/star.svg' ?>" /></div>
                    </div>
                </div>
                <div class="d-flex align-center">
                    <div class="pipe"></div>
                    <div>
                        <img src="<?php echo POPTIN_URL . '/assets/images/wordpress.svg' ?>" class="wordpress">
                        <div class="d-flex align-center">(4.9/5) <img src="<?php echo POPTIN_URL . '/assets/images/star.svg' ?>" /></div>
                    </div>
                </div>
                <div class="d-flex align-center">
                    <div class="pipe"></div>
                    <div>
                        <img src="<?php echo POPTIN_URL . '/assets/images/g2Crowdlogo.svg' ?>" alt="">
                        <div class="d-flex align-center">(4.8/5) <img src="<?php echo POPTIN_URL . '/assets/images/star.svg' ?>" /></div>
                    </div>
                </div>
                <div class="d-flex align-center">
                    <div class="pipe"></div>
                    <div>
                        <img src="<?php echo POPTIN_URL . '/assets/images/facebook.svg' ?>" alt="">
                        <div class="d-flex align-center">(5/5) <img src="<?php echo POPTIN_URL . '/assets/images/star.svg' ?>" /></div>
                    </div>
                </div>
            </div>
            <div class="poptinLearnMore d-flex justify-center">
                <img class="parrot" src="<?php echo POPTIN_URL . '/assets/images/Parrot.svg' ?>" alt="">
                <span>
                    <a href="<?php echo POPTIN_FRONT_SITE ?>?utm_source=wordpress" target="_blank">
                        Learn more about us at poptin.com <img src="<?php echo POPTIN_URL . '/assets/images/arrow-head.svg' ?>" alt=""></a>
                </span>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div id="whereIsMyId" class="modal fade" role="dialog" data-keyboard="true">
        <div class="content d-flex align-center justify-center">
            <div class="card d-flex flex-column align-center justify-center">
                <div class="close-button" data-dismiss="modal">
                    <img src="<?php echo POPTIN_URL . '/assets/images/close-icon.svg' ?>" alt="">
                </div>
                <div class="title">
                    Where is my User ID?
                </div>
                <div class="card-content">
                    <div class="find-id-1">
                        <img src="<?php echo POPTIN_URL . '/assets/images/user-id-1.png' ?>" alt="">
                        <div class="d-flex">
                            <div class="step d-flex justify-center align-center">
                                1
                            </div>
                            <p class="step-description">
                                Go to your dashboard, in the top bar click on “Installation Code”
                            </p>
                        </div>
                    </div>
                    <div class="find-id-2">
                        <img src="<?php echo POPTIN_URL . '/assets/images/user-id-2.png' ?>" alt="">
                        <div class="d-flex">
                            <div class="step d-flex justify-center align-center">
                                2
                            </div>
                            <p class="step-description">
                                Click on WordPress
                            </p>
                        </div>
                    </div>
                    <div class="find-id-3">
                        <img src="<?php echo POPTIN_URL . '/assets/images/user-id-3.png' ?>" alt="">
                        <div class="d-flex">
                            <div class="step d-flex justify-center align-center">
                                3
                            </div>
                            <p class="step-description">
                                Copy your user ID
                            </p>
                        </div>
                    </div>
                </div>
                <div class="foot d-flex align-center">
                    <button data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- BYE BYE Modal -->
    <div id="byebyeModal" class="modal fade" role="dialog">
        <div class="content d-flex align-center justify-center">
            <div class="card d-flex align-center  flex-column">
                <div class="close-button" data-dismiss="modal">
                    <img src="<?php echo POPTIN_URL . '/assets/images/close-icon.svg' ?>" alt="">
                </div>
                <h3>Bye Bye</h3>
                <h4>Poptin snippet has been removed. <br /> See you around ✌️</h4>

                <button data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>

    <!-- Just Making Sure Modal -->
    <div id="makingsure" class="modal fade" role="dialog">
        <div class="content d-flex align-center justify-center">
            <div class="card d-flex align-center  flex-column">
                <div class="close-button" data-dismiss="modal">
                    <img src="<?php echo POPTIN_URL . '/assets/images/close-icon.svg' ?>" alt="">
                </div>
                <h3>Just Making Sure</h3>
                <h4>Are you sure you want to remove Poptin?</h4>
                <img src="<?php echo POPTIN_URL . '/assets/images/exit-parrot.svg' ?>" alt="">

                <button class="deactivate-poptin-confirm-yes">
                    <span class="text-content">
                        Remove Poptin
                    </span><span class="loader" style="display: none;">
                        <div class="lds-ellipsis">
                            <div></div>
                            <div></div>
                            <div></div>
                            <div></div>
                        </div>
                    </span>
                </button>
                <input type="hidden" id="ppFormIdDeactivate" value="<?php echo wp_create_nonce("ppFormIdDeactivate") ?>">
                <div class="cancel-text" data-dismiss="modal">Cancel</div>
            </div>
        </div>
    </div>

    <!-- Look familiar Modal -->
    <div id="lookfamiliar" class="modal fade" role="dialog">
        <div class="content d-flex align-center justify-center">
            <div class="card d-flex align-center  flex-column">
                <div class="close-button" data-dismiss="modal">
                    <img src="<?php echo POPTIN_URL . '/assets/images/close-icon.svg' ?>" alt="">
                </div>
                <h3>You Look Familiar</h3>
                <h4>You already have a Poptin account with this email address.</h4>

                <button class="ppLogin" data-dismiss="modal">Enter your user ID</button>
                <div class="cancel-text" data-dismiss="modal">Cancel</div>
            </div>
        </div>
    </div>

    <!-- Explanatory Video Modal -->
    <div id="poptinExplanatoryVideo" class="modal fade" role="dialog">
        <div class="content d-flex align-center justify-center">
            <div class="card d-flex align-center  flex-column">
                <div class="close-button" data-dismiss="modal">
                    <img src="<?php echo POPTIN_URL . '/assets/images/close-icon.svg' ?>" alt="">
                </div>
                <h3>Video Walkthrough</h3>

                <div class="youtubeVideoContainer" style="background:url(<?php echo POPTIN_URL . '/assets/images/youtubeBackground.png' ?>) no-repeat">
                    <div class="youtubeVideo">
                        <iframe width=755" height="409" src="https://www.youtube.com/embed/gZGz0tawfx8?rel=0&amp;showinfo=0" frameborder="0" allowfullscreen></iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<!-- <form action="https://app.popt.in/login" method="GET" class="dummy_form" id="dummy_form" target="_blank">

</form> -->

<!-- ------------------------
Start: Poptin Support Widget
------------------------- -->
<div class="ps-widget">
    <!-- popover -->
    <div class="ps-widget__popover">
        <div class="ps-widget__popover__header">
            <img
                class="ps-widget__popover__header__bg"
                src="<?= esc_url(POPTIN_URL . '/assets/images/ps-widget-header-bg.svg') ?>"
                draggable="false"
                width="276"
                height="54"
                loading="eager"
            />
            <img
                class="ps-widget__popover__header__bird"
                src="<?= esc_url(POPTIN_URL . '/assets/images/ps-widget-bird.svg') ?>"
                draggable="false"
                width="65"
                height="52"
                loading="eager"
            />

            <h3 class="ps-widget__popover__header__title">Talk to us via</h3>
        </div>
        <div class="ps-widget__popover__body">
            <a href="https://poptin.com/contact" target="_blank" class="ps-widget__popover__body__item">
                <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M17.5 12.5C17.5 12.942 17.3244 13.366 17.0118 13.6785C16.6993 13.9911 16.2754 14.1667 15.8333 14.1667H5.83333L2.5 17.5V4.16667C2.5 3.72464 2.67559 3.30072 2.98816 2.98816C3.30072 2.67559 3.72464 2.5 4.16667 2.5H15.8333C16.2754 2.5 16.6993 2.67559 17.0118 2.98816C17.3244 3.30072 17.5 3.72464 17.5 4.16667V12.5Z" stroke="currentColor" stroke-width="1.33" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
                <span>Live chat</span>
            </a>
            <a href="https://help.poptin.com" target="_blank" class="ps-widget__popover__body__item">
                <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M10.0013 18.3346C14.6037 18.3346 18.3346 14.6037 18.3346 10.0013C18.3346 5.39893 14.6037 1.66797 10.0013 1.66797C5.39893 1.66797 1.66797 5.39893 1.66797 10.0013C1.66797 14.6037 5.39893 18.3346 10.0013 18.3346Z" stroke="currentColor" stroke-width="1.33" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M7.57422 7.49852C7.77014 6.94158 8.15685 6.47194 8.66585 6.1728C9.17485 5.87365 9.7733 5.7643 10.3552 5.86411C10.9371 5.96393 11.4649 6.26646 11.8451 6.71813C12.2253 7.1698 12.4334 7.74146 12.4326 8.33186C12.4326 9.99852 9.93255 10.8319 9.93255 10.8319" stroke="currentColor" stroke-width="1.33" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M10 14.168H10.0083" stroke="currentColor" stroke-width="1.33" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>

                <span>Help center</span>
            </a>
            <a href="https://wordpress.org/support/plugin/poptin/#new-topic-0" target="_blank" class="ps-widget__popover__body__item">
            <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                <g clip-path="url(#clip0_60764_81346)">
                <path d="M10.0002 1C5.03728 1 1 5.03709 1 9.99963C1 14.9625 5.03747 19 10 19C14.9623 19 18.9994 14.9625 18.9994 9.99963C18.9996 5.03728 14.9625 1 10.0002 1ZM1.90823 9.99963C1.90823 8.82675 2.15979 7.71278 2.60885 6.70673L6.46883 17.2823C3.76976 15.9704 1.90823 13.2026 1.90823 9.99963ZM10.0002 18.092C9.20586 18.092 8.43921 17.9754 7.71428 17.7622L10.142 10.7075L12.6297 17.5217C12.6458 17.5619 12.6654 17.5986 12.6873 17.6332C11.8462 17.9291 10.9425 18.092 10.0002 18.092ZM11.1151 6.20586C11.6021 6.18024 12.0415 6.1288 12.0415 6.1288C12.4772 6.07718 12.4262 5.4366 11.9897 5.46222C11.9897 5.46222 10.6791 5.5649 9.83279 5.5649C9.03791 5.5649 7.70137 5.46222 7.70137 5.46222C7.26521 5.4366 7.21434 6.10318 7.65031 6.1288C7.65031 6.1288 8.06328 6.18024 8.49888 6.20586L9.75948 9.66016L7.98865 14.9709L5.04252 6.20605C5.5303 6.18061 5.9687 6.12899 5.9687 6.12899C6.40449 6.07756 6.35306 5.4366 5.91671 5.46278C5.91671 5.46278 4.60673 5.56546 3.76022 5.56546C3.60817 5.56546 3.42918 5.56153 3.23953 5.55574C4.68603 3.35867 7.17338 1.90823 10.0002 1.90823C12.1071 1.90823 14.0249 2.71359 15.4643 4.03236C15.4294 4.03049 15.3955 4.02581 15.3592 4.02581C14.5647 4.02581 14.0006 4.7182 14.0006 5.46203C14.0006 6.12862 14.385 6.69308 14.7951 7.35966C15.1032 7.89869 15.4623 8.59127 15.4623 9.59133C15.4623 10.2841 15.1963 11.0876 14.8464 12.2072L14.0393 14.9044L11.1151 6.20586ZM14.068 16.9943L16.5396 9.84813C17.0017 8.69395 17.1549 7.77095 17.1549 6.94969C17.1549 6.65212 17.1355 6.3755 17.1003 6.11758C17.7325 7.27026 18.0921 8.59314 18.0918 10C18.0916 12.985 16.4734 15.5915 14.068 16.9943Z" fill="currentColor"/>
                </g>
                <defs>
                <clipPath id="clip0_60764_81346">
                <rect width="18" height="18" fill="white" transform="translate(1 1)"/>
                </clipPath>
                </defs>
            </svg>
                <span>Submit a ticket</span>
            </a>
        </div>
    </div>
    <!-- button -->
    <button class="ps-widget__trigger-btn">
        <img 
            src="<?= esc_url(POPTIN_URL . '/assets/images/support-icon.svg') ?>" 
            alt="support-icon"
            width="64"
            height="64"
            loading="lazy"
            draggable="false"
        >
    </button>
</div>
<!-- ------------------------
End: Poptin Support Widget
------------------------- -->