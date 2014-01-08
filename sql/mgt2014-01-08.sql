/*
SQLyog 企业版 - MySQL GUI v8.14 
MySQL - 5.5.19 : Database - mgt
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`mgt` /*!40100 DEFAULT CHARACTER SET utf8 */;

USE `mgt`;

/*Table structure for table `lesson_pay` */

DROP TABLE IF EXISTS `lesson_pay`;

CREATE TABLE `lesson_pay` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userid` int(11) NOT NULL COMMENT 'userinfo表外键',
  `username` varchar(20) NOT NULL COMMENT '会员名',
  `money` double NOT NULL COMMENT '缴费金额',
  `paytype` varchar(20) NOT NULL COMMENT '缴费方式',
  `paydate` varchar(20) NOT NULL COMMENT '缴费日期',
  `other` varchar(100) DEFAULT NULL COMMENT '备注',
  `recorder` varchar(20) NOT NULL COMMENT '记录人',
  `recordtime` varchar(20) NOT NULL COMMENT '记录时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `lesson_pay` */

LOCK TABLES `lesson_pay` WRITE;

UNLOCK TABLES;

/*Table structure for table `lesson_score` */

DROP TABLE IF EXISTS `lesson_score`;

CREATE TABLE `lesson_score` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cnid` varchar(20) NOT NULL COMMENT '学籍号',
  `userid` int(11) NOT NULL COMMENT '学员ID',
  `username` varchar(20) NOT NULL COMMENT '学员名',
  `workid` int(11) NOT NULL COMMENT '作业ID',
  `score` int(11) NOT NULL COMMENT '成绩',
  `other` varchar(100) DEFAULT NULL COMMENT '备注',
  `modifer` varchar(20) NOT NULL COMMENT '修改人',
  `modiftime` varchar(20) NOT NULL COMMENT '修改日期',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `lesson_score` */

LOCK TABLES `lesson_score` WRITE;

UNLOCK TABLES;

/*Table structure for table `lesson_work` */

DROP TABLE IF EXISTS `lesson_work`;

CREATE TABLE `lesson_work` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL COMMENT '作业标题',
  `note` varchar(500) NOT NULL COMMENT '作业内容',
  `other` varchar(200) DEFAULT NULL COMMENT '备注',
  `memberid` int(11) NOT NULL COMMENT '作业分类',
  `state` int(1) NOT NULL DEFAULT '0' COMMENT '状态',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `lesson_work` */

LOCK TABLES `lesson_work` WRITE;

UNLOCK TABLES;

/*Table structure for table `lesson_xueji` */

DROP TABLE IF EXISTS `lesson_xueji`;

CREATE TABLE `lesson_xueji` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cnid` varchar(20) NOT NULL COMMENT '学籍号',
  `userid` int(11) NOT NULL COMMENT '会员ID',
  `username` varchar(20) NOT NULL COMMENT '会员名',
  `start_date` varchar(20) DEFAULT NULL COMMENT '开学时间',
  `end_date` varchar(20) DEFAULT NULL COMMENT '毕业时间',
  `state` int(1) DEFAULT NULL COMMENT '学籍状态',
  `other` varchar(100) DEFAULT NULL COMMENT '备注',
  `modifer` varchar(20) NOT NULL COMMENT '修改人',
  `modiftime` varchar(20) NOT NULL COMMENT '修改时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `lesson_xueji` */

LOCK TABLES `lesson_xueji` WRITE;

UNLOCK TABLES;

/*Table structure for table `member` */

DROP TABLE IF EXISTS `member`;

CREATE TABLE `member` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `state` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

/*Data for the table `member` */

LOCK TABLES `member` WRITE;

insert  into `member`(`id`,`name`,`state`) values (1,'普通会员',0),(2,'全科课程会员',0),(3,'在线教育会员',0),(4,'俱乐部会员',0);

UNLOCK TABLES;

/*Table structure for table `mgt_module` */

DROP TABLE IF EXISTS `mgt_module`;

CREATE TABLE `mgt_module` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL COMMENT '模块名',
  `url` varchar(100) DEFAULT NULL COMMENT '链接地址',
  `urltype` int(11) NOT NULL DEFAULT '0',
  `type` int(11) NOT NULL DEFAULT '1' COMMENT '模块类型：目录1，文件2',
  `parentid` int(11) NOT NULL DEFAULT '0' COMMENT '上级模块ID',
  `state` int(11) NOT NULL DEFAULT '1' COMMENT '状态：启用1，作废-1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=31 DEFAULT CHARSET=utf8;

/*Data for the table `mgt_module` */

LOCK TABLES `mgt_module` WRITE;

insert  into `mgt_module`(`id`,`name`,`url`,`urltype`,`type`,`parentid`,`state`) values (1,'用户权限管理','',0,1,0,1),(2,'模块管理','',0,1,1,1),(3,'角色管理','',0,1,1,1),(4,'用户管理','',0,1,1,1),(5,'用户角色管理','',0,1,1,1),(6,'模块添加','?dir=admin&control=module&action=add',0,2,2,1),(7,'模块列表','?dir=admin&control=module&action=list',2,2,2,1),(8,'角色添加','?dir=admin&control=rolse&action=add',2,2,3,1),(9,'角色列表','?dir=admin&control=rolse&action=list',2,2,3,1),(10,'新增用户','?dir=admin&control=user&action=add',2,2,4,1),(11,'用户列表','?dir=admin&control=user&action=list',2,2,4,1),(12,'用户角色分配','?dir=admin&control=userrole&action=add',2,2,5,1),(13,'用户角色列表','?dir=admin&control=userrole&action=list',2,2,5,1),(14,'密码修改','?dir=admin&control=user&action=pwd',2,2,4,1),(15,'学员信息管理','',2,1,0,1),(16,'全科学员信息管理','',2,1,0,1),(17,'缴费管理','',2,1,16,1),(18,'学籍管理','',2,1,16,1),(19,'作业管理','',2,1,16,1),(20,'成绩管理','',2,1,16,1),(21,'新学员录入','?dir=mgt&control=userinfo&action=add',2,2,15,1),(22,'学员信息查询','?dir=mgt&control=userinfo&action=list',2,2,15,1),(23,'缴费录入','?dir=mgt&control=pay&action=add',2,2,17,1),(24,'缴费列表','?dir=mgt&control=pay&action=list',2,2,17,1),(25,'学籍录入','?dir=mgt&control=xueji&action=add',2,2,18,1),(26,'学籍查询','?dir=mgt&control=xueji&action=list',2,2,18,1),(27,'作业添加','?dir=mgt&control=work&action=add',2,2,19,1),(28,'作业查询','?dir=mgt&control=work&action=list',2,2,19,1),(29,'成绩录入','?dir=mgt&control=score&action=add',2,2,20,1),(30,'成绩列表','?dir=mgt&control=score&action=list',2,2,20,1);

UNLOCK TABLES;

/*Table structure for table `mgt_rolse` */

DROP TABLE IF EXISTS `mgt_rolse`;

CREATE TABLE `mgt_rolse` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `rolse` varchar(32) NOT NULL COMMENT '角色名',
  `info` varchar(500) DEFAULT NULL COMMENT '角色介绍',
  `modules` varchar(200) NOT NULL COMMENT '包含的模块ID，用,分割',
  `state` int(11) NOT NULL DEFAULT '1' COMMENT '状态：启用1，作废-1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC;

/*Data for the table `mgt_rolse` */

LOCK TABLES `mgt_rolse` WRITE;

insert  into `mgt_rolse`(`id`,`rolse`,`info`,`modules`,`state`) values (1,'管理员','','1,4,10,11,14,5,12,13',1);

UNLOCK TABLES;

/*Table structure for table `mgt_user` */

DROP TABLE IF EXISTS `mgt_user`;

CREATE TABLE `mgt_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(10) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL,
  `email` varchar(30) DEFAULT NULL,
  `registdate` varchar(20) NOT NULL,
  `modifydate` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

