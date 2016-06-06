
START TRANSACTION;

INSERT INTO `fields` VALUES (NULL, 'report_guests', 'backend', 'Reports / Guests', 'script', '2015-03-20 11:37:44');

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '1', 'title', 'Guests', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '2', 'title', 'Guests', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '3', 'title', 'Guests', 'script');

INSERT INTO `fields` VALUES (NULL, 'report_guest', 'backend', 'Reports / Guest', 'script', '2015-03-20 11:37:56');

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '1', 'title', 'Guest', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '2', 'title', 'Guest', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '3', 'title', 'Guest', 'script');

INSERT INTO `fields` VALUES (NULL, 'report_nights', 'backend', 'Reports / Nights', 'script', '2015-03-20 11:38:12');

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '1', 'title', 'Nights', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '2', 'title', 'Nights', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '3', 'title', 'Nights', 'script');

INSERT INTO `fields` VALUES (NULL, 'report_night', 'backend', 'Reports / Night', 'script', '2015-03-20 11:38:20');

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '1', 'title', 'Night', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '2', 'title', 'Night', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '3', 'title', 'Night', 'script');

INSERT INTO `fields` VALUES (NULL, 'report_total', 'backend', 'Reports / Total', 'script', '2015-03-20 11:38:34');

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '1', 'title', 'Total', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '2', 'title', 'Total', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '3', 'title', 'Total', 'script');

INSERT INTO `fields` VALUES (NULL, 'report_confirmed_bookings', 'backend', 'Reports / Confirmed Bookings', 'script', '2015-03-20 11:38:54');

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '1', 'title', 'Confirmed Bookings', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '2', 'title', 'Confirmed Bookings', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '3', 'title', 'Confirmed Bookings', 'script');

INSERT INTO `fields` VALUES (NULL, 'report_cancelled_bookings', 'backend', 'Reports / Cancelled Bookings', 'script', '2015-03-20 11:39:08');

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '1', 'title', 'Cancelled Bookings', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '2', 'title', 'Cancelled Bookings', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '3', 'title', 'Cancelled Bookings', 'script');

INSERT INTO `fields` VALUES (NULL, 'report_rooms_per_booking', 'backend', 'Reports / Rooms Per Booking', 'script', '2015-03-20 11:39:22');

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '1', 'title', 'Rooms Per Booking', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '2', 'title', 'Rooms Per Booking', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '3', 'title', 'Rooms Per Booking', 'script');

INSERT INTO `fields` VALUES (NULL, 'report_nights_per_booking', 'backend', 'Reports / Nights Per Booking', 'script', '2015-03-20 11:39:42');

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '1', 'title', 'Nights Per Booking', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '2', 'title', 'Nights Per Booking', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '3', 'title', 'Nights Per Booking', 'script');

INSERT INTO `fields` VALUES (NULL, 'report_total_bookings', 'backend', 'Reports / Total bookings', 'script', '2015-03-20 11:39:58');

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '1', 'title', 'Total bookings', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '2', 'title', 'Total bookings', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '3', 'title', 'Total bookings', 'script');

INSERT INTO `fields` VALUES (NULL, 'report_total_people', 'backend', 'Reports / Total people stayed', 'script', '2015-03-20 11:40:11');

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '1', 'title', 'Total people stayed', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '2', 'title', 'Total people stayed', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '3', 'title', 'Total people stayed', 'script');

INSERT INTO `fields` VALUES (NULL, 'report_total_nights', 'backend', 'Reports / Total nights booked', 'script', '2015-03-20 11:40:24');

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '1', 'title', 'Total nights booked', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '2', 'title', 'Total nights booked', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '3', 'title', 'Total nights booked', 'script');

INSERT INTO `fields` VALUES (NULL, 'report_nights_arr_ARRAY_1', 'arrays', 'Reports / 1 Night Bookings', 'script', '2015-03-20 11:41:25');

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '1', 'title', '1 Night Bookings', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '2', 'title', '1 Night Bookings', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '3', 'title', '1 Night Bookings', 'script');

INSERT INTO `fields` VALUES (NULL, 'report_nights_arr_ARRAY_2', 'arrays', 'Reports / 2 Nights Bookings', 'script', '2015-03-20 11:43:00');

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '1', 'title', '2 Nights Bookings', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '2', 'title', '2 Nights Bookings', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '3', 'title', '2 Nights Bookings', 'script');

