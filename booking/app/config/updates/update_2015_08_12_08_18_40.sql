
START TRANSACTION;

INSERT INTO `fields` VALUES (NULL, 'more_prices', 'backend', 'Label / More prices', 'script', '2015-08-12 08:10:17');

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '1', 'title', 'More prices', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '2', 'title', 'More prices', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '3', 'title', 'More prices', 'script');

INSERT INTO `fields` VALUES (NULL, 'prices_based_on_adults_children', 'backend', 'Label / Price based on adults & children', 'script', '2015-08-12 08:16:10');

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '1', 'title', 'Price based on adults & children', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '2', 'title', 'Price based on adults & children', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '3', 'title', 'Price based on adults & children', 'script');

INSERT INTO `fields` VALUES (NULL, 'discount_enter_price', 'backend', 'Label / Enter price', 'script', '2015-08-12 08:17:48');

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '1', 'title', 'Enter price', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '2', 'title', 'Enter price', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '3', 'title', 'Enter price', 'script');

COMMIT;