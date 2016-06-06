
START TRANSACTION;

INSERT INTO `fields` VALUES (NULL, 'welcome_heading', 'backend', 'Welcome / Heading', 'script', '2015-03-27 11:27:24');

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '1', 'title', 'Welcome to your StivaWeb Hotel Booking Software.', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '2', 'title', 'Welcome to your StivaWeb Hotel Booking Software.', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '3', 'title', 'Welcome to your StivaWeb Hotel Booking Software.', 'script');

INSERT INTO `fields` VALUES (NULL, 'welcome_text_1', 'backend', 'Welcome / Text 1', 'script', '2015-03-27 11:27:53');

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '1', 'title', 'You need to set up the system in order to function efficiently. It''s easy to do. Please, follow our guide below.', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '2', 'title', 'You need to set up the system in order to function efficiently. It''s easy to do. Please, follow our guide below.', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '3', 'title', 'You need to set up the system in order to function efficiently. It''s easy to do. Please, follow our guide below.', 'script');

INSERT INTO `fields` VALUES (NULL, 'welcome_text_2', 'backend', 'Welcome / Text 2', 'script', '2015-03-27 11:28:56');

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '1', 'title', 'As soon as you complete a step click on its "I''ve done this" link. Complete all steps and then switch to the <a href="#" class="welcome-switch">standard Dashboard</a>.', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '2', 'title', 'As soon as you complete a step click on its "I''ve done this" link. Complete all steps and then switch to the <a href="#" class="welcome-switch">standard Dashboard</a>.', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '3', 'title', 'As soon as you complete a step click on its "I''ve done this" link. Complete all steps and then switch to the <a href="#" class="welcome-switch">standard Dashboard</a>.', 'script');

INSERT INTO `fields` VALUES (NULL, 'welcome_step_1_title', 'backend', 'Welcome / Step 1 (Title)', 'script', '2015-03-27 11:29:37');

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '1', 'title', '1. Set your Room Type', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '2', 'title', '1. Set your Room Type', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '3', 'title', '1. Set your Room Type', 'script');

INSERT INTO `fields` VALUES (NULL, 'welcome_step_1_desc', 'backend', 'Welcome / Step 1 (Description)', 'script', '2015-03-27 11:30:02');

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '1', 'title', 'You need to add at least one room type and have at least one room to offer to your clients.', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '2', 'title', 'You need to add at least one room type and have at least one room to offer to your clients.', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '3', 'title', 'You need to add at least one room type and have at least one room to offer to your clients.', 'script');

INSERT INTO `fields` VALUES (NULL, 'welcome_step_1_btn', 'backend', 'Welcome / Step 1 (Button)', 'script', '2015-03-27 11:30:26');

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '1', 'title', 'Manage Rooms', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '2', 'title', 'Manage Rooms', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '3', 'title', 'Manage Rooms', 'script');

INSERT INTO `fields` VALUES (NULL, 'welcome_step_done', 'backend', 'Welcome / I''ve done this', 'script', '2015-03-27 11:30:47');

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '1', 'title', 'I''ve done this', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '2', 'title', 'I''ve done this', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '3', 'title', 'I''ve done this', 'script');

INSERT INTO `fields` VALUES (NULL, 'welcome_step_2_title', 'backend', 'Welcome / Step 1 (Title)', 'script', '2015-03-27 11:31:22');

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '1', 'title', '2. Set Room Prices', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '2', 'title', '2. Set Room Prices', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '3', 'title', '2. Set Room Prices', 'script');

INSERT INTO `fields` VALUES (NULL, 'welcome_step_2_desc', 'backend', 'Welcome / Step 2 (Description)', 'script', '2015-03-27 11:31:40');

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '1', 'title', 'To be available for booking your rooms need to have prices set.', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '2', 'title', 'To be available for booking your rooms need to have prices set.', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '3', 'title', 'To be available for booking your rooms need to have prices set.', 'script');

INSERT INTO `fields` VALUES (NULL, 'welcome_step_2_btn', 'backend', 'Welcome / Step 2 (Button)', 'script', '2015-03-27 11:32:03');

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '1', 'title', 'Set Prices', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '2', 'title', 'Set Prices', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '3', 'title', 'Set Prices', 'script');

INSERT INTO `fields` VALUES (NULL, 'welcome_step_3_title', 'backend', 'Welcome / Step 3 (Title)', 'script', '2015-03-27 11:32:21');

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '1', 'title', '3. Define your payment methods', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '2', 'title', '3. Define your payment methods', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '3', 'title', '3. Define your payment methods', 'script');

