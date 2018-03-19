/*
Navicat MySQL Data Transfer

Source Server         : root
Source Server Version : 50719
Source Host           : localhost:3306
Source Database       : blog

Target Server Type    : MYSQL
Target Server Version : 50719
File Encoding         : 65001

Date: 2018-03-19 15:45:36
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `blogs`
-- ----------------------------
DROP TABLE IF EXISTS `blogs`;
CREATE TABLE `blogs` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `cid` tinyint(4) NOT NULL,
  `title` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `create_time` datetime NOT NULL,
  `avatar` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of blogs
-- ----------------------------
INSERT INTO `blogs` VALUES ('11', '2', 'mysql 整数型变量', '2018-03-19 12:37:02', './article/1.html');

-- ----------------------------
-- Table structure for `category`
-- ----------------------------
DROP TABLE IF EXISTS `category`;
CREATE TABLE `category` (
  `id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `category` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `avatar` varchar(80) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of category
-- ----------------------------
INSERT INTO `category` VALUES ('1', 'PHP', null);
INSERT INTO `category` VALUES ('2', 'MySQL', null);
INSERT INTO `category` VALUES ('3', 'Linux', null);
INSERT INTO `category` VALUES ('4', 'HTML', null);
INSERT INTO `category` VALUES ('5', 'javasctipt', null);
INSERT INTO `category` VALUES ('6', 'CSS', null);
INSERT INTO `category` VALUES ('7', 'Think3.2', null);
INSERT INTO `category` VALUES ('8', 'CodeIginter', null);

-- ----------------------------
-- Table structure for `users`
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES ('1', 'yuege', '$2y$10$pnicg/FNwNuYHIy2zlbbjexz.MRd2iiHzkUe/pmUT0xnKxh5lDzDK');
