--2014年2月8日添加用户赞同数--
ALTER TABLE `ask_user` ADD `supports` INT( 10 ) NOT NULL DEFAULT '0' COMMENT '赞同' AFTER `adopts` ;

--2014年2月10日添加赞同表
CREATE TABLE IF NOT EXISTS `ask_answer_support` (
 `sid` char(16) NOT NULL,
 `aid` int(10) NOT NULL,
 `time` int(10) NOT NULL,
 PRIMARY KEY (`sid`,`aid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8


--2014年2月10日添加用户擅长分类表
CREATE TABLE IF NOT EXISTS `ask_user_category` (
  `uid` int(10) NOT NULL,
  `cid` int(4) NOT NULL,
  PRIMARY KEY (`uid`,`cid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;



ALTER TABLE `ask_answer` ADD `comment` TINYTEXT NULL AFTER `content` ;

