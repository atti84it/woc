<?php
if ($success)
{
    $ans = array ('msg' => "OK");
} else {
    $ans = array ('msg' => $model->errorMsg);
}
sleep(1);
echo CJSON::encode($ans);
?>
