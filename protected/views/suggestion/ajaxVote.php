<?php
if ($success)
{
    $ans = array ('code' => "ok", 'msg' => "OK");
} else {
    $ans = array ('code' => "error", 'msg' => $model->errorMsg);
}
sleep(1);
echo CJSON::encode($ans);
?>
