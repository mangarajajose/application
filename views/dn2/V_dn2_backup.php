
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">

    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Debit Note</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Dashboard v1</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
        
        <!-- <php echo $this->session->flashdata('msg'); ?> -->

        <!-- ##################################### Batas Row 1 #####################################  -->

          <div class="col-12"> <!-- .col -->

            <div class="card"> <!-- .card -->

              <!-- .card-header -->
              <div class="card-header"> 
                <!-- <h3 class="card-title">DataTable with minimal features & hover style</h3> -->               
                <div class="row">
                   <div class="col-md-12">
                    <div class="card">              
                      <div class="card-header">    
                      <div id="accordion">
                          <!-- we are adding the .class so bootstrap.js collapse plugin detects it -->
                          <div class="card card-primary">

                            <div class="card-header">

                              <h4 class="card-title">
                               
                         <!-- Jika ketemu hak akses -->
                                <?php if (!empty($hak_akses)) { ?> 
                                  <!-- Jika allow add = true -->
                                  <?php if ($hak_akses->allow_add=='on') { ?>
                                    <!-- menampilkan tombol add data-->
                                    <a data-toggle="modal" data-target="#modal-default"  Onclick="view_modal('1','Add')" href="#">
                                      <i class="fa fa-plus"></i> Add Data
                                    </a>
                                  <?php } ?>
                                  <!-- /Jika allow add = true -->
                                <?php } ?>
                                <!-- /Jika ketemu hak akses -->

                                <!-- Jika ketemu hak akses -->
                                <?php if (!empty($hak_akses)) { ?>
                                  <!-- Jika allow_import = true -->
                                  <?php if ($hak_akses->allow_import=='on') { ?>
                                      <a data-toggle="modal" data-target="#modal-import"  href="#">
                                        <!-- <i class="fa fa-upload"></i> Import Data -->
                                      </a>
                                  <?php } ?>
                                 <!-- /Jika allow add = true -->
                                <?php } ?>
                                <!-- /Jika ketemu hak akses -->

                                <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
                                     <i class="fa fa-binoculars"></i> Custom Filter
                                </a>

                                <!-- <a href="<php echo base_url('C_Email/send2')?> "  Onclick='Delete_data()' >
                                   <i class="fa fa-plus"></i> Send Mail
                                </a>

                                <button type="button" id="delete" onclick="Send_mail()" class="btn btn-outline-light">Send Mail 2</button>     -->

                              </h4>

                            </div>

                            <div id="collapseOne" class="panel-collapse collapse in">
                              <div class="card-body">

                                  <!-- Date -->
                                  <div class="form-group">                                

                                    <label>Date From:</label>
                                     
                                      <div class="input-group date" data-date-format="YYYY-MM-DD"  id="startdate" data-target-input="nearest">
                                          <input type="text" id="search_fromdate" class="form-control datetimepicker-input" data-target="#startdate"/>
                                          <div class="input-group-append" data-target="#startdate" data-toggle="datetimepicker">
                                              <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                          </div>
                                      </div>

                                  </div>

                                  <!-- Date To-->
                                  <div class="form-group">
                                    <label>Date To:</label>
                                      <div class="input-group date" data-date-format="YYYY-MM-DD" id="enddate" data-target-input="nearest">
                                          <input type="text" id="search_todate" class="form-control datetimepicker-input" data-target="#enddate"/>
                                          <div class="input-group-append" data-target="#enddate" data-toggle="datetimepicker">
                                              <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                          </div>
                                      </div>
                                  </div>

                                  <button type="button" id="search" class="btn btn-block btn-success" data-toggle="collapse" data-target="#collapseOne">Search</button>
                               
                              </div>
                            </div>
                          </div>
                        </div>            
                      </div>
                    </div>
                    <!-- /.card -->
                  </div>
                  <!-- /.col -->
                </div>
                <!-- /.row -->
                <!-- END ACCORDION & CAROUSEL-->                                      
              </div> 
              <!-- /.card-header -->
              
              <div class="card-body">  <!-- .card-body -->

                <table id="example1" class="table table-bordered display nowrap table-striped">

                  <thead>
									<tr>
                    <td colspan="1">  </td>
                    <!-- <td colspan="10">  -->
										<div class="bg-teal color-palette"> <span>Green=APPROVE</span></div>  <!--untuk reminder kalau udah selesai-->
                      <div class="bg-pink color-palette"> <span>Pink=REJECT</span></div> <!--untuk reminder kalau belum di approver manager finance-->
                      <div class="bg-white color-palette"> <span>White=On Progress</span> </div><!--untuk reminder masih on progress-->
                    </td>
                  </tr>
                  <tr>

                    <!-- Th Macro Batas Sini -->
					<th>ACTION</th>
					<th>TRANSACTION ID</th>
					<th>DATE OF ISSUE</th>
					<th>NAME</th>
					<th>NIK</th>
					<th>SECTION</th>
					<th>COMPANY TO</th>
					<th>COMPANY ADDRESS</th>
					<th>COMPANY ADDRESS 1</th>
					<th>COMPANY ADDRESS 2</th>
					<th>ATTENTION</th>
					<th>ATTENTION DEPARTEMENT</th>
					<th>EMAIL AND TELP</th>
					<th>DETAIL REQUEST</th>
					<th>REFERENCE</th>
					<th>BUDGET</th>
					<th>ACCOUNT</th>
					<th>PAYMENT TERMS</th>
					<th>TRANSFER TO</th>
					<th>TRANSFER ADDRESS</th>
					<th>CURRENCY</th>
					<th>IDR</th>
					<th>USD</th>
					<th>EUR</th>
					<th>JPY</th>
					<th>SWIFT CODE</th>
					<th>ACCOUNT NAME</th>
					<th>DPP</th>
					<th>VAT PERSEN</th>
					<th>VAT NOMINAL</th>
					<th>AMOUNT TOTAL</th>
					<th>AMOUNT IN WORD</th>
					<th>ATTACHMENT 1</th>
					<th>ATTACHMENT 2</th>
					<th>ATTACHMENT 3</th>
					<th>ATTACHMENT 4</th>
					<th>DIRECTOR</th>
					<th>TITLE</th>
					<th>STATUS</th>
					<th>STATUS TRANSACTION</th>
           


                    <!-- /Th Macro Batas Sini -->
                          
                  </tr>

                  </thead>

                  <tbody></tbody>
              
                </table>
                        
              </div> <!-- /.card-body -->
             
            </div> <!-- /.card -->
          </div> <!-- /.col -->

        <!-- ##################################### / Batas Row 1 #####################################  -->
        </div> <!-- /.row -->

      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->    
  </div>
  <!-- /.content-wrapper -->

  <!-- ##################################### Batas Modal #####################################  -->

     <!-- modal-Add / Update -->
     <div class="modal fade" id="modal-default" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document" >
            <div class="modal-content">            
              <div class="modal-header">
                  <h4 class="modal-title" id="exampleModalLabel">ADD DATA</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                  </button>
              </div>

              <!-- form -->
              <form role="form" id="quickForm">

                <div class="card-body">

                <!---------------------------------- Form Macro Batas sini ---------------------------------->
				<div class="form-group">
   <div class="row">
      <div class="col-md-4">
         <label for="hdrid">TRANSACTION ID</label>
      </div>
      <div class="col-md-8">
         <input type="text" name="hdrid" class="form-control" id="hdrid" placeholder="auto generate" readonly>
      </div>
   </div>
