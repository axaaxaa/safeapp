/*
 Navicat Premium Data Transfer

 Source Server         : vagrant
 Source Server Type    : MySQL
 Source Server Version : 50715
 Source Host           : localhost
 Source Database       : safeapp

 Target Server Type    : MySQL
 Target Server Version : 50715
 File Encoding         : utf-8

 Date: 12/25/2016 20:39:01 PM
*/

SET NAMES utf8;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
--  Table structure for `data_admin`
-- ----------------------------
DROP TABLE IF EXISTS `data_admin`;
CREATE TABLE `data_admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) DEFAULT NULL,
  `password` char(32) DEFAULT NULL,
  `weight` tinyint(1) DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL,
  `add_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Records of `data_admin`
-- ----------------------------
BEGIN;
INSERT INTO `data_admin` VALUES ('1', 'admin', 'e3157b4214ccfd2124a00df8088add31', null, null, null);
COMMIT;

-- ----------------------------
--  Table structure for `data_users`
-- ----------------------------
DROP TABLE IF EXISTS `data_users`;
CREATE TABLE `data_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `guid` char(32) NOT NULL,
  `username` varchar(255) DEFAULT NULL,
  `phone` char(11) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `add_time` int(11) DEFAULT NULL,
  `password` char(32) DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Records of `data_users`
-- ----------------------------
BEGIN;
INSERT INTO `data_users` VALUES ('1', '14389173cb8a453b9a4b3fdf416144e1', 'limingxia', '18810537353', 'lilian1131@163.com', null, 'e3157b4214ccfd2124a00df8088add31'), ('6', '27ead742ca7b11e6b820080027d97380', 'aaaxia', '18810537353', null, null, ''), ('7', '3c9dcd30ca8e11e688a1080027d97380', 'linjunjie', '17600195424', null, null, ''), ('8', '84436fa8ca9511e69cd7080027d97380', '1111', '12220537353', '1@qq.com', null, '9d28867c5ecfed8061f7a21deac504d0');
COMMIT;

SET FOREIGN_KEY_CHECKS = 1;
