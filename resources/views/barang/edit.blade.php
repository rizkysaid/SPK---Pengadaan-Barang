@extends('layouts.master')

@section('title')
	<title>Edit Barang</title>
@endsection

@section('content')
	<div class="content-wrapper">
		<div class="content-header">
			<div class="container-fluid">
				<div class="row mb-2">
					<div class="col-sm-6">
						<h1 class="m-0 text-dark">Edit Barang</h1>
					</div>
					<div class="col-sm-6">
						<ol class="breadcrumb float-sm-right">
							<li class="breadcrumb-item"><a href="#">Home</a></li>
							<li class="breadcrumb-item"><a href="{{ route('barang.index') }}">Barang</a></li>
							<li class="breadcrumb-item active">Edit</li>
						</ol>
					</div>
				</div>
			</div>
		</div>

		<section class="content">
			<div class="container-fluid">
				<div class="row">
					<div class="col-sm-12">
						@component('components.card')
							@slot('title')
								Edit
							@endslot

							@if(session('error'))
								@component('components.alert', ['type' => 'danger'])
									{!! session('error') !!}
								@endcomponent
							@endif


							<form role="form" action="{{ route('barang.update', $barang->first()->id) }}" method="POST">
									{{csrf_field()}}
									<input type="hidden" name="_method" value="PUT">
									<div class="form-group row">
										<div class="col-sm-6">
											<div class="form-group row">
												<div class="col-sm-4">
													<label for="kode">Kode Barang</label>
												</div>
												<div class="col-sm-8">
													<input type="text" name="kode" required maxlength="10"
														 value="{{ $barang->first()->kode_barang }}"
														 readonly 
														class="form-control {{ $errors->has('kode') ? 'is-invalid':'' }}">
													<p class="text-danger">{{ $errors->first('kode') }}</p>
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
													<input type="number" name="harga" required
														 value="{{ $barang->first()->harga }}"
														class="form-control {{ $errors->has('harga') ? 'is-invalid':'' }}">
													<p class="text-danger">{{ $errors->first('harga') }}</p>
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
													<input type="text" name="nama" required
														 value="{{ $barang->first()->nama_barang }}"
														class="form-control {{ $errors->has('nama') ? 'is-invalid':'' }}">
													<p class="text-danger">{{ $errors->first('nama') }}</p>
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
													<input type="number" name="biaya_simpan" required
														 value="{{ $barang->first()->biaya_simpan }}"
														class="form-control {{ $errors->has('biaya_simpan') ? 'is-invalid':'' }}">
													<p class="text-danger">{{ $errors->first('biaya_simpan') }}</p>
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
														<option value="$ngambil_id->first()->id_kategori">{{ $ngambil_id->first()->nama_kategori .
														' - (' . $ngambil_id->first()->deskripsi . ')'}}</option>
														@foreach($kategori as $row)
															<option value="{{ $row->id }}" {{ $row->id == $barang->first()->id_kategori ? 'selected':'' }}>
																{{ ucfirst($row->nama_kategori) . ' - (' .
																	$row->deskripsi . ')' }}
															</option>
														@endforeach
														<p class="text-danger">{{ $errors->first('id_kategori') }}</p>
													</select>	
												</div>
											</div>
										</div>
										<div class="col-sm-1"></div>
										<div class="col-sm-5">
											

											<div class="form-group row">
												<div class="col-sm-4">
													<label for="biaya">Biaya Pesan</label>
												</div>
												<div class="col-sm-8">
													<input type="number" name="biaya_pesan" required
														 value="{{ $barang->first()->biaya_pesan }}"
														class="form-control {{ $errors->has('biaya_pesan') ? 'is-invalid':'' }}">
													<p class="text-danger">{{ $errors->first('biaya_simpan') }}</p>
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
														<option value="$ngambil_id->first()->id_satuan">{{ $ngambil_id->first()->nama_satuan }}</option>
														@foreach($satuan as $row)
															<option value="{{ $row->id }}" {{ $row->id == $barang->first()->id_satuan ? 'selected':'' }}>
																{{ ucfirst($row->nama_satuan) }}
															</option>
														@endforeach
														<p class="text-danger">{{ $errors->first('id_satuan') }}</p>
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
													<input type="number" name="stok" required
														 value="{{ $barang->first()->stok }}"
														class="form-control {{ $errors->has('stok') ? 'is-invalid':'' }}">
													<p class="text-danger">{{ $errors->first('stok') }}</p>
												</div>
											</div>
										</div>
									</div>

									<div class="row">
										<div class="col-sm-12">
											<div class="float-sm-right">
												<button class="btn btn-primary">Update</button>
											</div>		
										</div>
									</div>
					
									
								@slot('footer')
									
								</form>
							@endslot
						@endcomponent	
					</div>
				</div>
			</div>
		</section>

	</div>
@endsection