CREATE TABLE nhood_list (
	nhood_id int(3) NOT NULL AUTO_INCREMENT PRIMARY KEY,
	name varchar(30) NOT NULL,
	perimeter float(15,5),
	area float(15,3),
	acres float(10,3)
);

INSERT INTO nhood_list VALUES
('1', 'Avondale', '41101.30239', '60674789.94', '1392.9'),
('2', 'Bond Hill', '33875.72512', '51199081.22', '1175.37'),
('3', 'California', '40160.29252', '58473146.15', '1342.36'),
('4', 'Camp Washington', '28653.13609', '34758820.43', '797.95'),
('5', 'Carthage', '22183.41757', '22080530.95', '506.9'),
('6', 'Clifton', '36874.56338', '61516081.83', '1412.21'),
('7', 'CUF', '21251.61655', '16746471.43', '384.45'),
('8', 'College Hill', '75110.52291', '108463691.6', '2489.98'),
('9', 'Columbia-Tusculum', '20442.65379', '26286773.65', '603.46'),
('10', 'Corryville', '17944.84048', '14125298.22', '324.27'),
('11', 'Downtown Cincinnati', '19076.32172', '21951597.33', '503.94'),
('12', 'East End', '78461.74038', '58285373.11', '1338.05'),
('13', 'East Price Hill', '41509.34344', '80844189.57', '1855.93'),
('14', 'East Walnut Hills', '22084.05565', '15426131.44', '354.14'),
('15', 'East Westwood', NULL, NULL, NULL),
('16', 'English Woods', '24750.98933', '28373137.57', '651.36'),
('17', 'Evanston', '25274.30156', '30960533.66', '710.76'),
('18', 'Fay Apartments', '15682.85654', '11399641.65', '261.7'),
('19', 'Hartwell', '51475.26473', '36646313.7', '841.28'),
('20', 'Hyde Park', '47515.89954', '81018991.78', '1859.94'),
('21', 'Kennedy Heights', '31395.72347', '28264662.74', '648.87'),
('22', 'Linwood', '46107.92795', '84058639.97', '1929.72'),
('23', 'Lower Price Hill', '22163.15602', '15658114.18', '359.46'),
('24', 'Madisonville', '45112.89405', '66124660.31', '1518.01'),
('25', 'Millvale', '24139.23898', '23892855.55', '548.5'),
('26', 'Mount Adams', '11071.34683', '6489910.811', '148.99'),
('27', 'Mount Airy', '57817.46782', '97583793.37', '2240.22'),
('28', 'Mount Auburn', '17691.6506', '19537134.52', '448.51'),
('29', 'Mount Lookout', '22774.2091', '28302565.91', '649.74'),
('30', 'Mount Washington', '78647.99948', '92102840.04', '2114.39'),
('31', 'North Avondale', '34782.94034', '35682316.53', '819.15'),
('32', 'North Fairmount', '24750.98933', '28373137.57', '651.36'),
('33', 'Northside', '38288.57056', '47883698.15', '1099.26'),
('34', 'Oakley', '38385.91866', '71780553.67', '1647.85'),
('35', 'Over-the-Rhine', '25820.20041', '16937678.73', '388.84'),
('36', 'Paddock Hills', NULL, NULL, NULL),
('37', 'Pendleton', NULL, NULL, NULL),
('38', 'Pleasant Ridge', '44764.52865', '47171473.85', '1082.91'),
('39', 'Queensgate', '31584.42407', '41318667.85', '948.55'),
('40', 'Riverside', '69699.6235', '45634377.47', '1047.62'),
('41', 'Roselawn', '41952.9769', '45341041.07', '1040.89'),
('42', 'Sayler Park', '46570.71032', '41173767.28', '945.22'),
('43', 'Sedamsville', '42823.18381', '38109429.07', '874.87'),
('44', 'South Cumminsville', '24139.23898', '23892855.55', '548.5'),
('45', 'South Fairmount', '25081.06841', '18510421', '424.94'),
('46', 'Spring Grove Village', '45162.07962', '54475190.19', '1250.58'),
('47', 'Walnut Hills', '36474.98742', '41347924.01', '949.22'),
('48', 'West End', '32239.25164', '28101883.14', '645.13'),
('49', 'West Price Hill', '57598.95495', '75429337.47', '1731.62'),
('50', 'Westwood', '70237.9561', '181963047.4', '4177.3'),
('51', 'Winton Terrace', '43090.56326', '70140291.25', '1610.2');

CREATE TABLE address (
	parcel varchar(30) NOT NULL PRIMARY KEY,
	st_no varchar(10) NOT NULL,
	st_dir varchar(5),
	st_name varchar(30) NOT NULL,
	nhood_id int(3),
	xcoord int(10),
	ycoord int(10)
);

create table vp_stat(
	stat_id int(3) NOT NULL AUTO_INCREMENT PRIMARY KEY,
	stat_name char(20)
);

create table vp_type(
	type_id int(3) NOT NULL AUTO_INCREMENT PRIMARY KEY,
	type_name char(30)
);


create table vp_list(
	parcel varchar(30) NOT NULL PRIMARY KEY,
	type_id int(3) not null,
	stat_id int(3) not null
);

create table sr_stat
( stat_id int(3) not null auto_increment primary key,
  stat_name char(20)
);

create table sr_priority
( priority_id int(3) not null auto_increment primary key,
  priority_name char(20)
);

create table sr_type
( type_id int not null auto_increment primary key,
  type_name char(30)
);

create table sr_list
( csr_id varchar(30) not null primary key,
  stat_id int(3) not null,
  type_id int(3) not null,
  description char(255),
  rcvd_dt date not null,
  priority_id int(3) not null,
  pln_comp_dt date,
  comp_dt date,
  stat_dt date,
  parcel varchar(30)
);

create table users
(
user_id int(3) NOT NULL AUTO_INCREMENT PRIMARY KEY,
user_name char(25) NOT NULL,
password char(255) NOT NULL,
first_name char(25) NOT NULL,
last_name char(25) NOT NULL,
email char(50) NOT NULL,
registing_date DATE,
UNIQUE(user_name),
UNIQUE(email)
);