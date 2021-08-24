<?php
$conn = mysqli_connect("localhost","root","123456");
//var_dump($conn);
//object(mysqli)'#'1 (19) { ["affected_rows"]=> int(0) ["client_info"]=> string(79) "mysqlnd 5.0.11-dev - 20120503 - $Id: 3c688b6bbc30d36af3ac34fdd4b7b5b787fe5555 $" ["client_version"]=> int(50011) ["connect_errno"]=> int(0) ["connect_error"]=> NULL ["errno"]=> int(0) ["error"]=> string(0) "" ["error_list"]=> array(0) { } ["field_count"]=> int(0) ["host_info"]=> string(20) "localhost via TCP/IP" ["info"]=> NULL ["insert_id"]=> int(0) ["server_info"]=> string(6) "5.7.26" ["server_version"]=> int(50726) ["stat"]=> string(135) "Uptime: 35636 Threads: 2 Questions: 644 Slow queries: 0 Opens: 140 Flush tables: 1 Open tables: 29 Queries per second avg: 0.018" ["sqlstate"]=> string(5) "00000" ["protocol_version"]=> int(10) ["thread_id"]=> int(82) ["warning_count"]=> int(0) }
mysqli_select_db($conn,"db_bbs");

$sql = "select * from user_info";
$result = mysqli_query($conn,$sql);
//object(mysqli_result)'#'2 (5) { ["current_field"]=> int(0) ["field_count"]=> int(6) ["lengths"]=> NULL ["num_rows"]=> int(2) ["type"]=> int(0) }
//var_dump($result);
$row = mysqli_fetch_array($result);
//while ($row){
//    echo "$row[1]";
//}
var_dump($row);
//$sql = "create database newbase";
//var_dump(mysqli_query($conn,$sql));
//bool(true)

//$sql = "create table user_text(id int(10),name varchar(10))";
//var_dump(mysqli_query($conn,$sql));
//bool(true)

//$sql = "insert into user_text(id,name)values(1,'张伞')";
//var_dump(mysqli_query($conn,$sql));
//bool(true)

//$sql = "delete from user_text where id='1'";
//var_dump(mysqli_query($conn,$sql));
//bool(true)

//$sql = "update user_text set name='李四' where id='1'";
//var_dump(mysqli_query($conn,$sql));
//bool(true)
?>

