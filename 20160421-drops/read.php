<?php

$file=isset($_GET['file'])?$_GET['file']:'';

if(empty($file)){
exit('The file parameter is empty,Please input it');
}

if( preg_match('/.php/i',$file) && is_file($file) ){
    die("The parameter is not allow contain php!"); //
}

if( preg_match('/admin_index|\.\/|admin_xx_modify/i',$file) ){
    die('Error String!');
}

$realfile = 'aaaaaa/../'.$file; //prevent to use agreement

if(!@readfile($realfile)){
    exit('File not exists');
}


?>
