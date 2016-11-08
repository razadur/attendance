<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 7/28/16
 * Time: 5:09 PM
 */
 $base_url = base_url();
?>
<div class="panel panel-default">
    <div class="panel-heading">Report</div>
    <div class="panel-body">
        <?php

            foreach($empAttData as $row){
                //userId, userName, nDepartmentIdn, des, code, inTime, outTime, accountno
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
                <div class="row">
                    <div class="col-sm-3 padding-sm">
                        <?php
                        if($userId=="")
                        {
                           echo "<img class='img-thumbnail' src='http://placehold.it/200X200' height='200px' width='200px'>";
                        }
                        else{
                            echo "<img class='img-thumbnail' src='$img_url' height='200px' width='200px'>";
                        }
                        ?>

                    </div>
                    <div class="col-xs-6 col-sm-12 col-md-6 padding-sm">
                        <table class="font-14" style="border: none; height: 200px">
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
                    </div>
                </div>
        <?php
            break;}
        if(empty($empAttDataAll))
        {
            echo "<p style='color: red; text-align: center'>No attendance data Found</p>";
        }
        else{


?>
        <table class="table">
            <tbody>
            <tr>
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
        }
        $firsttime=true;
        foreach($empAttDataAll as $row){
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
            $hiddenData="";
            if($firsttime==true)
            {
                $hiddenData="<input type='hidden' id='udate' value='$dueDATE'></td>";
                $firsttime=false;
            }
            if($outtime=="")
            {
                $dutytime="N/A";
                $outtime="N/A";
            }
            echo "<tr>
                <td>
                    $dueDATE
                    $hiddenData
                </td>
                <td>
                    $intime
                </td>
                <td>
                    $outtime
                </td>
                <td>
                   $dutytime
                </td>

            </tr>";
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
    </div>
</div>