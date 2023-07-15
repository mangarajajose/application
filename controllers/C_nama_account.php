<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_nama_account extends CI_Controller {

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
     /** ---------------------------------------------- nama_account----------------------------------------------**/

     public function __construct(){
        parent::__construct();   

        if ($this->session->userdata('user_name')=="") { // Jika username kosong
			redirect('Auth'); // Kembali ke halaman Auth
		}

        $this->load->helper('date'); // Load helper date fungsi tanggal
        $this->load->helper('file'); // Load helper file fungsi upload         
        $this->load->model('M_nama_account'); // Load model
        $this->load->model('UserModel');  //untuk load user model hak akses menu     
        $this->load->library('encryption');  //untuk encryp data
        // $this->load->library('encrypt');    

        // Cari hak akses by controller
	    $Hak_akses = $this->UserModel->get_controller_access($this->session->userdata('role_id'),'C_nama_account'); 
	    if($Hak_akses->found!='found') {
		redirect('Auth'); // Kembali ke halaman Auth
	}
                  
      }

	public function Index()
	{

        $data['groups'] = $this->M_nama_account->get_tb_nama_account();  // Menarik data dan menampung nya menjadi groups
        // var_dump($data);
        // die;
        $menu_code = $this->input->get('var');  // Decrypt menu ID   untuk dekrip menu   
        $menu_name = $this->input->get('var2');  // Decrypt menu ID   untuk dekrip menu name  
        $data['menu_name'] =  $menu_name; // Deklarasi menu_name dan mengirim nya ke view
        $data_akses['menu_akses']=$this->UserModel->get_menu_access($this->session->userdata('role_id'));  //Menu akses untuk munculkan menu   
        $data['hak_akses']=$this->UserModel->get_hak_access($this->session->userdata('role_id'), $menu_code); //button akses(Add,Adit,View,Delete,Import,Export)
        $this->load->view('templates/header'); //Tampil header
		$this->load->view('templates/sidebar',$data_akses); //Tampil Sidebar
		// // $this->load->view('nama_account/V_nama_account',$data); // Tampil data
        $this->load->view('nama_account/V_nama_account',$data); // Tampil data
        $this->load->view('templates/footer'); // Tampil footer
               
    }

     // Satu table tanpa where
     function view_data()
     {
        
        $tables = "tb_nama_account";  // Table yang digunakan       
        $search = array('hdrid','nama_account');  // Column column yang akan muncul di feature search datatable




         // jika memakai IS NULL pada where sql
         $isWhere = null;  // jika memakai IS NULL pada where sql
         // $isWhere = 'artikel.deleted_at IS NULL';
         header('Content-Type: application/json');  // Memberi tahu browser bahwa data dalam bentuk format json
         echo $this->M_nama_account->get_tables($tables,$search,$isWhere);  // Mengambil data dari database
         
     }

    // Satu table dengan where
    function view_data_where()
    {

        $tables = "tb_nama_account";  // Table yang digunakan       
        $search = array('hdrid','nama_account');  // Column column yang akan muncul di feature search datatable




        
        if($_POST['searchByFromdate']==''||$_POST['searchByTodate']==''){
            $where  = array('transaction_date >'=>'2020-01-01');              
        }else{
            $where  = array('transaction_date >' => $_POST['searchByFromdate'],'transaction_date <' => $_POST['searchByTodate']);
        };
        
        // jika memakai IS NULL pada where sql
        $isWhere = null;  // jika memakai IS NULL pada where sql
        // $isWhere = 'artikel.deleted_at IS NULL';
        header('Content-Type: application/json');  // Memberi tahu browser bahwa data dalam bentuk format json
        echo $this->M_nama_account->get_tables_where($tables,$search,$where,$isWhere);  // Mengambil data dari database
        
    }

    // Multy table / Query
    function view_data_query()
    {

        $query  = "SELECT kategori.name_kategori AS name_kategori, subkat.* FROM subkat 
                    JOIN kategori ON subkat.id_kategori = kategori.id_kategori";  // Memmbuat relasi antar table
        $search = array('name_kategori','subkat','tgl_add'); // Membuat array dengan nama $search
        $where  = null;  // jika memakai IS NULL pada where sql
        // $where  = array('name_kategori' => 'Tutorial');
        
        // jika memakai IS NULL pada where sql
        $isWhere = null;  // jika memakai IS NULL pada where sql
        // $isWhere = 'artikel.deleted_at IS NULL';
        header('Content-Type: application/json');  // Memberi tahu browser bahwa data dalam bentuk format json
        echo $this->M_Datatables->get_tables_query($query,$search,$where,$isWhere);  // Mengambil data dari database

    }


    //    if($this->session->userdata('authenticated')){ // Jika user sudah login (Session authenticated ditemukan)
    //     }else{
    //     redirect('auth');
    //     }

    public function ajax_add()
	{

        // ********************* 0. Generate nomor transaksi  *********************          
        $mdate="TR".mdate('%Y%m',time());   // Buat HDRID otomatis dengan format TR Tahun Bulan Jam (TR202210)         
        $hdrid2=$this->M_nama_account->Max_data($mdate,'tb_nama_account')->row();  // Mengambil row dari database        
        if ($hdrid2->hdrid==NULL){ // Jika HDRID belum ada
           $hdrid3=$mdate."001"; // Maka mulai dari 001
        }else{
           $hdrid3=$hdrid2->hdrid; // Jika sudah ada 
           $hdrid3="TR".(intval(substr($hdrid3,2,10))+1); // Jika sudah ada maka naik 1 level
        }
        $hdrid=$hdrid3; // Deklarasi $hdrid = $hdrid3
       
        // ********************* 1. Set hdrid  *********************
        $post_data2=array('hdrid'=>$hdrid3); // Buat array untuk post ke field HDRID

        // ********************* 2. Transaction date  *********************
        $post_data3=array('transaction_date'=>mdate('%Y-%m-%d',time())); // Buat array untuk post ke field Transaction_date
                
         // ******************** 3. Collect all data post *********************     
        $post_data = $this->input->post();  // Ambil semua data post   

        $msg = "success save"; // Menampung message untuk notif
        // ********************* 4. Merge data post *********************        
        $post_datamerge=array_merge($post_data,$post_data2,$post_data3); // Menggabungkan semua data 

        // ********************* 5. Simpan data     *********************

        $this->M_nama_account->Input_Data($post_datamerge,'tb_nama_account');  // Mengirim parameter ke model untuk query 

        // ********************* 6. Upload file jika ada  *********************   
        if(!empty($_FILES['file']['name']))
        {
            $this->upload_file_attach('file',$hdrid,'tb_nama_account');  // Upload attach file sesuai table           
        }
       

        $data['status']= $msg; // Menarik dan menampung $msg menjadi status

        // return value array
        $this->output->set_content_type('application/json')->set_output(json_encode($data));  // Memberi tahu browser bahwa data dalam bentuk format json

    }
    
    
    public function ajax_update()
	{

         // ********************* 1. Collect data post *********************
        $post_data = $this->input->post(); // Mengambil semua data input post
        $hdrid=$this->input->post('hdrid'); // Mengambil data input post field
       
        $msg = "success Update"; // Menampung menjadi 

        // **********************  Upload file (filename,hdrid,table)  *********************   
        if(!empty($_FILES['file']['name']))
        {          
            $this->upload_file_attach('file',$hdrid,'tb_nama_account'); // Upload attach file sesuai table              
        }
                
        // *********************  Merge data All post *********************
        // $post_datamerge=array_merge($post_data,$post_data2);
        $post_datamerge=array_merge($post_data,$post_data); // Menggabungkan semua data

        // **********************  Simpan data ************************        
        $where = array('hdrid' => $hdrid);  // Buat kondisi where untuk query model         
        $this->M_nama_account->Update_Data($where,$post_datamerge,'tb_nama_account');

        $data['status']="berhasil update";// Menampung message menjadi status

        // return value array
        $this->output->set_content_type('application/json')->set_output(json_encode($data));  // Memberi tahu browser bahwa data dalam bentuk format json

    }

    public function ajax_delete()
	{

         
        $where = array('hdrid' => $this->input->post('hdrid')); // Buat kondisi where untuk query model
        $this->M_nama_account->Delete_Data($where,'tb_nama_account'); // Mengirim parameter ke model 
        $data['status']="berhasil dihapus";// Menampung message menjadi status
        // return value array
        $this->output->set_content_type('application/json')->set_output(json_encode($data));  // Memberi tahu browser bahwa data dalam bentuk format json

    }
    

    function ajax_getbyhdrid(){      

        $hdrid=$this->input->get('hdrid'); // Mengambil input get field
        $data=$this->M_nama_account->ajax_getbyhdrid($hdrid,'tb_nama_account')->row();  // Mengirim parameter ke model dan menampung nya menjadi variable
        echo json_encode($data); // Mengembalikan nilai data format json

    }

    /// @see form_approver_link_mail()
    /// @note
    /// @attention
    function form_approver_link_mail(){
        
        $id_user_reg=$this->input->get('var1'); // Tarik var1 dari input get
        $nik=$this->input->get('var2'); // Tarik var2 dari input get
        
        $data['get_approver']=$this->M_nama_account->get_approver($id_user_reg); // Menarik data hasil query dan menampung nya sebagai data get_approver 
		$data['get_requester']=$this->M_nama_account->get_requester($id_user_reg); // Menarik data hasil query dan menampung nya sebagai data get_requester
		$data['data']=$this->M_nama_account->get_data($id_user_reg);  // Menarik data hasil query dan menampung nya sebagai data 
        
        $this->load->view('email/V_nama_account',$data); // Tampil data
    
    }

    /// @see upload_file_attach()
    /// @note
    /// @attention
    function upload_file_attach($filename,$hdrid,$table){

        if(!empty($_FILES[$filename]['name']))
        {
        
            $config['upload_path'] = './assets/upload'; // Configurasi folder yang ingin dijadikan penyimpanan untuk upload file  
            $config['allowed_types'] = 'gif|jpg|png|pdf'; // Configurasi tipe yang bisa di upload        
            $config['overwrite'] = True; // Configurasi agar bisa di ubah        
            $config['max_size']  = '1000000'; // Configurasi max size dari file yang di upload
            $config['max_width']  = '1024'; // Configurasi lebar dari file yang di upload  
            $config['max_height']  = '768'; // Configurasi tinggi dari file yang di upload
            $config['file_name']=$hdrid.'_'.$filename; // Configurasi nama sesuai format hdrid dan juga file name
            $this->load->library('upload', $config); // Load library untuk upload file 
            $this->upload->initialize($config); 

            if ( ! $this->upload->do_upload($filename)){
                // $status = "error";
                 $msg = $this->upload->display_errors(); // Munculkuan notif error
            }
            else{
                $msg = "success upload"; // Menampung message untuk notif

                $dataupload = $this->upload->data(); // Upload data 
                // $status = "success";
                // $msg = $dataupload['file_name']." berhasil diupload";                      
                $data_update = array($filename =>$dataupload['file_name']); // Buat array    
                $where = array('hdrid' => $hdrid); // Buat array untuk kondisi di query model        
                $this->M_nama_account->Update_Data($where,$data_update,$table); // Kirim semua parameter ke model

            }

        }

    }


    public function import() {

		// $this->form_validation->set_rules('excel', 'File', 'trim|required');

		if ($_FILES['excel']['name'] == '') {

			$this->session->set_flashdata('msg', 'File harus diisi');
            redirect('C_nama_account');

		} else {

			$config['upload_path'] = './assets/excel/';
			$config['allowed_types'] = 'xls|xlsx';
			
			$this->load->library('upload', $config);
			
			if ( ! $this->upload->do_upload('excel')){
				$error = array('error' => $this->upload->display_errors());
			}
			else{

				$data = $this->upload->data();
				
				error_reporting(E_ALL);
				date_default_timezone_set('Asia/Jakarta');

				include './assets/phpexcel/Classes/PHPExcel/IOFactory.php';

				$inputFileName = './assets/excel/' .$data['file_name'];
				$objPHPExcel = PHPExcel_IOFactory::load($inputFileName);
				$sheetData = $objPHPExcel->getActiveSheet()->toArray(null,true,true,true);

				$index = 0;

				foreach ($sheetData as $key => $value) {

                     if ($index > 1 && ucwords($value['D'])!='' ) {


                        // ********************* 0. Generate nomor transaksi  *********************          
                        
                            // Cari database sekali saja
                            if($index==2){
                                $mdate="TR".mdate('%Y%m',time());        
                                $hdrid2=$this->M_nama_account->Max_data($mdate,'tb_nama_account')->row();  
                                if ($hdrid2->hdrid==NULL){
                                    // Jika belum ada
                                $hdrid3=$mdate."001";
                                //    $resultData[$index]['hdrid'] =   $hdrid3;
                                }else{
                                    $hdrid3=$hdrid2->hdrid;
                                    // Jika sudah ada maka naik 1 level
                                    $hdrid3="TR".(intval(substr($hdrid3,2,10))+1);
                                    // $resultData[$index]['hdrid'] =   $hdrid3;    
                                }

                            }else{
                                $hdrid3="TR".(intval(substr($hdrid3,2,10))+1);
                            }

                            $resultData[$index]['hdrid'] =   $hdrid3;  
                            $resultData[$index]['transaction_date'] = mdate('%Y-%m-%d',time());    

                            // ---------------------------------- Import Macro Batas sini 1---------------------------------
                        
                            $resultData[$index]['nama_account'] = ucwords($value['A']);// Isi nama_account dari column A excel 
                                                    

                     }

					$index++;

				}

				unlink('./assets/excel/' .$data['file_name']);

				if (count($resultData) != 0) {
					$result = $this->M_nama_account->insert_batch('tb_nama_account',$resultData);
					if ($result > 0) {
						// $this->session->set_flashdata('msg', show_succ_msg('Data Legalitas Perusahaan Berhasil diimport ke database'));
						redirect('C_nama_account');  // Kembali ke halaman C_nama_account
					}
				} else {
                        // $this->session->set_flashdata('msg', show_msg('Data Legalitas Perusahaan Gagal diimport ke database (Data Sudah terupdate)', 'warning', 'fa-warning'));
                        redirect('C_nama_account');  // Kembali ke halaman C_nama_account
				}

			}
		}
	}
    
    /** ---------------------------------------------- /Close controller----------------------------------------------**/

}
