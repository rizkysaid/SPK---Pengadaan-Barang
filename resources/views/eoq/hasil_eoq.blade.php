@extends('layouts.master')

@section('title')
	<title>Hasil EOQ </title>
@endsection

@section('content')
	<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Hasil eoq</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Hasil EOQ</li>
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

			<div class="card">
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                	<th>No</th>
                  <th>Nama barang</th>
                  <th>Kebutuhan</th>
                  <th>EOQ</th>
                  <th>Safety Stock</th>
                  <th>Reorder Point</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @php $no=1; @endphp
				@forelse ($barang as $row)
				<tr>
					<td>{{ $no++ }}</td>
					<td>{{ ucfirst($row->nama_barang) }}</td>
					<td>{{ $row->kebutuhan }} /{{ $row->periode }} bulan</td>
					<td>{{ $row->eoq }}</td>
					<td>{{ $row->safety }}</td>
					<td>{{ $row->rop }}</td>
					<td>
						<form action="{{ url('eoq/destroy', $row->id) }}" method="POST">
							{{csrf_field()}}
							<input type="hidden" name="_method" value="DELETE">
							<a href="{{ url('eoq/edit', $row->id) }}" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i></a>
							<button class="btn btn-danger btn-sm" 
							onclick="javascript: return confirm('Anda yakin hapus?')"><i class="fa fa-trash"></i></button>
						</form>
					</td>
				</tr> 
				@empty
				@endforelse
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
  $(function() {
    $("#example1").DataTable();
  });
</script>
@endpush