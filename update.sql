--2014年2月8日添加用户赞同数--
ALTER TABLE `ask_user` ADD `supports` INT( 10 ) NOT NULL DEFAULT '0' COMMENT '赞同' AFTER `adopts` ;
