<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class home extends CI_Controller
{
   
    public function __construct()
    {
        header("content-type: text/html; charset=utf-8");
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->library('session');
   
		$this->load->model('api/common');
        $this->load->model('admin/admin');
	
		$this->load->helper('cookie');
		$this->load->helper('form');
		$this->load->helper('url');
		$this->load->helper('security');
		$this->load->library('user_agent');
		$this->load->library('image_lib');
		$this->load->library('form_validation');
        $this->load->helper('xcrud');
        $this->load->library('session');
        $this->load->model('admin/admin');
       // $this->load->model('user/homes');
	
       
    }
    

    public function index()
    {
      
        $session = $this->session->userdata('admin_id');
        if(empty($session))
        {
            redirect(site_url('admin/home/login'), 'refresh');
        }
       
        
        $xcrud = Xcrud::get_instance();

        $xcrud->table('lows');

        $xcrud->order_by('law_id','desc');
        

        
      

        //$xcrud->highlight('status','=','5','red');
     
        //$xcrud->unset_print();
        //$xcrud->change_type('status','select','',array('values'=>array('0'=>'Pending','1'=>'Started','2'=>'Confirmed','3'=>'Deleted','4'=>'Closed','5'=>'Missed')));
        
        $data['content'] = $xcrud->render();
      
        $this->load->view('admin/tableview', $data);    
    }
     
    


    public function login()
    {
        if( $this->input->server('REQUEST_METHOD') == 'POST')
        {
            $logindata = $this->input->post();
            $this->form_validation->set_rules('email', 'Email', 'required');
            $this->form_validation->set_rules('password', 'Password', 'required');
            if ($this->form_validation->run() == FALSE)
            {
                $data['errormsg'] = '';
                $this->load->view('admin/login',$data);    
            }
            else
            {
                 $result = $this->admin->checkauth($logindata['email'],$logindata['password']);

                    //echo '<pre>';print_r($result);die;
                        if(count($result) > 0)  //isset($result)
                        {
                            
                            $this->session->set_userdata('admin_id', $result[0]['admin_id']); // $_SESSION['admin_id'] = $result[0]['admin_id']
                            
                            $this->session->set_userdata('lastname', $result[0]['admin_name']);
                            $this->session->set_userdata('email', $result[0]['email']);
                            $this->session->set_userdata('status', '1');
                          
                            redirect(site_url('admin/home'), 'refresh');
                            //echo "hello";
                            //exit;                
                        }
                        else
                        {
                            $data['errormsg'] = 'Username or password is not correct.';
                            $data['email'] = $logindata['email'];
                            $this->load->view('admin/login',$data); 
                        }
            }
        }
        else
        {
            $data['title']="Admin Login | Digital Lawyer";
            $this->load->view('admin/login',$data); 
        }
    }

    public function allq()
    {
         $session = $this->session->userdata('admin_id');
        if(empty($session))
        {
            redirect(site_url('admin/home/login'), 'refresh');
        }
       
        
        $xcrud = Xcrud::get_instance();

        $xcrud->table('quetions');

        $xcrud->order_by('q_id','desc');
        

        
      

        //$xcrud->highlight('status','=','5','red');
     
        //$xcrud->unset_print();
        //$xcrud->change_type('status','select','',array('values'=>array('0'=>'Pending','1'=>'Started','2'=>'Confirmed','3'=>'Deleted','4'=>'Closed','5'=>'Missed')));
        
        $data['content'] = $xcrud->render();
      
        $this->load->view('admin/tableview', $data);    

    }

    public function allans()
    {
         $session = $this->session->userdata('admin_id');
        if(empty($session))
        {
            redirect(site_url('admin/home/login'), 'refresh');
        }
       
        
        $xcrud = Xcrud::get_instance();

        $xcrud->table('answers');

        $xcrud->order_by('a_id','desc');
        

        
      

        //$xcrud->highlight('status','=','5','red');
     
        //$xcrud->unset_print();
        //$xcrud->change_type('status','select','',array('values'=>array('0'=>'Pending','1'=>'Started','2'=>'Confirmed','3'=>'Deleted','4'=>'Closed','5'=>'Missed')));
        
        $data['content'] = $xcrud->render();
      
        $this->load->view('admin/tableview', $data);    

    }
    public function feedback()
    {
         $session = $this->session->userdata('admin_id');
        if(empty($session))
        {
            redirect(site_url('admin/home/login'), 'refresh');
        }
       
        
        $xcrud = Xcrud::get_instance();

        $xcrud->table('contact');

        $xcrud->order_by('contact_id','desc');
        

        
      

        //$xcrud->highlight('status','=','5','red');
     
        //$xcrud->unset_print();
        //$xcrud->change_type('status','select','',array('values'=>array('0'=>'Pending','1'=>'Started','2'=>'Confirmed','3'=>'Deleted','4'=>'Closed','5'=>'Missed')));
        
        $data['content'] = $xcrud->render();
      
        $this->load->view('admin/tableview', $data);    

    }
      public function laywerslist()
    {
         $session = $this->session->userdata('admin_id');
        if(empty($session))
        {
            redirect(site_url('admin/home/login'), 'refresh');
        }
       
        
        $xcrud = Xcrud::get_instance();

        $xcrud->table('lawyers');

        $xcrud->order_by('lawyer_id','desc');
        

        
      

        //$xcrud->highlight('status','=','5','red');
     
        //$xcrud->unset_print();
        //$xcrud->change_type('status','select','',array('values'=>array('0'=>'Pending','1'=>'Started','2'=>'Confirmed','3'=>'Deleted','4'=>'Closed','5'=>'Missed')));
        
        $data['content'] = $xcrud->render();
      
        $this->load->view('admin/tableview', $data);    

    }
          public function lawcat()
    {
         $session = $this->session->userdata('admin_id');
        if(empty($session))
        {
            redirect(site_url('admin/home/login'), 'refresh');
        }
       
        
        $xcrud = Xcrud::get_instance();

        $xcrud->table('low_category');

        $xcrud->order_by('category_id','desc');
        

        
      

        //$xcrud->highlight('status','=','5','red');
     
        //$xcrud->unset_print();
        //$xcrud->change_type('status','select','',array('values'=>array('0'=>'Pending','1'=>'Started','2'=>'Confirmed','3'=>'Deleted','4'=>'Closed','5'=>'Missed')));
        
        $data['content'] = $xcrud->render();
      
        $this->load->view('admin/tableview', $data);    

    }
 public function sublist()
    {
         $session = $this->session->userdata('admin_id');
        if(empty($session))
        {
            redirect(site_url('admin/home/login'), 'refresh');
        }
       
        
        $xcrud = Xcrud::get_instance();

        $xcrud->table('subscribers');

        $xcrud->order_by('sub_id','desc');
        

        
      

        //$xcrud->highlight('status','=','5','red');
     
        //$xcrud->unset_print();
        //$xcrud->change_type('status','select','',array('values'=>array('0'=>'Pending','1'=>'Started','2'=>'Confirmed','3'=>'Deleted','4'=>'Closed','5'=>'Missed')));
        
        $data['content'] = $xcrud->render();
      
        $this->load->view('admin/tableview', $data);    

    }

}

?>