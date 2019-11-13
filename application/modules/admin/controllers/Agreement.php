<?php
class Agreement extends Admin_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model(array('Building_model'));
        $this->load->helper("url");
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->helper('download');
    }
    public function index()
    {
        $data['completed']=$this->Building_model->get_Completed_building();
        $data['ongoing']=$this->Building_model->getOngoing_building();
        $data['overdue']=$this->Building_model->getOverdue_building();
        $data['total']=$this->Building_model->getOverdue_building();
        $this->render_admin('building/home', $data);
    }
    public function getBuildings()
    {
        $actions = "<div class=\"text-center\">";
        $actions .= "<a href='" . base_url('admin/Building/building_board/$1') . "'  class='tip' ><i class=\"fa fa-search\"></i></a><a href='" . base_url('admin/Building/view/$1') . "'  class='tip' ><i class=\"fa fa-eye\"></i></a> <a href='" . base_url('admin/Building/form/$1') . "'  class='tip' ><i class=\"fa fa-edit\"></i></a> <a href='" . base_url('admin/Building/delete/$1') . "' class='tip po'  onclick='return areyousure(this)'><i class=\"fa fa-trash-o\"></i></a>";
        $actions .= "</div>";
        $this->load->library('datatables');
        $this->datatables
            ->select("bldid,building_info.name,project.Name,status,building_info.start_date,CONCAT(total_area,' Sqm')Project_area,building_info.planned_floors,building_info.planned_units", false)
            ->from("building_info")
            ->join("project", "project.id=building_info.project_id", "left")
            ->where("building_info.soft_delete", 0)
            ->add_column("Actions", $actions, "bldid");
        echo $this->datatables->generate();
    }

    public function view($id, $tab = false)
    {
        $data['building'] = $building = $this->Building_model->get($id);
        $data['soc'] = $this->Building_model->get_all_soc();
        $data['contractor'] = $this->Building_model->getContractor();
        $data['page_title'] = lang('view') . " " . lang('building');
        $this->render_admin('building/view', $data);
    }
    public function form($id = false)
    {
        $data['page_title'] = lang('add_building');
        $data['projecttype'] = $this->Building_model->Get_projecttype();
        $data['project'] = $this->Building_model->getAllProject();
        $data['soc'] = $this->Building_model->get_all_soc();
        $data['contractor'] = $this->Building_model->getContractor();
        $data['id'] = '';
        $data['Name'] = '';
        $data['project_id'] = '';
        $data['start_date'] = '';
        $data['project_completion_date'] = '';
        $data['Project_area'] = '';
        $data['shared_public_area'] = '';
        $data['planned_units'] = '';
        $data['planned_floors'] = '';
        $data['legal_descrioption'] = '';
        $data['legal_document'] = '';
        $data['project_status'] = '';
        $data['contractors'] = '';
        $data['pm_contract_start_date'] = '';
        $data['pm_contract_duration'] = '';
        $data['address'] = '';
        $data['pm_information'] = '';
        $data['emergency_contact'] = '';
        $data['attachment'] = '';
        if ($id) {
            $data['page_title'] = lang('edit_building');
            $data['building'] = $building = $this->Building_model->get($id);
            if (!$building) {
                $this->session->set_flashdata('error', lang('building_data_not_found'));
                redirect('admin/building');
            }
            $data['id'] = $building->bldid;
            $data['Name'] = $building->name;
            $data['project_id'] = $building->project_id;
            //$data['developer'] = $building->developer_name;
            $data['start_date'] = $building->start_date;
            $data['project_completion_date'] = $building->planned_completion_date;
            $data['Project_area'] = $building->total_area;
            $data['shared_public_area'] = $building->shared_public_area;
            $data['planned_units'] = $building->planned_units;
            $data['planned_floors'] = $building->planned_floors;
            $data['legal_descrioption'] = $building->legal_description;
            $data['legal_document'] = json_decode($building->legal_document);
            $data['project_status'] = $building->status;
            $data['contractors'] = json_decode($building->contractor_id);
            $data['pm_contract_start_date'] = $building->contractor_start_date;
            $data['pm_contract_duration'] = $building->contarctor_duration;
            $data['address'] = $building->address;
            $data['emergency_contact'] = $building->emergency_contact;
            $data['attachment'] = $building->attachment;
        }
        $this->form_validation->set_rules('Name', 'lang:Name', 'trim|required');
        $this->form_validation->set_rules('Start_date', 'lang:Start_date', 'trim|required');
        if ($this->form_validation->run() == false) {
            $this->render_admin('building/form', $data);
        } else {
            foreach ($_FILES['legal_doc']['name'] as $key => $image) {
                $config['upload_path'] = 'uploads/building/legal_doc/';
                $config['allowed_types'] = '*';
                $_FILES['file']['name'] = $_FILES['legal_doc']['name'][$key];
                $_FILES['file']['type'] = $_FILES['legal_doc']['type'][$key];
                $_FILES['file']['tmp_name'] = $_FILES['legal_doc']['tmp_name'][$key];
                $_FILES['file']['error'] = $_FILES['legal_doc']['error'][$key];
                $_FILES['file']['size'] = $_FILES['legal_doc']['size'][$key];
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
                foreach (json_decode($building->other_docpath) as $path) {
                    $otherdoc[] = $path;
                }
                $save['legal_document'] = !empty($otherdoc) ? json_encode($otherdoc) : null;
            }
            if (!empty($_FILES['handbook']['name'])) {
                $config['upload_path'] = 'uploads/building/';
                $config['allowed_types'] = '*';
                $config['file_name'] = $_FILES['handbook']['name'];
                $this->load->library('upload', $config);
                $this->upload->initialize($config);
                if ($this->upload->do_upload('handbook')) {
                    $uploadData = $this->upload->data();
                    $attachment = str_replace(' ', '_', $uploadData['file_name']);
                }
                $save['attachment'] = !empty($attachment) ? $attachment : null;
            }
            $save['bldid'] = $this->input->post('id');
            $save['name'] = $this->input->post('Name');
            $save['project_id'] = $this->input->post('project_id');
            $save['start_date'] = $this->input->post('Start_date');
            $save['planned_completion_date'] = $this->input->post('complete_date');
            $save['total_area'] = $this->input->post('area');
            $save['shared_public_area'] = $this->input->post('shared_public_area');
            $save['planned_units'] = $this->input->post('Planned_unit');
            $save['planned_floors'] = $this->input->post('Planned_floors');
            $save['legal_description'] = $this->input->post('legaldescription');
            $save['status'] = $this->input->post('projectstatus');
            $save['contractor_id'] = json_encode($this->input->post('contractors'));
            $save['contractor_start_date'] = $this->input->post('contract_start_date');
            $save['contarctor_duration'] = $this->input->post('contract_duration');
            $save['address'] = $this->input->post('address');
            $save['emergency_contact'] = $this->input->post('emergency_contact');
            $this->Building_model->save($save);
            if ($id) {
                $this->session->set_flashdata('message', lang('building_updated'));
            } else {
                $this->session->set_flashdata('message', lang('building_save'));
            }
            redirect('admin/building');
        }
    }

    public function delete($id = false)
    {
        if ($id) {
            $building = $this->Building_model->projectIfexists($id);
            if (!$building) {
                $this->session->set_flashdata('error', lang('unable_to_delete_this_building_data'));
                redirect('admin/building');
            } else {
                $delete = $this->Building_model->delete($id);
                $this->session->set_flashdata('message', lang('building_data_deleted'));
                redirect('admin/building');
            }
        } else {
            $this->session->set_flashdata('error', lang('unable_to_delete_this_building_data'));
            redirect('admin/building');
        }
    }
    public function download_Attachment($id = null)
    {
        $buildingattachment = $this->Building_model->get($id);
        $Attachment = $buildingattachment->attachment;
        $file = base_url() . 'uploads/building/' . $Attachment;
        $data = file_get_contents($file);
        force_download($servicesattachment->attachment_path, $data);
    }
    public function download_otherdoc($name)
    {
        $file = base_url() . 'uploads/building/legal_doc/' . $name;
        $data = file_get_contents($file);
        force_download($servicesattachment->attachment_path, $data);
    }
    public function doc_delete()
    {
        $doc = $this->input->post('doc');
        $id = $this->input->post('projectid');
        $buildingattachment = $this->Building_model->get($id);
        $otherdoc = json_decode(($buildingattachment->legal_document));
        if (($key = array_search($doc, $otherdoc)) !== false) {
            unset($otherdoc[$key]);
            $this->db->where('id', $id);
            $this->db->update('project', array('legal_document' => json_encode($otherdoc)));
            echo $this->db->last_query();
            if (file_exists(BASEPATH . '../uploads/building/legal_doc/' . $doc)) {
                unlink(BASEPATH . '../uploads/building/legal_doc/' . $doc);
            }
        }
        return true;
    }
    public function building_home()
    {
        $data['completed']=$this->Building_model->get_Completed_building();
        $data['ongoing']=$this->Building_model->getOngoing_building();
        $data['overdue']=$this->Building_model->getOverdue_building();
        $data['total']=$this->Building_model->getOverdue_building();
        $this->render_admin('building/home', $data);
    }
    public function building_board($building_id, $tab= false)
    {
        $data['building']=$building=$this->Building_model->getbuildingById($building_id);
        $data['milestone']=$this->Building_model->getmilestone($building->bldid,$building->project_id);
        $data['buildingTask']=$buildingTask=$this->Building_model->getBuildingTask($building->bldid,$building->project_id);
        $data['incompletedTask']=$incompletedTask=$this->Building_model->incompletedTaskCount($building->bldid,$building->project_id);
        $data['currency']=$this->Building_model->getCurrency();
        $data['building_members']=$this->Building_model->getMembers($building->bldid,$building->project_id);
        $data['buildingactivity']=$this->Building_model->getbuildingActivity($building->bldid,$building->project_id);
        $data['buildingid']=$building->bldid;
        $data['project_id']=$building->project_id;
        $data['employee']=$this->Building_model->getEmployee();
        $data['labourtype']=$this->Building_model->getlabourtype();
        $this->render_admin('building/board', $data);
    }
    public function getMilstone()
    {
        $actions = "<div class=\"text-center\">";
        $actions .= "<a   class='milestoneedit' id='$1' onclick='getMilstoneEdit()'><i class=\"fa fa-edit\"></i></a> <a href='" . base_url('admin/Project/delete/$1') . "' class='tip po'  onclick='return areyousure(this)'><i class=\"fa fa-trash-o\"></i></a>";
        $actions .= "</div>";
        $this->load->library('datatables');
        $this->datatables
           ->select("building_milestone.id,title ,CONCAT(currrency_symbol,cost) cost,building_milestone.status", false)
           ->from("building_milestone")
           ->join("currency", "currency.id=building_milestone.currency", "left")
           ->where("soft_delete", 0)
           ->add_column("Actions", $actions, "building_milestone.id");
        echo $this->datatables->generate();
    }
    public function members_save()
    {
        $this->form_validation->set_rules('Name', 'lang:Name', 'trim|required');
        $this->form_validation->set_rules('Start_date', 'lang:Start_date', 'trim|required');
        if ($this->form_validation->run() == false) {
            $save['employee_id']= $this->input->post('members');
            $save['role_id']= $this->input->post('labourtype');
            $save['building_id']= $this->input->post('buildingid');
            $save['project_id']= $this->input->post('projectid');
            $saved=$this->Building_model->building_member_save($save);
            if ($saved) {
                $this->message->save_success('admin/Building/building_board/'.$this->input->post('buildingid').'/Members');
            } else {
                $this->message->custom_error_msg('admin/Building/building_board/'.$this->input->post('buildingid').'/Members', 'Members Not Saved');
            }
        }
    }
    public function assignlead()
    {
        $this->form_validation->set_rules('Name', 'lang:Name', 'trim|required');
        $this->form_validation->set_rules('Start_date', 'lang:Start_date', 'trim|required');
        if ($this->form_validation->run() == false) {
            $save['employee_id']= $this->input->post('members');
            $save['building_id']= $this->input->post('buildingid');
            $save['project_id']= $this->input->post('projectid');
            $saved=$this->Building_model->assignLeadForBuilding($save);
            if ($saved) {
                $this->message->save_success('admin/Building/building_board/'.$this->input->post('buildingid').'/Members');
            } else {
                $this->message->custom_error_msg('admin/Building/building_board/'.$this->input->post('buildingid').'/Members', 'Members Not Saved');
            }
        }
    }




    
    public function task_save()
    {
        $this->form_validation->set_rules('heading', 'heading', 'trim|required');
        $this->form_validation->set_rules('editordata', 'editordata', 'trim|required');
        $buildingid=$this->input->post('buildingid');
        if ($this->form_validation->run() ==true) {
            $save['taskName']= $this->input->post('heading');
            $save['description']= $this->input->post('editordata');
            $save['start_date']= $this->input->post('start_date');
            $save['end_date']= $this->input->post('due_date');
            $save['milestone_id']= $this->input->post('milestone');
            $save['assign_to']= $this->input->post('assigned_to');
            $save['building_id']= $this->input->post('buildingid');
            $save['project_id']= $this->input->post('projectid');
            $save['status']= $this->input->post('status');
            $save['id']   = $this->input->post('task_id');
            $saved=$this->Building_model->tasksave($save);
            if ($saved) {
                $this->message->save_success('admin/Building/building_board/'.$buildingid.'/Tasks');
            } else {
                $this->message->custom_error_msg('admin/Building/building_board/'.$buildingid.'/Tasks', 'Task Not Saved');
            }
        } else {
            $error = validation_errors();
            $this->message->custom_error_msg('admin/Building/building_board/'.$buildingid.'/Tasks', $error);
        }
    }
    public function milestone_save()
    {
        $this->form_validation->set_rules('milestone_title', 'milestone_title', 'trim|required');
        $this->form_validation->set_rules('summary', 'summary', 'trim|required');
        $buildingid=$this->input->post('buildingid');
        if ($this->form_validation->run() ==true) {
            $save['title']= $this->input->post('milestone_title');
            $save['status']= $this->input->post('status');
            $save['currency']= $this->input->post('currency_id');
            $save['cost']= $this->input->post('cost');
            $save['milestone_summary']= $this->input->post('summary');
            $save['projectid']= $this->input->post('projectid');
            $save['buildingid']= $this->input->post('buildingid');
            $save['id']   = $this->input->post('milestone_id');
            $saved=$this->Building_model->milestonesave($save);
            if ($saved) {
                $this->message->save_success('admin/Building/building_board/'.$buildingid.'/Milestone');
            } else {
                $this->message->custom_error_msg('admin/Building/building_board/'.$buildingid.'/Milestone', 'Milestone Not Saved');
            }
        } else {
            $error = validation_errors();
            $this->message->custom_error_msg('admin/Building/building_board/'.$buildingid.'/Milestone', $error);
        }
    }
    public function getMilstoneEdit()
    {
        $milstone=$this->Building_model->milestoneget($this->input->post('milestone_id'));
        echo json_encode($milstone);
    }
    public function milstoneDelete($id = false)
    {
        if ($id) {
            $milstone	= $this->Building_model->milstoneifexists($id);
            if (!$milstone) {
                $this->message->custom_error_msg('admin/Building/building_board/'.$milstone->buildingid.'/Milestone', lang('milstone_is_used'));
            } else {
                $delete	= $this->Building_model->milstoneDeleted($id);
                $this->message->save_success('admin/Building/building_board/'.$milstone->buildingid.'/Milestone');
            }
        } else {
            $this->message->custom_error_msg('admin/Building/building_board/'.$milstone->buildingid.'/Milestone', lang('milstone_is_used'));
        }
    }
    
    public function milestone_doc_save(){
        if (!empty($_FILES['file']['name'])) {
            $config['upload_path'] = 'uploads/building_file/';
            $config['allowed_types'] = '*';
            $config['file_name'] = $_FILES['file']['name'];
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            if ($this->upload->do_upload('file')) {
                $uploadData = $this->upload->data();
                $attachment = str_replace(' ', '_', $uploadData['file_name']);
            }
            $save['upload_doc'] = !empty($attachment) ? $attachment : null;
            //  $save['projectid']= $this->input->post('projectid');
            $save['bldid']= $this->input->post('buildingid');
            $saved=$this->Building_model->building_doc_upload($save);
            redirect($_SERVER["HTTP_REFERER"]);
        }
    }
    public function building_doc_download($doc){
        $this->load->helper('download');
        $file = base_url().'uploads/building_file/'.$doc;
        $data =  file_get_contents($file);
        force_download($doc, $data);
    }

    public function doc_deleted($doc, $buildingid){
        $building=$this->db->get_where('building_info', array("bldid"=>$buildingid))->row();
        $otherdoc=json_decode(($building->upload_doc));
        if (($key = array_search($doc, $otherdoc)) !== false) {
            unset($otherdoc[$key]);
            $this->db->where('bldid', $buildingid);
            $this->db->update('building_info', array('upload_doc'=>json_encode($otherdoc)));
            if (file_exists(BASEPATH.'../uploads/building_file/'.$doc)) {
                unlink(BASEPATH.'../uploads/building_file/'.$doc);
            }
        }
        redirect($_SERVER["HTTP_REFERER"]);
    }
    public function getTaskEdit(){
        $task=$this->Building_model->editTask($this->input->post('task_id'));
        echo json_encode($task);
    }
    function member_remove(){
        $member=$this->input->post('memeberid');
        $this->db->where('id',$member);
        if($this->db->update('building_members',array('soft_delete'=>1))){
            return true;
        }else{
            return false;
        }
    }
    function generate_datatable(){
        $project = $this->input->post('project');
        $building = $this->input->post('building');
        $floors = $this->input->post('floors');
        $units = $this->input->post('units');
        $Owner = $this->input->post('Owner');
        /*$final_balance = $balance - $advance_amt;
        $emi_period = $this->input->post('emi_period');
        $emi_percentage = $this->input->post('emi_percentage');
        $date = $this->input->post('date');
        $moratorium = !empty($this->input->post('moratorium'))?$this->input->post('moratorium'):0;
        $moratorium_per = !empty($this->input->post('moratorium_per'))? $this->input->post('moratorium_per'):0;
        $moratorium_amt= round((($final_balance/100)*$moratorium_per), 2);
        $emi = $this->paymentSchedulesummary($final_balance, $emi_period, $emi_percentage, $date, $moratorium, $moratorium_per);
        $data = array('balance' => $final_balance, 'emi' => $emi,'moratorium_amt'=>$moratorium_amt);
        echo json_encode($data); */
    }
    
}