INSERT INTO `fields` VALUES (NULL, 'welcome_step_3_desc', 'backend', 'Welcome / Step 3 (Description)', 'script', '2015-03-27 11:32:39');

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '1', 'title', 'To complete a reservation your customers will have to choose a payment method. You have few payment options you can use by default and you need to set up at least one live.', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '2', 'title', 'To complete a reservation your customers will have to choose a payment method. You have few payment options you can use by default and you need to set up at least one live.', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '3', 'title', 'To complete a reservation your customers will have to choose a payment method. You have few payment options you can use by default and you need to set up at least one live.', 'script');

INSERT INTO `fields` VALUES (NULL, 'welcome_step_3_btn', 'backend', 'Welcome / Step 3 (Button)', 'script', '2015-03-27 11:33:03');

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '1', 'title', 'Configure Payments', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '2', 'title', 'Configure Payments', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '3', 'title', 'Configure Payments', 'script');

INSERT INTO `fields` VALUES (NULL, 'welcome_step_4_title', 'backend', 'Welcome / Step 4 (Title)', 'script', '2015-03-27 11:33:18');

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '1', 'title', '4. Define the deposit amount', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '2', 'title', '4. Define the deposit amount', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '3', 'title', '4. Define the deposit amount', 'script');

INSERT INTO `fields` VALUES (NULL, 'welcome_step_4_desc', 'backend', 'Welcome / Step 4 (Description)', 'script', '2015-03-27 11:33:41');

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '1', 'title', 'This is the sum of the reservation that users will have to pay while they make reservation. If PayPal or Authorize.net payment methods are available and customers choose them, they will have to pay the deposit amount online to confirm their booking. If offline payment methods are available and customers choose them then their bookings will have status Pending or Not confirmed.', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '2', 'title', 'This is the sum of the reservation that users will have to pay while they make reservation. If PayPal or Authorize.net payment methods are available and customers choose them, they will have to pay the deposit amount online to confirm their booking. If offline payment methods are available and customers choose them then their bookings will have status Pending or Not confirmed.', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '3', 'title', 'This is the sum of the reservation that users will have to pay while they make reservation. If PayPal or Authorize.net payment methods are available and customers choose them, they will have to pay the deposit amount online to confirm their booking. If offline payment methods are available and customers choose them then their bookings will have status Pending or Not confirmed.', 'script');

INSERT INTO `fields` VALUES (NULL, 'welcome_step_4_btn', 'backend', 'Welcome / Step 4 (Button)', 'script', '2015-03-27 11:33:57');

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '1', 'title', 'Confirmation Messages', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '2', 'title', 'Confirmation Messages', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '3', 'title', 'Confirmation Messages', 'script');

INSERT INTO `fields` VALUES (NULL, 'welcome_step_5_title', 'backend', 'Welcome / Step 5 (Title)', 'script', '2015-03-27 11:34:16');

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '1', 'title', '5. Set Room Pending Time', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '2', 'title', '5. Set Room Pending Time', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '3', 'title', '5. Set Room Pending Time', 'script');

INSERT INTO `fields` VALUES (NULL, 'welcome_step_5_desc', 'backend', 'Welcome / Step 5 (Description)', 'script', '2015-03-27 11:34:38');

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '1', 'title', 'When booking is made, but not paid yet, the rooms assigned to it will be kept unavailable for other booking for a period of time. This bookings have Pending status. After that time expire bookings will change their status to Not Confirmed and the rooms will be available for booking by other customers. You can manage the time the system keep rooms unavailable and booking with status Pending.', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '2', 'title', 'When booking is made, but not paid yet, the rooms assigned to it will be kept unavailable for other booking for a period of time. This bookings have Pending status. After that time expire bookings will change their status to Not Confirmed and the rooms will be available for booking by other customers. You can manage the time the system keep rooms unavailable and booking with status Pending.', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '3', 'title', 'When booking is made, but not paid yet, the rooms assigned to it will be kept unavailable for other booking for a period of time. This bookings have Pending status. After that time expire bookings will change their status to Not Confirmed and the rooms will be available for booking by other customers. You can manage the time the system keep rooms unavailable and booking with status Pending.', 'script');

INSERT INTO `fields` VALUES (NULL, 'welcome_step_5_btn', 'backend', 'Welcome / Step 5 (Button)', 'script', '2015-03-27 11:34:57');

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '1', 'title', 'Pending Time', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '2', 'title', 'Pending Time', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '3', 'title', 'Pending Time', 'script');

