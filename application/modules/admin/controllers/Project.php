<?php

class Project extends Admin_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model(array('Project_model'));
        $this->load->helper("url");
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->helper('download');
    }
    public function index()
    {
        $this->sma->checkPermissions();
        $admin = $this->session->userdata('admin');
        $data['page_title'] = lang('Project');
        $this->render_admin('Project/list', $data);
    }
    public function getProject()
    {
        $actions = "<div class=\"text-center\">";
       // $actions .= "<a href='" . base_url('admin/Project/project_chart/$1') . "'  class='tip' ><i class=\"fa fa-bar-chart\"></i></a> <a href='" . base_url('admin/Project/view/$1') . "'  class='tip' ><i class=\"fa fa-eye\"></i></a> <a href='" . base_url('admin/Project/form/$1') . "'  class='tip' ><i class=\"fa fa-edit\"></i></a> <a href='" . base_url('admin/Project/delete/$1') . "' class='tip po'  onclick='return areyousure(this)'><i class=\"fa fa-trash-o\"></i></a>";
		  $actions .= "<a href='" . base_url('admin/Project/view/$1') . "'  class='tip' ><i class=\"fa fa-eye\"></i></a> <a href='" . base_url('admin/Project/form/$1') . "'  class='tip' ><i class=\"fa fa-edit\"></i></a> <a href='" . base_url('admin/Project/delete/$1') . "' class='tip po'  onclick='return areyousure(this)'><i class=\"fa fa-trash-o\"></i></a>";
        $actions .= "</div>";
        $this->load->library('datatables');
        $this->datatables
            ->select("id,Name,project_status,Start_date,CONCAT(Project_area,' Sqm')Project_area,Planned_floors,Planned_units", false)
            ->from("project")
            ->where("soft_delete", 0)
            ->add_column("Actions", $actions, "id");
        echo $this->datatables->generate();
    }

    public function view($id, $tab = false)
    {
        $this->sma->checkPermissions();
        $admin = $this->session->userdata('admin');
        $data['project_id'] = $id;
        $data['project'] = $project = $this->Project_model->get($id);
        $data['projecttype'] = $this->Project_model->Get_projecttype();
        $data['soc'] = $this->Project_model->get_all_soc();
        $data['facilities'] = $this->Project_model->getfacilities();
        $data['vendor'] = $this->Project_model->getVendor();
        $data['buildings'] = $this->Project_model->getBuilding($id);
        $data['contractor'] = $this->Project_model->getContractor();
        $data['page_title'] = lang('view') . " " . lang('Project');
        //    $this->render_admin('Project/view', $data);
        $this->render_admin('Project/board', $data);
    }
    public function form($id = false)
    {
        $this->sma->checkPermissions();
        $admin = $this->session->userdata('admin');
        $data['page_title'] = lang('Project_Form');
        $data['projecttype'] = $this->Project_model->Get_projecttype();
        $data['soc'] = $this->Project_model->get_all_soc();
        $data['facilities'] = $this->Project_model->getfacilities();
        $data['vendors'] = $this->Project_model->getVendor();
        $data['contractor'] = $this->Project_model->getContractor();
        $data['id'] 						= '';
        $data['Name'] 						= '';
        $data['developer'] 					= '';
        $data['project_type'] 				= '';
        $data['start_date'] 				= '';
        $data['project_completion_date'] 	= '';
        $data['Project_area'] 				= '';
        $data['shared_public_area'] 		= '';
        $data['planned_units'] 				= '';
        $data['planned_floors'] 			= '';
        $data['legal_descrioption'] 		= '';
        $data['legal_document'] 			= '';
        $data['project_status'] 			= '';
        $data['facilites'] 					= '';
        $data['contractors'] 				= '';
        $data['pm_contract_start_date'] 	= '';
        $data['pm_contract_duration'] 		= '';
        $data['vendor'] 					= '';
        $data['address'] 					= '';
        $data['pm_information'] 			= '';
        $data['emergency_contact'] 			= '';
        $data['attachment'] 				= '';
        //$data['soc_id']                = '';
        if ($id) {
            $this->sma->checkPermissions('edit');
            $data['project'] = $project = $this->Project_model->get($id);
            if (!$project) {
                $this->session->set_flashdata('error', lang('Project_Not_found'));   
                redirect('admin/Project');
            }
            $data['id'] 			         = $project->id;
            $data['Name']		             = $project->Name;
            $data['developer']               = $project->developer;
            $data['project_type']            = json_decode($project->project_type);
            $data['start_date']              = $project->start_date;
            $data['project_completion_date'] = $project->project_completion_date;
            $data['Project_area']            = $project->Project_area;
            $data['shared_public_area']      = $project->shared_public_area;
            $data['planned_units']           = $project->planned_units;
            $data['planned_floors']          = $project->planned_floors;
			$data['Planned_building']          = $project->planned_building;
            $data['legal_descrioption']      = $project->legal_descrioption;
            $data['legal_document']          = json_decode($project->legal_document);
            $data['project_status']          = $project->project_status;
            $data['facilites']               = json_decode($project->facilites);
            $data['contractors']             = json_decode($project->contractors);
            $data['pm_contract_start_date']  = $project->pm_contract_start_date;
            $data['pm_contract_duration']    = $project->pm_contract_duration;
            $data['vendor'] 				 = json_decode($project->vendor);
            $data['address']                 = $project->address;
            $data['pm_information']          = $project->pm_information;
            $data['emergency_contact']       = $project->emergency_contact;
            $data['attachment']              = $project->attachment;
            $data['soc_id']                  = json_decode($project->Project_stages);
            $data['projectStages']           = $this->Project_model->getProjectStages(json_decode($project->Project_stages));
        }
        $this->form_validation->set_rules('Name', 'lang:Name', 'trim|required');
        $this->form_validation->set_rules('Start_date', 'lang:Start_date', 'trim|required');
        $this->form_validation->set_rules('Project_area', 'lang:Project_area', 'trim|required');
        if ($this->form_validation->run() == false) {
            $this->render_admin('Project/form', $data);
        } else {
            foreach ($_FILES['legal_doc']['name'] as $key => $image) {
                $config['upload_path'] = 'uploads/project/legal_doc/';
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
                foreach (json_decode($service->other_docpath) as $path) {
                    $otherdoc[] = $path;
                }
                $save['legal_document'] = !empty($otherdoc) ? json_encode($otherdoc) : null;
            }
            if (!empty($_FILES['handbook']['name'])) {
                $config['upload_path'] = 'uploads/project/';
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
            $save['id']                    = $this->input->post('id');
            $save['Name']                  = $this->input->post('Name');
            $save['developer']             = $this->input->post('developer');
            $save['project_type']          = json_encode($this->input->post('projecttype'));
            $save['start_date']            = $this->input->post('Start_date');
            $save['project_completion_date'] = $this->input->post('complete_date');
            $save['Project_area']           = $this->input->post('Project_area');
            $save['shared_public_area']     = $this->input->post('shared_public_area');
            $save['planned_units']          = $this->input->post('Planned_unit');
            $save['planned_floors']         = $this->input->post('Planned_floors');
			$save['planned_building']       = $this->input->post('Planned_building');
            $save['legal_descrioption']     = $this->input->post('legaldescription');
            $save['project_status']         = $this->input->post('projectstatus');
            $save['facilites']              = json_encode($this->input->post('facilities'));
            $save['contractors']            = json_encode($this->input->post('contractors'));
            $save['pm_contract_start_date'] = $this->input->post('project_start_date');
            $save['pm_contract_duration']   = $this->input->post('contract_duration');
            $save['vendor']                 = json_encode($this->input->post('vendor'));
            $save['address']                = $this->input->post('address');
            $save['pm_information']         = $this->input->post('pm_information');
            $save['emergency_contact']      = $this->input->post('emergency_contact');
            $save['Project_stages']         = json_encode($this->input->post('soc'));
            $this->Project_model->save($save);
            if ($id) {
                $this->session->set_flashdata('message', lang('Project_Updated'));
            } else {
                $this->session->set_flashdata('message', lang('Project_Saved'));
            }
            redirect('admin/Project');
        }
    }
    public function delete($id = false)
    {
        if ($id) {
            $project = $this->Project_model->projectIfexists($id);
            if (!$project) {
                $this->session->set_flashdata('error', lang('Project_unable_to_delete'));
                redirect('admin/Project');
            } else {
                $delete = $this->Project_model->delete($id);
                $this->session->set_flashdata('message', lang('Project_Deleted'));
                redirect('admin/Project');
            }
        } else {
            $this->session->set_flashdata('error', lang('Project_unable_to_delete'));
            redirect('admin/Project');
        }
    }
	function gettask($projectid){
		 $actions = "<div class=\"text-center\">";
         $actions .= "<a href='" . base_url('admin/Task/view/$1') . "'  class='tip' ><i class=\"fa fa-eye\"></i></a>";
         $actions .= "</div>";
            $this->load->library('datatables');
            $this->datatables
            ->select("task.id,taskName,project.Name project,soc.Name soc,task.start_date,task.due_date,status", FALSE)
            ->from("task")
			->join("project","project.id=task.project_id","left")
			->join("soc","soc.id=task.stage_id","left")
			->where("task.soft_delete",0)
			->where("task.project_id",$projectid)
            ->add_column("Actions", $actions, "task.id");
	         echo $this->datatables->generate();
	}

    public function stage_approval()
    {
        $this->sma->checkPermissions();
        $admin = $this->session->userdata('admin');
        $data['page_title'] = lang('Project');
        $this->render_admin('Project/stage_approval//list', $data);
    }
    public function getStageApproval()
    {
        $actions = "<div class=\"text-center\">";
        $actions .= " <a href='" . base_url('admin/Project/approvedform/$1') . "'  class='tip' ><i class=\"fa fa-edit\"></i></a> ";
        $actions .= "</div>";
        $this->load->library('datatables');
        $this->datatables
            ->select("id,Name,project_status,Start_date,CONCAT(Project_area,' Sqm')Project_area,Planned_floors,Planned_units", false)
            ->from("project")
            ->where("soft_delete", 0)
            ->add_column("Actions", $actions, "id");
        echo $this->datatables->generate();
    }
    public function approvedform($id = false)
    {
        $this->sma->checkPermissions();
        $admin = $this->session->userdata('admin');
        $data['page_title'] = lang('stage_approval');
        $data['soc']        = $this->Project_model->get_all_soc();
        $data['id']         = '';
        $data['Name']       = '';
        $data['developer']  = '';
        if ($id) {
            $this->sma->checkPermissions('edit');
            $data['project'] = $project = $this->Project_model->get($id);
            $data['activestage'] = $this->Project_model->getapproval_stages($id);
            if (!$project) {
                $this->session->set_flashdata('error', lang('Project_Not_found'));
                redirect('admin/Project');
            }
            $data['id'] = $project->id;
            $data['projectStages'] = $this->Project_model->getProjectStages(json_decode($project->Project_stages));
        }
        $this->form_validation->set_rules('id', 'lang:id', 'trim|required');
        if ($this->form_validation->run() == false) {
            $this->render_admin('Project/stage_approval/form', $data);
        } else {
            for ($i = 0; $i < count($this->input->post('isApproved')); $i++) {
                if (!empty($_POST['isApproved'][$i])) {
                    $config['upload_path'] = 'uploads/project/approval_doc/';
                    $config['allowed_types'] = '*';
                    $_FILES['file']['name'] = $_FILES['document']['name'][$i];
                    $_FILES['file']['type'] = $_FILES['document']['type'][$i];
                    $_FILES['file']['tmp_name'] = $_FILES['document']['tmp_name'][$i];
                    $_FILES['file']['error'] = $_FILES['document']['error'][$i];
                    $_FILES['file']['size'] = $_FILES['document']['size'][$i];
                    $config['file_name'] =  str_replace(' ', '_',$_FILES['document']['name']);
                    $this->load->library('upload', $config);
                    $this->upload->initialize($config);
                    if ($this->upload->do_upload('file')) {
                        $doc = $this->upload->data();
                        $otherdoc= str_replace(' ', '_', $doc['file_name']);
                    }
                    $save[] = array(
                        'document_path' => !empty($otherdoc) ? $otherdoc : null,
                        'stage_id' => $_POST['projectstages'][$i],
                        'is_approved' => $_POST['isApproved'][$i],
                        'approved_date' => $_POST['approveddate'][$i],
                        'expired_date' => $_POST['expireddate'][$i],
                        'description' => $_POST['description'][$i],
                        'project_id' => $id,
                    );
                }
            }
            $this->Project_model->stage_approval_save($save, $id);
            if ($id) {
                $this->session->set_flashdata('message', lang('Project_Updated'));
            } else {
                $this->session->set_flashdata('message', lang('Project_Saved'));
            }
            redirect('admin/Project/stage_approval');
        }
    }
       function Estimation(){
$admin = $this->session->userdata('admin');
$data['page_title']    = lang('Project_estimation');
$data['Estimation']    = $this->Project_model->getAllEstimationplan();
$this->render_admin('Project/Estimation_list', $data);
}

function Estimation_view($id,$tab=false){
$admin = $this->session->userdata('admin');
$data['projects']= $this->Project_model->get_all();
$data['Materials']= $this->Project_model->getMaterial();
$data['Uoms']= $this->Project_model->getUom();
$data['Laboutypes']= $this->Project_model->getLabour();
$data['Estimation']            =    $project        = $this->Project_model->get($id);
$data['page_title']    = lang('view')." ".lang('Project_estimation') ;
$data['Estimationplan']            =    $Estimationplan        = $this->Project_model->getEstimationPlan($id);
$data['id']                            =$Estimationplan->id;
$data['TaskName']                    =$Estimationplan->TaskName;
$data['project_id']                    =$Estimationplan->project_id;
$data['Project_Stages']                =$this->Project_model->getStage($Estimationplan->Stage_id);
$data['TotalEstimateCost']            =$Estimationplan->TotalEstimateCost;
$data['TotalEstimateLabour']        =$Estimationplan->TotalEstimateLabour;
$data['TotalEstimateTime']            =$Estimationplan->TotalEstimateTime;
$data['TaskLists']                    =$this->Project_model->getTasklistByid($Estimationplan->id);
$data['TaskwiseLabourlists']        =$this->Project_model->getTasklistWiseLabour($Estimationplan->project_id,$Estimationplan->Stage_id);
$data['TaskwiseMateriallists']        =$this->Project_model->getTasklistWiseMaterial($Estimationplan->project_id,$Estimationplan->Stage_id);

$this->render_admin('Project/Estimation_view', $data);
}
function Estimationform($id = false)
{
$data['projects']= $this->Project_model->get_all();
$data['Materials']= $this->Project_model->getMaterial();
$data['Uoms']= $this->Project_model->getUom();
$data['Laboutypes']= $this->Project_model->getLabour();
$admin = $this->session->userdata('admin');
$this->load->helper('form');
$this->load->library('form_validation');
$data['page_title']        = lang('Project_estimation_form');
$data['projecttype']            = $this->Project_model->Get_projecttype();
$data['id']                        = '';
$data['project_id']                = '';
$data['Project_Stages']            = '';
$data['TotalEstimateCost']        = '';
$data['TotalEstimateLabour']    = '';
$data['TotalEstimateTime']        = '';
if ($id){
$data['Estimationplan']            =    $Estimationplan        = $this->Project_model->getEstimationPlan($id);
if (empty($Estimationplan)){
$this->session->set_flashdata('error', lang('ProjectEstimationPlanNotFound'));
redirect('admin/Project/Estimation');
}
$data['id']                    =$Estimationplan->id;
$data['TaskName']                    =$Estimationplan->TaskName;
$data['project_id']                =$Estimationplan->project_id;
$data['Project_Stages']        =$this->Project_model->getStage($Estimationplan->Stage_id);
$data['TotalEstimateCost']        =$Estimationplan->TotalEstimateCost;
$data['TotalEstimateLabour']            =$Estimationplan->TotalEstimateLabour;
$data['TotalEstimateTime']        =$Estimationplan->TotalEstimateTime;
$data['TaskLists']        =$this->Project_model->getTasklistByid($Estimationplan->id);

$data['TaskwiseLabourlists']        =$this->Project_model->getTasklistWiseLabour($Estimationplan->project_id,$Estimationplan->Stage_id);

$data['TaskwiseMateriallists']        =$this->Project_model->getTasklistWiseMaterial($Estimationplan->project_id,$Estimationplan->Stage_id);

}
$this->form_validation->set_rules('project', 'lang:Project', 'trim|required');
$this->form_validation->set_rules('projectstage', 'lang:ProjectStages', 'trim|required');

if ($this->form_validation->run() == FALSE){
$this->render_admin('Project/Estimation_form', $data);
}    else{

$TaskName=$this->input->post('TaskName');
$save['project_id']                    = $this->input->post('project');
$save['Stage_id']                    = $this->input->post('projectstage');
$save['Total_task']                    = count($this->input->post('taskid'));
$save['TotalEstimateCost']            = $this->input->post('Totalcost');
$save['TotalEstimateLabour']        = $this->input->post('Totallabour');
$save['TotalEstimateTime']            = $this->input->post('Totaltimeperiod');
$Cost        = $this->input->post('cost');
$timeperiod        = $this->input->post('timeperiod');
$timetype                = $this->input->post('timetype');
$labourTaskid=$this->input->post('Labourtaskid');
$labourtype=$this->input->post('labourtype');
$noofperson=$this->input->post('noofperson');
$paymentperiod=$this->input->post('paymentperiod');
$materialtaskid=$this->input->post('materialtaskid');
$material=$this->input->post('material');
$Qty=$this->input->post('Qty');
$taskid=$this->input->post('taskid');
$Uom=$this->input->post('uoms');
$this->Project_model->estimaionFormSave($save,$Cost,$timeperiod,$timetype,$labourTaskid,$labourtype,$noofperson,$paymentperiod,$materialtaskid,$material,$Qty,$taskid,$Uom,$TaskName);
if($id){
$this->session->set_flashdata('message', lang('ProjectEstimationPlanUpdated'));
}else{
$this->session->set_flashdata('message', lang('ProjectEstimationPlanSaved'));
}
redirect('admin/Project/Estimation');
}
}
function Estimation_delete($id = false){
if ($id){
$Estimation    = $this->Project_model->getEstimationPlan($id);
if (!$Estimation){
$this->session->set_flashdata('error', lang('ProjectEstimationPlanNotFound'));
redirect('admin/Project/Estimation');
}else{
$delete    = $this->Project_model->projectEstimation_delete($id);
$this->session->set_flashdata('message', lang('Project_estimation_plan_delted'));
redirect('admin/Project/Estimation');
}
}else{
$this->session->set_flashdata('error', lang('ProjectEstimationPlanNotFound'));
redirect('admin/Project/Estimation');
}
}
function downloadDocument($id){
$result=$this->db->get_where('stagewise_approved',array('id'=>$id))->row();
if($result){
$this->load->helper('download');
$file = base_url().'/uploads/Project_doc/Approved_doc/'.$result->Document_path;
$data =  file_get_contents($file);
force_download($result->Document_path, $data);
}
}
function gtProjectStages(){
$project_id=$this->input->post('projectid');
if($project_id){
$projectstageIds=$this->db->get_where('project',array('id'=>$project_id))->row();
$projectStages=$this->Project_model->getProjectStages(json_decode($projectstageIds->Project_stages));
$option='<option>select</option>';
foreach($projectStages as $projectStage){
$option .='<option value="'.$projectStage->id.'">'.$projectStage->Name.'</option>';
}
echo $option;
}
}

function ProjectDevelopment()
{
$admin = $this->session->userdata('admin');
$data['page_title']    = lang('Project_development');
$data['Estimation']    = $this->Project_model->getAllEstimationplan();
$this->render_admin('Project/Project_development_list', $data);
}

function ProjectDevelopment_view($id,$tab=false){
$admin = $this->session->userdata('admin');
$data['projects']= $this->Project_model->get_all();
$data['Materials']= $this->Project_model->getMaterial();
$data['Uoms']                   = $this->Project_model->getUom();
$data['Laboutypes']             = $this->Project_model->getLabour();
$data['Estimation']                =    $project        = $this->Project_model->get($id);
$data['page_title']                = lang('view')." ".lang('Project_development') ;
$data['Estimationplan']            =    $Estimationplan        = $this->Project_model->getEstimationPlan($id);
$data['id']                    =$Estimationplan->id;
$data['TaskName']                =$Estimationplan->TaskName;
$data['project_id']                =$Estimationplan->project_id;
$data['Project_Stages']            =$this->Project_model->getStage($Estimationplan->Stage_id);
$data['TotalEstimateCost']        =$Estimationplan->TotalEstimateCost;
$data['TotalEstimateLabour']    =$Estimationplan->TotalEstimateLabour;
$data['TotalEstimateTime']        =$Estimationplan->TotalEstimateTime;
$data['TaskLists']                =$this->Project_model->getTasklistByid($Estimationplan->id);
$data['TaskwiseLabourlists']    =$this->Project_model->getTasklistWiseLabour($Estimationplan->project_id,$Estimationplan->Stage_id);
$data['TaskwiseMateriallists']  =$this->Project_model->getTasklistWiseMaterial($Estimationplan->project_id,$Estimationplan->Stage_id);
$this->render_admin('Project/Project_development_view', $data);
}
function ProjectDevelopmentform($id = false){
$data['projects']= $this->Project_model->get_all();
$data['Materials']= $this->Project_model->getMaterial();
$data['Uoms']= $this->Project_model->getUom();
$data['Laboutypes']= $this->Project_model->getLabour();
$admin = $this->session->userdata('admin');
$this->load->helper('form');
$this->load->library('form_validation');
$data['page_title']        = lang('Project_development');
$data['projecttype']            = $this->Project_model->Get_projecttype();
$data['id']                    = '';
$data['project_id']                = '';
$data['Project_Stages']        = '';
$data['TotalEstimateCost']        = '';
$data['TotalEstimateLabour']            = '';
$data['TotalEstimateTime']        = '';
if ($id)
{
$data['Estimationplan']            =    $Estimationplan        = $this->Project_model->getEstimationPlan($id);
if (empty($Estimationplan))
{
$this->session->set_flashdata('error', lang('ProjectEstimationPlanNotFound'));
redirect('admin/Project/Estimation');
}
$data['id']                        =$Estimationplan->id;
$data['TaskName']                =$Estimationplan->TaskName;
$data['project_id']                =$Estimationplan->project_id;
$data['Project_Stages']            =$this->Project_model->getStage($Estimationplan->Stage_id);
$data['TotalEstimateCost']        =$Estimationplan->TotalEstimateCost;
$data['TotalEstimateLabour']    =$Estimationplan->TotalEstimateLabour;
$data['TotalEstimateTime']        =$Estimationplan->TotalEstimateTime;
$data['TaskLists']                =$this->Project_model->getTasklistByid($Estimationplan->id);
$data['TaskwiseLabourlists']    =$this->Project_model->getTasklistWiseLabour($Estimationplan->project_id,$Estimationplan->Stage_id);
$data['TaskwiseMateriallists']    =$this->Project_model->getTasklistWiseMaterial($Estimationplan->project_id,$Estimationplan->Stage_id);
}
//$this->form_validation->set_rules('project', 'lang:Project', 'trim|required');
$this->form_validation->set_rules('projectstage', 'lang:ProjectStages', 'trim|required');
if ($this->form_validation->run() == FALSE)
{
$this->render_admin('Project/Project_development_form', $data);
}
else
{
$id=$this->input->post('id');
$save['ActualCost']                = $this->input->post('Totalcost');
$save['OverlayCost']            = $this->input->post('Overlaycost');
$save['ActualLabour']            = $this->input->post('Totallabour');
$save['OverlayLabour']            = $this->input->post('Overlaylabour');
$save['ActualTime']                  = $this->input->post('Totaltimeperiod');
$save['OverLayTime']            = $this->input->post('Overlayperiod');
$taskid         =$this->input->post('taskid');
$Cost            = $this->input->post('cost');
$timeperiod        = $this->input->post('timeperiod');
$timetype                = $this->input->post('timetype');
$labourTaskid=$this->input->post('Labourtaskid');
$labourtype=$this->input->post('labourtype');
$noofperson=$this->input->post('noofperson');
$paymentperiod=$this->input->post('paymentperiod');
$materialtaskid=$this->input->post('materialtaskid');
$material=$this->input->post('material');
$Qty=$this->input->post('Qty');
$Uom=$this->input->post('uoms');
$this->Project_model->devlopementFormSave($save,$Cost,$timeperiod,$timetype,$labourTaskid,$labourtype,$noofperson,$paymentperiod,$materialtaskid,$material,$Qty,$taskid,$Uom,$id);
if($id){
$this->session->set_flashdata('message', lang('ProjectEstimationPlanUpdated'));
}else{
$this->session->set_flashdata('message', lang('ProjectEstimationPlanSaved'));
}
redirect('admin/Project/ProjectDevelopment');
}
}
function ProjectProgress()
{
$admin = $this->session->userdata('admin');
$data['page_title']    = lang('Project_planner');
$data['Project']    = $this->Project_model->getActiveProject();
$this->render_admin('Project/Project_progress_list', $data);
}
function ProjectProgressView($id,$tab=false){
$data['page_title']    = lang('Project_planner');
$data['id']    = $id;
$data['projectsstages']= $this->Project_model->getProjectActiveStages($id);
$this->render_admin('Project/Project_progess_view', $data);
}
function ProjectProgressPlanner($id,$Projectstageid){
$data['page_title']    = lang('Project_Progress_planner');
$data['id']    = $id;
$data['Projectstageid']    = $Projectstageid;
$data['tasklist']= $this->Project_model->getTasklist($id,$Projectstageid);
if($this->input->post('add')){
$save['title']=$this->input->post('title');
$save['Task_id']=$this->input->post('Tasklist');
$save['color']=$this->input->post('color');
$save['start']=$this->input->post('start').' '.$this->input->post('startTime');
$save['end']=$this->input->post('end').' '.$this->input->post('endTime');
$save['Actual_cost']=$this->input->post('Cost');
$save['Actual_labour']=$this->input->post('labour');
$save['Actual_time']=$this->input->post('Timeline');
$save['Timelinetype']=$this->input->post('Timelinetype');
$save['color']=$this->input->post('color');
$save['ProjectStage_id']=$Projectstageid;
$save['Project_id']=$id;
$save['type']='E';
$this->Project_model->addPlannerTask($save);
}
if($this->input->post('id')){
$save['title']=$this->input->post('title');
$save['Task_id']=$this->input->post('Tasklist');
$save['color']=$this->input->post('color');
$save['start']=$this->input->post('start').' '.$this->input->post('startTime');
$save['end']=$this->input->post('end').' '.$this->input->post('endTime');
$save['Actual_cost']=$this->input->post('Cost');
$save['Actual_labour']=$this->input->post('labour');
$save['Actual_time']=$this->input->post('Timeline');
$save['Timelinetype']=$this->input->post('Timelinetype');
$save['color']=$this->input->post('color');
$save['ProjectStage_id']=$Projectstageid;
$save['Project_id']=$id;
$save['type']='E';
$delete=$this->input->post('delete');
$taskeditid=$this->input->post('id');
$this->Project_model->updateplannertask($save,$taskeditid,$delete);
}
if(isset($_GET['start'])&&isset($_GET['end'])){
$begin = new DateTime(date('Y-m-d',strtotime($_GET['start'])));
$end = new DateTime(date('Y-m-d',strtotime('+1 day',strtotime($_GET['end']))));
$begin =$begin->format('d/m/Y');
$end = $end->format('d/m/Y');
$task=$this->Project_model->getTask($id,$Projectstageid,$begin,$end);
echo json_encode($task);
die;
}
$this->render_admin('Project/Project_progess_Planner', $data);
}
function download_Attachment($id = null)  {
$projectattachment = $this->Project_model->get($id);
$Attachment = $projectattachment->attachment;
$file = base_url().'uploads/project/'.$Attachment;
$data =  file_get_contents($file);
force_download($servicesattachment->attachment_path, $data);
}
function download_otherdoc($name){
$file = base_url().'uploads/project/legal_doc/'.$name;
$data =  file_get_contents($file);
force_download($servicesattachment->attachment_path, $data);
}
function doc_delete(){
$doc= $this->input->post('doc');
$id=$this->input->post('projectid');
$projectattachment = $this->Project_model->get($id);
$otherdoc=json_decode(($projectattachment->legal_document));
if (($key = array_search($doc, $otherdoc)) !== false) {
unset($otherdoc[$key]);
$this->db->where('id',$id);
$this->db->update('project',array('legal_document'=>json_encode($otherdoc)));
echo $this->db->last_query();
if(file_exists(BASEPATH.'../uploads/project/legal_doc/'.$doc)){
unlink(BASEPATH.'../uploads/project/legal_doc/'.$doc);
}
}
return true;
}
function project_chart($projectid){
$data['page_title']=lang('Project_buildingWise_completion');
$data['projectid']=$projectid;
$data['chart_data']=$this->Project_model->getBuildingWiseTask($projectid);
$this->render_admin('Project/project_chart', $data);
}

}
