
START TRANSACTION;

INSERT INTO `fields` VALUES (NULL, 'welcome_switch_btn_preview', 'backend', 'Welcome / Preview standard dashboard', 'script', '2015-03-30 07:08:01');

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '1', 'title', 'Preview standard dashboard', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '2', 'title', 'Preview standard dashboard', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '3', 'title', 'Preview standard dashboard', 'script');

INSERT INTO `fields` VALUES (NULL, 'welcome_switch_btn_switch', 'backend', 'Welcome / Permanently switch to standard dashboard', 'script', '2015-03-30 07:08:29');

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '1', 'title', 'Permanently switch to standard dashboard', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '2', 'title', 'Permanently switch to standard dashboard', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '3', 'title', 'Permanently switch to standard dashboard', 'script');

INSERT INTO `fields` VALUES (NULL, 'welcome_switch_btn_cancel', 'backend', 'Welcome / Cancel', 'script', '2015-03-30 07:08:48');

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '1', 'title', 'Cancel', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '2', 'title', 'Cancel', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '3', 'title', 'Cancel', 'script');

INSERT INTO `fields` VALUES (NULL, 'welcome_switch_btn_done', 'backend', 'Welcome / Done', 'script', '2015-03-30 07:11:45');

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '1', 'title', 'Yes, I''ve done this', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '2', 'title', 'Yes, I''ve done this', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '3', 'title', 'Yes, I''ve done this', 'script');

INSERT INTO `fields` VALUES (NULL, 'dash_tab_arrivals', 'backend', 'Dashboard / Tab Arrivals', 'script', '2015-03-30 07:22:26');

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '1', 'title', 'Arrivals', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '2', 'title', 'Arrivals', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '3', 'title', 'Arrivals', 'script');

INSERT INTO `fields` VALUES (NULL, 'dash_tab_departures', 'backend', 'Dashboard / Tab Departures', 'script', '2015-03-30 07:22:44');

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '1', 'title', 'Departures', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '2', 'title', 'Departures', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '3', 'title', 'Departures', 'script');

INSERT INTO `fields` VALUES (NULL, 'dash_tab_latest', 'backend', 'Dashboard / Tab Latest', 'script', '2015-03-30 07:23:00');

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '1', 'title', 'Latest', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '2', 'title', 'Latest', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '3', 'title', 'Latest', 'script');

INSERT INTO `fields` VALUES (NULL, 'dash_tab_upcoming', 'backend', 'Dashboard / Tab Upcoming Bookings', 'script', '2015-03-30 07:23:22');

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '1', 'title', 'Upcoming Bookings', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '2', 'title', 'Upcoming Bookings', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '3', 'title', 'Upcoming Bookings', 'script');

INSERT INTO `fields` VALUES (NULL, 'dash_tab_past', 'backend', 'Dashboard / Tab Past Bookings', 'script', '2015-03-30 07:23:40');

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '1', 'title', 'Past Bookings', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '2', 'title', 'Past Bookings', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '3', 'title', 'Past Bookings', 'script');

INSERT INTO `fields` VALUES (NULL, 'dash_no_arrivals', 'backend', 'Dashboard / No arrivals today', 'script', '2015-03-30 07:24:31');

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '1', 'title', 'No arrivals today.', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '2', 'title', 'No arrivals today.', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '3', 'title', 'No arrivals today.', 'script');

INSERT INTO `fields` VALUES (NULL, 'dash_no_departures', 'backend', 'Dashboard / No departures today', 'script', '2015-03-30 07:24:50');

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '1', 'title', 'No departures today.', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '2', 'title', 'No departures today.', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '3', 'title', 'No departures today.', 'script');

INSERT INTO `fields` VALUES (NULL, 'error_titles_ARRAY_AU11', 'arrays', 'error_titles_ARRAY_AU11', 'script', '2015-03-30 08:40:16');

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '1', 'title', 'Users', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '2', 'title', 'Users', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '3', 'title', 'Users', 'script');