INSERT INTO `fields` VALUES (NULL, 'report_nights_arr_ARRAY_3', 'arrays', 'Reports / 3 Nights Bookings', 'script', '2015-03-20 11:43:11');

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '1', 'title', '3 Nights Bookings', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '2', 'title', '3 Nights Bookings', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '3', 'title', '3 Nights Bookings', 'script');

INSERT INTO `fields` VALUES (NULL, 'report_nights_arr_ARRAY_4', 'arrays', 'Reports / 4 Nights Bookings', 'script', '2015-03-20 11:43:22');

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '1', 'title', '4 Nights Bookings', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '2', 'title', '4 Nights Bookings', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '3', 'title', '4 Nights Bookings', 'script');

INSERT INTO `fields` VALUES (NULL, 'report_nights_arr_ARRAY_5', 'arrays', 'Reports / 5 Nights Bookings', 'script', '2015-03-20 11:43:33');

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '1', 'title', '5 Nights Bookings', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '2', 'title', '5 Nights Bookings', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '3', 'title', '5 Nights Bookings', 'script');

INSERT INTO `fields` VALUES (NULL, 'report_nights_arr_ARRAY_6', 'arrays', 'Reports / 6 Nights Bookings', 'script', '2015-03-20 11:43:53');

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '1', 'title', '6 Nights Bookings', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '2', 'title', '6 Nights Bookings', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '3', 'title', '6 Nights Bookings', 'script');

INSERT INTO `fields` VALUES (NULL, 'report_nights_arr_ARRAY_7', 'arrays', 'Reports / More Than 6 Nights Bookings', 'script', '2015-03-20 11:44:38');

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '1', 'title', 'More Than 6 Nights Bookings', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '2', 'title', 'More Than 6 Nights Bookings', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '3', 'title', 'More Than 6 Nights Bookings', 'script');

INSERT INTO `fields` VALUES (NULL, 'report_guests_per_booking', 'backend', 'Reports / Guests Per Booking', 'script', '2015-03-20 11:44:56');

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '1', 'title', 'Guests Per Booking', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '2', 'title', 'Guests Per Booking', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '3', 'title', 'Guests Per Booking', 'script');

INSERT INTO `fields` VALUES (NULL, 'report_only_adults', 'backend', 'Reports / (only adults guest counting)', 'script', '2015-03-20 11:45:11');

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '1', 'title', '(only adults guest counting)', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '2', 'title', '(only adults guest counting)', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '3', 'title', '(only adults guest counting)', 'script');

INSERT INTO `fields` VALUES (NULL, 'report_guests_arr_ARRAY_1', 'arrays', 'Reports / 1 Guest Bookings', 'script', '2015-03-20 11:45:30');

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '1', 'title', '1 Guest Bookings', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '2', 'title', '1 Guest Bookings', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '3', 'title', '1 Guest Bookings', 'script');

INSERT INTO `fields` VALUES (NULL, 'report_guests_arr_ARRAY_2', 'arrays', 'Reports / 2 Guests Bookings', 'script', '2015-03-20 11:45:47');

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '1', 'title', '2 Guests Bookings', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '2', 'title', '2 Guests Bookings', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '3', 'title', '2 Guests Bookings', 'script');

INSERT INTO `fields` VALUES (NULL, 'report_guests_arr_ARRAY_3', 'arrays', 'Reports / 3 Guests Bookings', 'script', '2015-03-20 11:45:56');

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '1', 'title', '3 Guests Bookings', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '2', 'title', '3 Guests Bookings', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '3', 'title', '3 Guests Bookings', 'script');

INSERT INTO `fields` VALUES (NULL, 'report_guests_arr_ARRAY_4', 'arrays', 'Reports / 4 Guests Bookings', 'script', '2015-03-20 11:46:10');

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '1', 'title', '4 Guests Bookings', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '2', 'title', '4 Guests Bookings', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '3', 'title', '4 Guests Bookings', 'script');

INSERT INTO `fields` VALUES (NULL, 'report_guests_arr_ARRAY_5', 'arrays', 'Reports / 5 Guests Bookings', 'script', '2015-03-20 11:46:24');

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '1', 'title', '5 Guests Bookings', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '2', 'title', '5 Guests Bookings', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '3', 'title', '5 Guests Bookings', 'script');

