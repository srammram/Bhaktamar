<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Owner_auth
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
        $Owner = $this->CI->session->userdata('owner');
        if(!$Owner)
        {
            redirect('owner/login');
        }
	}
    function check_access($access, $default_redirect=false, $redirect = false)
    {
        $Owner = $this->CI->session->userdata('Owner');
        $this->CI->db->select('access_id');
        $this->CI->db->where('id', Owner['id']);
        $this->CI->db->limit(1);
        $result = $this->CI->db->get('owner_login');
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
				   redirect('owner/dashboard/');
                }
            }
            
        }
    }
  
    function is_logged_in($redirect = false, $default_redirect = true)
    {
        $Owner = $this->CI->session->userdata('Owner');
        if (!$Owner)
        {
            //check the cookie
            if(isset($_COOKIE['Owner']))
            {
                //the cookie is there, lets log the customer back in.
                $info = $this->aes256Decrypt(base64_decode($_COOKIE['Owner']));
                $cred = json_decode($info, true);

                if(is_array($cred))
                {
                    if( $this->login_owner($cred['username'], $cred['password']) )
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
                redirect('owner/login');
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
    function login_owner($username, $password, $remember=false)
    {
        // make sure the username doesn't go into the query as false or 0
        if(!$username)
        {
            return false;
        }
        $this->CI->db->select('*');
        $this->CI->db->where('active', 1);
		$this->CI->db->where("(email='$username' OR username='$username')", NULL, FALSE);
        $this->CI->db->where('password',  sha1($password));
        $this->CI->db->limit(1);
        $result = $this->CI->db->get('owner_login');
        $result = $result->row_array();
        if (sizeof($result) > 0)
        {
            $owner = array();
            $owner['owner'] = array();
            $owner['owner']['id'] = $result['id'];
            $owner['owner']['user_role'] = $result['user_role'];
            $owner['owner']['firstname'] = $result['firstname'];
			$owner['owner']['lastname'] = $result['lastname'];
            $owner['owner']['email'] = $result['email'];
            $owner['owner']['username'] = $result['username'];
			$owner['owner']['projectid'] = $result['project_id'];
			$owner['owner']['floor']     = $result['floor_id'];
			$owner['owner']['unit']      = $result['Owner_unit'];
			$owner['owner']['venue']      = $result['address'];
			$owner['owner']['Owner_type'] = $result['Owner_type'];
			$owner['owner']['owner_id']   = $result['Owner_id'];
            if($remember)
            {
                $loginCred = json_encode(array('username'=>$username, 'password'=>$password));
                $loginCred = base64_encode($this->aes256Encrypt($loginCred));
                $this->generateCookie($loginCred, strtotime('+6 months'));
            }
            $this->CI->session->set_userdata($owner);
            return true;
        }
        else
        {
            return false;
        }
    }
    
    private function generateCookie($data, $expire)
    {
        setcookie('Owner', $data, $expire, '/', $_SERVER['HTTP_HOST']);
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
        $this->CI->session->unset_userdata('owner');
        //force expire the cookie
        $this->generateCookie('[]', time()-3600);
    }

    /*
    This function resets the admins password and usernames them a copy
    */
    function reset_password($username)
    {
        $owner = $this->get_admin_by_username($username);
        if ($owner)
        {
            $this->CI->load->helper('string');
            $this->CI->load->library('email');
            
            $new_password       = random_string('alnum', 8);
            $owner['password']  = sha1($new_password);
            $this->save_admin($owner);
            
            $this->CI->email->from(config_item('email'), config_item('site_name'));
            $this->CI->email->to($owner['email']);
            $this->CI->email->subject(config_item('site_name').': owner Password Reset');
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