    <div class="panel panel-default" >
        <div class="panel-heading"><strong>Report :: Attendance</strong></div>
        <div class="panel-body">
            <div class="col-md-4"></div>
            <div class="col-md-4">
                <form id="attForm" method="post" action="<?php echo site_url('Welcome/empAttReport')?>">
                    <div class="form-group col-md-12">
                        <label class="control-label" for="des">Select Department</label>
                        <select id="des" name="des" id="des" class="form-control">
                            <option value="0">Select</option>
                            <?php
                            foreach($allData as $row){
                                $des = $row->sName;
                                $des = explode('@',$des);
                                echo '<option value="'.$row->nDepartmentIdn.'">'.$des[0].'</option>';
                            }
                            ?>
                        </select>
                    </div><!-- /form-group -->

                    <div class="form-group col-md-6">
                        <label class="control-label">Date</label>
                        <div class="input-group">
                            <input type="text" name="date" id="date" value="<?php echo date('d/m/Y')?>" class="datepicker form-control">
                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                        </div>
                    </div>
                    <div class="form-group col-md-6">
                        <label class="control-label">To Date</label>
                        <div class="input-group">
                            <input type="text" name="toDate" id="toDate" value="<?php echo date('d/m/Y')?>" class="datepicker form-control">
                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-success btn-sm">Search</button>
                        <input type="button" id="save" class="btn btn-danger btn-sm" value="Print" onclick="printView()">
                    </div>
                </form>
            </div>
            <div class="col-md-4"></div>
        </div>
    </div>