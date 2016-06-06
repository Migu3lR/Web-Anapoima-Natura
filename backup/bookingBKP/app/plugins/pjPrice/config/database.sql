DROP TABLE IF EXISTS `plugin_price`;
CREATE TABLE IF NOT EXISTS `plugin_price` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `foreign_id` int(10) unsigned NOT NULL,
  `tab_id` int(10) unsigned DEFAULT NULL,
  `season` varchar(255) DEFAULT NULL,
  `date_from` date DEFAULT NULL,
  `date_to` date DEFAULT NULL,
  `adults` tinyint(3) unsigned DEFAULT NULL,
  `children` tinyint(3) unsigned DEFAULT NULL,
  `mon` decimal(9,2) unsigned DEFAULT NULL,
  `tue` decimal(9,2) unsigned DEFAULT NULL,
  `wed` decimal(9,2) unsigned DEFAULT NULL,
  `thu` decimal(9,2) unsigned DEFAULT NULL,
  `fri` decimal(9,2) unsigned DEFAULT NULL,
  `sat` decimal(9,2) unsigned DEFAULT NULL,
  `sun` decimal(9,2) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `season` (`foreign_id`,`tab_id`,`season`,`adults`,`children`),
  UNIQUE KEY `dates` (`foreign_id`,`date_from`,`date_to`,`tab_id`,`adults`,`children`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

INSERT INTO `fields` (`id`, `key`, `type`, `label`, `source`, `modified`) VALUES
(NULL, 'plugin_price_menu', 'backend', 'Price plugin / Menu Prices', 'plugin', NULL);

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` (`id`, `foreign_id`, `model`, `locale`, `field`, `content`, `source`) VALUES
(NULL, @id, 'pjField', 1, 'title', 'Prices', 'plugin'),
(NULL, @id, 'pjField', 2, 'title', 'Prices', 'plugin'),
(NULL, @id, 'pjField', 3, 'title', 'Prices', 'plugin');

INSERT INTO `fields` (`id`, `key`, `type`, `label`, `source`, `modified`) VALUES
(NULL, 'plugin_price_add_season', 'backend', 'Price plugin / Add season', 'plugin', NULL);

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` (`id`, `foreign_id`, `model`, `locale`, `field`, `content`, `source`) VALUES
(NULL, @id, 'pjField', 1, 'title', '+ Add season', 'plugin'),
(NULL, @id, 'pjField', 2, 'title', '+ Add season', 'plugin'),
(NULL, @id, 'pjField', 3, 'title', '+ Add season', 'plugin');

INSERT INTO `fields` (`id`, `key`, `type`, `label`, `source`, `modified`) VALUES
(NULL, 'plugin_price_season_title', 'backend', 'Price plugin / Add season prices', 'plugin', NULL);

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` (`id`, `foreign_id`, `model`, `locale`, `field`, `content`, `source`) VALUES
(NULL, @id, 'pjField', 1, 'title', 'Add season prices', 'plugin'),
(NULL, @id, 'pjField', 2, 'title', 'Add season prices', 'plugin'),
(NULL, @id, 'pjField', 3, 'title', 'Add season prices', 'plugin');

INSERT INTO `fields` (`id`, `key`, `type`, `label`, `source`, `modified`) VALUES
(NULL, 'plugin_price_season_name', 'backend', 'Price plugin / Season name', 'plugin', NULL);

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` (`id`, `foreign_id`, `model`, `locale`, `field`, `content`, `source`) VALUES
(NULL, @id, 'pjField', 1, 'title', 'Name', 'plugin'),
(NULL, @id, 'pjField', 2, 'title', 'Name', 'plugin'),
(NULL, @id, 'pjField', 3, 'title', 'Name', 'plugin');

INSERT INTO `fields` (`id`, `key`, `type`, `label`, `source`, `modified`) VALUES
(NULL, 'plugin_price_date_range', 'backend', 'Price plugin / Date range', 'plugin', NULL);

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` (`id`, `foreign_id`, `model`, `locale`, `field`, `content`, `source`) VALUES
(NULL, @id, 'pjField', 1, 'title', 'Date range', 'plugin'),
(NULL, @id, 'pjField', 2, 'title', 'Date range', 'plugin'),
(NULL, @id, 'pjField', 3, 'title', 'Date range', 'plugin');

INSERT INTO `fields` (`id`, `key`, `type`, `label`, `source`, `modified`) VALUES
(NULL, 'plugin_price_from', 'backend', 'Price plugin / From', 'plugin', NULL);

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` (`id`, `foreign_id`, `model`, `locale`, `field`, `content`, `source`) VALUES
(NULL, @id, 'pjField', 1, 'title', 'From', 'plugin'),
(NULL, @id, 'pjField', 2, 'title', 'From', 'plugin'),
(NULL, @id, 'pjField', 3, 'title', 'From', 'plugin');

INSERT INTO `fields` (`id`, `key`, `type`, `label`, `source`, `modified`) VALUES
(NULL, 'plugin_price_to', 'backend', 'Price plugin / To', 'plugin', NULL);

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` (`id`, `foreign_id`, `model`, `locale`, `field`, `content`, `source`) VALUES
(NULL, @id, 'pjField', 1, 'title', 'To', 'plugin'),
(NULL, @id, 'pjField', 2, 'title', 'To', 'plugin'),
(NULL, @id, 'pjField', 3, 'title', 'To', 'plugin');

INSERT INTO `fields` (`id`, `key`, `type`, `label`, `source`, `modified`) VALUES
(NULL, 'plugin_price_default', 'backend', 'Price plugin / Default price', 'plugin', NULL);

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` (`id`, `foreign_id`, `model`, `locale`, `field`, `content`, `source`) VALUES
(NULL, @id, 'pjField', 1, 'title', 'Default price', 'plugin'),
(NULL, @id, 'pjField', 2, 'title', 'Default price', 'plugin'),
(NULL, @id, 'pjField', 3, 'title', 'Default price', 'plugin');

INSERT INTO `fields` (`id`, `key`, `type`, `label`, `source`, `modified`) VALUES
(NULL, 'plugin_price_adults', 'backend', 'Price plugin / Adults', 'plugin', NULL);

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` (`id`, `foreign_id`, `model`, `locale`, `field`, `content`, `source`) VALUES
(NULL, @id, 'pjField', 1, 'title', 'Adults', 'plugin'),
(NULL, @id, 'pjField', 2, 'title', 'Adults', 'plugin'),
(NULL, @id, 'pjField', 3, 'title', 'Adults', 'plugin');

INSERT INTO `fields` (`id`, `key`, `type`, `label`, `source`, `modified`) VALUES
(NULL, 'plugin_price_children', 'backend', 'Price plugin / Children', 'plugin', NULL);

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` (`id`, `foreign_id`, `model`, `locale`, `field`, `content`, `source`) VALUES
(NULL, @id, 'pjField', 1, 'title', 'Children', 'plugin'),
(NULL, @id, 'pjField', 2, 'title', 'Children', 'plugin'),
(NULL, @id, 'pjField', 3, 'title', 'Children', 'plugin');

INSERT INTO `fields` (`id`, `key`, `type`, `label`, `source`, `modified`) VALUES
(NULL, 'plugin_price_adults_children', 'backend', 'Price plugin / Adults & Children', 'plugin', NULL);

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` (`id`, `foreign_id`, `model`, `locale`, `field`, `content`, `source`) VALUES
(NULL, @id, 'pjField', 1, 'title', '+ Adults & Children', 'plugin'),
(NULL, @id, 'pjField', 2, 'title', '+ Adults & Children', 'plugin'),
(NULL, @id, 'pjField', 3, 'title', '+ Adults & Children', 'plugin');

INSERT INTO `fields` (`id`, `key`, `type`, `label`, `source`, `modified`) VALUES
(NULL, 'plugin_price_save', 'backend', 'Price plugin / Save', 'plugin', NULL);

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` (`id`, `foreign_id`, `model`, `locale`, `field`, `content`, `source`) VALUES
(NULL, @id, 'pjField', 1, 'title', 'Save', 'plugin'),
(NULL, @id, 'pjField', 2, 'title', 'Save', 'plugin'),
(NULL, @id, 'pjField', 3, 'title', 'Save', 'plugin');

INSERT INTO `fields` (`id`, `key`, `type`, `label`, `source`, `modified`) VALUES
(NULL, 'plugin_price_days_ARRAY_monday', 'arrays', 'Price plugin / Days - Monday', 'plugin', NULL);

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` (`id`, `foreign_id`, `model`, `locale`, `field`, `content`, `source`) VALUES
(NULL, @id, 'pjField', 1, 'title', 'Monday', 'plugin'),
(NULL, @id, 'pjField', 2, 'title', 'Monday', 'plugin'),
(NULL, @id, 'pjField', 3, 'title', 'Monday', 'plugin');

INSERT INTO `fields` (`id`, `key`, `type`, `label`, `source`, `modified`) VALUES
(NULL, 'plugin_price_days_ARRAY_tuesday', 'arrays', 'Price plugin / Days - Tuesday', 'plugin', NULL);

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` (`id`, `foreign_id`, `model`, `locale`, `field`, `content`, `source`) VALUES
(NULL, @id, 'pjField', 1, 'title', 'Tuesday', 'plugin'),
(NULL, @id, 'pjField', 2, 'title', 'Tuesday', 'plugin'),
(NULL, @id, 'pjField', 3, 'title', 'Tuesday', 'plugin');

INSERT INTO `fields` (`id`, `key`, `type`, `label`, `source`, `modified`) VALUES
(NULL, 'plugin_price_days_ARRAY_wednesday', 'arrays', 'Price plugin / Days - Wednesday', 'plugin', NULL);

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` (`id`, `foreign_id`, `model`, `locale`, `field`, `content`, `source`) VALUES
(NULL, @id, 'pjField', 1, 'title', 'Wednesday', 'plugin'),
(NULL, @id, 'pjField', 2, 'title', 'Wednesday', 'plugin'),
(NULL, @id, 'pjField', 3, 'title', 'Wednesday', 'plugin');

INSERT INTO `fields` (`id`, `key`, `type`, `label`, `source`, `modified`) VALUES
(NULL, 'plugin_price_days_ARRAY_thursday', 'arrays', 'Price plugin / Days - Thursday', 'plugin', NULL);

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` (`id`, `foreign_id`, `model`, `locale`, `field`, `content`, `source`) VALUES
(NULL, @id, 'pjField', 1, 'title', 'Thursday', 'plugin'),
(NULL, @id, 'pjField', 2, 'title', 'Thursday', 'plugin'),
(NULL, @id, 'pjField', 3, 'title', 'Thursday', 'plugin');

INSERT INTO `fields` (`id`, `key`, `type`, `label`, `source`, `modified`) VALUES
(NULL, 'plugin_price_days_ARRAY_friday', 'arrays', 'Price plugin / Days - Friday', 'plugin', NULL);

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` (`id`, `foreign_id`, `model`, `locale`, `field`, `content`, `source`) VALUES
(NULL, @id, 'pjField', 1, 'title', 'Friday', 'plugin'),
(NULL, @id, 'pjField', 2, 'title', 'Friday', 'plugin'),
(NULL, @id, 'pjField', 3, 'title', 'Friday', 'plugin');

INSERT INTO `fields` (`id`, `key`, `type`, `label`, `source`, `modified`) VALUES
(NULL, 'plugin_price_days_ARRAY_saturday', 'arrays', 'Price plugin / Days - Saturday', 'plugin', NULL);

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` (`id`, `foreign_id`, `model`, `locale`, `field`, `content`, `source`) VALUES
(NULL, @id, 'pjField', 1, 'title', 'Saturday', 'plugin'),
(NULL, @id, 'pjField', 2, 'title', 'Saturday', 'plugin'),
(NULL, @id, 'pjField', 3, 'title', 'Saturday', 'plugin');

INSERT INTO `fields` (`id`, `key`, `type`, `label`, `source`, `modified`) VALUES
(NULL, 'plugin_price_days_ARRAY_sunday', 'arrays', 'Price plugin / Days - Sunday', 'plugin', NULL);

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` (`id`, `foreign_id`, `model`, `locale`, `field`, `content`, `source`) VALUES
(NULL, @id, 'pjField', 1, 'title', 'Sunday', 'plugin'),
(NULL, @id, 'pjField', 2, 'title', 'Sunday', 'plugin'),
(NULL, @id, 'pjField', 3, 'title', 'Sunday', 'plugin');

INSERT INTO `fields` (`id`, `key`, `type`, `label`, `source`, `modified`) VALUES
(NULL, 'error_titles_ARRAY_PPR02', 'arrays', 'Price plugin / Missing parameters', 'plugin', NULL);

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` (`id`, `foreign_id`, `model`, `locale`, `field`, `content`, `source`) VALUES
(NULL, @id, 'pjField', 1, 'title', 'Missing parameters!', 'plugin'),
(NULL, @id, 'pjField', 2, 'title', 'Missing parameters!', 'plugin'),
(NULL, @id, 'pjField', 3, 'title', 'Missing parameters!', 'plugin');

INSERT INTO `fields` (`id`, `key`, `type`, `label`, `source`, `modified`) VALUES
(NULL, 'error_bodies_ARRAY_PPR02', 'arrays', 'Price plugin / Missing parameters', 'plugin', NULL);

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` (`id`, `foreign_id`, `model`, `locale`, `field`, `content`, `source`) VALUES
(NULL, @id, 'pjField', 1, 'title', 'It seems that there are missing parameters.', 'plugin'),
(NULL, @id, 'pjField', 2, 'title', 'It seems that there are missing parameters.', 'plugin'),
(NULL, @id, 'pjField', 3, 'title', 'It seems that there are missing parameters.', 'plugin');

INSERT INTO `fields` (`id`, `key`, `type`, `label`, `source`, `modified`) VALUES
(NULL, 'error_titles_ARRAY_PPR01', 'arrays', 'Price plugin / Price saved', 'plugin', NULL);

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` (`id`, `foreign_id`, `model`, `locale`, `field`, `content`, `source`) VALUES
(NULL, @id, 'pjField', 1, 'title', 'Prices have been saved!', 'plugin'),
(NULL, @id, 'pjField', 2, 'title', 'Prices have been saved!', 'plugin'),
(NULL, @id, 'pjField', 3, 'title', 'Prices have been saved!', 'plugin');

INSERT INTO `fields` (`id`, `key`, `type`, `label`, `source`, `modified`) VALUES
(NULL, 'error_bodies_ARRAY_PPR01', 'arrays', 'Price plugin / Price saved', 'plugin', NULL);

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` (`id`, `foreign_id`, `model`, `locale`, `field`, `content`, `source`) VALUES
(NULL, @id, 'pjField', 1, 'title', 'Prices have been saved successfully.', 'plugin'),
(NULL, @id, 'pjField', 2, 'title', 'Prices have been saved successfully.', 'plugin'),
(NULL, @id, 'pjField', 3, 'title', 'Prices have been saved successfully.', 'plugin');

INSERT INTO `fields` (`id`, `key`, `type`, `label`, `source`, `modified`) VALUES
(NULL, 'error_titles_ARRAY_PPR03', 'arrays', 'Price plugin / Prices title', 'plugin', NULL);

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` (`id`, `foreign_id`, `model`, `locale`, `field`, `content`, `source`) VALUES
(NULL, @id, 'pjField', 1, 'title', 'Prices', 'plugin'),
(NULL, @id, 'pjField', 2, 'title', 'Prices', 'plugin'),
(NULL, @id, 'pjField', 3, 'title', 'Prices', 'plugin');

INSERT INTO `fields` (`id`, `key`, `type`, `label`, `source`, `modified`) VALUES
(NULL, 'error_bodies_ARRAY_PPR03', 'arrays', 'Price plugin / Prices content', 'plugin', NULL);

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` (`id`, `foreign_id`, `model`, `locale`, `field`, `content`, `source`) VALUES
(NULL, @id, 'pjField', 1, 'title', 'Set a default daily/nightly price for each date of the week. Click on the "Adults & Children" button to add different price based on number of adults and children selected on the reservation form. Click on "Add season" to set different prices for specific date periods.', 'plugin'),
(NULL, @id, 'pjField', 2, 'title', 'Set a default daily/nightly price for each date of the week. Click on the "Adults & Children" button to add different price based on number of adults and children selected on the reservation form. Click on "Add season" to set different prices for specific date periods.', 'plugin'),
(NULL, @id, 'pjField', 3, 'title', 'Set a default daily/nightly price for each date of the week. Click on the "Adults & Children" button to add different price based on number of adults and children selected on the reservation form. Click on "Add season" to set different prices for specific date periods.', 'plugin');

INSERT INTO `fields` (`id`, `key`, `type`, `label`, `source`, `modified`) VALUES
(NULL, 'plugin_price_status_start', 'backend', 'Price plugin / Saving start notification', 'plugin', NULL);

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` (`id`, `foreign_id`, `model`, `locale`, `field`, `content`, `source`) VALUES
(NULL, @id, 'pjField', 1, 'title', 'Please wait while prices are saved...', 'plugin'),
(NULL, @id, 'pjField', 2, 'title', 'Please wait while prices are saved...', 'plugin'),
(NULL, @id, 'pjField', 3, 'title', 'Please wait while prices are saved...', 'plugin');

INSERT INTO `fields` (`id`, `key`, `type`, `label`, `source`, `modified`) VALUES
(NULL, 'plugin_price_status_end', 'backend', 'Price plugin / Saving end notification', 'plugin', NULL);

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` (`id`, `foreign_id`, `model`, `locale`, `field`, `content`, `source`) VALUES
(NULL, @id, 'pjField', 1, 'title', 'Prices has been saved.', 'plugin'),
(NULL, @id, 'pjField', 2, 'title', 'Prices has been saved.', 'plugin'),
(NULL, @id, 'pjField', 3, 'title', 'Prices has been saved.', 'plugin');

INSERT INTO `fields` (`id`, `key`, `type`, `label`, `source`, `modified`) VALUES
(NULL, 'plugin_price_delete_title', 'backend', 'Price plugin / Delete confirmation', 'plugin', NULL);

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` (`id`, `foreign_id`, `model`, `locale`, `field`, `content`, `source`) VALUES
(NULL, @id, 'pjField', 1, 'title', 'Delete confirmation', 'plugin'),
(NULL, @id, 'pjField', 2, 'title', 'Delete confirmation', 'plugin'),
(NULL, @id, 'pjField', 3, 'title', 'Delete confirmation', 'plugin');

INSERT INTO `fields` (`id`, `key`, `type`, `label`, `source`, `modified`) VALUES
(NULL, 'plugin_price_delete_content', 'backend', 'Price plugin / Are you sure you want to delete selected row?', 'plugin', NULL);

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` (`id`, `foreign_id`, `model`, `locale`, `field`, `content`, `source`) VALUES
(NULL, @id, 'pjField', 1, 'title', 'Are you sure you want to delete selected row? Please, note that you should click SAVE button to save the changes.', 'plugin'),
(NULL, @id, 'pjField', 2, 'title', 'Are you sure you want to delete selected row? Please, note that you should click SAVE button to save the changes.', 'plugin'),
(NULL, @id, 'pjField', 3, 'title', 'Are you sure you want to delete selected row? Please, note that you should click SAVE button to save the changes.', 'plugin');

INSERT INTO `fields` (`id`, `key`, `type`, `label`, `source`, `modified`) VALUES
(NULL, 'plugin_price_delete_season_title', 'backend', 'Price plugin / Delete confirmation', 'plugin', NULL);

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` (`id`, `foreign_id`, `model`, `locale`, `field`, `content`, `source`) VALUES
(NULL, @id, 'pjField', 1, 'title', 'Delete confirmation', 'plugin'),
(NULL, @id, 'pjField', 2, 'title', 'Delete confirmation', 'plugin'),
(NULL, @id, 'pjField', 3, 'title', 'Delete confirmation', 'plugin');

INSERT INTO `fields` (`id`, `key`, `type`, `label`, `source`, `modified`) VALUES
(NULL, 'plugin_price_delete_season_content', 'backend', 'Price plugin / Are you sure you want to delete selected season?', 'plugin', NULL);

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` (`id`, `foreign_id`, `model`, `locale`, `field`, `content`, `source`) VALUES
(NULL, @id, 'pjField', 1, 'title', 'Are you sure you want to delete selected season? Please, note that you should click SAVE button to save the changes.', 'plugin'),
(NULL, @id, 'pjField', 2, 'title', 'Are you sure you want to delete selected season? Please, note that you should click SAVE button to save the changes.', 'plugin'),
(NULL, @id, 'pjField', 3, 'title', 'Are you sure you want to delete selected season? Please, note that you should click SAVE button to save the changes.', 'plugin');

INSERT INTO `fields` (`id`, `key`, `type`, `label`, `source`, `modified`) VALUES
(NULL, 'plugin_price_status_title', 'backend', 'Price plugin / Saving dialog title', 'plugin', NULL);

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` (`id`, `foreign_id`, `model`, `locale`, `field`, `content`, `source`) VALUES
(NULL, @id, 'pjField', 1, 'title', 'Status', 'plugin'),
(NULL, @id, 'pjField', 2, 'title', 'Status', 'plugin'),
(NULL, @id, 'pjField', 3, 'title', 'Status', 'plugin');

INSERT INTO `fields` (`id`, `key`, `type`, `label`, `source`, `modified`) VALUES
(NULL, 'plugin_price_status_fail', 'backend', 'Price plugin / Saving fail notification', 'plugin', NULL);

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` (`id`, `foreign_id`, `model`, `locale`, `field`, `content`, `source`) VALUES
(NULL, @id, 'pjField', 1, 'title', 'The season date range overlap with another season.', 'plugin'),
(NULL, @id, 'pjField', 2, 'title', 'The season date range overlap with another season.', 'plugin'),
(NULL, @id, 'pjField', 3, 'title', 'The season date range overlap with another season.', 'plugin');

INSERT INTO `fields` (`id`, `key`, `type`, `label`, `source`, `modified`) VALUES
(NULL, 'error_titles_ARRAY_PPR09', 'arrays', 'Price plugin / Overlap title', 'plugin', NULL);

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` (`id`, `foreign_id`, `model`, `locale`, `field`, `content`, `source`) VALUES
(NULL, @id, 'pjField', 1, 'title', 'Attention', 'plugin'),
(NULL, @id, 'pjField', 2, 'title', 'Attention', 'plugin'),
(NULL, @id, 'pjField', 3, 'title', 'Attention', 'plugin');

INSERT INTO `fields` (`id`, `key`, `type`, `label`, `source`, `modified`) VALUES
(NULL, 'error_bodies_ARRAY_PPR09', 'arrays', 'Price plugin / Overlap message', 'plugin', NULL);

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` (`id`, `foreign_id`, `model`, `locale`, `field`, `content`, `source`) VALUES
(NULL, @id, 'pjField', 1, 'title', 'Please note that there are overlapping date periods.', 'plugin'),
(NULL, @id, 'pjField', 2, 'title', 'Please note that there are overlapping date periods.', 'plugin'),
(NULL, @id, 'pjField', 3, 'title', 'Please note that there are overlapping date periods.', 'plugin');