</div>
<div class="form-group">
   <div class="row">
      <div class="col-md-4">
        <label>DATE OF ISSUE:</label>
      </div>
      <div class="col-md-4">
        <div class="input-group date" data-date-format="YYYY-MM-DD"  id="timepickerdate_of_issue" data-target-input="nearest">
          <input type="text" id="date_of_issue" name="date_of_issue" class="form-control datetimepicker-input" data-target="#timepickerdate_of_issue"/>
            <div class="input-group-append" data-target="#timepickerdate_of_issue" data-toggle="datetimepicker">
               <div class="input-group-text"><i class="fa fa-calendar"></i></div>
            </div>
        </div>
      </div>
   </div>
</div>
<div class="form-group">
   <div class="row">
      <div class="col-md-4">
         <label for="name">NAME</label>
      </div>
      <div class="col-md-8">
         <input type="text" name="name" class="form-control" id="name" >
      </div>
   </div>
</div>
<div class="form-group">
   <div class="row">
      <div class="col-md-4">
         <label for="nik">NIK</label>
      </div>
      <div class="col-md-8">
         <input type="text" name="nik" class="form-control" id="nik" >
      </div>
   </div>
</div>
<div class="form-group">
   <div class="row">
      <div class="col-md-4">
         <label for="section">SECTION</label>
      </div>
      <div class="col-md-8">
         <input type="text" name="section" class="form-control" id="section" >
      </div>
   </div>
</div>
<div class="form-group">
  <div class="row">
    <div class="col-md-4">
      <label>COMPANY TO</label>
    </div>
    <div class="col-md-8">
      <select class="form-control select2" id="company_to" name="company_to" onchange="handleSelectChange_company_to(event)" style="width: 100%;">
        <option value='' selected="selected">-Select-</option>
        <?php
          foreach ($company_to as $value) {
			echo "<option value='$value->company_to'>$value->company_to-$value->company_address-$value->company_address1-$value->company_address2-$value->attention-$value->attention_departement-$value->email_and_telp</option>";
          }
        ?>
      </select>
    </div>
  </div>
</div>
<div class="form-group">
   <div class="row">
      <div class="col-md-4">
         <label for="company_address">COMPANY ADDRESS</label>
      </div>
      <div class="col-md-8">
         <input type="text" name="company_address" class="form-control" id="company_address" >
      </div>
   </div>
</div>
<div class="form-group">
   <div class="row">
      <div class="col-md-4">
         <label for="company_address1">COMPANY ADDRESS 1</label>
      </div>
      <div class="col-md-8">
         <input type="text" name="company_address1" class="form-control" id="company_address1" >
      </div>
   </div>
</div>
<div class="form-group">
   <div class="row">
      <div class="col-md-4">
         <label for="company_address2">COMPANY ADDRESS 2</label>
      </div>
      <div class="col-md-8">
         <input type="text" name="company_address2" class="form-control" id="company_address2" >
      </div>
   </div>
</div>
<div class="form-group">
   <div class="row">
      <div class="col-md-4">
         <label for="attention">ATTENTION</label>
      </div>
      <div class="col-md-8">
         <input type="text" name="attention" class="form-control" id="attention" >
      </div>
   </div>
</div>
<div class="form-group">
   <div class="row">
      <div class="col-md-4">
         <label for="attention_departement">ATTENTION DEPARTEMENT</label>
      </div>
      <div class="col-md-8">
         <input type="text" name="attention_departement" class="form-control" id="attention_departement" >
      </div>
   </div>
</div>
<div class="form-group">
   <div class="row">
      <div class="col-md-4">
         <label for="email_and_telp">EMAIL AND TELP</label>
      </div>
      <div class="col-md-8">
         <input type="text" name="email_and_telp" class="form-control" id="email_and_telp" >
      </div>
   </div>
</div>
<div class="form-group">
   <div class="row">
      <div class="col-md-4">
         <label for="detail_request">DETAIL REQUEST</label>
      </div>
      <div class="col-md-8">
         <input type="text" name="detail_request" class="form-control" id="detail_request" >
      </div>
   </div>
</div>
<div class="form-group">
   <div class="row">
      <div class="col-md-4">
         <label for="reference">REFERENCE</label>
      </div>
      <div class="col-md-8">
         <input type="text" name="reference" class="form-control" id="reference" >
      </div>
   </div>
</div>
<div class="form-group">
   <div class="row">
      <div class="col-md-4">
         <label for="budget">BUDGET</label>
      </div>
      <div class="col-md-8">
         <input type="text" name="budget" class="form-control" id="budget" >
      </div>
   </div>
</div>
							<div class="card card-primary">
                  <div class="card-header">
                    <h4 class="card-title">
                      <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwoapproval3">
                        <b>Detail Pembayaran</b>
                      </a>
                    </h4>
                  </div>                  
                  <div id="collapseTwoapproval3" class="panel-collapse collapse">
                    <div class="card-body">   
<div class="form-group">
   <div class="row">
      <div class="col-md-4">
         <label for="account">ACCOUNT</label>
      </div>
      <div class="col-md-8">
         <input type="text" name="account" class="form-control" id="account" >
      </div>
   </div>
</div>
<div class="form-group" clearfix>
   <div class="icheck-primary d-inline">
      <input type="radio" id="payment_terms" value="C30D" name="payment_terms">
      <label for="payment_terms">
					C30D
       </label>
   </div>
   <div class="icheck-primary d-inline">
      <input type="radio" id="payment_terms2" value="partial" name="payment_terms" >
       <label for="payment_terms2">
			 	Partial
       </label>
   </div>
</div>
<div class="form-group">
   <div class="row">
      <div class="col-md-4">
         <label for="transfer_to">TRANSFER TO</label>
      </div>
      <div class="col-md-8">
         <input type="text" name="transfer_to" class="form-control" id="transfer_to" >
      </div>
   </div>
