/*
Navicat MariaDB Data Transfer

Source Server         : LocalDB
Source Server Version : 100418
Source Host           : localhost:3306
Source Database       : pwl_2021

Target Server Type    : MariaDB
Target Server Version : 100418
File Encoding         : 65001

Date: 2021-10-23 20:27:10
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for app_session
-- ----------------------------
DROP TABLE IF EXISTS `app_session`;
CREATE TABLE `app_session` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Username` varchar(20) NOT NULL,
  `Password` varchar(50) NOT NULL,
  `CreatedAt` timestamp NOT NULL DEFAULT current_timestamp(),
  `CreatedBy` varchar(20) NOT NULL,
  `UpdatedAt` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `UpdatedBy` int(11) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of app_session
-- ----------------------------
INSERT INTO `app_session` VALUES ('1', 'febry.fairuz', 'e10adc3949ba59abbe56e057f20f883e', '2021-10-02 19:48:35', 'system', '2021-10-23 19:34:31', '0');
