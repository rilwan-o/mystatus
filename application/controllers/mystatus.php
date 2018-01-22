<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mystatus extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */

    public function index()
    {
        $this->login();
    }

    public function login(){
            $data['alert_message']=  '' ;
            $this->load->view('accesslayout1');
            $this->load->view('login', $data);
            $this->load->view('accesslayout2');
    }

    public function login_validation(){
        //form validation
        $this->load->library('form_validation');
        $this->form_validation->set_rules('number','Number','required|trim|numeric|min_length[11]|max_length[15]|callback_validate_credentials');
        $this->form_validation->set_rules('password','Password','required|md5|trim');

        //if login successful, goto contacts and save login details in session
        if($this->form_validation->run()){
            $this->load->model('Get_db');
            $data=array(
                'user_id' =>$this->Get_db->user_id($this->input->post('number')),
                'is_logged_in' =>1
            );
            $this->session->set_userdata($data);
            redirect('mystatus/home');
        }
        else{
            $data['alert_message']=  '<div class="alert alert-danger">
                                        <button type="button" class="close" data-dismiss="alert">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                        <div>'.validation_errors().'</div>
                                      </div>' ;
            $this->load->view('accesslayout1');
            $this->load->view('login', $data);
            $this->load->view('accesslayout2');
        }
        //session security  check for anonymous user

    }

    public function validate_credentials(){

        $this->load->model('Get_db');
        if($this->Get_db->can_login()){
            return true;
        }
        else{
            $this->form_validation->set_message('validate_credentials', 'incorrect number/password');
            return false;
        }
    }

    function alpha_dash_space($fullname){
        if (! preg_match('/^[a-zA-Z\s]+$/', $fullname)) {
            $this->form_validation->set_message('alpha_dash_space', 'The %s field may only contain alphabet characters & White spaces');
            return FALSE;
        } else {
            return TRUE;
        }
    }

    public function signUpValidation(){

        $this->load->library('form_validation');
        $this->form_validation->set_rules('name', 'Names', 'required|trim|callback_alpha_dash_space');
        $this->form_validation->set_rules('number', 'Number', 'required|trim|min_length[11]|max_length[15]|numeric|is_unique[users.number]');
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'required|trim');
        $this->form_validation->set_rules('cpassword', 'Confirm Password', 'required|trim|matches[password]');

        $this->form_validation->set_message('is_unique', 'That number already exists');
        if ($this->form_validation->run()) {
            $key = md5(uniqid());


           // $config['useragent']    = 'CodeIgniter';
            $config['protocol']     = 'smtp';
            $config['smtp_host']    = 'ssl://lake.hollatags.com';
            $config['smtp_user']    = 'rilwan@hollatags.com'; // Your gmail id
            $config['smtp_pass']    = 'OSD?XAjoy/X'; // Your gmail Password
            $config['smtp_port']    = 465;
            $config['wordwrap']     = TRUE;
            $config['wrapchars']    = 76;
            $config['mailtype']     = 'html';
            $config['charset']      = 'iso-8859-1';
            $config['validate']     = FALSE;
            $config['priority']     = 3;
            $config['newline']      = "\r\n";
            $config['crlf']         = "\r\n";
            //, array('mailtype', 'html')
            $this->load->library('email');
            $this->email->initialize($config);

            $this->email->from('admin@email.com', 'Admin');
            $this->email->to($this->input->post('email'));
            $this->email->subject("Confirm your account");
            $message = "<p> Please click the following link to confirm your Mystatus user account. </p>";
            $message .= "<p> <a href=" . base_url() . "mystatus/register_user/$key>". $key." </a> </p>";
            $this->email->message($message);

            $this->load->model('Get_db');

            if ($this->Get_db->add_temp_user($key)) {
                    if ($this->email->send()) {
                        $data['alert_message']=  '<div class="alert alert-success">
                                        <button type="button" class="close" data-dismiss="alert">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                        <div>An email has been sent to your email address. Please log in to your email to confirm your new mystatus account</div>
                                      </div>' ;
                       // "An email has been sent to your email address. Please log in to your email to confirm your new mystatus account.";
                        $this->load->view('accesslayout1');
                        $this->load->view('register', $data);
                        $this->load->view('accesslayout2');

                    } else {
                        echo "Could not send email.";
                    }
                }
            else {
                echo "problem adding to database.";
                 }

        }else{
           // redirect('mystatus/register');
            $data['alert_message']=  '<div class="alert alert-danger">
                                        <button type="button" class="close" data-dismiss="alert">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                        <div>'.validation_errors().'</div>
                                      </div>' ;
            $this->load->view('accesslayout1');
            $this->load->view('register', $data);
            $this->load->view('accesslayout2');
        }


    }
        public function register_user($key){

            $this->load->model('Get_db');
            if($this->Get_db->is_key_valid($key)){
                if($number=($this->Get_db->add_user($key))){
                        $data=array(
                            'user_id' =>$this->Get_db->user_id($number),
                            'is_logged_in' =>1
                        );

                    $this->session->set_userdata($data);
                    redirect('mystatus/home');
                }
                else{
                    echo "failed to add user, please try again.";
                }
            }else{
                echo "invalid key";
            }

        }

        public function reset_password($key){
            $this->load->model('Get_db');
            if($this->Get_db->email_id_exist($key)){

                $data=array(

                    'is_logged_in' =>1
                );
                $this->session->set_userdata($data);

                redirect('mystatus/password_reset');
            }else{
                echo "email does not exist in the database";
            }

        }

        public function reset_link(){
            //form validation

            $this->load->library('form_validation');
            $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|callback_validate_email');
            if($this->form_validation->run()){

                // $config['useragent']    = 'CodeIgniter';
                $config['protocol']     = 'smtp';
                $config['smtp_host']    = 'ssl://lake.hollatags.com';
                $config['smtp_user']    = 'rilwan@hollatags.com'; // Your gmail id
                $config['smtp_pass']    = 'OSD?XAjoy/X'; // Your gmail Password
                $config['smtp_port']    = 465;
                $config['wordwrap']     = TRUE;
                $config['wrapchars']    = 76;
                $config['mailtype']     = 'html';
                $config['charset']      = 'iso-8859-1';
                $config['validate']     = FALSE;
                $config['priority']     = 3;
                $config['newline']      = "\r\n";
                $config['crlf']         = "\r\n";
                //, array('mailtype', 'html')
                $this->load->library('email');
                $this->email->initialize($config);

                $this->email->from('admin@email.com', 'Admin');
                $this->email->to($this->input->post('email'));
                $this->email->subject("Reset Mystatus password");
                $message = "<p> Please click the following link to confirm your Mystatus user account. </p>";
                $this->load->model('Get_db');
                $user_id=$this->Get_db->get_email_id($this->input->post('email'));
                $this->session->set_userdata('user_id',$user_id);
                $key=md5($user_id);
                $message .= "<p> <a href=" . base_url() . "mystatus/reset_password/$user_id>".$key." </a> </p>";
                $this->email->message($message);
                if ($this->email->send()) {

                   // echo "An email has been sent to your email address. Please log in to your email and follow the instructions.";
                    $data['alert_message']=  '<div class="alert alert-success">
                                        <button type="button" class="close" data-dismiss="alert">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                        <div>An email has been sent to your email address. Please log in to your email and follow the instructions</div>
                                      </div>' ;
                    $this->load->view('accesslayout1');
                    $this->load->view('reset_link_email', $data);
                    $this->load->view('accesslayout2');

                } else {
                    echo "Could not send email.";
                }


            }else{
                $data['alert_message']=  '<div class="alert alert-danger">
                                        <button type="button" class="close" data-dismiss="alert">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                        <div>'.validation_errors().'</div>
                                      </div>' ;
                $this->load->view('accesslayout1');
                $this->load->view('reset_link_email', $data);
                $this->load->view('accesslayout2');
            }
        }

    public function validate_email(){

        $this->load->model('Get_db');
        if($this->Get_db->email_exists()){
            return true;
        }
        else{
            $this->form_validation->set_message('validate_email', 'incorrect email');
            return false;
        }
    }
    public function change_password(){
        if($this->session->userdata('is_logged_in')) {
            $user_id=$this->session->userdata('user_id');
            $this->load->model('Get_db');
            $data=array(
                'number'=>$this->Get_db->get_user_details($user_id)->number,
                'p_name'=>$this->Get_db->get_user_details($user_id)->name,
                'alert_message'=>''
            );
            $this->load->view('applayout1',$data);
            $this->load->view('change_password',$data);
            $this->load->view('applayout2');
        }else{
            redirect('mystatus/login');
        }
    }

    public function set_password_after_login(){
        if($this->session->userdata('is_logged_in')) {
            $this->load->library('form_validation');
            $this->form_validation->set_rules('password', 'Password', 'required|trim');
            $this->form_validation->set_rules('cpassword', 'Confirm Password', 'required|trim|matches[password]');

            if ($this->form_validation->run()) {

                $this->load->model('Get_db');
                $user_id=$this->session->userdata('user_id');
                $this->Get_db->reset_user_password($user_id);
                $data=array(
                    'number'=>$this->Get_db->get_user_details($user_id)->number,
                    'p_name'=>$this->Get_db->get_user_details($user_id)->name,
                    'alert_message'=>'<div class="alert alert-success">
                                        <button type="button" class="close" data-dismiss="alert">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                        <div>A new password has been set successfully</div>
                                      </div>'
                );
                $this->load->view('applayout1',$data);
                $this->load->view('change_password', $data);
                $this->load->view('applayout2');
            }else{
                $data['alert_message']=  '<div class="alert alert-danger">
                                        <button type="button" class="close" data-dismiss="alert">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                        <div>'.validation_errors().'</div>
                                      </div>' ;
                $this->load->view('applayout1');
                $this->load->view('change_password', $data);
                $this->load->view('applayout2');
            }
        }else{
            redirect('mystatus/login');
        }
    }

    public function set_password(){
        if($this->session->userdata('is_logged_in')) {
            $this->load->library('form_validation');
            $this->form_validation->set_rules('password', 'Password', 'required|trim');
            $this->form_validation->set_rules('cpassword', 'Confirm Password', 'required|trim|matches[password]');

            if ($this->form_validation->run()) {
             $this->load->model('Get_db');
                $this->Get_db->reset_user_password($this->session->userdata('user_id'));
                redirect('mystatus/home');
            }else{
                $data['alert_message']=  '<div class="alert alert-danger">
                                        <button type="button" class="close" data-dismiss="alert">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                        <div>'.validation_errors().'</div>
                                      </div>' ;
                $this->load->view('accesslayout1');
                $this->load->view('reset_password',$data);
                $this->load->view('accesslayout2');
            }
        }else{
            redirect('mystatus/login');
        }
    }



    public function logout(){
        $this->session->sess_destroy();
        redirect('mystatus/login');
    }
    ////////////////////////////////////////////////////////////////////////
    public function register(){
        $data['alert_message']='';
        $this->load->view('accesslayout1');
        $this->load->view('register', $data);
        $this->load->view('accesslayout2');
    }

    public function password_reset(){
        if($this->session->userdata('is_logged_in')) {
            $data['alert_message'] = '';
            $this->load->view('accesslayout1');
            $this->load->view('reset_password', $data);
            $this->load->view('accesslayout2');
        }else{
            redirect('mystatus/login');
        }
    }

    public function reset_link_email(){
        $data['alert_message']='';
        $this->load->view('accesslayout1');
        $this->load->view('reset_link_email', $data);
        $this->load->view('accesslayout2');
    }
