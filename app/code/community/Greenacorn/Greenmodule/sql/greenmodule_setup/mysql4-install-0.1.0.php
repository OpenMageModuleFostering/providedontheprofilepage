<?php
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
    
    $installer->endSetup();
?>
