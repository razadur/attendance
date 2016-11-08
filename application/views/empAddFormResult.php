<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 8/2/16
 * Time: 9:56 AM
 */
?>
<div class="panel panel-default">
    <div class="panel-heading">Report</div>
    <div class="panel-body">
        <table class="table table-striped" id="dataTable">
            <thead>
            <tr>
                <th width="4%">SL. No.</th>
              <th width="5%">Staff Code</th>
              <th width="9%">Name of Employee</th>
              <th width="11%">Department</th>
              <th width="10%">Bank Account</th>
               <th width="10%">Join Date</th>
              <th width="17%">Designation</th>
              <th width="8%">Duty Hrs</th>
              <th width="10%">Type</th>
              <th width="16%"></th>
            </tr>
            </thead>
            <tbody>
            <?php
            $n=1;
            foreach($empData as $row){ //userId, userName, nDepartmentIdn, des, code
                $code = $row->code;
                $des = $row->des;
                $des = explode('@',$des);
                if(!isset($des[1])){$pre = '';}else{ $pre = $des[1];}
                ?>
                <tr id="<?php echo $n;?>">
                    <td><?php echo $n; ?></td>
                    <td><?php echo $pre.$code; ?></td>
                    <td><?php echo $row->userName; ?></td>
                    <td><?php echo $des[0]; ?></td>
                    <td style="width: 12%"><?php echo '<input type="text" id="acc'.$row->userId.'" value = "'.$row->accountno.'" class="form-control" >' ?></td>
                    <td style="width: 12%"><?php echo '<input type="text" id="f6'.$row->userId.'" value = "'.$row->exField6.'" class="form-control" >' ?></td>
                    <td style="width: 12%"><?php echo '<input type="text" id="f1'.$row->userId.'" value = "'.$row->exField1.'" class="form-control" >' ?></td>
                    <td style="width: 12%"><?php echo '<input type="text" id="f2'.$row->userId.'" value = "'.$row->exField2.'" class="form-control" >' ?></td>
                    <td style="width: 12%"><?php echo '<input type="text" id="f3'.$row->userId.'" value = "'.$row->exField3.'" class="form-control" >' ?></td>
                    <td><input type="button" id="save" class="btn btn-group-sm" value="Save" onclick="saveAccNo(<?php echo $row->userId ?>,<?php echo $n;?>)"></td>
                </tr>
                <?php
                $n++;
            }
            ?>
            </tbody>
        </table>
    </div>
</div>