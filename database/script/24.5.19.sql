ALTER TABLE `sale_project` ADD `Moratorium` DECIMAL(12,2) NOT NULL DEFAULT '0.0' AFTER `initialAmount`;
ALTER TABLE `sale_project` CHANGE `Moratorium` `moratorium` DECIMAL(12,2) NOT NULL DEFAULT '0.00';
ALTER TABLE `settings`  ADD `moratorium_percentage` DECIMAL(12,2) NOT NULL DEFAULT '0.0'  AFTER `soft_delete`;
UPDATE `settings` SET `moratorium_percentage` = '30' WHERE `settings`.`id` = 1;
ALTER TABLE `sales_emi`  ADD `type` INT NOT NULL DEFAULT '1' COMMENT '1 means moratorium  '  AFTER `Ending_Balance`;

