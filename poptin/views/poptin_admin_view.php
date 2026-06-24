<?php

// Prevent direct file access
if (!defined('ABSPATH')) {
    exit;
}

if (!current_user_can('manage_options')) {
    wp_die(__('You do not have sufficient permissions to access this page.'));
}

$poptinidcheck = get_option('poptin_id', false);
$poptin_marketplace_token_check = get_option('poptin_marketplace_token', false);
$poptin_marketplace_email_id_check = get_option('poptin_marketplace_email_id', false);
$go_to_dashboard_url = POPTIN_APP_BASE_URL;

/**
 * We need to pre-fill the email ID of the WP Admin site.
 * The same would be stored in an option as well, for confirmation purposes.
 * Everything looks settled here now.
 */
$admin_email = get_bloginfo('admin_email');

?>

<!-- Main wrapper -->
<div class="poptin-overlay"></div>

<div class="poptin">

    <div class="wrap poptin-wrap">

        <h1></h1>
        <div class="poptinWrap d-flex" id="authWrap">
            <div class="poptinContentBox">
                <div class="poptinLogo">
                    <img src="<?php echo POPTIN_URL . '/assets/images/poptinlogo.png' ?>" alt="Poptin" width="147px" />
                </div>

                <div class="poptinLogged" style="<?php echo ($poptinidcheck ? 'display:block' : 'display:none') ?>">
                    <div class="poptinView">
                        <div class="title"><?php _e("You're All Set 🎉", 'ppbase'); ?></div>
                        <h4 class="description">
                            <?php _e(" Poptin is installed on your website ", 'ppbase'); ?>
                        </h4>

                        <!-- Use the dynamically determined URL - JavaScript will handle target -->
                        <a class="cbutton dashboard-link goto_dashboard_button_pp_updatable" href="<?php echo esc_url($go_to_dashboard_url); ?>" target="_blank">
                           <?php _e("Go to Your Dashboard", "ppbase"); ?> <img src="<?php echo POPTIN_URL . '/assets/images/polygon.svg' ?>" alt="">
                        </a>
                        <div class="other-links d-flex justify-center">
                            <span>
                                <?php _e("Click on the button to create and manage your poptins", "ppbase"); ?>
                            </span>
                        </div>

                        <div class="footer">
                            <div class="important-note d-flex justify-start">
                                <img src="<?php echo POPTIN_URL . '/assets/images/important-note.png' ?>" alt="Important note" width="24px" height="24px" />
                                <p>
                                    <b>Note: </b> If you have a cache plugin, please delete cache so the code will be updated.
                                    If you use WP-Rocket, <a href="https://help.poptin.com/article/show/87331-how-to-exclude-poptin-s-snippet-from-wp-rocket" target="_blank"> follow this guide</a>.
                                </p>
                            </div>
                            <div class="pplogout">
                                <a href="#" class="pplogout">
                                    Deactivate Poptin >
                                </a>
                            </div>
                        </div>
                        <!-- </form> -->
                    </div>
                </div>
                <div class="ppaccountmanager" style="<?php echo ($poptinidcheck ? 'display:none' : 'display:block') ?>">

                    <div class="poptinView popotinRegister">

                        <div class="popotinFormByline">
                            Manage directly from <b>WordPress</b>
                        </div>

                        <div class="title"><?php _e("Sign Up for Free", 'ppbase'); ?></div>
                        <h4 class="description"><?php _e("👉 Create beautiful pop ups and forms", 'ppbase'); ?></h4>

                        <form id="registration_form" class="ppFormRegister ppForm" action="" target="" method="POST">
                            <div class="tooltip-enable">
                                <div class="tooltip d-flex align-center" id="oopsiewrongemailid" style="display: none;">
                                    <img src="<?php echo POPTIN_URL . '/assets/images/squircle.png' ?>" alt="Warning" width="24px" />
                                    Please enter a valid email address
                                </div>
                                <div class="input-controls">
                                    <input class="poptin_input <?php echo !empty($admin_email) ? 'active' : ''; ?>" type="text" name="email" id="poptinRegisterEmail" name="email" value="<?php // echo esc_attr($admin_email); ?>" placeholder=" ">
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
                        
                        <div class="popotinFormByline">
                            Access directly from <b>WordPress</b>
                        </div>

                        <div class="title"><?php _e("You Look Familiar", 'ppbase'); ?></div>

                        <form id="map_poptin_id_form" class="ppFormLogin ppForm">
                            <div class="user-id d-flex justify-end">
                                <a href="#" data-toggle="modal" data-keyboard="true" class="wheremyid"><?php _e("Where is my user ID?", 'ppbase'); ?></a>
                            </div>
                            <div class="tooltip-enable">
                                <div class="tooltip d-flex align-center" id="oopsiewrongid" style="display: none;">
                                    <img src="<?php echo POPTIN_URL . '/assets/images/squircicle-error.svg' ?>" alt="Error" width="24px" />
                                    <div>
                                        Wrong user ID. <a href="#" data-toggle="modal" class="wheremyid"><?php _e("Where is my user ID?", 'ppbase'); ?></a>
                                    </div>
                                </div>
                                <div class="input-controls">
                                    <input type="text" class="poptin_input" autofocus id="poptinUserId">
                                    <label>Enter your User ID...</label>
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
                            <div class="other-links">
                                <a href="<?php echo POPTIN_APP_BASE_URL; ?>" target="_blank"><?php _e("Login to Poptin account", "ppbase"); ?> <img class="external-link-icon" src="<?php echo POPTIN_URL . '/assets/images/external-link.svg' ?>" alt=""></a>
                            </div>
                        </form>
                    </div>
                    <div class="poptinContentFoot d-flex justify-space-between align-center poptinWalkthroughVideoTrigger">

                        <div class="play-button d-flex align-center justify-center">
                            <!-- sg oidsioguoi dsg -->
                            <img src="<?php echo POPTIN_URL . '/assets/images/play-icon.svg' ?>" alt="Watch demo video" width="150px" />
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
                        <?php _e("Here's What Poptin Can Do For You", "ppbase") ?>
                    </div>
                    <div>
                        <div class="poptinFeaturesGrid">
                            <div class="poptinFeatureItem">
                                <div class="poptinFeatureIcon poptinFeatureIcon--popups">
                                    <img src="<?php echo POPTIN_URL . '/assets/images/popups.svg' ?>" alt="Popups" />
                                </div>
                                <span><?php _e("Popups", "ppbase") ?></span>
                            </div>
                            <div class="poptinFeatureItem">
                                <div class="poptinFeatureIcon poptinFeatureIcon--email-campaigns">
                                    <img src="<?php echo POPTIN_URL . '/assets/images/email-campaigns.svg' ?>" alt="Emails Campaigns" />
                                </div>
                                <span><?php _e("Emails Campaigns", "ppbase") ?></span>
                            </div>
                            <div class="poptinFeatureItem">
                                <div class="poptinFeatureIcon poptinFeatureIcon--forms">
                                    <img src="<?php echo POPTIN_URL . '/assets/images/forms.svg' ?>" alt="Forms" />
                                </div>
                                <span><?php _e("Forms", "ppbase") ?></span>
                            </div>
                            <div class="poptinFeatureItem">
                                <div class="poptinFeatureIcon poptinFeatureIcon--email-automation">
                                    <img src="<?php echo POPTIN_URL . '/assets/images/email-automation.svg' ?>" alt="Email Automation" />
                                </div>
                                <span><?php _e("Email Automation", "ppbase") ?></span>
                            </div>
                            <div class="poptinFeatureItem">
                                <div class="poptinFeatureIcon poptinFeatureIcon--coupons">
                                    <img src="<?php echo POPTIN_URL . '/assets/images/coupons.svg' ?>" alt="Coupons" />
                                </div>
                                <span><?php _e("Coupons", "ppbase") ?></span>
                            </div>
                            <div class="poptinFeatureItem">
                                <div class="poptinFeatureIcon poptinFeatureIcon--segmentation">
                                    <img src="<?php echo POPTIN_URL . '/assets/images/segmentation.svg' ?>" alt="Segmentation" />
                                </div>
                                <span><?php _e("Segmentation", "ppbase") ?></span>
                            </div>
                        </div>
                        <div class="poptinTestimonials d-flex align-center flex-column">
                            <div class="d-flex align-center justify-center">
                                <div class="poptinTestimonialAvatar">
                                    <img src="<?php echo POPTIN_URL . '/assets/images/Crystal-R.png' ?>" alt="Crystal R." />
                                </div>
                                <div class="poptinNameCompany">
                                    <div class="name"><?php _e("Crystal R.", "ppbase") ?></div>
                                    <div class="position"><?php _e("Marketing & Campaigns Lead, Batyr", "ppbase") ?></div>
                                </div>
                            </div>
                            <div class="review">
                                <?php _e("We use Poptin to track and convert leads into our email database - it's made a noticeable difference in how effectively we capture and understand audience engagement.", "ppbase") ?>
                            </div>
                            <div class="bar"></div>
                        </div>
                        <div class="poptinRecognized d-flex align-center flex-column">
                            <div class="poptinRecognizedLabel">
                                <span><?php _e("Recognized by the Best", "ppbase") ?></span>
                            </div>
                            <img src="<?php echo POPTIN_URL . '/assets/images/recognized-by.png' ?>" alt="<?php _e('Recognized by the best', 'ppbase') ?>" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="poptinWrap" id="customersWrap" style="<?php echo ($poptinidcheck ? 'display:none' : 'display:block') ?>">
            <div class="title d-flex align-center justify-center">
                <?php _e("Our customers", "ppbase") ?> <img src="<?php echo POPTIN_URL . '/assets/images/heart.svg' ?>" alt="" width="26px" height="21px" style="margin: 0px 6px"> <?php _e("Poptin", "ppbase") ?> </div>
            <div class="customersReview">
                <div class="poptinCustomer">
                    <div class="d-flex align-center">
                        <img src="<?php echo POPTIN_URL . '/assets/images/Deepak-Shukla.png' ?>" alt="Deepak Shukla" width="52px">
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
                        <img src="<?php echo POPTIN_URL . '/assets/images/Liraz-P.png' ?>" alt="Liraz Postan" width="52px">
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
                        <img src="<?php echo POPTIN_URL . '/assets/images/Michael-Kamleitner.png' ?>" alt="Michael Kamleitner" width="52px">
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
                        <img src="<?php echo POPTIN_URL . '/assets/images/Ramesh-Gurung.png' ?>" alt="Ramesh Gurung" width="52px">
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
                        <img src="<?php echo POPTIN_URL . '/assets/images/Roy-Povarchik.png' ?>" alt="Roy Povarchik" width="52px">
                        <div class="poptinNameCompany">
                            <div class="name">Roy Povarchik</div>
                            <div class="position">CEO, stardom.io</div>
                        </div>
                    </div>
                    <div class="review">
                        Poptin was a crucial tool in growing our mailing list and following for our podcast "Strike Gold". Its A/B testing features helped us improve our messaging and offer to our listeners.
                    </div>
                </div>
                <div class="poptinCustomer">
                    <div class="d-flex align-center">
                        <img src="<?php echo POPTIN_URL . '/assets/images/Myriam-Plamondon.png' ?>" alt="Myriam Plamondon" width="52px">
                        <div class="poptinNameCompany">
                            <div class="name">Myriam Plamondon</div>
                            <div class="position">Founder, Talent Fou</div>
                        </div>
                    </div>
                    <div class="review">
                        Integrates flawlessly with WordPress. This plugin integrates very easily, you don't have anything to do except activating it.
                    </div>
                </div>
            </div>
            <div class="marketplace d-flex justify-center">
                <div class="d-flex align-center">
                    <div class="pipe"></div>
                    <div>
                        <img src="<?php echo POPTIN_URL . '/assets/images/capterra-inc.svg' ?>" alt="Capterra" class="marketplace-logo marketplace-logo--capterra">
                        <div class="d-flex align-center">(4.8/5) <img src="<?php echo POPTIN_URL . '/assets/images/star.svg' ?>" alt="Star rating" /></div>
                    </div>
                </div>
                <div class="d-flex align-center">
                    <div class="pipe"></div>
                    <div>
                        <img src="<?php echo POPTIN_URL . '/assets/images/wordpress.svg' ?>" alt="WordPress" class="marketplace-logo marketplace-logo--wordpress">
                        <div class="d-flex align-center">(4.9/5) <img src="<?php echo POPTIN_URL . '/assets/images/star.svg' ?>" alt="Star rating" /></div>
                    </div>
                </div>
                <div class="d-flex align-center">
                    <div class="pipe"></div>
                    <div>
                        <img src="<?php echo POPTIN_URL . '/assets/images/g2Crowdlogo.svg' ?>" alt="G2 Crowd" class="marketplace-logo marketplace-logo--g2crowd">
                        <div class="d-flex align-center">(4.8/5) <img src="<?php echo POPTIN_URL . '/assets/images/star.svg' ?>" alt="Star rating" /></div>
                    </div>
                </div>
                <div class="d-flex align-center">
                    <div class="pipe"></div>
                    <div>
                        <img src="<?php echo POPTIN_URL . '/assets/images/trustpilot.svg' ?>" alt="Trustpilot" class="marketplace-logo marketplace-logo--trustpilot">
                        <div class="d-flex align-center">(4.9/5) <img src="<?php echo POPTIN_URL . '/assets/images/star.svg' ?>" alt="Star rating" /></div>
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

</div>

<!-- Iframe overlay for full registration users -->
<?php if ($poptin_marketplace_token_check && $poptin_marketplace_email_id_check): ?>
<div id="poptin-iframe-overlay" class="poptin-iframe-overlay">
    <iframe id="poptin-iframe" 
            class="poptin-iframe" 
            allow="clipboard-read; clipboard-write"
            src="">
    </iframe>
</div>
<?php endif; ?>