</div>
<div class="form-group">
   <div class="row">
      <div class="col-md-4">
         <label for="transfer_address">TRANSFER ADDRESS</label>
      </div>
      <div class="col-md-8">
         <input type="text" name="transfer_address" class="form-control" id="transfer_address" >
      </div>
   </div>
</div>
<div class="form-group">
  <div class="row">
    <div class="col-md-4">
      <label>CURRENCY</label>
    </div>
    <div class="col-md-8">
      <select class="form-control select2" id="currency" name="currency" onchange="handleSelectChange_currency(event)" style="width: 100%;">
        <option value='' selected="selected">-Select-</option>
        <?php
          foreach ($currency as $value) {
          echo "<option value='$value->currency'>$value->currency</option>";
          }
        ?>
      </select>
    </div>
  </div>
</div>
<div class="form-group">
   <div class="row">
      <div class="col-md-4">
         <label for="idr">IDR</label>
      </div>
      <div class="col-md-8">
         <input type="text" name="idr" class="form-control" id="idr" >
      </div>
   </div>
</div>
<div class="form-group">
   <div class="row">
      <div class="col-md-4">
         <label for="usd">USD</label>
      </div>
      <div class="col-md-8">
         <input type="text" name="usd" class="form-control" id="usd" >
      </div>
   </div>
</div>
<div class="form-group">
   <div class="row">
      <div class="col-md-4">
         <label for="eur">EUR</label>
      </div>
      <div class="col-md-8">
         <input type="text" name="eur" class="form-control" id="eur" >
      </div>
   </div>
</div>
<div class="form-group">
   <div class="row">
      <div class="col-md-4">
         <label for="jpy">JPY</label>
      </div>
      <div class="col-md-8">
         <input type="text" name="jpy" class="form-control" id="jpy" >
      </div>
   </div>
</div>
<div class="form-group">
   <div class="row">
      <div class="col-md-4">
         <label for="swift_code">SWIFT CODE</label>
      </div>
      <div class="col-md-8">
         <input type="text" name="swift_code" class="form-control" id="swift_code" >
      </div>
   </div>
</div>
<div class="form-group">
   <div class="row">
      <div class="col-md-4">
         <label for="account_name">ACCOUNT NAME</label>
      </div>
      <div class="col-md-8">
         <input type="text" name="account_name" class="form-control" id="account_name" >
      </div>
   </div>
</div>
<div class="form-group">
   <div class="row">
      <div class="col-md-4">
         <label for="dpp">DPP</label>
      </div>
      <div class="col-md-8">
         <input type="text" name="dpp" class="form-control" id="dpp" >
      </div>
   </div>
</div>
<div class="form-group">
				<div class="row">
					<div class="col-md-4">
						<label for="vat_persen">VAT PERSEN</label>
					</div>
					<div class="col-md-8">
						<input type="text" name="vat_persen" class="form-control" id="vat_persen" >
					</div>
				</div>
				</div>
<div class="form-group">
   <div class="row">
      <div class="col-md-4">
         <label for="vat_nominal">VAT NOMINAL</label>
      </div>
      <div class="col-md-8">
         <input type="text" name="vat_nominal" class="form-control" id="vat_nominal" >
      </div>
   </div>
</div>
<div class="form-group">
   <div class="row">
      <div class="col-md-4">
         <label for="amount_total">AMOUNT TOTAL</label>
      </div>
      <div class="col-md-8">
         <input type="text" name="amount_total" class="form-control" id="amount_total" >
      </div>
   </div>
</div>
<div class="form-group">
   <div class="row">
      <div class="col-md-4">
         <label for="amount_in_word">AMOUNT IN WORD</label>
      </div>
      <div class="col-md-8">
         <input type="text" name="amount_in_word" class="form-control" id="amount_in_word" >
      </div>
   </div>
</div>
														</div>
                          </div>
                        </div>

								<div class="card card-danger">
                  <div class="card-header">
                    <h4 class="card-title">
                      <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwoapproval4">
                        <b>Detail Request </b>
                      </a>
                    </h4>
                  </div>                  
                  <div id="collapseTwoapproval4" class="panel-collapse collapse">
                    <div class="card-body">   
<div class="form-group">
  <div class="row">
    <div class="col-md-1">
      <a class="btn btn-success" id="attachment_1_view" target="_blank"> <i class="fa fa-paperclip"></i> </a>
    </div>
    <div class="col-md-4">
      <label for="attachment_1">ATTACHMENT 1</label>
    </div>
    <div class="col-md-7">
       <div class="custom-file">
         <input type="file" class="custom-file-input" id="attachment_1" multiple="" name="attachment_1">
         <label class="custom-file-label" for="attachment_1" id="attachment_1_label">Choose file</label>
       </div>
    </div>
  </div>
</div>
<div class="form-group">
  <div class="row">
    <div class="col-md-1">
      <a class="btn btn-success" id="attachment_2_view" target="_blank"> <i class="fa fa-paperclip"></i> </a>
    </div>
    <div class="col-md-4">
      <label for="attachment_2">ATTACHMENT 2</label>
    </div>
    <div class="col-md-7">
       <div class="custom-file">
         <input type="file" class="custom-file-input" id="attachment_2" multiple="" name="attachment_2">
         <label class="custom-file-label" for="attachment_2" id="attachment_2_label">Choose file</label>
       </div>
    </div>
  </div>
</div>
<div class="form-group">
  <div class="row">
    <div class="col-md-1">
      <a class="btn btn-success" id="attachment_3_view" target="_blank"> <i class="fa fa-paperclip"></i> </a>
    </div>
    <div class="col-md-4">
      <label for="attachment_3">ATTACHMENT 3</label>
    </div>
    <div class="col-md-7">
       <div class="custom-file">
         <input type="file" class="custom-file-input" id="attachment_3" multiple="" name="attachment_3">
         <label class="custom-file-label" for="attachment_3" id="attachment_3_label">Choose file</label>
       </div>
    </div>
  </div>
</div>
<div class="form-group">
  <div class="row">
    <div class="col-md-1">
      <a class="btn btn-success" id="attachment_4_view" target="_blank"> <i class="fa fa-paperclip"></i> </a>
    </div>
    <div class="col-md-4">
      <label for="attachment_4">ATTACHMENT 4</label>
    </div>
    <div class="col-md-7">
       <div class="custom-file">
         <input type="file" class="custom-file-input" id="attachment_4" multiple="" name="attachment_4">
         <label class="custom-file-label" for="attachment_4" id="attachment_4_label">Choose file</label>
       </div>
    </div>
  </div>
