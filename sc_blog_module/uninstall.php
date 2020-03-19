<?php
$sql = <<<SQLS
DROP TABLE IF EXISTS `ims_sc_blog_articles`;
DROP TABLE IF EXISTS `ims_sc_blog_categorys`;
DROP TABLE IF EXISTS `ims_sc_blog_comments`;
DROP TABLE IF EXISTS `ims_sc_blog_links`;
DROP TABLE IF EXISTS `ims_sc_blog_requestlog`;
DROP TABLE IF EXISTS `ims_sc_blog_users`;
DROP TABLE IF EXISTS `ims_sc_blog_weiyu`;
DROP TABLE IF EXISTS `ims_sc_blog_works`;
SQLS;

if (!empty($sql)) {
    pdo_query($sql);
}