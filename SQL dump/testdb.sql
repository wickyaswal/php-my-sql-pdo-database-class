/*
Navicat MySQL Data Transfer

Source Server         : localhost_3306
Source Server Version : 50527
Source Host           : localhost:3306
Source Database       : testdb

Target Server Type    : MYSQL
Target Server Version : 50527
File Encoding         : 65001

Date: 2012-11-12 14:07:39
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `persons`
-- ----------------------------
DROP TABLE IF EXISTS `persons`;
CREATE TABLE `persons` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Firstname` varchar(32) DEFAULT NULL,
  `Lastname` varchar(32) DEFAULT NULL,
  `Sex` char(1) DEFAULT NULL,
  `Age` tinyint(3) DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of persons
-- ----------------------------
INSERT INTO `persons` VALUES ('1', 'John', 'Doe', 'M', '19');
INSERT INTO `persons` VALUES ('2', 'Bob', 'Black', 'M', '40');
INSERT INTO `persons` VALUES ('3', 'Zoe', 'Chan', 'F', '21');
INSERT INTO `persons` VALUES ('4', 'Sekito', 'Khan', 'M', '19');
INSERT INTO `persons` VALUES ('5', 'Kader', 'Khan', 'M', '56');
