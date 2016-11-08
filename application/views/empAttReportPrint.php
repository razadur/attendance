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
    <table width="96%" style="width: 100%; text-align: center">
    <tr>
       
   <td width="84%">
      <h1 > ANWAR KHAN MODERN HOSPITAL LIMITED</h1>
           <h3>Attendance Details Report </h3>
     Print date: <?php echo date("Y-m-d h:m:s a");?>
       </td>
    </tr>
    </table>
<br>

            <?php
            $n=1;
            $department="";
            foreach($empAttData as $row){
                //userId, userName, nDepartmentIdn, des, cod, inTime, outTime, exField1,exField2,exField3
                $code = $row->cod;
                $des = $row->des;
                $des = explode('@',$des);
                if(!isset($des[1])){$pre = '';}else{ $pre = $des[1];}
            if($department!=$des[0])
            {





            ?>

    <table width="99%" height="70" border="1" style="width: 100%; 	border-collapse: collapse; text-align: center">
        <thead>
        <tr bgcolor="#999999" bordercolordark="#000000">
            <th width="2%">SL<br>
                No</th>
            <th width="4%">Staff<br>
                Code</th>
            <th width="18%">Name of Employee</th>

            <th width="11%">Designation</th>
            <th width="8%">Account No.</th>
            <th width="8%">Join Date</th>
            <th width="6%">Duty Hrs</th>
            <th width="9%">In Time</th>
            <th width="7%">Out Time</th>
            <th width="6%">Total Hours</th>
            <th width="10%">Remarks</th>
        </tr>
        </thead>
        <tbody>
            <?php
                if($des[0]=="")
                {
                    echo "<div   style='text-align: center; padding: 5px; background: lightgrey; margin: 5px; margin-top: 15px'><b >Unknown Department</b> </div>";
                }
                else{
                    echo "<div  style='text-align: center; padding: 5px; background: lightgrey; margin-bottom: 5px; margin-top: 15px''><b>Department: $des[0] </b></div>";
                }
            }
            ?>
            <tr>
                <td><?php echo $n; ?></td>
                <td><?php echo $pre.$code; ?></td>
                <td><?php echo $row->userName; ?></td>                

                <td><?php echo $row->exField1; ?></td>
                <td><?php echo $row->accountno; ?></td>
                <td><?php echo $row->exField6; ?></td>
                <td><?php echo $row->exField2; ?></td>
                <td><?php echo $row->inTime; ?></td>
                <td><?php
                    if(!empty($row->outTime) && $row->outTime != '12:00:00 AM'){
                        echo $row->outTime;
                    } ?></td>
                <td ><?php 
			if(!empty($row->outTime) && $row->outTime != '12:00:00 AM'){
                            $inTime = new DateTime($row->inTime);
                            $outTime   = new DateTime($row->outTime);
                            $diff  = $inTime->diff($outTime);
                            echo  $diff->format("%H:%I:%S");
                        }
                    ?></td>
                    <td><?php echo $row->exField3; ?></td>
            </tr>
            <?php
                $department=$des[0];
                if($department!=$des[0])
                {
                    ?>
                    </tbody>
                    </table>
                <?php
                }
                $n++;
            }
            ?>

<br><br>
    <table width="99%" style="width: 100%; text-align: center">
  <tr>
            <td style="text-align: left">Prepared By<br>HR Accounts</td>
            <td style="text-align: center">Checked By<br>Director</td>
            <td style="text-align: right">Approved By<br>Managing Director</td>
        </tr>
    </table>
</body>