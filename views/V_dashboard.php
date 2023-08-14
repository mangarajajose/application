
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark" hidden>Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Dashboard v1</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->




<!-- /.col (LEFT) -->


<!-- <div class="col-md-4"> -->

 
	<!-- DONUT CHART -->
	<!-- <div class="card card-danger">
		<div class="card-header">
			<h3 class="card-title">Historycal Claim By FY</h3>

			<div class="card-tools">
				<button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
				</button>
				<button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
			</div>
		</div>
		<div class="card-body" id="donutReport">
			<canvas id="donutChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
		</div> -->
		<!-- /.card-body -->
	<!-- </div> -->
	<!-- /.card -->

<!-- </div> -->
<!-- /.col (LEFT) -->

<!-- /.row -->



<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<body>
    <!-- Elemen untuk menampilkan grafik -->
    <canvas id="myChart"></canvas>

    <script>
        // Data yang ingin ditampilkan dalam grafik
        var data = {
            labels: ['Label 1', 'Label 2', 'Label 3'],
            datasets: [{
                label: 'Contoh Grafik',
                data: [5, 12, 5], // Data nilai
                backgroundColor: ['red', 'blue', 'green'] // Warna batang
            }]
        };

        // Konfigurasi grafik
        var config = {
            type: 'bar', // Jenis grafik
            data: data,
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        };

        // Membuat grafik menggunakan Chart.js
        var myChart = new Chart(document.getElementById('myChart'), config);
    </script>
</body>

<div class="row">

<div class="col-md-4" style="margin-top: -130px;">
	<div class="card card-primary">
		<div class="card-body p-0">
			<!-- THE CALENDAR -->
			<div id="calendar"></div>
		</div>
		<!-- /.card-body -->
	</div>
	<!-- /.card -->

</div>
<!-- /.col (RIGHT) -->

<div class="col-md-4">
	<!-- LINE CHART -->
	<div class="card card-info">
		<div class="card-header">
			<h3 class="card-title">Customer Claim by Case </h3>
										
			<div class="card-tools">
				<button type="button" class="btn btn-tool" data-card-widget="collapse">
					<i class="fas fa-minus"></i>
				</button>
				<button type="button" class="btn btn-tool" data-card-widget="remove">
					<i class="fas fa-times"></i>
				</button>
			</div>
		</div>
		<div class="card-body">
			<div class="chart" id="linechart2report">
				<canvas id="lineChart2" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
			</div>
		</div>
		<!-- /.card-body -->
	</div>
	<!-- col -->
</div>

<div class="col-md-4">
	<!-- LINE CHART -->
	<div class="card card-info">
		<div class="card-header">
			<h3 class="card-title">Customer Claim by DNCN </h3>

			<div class="card-tools">
				<button type="button" class="btn btn-tool" data-card-widget="collapse">
					<i class="fas fa-minus"></i>
				</button>
				<button type="button" class="btn btn-tool" data-card-widget="remove">
					<i class="fas fa-times"></i>
				</button>
			</div>
		</div>
		<div class="card-body">
			<div class="chart" id="linechart3report">
				<canvas id="lineChart3" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
			</div>
		</div>
		<!-- /.card-body -->
	</div>
	<!-- col -->
</div>


</div>
<!-- /.row -->






<div class="row">

<div class="col-md-4">

	<div class="card card-primary">
		<div class="card-body p-0">
			<!-- THE CALENDAR -->
			<div id=""></div>
		</div>
		<!-- /.card-body -->
	</div>
	<!-- /.card -->

</div>
<!-- /.col (RIGHT) -->

<div class="col-md-4" style="margin-top: -20px;">
	<!-- LINE CHART -->
	<div class="card card-success">
		<div class="card-header">
			<h3 class="card-title">Case Data by Group product </h3>

			<div class="card-tools">
				<button type="button" class="btn btn-tool" data-card-widget="collapse">
					<i class="fas fa-minus"></i>
				</button>
				<button type="button" class="btn btn-tool" data-card-widget="remove">
					<i class="fas fa-times"></i>
				</button>
			</div>
		</div>
		<div class="card-body">
			<div class="chart" id="stackedbarreport">
				<canvas id="stackedBarChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
			</div>
		</div>
		<!-- /.card-body -->
	</div>
	<!-- col -->
</div>

<div class="col-md-4"  style="margin-top: -20px;">
	<!-- LINE CHART -->
	<div class="card card-success" >
		<div class="card-header">
			<h3 class="card-title">PPM Data This Years</h3>

			<div class="card-tools">
				<button type="button" class="btn btn-tool" data-card-widget="collapse">
					<i class="fas fa-minus"></i>
				</button>
				<button type="button" class="btn btn-tool" data-card-widget="remove">
					<i class="fas fa-times"></i>
				</button>
			</div>
		</div>
		<div class="card-body">
			<div class="chart" id="barReport2">
				<canvas id="barChart2" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
			</div>
		</div>
		<!-- /.card-body -->
	</div>
	<!-- col -->
</div>

</div>
<!-- /.row -->





<div class="row">

			 
 <div class="col-md-2">
	 <button type="button" onclick="btnCompanyOnCLick()"class="btn btn-block btn-primary btn-lg">Company</button>
 </div>


	<div class="col-md-2">
		<button type="button" onclick="btnBodyOnClick()" class="btn btn-block btn-success btn-lg"  >Body</button>
 </div>
 

 <div class="col-md-2">
	 <button type="button" onclick="btnPowerTrainOnClick()"  class="btn btn-block btn-warning btn-lg">Power Train</button>
 </div>
 

	<div class="col-md-2">
	 <button type="button" onclick="btnBlowerOnClick()"  class="btn btn-block btn-danger btn-lg">Blower</button>
 </div>
 

	<div class="col-md-2">
	 <button type="button" onclick="btnWiperWasherOnClick()" class="btn btn-block btn-primary btn-lg">Wiper</button>
 </div>


 <div class="col-md-2">
	 <button type="button" onclick="btnThermalOnClick()" class="btn btn-block btn-success btn-lg">Thermal</button>
 </div>
 



</div>
<!-- /.row -->


</div><!-- /.container-fluid -->

</section>
<!-- /.content -->    
</div>
<!-- /.content-wrapper -->