</div>
<div class="form-group">
   <div class="row">
      <div class="col-md-4">
         <label for="director">DIRECTOR</label>
      </div>
      <div class="col-md-8">
         <input type="text" name="director" class="form-control" id="director" >
      </div>
   </div>
</div>
<div class="form-group">
   <div class="row">
      <div class="col-md-4">
         <label for="title">TITLE</label>
      </div>
      <div class="col-md-8">
         <input type="text" name="title" class="form-control" id="title" >
      </div>
   </div>
</div>
					</div>
        </div>
     </div>

		 <?php if ($menu_name == 'Debit Note') { ?> 
			<div class="form-group">
   <div class="row">
      <div class="col-md-4">
         <label for="status">status</label>
      </div>
      <div class="col-md-8">
         <input type="text" name="status" class="form-control" id="status" readonly>
      </div>
   </div>
</div>
<div class="form-group">
   <div class="row">
      <div class="col-md-4">
         <label for="status_transaction">status transaction</label>
      </div>
      <div class="col-md-8">
         <input type="text" name="status_transaction" class="form-control" id="status_transaction" readonly>
      </div>
   </div>
</div>
   <?php } ?> 


















                <!---------------------------------- / Form Macro Batas sini ---------------------------------->

                <!-- Close Card Body -->  
                </div>
                  
                  <div class="card-footer">
                    <button type="submit" class="btn btn-primary" id="btnsubmit">Save</button>                 
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> 
										<?php if ($menu_name == 'Summary Debit Note') { ?> 
                  <tr>
                    <td colspan="1">  </td>
                    <!-- <td colspan="10">  -->
									<div class="btn btn-success btn-sm konfirmasiApprove" data-id='' data-toggle="modal" data-target="#modal-confirm-approve" id="btn_approve_footer" > Approve <i class="far fa-thumbs-up"></i></div> <!--fungsi untuk approve-->    
                  <div class="btn btn-danger btn-sm konfirmasiReject" data-id='' data-toggle="modal" data-target="#modal-reject" id="btn_reject_footer" > Reject <i class="far fa-thumbs-down"></i></div> <!--fungsi  untuk reject-->       
                    </td>
                  </tr>
                    <?php } ?>            
                  </div>

						
                               
              </form>    
              <!-- /form  -->

            </div> 
            <!-- Close modal-content -->  
        </div>
        <!-- Close modal-dialog -->  
      </div>
      <!-- Close modal-Add / Update -->  

      <!-- modal-delete -->
      <div class="modal fade" id="modal-delete">
        <div class="modal-dialog">
          <div class="modal-content bg-danger">
            <div class="modal-header">
              <h4 class="modal-title">Danger Modal</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>

            <div class="modal-body">
               <label id="iddelete2" hidden> </label>Apakah ingin delete <label id="iddelete"> </label> ?              
            </div>

            <div class="modal-footer justify-content-between">             
              <form action="#" method="post">
                 <button type="button" id="delete" onclick="Delete_data()" class="btn btn-outline-light">Yes</button>    
              </form>     
              <button type="button" class="btn btn-outline-light" data-dismiss="modal">No</button>       
            </div>

          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal Delete-->

	  
	  <!-- modal-confirm-approve -->
      <div class="modal fade" id="modal-confirm-approve">
        <div class="modal-dialog">
          <div class="modal-content bg-success">

            <div class="modal-header">
              <h4 class="modal-title">Approval confirmation</h4>   
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>

            <div class="modal-body">
              <label id="idapprove2"  > </label>Apakah ingin approve <label id="idapprove" hidden > </label> ?
              <label id="idposition_code" hidden > </label>
              <br>
              <label id="lblposition"  > </label>
              <br>
              <label id="lbluserconfirm" hidden > <?php echo $this->session->userdata('name'); ?> </label> 
              <label id="iduserlogin" hidden > <?php echo $this->session->userdata('user_name'); ?> </label>
            </div>
                            
            <div class="modal-footer justify-content-between">

              <button type="button" id="approve" onclick="Approve_data()" class="btn btn-outline-light">Approve</button>
              <button type="button" class="btn btn-outline-light" data-dismiss="modal">Cancel</button>

            </div>

          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->

      <!-- modal-confirm-reject -->
      <div class="modal fade" id="modal-reject">
        <div class="modal-dialog">
          <div class="modal-content bg-danger">
            <div class="modal-header">
              <h4 class="modal-title">Reason reject</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>


            <div class="modal-body">
              
              <div class="form-group">
                <div class="row">
                  <div class="col-md-2">
                    <label for="reason">REASON</label>
                  </div>
                  <div class="col-md-10">
                    <textarea rows="2" type="text" name="reason" class="form-control" id="reason"></textarea>
                  </div>
                </div>
              </div>

            </div>

            <div class="modal-footer justify-content-between">

              <input type="text" name="rejecter" value="<?php echo $this->session->userdata('name') ?>" class="form-control" id="rejecter" hidden>
              <input type="text" name="idreject" class="form-control" id="idreject" hidden>
              <button type="button" id="process_reject" onclick="Reject_data3()" class="btn btn-outline-light">Reject</button>
              <button type="button" class="btn btn-outline-light" data-dismiss="modal">Cancel</button>

            </div>

          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal Reject-->
      <!-- Akhir modal approve -->


      <!-- modal-import -->
      <div class="modal fade" id="modal-import">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Import Data</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>

            <div class="modal-body">
               
              <form method="POST" action="<?php echo base_url('c_dn2/import'); ?>" enctype="multipart/form-data">

                  <div class="input-group form-group">
                    <span class="input-group-addon" id="sizing-addon2">
                      <i class="glyphicon glyphicon-file"></i>
                    </span>
                    <input type="file" class="form-control" name="excel" aria-describedby="sizing-addon2">
                  </div>

                  <div class="form-group">
                    <div class="col-md-12">
                        <button type="submit" class="form-control btn btn-primary"> <i class="glyphicon glyphicon-ok"></i>Import Data</button>
                    </div>
                  </div>

              </form>
              
            </div>

            <div class="modal-footer justify-content-between">   
              
              <!-- <button type="button" id="delete"  class="btn btn-outline-light">Import</button>     -->               
              <!-- <button type="button" class="btn btn-outline-light" data-dismiss="modal">No</button>  -->              

            </div>

          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal Delete-->

      

