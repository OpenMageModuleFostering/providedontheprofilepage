<?php
/**
 *
 *
 * @Udaan Technology (http://www.udaantechnologies.com/)
 * @copyright  Copyright (c) 2014 Udaan Technology 
 * @license    http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */


$installer = $this;

$installer->startSetup();

Mage::helper('smtppro/mysql4_install')->prepareForDb();

Mage::helper('smtppro/mysql4_install')->attemptQuery($installer, "
    CREATE TABLE IF NOT EXISTS `{$this->getTable('Abandon_added_product')}` (
      `abandon_id` int(11) NOT NULL AUTO_INCREMENT,
  `added_user_id` varchar(255) NOT NULL,
  `added_prod_id` varchar(255) NOT NULL,
  `added_entity_id` varchar(255) NOT NULL,
  `abandon_email_status` tinyint(1) NOT NULL,
  PRIMARY KEY (`abandon_id`)
    ) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;
");



Mage::helper('smtppro/mysql4_install')->createInstallNotice("Abandon_added_product was installed successfully.", "SMTP Pro has been installed successfully. Go to the system configuration section of your Magento admin to configure SMTP Pro and get it up and running.");

$installer->endSetup();
