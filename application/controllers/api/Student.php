<?php

require APPPATH.'libraries\REST_CONTROLLER.php';

class Student extends REST_Controller{

    public function __construct()
    {

        parent::__construct();
        $this->load->database();
        $this->load->model("StudentModel");
        $this->load->library(array("form_validation"));
        $this->load->helper("security");
        $this->load->library('Authorization_Token');

    
    }


    public function verify_post()
	{  
		$headers = $this->input->request_headers(); 
		$decodedToken = $this->authorization_token->validateToken($headers['Authorization']);

		$this->response($decodedToken);  
	}

    public function register_post()
	{   
		$token_data['user_id'] = 121;
		$token_data['fullname'] = 'code'; 
		$token_data['email'] = 'code@gmail.com';

		$tokenData = $this->authorization_token->generateToken($token_data);

		$final = array();
		$final['token'] = $tokenData;
		$final['status'] = 'ok';
 
		$this->response($final); 

	}







 public function index_post(){


$student =new StudentModel;

 $data=array(
  'name' =>$this->input->post('name'),
  'email' =>$this->input->post('email'),
  'mobile' =>$this->input->post('mobile'),
  'course' =>$this->input->post('course')

 );

 $result=$student->insert_student($data);
 if(count($result>0)){
  $this-> response( array(
    "status"=>"1",
    "message"=>"students inserted",
     ),REST_Controller::HTTP_OK);
 
  }
else {


  $this-> response( array(
    "status"=>"0",
    "message"=>"students not created",
     ),REST_Controller::HTTP_BAD_GATEWAY);



}


$token_data['user_id'] = 121;
		$token_data['fullname'] = 'code'; 
		$token_data['email'] = 'code@gmail.com';

		$tokenData = $this->authorization_token->generateToken($token_data);

		$final = array();
		$final['token'] = $tokenData;
		$final['status'] = 'ok';
 
		$this->response($final); 



    }
public function index_get(){

    $student=new StudentModel;


$res=$student->get_students();
if(count($res>0)){

$this-> response( array(
   "status"=>"1",
   "message"=>"students found",
   "query"=>$res,
    ),REST_Controller::HTTP_OK);


}else{

    $this-> response( array(
        "status"=>"0",
        "message"=>"students not found",

         ),REST_Controller::HTTP_NOT_FOUND);
     




}



}
public function updatestudent_put($id){

    
$student=new StudentModel;

$data=array(

    'name'=>$this->input->put('name'),
    'email'=>$this->input->put('email'),
    'mobile'=>$this->input->put('mobile'),
    'course'=>$this->input->put('name'),


);

$result=$student->update_student($id,$data);
if(count($result>0)){
 $this-> response( array(
   "status"=>"1",
   "message"=>"student updated",
    ),REST_Controller::HTTP_OK);

 }
else {


 $this-> response( array(
   "status"=>"0",
   "message"=>"students not updated",
    ),REST_Controller::HTTP_BAD_GATEWAY);



}

}




public function index_delete(){


$data = json_decode(file_get_contents("php://input"));
    $student_id = $this->security->xss_clean($data->student_id);

    if($this->StudentModel->delete_student($student_id)){
      // retruns true
      $this->response(array(
        "status" => 1,
        "message" => "Student has been deleted"
      ), REST_Controller::HTTP_OK);
    }else{
      // return false
      $this->response(array(
        "status" => 0,
        "message" => "Failed to delete student"
      ), REST_Controller::HTTP_NOT_FOUND);
    }
  }



}








?>