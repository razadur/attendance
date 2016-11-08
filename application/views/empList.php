<?php
foreach($allData as $row){
    $des = $row->sName;
    $sUserID = $row->sUserID;
    $userName = $row->userName;
    $des = explode('@',$des);
    //echo '<option value="'.$sUserID.'">'.$des[1].$sUserID.'</option>';
    echo "<option value='$sUserID'>$sUserID --- $userName</option>";
}
?>