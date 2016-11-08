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
                $this->load->model('welcome_model');

               $sUserID=$userdata[0]->sUserID;
               $sUserName=$userdata[0]->sUserName;
               $rdate=$userdata[0]->rdate;
               $RGName=$userdata[0]->RGName;
                //echo  "$sUserID $sUserName $rdate $RGName<br/>";

                ?>
        <table class="table table-striped table-bordered">
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Date</th>
                <th>Group</th>
                <th style="text-align: center">Details</th>
                <th>Total</th>
            </tr>
            <?php
            echo "<tr>
                <td>$sUserID</td>
                <td>$sUserName</td>
                <td>$rdate</td>
                <td>$RGName</td>
                <td style='padding: 0px;margin: 0px; text-align: center'>
                <table class='table table-striped table-bordered'>
                <tr>
                <th>Roster Type</th>
                <th>Attendance</th>
                <th>Start Time</th>
                <th>End Time</th>
                <th>Duty Time</th>
                </tr>";
                $totalDutime=0;
                $totalDutime1=0;
                $totalDutime2=0;
                $firstTimePunchCount=true;
            $totalUserData= count($userdata);
            $i=0;

            foreach($userdata as $rows)
            {
                $LateIn=0;//ok
                $LateOut=0;//ok
                $i++;
                $rosterType=$rows->rosterType;
                $attandance=$rows->attandance;
                $startTime=$rows->startTime;
                $EndTime=$rows->EndTime;
                $relaxtime=$rows->relaxtime;
                $continuty=$rows->continuty;

                $rosterTypeDtls="";
                $attandanceeDtls="";

                $r_startTime=$rows->startTime;
                $r_EndTime=$rows->EndTime;
                ///////////////////////start///////////////////////////////////
                ////////////////////////////////////////////////////////////
                $startTime1 = strtotime("-15 minutes", strtotime($startTime));
                $startTime1=date('H:i:s', $startTime1);
                $startTime2 = strtotime("+15 minutes", strtotime($startTime));
                $startTime2=date('H:i:s', $startTime2);


                $data = $this->welcome_model->getEmpDetailRoster($sUserID,$rdate,$startTime1,$startTime2);
                $startCount= count($data);
                $Start_arr=array();
                foreach($data as $r)
                {
                    $Start_arr[]=$r->INTIME;
                }
                if(count($Start_arr)!=0)
                {
                    $sintime= substr(max($Start_arr),0,-3);
                }
                else{
                    $sintime="";
                }


                $startTime=$sintime;
                ////////////////////////////////////////////////////////////
                //////////////////////////End///////////////////////////////
               $EndTime1 = strtotime("-15 minutes", strtotime($EndTime));
               $EndTime1=date('H:i:s', $EndTime1);
               $EndTime2 = strtotime("+15 minutes", strtotime($EndTime));
               $EndTime2=date('H:i:s', $EndTime2);

                $startTimeN1=str_replace(':','.',$r_startTime);
                $EndTimeN1=str_replace(':','.',$r_EndTime);

                if($EndTimeN1<$startTimeN1)//if duty date not end in same day
                {
                    $middleTime1=abs($startTimeN1-($EndTimeN1+24))/2;
                    $data = $this->welcome_model->getEmpDetailRoster($sUserID,$rdate,$EndTime1,$EndTime2,'1');
                }
                else
                {
                    $middleTime1=abs($startTimeN1-$EndTimeN1)/2;
                    $data = $this->welcome_model->getEmpDetailRoster($sUserID,$rdate,$EndTime1,$EndTime2);
                }

               $EndCount= count($data);

                ///////////////////////////////////////////////////////////////
                /////////////////////check data not in flaxible time///////////
                 if(trim($startCount)==0 || trim($EndCount)==0)// if no data found in flaxible time
                {
                    if(trim($startCount)==0)//not found in start flaxible time then try to more half of full hour
                    {
                        $startTime1 = strtotime("-15 minutes", strtotime($r_startTime));
                        $startTime1=date('H:i:s', $startTime1);
                        $middleTime1inMin=$middleTime1*60;
                        $startTime2 = strtotime("+$middleTime1inMin minutes", strtotime($r_startTime));
                        $startTime2=date('H:i:s', $startTime2);


                        $dataStart = $this->welcome_model->getEmpDetailRoster($sUserID,$rdate,$startTime1,$startTime2);
                        $startCount= count($dataStart);

                        $arr=array();
                        foreach($dataStart as $r)
                        {
                            $Start_arr[]=$r->INTIME;
                        }
                        if(count($Start_arr)!=0)
                        {
                            $sintime= substr(max($Start_arr),0,-3);
                        }
                        else{
                            $sintime="";
                        }

                        $startTime=$sintime;

                        $LateIn=1;//late in
                    }
                    if(trim($EndCount)==0)//not found in end flaxible time then try to more half of full hour
                    {
                        $middleTime1inMin=$middleTime1*60;
                        $EndTime1 = strtotime("-$middleTime1inMin minutes", strtotime($r_EndTime));
                        $EndTime1=date('H:i:s', $EndTime1);

                        if($EndTimeN1<$startTimeN1)//if duty date not end in same day
                        {
                            $middleTime1=abs($startTimeN1-($EndTimeN1+24))/2;
                            $data = $this->welcome_model->getEmpDetailRoster($sUserID,$rdate,$EndTime1,$EndTime2,'1');

                        }
                        else
                        {
                            $middleTime1=abs($startTimeN1-$EndTimeN1)/2;
                            $data = $this->welcome_model->getEmpDetailRoster($sUserID,$rdate,$EndTime1,$EndTime2);

                        }
                        $LateOut=1;//early out

                    }
                }
                ///////////////////////////////////////////////////////////////
                ///////////////////////////////////////////////////////////////
                $arr=array();
               foreach($data as $r)
               {
                    $arr[]=$r->INTIME;
                }

                if(count($arr)!=0)
                {
                    $eintime= substr(min($arr),0,-3);
                }
                else{
                    $eintime="";
                }

                $EndTime=$eintime;
               ///////////////////////////////////////////////////////////////////////////////////////////////
                $coutinus=0;
                if($firstTimePunchCount==true)// first time punch
                {
                    $nextabsent=false;
                    $firstTimePunchCount=false;

                    if($startCount>=1)
                    {
                        $coutinus=1;
                    }
                    else{
                        $coutinus=0;
                    }

                    if($EndCount>1)
                    {
                        $coutinus=1;
                    }
                    else{
                        if($EndCount=="1")
                        {
                            $LateOut=0;
                        }
                        else{
                            $LateOut=1;
                        }
                        //recheck
                        $middleTime1inMin=$middleTime1*60;
                        $EndTime1 = strtotime("-$middleTime1inMin minutes", strtotime($r_EndTime));
                        $EndTime1=date('H:i:s', $EndTime1);

                        $EndTime2 = strtotime("+$middleTime1inMin minutes", strtotime($r_EndTime));
                        $EndTime2=date('H:i:s', $EndTime2);

                        if($EndTimeN1<$startTimeN1)//if duty date not end in same day
                        {
                            $data = $this->welcome_model->getEmpDetailRoster($sUserID,$rdate,$EndTime1,$EndTime2,'1');
                        }
                        else
                        {
                            $data = $this->welcome_model->getEmpDetailRoster($sUserID,$rdate,$EndTime1,$EndTime2);
                        }
                        $arr=array();
                        foreach($data as $r)
                        {
                            $arr[]=$r->INTIME;
                        }

                        if(count($arr)!=0)
                        {
                            $eintime= substr(min($arr),0,-3);
                        }
                        else{
                            $eintime="";
                        }

                        $EndTime=$eintime;

                        $EndCount=count($data);

                        if($continuty=="1")//continuous
                        {
                            if($EndCount>1)
                            {
                                $coutinus=1;
                            }
                            else
                            {
                                $coutinus=0;
                            }
                        }
                        else{//not countinuous
                            if($EndCount>=1)
                            {
                                $coutinus=1;
                            }
                            else
                            {
                                $coutinus=0;
                            }
                        }


                    }

                }
                else{

                    if($startCount>1)
                    {
                        $coutinus=1;
                    }
                    else
                    {
                        //recheck
                        $middleTime1inMin=$middleTime1*60;
                        $startTime1 = strtotime("-$middleTime1inMin minutes", strtotime($r_startTime));
                        $startTime1=date('H:i:s', $startTime1);

                        $startTime2 = strtotime("+$middleTime1inMin minutes", strtotime($r_startTime));
                        $startTime2=date('H:i:s', $startTime2);
                        $dataStart = $this->welcome_model->getEmpDetailRoster($sUserID,$rdate,$startTime1,$startTime2);
                        $startCount= count($dataStart);
                        $arr=array();
                        foreach($dataStart as $r)
                        {
                            $Start_arr[]=$r->INTIME;
                        }
                        if(count($Start_arr)!=0)
                        {
                            $sintime= substr(max($Start_arr),0,-3);
                        }
                        else{
                            $sintime="";
                        }

                        $startTime=$sintime;
                        if($startCount>1)
                        {
                            $coutinus=1;
                        }
                        else{
                            $coutinus=0;
                        }
                        $LateIn=1;
                    }


                    if($totalUserData==$i)
                    {

                        if($EndCount>=1)
                        {
                            $coutinus=1;

                        }
                        else{


                            $coutinus=0;
                        }

                    }
                    else
                    {

                        if($EndCount>1)
                        {
                            $coutinus=1;
                        }
                        else{
                            //recheck
                            if($EndTimeN1<$startTimeN1)//if duty date not end in same day
                            {
                                $data = $this->welcome_model->getEmpDetailRoster($sUserID,$rdate,$EndTime1,$EndTime2,'1');
                            }
                            else
                            {
                                $data = $this->welcome_model->getEmpDetailRoster($sUserID,$rdate,$EndTime1,$EndTime2);
                            }
                           $EndCount=count($data);

                            if($EndCount>1)
                            {
                                $coutinus=1;
                            }
                            else{
                                $coutinus=0;
                            }

                        }
                    }

                }

                ///////////////////////////////////////////////////////////////////////
                ///////////////////............Main calculation..............///////////
                ///////////////////////////////////////////////////////////////////////
                $startTimeN=str_replace(':','.',$startTime);
                $EndTimeN=str_replace(':','.',$EndTime);
                //$startTimeN=$startTimeN+0.15;
                $sFraction=$startTimeN - floor($startTimeN);
                if($sFraction!=0)
                {
                    $startTimeN=floor($startTimeN)+(($sFraction/60)*100);
                }
                $eFraction=$EndTimeN - floor($EndTimeN);
                if($eFraction!=0)
                {
                    $EndTimeN=floor($EndTimeN)+(($eFraction/60)*100);
                }

                if($EndTimeN<$startTimeN)
                {
                    $dutyTime=$EndTimeN+24-$startTimeN;
                }
                else{
                    $dutyTime=$EndTimeN-$startTimeN;
                }
                $dFraction=$dutyTime - floor($dutyTime);
                if($dFraction!=0)
                {
                    $dutyTime=floor($dutyTime)+(($dFraction/100)*60);
                }
                $dutyTime=sprintf('%0.2f', $dutyTime);
                $totalDutime1=$totalDutime1+floor($dutyTime);
                $totalDutime2=$totalDutime2+($dFraction/100)*60;
                ///////////////////////////////////////////////////////////////////////
                /////////////............Main calculation End..............///////////
                ///////////////////////////////////////////////////////////////////////

                if($nextabsent==true)
                {

                    $attandance=0;
                    $nextabsent=false;
                }
                if($coutinus==0)
                {
                    $nextabsent=true;
                }


                if($rosterType=="1")
                {
                    $rosterTypeDtls="Normal";
                }
                else if($rosterType=="2")
                {
                    $rosterTypeDtls="OverTime";
                }


                if($sintime=="" || $eintime=="")
                {
                    $attandance=0;
                }

                if($attandance==0)
                {

                    $totalDutime1=$totalDutime1-floor($dutyTime);
                    $totalDutime2=$totalDutime2-($dFraction/100)*60;
                    $startTime="";
                    $EndTime="";
                    $dutyTime=0.00;

                }
                $dutyTime=str_replace('.',':',$dutyTime);
                if($LateIn==0 && $LateOut==0)
                {
                    if($attandance=="1")
                    {
                        $attandanceeDtls="Present";
                    }
                    else if($attandance=="0")
                    {
                        $attandanceeDtls="Absent";
                    }
                }
                else{
                    if($attandance=="1")
                    {
                        $attandanceeDtls="Present";
                    }
                    else if($attandance=="0")
                    {
                        $attandanceeDtls="Absent";
                    }
                    if($LateIn==1 && $attandance=="1")
                    {
                        $attandanceeDtls=$attandanceeDtls.",Late In";
                    }
                    if($LateOut==1 && $attandance=="1")
                    {
                        $attandanceeDtls=$attandanceeDtls.",Early Out";
                    }

                }



                echo "<tr>
                <td>$rosterTypeDtls</td>
                <td>$attandanceeDtls</td>
                <td>$startTime</td>
                <td>$EndTime</td>
                <td>$dutyTime</td>
                </tr>";
                //echo "</t> $rosterType $attandance $startTime $EndTime $relaxtime<br/> ";
            }
             $totalDutime2=trim($totalDutime2);
            if($totalDutime2>=0.6)
            {

                $dtotalDutime=floor($totalDutime2/.6);
               $dtotalDutime2=$totalDutime2-($dtotalDutime*.6);

                $totalDutime=$totalDutime1+$dtotalDutime+$dtotalDutime2;
            }
            else{

                $totalDutime=$totalDutime1+$totalDutime2;

            }

            $totalDutime=sprintf('%0.2f', $totalDutime);
            $totalDutime=str_replace('.',':',$totalDutime);
                echo"
                    </table>
                    </td>
                <td> $totalDutime</td>
            </tr>";
            ?>
       </table>


    </div>
</div>