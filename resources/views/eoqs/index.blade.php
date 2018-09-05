
@extends('layouts.master')

@section('title')
	<title>Proses EOQ</title>
@endsection

@section('content')
	<div class="content-wrapper">
		<div class="content-header">
			<div class="container-fluid">
				<div class="row mb-2">
					<div class="col-sm-6">
						<h1 class="m-0 text-dark">Proses EOQ</h1>
					</div>
					<div class="col-sm-6">
						<ol class="breadcrumb float-sm-right">
							<li class="breadcrumb-item"><a href="#">Home</a></li>
							<li class="breadcrumb-item"><a href="#">Maintenance Data</a></li>
							<li class="breadcrumb-item active">Proses EOQ</li>
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
								Data Barang
							@endslot

							@if(session('success'))
								@component('components.alert', ['type' => 'success'])
									{{!! session('success') !!}}
								@endcomponent
							@endif

							@if(session('error'))
								@component('components.alert', ['type' => 'danger'])
									{{!! session('error') !!}}
								@endcomponent
							@endif


							<form role="form" action="#" method="post" enctype="multipart/form-data">
								{{csrf_field()}}
								<div class="form-group">
									<label for="">Jenis Barang</label>
									<input type="text" name="jenis" required class="form-control {{ $errors->has('name') ? 'is-invalid':'' }}"
									value="{{ $barang->jenis_barang }}"><p class="text-danger">{{ $errors->first('jenis') }}</p>
								</div>

								<div class="form-group">
									<label for="">Nama Barang</label>
									<input type="text" name="nama" required class="form-control {{ $errors->has('nama') ? 'is-invalid':'' }}"
									value="{{ $barang->nama_barang }}"><p class="text-danger">{{ $errors->first('nama') }}</p>
								</div>

						@endcomponent <!-- endcard -->

						@component('components.card')

							@slot('title')
								FORM ESQ
							@endslot
								<div class="form-group">
                                    <label for="">Periode</label>
                                    <input type="number" name="periode" required class="form-control {{ $errors->has('periode') ? 'is-invalid':'' }}"
									value="{{ $eoqs->periode }}"><p class="text-danger">{{ $errors->first('periode') }}</p>
                                    <p class="text-danger">{{ $errors->first('description') }}</p>
                                </div>

                                <div class="form-group">
                                    <label for="">Biaya Pesan Per Unit</label>
                                    <input type="number" name="biaya" required 
                                        class="form-control {{ $errors->has('biaya') ? 'is-invalid':'' }}"
                                        value="{{ $eoqs->biaya_pesan }}">
                                    <p class="text-danger">{{ $errors->first('biaya') }}</p>
                                </div>


                                 <div class="form-group">
                                    <label for="">Kebutuhan Per Periode</label>
                                    <input type="number" name="keb" required 
                                        class="form-control {{ $errors->has('keb') ? 'is-invalid':'' }}"
                                        value="{{ $eoqs->keb_per_periode }}">
                                    <p class="text-danger">{{ $errors->first('keb') }}</p>
                                </div>

								<div class="form-group">
                                    <label for="">Rata-rata Kebutuhan Per Bulan</label>
                                    <input type="number" name="rata" required 
                                        class="form-control {{ $errors->has('rata') ? 'is-invalid':'' }}"
                                        value="{{ $eoqs->keb_per_periode }}">
                                    <p class="text-danger">{{ $errors->first('rata') }}</p>
                                </div>


								<div class="form-group">
									<button class="btn btn-primary btn-sm">
										<i class="fa fa-send"></i>
										Simpan
									</button>
								</div>
							</form>

							@slot('footer')

							@endslot

						@endcomponent
					</div>
				</div>
			</div>
		</section>
	</div>
@endsection