<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_cn extends CI_Controller {

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
     /** ---------------------------------------------- cn----------------------------------------------**/


  
     public function __construct(){
        parent::__construct();  

        if ($this->session->userdata('user_name')=="") { // Jika username kosong(Belum login) maka
			redirect('Auth'); // Kembali ke halaman Auth
		}

        $this->load->helper('date'); // Load helper date fungsi tanggal
        $this->load->helper('file'); // Load helper date fungsi tanggal     
        $this->load->model('M_cn');// Load model
        $this->load->model('M_approver');// Load model
        $this->load->model('M_User');// Load model
        $this->load->model('UserModel');  //untuk load user model hak akses menu     
        $this->load->library('encryption');  //untuk encryp data
        // $this->load->library('encrypt');
        
        // Cari hak akses by controller
	    $Hak_akses = $this->UserModel->get_controller_access($this->session->userdata('role_id'),'C_cn'); 
	    if($Hak_akses->found!='found') {
		redirect('Auth'); // Kembali ke halaman Auth
	}
	

    }

    /// @see index()
    /// @note Fungsi tampilan utama
    /// @attention Mengirim data data yang diperlukan untuk view
	public function Index()
	{

        $data['nik'] = $this->M_cn->Tampil_nik();
        $menu_code = $this->input->get('var');  // Decrypt menu ID   untuk dekrip menu   
        $menu_name = $this->input->get('var2');  // Decrypt menu ID   untuk dekrip menu name  
        $data['menu_name'] =  $menu_name; 
        $data_akses['menu_akses']=$this->UserModel->get_menu_access($this->session->userdata('role_id'));  //Menu akses untuk munculkan menu   
        $data['hak_akses']=$this->UserModel->get_hak_access($this->session->userdata('role_id'), $menu_code); //button akses(Add,Adit,View,Delete,Import,Export)
        $data['company_to'] = $this->M_cn->Tampil_company_to();// Menarik dan menampung ke data company to
        $data['account'] = $this->M_cn->Tampil_account();// Menarik dan menampung ke data account
        $data['transfer_to'] = $this->M_cn->Tampil_transfer_to();// Menarik dan menampung ke data transfer to
        $data['currency'] = $this->M_cn->Tampil_Currency();// Menarik dan menampung ke data currency
        $data['vat'] = $this->M_cn->Tampil_vat();// Menarik dan menampung ke data vat
        $data['tipe_transfer'] = $this->M_cn->Tampil_Tipe_Transfer();// Menarik dan menampung ke data tipe_transfer
        $data['finish_settlement_cn_bank'] = $this->M_cn->Tampil_Bank();// Menarik dan menampung ke data finish_settlement_cn_bank
        $data['use_budget']=['Own','Other Dept/Section'];
        $data['department'] =$this->M_cn->Tampil_department();
        $data['director_filter'] =$this->M_cn->Tampil_director_filter();
        $data['director'] = $this->M_cn->Tampil_director();// Menarik dan menampung ke data director
    
        $this->load->view('templates/header'); //Tampil header
		$this->load->view('templates/sidebar',$data_akses); //Tampil Sidebar
		// // $this->load->view('cn/V_cn',$data); // Tampil data
        $this->load->view('cn/V_cn',$data); // Tampil data
        $this->load->view('templates/footer'); // Tampil footer

    }

    /// @see view_data()
    /// @note Menampilkan data yang ada di table 
    /// @attention Menampilkan data tanpa kondisi
     function view_data()
     {
        
        $tables = "tb_cn"; //table cn
        $search = array('hdrid','date_of_issue','name','nik','status_transaction','section','company_to','company_address','attention','attention_departement','detail_request','reference','budget','account','payment_terms','banyak_cicilan','transfer_to','transfer_address','currency','idr','usd','eur','swift_code','account_name','amount','amount_total','amount_in_word','dpp','vat','vat_persen','vat_nominal','vat_total','dmia_bank_account','transfer_name','bank_name','account_number','attachment1','attachment2','attachment3','attachment4','director','title','approver_dept_user','approver_dept_finance','finish_settlement_cn_bank','finish_settlement_cn_amount','finish_settlement_cn_date','start_month','company_address1','company_address2','email_and_telp');//isi table cn
        
        // jika memakai IS NULL pada where sql
         $isWhere = null;
         // $isWhere = 'artikel.deleted_at IS NULL';
         header('Content-Type: application/json'); // Memberi tahu browser bahwa data dalam bentuk format json
         echo $this->M_cn->get_tables($tables,$search,$isWhere); // Mengambil data dari database
         
     }

    /// @see view_data_where()
    /// @note Menampilkan data yang ada di table 
    /// @attention Menampilkan data dengan kondisi tertentu
    // Satu table dengan where
    function view_data_where()
    {
   

        $nik= $this->session->userdata('user_name'); // Menarik username dari session dan menampung nya sebagai nik
        $name= $this->session->userdata('nama'); // Menarik username dari session dan menampung nya sebagai nik
        

        // $tables = "tb_cn";  
        $menu_name=$this->input->post('menu_name'); // Ambil input post menu_name
        if ($menu_name=='Add Credit Note') { // Kondisi jika menu_name = Add settlement

            if($this->session->userdata('rolename')=='Administrator FA'){
                    $tables = "fn_view_add_cn('')"; // Terbuka semua tanpa user
            }else{
                    $tables = "fn_view_add_cn('$nik')"; // Maka table yang dipakai
            }

        }elseif ($menu_name=='Approval Credit Note') { // Kondisi jika menu_name = Approval advance

            $tables = "fn_view_app_cn('$name')"; // Maka table yang dipakai

        }elseif ($menu_name=='Summary Credit Note') { // Kondisi jika menu_name = Summary advance FA Closing advance

            if($this->session->userdata('rolename')=='Administrator FA' || $this->session->userdata('rolename')=='Super Admin'  ){
                $tables = "fn_view_sum_cn('')"; // Terbuka semua tanpa user
            }else{
                    $tables = "fn_view_sum_cn('$nik')"; // Maka table yang dipakai
            }

        }elseif ($menu_name=='Settlement Credit Note') { // Kondisi jika menu_name = Summary advance 

            $tables = "fn_view_set_cn()"; // Maka table yang dipakai

        }else { // Kondisi lainnya
            $tables = "tb_cn"; // Maka table yang dipakai
        }
        
        // $tables = "fn_view_req_pc('$nik')"; // Table yang digunakan 
      
        // $tables = "tb_cn"; //table cn
        $search = array('hdrid','date_of_issue','name','nik','status_transaction','section','company_to','company_address','attention','attention_departement','detail_request','reference','budget','account','payment_terms','banyak_cicilan','transfer_to','transfer_address','currency','idr','usd','eur','swift_code','account_name','amount','amount_total','amount_in_word','dpp','vat','vat_persen','vat_nominal','vat_total','dmia_bank_account','transfer_name','bank_name','account_number','attachment1','attachment2','attachment3','attachment4','director','title','approver_dept_user','approver_dept_finance','finish_settlement_cn_bank','finish_settlement_cn_amount','finish_settlement_cn_date','start_month','company_address1','company_address2','email_and_telp');//isi table cn
        

        if($_POST['searchByFromdate']==''||$_POST['searchByTodate']==''){ //pencarian melalui tanggal
            $where  = array('transaction_date >'=>'2020-01-01');              
        }else{
            $where  = array('transaction_date >' => $_POST['searchByFromdate'],'transaction_date <' => $_POST['searchByTodate']);
        };
        
        // jika memakai IS NULL pada where sql
        $isWhere = null;
        // $isWhere = 'artikel.deleted_at IS NULL';
        header('Content-Type: application/json'); // Memberi tahu browser bahwa data dalam bentuk format json
        echo $this->M_cn->get_tables_where($tables,$search,$where,$isWhere); // Mengambil data dari database
        
    }


    /// @see view_data_whereapproval()
    /// @note Tampil List Approval
    /// @attention Menampilkan list approver berdasarkan hdrid di view 
    function view_data_whereapproval()
    {
        
        $tables = "tb_approval"; // Table yang digunakan     
        
        // $nikSession=$this->session->userdata('user_name');
        
        $hdrid = $this->input->post('hdrid'); // Tarik input post hdrid
        $search = array('nik','name','department_code','department_name','office_email','position_code','position_name','date_approve'); // Column-column yang akan digunakan sebagai kondisi search query
        $where  = array('hdrid' => $hdrid); // Array untuk menjadi kondisi yang akan dikirimkan ke model
        $isWhere = null; // Jika memakai IS NULL pada where sql
        // $isWhere = 'artikel.deleted_at IS NULL';
        header('Content-Type: application/json'); // Memberi tahu browser bahwa data dalam bentuk format json
        echo $this->M_cn->get_tables_where($tables, $search, $where, $isWhere); // Mengambil data dari database
    }
 

    /// @see View_cicilan_cn()
    /// @note Tampil List Cicilan
    /// @attention Menampilkan list cicilan berdasarkan hdrid di view 
    function View_cicilan_cn()
    {
        
        $tables = "tb_cicilan_cn"; // Table yang digunakan     
        
        // $nikSession=$this->session->userdata('user_name');
        
        $hdrid = $this->input->post('hdrid'); // Tarik input post hdrid
        $search = array('hdrid','month','amount'); // Column-column yang akan digunakan sebagai kondisi search query
        if ($hdrid == '') {
            $where  = array('hdrid'=> $this->session->userdata('user_name') ); // Array untuk menjadi kondisi yang akan dikirimkan ke model
        } 
        if(substr($hdrid,0,2)=='CN'){
            $where  = array('hdrid' => $hdrid); // Array untuk menjadi kondisi yang akan dikirimkan ke model
        }
        
        $isWhere = null; // Jika memakai IS NULL pada where sql
        // $isWhere = 'artikel.deleted_at IS NULL';
        header('Content-Type: application/json'); // Memberi tahu browser bahwa data dalam bentuk format json
        echo $this->M_cn->get_tables_where($tables, $search, $where, $isWhere); // Mengambil data dari database
    }

    /// @see Ajax_Add_Row()
    /// @note Tambah data cicilan
    /// @attention HDRID Bisa berupa nik apabila masih dalam tahap ajax_Add()
    function Ajax_Add_Row(){      

        $hdridm=$this->input->post('hdrid'); //mengambil dari hdrid
        $hdrid2=$this->M_cn->Max_data_cn($hdridm,'tb_cicilan_cn')->row();   // Mengambil row dari database
        // var_dump($hdrid2->no_cicilan);        
        if ($hdrid2->no_cicilan==NULL){ // Jika HDRID belum ada
           $no_cil="1"; // Maka mulai dari 001
        }else{
           $hdrid3=$hdrid2->no_cicilan; // Jika sudah ada 
            $no_cil=intval($hdrid3)+1;// Jika sudah ada maka naik 1 level
        }
        $no_cicilan=$no_cil;  // Deklarasi $hdrid = $hdrid3
        $post_data = array('hdrid' =>$hdridm ,'transaction_date' => mdate('%Y-%m-%d',time()),'no_cicilan' => $no_cicilan);
        // ********************* 4. Merge data post *********************        
        $post_datamerge=array_merge($post_data,$post_data); // Menggabungkan semua data 

        // ********************* 5. Simpan data     *********************

        $this->M_cn->Input_Data($post_datamerge,'tb_cicilan_cn'); // Mengirim parameter ke model untuk query 

        $data['status']= $no_cicilan; // Menarik dan menampung $msg menjadi status

        // return value array
        $this->output->set_content_type('application/json')->set_output(json_encode($data)); // Memberi tahu browser bahwa data dalam bentuk format json

    }


    /// @see ajax_update_cn()
    /// @note Update cicilan
    /// @attention Update cicilan berdasarkan no cicilan,hdrid
    public function ajax_update_cn()
	{

         // ********************* 1. Collect data post *********************
        $hdrid=$this->input->post('hdrid'); // Tarik data input post hdrid
        $no_cicilan=$this->input->post('no_cicilan'); // Tarik data input post hdrid
        $no_cicilan_history=$this->input->post('no_cicilan_history'); // Tarik data input post hdrid
        $month=$this->input->post('month'); // Tarik data input post hdrid
        $amount=$this->input->post('amount'); // Tarik data input post hdrid
        $post_data = array('no_cicilan'=>$no_cicilan,'month' => $month,'amount' => $amount );
        // *********************  Merge data All post *********************
        $post_datamerge=array_merge($post_data,$post_data);//menggabungkan semua data
        $post_data_transaction_date = mdate('%Y-%m-%d', time()); // menampung tahun bulan hari jam 


        // **********************  Simpan data ************************        
        $where = array('hdrid' => $hdrid,'no_cicilan' => $no_cicilan_history);// Buat kondisi where untuk dikirim ke model   
        $this->M_cn->Update_Data($where,$post_datamerge,'tb_cicilan_cn');// Buat kondisi where untuk dikirim ke model
        $data['status'] = $hdrid; // Menarik dan menampung $msg menjadi status

        // return value array
        $this->output->set_content_type('application/json')->set_output(json_encode($data));// Mengembalikan nilai data format json

    }


    /// @see ajax_update_director()
    /// @note Update director,title
    /// @attention Update director,title berdasarkan hdrid(Adminstrator FA OR Super Admin ONLY)
    public function ajax_update_director()
	{

         // ********************* 1. Collect data post *********************
        $director=$this->input->post('director'); // Tarik data input post director
        $title=$this->input->post('title'); // Tarik data input post title
        $hdrid=$this->input->post('hdrid'); // Tarik data input post title
        $post_data = array('director'=>$director,'title' => $title);
        $where = array('hdrid' => $hdrid);// Buat kondisi where untuk dikirim ke model   
        $post_datamerge=array_merge($post_data,$post_data);//menggabungkan semua data
        
        $this->M_cn->Update_data($where,$post_datamerge,'tb_cn');// Buat kondisi where untuk dikirim ke model
        // **********************  Simpan data ************************        
        $data['status'] = $hdrid; // Menarik dan menampung $msg menjadi status
        // return value array
        $this->output->set_content_type('application/json')->set_output(json_encode($data));// Mengembalikan nilai data format json

    }

    /// @see ajax_add()
    /// @note Add Data
    /// @attention Tambah data baru ke database
    public function ajax_add()
	{

        // ********************* 0. Generate nomor transaksi  *********************          
        $mdate="CN".mdate('%y',time())."/"; // Buat format untuk hdrid CN berdasarkan Tgl dan tahun 
        $hdrid2=$this->M_cn->Max_data($mdate,'tb_cn')->row();     
        if ($hdrid2->hdrid==NULL){ // Jika hdrid kosong
            // Jika belum ada
           $hdrid3=$mdate."01";// Jika belum ada = 001
        }else{
           $hdrid3=$hdrid2->hdrid; // Jika sudah ada hdrid maka akan tetap sama
           $nomor=intval(substr($hdrid3,5,10))+1;//untuk mengambil nomor dipilih
           $nomor=str_pad($nomor,2,"0",STR_PAD_LEFT);//untuk mengambil huruf sesuai diatur
           $hdrid3=$mdate.$nomor;// Jika sudah ada maka naik 1 level
        }
        $hdrid=$hdrid3; // hdrid=hdrid
       
        // ********************* 1. Set hdrid  *********************



        $post_data2=array('hdrid'=>$hdrid3); // Buat array untuk set hdrid

        // ********************* 2. Transaction date  *********************
        $post_data3=array('transaction_date'=>mdate('%Y-%m-%d',time()));
        $post_data_transaction_date = mdate('%Y-%m-%d', time()); // menampung tahun bulan hari jam 
                
         // ******************** 3. Collect all data post *********************     
        $post_data = $this->input->post();  // Tarik semua data input post 
        $msg = "success save"; // Menampung message untuk notif
        
        // ********************* 4. Merge data post *********************        
        $post_datamerge=array_merge($post_data,$post_data2,$post_data3);  // Menggabungkan semua data post 

        // ********************* 5. Simpan data     *********************
        $this->M_cn->Input_Data($post_datamerge,'tb_cn'); //Simpan data
        
        // // ********************* 6. Simpan data aproval     *********************
        // $this->M_cn->Input_Data_Approver($hdrid3,$this->input->post('nik'));
        $nominal=$this->input->post('nominal'); // Tarik data input post nominal
       
        // $this->M_cn->Input_Data_Approver($nominal,$post_data_transaction_date,$hdrid,$this->input->post('nik')); // Mengirim data ke model untuk query menambah data approver
        $this->M_cn->Add_List_Approver($post_data_transaction_date,$hdrid,$this->input->post('nik')); // Mengirim data ke model untuk query menambah data approver

        $where = array('hdrid' =>  $this->session->userdata('user_name')); 
        $post_hdrid = array('hdrid' =>  $hdrid3); 
        $post_datamerge=array_merge($post_hdrid,$post_hdrid);  
        $this->M_cn->Update_Data($where,$post_datamerge,'tb_cicilan_cn');// Buat kondisi where untuk dikirim ke model

        // $this->M_cn->Add_cicilan($cicilan,$month,$amount_total,$payment_terms,$hdrid); // Mengirim data ke model untuk menambah data ke tb cicilan


       
        // ********************* 7. Upload file jika ada  *********************   
        if(!empty($_FILES['attachment1']['name']))
                {
                $this->upload_file_attach('attachment1',$hdrid,'tb_cn');
                }
        if(!empty($_FILES['attachment2']['name']))
                {  
                $this->upload_file_attach('attachment2',$hdrid,'tb_cn');
                }
        if(!empty($_FILES['attachment3']['name']))
                {
                $this->upload_file_attach('attachment3',$hdrid,'tb_cn');
                }
        if(!empty($_FILES['attachment4']['name']))
                {
                $this->upload_file_attach('attachment4',$hdrid,'tb_cn');
                }
        if(!empty($_FILES['attachment4']['name']))
                {
                $this->upload_file_attach('attachment4',$hdrid,'tb_dncnsettlement');
                }
        
       
        $data['status'] = $hdrid; //status

        // return value array
        $this->output->set_content_type('application/json')->set_output(json_encode($data));

    }

    
    /// @see ajax_update()
    /// @note Update Data
    /// @attention Updata data field sesuai hdrid
    public function ajax_update()
	{

         // ********************* 1. Collect data post *********************
        $post_data = $this->input->post(); // Tarik data input post
        $hdrid=$this->input->post('hdrid'); // Tarik data input post hdrid
        $nominal=$this->input->post('nominal'); // Tarik data input post nominal

        $msg = "success Update"; //message ketika berhasil update

        // **********************  Upload file (filename,hdrid,table)  *********************   
        if(!empty($_FILES['attachment1']['name']))
        {
          $this->upload_file_attach('attachment1',$hdrid,'tb_cn');
        }
        if(!empty($_FILES['attachment2']['name']))
                {
                $this->upload_file_attach('attachment2',$hdrid,'tb_cn');
                }
        if(!empty($_FILES['attachment3']['name']))
                {
                $this->upload_file_attach('attachment3',$hdrid,'tb_cn');
                }
        if(!empty($_FILES['attachment4']['name']))
                {
                $this->upload_file_attach('attachment4',$hdrid,'tb_cn');
                }
        if(!empty($_FILES['attachment4']['name']))
                {
                $this->upload_file_attach('attachment4',$hdrid,'tb_cn');
                }
        
                
        // *********************  Merge data All post *********************
        // $post_datamerge=array_merge($post_data,$post_data2);
        $post_datamerge=array_merge($post_data,$post_data);//menggabungkan semua data
        $post_data_transaction_date = mdate('%Y-%m-%d', time()); // menampung tahun bulan hari jam 


        // **********************  Simpan data ************************        
        $where = array('hdrid' => $hdrid);// Buat kondisi where untuk dikirim ke model   
        $this->M_cn->Update_Data($where,$post_datamerge,'tb_cn');// Buat kondisi where untuk dikirim ke model

        $month=$this->input->post('start_month');  // Tarik data input post start_month
        $cicilan=$this->input->post('banyak_cicilan');  // Tarik data input post banyak_cicilan
        $amount_total=$this->input->post('amount_total');  // Tarik data input post amount_total
        $payment_terms=$this->input->post('payment_terms');  // Tarik data input post payment_terms

        // $this->M_cn->Add_cicilan_update($cicilan,$month,$amount_total,$payment_terms,$hdrid); // Mengirim data ke model untuk update data ke tb cicilan

        // $data['status']="berhasil update";// Menarik dan menampung $msg menjadi status
        $data['status'] = $hdrid; // Menarik dan menampung $msg menjadi status

        // return value array
        $this->output->set_content_type('application/json')->set_output(json_encode($data));// Mengembalikan nilai data format json

    }

    /// @see ajax_delete()
    /// @note Delete Data
    /// @attention Delete data berdasarkan hdrid
    public function ajax_delete() //function untuk delete
	{

         
        $where = array('hdrid' => $this->input->post('hdrid')); // Buat array untuk kondisi where di query model 
        $this->M_cn->Delete_Data($where,'tb_cn'); // Mengirim param ke model untuk query delete

        $where = array('hdrid' => $this->input->post('hdrid')); // Buat array untuk kondisi where di query model 
        $this->M_cn->Delete_Data($where,'tb_approval'); // Mengirim param ke model untuk query delete
        
        $where = array('hdrid' => $this->input->post('hdrid')); // Buat array untuk kondisi where di query model 
        $this->M_cn->Delete_Data($where,'tb_cicilan_cn'); // Mengirim param ke model untuk query delete

        $data['status']="berhasil dihapus"; //pesan saat berhasil dihapus
        // return value array
        $this->output->set_content_type('application/json')->set_output(json_encode($data)); // mengembalikkan nilai dari format json

    }

     /// @see ajax_delete_temporary
    /// @note menghapus cicilan saat diinput jika memilih C30D
    /// @attention Delete data berdasarkan jika memilih C30D
    public function ajax_delete_temporary() //function untuk delete
	{

    
        $where = array('hdrid' => $this->input->post('hdrid')); // Buat array untuk kondisi where di query model 
        $this->M_cn->Delete_Data($where,'tb_cicilan_cn'); // Mengirim param ke model untuk query delete

        $data['status']="berhasil dihapus"; //pesan saat berhasil dihapus
        // return value array
        $this->output->set_content_type('application/json')->set_output(json_encode($data)); // mengembalikkan nilai dari format json

    }

    /// @see ajax_delete_cicilan()
    /// @note Delete Data
    /// @attention Delete data berdasarkan hdrid
    public function ajax_delete_cicilan() //function untuk delete
	{

        $where = array('hdrid' => $this->input->post('hdrid'),'no_cicilan' => $this->input->post('no_cicilan')); // Buat array untuk kondisi where di query model 
        $this->M_cn->Delete_Data($where,'tb_cicilan_cn'); // Mengirim param ke model untuk query delete

        $data['status']="berhasil dihapus"; //pesan saat berhasil dihapus
        // return value array
        $this->output->set_content_type('application/json')->set_output(json_encode($data)); // mengembalikkan nilai dari format json

    }
    /// @see ajax_cekdup()
    /// @note Cek Duplicate field
    /// @attention Kirim data input user ke database untuk di search(Return Status)
    public function ajax_cekdup() 
	{
        $where = array('reference' => $this->input->post('reference')); // Buat array untuk kondisi where di query model 

        $hasil=$this->M_cn->cek_duplicate($where,'tb_cn'); // Mengirim param ke model untuk query delete

        $data['status']=$hasil; //pesan saat berhasil dihapus

        // return value array
        $this->output->set_content_type('application/json')->set_output(json_encode($data)); // mengembalikkan nilai dari format json

    }

    
    /// @see ajax_getbyhdrid()
    /// @note Mencari data berdasarkan hdrid
    /// @attention Untuk data field ketika view modal(View,Update)
    function ajax_getbyhdrid(){      

        $hdrid=$this->input->get('hdrid'); //mengambil dari hdrid
        $data=$this->M_cn->ajax_getbyhdrid($hdrid,'tb_cn')->row();// Mengirim param ke model untuk query 
        echo json_encode($data);// mengembalikkan nilai dari format daTA json

    }

    /// @see ajax_getbytrxid()
    /// @note Mencari data berdasarkan hdrid
    /// @attention Untuk data field ketika view modal(View,Update)
    function ajax_getbytrxid(){      

        $hdrid=$this->input->get('hdrid'); //mengambil dari hdrid
        $no_cicilan=$this->input->get('no_cicilan'); //mengambil dari hdrid
        // $No_cicilan=$this->input->get('=='); //mengambil dari hdrid
        $data=$this->M_cn->ajax_getbytrxid($hdrid,$no_cicilan,'tb_cicilan_cn')->row();// Mengirim param ke model untuk query 
        echo json_encode($data);// mengembalikkan nilai dari format daTA json

    }



    /// @see ajax_getapproval_cn()
    /// @note Cek approver yang berjalan
    /// @attention Untuk validasi button di view
    function ajax_getapproval_cn(){      

        $hdrid = $this->input->get('hdrid'); // Mengambil hdrid

        $query = $this->db->query("select top 1 * from tb_approval where hdrid='$hdrid' and date_approve is null order by position_code asc"); // Query untuk mencari approver dengan kondisi date_approve kosong 
        if ($query->num_rows() > 0) {  
            $query=$query->row();
            $data['nik'] = $query->nik;// Menampung data sesuai dengan hasil query
            $data['name'] = $query->name;// Menampung data sesuai dengan hasil query
            $data['position_code'] = $query->position_code;// Menampung data sesuai dengan hasil query
            $this->output->set_content_type('application/json')->set_output(json_encode($data)); // Mengembalikan nilai data format json
            
        }else{
        
            $data['nik'] = ""; // Apabila tidak dapat
            $data['name'] = ""; // Apabila tidak dapat
            $data['position_code'] = ""; // Apabila tidak dapat
            $this->output->set_content_type('application/json')->set_output(json_encode($data)); // Mengembalikan nilai data format json
        }

    }

    /// @see upload_file_attach()
    /// @note Upload File 
    /// @attention Configurasi settingan upload file
    function upload_file_attach($filename,$hdrid,$table){

        if(!empty($_FILES[$filename]['name']))
        {
          
            $config['upload_path'] = './assets/upload/cn/';  // Configurasi folder yang ingin dijadikan penyimpanan untuk upload file 
            $config['allowed_types'] = 'gif|jpg|png|pdf|jpeg|txt'; // Configurasi tipe yang bisa di upload         
            $config['overwrite'] = True; // Configurasi agar bisa di ubah           
            $config['max_size']  = '1000000'; // Configurasi max size dari file yang di upload
            $config['max_width']  = '1024';// Configurasi lebar dari file yang di upload
            $config['max_height']  = '768';// Configurasi tinggi dari file yang di upload
            $config['file_name']=$hdrid.'_'.$filename;// Configurasi nama sesuai format hdrid dan juga file name
            $this->load->library('upload', $config); // Load library untuk upload file
            $this->upload->initialize($config); 

            if ( ! $this->upload->do_upload($filename)){
                // $status = "error";
                 $msg = $this->upload->display_errors();  // Munculkan notif error
            }
            else{
                 $msg = "success upload"; // Menampung message untuk notif

                $dataupload = $this->upload->data(); // Upload data 
                // $status = "success";
                // $msg = $dataupload['file_name']." berhasil diupload";                      
                $data_update = array($filename =>$dataupload['file_name']); // Buat array   
               
                $where = array('hdrid' => $hdrid);  // Buat array untuk kondisi di query model        
                $this->M_cn->Update_Data($where,$data_update,$table); // Kirim semua parameter ke model

            }

        }

    }
    
    /// @see import()
    /// @note Import data 
    /// @attention Import data excel ke database
    public function import() { //fungsi untuk import

		// $this->form_validation->set_rules('excel', 'File', 'trim|required');

		if ($_FILES['excel']['name'] == '') {

			$this->session->set_flashdata('msg', 'File harus diisi');
            redirect('C_cn'); //kembali ke C_cn

		} else {

			$config['upload_path'] = './assets/excel/'; //upload tipe excel
			$config['allowed_types'] = 'xls|xlsx'; //tipe data excel
			
			$this->load->library('upload', $config); //untuk fungsi upload
			
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
                                $mdate="ADV".mdate('%Y%m',time());        
                                $hdrid2=$this->M_cn->Max_data($mdate,'tb_cn')->row();  
                                if ($hdrid2->hdrid==NULL){
                                    // Jika belum ada
                                $hdrid3=$mdate."001";
                                //    $resultData[$index]['hdrid'] =   $hdrid3;
                                }else{
                                    $hdrid3=$hdrid2->hdrid;
                                    // Jika sudah ada maka naik 1 level
                                    $hdrid3="ADV".(intval(substr($hdrid3,3,10))+1);
                                    // $resultData[$index]['hdrid'] =   $hdrid3;    
                                }

                            }else{
                                $hdrid3="ADV".(intval(substr($hdrid3,3,10))+1);
                            }

                            $resultData[$index]['hdrid'] =   $hdrid3;  
                            $resultData[$index]['transaction_date'] = mdate('%Y-%m-%d',time());    

                            // ---------------------------------- Import Macro Batas sini 1---------------------------------
                        
                            $resultData[$index]['date_of_issue'] = ucwords($value['A']);	
                            $resultData[$index]['name'] = ucwords($value['A']);	
                            $resultData[$index]['nik'] = ucwords($value['A']);	
                            $resultData[$index]['section'] = ucwords($value['A']);	
                            $resultData[$index]['company_to'] = ucwords($value['A']);	
                            $resultData[$index]['company_address'] = ucwords($value['A']);	
                            $resultData[$index]['attention'] = ucwords($value['A']);	
                            $resultData[$index]['attention_departement'] = ucwords($value['A']);	
                            $resultData[$index]['detail_request'] = ucwords($value['A']);	
                            $resultData[$index]['reference'] = ucwords($value['A']);	
                            $resultData[$index]['budget'] = ucwords($value['A']);	
                            $resultData[$index]['account'] = ucwords($value['A']);	
                            $resultData[$index]['payment_terms'] = ucwords($value['A']);	
                            $resultData[$index]['banyak_cicilan'] = ucwords($value['A']);	
                            $resultData[$index]['transfer_to'] = ucwords($value['A']);	
                            $resultData[$index]['transfer_address'] = ucwords($value['A']);	
                            $resultData[$index]['currency'] = ucwords($value['A']);	
                            $resultData[$index]['idr'] = ucwords($value['A']);	
                            $resultData[$index]['usd'] = ucwords($value['A']);	
                            $resultData[$index]['eur'] = ucwords($value['A']);	
                            $resultData[$index]['swift_code'] = ucwords($value['A']);	
                            $resultData[$index]['account_name'] = ucwords($value['A']);	
                            $resultData[$index]['amount'] = ucwords($value['A']);	
                            $resultData[$index]['amount_total'] = ucwords($value['A']);	
                            $resultData[$index]['amount_in_word'] = ucwords($value['A']);	
                            $resultData[$index]['dpp'] = ucwords($value['A']);	
                            $resultData[$index]['vat'] = ucwords($value['A']);	
                            $resultData[$index]['vat_persen'] = ucwords($value['A']);	
                            $resultData[$index]['vat_nominal'] = ucwords($value['A']);	
                            $resultData[$index]['vat_total'] = ucwords($value['A']);	
                            $resultData[$index]['dmia_bank_account'] = ucwords($value['A']);	
                            $resultData[$index]['transfer_name'] = ucwords($value['A']);	
                            $resultData[$index]['bank_name'] = ucwords($value['A']);	
                            $resultData[$index]['account_number'] = ucwords($value['A']);	
                            $resultData[$index]['attachment1'] = ucwords($value['A']);	
                            $resultData[$index]['attachment2'] = ucwords($value['A']);	
                            $resultData[$index]['attachment3'] = ucwords($value['A']);	
                            $resultData[$index]['attachment4'] = ucwords($value['A']);	
                            $resultData[$index]['director'] = ucwords($value['A']);	
                            $resultData[$index]['title'] = ucwords($value['A']);	
                            $resultData[$index]['approver_dept_user'] = ucwords($value['A']);	
                            $resultData[$index]['approver_dept_finance'] = ucwords($value['A']);	
                            $resultData[$index]['finish_settlement_cn_bank'] = ucwords($value['A']);	
                            $resultData[$index]['finish_settlement_cn_amount'] = ucwords($value['A']);	
                            $resultData[$index]['finish_settlement_cn_date'] = ucwords($value['A']);	
                            
                            
                            
                                                                                 

                     }

					$index++;

				}

				unlink('./assets/excel/' .$data['file_name']);

				if (count($resultData) != 0) {
					$result = $this->M_cn->insert_batch('tb_cn',$resultData);
					if ($result > 0) {
						// $this->session->set_flashdata('msg', show_succ_msg('Data Legalitas Perusahaan Berhasil diimport ke database'));
						redirect('C_cn'); // Kembali ke halaman C_cn
					}
				} else {
                        // $this->session->set_flashdata('msg', show_msg('Data Legalitas Perusahaan Gagal diimport ke database (Data Sudah terupdate)', 'warning', 'fa-warning'));
                        redirect('C_cn');// Kembali ke halaman C_cn
				}

			}
		}
	}
    
    /** ---------------------------------------------- /Close controller----------------------------------------------**/

}
