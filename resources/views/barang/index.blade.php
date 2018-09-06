
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
					<div class="col-md-12">

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
									
									<div class="form-group row">
										<div class="col-sm-6">
											<div class="form-group row">
												<div class="col-sm-4">
													<label for="kode">Kode Barang</label>
												</div>
												<div class="col-sm-8">
													<input type="text" name="kode" class="form-control {{ $errors->has('kode') ? 'is-invalid':'' }}" id="kode">
												</div>
											</div>
										</div>

										<div class="col-sm-1"></div>

										<div class="col-sm-5">
											<div class="form-group row">
												<div class="col-sm-4">
													<label for="harga">Harga</label>
												</div>
												<div class="col-sm-8">
													<input type="number" name="harga" class="form-control {{ $errors->has('harga') ? 'is-invalid':'' }}" id="harga">
												</div>
											</div>

										</div>
									</div>

									<div class="form-group row">
										<div class="col-sm-6">
											<div class="form-group row">
												<div class="col-sm-4">
													<label for="name">Nama Barang</label>		
												</div>
												<div class="col-sm-8">
													<input type="text"  name="nama" class="form-control {{ $errors->has('nama') ? 'is-invalid':'' }}" id="nama">
												</div>
											</div>
										</div>
										<div class="col-sm-1"></div>
										<div class="col-sm-5">
											<div class="form-group row">
												<div class="col-sm-4">
													<label for="biaya">Biaya Simpan</label>
												</div>
												<div class="col-sm-8">
													<input type="number" name="biaya" class="form-control {{ $errors->has('biaya') ? 'is-invalid':'' }}" id="biaya">
												</div>
											</div>
										</div>
									</div>
									<div class="form-group row">
										<div class="col-sm-6">
											<div class="form-group row">
												<div class="col-sm-4">
													<label for="kategori">Jenis Barang</label>
												</div>
												<div class="col-sm-8">
													<select name="kategori" id="kategori" required="" class="form-control {{ $errors->has('kategori') ? 'is-invalid':'' }}">
														<option value="">Pilih</option>
														@foreach($kategori as $row)
															<option value="{{ $row->id }}">
																{{ $row->nama_kategori . ' - (' . 
																	$row->deskripsi . ')' }}</option>
														@endforeach
													</select>	
												</div>
											</div>
										</div>
										<div class="col-sm-1"></div>
										<div class="col-sm-5">
											<div class="form-group row">
												<div class="col-sm-4">
													<label for="stok">Stok</label>	
												</div>
												<div class="col-sm-8">
													<input type="number" name="stok" class="form-control {{ $errors->has('stok') ? 'is-invalid':'' }}" id="stok">
												</div>
											</div>
										</div>

									</div>
									<div class="form-group row">
										<div class="col-sm-6">
											<div class="form-group row">
												<div class="col-sm-4">
													<label for="satuan">Satuan</label>
												</div>
												<div class="col-sm-8">
													<select name="satuan" id="satuan" required="" class="form-control {{ $errors->has('satuan') ? 'is-invalid':'' }}">
														<option value="">Pilih</option>
														@foreach($satuan as $row)
															<option value="{{ $row->id }}">
																{{ $row->nama_satuan }}</option>
														@endforeach
													</select>	
												</div>
											</div>
										</div>
										<div class="col-sm-6">
											<div class="float-sm-right">
											<button class="btn btn-primary">Simpan</button>
									</div>		
										</div>
									</div>
					
									
								@slot('footer')
									
								</form>
								@endslot
							@endcomponent	
					</div>

					<div class="col-md-12">
						@component('components.card')
							@slot('title')
							List Barang
							@endslot

 							@if(session('success'))
 								@component('components.alert', ['type' => 'success'])
 									{!! session('success') !!}
 								@endcomponent
 							@endif

							<div class="table-responsive">
								<table class="table table-hover">
									<thead>
										<tr>
											<td><b>#</b></td>
											<td><b>Kode</b></td>
											<td><b>Nama</b></td>
											<td><b>Jenis Barang</b></td>
											<td><b>Satuan</b></td>
											<td><b>Harga</b></td>
											<td><b>Biaya Simpan</b></td>
											<td><b>Stok</b></td>
											<td><b>Aksi</b></td>
										</tr>
									</thead>
									<tbody>
										@php $no=1; @endphp
										@forelse ($barang as $row)
										<tr>
											<td>{{ $no++ }}</td>
											<td>{{ $row->kode_barang }}</td>
											<td>{{ ucfirst($row->nama_barang) }}</td>
											<td>{{ $row->nama_kategori }}</td>
											<td>{{ $row->nama_satuan }}</td>
											<td>{{ number_format($row->harga) }}</td>
											<td>{{ number_format($row->biaya_simpan) }}</td>
											<td>{{ $row->stok }}</td>
											<td>
												<form action="{{ route('barang.destroy', $row->id) }}" method="POST">
													{{csrf_field()}}
													<input type="hidden" name="_method" value="DELETE">
													<a href="{{ route('barang.edit', $row->id) }}" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i></a>
													<button class="btn btn-danger btn-sm" 
													onclick="javascript: return confirm('Anda yakin hapus?')"><i class="fa fa-trash"></i></button>
												</form>
											</td>
										</tr> 
										@empty
										<tr>
											<td colspan="12" class="text-center">Tidak ada data</td>
										</tr>
										@endforelse
									</tbody>
								</table>
							</div>
							@slot('footer')

							@endslot
						@endcomponent
					</div> <!-- col-md-12 -->
				</div> <!-- row -->
			</div> <!-- container-fluid -->
		</section>
	</div> <!-- content-wrapper -->
 @endsection	