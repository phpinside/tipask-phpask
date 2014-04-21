<?php

//本程序用于把Tipask2.0beta 升级到V2.0正式版

error_reporting(0);
@set_magic_quotes_runtime(0);
@set_time_limit(1000);
define('IN_TIPASK', TRUE);
define('TIPASK_ROOT', dirname(__FILE__));
require TIPASK_ROOT . '/config.php';
header("Content-Type: text/html; charset=" . TIPASK_CHARSET);
require TIPASK_ROOT . '/lib/global.func.php';
require TIPASK_ROOT . '/lib/db.class.php';
$action = ($_POST['action']) ? $_POST['action'] : $_GET['action'];
if (!stristr(strtolower(TIPASK_VERSION), '2.5beta')) {
    exit('本程序只能升级Tipask 2.0版release 201201210 到Tipask2.5请不要重复升级！');
}
$upgrade = <<<EOT
ALTER TABLE ask_user ADD authstr varchar(25) null AFTER signature;
DROP TABLE IF EXISTS ask_answer_append;
CREATE TABLE ask_answer_append (
    appendanswerid int(10) NOT NULL AUTO_INCREMENT,
    answerid int(10) NOT NULL,
    author varchar(20) NOT NULL,
    authorid int(10) NOT NULL,
    content text NOT NULL,
    `time` int(10) NOT NULL,
    PRIMARY KEY (appendanswerid),
    KEY answerid (answerid),
    KEY authorid (authorid),
    KEY `time` (`time`)
) ENGINE=MyISAM;

DROP TABLE IF EXISTS ask_question_attention;
CREATE TABLE ask_question_attention (
  `qid` int(10) NOT NULL,
  `followerid` int(10) NOT NULL,
  `follower` char(18) NOT NULL,
  `time` int(10) NOT NULL,
  PRIMARY KEY (`qid`,`followerid`)
) ENGINE=MyISAM;

DROP TABLE IF EXISTS ask_user_attention;
CREATE TABLE ask_user_attention (
  `uid` int(10) NOT NULL,
  `followerid` int(10) NOT NULL,
  `follower` char(18) NOT NULL,
  `time` int(10) NOT NULL,
  PRIMARY KEY (`uid`,`followerid`)
) ENGINE=MyISAM;


ALTER TABLE `ask_user` ADD `followers` INT( 10 ) NOT NULL DEFAULT '0' AFTER `supports` ;
ALTER TABLE `ask_user` ADD `attentions` INT( 10 ) NOT NULL DEFAULT '0' AFTER `followers`;

DROP TABLE IF EXISTS ask_user_readlog;
CREATE TABLE ask_user_readlog (
  `uid` int(10) NOT NULL,
  `qid` int(10) NOT NULL,
  PRIMARY KEY (`uid`,`qid`)
) ENGINE=MyISAM;
        
DROP TABLE IF EXISTS ask_doing;
CREATE TABLE ask_doing (
  `doingid` bigint(20) NOT NULL AUTO_INCREMENT,
  `authorid` int(10) NOT NULL,
  `author` varchar(20) NOT NULL,
  `action` tinyint(1) NOT NULL,
  `questionid` int(10) NOT NULL,
  `content` text,
  `referid` int(10) NOT NULL DEFAULT '0',
  `refer_authorid` int(10) NOT NULL DEFAULT '0',
  `refer_content` tinytext,
  `createtime` int(10) NOT NULL,
  PRIMARY KEY (`doingid`),
  KEY `authorid` (`authorid`,`author`),
  KEY `sourceid` (`questionid`),
  KEY `createtime` (`createtime`),
  KEY `referid` (`referid`)
) ENGINE=MyISAM;        
EOT;

