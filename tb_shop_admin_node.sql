/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50553
Source Host           : localhost:3306
Source Database       : deyi

Target Server Type    : MYSQL
Target Server Version : 50553
File Encoding         : 65001

Date: 2018-01-02 14:57:59
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for tb_shop_admin_node
-- ----------------------------
DROP TABLE IF EXISTS `tb_shop_admin_node`;
CREATE TABLE `tb_shop_admin_node` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `controller` varchar(255) DEFAULT NULL COMMENT '控制器',
  `action` varchar(255) DEFAULT NULL COMMENT '方法名',
  `sorts` int(11) DEFAULT '0' COMMENT '排序',
  `pid` int(11) DEFAULT NULL COMMENT '本级',
  `pid2` int(11) DEFAULT NULL COMMENT '上级',
  `pid3` int(11) DEFAULT NULL COMMENT '上上级',
  `classname` varchar(255) DEFAULT NULL COMMENT '类名',
  `level` tinyint(4) NOT NULL DEFAULT '0' COMMENT '等级',
  `is_del` tinyint(1) DEFAULT '0' COMMENT '0-正常  1-删除',
  `add_time` datetime DEFAULT NULL,
  `edit_time` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=794 DEFAULT CHARSET=utf8 COMMENT='商城节点表wzz';

