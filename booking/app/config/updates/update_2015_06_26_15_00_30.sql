
START TRANSACTION;


INSERT INTO `fields` VALUES (NULL, 'short_days_ARRAY_0', 'arrays', 'short_days_ARRAY_0', 'script', NULL);

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '1', 'title', 'Su', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '2', 'title', 'Su', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '3', 'title', 'Su', 'script');

INSERT INTO `fields` VALUES (NULL, 'short_days_ARRAY_1', 'arrays', 'short_days_ARRAY_1', 'script', NULL);

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '1', 'title', 'Mo', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '2', 'title', 'Mo', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '3', 'title', 'Mo', 'script');

INSERT INTO `fields` VALUES (NULL, 'short_days_ARRAY_2', 'arrays', 'short_days_ARRAY_2', 'script', NULL);

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '1', 'title', 'Tu', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '2', 'title', 'Tu', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '3', 'title', 'Tu', 'script');

INSERT INTO `fields` VALUES (NULL, 'short_days_ARRAY_3', 'arrays', 'short_days_ARRAY_3', 'script', NULL);

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '1', 'title', 'We', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '2', 'title', 'We', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '3', 'title', 'We', 'script');

INSERT INTO `fields` VALUES (NULL, 'short_days_ARRAY_4', 'arrays', 'short_days_ARRAY_4', 'script', NULL);

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '1', 'title', 'Th', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '2', 'title', 'Th', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '3', 'title', 'Th', 'script');

INSERT INTO `fields` VALUES (NULL, 'short_days_ARRAY_5', 'arrays', 'short_days_ARRAY_5', 'script', NULL);

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '1', 'title', 'Fr', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '2', 'title', 'Fr', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '3', 'title', 'Fr', 'script');

INSERT INTO `fields` VALUES (NULL, 'short_days_ARRAY_6', 'arrays', 'short_days_ARRAY_6', 'script', NULL);

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '1', 'title', 'Sa', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '2', 'title', 'Sa', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '3', 'title', 'Sa', 'script');

INSERT INTO `fields` VALUES (NULL, 'enum_arr_ARRAY_mail', 'arrays', 'enum_arr_ARRAY_mail', 'script', '2015-06-11 08:35:51');

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '1', 'title', 'PHP mail()', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '2', 'title', 'PHP mail()', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '3', 'title', 'PHP mail()', 'script');

INSERT INTO `fields` VALUES (NULL, 'enum_arr_ARRAY_smtp', 'arrays', 'enum_arr_ARRAY_smtp', 'script', '2015-06-11 08:36:12');

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '1', 'title', 'SMTP', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '2', 'title', 'SMTP', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '3', 'title', 'SMTP', 'script');

INSERT INTO `fields` VALUES (NULL, 'enum_arr_ARRAY_confirmed', 'arrays', 'enum_arr_ARRAY_confirmed', 'script', '2015-06-11 08:38:00');

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '1', 'title', 'Confirmed', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '2', 'title', 'Confirmed', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '3', 'title', 'Confirmed', 'script');

INSERT INTO `fields` VALUES (NULL, 'enum_arr_ARRAY_pending', 'arrays', 'enum_arr_ARRAY_pending', 'script', '2015-06-11 08:38:16');

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '1', 'title', 'Pending', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '2', 'title', 'Pending', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '3', 'title', 'Pending', 'script');

INSERT INTO `fields` VALUES (NULL, 'enum_arr_ARRAY_cancelled', 'arrays', 'enum_arr_ARRAY_cancelled', 'script', '2015-06-11 08:38:35');

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '1', 'title', 'Cancelled', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '2', 'title', 'Cancelled', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '3', 'title', 'Cancelled', 'script');

INSERT INTO `fields` VALUES (NULL, 'enum_arr_ARRAY_Yes', 'arrays', 'enum_arr_ARRAY_Yes', 'script', '2015-06-11 08:38:55');

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '1', 'title', 'Yes', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '2', 'title', 'Yes', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '3', 'title', 'Yes', 'script');

INSERT INTO `fields` VALUES (NULL, 'enum_arr_ARRAY_No', 'arrays', 'enum_arr_ARRAY_No', 'script', '2015-06-11 08:39:09');

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '1', 'title', 'No', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '2', 'title', 'No', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '3', 'title', 'No', 'script');

INSERT INTO `fields` VALUES (NULL, 'enum_arr_ARRAY_0', 'arrays', 'enum_arr_ARRAY_0', 'script', '2015-06-11 08:39:25');

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '1', 'title', 'No', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '2', 'title', 'No', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '3', 'title', 'No', 'script');

INSERT INTO `fields` VALUES (NULL, 'enum_arr_ARRAY_1', 'arrays', 'enum_arr_ARRAY_1', 'script', '2015-06-11 08:39:44');

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '1', 'title', 'Yes', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '2', 'title', 'Yes', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '3', 'title', 'Yes', 'script');

INSERT INTO `fields` VALUES (NULL, 'enum_arr_ARRAY_2', 'arrays', 'enum_arr_ARRAY_2', 'script', '2015-06-11 08:45:56');

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '1', 'title', 'Yes (required)', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '2', 'title', 'Yes (required)', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '3', 'title', 'Yes (required)', 'script');

INSERT INTO `fields` VALUES (NULL, 'front_required_field', 'frontend', 'Label / This field is required.', 'script', '2015-06-26 08:21:52');

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '1', 'title', 'This field is required.', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '2', 'title', 'This field is required.', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '3', 'title', 'This field is required.', 'script');


INSERT INTO `fields` VALUES (NULL, 'lblBookingDeposit', 'backend', 'Label / Booking deposit', 'script', '2015-06-26 08:19:39');

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '1', 'title', 'Booking deposit', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '2', 'title', 'Booking deposit', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '3', 'title', 'Booking deposit', 'script');

INSERT INTO `fields` VALUES (NULL, 'lblSecurityDeposit', 'backend', 'Label / Security deposit', 'script', '2015-06-26 08:20:18');

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '1', 'title', 'Security deposit', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '2', 'title', 'Security deposit', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '3', 'title', 'Security deposit', 'script');

INSERT INTO `fields` VALUES (NULL, 'front_email_invalid', 'frontend', 'Label / Email is invalid.', 'script', '2015-06-26 08:25:49');

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '1', 'title', 'Email is invalid.', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '2', 'title', 'Email is invalid.', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '3', 'title', 'Email is invalid.', 'script');

COMMIT;