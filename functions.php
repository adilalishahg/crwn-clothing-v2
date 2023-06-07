<?php
function writeLog($message){
    $date = date('Y-m-d H:i:s');
    file_put_contents("logs/signup_error.log",$date.','.$message."\n",FILE_APPEND);
}
