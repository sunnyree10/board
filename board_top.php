<?php

require_once("data/db_info.php");

$s=mysql_connect($SERV, $USER, $PASS) or die("실패입니다.");
mysql_select_db($DBNM);

print <<<eot1
	<html>
		<head>
			<meta http-equiv="Content-Type" content="text/html;charset=utf-8">
			<title>SQL 카페 화면</title>
		</head>
		<body bgcolor="lightsteelblue">
			<img src="pic/parent.gif" alt="사진 구함">
			<font size="7" color="indigo">
				SQL 카페 게시판입니다~
			</font>
			<br><br>
			확인하고자 하는 스레드 번호를 누르세요.
			<hr>
			<font size="5">
				(스레드 목록)
			</font>
			<br> 
eot1;
#클라이언트의 IP 주소 가져오기
$ip = getenv("REMOTE_ADDR");
#스레드 제목(th)에 데이터가 있으면 테이블 tbj0에 대입 
$th_d = isset($_GET["th"]) ? htmlspecialchars($_GET["th"]) : null;
if($th_d<>""){
	mysql_query("INSERT INTO tbj0 (thread, date, ipaddr) VALUES('$th_d', NOW(), '$ip')");
}
#tbj0의 모든 데이터 추출
$re = mysql_query("SELECT * FROM tbj0");
while($result = mysql_fetch_array($re)){
print <<<eot2
				<a href="board.php?gn=$result[0]">$result[0]   $result[1]</a>
				<br>
				$result[2]작성<br><br>
eot2;
}
#데이터베이스 접속 종료
mysql_close($s);
#스레드 제목 입력과 메인 화면으로 이동하는 링크 등
print <<<eot3
			<hr>
			<font size="5">
				스레드 작성
			</font>
			<br>
				여기에 새로운 스레드를 작성합니다!
			<br>
			<form action="board_top.php" method="GET">
				새로 작성할 스레드의 제목
				<input type="text" name="th" size="50">
				<br>
				<input type="submit" value="확인">
			</form>
			<hr>
			<font size="5">
				메세지 검색
			</font>
			<a href="board_search.php">검색을 하려면 여기를 누르세요</a>
			<hr>
		</body>
	</html>
eot3;

?>