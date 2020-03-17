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
(3,'2020',13),
(1,'2020',2);

/*Table structure for table `cs_detail` */

DROP TABLE IF EXISTS `cs_detail`;

CREATE TABLE `cs_detail` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `iCsId` int(11) DEFAULT NULL,
  `dPerjalananStart` date DEFAULT NULL,
  `dPerjalananEnd` date DEFAULT NULL,
  `nLama` int(4) NOT NULL DEFAULT '0',
  `iAlatAngkut` tinyint(1) NOT NULL DEFAULT '0',
  `iOpsiHariLibur` tinyint(1) DEFAULT NULL,
  `iOpsiHariSabtu` tinyint(1) DEFAULT NULL,
  `iOpsiHariMinggu` tinyint(1) DEFAULT NULL,
  `vNip` varchar(30) DEFAULT NULL,
  `nBiayaUangHarian` bigint(20) DEFAULT NULL COMMENT 'Per hari',
  `nTotalUangHarian` bigint(20) DEFAULT NULL COMMENT 'jumlah (perhari * hari)',
  `nBiayaRepre` bigint(20) DEFAULT NULL,
  `nBiayaTransport` bigint(20) DEFAULT NULL,
  `nTotalTransport` bigint(20) DEFAULT NULL,
  `iJenisAkomodasi` tinyint(1) DEFAULT NULL,
  `nBiayaPenginapan` bigint(20) DEFAULT NULL,
  `nTotalPenginapan` bigint(20) DEFAULT NULL,
  `nHonorJasa` bigint(20) DEFAULT NULL,
  `nTotalBiaya` bigint(20) DEFAULT NULL,
  `dTglSPPD` date DEFAULT NULL,
  `vNoSPPD` varchar(30) DEFAULT NULL,
  `vJenisSPD` varchar(30) DEFAULT NULL,
  `tCreated` datetime DEFAULT NULL,
  `cCreatedby` varchar(20) DEFAULT NULL,
  `tUpdated` datetime DEFAULT NULL,
  `cUpdatedby` varchar(20) DEFAULT NULL,
  `lDeleted` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `iCsId` (`iCsId`,`vNip`),
  KEY `vNip` (`vNip`),
  KEY `lDeleted` (`lDeleted`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

/*Data for the table `cs_detail` */

insert  into `cs_detail`(`id`,`iCsId`,`dPerjalananStart`,`dPerjalananEnd`,`nLama`,`iAlatAngkut`,`iOpsiHariLibur`,`iOpsiHariSabtu`,`iOpsiHariMinggu`,`vNip`,`nBiayaUangHarian`,`nTotalUangHarian`,`nBiayaRepre`,`nBiayaTransport`,`nTotalTransport`,`iJenisAkomodasi`,`nBiayaPenginapan`,`nTotalPenginapan`,`nHonorJasa`,`nTotalBiaya`,`dTglSPPD`,`vNoSPPD`,`vJenisSPD`,`tCreated`,`cCreatedby`,`tUpdated`,`cUpdatedby`,`lDeleted`) values 
(6,5,'2020-03-04','2020-03-09',4,1,1,1,3,'44411122',10000,40000,50000,5000,10000,1,10000,30000,500000,630000,'2020-03-11','SPD-2/PW4/3/2020','A','2020-03-07 23:10:30','rava','2020-03-14 06:00:59','rava',0),
(7,8,'2020-03-09','2020-03-09',1,0,0,0,0,'197706121998111001',0,0,0,0,0,0,0,0,0,0,NULL,NULL,NULL,'2020-03-09 05:28:02','rava','2020-03-09 05:28:09','rava',0),
(8,5,'2020-03-04','2020-03-05',2,1,1,1,1,'999999999X',30000,60000,20000,10000,20000,1,10000,10000,40000,150000,NULL,NULL,NULL,'2020-03-16 05:41:28',NULL,NULL,NULL,0);

/*Table structure for table `cs_header` */

DROP TABLE IF EXISTS `cs_header`;

CREATE TABLE `cs_header` (
  `iCsId` int(11) NOT NULL AUTO_INCREMENT,
  `iStId` int(11) DEFAULT NULL,
  `dTanggalCS` date DEFAULT NULL,
  `vNomorCs` varchar(20) DEFAULT NULL,
  `dMasaStrat` date DEFAULT NULL,
  `dMasaEnd` date DEFAULT NULL,
  `nLama` int(11) DEFAULT NULL,
  `iJenisPerDinas` tinyint(1) DEFAULT NULL,
  `vDari` varbinary(30) DEFAULT NULL,
  `vTujuan` varchar(30) DEFAULT NULL,
  `tCreated` datetime DEFAULT NULL,
  `cCreatedby` varchar(20) DEFAULT NULL,
  `tUpdated` datetime DEFAULT NULL,
  `cUpdatedby` varchar(20) DEFAULT NULL,
  `lDeleted` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`iCsId`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

/*Data for the table `cs_header` */

insert  into `cs_header`(`iCsId`,`iStId`,`dTanggalCS`,`vNomorCs`,`dMasaStrat`,`dMasaEnd`,`nLama`,`iJenisPerDinas`,`vDari`,`vTujuan`,`tCreated`,`cCreatedby`,`tUpdated`,`cUpdatedby`,`lDeleted`) values 
(1,2,NULL,'CS-6/PW04/3/2020','2020-03-04','2020-03-06',3,NULL,NULL,NULL,'2020-03-06 20:28:04','rava','2020-03-07 07:51:02','rava',0),
(2,2,NULL,'CS-6/PW04/3/2020','2020-03-04','2020-03-06',3,NULL,NULL,NULL,'2020-03-06 20:28:33','rava','2020-03-07 07:04:08','rava',1),
(3,2,NULL,'CS-7/PW04/3/2020','2020-03-04','2020-03-06',3,NULL,NULL,NULL,'2020-03-07 06:55:59','rava','2020-03-07 07:04:02','rava',1),
(4,2,NULL,'CS-8/PW04/3/2020','2020-03-04','2020-03-06',3,NULL,NULL,NULL,'2020-03-07 06:56:12','rava',NULL,NULL,0),
(5,1,'2020-03-10','CS-9/PW04/3/2020','2020-03-04','2020-03-06',3,1,'Jakarta','Surabaya','2020-03-07 08:31:47','rava','2020-03-08 04:48:18','rava',0),
(6,1,'1970-01-01','CS-10/PW04/3/2020','2020-03-05','2020-03-06',1,1,'Jakarta','Bogor','2020-03-07 10:55:23','rava','2020-03-14 04:08:31','rava',0),
(7,1,'2020-03-07','CS-12/PW04/3/2020','2020-03-04','2020-03-06',2,NULL,NULL,NULL,'2020-03-07 22:36:05','rava',NULL,NULL,0),
(8,4,'2020-03-09','CS-13/PW04/3/2020','2020-03-09','2020-03-12',2,3,'Jakarta','Jakarta','2020-03-09 05:27:51','rava',NULL,NULL,0);

/*Table structure for table `dipa` */

DROP TABLE IF EXISTS `dipa`;

CREATE TABLE `dipa` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cTahun` char(4) DEFAULT NULL,
  `iBidangId` int(11) DEFAULT NULL,
  `cKodeDipa` varchar(20) DEFAULT NULL,
  `vNamaItem` varchar(50) DEFAULT NULL,
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
  KEY `iBidangId` (`iBidangId`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `dipa` */

insert  into `dipa`(`id`,`cTahun`,`iBidangId`,`cKodeDipa`,`vNamaItem`,`cKodeAccount`,`iJenis`,`fJumlahAnggaran`,`tCreated`,`cCreatedBy`,`tUpdated`,`cUpdatedBy`,`lDeleted`) values 
(1,'2020',3,'3676960.1112.12212.1','Penyusunan Laporan Keuangan Tahunan Tahun 2019 yan','524111',0,35000000,'2020-02-28 22:33:48','rava','2020-02-28 22:44:31','rava',0),
(2,'2020',3,'3676960','Penyusunan Dokumen RKAKL/DIPA','22213',0,25000000,'2020-02-29 12:35:01','rava','2020-03-02 05:38:16','rava',0);

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
(3,'AP','AKUNTABILITAS PEMDA',3,'2020-02-23 22:46:12','root',NULL,NULL,0),
(4,'AN','AKUNTAN NEGARA',4,'2020-02-23 22:46:22','root',NULL,NULL,0),
(5,'INVESTIGASI','INVESTIGASI',5,'2020-02-23 22:46:39','root',NULL,NULL,0),
(6,'P3A','PROGRAM,PELAPORAN DAN PEMBINAAN APIP',6,'2020-02-23 22:46:55','root',NULL,NULL,0);

/*Table structure for table `ms_jabatan` */

DROP TABLE IF EXISTS `ms_jabatan`;

CREATE TABLE `ms_jabatan` (
  `iJabatanId` int(11) NOT NULL AUTO_INCREMENT,
  `vJabatanName` varchar(50) DEFAULT NULL,
  `tCreated` datetime DEFAULT NULL,
  `cCreatedBy` varchar(20) DEFAULT NULL,
  `tUpdated` datetime DEFAULT NULL,
  `cUpdatedBy` varchar(20) DEFAULT NULL,
  `lDeleted` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0=>Acive,1=>Deleted',
  PRIMARY KEY (`iJabatanId`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `ms_jabatan` */

insert  into `ms_jabatan`(`iJabatanId`,`vJabatanName`,`tCreated`,`cCreatedBy`,`tUpdated`,`cUpdatedBy`,`lDeleted`) values 
(1,'Kepala Bagian','2020-02-23 02:40:38','root',NULL,NULL,0),
(2,'Kepala Unit','2020-02-23 02:41:37','root',NULL,NULL,0);

/*Table structure for table `ms_pegawai` */

DROP TABLE IF EXISTS `ms_pegawai`;

CREATE TABLE `ms_pegawai` (
  `iPegawaiId` int(11) NOT NULL AUTO_INCREMENT,
  `vNip` varchar(30) DEFAULT NULL,
  `vName` varchar(50) DEFAULT NULL,
  `cSex` char(1) DEFAULT NULL,
  `vGelar` varchar(50) DEFAULT NULL,
  `iJabatanId` int(11) DEFAULT NULL,
  `cGolongan` char(3) DEFAULT NULL,
  `nGolTarif` int(11) DEFAULT NULL,
  `iBidangId` int(11) DEFAULT NULL,
  `iSubBidangId` int(11) DEFAULT NULL,
  `iPeran` tinyint(1) DEFAULT NULL COMMENT '1=>Admin,2=>Pegawai,3=>Kepala Bagian,4=>Sub Bagian,5=>Skretaris Bidang,6=>Kepala Perwakilan',
  `cUserId` varchar(20) DEFAULT NULL,
  `vPassword` varchar(50) DEFAULT NULL,
  `vImage` varchar(200) DEFAULT NULL,
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
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

/*Data for the table `ms_pegawai` */

insert  into `ms_pegawai`(`iPegawaiId`,`vNip`,`vName`,`cSex`,`vGelar`,`iJabatanId`,`cGolongan`,`nGolTarif`,`iBidangId`,`iSubBidangId`,`iPeran`,`cUserId`,`vPassword`,`vImage`,`tCreated`,`cCreatedBy`,`tUpdated`,`cUpdatedBy`,`lDeleted`) values 
(1,'197706121998111001','Rava','L','S1',1,'IV',0,3,0,1,'rava','81dc9bdb52d04dc20036dbd8313ed055','user_5e567f443c34d.jpg','2020-02-24 14:45:54','root','2020-02-26 21:40:47','root',0),
(3,'999999999X','MF Sucianto','L','S1',2,'a',0,3,0,1,'anto','c116819bb770ace40c51166f19d7e526','user_5e5685051198d.jpg','2020-02-24 14:45:54','root','2020-02-26 21:48:34','root',0),
(4,'999999999','MF Sucianto','L','S1',1,'a',0,3,0,1,'','1234','5e5679c8b2568.jpeg','2020-02-24 14:45:54','root','2020-02-26 21:02:57','root',0),
(17,'44411122','LARA ATI','P','S1',1,'IV',234,1,2,3,'',NULL,NULL,'2020-03-01 21:39:33','rava',NULL,NULL,0);

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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `rkt` */

insert  into `rkt`(`id`,`cTahun`,`vUnitPelaksana`,`iBidangId`,`iDipaId`,`cNomorRkt`,`cKodeAccount`,`cKodeRkt`,`cNamaItem`,`cKelompok`,`iJenis`,`iJumlahRencana`,`fAnggaran`,`tCreated`,`cCreatedBy`,`tUpdated`,`cUpdatedBy`,`lDeleted`) values 
(1,'2020','204',3,1,'33441.121.12121121','111','21212','Jajsa hj','kelompok kegiatan Akuntabilitas Pemda',0,35,2000000,'2020-02-29 21:21:03','rava','2020-03-14 17:48:16','rava',0),
(2,'2020','204',3,1,'12','aa','121','aas','kelompok kegiatan Akuntabilitas Pemda',1,12,1000000,'2020-03-01 21:14:43','rava','2020-03-14 17:48:21','rava',0),
(3,'2020','204',3,2,'11','22212','112','asa','kelompok kegiatan investigasi',1,1,20000,'2020-03-14 17:40:14','rava','2020-03-14 17:47:46','rava',0);

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
(1,1,1000000,NULL,1000000,'2020-03-08 04:33:42','rava',NULL,NULL,0),
(1,2,30000,NULL,30000,'2020-03-08 04:33:43','rava',NULL,NULL,0),
(4,2,10000,NULL,10000,'2020-03-09 05:23:38','rava',NULL,NULL,0);

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
  UNIQUE KEY `iStId` (`iStId`,`vNip`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `st_detail_team` */

insert  into `st_detail_team`(`id`,`iStId`,`vNip`,`cGolongan`,`iPeran`,`vPeranst`,`nJumlahHP`,`dMasaStrat`,`dMasaEnd`,`nLama`,`iJenisPerDinas`,`vDari`,`vTujuan`,`dPerjalananStart`,`dPerjalananEnd`,`iAlatAngkut`,`iOpsiHariLibur`,`iOpsiHariSabtu`,`iOpsiHariMinggu`,`nBiayaUangHarian`,`nBiayaRepre`,`nBiayaTransport`,`iJenisAkomodasi`,`nBiayaPenginapan`,`nHonorJasa`,`tCreated`,`cCreatedby`,`tUpdated`,`cUpdatedby`,`lDeleted`) values 
(1,1,'44411122','IV','1','Tukang Masak',1,'2020-03-04','2020-03-06',2,1,'Jakarta','Lampung','2020-03-04','2020-03-06',2,1,1,1,250000,30000,45000,1,300000,200000,'2020-03-06 10:39:35','rava','2020-03-14 08:36:03','rava',0),
(2,1,'999999999X','a','3','Tukang bawa',3,'2020-03-04','2020-03-06',3,3,'Jakarta','Jakarta','2020-03-06','2020-03-06',0,0,0,0,0,0,0,0,0,0,'2020-03-06 15:10:03','rava','2020-03-14 08:35:51','rava',0),
(3,1,'197706121998111001','IV','0','Sopir',2,'2020-03-06','2020-03-06',2,3,'Jakarta','Jakarta','2020-03-05','2020-03-05',0,0,0,0,0,0,0,0,0,0,'2020-03-06 15:12:24','rava','2020-03-14 08:35:40','rava',0),
(4,4,'197706121998111001','IV','1','-',12,NULL,NULL,NULL,0,NULL,NULL,NULL,NULL,0,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,'2020-03-09 05:27:16','rava','2020-03-14 16:30:12','rava',0);

/*Table structure for table `st_header` */

DROP TABLE IF EXISTS `st_header`;

CREATE TABLE `st_header` (
  `iStId` int(11) NOT NULL AUTO_INCREMENT,
  `iBarcode` int(8) DEFAULT NULL,
  `vNomorCs` varbinary(20) DEFAULT NULL,
  `iBidangId` tinyint(1) DEFAULT NULL,
  `iSubBidangId` tinyint(1) DEFAULT NULL,
  `iJenisRkt` tinyint(1) DEFAULT '0',
  `iJenisSt` tinyint(1) DEFAULT '0',
  `vJenisPenugasan` varbinary(50) DEFAULT NULL,
  `vDasarPenugasan` text,
  `cNoSrtDasar` varchar(50) DEFAULT NULL,
  `dTglSrtDasar` date DEFAULT NULL,
  `cObyekPenugasan` varchar(10) DEFAULT NULL,
  `vUraianPenugasan` text,
  `dMulai` date DEFAULT NULL,
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
  PRIMARY KEY (`iStId`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `st_header` */

insert  into `st_header`(`iStId`,`iBarcode`,`vNomorCs`,`iBidangId`,`iSubBidangId`,`iJenisRkt`,`iJenisSt`,`vJenisPenugasan`,`vDasarPenugasan`,`cNoSrtDasar`,`dTglSrtDasar`,`cObyekPenugasan`,`vUraianPenugasan`,`dMulai`,`nJangkaWaktu`,`iSumberDana`,`iDipaId`,`vUraianSumberDana`,`vDaerahTujuan`,`nNilaiPengajuan`,`nRealiasi`,`cNomorST`,`dTglST`,`tCreated`,`cCreatedBy`,`tUpdated`,`cUpdatedBy`,`lDeleted`) values 
(1,200001,'CS-5/PW04/3/2020',3,NULL,1,1,'KEGIATAN BIDANG AKUNTABILITAS PEMDA','Dasar Penugasan membuat segal','121-1123','2020-03-04','Obejek','Melaksanakan kegiatang yang menjadi tanggung jawab team kita dan memberikan edukasi terhadap masyarakat terkait bayanya Virus Korona','2020-03-04',5,1,1,'',NULL,NULL,NULL,'ST-/SSS/SDS','2020-03-04','2020-03-05 05:41:01','rava','2020-03-08 04:33:42','rava',0),
(2,200002,'CS-1/PW04/1/2020',1,NULL,1,1,'RAPAT KOORDINASI','Pembuatan','123456','2020-03-03','Pembuatan ','dddd','2020-03-04',4,3,0,'Relasisasi dari orang sana',NULL,NULL,NULL,NULL,NULL,'2020-03-06 05:32:45','rava','2020-03-06 06:27:32','rava',0),
(3,200003,'CS-2/PW04/1/2020',1,NULL,0,2,'KEGIATAN SUB BAG UMUM','asa','asa','2020-03-06','ass','aaaa','2020-03-03',23,3,0,'asa',NULL,NULL,NULL,NULL,NULL,'2020-03-06 06:25:20','rava','2020-03-06 09:11:10','rava',1),
(4,200004,NULL,3,NULL,0,1,'KEGIATAN BIDANG AKUNTABILITAS PEMDA','a','w','2020-03-04','q','q','2020-03-04',45,1,1,'',NULL,NULL,NULL,'','0000-00-00','2020-03-09 05:23:38','rava','2020-03-09 05:29:00','rava',0);

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
('BAR','2020',4,'Counter For Barcode Cost Sheet');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
