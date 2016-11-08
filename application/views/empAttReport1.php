<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 7/28/16
 * Time: 5:09 PM
 */
?>
<div class="panel panel-default">
    <div class="panel-heading">Report</div>
    <div class="panel-body">
        <table class="table table-striped" id="dataTable">
            <thead>
                <tr>
                    <th width="18%">Name of The Employee</th>
              <th width="17%">Designation</th>
              <th width="15%">Department</th>
              <th width="11%">Account No.</th>
              <th width="11%">In Time</th>
              <th width="7%">Out Time</th>
              <th width="12%">Total Hours</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $n=1;
                foreach($empAttData as $row){
                    //userId, userName, nDepartmentIdn, des, code, inTime, outTime
                    $code = $row->code;
                    $des = $row->des;
                    $des = explode('@',$des);
                    if(!isset($des[1])){$pre = '';}else{ $pre = $des[1];}
                ?>
                <tr>
                    <td><?php echo $n; ?></td>
                    <td><?php echo $pre.$code; ?></td>
                    <td><?php echo $row->userName; ?></td>
                    <td><?php echo $des[0]; ?></td>
                    <td><?php echo $row->inTime; ?></td>
                    <td><?php echo $row->outTime; ?></td>
                    <td><?php 
			if(!empty($row->outTime)){
				$inTime = new DateTime($row->inTime);
                        	$outTime   = new DateTime($row->outTime);
                        	$diff  = $inTime->diff($outTime);
                        	echo  $diff->format("%H:%I:%S");
			}
                        ?></td>
                </tr>
                <?php
                    $n++;
                }
                ?>
            </tbody>
        </table>
    </div>
</div>