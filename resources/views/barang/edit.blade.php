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
					<div class="col-sm-6">
						@component('components.card')
							@slot('title')
								Edit
							@endslot

							@if(session('error'))
								@component('components.alert', ['type' => 'danger'])
									{!! session('error') !!}
								@endcomponent
							@endif


							<form role="form" action="{{ route('barang.update', $barang->id) }}" method="POST">
								{{ csrf_field() }}
								<input type="hidden" name="_method" value="PUT">
								<div class="form-group">
									<label for="nama">Nama Barang</label>
									<input type="text" name="nama"
										value="{{ $barang->nama_barang }}" required class="form-control {{ $errors->has('nama') ? 'is-invalid':'' }}"><p class="text-danger">{{ $errors->first('nama') }}</p>
								</div>
								<div class="form-group">
									<label for="jenis">Jenis Barang</label>
									<input type="text" name="jenis"
										value="{{ $barang->jenis_barang }}" required class="form-control {{ $errors->has('jenis') ? 'is-invalid':'' }}"><p class="text-danger">{{ $errors->first('jenis') }}</p>
								</div>
								<div class="form-group">
									<label for="stok">Stok Barang</label>
									<input type="number" name="stok"
										value="{{ $barang->stok_barang }}" required class="form-control {{ $errors->has('stok') ? 'is-invalid':'' }}"><p class="text-danger">{{ $errors->first('stok') }}</p>
								</div>

							@slot('footer')
								<div class="card-footer">
									<button class="btn btn-info">Update</button>
								</div>
							</form>
							@endslot
						@endcomponent	
					</div>
				</div>
			</div>
		</section>

	</div>
@endsection