<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class APIRequest extends CI_Controller {

	function __Construct(){
        parent ::__construct();
        header('Access-Control-Allow-Origin: *');
        header("Access-Control-Allow-Headers: *");
        header('Access-Control-Allow-Methods: GET, POST');
        header("Access-Control-Allow-Headers: *");
        header('Content-Type: application/json');       
        $this->load->library('JWT');
        $this->load->model("General_model");
    }

	public function authentification(){
		$result = array();
		//$reqdata = json_decode( file_get_contents( 'php://input' ), true );
		$reqdata = $this->input->post();
		if($reqdata){ //ada isinya 
			//decription
			$key = "PWL123!@#$";

            $data_arr = (array) $this->jwt->decode($reqdata['token'],$key); //=> (array) => diconvert dari obj menjadi bentuk array
            //pengecekan kedalam database
            //$data_arr['username'] => call key base on array
            //$data->username; => call key base on object
            //var_dump($data_arr);
            $data_arr['password'] = md5($data_arr['password']); // converting dengan md5 untuk hashing password
            $isExist = $this->General_model->fetchData("app_session",array("Username"=>$data_arr['username'],"Password"=>$data_arr['password']))->row(); //row() => 1 data/baris, result()=> lebih dari 1 data
            if(!empty($isExist)){
            	unset($isExist->Password);
            	$currDate = date('Y-m-d H:i:s');
                $timestamp = strtotime($currDate) + 60*60; //1 jam
                $expiredTime = date('Y-m-d H:i:s', $timestamp);
            	$isExist->Expired = $expiredTime;
            	$result = array("return"=>true,"message"=>"Data ditemukan","result"=>$isExist);	
            }else{
            	$result = array("return"=>false,"message"=>"Data tidak ditemukan","result"=>null);
            }            
		}

		echo json_encode($result);
	}

	public function hasPassword(){
		echo md5("123456");
	}
}
