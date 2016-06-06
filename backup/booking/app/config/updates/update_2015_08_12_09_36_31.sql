
START TRANSACTION;

INSERT INTO `fields` VALUES (NULL, 'lblNoRoomMessage', 'backend', 'Label / No room message', 'script', '2015-08-12 09:25:24');

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '1', 'title', 'No rooms found. Click {STAG}here{ETAG} to add one.', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '2', 'title', 'No rooms found. Click {STAG}here{ETAG} to add one.', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '3', 'title', 'No rooms found. Click {STAG}here{ETAG} to add one.', 'script');

COMMIT;