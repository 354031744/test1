CREATE DATABASE IF NOT EXISTS content_management DEFAULT CHARSET utf8;

USE content_management;

SET NAMES utf8;

CREATE TABLE `pf_arctype` (
   `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
   `classification_name` varchar(45) NOT NULL,
   `is_display` int(11) NOT NULL,
   `order` int(11) NOT NULL COMMENT '排序',
   `category_parent` varchar(45) NOT NULL COMMENT '上级分类',
   `classification_model` varchar(45) NOT NULL COMMENT '分类模型',
   `classified_catalogue` varchar(45) DEFAULT NULL COMMENT '分类目录',
   `keyword` varchar(45) DEFAULT NULL COMMENT '关键词',
   `comments` varchar(45) DEFAULT NULL COMMENT '描述',
   `display_mode` varchar(20) DEFAULT NULL COMMENT '显示方式',
   `classification_icon` varchar(45) DEFAULT NULL COMMENT '分类图标',
   `list_mode` varchar(45) DEFAULT NULL,
   `content_mode` varchar(45) DEFAULT NULL,
   `identifier` varchar(45) DEFAULT NULL,
   PRIMARY KEY (`id`)
 ) ENGINE=InnoDB DEFAULT CHARSET=utf8

CREATE TABLE `pf_archive` (
   `id` int(11) NOT NULL AUTO_INCREMENT,
   `classified_catalogue` varchar(45) NOT NULL COMMENT '所属分类',
   `title` varchar(45) NOT NULL,
   `attribute` varchar(45) NOT NULL COMMENT '属性',
   `thumbnail` varchar(45) DEFAULT NULL COMMENT '缩略图',
   `content` text,
   `membership_level` varchar(20) DEFAULT NULL COMMENT '可查看文章的会员等级',
   `articles_source` varchar(45) DEFAULT NULL,
   `keyword` varchar(45) DEFAULT NULL,
   `describe` varchar(60) DEFAULT NULL COMMENT '描述',
   `clicks` int(11) DEFAULT NULL COMMENT '点击数',
   `status` int(11) DEFAULT NULL,
   `author` varchar(45) DEFAULT NULL,
   `create_time` datetime DEFAULT NULL,
   `update_time` datetime DEFAULT NULL,
   PRIMARY KEY (`id`)
 ) ENGINE=InnoDB DEFAULT CHARSET=utf8