$extend = <<<EOT
ALTER TABLE ask_answer DROP tag;
EOT;
if (!$action) {
    echo '<meta http-equiv=Content-Type content="text/html;charset=' . TIPASK_CHARSET . '">';
    echo"本程序仅用于升级 Tipask2.0 到 Tipask2.5Beta版,请确认之前已经顺利安装Tipask2.0版本!<br><br><br>";
    echo"<b><font color=\"red\">运行本升级程序之前,请确认已经上传 Tipask2.5Beta版的全部文件和目录</font></b><br><br>";
    echo"<b><font color=\"red\">本程序只能从Tipask2.0正式版到 Tipask2.5Beta版,切勿使用本程序从其他版本升级,否则可能会破坏掉数据库资料.<br><br>强烈建议您升级之前备份数据库资料!</font></b><br><br>";
    echo"正确的升级方法为:<br>1. 上传 Tipask2.5Beta版的全部文件和目录,覆盖服务器上的Tipask2.0正式版;<br>2. 上传本程序(2.0To2.5beta.php)到 Tipask目录中;<br>3. 运行本程序,直到出现升级完成的提示;<br>4. 登录Tipask后台,更新缓存,升级完成。<br><br>";
    echo"<a href=\"$PHP_SELF?action=upgrade\">如果您已确认完成上面的步骤,请点这里升级</a>";
} else {
    $db = new db(DB_HOST, DB_USER, DB_PW, DB_NAME, DB_CHARSET, DB_CONNECT);
    runquery($upgrade);
    $query = $db->query("SELECT * FROM " . DB_TABLEPRE . "answer WHERE tag<>''");
    while ($answer = $db->fetch_array($query)) {
        $question = $db->fetch_first("SELECT * FROM " . DB_TABLEPRE . "question WHERE `id`=" . $answer['qid']);
        $taglist = tstripslashes(unserialize($answer['tag']));
        $stime = $answer['time'];
        foreach ($taglist as $index => $tag) {
            $stime+=rand(60,7200);
            $tag = '<p>'.strip_tags($tag).'</p>';
            if ($index % 2 == 0) {
                $db->query("INSERT INTO " . DB_TABLEPRE . "answer_append(appendanswerid,answerid,author,authorid,content,time) VALUES (NULL,".$answer['id'].",'".$question['author']."',".$question['authorid'].",'$tag',$stime)");
            } else {                
                $db->query("INSERT INTO " . DB_TABLEPRE . "answer_append(appendanswerid,answerid,author,authorid,content,time) VALUES (NULL,".$answer['id'].",'".$answer['author']."',".$answer['authorid'].",'$tag',$stime)");
            }
        }
    }
//    $config = "<?php \r\ndefine('DB_HOST',  '" . DB_HOST . "');\r\n";
//    $config .= "define('DB_USER',  '" . DB_USER . "');\r\n";
//    $config .= "define('DB_PW',  '" . DB_PW . "');\r\n";
//    $config .= "define('DB_NAME',  '" . DB_NAME . "');\r\n";
//    $config .= "define('DB_CHARSET', '" . DB_CHARSET . "');\r\n";
//    $config .= "define('DB_TABLEPRE',  '" . DB_TABLEPRE . "');\r\n";
//    $config .= "define('DB_CONNECT', 0);\r\n";
//    $config .= "define('TIPASK_CHARSET', '" . TIPASK_CHARSET . "');\r\n";
//    $config .= "define('TIPASK_VERSION', '2.5Beta');\r\n";
//    $config .= "define('TIPASK_RELEASE', '20140326');\r\n";
//    $fp = fopen(TIPASK_ROOT . '/config.php', 'w');
//    fwrite($fp, $config);
//    fclose($fp);
//    cleardir(TIPASK_ROOT . '/data/cache');
//    cleardir(TIPASK_ROOT . '/data/view');
//    cleardir(TIPASK_ROOT . '/data/tmp');
    echo "<font color='red'>升级说明：请登录到tipask后台，重新更改一下用户组权限，还有其他一些新特性!</font><br />";
    echo "升级完成,请删除本升级文件,更新缓存以便完成升级,如果后台登录不进去，请直接删除data/view 目录下的所有.tpl文件，<font color='red'>切记需要保留view目录</font>";
}

function createtable($sql, $dbcharset) {
    $type = strtoupper(preg_replace("/^\s*CREATE TABLE\s+.+\s+\(.+?\).*(ENGINE|TYPE)\s*=\s*([a-z]+?).*$/isU", "\\2", $sql));
    $type = in_array($type, array('MYISAM', 'HEAP')) ? $type : 'MYISAM';
    return preg_replace("/^\s*(CREATE TABLE\s+.+\s+\(.+?\)).*$/isU", "\\1", $sql) .
            (mysql_get_server_info() > '4.1' ? " ENGINE=$type default CHARSET=$dbcharset" : " TYPE=$type");
}

function runquery($query) {
    global $db;
    $query = str_replace("\r", "\n", str_replace('ask_', DB_TABLEPRE, $query));
    $expquery = explode(";\n", $query);
    foreach ($expquery as $sql) {
        $sql = trim($sql);
        if ($sql == '' || $sql[0] == '#')
            continue;
        if (strtoupper(substr($sql, 0, 12)) == 'CREATE TABLE') {
            $db->query(createtable($sql, DB_CHARSET));
        } else {
            $db->query($sql);
        }
    }
}

?>
