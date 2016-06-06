
START TRANSACTION;

INSERT INTO `fields` VALUES (NULL, 'front_accommodation', 'backend', 'Frontend / Accommodation', 'script', '2015-05-13 13:18:47');

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '1', 'title', 'This room accommodates:', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '2', 'title', 'This room accommodates:', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '3', 'title', 'This room accommodates:', 'script');

COMMIT;