<script type="text/javascript">

  $(document).ready(function () {

    $.validator.setDefaults({
      submitHandler: function () {

        //berhasil( "Form successful submitted!" );
        var status=$('#exampleModalLabel').text();
       
        if (status=="Add Data"){

          // Ajax insert data
           Simpan_data("Add");

        }else if(status=="Edit Data"){

           // Ajax update data
           Simpan_data("Update");

        }else{

          berhasil(status);

        }

      }
    });

    $('#quickForm').validate({
      rules: {

				// ---------------------------------- Rule input Macro Batas sini 1---------------------------------
				date_of_issue: {
				required: true,
				},
				name: {
				required: true,
				},
				nik: {
				required: true,
				},
				section: {
				required: true,
				},
				company_to: {
				required: true,
				},
				company_address: {
				required: true,
				},
				company_address1: {
				required: true,
				},
				company_address2: {
				required: true,
				},
				attention: {
				required: true,
				},
				attention_departement: {
				required: true,
				},
				// email_and_telp: {
				// required: true,
				// },
				detail_request: {
				required: true,
				},
				reference: {
				required: true,
				},
				budget: {
				required: true,
				},
				account: {
				required: true,
				},
				payment_terms: {
				required: true,
				},
				transfer_to: {
				required: true,
				},
				transfer_address: {
				required: true,
				},
				currency: {
				required: true,
				},
				idr: {
				required: true,
				},
				usd: {
				required: true,
				},
				eur: {
				required: true,
				},
				jpy: {
				required: true,
				},
				swift_code: {
				required: true,
				},
				account_name: {
				required: true,
				},
				dpp: {
				required: true,
				},
				vat_persen: {
				required: true,
				},
				vat_nominal: {
				required: true,
				},
				amount_total: {
				required: true,
				},
				amount_in_word: {
				required: true,
				},
				attachment_1: {
				required: true,
				},
				attachment_2: {
				required: true,
				},
				attachment_3: {
				required: true,
				},
				attachment_4: {
				required: true,
				},
				director: {
				required: true,
				},
				title: {
				required: true,
				},




        // ---------------------------------- / Rule input Macro Batas sini 1--------------------------------

      },
      messages: {
    
				// ---------------------------------- Rule input Macro Batas sini 2---------------------------------
				// date_of_issue: {
				// required: "Please Input date_of_issue",
				// minlength: 3
				// },
				// name: {
				// required: "Please Input name",
				// minlength: 3
				// },
				// nik: {
				// required: "Please Input nik",
				// minlength: 3
				// },
				// section: {
				// required: "Please Input section",
				// minlength: 3
				// },
				// company_to: {
				// required: "Please Input company_to",
				// minlength: 3
				// },
				// company_address: {
				// required: "Please Input company_address",
				// minlength: 3
				// },
				// company_address1: {
				// required: "Please Input company_address1",
				// minlength: 3
				// },
				// company_address2: {
				// required: "Please Input company_address2",
				// minlength: 3
				// },
				// attention: {
				// required: "Please Input attention",
				// minlength: 3
				// },
				// attention_departement: {
				// required: "Please Input attention_departement",
				// minlength: 3
				// },
				// email_and_telp: {
				// required: "Please Input email_and_telp",
				// minlength: 3
				// },
				// detail_request: {
				// required: "Please Input detail_request",
				// minlength: 3
				// },
				// reference: {
				// required: "Please Input reference",
				// minlength: 3
				// },
				// budget: {
				// required: "Please Input budget",
				// minlength: 3
				// },
				// account: {
				// required: "Please Input account",
				// minlength: 3
				// },
				// payment_terms: {
				// required: "Please Input payment_terms",
				// minlength: 3
				// },
				// transfer_to: {
				// required: "Please Input transfer_to",
				// minlength: 3
				// },
				// transfer_address: {
				// required: "Please Input transfer_address",
				// minlength: 3
				// },
				// currency: {
				// required: "Please Input currency",
				// minlength: 3
				// },
				// idr: {
				// required: "Please Input idr",
				// minlength: 3
				// },
				// usd: {
				// required: "Please Input usd",
				// minlength: 3
				// },
				// eur: {
				// required: "Please Input eur",
				// minlength: 3
				// },
				// jpy: {
				// required: "Please Input jpy",
				// minlength: 3
				// },
				// swift_code: {
				// required: "Please Input swift_code",
				// minlength: 3
				// },
				// account_name: {
				// required: "Please Input account_name",
				// minlength: 3
				// },
				// dpp: {
				// required: "Please Input dpp",
				// minlength: 3
				// },
				// vat_persen: {
				// required: "Please Input vat_persen",
				// minlength: 3
				// },
				// vat_nominal: {
				// required: "Please Input vat_nominal",
				// minlength: 3
				// },
				// amount_total: {
				// required: "Please Input amount_total",
				// minlength: 3
				// },
				// amount_in_word: {
				// required: "Please Input amount_in_word",
				// minlength: 3
				// },
				// attachment_1: {
				// required: "Please Input attachment_1",
				// minlength: 3
				// },
				// attachment_2: {
				// required: "Please Input attachment_2",
				// minlength: 3
				// },
				// attachment_3: {
				// required: "Please Input attachment_3",
				// minlength: 3
				// },
				// attachment_4: {
				// required: "Please Input attachment_4",
				// minlength: 3
				// },
				// director: {
				// required: "Please Input director",
				// minlength: 3
				// },
				// title: {
				// required: "Please Input title",
				// minlength: 3
				// },







        // ---------------------------------- / Rule input Macro Batas sini 2--------------------------------


      },
      errorElement: 'span',
      errorPlacement: function (error, element) {
        error.addClass('invalid-feedback');
        element.closest('.form-group').append(error);
      },
      highlight: function (element, errorClass, validClass) {
        $(element).addClass('is-invalid');
      },
      unhighlight: function (element, errorClass, validClass) {
        $(element).removeClass('is-invalid');
      }
    });
  });
</script>

<script type="text/javascript">

  /// @see  Approve_data() 
    /// @note untuk fungsi approve dalam table
    /// @attention tabel akan menampilkan siapa saja melakukan approve
	function Approve_data() {


var fdata2 = new FormData();

fdata2.append('hdrid',$('#hdrid').val());
fdata2.append('nik', $('#iduserlogin').text());
fdata2.append('nikreq',$('#nik').val());
fdata2.append('name', $('#name').val()); // Ganti dengan nik val 
fdata2.append('position_code', $('#idposition_code').text());

var vurl2; 
vurl2 = "<?php echo base_url('C_email_v2/ajax_update_approve')?>"; //fungsi approve akan dikirim ke  email

$.ajax({
		  url: vurl2,
		  method: "post",
		  processData: false,
		  contentType: false,
		  data: fdata2,
		  success: function (data) {                 
			  // Pesan berhasil  

				  $('#modal-confirm-approve').modal('hide');
				  $('#modal-default').modal('hide');
				  berhasil("Berhasil");
				  location.reload();
		  },
		  error: function (e) {
			  // gagal(e);
			  // //location.reload();
			  // error
				  $('#modal-confirm-approve').modal('hide');
				  $('#modal-default').modal('hide');
				  berhasil("Berhasil");
				  location.reload();

		  }
	  });

	  tabel.draw();
	  tabel2.draw();
	  tabel3.draw();
}


