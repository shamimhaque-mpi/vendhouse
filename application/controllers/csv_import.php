<?php
class Csv_import extends Admin_Controller{
    function __construct() {
       parent::__construct();

        $this->load->model('action');
        $this->load->library("csvreader");
        $this->data['db_name']=config_item('my_database');
    }

    public function index(){
        $this->data['meta_title'] = 'CSV Import';
        $this->data['active'] = 'data-target="backup_menu"';
        $this->data['subMenu'] = 'data-target="import"';
        $this->data['confirmation'] = $this->data['allTables']  = NULL;

        $this->data['allTables'] = $this->action->readAllTable($this->data['db_name']);

        if(isset($_POST['upload'])){
            $msg = $this->importData();
            $this->session->set_flashdata("confirmation",$msg);
            redirect("csv_import","refresh");
        }

        $this->load->view($this->data['privilege'].'/includes/header', $this->data);
        $this->load->view($this->data['privilege'].'/includes/aside', $this->data);
        $this->load->view($this->data['privilege'].'/includes/headermenu', $this->data);
        $this->load->view('components/data_backup/data_backup_nav', $this->data);
        $this->load->view('components/data_backup/csv_import', $this->data);
        $this->load->view($this->data['privilege'].'/includes/footer', $this->data);
    }

    private function importData(){
        $message = "";
        $table = $_POST['table'];
        $fileData = $this->csvreader->parse_file($_FILES["datafile"]["tmp_name"]);

        foreach ($fileData as $key => $value) {
           $status = $this->action->add($table,$value);
        }

      if($status == "success"){
            $options = array(
                'title'  => "success",
                'emit'   => "CSV File Successfully Imported into your Database!",
                'btn'    => true
            );
          $message  = message('success',$options);
       }else{
         $options = array(
             'title'  => "warning",
             'emit'   => "An Error!Please try Again.",
             'btn'    => true
         );
       $message  = message('warning',$options);
      }
      return $message;
    }

}
