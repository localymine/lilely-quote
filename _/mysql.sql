-- 9-6-2015
ALTER TABLE `post` ADD `post_mv_type` TINYINT(1) NOT NULL DEFAULT '0' COMMENT '0: youtube; 1: vimeo' AFTER `post_youtube`;
ALTER TABLE `post_lang` ADD `l_post_mv_type` TINYINT(1) NOT NULL DEFAULT '0' COMMENT '0: youtube; 1: vimeo' AFTER `l_post_youtube`;
