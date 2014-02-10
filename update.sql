--2014年2月8日添加用户赞同数--
ALTER TABLE `ask_user` ADD `supports` INT( 10 ) NOT NULL DEFAULT '0' COMMENT '赞同' AFTER `adopts` ;

--2014年2月10日添加赞同表
CREATE TABLE `ask_answer_support` (
 `sid` char(16) NOT NULL,
 `aid` int(10) NOT NULL,
 `time` int(10) NOT NULL,
 PRIMARY KEY (`sid`,`aid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8