INSERT INTO `fields` VALUES (NULL, 'error_bodies_ARRAY_AU11', 'arrays', 'error_bodies_ARRAY_AU11', 'script', '2015-03-30 08:41:55');

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '1', 'title', 'Below you can view system users. Under the Add user tab you can add a new user. To Edit a user just click on the edit icon next to it.', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '2', 'title', 'Below you can view system users. Under the Add user tab you can add a new user. To Edit a user just click on the edit icon next to it.', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '3', 'title', 'Below you can view system users. Under the Add user tab you can add a new user. To Edit a user just click on the edit icon next to it.', 'script');

INSERT INTO `fields` VALUES (NULL, 'error_titles_ARRAY_AU12', 'arrays', 'error_titles_ARRAY_AU12', 'script', '2015-03-30 08:48:54');

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '1', 'title', 'Add an User', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '2', 'title', 'Add an User', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '3', 'title', 'Add an User', 'script');

INSERT INTO `fields` VALUES (NULL, 'error_bodies_ARRAY_AU12', 'arrays', 'error_bodies_ARRAY_AU12', 'script', '2015-03-30 09:09:35');

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '1', 'title', 'Enter role (e.g. admin or editor), email and password for the user. You can also specify the name and phone of the user.', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '2', 'title', 'Enter role (e.g. admin or editor), email and password for the user. You can also specify the name and phone of the user.', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '3', 'title', 'Enter role (e.g. admin or editor), email and password for the user. You can also specify the name and phone of the user.', 'script');

INSERT INTO `fields` VALUES (NULL, 'error_titles_ARRAY_AU13', 'arrays', 'error_titles_ARRAY_AU13', 'script', '2015-03-30 09:11:27');

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '1', 'title', 'Update an User', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '2', 'title', 'Update an User', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '3', 'title', 'Update an User', 'script');

INSERT INTO `fields` VALUES (NULL, 'error_bodies_ARRAY_AU13', 'arrays', 'error_bodies_ARRAY_AU13', 'script', '2015-03-30 09:12:48');

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '1', 'title', 'Update role (e.g. admin or editor), email, password and status of the user. You can also specify the name and phone of the user.', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '2', 'title', 'Update role (e.g. admin or editor), email, password and status of the user. You can also specify the name and phone of the user.', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '3', 'title', 'Update role (e.g. admin or editor), email, password and status of the user. You can also specify the name and phone of the user.', 'script');

INSERT INTO `fields` VALUES (NULL, 'booking_rooms_extras', 'backend', 'Bookings / Rooms & Extras', 'script', '2015-03-30 09:55:05');

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '1', 'title', 'Rooms and extras', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '2', 'title', 'Rooms and extras', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '3', 'title', 'Rooms and extras', 'script');

INSERT INTO `fields` VALUES (NULL, 'booking_arrival_date_time', 'backend', 'Bookings / Arrival date & time', 'script', '2015-03-30 10:00:11');

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '1', 'title', 'Arrival date / time', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '2', 'title', 'Arrival date / time', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '3', 'title', 'Arrival date / time', 'script');

INSERT INTO `fields` VALUES (NULL, 'rooms_price', 'backend', 'Rooms / Price', 'script', '2015-03-30 12:28:58');

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '1', 'title', 'Price', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '2', 'title', 'Price', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '3', 'title', 'Price', 'script');

INSERT INTO `fields` VALUES (NULL, 'booking_amount_tooltip', 'backend', 'Bookings / Amount tooltip', 'script', '2015-03-30 12:56:37');

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '1', 'title', '{AMOUNT} is the correct amount according to the lastest changes you have made to this reservation. If you wish to update the amount, please click on ''{BUTTON}'' button.', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '2', 'title', '{AMOUNT} is the correct amount according to the lastest changes you have made to this reservation. If you wish to update the amount, please click on ''{BUTTON}'' button.', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '3', 'title', '{AMOUNT} is the correct amount according to the lastest changes you have made to this reservation. If you wish to update the amount, please click on ''{BUTTON}'' button.', 'script');

COMMIT;