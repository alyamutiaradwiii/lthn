@extends('template.layout')
<title> Buku </title>
@section('isi')

						<!-- breadcrumb -->
						<div class="breadcrumb-header justify-content-between">
							<div>
								<h4 class="content-title mb-2">Hi, welcome back!</h4>
								<nav aria-label="breadcrumb">
									<ol class="breadcrumb">
										<li class="breadcrumb-item"><a   href="javascript:void(0);">Dashboard</a></li>
										<li class="breadcrumb-item active" aria-current="page">Project</li>
									</ol>
								</nav>
							</div>
						</div>
						<!-- /breadcrumb -->
                        <div class="row row-sm ">
							<div class="col-md-12 col-xl-12">
								<div class="card">	
									<div class="pd-t-10 pd-s-10 pd-e-10 bg-white bd-b">
                    
										<div class="row">
											<div class="col-md-6">
												<h4 class="card-title mg-b-10">Data Buku</h4>
											</div>
											<div class="col-md-6">
												<div class="d-flex my-auto btn-list justify-content-end">
													<a href="{{ route('buku.input') }}" class="btn btn-sm btn-info"><i class="fa fa-plus"></i> Tambah</a>
													 {{-- <button onclick="formImport()" class="btn btn-sm btn-secondary"><i class="fa fa-upload me-2"></i> Import</button>
													<div class="dropdown">
														<button type="button" class="btn btn-sm btn-success dropdown-toggle" data-bs-toggle="dropdown">
															<i class="fa fa-download me-2"></i>Export
														</button>
														<div class="dropdown-menu">
															<a class="dropdown-item" href="javascript:void(0)" onclick="exportExcel()">Excel</a>
															<a class="dropdown-item" href="javascript:void(0)" onclick="exportPdf()">PDF</a>
														</div>
													</div>  --}}
												</div>
											</div>
										</div>
									</div>
										<div class="card-body">
										<div class="table-responsive mb-0">
											<table class="table table-hover table-bordered mb-0 text-md-nowrap text-lg-nowrap text-xl-nowrap table-striped ">
												<thead>
													<tr>
														<th>No</th>
														<th>Judul</th>
														<th>Penulis</th>
														<th>Penerbit</th>
														<th>Tahun Terbit</th>
														<th>Action</th>
													</tr>
												</thead>
												
												<tbody>
													@foreach ($buku as $item)
													<tr>
														<td style="text-align:center">{{ $loop->iteration }}</td>
														<td>{{ $item->judul }}</td>
														<td>{{ $item->penulis }}</td>
														<td>{{ $item->penerbit }}</td>
														<td>{{ $item->tahunTerbit }}</td>
														<td>//</td>
													</tr>		
													@endforeach
												</tbody>
												
											</table>
										</div>
									</div>
								</div>
							</div>
						</div>

@endsection