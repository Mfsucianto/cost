/*
SQLyog Community v12.2.1 (32 bit)
MySQL - 5.6.16 : Database - cost
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
USE `cost`;

/*Table structure for table `cd_detail_dpr` */

DROP TABLE IF EXISTS `cd_detail_dpr`;

CREATE TABLE `cd_detail_dpr` (
  `iCsDetailId` int(11) DEFAULT NULL,
  `vPerincian` varchar(100) DEFAULT NULL,
  `nJumlah` bigint(20) NOT NULL DEFAULT '0',
  KEY `iCsDetailId` (`iCsDetailId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `cd_detail_dpr` */

insert  into `cd_detail_dpr`(`iCsDetailId`,`vPerincian`,`nJumlah`) values 
(6,'Taksi dari Kediaman ke Bandara SSK II (PP)',188000),
(6,'Taksi dari Bandara di Bangka Belitung ke Kantor (PP)',180000),
(5,'Taksi dari Kediaman ke Bandara SSK II (PP)',188000),
(5,'Taksi dari Bandara di Bang Belitung ke Kantor',180000),
(7,'Taksi dari Kediaman ke Pelabuhan Sungai Duku (PP)',188000),
(8,'Taksi dari Kediaman ke Pelabuhan Sungai Duku (PP)',188000),
(13,'Taksi dari Kediaman ke Pelabuhan Sungai Duku',188000),
(30,'Taksi dari Kediaman ke Pelabuhan Sungai Duku (PP)',188000),
(31,'Taksi dari Kediaman ke Pelabuhan Sungai Duku (PP)',188000),
(32,'Taksi dari Kediaman ke Pelabuhan Sungai Duku (PP)',188000),
(33,'Taksi dari Kantor ke Bandara SSK II (PP)',188000),
(33,'Taksi di Bandara Soekarno Hatta',256000),
(33,'Taksi di Bandara Halim Perdanakusuma',75000),
(34,'Taksi da Penggantian Biaya Penginapan',1268000),
(35,'Taksi dari Kantor ke Bandara SSK II (PP)',188000),
(35,'Taksi dari Bandara Soekarno Hatta ke Kantor (PP)',512000),
(36,'Taksi dari Kantoir ke Bandara SSK II (PP)',188000),
(36,'Taksi dari Bandara Soekarno Hatta ke Kantor (PP)',512000),
(3,'Taksi dari Kantor - Bandara SSK II (PP)',188000),
(3,'asa',12000);

/*Table structure for table `counter_cs` */

DROP TABLE IF EXISTS `counter_cs`;

CREATE TABLE `counter_cs` (
  `iBidangId` int(11) DEFAULT NULL,
  `cTahun` char(4) DEFAULT NULL,
  `iLastNumber` int(11) DEFAULT NULL,
  UNIQUE KEY `iBidangId` (`iBidangId`,`cTahun`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `counter_cs` */

insert  into `counter_cs`(`iBidangId`,`cTahun`,`iLastNumber`) values 
(6,'2020',11),
(1,'2020',13),
(5,'2020',5),
(3,'2020',13),
(2,'2020',5);

/*Table structure for table `cs_detail` */

DROP TABLE IF EXISTS `cs_detail`;

CREATE TABLE `cs_detail` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `iDipaId` int(11) DEFAULT NULL,
  `iCsId` int(11) DEFAULT NULL,
  `dPerjalananStart` date DEFAULT NULL,
  `dPerjalananEnd` date DEFAULT NULL,
  `nLama` int(4) NOT NULL DEFAULT '0',
  `iAlatAngkut` tinyint(1) NOT NULL DEFAULT '0',
  `iOpsiHariLibur` tinyint(1) DEFAULT NULL,
  `iOpsiHariSabtu` tinyint(1) DEFAULT NULL,
  `iOpsiHariMinggu` tinyint(1) DEFAULT NULL,
  `vNip` varchar(30) DEFAULT NULL,
  `nBiayaUangHarian` bigint(20) NOT NULL DEFAULT '0' COMMENT 'Per hari',
  `nTotalUangHarian` bigint(20) NOT NULL DEFAULT '0' COMMENT 'jumlah (perhari * hari)',
  `nBiayaRepre` bigint(20) NOT NULL DEFAULT '0',
  `nBiayaTransport` bigint(20) NOT NULL DEFAULT '0',
  `nTotalTransport` bigint(20) NOT NULL DEFAULT '0',
  `iJenisAkomodasi` tinyint(1) DEFAULT NULL,
  `nBiayaPenginapan` bigint(20) NOT NULL DEFAULT '0',
  `nTotalPenginapan` bigint(20) NOT NULL DEFAULT '0',
  `nHonorJasa` bigint(20) NOT NULL DEFAULT '0',
  `nTotalBiaya` bigint(20) NOT NULL DEFAULT '0',
  `dTglSPPD` date DEFAULT NULL,
  `vNoSPPD` varchar(30) DEFAULT NULL,
  `vJenisSPD` varchar(30) DEFAULT NULL,
  `iBatalSPD` tinyint(1) NOT NULL DEFAULT '0' COMMENT '1=>batal SPD',
  `iCheckSuratTugas` tinyint(1) NOT NULL DEFAULT '0',
  `iChekSpd` tinyint(1) NOT NULL DEFAULT '0',
  `iChekPenginapan` tinyint(1) NOT NULL DEFAULT '0',
  `iChekTransportasi` tinyint(1) NOT NULL DEFAULT '0',
  `iChekPengeluaran` tinyint(1) NOT NULL DEFAULT '0',
  `dTerimaSpj` date DEFAULT NULL,
  `vNomorKwitansi` varchar(30) DEFAULT NULL,
  `dTglKwitansi` date DEFAULT NULL,
  `cTahunKwitansi` char(4) DEFAULT NULL,
  `dLumpsumpAwal` date DEFAULT NULL,
  `dLumpsumpAkhir` date DEFAULT NULL,
  `nNilaiKwitansi` bigint(20) NOT NULL DEFAULT '0',
  `tCreated` datetime DEFAULT NULL,
  `cCreatedby` varchar(20) DEFAULT NULL,
  `tUpdated` datetime DEFAULT NULL,
  `cUpdatedby` varchar(20) DEFAULT NULL,
  `lDeleted` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `iCsId` (`iCsId`,`vNip`),
  KEY `vNip` (`vNip`),
  KEY `lDeleted` (`lDeleted`),
  KEY `dTglKwitansi` (`dTglKwitansi`),
  KEY `cTahunKwitansi` (`cTahunKwitansi`),
  KEY `iDipaId` (`iDipaId`,`lDeleted`),
  KEY `iDipaId_2` (`iDipaId`,`nTotalBiaya`,`lDeleted`)
) ENGINE=InnoDB AUTO_INCREMENT=49 DEFAULT CHARSET=latin1;

/*Data for the table `cs_detail` */

insert  into `cs_detail`(`id`,`iDipaId`,`iCsId`,`dPerjalananStart`,`dPerjalananEnd`,`nLama`,`iAlatAngkut`,`iOpsiHariLibur`,`iOpsiHariSabtu`,`iOpsiHariMinggu`,`vNip`,`nBiayaUangHarian`,`nTotalUangHarian`,`nBiayaRepre`,`nBiayaTransport`,`nTotalTransport`,`iJenisAkomodasi`,`nBiayaPenginapan`,`nTotalPenginapan`,`nHonorJasa`,`nTotalBiaya`,`dTglSPPD`,`vNoSPPD`,`vJenisSPD`,`iBatalSPD`,`iCheckSuratTugas`,`iChekSpd`,`iChekPenginapan`,`iChekTransportasi`,`iChekPengeluaran`,`dTerimaSpj`,`vNomorKwitansi`,`dTglKwitansi`,`cTahunKwitansi`,`dLumpsumpAwal`,`dLumpsumpAkhir`,`nNilaiKwitansi`,`tCreated`,`cCreatedby`,`tUpdated`,`cUpdatedby`,`lDeleted`) values 
(1,0,3,'2020-01-12','2020-01-15',3,0,0,0,0,'196107081982031001',0,0,0,0,0,0,0,0,0,0,'2020-01-06','SPD-1/PW04/1/2020','Luar Kota',0,0,0,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,0,'2020-05-09 14:46:58','yulissa','2020-05-10 14:51:55','Nova',0),
(2,0,3,'2020-01-12','2020-01-15',3,0,0,0,0,'198706022009111001',0,0,0,0,0,0,0,0,0,0,'2020-05-06','SPD-2/PW04/1/2020','Luar Kota',0,0,0,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,0,'2020-05-09 14:47:08','yulissa','2020-05-09 16:43:58','Nova',0),
(3,37,4,'2020-01-08','2020-01-11',4,1,3,3,3,'196501141986031001',430000,1720000,0,2806050,5612100,2,233333,699999,0,8032099,'2020-01-07','SPD-3/PW04/1/2020','Luar Kota',0,1,1,1,1,0,'2020-01-13','KUI-01','2020-01-13','2020','2020-01-08','2020-01-11',7754100,'2020-05-09 16:17:18','kemal','2020-05-16 21:24:36','Nova',0),
(4,0,6,'2020-01-12','2020-01-18',5,0,0,0,0,'196705131994031001',0,0,0,0,0,0,0,0,0,0,'2020-05-08','SPD-4/PW04/1/2020','Luar Kota',0,0,0,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,0,'2020-05-09 17:02:03','idra','2020-05-09 17:15:27','Nova',0),
(5,36,7,'2020-01-23','2020-01-26',4,1,3,3,3,'196601101986031002',270000,1080000,0,1957600,3915200,1,853333,2559999,0,7555199,'2020-01-08','SPD-5/PW04/1/2020','Fullboard',0,1,1,1,1,0,'2020-04-07','KUI-03/2020','2020-04-07','2020','2020-01-23','2020-01-26',7187200,'2020-05-09 17:48:28','nelson','2020-05-10 15:13:15','Nova',0),
(6,36,7,'2020-01-23','2020-01-26',4,1,3,3,3,'196208101985031001',270000,1080000,0,1984000,3968000,1,533333,1599999,0,6647999,'2020-01-08','SPD-6/PW04/1/2020','Fullboard',0,1,1,1,1,0,'2020-04-07','KUI-02/2020','2020-04-07','2020','2020-01-23','2020-01-26',6280000,'2020-05-09 17:51:25','nelson','2020-05-10 16:23:23','Nova',0),
(7,30,8,'2020-01-12','2020-01-15',4,3,3,3,3,'196302121990031001',370000,1480000,0,265000,530000,2,351000,1053000,0,3063000,'2020-01-09','SPD-7/PW04/1/2020','Luar Kota',0,1,1,1,1,0,'2020-01-29','KUI-4/2020','2020-01-29','2020','2020-01-12','2020-01-15',2875000,'2020-05-10 09:14:25','gamadi','2020-05-10 15:27:26','Nova',0),
(8,30,8,'2020-01-12','2020-01-19',8,3,3,3,3,'198709232014021003',370000,2960000,0,262500,525000,2,0,0,0,3485000,'2020-01-09','SPD-8/PW04/1/2020','Luar Kota',0,1,1,1,1,0,'2020-01-29','KUI-05/2020','2020-01-29','2020','2020-01-12','2020-01-19',3297000,'2020-05-10 09:16:25','gamadi','2020-05-10 15:46:07','Nova',0),
(13,30,8,'2020-01-12','2020-01-19',8,3,3,3,3,'198801282009011001',370000,2960000,0,262500,525000,2,351000,2457000,0,5942000,'2020-01-09','SPD-9/PW04/1/2020','Luar Kota',0,1,1,1,1,0,'2020-01-29','KUI-06/2020','2020-01-29','2020','2020-01-12','2020-01-19',5754000,'2020-05-10 12:18:28','Rae','2020-05-10 15:54:02','Nova',0),
(14,30,13,'2020-01-12','2020-01-15',4,3,3,3,3,'196307101990031001',370000,1480000,0,100000,200000,2,500000,1500000,0,3180000,'2020-01-09','SPD-10/PW04/1/2020','Luar Kota',0,1,1,1,1,0,'2020-01-30','KUI-07/2020','2020-01-30','2020','2020-01-12','2020-01-15',3180000,'2020-05-10 13:53:59','Rae','2020-05-10 16:06:53','Nova',0),
(15,30,13,'2020-01-12','2020-01-19',8,3,3,3,3,'197310211999032001',370000,2960000,0,125000,250000,2,0,0,0,3210000,'2020-01-09','SPD-11/PW04/1/2020','Luar Kota',0,1,1,1,1,0,'2020-01-30','KUI-07/2020','2020-01-30','2020','2020-01-12','2020-01-19',3210000,'2020-05-10 13:54:56','Rae','2020-05-10 16:07:45','Nova',0),
(16,30,13,'2020-01-12','2020-01-19',8,3,3,3,3,'199008222012102001',370000,2960000,0,125000,250000,2,500000,3500000,0,6710000,'2020-01-09','SPD-12/PW04/1/2020','Luar Kota',0,1,1,1,1,0,'2020-01-30','KUI-09/2020','2020-01-30','2020','2020-01-12','2020-01-19',6710000,'2020-05-10 13:55:44','Rae','2020-05-10 16:09:17','Nova',0),
(17,30,14,'2020-01-16','2020-01-19',4,3,3,3,3,'197308131994021001',370000,1480000,0,175000,350000,2,338800,1016400,0,2846400,'2020-01-09','SPD-13/PW04/1/2020','Luar Kota',0,1,1,1,1,0,'2020-01-30','KUI-10/2020','2020-01-30','2020','2020-01-16','2020-01-19',2846400,'2020-05-10 14:17:35','reza','2020-05-10 16:13:44','Nova',0),
(18,30,14,'2020-01-12','2020-01-19',8,3,3,3,3,'196907201993031001',370000,2960000,0,175000,350000,2,338800,2371600,0,5681600,'2020-01-09','SPD-14/PW04/1/2020','Luar Kota',0,1,1,1,1,0,'2020-01-30','KUI-11/2020','2020-01-30','2020','2020-01-12','2020-01-19',5681600,'2020-05-10 14:18:55','reza','2020-05-10 16:15:23','Nova',0),
(19,30,14,'2020-01-12','2020-01-19',8,3,3,3,3,'199608272018011001',370000,2960000,0,175000,350000,2,0,0,0,3310000,'2020-01-09','SPD-15/PW04/1/2020','Luar Kota',0,1,1,1,1,0,'2020-01-30','KUI-12/2020','2020-01-30','2020','2020-01-12','2020-01-19',3310000,'2020-05-10 14:20:06','reza','2020-05-10 16:18:28','Nova',0),
(20,30,15,'2020-01-12','2020-01-14',3,3,3,3,3,'196309271985031001',370000,1110000,0,135000,270000,2,250000,500000,0,1880000,'2020-01-09','SPD-16/PW04/1/2020','Luar Kota',0,1,1,1,1,0,'2020-01-30','KUI-13/2020','2020-01-30','2020','2020-01-12','2020-01-14',1880000,'2020-05-10 14:42:14','armin','2020-05-10 16:19:22','Nova',0),
(21,30,15,'2020-01-12','2020-01-19',8,3,3,3,3,'197603121996012001',370000,2960000,0,135000,270000,2,225000,1575000,0,4805000,'2020-01-09','SPD-17/PW04/1/2020','Luar Kota',0,1,1,1,1,0,'2020-01-30','KUI-14/2020','2020-01-30','2020','2020-01-12','2020-01-19',4805000,'2020-05-10 14:43:54','armin','2020-05-10 16:20:41','Nova',0),
(22,30,15,'2020-01-12','2020-01-19',8,3,3,3,3,'196701061988031001',370000,2960000,0,135000,270000,2,225000,1575000,0,4805000,'2020-01-09','SPD-18/PW04/1/2020','Luar Kota',0,1,1,1,1,0,'2020-01-30',NULL,NULL,NULL,NULL,NULL,0,'2020-05-10 14:44:27','armin','2020-05-16 14:31:13','Nova',0),
(23,30,16,'2020-01-12','2020-01-15',4,3,3,3,3,'196911211990031002',370000,1480000,0,130000,260000,2,400000,1200000,0,2940000,'2020-01-09','SPD-19/PW04/1/2020','Luar Kota',0,1,1,1,1,0,'2020-01-28','KUI-17/2020','2020-01-28','2020','2020-01-12','2020-01-15',2940000,'2020-05-10 14:50:58','juwita','2020-05-10 16:25:08','Nova',0),
(24,30,16,'2020-01-12','2020-01-18',7,3,3,3,3,'197208241998032001',370000,2590000,0,130000,260000,2,350000,2100000,0,4950000,'2020-01-09','SPD-20/PW04/1/2020','Luar Kota',0,1,1,1,1,0,'2020-01-28','KUI-18/2020','2020-01-28','2020','2020-01-12','2020-01-18',4950000,'2020-05-10 14:51:48','juwita','2020-05-10 16:27:28','Nova',0),
(25,30,16,'2020-01-12','2020-01-18',7,3,3,3,3,'198601312014022002',370000,2590000,0,130000,260000,2,0,0,0,2850000,'2020-01-09','SPD-21/PW04/1/2020','Luar Kota',0,1,1,1,1,0,'2020-01-28','KUI-20/2020','2020-01-28','2020','2020-01-12','2020-01-18',2850000,'2020-05-10 14:52:15','juwita','2020-05-10 16:32:23','Nova',0),
(26,24,17,'2020-01-14','2020-01-18',5,3,3,3,3,'197001191994011001',370000,1850000,0,290000,580000,2,263250,1053000,0,3483000,NULL,NULL,NULL,0,0,0,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,0,'2020-05-10 15:06:50','ramadhani',NULL,NULL,0),
(27,24,17,'2020-01-14','2020-01-18',5,3,3,3,3,'197008171997032001',370000,1850000,0,290000,580000,2,351000,1404000,0,3834000,NULL,NULL,NULL,0,0,0,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,0,'2020-05-10 15:08:05','ramadhani',NULL,NULL,0),
(28,24,17,'2020-01-14','2020-01-18',5,3,3,3,3,'197310161998031001',370000,1850000,0,290000,580000,2,351000,1404000,0,3834000,NULL,NULL,NULL,0,0,0,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,0,'2020-05-10 15:08:50','ramadhani',NULL,NULL,0),
(29,0,19,'2020-01-12','2020-01-18',5,0,0,0,0,'196508061987031001',0,0,0,0,0,0,0,0,0,0,'2020-01-10','SPD-25/PW04/1/2020','Diklat',0,0,0,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,0,'2020-05-10 15:20:08','harman','2020-05-10 16:57:46','Nova',0),
(30,24,20,'2020-01-14','2020-01-18',5,3,3,3,3,'197001191994011001',370000,1850000,0,290000,580000,2,263250,1053000,0,3483000,'2020-01-10','SPD-22/PW04/1/2020','Luar Kota',0,1,1,1,1,0,'2020-01-31','KUI-21/2020','2020-01-31','2020','2020-01-14','2020-01-18',3295000,'2020-05-10 15:23:56','Rae','2020-05-10 16:51:15','Nova',0),
(31,24,20,'2020-01-14','2020-01-18',5,3,3,3,3,'197008171997032001',370000,1850000,0,290000,580000,2,351000,1404000,0,3834000,'2020-01-10','SPD-23/PW04/1/2020','Luar Kota',0,1,1,1,1,0,'2020-01-31','KUI-22/2020','2020-01-31','2020','2020-01-14','2020-01-18',3646000,'2020-05-10 15:24:29','Rae','2020-05-10 16:52:39','Nova',0),
(32,24,20,'2020-01-14','2020-01-18',5,3,3,3,3,'197310161998031001',370000,1850000,0,290000,580000,2,351000,1404000,0,3834000,'2020-01-10','SPD-24/PW04/1/2020','Luar Kota',0,1,1,1,1,0,'2020-01-31','KUI-23/2020','2020-01-31','2020','2020-01-14','2020-01-18',3646000,'2020-05-10 15:25:23','Rae','2020-05-10 16:52:56','Nova',0),
(33,5,21,'2020-01-15','2020-01-17',3,1,3,3,3,'197112201994031001',530000,1590000,0,1689057,3378114,2,550000,1100000,0,6068114,'2020-01-14','SPD-26/PW04/1/2020','Luar Kota',0,1,1,1,1,0,'2020-01-31','KUI-26/2020','2020-01-31','2020','2020-01-14','2020-01-16',5549114,'2020-05-10 15:56:40','aniska','2020-05-15 14:33:55','Nova',0),
(34,34,22,'2020-01-19','2020-01-21',3,1,3,3,3,'196510301993031001',530000,1590000,450000,1844922,3689844,2,0,0,0,5729844,'2020-01-17','SPD-27/PW04/1/2020','Luar Kota',0,1,1,1,1,0,'2020-01-31','KUI-27/2020','2020-01-31','2020','2020-01-19','2020-01-21',4461844,'2020-05-10 16:17:46','zulfaandri','2020-05-15 14:48:06','Nova',0),
(35,34,22,'2020-01-19','2020-01-21',3,1,3,3,3,'196601101986031002',530000,1590000,0,1500300,3000600,2,528750,1057500,0,5648100,'2020-01-17','SPD-28/PW04/1/2020','Luar Kota',0,1,1,1,1,0,'2020-01-31','KUI-28/2020','2020-01-31','2020','2020-01-19','2020-01-21',4948100,'2020-05-10 16:18:25','zulfaandri','2020-05-15 14:56:28','Nova',0),
(36,34,22,'2020-01-19','2020-01-21',3,1,3,3,3,'198610222014021002',530000,1590000,0,1500300,3000600,2,528750,1057500,0,5648100,'2020-01-17','SPD-29/PW04/1/2020','Luar Kota',0,1,1,1,1,0,'2020-01-31','KUI-29/2020','2020-01-31','2020','2020-01-19','2020-01-21',4948100,'2020-05-10 16:19:04','zulfaandri','2020-05-15 14:58:58','Nova',0),
(37,0,23,'2020-01-20','2020-01-24',5,0,0,0,0,'196209191993031001',0,0,0,0,0,0,0,0,0,0,'2020-01-17','SPD-30/PW04/1/2020','Luar Kota',0,0,0,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,0,'2020-05-10 17:02:38','devit','2020-05-16 10:08:36','Nova',0),
(38,0,23,'2020-01-20','2020-01-24',5,0,0,0,0,'198403302006021008',0,0,0,0,0,0,0,0,0,0,'2020-01-17','SPD-31/PW04/1/2020','Luar Kota',0,0,0,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,0,'2020-05-10 17:02:55','devit','2020-05-15 15:07:00','Nova',0),
(39,0,23,'2020-01-20','2020-01-24',5,0,0,0,0,'198902172012101001',0,0,0,0,0,0,0,0,0,0,'2020-01-17','SPD-32/PW04/1/2020','Luar Kota',0,0,0,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,0,'2020-05-10 17:03:19','devit','2020-05-15 15:07:32','Nova',0),
(40,0,24,'2020-01-21','2020-01-22',2,5,1,1,1,'197308131994021001',0,0,0,0,0,0,0,0,0,0,NULL,NULL,NULL,0,0,0,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,0,'2020-05-13 08:39:33','indra','2020-05-16 10:06:11','Nova',0),
(41,0,25,'2020-01-19','2020-01-25',5,0,0,0,0,'196611251993031001',0,0,0,0,0,0,0,0,0,0,NULL,NULL,NULL,0,0,0,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,0,'2020-05-13 09:01:30','indra',NULL,NULL,0),
(42,9,26,'2020-01-22','2020-01-24',3,3,3,3,3,'196006191991031001',370000,1110000,0,100000,200000,2,450000,900000,0,2210000,'2020-01-22','SPD-35/PW20/1/2020','Luar Kota',0,1,1,1,1,0,'2020-01-29',NULL,NULL,NULL,NULL,NULL,0,'2020-05-13 10:42:21','indra','2020-05-13 11:07:42','indra',0),
(43,9,26,'2020-01-22','2020-01-26',5,3,3,3,3,'196301291985031001',370000,1850000,0,100000,200000,2,450000,1800000,0,3850000,'2020-01-22','SPD-36/PW20/1/2020','Luar Kota',0,0,0,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,0,'2020-05-13 10:45:41','indra','2020-05-13 10:57:51','indra',0),
(44,9,26,'2020-01-22','2020-01-26',5,3,3,3,3,'198809162014021003',370000,1850000,0,100000,200000,2,0,0,0,2050000,'2020-01-22','SPD-37/PW20/2/2020','Luar Kota',0,0,0,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,0,'2020-05-13 10:46:15','indra','2020-05-13 10:59:03','indra',0),
(45,0,27,'2020-01-22','2020-01-23',2,0,0,0,0,'196302121990031001',0,0,0,0,0,0,0,0,0,0,NULL,NULL,NULL,0,0,0,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,0,'2020-05-13 11:45:18','indra',NULL,NULL,0),
(46,0,27,'2020-01-22','2020-01-23',2,0,0,0,0,'197001191994011001',0,0,0,0,0,0,0,0,0,0,NULL,NULL,NULL,0,0,0,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,0,'2020-05-13 11:45:31','indra',NULL,NULL,0),
(47,0,27,'2020-01-22','2020-01-23',2,0,0,0,0,'198903152014022005',0,0,0,0,0,0,0,0,0,0,NULL,NULL,NULL,0,0,0,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,0,'2020-05-13 11:45:43','indra',NULL,NULL,0),
(48,37,25,'2020-01-19','2020-01-25',5,1,1,1,1,'196501141986031001',0,0,0,1500000,1500000,1,0,0,0,1500000,NULL,NULL,NULL,0,0,0,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,0,'2020-05-16 13:58:56','Nova',NULL,NULL,0);

/*Table structure for table `cs_detail_kwitansi` */

DROP TABLE IF EXISTS `cs_detail_kwitansi`;

CREATE TABLE `cs_detail_kwitansi` (
  `iCsDetailId` int(11) DEFAULT NULL,
  `iJenis` tinyint(1) DEFAULT NULL,
  `nHari` int(4) NOT NULL DEFAULT '0',
  `nBiaya` bigint(20) NOT NULL DEFAULT '0',
  `nJumlah` bigint(20) NOT NULL DEFAULT '0',
  `vKeterangan` text NOT NULL,
  `vTransDari` varchar(30) DEFAULT NULL,
  `vTransTujuan` varchar(30) DEFAULT NULL,
  KEY `iCsDetailId` (`iCsDetailId`),
  KEY `iCsDetailId_2` (`iCsDetailId`,`iJenis`),
  KEY `iJenis` (`iJenis`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `cs_detail_kwitansi` */

insert  into `cs_detail_kwitansi`(`iCsDetailId`,`iJenis`,`nHari`,`nBiaya`,`nJumlah`,`vKeterangan`,`vTransDari`,`vTransTujuan`) values 
(5,1,2,410000,820000,'Uang Harian Biasa',NULL,NULL),
(5,1,2,130000,260000,'Uang Harian Fullboard',NULL,NULL),
(5,2,1,960000,960000,'',NULL,NULL),
(5,2,2,800000,1600000,'',NULL,NULL),
(5,4,0,0,3547200,'','Pekanbaru','Bangka Belitung'),
(6,1,2,410000,820000,'Uang Harian Biasa',NULL,NULL),
(6,1,2,130000,260000,'Uang Harian Fullboard',NULL,NULL),
(6,2,2,800000,1600000,'',NULL,NULL),
(6,2,0,0,0,'',NULL,NULL),
(6,4,0,0,3600000,'','Pekanbaru','Bangka Belitung'),
(7,1,4,370000,1480000,'',NULL,NULL),
(7,2,3,351000,1053000,'',NULL,NULL),
(7,4,0,0,342000,'','Pekanbaru','Selat Panjang'),
(8,1,8,370000,2960000,'',NULL,NULL),
(8,4,0,0,337000,'','Pekanbaru','Selat Panjang'),
(13,1,8,370000,2960000,'',NULL,NULL),
(13,2,7,351000,2457000,'',NULL,NULL),
(13,4,0,0,337000,'','Pekanbaru','Selat Panjang'),
(14,1,4,370000,1480000,'',NULL,NULL),
(14,2,3,500000,1500000,'',NULL,NULL),
(14,4,0,0,200000,'','Pekanbaru','Duri (Bengkalis)'),
(15,1,8,370000,2960000,'',NULL,NULL),
(15,4,0,0,250000,'','Pekanbaru','Duri (Bengkalis)'),
(16,1,8,370000,2960000,'',NULL,NULL),
(16,2,7,500000,3500000,'',NULL,NULL),
(16,4,0,0,250000,'','Pekanbaru','Duri (Bengkalis)'),
(17,1,4,370000,1480000,'',NULL,NULL),
(17,2,3,338800,1016400,'',NULL,NULL),
(17,4,0,0,350000,'','Pekanbaru','Bagansiapiapi'),
(18,1,8,370000,2960000,'',NULL,NULL),
(18,2,7,338800,2371600,'',NULL,NULL),
(18,4,0,0,350000,'','Pekanbaru','Bagansiapiapi'),
(19,1,8,370000,2960000,'',NULL,NULL),
(19,4,0,0,350000,'','Pekanbaru','Bagansiapiapi'),
(20,1,3,370000,1110000,'',NULL,NULL),
(20,2,2,250000,500000,'',NULL,NULL),
(20,4,0,0,270000,'','Pekanbaru','Teluk Kuantan'),
(21,1,8,370000,2960000,'',NULL,NULL),
(21,2,7,225000,1575000,'',NULL,NULL),
(21,4,0,0,270000,'','Pekanbaru','Teluk Kuantan'),
(23,1,4,370000,1480000,'',NULL,NULL),
(23,2,3,400000,1200000,'',NULL,NULL),
(23,4,0,0,260000,'','Pekanbaru','Rengat'),
(24,1,7,370000,2590000,'',NULL,NULL),
(24,2,6,350000,2100000,'',NULL,NULL),
(24,4,0,0,260000,'','Pekanbaru','Rengat'),
(25,1,7,370000,2590000,'',NULL,NULL),
(25,4,0,0,260000,'','Pekanbaru','Rengat'),
(30,1,5,370000,1850000,'',NULL,NULL),
(30,2,4,263250,1053000,'',NULL,NULL),
(30,4,0,0,392000,'','Pekanbaru','Selat Panjang'),
(31,1,5,370000,1850000,'',NULL,NULL),
(31,2,4,351000,1404000,'',NULL,NULL),
(31,4,0,0,392000,'','Pekanbaru','Selat Panjang'),
(32,1,5,370000,1850000,'',NULL,NULL),
(32,2,4,351000,1404000,'',NULL,NULL),
(32,4,0,0,392000,'','Pekanbaru','Selat Panjang'),
(33,1,3,530000,1590000,'',NULL,NULL),
(33,2,2,550000,1100000,'',NULL,NULL),
(33,4,0,0,2859114,'','Pekanbaru','Jakarta'),
(34,1,3,530000,1590000,'',NULL,NULL),
(34,3,3,150000,450000,'',NULL,NULL),
(34,4,0,0,2421844,'','Pekanbaru','Jakarta '),
(35,1,3,530000,1590000,'',NULL,NULL),
(35,2,2,528750,1057500,'',NULL,NULL),
(35,4,0,0,2300600,'','Pekanbaru','Jakarta'),
(36,1,3,530000,1590000,'',NULL,NULL),
(36,2,2,528750,1057500,'',NULL,NULL),
(36,4,0,0,2300600,'','Pekanbaru','Jakarta'),
(3,1,4,430000,1720000,'',NULL,NULL),
(3,2,2,350000,700000,'',NULL,NULL),
(3,4,0,0,5134100,'Tiket Pesawat (PP)','Pekanbaru','Makassar');

/*Table structure for table `cs_header` */

DROP TABLE IF EXISTS `cs_header`;

CREATE TABLE `cs_header` (
  `iCsId` int(11) NOT NULL AUTO_INCREMENT,
  `iStId` int(11) DEFAULT NULL,
  `dTanggalCS` date DEFAULT NULL,
  `vNomorCs` varchar(20) DEFAULT NULL,
  `dMasaStrat` date DEFAULT NULL,
  `dMasaEnd` date DEFAULT NULL,
  `nLama` int(11) DEFAULT NULL COMMENT 'lama',
  `iJenisPerDinas` tinyint(1) DEFAULT NULL,
  `vDari` varchar(30) DEFAULT NULL,
  `vTujuan` varchar(30) DEFAULT NULL,
  `tCreated` datetime DEFAULT NULL,
  `cCreatedby` varchar(20) DEFAULT NULL,
  `tUpdated` datetime DEFAULT NULL,
  `cUpdatedby` varchar(20) DEFAULT NULL,
  `lDeleted` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`iCsId`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=latin1;

/*Data for the table `cs_header` */

insert  into `cs_header`(`iCsId`,`iStId`,`dTanggalCS`,`vNomorCs`,`dMasaStrat`,`dMasaEnd`,`nLama`,`iJenisPerDinas`,`vDari`,`vTujuan`,`tCreated`,`cCreatedby`,`tUpdated`,`cUpdatedby`,`lDeleted`) values 
(3,1,'2020-01-06','CS-1/PW04/6/2020','2020-01-12','2020-01-15',4,3,'Pekanbaru','Tembilahan','2020-05-09 14:46:40','yulissa','2020-05-09 14:52:56','yulissa',0),
(4,2,'2020-01-07','CS-2/PW04/1/2020','2020-01-08','2020-01-11',4,1,'Pekanbaru','Makassar','2020-05-09 16:05:11','kemal','2020-05-09 16:27:04','kemal',0),
(6,3,'2020-05-08','CS-3/PW04/6/2020','2020-01-12','2020-01-18',7,3,'Pekanbaru','Banda Aceh','2020-05-09 17:01:12','idra','2020-05-09 17:08:50','idra',0),
(7,4,'2020-01-08','CS-4/PW04/5/2020','2020-01-23','2020-01-26',4,1,'Pekanbaru','Bangka Belitung','2020-05-09 17:41:59','nelson','2020-05-10 14:07:06','Rae',0),
(8,5,'2020-01-09','CS-5/PW04/3/2020','2020-01-09','2020-01-21',9,1,'Pekanbaru','Selat Panjang, Kabupaten Kepul','2020-05-10 09:06:51','gamadi','2020-05-10 12:19:26','Rae',0),
(13,10,'2020-01-09','CS-6/PW04/3/2020','2020-01-09','2020-01-21',9,1,'Pekanbaru','Bengkalis','2020-05-10 13:38:13','Rae','2020-05-10 13:55:52','Rae',0),
(14,11,'2020-01-09','CS-7/PW04/3/2020','2020-01-12','2020-01-19',8,1,'Pekanbaru','Bagansiapiapi','2020-05-10 14:15:33','reza','2020-05-10 14:20:43','reza',0),
(15,12,'2020-01-09','CS-8/PW04/3/2020','2020-01-09','2020-01-21',9,1,'Pekanbaru','Teluk Kuantan','2020-05-10 14:34:24','armin','2020-05-10 14:44:38','armin',0),
(16,13,'2020-01-09','CS-9/PW04/3/2020','2020-01-09','2020-01-21',9,1,'Pekanbaru','Rengat','2020-05-10 14:50:01','juwita','2020-05-10 14:52:30','juwita',0),
(19,15,'2020-01-10','CS-11/PW04/3/2020','2020-01-12','2020-01-18',7,3,'Pekanbaru','Bogor','2020-05-10 15:17:28','harman','2020-05-10 15:20:16','harman',0),
(20,14,'2020-01-10','CS-10/PW04/6/2020','2020-01-14','2020-01-18',5,1,'Pekanbaru','Selat Panjang','2020-05-10 15:23:25','Rae','2020-05-10 15:25:45','Rae',0),
(21,16,'2020-01-14','CS-12/PW04/1/2020','2020-01-15','2020-01-17',3,1,'Pekanbaru','Jakarta','2020-05-10 15:54:10','aniska','2020-05-10 15:58:02','aniska',0),
(22,17,'2020-01-17','CS-13/PW04/5/2020','2020-01-19','2020-01-21',3,1,'Pekanbaru','Jakarta','2020-05-10 16:16:38','zulfaandri','2020-05-10 16:29:06','zulfaandri',0),
(23,18,'2020-01-17','CS-14/PW04/2/2020','2020-01-20','2020-02-07',15,3,'Pekanbaru','Teluk Kuantan','2020-05-10 17:01:43','devit','2020-05-10 17:03:23','devit',0),
(24,19,'2020-01-20','CS-15/PW04/3/2020','2020-01-21','2020-01-22',2,1,'Pekanbaru','Teluk Kuantan','2020-05-16 09:23:53','Rae',NULL,NULL,0),
(25,2,'2020-05-16','CS-16/PW04/1/2020','2020-01-08','2020-01-14',4,2,'jakarta','medan','2020-05-16 13:58:25','Nova',NULL,NULL,0);

/*Table structure for table `dipa` */

DROP TABLE IF EXISTS `dipa`;

CREATE TABLE `dipa` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cTahun` char(4) DEFAULT NULL,
  `iBidangId` int(11) DEFAULT NULL,
  `cKodeDipa` varchar(150) DEFAULT NULL,
  `vNamaItem` varchar(200) DEFAULT NULL,
  `cKodeAccount` char(6) DEFAULT NULL,
  `iJenis` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0=>PKAU,1=>PKPT,2=>NON PKPT',
  `fJumlahAnggaran` bigint(20) DEFAULT NULL,
  `tCreated` datetime DEFAULT NULL,
  `cCreatedBy` varchar(20) DEFAULT NULL,
  `tUpdated` datetime DEFAULT NULL,
  `cUpdatedBy` varchar(20) DEFAULT NULL,
  `lDeleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `cTahun` (`cTahun`,`iBidangId`,`lDeleted`),
  KEY `iBidangId` (`iBidangId`),
  KEY `cTahun_2` (`cTahun`,`lDeleted`)
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=latin1;

/*Data for the table `dipa` */

insert  into `dipa`(`id`,`cTahun`,`iBidangId`,`cKodeDipa`,`vNamaItem`,`cKodeAccount`,`iJenis`,`fJumlahAnggaran`,`tCreated`,`cCreatedBy`,`tUpdated`,`cUpdatedBy`,`lDeleted`) values 
(1,'2020',6,'3701.004.004.056','Workshop/diseminasi/sosialisasi/koordinasi - 1','54211',1,34650000,'2020-05-03 15:02:14','Nova','2020-05-09 09:40:52','Nova',1),
(2,'2020',6,'3676.960.008.801.AA.524111','Layanan Perencanaan - Luar Kota','524111',0,20060000,'2020-05-09 09:51:41','Rae','2020-05-09 15:44:45','Rae',0),
(3,'2020',1,'3676.960.008.801.AB.524111','Layanan Keuangan - Luar Kota','524111',0,77463000,'2020-05-09 09:54:44','Rae','2020-05-09 10:23:39','Rae',0),
(4,'2020',1,'3676.960.008.801.AB.524113','Layanan Keuangan - Dalam Kota','524113',0,35100000,'2020-05-09 09:57:18','Rae','2020-05-09 10:23:19','Rae',0),
(5,'2020',1,'3676.960.008.801.AC.524111','Layanan SDM - Luar Kota','524111',0,45198000,'2020-05-09 10:01:41','Rae','2020-05-09 10:23:02','Rae',0),
(6,'2020',1,'3676.960.008.801.AE.524111','Layanan Umum - Luar Kota','524111',0,52080000,'2020-05-09 10:04:16','Rae','2020-05-09 10:21:26','Rae',0),
(7,'2020',1,'3676.994.008.002.BI.524111','Koordinasi Monitoring Kegiatan Pengawasan dan Dukungan Pengawasan - Luar Kota','524111',0,57792000,'2020-05-09 10:09:39','Rae','2020-05-09 10:17:29','Rae',0),
(8,'2020',1,'3676.994.008.002.BI.524119','Koordinasi Monitoring Kegiatan Pengawasan dan Dukungan Pengawasan - Fullboard','524119',0,20579000,'2020-05-09 10:15:01','Rae','2020-05-09 10:19:21','Rae',0),
(9,'2020',2,'3701.001.004.051.524111','Pengawasan Program Strategis K/L Bidang Perekonomian di daerah - Luar Kota','524111',1,59361000,'2020-05-09 10:28:43','Rae',NULL,NULL,0),
(10,'2020',2,'3701.001.004.051.524113','Pengawasan Program Strategis K/L Bidang Perekonomian di daerah - Dalam Kota','524113',1,29400000,'2020-05-09 10:29:47','Rae',NULL,NULL,0),
(11,'2020',2,'3701.002.004.051.524111','Pengawasan Program Prioritas Nasional K/L Bidang Perekonomian di daerah - Luar Kota','524111',1,25814000,'2020-05-09 10:32:46','Rae',NULL,NULL,0),
(12,'2020',2,'3701.002.004.051.524113','Pengawasan Program Prioritas Nasional K/L Bidang Perekonomian di daerah - Dalam Kota','524113',1,13200000,'2020-05-09 10:34:18','Rae',NULL,NULL,0),
(13,'2020',2,'3701.002.004.052.524111','Pengawasan Program Prioritas Nasional K/L Bidang Polhukam di daerah - Luar Kota','524111',1,57315000,'2020-05-09 10:36:10','Rae',NULL,NULL,0),
(14,'2020',2,'3701.002.004.052.524113','Pengawasan Program Prioritas Nasional K/L Bidang Polhukam di daerah	- Dalam Kota','524113',1,22650000,'2020-05-09 10:38:52','Rae',NULL,NULL,0),
(15,'2020',3,'3701.002.004.053.524111','Pengawasan Program Prioritas Nasional Lingkup Pemerintah Daerah - Luar Kota','524111',1,77327000,'2020-05-09 10:41:51','Rae',NULL,NULL,0),
(16,'2020',3,'3701.002.004.053.524113','Pengawasan Program Prioritas Nasional Lingkup Pemerintah Daerah - Dalam Kota','524113',1,40650000,'2020-05-09 10:43:20','Rae',NULL,NULL,0),
(17,'2020',3,'3701.002.004.053.524119','Pengawasan Program Prioritas Nasional Lingkup Pemerintah Daerah - Fullboard','524119',1,28645000,'2020-05-09 10:44:28','Rae',NULL,NULL,0),
(18,'2020',4,'3701.002.004.054.524111','Pengawasan Program Prioritas Nasional BUMN/BUMD - Luar Kota','524111',1,58541000,'2020-05-09 10:45:26','Rae',NULL,NULL,0),
(19,'2020',4,'3701.002.004.054.524113','Pengawasan Program Prioritas Nasional BUMN/BUMD - Dalam Kota','524113',1,35250000,'2020-05-09 10:46:33','Rae',NULL,NULL,0),
(20,'2020',5,'3701.002.004.055.524111','Pengawasan Keinvestigasian Program Prioritas Nasional K/L/P/BUMN/BUMD	- Luar Kota','524111',1,23998000,'2020-05-09 10:48:09','Rae',NULL,NULL,0),
(21,'2020',5,'3701.002.004.055.524113','Pengawasan Keinvestigasian Program Prioritas Nasional K/L/P/BUMN/BUMD - Dalam Kota','524113',1,12000000,'2020-05-09 10:49:11','Rae',NULL,NULL,0),
(22,'2020',3,'3701.003.004.053.524111','Pembinaan SPIP Lingkup Pemerintah Daerah - Luar Kota','524111',1,23132000,'2020-05-09 10:50:40','Rae',NULL,NULL,0),
(23,'2020',3,'3701.003.004.053.524113','Pembinaan SPIP Lingkup Pemerintah Daerah - Dalam Kota','524113',1,24300000,'2020-05-09 10:51:26','Rae',NULL,NULL,0),
(24,'2020',6,'3701.004.U04.056.524111','Pembinaan Kapabilitas APIP Pemerintah Daerah (SBK) - Luar Kota','524111',1,116961000,'2020-05-09 10:53:33','Rae',NULL,NULL,0),
(25,'2020',6,'3701.004.U04.056.524113','Pembinaan Kapabilitas APIP Pemerintah Daerah (SBK) - Dalam Kota','524113',1,6600000,'2020-05-09 10:54:26','Rae',NULL,NULL,0),
(26,'2020',6,'3701.004.U04.056.524119','Pembinaan Kapabilitas APIP Pemerintah Daerah (SBK) - Fullboard','524119',1,29289000,'2020-05-09 10:55:51','Rae',NULL,NULL,0),
(27,'2020',6,'3701.004.U04.057.524111','Pembinaan Kapabilitas APIP Pemda - Luar Kota','524111',1,6155000,'2020-05-09 10:57:23','Rae',NULL,NULL,0),
(28,'2020',2,'3701.006.004.051.524111','Pengawasan Akuntabilitas dan Tata Kelola Bidang Perekonomian - Luar Kota','524111',1,58774000,'2020-05-09 10:58:37','Rae',NULL,NULL,0),
(29,'2020',2,'3701.006.004.051.524113','Pengawasan Akuntabilitas dan Tata Kelola Bidang Perekonomian - Dalam Kota','524113',1,11850000,'2020-05-09 11:00:16','Rae','2020-05-09 11:00:35','Rae',0),
(30,'2020',3,'3701.006.004.053.524111','Pengawasan Akuntabilitas dan Tata Kelola Bidang Keuangan Daerah - Luar Kota','524111',1,102817000,'2020-05-09 11:01:54','Rae',NULL,NULL,0),
(31,'2020',3,'3701.006.004.053.524113','Pengawasan Akuntabilitas dan Tata Kelola Bidang Keuangan Daerah - Dalam Kota','524113',1,6150000,'2020-05-09 11:02:59','Rae',NULL,NULL,0),
(32,'2020',4,'3701.006.004.054.524111','Pengawasan Akuntabilitas dan Tata Kelola BUMN/D/BLU/D - Luar Kota','524111',1,11550000,'2020-05-09 11:04:08','Rae',NULL,NULL,0),
(33,'2020',4,'3701.006.004.054.524113','Pengawasan Akuntabilitas dan Tata Kelola BUMN/D/BLU/D - Dalam Kota','524113',1,13350000,'2020-05-09 11:04:58','Rae',NULL,NULL,0),
(34,'2020',5,'3701.006.004.055.524111','Pengawasan Akuntabilitas dan Tata Kelola Bidang Investigasi - Luar Kota','524111',1,54376000,'2020-05-09 11:06:14','Rae',NULL,NULL,0),
(35,'2020',5,'3701.006.004.055.524113','Pengawasan Akuntabilitas dan Tata Kelola Bidang Investigasi - Dalam kota','524113',1,450000,'2020-05-09 11:07:10','Rae',NULL,NULL,0),
(36,'2020',5,'3701.006.004.055.524119','Pengawasan Akuntabilitas dan Tata Kelola Bidang Investigasi	- Fullboard','524119',1,14204000,'2020-05-09 11:08:16','Rae',NULL,NULL,0),
(37,'2020',1,'3676.960.008.801.AA.524111 (TU PIMPINAN)','Pelaksanaan Kooordinasi dan Monitoring Kegiatan Dukungan Pengawasan dan Pengawasan, serta Rapat Kerja BPKP','524111',0,112029000,'2020-05-09 15:46:46','Rae',NULL,NULL,0);

/*Table structure for table `holyday` */

DROP TABLE IF EXISTS `holyday`;

CREATE TABLE `holyday` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `dDate` date DEFAULT NULL,
  `vKet` varchar(100) DEFAULT NULL,
  `ldeleted` tinyint(1) NOT NULL DEFAULT '0',
  `tCreated` datetime DEFAULT NULL,
  `cCreatedBy` char(10) DEFAULT NULL,
  `tUpdated` timestamp NULL DEFAULT NULL,
  `cUpdatedBy` char(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `holyday` */

insert  into `holyday`(`id`,`dDate`,`vKet`,`ldeleted`,`tCreated`,`cCreatedBy`,`tUpdated`,`cUpdatedBy`) values 
(2,'2020-03-06','Libur Tahun Baru',0,NULL,NULL,NULL,NULL);

/*Table structure for table `ms_account` */

DROP TABLE IF EXISTS `ms_account`;

CREATE TABLE `ms_account` (
  `cKodeAccount` char(6) DEFAULT NULL,
  `vUraian` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `ms_account` */

insert  into `ms_account`(`cKodeAccount`,`vUraian`) values 
('524111','Perjalanan Dinas Luar Kota'),
('524113','Perjalanan Dinas Dalam Kota'),
('524119','Perjalanan Dinas Full board');

/*Table structure for table `ms_bidang` */

DROP TABLE IF EXISTS `ms_bidang`;

CREATE TABLE `ms_bidang` (
  `iBidangId` int(11) NOT NULL AUTO_INCREMENT,
  `vNickName` varchar(20) DEFAULT NULL,
  `vBidangName` varchar(100) DEFAULT NULL,
  `iNomor` int(2) DEFAULT NULL COMMENT 'Nomor Bidang',
  `tCreated` datetime DEFAULT NULL,
  `cCreatedBy` varchar(20) DEFAULT NULL,
  `tUpdated` datetime DEFAULT NULL,
  `cUpdatedBy` varchar(20) DEFAULT NULL,
  `lDeleted` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0=>Acive,1=>Deleted',
  PRIMARY KEY (`iBidangId`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

/*Data for the table `ms_bidang` */

insert  into `ms_bidang`(`iBidangId`,`vNickName`,`vBidangName`,`iNomor`,`tCreated`,`cCreatedBy`,`tUpdated`,`cUpdatedBy`,`lDeleted`) values 
(1,'TATA USAHA','BAGIAN TATA USAHA',1,'2020-02-23 22:45:50','root',NULL,NULL,0),
(2,'IPP','INSTANSI PEMERINTAH PUSAT',2,'2020-02-23 22:46:03','root',NULL,NULL,0),
(3,'APD','AKUNTABILITAS PEMDA',3,'2020-02-23 22:46:12','root',NULL,NULL,0),
(4,'AN','AKUNTAN NEGARA',4,'2020-02-23 22:46:22','root',NULL,NULL,0),
(5,'INVESTIGASI','INVESTIGASI',5,'2020-02-23 22:46:39','root',NULL,NULL,0),
(6,'P3A','PROGRAM,PELAPORAN DAN PEMBINAAN APIP',6,'2020-02-23 22:46:55','root',NULL,NULL,0);

/*Table structure for table `ms_jabatan` */

DROP TABLE IF EXISTS `ms_jabatan`;

CREATE TABLE `ms_jabatan` (
  `iJabatanId` int(11) NOT NULL AUTO_INCREMENT,
  `vJabatanName` varchar(200) DEFAULT NULL,
  `tCreated` datetime DEFAULT NULL,
  `cCreatedBy` varchar(20) DEFAULT NULL,
  `tUpdated` datetime DEFAULT NULL,
  `cUpdatedBy` varchar(20) DEFAULT NULL,
  `lDeleted` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0=>Acive,1=>Deleted',
  PRIMARY KEY (`iJabatanId`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=latin1;

/*Data for the table `ms_jabatan` */

insert  into `ms_jabatan`(`iJabatanId`,`vJabatanName`,`tCreated`,`cCreatedBy`,`tUpdated`,`cUpdatedBy`,`lDeleted`) values 
(1,'Kepala Bagian Tata Usaha','2020-02-23 02:40:38','root',NULL,NULL,0),
(2,'Kepala Sub Bagian','2020-02-23 02:41:37','root','2020-05-03 14:22:00','root',0),
(3,'Korwas Bidang IPP','2020-05-03 13:22:47','root',NULL,NULL,0),
(4,'Pranata Komputer Pelaksana','2020-05-03 13:23:06','root',NULL,NULL,0),
(5,'Kepala Perwakilan ','2020-05-03 14:21:24','root',NULL,NULL,0),
(6,'Auditor Madya','2020-05-03 14:22:17','root',NULL,NULL,0),
(7,'Auditor Muda','2020-05-03 14:22:34','root',NULL,NULL,0),
(8,'Auditor Pertama','2020-05-03 14:22:57','root',NULL,NULL,0),
(9,'Auditor Penyelia','2020-05-03 14:23:12','root',NULL,NULL,0),
(10,'Auditor Pelaksana Lanjutan','2020-05-03 14:23:29','root',NULL,NULL,0),
(11,'Auditor Pelaksana','2020-05-03 14:23:42','root',NULL,NULL,0),
(12,'Arsiparis Muda','2020-05-03 14:24:15','root',NULL,NULL,0),
(13,'Arsiparis Pelaksana','2020-05-03 14:24:28','root',NULL,NULL,0),
(14,'Analis Kepegawaian Penyelia','2020-05-03 14:24:42','root',NULL,NULL,0),
(15,'Analis Kepegawaian Pelaksana Lanjutan','2020-05-03 14:24:59','root',NULL,NULL,0),
(16,'Analis Kepegawaian Pelaksana','2020-05-03 14:25:30','root',NULL,NULL,0),
(17,'Penyedia Layanan Informasi Kehumasan','2020-05-03 14:25:45','root',NULL,NULL,0),
(18,'Pengadministrasi Umum','2020-05-03 14:25:59','root',NULL,NULL,0),
(19,'Pengadministrasi Umum Tingkat I','2020-05-03 14:26:12','root',NULL,NULL,0),
(20,'Sekretaris Pimpinan Tingkat II','2020-05-03 14:26:28','root',NULL,NULL,0),
(21,'Pembuat Daftar Gaji / Tunjangan Kinerja','2020-05-03 14:26:42','root',NULL,NULL,0),
(22,'Bendahara Pengeluaran Tingkat II','2020-05-03 14:26:54','root',NULL,NULL,0),
(23,'Pengelola Sistem Akuntansi Instansi Tingkat II','2020-05-03 14:27:09','root',NULL,NULL,0),
(24,'Verifikatur Keuangan Tingkat II','2020-05-03 14:27:23','root',NULL,NULL,0),
(25,'Satuan Pengamanan Tingkat II','2020-05-03 14:27:35','root',NULL,NULL,0),
(26,'Pengelola Barang Milik Negara dan Barang Persediaan Tingkat II','2020-05-03 14:27:52','root','2020-05-03 14:30:49','root',0),
(27,'Pengelola Pelaksanaan Pengadaan Barang dan Jasa','2020-05-03 14:28:07','root',NULL,NULL,0),
(28,'Pengelola Barang Milik Negara dan Barang Persediaan Tingkat I','2020-05-03 14:28:24','root','2020-05-03 14:30:32','root',0),
(29,'Korwas Bidang APD','2020-05-10 14:56:05','root',NULL,NULL,0),
(30,'Korwas Bidang Akuntan Negara','2020-05-10 14:56:27','root',NULL,NULL,0),
(31,'Korwas Bidang Investigasi','2020-05-10 14:57:32','root',NULL,NULL,0),
(32,'Korwas Bidang P3A','2020-05-10 14:58:05','root',NULL,NULL,0);

/*Table structure for table `ms_pegawai` */

DROP TABLE IF EXISTS `ms_pegawai`;

CREATE TABLE `ms_pegawai` (
  `iPegawaiId` int(11) NOT NULL AUTO_INCREMENT,
  `vNip` varchar(30) DEFAULT NULL,
  `vName` varchar(50) DEFAULT NULL,
  `cSex` char(1) DEFAULT NULL,
  `vGelar` varchar(50) DEFAULT NULL,
  `iJabatanId` int(11) DEFAULT NULL,
  `cGolongan` varchar(10) DEFAULT NULL,
  `nGolTarif` varchar(50) DEFAULT NULL,
  `iBidangId` int(11) DEFAULT NULL,
  `iSubBidangId` int(11) DEFAULT NULL,
  `iPeran` tinyint(1) DEFAULT NULL COMMENT '1=>Admin,2=>Pegawai,3=>Kepala Bagian,4=>Sub Bagian,5=>Skretaris Bidang,6=>Kepala Perwakilan',
  `cUserId` varchar(20) DEFAULT NULL,
  `vPassword` varchar(50) DEFAULT NULL,
  `vImage` varchar(200) NOT NULL DEFAULT '""',
  `tCreated` datetime DEFAULT NULL,
  `cCreatedBy` varchar(20) DEFAULT NULL,
  `tUpdated` datetime DEFAULT NULL,
  `cUpdatedBy` varchar(20) DEFAULT NULL,
  `lDeleted` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0=>Acive,1=>Deleted',
  PRIMARY KEY (`iPegawaiId`),
  UNIQUE KEY `vNip` (`vNip`),
  KEY `cUserName_2` (`cUserId`,`vPassword`),
  KEY `iPeran` (`iPeran`),
  KEY `iBidangId` (`iBidangId`),
  KEY `iSubBidangId` (`iSubBidangId`),
  KEY `iJabatanId` (`iJabatanId`)
) ENGINE=InnoDB AUTO_INCREMENT=135 DEFAULT CHARSET=latin1;

/*Data for the table `ms_pegawai` */

insert  into `ms_pegawai`(`iPegawaiId`,`vNip`,`vName`,`cSex`,`vGelar`,`iJabatanId`,`cGolongan`,`nGolTarif`,`iBidangId`,`iSubBidangId`,`iPeran`,`cUserId`,`vPassword`,`vImage`,`tCreated`,`cCreatedBy`,`tUpdated`,`cUpdatedBy`,`lDeleted`) values 
(1,'199111042012122001','Nova Verayanti Saragih','P','S1',24,'III/a','E',1,2,1,'Nova','1234','user_5eae703c4d3e8.png','2020-02-24 14:45:54','root','2020-05-09 11:19:57','Nova',0),
(4,'196908011989031001','Farid Firman','L','S.E., M.Si.',5,'IV/b','C',1,1,6,'Farid','1234','','2020-05-03 14:35:37','nova','2020-05-10 15:11:42','Nova',0),
(5,'196606271988031001','Daridin','L','Ak., M.M.',1,'IV/b','D',1,3,3,'Daridin','1234','','2020-05-03 14:37:28','nova','2020-05-10 15:11:55','Nova',0),
(6,'196709221988031001','Petrus Ngorantutul','L',' S.E.',3,'IV/c','D',2,0,3,'petrus','1234','','2020-05-03 14:39:05','nova','2020-05-08 08:44:22','Nova',0),
(7,'196309271985031001','Sumirat','L','S.E.',3,'IV/c','D',3,0,3,'sumirat','1234','','2020-05-03 14:40:55','nova','2020-05-08 08:44:45','Nova',0),
(8,'196308311984021001','Lilik Sumarwanto','L','S.E.',3,'IV/c','D',4,0,3,'lilik','1234','','2020-05-03 14:43:08','nova','2020-05-08 08:45:06','Nova',0),
(9,'196601101986031002','IG. Setya Rudi Wiyana','L','Ak.',3,'IV/c','D',5,0,3,'setya','1234','','2020-05-03 14:47:38','Nova','2020-05-08 08:45:33','Nova',0),
(10,'196705131994031001','Idra Andayana','L','S.E.',3,'IV/b','D',6,0,3,'idra','1234','','2020-05-03 14:48:59','Nova','2020-05-08 08:45:51','Nova',0),
(11,'197112201994031001','Aniska Utama','L','S.E.',2,'III/d','E',1,3,3,'aniska','1234','','2020-05-03 14:50:34','Nova','2020-05-09 12:15:57','indra',0),
(12,'197706121998111001','Indra Kurniawan','L','Ak.',2,'III/d','E',1,2,1,'indra','1234','user_5eb606eaafc3a.JPG','2020-05-03 14:51:56','Nova','2020-05-09 12:17:58','indra',0),
(13,'196902281990031001','Evendy Sinaga','L','S.E.',2,'III/d','E',1,1,3,'','1234','','2020-05-03 14:53:43','Nova','2020-05-09 12:18:55','indra',0),
(14,'198910172015022003','Swenesia Yohana Aurora','P','S.E.',8,'III/b','E',6,0,2,'swenesia','1234','','2020-05-03 14:56:21','Nova','2020-05-09 12:19:51','indra',0),
(15,'197008171997032001','Maria Sinaga','P','S.E.',7,'III/d','E',6,0,2,'maria','1234','','2020-05-03 14:58:28','Nova','2020-05-09 12:20:20','indra',0),
(16,'196107081982031001','Yulissa Ananda','L','S.E.',6,'IV/c','D',6,0,2,'yulissa','1234','','2020-05-03 15:00:09','Nova','2020-05-09 12:20:46','indra',0),
(17,'199309162018012001','Santa Claudia Hutabarat','P','Amd',4,'II/c','C',6,0,2,'Santa','1234','','2020-05-03 15:04:51','Nova',NULL,NULL,0),
(18,'196006191991031001','Mukhlis','L','AK',6,'IV/c','D',2,0,2,'mukhlis','1234','','2020-05-08 11:47:02','Nova','2020-05-09 17:58:08','Nova',0),
(19,'196302121990031001','Yanerius','L','Ak',6,'IV/c','D',3,0,2,'yanerius','1234','','2020-05-08 11:50:32','Nova','2020-05-09 17:58:53','Nova',0),
(20,'196609021994032001','Warnita','P','SE',6,'IV/c','D',2,0,2,'warnita','1234','','2020-05-08 11:53:59','Nova','2020-05-09 17:57:27','Nova',0),
(21,'196207151983031001','Harsono','L','Ak',6,'IV/b','D',6,0,2,'harsono','1234','','2020-05-08 11:55:03','Nova','2020-05-09 17:59:42','Nova',0),
(22,'197210131993021002','Zulhanafi','L','Ak',6,'IV/a','D',4,0,2,'zulhanafi','1234','','2020-05-08 11:56:19','Nova','2020-05-09 18:00:10','Nova',0),
(23,'197001191994011001','Darhilman','L','Ak',6,'IV/a','D',6,0,2,'darhilman','1234','','2020-05-08 12:07:30','Nova','2020-05-09 18:00:38','Nova',0),
(24,'196508061987031001','Harman','L','Ak',6,'IV/b','D',3,0,2,'harman','1234','','2020-05-08 12:08:36','Nova','2020-05-09 18:01:06','Nova',0),
(25,'197009121991032001','Nurhandevi Saragih','P',' ',12,'III/d','E',6,0,2,'nurhandevi','1234','','2020-05-08 12:10:23','Nova','2020-05-09 18:01:52','Nova',0),
(26,'197308131994021001','Heri Purnama','L','Ak',6,'IV/a','D',3,0,2,'heripurnama','1234','','2020-05-08 12:19:29','Nova','2020-05-09 18:02:22','Nova',0),
(27,'196307101990031001','Zulheri','L','Drs',6,'IV/c','D',3,0,2,'zulheri','1234','','2020-05-08 12:21:03','Nova','2020-05-09 18:04:13','Nova',0),
(28,'196209191993031001','Sinar Sembiring','L','SE',6,'IV/b','D',2,0,2,'sinar','1234','','2020-05-08 12:34:12','Nova','2020-05-10 09:06:45','Nova',0),
(29,'196306051993031001','Syahrum','L','SE',6,'IV/a','D',2,0,2,'syahrum','1234','','2020-05-08 12:36:01','Nova','2020-05-10 09:07:51','Nova',0),
(30,'196208101985031001','Nelson Jati Hamonangan Sihite','L','SE',6,'IV/c','D',5,0,2,'nelson','1234','','2020-05-08 12:39:46','Nova','2020-05-10 09:08:20','Nova',0),
(31,'196210161991031001','Karuddin Purba','L','MM',6,'IV/c','D',5,0,2,'karuddin','1234','','2020-05-08 12:43:38','Nova','2020-05-10 09:09:05','Nova',0),
(32,'196808101993031002','Gusdiwal','L','SE',6,'IV/b','D',6,0,2,'gusdiwal','1234','','2020-05-08 12:45:37','Nova','2020-05-10 09:11:46','Nova',0),
(33,'196603151986031001','Dini Martisa Candra','L','Ak., MM',6,'IV/c','D',2,0,2,'dinimartisa','1234','','2020-05-08 12:48:46','Nova','2020-05-10 09:16:40','Nova',0),
(34,'196307221990031001','Sujito','L','MM',6,'IV/c','D',5,0,2,'sujito','1234','','2020-05-08 12:50:33','Nova','2020-05-10 09:18:51','Nova',0),
(35,'196011201982031001','Beny Amran','L','SE',6,'IV/c','D',2,0,2,'benyamran','1234','','2020-05-08 13:03:56','Nova','2020-05-10 09:19:31','Nova',0),
(36,'196606291987031001','Suprialdi','L','Ak',6,'IV/b','D',4,0,2,'suprialdi','1234','','2020-05-08 13:06:14','Nova','2020-05-10 09:20:16','Nova',0),
(37,'196911211990031002','Syahman Firdaus Tobing','L','Ak',6,'IV/a','D',3,0,2,'syahman','1234','','2020-05-08 13:09:10','Nova','2020-05-10 09:20:44','Nova',0),
(38,'196901081990031001','Arinal','L','SE',6,'IV/a','D',4,0,2,'arinal','1234','','2020-05-08 13:12:03','Nova','2020-05-10 09:21:28','Nova',0),
(39,'196603091992031001','Rizwan','L','Drs',6,'IV/c','D',2,0,2,'rizwan','1234','','2020-05-08 13:23:51','Nova','2020-05-10 09:23:37','Nova',0),
(40,'197502081998031001','Martogi Rumahorbo','L',' ',22,'III/b','E',1,2,2,'martogi','1234','','2020-05-08 13:28:24','Nova','2020-05-10 09:39:03','Nova',0),
(41,'196608191988032001','Gusritawati','P','-',14,'III/c','E',1,3,2,'gusritawati','1234','','2020-05-08 13:29:58','Nova','2020-05-10 09:24:39','Nova',0),
(42,'196607211990031001','Yul Adrian','L','-',19,'III/b','E',1,1,2,'yuladrian','1234','','2020-05-08 13:31:52','Nova','2020-05-10 09:25:38','Nova',0),
(43,'196611301988032001','Paramastuti','P','-',20,'III/b','E',1,1,2,'paramastuti','1234','','2020-05-08 13:34:30','Nova','2020-05-10 09:26:15','Nova',0),
(44,'196412291988032001','Zurianis','P',' ',19,'III/b','E',1,1,2,'zurianis','1234','','2020-05-08 13:38:07','Nova','2020-05-10 09:27:07','Nova',0),
(45,'196311121985032001','Jasmaniar','P',' ',19,'III/b','E',1,1,2,'jasmaniar','1234','','2020-05-08 13:39:42','Nova','2020-05-10 09:32:36','Nova',0),
(46,'196603311988032001','Suneti','P',' ',19,'III/b','D',1,1,2,'','1234','','2020-05-08 13:42:21','Nova','2020-05-10 09:38:17','Nova',0),
(47,'196404051988031001','Suryanto','L',' ',19,'III/b','E',1,1,2,'suryanto','1234','','2020-05-08 14:08:22','Nova','2020-05-10 09:37:24','Nova',0),
(48,'196309211986031001','Jan Piter','L',' ',27,'III/b','E',1,1,2,'janpiter','1234','','2020-05-08 14:13:12','Nova','2020-05-10 09:40:15','Nova',0),
(49,'196610121988031001','Syahrial','L',' ',19,'III/b','E',1,1,2,'syahrial','1234','','2020-05-08 14:38:15','Nova','2020-05-10 09:44:36','Nova',0),
(50,'196712051998031001','Alfianto','L',' ',23,'III/b','E',1,2,2,'alfianto','1234','','2020-05-08 14:39:18','Nova','2020-05-10 09:47:28','Nova',0),
(51,'196802121998031001','Yasni','L','-',27,'III B','E',1,1,2,'','1234','','2020-05-08 14:40:12','Nova',NULL,NULL,0),
(52,'198703062009112001','Isneni Vitry Haris','P','-',10,'III B','E',3,0,2,'','1234','','2020-05-08 14:42:19','Nova',NULL,NULL,0),
(53,'198912132012122002','Annisaa','P','-',23,'II D','F',1,2,1,'caca','1234','','2020-05-08 14:43:41','Nova','2020-05-09 14:30:57','Nova',0),
(54,'197512201998031001','Enriko','L','-',26,'III B','E',1,1,2,'','1234','','2020-05-08 14:49:23','Nova',NULL,NULL,0),
(55,'199103182012101001','Edwin Arawna SIanturi','L','-',10,'III A','E',2,0,2,'','1234','','2020-05-08 14:52:10','Nova',NULL,NULL,0),
(56,'199008222012102001','Nurafni Rosa Mahardhika','P','-',10,'III A','E',3,0,2,'','1234','','2020-05-08 14:53:14','Nova',NULL,NULL,0),
(57,'199310162019022005','Cristina Merliana Batubara','P','A.Md',26,'II C','F',1,1,2,'','1234','','2020-05-08 14:55:10','Nova',NULL,NULL,0),
(58,'199405112019021002','Ziddo Simanjuntak','L','A. Md',17,'II C','F',1,1,1,'ziddo','1234','','2020-05-08 14:56:59','Nova','2020-05-09 09:47:39','Nova',0),
(59,'196512031992032001','Irmayeni','P','-',21,'III C','E',1,2,2,'','1234','','2020-05-08 15:12:15','Nova',NULL,NULL,0),
(60,'196311011992032001','Emida','P','-',24,'III C','E',1,2,2,'','1234','','2020-05-08 15:13:41','Nova',NULL,NULL,0),
(61,'196606131993031001','Setiyono','L','-',15,'III B','E',1,3,2,'','1234','','2020-05-08 15:15:14','Nova',NULL,NULL,0),
(62,'199310062018012001','Rae Sitha Karina','P','-',23,'II C','F',1,2,1,'Rae','1234','','2020-05-08 15:26:07','Nova','2020-05-09 09:39:17','Nova',0),
(63,'199511252018012001','Salwa Hasanatunnisa','P','-',11,'II C','F',2,0,2,'','1234','','2020-05-08 15:28:24','Nova',NULL,NULL,0),
(64,'199603052018012001','Siti Roh Chayatun','P','-',11,'II C','F',3,0,2,'','1234','','2020-05-08 15:29:45','Nova',NULL,NULL,0),
(65,'199604262018011002','Fajri Adhia Putra','L','-',11,'II C','F',4,0,2,'','1234','','2020-05-08 15:48:55','Nova',NULL,NULL,0),
(66,'199605042018012001','Sitti Rahma','P','-',11,'II C','F',4,0,2,'','1234','','2020-05-08 15:50:08','Nova',NULL,NULL,0),
(67,'199608272018011001','Irfan Reza Putra','L','-',11,'II/c','F',3,0,2,'reza','81dc9bdb52d04dc20036dbd8313ed055','','2020-05-08 15:51:11','Nova','2020-05-10 14:09:47','Nova',0),
(68,'199401172019022001','Bulan Nauli Nasution','P','A.Md',11,'II C','F',6,0,2,'','1234','','2020-05-08 15:52:28','Nova',NULL,NULL,0),
(69,'199604112018122002','Krisna Santiatma','P','A.Md Ak',11,'II C','F',5,0,2,'','1234','','2020-05-08 15:53:40','Nova',NULL,NULL,0),
(70,'196904071988031001','Jumangin','L','-',18,'II D','F',1,1,2,'','1234','','2020-05-08 15:54:49','Nova',NULL,NULL,0),
(71,'196210011986031001','Kateni','L','-',25,'II B','F',1,1,2,'','1234','','2020-05-08 15:55:47','Nova',NULL,NULL,0),
(72,'199312312019022008','Maria Nathalya Christiany','P','A.Md',16,'II C','F',1,3,2,'','1234','','2020-05-08 15:57:13','Nova',NULL,NULL,0),
(73,'199506262019022004','Azra Aulia Ulfah','P','A.Md',13,'II C','F',1,1,2,'','1234','','2020-05-08 15:58:15','Nova',NULL,NULL,0),
(74,'199508062019022011','Agustina Christiany','P','A.Md',16,'II C','F',1,3,2,'','1234','','2020-05-08 15:59:16','Nova',NULL,NULL,0),
(75,'199308192019022005','Afrina Harahap','P','SE',8,'III A','E',3,0,2,'Afrina','1234','','2020-05-09 09:05:42','indra',NULL,NULL,0),
(76,'196411201988031001','Mangkarius','L','SE',12,'III D','E',1,1,2,'mangkarius','1234','','2020-05-09 09:07:25','indra',NULL,NULL,0),
(77,'198910032014021004','Yogi Hardika','L','-',8,'III B','E',5,0,2,'yogi','1234','','2020-05-09 09:08:53','indra',NULL,NULL,0),
(78,'198601122014022002','Endang Hadiyanti','P','-',8,'III B','E',6,0,2,'endang','1234','','2020-05-09 09:13:51','indra','2020-05-09 13:27:20','indra',0),
(79,'199211062018012002','Ella Novia Galin','P','-',8,'III A','E',5,0,2,'ella','1234','','2020-05-09 09:38:44','indra',NULL,NULL,0),
(80,'198901102010121001','Janson Yanda Hutauruk','L','-',8,'III A','E',2,0,2,'janson','1234','','2020-05-09 09:40:18','indra',NULL,NULL,0),
(81,'198706022009111001','Dony Pratomo','L','-',8,'III B','E',6,0,2,'doni','1234','','2020-05-09 09:41:22','indra',NULL,NULL,0),
(82,'199008182014022003','Saradhita Arumtaka','P','-',8,'III B','E',3,0,2,'saradhita','1234','','2020-05-09 09:42:36','indra',NULL,NULL,0),
(83,'198801282009011001','Gamadi Surya Putra','L','-',8,'III B','E',3,0,2,'gamadi','1234','','2020-05-09 09:44:01','indra',NULL,NULL,0),
(84,'198708272014022003','Intan Kemala Muktiningtyas','P','-',8,'III B','E',6,0,2,'intan','1234','','2020-05-09 09:45:43','indra',NULL,NULL,0),
(85,'197104031998031001','Anto Ompusunggu','L','-',9,'III D','E',5,0,2,'anto','1234','','2020-05-09 09:47:29','indra',NULL,NULL,0),
(86,'196701061988031001','Armin Tantia','L','-',9,'III D','E',3,0,2,'armin','1234','','2020-05-09 09:48:48','indra',NULL,NULL,0),
(87,'198705252014022004','Tiur Laurensia','P','-',8,'III B','E',2,0,2,'tiur','1234','','2020-05-09 09:51:04','indra',NULL,NULL,0),
(88,'196907201993031001','Marwan','L','-',9,'III D','E',3,0,2,'marwan','81dc9bdb52d04dc20036dbd8313ed055','','2020-05-09 09:54:55','indra','2020-05-10 14:10:06','Nova',0),
(89,'197004251993031001','Rusmansyah','L','-',9,'III D','E',2,0,2,'rusmansyah','1234','','2020-05-09 09:56:40','indra',NULL,NULL,0),
(90,'196204271987031001','Yusafrizon','L',' ',7,'III/d','E',2,0,2,'yusafrizon','1234','','2020-05-09 09:57:04','Nova',NULL,NULL,0),
(91,'197206111993021001','Edi Suroso','L','-',9,'III D','E',2,0,2,'edi','1234','','2020-05-09 09:58:01','indra',NULL,NULL,0),
(92,'196702021993032013','Jamilah','P',' ',9,'III D','E',5,0,2,'jamilah','1234','','2020-05-09 09:59:30','indra',NULL,NULL,0),
(93,'197208241998032001','Nelvia','P',' ',7,'III/d','E',3,0,2,'nelvia','1234','','2020-05-09 10:02:07','Nova',NULL,NULL,0),
(94,'197310211999032001','Rosmiyati','P',' ',7,'III/d','E',3,0,2,'rosmiyati','1234','','2020-05-09 10:04:47','Nova',NULL,NULL,0),
(95,'197404111999032001','Ria Gemala','P',' ',7,'III/d','E',4,0,2,'riagemala','1234','','2020-05-09 10:05:48','Nova',NULL,NULL,0),
(96,'196606101993031001','Apul Pandapotan Saragih','L',' ',7,'III/d','E',5,0,2,'apul','1234','','2020-05-09 10:06:50','Nova',NULL,NULL,0),
(97,'196602241999031001','Moh. Suharto','L',' ',7,'III/d','E',2,0,2,'suharto','1234','','2020-05-09 10:09:12','Nova',NULL,NULL,0),
(98,'197105201993021001','Sunarta','L',' ',7,'III/d','E',2,0,2,'sunarta','1234','','2020-05-09 10:10:27','Nova',NULL,NULL,0),
(99,'197310211998032001','Diah Okti Wahyuni','P',' ',7,'III/d','E',3,0,2,'diahokti','1234','','2020-05-09 10:11:56','Nova',NULL,NULL,0),
(100,'197603121996012001','Desi Fatimah','P',' ',7,'III/d','E',3,0,2,'desifatimah','1234','','2020-05-09 10:12:52','Nova',NULL,NULL,0),
(101,'196708231993032001','Mondang Rentama Simatupang','P',' ',9,'III/d','E',2,0,2,'mondang','1234','','2020-05-09 10:13:52','indra','2020-05-10 09:06:14','Nova',0),
(102,'196407061988032001','Yelly Efiza','P',' ',7,'III/d','E',4,0,2,'yellyefiza','1234','','2020-05-09 10:15:06','Nova',NULL,NULL,0),
(103,'196702031986031001','Auzrinur','L',' ',7,'III/d','E',2,0,2,'auzrinur','1234','','2020-05-09 10:17:49','Nova',NULL,NULL,0),
(104,'197310161998031001','Ramadhani','L','  ',7,'III/d','E',6,0,2,'ramadhani','1234','','2020-05-09 10:22:23','Nova',NULL,NULL,0),
(105,'196211191987121001','Rintar Mabue Lumban Tobing','L',' ',7,'III/d','E',2,0,2,'rintar','1234','','2020-05-09 10:25:36','Nova',NULL,NULL,0),
(106,'196611251993031001','Jonnesri','L',' ',7,'III/d','E',4,0,2,'jonnesri','1234','','2020-05-09 10:26:56','Nova',NULL,NULL,0),
(107,'198610222014021002','Zulfa Andri','L',' ',7,'III/c','E',5,0,2,'zulfaandri','1234','','2020-05-09 10:28:06','Nova',NULL,NULL,0),
(108,'197205211998031001','Bobby Simanjuntak','L',' ',9,'III D','E',4,0,2,'bobby','1234','','2020-05-09 10:28:12','indra',NULL,NULL,0),
(109,'198908112014021006','Hary Agus','L',' ',7,'III/c','E',6,0,2,'haryagus','1234','','2020-05-09 10:28:55','Nova',NULL,NULL,0),
(110,'196502061992021001','Firdaus Rusyad','L',' ',9,'III D','E',2,0,2,'firdaus','1234','','2020-05-09 10:29:15','indra',NULL,NULL,0),
(111,'198403302006021008','Guntur Yudo Hartono','L',' ',7,'II/c','E',2,0,2,'guntur','1234','','2020-05-09 10:29:39','Nova',NULL,NULL,0),
(112,'198601312014022002','Juwita Hari Yani Harahap','P','SE',8,'III B','E',3,0,2,'juwita','1234','','2020-05-09 10:30:55','indra',NULL,NULL,0),
(113,'196701091988031001','Dony Susanto','L',' ',9,'III/d','E',5,0,2,'donysusanto','1234','','2020-05-09 10:31:25','Nova','2020-05-09 10:38:54','Nova',0),
(114,'198903152014022005','Sri Rahayu','P','SE',8,'III B','E',3,0,2,'sri','1234','','2020-05-09 10:32:37','indra',NULL,NULL,0),
(115,'196301291985031001','Edward Tigor Halomoan Simatupang','L',' ',9,'III/d','E',3,0,2,'edward','1234','','2020-05-09 10:33:30','Nova',NULL,NULL,0),
(117,'196312191984021001','Muhammad Arifin Setianto','L',' ',9,'III.d','E',2,0,2,'arifin','1234','','2020-05-09 10:36:44','Nova',NULL,NULL,0),
(118,'198709232014021003','Ahmad Kosasih','L','SE',8,'III B','E',3,0,2,'ahmad','1234','','2020-05-09 10:38:59','indra',NULL,NULL,0),
(119,'198711292014021003','Kholid Mawardi','L',' ',8,'III/b','E',4,0,2,'kholid','1234','','2020-05-09 10:42:13','Nova',NULL,NULL,0),
(120,'198805012014022002','Rica Ramadhayani','P',' ',8,'III/b','E',6,0,2,'rica','1234','','2020-05-09 10:45:02','Nova',NULL,NULL,0),
(121,'198809162014021003','Bambang Yoga Prihartanto','L',' ',8,'III/b','E',2,0,2,'bambangyoga','1234','','2020-05-09 10:46:07','Nova',NULL,NULL,0),
(122,'199009162014021001','Angga Pardede','L',' ',8,'IIi/b','E',2,0,2,'angga','1234','','2020-05-09 10:46:56','Nova',NULL,NULL,0),
(123,'198707242014022003','Rakhma Yani','P',' ',8,'III/b','E',2,0,2,'rakhmayani','1234','','2020-05-09 10:47:50','Nova',NULL,NULL,0),
(124,'198901242014022002','Putri Muliani','P',' ',8,'III/b','E',4,0,2,'putrimuliani','1234','','2020-05-09 10:49:02','Nova',NULL,NULL,0),
(125,'198912102012101001','Ahmad Syarif','L',' ',8,'III/a','E',4,0,2,'ahmadsyarif','1234','','2020-05-09 10:50:03','Nova','2020-05-09 10:50:36','Nova',0),
(126,'199207052018012002','Diah Kartika Sari','P',' ',8,'III/a','E',2,0,2,'diah','1234','','2020-05-09 10:51:36','Nova','2020-05-09 13:29:42','indra',0),
(127,'199310122018012001','Neddy Sihombing','P',' ',8,'III/a','E',4,0,2,'neddy','1234','','2020-05-09 10:52:41','Nova',NULL,NULL,0),
(128,'199007102012101001','Henricus Ari Widayanto','L',' ',8,'III/a','E',5,0,2,'henricus','1234','','2020-05-09 10:53:34','Nova',NULL,NULL,0),
(129,'198902172012101001','Devit Tenta Pramana','L',' ',8,'III/a','E',2,0,2,'devit','1234','','2020-05-09 10:54:27','Nova',NULL,NULL,0),
(130,'198902232014021002','Machmud Sofyan Sauri Lubis','L',' ',8,'III/b','E',3,0,2,'sofyan','1234','','2020-05-09 10:55:47','Nova',NULL,NULL,0),
(131,'199001102015022003','Martha Simbolon','P',' ',8,'III/b','E',5,0,2,'martha','1234','','2020-05-09 10:57:51','Nova',NULL,NULL,0),
(132,'199603152018011004','Benny Tirta Putra','L',' ',13,'II C','F',2,0,2,'benny','1234','','2020-05-09 13:31:04','indra',NULL,NULL,0),
(133,'196501141986031001','Raden Kemal Ramdan','L',' ',1,'III/d','E',1,3,3,'kemal','1234','','2020-05-09 15:38:31','Nova',NULL,NULL,0),
(134,'196510301993031001','Ichsan Fuady','L',' ',5,'IV/c','C',1,3,2,'ichsan','1234','','2020-05-10 16:13:02','Nova',NULL,NULL,0);

/*Table structure for table `ms_sub_bidang` */

DROP TABLE IF EXISTS `ms_sub_bidang`;

CREATE TABLE `ms_sub_bidang` (
  `iSubBidangId` int(11) NOT NULL AUTO_INCREMENT,
  `iBidangId` int(11) DEFAULT NULL,
  `vSubBidangName` varchar(50) DEFAULT NULL,
  `tCreated` datetime DEFAULT NULL,
  `cCreatedBy` varchar(20) DEFAULT NULL,
  `tUpdated` datetime DEFAULT NULL,
  `cUpdatedBy` varchar(20) DEFAULT NULL,
  `lDeleted` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0=>Acive,1=>Deleted',
  PRIMARY KEY (`iSubBidangId`),
  KEY `iBidangId` (`iBidangId`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `ms_sub_bidang` */

insert  into `ms_sub_bidang`(`iSubBidangId`,`iBidangId`,`vSubBidangName`,`tCreated`,`cCreatedBy`,`tUpdated`,`cUpdatedBy`,`lDeleted`) values 
(1,1,'BAGIAN UMUM',NULL,NULL,NULL,NULL,0),
(2,1,'BAGIAN KEUANGAN',NULL,NULL,NULL,NULL,0),
(3,1,'BAGIAN KEPEGAWAIAN',NULL,NULL,NULL,NULL,0);

/*Table structure for table `rkt` */

DROP TABLE IF EXISTS `rkt`;

CREATE TABLE `rkt` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cTahun` char(4) DEFAULT NULL,
  `vUnitPelaksana` char(3) DEFAULT NULL,
  `iBidangId` int(11) DEFAULT NULL,
  `iDipaId` int(11) DEFAULT NULL,
  `cNomorRkt` varchar(20) DEFAULT NULL,
  `cKodeAccount` varchar(6) DEFAULT NULL,
  `cKodeRkt` varchar(20) DEFAULT NULL,
  `cNamaItem` varchar(200) DEFAULT NULL,
  `cKelompok` varchar(200) DEFAULT NULL,
  `iJenis` tinyint(1) DEFAULT NULL COMMENT '0=>PKAU,1=>PKPT,2=>NON PKPT',
  `iJumlahRencana` int(5) DEFAULT NULL,
  `fAnggaran` bigint(20) DEFAULT NULL,
  `tCreated` datetime DEFAULT NULL,
  `cCreatedBy` varchar(20) DEFAULT NULL,
  `tUpdated` datetime DEFAULT NULL,
  `cUpdatedBy` varchar(20) DEFAULT NULL,
  `lDeleted` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=78 DEFAULT CHARSET=latin1;

/*Data for the table `rkt` */

insert  into `rkt`(`id`,`cTahun`,`vUnitPelaksana`,`iBidangId`,`iDipaId`,`cNomorRkt`,`cKodeAccount`,`cKodeRkt`,`cNamaItem`,`cKelompok`,`iJenis`,`iJumlahRencana`,`fAnggaran`,`tCreated`,`cCreatedBy`,`tUpdated`,`cUpdatedBy`,`lDeleted`) values 
(2,'2020','204',2,11,'51880','524111','51880-524111','Evaluasi Lintas Sektoral Perbaikan Iklim Usaha dan Peningkatan Investasi 2020 pada Pemda A','kelompok kegiatan Instansi Pemerintah Pusat',2,10,4556300,'2020-05-09 11:10:17','Nova','2020-05-10 10:36:34','Nova',0),
(3,'2020','204',2,11,'51902','524111','51902-524111','Evaluasi lintas sektoral perbaikan iklim usaha dan peningkatan investasi 2020 pada Pemda B','kelompok kegiatan Instansi Pemerintah Pusat',2,10,5547500,'2020-05-09 11:23:21','Nova','2020-05-10 10:36:50','Nova',0),
(4,'2020','204',2,28,'56636','524111','56636-524111','Monitoring dan Evaluasi Program Prioritas Nasional (KSP) B12 2019','kelompok kegiatan Instansi Pemerintah Pusat',2,10,8110000,'2020-05-09 11:25:53','Nova','2020-05-10 10:37:01','Nova',0),
(5,'2020','204',2,29,'56636','524113','56636-524113','Monitoring dan Evaluasi Program Prioritas Nasional (KSP) B12 2019','kelompok kegiatan Instansi Pemerintah Pusat',2,10,3900000,'2020-05-09 11:26:57','Nova','2020-05-10 10:37:12','Nova',0),
(6,'2020','204',2,29,'56244','524113','56244-524113','Monitoring KPBU','kelompok kegiatan Instansi Pemerintah Pusat',2,10,7950000,'2020-05-09 11:29:41','Nova','2020-05-10 10:37:21','Nova',0),
(7,'2020','204',4,18,'48297','524111','48297-524111','Reviu Jalan Tol Ruas C Triwulan I','kelompok kegiatan Akuntan Negara',2,10,11270594,'2020-05-09 11:30:28','Rae','2020-05-10 10:37:33','Nova',0),
(8,'2020','204',2,28,'56264','524111','56264-524111','Audit atas Laporan Keuangan Third Water Supply and Sanitation for Low Income Communities Project (WSLIC-3)/ PAMSIMAS) (Loan ID 8578) - Provinsi','kelompok kegiatan Instansi Pemerintah Pusat',2,10,4966400,'2020-05-09 11:31:02','Nova','2020-05-10 10:37:44','Nova',0),
(9,'2020','204',2,28,'56268','524111','56268-524111','Audit atas Laporan Keuangan Third Water Supply and Sanitation for Low Income Communities Project (WSLIC-3)/ PAMSIMAS) (Loan ID 8578) - Kabupaten/Kota','kelompok kegiatan Instansi Pemerintah Pusat',2,10,17807200,'2020-05-09 11:32:05','Nova','2020-05-10 10:38:02','Nova',0),
(10,'2020','204',4,19,'48297','524113',' 48297-524113','Reviu Jalan Tol Ruas C Triwulan I','kelompok kegiatan Akuntan Negara',2,10,300000,'2020-05-09 11:40:09','Rae','2020-05-10 10:38:14','Nova',0),
(11,'2020','204',4,18,'48298','524111',' 48298-524111','Reviu Jalan Tol Ruas D Triwulan I','kelompok kegiatan Akuntan Negara',2,10,12220500,'2020-05-09 11:43:12','Rae','2020-05-10 10:38:29','Nova',0),
(12,'2020','204',4,33,'49135','524113',' 49135-524113','Bimtek/Asistensi pada BUMN di Provinsi Riau','kelompok kegiatan Akuntan Negara',2,10,8250000,'2020-05-09 11:45:50','Rae','2020-05-10 10:38:44','Nova',0),
(13,'2020','204',2,28,'56348','524111',' 56348-524111','Audit atas Laporan Keuangan Kota Tanpa Kumuh (KOTAKU) (IDB Loan IND- 174, 175, dan IND-176) - Provinsi','kelompok kegiatan Instansi Pemerintah Pusat',2,10,2490000,'2020-05-09 11:46:23','Nova','2020-05-10 10:38:58','Nova',0),
(14,'2020','204',2,28,'56495','524111',' 56495-524111','Audit atas Laporan Keuangan DOISP II IBRD 8711-IND & AIIB 000010','kelompok kegiatan Instansi Pemerintah Pusat',2,10,11010000,'2020-05-09 11:48:30','Nova','2020-05-10 10:39:12','Nova',0),
(15,'2020','204',2,13,'54798','524111',' 54798-524111','Verifikasi dan Evaluasi DLI PKH','kelompok kegiatan Instansi Pemerintah Pusat',2,10,9084906,'2020-05-09 11:50:42','Nova','2020-05-10 10:39:26','Nova',0),
(16,'2020','204',2,13,'54803','524111',' 54803-524111','Verifikasi dan Evaluasi DLI Stunting','kelompok kegiatan Instansi Pemerintah Pusat',2,10,2600094,'2020-05-09 11:51:31','Nova','2020-05-10 10:39:39','Nova',0),
(17,'2020','204',4,18,'48355','524111',' 48355-524111','Bimbingan Teknis Peningkatan Akuntabilitas Pengelolaan Keuangan BUM Desa dengan SIA BUMDesa pada Kabupaten A','kelompok kegiatan Akuntan Negara',2,10,15230000,'2020-05-09 11:52:24','Rae','2020-05-10 10:39:51','Nova',0),
(18,'2020','204',2,28,'56574','524111',' 56574-524111','Pemantauan Pelaksanaan SKD Pengadaan ASN Tahun 2019','kelompok kegiatan Instansi Pemerintah Pusat',2,10,8660000,'2020-05-09 11:53:11','Nova','2020-05-10 10:40:03','Nova',0),
(19,'2020','204',2,28,'56577','524111',' 56577-524111','Pemantauan Pelaksanaan SKB Pengadaan ASN Tahun 2019','kelompok kegiatan Instansi Pemerintah Pusat',2,10,5730000,'2020-05-09 11:53:57','Nova','2020-05-10 10:40:25','Nova',0),
(20,'2020','204',4,32,'48361','524111',' 48361-524111','Bimbingan Teknis Peningkatan Tata Kelola dan Kapabilitas SPI pada BLUD A','kelompok kegiatan Akuntan Negara',2,10,30909,'2020-05-09 11:54:38','Rae','2020-05-10 10:40:41','Nova',0),
(21,'2020','204',5,35,'52365','524113',' 52365-524113','Pemberian Keterangan Ahli-2020.1','kelompok kegiatan investigasi',2,10,450000,'2020-05-09 12:00:19','Nova','2020-05-10 10:40:58','Nova',0),
(22,'2020','204',5,34,'52414','524111',' 52414-524111','Audit Penghitungan Kerugian Keuangan Negara-2020.1','kelompok kegiatan investigasi',2,10,12660000,'2020-05-09 12:01:19','Nova','2020-05-10 10:41:19','Nova',0),
(23,'2020','204',4,33,'48361','524113',' 48361-524113','Bimbingan Teknis Peningkatan Tata Kelola dan Kapabilitas SPI pada BLUD A','kelompok kegiatan Akuntabilitas Pemda',2,10,2250000,'2020-05-09 12:01:25','Rae','2020-05-10 10:41:35','Nova',0),
(24,'2020','204',5,34,'52434','524111',' 52434-524111','Audit Penghitungan Kerugian Keuangan Negara-2020.2','kelompok kegiatan investigasi',2,10,3980000,'2020-05-09 12:02:11','Nova','2020-05-10 10:41:51','Nova',0),
(25,'2020','204',5,34,'52476','524111',' 52476-524111','Pemberian Keterangan Ahli-2020.7','kelompok kegiatan investigasi',2,10,2404894,'2020-05-09 12:03:03','Nova','2020-05-10 10:42:04','Nova',0),
(26,'2020','204',4,32,'48362','524111',' 48362-524111','Bimbingan Teknis Implementasi SIA BLUD pada BLUD A','kelompok kegiatan Akuntan Negara',2,10,11519091,'2020-05-09 12:03:28','Rae','2020-05-10 10:42:18','Nova',0),
(27,'2020','204',5,34,'52486','524111',' 52486-524111','Pemberian Keterangan Ahli-2020.8','kelompok kegiatan investigasi',2,10,5820000,'2020-05-09 12:04:25','Nova','2020-05-10 10:42:31','Nova',0),
(28,'2020','204',4,33,'48362','524113',' ','Bimbingan Teknis Implementasi SIA BLUD pada BLUD A','kelompok kegiatan Akuntan Negara',2,10,2250000,'2020-05-09 12:04:33','Rae','2020-05-09 12:37:42','Rae',1),
(29,'2020','204',5,34,'52560','524111',' 52560-524111','Audit Penyesuaian Harga 2020.1','kelompok kegiatan investigasi',2,10,6230200,'2020-05-09 12:05:23','Nova','2020-05-10 10:42:46','Nova',0),
(30,'2020','204',5,34,'52591','524111',' 52591-524111','Pemberian Keterangan Ahli-2020.9 pada BUMN/D-1','kelompok kegiatan investigasi',2,10,5820000,'2020-05-09 12:06:06','Nova','2020-05-10 10:42:59','Nova',0),
(31,'2020','204',4,33,'48363','524113',' ','Evaluasi Kinerja BUMD yang Mendukung Pembangunan Prioritas Nasional Tahun Buku 2019 pada BUMD A','kelompok kegiatan Akuntan Negara',2,10,2250000,'2020-05-09 12:06:50','Rae','2020-05-09 12:38:15','Rae',1),
(32,'2020','204',5,34,'52604','524111',' 52604-524111','Pemberian Keterangan Ahli-2020.10 pada BUMN/D-2','kelompok kegiatan investigasi',2,10,5820000,'2020-05-09 12:06:55','Nova','2020-05-10 10:43:12','Nova',0),
(33,'2020','204',5,34,'52610','524111',' 52610-524111','Pemberian Keterangan Ahli-2020.11','kelompok kegiatan investigasi',2,10,5820000,'2020-05-09 12:08:18','Nova','2020-05-10 10:43:27','Nova',0),
(34,'2020','204',5,34,'52613','524111',' 52613-524111','Pemberian Keterangan Ahli-2020.12','kelompok kegiatan investigasi',2,10,5820000,'2020-05-09 12:08:53','Nova','2020-05-10 10:43:40','Nova',0),
(35,'2020','204',4,33,'48364','524113',' ','Bimbingan Teknis Penerapan Manajemen Risiko dan Sistem Pengendalian Intern pada BLU/BLUD A','kelompok kegiatan Akuntan Negara',2,10,2100000,'2020-05-09 12:09:01','Rae','2020-05-09 12:38:41','Rae',1),
(36,'2020','204',5,36,'54398','524119',' 54398-524119','Forum  Masyarakat Pembelajar Anti Korupsi 2020.1','kelompok kegiatan investigasi',2,10,14204000,'2020-05-09 12:09:45','Nova','2020-05-10 10:43:56','Nova',0),
(37,'2020','204',3,30,'52690','524111',' 52690-524111','Bimkon Implementasi/aplikasi SIMDA E-government  terintegrasi pada Pemda A','kelompok kegiatan Akuntabilitas Pemda',2,10,7159687,'2020-05-09 12:12:45','Nova','2020-05-10 10:44:14','Nova',0),
(38,'2020','204',4,33,'48367','524113',' 48367-524113','Evaluasi/Diagnostic Assesmen GCG pada BUMD A','kelompok kegiatan Akuntan Negara',2,10,600000,'2020-05-09 12:13:23','Rae','2020-05-10 10:44:30','Nova',0),
(39,'2020','204',3,30,'52694','524111',' 52694-524111','Bimkon Implementasi/aplikasi SIMDA E-government  terintegrasi pada Pemda B','kelompok kegiatan Akuntabilitas Pemda',2,10,11440000,'2020-05-09 12:14:09','Nova','2020-05-10 10:44:45','Nova',0),
(40,'2020','204',3,30,'52697','524111',' 52697-524111','Bimkon Implementasi/aplikasi SIMDA E-government  terintegrasi pada Pemda C','kelompok kegiatan Akuntabilitas Pemda',2,10,6000000,'2020-05-09 12:16:23','Nova','2020-05-10 10:45:01','Nova',0),
(41,'2020','204',3,30,'52708','524111',' 52708-524111','Bimtek/Asistensi Reviu LKPD','kelompok kegiatan Akuntabilitas Pemda',2,10,3410000,'2020-05-09 12:17:46','Nova','2020-05-10 10:45:16','Nova',0),
(42,'2020','204',3,30,'52710','524111',' 52710-524111','Bimtek/Asistensi/Fasilitasi Pengelolaan Anggaran Pemda Triwulan IV Tahun 2019','kelompok kegiatan Akuntabilitas Pemda',2,10,9219000,'2020-05-09 12:19:18','Nova','2020-05-10 10:45:35','Nova',0),
(43,'2020','204',3,30,'52713','524111','  52713-524111','Bimtek/Asistensi/Fasilitasi Pengelolaan Anggaran Pemda Triwulan II Tahun 2020','kelompok kegiatan Akuntabilitas Pemda',2,10,5930000,'2020-05-09 12:21:48','Nova','2020-05-10 10:45:54','Nova',0),
(44,'2020','204',3,15,'54793','524111',' 54793-524111','Audit Kinerja Pelayanan Pemerintah Daerah (AKPPD) Bidang Layanan Administrasi Kependudukan','kelompok kegiatan Akuntabilitas Pemda',2,10,1980000,'2020-05-09 12:23:06','Nova','2020-05-10 10:46:11','Nova',0),
(45,'2020','204',3,15,'54813','524111',' 54813-524111','Audit Kinerja Pelayanan Pemerintah Daerah (AKPPD) Bidang Pendidikan','kelompok kegiatan Akuntabilitas Pemda',2,10,28704600,'2020-05-09 12:28:07','Nova','2020-05-10 10:46:39','Nova',0),
(46,'2020','204',3,15,'54714','524111',' 54714-524111','Penyusunan Laporan Hasil Analisis Program Prioritas Nasional dalam APBD TA 2019 Tingkat Provinsi','kelompok kegiatan Akuntabilitas Pemda',2,10,14250736,'2020-05-09 12:36:26','Nova','2020-05-10 10:46:54','Nova',0),
(47,'2020','204',3,16,'54714','524113',' 54714-524113','Penyusunan Laporan Hasil Analisis Program Prioritas Nasional dalam APBD TA 2019 Tingkat Provinsi','kelompok kegiatan Akuntabilitas Pemda',2,10,750000,'2020-05-09 12:38:03','Nova','2020-05-10 10:47:09','Nova',0),
(48,'2020','204',3,15,'54727','524111',' 54727-524111','Penyusunan Laporan Hasil Analisis Program Prioritas Nasional dalam APBD TA 2019 Tingkat Provinsi (2)','kelompok kegiatan Akuntabilitas Pemda',2,10,12292456,'2020-05-09 12:39:15','Nova','2020-05-10 10:47:23','Nova',0),
(49,'2020','204',6,26,'47955','524119',' 47955-524119','Workshop/Diseminasi/Sosialisasi/Koordinasi - 1','Pelaporan dan Pembinaan APIP',2,10,29288600,'2020-05-09 12:45:16','Rae','2020-05-10 10:47:41','Nova',0),
(50,'2020','204',3,30,'54826','524111',' 54826-524111','Evaluasi Penyaluran dan Penggunaan Dana Desa TW IV 2019 Desa A, Pemda 1','kelompok kegiatan Akuntabilitas Pemda',2,10,11234250,'2020-05-09 12:45:57','Nova','2020-05-10 10:47:53','Nova',0),
(51,'2020','204',3,31,'54826','524113',' 54826-524113','Evaluasi Penyaluran dan Penggunaan Dana Desa TW IV 2019 Desa A, Pemda 1','kelompok kegiatan Akuntabilitas Pemda',2,10,6150000,'2020-05-09 12:48:40','Nova','2020-05-10 10:48:07','Nova',0),
(52,'2020','204',3,30,'54833','524111',' 54833-524111','Evaluasi Penyaluran dan Penggunaan Dana Desa TW IV 2019 Desa B Pemda 1','kelompok kegiatan Akuntabilitas Pemda',2,10,11234250,'2020-05-09 12:49:30','Nova','2020-05-10 10:48:21','Nova',0),
(53,'2020','204',6,24,'47968','524111',' 47968-524111','Bimbingan Teknis Kapabilitas APIP Level 3 - 1','Pelaporan dan Pembinaan APIP',2,10,11151000,'2020-05-09 12:49:34','Rae','2020-05-10 10:48:35','Nova',0),
(54,'2020','204',3,30,'54840','524111',' 54840-524111','Evaluasi Penyaluran dan Penggunaan Dana Desa TW IV 2019 Desa C Pemda 1','kelompok kegiatan Akuntabilitas Pemda',2,10,11234250,'2020-05-09 12:50:28','Nova','2020-05-10 10:48:52','Nova',0),
(55,'2020','204',6,24,'47979','524111',' 47979-524111','Bimbingan Teknis Kapabilitas APIP Level 3 - 2','Pelaporan dan Pembinaan APIP',2,10,13940000,'2020-05-09 12:50:48','Rae','2020-05-10 10:49:16','Nova',0),
(56,'2020','204',3,30,'54844','524111',' 54844-524111','Evaluasi Penyaluran dan Penggunaan Dana Desa TW IV 2019 Desa D Pemda 1','kelompok kegiatan Akuntabilitas Pemda',2,10,11234250,'2020-05-09 12:51:15','Nova','2020-05-10 10:24:12','Rae',0),
(57,'2020','204',6,24,'47983','524111',' 47983-524111','Bimbingan Teknis Kapabilitas APIP Level 3 - 3','Pelaporan dan Pembinaan APIP',2,10,6091000,'2020-05-09 12:51:58','Rae','2020-05-10 10:50:22','Nova',0),
(58,'2020','204',6,24,'47988','524111',' 47988-524111','Bimbingan Teknis Kapabilitas APIP Level 3 - 4','Pelaporan dan Pembinaan APIP',2,10,13950000,'2020-05-09 12:53:00','Rae','2020-05-10 10:50:36','Nova',0),
(59,'2020','204',6,24,'47993','524111',' 47993-524111','Bimbingan Teknis Kapabilitas APIP Level 3 - 5','Pelaporan dan Pembinaan APIP',2,10,15520000,'2020-05-09 12:55:02','Rae','2020-05-10 10:50:49','Nova',0),
(60,'2020','204',6,24,'48054','524111',' 48054-524111','Bimbingan Teknis Kapabilitas APIP Level 3 - 6','Pelaporan dan Pembinaan APIP',2,10,14055000,'2020-05-09 12:57:00','Rae','2020-05-10 10:51:01','Nova',0),
(61,'2020','204',6,24,'48066','524111',' 48066-524111','Quality Assurance atas Hasil Self Assesment Kapabilitas APIP 6','Pelaporan dan Pembinaan APIP',2,10,16470000,'2020-05-09 12:59:19','Rae','2020-05-10 10:51:17','Nova',0),
(62,'2020','204',6,27,'48118','524111',' 48118-524111','Peningkatan Kompetensi SDM APIP 1','Pelaporan dan Pembinaan APIP',2,10,6154300,'2020-05-09 13:01:19','Rae','2020-05-10 10:51:30','Nova',0),
(63,'2020','204',6,24,'48147','524111',' 48147-524111','Bimbingan Teknis Kapabilitas APIP Level 3 - 8','Pelaporan dan Pembinaan APIP',2,10,12360000,'2020-05-09 13:02:45','Rae','2020-05-10 10:51:43','Nova',0),
(64,'2020','204',6,24,'48152','524111',' 48152-524111','Bimbingan Teknis Audit Kinerja APIP 1','Pelaporan dan Pembinaan APIP',2,10,10024729,'2020-05-09 14:11:18','Rae','2020-05-10 10:51:56','Nova',0),
(65,'2020','204',3,30,'54848','524111',' 54848-524111','Evaluasi Penyaluran dan Penggunaan Dana Desa TW IV 2019 Desa E Pemda 1','kelompok kegiatan Akuntabilitas Pemda',2,10,10995750,'2020-05-09 14:28:37','Nova','2020-05-10 10:52:09','Nova',0),
(66,'2020','204',3,30,'54853','524111',' 54853-524111','Evaluasi Penyaluran dan Penggunaan Dana Desa TW I 2020 Desa F Pemda 1','kelompok kegiatan Akuntabilitas Pemda',2,10,3725250,'2020-05-09 14:32:13','Nova','2020-05-10 10:21:07','Rae',0),
(67,'2020','204',3,22,'55134','524111',' 55134-524111','Bimbingan Teknis Penilaian Maturitas SPIP Terhadap Pemerintah Daerah A','kelompok kegiatan Akuntabilitas Pemda',2,10,11641600,'2020-05-09 14:35:09','Nova','2020-05-10 10:52:28','Nova',0),
(68,'2020','204',3,22,'55141','524111',' 55141-524111','Bimbingan Teknis Penilaian Maturitas SPIP Terhadap Pemerintah Daerah B','kelompok kegiatan Akuntabilitas Pemda',2,10,11490000,'2020-05-09 14:36:07','Nova','2020-05-10 10:52:47','Nova',0),
(69,'2020','204',1,3,'1','524111',' 1-524111','Layanan Keuangan','Kelompok kegiatan Sub Bagian Keuangan',0,50,77463000,'2020-05-09 15:56:04','Nova','2020-05-10 10:53:03','Nova',0),
(70,'2020','204',1,37,'2','524111',' 2-524111','Penyusunan Koordinasi dan Monitoring Kegiatan Dukungan Pengawasan dan Pengawasan serta Rapat Kerja BPKP','Kelompok kegiatan Tatausaha',0,50,112029000,'2020-05-09 15:57:19','Nova','2020-05-10 10:53:18','Nova',0),
(71,'2020','204',1,4,'3','524113',' 3-524113','Layanan Keuangan','Kelompok kegiatan Sub Bagian Keuangan',0,100,35100000,'2020-05-09 15:58:30','Nova','2020-05-10 10:53:30','Nova',0),
(72,'2020','204',1,5,'4','524111',' 4-524111','Layanan SDM','Kelompok kegiatan Sub Bagian Kepegawaian',0,10,45198000,'2020-05-09 16:01:34','Nova','2020-05-10 10:53:43','Nova',0),
(73,'2020','204',1,6,'5','524111',' 5-524111','Layanan Umum','Kelompok Bagian sub Bagian Umum',0,10,52080000,'2020-05-09 16:02:37','Nova','2020-05-10 10:53:55','Nova',0),
(74,'2020','204',1,7,'6','524111',' 6-524111','Koordinasi Mpnitoring Kegiatan Pengawasan dan Dukungan Pengawasan','Kelompok kegiatan Tatausaha',0,10,57792000,'2020-05-09 16:04:12','Nova','2020-05-10 10:54:10','Nova',0),
(75,'2020','204',1,8,'7','524119',' 7-524119','Koordinasi Monitoring Kegiatan Pengawasan dan Dukungan Pengawasan','Kelompok kegiatan Tatausaha',0,10,20579000,'2020-05-09 16:05:27','Nova','2020-05-10 10:50:04','Nova',0),
(76,'2020','204',2,9,'56636','524111','56636','Pengawasan atas Kegiatan Prioritas Nasional Pantauan KSP','kelompok kegiatan Instansi Pemerintah Pusat',2,1,8110000,'2020-05-13 10:33:07','indra',NULL,NULL,0),
(77,'2020','204',2,10,'56636','524113','56636','Pengawasan atas Kegiatan Prioritas Nasional Pantauan KSP','kelompok kegiatan Instansi Pemerintah Pusat',2,1,3900000,'2020-05-13 12:38:32','indra',NULL,NULL,0);

/*Table structure for table `st_detail_rkt` */

DROP TABLE IF EXISTS `st_detail_rkt`;

CREATE TABLE `st_detail_rkt` (
  `iStId` int(11) DEFAULT NULL,
  `iRktId` int(11) DEFAULT NULL,
  `nValueAju` bigint(20) DEFAULT NULL COMMENT 'Nilai Pengajuan',
  `nRealisasi` bigint(20) DEFAULT NULL,
  `nValue` bigint(20) DEFAULT NULL COMMENT 'Nilai Realisasi',
  `tCreated` datetime DEFAULT NULL,
  `cCreatedby` varchar(20) DEFAULT NULL,
  `tUpdated` datetime DEFAULT NULL,
  `cUpdatedby` varchar(20) DEFAULT NULL,
  `lDeleted` tinyint(1) NOT NULL DEFAULT '0',
  KEY `iStId` (`iStId`,`iRktId`),
  KEY `iRktId` (`iRktId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `st_detail_rkt` */

insert  into `st_detail_rkt`(`iStId`,`iRktId`,`nValueAju`,`nRealisasi`,`nValue`,`tCreated`,`cCreatedby`,`tUpdated`,`cUpdatedby`,`lDeleted`) values 
(10,50,11234250,NULL,11234250,'2020-05-10 13:56:47','Rae',NULL,NULL,0),
(10,66,1865750,NULL,1865750,'2020-05-10 13:56:47','Rae',NULL,NULL,0),
(4,36,14203200,NULL,14203200,'2020-05-10 14:07:14','Rae',NULL,NULL,0),
(5,56,11234250,NULL,11234250,'2020-05-10 14:08:50','Rae',NULL,NULL,0),
(5,66,1255750,NULL,1255750,'2020-05-10 14:08:50','Rae',NULL,NULL,0),
(11,54,11234250,NULL,11234250,'2020-05-10 14:21:24','reza',NULL,NULL,0),
(11,66,603750,NULL,603750,'2020-05-10 14:21:24','reza',NULL,NULL,0),
(12,52,11234250,NULL,11234250,'2020-05-10 14:44:49','armin',NULL,NULL,0),
(12,65,255750,NULL,255750,'2020-05-10 14:44:49','armin',NULL,NULL,0),
(13,65,10740000,NULL,10740000,'2020-05-10 14:52:40','juwita',NULL,NULL,0),
(14,53,11151000,NULL,11151000,'2020-05-10 15:25:56','Rae',NULL,NULL,0),
(16,72,6068114,NULL,6068114,'2020-05-10 15:52:41','aniska',NULL,NULL,0),
(17,27,5386044,NULL,5386044,'2020-05-10 16:29:16','zulfaandri',NULL,NULL,0),
(17,33,5820000,NULL,5820000,'2020-05-10 16:29:16','zulfaandri',NULL,NULL,0),
(17,34,5820000,NULL,5820000,'2020-05-10 16:29:16','zulfaandri',NULL,NULL,0),
(21,76,8110000,NULL,8110000,'2020-05-13 10:39:06','indra',NULL,NULL,0),
(2,70,10000000,NULL,10000000,'2020-05-16 13:57:56','Nova',NULL,NULL,0);

/*Table structure for table `st_detail_team` */

DROP TABLE IF EXISTS `st_detail_team`;

CREATE TABLE `st_detail_team` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `iStId` int(11) DEFAULT NULL,
  `vNip` varchar(30) DEFAULT NULL,
  `cGolongan` varchar(3) DEFAULT NULL,
  `iPeran` varchar(50) DEFAULT NULL,
  `vPeranst` varchar(50) DEFAULT NULL,
  `nJumlahHP` int(5) DEFAULT NULL,
  `dMasaStrat` date DEFAULT NULL,
  `dMasaEnd` date DEFAULT NULL,
  `nLama` int(11) DEFAULT NULL,
  `iJenisPerDinas` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0=>'''',1=>''Luar Kota'',2=>''Translok'',3=>''Nihil''',
  `vDari` varchar(30) DEFAULT NULL,
  `vTujuan` varchar(30) DEFAULT NULL,
  `dPerjalananStart` date DEFAULT NULL,
  `dPerjalananEnd` date DEFAULT NULL,
  `iAlatAngkut` tinyint(1) NOT NULL DEFAULT '0' COMMENT '(0=>'''', 1=>''Pesawat Terbang'', 2=>''Kapal Laut'', 3=>''Kendaraan Umum'', 4=>''Kereta API'', 5=>''Kendaraan Dinas''',
  `iOpsiHariLibur` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0=>'''', 1=>''Hari Libur Tidak Diperbolehkan'', 2=>''Hari Libur Diperbolehkan TAPI Tidak Dibiayai'', 3=>''Hari Libur Diperbolehkan dan Dibiayai''',
  `iOpsiHariSabtu` tinyint(1) NOT NULL DEFAULT '0',
  `iOpsiHariMinggu` tinyint(1) NOT NULL DEFAULT '0',
  `nBiayaUangHarian` bigint(20) DEFAULT NULL,
  `nBiayaRepre` bigint(20) DEFAULT NULL,
  `nBiayaTransport` bigint(20) DEFAULT NULL,
  `iJenisAkomodasi` tinyint(1) DEFAULT NULL,
  `nBiayaPenginapan` bigint(20) DEFAULT NULL,
  `nHonorJasa` bigint(20) DEFAULT NULL,
  `tCreated` datetime DEFAULT NULL,
  `cCreatedby` varchar(20) DEFAULT NULL,
  `tUpdated` datetime DEFAULT NULL,
  `cUpdatedby` varchar(20) DEFAULT NULL,
  `lDeleted` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `iStId` (`iStId`,`vNip`),
  KEY `vNip` (`vNip`,`lDeleted`),
  KEY `vNip_2` (`vNip`)
) ENGINE=InnoDB AUTO_INCREMENT=56 DEFAULT CHARSET=latin1;

/*Data for the table `st_detail_team` */

insert  into `st_detail_team`(`id`,`iStId`,`vNip`,`cGolongan`,`iPeran`,`vPeranst`,`nJumlahHP`,`dMasaStrat`,`dMasaEnd`,`nLama`,`iJenisPerDinas`,`vDari`,`vTujuan`,`dPerjalananStart`,`dPerjalananEnd`,`iAlatAngkut`,`iOpsiHariLibur`,`iOpsiHariSabtu`,`iOpsiHariMinggu`,`nBiayaUangHarian`,`nBiayaRepre`,`nBiayaTransport`,`iJenisAkomodasi`,`nBiayaPenginapan`,`nHonorJasa`,`tCreated`,`cCreatedby`,`tUpdated`,`cUpdatedby`,`lDeleted`) values 
(1,1,'196107081982031001','IV/','2','Auditor Madya',4,NULL,NULL,NULL,0,NULL,NULL,NULL,NULL,0,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,'2020-05-09 14:39:15','yulissa',NULL,NULL,0),
(2,1,'198706022009111001','III','3','Auditor Pertama',4,NULL,NULL,NULL,0,NULL,NULL,NULL,NULL,0,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,'2020-05-09 14:39:53','yulissa',NULL,NULL,0),
(3,2,'196501141986031001','III','1','Korwaspok Bidang P3A Perwakilan BPKP Provinsi Sula',4,NULL,NULL,NULL,0,NULL,NULL,NULL,NULL,0,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,'2020-05-09 16:03:34','kemal',NULL,NULL,0),
(4,3,'196705131994031001','IV/','5','Korwas P3A',7,NULL,NULL,NULL,0,NULL,NULL,NULL,NULL,0,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,'2020-05-09 16:51:59','idra',NULL,NULL,0),
(5,4,'196601101986031002','IV/','5','Korwas Bidang Investigasi',4,NULL,NULL,NULL,0,NULL,NULL,NULL,NULL,0,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,'2020-05-09 17:37:47','nelson',NULL,NULL,0),
(6,4,'196208101985031001','IV ','2','Auditor Madya',4,NULL,NULL,NULL,0,NULL,NULL,NULL,NULL,0,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,'2020-05-09 17:38:19','nelson',NULL,NULL,0),
(7,5,'196302121990031001','IV/','2','Pengendali Teknis',9,NULL,NULL,NULL,0,NULL,NULL,NULL,NULL,0,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,'2020-05-10 09:03:43','gamadi',NULL,NULL,0),
(8,5,'198709232014021003','III','3','Ketua Tim',9,NULL,NULL,NULL,0,NULL,NULL,NULL,NULL,0,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,'2020-05-10 09:04:32','gamadi',NULL,NULL,0),
(9,5,'198801282009011001','III','4','Anggota Tim',9,NULL,NULL,NULL,0,NULL,NULL,NULL,NULL,0,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,'2020-05-10 09:04:54','gamadi',NULL,NULL,0),
(10,6,'198801282009011001','III','4','Anggota Tim',9,NULL,NULL,NULL,0,NULL,NULL,NULL,NULL,0,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,'2020-05-10 09:24:27','rosmiyati','2020-05-10 09:56:49','Rae',1),
(18,10,'196307101990031001','IV/','2','Pengendali Teknis',9,NULL,NULL,NULL,0,NULL,NULL,NULL,NULL,0,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,'2020-05-10 13:34:47','Rae','2020-05-10 13:35:29','Rae',0),
(19,10,'197310211999032001','III','3','Ketua Tim',9,NULL,NULL,NULL,0,NULL,NULL,NULL,NULL,0,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,'2020-05-10 13:35:20','Rae',NULL,NULL,0),
(20,10,'199008222012102001','III','4','Anggota Tim',9,NULL,NULL,NULL,0,NULL,NULL,NULL,NULL,0,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,'2020-05-10 13:35:52','Rae',NULL,NULL,0),
(21,10,'198801282009011001','III','4','Anggota Tim',9,NULL,NULL,NULL,0,NULL,NULL,NULL,NULL,0,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,'2020-05-10 13:36:55','Rae','2020-05-10 13:51:46','Rae',1),
(22,11,'196309271985031001','IV/','0','Pembantu Penanggung Jawab',9,NULL,NULL,NULL,0,NULL,NULL,NULL,NULL,0,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,'2020-05-10 14:13:19','reza',NULL,NULL,0),
(23,11,'197308131994021001','IV/','2','Pengendali Teknis',9,NULL,NULL,NULL,0,NULL,NULL,NULL,NULL,0,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,'2020-05-10 14:13:47','reza',NULL,NULL,0),
(24,11,'196907201993031001','III','3','Ketua Tim',9,NULL,NULL,NULL,0,NULL,NULL,NULL,NULL,0,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,'2020-05-10 14:14:09','reza',NULL,NULL,0),
(25,11,'199608272018011001','II/','4','Anggota Tim',9,NULL,NULL,NULL,0,NULL,NULL,NULL,NULL,0,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,'2020-05-10 14:14:32','reza',NULL,NULL,0),
(26,12,'196309271985031001','IV/','0','Pembantu Penanggung Jawab',9,NULL,NULL,NULL,0,NULL,NULL,NULL,NULL,0,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,'2020-05-10 14:25:56','armin',NULL,NULL,0),
(27,12,'196302121990031001','IV/','2','Pengendali Teknis',9,NULL,NULL,NULL,0,NULL,NULL,NULL,NULL,0,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,'2020-05-10 14:26:20','armin',NULL,NULL,0),
(28,12,'197603121996012001','III','3','Ketua Tim',9,NULL,NULL,NULL,0,NULL,NULL,NULL,NULL,0,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,'2020-05-10 14:26:40','armin',NULL,NULL,0),
(29,12,'196701061988031001','III','4','Anggota Tim',9,NULL,NULL,NULL,0,NULL,NULL,NULL,NULL,0,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,'2020-05-10 14:27:01','armin',NULL,NULL,0),
(30,13,'196309271985031001','IV/','0','Pembantu Penanggung Jawab',9,NULL,NULL,NULL,0,NULL,NULL,NULL,NULL,0,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,'2020-05-10 14:47:45','juwita',NULL,NULL,0),
(31,13,'196911211990031002','IV/','2','Pengendali Teknis',9,NULL,NULL,NULL,0,NULL,NULL,NULL,NULL,0,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,'2020-05-10 14:48:09','juwita',NULL,NULL,0),
(32,13,'197208241998032001','III','3','Ketua Tim',9,NULL,NULL,NULL,0,NULL,NULL,NULL,NULL,0,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,'2020-05-10 14:48:28','juwita',NULL,NULL,0),
(33,13,'198601312014022002','III','4','Anggota Tim',9,NULL,NULL,NULL,0,NULL,NULL,NULL,NULL,0,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,'2020-05-10 14:48:48','juwita',NULL,NULL,0),
(34,14,'197001191994011001','IV/','2','Pengendelai Teknis',5,NULL,NULL,NULL,0,NULL,NULL,NULL,NULL,0,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,'2020-05-10 15:03:01','ramadhani',NULL,NULL,0),
(35,14,'197008171997032001','III','3','Ketua Tim',5,NULL,NULL,NULL,0,NULL,NULL,NULL,NULL,0,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,'2020-05-10 15:04:05','ramadhani',NULL,NULL,0),
(36,14,'197310161998031001','III','4','Anggota Tim',5,NULL,NULL,NULL,0,NULL,NULL,NULL,NULL,0,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,'2020-05-10 15:04:33','ramadhani',NULL,NULL,0),
(37,15,'196508061987031001','IV/','4','Aufitor Madya',7,NULL,NULL,NULL,0,NULL,NULL,NULL,NULL,0,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,'2020-05-10 15:16:18','harman',NULL,NULL,0),
(38,16,'197112201994031001','III','3','Kasubbag Kepegawaian',3,NULL,NULL,NULL,0,NULL,NULL,NULL,NULL,0,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,'2020-05-10 15:33:12','aniska','2020-05-10 15:52:36','aniska',0),
(39,17,'196510301993031001','IV/','5','Penanggung Jawab',3,NULL,NULL,NULL,0,NULL,NULL,NULL,NULL,0,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,'2020-05-10 16:13:54','zulfaandri',NULL,NULL,0),
(40,17,'196601101986031002','IV/','0','Pembantu Penanggung Jawab',3,NULL,NULL,NULL,0,NULL,NULL,NULL,NULL,0,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,'2020-05-10 16:14:13','zulfaandri',NULL,NULL,0),
(41,17,'198610222014021002','III','3','Ketua Tim',3,NULL,NULL,NULL,0,NULL,NULL,NULL,NULL,0,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,'2020-05-10 16:14:36','zulfaandri',NULL,NULL,0),
(42,18,'196709221988031001','IV/','0','Pembantu Penanggung Jawab',15,NULL,NULL,NULL,0,NULL,NULL,NULL,NULL,0,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,'2020-05-10 16:38:50','devit',NULL,NULL,0),
(43,18,'196209191993031001','IV/','2','Pengendali Teknis',15,NULL,NULL,NULL,0,NULL,NULL,NULL,NULL,0,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,'2020-05-10 16:39:10','devit',NULL,NULL,0),
(44,18,'198403302006021008','II/','3','Ketua Tim',15,NULL,NULL,NULL,0,NULL,NULL,NULL,NULL,0,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,'2020-05-10 16:39:30','devit',NULL,NULL,0),
(45,18,'198902172012101001','III','4','Anggota Tim',15,NULL,NULL,NULL,0,NULL,NULL,NULL,NULL,0,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,'2020-05-10 16:39:49','devit',NULL,NULL,0),
(46,19,'197308131994021001','IV/','2','Narasumber',2,NULL,NULL,NULL,0,NULL,NULL,NULL,NULL,0,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,'2020-05-13 08:38:55','indra',NULL,NULL,0),
(47,20,'196611251993031001','III','3','Auditor Muda',7,NULL,NULL,NULL,0,NULL,NULL,NULL,NULL,0,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,'2020-05-13 09:00:06','indra',NULL,NULL,0),
(48,21,'196709221988031001','IV/','0','Koordinator Pengawasan',10,NULL,NULL,NULL,0,NULL,NULL,NULL,NULL,0,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,'2020-05-13 10:36:58','indra',NULL,NULL,0),
(49,21,'196006191991031001','IV/','2','Pengendali Teknis',10,NULL,NULL,NULL,0,NULL,NULL,NULL,NULL,0,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,'2020-05-13 10:37:29','indra',NULL,NULL,0),
(50,21,'196301291985031001','III','3','Ketua tim',10,NULL,NULL,NULL,0,NULL,NULL,NULL,NULL,0,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,'2020-05-13 10:37:54','indra',NULL,NULL,0),
(51,21,'198901102010121001','III','4','Anggota tim',10,NULL,NULL,NULL,0,NULL,NULL,NULL,NULL,0,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,'2020-05-13 10:38:43','indra',NULL,NULL,0),
(52,21,'198809162014021003','III','4','Anggota tim',10,NULL,NULL,NULL,0,NULL,NULL,NULL,NULL,0,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,'2020-05-13 10:39:02','indra',NULL,NULL,0),
(53,22,'196302121990031001','IV/','2','Pengendali Teknis',2,NULL,NULL,NULL,0,NULL,NULL,NULL,NULL,0,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,'2020-05-13 11:43:16','indra',NULL,NULL,0),
(54,22,'197001191994011001','IV/','3','Ketua Tim',2,NULL,NULL,NULL,0,NULL,NULL,NULL,NULL,0,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,'2020-05-13 11:43:44','indra',NULL,NULL,0),
(55,22,'198903152014022005','III','4','Anggota Tim',2,NULL,NULL,NULL,0,NULL,NULL,NULL,NULL,0,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,'2020-05-13 11:44:13','indra',NULL,NULL,0);

/*Table structure for table `st_header` */

DROP TABLE IF EXISTS `st_header`;

CREATE TABLE `st_header` (
  `iStId` int(11) NOT NULL AUTO_INCREMENT,
  `iBarcode` int(8) DEFAULT NULL,
  `vNomorCs` varchar(20) DEFAULT NULL,
  `iBidangId` tinyint(1) DEFAULT NULL,
  `iSubBidangId` tinyint(1) DEFAULT NULL,
  `iJenisRkt` tinyint(1) DEFAULT '0',
  `iJenisSt` tinyint(1) DEFAULT '0',
  `vJenisPenugasan` varchar(50) DEFAULT NULL,
  `vDasarPenugasan` text,
  `cNoSrtDasar` varchar(50) DEFAULT NULL,
  `dTglSrtDasar` date DEFAULT NULL,
  `cObyekPenugasan` varchar(10) DEFAULT NULL,
  `vUraianPenugasan` text,
  `dMulai` date DEFAULT NULL,
  `dAkhir` date DEFAULT NULL,
  `nJangkaWaktu` int(4) DEFAULT NULL,
  `iSumberDana` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0=>'''',1=>''DIPA PERWAKILAN'',2=>''SKPA'',3=>''DROPING'',4=>''PIHAK III'',4=>''UNIT BPKP LAIN'',5=>''SHARING''',
  `iDipaId` int(11) DEFAULT NULL,
  `vUraianSumberDana` text,
  `vDaerahTujuan` varchar(50) DEFAULT NULL,
  `nNilaiPengajuan` bigint(20) DEFAULT NULL,
  `nRealiasi` bigint(20) DEFAULT NULL,
  `cNomorST` varchar(30) DEFAULT NULL,
  `dTglST` date DEFAULT NULL,
  `tCreated` datetime DEFAULT NULL,
  `cCreatedBy` varchar(20) DEFAULT NULL,
  `tUpdated` datetime DEFAULT NULL,
  `cUpdatedBy` varchar(20) DEFAULT NULL,
  `lDeleted` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`iStId`),
  KEY `lDeleted` (`lDeleted`),
  KEY `iBarcode` (`iBarcode`),
  KEY `iBidangId` (`iBidangId`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=latin1;

/*Data for the table `st_header` */

insert  into `st_header`(`iStId`,`iBarcode`,`vNomorCs`,`iBidangId`,`iSubBidangId`,`iJenisRkt`,`iJenisSt`,`vJenisPenugasan`,`vDasarPenugasan`,`cNoSrtDasar`,`dTglSrtDasar`,`cObyekPenugasan`,`vUraianPenugasan`,`dMulai`,`dAkhir`,`nJangkaWaktu`,`iSumberDana`,`iDipaId`,`vUraianSumberDana`,`vDaerahTujuan`,`nNilaiPengajuan`,`nRealiasi`,`cNomorST`,`dTglST`,`tCreated`,`cCreatedBy`,`tUpdated`,`cUpdatedBy`,`lDeleted`) values 
(1,200009,NULL,6,NULL,2,1,'KEGIATAN BIDANG PROGRAM,PELAPORAN DAN PEMBINAAN AP','Surat Inspektur Kabupaten Kepulauan Meranti','700/Insp-Set/2020/06','2020-01-02','Inspektora','Menjadi Narasumber pada pelaksanaan kegiatan In House Training (Pelatihan Kantor Sendiri) atas penerapan Pedoman Kendali Mutu Audit di lingkungan Inspektoran Kabupaten Indragiri Hilir','2020-01-12',NULL,4,4,0,'Kabupaten Indragiri Hilir',NULL,NULL,NULL,'ST-1/PW04/6/2020','2020-01-06','2020-05-09 14:38:17','yulissa','2020-05-09 15:33:59','Nova',0),
(2,200010,NULL,1,1,0,1,'KEGIATAN BAGIAN TATA USAHA','Surat Undangan Kaper BPKP Sulawesi Selatan','Und-064/PW21/1/2020','2020-01-03','Perwakilan','mengikuti Pelantikan dan Pengambilan Sumpah/Janji Jabatan di Perwakilan BPKP Provinsi Sulawesi Selatan','2020-01-08','2020-05-16',4,1,37,'',NULL,NULL,NULL,'S-28/PW04/1/2020','2020-01-07','2020-05-09 16:01:24','kemal','2020-05-16 13:57:56','Nova',0),
(3,200011,NULL,6,NULL,2,1,'KEGIATAN BIDANG PROGRAM,PELAPORAN DAN PEMBINAAN AP','Surat Kepala Perwakilan BPKP Provinsi Aceh','S-0043/PW04/1/2020','2020-01-03','Perwakilan','menyelesaikan pekerjaan pegawai yang bersangkutan di Perwakilan BPKP Provinsi Aceh','2020-01-12',NULL,7,5,0,'Perwakilan BPKP Provinsi Aceh',NULL,NULL,NULL,'ST-4-PW04/1/2020','2020-01-08','2020-05-09 16:51:08','idra','2020-05-09 17:14:27','Nova',0),
(4,200012,NULL,5,NULL,1,1,'KEGIATAN BIDANG INVESTIGASI','Surat Deputi Kepala BPKP Bidang Investigasi','S-857/D5/04/2019','2019-12-31','Belitung','mengikuti kegiatan Forum Investigasi Tahun 2020 di Belitung','2020-01-23',NULL,4,1,36,'',NULL,NULL,NULL,'ST-3/PW04/5/2020','2020-01-08','2020-05-09 17:35:05','nelson','2020-05-10 14:14:44','Nova',0),
(5,200013,NULL,3,NULL,1,1,'KEGIATAN BIDANG AKUNTABILITAS PEMDA','-','-','2020-01-09','Pemerintah','melakukan evaluasi atas penyaluran dan penggunaan Dana Desa Triwulan IV Tahun 2019 pada Pemerintah Kabupaten Kepulauan Meranti','2020-01-09',NULL,9,1,30,'',NULL,NULL,NULL,'ST-14/PW04/3/2020','2020-01-09','2020-05-10 09:02:59','gamadi','2020-05-10 15:06:19','Nova',0),
(10,200018,NULL,3,NULL,1,1,'KEGIATAN BIDANG AKUNTABILITAS PEMDA','-','-','2020-05-10','Pemerintah','melakukan evaluasi atas penyaluran dan penggunaan Dana Desa Triwulan IV Tahun 2019 pada Pemerintahan Kabupaten Bengkalis','2020-01-09',NULL,9,1,30,'',NULL,NULL,NULL,'ST-8/PW04/3/2020','2020-01-09','2020-05-10 13:33:37','Rae','2020-05-10 15:07:36','Nova',0),
(11,200019,NULL,3,NULL,1,1,'KEGIATAN BIDANG AKUNTABILITAS PEMDA','-','-','2020-01-09','Pemerintah','melakukan evaluasi atas penyaluran dan penggunaan Dana Desa Triwulan IV Tahun 2019 pada Pemerintah Kabupaten Rokan Hilir','2020-01-09',NULL,9,1,30,'',NULL,NULL,NULL,'ST-10/PW04/3/2020','2020-01-09','2020-05-10 14:12:05','reza','2020-05-10 15:08:19','Nova',0),
(12,200020,NULL,3,NULL,1,1,'KEGIATAN BIDANG AKUNTABILITAS PEMDA','-','-','2020-01-09','Pemerintah','melakukan evaluasi atas penyaluran dan penggunaan Dana Desa Triwulan IV Tahun 2019 pada Pemerintah Kabupaten Kuantan Singingi','2020-01-09',NULL,9,1,30,'',NULL,NULL,NULL,'ST-6/PW04/3/2020','2020-01-09','2020-05-10 14:25:15','armin','2020-05-10 15:08:48','Nova',0),
(13,200021,NULL,3,NULL,1,1,'KEGIATAN BIDANG AKUNTABILITAS PEMDA','-','-','2020-01-09','Pemerintah','melakukan evaluasi atas penyaluran dan penggunaan Dana Desa Triwulan IV Tahun 2019 pada Pemerintah Kabupaten Indragiri Hulu','2020-01-09',NULL,9,1,30,'',NULL,NULL,NULL,'ST-12/PW04/3/2020','2020-01-09','2020-05-10 14:47:17','juwita','2020-05-10 15:09:21','Nova',0),
(14,200022,NULL,6,NULL,1,1,'KEGIATAN BIDANG PROGRAM,PELAPORAN DAN PEMBINAAN AP','-','-','2020-01-10','Inspektora','melakukan Bimbingan Teknis atas Kegiatan Peningkatan Kapabilitas APIP pada Inspektorat Kabupaten Kepulauan Meranti','2020-01-14',NULL,5,1,24,'',NULL,NULL,NULL,'S-15/PW04/6/2020','2020-01-10','2020-05-10 15:02:15','ramadhani','2020-05-10 16:42:53','Nova',0),
(15,200023,NULL,3,NULL,2,1,'KEGIATAN BIDANG AKUNTABILITAS PEMDA','-','-','2020-01-10','Pusdiklatw','mengikuti Diklat Pengelolaan Resiko Pemda di Pusdiklatwas BPKP Ciawi, Bogor','2020-01-12',NULL,7,4,0,'Pusdiklatwas BPKP',NULL,NULL,NULL,'ST-17/PW04/1/2020','2020-01-10','2020-05-10 15:15:49','harman','2020-05-10 16:56:42','Nova',0),
(16,200024,NULL,1,2,0,1,'KEGIATAN SUB BAG KEPEGAWAIAN','-','-','2020-01-14','Kantor BPK','melaksanakan penyelesaian administrasi dokumen kepegawaian di Biro Kepegawaian BPKP Pusat','2020-01-15',NULL,3,1,5,'',NULL,NULL,NULL,'ST-19/PW04/1/2020','2020-01-14','2020-05-10 15:32:30','aniska','2020-05-15 14:29:46','Nova',0),
(17,200025,NULL,5,NULL,1,1,'KEGIATAN BIDANG INVESTIGASI','-','-','2020-01-17','Sekretaria','melakukan ekspose dalam rangka qualitty assurance terhadap penugasan Audit Investigatif atas Perjalanan Dinas Kegiatan Peningkatan Kapasitas Pimpinan dan Anggota DPRD pada Sekretariat DPRD Kabupaten Indragiri Hulu TA 2016, 2017, 2018','2020-01-17',NULL,3,1,34,'',NULL,NULL,NULL,'ST-22/PW04/5/2020','2020-01-17','2020-05-10 16:11:11','zulfaandri','2020-05-15 14:44:18','Nova',0),
(18,200026,NULL,2,NULL,2,1,'KEGIATAN BIDANG INSTANSI PEMERINTAH PUSAT','-','-','2020-01-17','Komisi Pem','melaksanakan Pendampingan Penyusunan Pedoman Teknis Pengelolaan Anggaran Pemilihan Bupati dan Wakil Bupati Kuantan Singingi Tahun 2020','2020-01-20',NULL,15,4,0,'Komisi Pemilihan Umum Kabupaten Kuantan Singingi',NULL,NULL,NULL,'ST-24/PW04/2/2020','2020-01-17','2020-05-10 16:38:21','devit','2020-05-15 15:03:38','Nova',0),
(19,200027,NULL,3,NULL,2,1,'KEGIATAN BIDANG AKUNTABILITAS PEMDA','Surat Sekda Kab Kuantan Sengingi ','No 050/Bappedalitbang/11','2020-01-14','Pemkab Sen','Narasumber kegiatan Sosialisasi Hibah/Bansos','2020-01-21',NULL,2,4,0,'Pemkab Kuantan Singingi',NULL,NULL,NULL,'S-30/PW04/3/2020','2020-01-20','2020-05-13 08:32:59','indra','2020-05-16 09:25:48','Rae',0),
(20,200028,NULL,1,1,0,1,'RAPAT KOORDINASI','Surat Kapusdiklatwas BPKP','S-','2020-01-13','Pusdiklatw','Mengikuti diklat asessment GCG berbasis ISO 9001 2015','2020-01-19',NULL,7,5,0,'Pusdiklatwas BPKP',NULL,NULL,NULL,'ST-27/PW04/1/2020','2020-01-17','2020-05-13 08:59:30','indra','2020-05-15 15:23:57','Nova',0),
(21,200029,NULL,2,NULL,1,1,'KEGIATAN BIDANG INSTANSI PEMERINTAH PUSAT','PKPT','56636','2020-01-01','Kementeria','Monitoring dan Evaluasi program dan kegiatan nasional dan inpres 9 tahun 2017 capaian B12 atas kegiatan Kemeterian PU dan Perumahan rakyat','2020-01-22',NULL,10,1,9,'',NULL,NULL,NULL,'ST-33/PW04/2/2020','2020-01-22','2020-05-13 10:35:36','indra','2020-05-13 10:49:07','indra',0),
(22,200030,NULL,3,NULL,2,1,'KEGIATAN BIDANG AKUNTABILITAS PEMDA','Surat Inspektur Kab Kampar','S','2020-01-13','Inspektora','Narasumber pelaksanaan kegiatan in hause training atas pengawasan APB Des di Lingk Inspektorat Kab kampar','2020-01-22',NULL,2,4,0,'Inspektorat Kab Kampar',NULL,NULL,NULL,NULL,NULL,'2020-05-13 11:42:44','indra','2020-05-13 11:46:00','indra',0);

/*Table structure for table `sysparam` */

DROP TABLE IF EXISTS `sysparam`;

CREATE TABLE `sysparam` (
  `cProg` varchar(20) NOT NULL,
  `vValue` varchar(100) DEFAULT NULL,
  `vDescription` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`cProg`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `sysparam` */

insert  into `sysparam`(`cProg`,`vValue`,`vDescription`) values 
('vP','1234',NULL),
('vU','root',NULL);

/*Table structure for table `tabcount` */

DROP TABLE IF EXISTS `tabcount`;

CREATE TABLE `tabcount` (
  `cCode` char(10) DEFAULT NULL,
  `cTahun` char(4) DEFAULT NULL,
  `iLastNumber` int(11) DEFAULT NULL,
  `vDesc` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tabcount` */

insert  into `tabcount`(`cCode`,`cTahun`,`iLastNumber`,`vDesc`) values 
('BAR','2020',30,'Counter For Barcode Cost Sheet'),
('CS','2020',16,'Penomoran Cost Sheet');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
