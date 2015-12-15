# Inject

### 常见web注入

* SQL 注入

* XSS 注入

* XPATH 注入

* XML 注入

* 代码注入

* 命令注入

* 模板注入 


### XPATH 注入

* 实战

    + 示例XPATH注入[1]
    
* 检测Xpath版本

使用lower-case()功能将大写字符转换成小写字符，然后跟小写字符进行对比，如果结果为空，意味着没有lower-case()函数定义，版本为1.0，否则就是2.0版本。

> /lib/book[title="Bible"and lower-case(&#039;A&#039;) = "a"]

* 工具
    
    * Xcat --python的命令行程序 \[要求python3.4+\]
    
    利用Xpath的注入漏洞在Web应用中检索XML文档，支持Xpath1.0和2.0，使用举例如下：

    > python xcat.py --true"Book Found" --arg="title=Bible" --method POST--quotecharacter=\" http://vulnhost.com:80/vuln.php

[1]: https://www.91ri.org/7147.html
