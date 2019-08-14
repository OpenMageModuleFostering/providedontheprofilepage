<?php
DebugBreak();
    $installer = $this;
    $installer->startSetup();

    $installer->run("
    CREATE TABLE `Abandoned_email_subscription` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `customer_id` int(11) NOT NULL,
    `customer_name` varchar(255) NOT NULL,
    `customer_email` varchar(255) NOT NULL,
    `subscribe_status` varchar(255) NOT NULL,
    PRIMARY KEY (`id`)
    ) ENGINE=MyISAM  DEFAULT CHARSET=utf8;
    "); 
    $installer->run("
    CREATE TABLE `abandoned_extensionsetting` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `extension_name` varchar(255) NOT NULL,
    `status` varchar(255) NOT NULL,
    PRIMARY KEY (`id`)
    ) ENGINE=MyISAM  DEFAULT CHARSET=utf8;
    "); 
    $installer->run("
    INSERT INTO `abandoned_extensionsetting` (`id`, `extension_name`, `status`) VALUES
    (1, 'catched_user', 'off'),
    (2, '1_click_signup', 'on'),
    (3, 'add_to_watchlist', 'on'),
    (4, 'pricelizer_logo', 'yes'),
    (5, 'link_footer', 'yes'),
    (6, 'purchase_reminder', 'yes'),
    (7, 'outwards_communication', 'no'),
    (8, 'site_logo', 'yes'),
    (9, 'abandoned_cart_reminder', 'yes'),
    (10, 'invite_abandonedcar_user', 'on');

    "); 
    $installer->run("
    CREATE TABLE IF NOT EXISTS `abandoned_user_ip` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `email_id` varchar(255) NOT NULL,
    `user_ip` varchar(255) NOT NULL,
    `product_name` varchar(255) NOT NULL,
    `Product_price` varchar(255) NOT NULL,
    `pay_status` varchar(255) NOT NULL,
    `added_date` date NOT NULL,
    PRIMARY KEY (`id`)
    ) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;
    "); 
    $installer->run("
    CREATE TABLE IF NOT EXISTS `Abandon_added_product` (
    `abandon_id` int(11) NOT NULL AUTO_INCREMENT,
    `added_user_id` varchar(255) NOT NULL,
    `added_prod_id` varchar(255) NOT NULL,
    `added_entity_id` varchar(255) NOT NULL,
    `abandon_email_status` tinyint(1) NOT NULL,
    PRIMARY KEY (`abandon_id`)
    ) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=27 ;

    "); 
    $installer->run("
    CREATE TABLE IF NOT EXISTS `abandon_cart` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `abandon_status` tinyint(1) NOT NULL,
    `day` tinyint(255) NOT NULL,
    `date` datetime NOT NULL,
    PRIMARY KEY (`id`)
    ) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

    "); 
    $installer->run("
    INSERT INTO `abandon_cart` (`id`, `abandon_status`, `day`, `date`) VALUES
    (1, 0, 10, '2015-03-07 19:02:04');

    "); 
    $installer->run("
    CREATE TABLE IF NOT EXISTS `Abandon_cart_licensekey` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `user_email` varchar(255) NOT NULL,
    `license_key` varchar(255) NOT NULL,
    `start_date` date NOT NULL,
    `end_date` date NOT NULL,
    `duration_type` varchar(255) NOT NULL,
    `user_id` varchar(255) NOT NULL,
    `package_name` varchar(255) NOT NULL,
    `list_abandon_cart` varchar(255) NOT NULL,
    `invitation_link` varchar(255) NOT NULL,
    `user_details` varchar(255) NOT NULL,
    PRIMARY KEY (`id`)
    ) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;
    "); 
    $installer->run("
    CREATE TABLE IF NOT EXISTS `Abandon_cart_users` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `Abandoned_cart` varchar(255) NOT NULL,
    `Catched_user` varchar(255) NOT NULL,
    PRIMARY KEY (`id`)
    ) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

    ");        $installer->run("
    INSERT INTO `Abandon_cart_users` (`id`, `Abandoned_cart`, `Catched_user`) VALUES
    (1, '0', '0');
    "); 

    $installer->run("
    CREATE TABLE IF NOT EXISTS `abandon_email_template` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `email_conetnt` text NOT NULL,
    `template_type` varchar(255) NOT NULL,
    PRIMARY KEY (`id`)
    ) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

    "); 
    $installer->run("
        CREATE TABLE IF NOT EXISTS `Abandon_social_media_login` (
    `social_id` int(11) NOT NULL AUTO_INCREMENT,
    `provider` varchar(255) NOT NULL,
    `oauth_token` varchar(255) NOT NULL,
    PRIMARY KEY (`social_id`)
    ) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

    "); 
    $installer->run("
    INSERT INTO `abandon_email_template` (`id`, `email_conetnt`, `template_type`) VALUES
    (1, '<style>\r\n    .container-middle, .section-item{ margin: auto; }\r\n    @media screen and (max-width:767px){\r\n    .container { width: 100%; }\r\n    .container-middle { padding: 0 15px; width: 100%; }\r\n    .main-table{ width: 100%; }\r\n    .main-table img{ width: 100%!important; }\r\n    }\r\n    @media screen and (max-width:320px){ \r\n        .container-middle { padding: 0; width: 95%; }\r\n    }\r\n</style>\r\n<div class='prmo-mail'>\r\n    <table width='100%' cellspacing='0' cellpadding='0' border='0' class='main-table'>\r\n        <tbody><tr><td height='30'></td></tr>\r\n            <tr bgcolor='#43B74A'>\r\n                <td width='100%' valign='top' bgcolor='#fff' align='center'>\r\n\r\n                    <!---------   top header   ------------>\r\n                    <table width='600' cellspacing='0' cellpadding='0' border='0' align='center' class='container'>\r\n                        <tbody>\r\n                <tr bgcolor='#43B74A' style='border-radius:5px 5px 0 0;'>\r\n                                <td>&nbsp;</td>\r\n                            </tr>\r\n                            <tr bgcolor='#43B74A'>\r\n                <td height='5'></td>\r\n                </tr>\r\n                            <tr bgcolor='#43B74A'>\r\n                                <td align='center'>\r\n                                    <table width='560' cellspacing='0' cellpadding='0' border='0' align='center' style='margin:0 auto;' class='container-middle'>\r\n                                        <tbody><tr>\r\n                                                <td>\r\n                                                    <table cellspacing='0' cellpadding='0' border='0' align='left' class='top-header-left'>\r\n                                                        <tbody><tr>\r\n                                                                <td align='center'>\r\n                                                                    <table cellspacing='0' cellpadding='0' border='0' class='date'>\r\n                                                                        <tbody><tr>\r\n                                                                                <td>\r\n                                                                                    <img width='13' editable='true' mc:edit='icon1' style='display: block;' src='http://promailthemes.com/campaigner/layout1/white/blue/img/icon-cal.png' alt='icon 1'>\r\n                                                                                </td>\r\n                                                                                <td>&nbsp;&nbsp;</td>\r\n                                                                                <td mc:edit='date' style='color: #fefefe; font-size: 11px; font-weight: normal; font-family: Helvetica, Arial, sans-serif;'>\r\n                                                                        <singleline>\r\n                                                                            DATE\r\n                                                                        </singleline>\r\n                                                                </td>\r\n                                                            </tr>\r\n                                                        </tbody></table>\r\n                                                </td>\r\n                                            </tr>\r\n                                        </tbody></table>\r\n\r\n                                    <table cellspacing='0' cellpadding='0' border='0' align='left' class='top-header-right'>\r\n                                        <tbody><tr><td width='30' height='20'></td></tr>\r\n                                        </tbody></table>\r\n\r\n                                   \r\n                </td>\r\n            </tr>\r\n        </tbody></table>\r\n</td>\r\n</tr>\r\n\r\n<tr bgcolor='#43B74A'><td height='10'></td></tr>\r\n\r\n</tbody></table>\r\n\r\n<!----------    end top header    ------------>\r\n\r\n\r\n<!----------   main content----------->\r\n<table width='600' cellspacing='0' cellpadding='0' border='0' bgcolor='ececec' align='center' class='container '>\r\n\r\n\r\n    <!--------- Header  ---------->\r\n    <tbody><tr bgcolor='ececec'><td height='40'></td></tr>\r\n\r\n        <tr>\r\n            <td>\r\n                <table width='560' cellspacing='0' cellpadding='0' border='0' align='center' class='container-middle'>\r\n                    <tbody><tr>\r\n                            <td>\r\n                                <table cellspacing='0' cellpadding='0' border='0' align='left' class='logo'>\r\n                                    <tbody><tr>\r\n                                            <td align='center'>\r\n                                                CULOGO\r\n                                            </td>\r\n                                        </tr>\r\n                                    </tbody></table>        \r\n                                <table cellspacing='0' cellpadding='0' border='0' align='left' class='nav'>\r\n                                    <tbody><tr>\r\n                                            <td width='20' height='20'></td>\r\n                                        </tr>\r\n                                    </tbody></table>\r\n                                \r\n            </td>\r\n        </tr>\r\n    </tbody></table>\r\n</td>\r\n</tr>\r\n\r\n<tr bgcolor='ececec'><td height='40'></td></tr>\r\n<!---------- end header --------->\r\n\r\n\r\n<!--------- main section --------->                    \r\n<tr>\r\n    <td>\r\n        <table width='560' cellspacing='0' cellpadding='0' border='0' align='center' class='container-middle'>\r\n\r\n            <tbody><tr><td align='center'><img width='560' height='auto' style='display: block;' src='http://promailthemes.com/campaigner/layout1/white/blue/img/top-rounded-bg.png' alt='' class='top-bottom-bg'></td></tr>\r\n\r\n                <tr bgcolor='#ffffff'><td height='7'></td></tr>\r\n\r\n\r\n                <tr bgcolor='#ffffff'><td height='20'></td></tr>\r\n\r\n                <tr bgcolor='#ffffff'>\r\n                    <td>\r\n                        <table width='100%' cellspacing='0' cellpadding='0' border='0' align='center' style='padding:0 15px' class='mainContent'>\r\n                            <tbody><tr>    \r\n                                    <td mc:edit='title1' class='main-header' style='color: #484848; font-size: 16px; font-weight: normal; font-family: Helvetica, Arial, sans-serif;'>\r\n                            <multiline>\r\n                               <p>Hi FIRSTNAME<br>\r\nGreat to see that you found some products you like at <a href='http://projects.udaantechnologies.com/magentodev'>www.projects.udaantechnologies.com</a></p>\r\n\r\n<p>We noticed that you left your cart for XDAYSFROMSETTINGS days .</p>\r\n\r\n<p>We offer a free service that automatically alerts you when the price drops on the products in your abandoned cart. </p>\r\n\r\n<p>Simply click here and it will all be automatically set-up</p>\r\n\r\n<p>1CLICKSIGNUP</p>\r\n\r\n\r\n<p>Best regards<br>\r\n<a target='_blank' href='http://projects.udaantechnologies.com/magentodev'>www.projects.udaantechnologies.com</a></p>\r\n\r\n                            </multiline>\r\n                    </td>\r\n                </tr>\r\n               \r\n</tbody></table>\r\n</td>\r\n</tr>\r\n\r\n<tr bgcolor='ffffff'><td height='25'></td></tr>\r\n\r\n<tr><td align='center'><img width='560' height='auto' style='display: block;' src='http://promailthemes.com/campaigner/layout1/white/blue/img/bottom-rounded-bg.png' alt='' class='top-bottom-bg'></td></tr>    \r\n\r\n</tbody></table>\r\n</td>\r\n</tr><!--------- end main section --------->\r\n\r\n\r\n<tr><td height='35'></td></tr>\r\n\r\n\r\n\r\n\r\n\r\n<!---------- prefooter  --------->\r\n\r\n<tr>\r\n    <td>\r\n        <table width='560' cellspacing='0' cellpadding='0' border='0' align='center' class='container-middle'>\r\n            <tbody><tr>\r\n                    <td>\r\n                        <table cellspacing='0' cellpadding='0' border='0' align='left' class='logo'>\r\n                            <tbody><tr>\r\n                                    <td align='center'>\r\n                                        <span style='float:left;'>PRICELIZERLOGO </span><span style='color: #989898; margin-left: 10px; float:left; line-height:79px;'></span>\r\n                                    </td>\r\n                                </tr>\r\n                                \r\n                               \r\n                            </tbody></table>        \r\n                        <table cellspacing='0' cellpadding='0' border='0' align='left'>\r\n                            <tbody><tr>\r\n                                    <td width='20' height='20'></td>\r\n                                </tr>\r\n                            </tbody></table>\r\n                        <table cellspacing='0' cellpadding='0' border='0' align='right' class='nav'>\r\n                            <tbody><tr><td height='10'></td></tr>\r\n                                <tr>\r\n                                    <td align='center' mc:edit='socials' style='font-size: 13px; font-family: Helvetica, Arial, sans-serif;'>\r\n                                      \r\n                                    </td>\r\n                                </tr>\r\n                            </tbody></table>\r\n                    </td>\r\n                </tr>\r\n            </tbody></table>\r\n    </td>\r\n</tr><!---------- end prefooter  --------->\r\n\r\n<tr><td height='40'></td></tr>\r\n<tr>\r\n    <td align='center' mc:edit='copy1' style='color: #939393; font-size: 11px; font-weight: normal; font-family: Helvetica, Arial, sans-serif;' class='prefooter-header'>\r\n<multiline>\r\n    You are currently signed up as: <span style='color: #2f90e2'>email@email.com</span> to unsubscribe  UNCLICK\r\n</multiline>\r\n</td>\r\n</tr>    \r\n\r\n<tr><td height='30'></td></tr>\r\n\r\n<tr>\r\n    <td align='center' mc:edit='copy2' style='color: #939393; font-size: 11px; font-weight: normal; font-family: Helvetica, Arial, sans-serif;' class='prefooter-subheader'>\r\n\r\n</td>\r\n</tr>\r\n\r\n<tr><td height='30'></td></tr>\r\n</tbody></table>\r\n<!------------ end main Content ----------------->\r\n\r\n\r\n<!---------- footer  --------->\r\n<table width='600' cellspacing='0' cellpadding='0' border='0' align='center' class='container'>\r\n    <tbody><tr bgcolor='#43B74A'><td height='14'></td></tr>\r\n        <tr bgcolor='#43B74A'>\r\n            <td align='center' mc:edit='copy3' style='color: #fff; font-size: 10px; font-weight: normal; font-family: Helvetica, Arial, sans-serif;'>\r\n    <multiline>\r\n         &copy; 2015 SITENAME\r\n    </multiline>\r\n    </td>\r\n    </tr>\r\n\r\n    <tr bgcolor='#43B74A' style=''>\r\n        <td>&nbsp;</td>\r\n    </tr>\r\n    </tbody></table>\r\n<!---------  end footer --------->\r\n</td>\r\n</tr>\r\n\r\n<tr><td height='30'></td></tr>\r\n\r\n</tbody></table>\r\n</div>\r\n', 'abandoned_cart_template'),
    (2, '<style>\r\n    .container-middle, .section-item{ margin: auto; }\r\n</style>\r\n<div class='prmo-mail'>\r\n    <table width='100%' cellspacing='0' cellpadding='0' border='0'>\r\n        <tbody><tr><td height='30'></td></tr>\r\n            <tr bgcolor='#43B74A'>\r\n                <td width='100%' valign='top' bgcolor='#4c4e4e' align='center'>\r\n\r\n                    <!---------   top header   ------------>\r\n                    <table width='600' cellspacing='0' cellpadding='0' border='0' align='center' class='container'>\r\n                        <tbody>\r\n                <tr  bgcolor='#43B74A' style='border-radius:5px 5px 0 0;' >\r\n                                <td>&nbsp;</td>\r\n                            </tr>\r\n                            <tr bgcolor='#43B74A'>\r\n                <td height='5'></td>\r\n                </tr>\r\n                            <tr bgcolor='#43B74A'>\r\n                                <td align='center'>\r\n                                    <table width='560' cellspacing='0' cellpadding='0' border='0' align='center' class='container-middle' style='margin:0 auto;' >\r\n                                        <tbody><tr>\r\n                                                <td>\r\n                                                    <table cellspacing='0' cellpadding='0' border='0' align='left' class='top-header-left'>\r\n                                                        <tbody><tr>\r\n                                                                <td align='center'>\r\n                                                                    <table cellspacing='0' cellpadding='0' border='0' class='date'>\r\n                                                                        <tbody><tr>\r\n                                                                                <td>\r\n                                                                                    <img width='13' alt='icon 1' src='http://promailthemes.com/campaigner/layout1/white/blue/img/icon-cal.png' style='display: block;' mc:edit='icon1' editable='true'>\r\n                                                                                </td>\r\n                                                                                <td>&nbsp;&nbsp;</td>\r\n                                                                                <td style='color: #fefefe; font-size: 11px; font-weight: normal; font-family: Helvetica, Arial, sans-serif;' mc:edit='date'>\r\n                                                                        <singleline>\r\n                                                                            DATE\r\n                                                                        </singleline>\r\n                                                                </td>\r\n                                                            </tr>\r\n                                                        </tbody></table>\r\n                                                </td>\r\n                                            </tr>\r\n                                        </tbody></table>\r\n\r\n                                    <table cellspacing='0' cellpadding='0' border='0' align='left' class='top-header-right'>\r\n                                        <tbody><tr><td width='30' height='20'></td></tr>\r\n                                        </tbody></table>\r\n\r\n                                   \r\n                </td>\r\n            </tr>\r\n        </tbody></table>\r\n</td>\r\n</tr>\r\n\r\n<tr bgcolor='#43B74A'><td height='10'></td></tr>\r\n\r\n</tbody></table>\r\n\r\n<!----------    end top header    ------------>\r\n\r\n\r\n<!----------   main content----------->\r\n<table width='600' cellspacing='0' cellpadding='0' border='0' bgcolor='ececec' align='center' class='container'>\r\n\r\n\r\n    <!--------- Header  ---------->\r\n    <tbody><tr bgcolor='ececec'><td height='40'></td></tr>\r\n\r\n        <tr>\r\n            <td>\r\n                <table width='560' cellspacing='0' cellpadding='0' border='0' align='center' class='container-middle'>\r\n                    <tbody><tr>\r\n                            <td>\r\n                                <table cellspacing='0' cellpadding='0' border='0' align='left' class='logo'>\r\n                                    <tbody><tr>\r\n                                            <td align='center'>\r\n                                                CULOGO\r\n                                            </td>\r\n                                        </tr>\r\n                                    </tbody></table>        \r\n                                <table cellspacing='0' cellpadding='0' border='0' align='left' class='nav'>\r\n                                    <tbody><tr>\r\n                                            <td width='20' height='20'></td>\r\n                                        </tr>\r\n                                    </tbody></table>\r\n                                \r\n            </td>\r\n        </tr>\r\n    </tbody></table>\r\n</td>\r\n</tr>\r\n\r\n<tr bgcolor='ececec'><td height='40'></td></tr>\r\n<!---------- end header --------->\r\n\r\n\r\n<!--------- main section --------->                    \r\n<tr>\r\n    <td>\r\n        <table width='560' cellspacing='0' cellpadding='0' border='0' align='center' class='container-middle'>\r\n\r\n            <tbody><tr><td align='center'><img width='560' height='auto' class='top-bottom-bg' alt='' src='http://promailthemes.com/campaigner/layout1/white/blue/img/top-rounded-bg.png' style='display: block;'></td></tr>\r\n\r\n                <tr bgcolor='ffffff'><td height='7'></td></tr>\r\n\r\n\r\n                <tr bgcolor='ffffff'><td height='20'></td></tr>\r\n\r\n                <tr bgcolor='ffffff'>\r\n                    <td>\r\n                        <table width='528' cellspacing='0' cellpadding='0' border='0' align='center' class='mainContent'>\r\n                            <tbody><tr>    \r\n                                    <td style='color: #484848; font-size: 16px; font-weight: normal; font-family: Helvetica, Arial, sans-serif;' class='main-header' mc:edit='title1'>\r\n                            <multiline>\r\n                               <p>Hi FIRSTNAME<br />\r\nThank you for your shown interest in the products that you have put into Your cart at <a href='http://projects.udaantechnologies.com/magentodev'>www.projects.udaantechnologies.com</a> with the following products</p>\r\n<p>PRODUCTNAME</p>\r\n\r\n<p>Click the buy button to place an order or contact us for any questions you might have. </p>\r\n\r\n<p>We work with <a href='http://Pricelizer.com' target='_blank'>Pricelizer.com</a> that offers automatic price alerts when the products already chosen by you drop in price.</p>\r\n\r\n<p>Best regards<br />\r\n<a href='http://projects.udaantechnologies.com/magentodev' target='_blank'>www.projects.udaantechnologies.com</a></p>\r\n\r\n                            </multiline>\r\n                    </td>\r\n                </tr>\r\n               \r\n</tbody></table>\r\n</td>\r\n</tr>\r\n\r\n<tr bgcolor='ffffff'><td height='25'></td></tr>\r\n\r\n<tr><td align='center'><img width='560' height='auto' class='top-bottom-bg' alt='' src='http://promailthemes.com/campaigner/layout1/white/blue/img/bottom-rounded-bg.png' style='display: block;'></td></tr>    \r\n\r\n</tbody></table>\r\n</td>\r\n</tr><!--------- end main section --------->\r\n\r\n\r\n<tr><td height='35'></td></tr>\r\n\r\n<!---------- prefooter  --------->\r\n\r\n<tr>\r\n    <td>\r\n        <table width='560' cellspacing='0' cellpadding='0' border='0' align='center' class='container-middle'>\r\n            <tbody><tr>\r\n                    <td>\r\n                        <table cellspacing='0' cellpadding='0' border='0' align='left' class='logo'>\r\n                            <tbody><tr>\r\n                                    <td align='center'>\r\n                                        <span style=''float:left;''>PRICELIZERLOGO </span><span style=''color: #989898; margin-left: 10px; float:left; line-height:79px;''></span>\r\n                                    </td>\r\n                                </tr>\r\n                            </tbody></table>        \r\n                        <table cellspacing='0' cellpadding='0' border='0' align='left'>\r\n                            <tbody><tr>\r\n                                    <td width='20' height='20'></td>\r\n                                </tr>\r\n                            </tbody></table>\r\n                        <table cellspacing='0' cellpadding='0' border='0' align='right' class='nav'>\r\n                            <tbody><tr><td height='10'></td></tr>\r\n                                <tr>\r\n                                    <td align='center' style='font-size: 13px; font-family: Helvetica, Arial, sans-serif;' mc:edit='socials'>\r\n                                      \r\n                                    </td>\r\n                                </tr>\r\n                            </tbody></table>\r\n                    </td>\r\n                </tr>\r\n            </tbody></table>\r\n    </td>\r\n</tr><!---------- end prefooter  --------->\r\n\r\n<tr><td height='40'></td></tr>\r\n<tr>\r\n    <td align='center' class='prefooter-header' style='color: #939393; font-size: 11px; font-weight: normal; font-family: Helvetica, Arial, sans-serif;' mc:edit='copy1'>\r\n</td>\r\n</tr>    \r\n<tr>\r\n    <td align='center' class='prefooter-header' style='color: #939393; font-size: 11px; font-weight: normal; font-family: Helvetica, Arial, sans-serif;' mc:edit='copy1'>\r\n</td>\r\n</tr>    \r\n\r\n<tr><td height='30'></td></tr>\r\n\r\n<tr>\r\n    <td align='center' class='prefooter-subheader' style='color: #939393; font-size: 11px; font-weight: normal; font-family: Helvetica, Arial, sans-serif;' mc:edit='copy2'>\r\n\r\n</td>\r\n</tr>\r\n\r\n<tr><td height='30'></td></tr>\r\n</tbody></table>\r\n<!------------ end main Content ----------------->\r\n\r\n\r\n<!---------- footer  --------->\r\n<table width='600' cellspacing='0' cellpadding='0' border='0' class='container' align='center'>\r\n    <tbody><tr bgcolor='#43B74A'><td height='14'></td></tr>\r\n        <tr bgcolor='#43B74A'>\r\n            <td align='center' style='color: #fff; font-size: 10px; font-weight: normal; font-family: Helvetica, Arial, sans-serif;' mc:edit='copy3'>\r\n    <multiline>\r\n         &copy; 2015 SITENAME.\r\n    </multiline>\r\n    </td>\r\n    </tr>\r\n\r\n    <tr  bgcolor='#43B74A' style='' >\r\n        <td>&nbsp;</td>\r\n    </tr>\r\n    </tbody></table>\r\n<!---------  end footer --------->\r\n</td>\r\n</tr>\r\n\r\n<tr><td height='30'></td></tr>\r\n\r\n</tbody></table>\r\n</div>\r\n', 'catched_user_template'),
    (3, '<style>\r\n    .container-middle, .section-item{ margin: auto; }\r\n</style>\r\n<div class='prmo-mail'>\r\n    <table width='100%' cellspacing='0' cellpadding='0' border='0'>\r\n        <tbody><tr><td height='30'></td></tr>\r\n            <tr bgcolor='#43B74A'>\r\n                <td width='100%' valign='top' bgcolor='#4c4e4e' align='center'>\r\n\r\n                    <!---------   top header   ------------>\r\n                    <table width='600' cellspacing='0' cellpadding='0' border='0' align='center' class='container'>\r\n                        <tbody>\r\n                <tr  bgcolor='#43B74A' style=''border-radius:5px 5px 0 0;'' >\r\n                                <td>&nbsp;</td>\r\n                            </tr>\r\n                            <tr bgcolor='#43B74A'>\r\n                <td height='5'></td>\r\n                </tr>\r\n                            <tr bgcolor='#43B74A'>\r\n                                <td align='center'>\r\n                                    <table width='560' cellspacing='0' cellpadding='0' border='0' align='center' class='container-middle' style=''margin:0 auto;'' >\r\n                                        <tbody><tr>\r\n                                                <td>\r\n                                                    <table cellspacing='0' cellpadding='0' border='0' align='left' class='top-header-left'>\r\n                                                        <tbody><tr>\r\n                                                                <td align='center'>\r\n                                                                    <table cellspacing='0' cellpadding='0' border='0' class='date'>\r\n                                                                        <tbody><tr>\r\n                                                                                <td>\r\n                                                                                    <img width='13' alt='icon 1' src='http://promailthemes.com/campaigner/layout1/white/blue/img/icon-cal.png' style='display: block;' mc:edit='icon1' editable='true'>\r\n                                                                                </td>\r\n                                                                                <td>&nbsp;&nbsp;</td>\r\n                                                                                <td style='color: #fefefe; font-size: 11px; font-weight: normal; font-family: Helvetica, Arial, sans-serif;' mc:edit='date'>\r\n                                                                        <singleline>\r\n                                                                            DATE\r\n                                                                        </singleline>\r\n                                                                </td>\r\n                                                            </tr>\r\n                                                        </tbody></table>\r\n                                                </td>\r\n                                            </tr>\r\n                                        </tbody></table>\r\n\r\n                                    <table cellspacing='0' cellpadding='0' border='0' align='left' class='top-header-right'>\r\n                                        <tbody><tr><td width='30' height='20'></td></tr>\r\n                                        </tbody></table>\r\n\r\n                                   \r\n                </td>\r\n            </tr>\r\n        </tbody></table>\r\n</td>\r\n</tr>\r\n\r\n<tr bgcolor='#43B74A'><td height='10'></td></tr>\r\n\r\n</tbody></table>\r\n\r\n<!----------    end top header    ------------>\r\n\r\n\r\n<!----------   main content----------->\r\n<table width='600' cellspacing='0' cellpadding='0' border='0' bgcolor='ececec' align='center' class='container'>\r\n\r\n\r\n    <!--------- Header  ---------->\r\n    <tbody><tr bgcolor='ececec'><td height='40'></td></tr>\r\n\r\n        <tr>\r\n            <td>\r\n                <table width='560' cellspacing='0' cellpadding='0' border='0' align='center' class='container-middle'>\r\n                    <tbody><tr>\r\n                            <td>\r\n                                <table cellspacing='0' cellpadding='0' border='0' align='left' class='logo'>\r\n                                    <tbody><tr>\r\n                                            <td align='center'>\r\n                                                CULOGO\r\n                                            </td>\r\n                                        </tr>\r\n                                    </tbody></table>        \r\n                                <table cellspacing='0' cellpadding='0' border='0' align='left' class='nav'>\r\n                                    <tbody><tr>\r\n                                            <td width='20' height='20'></td>\r\n                                        </tr>\r\n                                    </tbody></table>\r\n                                \r\n            </td>\r\n        </tr>\r\n    </tbody></table>\r\n</td>\r\n</tr>\r\n\r\n<tr bgcolor='ececec'><td height='40'></td></tr>\r\n<!---------- end header --------->\r\n\r\n\r\n<!--------- main section --------->                    \r\n<tr>\r\n    <td>\r\n        <table width='560' cellspacing='0' cellpadding='0' border='0' align='center' class='container-middle'>\r\n\r\n            <tbody><tr><td align='center'><img width='560' height='auto' class='top-bottom-bg' alt='' src='http://promailthemes.com/campaigner/layout1/white/blue/img/top-rounded-bg.png' style='display: block;'></td></tr>\r\n\r\n                <tr bgcolor='#ffffff'><td height='7'></td></tr>\r\n\r\n\r\n                <tr bgcolor='#ffffff'><td height='20'></td></tr>\r\n\r\n                <tr bgcolor='#ffffff'>\r\n                    <td>\r\n                        <table width='100%' cellspacing='0' cellpadding='0' border='0' align='center' class='mainContent' style=''padding:0 15px'' >\r\n                            <tbody><tr>    \r\n                                    <td style='color: #484848; font-size: 16px; font-weight: normal; font-family: Helvetica, Arial, sans-serif;' class='main-header' mc:edit='title1'>\r\n                            <multiline>\r\n                               <p>Hi FIRSTNAME<br />\r\nThank you for visiting <a href='http://projects.udaantechnologies.com/magentodev'>www.projects.udaantechnologies.com</a></p>\r\n\r\n<p>We are sorry that you left yesterday, and would like to offer you a service that we hope you will like: When the products you left in your cart drop in price, we can email you. </p>\r\n\r\n<p>Now you don''t have to think about when the products you liked drop in price. Just click here:</p>\r\n\r\n\r\n<p>1CLICKSIGNUP</p>\r\n\r\n<p>To monitor these products in your cart:</p>\r\n<p>PRODUCTLIST</p>\r\n\r\n<p>Best regards<br />\r\n\r\n<a href='http://projects.udaantechnologies.com/magentodev' target='_blank'>www.projects.udaantechnologies.com</a></p>\r\n\r\n                            </multiline>\r\n                    </td>\r\n                </tr>\r\n               \r\n</tbody></table>\r\n</td>\r\n</tr>\r\n\r\n<tr bgcolor='ffffff'><td height='25'></td></tr>\r\n\r\n<tr><td align='center'><img width='560' height='auto' class='top-bottom-bg' alt='' src='http://promailthemes.com/campaigner/layout1/white/blue/img/bottom-rounded-bg.png' style='display: block;'></td></tr>    \r\n\r\n</tbody></table>\r\n</td>\r\n</tr><!--------- end main section --------->\r\n\r\n\r\n<tr><td height='35'></td></tr>\r\n\r\n\r\n\r\n\r\n\r\n<!---------- prefooter  --------->\r\n\r\n<tr>\r\n    <td>\r\n        <table width='560' cellspacing='0' cellpadding='0' border='0' align='center' class='container-middle'>\r\n            <tbody><tr>\r\n                    <td>\r\n                        <table cellspacing='0' cellpadding='0' border='0' align='left' class='logo'>\r\n                            <tbody><tr>\r\n                                    <td align='center'>\r\n                                        <span style=''float:left;''>PRICELIZERLOGO </span><span style=''color: #989898; margin-left: 10px; float:left; line-height:79px;''></span>\r\n                                    </td>\r\n                                </tr>\r\n                                \r\n                               \r\n                            </tbody></table>        \r\n                        <table cellspacing='0' cellpadding='0' border='0' align='left'>\r\n                            <tbody><tr>\r\n                                    <td width='20' height='20'></td>\r\n                                </tr>\r\n                            </tbody></table>\r\n                        <table cellspacing='0' cellpadding='0' border='0' align='right' class='nav'>\r\n                            <tbody><tr><td height='10'></td></tr>\r\n                                <tr>\r\n                                    <td align='center' style='font-size: 13px; font-family: Helvetica, Arial, sans-serif;' mc:edit='socials'>\r\n                                      \r\n                                    </td>\r\n                                </tr>\r\n                            </tbody></table>\r\n                    </td>\r\n                </tr>\r\n            </tbody></table>\r\n    </td>\r\n</tr><!---------- end prefooter  --------->\r\n\r\n<tr><td height='40'></td></tr>\r\n<tr>\r\n    <td align='center' class='prefooter-header' style='color: #939393; font-size: 11px; font-weight: normal; font-family: Helvetica, Arial, sans-serif;' mc:edit='copy1'>\r\n<multiline>\r\n    You are currently signed up as: <span style='color: #2f90e2'>email@email.com</span> to unsubscribe  UNCLICK\r\n</multiline>\r\n</td>\r\n</tr>    \r\n\r\n<tr><td height='30'></td></tr>\r\n\r\n<tr>\r\n    <td align='center' class='prefooter-subheader' style='color: #939393; font-size: 11px; font-weight: normal; font-family: Helvetica, Arial, sans-serif;' mc:edit='copy2'>\r\n\r\n</td>\r\n</tr>\r\n\r\n<tr><td height='30'></td></tr>\r\n</tbody></table>\r\n<!------------ end main Content ----------------->\r\n\r\n\r\n<!---------- footer  --------->\r\n<table width='600' cellspacing='0' cellpadding='0' border='0' class='container' align='center'>\r\n    <tbody><tr bgcolor='#43B74A'><td height='14'></td></tr>\r\n        <tr bgcolor='#43B74A'>\r\n            <td align='center' style='color: #fff; font-size: 10px; font-weight: normal; font-family: Helvetica, Arial, sans-serif;' mc:edit='copy3'>\r\n    <multiline>\r\n         &copy; 2015  SITENAME.\r\n    </multiline>\r\n    </td>\r\n    </tr>\r\n\r\n    <tr  bgcolor='#43B74A' style='' >\r\n        <td>&nbsp;</td>\r\n    </tr>\r\n    </tbody></table>\r\n<!---------  end footer --------->\r\n</td>\r\n</tr>\r\n\r\n<tr><td height='30'></td></tr>\r\n\r\n</tbody></table>\r\n</div>\r\n', 'reminder_template');

    "); 

    $installer->endSetup();
?>