INSERT INTO `fields` VALUES (NULL, 'welcome_step_6_title', 'backend', 'Welcome / Step 6 (Title)', 'script', '2015-03-27 11:35:21');

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '1', 'title', '6. Define your booking terms', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '2', 'title', '6. Define your booking terms', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '3', 'title', '6. Define your booking terms', 'script');

INSERT INTO `fields` VALUES (NULL, 'welcome_step_6_desc', 'backend', 'Welcome / Step 6 (Description)', 'script', '2015-03-27 11:35:44');

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '1', 'title', 'Users will be able to review booking terms while placing their reservation. You need to define your own booking terms, because their us dummy text placed there at the moment.', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '2', 'title', 'Users will be able to review booking terms while placing their reservation. You need to define your own booking terms, because their us dummy text placed there at the moment.', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '3', 'title', 'Users will be able to review booking terms while placing their reservation. You need to define your own booking terms, because their us dummy text placed there at the moment.', 'script');

INSERT INTO `fields` VALUES (NULL, 'welcome_step_6_btn', 'backend', 'Welcome / Step 6 (Button)', 'script', '2015-03-27 11:36:03');

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '1', 'title', 'Booking Terms', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '2', 'title', 'Booking Terms', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '3', 'title', 'Booking Terms', 'script');

INSERT INTO `fields` VALUES (NULL, 'welcome_contact', 'backend', 'Welcome / Contact', 'script', '2015-03-27 11:36:58');

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '1', 'title', 'If you need help setting up your Hotel Booking Software do not hesitate to <a href="index.php?controller=pjAdmin&action=pjActionSupport">contact us</a>.', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '2', 'title', 'If you need help setting up your Hotel Booking Software do not hesitate to <a href="index.php?controller=pjAdmin&action=pjActionSupport">contact us</a>.', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '3', 'title', 'If you need help setting up your Hotel Booking Software do not hesitate to <a href="index.php?controller=pjAdmin&action=pjActionSupport">contact us</a>.', 'script');

INSERT INTO `fields` VALUES (NULL, 'welcome_done_body', 'backend', 'Welcome / Done confirm (Body)', 'script', '2015-03-27 11:39:36');

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '1', 'title', 'Do you confirm you''ve done this?', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '2', 'title', 'Do you confirm you''ve done this?', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '3', 'title', 'Do you confirm you''ve done this?', 'script');

INSERT INTO `fields` VALUES (NULL, 'welcome_done_title', 'backend', 'Welcome / Done confirm (Title)', 'script', '2015-03-27 11:39:56');

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '1', 'title', 'Done confirmation', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '2', 'title', 'Done confirmation', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '3', 'title', 'Done confirmation', 'script');

INSERT INTO `fields` VALUES (NULL, 'welcome_switch_title', 'backend', 'Welcome / Switch confirm (Title)', 'script', '2015-03-27 11:40:44');

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '1', 'title', 'Switch confirmation', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '2', 'title', 'Switch confirmation', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '3', 'title', 'Switch confirmation', 'script');

INSERT INTO `fields` VALUES (NULL, 'welcome_switch_body', 'backend', 'Welcome / Switch confirm (Body)', 'script', '2015-03-27 11:41:03');

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '1', 'title', 'You are currently seeing the welcome dashboard. Once all steps are completed the standard dashboard will be displayed.', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '2', 'title', 'You are currently seeing the welcome dashboard. Once all steps are completed the standard dashboard will be displayed.', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '3', 'title', 'You are currently seeing the welcome dashboard. Once all steps are completed the standard dashboard will be displayed.', 'script');

INSERT INTO `fields` VALUES (NULL, 'preview_use_theme', 'backend', 'Preview / Use this theme', 'script', '2015-03-27 15:44:43');

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '1', 'title', 'Use this theme', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '2', 'title', 'Use this theme', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '3', 'title', 'Use this theme', 'script');

INSERT INTO `fields` VALUES (NULL, 'preview_theme_current', 'backend', 'Preview / Currently in use', 'script', '2015-03-27 15:53:20');

SET @id := (SELECT LAST_INSERT_ID());

INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '1', 'title', 'Currently in use', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '2', 'title', 'Currently in use', 'script');
INSERT INTO `multi_lang` VALUES (NULL, @id, 'pjField', '3', 'title', 'Currently in use', 'script');

COMMIT;