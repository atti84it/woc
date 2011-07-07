<?php
if ($isGuest)
{
    $ans = array('code' => "isguest");
} elseif ($success) { // Vote was saved
    $ans = array ('code' => "ok", 'msg' => "OK");
} else {
    $ans = array ('code' => "error", 'msg' => $model->errorMsg);
}
echo CJSON::encode($ans);
?>
