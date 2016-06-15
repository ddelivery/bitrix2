create table if not exists ddelivery_ddelivery
(
    ID int(11) NOT NULL auto_increment,
	PARAMS text,
	ORDER_ID int(11),
	ddelivery_ID int(12),
	STATUS varchar(40),
	MESSAGE text,
	UPTIME varchar(10),
	PRIMARY KEY(ID),
	INDEX ix_ddelivery_ddeliveryoi (ORDER_ID)
);
/*//==backTown
CREATE TABLE ddelivery_ddelivery_cities (
  ID int(11) NOT NULL,
  NAME varchar(255) DEFAULT NULL,
  AREA varchar(255) DEFAULT NULL,
  REGION varchar(255) DEFAULT NULL,
  KLADR varchar(30) DEFAULT NULL,
  `TYPE` varchar(5) DEFAULT NULL,
  DPD_ID int(11) DEFAULT NULL,
  PRIORATY int(11) DEFAULT NULL,
  PRIMARY KEY (ID)
);
*/
