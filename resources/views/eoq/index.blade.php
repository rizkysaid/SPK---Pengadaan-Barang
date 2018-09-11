
@extends('layouts.master')

@section('title')
	<title>Proses Economic Order Quantity (EOQ)</title>
@endsection

@section('content')
	<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Proses EOQ</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Proses EOQ</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="card card-default">
          <div class="card-header">
            <h3 class="card-title">Pilih barang</h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
      		<form role="form" action="{{url('eoq.store')}}" method="POST">
				{{csrf_field()}}

	            <div class="row">
					<div class="col-md-6">
						<div class="form-group">
						  <label>Nama barang</label>
						  <select class="form-control barang" style="width: 100%;">
						  	<option></option>
						    @foreach($barang as $row)
								<option value="{{ $row->id }}">{{ $row->nama_barang }}</option>
							@endforeach
						  </select>
						</div>
						<!-- /.form-group -->
						<div class="form-group">
						  <label>Periode</label>
						  <select  id="kebperper" class="form-control" style="width: 100%;">
							<option value="1">1 bulan</option>
							<option value="2">2 bulan</option>
							<option value="3">3 bulan</option>
							<option value="4">4 bulan</option>
							<option value="5">5 bulan</option>
							<option value="6">6 bulan</option>
							<option value="12">12 bulan</option>
						  </select>
						</div>
						<!-- /.form-group -->
						<div class="form-group">
						  <label>Kebutuhan barang per periode</label>
						  <input id="jumkeb"  type="number" name="kebper" class="form-control" placeholder="jumlah kebutuhan perperiode">
						</div>
						<!-- /.form-group -->
					</div>
	              	<!-- /.col -->

	              	<div class="col-md-6">
						<div class="form-group">
						  <label>Kebutuhan pengaman (%)</label>
						  <input  type="number" name="kebpeng" class="form-control" placeholder="%">
						</div>
						<!-- /.form-group -->

						<div class="form-group">
						  <label>Waktu tunggu pesan (hari)</label>
						  <input id="wakpes"  type="number" name="waktu" class="form-control" placeholder="hari">
						</div>
						<!-- /.form-group -->
					</div>
	              	<!-- /.col -->
	              	<div class="col-md-12">
	              		<div class="float-sm-right">
							<button type="submit" class="btn btn-primary">Simpan</button>
						</div>	
	              	</div>
	              	<!-- /.col -->
	            </div>
	            <!-- /.row -->
	        </form>
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->	 
      </div><!-- /.container-fluid -->

      <div class="container-fluid">
        <div class="card card-default">
          <div class="card-header">
            <h3 class="card-title">Hasil</h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <table class="table table-striped">
			    <tbody>
			      <tr>
			        <td style="width: 250px">Nama barang</td>
			        <td id="namaBarang"></td>
			      </tr><tr>
			        <td>Harga barang</td>
			        <td id="hargaBarang"></td>
			      </tr>
			      <tr>
			        <td>Biaya pesan per barang</td>
			        <td id="bipes"></td>
			      </tr>
			      <tr>
			        <td>Waktu tunggu pesan</td>
			        <td id="waktu"></td>
			      </tr>
			      <tr>
			        <td>Biaya penyimpanan</td>
			        <td id="bipeny"></td>
			      </tr>
			      <tr>
			        <td>Rata-rata Kebutuhan per bulan</td>
			        <td id="kebutuhan"></td>
			      </tr>
			      <tr>
			        <td>EOQ - Economic Order Quantity</td>
			        <td id="eoq"></td>
			      </tr>
			      <tr>
			        <td>Safety Stock</td>
			        <td id="safety"></td>
			      </tr>
			      <tr>
			        <td>Re Order Point</td>
			        <td id="rop"></td>
			      </tr>
			    </tbody>
			  </table>
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->	 
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
 @endsection

@push('scripts')
<script>
	$(function () {
		$('.barang').select2({
			placeholder: 'Cari barang'
		})
	});

	$(document).ready(function(){
		$(".barang").change(function() {
			proses();
		});

		$("#jumkeb").change(function() {
			proses();
		}); 

		$("#kebperper").change(function() {
			proses();
		});

		$("#wakpes").change(function() {
			proses();
		});
	});

	function proses(){
		var barang = $("select.barang option:checked").text();
		var id = $("select.barang option:checked").val();
		var keb = $("select#kebperper option:checked").val();
		var jumkeb = $('input[name="kebper"]').val();
		var waktu = $('input[name="waktu"]').val();
		keb = Math.floor(jumkeb / keb);
		var leadTime =  Math.floor(waktu*keb / 30);
		var  kebpeng = $('input[name="kebpeng"]').val();

		$("#waktu").html(leadTime + ' hari');

    	
		$.get('/eoq/get-barang/' + id, function (data){
			$("#namaBarang").html(data.nama_barang);
			$("#hargaBarang").html('Rp. '+data.harga_barang);
			$("#bipes").html('Rp. ' + data.biaya_pesan);
			$("#bipeny").html('Rp. ' + data.biaya_simpan);

			var safety = Math.floor( keb*kebpeng/100);
			$("#safety").html(safety+' '+ data.satuan + ' per bulan');
			$("#kebutuhan").html(keb +' '+ data.satuan + ' per bulan');

			//menghitung eoq 
			var eoq = Math.floor(Math.sqrt((2 * data.biaya_pesan * jumkeb) / data.biaya_simpan));
			$("#eoq").html(eoq +' '+ data.satuan);
			//menghitung safety stock
			var rop = parseInt(safety) + parseInt(waktu);
			$("#rop").html(rop + ' ' + data.satuan);
		})
	}
</script>
@endpush