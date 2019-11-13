ALTER TABLE `crm_customer` ADD `initialamount_date` DATE NOT NULL AFTER `initialAmountpaid`;
ALTER TABLE `crm_customer` CHANGE `initialAmountpaid` `initialAmountpaid` DECIMAL(12,2) NOT NULL DEFAULT '0';
ALTER TABLE `sales_emi`  ADD `balance` DECIMAL(12,3) NOT NULL  AFTER `emi_status`;