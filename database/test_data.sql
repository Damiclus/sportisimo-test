SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';
USE `sportisimo`;

INSERT INTO `sp_users` (`user_id`, `user_name`, `user_email`, `user_password`) VALUES
    (1,	'admin',	'admin@sportisimo.cz',	'$2y$10$KvXhbnzhVVBZUJO03QYDO.XRuChf2V1OHj3zUZ.fsgz9T86DQC6GS'),
    (2,	'test',	'test@sportisimo.cz',	'$2y$10$gdvxZJpinSfJEFgZS6xI1.dhJmVehPr23D2Xy3bgzfNqvH9RxjRTS');

INSERT INTO `sp_brands` (`brand_id`, `brand_code`, `brand_name`, `brand_created`, `brand_created_by`, `brand_edited`, `brand_edited_by`) VALUES
    (1,	'lorem',	'lorem',	'2023-01-26 09:17:00',	1,	NULL,	NULL),
    (2,	'test1',	'test1',	'2023-01-26 13:15:40',	1,	'2023-01-26 13:37:13',	1),
    (3,	'test2',	'test2',	'2023-01-26 14:07:45',	1,	'2023-01-26 14:07:54',	1),
    (4,	'test3',	'test3',	'2023-01-26 14:07:59',	1,	NULL,	NULL),
    (5,	'test4',	'test4',	'2023-01-26 14:08:10',	1,	NULL,	NULL),
    (6,	'lorem2',	'lorem2',	'2023-01-26 09:17:00',	1,	NULL,	NULL),
    (7,	'test6',	'test6',	'2023-01-26 13:15:40',	1,	'2023-01-26 13:37:41',	2),
    (8,	'test7',	'test7',	'2023-01-26 14:07:45',	1,	'2023-01-26 14:07:54',	2),
    (9,	'test8',	'test8',	'2023-01-26 14:07:59',	1,	NULL,	NULL),
    (10,	'test9',	'test9',	'2023-01-26 14:08:10',	1,	NULL,	NULL),
    (11,	'lorem3',	'lorem',	'2023-01-26 09:17:00',	1,	NULL,	NULL),
    (12,	'test10',	'test10',	'2023-01-26 13:15:40',	1,	'2023-01-26 13:37:13',	1),
    (13,	'test11',	'test11',	'2023-01-26 14:07:45',	1,	'2023-01-26 14:07:54',	1),
    (14,	'test12',	'test12',	'2023-01-26 14:07:59',	1,	NULL,	NULL),
    (15,	'test13',	'test13',	'2023-01-26 14:08:10',	1,	NULL,	NULL),
    (16,	'lorem4',	'lorem4',	'2023-01-26 09:17:00',	1,	NULL,	NULL),
    (17,	'test14',	'test14',	'2023-01-26 13:15:40',	1,	'2023-01-26 13:37:43',	2),
    (18,	'test15',	'test15',	'2023-01-26 14:07:45',	1,	'2023-01-26 14:07:54',	2),
    (19,	'test16',	'test16',	'2023-01-26 14:07:59',	1,	NULL,	NULL),
    (20,	'test17',	'test17',	'2023-01-26 14:08:10',	1,	NULL,	NULL),
    (21,	'atest',	'atest',	'2023-01-26 14:26:51',	1,	NULL,	NULL);
