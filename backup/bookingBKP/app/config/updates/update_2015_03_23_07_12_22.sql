
START TRANSACTION;

INSERT INTO `fields` VALUES (NULL, 'booking_extra_note', 'backend', 'Bookings / Extras note', 'script', '2015-03-18 09:44:27');

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '1', 'title', 'No extras found.<br>Click <a href="index.php?controller=pjAdminExtras&amp;action=pjActionCreate">here</a> and follow the instructions to add an extra.', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '2', 'title', 'No extras found.<br>Click <a href="index.php?controller=pjAdminExtras&amp;action=pjActionCreate">here</a> and follow the instructions to add an extra.', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '3', 'title', 'No extras found.<br>Click <a href="index.php?controller=pjAdminExtras&amp;action=pjActionCreate">here</a> and follow the instructions to add an extra.', 'script');

INSERT INTO `fields` VALUES (NULL, 'room_numbers', 'backend', 'Rooms / Room numbers', 'script', '2015-03-18 11:35:39');

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '1', 'title', 'Room numbers', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '2', 'title', 'Room numbers', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '3', 'title', 'Room numbers', 'script');

INSERT INTO `fields` VALUES (NULL, 'room_numbers_note', 'backend', 'Rooms / Room numbers (Note)', 'script', '2015-03-18 11:36:13');

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '1', 'title', 'Enter actual numbers/IDs for all the rooms that you have.', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '2', 'title', 'Enter actual numbers/IDs for all the rooms that you have.', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '3', 'title', 'Enter actual numbers/IDs for all the rooms that you have.', 'script');

INSERT INTO `fields` VALUES (NULL, 'room_numbers_enter', 'backend', 'Rooms / Room numbers enter', 'script', '2015-03-18 11:38:44');

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '1', 'title', 'Enter amount of rooms to set actual room numbers.', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '2', 'title', 'Enter amount of rooms to set actual room numbers.', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '3', 'title', 'Enter amount of rooms to set actual room numbers.', 'script');

INSERT INTO `fields` VALUES (NULL, 'rooms_number', 'backend', 'Rooms / Number', 'script', '2015-03-18 12:42:12');

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '1', 'title', 'Room number', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '2', 'title', 'Room number', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '3', 'title', 'Room number', 'script');

INSERT INTO `fields` VALUES (NULL, 'opt_o_pending_time', 'backend', 'Options / Pending time', 'script', '2015-03-18 15:18:51');

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '1', 'title', 'Room pending reservation time (minutes).<br><span class="fs11 italic">Set the time while the system will keep as reserved the room assigned to a Pending booking. After the time expires, if booking is not paid meanwhile, the booking status will become "Not Confirmed" and rooms will be available to be booked again by other visitors.</span>', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '2', 'title', 'Room pending reservation time (minutes).<br><span class="fs11 italic">Set the time while the system will keep as reserved the room assigned to a Pending booking. After the time expires, if booking is not paid meanwhile, the booking status will become "Not Confirmed" and rooms will be available to be booked again by other visitors.</span>', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '3', 'title', 'Room pending reservation time (minutes).<br><span class="fs11 italic">Set the time while the system will keep as reserved the room assigned to a Pending booking. After the time expires, if booking is not paid meanwhile, the booking status will become "Not Confirmed" and rooms will be available to be booked again by other visitors.</span>', 'script');

INSERT INTO `fields` VALUES (NULL, 'menuReports', 'backend', 'Menu Reports', 'script', '2015-03-19 15:32:25');

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '1', 'title', 'Reports', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '2', 'title', 'Reports', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '3', 'title', 'Reports', 'script');

INSERT INTO `fields` VALUES (NULL, 'report_amount', 'backend', 'Reports / Amount', 'script', '2015-03-20 11:35:05');

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '1', 'title', 'Amount', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '2', 'title', 'Amount', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '3', 'title', 'Amount', 'script');

INSERT INTO `fields` VALUES (NULL, 'report_cancelled', 'backend', 'Reports / Cancelled bookings', 'script', '2015-03-20 11:35:23');

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '1', 'title', 'Cancelled bookings', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '2', 'title', 'Cancelled bookings', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '3', 'title', 'Cancelled bookings', 'script');

INSERT INTO `fields` VALUES (NULL, 'report_one_room', 'backend', 'Reports / One room bookings', 'script', '2015-03-20 11:35:39');

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '1', 'title', 'One room bookings', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '2', 'title', 'One room bookings', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '3', 'title', 'One room bookings', 'script');

INSERT INTO `fields` VALUES (NULL, 'report_two_room', 'backend', 'Reports / Two room bookings', 'script', '2015-03-20 11:35:55');

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '1', 'title', 'Two room bookings', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '2', 'title', 'Two room bookings', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '3', 'title', 'Two room bookings', 'script');

INSERT INTO `fields` VALUES (NULL, 'report_more_room', 'backend', 'Reports / Two+ room bookings', 'script', '2015-03-20 11:36:12');

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '1', 'title', 'Two+ room bookings', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '2', 'title', 'Two+ room bookings', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '3', 'title', 'Two+ room bookings', 'script');

INSERT INTO `fields` VALUES (NULL, 'report_rooms', 'backend', 'Reports / Rooms', 'script', '2015-03-20 11:36:31');

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '1', 'title', 'Rooms', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '2', 'title', 'Rooms', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '3', 'title', 'Rooms', 'script');

INSERT INTO `fields` VALUES (NULL, 'report_bookings', 'backend', 'Reports / Bookings', 'script', '2015-03-20 11:36:46');

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '1', 'title', 'Bookings', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '2', 'title', 'Bookings', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '3', 'title', 'Bookings', 'script');

INSERT INTO `fields` VALUES (NULL, 'report_booking', 'backend', 'Reports / Booking', 'script', '2015-03-20 11:37:02');

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '1', 'title', 'Booking', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '2', 'title', 'Booking', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '3', 'title', 'Booking', 'script');

INSERT INTO `fields` VALUES (NULL, 'report_booked', 'backend', 'Reports / Booked', 'script', '2015-03-20 11:37:17');

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '1', 'title', 'Booked', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '2', 'title', 'Booked', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '3', 'title', 'Booked', 'script');

INSERT INTO `fields` VALUES (NULL, 'report_bookings_received', 'backend', 'Reports / Bookings Received', 'script', '2015-03-20 11:37:32');

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '1', 'title', 'Bookings Received', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '2', 'title', 'Bookings Received', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '3', 'title', 'Bookings Received', 'script');

COMMIT;