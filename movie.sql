/*
Navicat MySQL Data Transfer

Source Server         : php
Source Server Version : 50726
Source Host           : localhost:3306
Source Database       : movie

Target Server Type    : MYSQL
Target Server Version : 50726
File Encoding         : 65001

Date: 2020-12-30 18:07:00
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for comment
-- ----------------------------
DROP TABLE IF EXISTS `comment`;
CREATE TABLE `comment` (
  `cid` int(11) NOT NULL AUTO_INCREMENT,
  `commentTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `commentText` varchar(100) NOT NULL,
  `vid` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  PRIMARY KEY (`cid`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of comment
-- ----------------------------
INSERT INTO `comment` VALUES ('3', '2020-12-06 10:56:55', '该用户因为违规发言，评论已被和谐', '2', '1');
INSERT INTO `comment` VALUES ('4', '2020-12-06 11:00:23', '测试\r\n哈哈哈哈', '2', '1');
INSERT INTO `comment` VALUES ('5', '2020-12-06 11:03:27', '哈哈哈哈123', '2', '1');
INSERT INTO `comment` VALUES ('6', '2020-12-06 11:03:48', '哈哈哈哈1213', '2', '1');
INSERT INTO `comment` VALUES ('7', '2020-12-11 11:04:16', 'sasasa', '2', '1');
INSERT INTO `comment` VALUES ('8', '2020-12-13 11:05:01', 'asssdfd', '3', '1');
INSERT INTO `comment` VALUES ('11', '2020-12-28 21:43:27', 'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa', '8', '7');
INSERT INTO `comment` VALUES ('15', '2020-12-29 22:25:44', '好看好看', '8', '2');

-- ----------------------------
-- Table structure for like
-- ----------------------------
DROP TABLE IF EXISTS `like`;
CREATE TABLE `like` (
  `lid` int(11) NOT NULL AUTO_INCREMENT,
  `vid` int(11) NOT NULL,
  `userIP` varchar(40) NOT NULL,
  PRIMARY KEY (`lid`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of like
-- ----------------------------
INSERT INTO `like` VALUES ('12', '8', '127.0.0.1');
INSERT INTO `like` VALUES ('13', '3', '127.0.0.1');
INSERT INTO `like` VALUES ('14', '8', '::1');
INSERT INTO `like` VALUES ('15', '2', '::1');
INSERT INTO `like` VALUES ('16', '7', '192.168.1.107');
INSERT INTO `like` VALUES ('17', '1', '192.168.1.100');
INSERT INTO `like` VALUES ('18', '1', '::1');
INSERT INTO `like` VALUES ('19', '11', '::1');
INSERT INTO `like` VALUES ('20', '6', '192.168.1.107');
INSERT INTO `like` VALUES ('21', '1', '192.168.1.107');
INSERT INTO `like` VALUES ('22', '5', '192.168.1.107');
INSERT INTO `like` VALUES ('23', '6', '::1');

-- ----------------------------
-- Table structure for user
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `uid` int(11) NOT NULL AUTO_INCREMENT,
  `userName` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `avatar` varchar(50) NOT NULL DEFAULT 'Nav.png',
  `regtime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `gender` smallint(6) NOT NULL DEFAULT '1',
  `power` smallint(6) NOT NULL DEFAULT '0',
  PRIMARY KEY (`uid`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of user
-- ----------------------------
INSERT INTO `user` VALUES ('1', 'yyh', 'e10adc3949ba59abbe56e057f20f883e', '3044808977@qq.com', 'Nav.png', '2020-11-04 14:51:00', '1', '0');
INSERT INTO `user` VALUES ('2', 'admin', '21232f297a57a5a743894a0e4a801fc3', '222146140@qq.com', 'Nav.png', '2020-11-05 13:02:47', '1', '1');
INSERT INTO `user` VALUES ('4', 'yeyouhui', '25d55ad283aa400af464c76d713c07ad', '3044808977@qq.com', '20201230143039342.jpg', '2020-11-24 10:18:06', '1', '0');
INSERT INTO `user` VALUES ('5', 'yeyouhui123', 'e10adc3949ba59abbe56e057f20f883e', '2221464140@qq.com', 'Nav.png', '2020-12-04 10:20:22', '1', '0');
INSERT INTO `user` VALUES ('6', '2018', '1de4f015eedd91ca5dc72ade2136ef54', '15151@qq.com', 'Nav.png', '2020-12-18 12:24:24', '1', '0');
INSERT INTO `user` VALUES ('7', '111', '5abd06d6f6ef0e022e11b8a41f57ebda', '123@123.com', 'Nav.png', '2020-12-28 21:41:57', '1', '0');

-- ----------------------------
-- Table structure for video
-- ----------------------------
DROP TABLE IF EXISTS `video`;
CREATE TABLE `video` (
  `vid` int(11) NOT NULL AUTO_INCREMENT,
  `videoName` varchar(50) NOT NULL,
  `videoTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `videoUrl` varchar(100) NOT NULL,
  PRIMARY KEY (`vid`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of video
-- ----------------------------
INSERT INTO `video` VALUES ('2', '刀剑神域', '2020-12-05 15:45:38', './videos/20201227223541152.mp4');
INSERT INTO `video` VALUES ('3', '狐妖小红娘', '2020-12-05 22:49:32', './videos/20201227223541152.mp4');
INSERT INTO `video` VALUES ('4', '火影忍者', '2020-12-06 09:41:47', './videos/20201227223541152.mp4');
INSERT INTO `video` VALUES ('5', '从零开始的异世界生活', '2020-12-06 09:49:05', './videos/20201227223541152.mp4');
INSERT INTO `video` VALUES ('6', 'Fate', '2020-12-06 09:49:05', './videos/20201227223541152.mp4');
INSERT INTO `video` VALUES ('7', '妖精的尾巴', '2020-12-06 09:49:05', './videos/20201227223541152.mp4');
INSERT INTO `video` VALUES ('8', '龙珠超', '2020-12-08 16:40:09', './videos/20201227223541152.mp4');
INSERT INTO `video` VALUES ('9', '犬夜叉', '2020-12-27 15:26:36', './videos/20201227223541152.mp4');
INSERT INTO `video` VALUES ('11', '全职高手', '2020-12-30 14:36:38', './videos/20201230143638654.mp4');

-- ----------------------------
-- Table structure for video_adventure
-- ----------------------------
DROP TABLE IF EXISTS `video_adventure`;
CREATE TABLE `video_adventure` (
  `vid` int(11) NOT NULL,
  PRIMARY KEY (`vid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of video_adventure
-- ----------------------------
INSERT INTO `video_adventure` VALUES ('4');
INSERT INTO `video_adventure` VALUES ('5');
INSERT INTO `video_adventure` VALUES ('6');
INSERT INTO `video_adventure` VALUES ('7');
INSERT INTO `video_adventure` VALUES ('8');
INSERT INTO `video_adventure` VALUES ('9');

-- ----------------------------
-- Table structure for video_battle
-- ----------------------------
DROP TABLE IF EXISTS `video_battle`;
CREATE TABLE `video_battle` (
  `vid` int(11) NOT NULL,
  PRIMARY KEY (`vid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of video_battle
-- ----------------------------
INSERT INTO `video_battle` VALUES ('2');
INSERT INTO `video_battle` VALUES ('11');

-- ----------------------------
-- Table structure for video_desc
-- ----------------------------
DROP TABLE IF EXISTS `video_desc`;
CREATE TABLE `video_desc` (
  `vid` int(11) NOT NULL AUTO_INCREMENT,
  `coverUrl` varchar(100) NOT NULL,
  `videoDesc` varchar(200) NOT NULL DEFAULT '暂无视频简介',
  `likeCount` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`vid`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of video_desc
-- ----------------------------
INSERT INTO `video_desc` VALUES ('2', './img/2.jpg', '暂无视频简介?不，这是一个测试视频，当然需要有简介。', '1');
INSERT INTO `video_desc` VALUES ('3', './img/3.jpg', '暂无视频简介?不，这是一个测试视频，当然需要有简介。', '1');
INSERT INTO `video_desc` VALUES ('4', './img/4.jpg', '暂无视频简介?不，这是一个测试视频，当然需要有简介。', '2');
INSERT INTO `video_desc` VALUES ('5', './img/5.jpg', '暂无视频简介?不，这是一个测试视频，当然需要有简介。', '1');
INSERT INTO `video_desc` VALUES ('6', './img/6.jpg', '暂无视频简介?不，这是一个测试视频，当然需要有简介。', '7');
INSERT INTO `video_desc` VALUES ('7', './img/7.jpg', '暂无视频简介?不，这是一个测试视频，当然需要有简介。', '1');
INSERT INTO `video_desc` VALUES ('8', './img/8.jpg', '暂无视频简介?不，这是一个测试视频，当然需要有简介。', '3');
INSERT INTO `video_desc` VALUES ('9', './img/9.jpg', '哈哈哈', '7');
INSERT INTO `video_desc` VALUES ('11', './img/20201230143638648.jpg', '全职高手非常好看呢', '0');

-- ----------------------------
-- Table structure for video_funny
-- ----------------------------
DROP TABLE IF EXISTS `video_funny`;
CREATE TABLE `video_funny` (
  `vid` int(11) NOT NULL,
  PRIMARY KEY (`vid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of video_funny
-- ----------------------------
INSERT INTO `video_funny` VALUES ('2');
INSERT INTO `video_funny` VALUES ('3');

-- ----------------------------
-- Table structure for video_other
-- ----------------------------
DROP TABLE IF EXISTS `video_other`;
CREATE TABLE `video_other` (
  `vid` int(11) NOT NULL,
  PRIMARY KEY (`vid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of video_other
-- ----------------------------
