

CREATE TABLE `branch` (
  `branch_id` int(11) NOT NULL AUTO_INCREMENT,
  `branch_name` varchar(50) NOT NULL,
  `branch_address` varchar(100) NOT NULL,
  `branch_contact` varchar(50) NOT NULL,
  `reciept_footer_text` text NOT NULL,
  `skin` varchar(15) NOT NULL,
  PRIMARY KEY (`branch_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;


INSERT INTO branch VALUES
("1","Havana Lounge Pub Grill","Mugoti Rd, Roma, Lusaka, Zambia.","Come For a Discount on the 30th of July","Come for a Discount on the 30th of July.","red");




CREATE TABLE `category` (
  `cat_id` int(11) NOT NULL AUTO_INCREMENT,
  `cat_name` varchar(30) NOT NULL,
  PRIMARY KEY (`cat_id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;


INSERT INTO category VALUES
("12","Beer"),
("13","Beef"),
("15","Soft Drinks"),
("16","Cap Cake"),
("18","Salads"),
("19","Kitchen");




CREATE TABLE `customer` (
  `cust_id` int(11) NOT NULL AUTO_INCREMENT,
  `cust_first` varchar(50) NOT NULL,
  `cust_last` varchar(30) NOT NULL,
  `cust_address` varchar(100) NOT NULL,
  `cust_contact` varchar(30) NOT NULL,
  `balance` decimal(10,2) NOT NULL,
  `cust_pic` varchar(300) NOT NULL,
  `bday` date NOT NULL,
  `nickname` varchar(30) NOT NULL,
  `house_status` varchar(30) NOT NULL,
  `years` varchar(20) NOT NULL,
  `rent` varchar(10) NOT NULL,
  `emp_name` varchar(100) NOT NULL,
  `emp_no` varchar(30) NOT NULL,
  `emp_address` varchar(100) NOT NULL,
  `emp_year` varchar(10) NOT NULL,
  `occupation` varchar(30) NOT NULL,
  `salary` varchar(30) NOT NULL,
  `spouse` varchar(30) NOT NULL,
  `spouse_no` varchar(30) NOT NULL,
  `spouse_emp` varchar(50) NOT NULL,
  `spouse_details` varchar(100) NOT NULL,
  `spouse_income` decimal(10,2) NOT NULL,
  `comaker` varchar(30) NOT NULL,
  `comaker_details` varchar(100) NOT NULL,
  `branch_id` int(11) NOT NULL,
  `credit_status` varchar(10) NOT NULL,
  `ci_remarks` varchar(1000) NOT NULL,
  `ci_name` varchar(50) NOT NULL,
  `ci_date` date NOT NULL,
  `payslip` int(11) NOT NULL,
  `valid_id` int(11) NOT NULL,
  `cert` int(11) NOT NULL,
  `cedula` int(11) NOT NULL,
  `income` int(11) NOT NULL,
  `email` text NOT NULL,
  PRIMARY KEY (`cust_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;


INSERT INTO customer VALUES
("1","Kennedy","Aboy","Silay City\n","0975704991","0.00","default.gif","0000-00-00","","","","","","","","","","","","","","","0.00","","","1","","","","0000-00-00","0","0","0","0","0","aby@yahoo.com"),
("2","Honeylee","Magbanua","Brgy. Busay, bago CIty","09051914070","303.20","default.gif","1989-10-14","lee","owned","27","NA","Stratium Software","034-707-1630","Ayala Northpoint","1","Systems Administrator","12000","NA","NA","NA","NA","0.00","Kaye Angela Cueva","Cadiz City","1","Approved","","","0000-00-00","0","0","0","0","0",""),
("3","Mulimba","Sipo","Ndeke House Haile Salassie Avenue Longacres Lusaka","0955104708","0.00","default.gif","0000-00-00","","","","","","","","","","","","","","","0.00","","","1","","","","0000-00-00","0","0","0","0","0","ngandu.choolwe@yahoo.com"),
("4","Lusungo","Moyo","Lusaka, Zambia","090998278","0.00","default.gif","0000-00-00","","","","","","","","","","","","","","","0.00","","","1","","","","0000-00-00","0","0","0","0","0","Choolwe1992@gmail.com");




CREATE TABLE `discount_tb` (
  `id` int(12) NOT NULL AUTO_INCREMENT,
  `prod_id` int(12) NOT NULL,
  `discount_price` int(12) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `discount_from` text NOT NULL,
  `discount_to` text NOT NULL,
  `status` text NOT NULL,
  `price_before_disc` int(12) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;


INSERT INTO discount_tb VALUES
("1","8","50","2018-07-23 21:37:46","2018-07-22 00:00:00","2018-07-22 00:00:00","notactive","50");




CREATE TABLE `history_log` (
  `log_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `action` varchar(100) NOT NULL,
  `date` datetime NOT NULL,
  PRIMARY KEY (`log_id`)
) ENGINE=InnoDB AUTO_INCREMENT=294 DEFAULT CHARSET=latin1;


INSERT INTO history_log VALUES
("21","1","has logged out the system at ","2017-12-03 03:15:35"),
("22","1","has logged in the system at ","2017-12-03 03:15:39"),
("23","1","has logged out the system at ","2017-12-03 03:20:07"),
("24","1","has logged in the system at ","2017-12-03 03:21:35"),
("25","1","has logged out the system at ","2017-12-03 03:22:38"),
("26","1","has logged in the system at ","2017-12-03 03:22:42"),
("27","1","has logged in the system at ","2017-12-03 03:22:58"),
("28","1","has logged in the system at ","2017-12-03 03:30:08"),
("29","1","has logged in the system at ","2017-12-03 03:30:21"),
("30","1","has logged out the system at ","2017-12-03 03:46:18"),
("31","1","has logged in the system at ","2017-12-03 03:46:22"),
("32","1","has logged in the system at ","2017-12-03 05:21:24"),
("33","1","has logged out the system at ","2017-12-03 10:19:19"),
("34","1","has logged in the system at ","2017-12-03 17:49:50"),
("35","1","has logged out the system at ","2017-12-03 22:25:33"),
("36","1","has logged in the system at ","2017-12-03 22:25:46"),
("37","1","has logged out the system at ","2017-12-03 22:38:52"),
("38","1","has logged in the system at ","2017-12-03 22:38:56"),
("39","1","has logged out the system at ","2017-12-03 22:39:00"),
("40","4","has logged in the system at ","2017-12-03 22:40:10"),
("41","4","has logged in the system at ","2017-12-04 14:24:42"),
("42","4","has logged out the system at ","2017-12-04 15:00:05"),
("43","4","has logged in the system at ","2017-12-04 21:00:09"),
("44","4","has logged out the system at ","2017-12-04 15:21:07"),
("45","1","has logged in the system at ","2017-12-04 22:16:51"),
("46","1","has logged out the system at ","2017-12-04 20:24:08"),
("47","4","has logged in the system at ","2017-12-05 02:24:15"),
("48","4","has logged out the system at ","2017-12-04 22:13:42"),
("49","4","has logged in the system at ","2017-12-05 04:34:00"),
("50","4","has logged out the system at ","2017-12-04 22:34:04"),
("51","4","has logged in the system at ","2017-12-05 11:16:29"),
("52","4","has logged out the system at ","2017-12-05 11:26:44"),
("53","1","has logged in the system at ","2017-12-05 11:26:50"),
("54","1","has logged out the system at ","2017-12-05 11:27:45"),
("55","4","has logged in the system at ","2017-12-05 11:32:26"),
("56","4","has logged in the system at ","2017-12-05 12:19:31"),
("57","4","has logged out the system at ","2017-12-05 12:42:57"),
("58","1","has logged in the system at ","2017-12-05 12:43:10"),
("59","4","has logged out the system at ","2017-12-05 14:26:05"),
("60","1","has logged in the system at ","2017-12-05 20:55:25"),
("61","1","has logged out the system at ","2017-12-05 21:12:37"),
("62","4","has logged in the system at ","2017-12-05 21:12:42"),
("63","4","has logged out the system at ","2017-12-05 21:14:17"),
("64","4","has logged in the system at ","2017-12-05 21:17:55"),
("65","4","has logged out the system at ","2017-12-05 21:38:43"),
("66","4","has logged in the system at ","2017-12-06 09:23:24"),
("67","4","has logged out the system at ","2017-12-06 18:27:58"),
("68","1","has logged in the system at ","2017-12-06 18:30:33"),
("69","1","has logged out the system at ","2017-12-06 18:38:45"),
("70","4","has logged in the system at ","2017-12-06 18:38:53"),
("71","1","has logged in the system at ","2018-06-08 20:38:06"),
("72","1","has logged out the system at ","2018-06-09 10:44:47"),
("73","1","has logged in the system at ","2018-06-09 10:44:52"),
("74","1","has logged out the system at ","2018-06-09 11:09:00"),
("75","4","has logged in the system at ","2018-06-09 11:09:20"),
("76","4","has logged out the system at ","2018-06-09 11:10:14"),
("77","1","has logged in the system at ","2018-06-09 11:10:30"),
("78","1","has logged out the system at ","2018-06-09 12:15:34"),
("79","4","has logged in the system at ","2018-06-09 12:15:45"),
("80","4","has logged out the system at ","2018-06-09 12:22:24"),
("81","4","has logged in the system at ","2018-06-09 12:37:44"),
("82","4","has logged out the system at ","2018-06-09 12:37:47"),
("83","1","has logged in the system at ","2018-06-09 12:37:58"),
("84","1","has logged out the system at ","2018-06-09 12:38:00"),
("85","5","has logged in the system at ","2018-06-09 12:38:09"),
("86","5","has logged out the system at ","2018-06-09 12:38:16"),
("87","5","has logged in the system at ","2018-06-09 12:40:17"),
("88","5","has logged out the system at ","2018-06-09 12:40:19"),
("89","4","has logged in the system at ","2018-06-09 12:40:25"),
("90","4","has logged in the system at ","2018-06-11 19:12:49"),
("91","4","has logged out the system at ","2018-06-11 19:21:21"),
("92","1","has logged in the system at ","2018-06-11 19:21:31"),
("93","1","has logged out the system at ","2018-06-11 19:28:45"),
("94","4","has logged in the system at ","2018-06-11 19:28:54"),
("95","4","has logged out the system at ","2018-06-14 20:37:35"),
("96","4","has logged in the system at ","2018-06-14 20:37:39"),
("97","4","has logged out the system at ","2018-06-14 20:38:43"),
("98","4","has logged in the system at ","2018-06-14 20:38:46"),
("99","4","has logged out the system at ","2018-06-15 21:01:13"),
("100","4","has logged in the system at ","2018-06-15 21:01:21"),
("101","4","has logged out the system at ","2018-06-15 21:09:57"),
("102","1","has logged in the system at ","2018-06-15 21:10:03"),
("103","1","has logged out the system at ","2018-06-15 21:54:28"),
("104","4","has logged in the system at ","2018-06-15 21:54:37"),
("105","4","has logged out the system at ","2018-06-15 22:46:10"),
("106","1","has logged in the system at ","2018-06-15 22:46:17"),
("107","1","has logged out the system at ","2018-06-16 13:28:17"),
("108","4","has logged in the system at ","2018-06-16 13:28:30"),
("109","4","has logged out the system at ","2018-06-16 21:10:47"),
("110","5","has logged in the system at ","2018-06-16 21:13:03"),
("111","5","has logged out the system at ","2018-06-16 21:13:07"),
("112","4","has logged in the system at ","2018-06-16 21:13:10"),
("113","4","has logged out the system at ","2018-06-16 22:51:31"),
("114","1","has logged in the system at ","2018-06-16 22:51:38"),
("115","1","has logged out the system at ","2018-06-16 22:52:20"),
("116","4","has logged in the system at ","2018-06-16 22:52:26"),
("117","4","has logged out the system at ","2018-06-16 23:02:12"),
("118","4","has logged in the system at ","2018-06-16 23:05:50"),
("119","4","has logged out the system at ","2018-06-17 10:31:55"),
("120","4","has logged in the system at ","2018-06-17 10:32:01");
INSERT INTO history_log VALUES
("121","4","has logged out the system at ","2018-06-17 10:34:59"),
("122","4","has logged in the system at ","2018-06-17 10:36:16"),
("123","4","has logged out the system at ","2018-06-17 10:53:02"),
("124","1","has logged in the system at ","2018-06-17 10:53:09"),
("125","1","has logged out the system at ","2018-06-17 10:57:27"),
("126","4","has logged in the system at ","2018-06-17 10:57:36"),
("127","4","has logged out the system at ","2018-06-18 20:10:53"),
("128","1","has logged in the system at ","2018-06-18 20:10:58"),
("129","4","has logged in the system at ","2018-06-19 21:03:56"),
("130","4","has logged out the system at ","2018-06-19 21:03:59"),
("131","1","has logged in the system at ","2018-06-19 21:04:05"),
("132","1","has logged out the system at ","2018-06-20 20:20:03"),
("133","4","has logged in the system at ","2018-06-20 20:20:14"),
("134","4","has logged out the system at ","2018-06-21 21:29:40"),
("135","1","has logged in the system at ","2018-06-21 21:29:46"),
("136","1","has logged out the system at ","2018-06-22 21:20:44"),
("137","1","has logged in the system at ","2018-06-22 21:24:58"),
("138","1","has logged out the system at ","2018-06-22 22:09:46"),
("139","5","has logged in the system at ","2018-06-22 22:09:56"),
("140","5","has logged out the system at ","2018-06-22 22:35:18"),
("141","4","has logged in the system at ","2018-06-22 22:35:28"),
("142","4","has logged out the system at ","2018-06-22 23:04:23"),
("143","4","has logged in the system at ","2018-06-22 23:07:06"),
("144","4","has logged out the system at ","2018-06-23 00:09:49"),
("145","4","has logged in the system at ","2018-06-23 07:35:12"),
("146","4","has logged out the system at ","2018-06-23 07:40:57"),
("147","8","has logged in the system at ","2018-06-23 07:42:11"),
("148","8","has logged out the system at ","2018-06-23 08:23:03"),
("149","1","has logged in the system at ","2018-06-23 08:25:07"),
("150","1","has logged out the system at ","2018-06-23 09:41:07"),
("151","1","has logged in the system at ","2018-06-24 14:32:41"),
("152","1","has logged out the system at ","2018-06-24 14:33:16"),
("153","1","has logged in the system at ","2018-06-24 15:35:44"),
("154","1","has logged out the system at ","2018-06-24 20:21:53"),
("155","4","has logged in the system at ","2018-06-24 20:22:05"),
("156","1","has logged in the system at ","2018-06-29 22:19:24"),
("157","1","has logged out the system at ","2018-06-29 22:47:07"),
("158","4","has logged in the system at ","2018-06-29 22:47:14"),
("159","4","has logged out the system at ","2018-06-29 22:56:06"),
("160","1","has logged in the system at ","2018-06-29 22:56:13"),
("161","1","has logged out the system at ","2018-06-29 23:01:55"),
("162","4","has logged in the system at ","2018-06-30 00:20:27"),
("163","4","has logged out the system at ","2018-06-30 01:38:15"),
("164","1","has logged in the system at ","2018-06-30 01:38:24"),
("165","1","has logged out the system at ","2018-06-30 01:38:31"),
("166","5","has logged in the system at ","2018-06-30 01:38:46"),
("167","5","has logged out the system at ","2018-06-30 01:47:36"),
("168","4","has logged in the system at ","2018-06-30 01:47:42"),
("169","4","has logged out the system at ","2018-06-30 01:49:38"),
("170","5","has logged in the system at ","2018-06-30 01:49:46"),
("171","5","has logged out the system at ","2018-06-30 01:51:17"),
("172","4","has logged in the system at ","2018-06-30 11:43:43"),
("173","4","has logged out the system at ","2018-06-30 12:04:20"),
("174","1","has logged in the system at ","2018-06-30 12:04:26"),
("175","1","has logged out the system at ","2018-06-30 12:05:24"),
("176","4","has logged in the system at ","2018-06-30 16:20:54"),
("177","4","has logged out the system at ","2018-06-30 16:46:17"),
("178","1","has logged in the system at ","2018-06-30 16:46:29"),
("179","1","has logged out the system at ","2018-06-30 16:57:18"),
("180","4","has logged in the system at ","2018-06-30 16:57:53"),
("181","4","has logged out the system at ","2018-06-30 16:58:50"),
("182","5","has logged in the system at ","2018-06-30 16:59:08"),
("183","5","has logged out the system at ","2018-06-30 17:00:38"),
("184","4","has logged in the system at ","2018-07-02 13:24:46"),
("185","4","has logged out the system at ","2018-07-02 13:35:09"),
("186","1","has logged in the system at ","2018-07-02 13:35:21"),
("187","1","has logged out the system at ","2018-07-02 13:36:07"),
("188","4","has logged in the system at ","2018-07-02 13:36:19"),
("189","4","has logged out the system at ","2018-07-02 13:46:38"),
("190","1","has logged in the system at ","2018-07-02 13:46:43"),
("191","1","has logged out the system at ","2018-07-02 13:51:32"),
("192","4","has logged in the system at ","2018-07-02 13:51:41"),
("193","4","has logged out the system at ","2018-07-02 13:52:13"),
("194","1","has logged in the system at ","2018-07-02 13:52:18"),
("195","1","has logged out the system at ","2018-07-02 13:52:49"),
("196","4","has logged in the system at ","2018-07-02 13:52:58"),
("197","4","has logged out the system at ","2018-07-02 13:56:48"),
("198","1","has logged in the system at ","2018-07-02 13:56:53"),
("199","1","has logged out the system at ","2018-07-02 13:57:45"),
("200","4","has logged in the system at ","2018-07-02 13:57:54"),
("201","4","has logged out the system at ","2018-07-02 18:45:43"),
("202","1","has logged in the system at ","2018-07-02 23:25:12"),
("203","1","has logged out the system at ","2018-07-02 23:25:51"),
("204","4","has logged in the system at ","2018-07-02 23:25:58"),
("205","4","has logged out the system at ","2018-07-02 23:26:24"),
("206","1","has logged in the system at ","2018-07-02 23:26:31"),
("207","1","has logged out the system at ","2018-07-02 23:27:07"),
("208","4","has logged in the system at ","2018-07-02 23:27:15"),
("209","4","has logged out the system at ","2018-07-02 23:34:16"),
("210","1","has logged in the system at ","2018-07-02 23:34:22"),
("211","1","has logged out the system at ","2018-07-02 23:38:50"),
("212","1","has logged in the system at ","2018-07-02 23:41:45"),
("213","1","has logged out the system at ","2018-07-02 23:42:25"),
("214","4","has logged in the system at ","2018-07-02 23:42:33"),
("215","4","has logged out the system at ","2018-07-02 23:42:48"),
("216","1","has logged in the system at ","2018-07-02 23:43:13"),
("217","1","has logged out the system at ","2018-07-02 23:44:02"),
("218","4","has logged in the system at ","2018-07-02 23:44:12"),
("219","4","has logged out the system at ","2018-07-02 23:51:04"),
("220","1","has logged in the system at ","2018-07-02 23:51:15");
INSERT INTO history_log VALUES
("221","1","has logged out the system at ","2018-07-03 00:14:58"),
("222","4","has logged in the system at ","2018-07-03 00:15:05"),
("223","4","has logged out the system at ","2018-07-03 00:16:51"),
("224","1","has logged in the system at ","2018-07-03 00:17:12"),
("225","1","has logged out the system at ","2018-07-03 00:17:42"),
("226","4","has logged in the system at ","2018-07-03 00:17:51"),
("227","4","has logged out the system at ","2018-07-03 00:20:22"),
("228","4","has logged in the system at ","2018-07-03 00:22:00"),
("229","4","has logged out the system at ","2018-07-03 11:24:55"),
("230","4","has logged in the system at ","2018-07-03 12:41:21"),
("231","4","has logged out the system at ","2018-07-03 16:44:53"),
("232","4","has logged in the system at ","2018-07-03 16:45:31"),
("233","4","has logged out the system at ","2018-07-03 16:56:15"),
("234","1","has logged in the system at ","2018-07-03 16:56:22"),
("235","4","has logged in the system at ","2018-07-04 21:34:26"),
("236","4","has logged in the system at ","2018-07-07 09:05:01"),
("237","4","has logged in the system at ","2018-07-07 20:30:55"),
("238","4","has logged out the system at ","2018-07-07 20:54:11"),
("239","1","has logged in the system at ","2018-07-07 20:54:17"),
("240","1","has logged out the system at ","2018-07-07 20:56:00"),
("241","5","has logged in the system at ","2018-07-07 20:56:17"),
("242","5","has logged out the system at ","2018-07-09 20:08:39"),
("243","4","has logged in the system at ","2018-07-17 21:30:22"),
("244","4","has logged out the system at ","2018-07-17 21:32:24"),
("245","1","has logged in the system at ","2018-07-17 21:32:30"),
("246","1","has logged out the system at ","2018-07-17 21:33:30"),
("247","4","has logged in the system at ","2018-07-17 21:33:39"),
("248","4","has logged out the system at ","2018-07-17 21:35:46"),
("249","4","has logged in the system at ","2018-07-17 22:01:04"),
("250","4","has logged in the system at ","2018-07-21 12:19:33"),
("251","4","has logged out the system at ","2018-07-21 13:03:51"),
("252","5","has logged in the system at ","2018-07-21 13:07:30"),
("253","5","has logged out the system at ","2018-07-21 13:08:52"),
("254","4","has logged in the system at ","2018-07-21 15:08:25"),
("255","4","has logged out the system at ","2018-07-21 15:12:01"),
("256","1","has logged in the system at ","2018-07-21 15:12:07"),
("257","1","has logged out the system at ","2018-07-21 15:54:06"),
("258","4","has logged in the system at ","2018-07-21 15:54:12"),
("259","4","has logged out the system at ","2018-07-21 15:54:46"),
("260","1","has logged in the system at ","2018-07-21 15:54:52"),
("261","1","has logged out the system at ","2018-07-21 16:04:34"),
("262","4","has logged in the system at ","2018-07-21 16:05:42"),
("263","4","has logged out the system at ","2018-07-21 16:24:04"),
("264","1","has logged in the system at ","2018-07-21 16:24:09"),
("265","1","has logged out the system at ","2018-07-21 16:26:37"),
("266","4","has logged in the system at ","2018-07-21 16:26:42"),
("267","4","has logged out the system at ","2018-07-21 16:27:27"),
("268","1","has logged in the system at ","2018-07-21 16:27:43"),
("269","1","has logged out the system at ","2018-07-21 16:35:39"),
("270","4","has logged in the system at ","2018-07-21 16:35:44"),
("271","4","has logged out the system at ","2018-07-21 16:40:24"),
("272","5","has logged in the system at ","2018-07-21 16:40:31"),
("273","4","has logged in the system at ","2018-07-21 22:48:34"),
("274","5","has logged out the system at ","2018-07-22 13:39:00"),
("275","4","has logged in the system at ","2018-07-22 13:39:05"),
("276","4","has logged in the system at ","2018-07-22 15:09:37"),
("277","4","has logged in the system at ","2018-07-22 15:57:27"),
("278","4","has logged out the system at ","2018-07-22 20:21:54"),
("279","1","has logged in the system at ","2018-07-22 20:22:00"),
("280","1","has logged out the system at ","2018-07-22 20:25:14"),
("281","4","has logged in the system at ","2018-07-22 20:25:25"),
("282","4","has logged out the system at ","2018-07-23 21:08:58"),
("283","5","has logged in the system at ","2018-07-23 21:09:13"),
("284","5","has logged out the system at ","2018-07-23 21:10:01"),
("285","4","has logged in the system at ","2018-07-23 21:10:05"),
("286","4","has logged out the system at ","2018-07-23 21:39:35"),
("287","1","has logged in the system at ","2018-07-23 21:39:40"),
("288","1","has logged out the system at ","2018-07-23 21:39:44"),
("289","4","has logged in the system at ","2018-07-23 21:39:53"),
("290","4","has logged out the system at ","2018-07-23 21:48:34"),
("291","1","has logged in the system at ","2018-07-23 21:50:01"),
("292","1","has logged out the system at ","2018-07-23 21:57:11"),
("293","4","has logged in the system at ","2018-07-23 21:57:20");




CREATE TABLE `inv_damages_tb` (
  `id` int(12) NOT NULL AUTO_INCREMENT,
  `inv_id` int(12) NOT NULL,
  `quantity` int(12) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;


INSERT INTO inv_damages_tb VALUES
("1","1","30"),
("2","4","20"),
("3","5","2");




CREATE TABLE `inventory_tb` (
  `id` int(12) NOT NULL AUTO_INCREMENT,
  `name` text NOT NULL,
  `quantity` int(12) NOT NULL,
  `date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `added_by` int(12) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;


INSERT INTO inventory_tb VALUES
("1","Spoons","100","2018-07-22 13:24:57","5"),
("2","Plates","250","2018-07-22 13:27:56","5"),
("4","Mag Cups","280","2018-07-22 13:32:39","5"),
("5","Cooking Pans","54","2018-07-22 13:47:38","4");




CREATE TABLE `payment` (
  `payment_id` int(11) NOT NULL AUTO_INCREMENT,
  `cust_id` int(11) NOT NULL,
  `sales_id` int(11) NOT NULL,
  `payment` decimal(10,2) NOT NULL,
  `payment_date` datetime NOT NULL,
  `user_id` int(11) NOT NULL,
  `branch_id` int(11) NOT NULL,
  `payment_for` date NOT NULL,
  `due` decimal(10,2) NOT NULL,
  `interest` decimal(10,2) NOT NULL,
  `remaining` decimal(10,2) NOT NULL,
  `status` varchar(20) NOT NULL,
  `rebate` decimal(10,2) NOT NULL,
  `or_no` int(11) NOT NULL,
  PRIMARY KEY (`payment_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3210 DEFAULT CHARSET=latin1;


INSERT INTO payment VALUES
("3156","1","6","550.00","2017-02-21 19:57:12","1","1","2017-02-21","550.00","0.00","0.00","paid","0.00","1901"),
("3157","2","7","550.00","2017-02-21 19:57:29","1","1","2017-02-21","550.00","0.00","0.00","paid","0.00","1902"),
("3163","2","9","113.30","2017-02-21 21:31:20","1","1","2017-03-21","113.30","0.00","0.00","paid","0.00","0"),
("3164","2","9","36.70","2017-02-21 21:31:20","1","1","2017-04-21","113.30","9.10","422.40","partially paid","0.00","0"),
("3165","2","9","0.00","0000-00-00 00:00:00","1","1","2017-05-21","113.30","9.10","459.10","","0.00","0"),
("3166","2","9","0.00","0000-00-00 00:00:00","1","1","2017-06-21","113.30","9.10","459.10","","0.00","0"),
("3167","2","9","113.30","2017-02-21 00:00:00","1","1","2017-02-21","113.30","0.00","0.00","paid","0.00","3151"),
("3168","0","10","0.00","0000-00-00 00:00:00","4","1","2018-07-16","0.00","0.00","0.00","","0.00","0"),
("3172","0","14","302.00","2018-06-16 17:51:44","1","1","2018-06-16","302.00","0.00","0.00","paid","0.00","1903"),
("3173","0","15","311.00","2018-06-16 18:22:51","1","1","2018-06-16","311.00","0.00","0.00","paid","0.00","1904"),
("3174","0","16","322.00","2018-06-17 16:55:03","1","1","2018-06-17","322.00","0.00","0.00","paid","0.00","1905"),
("3175","0","17","322.00","2018-06-21 01:51:24","1","1","2018-06-21","322.00","0.00","0.00","paid","0.00","1906"),
("3176","0","18","300.00","2018-06-21 02:17:25","1","1","2018-06-21","300.00","0.00","0.00","paid","0.00","1907"),
("3177","0","19","300.00","2018-06-21 02:17:51","1","1","2018-06-21","300.00","0.00","0.00","paid","0.00","1908"),
("3178","0","20","300.00","2018-06-23 04:01:09","1","1","2018-06-23","300.00","0.00","0.00","paid","0.00","1909"),
("3179","0","21","300.00","2018-06-23 04:03:30","1","1","2018-06-23","300.00","0.00","0.00","paid","0.00","1910"),
("3180","0","22","1200.00","2018-06-23 14:03:45","8","1","2018-06-23","1200.00","0.00","0.00","paid","0.00","1911"),
("3181","0","23","33.00","2018-06-23 14:16:29","8","1","2018-06-23","33.00","0.00","0.00","paid","0.00","1912"),
("3182","0","24","1632.00","2018-06-23 14:33:25","1","1","2018-06-23","1632.00","0.00","0.00","paid","0.00","1913"),
("3183","0","25","300.00","2018-06-23 14:35:42","1","1","2018-06-23","300.00","0.00","0.00","paid","0.00","1914"),
("3184","0","26","11.00","2018-06-30 18:04:53","1","1","2018-06-30","11.00","0.00","0.00","paid","0.00","1915"),
("3185","0","27","1500.00","2018-06-30 22:54:19","1","1","2018-06-30","1500.00","0.00","0.00","paid","0.00","1916"),
("3186","0","28","21.00","2018-07-02 19:36:01","1","1","2018-07-02","21.00","0.00","0.00","paid","0.00","1917"),
("3187","0","29","11.00","2018-07-02 19:47:08","1","1","2018-07-02","11.00","0.00","0.00","paid","0.00","1918"),
("3188","0","30","323.00","2018-07-02 19:47:55","1","1","2018-07-02","323.00","0.00","0.00","paid","0.00","1919"),
("3189","0","31","55.00","2018-07-02 19:51:21","1","1","2018-07-02","55.00","0.00","0.00","paid","0.00","1920"),
("3190","0","32","99.00","2018-07-02 19:52:43","1","1","2018-07-02","99.00","0.00","0.00","paid","0.00","1921"),
("3191","0","33","55.00","2018-07-02 19:57:10","1","1","2018-07-02","55.00","0.00","0.00","paid","0.00","1901"),
("3192","0","34","22.00","2018-07-02 19:57:32","1","1","2018-07-02","22.00","0.00","0.00","paid","0.00","1902"),
("3193","0","35","900.00","2018-07-03 05:25:44","1","1","2018-07-03","900.00","0.00","0.00","paid","0.00","1903"),
("3194","0","36","11.00","2018-07-03 05:34:32","1","1","2018-07-03","11.00","0.00","0.00","paid","0.00","1904"),
("3195","0","37","12.00","2018-07-02 23:42:01","1","1","2018-07-02","12.00","0.00","0.00","paid","0.00","1905"),
("3196","0","38","143.00","2018-07-02 23:43:32","1","1","2018-07-02","143.00","0.00","0.00","paid","0.00","1906"),
("3197","0","39","1008.00","2018-07-02 23:52:40","1","1","2018-07-02","1008.00","0.00","0.00","paid","0.00","1907"),
("3198","0","40","2400000.00","2018-07-02 23:53:01","1","1","2018-07-02","2400000.00","0.00","0.00","paid","0.00","1908"),
("3199","0","41","880.00","2018-07-02 23:54:45","1","1","2018-07-02","880.00","0.00","0.00","paid","0.00","1909"),
("3200","0","42","7.00","2018-07-03 00:14:35","1","1","2018-07-03","7.00","0.00","0.00","paid","0.00","1910"),
("3201","0","43","616.00","2018-07-03 00:17:32","1","1","2018-07-03","616.00","0.00","0.00","paid","0.00","1911"),
("3202","0","44","1524.00","2018-07-03 16:59:27","1","1","2018-07-03","1524.00","0.00","0.00","paid","0.00","1912"),
("3203","0","45","97.00","2018-07-17 21:33:14","1","1","2018-07-17","97.00","0.00","0.00","paid","0.00","1913"),
("3204","0","46","391.00","2018-07-21 15:19:54","1","1","2018-07-21","391.00","0.00","0.00","paid","0.00","1914"),
("3205","0","47","2250.00","2018-07-21 15:27:07","1","1","2018-07-21","2250.00","0.00","0.00","paid","0.00","1915"),
("3206","0","48","1350.00","2018-07-21 15:50:42","1","1","2018-07-21","1350.00","0.00","0.00","paid","0.00","1916"),
("3207","0","49","1260.00","2018-07-21 16:30:59","1","1","2018-07-21","1260.00","0.00","0.00","paid","0.00","1917"),
("3208","0","50","450.00","2018-07-22 20:23:48","1","1","2018-07-22","450.00","0.00","0.00","paid","0.00","1918"),
("3209","0","51","7.00","2018-07-23 21:50:57","1","1","2018-07-23","7.00","0.00","0.00","paid","0.00","1919");




CREATE TABLE `product` (
  `prod_id` int(11) NOT NULL AUTO_INCREMENT,
  `prod_name` varchar(100) NOT NULL,
  `prod_desc` varchar(500) NOT NULL,
  `prod_price` decimal(10,2) NOT NULL,
  `prod_sell_price` text NOT NULL,
  `prod_pic` varchar(300) NOT NULL,
  `cat_id` int(11) NOT NULL,
  `prod_qty` int(11) NOT NULL,
  `branch_id` int(11) NOT NULL,
  `reorder` int(11) NOT NULL,
  `supplier_id` int(11) NOT NULL,
  `serial` varchar(50) NOT NULL,
  `date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `belongs_to` int(12) NOT NULL,
  PRIMARY KEY (`prod_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;


INSERT INTO product VALUES
("2","Castle Lite Beer","2 Crates of Castle Lite","350.00","300.00","in.png","13","245","1","0","8","Non","2018-07-03 16:59:27","13"),
("6","Castle Lagar","Castle Beer","45.00","7","default.gif","12","86","1","0","8","Non","2018-07-23 21:50:57","12"),
("7","Cider","Cider Beer","45.00","12","default.gif","12","3","1","0","8","Non","2018-07-21 15:59:05","12"),
("8","Amarula","Amurula Big Bottle","35.00","50","default.gif","12","12","1","0","8","Non","2018-07-23 21:37:46","1");




CREATE TABLE `purchase_request` (
  `pr_id` int(11) NOT NULL AUTO_INCREMENT,
  `prod_id` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `request_date` date NOT NULL,
  `branch_id` int(11) NOT NULL,
  `purchase_status` varchar(10) NOT NULL,
  PRIMARY KEY (`pr_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;


INSERT INTO purchase_request VALUES
("1","0","0","2017-12-06","0","pending");




CREATE TABLE `sales` (
  `sales_id` int(11) NOT NULL AUTO_INCREMENT,
  `cust_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `cash_tendered` decimal(10,2) DEFAULT NULL,
  `discount` decimal(10,2) DEFAULT NULL,
  `amount_due` decimal(10,2) NOT NULL,
  `cash_change` decimal(10,2) DEFAULT NULL,
  `date_added` datetime NOT NULL,
  `modeofpayment` varchar(15) NOT NULL,
  `branch_id` int(11) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  PRIMARY KEY (`sales_id`)
) ENGINE=InnoDB AUTO_INCREMENT=52 DEFAULT CHARSET=latin1;


INSERT INTO sales VALUES
("33","0","1","56.00","0.00","55.00","1.00","2018-07-02 19:57:10","cash","1","55.00"),
("34","0","1","23.00","0.00","22.00","1.00","2018-07-02 19:57:32","cash","1","22.00"),
("35","0","1","901.00","0.00","900.00","1.00","2018-07-03 05:25:44","cash","1","900.00"),
("36","0","1","12.00","0.00","11.00","1.00","2018-07-03 05:34:32","cash","1","11.00"),
("37","0","1","13.00","0.00","12.00","1.00","2018-07-02 23:42:01","cash","1","12.00"),
("38","0","1","144.00","0.00","143.00","1.00","2018-07-02 23:43:32","cash","1","143.00"),
("39","0","1","2000.00","0.00","1008.00","992.00","2018-07-02 23:52:40","cash","1","1008.00"),
("40","0","1","99999999.99","0.00","2400000.00","99999999.99","2018-07-02 23:53:01","cash","1","2400000.00"),
("41","0","1","889.00","0.00","880.00","9.00","2018-07-02 23:54:45","cash","1","880.00"),
("42","0","1","9.00","0.00","7.00","2.00","2018-07-03 00:14:35","cash","1","7.00"),
("43","0","1","617.00","0.00","616.00","1.00","2018-07-03 00:17:32","cash","1","616.00"),
("44","0","1","1550.00","0.00","1524.00","26.00","2018-07-03 16:59:27","cash","1","1524.00"),
("45","0","1","97.00","0.00","97.00","0.00","2018-07-17 21:33:14","cash","1","97.00"),
("46","0","1","392.00","0.00","391.00","1.00","2018-07-21 15:19:54","cash","1","391.00"),
("47","0","1","3000.00","0.00","2250.00","750.00","2018-07-21 15:27:07","cash","1","2250.00"),
("48","0","1","1400.00","0.00","1350.00","50.00","2018-07-21 15:50:42","cash","1","1350.00"),
("49","0","1","1300.00","0.00","1260.00","40.00","2018-07-21 16:30:59","cash","1","1260.00"),
("50","0","1","451.00","0.00","450.00","1.00","2018-07-22 20:23:48","cash","1","450.00"),
("51","0","1","7.50","0.00","7.00","0.50","2018-07-23 21:50:57","cash","1","7.00");




CREATE TABLE `sales_details` (
  `sales_details_id` int(11) NOT NULL AUTO_INCREMENT,
  `sales_id` int(11) NOT NULL,
  `prod_id` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `qty` int(11) NOT NULL,
  PRIMARY KEY (`sales_details_id`)
) ENGINE=InnoDB AUTO_INCREMENT=65 DEFAULT CHARSET=latin1;


INSERT INTO sales_details VALUES
("42","33","5","11.00","5"),
("43","34","5","11.00","2"),
("44","35","2","300.00","3"),
("45","36","5","11.00","1"),
("46","37","7","12.00","1"),
("47","38","5","11.00","13"),
("48","39","6","7.00","144"),
("49","40","2","300.00","8000"),
("50","41","5","11.00","80"),
("51","42","6","7.00","1"),
("52","43","6","7.00","88"),
("53","44","2","300.00","5"),
("54","44","7","12.00","2"),
("55","45","8","90.00","1"),
("56","45","6","7.00","1"),
("57","46","6","7.00","1"),
("58","46","7","48.00","8"),
("59","47","8","450.00","5"),
("60","48","8","1170.00","13"),
("61","48","7","132.00","15"),
("62","49","8","1170.00","14"),
("63","50","8","90.00","5"),
("64","51","6","7.00","1");




CREATE TABLE `sales_tb` (
  `id` int(12) NOT NULL AUTO_INCREMENT,
  `item_sold_id` int(12) NOT NULL,
  `quantity` int(12) NOT NULL,
  `sales_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `added_by` int(12) NOT NULL,
  `price` int(12) NOT NULL,
  `date` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;






CREATE TABLE `shop_category_tb` (
  `id` int(12) NOT NULL AUTO_INCREMENT,
  `name` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;


INSERT INTO shop_category_tb VALUES
("1","Bar"),
("2","Restruant");




CREATE TABLE `stockin` (
  `stockin_id` int(11) NOT NULL AUTO_INCREMENT,
  `prod_id` int(11) NOT NULL,
  `qty` int(6) NOT NULL,
  `date` datetime NOT NULL,
  `branch_id` int(11) NOT NULL,
  PRIMARY KEY (`stockin_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;


INSERT INTO stockin VALUES
("1","5","5","2017-02-04 01:10:41","1"),
("2","15","100","2017-02-04 01:10:49","1"),
("3","13","10","2017-02-04 01:10:55","1"),
("4","14","5","2017-02-04 01:11:07","1"),
("5","5","0","2017-12-03 00:29:21","1"),
("6","14","0","2017-12-03 00:29:49","1");




CREATE TABLE `supplier` (
  `supplier_id` int(11) NOT NULL AUTO_INCREMENT,
  `supplier_name` varchar(100) NOT NULL,
  `supplier_address` varchar(300) NOT NULL,
  `supplier_contact` varchar(50) NOT NULL,
  PRIMARY KEY (`supplier_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;


INSERT INTO supplier VALUES
("8","Chescotech","Supplier of Beers","0955104708"),
("9","Oswald Supplier","Chudleah Street, Lusaka. Zambia","0978980054"),
("10","Gimuceci","Kaunda Square Stage 2, Lusaka","0975704992");




CREATE TABLE `temp_trans` (
  `temp_trans_id` int(11) NOT NULL AUTO_INCREMENT,
  `prod_id` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `qty` int(11) NOT NULL,
  `branch_id` int(11) NOT NULL,
  PRIMARY KEY (`temp_trans_id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;






CREATE TABLE `term` (
  `term_id` int(11) NOT NULL AUTO_INCREMENT,
  `sales_id` int(11) DEFAULT NULL,
  `payable_for` varchar(10) NOT NULL,
  `term` varchar(11) NOT NULL,
  `due` decimal(10,2) NOT NULL,
  `payment_start` date NOT NULL,
  `down` decimal(10,2) NOT NULL,
  `due_date` date NOT NULL,
  `interest` decimal(10,2) NOT NULL,
  `status` varchar(10) NOT NULL,
  PRIMARY KEY (`term_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;


INSERT INTO term VALUES
("1","8","4","monthly","113.30","2017-02-21","113.30","2017-06-21","16.50",""),
("2","9","4","monthly","113.30","2017-02-21","113.30","2017-06-21","16.50",""),
("3","10","1","monthly","0.00","2018-06-16","0.00","2018-07-16","0.00","");




CREATE TABLE `user` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(15) NOT NULL,
  `password` varchar(50) NOT NULL,
  `name` varchar(50) NOT NULL,
  `status` varchar(10) NOT NULL,
  `branch_id` int(11) NOT NULL,
  `user_type` text NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;


INSERT INTO user VALUES
("1","user","e6e061838856bf47e1de730719fb2609","Choolwe Ngandu","active","1","User"),
("4","admin","e6e061838856bf47e1de730719fb2609","Mona Lisa","active","1","Admin"),
("5","inv","21232f297a57a5a743894a0e4a801fc3","Monde Sichuma","active","1","InventoryDataEntry"),
("6","GregzPub","c5866e93cab1776890fe343c9e7063fb","Gregory Phiri","active","1","Admin"),
("7","Peter","81dc9bdb52d04dc20036dbd8313ed055","Peter Shanyemba","active","1","User"),
("8","Jane","674f3c2c1a8a6f90461e8a66fb5550ba","Jane Muboola","active","1","User");


