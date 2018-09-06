@extends('layouts.master')

@section('title')
	<title>Edit Kategori</title>
@endsection

@section('content')
	<div class="content-wrapper">
		<div class="content-header">
			<div class="container-fluid">
				<div class="row mb-2">
					<div class="col-sm-6">
						<h1 class="m-0 text-dark">Edit Kategori</h1>
					</div>
					<div class="col-sm-6">
						<ol class="breadcrumb float-sm-right">
							<li class="breadcrumb-item"><a href="#">Home</a></li>
							<li class="breadcrumb-item"><a href="{{ route('kategori.index') }}">Kategori</a></li>
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


							<form role="form" action="{{ route('kategori.update', $kategori->id) }}" method="POST">
								{{ csrf_field() }}
								<input type="hidden" name="_method" value="PUT">
								<div class="form-group">
									<label for="nama">Kategori</label>
									<input type="text" 
									name="nama" 
									value="{{ $kategori->nama_kategori }}" 
									class="form-control {{ $errors->has('nama') ? 'is-invalid':'' }}" 
									id="nama" required>
								</div>
								<div class="form-group">
									<label for="deskripsi">Deskripsi</label>
									<textarea name="deskripsi" cols="5" rows="5" class="form-control {{ $errors->has('deskripsi') ? 'is-invalid':'' }}" id="deskripsi">{{ $kategori->deskripsi }}</textarea>
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