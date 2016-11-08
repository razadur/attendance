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

                <?php
                $n=1;
                $m=0;
                $department="";
                $runFirst=true;
               // print_r($empAttData_count);
                $dept_count="1";
                foreach($empAttData as $row){
                    //userId, userName, nDepartmentIdn, des, cod, inTime, outTime
                  // echo $m;
                    $m++;
                    $code = $row->cod;
                     $des = $row->des;

                    $des = explode('@',$des);
                    if(!isset($des[1])){$pre = '';}else{ $pre = $des[1];}
//                     $k=$n;
//                    if($dept_count!=1 && $dept_count==$k && $runFirst==true)
//                    {
//                        echo"ROW ".$k." $department $des[0]";
//                        $runFirst=false;
//                    }
                    if($department!=$des[0])
                    {
//                            if($n==1)
//                            {
//                                echo "<div class='alert alert-success' role='alert' style='text-align: center'><b>Department: $des[0] </b></div>";
//                            }

                        ?>


                        <table class="table table-striped" id="dataTable">
                            <thead>
                            <tr>
                                <th>SL<br>No</th>
                                <th>Staff<br>Code</th>
                                <th>Name of The Employee</th>
                                <th>Designation</th>
                                <th>In Time</th>
                                <th>Out Time</th>
                                <th>Total Hours</th>
                            </tr>
                            </thead>
                            <tbody>
                        <?php
                       // if($dept_count=="1")
                       // {
                           // echo "<div class='alert alert-success' role='alert' style='text-align: center'><b>Department: $des[0] </b></div>";
                      //  }

                        // echo"ROW".$n;
                        //if($n>1)
                        {
                            if($des[0]=="")
                            {
                                ?>
                                <div class='alert alert-success' role='alert' style='text-align: center'><b >Unknown Department</b> </div>
                            <?php
                            }
                            else{
                                ?>
                                <div class='alert alert-success' role='alert' style='text-align: center'><b>Department:<?php echo $des[0]; ?></php> </b></div>
                            <?php
                            }

                        }
                        $n++;

                    }
                ?>
                <tr>
                    <td><?php echo $m; ?></td>
                    <td><?php echo $pre.$code; ?></td>
                    <td><?php echo $row->userName; ?></td>
                    <td><?php echo $des[0]; ?></td>
                    <td><?php echo $row->inTime; ?></td>
                    <td><?php
                        if(!empty($row->outTime) && $row->outTime != '12:00:00 AM'){
                            echo $row->outTime;
                        } ?></td>
                    <td><?php

            if(!empty($row->outTime) && $row->outTime != '12:00:00 AM'){
				$inTime = new DateTime($row->inTime);
                        	$outTime   = new DateTime($row->outTime);
                        	$diff  = $inTime->diff($outTime);
                        	echo  $diff->format("%H:%I:%S");
			}
                        ?></td>
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
                   // 34-1


                }
                ?>
        </tbody>
        </table>

    </div>
</div>