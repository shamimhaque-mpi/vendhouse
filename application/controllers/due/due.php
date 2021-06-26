 <?php

class Due extends Admin_Controller {

    function __construct() {
        parent::__construct();

        $this->load->model('action');
    }

    public function index() {
        $this->data['meta_title'] = 'Due';
        $this->data['active']     = 'data-target="report_menu"';
        $this->data['subMenu']    = 'data-target="due"';
        $this->data['result']     = null;

        $this->data['result'] = $this->action->readGroupBy('sale', 'voucher_number');
        
        
        if(isset($_POST['show'])){
            $this->data['result'] = $this->searchSale();
        }
        

        $this->load->view($this->data['privilege'].'/includes/header', $this->data);
        $this->load->view($this->data['privilege'].'/includes/aside', $this->data);
        $this->load->view($this->data['privilege'].'/includes/headermenu', $this->data);
        $this->load->view('components/due/due-nav', $this->data);
        $this->load->view('components/due/alldue', $this->data);
        $this->load->view($this->data['privilege'].'/includes/footer');
    }

    private function searchSale(){
        $where = array('due >' => 0);

        foreach($_POST['search'] as $key => $val){
            if($val != null){
                $where[$key] = $val;
            }
        }

        /*foreach($_POST['date'] as $key => $val){
            if($val != null && $key == 'from'){
                $where['date >='] = $val;
            }

            if($val != null && $key == 'to'){
                $where['date <='] = $val;
            }
        }*/

        $where['quantity >'] =  0;

        return $this->action->readGroupBy('sale', 'voucher_number', $where);
    }
    
    
    public function dueCollect()
    {
        $this->data['meta_title'] = 'Due Collect';
        $this->data['active']     = 'data-target="report_menu"';
        $this->data['subMenu']    = 'data-target="due"';
        $this->data['result']     = null;
        
        $where = array('voucher_number' => $this->input->get('vno'));
        $this->data['result'] = $this->action->read('sale', $where);
        
        
        if($this->input->post('save')){
            // Save data to due_collection table
            $duecollectionData = array(
                "date"          => date('Y-m-d'),
                "voucher_number"=> $this->input->post('voucher'),
                "name"          => $this->input->post('name'),
                "mobile"        => $this->input->post('mobile'),
                "grand_total"   => $this->input->post('grand_total'),
                "paid"          => $this->input->post('paid'),
                "amount"        => $this->input->post('amount'),
                "due"           => $this->input->post('due')
                );
                
                $this->action->add('due_collection',$duecollectionData);
            // Save data end here
            
            
            // Update sale table data
            
            $saleUpdateData = array(
                "paid" => ( $this->input->post('paid') + $this->input->post('amount') ),
                "due"  => $this->input->post('due')
                );
            $where = array("voucher_number" => $this->input->post('voucher'));
            $this->action->update('sale',$saleUpdateData,$where);
            
            
            $options = array(
                'title'=>'success',
                'emit' =>'Due Successfully Collected!',
                'btn'  =>true
            );

            $this->data['confirmation'] = message('success', $options);
            $this->session->set_flashdata('confirmation', $this->data['confirmation']);
            redirect('due/due/dueCollect?vno='.$this->input->post('voucher'),'refresh');
        }
        
        $this->load->view($this->data['privilege'].'/includes/header', $this->data);
        $this->load->view($this->data['privilege'].'/includes/aside', $this->data);
        $this->load->view($this->data['privilege'].'/includes/headermenu', $this->data);
        $this->load->view('components/due/due-nav', $this->data);
        $this->load->view('components/due/due_collect', $this->data);
        $this->load->view($this->data['privilege'].'/includes/footer');
    }
    
    
    public function dueReport(){
        
        $this->data['meta_title'] = 'Due Collect';
        $this->data['active']     = 'data-target="report_menu"';
        $this->data['subMenu']    = 'data-target="due-report"';
        $this->data['result']     = null;
        
        
        $where = array();
        if($this->input->post('show')){
            
            foreach($_POST['date'] as $key => $val){
                
                if($val != null && $key == 'from'){
                    $where['date >='] = $val;
                }
                
                if($val != null && $key == 'to'){
                    $where['date <='] = $val;
                }
            }
            
        }
        
        $this->data['result'] = $this->action->read('due_collection',$where);
        
        
        $this->load->view($this->data['privilege'].'/includes/header', $this->data);
        $this->load->view($this->data['privilege'].'/includes/aside', $this->data);
        $this->load->view($this->data['privilege'].'/includes/headermenu', $this->data);
        $this->load->view('components/due/due-nav', $this->data);
        $this->load->view('components/due/due_report', $this->data);
        $this->load->view($this->data['privilege'].'/includes/footer');
        
    }
    
    
    
    
    
    
    

}