/*Data for the table `mgt_user` */

LOCK TABLES `mgt_user` WRITE;

insert  into `mgt_user`(`id`,`name`,`username`,`password`,`email`,`registdate`,`modifydate`) values (1,'admin','超级管理员','123',NULL,'2014-01-01',NULL),(6,'dy','邸永','123',NULL,'2014-01-07 10:34:41',NULL);

UNLOCK TABLES;

/*Table structure for table `mgt_userinfo` */

DROP TABLE IF EXISTS `mgt_userinfo`;

CREATE TABLE `mgt_userinfo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userid` int(11) NOT NULL COMMENT '用户ID',
  `rolses` varchar(100) NOT NULL COMMENT '用户角色列表',
  `state` int(11) NOT NULL DEFAULT '1' COMMENT '状态：启用1，作废-1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC;

/*Data for the table `mgt_userinfo` */

LOCK TABLES `mgt_userinfo` WRITE;

insert  into `mgt_userinfo`(`id`,`userid`,`rolses`,`state`) values (1,6,'1',1);

UNLOCK TABLES;

/*Table structure for table `userinfo` */

DROP TABLE IF EXISTS `userinfo`;

CREATE TABLE `userinfo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(10) DEFAULT NULL COMMENT '登录名',
  `password` varchar(50) DEFAULT NULL COMMENT '密码',
  `username` varchar(10) NOT NULL COMMENT '真实姓名',
  `sex` int(1) NOT NULL DEFAULT '0' COMMENT '性别 男1 女2',
  `birth` varchar(10) DEFAULT NULL COMMENT '出生年月',
  `sfz` varchar(20) DEFAULT NULL COMMENT '身份证号码',
  `province` varchar(20) DEFAULT NULL COMMENT '省份',
  `city` varchar(20) DEFAULT NULL COMMENT '城市',
  `address` varchar(50) DEFAULT NULL COMMENT '通讯地址',
  `post` varchar(10) DEFAULT NULL COMMENT '邮编',
  `mobile` varchar(20) DEFAULT NULL COMMENT '手机号',
  `phone` varchar(20) DEFAULT NULL COMMENT '备用电话',
  `email` varchar(20) DEFAULT NULL COMMENT '电子邮箱',
  `createtime` varchar(20) DEFAULT NULL COMMENT '创建时间',
  `picture` mediumblob COMMENT '照片',
  `photo_url` varchar(200) DEFAULT NULL COMMENT '照片地址',
  `memberid` int(11) DEFAULT '0' COMMENT '会员类型',
  `member` varchar(20) DEFAULT NULL COMMENT '会员名称',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

/*Data for the table `userinfo` */

LOCK TABLES `userinfo` WRITE;

insert  into `userinfo`(`id`,`name`,`password`,`username`,`sex`,`birth`,`sfz`,`province`,`city`,`address`,`post`,`mobile`,`phone`,`email`,`createtime`,`picture`,`photo_url`,`memberid`,`member`) values (1,NULL,NULL,'dyong',1,'','','','','','','','','','',NULL,NULL,2,'全科课程会员'),(2,NULL,NULL,'admin',1,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,3,'在线教育会员');

UNLOCK TABLES;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
