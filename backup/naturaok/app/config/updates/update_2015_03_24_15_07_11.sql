
START TRANSACTION;

INSERT INTO `fields` VALUES (NULL, 'dash_today_arrivals', 'backend', 'Dashboard / Today Arrivals', 'script', '2015-03-24 13:49:35');

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '1', 'title', 'Today Arrivals', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '2', 'title', 'Today Arrivals', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '3', 'title', 'Today Arrivals', 'script');

INSERT INTO `fields` VALUES (NULL, 'dash_rooms', 'backend', 'Dashboard / Rooms', 'script', '2015-03-24 13:49:54');

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '1', 'title', 'Rooms', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '2', 'title', 'Rooms', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '3', 'title', 'Rooms', 'script');

INSERT INTO `fields` VALUES (NULL, 'dash_stay', 'backend', 'Dashboard / Stay', 'script', '2015-03-24 13:50:19');

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '1', 'title', 'Stay', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '2', 'title', 'Stay', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '3', 'title', 'Stay', 'script');

INSERT INTO `fields` VALUES (NULL, 'dash_no_bookings', 'backend', 'Dashboard / No bookings found', 'script', '2015-03-24 13:51:00');

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '1', 'title', 'No bookings found.', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '2', 'title', 'No bookings found.', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '3', 'title', 'No bookings found.', 'script');

INSERT INTO `fields` VALUES (NULL, 'dash_to', 'backend', 'Dashboard / to', 'script', '2015-03-24 13:51:23');

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '1', 'title', 'to', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '2', 'title', 'to', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '3', 'title', 'to', 'script');

INSERT INTO `fields` VALUES (NULL, 'dash_today_departures', 'backend', 'Dashboard / Today Departures', 'script', '2015-03-24 13:51:50');

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '1', 'title', 'Today Departures', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '2', 'title', 'Today Departures', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '3', 'title', 'Today Departures', 'script');

INSERT INTO `fields` VALUES (NULL, 'dash_view_all_bookings', 'backend', 'Dashboard / View All Bookings', 'script', '2015-03-24 13:53:04');

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '1', 'title', 'View All Bookings', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '2', 'title', 'View All Bookings', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '3', 'title', 'View All Bookings', 'script');

INSERT INTO `fields` VALUES (NULL, 'dash_from', 'backend', 'Dashboard / from', 'script', '2015-03-24 13:53:54');

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '1', 'title', 'from', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '2', 'title', 'from', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '3', 'title', 'from', 'script');

INSERT INTO `fields` VALUES (NULL, 'dash_room_booked_today', 'backend', 'Dashboard / Rooms Booked Today', 'script', '2015-03-24 13:55:23');

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '1', 'title', 'Rooms Booked Today', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '2', 'title', 'Rooms Booked Today', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '3', 'title', 'Rooms Booked Today', 'script');

INSERT INTO `fields` VALUES (NULL, 'dash_pending_rooms_today', 'backend', 'Dashboard / Pending Rooms Today', 'script', '2015-03-24 13:55:59');

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '1', 'title', 'Pending Rooms Today', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '2', 'title', 'Pending Rooms Today', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '3', 'title', 'Pending Rooms Today', 'script');

INSERT INTO `fields` VALUES (NULL, 'dash_available_rooms_today', 'backend', 'Dashboard / Available Rooms Today', 'script', '2015-03-24 13:56:23');

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '1', 'title', 'Available Rooms Today', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '2', 'title', 'Available Rooms Today', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '3', 'title', 'Available Rooms Today', 'script');

INSERT INTO `fields` VALUES (NULL, 'dash_available_rooms_type', 'backend', 'Dashboard / AVAILABLE ROOMS BY TYPE', 'script', '2015-03-24 13:56:44');

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '1', 'title', 'AVAILABLE ROOMS BY TYPE', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '2', 'title', 'AVAILABLE ROOMS BY TYPE', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '3', 'title', 'AVAILABLE ROOMS BY TYPE', 'script');

INSERT INTO `fields` VALUES (NULL, 'dash_guests', 'backend', 'Dashboard / GUESTS', 'script', '2015-03-24 13:57:06');

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '1', 'title', 'GUESTS', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '2', 'title', 'GUESTS', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '3', 'title', 'GUESTS', 'script');

INSERT INTO `fields` VALUES (NULL, 'dash_staying_tonight', 'backend', 'Dashboard / Staying tonight', 'script', '2015-03-24 13:57:41');

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '1', 'title', 'Staying tonight', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '2', 'title', 'Staying tonight', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '3', 'title', 'Staying tonight', 'script');

INSERT INTO `fields` VALUES (NULL, 'dash_adults', 'backend', 'Dashboard / Adults', 'script', '2015-03-24 13:58:08');

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '1', 'title', 'Adults', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '2', 'title', 'Adults', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '3', 'title', 'Adults', 'script');

INSERT INTO `fields` VALUES (NULL, 'dash_children', 'backend', 'Dashboard / Children', 'script', '2015-03-24 13:58:33');

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '1', 'title', 'Children', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '2', 'title', 'Children', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '3', 'title', 'Children', 'script');

INSERT INTO `fields` VALUES (NULL, 'dash_arriving_today', 'backend', 'Dashboard / Arriving today', 'script', '2015-03-24 13:59:00');

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '1', 'title', 'Arriving today', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '2', 'title', 'Arriving today', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '3', 'title', 'Arriving today', 'script');

INSERT INTO `fields` VALUES (NULL, 'dash_leaving_today', 'backend', 'Dashboard / Leaving today', 'script', '2015-03-24 13:59:21');

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '1', 'title', 'Leaving today', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '2', 'title', 'Leaving today', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '3', 'title', 'Leaving today', 'script');

INSERT INTO `fields` VALUES (NULL, 'dash_view_calendar', 'backend', 'Dashboard / View Calendar', 'script', '2015-03-24 13:59:59');

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '1', 'title', 'View Calendar', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '2', 'title', 'View Calendar', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '3', 'title', 'View Calendar', 'script');

INSERT INTO `fields` VALUES (NULL, 'dash_nights', 'backend', 'Dashboard / nights', 'script', '2015-03-24 14:00:57');

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '1', 'title', 'nights', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '2', 'title', 'nights', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '3', 'title', 'nights', 'script');

INSERT INTO `fields` VALUES (NULL, 'dash_night', 'backend', 'Dashboard / night', 'script', '2015-03-24 14:01:07');

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '1', 'title', 'night', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '2', 'title', 'night', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '3', 'title', 'night', 'script');

INSERT INTO `fields` VALUES (NULL, 'dash_lastest_bookings', 'backend', 'Dashboard / Latest Bookings', 'script', '2015-03-24 14:02:07');

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '1', 'title', 'Latest Bookings', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '2', 'title', 'Latest Bookings', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '3', 'title', 'Latest Bookings', 'script');

INSERT INTO `fields` VALUES (NULL, 'dash_id', 'backend', 'Dashboard / ID', 'script', '2015-03-24 14:02:35');

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '1', 'title', 'ID', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '2', 'title', 'ID', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '3', 'title', 'ID', 'script');

COMMIT;