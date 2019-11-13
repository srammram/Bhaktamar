<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Emp_auth
{
    var $CI;

    function __construct()
    {
        $this->CI =& get_instance();
        $this->CI->load->database();
        $this->CI->load->helper('url');
    }
    
	function check_session()
	{
        $Employee = $this->CI->session->userdata('employee');
        if(!$Employee)
        {
            redirect('employee/dashboard');
        }
	}
    function check_access($access, $default_redirect=false, $redirect = false)
    {
        $Employee = $this->CI->session->userdata('employee');
        $this->CI->db->select('access_id');
        $this->CI->db->where('id', $Employee['id']);
        $this->CI->db->limit(1);
        $result = $this->CI->db->get('employee');
        $result = $result->row();
        //result should be an object I was getting odd errors in relation to the object.
        //if $result is an array then the problem is present.
        if(!$result || is_array($result))
        {
            $this->logout();
            return false;
        }
    //  echo $result->access;
        if ($access)
        {
       
			if ($access == $result->access_id)
            {
             	return true;
            }
            else
            {	if ($redirect)
                {
                    redirect($redirect);
                }
                else{
				   redirect('employee/dashboard/');
                }
            }
            
        }
    }
  
    function is_logged_in($redirect = false, $default_redirect = true)
    {
        $employee = $this->CI->session->userdata('employee');
        if (!$employee)
        {
            //check the cookie
            if(isset($_COOKIE['employee']))
            {
                //the cookie is there, lets log the customer back in.
                $info = $this->aes256Decrypt(base64_decode($_COOKIE['employee']));
                $cred = json_decode($info, true);

                if(is_array($cred))
                {
                    if( $this->login_employee($cred['username'], $cred['password']) )
                    {
                        return $this->is_logged_in($redirect, $default_redirect);
                    }
                }
            }

            if ($redirect)
            {
                $this->CI->session->set_flashdata('redirect', $redirect);
            }
                
            if ($default_redirect)
            {   
                redirect('employee/login');
            }
            
            return false;
        }
        else
        {
            return true;
        }
    }
    /*
    this function does the logging in.
    */
    function login_employee($username, $password, $remember=false)
    {
        // make sure the username doesn't go into the query as false or 0
        if(!$username)
        {
            return false;
        }
        $this->CI->db->select('*');
        $this->CI->db->where('termination', 1);
		$this->CI->db->where("(employee_id='$username' OR first_name='$username')", NULL, FALSE);
        $this->CI->db->where('password',  sha1($password));
        $this->CI->db->limit(1);
        $result = $this->CI->db->get('employee');
        $result = $result->row_array();
        if (sizeof($result) > 0)
        {
            $employee = array();
            $employee['employee'] = array();
            $employee['employee']['id'] = $result['id'];
            $employee['employee']['user_role'] = $result['user_role'];
            $employee['employee']['firstname'] = $result['first_name'];
			$employee['employee']['lastname'] = $result['last_name'];
            $employee['employee']['department'] = $result['department'];
			$employee['employee']['email'] = $result['email'];
            if($remember)
            {
                $loginCred = json_encode(array('username'=>$username, 'password'=>$password));
                $loginCred = base64_encode($this->aes256Encrypt($loginCred));
                $this->generateCookie($loginCred, strtotime('+6 months'));
            }
            $this->CI->session->set_userdata($employee);
            return true;
        }
        else
        {
            return false;
        }
    }
    
    private function generateCookie($data, $expire)
    {
        setcookie('employee', $data, $expire, '/', $_SERVER['HTTP_HOST']);
    }

    private function aes256Encrypt($data)
    {
        $key = config_item('encryption_key');
        if(32 !== strlen($key))
        {
            $key = hash('SHA256', $key, true);
        }
        $padding = 16 - (strlen($data) % 16);
        $data .= str_repeat(chr($padding), $padding);
        return mcrypt_encrypt(MCRYPT_RIJNDAEL_128, $key, $data, MCRYPT_MODE_CBC, str_repeat("\0", 16));
    }

    private function aes256Decrypt($data) {
        $key = config_item('encryption_key');
        if(32 !== strlen($key))
        {
            $key = hash('SHA256', $key, true);
        }
        $data = mcrypt_decrypt(MCRYPT_RIJNDAEL_128, $key, $data, MCRYPT_MODE_CBC, str_repeat("\0", 16));
        $padding = ord($data[strlen($data) - 1]); 
        return substr($data, 0, -$padding); 
    }

    /*
    this function does the logging out
    */
    function logout()
    {
        $this->CI->session->unset_userdata('employee');
        //force expire the cookie
        $this->generateCookie('[]', time()-3600);
    }

    /*
    This function resets the admins password and usernames them a copy
    */
    function reset_password($username)
    {
        $employee = $this->get_admin_by_username($username);
        if ($owner)
        {
            $this->CI->load->helper('string');
            $this->CI->load->library('email');
            
            $new_password       = random_string('alnum', 8);
            $employee['password']  = sha1($new_password);
            $this->save_admin($employee);
            $this->CI->email->from(config_item('email'), config_item('site_name'));
            $this->CI->email->to($employee['email']);
            $this->CI->email->subject(config_item('site_name').': employee Password Reset');
            $this->CI->email->message('Your password has been reset to '. $new_password .'.');
            $this->CI->email->send();
            return true;
        }
        else
        {
            return false;
        }
    }
    
  
   
}