
CREATE TABLE `soe` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(255) DEFAULT NULL,
 
  `Description` varchar(255) DEFAULT NULL,
  `Soft_delete` int(11) DEFAULT '1',
    `created_on` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=latin1;


ALTER TABLE `crm_customer` CHANGE `street` `pincode` VARCHAR(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL;

ALTER TABLE `crm_enquiry` CHANGE `street` `pincode` VARCHAR(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL;

ALTER TABLE `crm_customer` CHANGE `initialAmountpaid` `initialAmountpaid` INT NOT NULL DEFAULT '0';

ALTER TABLE `crm_customer` CHANGE `initialAmountpaid` `initialAmountpaid` INT(11) NOT NULL DEFAULT '0' COMMENT 'if this amount paid for sales .will change into 1';


ALTER TABLE `sale_project`  ADD `isPaid_initialAmount` INT NOT NULL DEFAULT '0'  AFTER `payment_status`;

ALTER TABLE `sale_project`  ADD `initialAmount` DECIMAL(12,3) NOT NULL DEFAULT '0.0'  AFTER `isPaid_initialAmount`;