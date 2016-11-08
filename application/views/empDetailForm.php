<div class="panel panel-default" >
    <div class="panel-heading"><strong>Report :: Attendance</strong></div>
    <div class="panel-body">
        <div class="col-md-4"></div>
        <div class="col-md-4">
            <form  method="post" action="<?php echo site_url('Welcome/empDetailView')?>">
                <div class="form-group col-md-12">
                    <label class="control-label" for="des">Select Department</label>
                    <select id="des" name="des" id="des" class="form-control" onchange="GETempUSER(this.value,'staffCode')">
                        <option value="0">Select</option>
                        <?php
                        foreach($allData as $row){
                            $des = $row->sName;
                            $des = explode('@',$des);
                            echo '<option value="'.$row->nDepartmentIdn.'">'.$des[0].'</option>';
                        }
                        ?>
                    </select>
                    <label class="control-label">Staff Code</label>
<!--                    <input type="text" name="staffCode" id="staffCode" class="form-control" value="--><?php //if(isset($_REQUEST["staffCode"])){ echo $_REQUEST["staffCode"];}?><!--">-->
                    <select name="staffCode" id="staffCode" class="form-control">
                      <option value="">Select Staff Code</option>';
                        </select>
                    <label class="control-label">Month/Year</label>
                    <table style="width: 100%">
                        <tr>
                            <td>
                                <select name="selectMonth" id="selectMonth" class="form-control">
                                    <option value="1" >January</option>
                                    <option value="2" >February</option>
                                    <option value="3" >March</option>
                                    <option value="4" >April</option>
                                    <option value="5" >May</option>
                                    <option value="6" >June</option>
                                    <option value="7" >July</option>
                                    <option value="8" >August</option>
                                    <option value="9" >September</option>
                                    <option value="10">October</option>
                                    <option value="11">November</option>
                                    <option value="12">December</option>
                                </select>
                            </td>
                            <td>
                                <select name="selectYear" id="selectYear" class="form-control">
                                    <?php
                                    date_default_timezone_set('Asia/Dhaka');
                                    $StartYear= '2016';
                                    $currentYear= date('Y');
                                    for($i=$StartYear;$i<=$currentYear;$i++)
                                    {
                                      

                                        echo "<option value='$i' >$i</option>";
                                    }
                                    ?>

                                </select>
                            </td>
                        </tr>
                    </table>




                </div>
                <div class="col-md-12">
                    <button type="submit" class="btn btn-success btn-sm">Search</button>
                    <input type="button" id="save" class="btn btn-danger btn-sm" value="Print" onclick="staffPrintView()">
<!--                   <a href="--><?php //echo site_url('Welcome/empDetail')?><!--"> <input type="button" id="save" class="btn btn-info btn-sm" value="Reset" ></a>-->
                </div>
            </form>
        </div>
        <div class="col-md-4"></div>
    </div>
</div>