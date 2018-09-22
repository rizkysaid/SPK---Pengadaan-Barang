
@extends('layouts.master')

@section('title')
	<title>Edit EOQ</title>
@endsection

@section('content')
	<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Edit EOQ</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Edit EOQ</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
      	@if(session('success'))
			@component('components.alert', ['type' => 'success'])
				{!! session('success') !!}
			@endcomponent
		@endif
		<div class="row">
			<div class="col-md-4">
		        <div class="card card-default">
		          <div class="card-header">
		            <h3 class="card-title">Pilih barang</h3>
		          </div>
		          <!-- /.card-header -->
		          <div class="card-body">
		      		<form role="form" action="{{url('eoq/update') .'/'. $eoq->first()->id}}" method="POST">
						{{csrf_field()}}
						<input type="hidden" name="_method" value="PUT">

								<div class="form-group">
								  <label>Nama barang</label>
								  <select name="id_barang" class="form-control barang" style="width: 100%;">
								  	<option value="{{$eoq->first()->id_barang}}">{{$eoq->first()->nama_barang}}</option>
								    @foreach($barang as $row)
										<option value="{{ $row->id }}">{{ $row->nama_barang }}</option>
									@endforeach
								  </select>
								</div>
								<!-- /.form-group -->
								<div class="form-group">
								  <label>Kebutuhan barang per periode</label>
								  <input id="jumkeb"  type="number" name="kebper" class="form-control" placeholder="jumlah kebutuhan perperiode" value="{{$eoq->first()->kebutuhan}}">
								</div>
								<!-- /.form-group -->
								<div class="form-group">
								  <label>Periode</label>
								  <select name="periode"  id="kebperper" class="form-control" style="width: 100%;">
								  	<option value="{{$eoq->first()->periode}}">{{$eoq->first()->periode}} bulan</option>
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
								  <label>Kebutuhan pengaman (%)</label>
								  <input  type="number" name="kebpeng" class="form-control" placeholder="%" value="{{$eoq->first()->pengaman}}">
								</div>
								<!-- /.form-group -->

								<div class="form-group">
								  <label>Waktu tunggu pesan (hari)</label>
								  <input id="wakpes"  type="number" name="waktu" class="form-control" placeholder="hari" value="{{$eoq->first()->waktu_pesan}}" autofocus="autofocus">
								</div>
								<!-- /.form-group -->

								<input id="value_eoq" type="hidden" name="eoq" value="">
								<input id="value_safety" type="hidden" name="safety" value="">
								<input id="value_rop" type="hidden" name="rop" value="">

								<div class="col-md-12">
			              		<div class="float-sm-right">
									<button type="submit" class="btn btn-primary">Update</button>
								</div>	
			              	</div>
			        </form>
		          </div>
		          <!-- /.card-body -->
		        </div>
		        <!-- /.card -->	 				
			</div>
	              	<!-- /.col md-4-->
	        <div class="col-md-8">     			
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

		        @slot('footer')

				@endslot
        	</div><!-- col-md-8 -->
	    </div>
	            <!-- /.row -->
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

		$(".barang").keyup(function() {
			proses();
		});

		$("#jumkeb").change(function() {
			proses();
		}); 

		$("#jumkeb").keyup(function() {
			proses();
		}); 

		$("#kebperper").change(function() {
			proses();
		});

		$("#kebperper").keyup(function() {
			proses();
		});

		$("#wakpes").keyup(function() {
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
			$("#safety").html(safety+' '+ data.satuan + ' per periode');
			$("#kebutuhan").html(keb +' '+ data.satuan + ' per bulan');

			//menghitung eoq 
			var eoq = Math.floor(Math.sqrt((2 * data.biaya_pesan * jumkeb) / data.biaya_simpan));
			$("#eoq").html(eoq +' '+ data.satuan);
			//menghitung safety stock
			var rop = parseInt(safety) + parseInt(waktu);
			$("#rop").html(rop + ' ' + data.satuan);

			$('#value_safety').val(safety);
			$('#value_eoq').val(eoq);
			$('#value_rop').val(rop);
		})
	}
</script>
@endpush