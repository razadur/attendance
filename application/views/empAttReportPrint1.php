<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 7/28/16
 * Time: 5:09 PM
 */
?>
<html>
<head>
    <title>Report</title>
    <style></style>
</head>
<body style="padding: 0 5%; align-content: center">
    <table style="width: 100%; text-align: center">
    <tr>
       <td>
           <h1> ANWAR KHAN MODERN HOSPITAL LIMITED</h1>
           <h3>Report Title</h3>
           Print date: <?php echo date("Y-m-d h:m:s a");?>
       </td>
    </tr>
    </table>
    <br>
    <table style="width: 100%; 	border-collapse: collapse; text-align: center" border="1">
        <thead>
            <tr>
                <th width="5%">SL<br>
              No</th>
              <th width="8%">Staff<br>
              Code</th>
              <th width="21%">Name of  Employee</th>
              <th width="22%">Designation</th>
              <th width="22%">Account No.</th>
              <th width="12%">In Time</th>
              <th width="14%">Out Time</th>
              <th width="18%">Total Hours</th>
          </tr>
        </thead>
        <tbody>
            <?php
            $n=1;
            foreach($empAttData as $row){
                //userId, userName, nDepartmentIdn, des, code, inTime, outTime, exField1,exField2,exField3
                $code = $row->code;
                $des = $row->des;
                $des = explode('@',$des);
                if(!isset($des[1])){$pre = '';}else{ $pre = $des[1];}
            ?>
            <tr>
                <td><?php echo $n; ?></td>
                <td><?php echo $pre.$code; ?></td>
                <td><?php echo $row->userName; ?></td>
                <td><?php echo $row->exField1; ?></td>
                <td><?php echo $row->exField2; ?></td>
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
    <br><br>
    <table style="width: 100%; text-align: center">
        <tr>
            <td style="text-align: left">Prepared By<br>HR Accounts</td>
            <td style="text-align: center">Checked By<br>Director</td>
            <td style="text-align: right">Approved By<br>Managing Director</td>
        </tr>
    </table>
</body>