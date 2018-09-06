
@extends('layouts.master')

@section('title')
	<title>Manajemen Kategori</title>
@endsection

@section('content')
	<div class="content-wrapper">
		<div class="content-header">
			<div class="container-fluid">
				<div class="row mb-2">
					<div class="col-sm-6">
						<h1 class="m-0 text-dark">Manajemen Kategori</h1>
					</div>
					<div class="col-sm-6">
						<ol class="breadcrumb float-sm-right">
							<li class="breadcrumb-item"><a href="#">Home</a></li>
							<li class="breadcrumb-item active">Kategori</li>
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
							Tambah Data Kategori <!-- <b>+</b> -->
							@endslot


 							@if(session('error'))
 								@component('components.alert', ['type' => 'danger'])
 									{!! session('error') !!}
 								@endcomponent
 							@endif

							<form role="form" action="{{ route('kategori.store') }}" method="POST">
								{{csrf_field()}}
								
								<div class="form-group">
									<label for="nama">Kategori</label>
									<input type="text" name="nama" class="form-control {{ $errors->has('nama') ? 'is-invalid':'' }}" id="nama"></input>
								</div>
								<div class="form-group">
									<label for="deskripsi">Deskripsi</label>
									<textarea cols="5" rows="5" name="deskripsi" class="form-control {{ $errors->has('deskripsi') ? 'is-invalid':'' }}" id="deskripsi"></textarea>
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
							List Kategori
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
											<td><b>#</b></td>
											<td><b>Kategori</b></td>
											<td><b>Deskripsi</b></td>
											<td><b>Aksi</b></td>
										</tr>
									</thead>
									<tbody>
										@php $no=1; @endphp
										@forelse ($kategori as $row)
										<tr>
											<td>{{ $no++ }}</td>
											<td>
												<!-- <sup class="label label-success">{{ $row->id }}</sup> -->	
												{{ ucfirst($row->nama_kategori) }}
											</td>
											<td>{{ $row->deskripsi }}</td>
											<td>
												<form action="{{ route('kategori.destroy', $row->id) }}" method="POST">
													{{csrf_field()}}
													<input type="hidden" name="_method" value="DELETE">
													<a href="{{ route('kategori.edit', $row->id) }}" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i></a>
													<button class="btn btn-danger btn-sm"
														onclick="javascript: return confirm('Anda yakin hapus?')"><i class="fa fa-trash"></i></button>
												</form>
											</td>
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