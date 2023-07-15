<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_Menu extends CI_Controller {

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
	 **/
     /** ---------------------------------------------- Menu----------------------------------------------**/


     public function __construct(){
        parent::__construct();   

        $this->load->helper('date');
        $this->load->helper('file');        
        $this->load->model('M_Menu');
        // $this->load->library('encrypt');    
                  
      }


	public function Index()
	{

        // // $data['Menu'] = $this->M_Menu->Tampil_Data();
        $this->load->view('templates/header'); //Tampil header
		$this->load->view('templates/sidebar'); //Tampil Sidebar
		// // $this->load->view('Menu/V_Menu',$data); // Tampil data
        $this->load->view('Menu/V_Menu'); // Tampil data
        $this->load->view('templates/footer'); // Tampil footer
               
    }


     // Satu table tanpa where
     function view_data()
     {
        
        $tables = "a_menu";         
       $search = array('id_menu','menu_id','description');
         // jika memakai IS NULL pada where sql
         $isWhere = null;
         // $isWhere = 'artikel.deleted_at IS NULL';
         header('Content-Type: application/json');
         echo $this->M_Menu->get_tables($tables,$search,$isWhere);
         
     }

    // Satu table dengan where
    function view_data_where()
    {

        $tables = "a_menu";         
       $search = array('id_menu','menu_id','description');
        
        if($_POST['searchByFromdate']==''||$_POST['searchByTodate']==''){
            $where  = array('transaction_date >'=>'2020-01-01');              
        }else{
            $where  = array('transaction_date >' => $_POST['searchByFromdate'],'transaction_date <' => $_POST['searchByTodate']);
        };
        
        // jika memakai IS NULL pada where sql
        $isWhere = null;
        // $isWhere = 'artikel.deleted_at IS NULL';
        header('Content-Type: application/json');
        echo $this->M_Menu->get_tables_where($tables,$search,$where,$isWhere);
        
    }

    // Multy table / Query
    function view_data_query()
    {

        $query  = "SELECT kategori.nama_kategori AS nama_kategori, subkat.* FROM subkat 
                    JOIN kategori ON subkat.id_kategori = kategori.id_kategori";
        $search = array('nama_kategori','subkat','tgl_add');
        $where  = null; 
        // $where  = array('nama_kategori' => 'Tutorial');
        
        // jika memakai IS NULL pada where sql
        $isWhere = null;
        // $isWhere = 'artikel.deleted_at IS NULL';
        header('Content-Type: application/json');
        echo $this->M_Datatables->get_tables_query($query,$search,$where,$isWhere);

    }


    //    if($this->session->userdata('authenticated')){ // Jika user sudah login (Session authenticated ditemukan)
    //     }else{
    //     redirect('auth');
    //     }

    public function ajax_add()
	{

        // ********************* 0. Generate nomor transaksi  *********************          
        $mdate="WT".mdate('%Y%m',time());        
        $hdrid2=$this->M_Menu->Max_data($mdate,'a_menu')->row();        
        if ($hdrid2->id_menu==NULL){
            // Jika belum ada
           $hdrid3=$mdate."001";
        }else{
           $hdrid3=$hdrid2->id_menu;
           // Jika sudah ada maka naik 1 level
           $hdrid3="WT".(intval(substr($hdrid3,2,10))+1);
        }
                
        // ********************* 1. Set hdrid  *********************
        $post_data2=array('id_menu'=>$hdrid3);

         // ********************* 2. Collect all data post *********************     
        $post_data = $this->input->post();   

        $post_data3=array('transaction_date'=>mdate('%Y%m%d',time()));
        $msg = "success save";

        // ********************** 4. Upload file jika ada  *********************   
        if(!empty($_FILES['file']['name']))
        {
          
            $config['upload_path'] = './assets/upload';   
            $config['allowed_types'] = 'gif|jpg|png|pdf';         
            $config['overwrite'] = True;          
            $config['max_size']  = '1000000';
            $config['max_width']  = '1024';
            $config['max_height']  = '768';
            $config['file_name']=$hdrid3;
            $this->load->library('upload', $config);

            $post_data3=array('keterangan'=>$hdrid3);

            if ( ! $this->upload->do_upload('file')){
                // $status = "error";
                 $msg = $this->upload->display_errors();
            }
            else{
                 $msg = "success upload";

                // $dataupload = $this->upload->data();
                // $status = "success";
                // $msg = $dataupload['file_name']." berhasil diupload";              
                // $this->M_wiretransfer_approver->update_file_attach($hdrid,$field,$dataupload['file_name']);

            }

        }else{

            
        }
        
           
        // ********************* 3. Merge data post *********************        
        //$post_datamerge=array_merge($post_data,$post_data2);

        // ********************** 4. Simpan data     *********************

        $post_datamerge=array_merge($post_data,$post_data2,$post_data3);
        
        $this->M_Menu->Input_Data($post_datamerge,'a_menu');

        $data['status']= $msg;

        // return value array
        $this->output->set_content_type('application/json')->set_output(json_encode($data));

    }
    
    
    public function ajax_update()
	{

         // ********************* 1. Collect data post *********************
        $post_data = $this->input->post();
        $id_menu=$this->input->post('id_menu');
       
        $msg = "success Update";

        // ********************** 4. Upload file jika ada  *********************   
        if(!empty($_FILES['file']['name']))
        {
          
            $config['upload_path'] = './assets/upload';   
            $config['allowed_types'] = 'gif|jpg|png|pdf';         
            $config['overwrite'] = True;          
            $config['max_size']  = '1000000';
            $config['max_width']  = '1024';
            $config['max_height']  = '768';
            $config['file_name']=$id_menu;
            $this->load->library('upload', $config);

            $post_data3=array('keterangan'=>$id_menu);

            if ( ! $this->upload->do_upload('file')){
                // $status = "error";
                 $msg = $this->upload->display_errors();
            }
            else{
                 $msg = "success upload";

                // $dataupload = $this->upload->data();
                // $status = "success";
                // $msg = $dataupload['file_name']." berhasil diupload";              
                // $this->M_wiretransfer_approver->update_file_attach($id_menu,$field,$dataupload['file_name']);

            }

        }

        
         // ********************* 3. Merge data post *********************
        // $post_datamerge=array_merge($post_data,$post_data2);
        $post_datamerge=array_merge($post_data,$post_data);

        // ********************** 4. Simpan data ************************
        
        $where = array('id_menu' => $id_menu);        
        $this->M_Menu->Update_Data($where,$post_datamerge,'a_menu');


        $data['status']="berhasil update";

        // return value array
        $this->output->set_content_type('application/json')->set_output(json_encode($data));

    }

    public function ajax_delete()
	{

         
        $where = array('id_menu' => $this->input->post('id_menu'));
        $this->M_Menu->Delete_Data($where,'a_menu');
        $data['status']="berhasil dihapus";
        // return value array
        $this->output->set_content_type('application/json')->set_output(json_encode($data));

    }
    

    function ajax_getbyid_menu(){      

        $id_menu=$this->input->get('id_menu');
        $data=$this->M_Menu->ajax_getbyid_menu($id_menu,'a_menu')->row();
        echo json_encode($data);

    }

    
    /** ---------------------------------------------- /Close controller----------------------------------------------**/

}