/// @see  Reject_data3() 
/// @note untuk fungsi reject dalam table
/// @attention tabel akan menampilkan siapa saja melakukan reject
	function Reject_data3() {

	// Validasi reason harus diisi
	if ($('#reason').val() == '') {
	  gagal('Reason wajib diisi');
	  return false;
	}

	var fdata2 = new FormData();

	fdata2.append('hdrid',$('#hdrid').val());
	fdata2.append('nik', $('#iduserlogin').text());
	fdata2.append('name', $('#name').val());
	fdata2.append('nikreq', $('#nik').val());
	fdata2.append('rejected_by', $('#lbluserconfirm').text());
	fdata2.append('reason', $('#reason').val());
	fdata2.append('position_code', $('#idposition_code').text());

	vurl = "<?php echo base_url('C_email_v2/ajax_update_reject') ?>";

	// Post data
	$.ajax({
	  url: vurl,
	  method: "post",
	  processData: false,
	  contentType: false,
	  data: fdata2,
	  success: function(data) {

		// Hide modal delete
		$('#modal-reject').modal('hide');
		$('#modal-default').modal('hide');
		tabel.draw();
		berhasil('Berhasil Reject');
		location.reload();
	  },
	  error: function(e) {
		// Hide modal delete
		$('#modal-reject').modal('hide');
		$('#modal-default').modal('hide');
		tabel.draw();
		//Pesan Gagal
		// gagal(e);
		berhasil('Berhasil Reject');
		location.reload();
	  }
	});

	}
  // Untuk Add,Edit,delete.
  
  function view_modal(hdrid1,status){
                             
          if (status=="Add"){

            $('#exampleModalLabel').text('Add Data');  // name view
            $('#quickForm')[0].reset(); // reset form   
            $('#btnsubmit').text('Save'); // name Save
            document.getElementById("btnsubmit").style.visibility = "visible";    // Visible button              
            //Ajax kosongkan data

          }else {
           
            // Get Hdri ID
            $('#hdrid').val(hdrid1);
            var hdrid=hdrid1;   

            // Ajax isi data
              $.ajax({
              url: "<?php echo base_url('C_dn2/ajax_getbyhdrid')?>",
              method: "get",
              dataType : "JSON",              
              data: {hdrid:hdrid1},
              success: function (data) {

   		            // ---------------------------------- Data val Macro Batas sini ---------------------------------                  
					   $('#date_of_issue').val(data.date_of_issue);	
						$('#name').val(data.name);	
						$('#nik').val(data.nik);	
						$('#section').val(data.section);	
						$('#company_to').select2().val(data.company_to).trigger('change');	
						$('#company_address').val(data.company_address);	
						$('#company_address1').val(data.company_address1);	
						$('#company_address2').val(data.company_address2);	
						$('#attention').val(data.attention);	
						$('#attention_departement').val(data.attention_departement);	
						$('#email_and_telp').val(data.email_and_telp);	
						$('#detail_request').val(data.detail_request);	
						$('#reference').val(data.reference);	
						$('#budget').val(data.budget);	
						$('#account').val(data.account);	

						// if(data.payment_terms=='payment_terms'){	
						// document.getElementById('payment_terms').checked=true;	
						// }else	
						// {	
						// document.getElementById('payment_terms2').checked=true;	
						// }	

						if(data.payment_terms=='C30D'){
								document.getElementById('payment_terms').checked=true;
						}else if(data.payment_terms=='partial'){
								document.getElementById('payment_terms2').checked=true;
						}else{
								document.getElementById('payment_terms').checked=false;
								document.getElementById('payment_terms2').checked=false;
						}
						
						$('#transfer_to').val(data.transfer_to);	
						$('#transfer_address').val(data.transfer_address);	
						$('#currency').select2().val(data.currency).trigger('change');	
						$('#idr').val(data.idr);	
						$('#usd').val(data.usd);	
						$('#eur').val(data.eur);	
						$('#jpy').val(data.jpy);	
						$('#swift_code').val(data.swift_code);	
						$('#account_name').val(data.account_name);	
						$('#dpp').val(data.dpp);	
						$('#vat_persen').val(data.vat_persen);	
						$('#vat_nominal').val(data.vat_nominal);	
						$('#amount_total').val(data.amount_total);	
						$('#amount_in_word').val(data.amount_in_word);	
						document.getElementById('attachment_1_label').innerHTML=data.attachment_1;	
						var a = document.getElementById('attachment_1_view');	
						if(!data.attachment_1==''){	
						a.href = "<?php echo base_url('assets/upload/dn2/') ?>" + data.attachment_1;	
						}else{	
						a.removeAttribute("href");	
						};	
						document.getElementById('attachment_2_label').innerHTML=data.attachment_2;	
						var a = document.getElementById('attachment_2_view');	
						if(!data.attachment_2==''){	
						a.href = "<?php echo base_url('assets/upload/dn2/') ?>" + data.attachment_2;	
						}else{	
						a.removeAttribute("href");	
						};	
						document.getElementById('attachment_3_label').innerHTML=data.attachment_3;	
						var a = document.getElementById('attachment_3_view');	
						if(!data.attachment_3==''){	
						a.href = "<?php echo base_url('assets/upload/dn2/') ?>" + data.attachment_3;	
						}else{	
						a.removeAttribute("href");	
						};	
						document.getElementById('attachment_4_label').innerHTML=data.attachment_4;	
						var a = document.getElementById('attachment_4_view');	
						if(!data.attachment_4==''){	
						a.href = "<?php echo base_url('assets/upload/dn2/') ?>" + data.attachment_4;	
						}else{	
						a.removeAttribute("href");	
						};	
						$('#director').val(data.director);	
						$('#title').val(data.title);	

                    






                  // ---------------------------------- / Data val Macro  Batas sini ------------------------------

                                                           
                  },
              error: function (e) {
                      alert(e);
                     
                  }
            });
            
            // Disable and button submit dan text form           
            if(status=="View"){
              document.getElementById("btnsubmit").style.visibility = "hidden";  
              $('#exampleModalLabel').text('View Data'); //name view              
            }else{
              $('#exampleModalLabel').text('Edit Data'); //name view 
              $('#btnsubmit').text('Update'); //name Update  
              document.getElementById("btnsubmit").style.visibility = "visible"; 
            }
          
          }

  }

</script>

