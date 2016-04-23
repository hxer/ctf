<?php
error_reporting(E_ALL ^ E_NOTICE);
$_POST=Add_S($_POST);
$_GET=Add_S($_GET);
$_COOKIE=Add_S($_COOKIE);
$_REQUEST=Add_S($_REQUEST);

foreach($_POST AS $_key=>$_value){
    !preg_match("/^\_[A-Z]+/",$_key) && $$_key=$_POST[$_key]; //伪register globals
}

foreach($_GET AS $_key=>$_value){
    !preg_match("/^\_[A-Z]+/",$_key) && $$_key=$_GET[$_key];
}

foreach($_COOKIE AS $_key=>$_value){
    unset($$_key);    //不允许使用COOKIE创建变量
}

function Add_S($array){
    foreach($array as $key=>$value){
        if(!is_array($value)){
            $filter = "\\<.+javascript:window\\[.{1}\\\\x|<.*=(&#\\d+?;?)+?>|<.*(data|src)=data:text\\/html.*>|\\b(alert\\(|confirm\\(|expression\\(|prompt\\(|benchmark\s*?\(.*\)|sleep\s*?\(.*\)|load_file\s*?\\()|<[a-z]+?\\b[^>]*?\\bon([a-z]{4,})\s*?=|^\\+\\/v(8|9)|\\b(and|or)\\b\\s*?([\\(\\)'\"\\d]+?=[\\(\\)'\"\\d]+?|[\\(\\)'\"a-zA-Z]+?=[\\(\\)'\"a-zA-Z]+?|>|<|\s+?[\\w]+?\\s+?\\bin\\b\\s*?\(|\\blike\\b\\s+?[\"'])|\\/\\*.*\\*\\/|<\\s*script\\b|\\bEXEC\\b|UNION.+?SELECT(\(|@{1,2}\w+?\s*|\s+?.+?|.*(`|'|\").+(`|'|\")\s*)|UPDATE\s*(\(.+\)\s*|@{1,2}.+?\s*|\s+?.+?|(`|'|\").*?(`|'|\")\s*)SET|INSERT\\s+INTO.+?VALUES|(SELECT|DELETE).+?FROM\s+?|(CREATE|ALTER|DROP|TRUNCATE)\\s+(TABLE|DATABASE)|FROM\s.?|\(select|\(\sselect|\bunion\b|select\s.+?";//过滤子查询各种
            !get_magic_quotes_gpc() && $value=addslashes($value);
            $value=check_sql($value);
            webscan_StOpAttack($key,$value,$filter,"GET");
            $array[$key]=$value;
        }else{
            $array[$key]=Add_S($array[$key]);
        }

    }
return $array;
}

function webscan_St0pAttack($StrFiltKey,$StrFiltValue,$ArrFiltReq,$method) {

        if (preg_match("/".$ArrFiltReq."/i",$StrFiltValue)==1){
            exit('Hey boy,I\'m 360!');
        }

        if (preg_match("/".$ArrFiltReq."/i",$StrFiltKey)==1){
            exit('Hey boy,I\'m 360!');
        }
}

function check_sql($str) {
    $count=0;
    for ($i = 0; $i < strlen($str); $i++) {
        if($str[$i]=='\\'){
            $count++;
        }
    }
    if($count && $count % 2 == 0){
        exit('evil string');
    }
    $check= preg_match('/select|\'|\"|,|%|insert|update|delete|union|into|load_file|outfile|or|\/\*/i', $str);
    if($check) {
        exit ("The data is unable to submit,Because it contain dengerous string,Please check it and clear it.");
    }

    $newstr="";
    while($newstr!=$str){
        $newstr=$str;
        $str = str_replace("union", "", $str);
        $str = str_replace("update", "", $str);
        $str = str_replace("into", "", $str);
        $str = str_replace("exec", "", $str);
        $str = str_replace("select", "", $str);
        $str = str_replace("delete", "", $str);
        $str = str_replace("declear"," ",$str);
        $str = str_replace("insert", "", $str);
    }
    return $str;
}

function webscan_StOpAttack($StrFiltKey,$StrFiltValue,$ArrFiltReq,$method) {

    if (preg_match("/".$ArrFiltReq."/is",$StrFiltValue)==1  || strpos(strtolower(urlencode($StrFiltValue)),'%0b')){
        exit('Hey boy,I\'m 360!');
    }

    if (preg_match("/".$ArrFiltReq."/is",$StrFiltKey)==1){
        exit('Hey boy,I\'m 360!');
    }
}


function mysql_conn(){
    $conn=mysql_connect('localhost','root','sangebaimao') or die('could not connect'.mysql_error());
    mysql_query('use ctf');
    mysql_query("SET character_set_connection=utf8, character_set_results=utf8,character_set_client=utf8", $conn);
}

?>
