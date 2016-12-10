/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50617
Source Host           : localhost:3306
Source Database       : caijia

Target Server Type    : MYSQL
Target Server Version : 50617
File Encoding         : 65001

Date: 2016-12-10 10:58:27
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `admin`
-- ----------------------------
DROP TABLE IF EXISTS `admin`;
CREATE TABLE `admin` (
  `id` int(32) NOT NULL AUTO_INCREMENT,
  `username` varchar(16) NOT NULL DEFAULT '',
  `password` char(32) NOT NULL DEFAULT '',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '状态，0禁用，1启用',
  `openid` varchar(64) NOT NULL DEFAULT '' COMMENT '管理员微信号',
  `last_login` int(32) NOT NULL DEFAULT '0',
  `last_ip` varchar(32) NOT NULL DEFAULT '',
  `role_id` int(10) NOT NULL DEFAULT '0' COMMENT '角色ID',
  `login_num` int(32) NOT NULL DEFAULT '0',
  `create_by` varchar(16) NOT NULL DEFAULT '' COMMENT '创建者',
  `created` int(32) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='管理员表';

-- ----------------------------
-- Records of admin
-- ----------------------------
INSERT INTO `admin` VALUES ('1', 'admin', '21232f297a57a5a743894a0e4a801fc3', '1', 'ohs_4sgyk31vkfKLHy2wg5HrrGeo', '1481293985', '127.0.0.1', '1', '497', '', '1360085491');

-- ----------------------------
-- Table structure for `announce`
-- ----------------------------
DROP TABLE IF EXISTS `announce`;
CREATE TABLE `announce` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `title` varchar(64) NOT NULL DEFAULT '' COMMENT '标题',
  `content` text NOT NULL COMMENT '内容',
  `created` int(11) NOT NULL COMMENT '创建时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of announce
-- ----------------------------
INSERT INTO `announce` VALUES ('2', '2222', '&#60;p&#62;3333333&#60;span&#32;style&#61;&#34;color:&#32;rgb(255,&#32;0,&#32;0)&#59;&#34;&#62;ssdsdsd&#60;&#47;span&#62;&#60;&#47;p&#62;', '1481200349');

-- ----------------------------
-- Table structure for `area`
-- ----------------------------
DROP TABLE IF EXISTS `area`;
CREATE TABLE `area` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `areaname` varchar(32) NOT NULL DEFAULT '' COMMENT '城市名称',
  `areacode` varchar(16) NOT NULL DEFAULT '' COMMENT '城市码',
  `fullname` varchar(128) NOT NULL DEFAULT '' COMMENT '地区全称',
  `level` tinyint(2) DEFAULT NULL COMMENT '等级',
  `pid` int(11) DEFAULT NULL COMMENT '上级ID',
  `created` int(11) NOT NULL DEFAULT '0' COMMENT '创建时间',
  PRIMARY KEY (`id`),
  UNIQUE KEY `areacode` (`areacode`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of area
-- ----------------------------
INSERT INTO `area` VALUES ('1', '宁德市', '101', '宁德市', '1', '0', '1480951069');
INSERT INTO `area` VALUES ('2', '厦门市', '102', '厦门市', '1', '0', '1480951086');
INSERT INTO `area` VALUES ('3', '蕉城区', '101101', '宁德市,蕉城区', '2', '1', '1480951099');
INSERT INTO `area` VALUES ('4', '古田', '101102', '宁德市,古田', '2', '1', '1480951119');
INSERT INTO `area` VALUES ('5', '漳湾镇', '101101101', '宁德市,蕉城区,漳湾镇', '3', '3', '1480951133');
INSERT INTO `area` VALUES ('7', '漳湾村', '101101101101', '宁德市,蕉城区,漳湾镇,漳湾村', '4', '5', '1480951161');
INSERT INTO `area` VALUES ('8', '郑歧村', '101101101102', '宁德市,蕉城区,漳湾镇,郑歧村', '4', '5', '1481120734');
INSERT INTO `area` VALUES ('9', '八都镇', '101101102', '宁德市,蕉城区,八都镇', '3', '3', '1481120745');
INSERT INTO `area` VALUES ('10', '云淡村', '101101102101', '宁德市,蕉城区,八都镇,云淡村', '4', '9', '1481120756');
INSERT INTO `area` VALUES ('11', '思明区', '102101', '厦门市,思明区', '2', '2', '1481120765');

-- ----------------------------
-- Table structure for `charge`
-- ----------------------------
DROP TABLE IF EXISTS `charge`;
CREATE TABLE `charge` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `name` varchar(32) NOT NULL DEFAULT '' COMMENT '姓名',
  `depart_id` int(11) NOT NULL COMMENT '主管部门',
  `mobile` varchar(16) NOT NULL DEFAULT '' COMMENT '联系方式',
  `password` char(32) NOT NULL DEFAULT '' COMMENT '密码',
  `created` int(11) NOT NULL COMMENT '创建时间',
  PRIMARY KEY (`id`),
  UNIQUE KEY `mobile` (`mobile`),
  KEY `depart_id` (`depart_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COMMENT='主管成员';

-- ----------------------------
-- Records of charge
-- ----------------------------
INSERT INTO `charge` VALUES ('2', 'lzy', '3', '18922835259', '1c395a8dce135849bd73c6dba3b54809', '1481118418');

-- ----------------------------
-- Table structure for `depart`
-- ----------------------------
DROP TABLE IF EXISTS `depart`;
CREATE TABLE `depart` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `name` varchar(32) NOT NULL DEFAULT '' COMMENT '单位名称',
  `created` int(11) NOT NULL COMMENT '创建时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of depart
-- ----------------------------
INSERT INTO `depart` VALUES ('2', '2222', '1481105845');
INSERT INTO `depart` VALUES ('3', '3333', '1481105944');
INSERT INTO `depart` VALUES ('4', 'dddd', '1481119334');

-- ----------------------------
-- Table structure for `goods`
-- ----------------------------
DROP TABLE IF EXISTS `goods`;
CREATE TABLE `goods` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `name` varchar(64) NOT NULL DEFAULT '' COMMENT '商品名称',
  `cat_id` int(11) NOT NULL COMMENT '分类ID',
  `created` int(11) NOT NULL COMMENT '创建时间',
  PRIMARY KEY (`id`),
  KEY `cat_id` (`cat_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of goods
-- ----------------------------
INSERT INTO `goods` VALUES ('3', '111', '26', '1481255380');
INSERT INTO `goods` VALUES ('4', '22', '26', '1481263003');
INSERT INTO `goods` VALUES ('5', '33', '28', '1481263009');
INSERT INTO `goods` VALUES ('6', '44', '29', '1481263017');
INSERT INTO `goods` VALUES ('7', '55', '28', '1481263022');

-- ----------------------------
-- Table structure for `goods_category`
-- ----------------------------
DROP TABLE IF EXISTS `goods_category`;
CREATE TABLE `goods_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `name` varchar(32) NOT NULL DEFAULT '' COMMENT '分类名称',
  `pid` int(11) NOT NULL COMMENT '上级分类ID',
  `fullname` varchar(64) NOT NULL DEFAULT '' COMMENT '完整分类名称',
  `unit` varchar(16) NOT NULL DEFAULT '' COMMENT '单位',
  `level` tinyint(2) NOT NULL DEFAULT '1' COMMENT '分类等级',
  `created` int(11) NOT NULL COMMENT '创建时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of goods_category
-- ----------------------------
INSERT INTO `goods_category` VALUES ('25', '33', '0', '33', '55', '1', '1481209450');
INSERT INTO `goods_category` VALUES ('26', '44', '25', '33,44', '55', '2', '1481209454');
INSERT INTO `goods_category` VALUES ('27', '55', '0', '55', '55', '1', '1481211953');
INSERT INTO `goods_category` VALUES ('28', '66', '27', '55,66', '55', '2', '1481212003');
INSERT INTO `goods_category` VALUES ('29', '77', '27', '55,77', '55', '2', '1481212110');
INSERT INTO `goods_category` VALUES ('30', '88', '27', '55,88', '55', '2', '1481262579');

-- ----------------------------
-- Table structure for `news`
-- ----------------------------
DROP TABLE IF EXISTS `news`;
CREATE TABLE `news` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(128) NOT NULL DEFAULT '' COMMENT '标题',
  `summary` varchar(512) NOT NULL DEFAULT '' COMMENT '摘要',
  `cate_id` int(11) NOT NULL DEFAULT '0' COMMENT '分类',
  `image` varchar(256) NOT NULL DEFAULT '' COMMENT '图片地址',
  `content` longtext,
  `view_count` smallint(6) NOT NULL DEFAULT '0' COMMENT '浏览次数',
  `is_hot` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否热门',
  `create_time` int(11) NOT NULL DEFAULT '0' COMMENT '发布时间',
  `seo_title` varchar(64) NOT NULL DEFAULT '' COMMENT '标题',
  `seo_keyword` varchar(512) NOT NULL DEFAULT '' COMMENT '关键词',
  `seo_description` text COMMENT '描述',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of news
-- ----------------------------
INSERT INTO `news` VALUES ('1', '国金所金融控股董事长何玉山受邀云滴科技开幕典礼', '云滴公司是一家综合型互联网公司，隶属于云南盛达集团。云滴公司服务面涵盖交通，旅游，物流，教育，农业，金融等多个领域，充分发挥互联网在社会资源配置中的优化和集成作用，将互联网的创新成果深度融合于各个领域之中。', '1', '/static/images/news/news-cover-big.png', '&#60;p&#62;云滴公司是一家综合型互联网公司，隶属于云南盛达集团。云滴公司服务面涵盖交通，旅游，物流，教育，农业，金融等多个领域，充分发挥互联网在社会资源配置中的优化和集成作用，将互联网的创新成果深度融合于各个领域之中。&#60;&#47;p&#62;', '1232', '1', '1462519710', '', '', null);

-- ----------------------------
-- Table structure for `news_category`
-- ----------------------------
DROP TABLE IF EXISTS `news_category`;
CREATE TABLE `news_category` (
  `id` int(32) NOT NULL AUTO_INCREMENT,
  `name` varchar(64) NOT NULL DEFAULT '' COMMENT '新闻类名称',
  `pid` tinyint(2) NOT NULL DEFAULT '0',
  `sort` int(11) NOT NULL DEFAULT '0' COMMENT '排序',
  `created` int(32) NOT NULL DEFAULT '0',
  `seo_title` varchar(64) NOT NULL DEFAULT '' COMMENT '标题',
  `seo_keyword` varchar(512) NOT NULL DEFAULT '' COMMENT '关键词',
  `seo_description` text COMMENT '描述',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of news_category
-- ----------------------------
INSERT INTO `news_category` VALUES ('1', '云滴旅行', '0', '10', '1463559139', '', '', null);
INSERT INTO `news_category` VALUES ('2', '云滴生活', '0', '20', '1463559149', '', '', null);
INSERT INTO `news_category` VALUES ('3', '云滴活动', '0', '30', '1463559157', '', '', null);
INSERT INTO `news_category` VALUES ('4', '云滴动态', '0', '40', '1463559165', '', '', null);

-- ----------------------------
-- Table structure for `place`
-- ----------------------------
DROP TABLE IF EXISTS `place`;
CREATE TABLE `place` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `areacode` varchar(16) NOT NULL DEFAULT '' COMMENT '采价点编码',
  `name` varchar(32) NOT NULL DEFAULT '' COMMENT '采价点名称',
  `weight` float(8,2) NOT NULL COMMENT '权重',
  `created` int(11) NOT NULL DEFAULT '0' COMMENT '创建时间',
  PRIMARY KEY (`id`),
  KEY `areacode` (`areacode`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of place
-- ----------------------------
INSERT INTO `place` VALUES ('4', '101', '东湖市场', '0.10', '1481030557');
INSERT INTO `place` VALUES ('5', '101', '111', '0.10', '1481032850');
INSERT INTO `place` VALUES ('6', '101101101101', 'ddd', '0.40', '1481034076');
INSERT INTO `place` VALUES ('7', '101101101101', '13232', '0.20', '1481034105');
INSERT INTO `place` VALUES ('8', '101101101', 'dddd', '0.20', '1481125122');
INSERT INTO `place` VALUES ('9', '101101101102', 'asdf', '0.30', '1481125134');

-- ----------------------------
-- Table structure for `project`
-- ----------------------------
DROP TABLE IF EXISTS `project`;
CREATE TABLE `project` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `name` varchar(64) NOT NULL DEFAULT '' COMMENT '项目名称',
  `begin_date` int(11) NOT NULL DEFAULT '0' COMMENT '开始日期',
  `end_date` int(11) NOT NULL DEFAULT '0' COMMENT '结束日期',
  `desc` text NOT NULL COMMENT '项目简介',
  `place_ids` varchar(64) NOT NULL COMMENT '采价点IDs',
  `goods_ids` varchar(64) NOT NULL COMMENT '商品IDs',
  `first` varchar(32) NOT NULL DEFAULT '' COMMENT '第一次采价时间',
  `second` varchar(32) NOT NULL DEFAULT '' COMMENT '第二次采价时间',
  `depart_ids` varchar(64) NOT NULL DEFAULT '' COMMENT '部门IDs',
  `created` int(11) NOT NULL DEFAULT '0' COMMENT '创建时间',
  PRIMARY KEY (`id`),
  KEY `begin_date` (`begin_date`),
  KEY `end_date` (`end_date`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of project
-- ----------------------------
INSERT INTO `project` VALUES ('19', '1', '1481126400', '1481212800', '&#60;p&#62;111&#60;&#47;p&#62;', '', '3,4,5,7', '7:00-17:30', '', '2,3,4', '1481294209');
INSERT INTO `project` VALUES ('20', '2', '1481126400', '1481212800', '&#60;p&#62;1111&#60;&#47;p&#62;', '', '3,4,5,7,6', '7:00-17:30', '', '2,3,4', '1481294539');
INSERT INTO `project` VALUES ('21', '3', '1481212800', '1481904000', '&#60;p&#62;1111&#60;br&#47;&#62;&#60;&#47;p&#62;', '', '', '1:1-2:2', '1:1-2:2', '2,3,4', '1481337897');
INSERT INTO `project` VALUES ('22', '4', '1481385600', '1481558400', 'dsf', '', '', '1:1-2:2', '', '2,3,4', '1481338554');

-- ----------------------------
-- Table structure for `project_depart_relation`
-- ----------------------------
DROP TABLE IF EXISTS `project_depart_relation`;
CREATE TABLE `project_depart_relation` (
  `project_id` int(11) NOT NULL COMMENT '项目ID',
  `depart_id` int(11) NOT NULL COMMENT '部门ID',
  UNIQUE KEY `project_depart_id` (`project_id`,`depart_id`),
  KEY `project_id` (`project_id`),
  KEY `depart_id` (`depart_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of project_depart_relation
-- ----------------------------
INSERT INTO `project_depart_relation` VALUES ('19', '2');
INSERT INTO `project_depart_relation` VALUES ('19', '3');
INSERT INTO `project_depart_relation` VALUES ('19', '4');
INSERT INTO `project_depart_relation` VALUES ('20', '2');
INSERT INTO `project_depart_relation` VALUES ('20', '3');
INSERT INTO `project_depart_relation` VALUES ('20', '4');
INSERT INTO `project_depart_relation` VALUES ('21', '2');
INSERT INTO `project_depart_relation` VALUES ('21', '3');
INSERT INTO `project_depart_relation` VALUES ('21', '4');
INSERT INTO `project_depart_relation` VALUES ('22', '2');
INSERT INTO `project_depart_relation` VALUES ('22', '3');
INSERT INTO `project_depart_relation` VALUES ('22', '4');

-- ----------------------------
-- Table structure for `project_goods_relation`
-- ----------------------------
DROP TABLE IF EXISTS `project_goods_relation`;
CREATE TABLE `project_goods_relation` (
  `project_id` int(11) NOT NULL COMMENT '项目ID',
  `goods_id` int(11) NOT NULL COMMENT '商品ID',
  UNIQUE KEY `project_goods_id` (`project_id`,`goods_id`) USING BTREE,
  KEY `project_id` (`project_id`),
  KEY `goods_id` (`goods_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of project_goods_relation
-- ----------------------------

-- ----------------------------
-- Table structure for `project_place_relation`
-- ----------------------------
DROP TABLE IF EXISTS `project_place_relation`;
CREATE TABLE `project_place_relation` (
  `project_id` int(11) NOT NULL COMMENT '项目ID',
  `place_id` int(11) NOT NULL COMMENT '采价点ID',
  UNIQUE KEY `project_place_id` (`project_id`,`place_id`),
  KEY `project_id` (`project_id`),
  KEY `place_id` (`place_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of project_place_relation
-- ----------------------------

-- ----------------------------
-- Table structure for `upload`
-- ----------------------------
DROP TABLE IF EXISTS `upload`;
CREATE TABLE `upload` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `user_type` int(10) NOT NULL DEFAULT '0' COMMENT '用户类型，管理平台0',
  `user_id` int(10) NOT NULL COMMENT '用户ID',
  `item_type` int(10) NOT NULL DEFAULT '0',
  `item_id` int(10) NOT NULL DEFAULT '0',
  `name` varchar(100) NOT NULL,
  `file` varchar(50) NOT NULL,
  `size` int(10) NOT NULL DEFAULT '0',
  `ext` varchar(5) NOT NULL,
  `thumbs` varchar(32) NOT NULL COMMENT '缩略图',
  `uniqid` varchar(15) NOT NULL,
  `status` tinyint(2) NOT NULL DEFAULT '1' COMMENT '1->被使用，2->已删除',
  `created` int(10) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`),
  UNIQUE KEY `file` (`file`)
) ENGINE=InnoDB AUTO_INCREMENT=62 DEFAULT CHARSET=utf8 COMMENT='上传表';

-- ----------------------------
-- Records of upload
-- ----------------------------
INSERT INTO `upload` VALUES ('1', '0', '0', '0', '0', '573c4331bf0af.jpg', '/upload/1605/1818/25/573c4331bf0af.jpg', '162944', 'jpg', '', '', '1', '1463567153');
INSERT INTO `upload` VALUES ('2', '0', '0', '0', '0', '573c43782e07a.jpg', '/upload/1605/1818/27/573c43782e07a.jpg', '233009', 'jpg', '', '', '1', '1463567224');
INSERT INTO `upload` VALUES ('3', '0', '0', '0', '0', '573c438838ff0.jpg', '/upload/1605/1818/27/573c438838ff0.jpg', '233009', 'jpg', '', '', '1', '1463567240');
INSERT INTO `upload` VALUES ('4', '0', '0', '0', '0', '573c43c2c4bae.jpg', '/upload/1605/1818/28/573c43c2c4bae.jpg', '233009', 'jpg', '', '', '1', '1463567298');
INSERT INTO `upload` VALUES ('5', '0', '0', '0', '0', '573c440b11133.jpg', '/upload/1605/1818/29/573c440b11133.jpg', '233009', 'jpg', '', '', '1', '1463567371');
INSERT INTO `upload` VALUES ('6', '0', '0', '0', '0', '573c4432918e8.jpg', '/upload/1605/1818/30/573c4432918e8.jpg', '233009', 'jpg', '', '', '1', '1463567410');
INSERT INTO `upload` VALUES ('7', '0', '0', '0', '0', '573c4479c41c9.jpg', '/upload/1605/1818/31/573c4479c41c9.jpg', '233009', 'jpg', '', '', '1', '1463567481');
INSERT INTO `upload` VALUES ('8', '0', '0', '0', '0', '573c44878456b.jpg', '/upload/1605/1818/31/573c44878456b.jpg', '233009', 'jpg', '', '', '1', '1463567495');
INSERT INTO `upload` VALUES ('9', '0', '0', '0', '0', '573c449dd0557.jpg', '/upload/1605/1818/31/573c449dd0557.jpg', '233009', 'jpg', '', '', '1', '1463567517');
INSERT INTO `upload` VALUES ('10', '0', '0', '0', '0', '573c44cd61e9e.jpg', '/upload/1605/1818/32/573c44cd61e9e.jpg', '233009', 'jpg', '', '', '1', '1463567565');
INSERT INTO `upload` VALUES ('11', '0', '0', '0', '0', '573c44e18559f.jpg', '/upload/1605/1818/33/573c44e18559f.jpg', '162944', 'jpg', '', '', '1', '1463567585');
INSERT INTO `upload` VALUES ('12', '0', '0', '0', '0', '573c44e8906fa.jpg', '/upload/1605/1818/33/573c44e8906fa.jpg', '233009', 'jpg', '', '', '1', '1463567592');
INSERT INTO `upload` VALUES ('13', '0', '0', '0', '0', '573c44e89f92d.jpg', '/upload/1605/1818/33/573c44e89f92d.jpg', '162944', 'jpg', '', '', '1', '1463567592');
INSERT INTO `upload` VALUES ('14', '0', '0', '0', '0', '573c45177d50d.jpg', '/upload/1605/1818/33/573c45177d50d.jpg', '162944', 'jpg', '', '', '1', '1463567639');
INSERT INTO `upload` VALUES ('15', '0', '0', '0', '0', '573c452d935a5.jpg', '/upload/1605/1818/34/573c452d935a5.jpg', '233009', 'jpg', '', '', '1', '1463567661');
INSERT INTO `upload` VALUES ('16', '0', '0', '0', '0', '573c453e19065.jpg', '/upload/1605/1818/34/573c453e19065.jpg', '233009', 'jpg', '', '', '1', '1463567678');
INSERT INTO `upload` VALUES ('17', '0', '0', '0', '0', '573c45e14fcb4.jpg', '/upload/1605/1818/37/573c45e14fcb4.jpg', '162944', 'jpg', '', '', '1', '1463567841');
INSERT INTO `upload` VALUES ('18', '0', '0', '0', '0', '573c45f52a3ac.jpg', '/upload/1605/1818/37/573c45f52a3ac.jpg', '233009', 'jpg', '', '', '1', '1463567861');
INSERT INTO `upload` VALUES ('19', '0', '0', '0', '0', '573c46054d9c7.jpg', '/upload/1605/1818/37/573c46054d9c7.jpg', '233009', 'jpg', '', '', '1', '1463567877');
INSERT INTO `upload` VALUES ('20', '0', '0', '0', '0', '573c461d4f2ac.jpg', '/upload/1605/1818/38/573c461d4f2ac.jpg', '233009', 'jpg', '', '', '1', '1463567901');
INSERT INTO `upload` VALUES ('21', '0', '0', '0', '0', '573c46364b1f1.jpg', '/upload/1605/1818/38/573c46364b1f1.jpg', '233009', 'jpg', '', '', '1', '1463567926');
INSERT INTO `upload` VALUES ('22', '0', '0', '0', '0', '573c46452d0e4.jpg', '/upload/1605/1818/39/573c46452d0e4.jpg', '233009', 'jpg', '', '', '1', '1463567941');
INSERT INTO `upload` VALUES ('23', '0', '0', '0', '0', '573c465091119.jpg', '/upload/1605/1818/39/573c465091119.jpg', '233009', 'jpg', '', '', '1', '1463567952');
INSERT INTO `upload` VALUES ('24', '0', '0', '0', '0', '573c465af0eab.jpg', '/upload/1605/1818/39/573c465af0eab.jpg', '233009', 'jpg', '', '', '1', '1463567962');
INSERT INTO `upload` VALUES ('25', '0', '0', '0', '0', '573c468ef2602.jpg', '/upload/1605/1818/40/573c468ef2602.jpg', '233009', 'jpg', '', '', '1', '1463568014');
INSERT INTO `upload` VALUES ('26', '0', '0', '0', '0', '573c46ce4d7d0.jpg', '/upload/1605/1818/41/573c46ce4d7d0.jpg', '233009', 'jpg', '', '', '1', '1463568078');
INSERT INTO `upload` VALUES ('27', '0', '0', '0', '0', '573c4711271d7.jpg', '/upload/1605/1818/42/573c4711271d7.jpg', '233009', 'jpg', '', '', '1', '1463568145');
INSERT INTO `upload` VALUES ('28', '0', '0', '0', '0', '573c4718ea4ad.jpg', '/upload/1605/1818/42/573c4718ea4ad.jpg', '233009', 'jpg', '', '', '1', '1463568152');
INSERT INTO `upload` VALUES ('29', '0', '0', '0', '0', '573d162d387db.jpg', '/upload/1605/1909/26/573d162d387db.jpg', '233009', 'jpg', '', '', '1', '1463621165');
INSERT INTO `upload` VALUES ('30', '0', '0', '0', '0', '573d16a47442f.jpg', '/upload/1605/1909/28/573d16a47442f.jpg', '233009', 'jpg', '', '', '1', '1463621284');
INSERT INTO `upload` VALUES ('31', '0', '0', '0', '0', '573d16b0dea2f.jpg', '/upload/1605/1909/28/573d16b0dea2f.jpg', '233009', 'jpg', '', '', '1', '1463621296');
INSERT INTO `upload` VALUES ('32', '0', '0', '0', '0', '573d16be3a071.jpg', '/upload/1605/1909/28/573d16be3a071.jpg', '233009', 'jpg', '', '', '1', '1463621310');
INSERT INTO `upload` VALUES ('33', '0', '0', '0', '0', '573d170768373.jpg', '/upload/1605/1909/29/573d170768373.jpg', '220014', 'jpg', '', '', '1', '1463621383');
INSERT INTO `upload` VALUES ('34', '0', '0', '0', '0', '573d170b7e7d5.jpg', '/upload/1605/1909/29/573d170b7e7d5.jpg', '233009', 'jpg', '', '', '1', '1463621387');
INSERT INTO `upload` VALUES ('35', '0', '0', '0', '0', '573d17135ab5e.jpg', '/upload/1605/1909/29/573d17135ab5e.jpg', '220014', 'jpg', '', '', '1', '1463621395');
INSERT INTO `upload` VALUES ('36', '0', '0', '0', '0', '573d17198ecca.jpg', '/upload/1605/1909/30/573d17198ecca.jpg', '220014', 'jpg', '', '', '1', '1463621401');
INSERT INTO `upload` VALUES ('37', '0', '0', '0', '0', '573d1719b0fb2.jpg', '/upload/1605/1909/30/573d1719b0fb2.jpg', '233009', 'jpg', '', '', '1', '1463621401');
INSERT INTO `upload` VALUES ('38', '0', '0', '0', '0', '573d1719cadc8.jpg', '/upload/1605/1909/30/573d1719cadc8.jpg', '162944', 'jpg', '', '', '1', '1463621401');
INSERT INTO `upload` VALUES ('39', '0', '0', '0', '0', '573d185bd2883.jpg', '/upload/1605/1909/35/573d185bd2883.jpg', '220014', 'jpg', '', '', '1', '1463621723');
INSERT INTO `upload` VALUES ('40', '0', '0', '0', '0', '573d1878a0e2a.jpg', '/upload/1605/1909/35/573d1878a0e2a.jpg', '220014', 'jpg', '', '', '1', '1463621752');
INSERT INTO `upload` VALUES ('41', '0', '0', '0', '0', '573d187b07d7a.jpg', '/upload/1605/1909/35/573d187b07d7a.jpg', '233009', 'jpg', '', '', '1', '1463621755');
INSERT INTO `upload` VALUES ('42', '0', '0', '0', '0', '573d187e05715.jpg', '/upload/1605/1909/35/573d187e05715.jpg', '162944', 'jpg', '', '', '1', '1463621758');
INSERT INTO `upload` VALUES ('43', '0', '0', '0', '0', '573d18ade63b9.jpg', '/upload/1605/1909/36/573d18ade63b9.jpg', '220014', 'jpg', '', '', '1', '1463621805');
INSERT INTO `upload` VALUES ('44', '0', '0', '0', '0', '573d18ebecf55.jpg', '/upload/1605/1909/37/573d18ebecf55.jpg', '233009', 'jpg', '', '', '1', '1463621867');
INSERT INTO `upload` VALUES ('45', '0', '0', '0', '0', '573d193cd56e1.jpg', '/upload/1605/1909/39/573d193cd56e1.jpg', '220014', 'jpg', '', '', '1', '1463621948');
INSERT INTO `upload` VALUES ('46', '0', '0', '0', '0', '573d197e0c311.jpg', '/upload/1605/1909/40/573d197e0c311.jpg', '233009', 'jpg', '', '', '1', '1463622014');
INSERT INTO `upload` VALUES ('47', '0', '0', '0', '0', '573d1988ee2c9.jpg', '/upload/1605/1909/40/573d1988ee2c9.jpg', '220014', 'jpg', '', '', '1', '1463622024');
INSERT INTO `upload` VALUES ('48', '0', '0', '0', '0', '573d1b5b98a64.jpg', '/upload/1605/1909/48/573d1b5b98a64.jpg', '220014', 'jpg', '', '', '1', '1463622491');
INSERT INTO `upload` VALUES ('49', '0', '0', '0', '0', '573d1d7363189.jpg', '/upload/1605/1909/57/573d1d7363189.jpg', '233009', 'jpg', '', '', '1', '1463623027');
INSERT INTO `upload` VALUES ('50', '0', '0', '0', '0', '573d1d8f7d1f9.jpg', '/upload/1605/1909/57/573d1d8f7d1f9.jpg', '233009', 'jpg', '', '', '1', '1463623055');
INSERT INTO `upload` VALUES ('51', '0', '0', '0', '0', '573d1d9f3419b.jpg', '/upload/1605/1909/57/573d1d9f3419b.jpg', '135487', 'jpg', '', '', '1', '1463623071');
INSERT INTO `upload` VALUES ('52', '0', '0', '0', '0', '573d1dd5a23c5.jpg', '/upload/1605/1909/58/573d1dd5a23c5.jpg', '233009', 'jpg', '', '', '1', '1463623125');
INSERT INTO `upload` VALUES ('53', '0', '0', '0', '0', '573d1e0c0aa6c.jpg', '/upload/1605/1909/59/573d1e0c0aa6c.jpg', '220014', 'jpg', '', '', '1', '1463623180');
INSERT INTO `upload` VALUES ('54', '0', '0', '0', '0', '573d1ed812df2.jpg', '/upload/1605/1910/03/573d1ed812df2.jpg', '233009', 'jpg', '', '', '1', '1463623384');
INSERT INTO `upload` VALUES ('55', '0', '0', '0', '0', '573d1ee21a947.jpg', '/upload/1605/1910/03/573d1ee21a947.jpg', '162944', 'jpg', '', '', '1', '1463623394');
INSERT INTO `upload` VALUES ('56', '0', '0', '0', '0', '573d1f0b23b2b.jpg', '/upload/1605/1910/03/573d1f0b23b2b.jpg', '233009', 'jpg', '', '', '1', '1463623435');
INSERT INTO `upload` VALUES ('57', '0', '0', '0', '0', '573d1f11a81d1.jpg', '/upload/1605/1910/04/573d1f11a81d1.jpg', '162944', 'jpg', '', '', '1', '1463623441');
INSERT INTO `upload` VALUES ('58', '0', '0', '0', '0', '573d201533dd5.jpg', '/upload/1605/1910/08/573d201533dd5.jpg', '162944', 'jpg', '', '', '1', '1463623701');
INSERT INTO `upload` VALUES ('59', '0', '0', '0', '0', '573d24bb04c22.jpg', '/upload/1605/1910/28/573d24bb04c22.jpg', '162944', 'jpg', '', '', '1', '1463624891');
INSERT INTO `upload` VALUES ('60', '0', '0', '0', '0', '573d24c0571bb.jpg', '/upload/1605/1910/28/573d24c0571bb.jpg', '135487', 'jpg', '', '', '1', '1463624896');
INSERT INTO `upload` VALUES ('61', '0', '0', '0', '0', '573d9321a5956.jpg', '/upload/1605/1918/19/573d9321a5956.jpg', '220014', 'jpg', '', '', '1', '1463653153');

-- ----------------------------
-- Table structure for `user`
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `name` varchar(16) NOT NULL DEFAULT '' COMMENT '姓名',
  `sex` tinyint(2) NOT NULL DEFAULT '1' COMMENT '性别：1男，2女',
  `mobile` varchar(16) NOT NULL DEFAULT '' COMMENT '电话号码',
  `idcard` varchar(32) NOT NULL DEFAULT '' COMMENT '身份证号码',
  `password` char(32) NOT NULL DEFAULT '' COMMENT '密码',
  `place_ids` varchar(128) NOT NULL DEFAULT '' COMMENT '管辖采价点',
  `depart_id` int(11) NOT NULL COMMENT '主管部门',
  `bank` varchar(64) NOT NULL DEFAULT '' COMMENT '开户银行',
  `bank_card` varchar(32) NOT NULL DEFAULT '' COMMENT '银行卡账号',
  `address` varchar(256) NOT NULL DEFAULT '' COMMENT '家庭住址',
  `education` varchar(16) NOT NULL DEFAULT '' COMMENT '最高学历',
  `created` int(11) NOT NULL COMMENT '创建时间',
  PRIMARY KEY (`id`),
  UNIQUE KEY `mobile` (`mobile`),
  KEY `depart_id` (`depart_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of user
-- ----------------------------
INSERT INTO `user` VALUES ('2', '111', '1', '18922835259', '352201199202261613', '96e79218965eb72c92a549dd5a330112', '4,5,8,6,7,9', '3', '11111', '1111111111111111111', '1111', '1', '1481111861');

-- ----------------------------
-- Table structure for `user_place_relation`
-- ----------------------------
DROP TABLE IF EXISTS `user_place_relation`;
CREATE TABLE `user_place_relation` (
  `user_id` int(11) NOT NULL COMMENT '用户ID',
  `place_id` int(11) NOT NULL COMMENT '采价点ID'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of user_place_relation
-- ----------------------------
INSERT INTO `user_place_relation` VALUES ('2', '4');
INSERT INTO `user_place_relation` VALUES ('2', '5');
INSERT INTO `user_place_relation` VALUES ('2', '8');
INSERT INTO `user_place_relation` VALUES ('2', '6');
INSERT INTO `user_place_relation` VALUES ('2', '7');
INSERT INTO `user_place_relation` VALUES ('2', '9');