<script type="text/javascript">

   function Simpan_data($trigger){

          // Form data
          var fdata = new FormData();
          
          // Form data collect name value
          var form_data = $('#quickForm').serializeArray();
          $.each(form_data, function (key, input) {
            fdata.append(input.name, input.value);
          });
          
          // Penanganan jika ada type check Box uncheck
          $('#quickForm input[type="checkbox"]:not(:checked)').each(function(i, e) {           
              fdata.append(e.getAttribute("name"),"Off");
          });

          // Penanganan jika ada type attach file
          $('#quickForm input[type="file"]').each(function(i, e) {     
              // jika ada file attach maka akan ditambahkan  
              if ($('#'+e.getAttribute("name")).val()) {   
                var file_data = $('#'+e.getAttribute("name")).prop('files')[0];
                fdata.append(e.getAttribute("name"),file_data);                            
              }
          });

          // Print_r(file_data);

          // Simpan or Update data          
          var vurl; 
          if($trigger == 'Add') {            
            vurl = "<?php echo base_url('C_dn2/ajax_add')?>";
          } else {           
            vurl = "<?php echo base_url('C_dn2/ajax_update')?>";
          }
                  
          $.ajax({
              url: vurl,
              method: "post",
              processData: false,
              contentType: false,
              data: fdata,
              success: function (data) {
                 
                   // Pesan berhasil
                   berhasil(data.status);
                   // Reset Form
                   $('#quickForm')[0].reset();               
                   // location.reload();
                    tabel.draw();

                   if(!vurl=="Add"){
                     $("#modal-default").modal('hide');
                   }
                 
              },
              error: function (e) {
                  gagal(e);
                  //location.reload();
                  //error
              }
          });

  }


  function Delete_data(){

      // Form data
      var fdata = new FormData();
     
      // Delete by Hdrid
      fdata.append('hdrid',$('#iddelete').text());
      // Url Post delete
      vurl = "<?php echo base_url('C_dn2/ajax_delete')?>";

      // Post data
      $.ajax({
          url: vurl,
          method: "post",
          processData: false,
          contentType: false,
          data: fdata,
          success: function (data) {

              // Hide modal delete
              $('#modal-delete').modal('hide');
              // Delete rows datatables
              $('#example1').DataTable().row("#"+$('#iddelete2').text()).remove().draw();
              // Pesan berhasil
              berhasil(data.status);   

          },
          error: function (e) {
              //Pesan Gagal
              gagal(e);             
          }
      });

  }

  function Send_mail(){

    // Url Post delete
    vurl = "<?php echo base_url('C_Email/Send_mail')?>";
    // Form data
    var fdata = new FormData();
    fdata.append('hdrid','Hdrid123');

    // Post data
    $.ajax({
        url: vurl,
        method: "post",
        processData: false,
        contentType: false,
        data: fdata,
        success: function (data) {
        },
        error: function (e) {
            //Pesan Gagal
            //gagal(e);             
        }
    });

  }

 
</script>

<!-- ***************************** Handle Button di datatable (View,edit,delete,row selected) ***************************** -->
<script type="text/javascript">

    //  HDRID selected konfirmasiHapus
    $(document).on("click", ".konfirmasiHapus", function() {        
        $('#iddelete').text($(this).attr("data-id")); 
    })

    //  HDRID selected  konfirmasiEdit
    $(document).on("click", ".konfirmasiEdit", function() {     
      view_modal($(this).attr("data-id"),'Edit');
    })
     
    //  HDRID selected  konfirmasiEdit
    $(document).on("click", ".konfirmasiView", function() {   
      view_modal($(this).attr("data-id"),'View');
    })

    // ID Rows selected
    $('#example1').on( 'click', 'tr', function () {
          $('#iddelete2').text($('#example1').DataTable().row( this ).id());             
    } );

</script>


<script type="text/javascript">

   $('.select2').select2();

    //Date range picker
    $('#reservationdate').datetimepicker({
            format: 'L'           
    });

    
    //Date range picker
    $('#startdate').datetimepicker({
            format: 'L'           
    });

    //Date range picker
    $('#enddate').datetimepicker({
            format: 'L'           
    });

</script>

<!-- <script type="text/javascript">
  document.getElementById('btnsubmit2').onclick = function() {
    var select = document.getElementById('multiple');
    var selected = [...select.options]
                      .filter(option => option.selected)
                      .map(option => option.value);
    alert(selected);
  } 
</script> -->

