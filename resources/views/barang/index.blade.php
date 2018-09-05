
@extends('layouts.master')

@section('title')
	<title>Manajemen barang</title>
@endsection

@section('content')
	<div class="content-wrapper">
		<div class="content-header">
			<div class="container-fluid">
				<div class="row mb-2">
					<div class="col-sm-6">
						<h1 class="m-0 text-dark">Manajemen barang</h1>
					</div>
					<div class="col-sm-6">
						<ol class="breadcrumb float-sm-right">
							<li class="breadcrumb-item"><a href="#">Home</a></li>
							<li class="breadcrumb-item active">Barang</li>
						</ol>
					</div>
				</div>
			</div>
		</div>

		<section class="content">
			<div class="container-fluid">
				<div class="row">
					<div class="col-md-4">
						@component('components.card')
							@slot('title')
							Tambah Data Barang <!-- <b>+</b> -->
							@endslot


 							@if(session('error'))
 								@component('components.alert', ['type' => 'danger'])
 									{!! session('error') !!}
 								@endcomponent
 							@endif

							<form role="form" action="{{ route('barang.store') }}" method="POST">
								{{csrf_field()}}
								
								<div class="form-group">
									<label for="kode">Kode Barang</label>
									<input type="text" name="kode" class="form-control {{ $errors->has('kode') ? 'is-invalid':'' }}" id="kode"></input>
								</div>
								<div class="form-group">
									<label for="name">Nama Barang</label>
									<input type="text"  name="nama" class="form-control {{ $errors->has('nama') ? 'is-invalid':'' }}" id="nama"></input>
								</div>
								<div class="form-group">
									<label for="jenis">Jenis Barang</label>
									<input type="text" name="jenis" class="form-control {{ $errors->has('jenis') ? 'is-invalid':'' }}" id="jenis"></input>
								</div>
								<div class="form-group">
									<label for="stok">Stok</label>
									<input type="number" name="stok" class="form-control {{ $errors->has('stok') ? 'is-invalid':'' }}" id="stok"></input>
								</div>
							@slot('footer')
								<div class="card-footer">
									<button class="btn btn-primary">Simpan</button>
								</div>
							</form>
							@endslot
						@endcomponent	
					</div>
					<div class="col-md-8">
						@component('components.card')
							@slot('title')
							List Barang
							@endslot
<!-- 
							@if(session('success'))
								@alert(['type' => 'success'])
									{!! session('success') !!}
								@endalert
							@endif
 -->

 							@if(session('success'))
 								@component('components.alert', ['type' => 'success'])
 									{!! session('success') !!}
 								@endcomponent
 							@endif

							<div class="table-responsive">
								<table class="table table-hover">
									<thead>
										<tr>
											<td><b>Nama Barang</b></td>
											<td><b>Jenis</b></td>
											<td><b>Stok</b></td>
											<td><b>Aksi</b></td>
											<td><b>Proses EOQ</b></td>
										</tr>
									</thead>
									<tbody>
										@forelse ($barang as $row)
										<tr>
											<td>
												<sup class="label label-success">{{ $row->kode_barang }}</sup>	
												<strong>{{ ucfirst($row->nama_barang) }}</strong>
											</td>
											<td>{{ $row->jenis_barang }}</td>
											<td>{{ $row->stok_barang }}</td>
											<td>
												<form action="{{ route('barang.destroy', $row->id) }}" method="POST">
													{{csrf_field()}}
													<input type="hidden" name="_method" value="DELETE">
													<a href="{{ route('barang.edit', $row->id) }}" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i></a>
													<button class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
												</form>
											</td>
											<td><a href="{{ route('eoqs.show', $row->id) }}"><i class="fa fa-line-chart"></i></a></td>
										</tr> 
										@empty
										<tr>
											<td colspan="4" class="text-center">Tidak ada data</td>
										</tr>
										@endforelse
									</tbody>
								</table>
							</div>
							@slot('footer')

							@endslot
						@endcomponent
					</div>
				</div>
			</div>
		</section>
	</div>
 @endsection	