////////////////////////////////////////////////////////////////////////////
    public function home(){
        if($this->session->userdata('is_logged_in')) {

            $user_id=$this->session->userdata('user_id');
            $this->load->model('Get_db');
            $data=array(
                'number'=>$this->Get_db->get_user_details($user_id)->number,
                'p_name'=>$this->Get_db->get_user_details($user_id)->name,
                'content'=>$this->Get_db->get_general_content($user_id)
            );
            $data['alert_message']='';
            $this->load->view('applayout1',$data);
            $this->load->view('home',$data);
            $this->load->view('applayout2');
        }else{
            redirect('mystatus/login');
        }
    }

    public function set_general_contents(){
        if($this->session->userdata('is_logged_in')) {

            $this->load->library('form_validation');
            $this->form_validation->set_rules('content', 'content', 'required|trim');

            if ($this->form_validation->run()) {
                $user_id=$this->session->userdata('user_id');
                $content=$this->input->post('content');
                $this->load->model('Get_db');
                $this->Get_db->set_general_content($user_id, $content);

                $data=array(
                    'alert_message'=>'<div class="alert alert-success">
                                        <button type="button" class="close" data-dismiss="alert">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                        <div>New status updated</div>
                                      </div>' ,
                    'number'=>$this->Get_db->get_user_details($user_id)->number,
                    'p_name'=>$this->Get_db->get_user_details($user_id)->name,
                    'content'=>$this->Get_db->get_general_content($user_id)
                );
                $this->load->view('applayout1', $data);
                $this->load->view('home',$data);
                $this->load->view('applayout2');
            }
            else{
                $this->load->model('Get_db');
                $user_id=$this->session->userdata('user_id');
                $data=array(
                    'alert_message'=>'<div class="alert alert-danger">
                                        <button type="button" class="close" data-dismiss="alert">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                        <div>'.validation_errors().'</div>
                                      </div>',
                    'number'=>$this->Get_db->get_user_details($user_id)->number,
                    'p_name'=>$this->Get_db->get_user_details($user_id)->name,
                    'content'=>$this->Get_db->get_general_content($user_id)
                );
                $this->load->view('applayout1',$data);
                $this->load->view('home',$data);
                $this->load->view('applayout2');
            }
        }else{
            redirect('mystatus/login');
        }
    }
    public function edit_delete_general_content()
    {
            if ($this->session->userdata('is_logged_in')) {

                $this->load->library('form_validation');
                $this->form_validation->set_rules('c_id', 'c_id', 'required|trim');
                if ($this->form_validation->run()) {
                    $user_id = $this->session->userdata('user_id');
                    $content_id = $this->input->post('c_id');
                    if($this->input->post('edit')=='edit') {
                        $this->load->model('Get_db');
                        $edit_content = $this->Get_db->get_general_edit_content($user_id, $content_id);

                        $data = array(
                            'alert_message'=>'',
                            'number' => $this->Get_db->get_user_details($user_id)->number,
                            'p_name'=>$this->Get_db->get_user_details($user_id)->name,
                            'content' => $edit_content
                        );
                        $this->load->view('applayout1',$data);
                        $this->load->view('edit_general_content', $data);
                        $this->load->view('applayout2');
                    }
                    if($this->input->post('edit')=='del'){
                        $this->load->model('Get_db');
                        $user_id = $this->session->userdata('user_id');
                        $this->Get_db->del_general_content($user_id, $content_id);
                        $data = array(
                            'alert_message'=>'<div class="alert alert-success">
                                        <button type="button" class="close" data-dismiss="alert">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                        <div>record successfully deleted ! </div>
                                      </div>',
                            'number' => $this->Get_db->get_user_details($user_id)->number,
                            'p_name'=>$this->Get_db->get_user_details($user_id)->name,
                            'content' => $this->Get_db->get_general_content($user_id)
                        );
                        $this->load->view('applayout1', $data);
                        $this->load->view('home', $data);
                        $this->load->view('applayout2');
                    }

                }
                else {
                    $this->load->model('Get_db');
                    $user_id = $this->session->userdata('user_id');
                    $data = array(
                        'alert_message'=>'<div class="alert alert-danger">
                                        <button type="button" class="close" data-dismiss="alert">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                        <div>'.validation_errors().'</div>
                                      </div>',
                        'number' => $this->Get_db->get_user_details($user_id)->number,
                        'p_name'=>$this->Get_db->get_user_details($user_id)->name,
                        'content' => $this->Get_db->get_general_content($user_id)
                    );
                    $this->load->view('applayout1',$data);
                    $this->load->view('home', $data);
                    $this->load->view('applayout2');
                }
        }else{
                redirect('mystatus/login');
            }

    }


    public function update_general_contents(){
        if($this->session->userdata('is_logged_in') ) {
            $this->load->library('form_validation');
            $this->form_validation->set_rules('content', 'content', 'required|trim');
            $this->form_validation->set_rules('c_id', 'c_id', 'required|trim');

            if ($this->form_validation->run()) {
                $user_id=$this->session->userdata('user_id');
                $content=$this->input->post('content');
                $content_id=$this->input->post('c_id');
                $this->load->model('Get_db');
                $this->Get_db->update_general_content($user_id, $content, $content_id);

                $data=array(
                    'alert_message'=>'<div class="alert alert-success">
                                        <button type="button" class="close" data-dismiss="alert">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                        <div>Your Mystatus message has been updated</div>
                                      </div>',
                    'number'=>$this->Get_db->get_user_details($user_id)->number,
                    'p_name'=>$this->Get_db->get_user_details($user_id)->name,
                    'content'=>$this->Get_db->get_general_content($user_id)
                );
                $this->load->view('applayout1', $data);
                $this->load->view('home',$data);
                $this->load->view('applayout2');
            }
            else{
                $this->load->model('Get_db');
                $user_id=$this->session->userdata('user_id');
                $data=array(
                    'alert_message'=>'<div class="alert alert-danger">
                                        <button type="button" class="close" data-dismiss="alert">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                        <div>'.validation_errors().'</div>
                                      </div>',
                    'number'=>$this->Get_db->get_user_details($user_id)->number,
                    'p_name'=>$this->Get_db->get_user_details($user_id)->name,
                    'content'=>$this->Get_db->get_general_content($user_id)
                );
                $this->load->view('applayout1', $data);
                $this->load->view('home',$data);
                $this->load->view('applayout2');
            }
        }else{
            redirect('mystatus/login');
        }

    }


    public function contact_mgt(){
        if($this->session->userdata('is_logged_in') ) {
            $this->load->model('Get_db');
            $user_id=$this->session->userdata('user_id');
            $data=array(
                'alert_message'=>'',
                'number'=>$this->Get_db->get_user_details($user_id)->number,
                'p_name'=>$this->Get_db->get_user_details($user_id)->name,
                'groups'=>$this->Get_db->get_customized_content($user_id),
                'contact_details'=>$this->Get_db->get_contact_details($user_id)

            );
            $this->load->view('applayout1', $data);
            $this->load->view('contact_management',$data);
            $this->load->view('applayout2');
        }else{
            redirect('mystatus/login');
        }
    }

    public function create_status_group(){
        if($this->session->userdata('is_logged_in') ) {
            $this->load->library('form_validation');
            $this->form_validation->set_rules('group_name', 'Group name', 'required|trim');
            $this->form_validation->set_rules('group_content', 'Group content', 'required|trim');
            if ($this->form_validation->run()) {
                $user_id=$this->session->userdata('user_id');
                $group_name=$this->input->post('group_name');
                $group_content=$this->input->post('group_content');
                $this->load->model('Get_db');
                $this->Get_db->set_customized_content($user_id, $group_name, $group_content);

                $data=array(
                    'number'=>$this->Get_db->get_user_details($user_id)->number,
                    'p_name'=>$this->Get_db->get_user_details($user_id)->name,
                    'groups'=>$this->Get_db->get_customized_content($user_id),
                    'alert_message'=>'<div class="alert alert-success">
                                        <button type="button" class="close" data-dismiss="alert">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                        <div>A new status group has been created !</div>
                                      </div>',
                    'contact_details'=>$this->Get_db->get_contact_details($user_id)
                );
                $this->load->view('applayout1', $data);
                $this->load->view('contact_management',$data);
                $this->load->view('applayout2');
            }
            else{
                $this->load->model('Get_db');
                $user_id=$this->session->userdata('user_id');
                $data=array(
                    'number'=>$this->Get_db->get_user_details($user_id)->number,
                    'p_name'=>$this->Get_db->get_user_details($user_id)->name,
                    'groups'=>$this->Get_db->get_customized_content($user_id),
                    'alert_message'=>'<div class="alert alert-danger">
                                        <button type="button" class="close" data-dismiss="alert">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                        <div>'.validation_errors().'</div>
                                      </div>',
                    'contact_details'=>$this->Get_db->get_contact_details($user_id)
                );
                $this->load->view('applayout1', $data);
                $this->load->view('contact_management',$data);
                $this->load->view('applayout2');
            }

        }else{
            redirect('mystatus/login');
        }

    }

    public function assign_contact_to_group(){

        if($this->session->userdata('is_logged_in') ) {
            $this->load->library('form_validation');
            $this->form_validation->set_rules('contact_name', 'Contact name', 'required|trim|callback_alpha_dash_space');
            $this->form_validation->set_rules('contact_number', 'Contact number', 'required|trim|numeric|min_length[11]|max_length[15]');
            $this->form_validation->set_rules('group_name', 'Group name', 'required|trim');
            if ($this->form_validation->run()) {
                $user_id=$this->session->userdata('user_id');
                $contact_name=$this->input->post('contact_name');
                $contact_number =$this->input->post('contact_number');

                $this->load->model('Get_db');
                $customized_group= $this->input->post('group_name');

              if($this->Get_db->assign_contact_to_group($user_id,  $contact_name, $contact_number, $customized_group)){

                $data=array(
                    'number'=>$this->Get_db->get_user_details($user_id)->number,
                    'p_name'=>$this->Get_db->get_user_details($user_id)->name,
                    'groups'=>$this->Get_db->get_customized_content($user_id),
                    'alert_message'=>'<div class="alert alert-success">
                                        <button type="button" class="close" data-dismiss="alert">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                        <div>A new contact has been assigned !</div>
                                      </div>',
                    'contact_details'=>$this->Get_db->get_contact_details($user_id)

                );
                $this->load->view('applayout1',$data);
                $this->load->view('contact_management',$data);
                $this->load->view('applayout2');
            }else{
                  $this->load->model('Get_db');
                  $user_id=$this->session->userdata('user_id');
                  $data=array(
                      'number'=>$this->Get_db->get_user_details($user_id)->number,
                      'p_name'=>$this->Get_db->get_user_details($user_id)->name,
                      'groups'=>$this->Get_db->get_customized_content($user_id),
                      'alert_message'=>'<div class="alert alert-danger">
                                        <button type="button" class="close" data-dismiss="alert">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                        <div>The contact is already assigned or blacklisted .</div>
                                      </div>',
                      'contact_details'=>$this->Get_db->get_contact_details($user_id)
                  );
                  $this->load->view('applayout1',$data);
                  $this->load->view('contact_management',$data);
                  $this->load->view('applayout2');
              }
            }
            else{
                $this->load->model('Get_db');
                $user_id=$this->session->userdata('user_id');
                $data=array(
                    'number'=>$this->Get_db->get_user_details($user_id)->number,
                    'p_name'=>$this->Get_db->get_user_details($user_id)->name,
                    'groups'=>$this->Get_db->get_customized_content($user_id),
                    'alert_message'=>'<div class="alert alert-danger">
                                        <button type="button" class="close" data-dismiss="alert">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                        <div>'.validation_errors().'</div>
                                      </div>',
                    'contact_details'=>$this->Get_db->get_contact_details($user_id)
                );
                $this->load->view('applayout1',$data);
                $this->load->view('contact_management',$data);
                $this->load->view('applayout2');
            }

        }else{
            redirect('mystatus/login');
        }

    }

    public function edit_contact(){
        if($this->session->userdata('is_logged_in') ) {

            $this->load->library('form_validation');
            $this->form_validation->set_rules('c_id', 'c_id', 'required|trim');
			$this->form_validation->set_rules('contact_num', 'contact_num', 'required|trim');
            if ($this->form_validation->run()) {
                $user_id = $this->session->userdata('user_id');
                $contact_id = $this->input->post('c_id');
				$contact_number = $this->input->post('contact_num');
                if($this->input->post('edit')=='edit') {
                    $this->load->model('Get_db');
                   // $edit_content = $this->Get_db->get_general_edit_contact($user_id, $contact_id);

                    $data = array(
                        'number'=>$this->Get_db->get_user_details($user_id)->number,
                        'p_name'=>$this->Get_db->get_user_details($user_id)->name,
                        'groups'=>$this->Get_db->get_customized_content($user_id),
                        'alert_message'=>'',
                        'contact_details'=>$this->Get_db->get_contact_detail($user_id, $contact_number)
                    );
                    $this->load->view('applayout1', $data);
                    $this->load->view('edit_contact_mgt', $data);
                    $this->load->view('applayout2');
                }
                if($this->input->post('edit')=='del'){
                    $this->load->model('Get_db');
                    $user_id = $this->session->userdata('user_id');
                    $this->Get_db->del_contact($user_id, $contact_id);
                    $data = array(
                        'number'=>$this->Get_db->get_user_details($user_id)->number,
                        'p_name'=>$this->Get_db->get_user_details($user_id)->name,
                        'groups'=>$this->Get_db->get_customized_content($user_id),
                        'alert_message'=>'<div class="alert alert-danger">
                                        <button type="button" class="close" data-dismiss="alert">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                        <div>Selected contact record has been deleted !</div>
                                      </div>',
                        'contact_details'=>$this->Get_db->get_contact_details($user_id)
                    );
                    $this->load->view('applayout1', $data);
                    $this->load->view('contact_management', $data);
                    $this->load->view('applayout2');
                }

            }
            else {
                $this->load->model('Get_db');
                $user_id = $this->session->userdata('user_id');
                $data = array(
                    'number'=>$this->Get_db->get_user_details($user_id)->number,
                    'p_name'=>$this->Get_db->get_user_details($user_id)->name,
                    'groups'=>$this->Get_db->get_customized_content($user_id),
                    'alert_message'=>'<div class="alert alert-danger">
                                        <button type="button" class="close" data-dismiss="alert">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                        <div>'.validation_errors().'</div>
                                      </div>',
                    'contact_details'=>$this->Get_db->get_contact_details($user_id)
                );
                $this->load->view('applayout1', $data);
                $this->load->view('contact_management', $data);
                $this->load->view('applayout2');
            }

        }
        else{
        redirect('mystatus/login');
        }
    }

    public function update_contact(){


        if($this->session->userdata('is_logged_in') ) {
            $this->load->library('form_validation');
            $this->form_validation->set_rules('c_id', 'C_id', 'required|trim');
            $this->form_validation->set_rules('contact_name', 'Contact name', 'required|trim|callback_alpha_dash_space');
            $this->form_validation->set_rules('contact_number', 'Contact number', 'required|trim|numeric|min_length[11]|max_length[15]');
            $this->form_validation->set_rules('group_name', 'Group name', 'required|trim');
            if ($this->form_validation->run()) {
                $user_id=$this->session->userdata('user_id');
                $id=$this->input->post('c_id');
                $contact_name=$this->input->post('contact_name');
                $contact_number =$this->input->post('contact_number');

                $this->load->model('Get_db');
                $customized_group= $this->input->post('group_name');

                if($this->Get_db->re_assign_contact_to_group($id, $user_id,  $contact_name, $contact_number, $customized_group)){

                    $data=array(
                        'number'=>$this->Get_db->get_user_details($user_id)->number,
                        'p_name'=>$this->Get_db->get_user_details($user_id)->name,
                        'groups'=>$this->Get_db->get_customized_content($user_id),
                        'alert_message'=>'<div class="alert alert-success">
                                        <button type="button" class="close" data-dismiss="alert">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                        <div>Selected contact status/group has been updated !</div>
                                      </div>',
                        'contact_details'=>$this->Get_db->get_contact_details($user_id)

                    );
                    $this->load->view('applayout1', $data);
                    $this->load->view('contact_management',$data);
                    $this->load->view('applayout2');
                }else{
                    $this->load->model('Get_db');
                    $user_id=$this->session->userdata('user_id');
                    $data=array(
                        'number'=>$this->Get_db->get_user_details($user_id)->number,
                        'p_name'=>$this->Get_db->get_user_details($user_id)->name,
                        'groups'=>$this->Get_db->get_customized_content($user_id),
                        'alert_message'=>'contact was blacklisted','<div class="alert alert-danger">
                                        <button type="button" class="close" data-dismiss="alert">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                        <div>Contact was blacklisted !</div>
                                      </div>',
                        'contact_details'=>$this->Get_db->get_contact_details($user_id)
                    );
                    $this->load->view('applayout1',$data);
                    $this->load->view('contact_management',$data);
                    $this->load->view('applayout2');
                }
            }
            else{
                $this->load->model('Get_db');
                $user_id=$this->session->userdata('user_id');
                $data=array(
                    'number'=>$this->Get_db->get_user_details($user_id)->number,
                    'p_name'=>$this->Get_db->get_user_details($user_id)->name,
                    'groups'=>$this->Get_db->get_customized_content($user_id),
                    'alert_message'=>'<div class="alert alert-danger">
                                        <button type="button" class="close" data-dismiss="alert">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                        <div>'.validation_errors().'</div>
                                      </div>',
                    'contact_details'=>$this->Get_db->get_contact_details($user_id)
                );
                $this->load->view('applayout1',$data);
                $this->load->view('contact_management',$data);
                $this->load->view('applayout2');
            }

        }else{
            redirect('mystatus/login');
        }

    }

    public function black_list(){
        if($this->session->userdata('is_logged_in') ) {
            $user_id = $this->session->userdata('user_id');
            $this->load->model('Get_db');
            $data = array(
                'number' => $this->Get_db->get_user_details($user_id)->number ,
                'p_name'=>$this->Get_db->get_user_details($user_id)->name,
                'black_number' => $this->Get_db->get_black_list($user_id),
                'alert_message'=>''
            );
            $this->load->view('applayout1', $data);
            $this->load->view('blacklist', $data);
            $this->load->view('applayout2');
        }else{
            redirect('mystatus/login');
        }
    }

    public function black_list_number(){
        if($this->session->userdata('is_logged_in') ) {
            $this->load->library('form_validation');
            $this->form_validation->set_rules('contact_num', 'contact_number', 'required|trim');

            if ($this->form_validation->run()) {
                $user_id = $this->session->userdata('user_id');
                $contact_num=$this->input->post('contact_num');
                $this->load->model('Get_db');
               if($this->Get_db->add_to_black_list($user_id, $contact_num)) {

                   $data = array(
                       'number'=>$this->Get_db->get_user_details($user_id)->number,
                       'p_name'=>$this->Get_db->get_user_details($user_id)->name,
                       'black_number' => $this->Get_db->get_black_list($user_id),
                       'alert_message' => '<div class="alert alert-success">
                                        <button type="button" class="close" data-dismiss="alert">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                        <div>Number has been blacklisted !</div>
                                      </div>'
                   );
                   $this->load->view('applayout1', $data);
                   $this->load->view('blacklist', $data);
                   $this->load->view('applayout2');
               }else{
                   $data = array(
                       'number'=>$this->Get_db->get_user_details($user_id)->number,
                       'p_name'=>$this->Get_db->get_user_details($user_id)->name,
                       'black_number' => $this->Get_db->get_black_list($user_id),
                       'alert_message' => '<div class="alert alert-danger">
                                        <button type="button" class="close" data-dismiss="alert">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                        <div>Number already exists in blacklist !</div>
                                      </div>'
                   );
                   $this->load->view('applayout1',$data);
                   $this->load->view('blacklist', $data);
                   $this->load->view('applayout2');
               }
            }
            else{
                $this->load->model('Get_db');
                $user_id=$this->session->userdata('user_id');
                $data=array(
                    'number'=>$this->Get_db->get_user_details($user_id)->number,
                    'p_name'=>$this->Get_db->get_user_details($user_id)->name,
                    'black_number'=>$this->Get_db->get_black_list($user_id),
                    'alert_message'=>'<div class="alert alert-danger">
                                        <button type="button" class="close" data-dismiss="alert">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                        <div>'.validation_errors().'</div>
                                      </div>'
                );
                $this->load->view('applayout1',$data);
                $this->load->view('blacklist',$data);
                $this->load->view('applayout2');
            }
        }else{
            redirect('mystatus/login');
        }
    }

    public function del_from_blacklist(){
        if($this->session->userdata('is_logged_in') ) {
            $this->load->library('form_validation');
            $this->form_validation->set_rules('c_id', 'c_id', 'required|trim');
            if ($this->form_validation->run()) {
                $this->load->model('Get_db');
                $id=$this->input->post('c_id');
                $user_id=$this->session->userdata('user_id');
                $this->Get_db->del_from_blacklist($user_id, $id);
                $this->Get_db->get_black_list($user_id);
                $data=array(
                    'number'=>$this->Get_db->get_user_details($user_id)->number,
                    'p_name'=>$this->Get_db->get_user_details($user_id)->name,
                    'black_number'=>$this->Get_db->get_black_list($user_id),
                    'alert_message'=>'<div class="alert alert-success">
                                        <button type="button" class="close" data-dismiss="alert">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                        <div>Selected number has been removed from the blacklist ! </div>
                                      </div>'
                );
                $this->load->view('applayout1',$data);
                $this->load->view('blacklist',$data);
                $this->load->view('applayout2');
            } else{
                $this->load->model('Get_db');
                $user_id=$this->session->userdata('user_id');
                $data=array(
                    'number'=>$this->Get_db->get_user_details($user_id)->number,
                    'p_name'=>$this->Get_db->get_user_details($user_id)->name,
                    'black_number'=>$this->Get_db->get_black_list($user_id),
                    'alert_message'=>'<div class="alert alert-danger">
                                        <button type="button" class="close" data-dismiss="alert">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                        <div>'.validation_errors().'</div>
                                      </div>'
                );
                $this->load->view('applayout1',$data);
                $this->load->view('blacklist',$data);
                $this->load->view('applayout2');
            }
        }else{
            redirect('mystatus/login');
        }

        }



    public function invite_friends(){
        if($this->session->userdata('is_logged_in') ) {
        $user_id = $this->session->userdata('user_id');
        $this->load->model('Get_db');
        $data = array(
            'number'=>$this->Get_db->get_user_details($user_id)->number,
            'p_name'=>$this->Get_db->get_user_details($user_id)->name,
            'alert_message' => ''
        );
        $this->load->view('applayout1', $data);
        $this->load->view('invite_friends', $data);
        $this->load->view('applayout2');
    }else{
            redirect('mystatus/login');
        }
    }

    public function send_invitation(){
        if($this->session->userdata('is_logged_in') ) {
            $this->load->library('form_validation');
            $this->form_validation->set_rules('contact_num', 'Friend\'s Number', 'required|trim');

            if ($this->form_validation->run()) {
                $user_id = $this->session->userdata('user_id');
                $contact_num=$this->input->post('contact_num');
                $this->load->model('Get_db');
                $this->Get_db->add_to_invitation_list($user_id, $contact_num);


                $data = array(
                    'number'=>$this->Get_db->get_user_details($user_id)->number,
                    'p_name'=>$this->Get_db->get_user_details($user_id)->name,
                    'alert_message' => '<div class="alert alert-success">
                                        <button type="button" class="close" data-dismiss="alert">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                        <div>An invite has been sent to'.$contact_num.'</div>
                                      </div>'
                );
                $this->load->view('applayout1',$data);
                $this->load->view('invite_friends',$data);
                $this->load->view('applayout2');
            }
            else{
                $this->load->model('Get_db');
                $user_id=$this->session->userdata('user_id');
                $data=array(
                    'number'=>$this->Get_db->get_user_details($user_id)->number,
                    'p_name'=>$this->Get_db->get_user_details($user_id)->name,
                    'alert_message' => '<div class="alert alert-danger">
                                        <button type="button" class="close" data-dismiss="alert">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                        <div>'.validation_errors().'</div>
                                      </div>'
                );
                $this->load->view('applayout1',$data);
                $this->load->view('invite_friends',$data);
                $this->load->view('applayout2');
            }
            }
            else{
            redirect('mystatus/login');
            }
        }



    public function rules(){
        if($this->session->userdata('is_logged_in') ) {
            $user_id = $this->session->userdata('user_id');
            $this->load->model('Get_db');
            $data = array(
                'number'=>$this->Get_db->get_user_details($user_id)->number,
                'p_name'=>$this->Get_db->get_user_details($user_id)->name,
                'alert_message' => '',
                'previous_set_time'=>$this->Get_db->get_user_rules($user_id)
            );
        $this->load->view('applayout1',$data);
        $this->load->view('rules', $data);
        $this->load->view('applayout2');
        }else{
            redirect('mystatus/login');
        }
    }

    public function set_rules(){
        if($this->session->userdata('is_logged_in') ) {
            $this->load->library('form_validation');
            $this->form_validation->set_rules('day[]', 'day(s)', 'trim');
            $this->form_validation->set_rules('from', 'From Time', 'required');
            $this->form_validation->set_rules('to', 'To Time', 'required');
            $user_id = $this->session->userdata('user_id');
            if ($this->form_validation->run()) {

                $days_array = $this->input->post('day[]');
                $arr_day=array();
                if(!($days_array == NULL)) {
                    foreach ($days_array as $day) {
                        $arr_day[] = $day;
                    }
                    $days = implode(",", $arr_day);
                }
                else{
                    $days='every day';
                }
                $from = $this->input->post('from');
                $to = $this->input->post('to');
                $this->load->model('Get_db');
                $this->Get_db->add_user_rules($user_id, $days, $from, $to );
                $data = array(
                    'number'=>$this->Get_db->get_user_details($user_id)->number,
                    'p_name'=>$this->Get_db->get_user_details($user_id)->name,
                    'alert_message' => '<div class="alert alert-success">
                                        <button type="button" class="close" data-dismiss="alert">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                        <div>A new time schedule has been set !</div>
                                      </div>',
                    'previous_set_time'=>$this->Get_db->get_user_rules($user_id)
                );

                $this->load->view('applayout1',$data);
                $this->load->view('rules', $data);
                $this->load->view('applayout2');
            }
            else{
                $this->load->model('Get_db');
                $data = array(
                    'number'=>$this->Get_db->get_user_details($user_id)->number,
                    'p_name'=>$this->Get_db->get_user_details($user_id)->name,
                    'alert_message' => '<div class="alert alert-danger">
                                        <button type="button" class="close" data-dismiss="alert">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                        <div>'.validation_errors().'</div>
                                      </div>',
                    'previous_set_time'=>$this->Get_db->get_user_rules($user_id)
                );
                $this->load->view('applayout1',$data);
                $this->load->view('rules', $data);
                $this->load->view('applayout2');
            }
        }else{
            redirect('mystatus/login');
        }
    }

    public function user_profile()
    {
        if($this->session->userdata('is_logged_in') ) {
            $user_id = $this->session->userdata('user_id');
            $this->load->model('Get_db');
            $data=array(
                'number'=>$this->Get_db->get_user_details($user_id)->number,
                'p_name'=>$this->Get_db->get_user_details($user_id)->name,
                'alert_message' => '',
                'name'=>$this->Get_db->get_user_details($user_id)->name,
                'email'=>$this->Get_db->get_user_details($user_id)->email,
                'date'=>$this->Get_db->get_user_details($user_id)->updated_at
            );


            $this->load->view('applayout1',$data);
            $this->load->view('profile', $data);
            $this->load->view('applayout2');
        }else{
            redirect('mystatus/login');
        }
    }

    public function update_user_profile(){
        if($this->session->userdata('is_logged_in') ) {
            $user_id = $this->session->userdata('user_id');
            $this->load->library('form_validation');
            $this->form_validation->set_rules('name', 'Names', 'required|trim|callback_alpha_dash_space');
            $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email');

            if ($this->form_validation->run()) {

                $name=$this->input->post('name');
                $email=$this->input->post('email');
                $this->load->model('Get_db');
                $this->Get_db->update_user_profile($user_id, $name, $email);

                $data=array(
                    'number'=>$this->Get_db->get_user_details($user_id)->number,
                    'p_name'=>$this->Get_db->get_user_details($user_id)->name,
                    'alert_message'=>'<div class="alert alert-success">
                                        <button type="button" class="close" data-dismiss="alert">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                        <div>Account updated !</div>
                                      </div>',
                    'name'=>$this->Get_db->get_user_details($user_id)->name,
                    'email'=>$this->Get_db->get_user_details($user_id)->email,
                    'date'=>$this->Get_db->get_user_details($user_id)->updated_at
                );
                $this->load->view('applayout1',$data);
                $this->load->view('profile', $data);
                $this->load->view('applayout2');
            }else{
                $this->load->model('Get_db');
                $data=array(
                    'number'=>$this->Get_db->get_user_details($user_id)->number,
                    'p_name'=>$this->Get_db->get_user_details($user_id)->name,
                    'alert_message'=>'<div class="alert alert-danger">
                                        <button type="button" class="close" data-dismiss="alert">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                        <div>'.validation_errors().'</div>
                                      </div>',
                    'name'=>$this->Get_db->get_user_details($user_id)->name,
                    'email'=>$this->Get_db->get_user_details($user_id)->email,
                    'date'=>$this->Get_db->get_user_details($user_id)->updated_at
                );
                $this->load->view('applayout1',$data);
                $this->load->view('profile', $data);
                $this->load->view('applayout2');
            }
        }else{
            redirect('mystatus/login');
        }

    }

    public function unsubscribe(){
        if($this->session->userdata('is_logged_in') ) {
            $user_id = $this->session->userdata('user_id');
            $this->load->model('Get_db');
            $data=array(
                'number'=>$this->Get_db->get_user_details($user_id)->number,
                'p_name'=>$this->Get_db->get_user_details($user_id)->name,
                'alert_message'=>''
            );
        $this->load->view('applayout1',$data);
        $this->load->view('unsubscribe', $data);
        $this->load->view('applayout2');
        }else{
            redirect('mystatus/login');
        }
    }

    public function unsubscriber(){
        if($this->session->userdata('is_logged_in') ) {
            $user_id = $this->session->userdata('user_id');
            $this->load->model('Get_db');

            $this->Get_db->unsubscribe_user($user_id);

            redirect('mystatus/login');

        }else{
            redirect('mystatus/login');
        }
    }














}
