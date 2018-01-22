<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Get_db extends CI_Model{

    public function add_temp_user($key){

    $data=array(
    'name'=>$this->input->post('name'),
    'number'=>$this->input->post('number'),
    'email'=>$this->input->post('email'),
    'password'=>md5($this->input->post('password')),
    'key'=>$key
    );
    $query=$this->db->insert('temp_users', $data);

    if($query){
        return true;
        }
    else{
        return false ;
        }

    }


    public function is_key_valid($key){
    $this->db->where('key', $key);
    $query=$this->db->get('temp_users');
    if($query->num_rows()==1){
    return true;
    }
    else{
    return false;}
    }


    public function add_user($key)
    {

        $this->db->where('key', $key);
        $temp_user = $this->db->get('temp_users');
        if ($temp_user) {

            $row = $temp_user->row();
            $data = array(
                'name' => $row->name,
                'number' =>$row->number,
                'email' => $row->email,
                'password' => $row->password,
                'created_at' =>date('Y-m-d  h:i:s')
            );

            $did_add_user = $this->db->insert('users', $data);
        }
        if ($did_add_user) {

            $this->db->where('key', $key);
            $this->db->delete('temp_users');
            return $data['number'];
        }
        return false;

    }

    public function can_login(){

        $this->db->where('number', $this->input->post('number'));
        $this->db->where('password', md5($this->input->post('password')));
        $this->db->where('deleted_at', NULL);
        $query = $this->db->get('users');

        if($query->num_rows()==1){

            return true;
        }else{
            return false;
        }
    }

    public function email_exists(){
        $this->db->where('email', $this->input->post('email'));
        $this->db->where('deleted_at', NULL);
        $query = $this->db->get('users');

        if($query->num_rows()==1){

            return true;
        }else{
            return false;
        }
    }

    public function get_email_id(){
        $result = $this->db->select('id')->from('users')->where('email', $this->input->post('email'))->where('deleted_at', NULL )->limit(1)->get()->row();
        return $result->id;

    }

    public function user_id($user_number){
        $result = $this->db->select('id')->from('users')->where('number', $user_number)->where('deleted_at', NULL )->limit(1)->get()->row();
        return $result->id;
    }

    public function email_id_exist($key){

        $this->db->where('id', $key);
        $this->db->where('deleted_at', NULL);
        $query = $this->db->get('users');

        if($query->num_rows()==1){

            return true;
        }else{
            return false;
        }
    }

    public function reset_user_password($id){
        $data = array(
            'password' => md5($this->input->post('password'))
        );

        $this->db->where('id', $id);
        $this->db->update('users', $data);
    }

    public function get_user_details($id){
        $result = $this->db->select('*')->from('users')->where('id', $id)->where('deleted_at', NULL )->limit(1)->get()->row();
        return $result;
    }

    public function update_user_profile($user_id, $name, $email){
        $data = array(
            'name'=>$name,
            'email'=>$email,
            'updated_at' => date('Y-m-d  h:i:s')
        );

        $this->db->where('id', $user_id);
        $this->db->update('users', $data);

    }

    public function set_general_content($user_id, $content){
        $data = array(
            'user_id' => $user_id,
            'content' => $content,
            'created_at' => date('Y-m-d  h:i:s')
        );
        $this->db->insert('general_contents', $data);
    }

    public function get_general_content($id){
        $result = $this->db->select('*')->from('general_contents')->where('user_id', $id)->where('deleted_at', NULL )->order_by('id', 'desc')->limit(1)->get();
        return $result->result();
    }

    public function get_general_edit_content($user_id, $content_id){
        $result = $this->db->select('*')->from('general_contents')->where('user_id', $user_id)->where('id',$content_id)->where('deleted_at', NULL )->order_by('id', 'desc')->limit(1)->get();
        return $result->result();
    }
    public function del_general_content($user_id, $content_id){
        $data = array(
            'deleted_at' => date('Y-m-d  h:i:s')
        );

        $this->db->where('id', $content_id);
        $this->db->where('user_id', $user_id);
        $this->db->update('general_contents', $data);
    }

    public function update_general_content($user_id, $content, $id){
        $data = array(
            'content'=>$content,
            'updated_at' => date('Y-m-d  h:i:s')
        );

        $this->db->where('id', $id);
        $this->db->where('user_id', $user_id);
        $this->db->update('general_contents', $data);

    }

    public function add_to_invitation_list($user_id, $contact_num){
        $data = array(
            'user_id' => $user_id,
            'contact_number' => $contact_num,
            'created_at' => date('Y-m-d  h:i:s')
        );
        $this->db->insert('invitations', $data);
    }

    public function add_to_black_list($user_id, $contact_num){
        $result = $this->db->select('number')->from('blacklist')->where('number', $contact_num)->where('deleted_at', NULL )->limit(1)->get()->row();
        $check_blacklist = $result;

        if(empty($check_blacklist)){
        $data = array(
            'user_id' => $user_id,
            'number' => $contact_num,
            'created_at' => date('Y-m-d  h:i:s')
        );
        $this->db->insert('blacklist', $data);
        return true;
        }else{
            return false;
        }
    }

    public function get_black_list($user_id){
        $result = $this->db->select('*')->from('blacklist')->where('user_id', $user_id)->get();
        return $result->result();

    }

    public function del_from_blacklist($user_id, $id){
        $this->db->where('id', $id);
        $this->db->where('user_id', $user_id);
        $this->db->delete('blacklist');
    }

    public function set_customized_content($user_id, $group_name, $group_content){
        $data = array(
            'user_id' => $user_id,
            'content_group_name' => $group_name,
            'contents'=>$group_content,
            'created_at' => date('Y-m-d  h:i:s')
        );
        $this->db->insert('customized_contents', $data);
    }

    public function get_customized_content($user_id){
        $result = $this->db->select('*')->from('customized_contents')->where('user_id', $user_id)->get();
        return $result->result();
    }

    public function get_customized_group_id($group_name){
        $result = $this->db->select('id')->from('customized_contents')->where('content_group_name', $group_name)->limit(1)->get()->row();
        return $result->id;
    }

    public function assign_contact_to_group($user_id,  $contact_name, $contact_number, $customized_group){
        $result = $this->db->select('number')->from('blacklist')->where('number', $contact_number)->limit(1)->get()->row();
        $check_blacklist = $result;
        $result2 = $this->db->select('contact_number')->from('contacts')->where('contact_number', $contact_number)->where('deleted_at', NULL )->limit(1)->get()->row();
        $check_contacts = $result2;
        if(empty($check_blacklist) && empty($check_contacts)){

            $data = array(
                'user_id' => $user_id,
                'contact_name' => $contact_name,
                'contact_number'=>$contact_number,
                'customized_contents_group'=> $customized_group,
                'created_at' => date('Y-m-d  h:i:s')
            );
            $this->db->insert('contacts', $data);
            return true;
        }

        else{
            return false ;
        }
    }
    public function get_group_name_from_id($id){
        $result = $this->db->select('content_group_name')->from('customized_contents')->where('id', $id)->where('deleted_at', NULL )->limit(1)->get()->row();
        $result->content_group_name;
    }

    public function get_contact_details($user_id){
        $result = $this->db->select('*')->from('contacts')->where('user_id', $user_id)->where('deleted_at', NULL )->get();
        return $result->result();
    }
	 public function get_contact_detail($user_id, $contact_number){
        $result = $this->db->select('*')->from('contacts')->where('user_id', $user_id)->where('contact_number', $contact_number)->where('deleted_at', NULL )->get();
        return $result->result();
    }

    public function del_contact($user_id, $contact_id){
        $data = array(
            'updated_at' => date('Y-m-d  h:i:s'),
            'deleted_at' => date('Y-m-d  h:i:s')
        );

        $this->db->where('id', $contact_id);
        $this->db->where('user_id', $user_id);
        $this->db->update('contacts', $data);
    }

    public function re_assign_contact_to_group($id, $user_id,  $contact_name, $contact_number, $customized_group){
        $result = $this->db->select('number')->from('blacklist')->where('number', $contact_number)->where('deleted_at', NULL )->limit(1)->get()->row();
        $check_blacklist = $result;

        if(empty($check_blacklist)){

            $data = array(
                'user_id' => $user_id,
                'contact_name' => $contact_name,
                'contact_number'=>$contact_number,
                'customized_contents_group'=> $customized_group,
                'updated_at' => date('Y-m-d  h:i:s')
            );
            $this->db->where('id', $id);
            $this->db->update('contacts', $data);
            return true;
        }

        else{
            return false ;
        }

    }

    public function add_user_rules($user_id, $days, $from, $to ){
        $check_contacts = $this->db->select('user_id')->from('rules')->where('user_id', $user_id)->limit(1)->get()->row();

        if(empty($check_contacts )) {
            $data = array(
                'user_id' => $user_id,
                'days' => $days,
                'from' => $from,
                'to' => $to,
                'created_at' => date('Y-m-d  h:i:s')
            );
            $this->db->insert('rules', $data);
        }
        else{
            $data = array(
                'user_id' => $user_id,
                'days' => $days,
                'from' => $from,
                'to' => $to,
                'updated_at' => date('Y-m-d  h:i:s')
            );
            $this->db->where('user_id', $user_id);
            $this->db->update('rules', $data);
        }
    }

    public function get_user_rules($user_id){
        $result = $this->db->select('*')->from('rules')->where('user_id', $user_id)->get();
        return $result->result();
    }

    public function unsubscribe_user($id){
        $data = array(
            'updated_at' => date('Y-m-d  h:i:s'),
            'deleted_at' => date('Y-m-d  h:i:s')
        );
        $this->db->where('id', $id);
        $this->db->update('users', $data);
    }






}