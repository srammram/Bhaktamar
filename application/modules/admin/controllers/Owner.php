<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Owner extends Admin_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model(array('Owner_model'));
    }
    public function index()
    {
        $admin = $this->session->userdata('admin');
        $data['page_title'] = lang('Owner');
        $this->render_admin('Owner/list', $data);
    }
    public function get_owner()
    {
        $actions = "<div class=\"text-center\">";
        $actions .= "<a href='" . base_url('admin/Owner/view/$1') . "'  class='tip' ><i class=\"fa fa-eye\"></i></a> <a href='" . base_url('admin/Owner/form/$1') . "'  class='tip' ><i class=\"fa fa-edit\"></i></a> <a href='" . base_url('admin/Owner/delete/$1') . "' class='tip po'  onclick='return areyousure(this)'><i class=\"fa fa-trash-o\"></i></a>";
        $actions .= "</div>";
        $this->load->library('datatables');
        $this->datatables
            ->select("ownid,full_name,project.Name,email,nationalities.Nationality,sex
		  ", false)
            ->from("owner")
            ->join("project", "project.id=owner.project_id", "left")
            ->join("nationalities", "nationalities.NationalityID=owner.nationality", "left")
            ->where("owner.soft_deleted", 0)
            ->add_column("Actions", $actions, "ownid");
        echo $this->datatables->generate();
    }
    public function view($id, $tab = false)
    {
        $data['idtype'] = $this->Owner_model->get_idtype();
        $data['project'] = $this->Owner_model->get_Project();
        $data['Owner'] = $Owner = $this->Owner_model->get($id);
        $data['nationalitylist'] = $this->Owner_model->get_nationality();
        $data['projectunits'] = $units = $this->Owner_model->get_unitBy_projectWise($id, $Owner->units);
		$data['activeunits'] = $activeunits = $this->Owner_model->get_ownerWiseUnit($id);
        $data['page_title'] = lang('view') . " " . lang('Owner');
        $this->render_admin('Owner/view', $data);
    }
    public function form($id = false){
        $admin = $this->session->userdata('admin');
        $this->load->helper('form');
        $this->load->library('form_validation');
        $data['page_title'] = lang('Add_Owner');
        $data['idtype'] = $this->Owner_model->get_idtype();
        $data['project'] = $this->Owner_model->get_Project();
        $data['nationalitylist'] = $this->Owner_model->get_nationality();
        $data['Owner'] = $Owner = $this->Owner_model->get($id);
        $data['id']           = '';
        $data['ownid']        = '';
        $data['full_name']    = '';
        $data['salutation']   = '';
        $data['surname']      = '';
        $data['firstname']    = '';
        $data['nationality']  = '';
        $data['dob']          = '';
        $data['sex']          = '';
        $data['id_type']      = '';
        $data['id_no']        = '';
        $data['primary_phone'] = '';
        $data['handphone']     = '';
        $data['app_communication_details'] = '';
        $data['card_details']        = '';
        $data['permanent_address']   = '';
        $data['project_id']          = '';
        $data['building_id']         = '';
        $data['assigned_unit']       = '';
        $data['email']				 = '';
        $data['password'] 			 = '';
        $data['attachments'] 		 = '';
        $data['vip']                 = '';
        if ($id) {
			$activeUnits=   $this->Owner_model->get_active_unit($id);
			$data['activeUnits']=$activeUnits=explode(',',$activeUnits->ids);
		    $activeUnits = implode("','",$activeUnits);
            $data['Owner']      = $Owner = $this->Owner_model->get($id);
            $data['buildings']  = $building = $this->Owner_model->get_buildingbyProjects($Owner->project_id);
            $data['ass_unites'] = $ass_unites = $this->Owner_model->get_unitBy_buildingwise($Owner->project_id, $Owner->building_id,$activeUnits);
			
           if (!$Owner) {
                $this->session->set_flashdata('error', lang('Owner_not_found'));
                redirect('Owner/form');
            }
            $data['ownid']                   = $Owner->ownid;
            $data['full_name']               = $Owner->full_name;
            $data['salutation']              = $Owner->salutation;
            $data['surname']                 = $Owner->surname;
            $data['firstname']               = $Owner->firstname;
            $data['nationality']             = $Owner->nationality;
            $data['dob']                     = $Owner->dob;
            $data['sex']                     = $Owner->sex;
            $data['id_type']                 = $Owner->id_type;
            $data['id_no']                   = $Owner->id_no;
            $data['primary_phone']           = $Owner->primary_phone;
            $data['handphone']               = $Owner->handphone;
            $data['app_communication_details']= json_decode($Owner->app_communication_details);
            $data['card_details']            = json_decode($Owner->card_details);
            $data['permanent_address']       = $Owner->permanent_address;
            $data['project_id']              = $Owner->project_id;
            $data['building_id']             = $Owner->building_id;
            $data['assigned_unit']           = json_decode($Owner->units);
            $data['email']                   = $Owner->email;
            $data['attachments']             = $Owner->attachments;
            $data['vip']                     = $Owner->vip;
        }
        $this->form_validation->set_rules('fullname', 'lang:fullname', 'trim|required');
        if ($this->form_validation->run() == false) {
            $this->render_admin('Owner/form', $data);
        } else {
            foreach ($_FILES['attachment']['name'] as $key => $image) {
                $config['upload_path'] = 'uploads/owners/';
                $config['allowed_types'] = '*';
                $_FILES['file']['name'] = $_FILES['attachment']['name'][$key];
                $_FILES['file']['type'] = $_FILES['attachment']['type'][$key];
                $_FILES['file']['tmp_name'] = $_FILES['attachment']['tmp_name'][$key];
                $_FILES['file']['error'] = $_FILES['attachment']['error'][$key];
                $_FILES['file']['size'] = $_FILES['attachment']['size'][$key];
                $fileName = $image;
                $config['file_name'] = $fileName;
                $this->load->library('upload', $config);
                $this->upload->initialize($config);
                if ($this->upload->do_upload('file')) {
                    $doc = $this->upload->data();
                    $otherdoc[] = str_replace(' ', '_', $doc['file_name']);
                }
            }
            if (!empty($otherdoc)) {
                foreach (json_decode($Owner->attachments) as $path) {
                    $otherdoc[] = $path;
                }
                $save['attachments'] = !empty($otherdoc) ? json_encode($otherdoc) : null;
            }
            for ($i = 0; $i < count($this->input->post('Appname')); $i++) {
                if (!empty($_POST['Appname'][$i])) {
                    $appdetails[] = array(
                        'Appname' => $_POST['Appname'][$i],
                        'Appid' => $_POST['Appid'][$i],
                    );
                }
            }

            for ($i = 0; $i < count($this->input->post('cardholdername')); $i++) {
                if (!empty($_POST['cardholdername'][$i])) {
                    $card_details[] = array(
                        'cardholdername' => $_POST['cardholdername'][$i],
                        'cardnumber' => $_POST['Cardnumber'][$i],
                        'expired' => $_POST['monthyears'][$i],
                        'cvv' => $_POST['cvv'][$i],
                    );
                }
            }
            if (!empty($card_details)) {
                $save['card_details'] = json_encode($card_details);
            }

            if (!empty($appdetails)) {
                $save['app_communication_details'] = json_encode($appdetails);
            }
            if (!empty($this->input->post('password'))) {
                $save['password'] = sha1($this->input->post('password'));
            }
            $save['ownid'] = $this->input->post('id');
            $save['full_name'] = $this->input->post('fullname');
            $save['salutation'] = $this->input->post('salutation');
            $save['surname'] = $this->input->post('surname');
            $save['firstname'] = $this->input->post('firstname');
            $save['nationality'] = $this->input->post('nationality');
            $save['dob'] = $this->input->post('dob');
            $save['sex'] = $this->input->post('sex');
            $save['id_type'] = $this->input->post('idtype');
            $save['id_no'] = $this->input->post('id_no');
            $save['primary_phone'] = $this->input->post('primary_phone');
            $save['handphone'] = $this->input->post('handphone');
            $save['permanent_address'] = $this->input->post('permanent_address');
            $save['project_id'] = $this->input->post('assigned_project');
            $save['building_id'] = $this->input->post('building_id');
            $save['units'] = json_encode($this->input->post('assigned_unit'));
            $save['email'] = $this->input->post('email');
            $save['vip'] = !empty($this->input->post('vip')) ? $this->input->post('vip') : 0;
            $this->Owner_model->save($save);
            if ($id) {
                $this->session->set_flashdata('message', lang('Owner_update'));
            } else {
                $this->session->set_flashdata('message', lang('Owner_save'));
            }
            redirect('admin/Owner');
        }
    }

    public function delete($id = false)
    {
        if ($id) {
            $owner = $this->Owner_model->get($id);
            if (!$owner) {
                $this->session->set_flashdata('error', lang('Owner_not_found'));
                redirect('admin/Owner');
            } else {
                $delete = $this->Owner_model->delete($id);
                $this->session->set_flashdata('message', lang('Owner_delete'));
                redirect('admin/Owner');
            }
        } else {

            $this->session->set_flashdata('error', lang('Owner_not_found'));
            redirect('admin/Owner');
        }
    }
    public function get_unitByProject()
    {
        $projectid = $this->input->post('projectid');
        $HTML = '';
        $units = $this->Owner_model->get_unitBy_project($projectid);
        if ($units) {
            foreach ($units as $unit) {
                $HTML .= "<option value='" . $unit->uid . "'>" . $unit->unit_name . "</option>";
            }
        } else {
            $HTML .= "<option value=''>Select unit</option>";
        }
        echo $HTML;
        /*
    $units=$this->Owner_model->get_unitBy_project($projectid);
    if ($units) {
    foreach ($units as $unit) {
    $HTML[]=array('id'=>$unit->uid,'name'=>$unit->unit_name)  ;
    }
    echo json_encode($HTML);
    }*/
    }

    public function get_unitBybuilding()
    {
        $projectid = $this->input->post('project_id');
        $buildingid = $this->input->post('buildingid');
        $HTML = '<option value="">Select unit</option>';
        $units = $this->Owner_model->get_unitBy_project($projectid, $buildingid);
        if ($units) {
            foreach ($units as $unit) {
                $HTML .= "<option value='" . $unit->uid . "'>" . $unit->unit_name . "</option>";
            }
        } 
        echo $HTML;
        /*
    $units=$this->Owner_model->get_unitBy_project($projectid);
    if ($units) {
    foreach ($units as $unit) {
    $HTML[]=array('id'=>$unit->uid,'name'=>$unit->unit_name)  ;
    }
    echo json_encode($HTML);
    }*/
    }
   
    public function doc_delete()
    {
        $doc = $this->input->post('doc');
        $id = $this->input->post('ownerid');
        $ownerattachment = $this->Owner_model->get($id);
        $otherdoc = json_decode(($ownerattachment->attachments));
        if (($key = array_search($doc, $otherdoc)) !== false) {
            unset($otherdoc[$key]);
            $this->db->where('ownid', $id);
            $this->db->update('owner', array('attachments' => json_encode($otherdoc)));

            if (file_exists(BASEPATH . '../uploads/owners/' . $doc)) {
                unlink(BASEPATH . '../uploads/owners/' . $doc);
            }
        }
        return true;
    }
    public function download_attachment($name){
        $file = base_url() . 'uploads/owners/' . $name;
        $data = file_get_contents($file);
        $file = base_url() . 'uploads/owners/' . $name;
        force_download($name, $data);
    }
    public function get_unit(){
        $projectid = $this->input->post('project_id');
        $buildingid = $this->input->post('buildingid');
        $HTML = '<option value="">Select unit</option>';
        $units = $this->Owner_model->get_units($projectid,$buildingid);
        if ($units) {
            foreach ($units as $unit) {
                $HTML .= "<option value='" . $unit->uid . "'>" . $unit->unit_name . "</option>";
            }
        } 
        echo $HTML;
    }
}
