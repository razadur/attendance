<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: User
 * Date: 7/28/16
 * Time: 4:13 PM
 */

class Welcome_model extends CI_Model{
//    public function __construct(){
//        parent::__construct();
//        $this->load->helper('form');
//        $this->load->helper('url');
//    }

    function getData(){
        $query = $this->db->query("Select * from tb_user_dept");
        return $query->result();
    }

    function getAtt($des, $date){
        if(!empty($des)){
            $where = "where nDepartmentIdn = $des";
        }else{
            $where = '';
        }
        $date = DateTime::createFromFormat('d/m/Y', $date);
        $date = $date->format('Y-m-d');

        $query = $this->db->query(" SELECT userId,userName,nDepartmentIdn,des,code cod,TIME_FORMAT(STR_TO_DATE(inTime,'%Y-%m-%d %h:%i:%s %p'), '%h:%i:%s %p') inTime,TIME_FORMAT(STR_TO_DATE(outTime,'%Y-%m-%d %h:%i:%s %p'), '%h:%i:%s %p') outTime,accountno,exField6,exField1,exField2,exField3,exField4,exField5
                                            FROM (	SELECT a.nUserIdn userId, a.sUserName userName,a.nDepartmentIdn, b.sName des, a.sUserID CODE,accountno,exField6, exField1,exField2,exField3,exField4,exField5
                                                FROM tb_user a
                                                LEFT JOIN tb_user_dept b
                                                ON a.nDepartmentIdn = b.nDepartmentIdn
                                                 )a
                                    LEFT JOIN emp_att b
                                    ON a.userId= b.nUserIdn
                                    AND inTime BETWEEN '$date 00:00:00 am' AND '$date 23:59:59 pm'
                                    $where
				    order by nDepartmentIdn,userId ;
                                    ");
        return $query->result();
    }

    function getAtt_count($des){

            if($des=="" || $des==0)
            {
                $query = $this->db->query(" SELECT COUNT(*) cdept FROM `tb_user_dept`");
                return $query->result();
            }
            else
            {
                $query = $this->db->query(" SELECT 1 cdept FROM `tb_user_dept`");
                return $query->result();
            }


    }

    function  getEmp($des){
        $where = "where a.nDepartmentIdn = $des";
        $query = $this->db->query(" SELECT a.nUserIdn userId, a.sUserName userName,a.nDepartmentIdn, b.sName des, a.sUserID code, accountno,exField6,exField1,exField2,exField3,exField4,exField5
                                    FROM tb_user a
                                    LEFT JOIN tb_user_dept b
                                    ON a.nDepartmentIdn = b.nDepartmentIdn
                                    $where");
        return $query->result();
    }
    function  getRosteruser($id,$date){

        $query = $this->db->query(" SELECT b.`sUserID`,b.`nUserIdn`,b.`sUserName`,a.`rosterType`,a.`attandance`,c.`startTime`,c.`EndTime`,c.`relaxtime`,d.`RGName`,a.`rdate`,continuty FROM `emp_roster_asign` a
LEFT JOIN `tb_user` b ON a.`uid`=b.`nUserIdn`
LEFT JOIN `emp_roster_plan` c ON a.`RPID`=c.`RPID`
LEFT JOIN `emp_roster_group` D ON c.`RGID`=d.`RGID`
WHERE b.`sUserID`='$id' AND a.`rdate`='$date' AND a.`status`='1';");
        return $query->result();
    }


    function  empAccNoAdd($data){
        $d=array('accountno'=>$data['accNo'],
                    'exField1'=>$data['f1'],
                    'exField2'=>$data['f2'],
                    'exField3'=>$data['f3'],
					'exField4'=>$data['f4'],
					'exField5'=>$data['f5'],
					'exField6'=>$data['f6'],
        );
        $this->db->where('nUserIdn',$data['empID']);
        $query = $this->db->update('tb_user',$d);
        return $query;
    }

    function getEmpDetail($staffCode){

        $where = "where a.sUserID = $staffCode";
        $query = $this->db->query(" SELECT a.nUserIdn userId, a.sUserName userName,a.nDepartmentIdn, b.sName des, a.sUserID code, accountno,exField6,exField1,exField2,exField3
                                    FROM tb_user a
                                    LEFT JOIN tb_user_dept b
                                    ON a.nDepartmentIdn = b.nDepartmentIdn
                                    $where");

        $query2 = $this->db->query(" SELECT * FROM `emp_att` WHERE `nUserIdn`='$staffCode';");
        return $query->result();
    }
    function getEmpDetailAttandance($staffCode,$selectMonth,$selectYear){
          //  $sql="SELECT DATE(`inTime`) dueDATE,inTime,outTime, TIME_FORMAT(ABS(TIMEDIFF(outTime,inTime)),'%H:%i') dutytime FROM tb_user a LEFT JOIN emp_att b ON b.nUserIdn = a.nUserIdn WHERE a.sUserID = '$staffCode' AND YEAR(inTime)='$selectYear' AND MONTH(inTime)='$selectMonth' ;";
            $sql="SELECT DATE(`inTime`) dueDATE,inTime,outTime,TIMEDIFF(outTime,inTime) dutytime FROM `emp_att` a LEFT JOIN tb_user b ON b.nUserIdn = a.nUserIdn WHERE b.sUserID ='$staffCode' AND YEAR(inTime)='$selectYear' AND MONTH(inTime)='$selectMonth';";
        $query = $this->db->query($sql);
        return $query->result();
    }
    function getEmpDetailRoster($uid,$date,$time1,$time2,$nextdateYN="0"){
        $string="";
        if($nextdateYN=="1")
        {
            $stop_date = date('Y-m-d', strtotime($date . ' +1 day'));
            //$string="AND DATE(FROM_UNIXTIME(`nDateTime`)) between '$date' and '$stop_date'";
            $string="AND DATE(FROM_UNIXTIME(`nDateTime`)) = '$stop_date'";
        }
        else{
            $string="AND DATE(FROM_UNIXTIME(`nDateTime`)) = '$date'";
        }

            $sql="SELECT TIME(FROM_UNIXTIME(`nDateTime`)) INTIME FROM `tb_event_log` WHERE nEventIdn='55' AND `nUserID`='$uid'
$string AND TIME(FROM_UNIXTIME(`nDateTime`)) BETWEEN   '$time1' AND '$time2' ;";
        $query = $this->db->query($sql);
        return $query->result();
    }
    function getDeptUserList($deptID){
          //  $sql="SELECT DATE(`inTime`) dueDATE,inTime,outTime, TIME_FORMAT(ABS(TIMEDIFF(outTime,inTime)),'%H:%i') dutytime FROM tb_user a LEFT JOIN emp_att b ON b.nUserIdn = a.nUserIdn WHERE a.sUserID = '$staffCode' AND YEAR(inTime)='$selectYear' AND MONTH(inTime)='$selectMonth' ;";
            $sql="SELECT a.sUserName userName,`sUserID`,sName FROM `tb_user` a
                    LEFT JOIN `tb_user_dept` b ON a.`nDepartmentIdn`=b.`nDepartmentIdn`
                    WHERE a.`nDepartmentIdn`='$deptID'";
        $query = $this->db->query($sql);
        return $query->result();
    }
/*    function  putData(){
        $data = array(
            'sName' => 'azad',
            'sDepartment' => '11'
        );
        $this->db->insert('tb_user_dept',$data);
    }*/
}

