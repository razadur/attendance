<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 8/1/16
 * Time: 4:36 PM
 */
?>
<div class="panel panel-default" >
    <div class="panel-heading"><strong>Form :: Employee  Informaiton</strong></div>
    <div class="panel-body">
        <div class="col-md-4"></div>
        <div class="col-md-4">
            <form id="attForm" method="post" action="<?php echo site_url('Welcome/empAddForm')?>">
                <div class="form-group">
                    <label class="control-label" for="des">Select Department</label>
                    <select id="des" name="des" class="form-control">
                        <option value="0">Select </option>
                        <?php
                        foreach($allData as $row){
                            $des = $row->sName;
                            $des = explode('@',$des);
                            echo '<option value="'.$row->nDepartmentIdn.'">'.$des[0].'</option>';
                        }
                        ?>
                    </select>
                </div><!-- /form-group -->
                <div class="col-md-12">
                    <button type="submit" class="btn btn-success btn-sm">Search</button>
                </div>
            </form>
        </div>
        <div class="col-md-4"></div>
    </div>
</div>