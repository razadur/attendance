<script>
function saveAccNo(empID,rowNo){
    var accNo = $('#acc'+empID+'').val();
    var f1 = $('#f1'+empID+'').val();
    var f2 = $('#f2'+empID+'').val();
    var f3 = $('#f3'+empID+'').val();

    if(accNo == ''){
        alert("Bank Account Cannot be empty.");
    }else{
        var r = confirm("Do you confirm?");
        if (r == true) {
            var dataset = 'empID='+empID+'&accNo='+accNo+'&f1='+f1+'&f2='+f2+'&f3='+f3;
            $.ajax({
                url:'<?php echo site_url('Welcome/empAccNoAdd')?>',
                data: dataset,
                type:'POST',
                success:function(data){
                    if(data == 1){
                     alert("Bank Account Added");
                     $("#"+rowNo+"").closest('tr').remove();
                     }else{
                     alert("Bank Account Not added. ");
                     }
                }
            });
        }
    }


}
function GETempUSER(deptID,resultDiv){

    $.post('<?php echo site_url('Welcome/getEmpList')?>',
        {

            deptID: deptID
        },
        function(test,status){
            //alert( test+resultDiv );
            $("#"+resultDiv).append(test);




        });



}


function printView(){
    var des = $('#des').val();
    var date = $('#date').val();

    var url = '<?php echo site_url('Welcome/printView/')?>?des='+des+'&date='+date;

    window.open(url, "Report");
}
function staffPrintView(){
    var des = $('#uuid').val();
    var mdate = $('#udate').val();


    var url = '<?php echo site_url('Welcome/staffAttandacePrintView/')?>?des='+des+'&date='+mdate;

    window.open(url, "Report");
}
</script>