<!-- Handle datatable -->
<script type="text/javascript">

    var tabel = null;
    $(document).ready(function() {

        tabel = $('#example1').DataTable({
            "processing": true,
            "responsive":true,
            "serverSide": true,
            "ordering": true, // Set true agar bisa di sorting
            "order": [[ 0, 'asc' ]], // Default sortingnya berdasarkan kolom / field ke 0 (paling pertama)
						"createdRow" : function (row, data, dataIndex){
							if (data.status == 'Approve') {
                $(row).css("background-color", "#7FFFD4");                   
              }
              else if (data.status == 'Reject') {                      
                $(row).css("background-color", "pink");                  
              }
              else {
                $(row).css("background-color", "#FFFFFF");               
              }
						},
            dom: "lfBrtip",
            buttons: [
            {
              extend: 'copyHtml5',
              className: 'btn btn-secondary',
              text: '<i class="fas fa-copy">&nbsp</i> Copy Data to Clipboard',
            },
            {
              extend: 'csvHtml5',
              className: 'btn btn-info',
              text: '<i class="fas fa-file-csv">&nbsp</i> Export Data to CSV',
            },
            {
              extend: 'excelHtml5',
              className: 'btn btn-success',
              text: '<i class="fas fa-file-excel">&nbsp</i> Export Data to Excel',
              customize: function ( xlsx ){
                var sheet = xlsx.xl.worksheets['sheet1.xml'];
                // jQuery selector to add a border
                $( 'row c', sheet ).attr( 's', '25' );
              }
            },
            {
              extend : 'pdfHtml5',             
              className: 'btn btn-danger',
              text: '<i class="fas fa-file-pdf">&nbsp</i> Export Data to PDF',
              orientation : 'landscape',
              pageSize : 'A4',
              download: 'open'
            }
          ],
            "ajax":
            {
                "url": "<?= base_url('C_dn2/view_data_where');?>", // URL file untuk proses select datanya
                "type": "POST",
                "data": function(data){     
                  data.searchByFromdate = $('#search_fromdate').val();
                  data.searchByTodate = $('#search_todate').val();
                }

            },
            "deferRender": true,
            "aLengthMenu": [[5, 10,100,1000,10000,100000,1000000,1000000000],[ 5, 10, 100,1000,10000,100000,1000000,"All"]], // Combobox Limit
            "columns": [
               {"data": 'hdrid',"sortable": false, //1
                    render: function (data, type, row, meta) {
                        // return meta.row + meta.settings._iDisplayStart + 1;
                        // return '<div class="btn btn-success btn-sm konfirmasiView" data-id="'+ data +'" data-toggle="modal" data-target="#modal-default" > <i class="fa fa-eye"></i></div> <div class="btn btn-danger btn-sm konfirmasiHapus" data-id="'+ data +'" data-toggle="modal" data-target="#modal-delete" > <i class="fa fa-trash"></i></div> <div class="btn btn-primary btn-sm konfirmasiEdit" data-id="'+ data +'" data-toggle="modal" data-target="#modal-default"> <i class="fa fa-edit"></i></div>';
                        mnu='';
                        mnu=mnu+'<div class="btn btn-success btn-sm konfirmasiView  mr-2" data-id="'+ data +'" data-toggle="modal" data-target="#modal-default" > <i class="fa fa-eye"></i></div>';
                        //Tombol Edit
                        <?php if(!empty($hak_akses)){ if ($hak_akses->allow_edit=='on') { ?>
                            mnu=mnu+'<div class="btn btn-primary btn-sm konfirmasiEdit" data-id="'+ data +'" data-toggle="modal" data-target="#modal-default"> <i class="fa fa-edit"></i></div>';
                        <?php } } ?>

                        //Tombol Delete
                        <?php if(!empty($hak_akses)){ if ($hak_akses->allow_delete=='on') { ?>
                            mnu=mnu+'<div class="btn btn-danger btn-sm konfirmasiHapus" data-id="'+ data +'" data-toggle="modal" data-target="#modal-delete" > <i class="fa fa-trash"></i></div>';
                        <?php } } ?>
												mnu = mnu + ' <a class="btn btn-secondary btn-sm mr-2"  href="<?php echo base_url('C_Print_dn/print_dn?var1=') . "'+ data +' &var2='+ row.hdrid +'&var3=1"?>"  target="_blank"> <i class="fas fa-print mr-1"></i>A4</a>'        

                    
						return mnu;
						

                    }  
                },
                
                // ---------------------------------- Datatables Macro Batas sini ---------------------------------
                 
				{"data":"hdrid"},
				{"data":"date_of_issue"},
				{"data":"name"},
				{"data":"nik"},
				{"data":"section"},
				{"data":"company_to"},
				{"data":"company_address"},
				{"data":"company_address1"},
				{"data":"company_address2"},
				{"data":"attention"},
				{"data":"attention_departement"},
				{"data":"email_and_telp"},
				{"data":"detail_request"},
				{"data":"reference"},
				{"data":"budget"},
				{"data":"account"},
				{"data":"payment_terms"},
				{"data":"transfer_to"},
				{"data":"transfer_address"},
				{"data":"currency"},
				{"data":"idr"},
				{"data":"usd"},
				{"data":"eur"},
				{"data":"jpy"},
				{"data":"swift_code"},
				{"data":"account_name"},
				{"data":"dpp"},
				{"data":"vat_persen"},
				{"data":"vat_nominal"},
				{"data":"amount_total"},
				{"data":"amount_in_word"},
				{"data":"attachment_1"},
				{"data":"attachment_2"},
				{"data":"attachment_3"},
				{"data":"attachment_4"},
				{"data":"director"},
				{"data":"title"},
				{"data":"status"},
				{"data":"status_transaction"},


                // {"data": 'report_no',"sortable": false, //1
                //     render: function (data, type, row) {
                                               
                //         // return '<h1 class="mycus-class2">'+data+'</h1>'
                //         return '<div class="progress progress-xm bg-dark " style="border-radius: 10px;">'+
                //                   '<div class="progress-bar progress-bar bg-yellow" style="width: 50% ">'+'</div>'+
                //                 '</div>'
                //     }
                //   },
                
                






                // ---------------------------------- / Datatables Macro Batas sini --------------------------------

            ],


        });

        // Search button
        $('#search').click(function(){

          
            if($('#search_fromdate').val() != '' && $('#search_todate').val() !='')
            {
                tabel.draw();
            }
            else
            {
              gagal("Both Date is Required");
            }

        });


    });
    
</script>


<script type="text/javascript">

    function vreadonly(form,vboolean){
    
      // alert(form);

      // var x = $(form).serializeArray();

      // $.each(x, function(i, field){

      //   if(field.name=="hdrid"){
      //     if(vboolean==true){
      //       document.getElementsByName(field.name)[0].readOnly=true;
      //     }else{
      //       document.getElementsByName(field.name)[0].readOnly=false;
      //     }
      //   }
        

      // });

     
    }

</script>

<script type="text/javascript">
  $(document).ready(function () {
    bsCustomFileInput.init();
  });
</script>


<script type="text/javascript">

  function handleSelectChange_tb_dn2_id(event) {

  var data = $('#tb_dn2_id').select2('data')[0].text;

  if (data=='-Select-'){
    $('#tb_dn2_name').val('');   
  }else{
    var res = data.split("-");
    $('#tb_dn2_name').val(res[1]);
  };

  }


/// @see handleSelectChange_company_to
/// @note fungsi untuk menarik data dari table
/// @attention data sudah otomatis muncul jika sudah disetting select filter
function handleSelectChange_company_to(event) {

var data = $('#company_to').select2('data')[0].text;

if (data=='-Select-'){
	$('#company_to').val('');   
	$('#company_address').val('');
	$('#company_address1').val('');
	$('#company_address2').val('');
	$('#attention').val('');
	$('#attention_departement').val('');
	$('#email_and_telp').val('');
}else{
	var res = data.split("-");
	$('#company_to').val(res[0]);
	$('#company_address').val(res[1]);
	$('#company_address1').val(res[2]);
	$('#company_address2').val(res[3]);
	$('#attention').val(res[4]);
	$('#attention_departement').val(res[5]);
	$('#email_and_telp').val(res[6]);
  };


}

   /// @see   handleSelectChange_currency
/// @note fungsi untuk menarik data dari table
/// @attention data sudah otomatis muncul jika sudah disetting select filter
function handleSelectChange_currency(event) {
              
//  By Text
 var value = $("#currency option:selected").text();  
var res = value.split("-");
			  
}




  function handleSelectChange_nik(event) {
 
  //  By Text
  var value = $("#nik option:selected").text();  
  var res = value.split("-");
  // $('#acc_number').val(res[0]);
  $('#name').val(res[1]);

  }

  function handleSelectChange_section(event) {

 //  By Value
  var selectElement = event.target;
  var value = selectElement.value;
  var res = value.split("-");
  // $('#acc_number').val(res[0]);
  // $('#name').val(res[1]);

  }
</script>