INSERT INTO `fields` VALUES (NULL, 'report_guests_arr_ARRAY_6', 'arrays', 'Reports / 6 Guests Bookings', 'script', '2015-03-20 11:46:33');

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '1', 'title', '6 Guests Bookings', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '2', 'title', '6 Guests Bookings', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '3', 'title', '6 Guests Bookings', 'script');

INSERT INTO `fields` VALUES (NULL, 'report_guests_arr_ARRAY_7', 'arrays', 'Reports / More Than 6 Nights Bookings', 'script', '2015-03-20 11:46:47');

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '1', 'title', 'More Than 6 Nights Bookings', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '2', 'title', 'More Than 6 Nights Bookings', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '3', 'title', 'More Than 6 Nights Bookings', 'script');

INSERT INTO `fields` VALUES (NULL, 'report_adults_vs_children', 'backend', 'Reports / Adults vs Chidren', 'script', '2015-03-20 11:47:04');

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '1', 'title', 'Adults vs Chidren', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '2', 'title', 'Adults vs Chidren', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '3', 'title', 'Adults vs Chidren', 'script');

INSERT INTO `fields` VALUES (NULL, 'report_count', 'backend', 'Reports / Count', 'script', '2015-03-20 11:47:17');

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '1', 'title', 'Count', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '2', 'title', 'Count', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '3', 'title', 'Count', 'script');

INSERT INTO `fields` VALUES (NULL, 'report_adults_guests', 'backend', 'Reports / Adults Guests', 'script', '2015-03-20 11:47:33');

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '1', 'title', 'Adults Guests', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '2', 'title', 'Adults Guests', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '3', 'title', 'Adults Guests', 'script');

INSERT INTO `fields` VALUES (NULL, 'report_children_guests', 'backend', 'Reports / Children Guests', 'script', '2015-03-20 11:47:48');

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '1', 'title', 'Children Guests', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '2', 'title', 'Children Guests', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '3', 'title', 'Children Guests', 'script');

INSERT INTO `fields` VALUES (NULL, 'btnPrint', 'backend', 'Button / Print', 'script', '2015-03-20 11:51:42');

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '1', 'title', 'Print', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '2', 'title', 'Print', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '3', 'title', 'Print', 'script');

INSERT INTO `fields` VALUES (NULL, 'btnGenerate', 'backend', 'Button / Generate', 'script', '2015-03-20 11:52:04');

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '1', 'title', 'Generate', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '2', 'title', 'Generate', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '3', 'title', 'Generate', 'script');

INSERT INTO `fields` VALUES (NULL, 'report_print', 'backend', 'Reports / Print Report', 'script', '2015-03-20 12:27:38');

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '1', 'title', 'Print Report', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '2', 'title', 'Print Report', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '3', 'title', 'Print Report', 'script');

INSERT INTO `fields` VALUES (NULL, 'booking_adults', 'backend', 'Bookings / Adults', 'script', '2015-03-20 15:13:03');

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '1', 'title', 'Adults', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '2', 'title', 'Adults', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '3', 'title', 'Adults', 'script');

INSERT INTO `fields` VALUES (NULL, 'booking_children', 'backend', 'Bookings / Children', 'script', '2015-03-20 15:13:21');

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '1', 'title', 'Children', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '2', 'title', 'Children', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '3', 'title', 'Children', 'script');

INSERT INTO `fields` VALUES (NULL, 'room_limit_select_room', 'backend', 'Bookings / Select room type', 'script', '2015-03-20 15:20:06');

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '1', 'title', 'Select room type', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '2', 'title', 'Select room type', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '3', 'title', 'Select room type', 'script');

INSERT INTO `fields` VALUES (NULL, 'booking_select_date', 'backend', 'Bookings / Select date', 'script', '2015-03-20 15:20:26');

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '1', 'title', 'Select date', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '2', 'title', 'Select date', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '3', 'title', 'Select date', 'script');

INSERT INTO `fields` VALUES (NULL, 'error_titles_ARRAY_ABK20', 'arrays', 'error_titles_ARRAY_ABK20', 'script', '2015-03-20 15:23:50');

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '1', 'title', 'No rooms found and availability calendar is not available.', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '2', 'title', 'No rooms found and availability calendar is not available.', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '3', 'title', 'No rooms found and availability calendar is not available.', 'script');

