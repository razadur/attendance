<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 7/28/16
 * Time: 5:09 PM
 */
$base_url = base_url();
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
           <h3>Attendance Report </h3>
     Print date: <?php echo date("Y-m-d h:m:s a");?>
       </td>
    </tr>
    </table>
<br>

            <?php
            foreach($empAttData1 as $row)
            {
            $code = $row->code;
            $des = $row->des;
            $des = explode('@',$des);
            if(!isset($des[1])){$pre = '';}else{ $pre = $des[1];}
            $userId="";
            $img_url="";
            if(isset($row->userId))
            {
                $userId=$row->userId;
                $img_url="$base_url/asset/ImageFile/$userId.dat";
            }

            ?>
    <table  style="border: none; height: 200px; width:60%; margin-bottom: 30px;" >
        <tr>
            <td>
            <?php
            if($userId=="")
            {
                echo "<img class='img-thumbnail' src='http://placehold.it/200X200' height='200px' width='200px'>";
            }
            else{
                echo "<img class='img-thumbnail' src='$img_url' height='200px' width='200px'>";
            }
            ?>
            </td>
        <td>


            <table class="font-14" style="border: none; height: 200px; width:100%">
                <tbody>
                <tr>
                    <td>
                        <strong>Name: </strong>
                    </td>
                    <td> <?php echo $row->userName;?> </td>
                </tr>
                <tr>
                    <td style="width: 150px">
                        <strong>Staff Code: </strong>
                    </td>
                    <td> <?php echo $pre.$code;
                        ?>
                        <input type="hidden" id="uuid" value="<?php echo $code?>">



                </tr>
                <tr>
                    <td>
                        <strong>Staff Designation: </strong>
                    </td>
                    <td><?php echo $des[0]?></td>
                </tr>
                <tr>
                    <td>
                        <strong>Account No: </strong>
                    </td>
                    <td> <?php echo $row->accountno;?> </td>
                </tr>
                <tr>
                    <td>
                        <strong>exField6: </strong>
                    </td>
                    <td> <?php echo $row->exField6;?> </td>
                </tr>
                </tbody>
            </table>

            </td>
       </tr>

        <?php
            }

            if(empty($empAttData1))
            {
                echo "<p style='color: red; text-align: center'>No attendance data Found</p>";
            }
            else{


            ?>

    <table  border="1px" style="width: 100%; 	border-collapse: collapse; text-align: center">
        <tbody>
        <tr bgcolor="#999999" bordercolordark="#000000">
            <th>
                Date
            </th>
            <th>
                In Time
            </th>
            <th>
                Out Time
            </th>
            <th>
                Total Duty
            </th>

        </tr>

        <?php



        foreach($empAttData as $row){

            $dueDATE= $row->dueDATE;
            $intime= dateTotime($row->inTime);
            $outtime=dateTotime($row->outTime);

            $start_time = new DateTime($row->inTime);
            $since_start = $start_time->diff(new DateTime($row->outTime));
            $dutytime="";
            if($row->dutytime!="")
            {
                $dutytime=explode(":",$row->dutytime);
                $dutytime=$dutytime[0]." hours ".$dutytime[1]." minutes";
            }
            $dutytime= $since_start->format("%H Hours %I Minutes");


            if($outtime=="")
            {
                $dutytime="N/A";
                $outtime="N/A";
            }
            echo "<tr>
                <td style='text-align: center'>
                    $dueDATE

                </td>
                <td style='text-align: center'>
                    $intime
                </td>
                <td style='text-align: center'>
                    $outtime
                </td>
                <td style='text-align: center'>
                   $dutytime
                </td>

            </tr>";

        }
        }
        function dateTotime($dateTotime)
        {$time="";
            if($dateTotime!="")
            {
                $exp=explode(" ",$dateTotime);
                $time=$exp[1]." ".$exp[2];
            }

            return $time;

        }
        ?>
        </tbody>
    </table>



<br><br>
    <table width="99%" style="width: 100%; text-align: center">
  <tr>
            <td style="text-align: left">Prepared By<br>HR Accounts</td>
            <td style="text-align: center">Checked By<br>Director</td>
            <td style="text-align: right">Approved By<br>Managing Director</td>
        </tr>
    </table>
</body>