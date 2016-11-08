<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->model('login_model');
        $this->load->model('welcome_model');
        $this->load->library('session');
        date_default_timezone_set('Asia/Dhaka');
    }

	public function index(){
        $this->load->view('login');
	}

    public  function signin_process(){
        $username = $_POST['username'];
        $password = $_POST['password'];

        $login = $this->login_model->login($username,$password);
        if($login == 1){
            $newData = array(
                'user'  => $username,
                'logged_in' => TRUE
            );
            $this->session->set_userdata($newData);
            $this->load->view('header');
            $this->load->view('welcome');
            $this->load->view('footer');
        }else{
            $this->index();
        }
    }

    public function logout(){
        $newData = array(
            'user'  => '',
            'logged_in' => ''
        );
        $this->session->unset_userdata($newData);
        $this->session->sess_destroy();
        $this->load->view('login');
    }

    public  function empAtt(){
        $data['allData'] = $this->welcome_model->getData();

        $this->load->view('header');
        $this->load->view('empAttForm',$data);
        $this->load->view('footer');
        $this->load->view('script');
    }

    public  function empAttReport(){
        $des = $_POST['des'];
        $date = $_POST['date'];

        $data['des'] = $des;
        $data['allData'] = $this->welcome_model->getData();

        $this->load->view('header');
        $this->load->view('empAttForm',$data);
        //$data['empAttData_count'] = $this->welcome_model->getAtt_count($des);
        if(!empty($des) && !empty($date)){
            $data['empAttData'] = $this->welcome_model->getAtt($des,$date);
            $this->load->view('empAttReport',$data);
        }
        if(empty($des) && !empty($date)){
            $data['empAttData'] = $this->welcome_model->getAtt($des,$date);
            $this->load->view('empAttReport',$data);
        }


        $this->load->view('footer');
        $this->load->view('script');
    }
    public  function empRoster(){

         $staffCode = '99999';
         $date= '2016-01-25';
        $data['allData'] = $this->welcome_model->getData();
        $data['userdate'] = $this->welcome_model->getRosteruser($staffCode,$date);
        $this->load->view('header');
        $this->load->view('empAttRoster',$data);
        $this->load->view('footer');
        $this->load->view('script');
    }
    public  function empRosterDtls(){

        $staffCode = '99999';
        $date= '2016-01-25';

        $data['userdata'] = $this->welcome_model->getRosteruser($staffCode,$date);

        $this->load->view('header');
        $this->load->view('empRosterDtls',$data);
        $this->load->view('footer');

    }

    public  function empAdd(){
        $data['allData'] = $this->welcome_model->getData();
        $this->load->view('header');
        $this->load->view('empAddForm',$data);
        $this->load->view('footer');
    }

    public  function empAddForm(){
        $des = $_POST['des'];
        $data['allData'] = $this->welcome_model->getData();
        $data['empData'] = $this->welcome_model->getEmp($des);
        $this->load->view('header');
        $this->load->view('empAddForm',$data);
        $this->load->view('empAddFormResult',$data);
        $this->load->view('footer');
        $this->load->view('script');
    }

    public function empAccNoAdd(){
        $data['empID'] = $_POST['empID'];
        $data['accNo'] = $_POST['accNo'];
	$data['f6'] = $_POST['f6'];
        $data['f1'] = $_POST['f1'];
        $data['f2'] = $_POST['f2'];
        $data['f3'] = $_POST['f3'];
		$data['f4'] = $_POST['f4'];
		$data['f5'] = $_POST['f5'];
		
        echo $this->welcome_model->empAccNoAdd($data);
    }

    public function  printView(){
        $des = $_GET['des'];
        $date = $_GET['date'];
        $data['empAttData'] = $this->welcome_model->getAtt($des,$date);
        $this->load->view('empAttReportPrint',$data);
    }
    public function  staffAttandacePrintView(){
        $des = $_GET['des'];
        $date = $_GET['date'];
        $time=strtotime($date);
         $selectMonth=date("m",$time);
         $selectYear=date("Y",$time);
        $data['empAttData1'] = $this->welcome_model->getEmpDetail($des);
        $data['empAttData'] = $this->welcome_model->getEmpDetailAttandance($des,$selectMonth,$selectYear);
        $this->load->view('empAttDtlsReportPrint',$data);
    }
    public function  getEmpList(){
        $des = $_POST['deptID'];
        $allData['allData'] = $this->welcome_model->getDeptUserList($des);
        $this->load->view('empList',$allData);
    }
    public function  empDetail(){
        $data['allData'] = $this->welcome_model->getData();
        $this->load->view('header');
        $this->load->view('empDetailForm',$data);
        $this->load->view('footer');
        $this->load->view('script');
    }

    public function  empDetailView(){
        $data['allData'] = $this->welcome_model->getData();
        $staffCode = $_POST['staffCode'];
        $selectMonth = $_POST['selectMonth'];
        $selectYear = $_POST['selectYear'];
       // $staffCode = substr($staffCode, 2);

        $this->load->view('header');
        $this->load->view('empDetailForm',$data);
        if(!empty($staffCode)){
            $data['empAttData'] = $this->welcome_model->getEmpDetail($staffCode);
            $data['empAttDataAll'] = $this->welcome_model->getEmpDetailAttandance($staffCode,$selectMonth,$selectYear);
            $this->load->view('empDetailView',$data);
        }
        $this->load->view('footer');
        $this->load->view('script');

    }


}