INSERT INTO `fields` VALUES (NULL, 'error_bodies_ARRAY_ABK20', 'arrays', 'error_bodies_ARRAY_ABK20', 'script', '2015-03-20 15:24:08');

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '1', 'title', 'You need to have at least one room type added before you can see availability calendar. Click <a href="bookAdmin.php?controller=pjAdminRooms&action=pjActionCreate">here</a> and follow the instructions to add a new room type.', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '2', 'title', 'You need to have at least one room type added before you can see availability calendar. Click <a href="bookAdmin.php?controller=pjAdminRooms&action=pjActionCreate">here</a> and follow the instructions to add a new room type.', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '3', 'title', 'You need to have at least one room type added before you can see availability calendar. Click <a href="bookAdmin.php?controller=pjAdminRooms&action=pjActionCreate">here</a> and follow the instructions to add a new room type.', 'script');

INSERT INTO `fields` VALUES (NULL, 'error_titles_ARRAY_ABK21', 'arrays', 'error_titles_ARRAY_ABK21', 'script', '2015-03-20 15:24:44');

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '1', 'title', 'Rooms Availability Calendar', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '2', 'title', 'Rooms Availability Calendar', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '3', 'title', 'Rooms Availability Calendar', 'script');

INSERT INTO `fields` VALUES (NULL, 'error_bodies_ARRAY_ABK21', 'arrays', 'error_bodies_ARRAY_ABK21', 'script', '2015-03-20 15:25:02');

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '1', 'title', 'Use the calendar below to easily see room availability. Use the date picker to quickly jump to a specific date or scroll back and forth using the navigation controls. Click on a booking to view it and use the "Print" button to print the whole calendar.', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '2', 'title', 'Use the calendar below to easily see room availability. Use the date picker to quickly jump to a specific date or scroll back and forth using the navigation controls. Click on a booking to view it and use the "Print" button to print the whole calendar.', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '3', 'title', 'Use the calendar below to easily see room availability. Use the date picker to quickly jump to a specific date or scroll back and forth using the navigation controls. Click on a booking to view it and use the "Print" button to print the whole calendar.', 'script');

INSERT INTO `fields` VALUES (NULL, 'booking_legend_pending', 'backend', 'Bookings / Legend: Pending Booking', 'script', '2015-03-20 15:35:12');

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '1', 'title', 'Pending Booking', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '2', 'title', 'Pending Booking', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '3', 'title', 'Pending Booking', 'script');

INSERT INTO `fields` VALUES (NULL, 'booking_legend_confirmed', 'backend', 'Bookings / Legend: Confirmed Booking', 'script', '2015-03-20 15:34:35');

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '1', 'title', 'Confirmed Booking', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '2', 'title', 'Confirmed Booking', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '3', 'title', 'Confirmed Booking', 'script');

INSERT INTO `fields` VALUES (NULL, 'menuCalendar', 'backend', 'Menu Calendar', 'script', '2015-03-20 15:38:23');

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '1', 'title', 'Calendar', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '2', 'title', 'Calendar', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '3', 'title', 'Calendar', 'script');

INSERT INTO `fields` VALUES (NULL, 'booking_statuses_ARRAY_not_confirmed', 'arrays', 'Bookings / Booking status ''not_confirmed''', 'script', '2015-03-21 07:27:02');

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '1', 'title', 'Not confirmed', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '2', 'title', 'Not confirmed', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '3', 'title', 'Not confirmed', 'script');

INSERT INTO `fields` VALUES (NULL, 'booking_stay', 'backend', 'Bookings / Stay', 'script', '2015-03-21 07:40:45');

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '1', 'title', 'Stay', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '2', 'title', 'Stay', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '3', 'title', 'Stay', 'script');

INSERT INTO `fields` VALUES (NULL, 'booking_id', 'backend', 'Bookings / ID', 'script', '2015-03-21 07:41:02');

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '1', 'title', 'ID', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '2', 'title', 'ID', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '3', 'title', 'ID', 'script');

INSERT INTO `fields` VALUES (NULL, 'front_search', 'frontend', 'Frontend / Search', 'script', '2015-03-21 09:28:17');

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '1', 'title', 'Search', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '2', 'title', 'Search', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '3', 'title', 'Search', 'script');

COMMIT;