<?php
$sql = <<<SQLS
SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

DROP TABLE IF EXISTS `ims_sc_blog_articles`;
CREATE TABLE `ims_sc_blog_articles`  (
  `id` int(10) NOT NULL AUTO_INCREMENT COMMENT '自增id',
  `cid` int(10) NOT NULL DEFAULT 0 COMMENT '分类id',
  `title` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '文章标题',
  `keyword` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT 'seo关键词',
  `description` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT 'seo描述',
  `readnum` int(10) NULL DEFAULT 0 COMMENT '阅读数量',
  `likenum` int(10) NULL DEFAULT 0 COMMENT '点赞数量',
  `author` varchar(15) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '文章作者',
  `remark` varchar(240) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '文章摘要',
  `openlevel` int(1) NOT NULL DEFAULT 2 COMMENT '公开权限，1公开，2隐藏',
  `recommend` int(1) NOT NULL DEFAULT 2 COMMENT '推荐',
  `imgurl` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '图片url',
  `uid` int(10) NULL DEFAULT NULL COMMENT '所属用户ID',
  `udat` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '修改时间',
  `cdat` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '创建时间',
  `content` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL COMMENT '博文内容',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 128 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

INSERT INTO `ims_sc_blog_articles` VALUES (127, 1, '欢迎使用ScarecrowBlog', 'scarecrowblog', 'scarecrowblog', 1, 0, 'Scarecrow', 'ScarecrowBlog使用说明', 1, 1, 'https://wq.scarecrow.top/attachment/images/7/2020/03/P9q94GlKsazq35UA4GzVu9VZ49q4k4.jpg', 1, '1583158151', '1583158151', '欢迎使用ScarecrowBlog，本博客只支持文章类博客不支持图文模式！\n本博客更多的是心情类的诉说而非技术类的展示~~~');

DROP TABLE IF EXISTS `ims_sc_blog_categorys`;
CREATE TABLE `ims_sc_blog_categorys`  (
  `cid` int(10) NOT NULL AUTO_INCREMENT COMMENT '自增id',
  `title` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '分类标题',
  `sort` int(3) NOT NULL DEFAULT 1 COMMENT '排序id',
  `cdat` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '创建时间',
  PRIMARY KEY (`cid`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

INSERT INTO `ims_sc_blog_categorys` VALUES (1, '默认分类', 1, '1532807040');
INSERT INTO `ims_sc_blog_categorys` VALUES (2, '编程代码', 2, '1535460216');
INSERT INTO `ims_sc_blog_categorys` VALUES (3, '生活琐事', 4, '1535460233');
INSERT INTO `ims_sc_blog_categorys` VALUES (4, '杂七杂八', 5, '1535460242');

DROP TABLE IF EXISTS `ims_sc_blog_comments`;
CREATE TABLE `ims_sc_blog_comments`  (
  `id` int(10) NOT NULL AUTO_INCREMENT COMMENT '自增id',
  `content` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '内容',
  `uid` int(10) NOT NULL COMMENT '评论人uid',
  `cdat` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '创建时间',
  `is_open` tinyint(1) NULL DEFAULT 0 COMMENT '是否展示',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 369 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

INSERT INTO `ims_sc_blog_comments` VALUES (335, '欢迎使用ScarecrowBlog小程序~', 0, '1571627924', 1);

DROP TABLE IF EXISTS `ims_sc_blog_links`;
CREATE TABLE `ims_sc_blog_links`  (
  `id` int(5) NOT NULL AUTO_INCREMENT COMMENT '自增id',
  `title` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '网站名称',
  `url` varchar(150) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '网站url',
  `pic` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '图片地址',
  `texts` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '简单说明',
  `sort` int(5) NOT NULL DEFAULT 1 COMMENT '排序id',
  `spread_id` int(5) NOT NULL DEFAULT 0 COMMENT '父类id',
  `status` int(1) NOT NULL DEFAULT 1 COMMENT '状态,1为显示,2为隐藏',
  `cdat` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '创建时间',
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `title`(`title`) USING BTREE,
  INDEX `cdat`(`cdat`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 45 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

INSERT INTO `ims_sc_blog_links` VALUES (1, '程序猿们~大佬集中营', '', '', '', 1, 0, 1, '1512398195');
INSERT INTO `ims_sc_blog_links` VALUES (2, 'ScarecrowBlog', 'https://scarecrow.top', 'https://scarecrow.top/scarecrow.png', '真正的大师永远抱着一颗学徒的心~', 1000, 1, 1, '1573692467');

DROP TABLE IF EXISTS `ims_sc_blog_requestlog`;
CREATE TABLE `ims_sc_blog_requestlog`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `option_id` int(11) NULL DEFAULT 0 COMMENT '入口场景值',
  `create_at` bigint(12) NULL DEFAULT 0 COMMENT '访问时间',
  `ip` char(16) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT '' COMMENT 'IP地址',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 42 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci COMMENT = '用户访问日志' ROW_FORMAT = Dynamic;

DROP TABLE IF EXISTS `ims_sc_blog_users`;
CREATE TABLE `ims_sc_blog_users`  (
  `id` int(10) NOT NULL AUTO_INCREMENT COMMENT '自增id',
  `nickname` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '昵称',
  `imgurl` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '头像地址',
  `sex` tinyint(1) NOT NULL DEFAULT 1 COMMENT '性别 0:女 1:男',
  `is_admin` tinyint(1) NULL DEFAULT 0 COMMENT '是否是管理员0：否 1:是',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

INSERT INTO `ims_sc_blog_users` VALUES (1, 'Scarecrow', 'http://wq.scarecrow.top/attachment/images/7/2020/03/bP0w12XCNvCmZaxArNPrNAXV2F021w.jpg', 1, 1);

DROP TABLE IF EXISTS `ims_sc_blog_weiyu`;
CREATE TABLE `ims_sc_blog_weiyu`  (
  `id` int(10) NOT NULL AUTO_INCREMENT COMMENT '自增id',
  `content` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL COMMENT '内容',
  `status` int(1) NOT NULL DEFAULT 1 COMMENT '状态,1为显示,2为隐藏',
  `cdat` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '创建时间',
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `cdat`(`cdat`) USING BTREE,
  INDEX `status`(`status`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 102 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

INSERT INTO `ims_sc_blog_weiyu` VALUES (1, '在1024这个程序员的节日里，我正式上线了我的博客，同时祝所有程序员BUG不断。。。。。加油！', 1, '1571883840');
INSERT INTO `ims_sc_blog_weiyu` VALUES (2, '2019再见，2020你好！', 1, '1571883840');
INSERT INTO `ims_sc_blog_weiyu` VALUES (3, '武汉加油！', 1, '1572064380');
INSERT INTO `ims_sc_blog_weiyu` VALUES (4, 'ScarecrowBlog小程序微擎版本正式开始开发', 1, '1572082403');
INSERT INTO `ims_sc_blog_weiyu` VALUES (5, 'ScarecrowBlog小程序前端正式开发完成', 1, '1572144799');
INSERT INTO `ims_sc_blog_weiyu` VALUES (6, 'ScarecrowBlog小程序后端正式开发完成', 1, '1572187385');
INSERT INTO `ims_sc_blog_weiyu` VALUES (7, '上线ScarecrowBlog小程序', 1, '1572233615');

DROP TABLE IF EXISTS `ims_sc_blog_works`;
CREATE TABLE `ims_sc_blog_works`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '作品名称',
  `img_href` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL COMMENT '作品图片地址',
  `to_href` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL COMMENT '作品跳转地址',
  `introduce` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT '' COMMENT '作品介绍',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 7 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci COMMENT = '作品列表' ROW_FORMAT = Dynamic;

INSERT INTO `ims_sc_blog_works` VALUES (1, 'scarecrowWechatSDK', 'https://scarecrow.top/assets/frontend/images/home/wdxm_wx.jpg', 'https://gitee.com/scarecrowpqs/scarecrowWechatSDK', '微信H5支付、查询、退款等');
INSERT INTO `ims_sc_blog_works` VALUES (2, 'scarecrowAlipaySDK', 'https://scarecrow.top/assets/frontend/images/home/wdxm_zfb.jpg', 'https://gitee.com/scarecrowpqs/scarecrowAlipaySDK', '支付宝支付SDK:移除官方框架、支持PSR4');
INSERT INTO `ims_sc_blog_works` VALUES (3, 'scarecrowChineseToPinYin', 'https://scarecrow.top/assets/frontend/images/home/wdxm_hztpy.jpg', 'https://gitee.com/scarecrowpqs/ScarecrowChineseToPinYin', '中文转拼音工具包');
INSERT INTO `ims_sc_blog_works` VALUES (4, 'scarecrowBlog', 'https://scarecrow.top/assets/frontend/images/home/wdxm_scarecrowblog.png', 'https://github.com/scarecrowpqs/ScarecrowBlog', '一个简单大气的技术博客！分前端和后台控制.....');

SET FOREIGN_KEY_CHECKS = 1;
SQLS;

if (!empty($sql)) {
    pdo_query($sql);
}