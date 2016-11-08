<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 8/2/16
 * Time: 1:29 PM
 */

class login_model extends CI_Model{
    function login($user, $pass){
        if($user=="admin" && $pass == "admin123"){
            return 1;
        }
    }
}