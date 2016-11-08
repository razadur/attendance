<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 7/28/16
 * Time: 2:57 PM
 */
$base_url = base_url();
?>
</div>
    </div><!-- /main-container -->
</div><!-- /wrapper -->
<!-- Le javascript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->

<!-- Jquery -->
<script src="<?php echo $base_url;?>asset/js/jquery-1.10.2.min.js"></script>

<!-- Bootstrap -->
<script src="<?php echo $base_url;?>asset/bootstrap/js/bootstrap.min.js"></script>

<!-- Chosen -->
<script src='<?php echo $base_url;?>asset/js/chosen.jquery.min.js'></script>

<!-- Mask-input -->
<script src='<?php echo $base_url;?>asset/js/jquery.maskedinput.min.js'></script>

<!-- Datepicker -->
<script src='<?php echo $base_url;?>asset/js/bootstrap-datepicker.min.js'></script>

<!-- Timepicker -->
<script src='<?php echo $base_url;?>asset/js/bootstrap-timepicker.min.js'></script>

<!-- Slider -->
<script src='<?php echo $base_url;?>asset/js/bootstrap-slider.min.js'></script>

<!-- Tag input -->
<script src='<?php echo $base_url;?>asset/js/jquery.tagsinput.min.js'></script>

<!-- WYSIHTML5 -->
<script src='<?php echo $base_url;?>asset/js/wysihtml5-0.3.0.min.js'></script>
<script src='<?php echo $base_url;?>asset/js/uncompressed/bootstrap-wysihtml5.js'></script>

<!-- Dropzone -->
<script src='<?php echo $base_url;?>asset/js/dropzone.min.js'></script>

<!-- Modernizr -->
<script src='<?php echo $base_url;?>asset/js/modernizr.min.js'></script>

<!-- Pace -->
<script src='<?php echo $base_url;?>asset/js/pace.min.js'></script>

<!-- Popup Overlay -->
<script src='<?php echo $base_url;?>asset/js/jquery.popupoverlay.min.js'></script>

<!-- Slimscroll -->
<script src='<?php echo $base_url;?>asset/js/jquery.slimscroll.min.js'></script>

<!-- Cookie -->
<script src='<?php echo $base_url;?>asset/js/jquery.cookie.min.js'></script>

<!-- Endless -->
<script src="<?php echo $base_url;?>asset/js/endless/endless_form.js"></script>
<script src="<?php echo $base_url;?>asset/js/endless/endless.js"></script>
<!--
<script>
    $('#attForm').on('submit',function(e){
        //alert($(this).serialize());

        $.ajax({
             url:'<?php /*echo site_url('Welcome/addData')*/?>',
             data:$(this).serialize(),
             type:'POST',
             beforeSend: function() {
             //$('#branchId').html('loading....');
             },
             success:function(data){
             //$("#branchId").html(data);
                 //alert(data);
                 $("#result").html(data);
             }
        });
        e.preventDefault();
    });
</script>-->

</body>

<!-- Mirrored from minetheme.com/Endless1.5.1/form_element.html by HTTrack Website Copier/3.x [XR&CO'2013], Sun, 21 Sep 2014 20:31:24 GMT -->
</html>
