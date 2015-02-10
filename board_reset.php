<?php

#데이터베이스의 정보를 읽어온다
require_once("data/db_info.php");

#데이터베이스 접속과 데이터베이스 선택
$s = mysql_connect($SERV, $USER, $PASS) or die("실패입니다.");
mysql_select_db($DBNM);

mysql_query("DELETE FROM tbj0");
mysql_query("DELETE FROM tbj1");
mysql_query("ALTER TABLE tbj0 AUTO_INCREMENT=0");
mysql_query("ALTER TABLE tbj1 AUTO_INCREMENT=0");

print "SQL 카페를 초기화했습니다.";

mysql_close($s);
?>