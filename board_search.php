<?php

#데이터베이스의 정보를 읽어온다
require_once("data/db_info.php");

#데이터베이스 접속과 데이터베이스 선택
$s = mysql_connect($SERV, $USER, $PASS) or die("실패입니다.");
mysql_select_db($DBNM);

print <<<eot1
	<html>
		<head>
			<meta http-equiv="Content-Type" content="text/html;charset=utf-8">
			<title>SQL 카페 검색 화면</title>
		</head>
		<body bgcolor="orange">
			<font size="5">
				(검색 결과는 여기에)
			</font>
			<br> 
eot1;

#검색 문자열을 가져와서 태그 삭제
$se_d = isset($_GET["se"]) ? htmlspecialchars($_GET["se"]) : null;

#검색 문자열($se_d)에 데이터가 있으면 검색 처리
if($se_d<>""){

#검색 SQL 문. 테이블 tbj1에 tbj0을 결합(조인)
$str = <<<eot2
	SELECT tbj1.number, tbj1.name, tbj1.mess, tbj0.thread
		FROM tbj1
	JOIN tbj0
	ON
		tbj1.gnum = tbj0.gnum
	WHERE tbj1.mess LIKE "%$se_d%"
eot2;

#검색 질의 실행
	$re = mysql_query($str);
	while($result = mysql_fetch_array($re)){
		print " $result[0] : $result[1] : $result[2] (  $result[3]  )";
		print "<br><br>";
	}
}

#데이터베이스 종료
mysql_close($s);

print <<<eot3
	<hr>
		메세지에 포함되는 문자를 입력하세요!
	<br>
		<form method="GET" action="board_search.php">
			검색할 문자열
		<input type="text" name="se">
		<br>
		<input type="submit" value="확인">
		</form>
	<br>
		<a href="board_top.php">
			스레드 목록으로 돌아가기
		</a>
	</body>
	</html>
eot3;
?>

