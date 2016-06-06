
START TRANSACTION;

INSERT INTO `fields` VALUES (NULL, 'front_captcha_incorrect', 'frontend', 'Label / Captcha is incorrect.', 'script', '2015-07-28 01:42:06');

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '1', 'title', 'Captcha is incorrect.', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '2', 'title', 'Captcha is incorrect.', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '3', 'title', 'Captcha is incorrect.', 'script');

INSERT INTO `fields` VALUES (NULL, 'front_captcha_minlength', 'frontend', 'Label / Please enter at least 6 characters.', 'script', '2015-07-28 01:43:08');

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '1', 'title', 'Please enter at least 6 characters.', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '2', 'title', 'Please enter at least 6 characters.', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '3', 'title', 'Please enter at least 6 characters.', 'script');

INSERT INTO `fields` VALUES (NULL, 'front_btn_ok', 'frontend', 'Button / OK', 'script', '2015-07-28 01:52:56');

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '1', 'title', 'OK', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '2', 'title', 'OK', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '3', 'title', 'OK', 'script');

COMMIT;