-- ----------------------------
-- Records of tb_shop_admin_node
-- ----------------------------
INSERT INTO `tb_shop_admin_node` VALUES ('1', 'system', 'admin', '10', '0', '0', '0', '分权设置', '1', '0', null, null);
INSERT INTO `tb_shop_admin_node` VALUES ('2', '0', '0', '0', '1', '0', '0', '管理员管理', '2', '0', null, null);
INSERT INTO `tb_shop_admin_node` VALUES ('3', 'system', 'admin', '0', '2', '1', '0', '管理员列表', '3', '0', null, null);
INSERT INTO `tb_shop_admin_node` VALUES ('4', 'system', 'admin', '0', '3', '2', '1', '管理员列表', '4', '0', null, null);
INSERT INTO `tb_shop_admin_node` VALUES ('5', 'system', 'addadmin', '0', '3', '2', '1', '添加/编辑管理员', '4', '0', null, '2017-12-13 18:12:22');
INSERT INTO `tb_shop_admin_node` VALUES ('6', 'system', 'ableadmin', '0', '3', '2', '1', '禁用/删除管理员', '4', '0', null, '2017-12-13 18:18:51');
INSERT INTO `tb_shop_admin_node` VALUES ('9', '0', '0', '0', '1', '0', '0', '角色管理', '2', '0', null, null);
INSERT INTO `tb_shop_admin_node` VALUES ('10', 'system', 'rolelist', '0', '9', '1', '0', '角色列表', '3', '0', null, null);
INSERT INTO `tb_shop_admin_node` VALUES ('11', 'system', 'nodelist', '0', '9', '1', '0', '权限节点列表', '3', '0', null, null);
INSERT INTO `tb_shop_admin_node` VALUES ('16', 'system', 'rolelist', '0', '10', '9', '1', '角色列表', '4', '0', null, null);
INSERT INTO `tb_shop_admin_node` VALUES ('17', 'system', 'addrole', '0', '10', '9', '1', '添加角色', '4', '0', null, null);
INSERT INTO `tb_shop_admin_node` VALUES ('18', 'system', 'delrole', '0', '10', '9', '1', '删除角色', '4', '0', null, null);
INSERT INTO `tb_shop_admin_node` VALUES ('19', 'system', 'roleset', '0', '10', '9', '1', '角色权限设置', '4', '0', null, null);
INSERT INTO `tb_shop_admin_node` VALUES ('20', 'system', 'nodelist', '0', '11', '9', '1', '权限节点列表', '4', '0', null, null);
INSERT INTO `tb_shop_admin_node` VALUES ('21', 'system', 'addnode', '0', '11', '9', '1', '添加/编辑权限节点', '4', '0', null, null);
INSERT INTO `tb_shop_admin_node` VALUES ('22', 'system', 'delnode', '0', '11', '9', '1', '删除权限节点', '4', '0', null, null);
INSERT INTO `tb_shop_admin_node` VALUES ('23', 'index', 'index', '1', '0', '0', '0', '首页', '1', '0', null, null);
INSERT INTO `tb_shop_admin_node` VALUES ('24', 'index', 'index', '0', '23', '0', '0', '后台主页', '2', '0', null, null);
INSERT INTO `tb_shop_admin_node` VALUES ('25', 'index', 'index', '0', '24', '23', '0', '主页', '3', '0', null, null);
INSERT INTO `tb_shop_admin_node` VALUES ('26', 'index', 'index', '0', '25', '24', '23', '主页', '4', '0', null, null);
INSERT INTO `tb_shop_admin_node` VALUES ('27', '0', '0', '0', '23', '0', '0', '网站配置', '2', '0', null, null);
INSERT INTO `tb_shop_admin_node` VALUES ('28', 'index', 'web_config', '0', '27', '23', '0', '网站配置', '3', '0', null, null);
INSERT INTO `tb_shop_admin_node` VALUES ('29', 'index', 'web_config', '0', '28', '27', '23', '网站配置', '4', '0', null, '2017-12-13 18:27:58');
INSERT INTO `tb_shop_admin_node` VALUES ('30', 'index', 'updatepwd', '0', '25', '24', '23', '修改密码', '4', '0', null, '2017-12-13 18:28:28');
INSERT INTO `tb_shop_admin_node` VALUES ('31', 'index', 'addimage', '0', '25', '24', '23', '上传图片', '4', '0', null, '2017-12-13 18:28:56');
INSERT INTO `tb_shop_admin_node` VALUES ('32', 'index', 'ueditorup', '0', '25', '24', '23', '编辑器上传', '4', '0', null, null);
INSERT INTO `tb_shop_admin_node` VALUES ('87', 'member', 'index', '2', '0', '0', '0', '用户管理', '1', '0', null, null);
INSERT INTO `tb_shop_admin_node` VALUES ('89', '0', '0', '1', '87', '0', '0', '会员', '2', '0', null, null);
INSERT INTO `tb_shop_admin_node` VALUES ('90', 'member', 'index', '3', '89', '87', '0', '会员信息', '3', '0', null, null);
INSERT INTO `tb_shop_admin_node` VALUES ('91', 'member', 'index', '0', '90', '89', '87', '用户列表', '4', '0', null, null);
INSERT INTO `tb_shop_admin_node` VALUES ('115', 'banner', 'bannertype', '0', '23', '0', '0', '广告管理', '2', '0', null, null);
INSERT INTO `tb_shop_admin_node` VALUES ('116', 'banner', 'bannertype', '0', '115', '23', '0', '广告位置', '3', '0', null, null);
INSERT INTO `tb_shop_admin_node` VALUES ('117', 'banner', 'bannertype', '0', '116', '115', '23', '广告位置', '4', '0', null, '2017-12-13 18:22:54');
INSERT INTO `tb_shop_admin_node` VALUES ('118', 'banner', 'bannertypeadd', '0', '116', '115', '23', '添加/修改广告位置', '4', '0', null, null);
INSERT INTO `tb_shop_admin_node` VALUES ('119', 'banner', 'bannertypedel', '0', '116', '115', '23', '启用/删除广告位置', '4', '0', null, null);
INSERT INTO `tb_shop_admin_node` VALUES ('122', 'banner', 'banner', '0', '115', '23', '0', '广告管理', '3', '0', null, null);
INSERT INTO `tb_shop_admin_node` VALUES ('123', 'banner', 'banner', '0', '122', '115', '23', '广告列表', '4', '0', null, null);
INSERT INTO `tb_shop_admin_node` VALUES ('124', 'banner', 'banneradd', '0', '122', '115', '23', '添加修改广告', '4', '0', null, null);
INSERT INTO `tb_shop_admin_node` VALUES ('125', 'banner', 'bannerdel', '0', '122', '115', '23', '启用/删除广告', '4', '0', null, null);
INSERT INTO `tb_shop_admin_node` VALUES ('142', 'goods', 'index', '3', '0', '0', '0', '商品管理', '1', '0', null, '2017-12-28 10:21:55');
INSERT INTO `tb_shop_admin_node` VALUES ('143', 'goodscate', 'goodscate', '0', '142', '0', '0', '商品分类', '2', '0', null, null);
INSERT INTO `tb_shop_admin_node` VALUES ('144', 'goods', 'index', '0', '142', '0', '0', '商品管理', '2', '0', null, null);
INSERT INTO `tb_shop_admin_node` VALUES ('147', 'goodscate', 'goodscate', '0', '143', '142', '0', '商品分类', '3', '0', null, null);
INSERT INTO `tb_shop_admin_node` VALUES ('148', 'goodscate', 'goodscate', '0', '147', '143', '142', '列表', '4', '0', null, '2017-12-13 23:24:49');
INSERT INTO `tb_shop_admin_node` VALUES ('149', 'goodscate', 'goodscateadd', '0', '147', '143', '142', '添加/编辑商品分类', '4', '0', null, '2017-12-15 20:15:56');
INSERT INTO `tb_shop_admin_node` VALUES ('150', 'goodscate', 'goodscatedel', '0', '147', '143', '142', '启用/删除商品分类', '4', '0', null, '2017-12-13 23:24:34');
INSERT INTO `tb_shop_admin_node` VALUES ('151', 'goods', 'index', '1', '144', '142', '0', '商品列表', '3', '0', null, null);
INSERT INTO `tb_shop_admin_node` VALUES ('152', 'goods', 'index', '0', '151', '144', '142', '商品列表', '4', '0', null, null);
INSERT INTO `tb_shop_admin_node` VALUES ('154', 'goods', 'addgoods', '0', '151', '144', '142', '添加/编辑商品', '4', '0', null, '2017-12-22 01:54:00');
INSERT INTO `tb_shop_admin_node` VALUES ('155', 'goods', 'changestatus', '0', '151', '144', '142', '状态变更', '4', '0', null, '2017-12-22 01:54:15');
INSERT INTO `tb_shop_admin_node` VALUES ('176', 'member', 'detail', '0', '90', '89', '87', '编辑用户', '4', '0', null, null);
INSERT INTO `tb_shop_admin_node` VALUES ('177', 'member', 'changestatus', '0', '90', '89', '87', '冻结', '4', '0', null, null);
INSERT INTO `tb_shop_admin_node` VALUES ('178', 'member', 'changeisdel', '0', '90', '89', '87', '删除', '4', '0', null, null);
INSERT INTO `tb_shop_admin_node` VALUES ('201', 'goodsorder', 'index', '3', '0', '0', '0', '订单管理', '1', '0', null, null);
INSERT INTO `tb_shop_admin_node` VALUES ('202', 'goodsorder', 'index', '0', '201', '0', '0', '订单管理', '2', '0', null, null);
INSERT INTO `tb_shop_admin_node` VALUES ('216', 'member', 'allpass', '0', '180', '179', '87', '批量通过', '4', '0', null, null);
INSERT INTO `tb_shop_admin_node` VALUES ('247', 'skuattr', 'skuattr', '0', '143', '142', '0', '规格管理', '3', '0', null, '2017-12-14 01:18:23');
INSERT INTO `tb_shop_admin_node` VALUES ('248', 'skuattr', 'skuattr', '0', '247', '143', '142', '规格列表', '4', '0', null, '2017-12-14 01:19:07');
INSERT INTO `tb_shop_admin_node` VALUES ('249', 'skuattr', 'skuattradd', '0', '247', '143', '142', '添加/编辑规格', '4', '0', null, '2017-12-14 01:20:02');
INSERT INTO `tb_shop_admin_node` VALUES ('250', 'skuattr', 'skuattrdel', '0', '247', '143', '142', '删除规格', '4', '0', null, '2017-12-14 01:20:08');
INSERT INTO `tb_shop_admin_node` VALUES ('264', 'data', 'sale', '4', '0', '0', '0', '数据统计', '1', '0', null, null);
INSERT INTO `tb_shop_admin_node` VALUES ('265', '0', '0', '0', '264', '0', '0', '销售统计', '2', '0', null, null);
INSERT INTO `tb_shop_admin_node` VALUES ('266', 'data', 'sale', '0', '265', '264', '0', '销售统计', '3', '0', null, null);
INSERT INTO `tb_shop_admin_node` VALUES ('267', 'data', 'order', '0', '265', '264', '0', '订单统计', '3', '0', null, null);
INSERT INTO `tb_shop_admin_node` VALUES ('268', '0', '0', '0', '264', '0', '0', '商品统计', '2', '0', null, null);
INSERT INTO `tb_shop_admin_node` VALUES ('269', 'data', 'saledetail', '0', '268', '264', '0', '销售明细', '3', '0', null, null);
INSERT INTO `tb_shop_admin_node` VALUES ('270', 'data', 'saleorder', '0', '268', '264', '0', '销售排行', '3', '0', null, null);
INSERT INTO `tb_shop_admin_node` VALUES ('271', '0', '0', '0', '264', '0', '0', '会员统计', '2', '0', null, null);
INSERT INTO `tb_shop_admin_node` VALUES ('272', 'data', 'consume', '0', '271', '264', '0', '消费排行', '3', '0', null, null);
INSERT INTO `tb_shop_admin_node` VALUES ('273', 'data', 'sale', '0', '266', '265', '264', '销售统计', '4', '0', null, null);
INSERT INTO `tb_shop_admin_node` VALUES ('274', 'data', 'order', '0', '267', '265', '264', '订单统计', '4', '0', null, null);
INSERT INTO `tb_shop_admin_node` VALUES ('275', 'data', 'saledetail', '0', '269', '268', '264', '销售明细', '4', '0', null, null);
INSERT INTO `tb_shop_admin_node` VALUES ('276', 'data', 'saleorder', '0', '270', '268', '264', '销售排行', '4', '0', null, null);
INSERT INTO `tb_shop_admin_node` VALUES ('277', 'data', 'consume', '0', '272', '271', '264', '消费排行', '4', '0', null, null);
INSERT INTO `tb_shop_admin_node` VALUES ('291', 'member', 'summary', '1', '89', '87', '0', '会员概述', '3', '0', null, null);
INSERT INTO `tb_shop_admin_node` VALUES ('293', 'member', 'summary', '0', '291', '89', '87', '会员概述', '4', '0', null, null);
INSERT INTO `tb_shop_admin_node` VALUES ('323', 'member', 'changegroup', '0', '90', '89', '87', '更新会员分组', '4', '0', null, null);
INSERT INTO `tb_shop_admin_node` VALUES ('349', 'news', 'index', '5', '0', '0', '0', '消息中心', '1', '1', null, null);
INSERT INTO `tb_shop_admin_node` VALUES ('350', '0', '0', '0', '349', '0', '0', '消息管理', '2', '1', null, null);
INSERT INTO `tb_shop_admin_node` VALUES ('351', 'news', 'index', '0', '350', '349', '0', '平台消息', '3', '1', null, null);
INSERT INTO `tb_shop_admin_node` VALUES ('352', 'news', 'index', '0', '351', '350', '349', '平台消息', '4', '1', null, null);
INSERT INTO `tb_shop_admin_node` VALUES ('353', 'news', 'addeditdel', '0', '351', '350', '349', '添加修改删除', '4', '1', null, null);
INSERT INTO `tb_shop_admin_node` VALUES ('354', 'news', 'newspush', '0', '351', '350', '349', '推送', '4', '1', null, null);
INSERT INTO `tb_shop_admin_node` VALUES ('579', 'about', 'first', '15', '0', '0', '0', '内容管理', '1', '0', null, '2017-12-13 18:02:41');
INSERT INTO `tb_shop_admin_node` VALUES ('580', 'about', 'first', '0', '579', '0', '0', '关于我们', '2', '0', null, null);
INSERT INTO `tb_shop_admin_node` VALUES ('581', 'about', 'first', '0', '580', '579', '0', '关于我们', '3', '0', null, null);
INSERT INTO `tb_shop_admin_node` VALUES ('582', 'about', 'first', '0', '581', '580', '579', '内容管理', '4', '0', null, null);
INSERT INTO `tb_shop_admin_node` VALUES ('583', 'about', 'second', '1', '580', '579', '0', '服务流程', '3', '0', null, null);
INSERT INTO `tb_shop_admin_node` VALUES ('584', 'about', 'second', '0', '583', '580', '579', '内容管理', '4', '0', null, null);
INSERT INTO `tb_shop_admin_node` VALUES ('585', 'about', 'third', '2', '580', '579', '0', '在线帮助', '3', '0', null, null);
INSERT INTO `tb_shop_admin_node` VALUES ('586', 'about', 'third', '0', '585', '580', '579', '内容管理', '4', '0', null, null);
INSERT INTO `tb_shop_admin_node` VALUES ('587', 'about', 'fourth', '3', '580', '579', '0', '常见问题', '3', '0', null, null);
INSERT INTO `tb_shop_admin_node` VALUES ('588', 'about', 'fourth', '0', '587', '580', '579', '内容管理', '4', '0', null, null);
INSERT INTO `tb_shop_admin_node` VALUES ('589', 'about', 'addeditcontent', '1', '581', '580', '579', '添加修改内容', '4', '0', null, null);
INSERT INTO `tb_shop_admin_node` VALUES ('590', 'about', 'fifth', '4', '580', '579', '0', '导航栏管理', '3', '0', null, null);
INSERT INTO `tb_shop_admin_node` VALUES ('591', 'about', 'fifth', '0', '590', '580', '579', '内容管理', '4', '0', null, null);
INSERT INTO `tb_shop_admin_node` VALUES ('592', 'about', 'sixth', '1', '579', '0', '0', '门店服务', '2', '0', null, null);
INSERT INTO `tb_shop_admin_node` VALUES ('593', 'about', 'sixth', '0', '592', '579', '0', '配送方式', '3', '0', null, null);
INSERT INTO `tb_shop_admin_node` VALUES ('594', 'about', 'sixth', '0', '593', '592', '579', '内容管理', '4', '0', null, null);
INSERT INTO `tb_shop_admin_node` VALUES ('595', 'about', 'seventh', '1', '592', '579', '0', '安装流程', '3', '0', null, null);
INSERT INTO `tb_shop_admin_node` VALUES ('596', 'about', 'seventh', '0', '595', '592', '579', '内容管理', '4', '0', null, null);
INSERT INTO `tb_shop_admin_node` VALUES ('597', 'about', 'eighth', '2', '592', '579', '0', '售后服务', '3', '0', null, null);
INSERT INTO `tb_shop_admin_node` VALUES ('598', 'about', 'eighth', '0', '597', '592', '579', '内容管理', '4', '0', null, null);
INSERT INTO `tb_shop_admin_node` VALUES ('599', 'about', 'ninth', '3', '592', '579', '0', '导航栏管理', '3', '0', null, null);
INSERT INTO `tb_shop_admin_node` VALUES ('600', 'about', 'ninth', '0', '599', '592', '579', '内容管理', '4', '0', null, null);
INSERT INTO `tb_shop_admin_node` VALUES ('601', 'about', 'yhzc', '2', '579', '0', '0', '购物指南', '2', '0', null, null);
INSERT INTO `tb_shop_admin_node` VALUES ('602', 'about', 'yhzc', '0', '601', '579', '0', '用户注册', '3', '0', null, null);
INSERT INTO `tb_shop_admin_node` VALUES ('603', 'about', 'yhzc', '0', '602', '601', '579', '内容管理', '4', '0', null, null);
INSERT INTO `tb_shop_admin_node` VALUES ('604', 'about', 'dglc', '1', '601', '579', '0', '订购流程', '3', '0', null, null);
INSERT INTO `tb_shop_admin_node` VALUES ('605', 'about', 'dglc', '0', '604', '601', '579', '内容管理', '4', '0', null, null);
INSERT INTO `tb_shop_admin_node` VALUES ('606', 'about', 'hyzd', '2', '601', '579', '0', '会员制度', '3', '0', null, null);
INSERT INTO `tb_shop_admin_node` VALUES ('607', 'about', 'hyzd', '0', '606', '601', '579', '内容管理', '4', '0', null, null);
INSERT INTO `tb_shop_admin_node` VALUES ('610', 'about', 'priva', '3', '579', '0', '0', '购物条款', '2', '0', null, null);
INSERT INTO `tb_shop_admin_node` VALUES ('611', 'about', 'priva', '0', '610', '579', '0', '隐私保护政策', '3', '0', null, null);
INSERT INTO `tb_shop_admin_node` VALUES ('612', 'about', 'priva', '0', '611', '610', '579', '隐私保护政策', '4', '0', null, null);
INSERT INTO `tb_shop_admin_node` VALUES ('614', 'about', 'hyxy', '0', '610', '579', '0', '会员注册协议', '3', '0', null, null);
INSERT INTO `tb_shop_admin_node` VALUES ('616', 'about', 'hyxy', '0', '614', '610', '579', '会员注册协议', '4', '0', null, null);
INSERT INTO `tb_shop_admin_node` VALUES ('617', 'about', 'sytk', '0', '610', '579', '0', '商城使用条款', '3', '0', null, null);
INSERT INTO `tb_shop_admin_node` VALUES ('618', 'about', 'sytk', '0', '617', '610', '579', '商城使用条款', '4', '0', null, null);
INSERT INTO `tb_shop_admin_node` VALUES ('619', 'about', 'delsoftall', '0', '617', '610', '579', '删除', '4', '0', null, null);
INSERT INTO `tb_shop_admin_node` VALUES ('620', 'about', 'fkfs', '4', '579', '0', '0', '支付配送', '2', '0', null, null);
INSERT INTO `tb_shop_admin_node` VALUES ('621', 'about', 'fkfs', '0', '620', '579', '0', '付款方式', '3', '0', null, null);
INSERT INTO `tb_shop_admin_node` VALUES ('623', 'about', 'fkfs', '0', '621', '620', '579', '付款方式', '4', '0', null, null);
INSERT INTO `tb_shop_admin_node` VALUES ('624', 'about', 'psfs', '1', '620', '579', '0', '配送方式', '3', '0', null, null);
INSERT INTO `tb_shop_admin_node` VALUES ('625', 'about', 'psfs', '0', '624', '620', '579', '配送方式', '4', '0', null, null);
INSERT INTO `tb_shop_admin_node` VALUES ('626', 'about', 'yhqs', '2', '620', '579', '0', '验货签收', '3', '0', null, null);
INSERT INTO `tb_shop_admin_node` VALUES ('627', 'about', 'yhqs', '0', '626', '620', '579', '验货签收', '4', '0', null, null);
INSERT INTO `tb_shop_admin_node` VALUES ('628', 'about', 'pswt', '3', '620', '579', '0', '配送问题', '3', '0', null, null);
INSERT INTO `tb_shop_admin_node` VALUES ('629', 'about', 'pswt', '0', '628', '620', '579', '配送问题', '4', '0', null, null);
INSERT INTO `tb_shop_admin_node` VALUES ('630', 'about', 'psfw', '4', '620', '579', '0', '配送范围', '3', '0', null, null);
INSERT INTO `tb_shop_admin_node` VALUES ('631', 'about', 'psfw', '0', '630', '620', '579', '配送范围', '4', '0', null, null);
INSERT INTO `tb_shop_admin_node` VALUES ('632', 'about', 'fwzc', '5', '579', '0', '0', '常见问题', '2', '0', null, null);
INSERT INTO `tb_shop_admin_node` VALUES ('633', 'about', 'fwzc', '0', '632', '579', '0', '服务政策', '3', '0', null, null);
INSERT INTO `tb_shop_admin_node` VALUES ('634', 'about', 'fwzc', '0', '633', '632', '579', '服务政策', '4', '0', null, null);
INSERT INTO `tb_shop_admin_node` VALUES ('635', 'about', 'thlc', '1', '632', '579', '0', '退货流程', '3', '0', null, null);
INSERT INTO `tb_shop_admin_node` VALUES ('636', 'about', 'thlc', '0', '635', '632', '579', '退货流程', '4', '0', null, null);
INSERT INTO `tb_shop_admin_node` VALUES ('637', 'about', 'tksm', '2', '632', '579', '0', '退款说明', '3', '0', null, null);
INSERT INTO `tb_shop_admin_node` VALUES ('638', 'about', 'tksm', '0', '637', '632', '579', '退款说明', '4', '0', null, null);
INSERT INTO `tb_shop_admin_node` VALUES ('639', 'about', 'gkbd', '3', '632', '579', '0', '顾客必读', '3', '0', null, null);
INSERT INTO `tb_shop_admin_node` VALUES ('640', 'about', 'gkbd', '0', '639', '632', '579', '顾客必读', '4', '0', null, null);
INSERT INTO `tb_shop_admin_node` VALUES ('641', 'about', 'jfjl', '4', '632', '579', '0', '积分奖励', '3', '0', null, null);
INSERT INTO `tb_shop_admin_node` VALUES ('642', 'about', 'jfjl', '0', '641', '632', '579', '积分奖励', '4', '0', null, null);
INSERT INTO `tb_shop_admin_node` VALUES ('643', 'integralgoods', 'index', '4', '0', '0', '0', '积分中心', '1', '0', null, '2017-12-27 15:21:07');
INSERT INTO `tb_shop_admin_node` VALUES ('644', 'integral', 'index', '0', '643', '0', '0', '积分商品', '2', '0', null, null);
INSERT INTO `tb_shop_admin_node` VALUES ('645', 'integral', 'index', '0', '644', '643', '0', '积分商品分类', '3', '0', null, null);
INSERT INTO `tb_shop_admin_node` VALUES ('646', 'integral', 'index', '0', '645', '644', '643', '积分商品分类', '4', '0', null, null);
INSERT INTO `tb_shop_admin_node` VALUES ('647', 'integral', 'integral_type_addorupdate', '0', '645', '644', '643', '添加或者修改积分商品分类', '4', '0', null, null);
INSERT INTO `tb_shop_admin_node` VALUES ('648', 'integral', 'integral_type_status', '0', '645', '644', '643', '修改积分商品分类状态', '4', '0', null, null);
INSERT INTO `tb_shop_admin_node` VALUES ('649', 'integral', 'integral_type_del', '0', '645', '644', '643', '删除积分商品分类', '4', '0', null, null);
INSERT INTO `tb_shop_admin_node` VALUES ('650', 'integral', 'integral_type_info', '0', '645', '644', '643', '获取积分商品分类修改信息', '4', '0', null, null);
INSERT INTO `tb_shop_admin_node` VALUES ('652', 'integralgoods', 'index', '0', '644', '643', '0', '积分商品列表', '3', '0', null, '2017-12-27 15:20:18');
INSERT INTO `tb_shop_admin_node` VALUES ('653', 'integralgoods', 'index', '0', '652', '644', '643', '积分商品管理', '4', '0', null, null);
INSERT INTO `tb_shop_admin_node` VALUES ('654', 'integralgoods', 'addgoods', '0', '652', '644', '643', '添加或者修改积分商品', '4', '0', null, null);
INSERT INTO `tb_shop_admin_node` VALUES ('655', 'index', 'addimage', '0', '652', '644', '643', '上传图片', '4', '0', null, null);
INSERT INTO `tb_shop_admin_node` VALUES ('656', 'integralgoods', 'changestatus', '0', '652', '644', '643', '更新商品上架 下架 删除 恢复', '4', '0', null, null);
INSERT INTO `tb_shop_admin_node` VALUES ('659', 'integralgoods', 'skunamelist', '0', '652', '644', '643', 'sku选择列表', '4', '0', '2017-12-13 18:25:41', '2017-12-13 18:25:41');
INSERT INTO `tb_shop_admin_node` VALUES ('661', 'ingetralsku', 'index', '0', '644', '643', '0', 'SKU管理', '3', '0', '2017-12-14 17:04:26', '2017-12-14 17:04:26');
INSERT INTO `tb_shop_admin_node` VALUES ('662', 'ingetralsku', 'index', '0', '661', '644', '643', 'SKU管理', '4', '0', '2017-12-14 17:04:44', '2017-12-14 17:04:44');
INSERT INTO `tb_shop_admin_node` VALUES ('663', 'ingetralsku', 'delsku', '0', '661', '644', '643', '删除SKU', '4', '0', '2017-12-14 17:05:03', '2017-12-14 17:05:03');
INSERT INTO `tb_shop_admin_node` VALUES ('664', 'ingetralsku', 'addsku', '0', '661', '644', '643', '添加SKU', '4', '0', '2017-12-14 17:05:18', '2017-12-14 17:05:18');
INSERT INTO `tb_shop_admin_node` VALUES ('665', 'ingetralsku', 'editsku', '0', '661', '644', '643', '修改SKU', '4', '0', '2017-12-14 17:05:37', '2017-12-14 17:05:37');
INSERT INTO `tb_shop_admin_node` VALUES ('666', 'integralcate', 'index', '0', '643', '0', '0', '积分管理', '2', '0', '2017-12-18 14:46:18', '2017-12-18 14:46:18');
INSERT INTO `tb_shop_admin_node` VALUES ('667', 'integralcate', 'index', '0', '666', '643', '0', '积分规则', '3', '0', '2017-12-18 14:46:42', '2017-12-27 15:20:28');
INSERT INTO `tb_shop_admin_node` VALUES ('668', 'integralcate', 'index', '0', '667', '666', '643', '积分分类', '4', '0', '2017-12-18 14:46:59', '2017-12-18 14:46:59');
INSERT INTO `tb_shop_admin_node` VALUES ('669', 'integralcate', 'integral_type_del', '0', '667', '666', '643', '删除分类', '4', '0', '2017-12-18 14:47:16', '2017-12-18 14:47:16');
INSERT INTO `tb_shop_admin_node` VALUES ('670', 'integralcate', 'integral_type_addorupdate', '0', '667', '666', '643', '修改分类', '4', '0', '2017-12-18 14:47:35', '2017-12-18 14:47:35');
INSERT INTO `tb_shop_admin_node` VALUES ('671', 'integralcate', 'integral_type_status', '0', '667', '666', '643', '修改状态', '4', '0', '2017-12-18 14:47:55', '2017-12-18 14:47:55');
INSERT INTO `tb_shop_admin_node` VALUES ('672', 'integralcate', 'integral_type_info', '0', '667', '666', '643', '获取分类修改信息', '4', '0', '2017-12-18 14:48:20', '2017-12-18 14:48:20');
INSERT INTO `tb_shop_admin_node` VALUES ('673', 'goodsmarket', 'spikegoods', '0', '144', '142', '0', '限时特惠', '3', '0', '2017-12-18 19:50:18', '2017-12-25 18:24:59');
INSERT INTO `tb_shop_admin_node` VALUES ('674', 'goodsmarket', 'spikegoods', '0', '673', '144', '142', '限时特惠商品列表', '4', '0', '2017-12-18 19:51:10', '2017-12-22 17:08:21');
INSERT INTO `tb_shop_admin_node` VALUES ('675', 'goodsmarket', 'goodssubmit', '0', '673', '144', '142', '添加搜索的商品', '4', '0', '2017-12-18 19:51:31', '2017-12-22 17:08:40');
INSERT INTO `tb_shop_admin_node` VALUES ('676', 'goodsmarket', 'goodsmarketconfig', '0', '673', '144', '142', '保存限时特惠商品配置', '4', '0', '2017-12-18 19:51:48', '2017-12-22 17:08:58');
INSERT INTO `tb_shop_admin_node` VALUES ('677', 'goods', 'goodsselect', '0', '673', '144', '142', '搜索商品', '4', '0', '2017-12-18 19:55:09', '2017-12-22 17:09:15');
INSERT INTO `tb_shop_admin_node` VALUES ('678', 'index', 'getcontentadd', '0', '25', '24', '23', '添加内容', '4', '0', '2017-12-19 17:07:27', '2017-12-19 19:52:35');
INSERT INTO `tb_shop_admin_node` VALUES ('679', 'news', 'index', '16', '0', '0', '0', '商城资讯', '1', '0', '2017-12-19 17:16:58', '2017-12-19 17:27:05');
INSERT INTO `tb_shop_admin_node` VALUES ('680', 'news', 'index', '0', '679', '0', '0', '资讯列表', '2', '0', '2017-12-19 17:21:20', '2017-12-19 17:28:42');
INSERT INTO `tb_shop_admin_node` VALUES ('681', 'news', 'index', '0', '680', '679', '0', '资讯列表', '3', '0', '2017-12-19 17:22:00', '2017-12-19 17:27:54');
INSERT INTO `tb_shop_admin_node` VALUES ('682', 'news', 'catelist', '0', '679', '0', '0', '资讯分类', '2', '1', '2017-12-19 17:26:28', '2017-12-19 17:28:37');
INSERT INTO `tb_shop_admin_node` VALUES ('683', 'news', 'index', '0', '681', '680', '679', '资讯列表', '4', '0', '2017-12-19 17:29:09', '2017-12-19 17:29:09');
INSERT INTO `tb_shop_admin_node` VALUES ('684', 'news', 'addeditnews', '0', '681', '680', '679', '添加修改新闻', '4', '0', '2017-12-19 17:30:04', '2017-12-19 17:30:04');
INSERT INTO `tb_shop_admin_node` VALUES ('685', 'news', 'catelist', '0', '682', '679', '0', '分类列表', '3', '1', '2017-12-19 17:31:11', '2017-12-19 17:31:11');
INSERT INTO `tb_shop_admin_node` VALUES ('686', 'news', 'addcate', '0', '685', '682', '679', '添加分类', '4', '1', '2017-12-19 17:32:17', '2017-12-19 17:32:17');
INSERT INTO `tb_shop_admin_node` VALUES ('687', 'news', 'catelist', '0', '685', '682', '679', '分类列表', '4', '1', '2017-12-19 17:32:49', '2017-12-19 17:32:49');
INSERT INTO `tb_shop_admin_node` VALUES ('688', 'news', 'addeditnews', '0', '685', '682', '679', '修改分类', '4', '1', '2017-12-19 17:33:15', '2017-12-19 17:34:08');
INSERT INTO `tb_shop_admin_node` VALUES ('689', 'news', 'delcate', '0', '685', '682', '679', '删除分类', '4', '1', '2017-12-19 17:33:40', '2017-12-19 17:33:40');
INSERT INTO `tb_shop_admin_node` VALUES ('691', 'news', 'catelist', '0', '690', '679', '0', '分类列表', '3', '1', '2017-12-19 19:05:00', '2017-12-19 19:05:00');
INSERT INTO `tb_shop_admin_node` VALUES ('692', 'news', 'catelist', '0', '691', '690', '679', '分类列表', '4', '1', '2017-12-19 19:05:24', '2017-12-19 19:05:24');
INSERT INTO `tb_shop_admin_node` VALUES ('693', 'news', 'addeditcate', '0', '691', '690', '679', '添加修改分类', '4', '1', '2017-12-19 19:06:00', '2017-12-19 19:17:43');
INSERT INTO `tb_shop_admin_node` VALUES ('694', 'news', 'addeditcate', '0', '691', '690', '679', '修改分类', '4', '1', '2017-12-19 19:06:20', '2017-12-19 19:14:07');
INSERT INTO `tb_shop_admin_node` VALUES ('695', 'news', 'delcate', '0', '691', '690', '679', '删除分类', '4', '1', '2017-12-19 19:07:05', '2017-12-19 19:07:05');
INSERT INTO `tb_shop_admin_node` VALUES ('696', 'index', 'getcontentedit', '0', '25', '24', '23', '修改内容', '4', '0', '2017-12-19 19:53:41', '2017-12-19 19:53:41');
INSERT INTO `tb_shop_admin_node` VALUES ('697', 'index', 'updown', '0', '25', '24', '23', '上下移', '4', '0', '2017-12-19 19:58:44', '2017-12-19 19:58:44');
INSERT INTO `tb_shop_admin_node` VALUES ('698', 'index', 'delsoftall', '0', '25', '24', '23', '软删除', '4', '0', '2017-12-19 19:59:30', '2017-12-19 19:59:30');
INSERT INTO `tb_shop_admin_node` VALUES ('699', 'index', 'change', '0', '25', '24', '23', '转移分类', '4', '0', '2017-12-19 20:00:00', '2017-12-19 20:00:00');
INSERT INTO `tb_shop_admin_node` VALUES ('700', 'about', 'gdgg', '6', '579', '0', '0', '滚动公告', '2', '0', '2017-12-19 20:18:46', '2017-12-19 20:18:46');
INSERT INTO `tb_shop_admin_node` VALUES ('701', 'about', 'gdgg', '0', '700', '579', '0', '滚动公告', '3', '0', '2017-12-19 20:19:12', '2017-12-19 20:19:12');
INSERT INTO `tb_shop_admin_node` VALUES ('702', 'about', 'gdgg', '0', '701', '700', '579', '滚动公告', '4', '0', '2017-12-19 20:19:36', '2017-12-19 20:19:36');
INSERT INTO `tb_shop_admin_node` VALUES ('703', 'about', 'dhxz', '7', '579', '0', '0', '积分兑换', '2', '0', '2017-12-19 20:20:35', '2017-12-19 20:20:42');
INSERT INTO `tb_shop_admin_node` VALUES ('704', 'about', 'dhxz', '0', '703', '579', '0', '兑换须知', '3', '0', '2017-12-19 20:21:03', '2017-12-19 20:21:03');
INSERT INTO `tb_shop_admin_node` VALUES ('705', 'about', 'dhxz', '0', '704', '703', '579', '兑换须知', '4', '0', '2017-12-19 20:21:24', '2017-12-19 20:21:24');
INSERT INTO `tb_shop_admin_node` VALUES ('706', 'about', 'dhyd', '1', '703', '579', '0', '兑换要点', '3', '0', '2017-12-19 20:21:49', '2017-12-19 20:21:49');
INSERT INTO `tb_shop_admin_node` VALUES ('707', 'about', 'dhyd', '0', '706', '703', '579', '兑换要点', '4', '0', '2017-12-19 20:22:09', '2017-12-19 20:22:09');
INSERT INTO `tb_shop_admin_node` VALUES ('708', 'goodscate', 'goodscateinfo', '0', '147', '143', '142', '分类详情配置', '4', '0', '2017-12-19 21:16:18', '2017-12-19 21:16:18');
INSERT INTO `tb_shop_admin_node` VALUES ('709', 'index', 'shopindexconfig', '0', '27', '23', '0', '商城首页配置', '3', '0', '2017-12-19 22:30:27', '2017-12-19 22:30:27');
INSERT INTO `tb_shop_admin_node` VALUES ('710', 'index', 'shopindexconfig', '0', '709', '27', '23', '商城首页配置', '4', '0', '2017-12-19 22:30:42', '2017-12-19 22:30:42');
INSERT INTO `tb_shop_admin_node` VALUES ('711', 'goods', 'addgoodssku', '0', '151', '144', '142', 'sku添加', '4', '1', '2017-12-21 09:18:24', '2017-12-21 09:18:24');
INSERT INTO `tb_shop_admin_node` VALUES ('712', 'goods', 'skudel', '0', '151', '144', '142', 'sku删除', '4', '1', '2017-12-21 09:18:54', '2017-12-21 09:18:54');
INSERT INTO `tb_shop_admin_node` VALUES ('713', 'goods', 'skudelall', '0', '151', '144', '142', 'sku批量删除', '4', '1', '2017-12-21 09:19:16', '2017-12-21 09:19:16');
INSERT INTO `tb_shop_admin_node` VALUES ('714', 'goods', 'goodsskulist', '0', '151', '144', '142', 'sku展示页', '4', '1', '2017-12-21 09:20:29', '2017-12-21 09:20:29');
INSERT INTO `tb_shop_admin_node` VALUES ('715', 'goods', 'makeskutable', '0', '151', '144', '142', '生成sku表格', '4', '1', '2017-12-21 09:20:50', '2017-12-21 09:20:50');
INSERT INTO `tb_shop_admin_node` VALUES ('716', 'goods', 'makeskutable1', '0', '151', '144', '142', '追加sku', '4', '1', '2017-12-21 09:21:11', '2017-12-21 09:21:11');
INSERT INTO `tb_shop_admin_node` VALUES ('717', 'goods', 'setsku', '0', '151', '144', '142', '设置sku页面', '4', '1', '2017-12-21 09:21:34', '2017-12-21 09:21:34');
INSERT INTO `tb_shop_admin_node` VALUES ('718', 'goods', 'addsku', '0', '151', '144', '142', '自定义sku表格', '4', '1', '2017-12-21 09:21:56', '2017-12-21 09:21:56');
INSERT INTO `tb_shop_admin_node` VALUES ('719', 'goods', 'addgoodsskuattr', '0', '151', '144', '142', '保存商品对应的sku', '4', '1', '2017-12-21 09:22:33', '2017-12-21 09:22:33');
INSERT INTO `tb_shop_admin_node` VALUES ('720', 'goods', 'skunamelist', '0', '151', '144', '142', 'sku列表', '4', '1', '2017-12-21 09:22:51', '2017-12-21 09:22:51');
INSERT INTO `tb_shop_admin_node` VALUES ('721', 'goods', 'delskulist', '0', '151', '144', '142', '删除sku', '4', '1', '2017-12-21 09:23:56', '2017-12-21 09:23:56');
INSERT INTO `tb_shop_admin_node` VALUES ('722', 'skuattr', 'index', '0', '142', '0', '0', '规格(SKU)管理', '2', '1', '2017-12-21 09:32:54', '2017-12-21 09:32:54');
INSERT INTO `tb_shop_admin_node` VALUES ('723', 'skuattr', 'index', '0', '722', '142', '0', '规格(SKU)列表', '3', '1', '2017-12-21 09:33:16', '2017-12-21 09:33:16');
INSERT INTO `tb_shop_admin_node` VALUES ('724', 'goods', 'skunamelist', '0', '151', '144', '142', '获取规格', '4', '0', '2017-12-22 01:54:32', '2017-12-22 01:54:32');
INSERT INTO `tb_shop_admin_node` VALUES ('725', 'goodsmarket', 'spikegoodsadd', '0', '673', '144', '142', '编辑限时特惠商品', '4', '0', '2017-12-22 17:09:33', '2017-12-22 17:09:33');
INSERT INTO `tb_shop_admin_node` VALUES ('726', 'userprotocol', 'index', '2', '87', '0', '0', '用户协议', '2', '0', '2017-12-25 18:25:39', '2017-12-25 22:06:37');
INSERT INTO `tb_shop_admin_node` VALUES ('727', 'userprotocol', 'index', '1', '726', '87', '0', '用户协议', '3', '0', '2017-12-25 18:25:56', '2017-12-25 22:06:52');
INSERT INTO `tb_shop_admin_node` VALUES ('728', 'userprotocol', 'index', '0', '727', '726', '87', '用户协议', '4', '0', '2017-12-25 18:26:13', '2017-12-25 18:26:13');
INSERT INTO `tb_shop_admin_node` VALUES ('729', 'userprotocol', 'update', '0', '727', '726', '87', '修改用户协议', '4', '0', '2017-12-25 18:26:31', '2017-12-25 18:26:31');
INSERT INTO `tb_shop_admin_node` VALUES ('730', 'goods', 'skunamelist', '0', '151', '144', '142', '获取规格', '4', '0', '2017-12-21 10:42:20', '2017-12-21 10:42:20');
INSERT INTO `tb_shop_admin_node` VALUES ('731', 'goodsmarket', 'spikegoodsadd', '0', '673', '144', '142', '编辑限时特惠商品', '4', '0', '2017-12-22 16:43:24', '2017-12-22 16:43:43');
INSERT INTO `tb_shop_admin_node` VALUES ('732', 'goods', 'goods_pc', '0', '151', '144', '142', '官网配置', '4', '0', '2017-12-23 10:48:13', '2017-12-23 10:48:13');
INSERT INTO `tb_shop_admin_node` VALUES ('733', 'activity', 'activityconfig', '0', '643', '0', '0', '积分活动', '2', '0', '2017-12-27 16:17:29', '2017-12-28 10:32:03');
INSERT INTO `tb_shop_admin_node` VALUES ('734', 'activity', 'activityconfig', '0', '733', '643', '0', '奖品管理', '3', '0', '2017-12-27 16:18:28', '2017-12-28 10:31:50');
INSERT INTO `tb_shop_admin_node` VALUES ('735', 'activity', 'activityconfig', '0', '734', '733', '643', '奖品列表', '4', '0', '2017-12-27 16:19:20', '2017-12-28 10:31:41');
INSERT INTO `tb_shop_admin_node` VALUES ('736', 'integralorder', 'index', '0', '666', '643', '0', '积分订单', '3', '0', '2017-12-27 22:35:54', '2017-12-27 22:35:54');
INSERT INTO `tb_shop_admin_node` VALUES ('737', 'integralorder', 'index', '0', '736', '666', '643', '积分订单', '4', '0', '2017-12-27 22:36:14', '2017-12-27 22:36:14');
INSERT INTO `tb_shop_admin_node` VALUES ('738', 'integralorder', 'orderrefund', '0', '736', '666', '643', '申请退款', '4', '0', '2017-12-27 22:36:35', '2017-12-27 22:36:35');
INSERT INTO `tb_shop_admin_node` VALUES ('739', 'integralorder', 'express', '0', '736', '666', '643', '发货', '4', '0', '2017-12-27 22:36:54', '2017-12-27 22:36:54');
INSERT INTO `tb_shop_admin_node` VALUES ('740', 'integralorder', 'orderdetail', '0', '736', '666', '643', '订单详情', '4', '0', '2017-12-27 22:37:09', '2017-12-27 22:37:09');
INSERT INTO `tb_shop_admin_node` VALUES ('741', 'logs', 'index', '20', '0', '0', '0', '日志管理', '1', '0', '2017-12-28 09:40:44', '2017-12-28 09:40:44');
INSERT INTO `tb_shop_admin_node` VALUES ('742', 'logs', 'index', '0', '741', '0', '0', '日志管理', '2', '0', '2017-12-28 09:41:08', '2017-12-28 09:41:08');
INSERT INTO `tb_shop_admin_node` VALUES ('743', 'logs', 'index', '0', '742', '741', '0', '管理员日志', '3', '0', '2017-12-28 09:41:30', '2017-12-28 09:41:30');
INSERT INTO `tb_shop_admin_node` VALUES ('744', 'logs', 'index', '0', '743', '742', '741', '日志列表', '4', '0', '2017-12-28 09:41:50', '2017-12-28 09:41:50');
INSERT INTO `tb_shop_admin_node` VALUES ('745', 'logs', 'user_log', '0', '742', '741', '0', '会员日志', '3', '0', '2017-12-28 09:42:17', '2017-12-28 09:42:17');
INSERT INTO `tb_shop_admin_node` VALUES ('746', 'logs', 'user_log', '0', '745', '742', '741', '日志列表', '4', '0', '2017-12-28 09:42:39', '2017-12-28 09:42:39');
INSERT INTO `tb_shop_admin_node` VALUES ('747', 'message', 'template', '10', '0', '0', '0', '消息管理', '1', '0', '2017-12-28 09:44:10', '2017-12-28 09:54:59');
INSERT INTO `tb_shop_admin_node` VALUES ('748', 'message', 'template', '0', '747', '0', '0', '短信管理', '2', '0', '2017-12-28 09:45:09', '2017-12-28 09:45:09');
INSERT INTO `tb_shop_admin_node` VALUES ('749', 'message', 'template', '0', '748', '747', '0', '短信模板', '3', '0', '2017-12-28 09:45:31', '2017-12-28 09:45:31');
INSERT INTO `tb_shop_admin_node` VALUES ('750', 'message', 'template', '0', '749', '748', '747', '模板列表', '4', '0', '2017-12-28 09:46:05', '2017-12-28 09:46:05');
INSERT INTO `tb_shop_admin_node` VALUES ('751', 'member', 'member_vip', '0', '89', '87', '0', '会员等级', '3', '0', '2017-12-28 09:48:15', '2017-12-28 09:48:15');
INSERT INTO `tb_shop_admin_node` VALUES ('752', 'member', 'member_vip', '0', '751', '89', '87', '会员等级', '4', '0', '2017-12-28 09:48:48', '2017-12-28 09:48:48');
INSERT INTO `tb_shop_admin_node` VALUES ('753', 'member', 'do_vip', '0', '751', '89', '87', '添加/编辑', '4', '0', '2017-12-28 09:49:13', '2017-12-28 09:49:13');
INSERT INTO `tb_shop_admin_node` VALUES ('754', 'store', 'index', '5', '0', '0', '0', '门店管理', '1', '0', '2017-12-28 09:50:20', '2017-12-28 09:55:09');
INSERT INTO `tb_shop_admin_node` VALUES ('755', 'store', 'index', '0', '754', '0', '0', '门店管理', '2', '0', '2017-12-28 09:50:40', '2017-12-28 09:50:40');
INSERT INTO `tb_shop_admin_node` VALUES ('756', 'store', 'index', '0', '755', '754', '0', '门店列表', '3', '0', '2017-12-28 09:51:03', '2017-12-28 09:51:03');
INSERT INTO `tb_shop_admin_node` VALUES ('757', 'store', 'index', '0', '756', '755', '754', '门店列表', '4', '0', '2017-12-28 09:51:24', '2017-12-28 09:51:24');
INSERT INTO `tb_shop_admin_node` VALUES ('758', 'store', 'addstore', '0', '756', '755', '754', '添加门店', '4', '0', '2017-12-28 09:51:43', '2017-12-28 09:51:43');
INSERT INTO `tb_shop_admin_node` VALUES ('759', 'store', 'editstore', '0', '756', '755', '754', '编辑门店', '4', '0', '2017-12-28 09:52:03', '2017-12-28 09:52:03');
INSERT INTO `tb_shop_admin_node` VALUES ('760', 'store', 'delstore', '0', '756', '755', '754', '门店删除', '4', '0', '2017-12-28 09:52:24', '2017-12-28 09:52:24');
INSERT INTO `tb_shop_admin_node` VALUES ('761', 'dealer', 'index', '5', '0', '0', '0', '经销商管理', '1', '0', '2017-12-28 10:04:39', '2017-12-28 10:06:49');
INSERT INTO `tb_shop_admin_node` VALUES ('762', 'dealer', 'index', '0', '761', '0', '0', '经销商管理', '2', '0', '2017-12-28 10:05:05', '2017-12-28 10:05:05');
INSERT INTO `tb_shop_admin_node` VALUES ('763', 'dealer', 'index', '0', '762', '761', '0', '经销商列表', '3', '0', '2017-12-28 10:05:24', '2017-12-28 10:05:24');
INSERT INTO `tb_shop_admin_node` VALUES ('764', 'dealer', 'index', '0', '763', '762', '761', '经销商列表', '4', '0', '2017-12-28 10:05:45', '2017-12-28 10:05:45');
INSERT INTO `tb_shop_admin_node` VALUES ('765', 'dealer', 'do_dealer', '0', '763', '762', '761', '经销商添加', '4', '0', '2017-12-28 10:06:09', '2017-12-28 10:06:09');
INSERT INTO `tb_shop_admin_node` VALUES ('766', 'dealer', 'del_dealer', '0', '763', '762', '761', '经销商删除', '4', '0', '2017-12-28 10:06:35', '2017-12-28 10:06:35');
INSERT INTO `tb_shop_admin_node` VALUES ('767', 'activity', 'activityconfiginfo', '0', '734', '733', '643', '奖品配置', '4', '0', '2017-12-28 10:38:01', '2017-12-28 10:38:01');
INSERT INTO `tb_shop_admin_node` VALUES ('768', 'goodsorder', 'index', '0', '202', '201', '0', '订单列表', '3', '0', '2017-12-28 10:51:52', '2017-12-28 10:51:52');
INSERT INTO `tb_shop_admin_node` VALUES ('769', 'goodsorder', 'index', '0', '768', '202', '201', '订单列表', '4', '0', '2017-12-28 10:52:19', '2017-12-28 10:52:19');
INSERT INTO `tb_shop_admin_node` VALUES ('770', 'goodsorder', 'orderdetail', '0', '768', '202', '201', '订单详情', '4', '0', '2017-12-28 10:52:42', '2017-12-28 10:52:42');
INSERT INTO `tb_shop_admin_node` VALUES ('771', 'goodsorder', 'editordergoodsprice', '0', '768', '202', '201', '修改订单价格', '4', '0', '2017-12-28 10:53:09', '2017-12-28 10:53:17');
INSERT INTO `tb_shop_admin_node` VALUES ('772', 'goodsorder', 'orderpay', '0', '768', '202', '201', '后台订单支付', '4', '0', '2017-12-28 10:53:38', '2017-12-28 10:53:38');
INSERT INTO `tb_shop_admin_node` VALUES ('773', 'goodsorder', 'goodslist', '0', '768', '202', '201', '未发货商品', '4', '0', '2017-12-28 10:53:58', '2017-12-28 10:53:58');
INSERT INTO `tb_shop_admin_node` VALUES ('774', 'goodsorder', 'ordercancel', '0', '768', '202', '201', '订单取消', '4', '0', '2017-12-28 10:54:28', '2017-12-28 10:54:28');
INSERT INTO `tb_shop_admin_node` VALUES ('775', 'goodsorder', 'orderrefund', '0', '768', '202', '201', '线上退款', '4', '0', '2017-12-28 11:27:28', '2017-12-28 11:27:28');
INSERT INTO `tb_shop_admin_node` VALUES ('776', 'goodsorder', 'editremark', '0', '768', '202', '201', '修改备注', '4', '0', '2017-12-28 13:50:48', '2017-12-28 13:50:48');
INSERT INTO `tb_shop_admin_node` VALUES ('777', 'goodsorder', 'editaddress', '0', '768', '202', '201', '修改收货地址', '4', '0', '2017-12-28 13:51:22', '2017-12-28 13:51:22');
INSERT INTO `tb_shop_admin_node` VALUES ('778', 'message', 'note', '0', '748', '747', '0', '短信消息', '3', '0', '2017-12-28 15:54:07', '2017-12-28 15:54:07');
INSERT INTO `tb_shop_admin_node` VALUES ('779', 'message', 'note', '0', '778', '748', '747', '短信消息列表', '4', '0', '2017-12-28 15:54:22', '2017-12-28 15:54:22');
INSERT INTO `tb_shop_admin_node` VALUES ('780', 'finance', 'index', '13', '0', '0', '0', '提现管理', '1', '1', '2017-12-29 16:19:36', '2017-12-29 16:19:36');
INSERT INTO `tb_shop_admin_node` VALUES ('781', 'index', 'delall', '0', '25', '24', '23', '硬删除', '4', '0', '2017-12-30 00:19:08', '2017-12-30 00:19:08');
INSERT INTO `tb_shop_admin_node` VALUES ('782', 'bill', 'index', '3', '726', '87', '0', '发票管理', '3', '1', '2018-01-02 09:01:30', '2018-01-02 09:01:30');
INSERT INTO `tb_shop_admin_node` VALUES ('783', 'bill', 'index', '3', '87', '0', '0', '发票管理', '2', '0', '2018-01-02 09:21:50', '2018-01-02 09:21:50');
INSERT INTO `tb_shop_admin_node` VALUES ('784', 'bill', 'index', '1', '783', '87', '0', '发票列表', '3', '0', '2018-01-02 09:22:17', '2018-01-02 09:22:17');
INSERT INTO `tb_shop_admin_node` VALUES ('785', 'bill', 'index', '1', '784', '783', '87', '发票列表', '4', '0', '2018-01-02 09:22:33', '2018-01-02 09:22:33');
INSERT INTO `tb_shop_admin_node` VALUES ('786', 'bill', 'billdetail', '2', '784', '783', '87', '发票详情', '4', '0', '2018-01-02 09:23:14', '2018-01-02 09:23:14');
INSERT INTO `tb_shop_admin_node` VALUES ('787', 'finance', 'index', '4', '87', '0', '0', '提现管理', '2', '0', '2018-01-02 09:24:42', '2018-01-02 09:24:42');
INSERT INTO `tb_shop_admin_node` VALUES ('788', 'finance', 'index', '1', '787', '87', '0', '提现列表', '3', '0', '2018-01-02 09:25:02', '2018-01-02 09:25:02');
INSERT INTO `tb_shop_admin_node` VALUES ('789', 'finance', 'index', '1', '788', '787', '87', '提现列表', '4', '0', '2018-01-02 09:25:23', '2018-01-02 09:25:23');
INSERT INTO `tb_shop_admin_node` VALUES ('790', 'finance', 'tixian', '2', '788', '787', '87', '提现', '4', '0', '2018-01-02 09:28:31', '2018-01-02 09:28:31');
INSERT INTO `tb_shop_admin_node` VALUES ('791', 'finance', 'jujue', '3', '788', '787', '87', '拒绝', '4', '0', '2018-01-02 09:28:47', '2018-01-02 09:29:50');
INSERT INTO `tb_shop_admin_node` VALUES ('792', 'bill', 'billdel', '3', '784', '783', '87', '发票状态', '4', '0', '2018-01-02 09:42:26', '2018-01-02 09:42:26');
INSERT INTO `tb_shop_admin_node` VALUES ('793', 'goods', 'match', '0', '144', '142', '0', '商品搭配', '4', '0', '2018-01-02 14:24:43', '2018-01-02 14:29:29');


INSERT INTO `tb_shop_admin_node` VALUES ('794', 'goods', 'goods_match_select', '0', '144', '142', '0', '商品搭配', '4', '0', '', '');