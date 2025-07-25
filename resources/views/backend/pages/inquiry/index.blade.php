@extends('backend.layouts.master')

@section('title')
Inquiry - Admin Panel
@endsection

@php
$usr = Auth::guard('web')->user();
@endphp

@section('admin-content')
<div class="content-wrapper">
	<div class="page-content">
		<div class="container-fluid">
			<div class="row">
				<div class="col-12 rt-mb-25">
					<div class="d-flex justify-content-between">
						<div class="breadcrumbs">
							<div class="breadcrumb-title">Inquiry</div>
							<nav aria-label="breadcrumb">
								<ol class="breadcrumb">
									<li class="breadcrumb-item"><a href='/admin'>Home</a></li>
									<li class="breadcrumb-item"><a href='/admin/inquiry'>Origin</a></li>
									<li class="breadcrumb-item active" aria-current="page"><a href='/admin/inquiry'>Inquiry</a></li>
								</ol>
							</nav>
						</div>
						<div class="section-filter d-flex">
							<div class="app-main-search me-2">
								<form action="/admin/inquiry" method="GET" class="d-flex" autocomplete="off">
									<div class="input-box d-flex">
										<input type="text" name="search" id="search" value="{{ $search }}" class="form-control" placeholder="Search Here">
									</div>
								</form>
							</div>
							<div class="button-filter">
								<button type="button" class="btn btn-primary2 btn-icon" id="btn-filter-inquiry">
									<span class="button-content-wrapper">
										<span class="button-icon align-icon-left">
											<img src="{{ asset('backend/assets/images/svg/filter.svg') }}">
										</span>
										<span class="button-text">
											Filter
										</span>
									</span>
								</button>
							</div>
						</div>
					</div>
				</div>
			</div>

			<!-- kanban start-->
			<div class="row">
				<div class="col-12">
					<div id="board" class="board">

						<div class="d-flex kanbanboard_parent" id="kanban_board_parent">
							@if ($usr->can('inquiry.kanban1'))
							<div class="kanbanboard_child">
								<x-inquiry.kanban1-component :search="$search" :filters="$filters" />
							</div>
							@endif
							@if ($usr->can('inquiry.kanban2'))
							<div class="kanbanboard_child">
								<x-inquiry.kanban2-component :search="$search" :filters="$filters" />
							</div>
							@endif
							@if ($usr->can('inquiry.kanban3'))
							<div class="kanbanboard_child">
								<x-inquiry.kanban3-component :search="$search" :filters="$filters" />
							</div>
							@endif
							@if ($usr->can('inquiry.kanban4'))
							<div class="kanbanboard_child">
								<x-inquiry.kanban4-component :search="$search" :filters="$filters" />
							</div>
							@endif
							@if ($usr->can('inquiry.kanban5'))
							<div class="kanbanboard_child">
								<x-inquiry.kanban5-component :search="$search" :filters="$filters" />
							</div>
							@endif
							@if ($usr->can('inquiry.kanban6'))
							<div class="kanbanboard_child">
								<x-inquiry.kanban6-component :search="$search" :filters="$filters" />
							</div>
							@endif
							@if ($usr->can('inquiry.kanban7'))
							<div class="kanbanboard_child">
								<x-inquiry.kanban7-component :search="$search" :filters="$filters" />
							</div>
							@endif
							@if ($usr->can('inquiry.kanban8'))
							<div class="kanbanboard_child">
								<x-inquiry.kanban8-component :search="$search" :filters="$filters" />
							</div>
							@endif
							@if ($usr->can('inquiry.kanban9'))
							<div class="kanbanboard_child">
								<x-inquiry.kanban9-component :search="$search" :filters="$filters" />
							</div>
							@endif
						</div>
					</div>
				</div>
			</div>
			<!-- kanban end -->

		</div>
	</div>
</div>

<div class="modal fade" id="viewmodal" tabindex="-1" aria-labelledby="viewmodalLabel" aria-hidden="true">
	<div class="modal-dialog viewmodal-dialog modal-xl modal-dialog-scrollable">
		<div class="modal-content">

			<div class="modal-header">
				<div>
					<button class="plain-btn rt-mr-8" onclick="show_edit_inquiry()">
						<div class="btn-content">
							<svg width="90" height="40" viewBox="0 0 90 40" fill="none" xmlns="http://www.w3.org/2000/svg">
								<!-- Original edit icon paths -->
								<path d="M20 22.5H17.5V20L25 12.5L27.5 15L20 22.5Z" stroke="#191B1C" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round"></path>
								<path d="M23.125 14.375L25.625 16.875" stroke="#191B1C" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round"></path>
								<path d="M26.875 19.375V26.25C26.875 26.4158 26.8092 26.5747 26.6919 26.6919C26.5747 26.8092 26.4158 26.875 26.25 26.875H13.75C13.5842 26.875 13.4253 26.8092 13.3081 26.6919C13.1908 26.5747 13.125 26.4158 13.125 26.25V13.75C13.125 13.5842 13.1908 13.4253 13.3081 13.3081C13.4253 13.1908 13.5842 13.125 13.75 13.125H20.625" stroke="#191B1C" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round"></path>
								<!-- Added text -->
								<text x="45" y="25" font-family="Arial" font-size="14" fill="#191B1C">Edit</text>
							</svg>
						</div>
					</button>
					<button class="plain-btn rt-mr-8" id="btn-download-inquiry">
						<div class="btn-content">
							<svg width="135" height="40" viewBox="0 0 135 40" fill="none" xmlns="http://www.w3.org/2000/svg">
								<!-- Download icon paths -->
								<path d="M20 25V15" stroke="#191B1C" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round"></path>
								<path d="M15 20L20 25L25 20" stroke="#191B1C" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round"></path>
								<path d="M26.25 26.875H13.75C13.5842 26.875 13.4253 26.8092 13.3081 26.6919C13.1908 26.5747 13.125 26.4158 13.125 26.25V13.75C13.125 13.5842 13.1908 13.4253 13.3081 13.3081C13.4253 13.1908 13.5842 13.125 13.75 13.125H26.25C26.4158 13.125 26.5747 13.1908 26.6919 13.3081C26.8092 13.4253 26.875 13.5842 26.875 13.75V26.25C26.875 26.4158 26.8092 26.5747 26.6919 26.6919C26.5747 26.8092 26.4158 26.875 26.25 26.875Z" stroke="#191B1C" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round"></path>
								<!-- Added text -->
								<text x="45" y="25" font-family="Arial" font-size="14" fill="#191B1C">Download</text>
							</svg>
						</div>
					</button>

				</div>
				<button type="button" class="" data-bs-dismiss="modal" aria-label="Close">
					<img src="{{ asset('backend/assets/images/svg/cross.svg') }}" alt="" draggable="false">
				</button>
			</div>

			<input type="hidden" id="d-inquiry-id">

			<div class="modal-body p-3">
				<div class="card-details-wrap">
					<div class="card-details-body">

						<div class="project-idea-wrap">
							<div id="card-action-status-inquiry"></div>

							<div class="project-idea-body">
								<div class="project-idea-data d-flex">
									<div class="col-lg-3">
										<div class="project-idea-data-left">
											<h5 class="text-dark mb-1 d-inquiry-nomor" style="font-size: 18px;"></h5>
											<p>Inquiry Dibuat : <span class="d-inquiry-create-date"></span></p>
										</div>
									</div>
									<div class="col-lg-9">
										<ul class="d-flex">
											<li class="me-2">
												<span class="badge rounded-pill bg-warning-50 text-warning-500 d-inquiry-type"></span>
											</li>
										</ul>
									</div>
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-lg-6">
								<div class="project-idea-data">
									<h5 class="text-dark mb-2">Due Date</h5>
									<button type="button" class="btn btn-icon" style="background-color: #8D98AF;" id="" name="">
										<span class="button-content-wrapper">
											<span class="button-icon align-icon-left">
												<input type="checkbox" id="taskCheckbox" class="custom-checkbox">
											</span>
											<span class="button-text text-white d-inquiry-due-date"></span>
										</span>
									</button>
								</div>
							</div>
							<div class="col-lg-6">
								<div class="project-idea-data">
									<h5 class="text-dark mb-2">Keputusan</h5>
									<button type="button" class="btn btn-icon btn-primary" id="" name="">
										<span class="button-content-wrapper">
											<span class="button-icon align-icon-left">
												<i class="ph-check-square text-white"></i> <!-- Changed Icon -->
											</span>
											<span class="button-text text-white"> 31 Jan 2023 (20:15) </span>
										</span>
									</button>
								</div>
							</div>
						</div>

						{{-- Deskripsi --}}
						<div class="row mt-3">
							<div class="col-lg-6">
								<div class="company-customer">
									<h6 class="table-inquiry-title">Perusahaan Customer</h6>
									<table class="table-inquiry-header">
										<tr>
											<td style="width: 6rem;">Perusahaan</td>
											<td>: <span class="d-inquiry-customer-nama"></span></td>
										</tr>
										<tr>
											<td>Provinsi</td>
											<td>: <span class="d-inquiry-customer-provinsi"></span></td>
										</tr>
										<tr>
											<td>Kota</td>
											<td>: <span class="d-inquiry-customer-kota"></span></td>
										</tr>
										<tr>
											<td>Alamat</td>
											<td>: <span class="d-inquiry-customer-alamat"></span></td>
										</tr>
										<tr>
											<td>Email</td>
											<td>: <span class="d-inquiry-customer-email"></span></td>
										</tr>
										<tr>
											<td>No Telp</td>
											<td>: <span class="d-inquiry-customer-telp"></span></td>
										</tr>
										<tr>
											<td>PIC</td>
											<td>: <span class="d-inquiry-customer-pic"></span></td>
										</tr>
									</table>
								</div>
							</div>
							<div class="col-lg-6">
								<div class="final-user">
									<h5 class="table-inquiry-title">User Final</h5>
									<table class="table-inquiry-header">
										<tr>
											<td style="width: 7rem;">Nama</td>
											<td>: <span class="d-inquiry-user-name"></span></td>
										</tr>
										<tr>
											<td>Email</td>
											<td>: <span class="d-inquiry-user-email"></span></td>
										</tr>
										<tr>
											<td>Telp</td>
											<td>: <span class="d-inquiry-user-telp"></span></td>
										</tr>
									</table>
								</div>
								<div class="information-inquiry">
									<h5 class="table-inquiry-title">Informasi Inquiry</h5>
									<table class="table-inquiry-header">
										<tr>
											<td style="width: 7rem;">Asal Inquiry</td>
											<td>: <span class="badge rounded-3 bg-warning-50 text-warning-500 d-inquiry-origin"></span></td>
										</tr>
										<tr>
											<td>Status Saat Ini</td>
											<td>: <span class="text-warning d-inquiry-status"></span></td>
										</tr>
										<tr>
											<td>Jenis</td>
											<td>
												<div class="d-inquiry-product">
													<ul class="d-flex">
														<li class="me-2">
															<span class="badge rounded-pill bg-warning-50 text-warning-500">SS</span>
														</li>
													</ul>
												</div>
											</td>
										</tr>
									</table>
								</div>
							</div>
						</div>

						<div class="row my-4">
							<div class="col-lg-6">
								<div class="project-idea-data">
									<h5 class="text-dark mb-2 fw-bold">Score</h5>
									<div class="d-flex justify-content-start" style="border: 2px solid #E5E7E8; border-radius: 8px; padding: 20px;">
										<img src="{{ asset('backend/assets/images/start-green.png')}}" alt="">
										<div class="row ms-1">
											<p class="m-0" style="font-size: 16px; font-weight: 500;">Score Final</p>
											<p class="text-success m-0 d-flex" style="font-size: 36px; font-weight: 700;">0/100 <a class="text-primary ms-2" href="" style="font-size: 14px; font-weight: 700;">Lihat Detail <img src="{{ asset('backend/assets/images/svg/arrow-icon.svg')}}" alt="" style="margin-top: -2px; scale: 1.5; transform: rotate(-90deg);"></a></p>
										</div>
									</div>
								</div>
							</div>
							<div class="col-lg-6">
								<div class="project-idea-data">
									<h5 class="text-white mb-2">Score</h5>
									<div class="d-flex justify-content-start" style="border: 2px solid #E5E7E8; border-radius: 8px; padding: 20px;">
										<img src="{{ asset('backend/assets/images/start-blue.png')}}" alt="">
										<div class="row ms-1">
											<p class="m-0" style="font-size: 16px; font-weight: 500;">Score Penggalian Sales</p>
											<p class="text-success m-0 d-flex" style="font-size: 36px; font-weight: 700;">0% <a class="ms-2" href="" style="font-size: 14px; font-weight: 700; color: #626C70;">Buat Schedule Dulu <img src="{{ asset('backend/assets/images/svg/arrow-icon.svg')}}" alt="" style="margin-top: -2px; scale: 1.5; transform: rotate(-90deg);"></a></p>
										</div>
									</div>
								</div>
							</div>
						</div>

					</div>
					<div class="project-tab px-2">
						<ul class="nav nav-tabs" id="myTab" role="tablist">
							<li class="nav-item" role="presentation">
								<button class="nav-link active" id="list-permintaan-tab" data-bs-toggle="tab" data-bs-target="#list-permintaan" type="button" role="tab" aria-controls="list-permintaan" aria-selected="true"> List Permintaan </button>
							</li>
							<li class="nav-item" role="presentation">
								<button class="nav-link" id="progress-tab" data-bs-toggle="tab" data-bs-target="#progress" type="button" role="tab" aria-controls="progress" aria-selected="false"> Progress </button>
							</li>
							<li class="nav-item" role="presentation">
								<button class="nav-link" id="jadwal-tab" data-bs-toggle="tab" data-bs-target="#jadwal" type="button" role="tab" aria-controls="jadwal" aria-selected="false"> Jadwal </button>
							</li>
							<li class="nav-item" role="presentation">
								<button class="nav-link" id="diskusi-tab" data-bs-toggle="tab" data-bs-target="#diskusi" type="button" role="tab" aria-controls="diskusi" aria-selected="false"> Diskusi </button>
							</li>
							<li class="nav-item" role="presentation">
								<button class="nav-link" id="file-tab" data-bs-toggle="tab" data-bs-target="#file" type="button" role="tab" aria-controls="file" aria-selected="false"> File </button>
							</li>
							<li class="nav-item" role="presentation">
								<button class="nav-link" id="member-tab" data-bs-toggle="tab" data-bs-target="#member" type="button" role="tab" aria-controls="member" aria-selected="false"> Member </button>
							</li>
							<li class="nav-item" role="presentation">
								<button class="nav-link" id="log-aktivitas-tab" data-bs-toggle="tab" data-bs-target="#log-aktivitas" type="button" role="tab" aria-controls="log-aktivitas" aria-selected="false"> Log Aktivitas </button>
							</li>
						</ul>
						<div class="project-tab-body_s">
							<div class="tab-content" id="myTabContent">
								<div class="tab-pane fade show active" id="list-permintaan" role="tabpanel" aria-labelledby="list-permintaan-tab">
									<section class="tables">
										<div class="row">
											<div class="col-lg-12">
												<div class="table-wrapper">
													<div class="table-content table-responsive">

														<div class="row mt-2">
															<div class="col-lg-6">
																<p class="m-0" style="font-weight: 500; font-size: 14px;">List Permintaan</p>
																<p class="m-0" style="font-size: 14px;"><span class="d-total-produk-permintaan"></span> Produk</p>
															</div>
															<div class="col-lg-6 text-end d-flex align-items-center justify-content-end">
																<button class="btn btn-primary" id="btn-detail-permintaan">
																	Lihat Detail
																</button>
															</div>
														</div>

														<hr class="custom-hr">

														<div class="row my-2">
															<div class="col-lg-6">
																<table class="table-inquiry-detail">
																	<tr>
																		<td style="width: 6rem;">Stock</td>
																		<td>: <span class="d-inquiry-warehaouse"></span></td>
																	</tr>
																	<tr>
																		<td>User</td>
																		<td>: <span class="d-inquiry-customer-type">End User</span></td>
																	</tr>
																</table>
															</div>
															<div class="col-lg-6">
																<table class="table-inquiry-detail">
																	<tr>
																		<td style="width: 6rem;">OC</td>
																		<td>: <span class="d-inquiry-oc"></span></td>
																	</tr>
																	<tr>
																		<td>Ongkir</td>
																		<td>: <span class="d-inquiry-shopping-cost"></span></td>
																	</tr>
																</table>
															</div>
														</div>

														<div class="row">
															<div class="col-lg-6">

															</div>
														</div>

														<table class="table align-middle table-basic">
															<thead style="text-align: center">
																<tr>
																	<th scope="col" width="5%">NO</th>
																	<th scope="col">Produk</th>
																	<th scope="col">Qty</th>
																	<th scope="col">Stock</th>
																	<th scope="col">Status</th>
																	<th scope="col">Satuan</th>
																	<th scope="col">Harga / Unit</th>
																	<th scope="col">Harga NET</th>
																	<th scope="col">Taxes</th>
																	<th scope="col">Harga Total</th>
																</tr>
															</thead>
															<tbody id="tableBody"></tbody>
														</table>

														<hr class="custom-hr">

														<div class="row mt-3 mb-2">
															<div class="col-lg-6">
																<p style="font-weight: 700; font-size: 16px; margin: 0;">Harga Total : <span style="font-size: 16px; font-weight: 400;" class="d-total-harga-permintaan"></span><span class="text-success"> (Harga Valid)</span></p>
															</div>
														</div>

													</div>
												</div>
											</div>
										</div>
									</section>
								</div>
								<div class="tab-pane fade" id="progress" role="tabpanel" aria-labelledby="progress-tab"></div>
								<div class="tab-pane fade" id="jadwal" role="tabpanel" aria-labelledby="jadwal-tab"></div>
								<div class="tab-pane fade" id="diskusi" role="tabpanel" aria-labelledby="diskusi-tab"></div>
								<div class="tab-pane fade" id="file" role="tabpanel" aria-labelledby="file-tab"></div>
								<div class="tab-pane fade" id="member" role="tabpanel" aria-labelledby="member-tab"></div>
								<div class="tab-pane fade" id="log-aktivitas" role="tabpanel" aria-labelledby="log-aktivitas-tab"></div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="filtermodal" tabindex="-1" aria-labelledby="filtermodalLabel" aria-hidden="true">
	<div class="modal-dialog filtermodal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<div>
					<p class="fw-bold">Filter</p>
				</div>
				<button type="button" class="" data-bs-dismiss="modal" aria-label="Close">
					<img src="{{ asset('backend/assets/images/svg/cross.svg') }}" alt="" draggable="false">
				</button>
			</div>
			<form action="/admin/inquiry" method="GET" autocomplete="off">
				<div class="modal-body p-3">
					<div class="fromGroup mb-3">
						<label class="fw-bold">Tanggal Mulai</label>
						<input class="form-control date-picker-calender hasDatepicker" type="date" id="filltertanggalmulai" name="filtertanggal" value="{{ $filtertanggal }}" />
					</div>

					<label class="fw-bold">Jenis</label>
					<div class="row row-cols-auto px-2 mb-3">
						<div class="col border border-2 border-primary rounded-pill d-flex align-items-center justify-content-center me-2 mb-2">
							<div class="form-check from-radio-custom">
								<input class="form-check-input" type="radio" name="filterjenis" id="radio-jenis-all" value="" {{ empty($filterjenis) ? "checked" : "" }}>
								<label class="form-check-label" for="radio-jenis-all">
									Semua
								</label>
							</div>
						</div>
						@foreach($inquiry_type as $row)
						<div class="col border border-2 border-primary rounded-pill d-flex align-items-center justify-content-center me-2 mb-2">
							<div class="form-check from-radio-custom">
								<input class="form-check-input" type="radio" name="filterjenis" id="radio-jenis-{{ $row->inquiry_type_id }}" value="{{ $row->inquiry_type_code }}" {{ ($filterjenis == $row->inquiry_type_code) ? "checked" : "" }}>
								<label class="form-check-label" for="radio-jenis-{{ $row->inquiry_type_id }}">
									{{ $row->inquiry_type_name }}
								</label>
							</div>
						</div>
						@endforeach
					</div>

					<label class="fw-bold">User</label>
					<div class="row row-cols-auto px-2 mb-3">
						<div class="col border border-2 border-primary rounded-pill d-flex align-items-center justify-content-center me-2 mb-2">
							<div class="form-check from-radio-custom">
								<input class="form-check-input" type="radio" name="filteruser" id="radio-user-all" value="" {{ empty($filteruser) ? "checked" : "" }}>
								<label class="form-check-label" for="radio-user-all">
									Semua
								</label>
							</div>
						</div>
						<div class="col border border-2 border-primary rounded-pill d-flex align-items-center justify-content-center me-2 mb-2">
							<div class="form-check from-radio-custom">
								<input class="form-check-input" type="radio" name="filteruser" id="radio-user-end" value="End User" {{ ($filteruser == "End User") ? "checked" : "" }}>
								<label class="form-check-label" for="radio-user-end">
									End User
								</label>
							</div>
						</div>
						<div class="col border border-2 border-primary rounded-pill d-flex align-items-center justify-content-center me-2 mb-2">
							<div class="form-check from-radio-custom">
								<input class="form-check-input" type="radio" name="filteruser" id="radio-user-reseller" value="Reseller" {{ ($filteruser == "Reseller") ? "checked" : "" }}>
								<label class="form-check-label" for="radio-user-reseller">
									Reseller
								</label>
							</div>
						</div>
						<div class="col border border-2 border-primary rounded-pill d-flex align-items-center justify-content-center me-2 mb-2">
							<div class="form-check from-radio-custom">
								<input class="form-check-input" type="radio" name="filteruser" id="radio-user-kontraktor" value="Kontraktor" {{ ($filteruser == "Kontraktor") ? "checked" : "" }}>
								<label class="form-check-label" for="radio-user-kontraktor">
									Kontraktor
								</label>
							</div>
						</div>
					</div>

					<label class="fw-bold">Stage Inqury</label>
					<div class="row row-cols-auto px-2 mb-3">
						<div class="col border border-2 border-primary rounded-pill d-flex align-items-center justify-content-center me-2 mb-2">
							<div class="form-check from-radio-custom">
								<input class="form-check-input" type="radio" name="filterstage" id="radio-stage-all" value="" {{ empty($filterstage) ? "checked" : "" }}>
								<label class="form-check-label" for="radio-stage-all">
									Semua
								</label>
							</div>
						</div>
						@foreach($inquiry_status as $row)
						<div class="col border border-2 border-primary rounded-pill d-flex align-items-center justify-content-center me-2 mb-2">
							<div class="form-check from-radio-custom">
								<input class="form-check-input" type="radio" name="filterstage" id="radio-stage-{{ $row->inquiry_status_id }}" value="{{ $row->inquiry_status_code }}" {{ ($filterstage == $row->inquiry_status_code) ? "checked" : "" }}>
								<label class="form-check-label" for="radio-stage-{{ $row->inquiry_status_id }}">
									{{ $row->inquiry_status_name }}
								</label>
							</div>
						</div>
						@endforeach
					</div>

					<label class="fw-bold">Status</label>
					<div class="row row-cols-auto px-2 mb-3">
						<div class="col border border-2 border-primary rounded-pill d-flex align-items-center justify-content-center me-2 mb-2">
							<div class="form-check from-radio-custom">
								<input class="form-check-input" type="radio" name="filterstatus" id="radio-status-all" value="" {{ empty($filterstatus) ? "checked" : "" }}>
								<label class="form-check-label" for="radio-status-all">
									Semua
								</label>
							</div>
						</div>
						<div class="col border border-2 border-primary rounded-pill d-flex align-items-center justify-content-center me-2 mb-2">
							<div class="form-check from-radio-custom">
								<input class="form-check-input" type="radio" name="filterstatus" id="radio-status-progress" value="in progress" {{ ($filterstatus == "in progress") ? "checked" : "" }}>
								<label class="form-check-label" for="radio-status-progress">
									In Progress
								</label>
							</div>
						</div>
						<div class="col border border-2 border-primary rounded-pill d-flex align-items-center justify-content-center me-2 mb-2">
							<div class="form-check from-radio-custom">
								<input class="form-check-input" type="radio" name="filterstatus" id="radio-status-overdue" value="overdue" {{ ($filterstatus == "overdue") ? "checked" : "" }}>
								<label class="form-check-label" for="radio-status-overdue">
									Overdue
								</label>
							</div>
						</div>
					</div>

					<label class="fw-bold">Asal</label>
					<div class="row row-cols-auto px-2 mb-3">
						<div class="col border border-2 border-primary rounded-pill d-flex align-items-center justify-content-center me-2 mb-2">
							<div class="form-check from-radio-custom">
								<input class="form-check-input" type="radio" name="filterasal" id="radio-asal-all" value="" {{ empty($filterasal) ? "checked" : "" }}>
								<label class="form-check-label" for="radio-asal-all">
									Semua
								</label>
							</div>
						</div>
						@foreach($origin_inquiry as $row)
						<div class="col border border-2 border-primary rounded-pill d-flex align-items-center justify-content-center me-2 mb-2">
							<div class="form-check from-radio-custom">
								<input class="form-check-input" type="radio" name="filterasal" id="radio-asal-{{ $row->origin_inquiry_id }}" value="{{ $row->origin_inquiry_code }}" {{ ($filterasal == $row->origin_inquiry_code) ? "checked" : "" }}>
								<label class="form-check-label" for="radio-asal-{{ $row->origin_inquiry_id }}">
									{{ $row->origin_inquiry_name }}
								</label>
							</div>
						</div>
						@endforeach
					</div>

					<label class="fw-bold">Kategori</label>
					<div class="row row-cols-auto px-2 mb-3">
						<div class="col border border-2 border-primary rounded-pill d-flex align-items-center justify-content-center me-2 mb-2">
							<div class="form-check from-radio-custom">
								<input class="form-check-input" type="radio" name="filterkategori" id="radio-kategori-all" value="" {{ empty($filterkategori) ? "checked" : "" }}>
								<label class="form-check-label" for="radio-kategori-all">
									Semua
								</label>
							</div>
						</div>
						@foreach($product_divisions as $row)
						<div class="col border border-2 border-primary rounded-pill d-flex align-items-center justify-content-center me-2 mb-2">
							<div class="form-check from-radio-custom">
								<input class="form-check-input" type="radio" name="filterkategori" id="radio-kategori-{{ $row->product_divisions_id }}" value="{{ $row->product_divisions_code }}" {{ ($filterkategori == $row->product_divisions_code) ? "checked" : "" }}>
								<label class="form-check-label" for="radio-kategori-{{ $row->product_divisions_id }}">
									{{ $row->product_divisions_name }}
								</label>
							</div>
						</div>
						@endforeach
					</div>

				</div>
				<div class="modal-footer">
					<div class="d-flex justify-content-end">
						<div class="me-2">
							<button type="button" class="btn btn-danger2 btn-icon" id="reset-filters">
								<span class="button-content-wrapper">
									<span class="button-icon align-icon-left">
										<img src="{{ asset('backend/assets/images/svg/trash.svg') }}">
									</span>
									<span class="button-text">Hapus Filter</span>
								</span>
							</button>
						</div>
						<div class="me-2">
							<button type="submit" class="btn btn-primary btn-icon">
								<span class="button-content-wrapper">
									<span class="button-icon align-icon-left">
										<img src="{{ asset('backend/assets/images/svg/floppydisk2.svg') }}">
									</span>
									<span class="button-text">Simpan</span>
								</span>
							</button>
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>

<div class="modal fade" id="listpermintaanmodal" tabindex="-1" aria-labelledby="listpermintaanmodalLabel" aria-hidden="true">
	<div class="modal-dialog listpermintaanmodal-dialog modal-xl modal-dialog-scrollable">
		<div class="modal-content">

			<div class="modal-header">
				<div>
					<p class="fs-4">List Permintaan</p>
				</div>
				<button type="button" class="" data-bs-dismiss="modal" aria-label="Close">
					<img src="{{ asset('backend/assets/images/svg/cross.svg') }}" alt="" draggable="false">
				</button>
			</div>

			<div class="modal-body p-3">
				<div class="card-details-wrap">
					<div class="card-details-body">

						<div class="table-wrapper">
							<div class="table-content table-responsive">
								<table class="table align-middle table-basic">
									<thead style="text-align: center">
										<tr>
											<th scope="col" width="5%">NO</th>
											<th scope="col">Produk</th>
											<th scope="col">Qty</th>
											<th scope="col">Stock</th>
											<th scope="col">Status</th>
											<th scope="col">Satuan</th>
											<th scope="col">Harga / Unit</th>
											<th scope="col">Harga NET</th>
											<th scope="col">Taxes</th>
											<th scope="col">Harga Total</th>
										</tr>
									</thead>
									<tbody id="tableListPermintaan"></tbody>
								</table>
							</div>
						</div>

						<hr class="custom-hr">

						<p class="fs-4">Keterangan</p>
						<div class="keterangan-detail-permintaan"></div>

					</div>
				</div>
			</div>

		</div>
	</div>
</div>

<div class="modal fade" id="viewmodaloncallpress" tabindex="-1" aria-labelledby="viewmodaloncallpressLabel" aria-hidden="true">
	<div class="modal-dialog viewmodaloncallpress-dialog modal-xl modal-dialog-scrollable">
		<div class="modal-content">

			<div class="modal-header">
				<div>
					<button class="plain-btn rt-mr-8" id="btn-download-inquiry">
						<div class="btn-content">
							<svg width="135" height="40" viewBox="0 0 135 40" fill="none" xmlns="http://www.w3.org/2000/svg">
								<!-- Download icon paths -->
								<path d="M20 25V15" stroke="#191B1C" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round"></path>
								<path d="M15 20L20 25L25 20" stroke="#191B1C" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round"></path>
								<path d="M26.25 26.875H13.75C13.5842 26.875 13.4253 26.8092 13.3081 26.6919C13.1908 26.5747 13.125 26.4158 13.125 26.25V13.75C13.125 13.5842 13.1908 13.4253 13.3081 13.3081C13.4253 13.1908 13.5842 13.125 13.75 13.125H26.25C26.4158 13.125 26.5747 13.1908 26.6919 13.3081C26.8092 13.4253 26.875 13.5842 26.875 13.75V26.25C26.875 26.4158 26.8092 26.5747 26.6919 26.6919C26.5747 26.8092 26.4158 26.875 26.25 26.875Z" stroke="#191B1C" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round"></path>
								<!-- Added text -->
								<text x="45" y="25" font-family="Arial" font-size="14" fill="#191B1C">Download</text>
							</svg>
						</div>
					</button>

				</div>
				<button type="button" class="" data-bs-dismiss="modal" aria-label="Close">
					<img src="{{ asset('backend/assets/images/svg/cross.svg') }}" alt="" draggable="false">
				</button>
			</div>

			<input type="hidden" id="d-inquiry-id-kanban2">
            <input type="hidden" id="d-inquiry-type-user"></input>

			<div class="modal-body p-3">
				<div class="card-details-wrap">
					<div class="card-details-body">

						<div class="project-idea-wrap">
							<div class="project-idea-header d-flex justify-content-between align-items-center p-3 rounded" style="background-color: #dc3545;">
								<div>
									<h5 class="text-white mb-1">Harga Masih Ada Yang Kosong! 💰</h5>
									<p class="text-white mb-0">Isi harga sekarang sebelum level berikutnya terbuka!</p>
								</div>
								@if ($usr->can('inquiry.editoncallpress'))
								<div class="d-flex gap-2">
									<button class="btn btn-light" onclick="showwarningbacktosales()">Data Nggak Lengkap</button>
									<button class="btn btn-primary" onclick="showwarningforwardapprove()">Selesai</button>
								</div>
								@endif
							</div>

							<div class="project-idea-body">
								<div class="project-idea-data d-flex">
									<div class="col-lg-3">
										<div class="project-idea-data-left">
											<h5 class="text-dark mb-1 d-inquiry-oncallprice-nomor" style="font-size: 18px;"></h5>
											<p>Inquiry Dibuat : <span class="d-inquiry-oncallprice-create-date"></span></p>
										</div>
									</div>
									<div class="col-lg-9">
										<ul class="d-flex">
											<li class="me-2">
												<span class="badge rounded-pill bg-warning-50 text-warning-500 d-inquiry-oncallprice-type"></span>
											</li>
										</ul>
									</div>
								</div>
							</div>
						</div>


						<div class="row">
							<div class="col-lg-6">
								<div class="project-idea-data" style="pointer-events: none; opacity: 0.6;">
									<h5 class="text-dark mb-2">Due Date</h5>
									<button type="button" class="btn btn-icon" style="background-color: #8D98AF;" id="" name="">
										<span class="button-content-wrapper">
											<span class="button-icon align-icon-left">
												<input type="checkbox" id="taskCheckbox" class="custom-checkbox">
											</span>
											<span class="button-text text-white d-inquiry-oncallprice-due-date"></span>
										</span>
									</button>
								</div>
							</div>
							<div class="col-lg-6">
								<div class="project-idea-data" style="pointer-events: none; opacity: 0.6;">
									<h5 class="text-dark mb-2">Keputusan</h5>
									<button type="button" class="btn btn-icon btn-primary" id="" name="">
										<span class="button-content-wrapper">
											<span class="button-icon align-icon-left">
												<i class="ph-check-square text-white"></i> <!-- Changed Icon -->
											</span>
											<span class="button-text text-white"> 31 Jan 2023 (20:15) </span>
										</span>
									</button>
								</div>
							</div>
						</div>

						{{-- Deskripsi --}}
						<div class="row mt-3">
							<div class="col-lg-6">
								<div class="company-customer">
									<h6 class="table-inquiry-title">Perusahaan Customer</h6>
									<table class="table-inquiry-header">
										<tr>
											<td style="width: 6rem;">Perusahaan</td>
											<td>: <span class="d-inquiry-oncallprice-customer-nama"></span></td>
										</tr>
										<tr>
											<td>Provinsi</td>
											<td>: <span class="d-inquiry-oncallprice-customer-provinsi"></span></td>
										</tr>
										<tr>
											<td>Kota</td>
											<td>: <span class="d-inquiry-oncallprice-customer-kota"></span></td>
										</tr>
										<tr>
											<td>Alamat</td>
											<td>: <span class="d-inquiry-oncallprice-customer-alamat"></span></td>
										</tr>
										<tr>
											<td>Email</td>
											<td>: <span class="d-inquiry-oncallprice-customer-email"></span></td>
										</tr>
										<tr>
											<td>No Telp</td>
											<td>: <span class="d-inquiry-oncallprice-customer-telp"></span></td>
										</tr>
										<tr>
											<td>PIC</td>
											<td>: <span class="d-inquiry-oncallprice-customer-pic"></span></td>
										</tr>
									</table>
								</div>
							</div>
							<div class="col-lg-6">
								<div class="final-user">
									<h5 class="table-inquiry-title">User Final</h5>
									<table class="table-inquiry-header">
										<tr>
											<td style="width: 7rem;">Nama</td>
											<td>: <span class="d-inquiry-oncallprice-user-name"></span></td>
										</tr>
										<tr>
											<td>Email</td>
											<td>: <span class="d-inquiry-oncallprice-user-email"></span></td>
										</tr>
										<tr>
											<td>Telp</td>
											<td>: <span class="d-inquiry-oncallprice-user-telp"></span></td>
										</tr>
									</table>
								</div>
								<div class="information-inquiry">
									<h5 class="table-inquiry-title">Informasi Inquiry</h5>
									<table class="table-inquiry-header">
										<tr>
											<td style="width: 7rem;">Asal Inquiry</td>
											<td>: <span class="badge rounded-3 bg-warning-50 text-warning-500 d-inquiry-oncallprice-origin"></span></td>
										</tr>
										<tr>
											<td>Status Saat Ini</td>
											<td>: <span class="text-warning d-inquiry-oncallprice-status"></span></td>
										</tr>
										<tr>
											<td>Jenis</td>
											<td>
												<div class="d-inquiry-oncallprice-product">
													<ul class="d-flex">
														<li class="me-2">
															<span class="badge rounded-pill bg-warning-50 text-warning-500">SS</span>
														</li>
													</ul>
												</div>
											</td>
										</tr>
									</table>
								</div>
							</div>
						</div>

						<div class="row my-4">
							<div class="col-lg-6">
								<div class="project-idea-data">
									<h5 class="text-dark mb-2 fw-bold">Score</h5>
									<div class="d-flex justify-content-start" style="border: 2px solid #E5E7E8; border-radius: 8px; padding: 20px;">
										<img src="{{ asset('backend/assets/images/start-green.png')}}" alt="">
										<div class="row ms-1">
											<p class="m-0" style="font-size: 16px; font-weight: 500;">Score Final</p>
											<p class="text-success m-0 d-flex" style="font-size: 36px; font-weight: 700;">0/100 <a class="text-primary ms-2" href="" style="font-size: 14px; font-weight: 700;">Lihat Detail <img src="{{ asset('backend/assets/images/svg/arrow-icon.svg')}}" alt="" style="margin-top: -2px; scale: 1.5; transform: rotate(-90deg);"></a></p>
										</div>
									</div>
								</div>
							</div>
							<div class="col-lg-6">
								<div class="project-idea-data">
									<h5 class="text-white mb-2">Score</h5>
									<div class="d-flex justify-content-start" style="border: 2px solid #E5E7E8; border-radius: 8px; padding: 20px;">
										<img src="{{ asset('backend/assets/images/start-blue.png')}}" alt="">
										<div class="row ms-1">
											<p class="m-0" style="font-size: 16px; font-weight: 500;">Score Penggalian Sales</p>
											<p class="text-success m-0 d-flex" style="font-size: 36px; font-weight: 700;">0% <a class="ms-2" href="" style="font-size: 14px; font-weight: 700; color: #626C70;">Buat Schedule Dulu <img src="{{ asset('backend/assets/images/svg/arrow-icon.svg')}}" alt="" style="margin-top: -2px; scale: 1.5; transform: rotate(-90deg);"></a></p>
										</div>
									</div>
								</div>
							</div>
						</div>

					</div>
					<div class="project-tab px-2">
						<ul class="nav nav-tabs" id="myTab" role="tablist">
							<li class="nav-item" role="presentation">
								<button class="nav-link active" id="list-permintaan-tab" data-bs-toggle="tab" data-bs-target="#list-permintaan" type="button" role="tab" aria-controls="list-permintaan" aria-selected="true"> List Permintaan </button>
							</li>
							<li class="nav-item" role="presentation">
								<button class="nav-link" id="progress-tab" data-bs-toggle="tab" data-bs-target="#progress" type="button" role="tab" aria-controls="progress" aria-selected="false"> Progress </button>
							</li>
							<li class="nav-item" role="presentation">
								<button class="nav-link" id="jadwal-tab" data-bs-toggle="tab" data-bs-target="#jadwal" type="button" role="tab" aria-controls="jadwal" aria-selected="false"> Jadwal </button>
							</li>
							<li class="nav-item" role="presentation">
								<button class="nav-link" id="diskusi-tab" data-bs-toggle="tab" data-bs-target="#diskusi" type="button" role="tab" aria-controls="diskusi" aria-selected="false"> Diskusi </button>
							</li>
							<li class="nav-item" role="presentation">
								<button class="nav-link" id="file-tab" data-bs-toggle="tab" data-bs-target="#file" type="button" role="tab" aria-controls="file" aria-selected="false"> File </button>
							</li>
							<li class="nav-item" role="presentation">
								<button class="nav-link" id="member-tab" data-bs-toggle="tab" data-bs-target="#member" type="button" role="tab" aria-controls="member" aria-selected="false"> Member </button>
							</li>
							<li class="nav-item" role="presentation">
								<button class="nav-link" id="log-aktivitas-tab" data-bs-toggle="tab" data-bs-target="#log-aktivitas" type="button" role="tab" aria-controls="log-aktivitas" aria-selected="false"> Log Aktivitas </button>
							</li>
						</ul>
						<div class="project-tab-body_s">
							<div class="tab-content" id="myTabContent">
								<div class="tab-pane fade show active" id="list-permintaan" role="tabpanel" aria-labelledby="list-permintaan-tab">
									<section class="tables">
										<div class="row">
											<div class="col-lg-12">
												<div class="table-wrapper">
													<div class="table-content table-responsive">

														<div class="row mt-2">
															<div class="col-lg-6">
																<p class="m-0" style="font-weight: 500; font-size: 14px;">List Permintaan</p>
																<p class="m-0" style="font-size: 14px;"><span class="d-total-produk-permintaan-oncallprice"></span> Produk</p>
															</div>
															<div class="col-lg-6 text-end d-flex align-items-center justify-content-end">
																<button class="btn btn-primary" id="btn-detail-permintaan-on-call-price" disabled>
																	Lihat Detail
																</button>
															</div>
														</div>

														<hr class="custom-hr">

														<div class="row my-2">
															<div class="col-lg-6">
																<table class="table-inquiry-detail">
																	<tr>
																		<td style="width: 6rem;">Stock</td>
																		<td>: <span class="d-inquiry-oncallprice-warehaouse"></span></td>
																	</tr>
																	<tr>
																		<td>User</td>
																		<td>: <span class="d-inquiry-oncallprice-customer-type">End User</span></td>
																	</tr>
																</table>
															</div>
															<div class="col-lg-6">
																<table class="table-inquiry-detail">
																	<tr>
																		<td style="width: 6rem;">OC</td>
																		<td>: <span class="d-inquiry-oncallprice-oc"></span></td>
																	</tr>
																	<tr>
																		<td>Ongkir</td>
																		<td>: <span class="d-inquiry-oncallprice-shopping-cost"></span></td>
																	</tr>
																</table>
															</div>
														</div>

														<div class="row">
															<div class="col-lg-6">

															</div>
														</div>

														<table class="table align-middle table-basic">
															<thead style="text-align: center">
																<tr>
																	<th scope="col" width="5%">NO</th>
																	<th scope="col">Produk</th>
																	<th scope="col">Qty</th>
																	<th scope="col">Status</th>
																	<th scope="col">Harga / Unit</th>
																	<th scope="col">Harga Total</th>
																	<th scope="col">Taxes</th>
																	@if ($usr->can('inquiry.editoncallpress'))
																		<th scope="col">Aksi</th>
																	@endif
																</tr>
															</thead>
															<tbody id="tableBody-kanban2"></tbody>
														</table>

														<hr class="custom-hr">

														<div class="row mt-3 mb-2">
															<div class="col-lg-6">
																<p style="font-weight: 700; font-size: 16px; margin: 0;">Harga Total : <span style="font-size: 16px; font-weight: 400;" class="d-total-harga-permintaan-oncallprice"></span><span class="text-success"> (Harga Valid)</span></p>
															</div>
														</div>

													</div>
												</div>
											</div>
										</div>
									</section>
								</div>
								<div class="tab-pane fade" id="progress" role="tabpanel" aria-labelledby="progress-tab"></div>
								<div class="tab-pane fade" id="jadwal" role="tabpanel" aria-labelledby="jadwal-tab"></div>
								<div class="tab-pane fade" id="diskusi" role="tabpanel" aria-labelledby="diskusi-tab"></div>
								<div class="tab-pane fade" id="file" role="tabpanel" aria-labelledby="file-tab"></div>
								<div class="tab-pane fade" id="member" role="tabpanel" aria-labelledby="member-tab"></div>
								<div class="tab-pane fade" id="log-aktivitas" role="tabpanel" aria-labelledby="log-aktivitas-tab"></div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="viewbacktosales_oncallpress" tabindex="-1" role="dialog" aria-labelledby="backtosales" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content text-center px-4 py-3">

      <!-- Tombol Close -->
      <div class="d-flex justify-content-end">
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="border: none; background: transparent; font-size: 1.5rem;">&times;</button>
      </div>

      <!-- Icon Tanya -->
      <div class="my-2">
        <div class="mx-auto d-flex justify-content-center align-items-center">
          <svg xmlns="http://www.w3.org/2000/svg" width="100px" height="100px" fill="#005ce8" viewBox="0 0 256 256"><path d="M140,180a12,12,0,1,1-12-12A12,12,0,0,1,140,180ZM128,72c-22.06,0-40,16.15-40,36v4a8,8,0,0,0,16,0v-4c0-11,10.77-20,24-20s24,9,24,20-10.77,20-24,20a8,8,0,0,0-8,8v8a8,8,0,0,0,16,0v-.72c18.24-3.35,32-17.9,32-35.28C168,88.15,150.06,72,128,72Zm104,56A104,104,0,1,1,128,24,104.11,104.11,0,0,1,232,128Zm-16,0a88,88,0,1,0-88,88A88.1,88.1,0,0,0,216,128Z"></path></svg>
        </div>
      </div>

      <!-- Judul dan Pesan -->
      <div class="modal-body">
        <h5 class="fw-bold">Data Sales Kurang? Suruh Cek Lagi!</h5>
        <p class="text-muted mb-0">
          Proses selanjutnya bakal balik ke sales untuk melengkapi data yang kurang!
        </p>
      </div>

      <!-- Footer -->
      <div class="modal-footer justify-content-center border-0 mt-2">
        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Kembali</button>
        <button type="button" class="btn btn-primary" onclick="update_stage_oncallpress($('#d-inquiry-id-kanban2').val(), 'STATUS001')">Lanjut</button>
      </div>

    </div>
  </div>
</div>

<div class="modal fade" id="viewapprove_oncallpress" tabindex="-1" role="dialog" aria-labelledby="approve" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content text-center px-4 py-3">

      <!-- Tombol Close -->
      <div class="d-flex justify-content-end">
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="border: none; background: transparent; font-size: 1.5rem;">&times;</button>
      </div>

      <!-- Icon Tanya -->
      <div class="my-2">
        <div class="mx-auto d-flex justify-content-center align-items-center">
          <svg xmlns="http://www.w3.org/2000/svg" width="100px" height="100px" fill="#005ce8" viewBox="0 0 256 256"><path d="M140,180a12,12,0,1,1-12-12A12,12,0,0,1,140,180ZM128,72c-22.06,0-40,16.15-40,36v4a8,8,0,0,0,16,0v-4c0-11,10.77-20,24-20s24,9,24,20-10.77,20-24,20a8,8,0,0,0-8,8v8a8,8,0,0,0,16,0v-.72c18.24-3.35,32-17.9,32-35.28C168,88.15,150.06,72,128,72Zm104,56A104,104,0,1,1,128,24,104.11,104.11,0,0,1,232,128Zm-16,0a88,88,0,1,0-88,88A88.1,88.1,0,0,0,216,128Z"></path></svg>
        </div>
      </div>

      <!-- Judul dan Pesan -->
      <div class="modal-body">
        <h5 class="fw-bold">Ready to Move Forward?🚀</h5>
        <p class="text-muted mb-0">
          Pastikan semua sudah beres, inquiry akan lanjut ke sales!
        </p>
      </div>

      <!-- Footer -->
      <div class="modal-footer justify-content-center border-0 mt-2">
        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Kembali</button>
        <button type="button" class="btn btn-primary" onclick="update_stage_oncallpress($('#d-inquiry-id-kanban2').val(), 'STATUS003')">Lanjut</button>
      </div>

    </div>
  </div>
</div>

<div class="modal fade" id="viewadddetailitem_oncallpress" tabindex="-1" aria-labelledby="viewadddetailitem_oncallpressLabel" aria-hidden="true">
	<div class="modal-dialog viewmodaloncallpress-dialog modal-xl modal-dialog-centered">
		<div class="modal-content">

			<div class="modal-header">
				<h5 class="body-font-3">On Call Price</h5>
				<button type="button" class="" data-bs-dismiss="modal" aria-label="Close">
					<img src="{{ asset('backend/assets/images/svg/cross.svg') }}" alt="" draggable="false">
				</button>
			</div>

			<div class="modal-body">
				<div class="mb-3">
					<label class="form-label fw-bold">Harga Pokok</label>
					<input type="number" class="form-control text-left" id="d-hargaPokok-oncallprice" value="">
				</div>

				<div class="row text-center mb-2 fw-bold" style="color: #005ce8;">
					<div class="col">End User</div>
					<div class="col">Kontraktor</div>
					<div class="col">Reseller</div>
					<div class="col">Price List</div>
				</div>

				<div class="row mb-3">
					<!-- Margin (%) -->
					<div class="col">
						<label>Margin ( % )</label>
						<input type="number" class="form-control text-center" value="" id="d-marginEndUser-oncallprice">
					</div>
					<div class="col">
						<label>Margin ( % )</label>
						<input type="number" class="form-control text-center" value="" id="d-marginKontraktor-oncallprice">
					</div>
					<div class="col">
						<label>Margin ( % )</label>
						<input type="number" class="form-control text-center" value="" id="d-marginReseller-oncallprice">
					</div>
					<div class="col">
						<label>Margin ( % )</label>
						<input type="number" class="form-control text-center" value="" id="d-marginPricelist-oncallprice">
					</div>
				</div>

				<input type="hidden" id="d-inquiry-oncallprace-aktive">

				<div class="row">
					<!-- Harga akhir -->
					<div class="col">
						<label class="form-label">Harga End User</label>
						<input type="number" class="form-control text-center" value="" id="d-hargaEndUser-oncallprice">
					</div>
					<div class="col">
						<label class="form-label">Harga Kontraktor</label>
						<input type="number" class="form-control text-center" value="" id="d-hargaKontraktor-oncallprice">
					</div>
					<div class="col">
						<label class="form-label">Harga Reseller</label>
						<input type="number" class="form-control text-center" value="" id="d-hargaReseller-oncallprice">
					</div>
					<div class="col">
						<label class="form-label">Harga Price List</label>
						<input type="number" class="form-control text-center" value="" id="d-hargaPricelist-oncallprice">
					</div>
				</div>

                <div class="row">
                    <div class="col">
                        <label class="form-label">Brand</label>
                        <select class="form-control" id="d-oncall-price-brand-code" style="width: 100%;">
                            <option value="" disabled selected>Pilih data</option>
                        </select>
                    </div>
                    <div class="col">
                        <label class="form-label">Type</label>
                        <select class="form-control" id="d-oncall-price-product-division-code" style="width: 100%;">
                            <option value="" disabled selected>Pilih data</option>
                        </select>
                    </div>
                    <div class="col">
                        <label class="form-label">Satuan</label>
                        <select class="form-control" id="d-oncall-price-uom-code" style="width: 100%;">
                            <option value="" disabled selected>Pilih data</option>
                        </select>
                    </div>
                    <div class="col">
                        <label class="form-label">Kategori</label>
                        <select class="form-control" id="d-oncall-category-code" style="width: 100%;">
                            <option value="" disabled selected>Pilih data</option>
                        </select>
                    </div>
                </div>
			</div>

			<!-- Footer -->
			<div class="modal-footer justify-content-end">
				<button type="button" class="btn btn-primary" onclick="saveOnCallPrice()" id="btn-save-oncall" disabled>
					<svg xmlns="http://www.w3.org/2000/svg" width="20px" height="20px" fill="#ffffff" viewBox="0 0 256 256"><path d="M219.31,72,184,36.69A15.86,15.86,0,0,0,172.69,32H48A16,16,0,0,0,32,48V208a16,16,0,0,0,16,16H208a16,16,0,0,0,16-16V83.31A15.86,15.86,0,0,0,219.31,72ZM168,208H88V152h80Zm40,0H184V152a16,16,0,0,0-16-16H88a16,16,0,0,0-16,16v56H48V48H172.69L208,83.31ZM160,72a8,8,0,0,1-8,8H96a8,8,0,0,1,0-16h56A8,8,0,0,1,160,72Z"></path></svg> Simpan
				</button>
			</div>

		</div>
	</div>
</div>

<div class="modal fade" id="viewmodal_waiting_oncallprice" tabindex="-1" aria-labelledby="viewmodalLabel" aria-hidden="true">
	<div class="modal-dialog viewmodal-dialog modal-xl modal-dialog-scrollable">
		<div class="modal-content">

			<div class="modal-header">
				<div>
					<button class="plain-btn rt-mr-8" id="btn-download-inquiry">
						<div class="btn-content">
							<svg width="135" height="40" viewBox="0 0 135 40" fill="none" xmlns="http://www.w3.org/2000/svg">
								<!-- Download icon paths -->
								<path d="M20 25V15" stroke="#191B1C" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round"></path>
								<path d="M15 20L20 25L25 20" stroke="#191B1C" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round"></path>
								<path d="M26.25 26.875H13.75C13.5842 26.875 13.4253 26.8092 13.3081 26.6919C13.1908 26.5747 13.125 26.4158 13.125 26.25V13.75C13.125 13.5842 13.1908 13.4253 13.3081 13.3081C13.4253 13.1908 13.5842 13.125 13.75 13.125H26.25C26.4158 13.125 26.5747 13.1908 26.6919 13.3081C26.8092 13.4253 26.875 13.5842 26.875 13.75V26.25C26.875 26.4158 26.8092 26.5747 26.6919 26.6919C26.5747 26.8092 26.4158 26.875 26.25 26.875Z" stroke="#191B1C" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round"></path>
								<!-- Added text -->
								<text x="45" y="25" font-family="Arial" font-size="14" fill="#191B1C">Download</text>
							</svg>
						</div>
					</button>

				</div>
				<button type="button" class="" data-bs-dismiss="modal" aria-label="Close">
					<img src="{{ asset('backend/assets/images/svg/cross.svg') }}" alt="" draggable="false">
				</button>
			</div>

            <input type="hidden" id="d-inquiry-waiting-oncallprice-id">
            <input type="hidden" id="d-inquiry-waiting-oncallprice-code">
            <input type="hidden" id="d-inquiry-waiting-oncallprice-approvals-id">

			<div class="modal-body p-3">
				<div class="card-details-wrap">
					<div class="card-details-body">

						<div class="project-idea-wrap">
							<div class="project-idea-header d-flex justify-content-between align-items-center p-3 rounded" style="background-color: #323C55;">
								<div>
									<h5 class="text-white mb-1">Harga on call price mengunggu keputusan! 💰</h5>
									<p class="text-white mb-0">Harga akan menjadi valid ketika dilakukan approval.</p>
								</div>
								<div class="d-flex gap-2" id="button_verification_waiting_oncallprice">
									<button class="btn btn-light" onclick="showreject_waiting_oncallprice()">Reject</button>
									<button class="btn btn-primary" onclick="showapprove_waiting_approval()">Approve</button>
								</div>
							</div>

							<div class="project-idea-body">
								<div class="project-idea-data d-flex">
									<div class="col-lg-3">
										<div class="project-idea-data-left">
											<h5 class="text-dark mb-1 d-inquiry-waiting-oncallprice-nomor" style="font-size: 18px;"></h5>
											<p>Inquiry Dibuat : <span class="d-inquiry-waiting-oncallprice-create-date"></span></p>
										</div>
									</div>
									<div class="col-lg-9">
										<ul class="d-flex">
											<li class="me-2">
												<span class="badge rounded-pill bg-warning-50 text-warning-500 d-inquiry-waiting-oncallprice-type"></span>
											</li>
										</ul>
									</div>
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-lg-6">
								<div class="project-idea-data" style="pointer-events: none; opacity: 0.6;">
									<h5 class="text-dark mb-2">Due Date</h5>
									<button type="button" class="btn btn-icon" style="background-color: #8D98AF;" id="" name="">
										<span class="button-content-wrapper">
											<span class="button-icon align-icon-left">
												<input type="checkbox" id="taskCheckbox" class="custom-checkbox">
											</span>
											<span class="button-text text-white d-inquiry-waiting-oncallprice-due-date"></span>
										</span>
									</button>
								</div>
							</div>
							<div class="col-lg-6">
								<div class="project-idea-data" style="pointer-events: none; opacity: 0.6;">
									<h5 class="text-dark mb-2">Keputusan</h5>
									<button type="button" class="btn btn-icon btn-primary" id="" name="">
										<span class="button-content-wrapper">
											<span class="button-icon align-icon-left">
												<i class="ph-check-square text-white"></i> <!-- Changed Icon -->
											</span>
											<span class="button-text text-white"> 31 Jan 2023 (20:15) </span>
										</span>
									</button>
								</div>
							</div>
						</div>

						{{-- Deskripsi --}}
						<div class="row mt-3">
							<div class="col-lg-6">
								<div class="company-customer">
									<h6 class="table-inquiry-title">Perusahaan Customer</h6>
									<table class="table-inquiry-header">
										<tr>
											<td style="width: 6rem;">Perusahaan</td>
											<td>: <span class="d-inquiry-waiting-oncallprice-customer-nama"></span></td>
										</tr>
										<tr>
											<td>Provinsi</td>
											<td>: <span class="d-inquiry-waiting-oncallprice-customer-provinsi"></span></td>
										</tr>
										<tr>
											<td>Kota</td>
											<td>: <span class="d-inquiry-waiting-oncallprice-customer-kota"></span></td>
										</tr>
										<tr>
											<td>Alamat</td>
											<td>: <span class="d-inquiry-waiting-oncallprice-customer-alamat"></span></td>
										</tr>
										<tr>
											<td>Email</td>
											<td>: <span class="d-inquiry-waiting-oncallprice-customer-email"></span></td>
										</tr>
										<tr>
											<td>No Telp</td>
											<td>: <span class="d-inquiry-waiting-oncallprice-customer-telp"></span></td>
										</tr>
										<tr>
											<td>PIC</td>
											<td>: <span class="d-inquiry-waiting-oncallprice-customer-pic"></span></td>
										</tr>
									</table>
								</div>
							</div>
							<div class="col-lg-6">
								<div class="final-user">
									<h5 class="table-inquiry-title">User Final</h5>
									<table class="table-inquiry-header">
										<tr>
											<td style="width: 7rem;">Nama</td>
											<td>: <span class="d-inquiry-waiting-oncallprice-user-name"></span></td>
										</tr>
										<tr>
											<td>Email</td>
											<td>: <span class="d-inquiry-waiting-oncallprice-user-email"></span></td>
										</tr>
										<tr>
											<td>Telp</td>
											<td>: <span class="d-inquiry-waiting-oncallprice-user-telp"></span></td>
										</tr>
									</table>
								</div>
								<div class="information-inquiry">
									<h5 class="table-inquiry-title">Informasi Inquiry</h5>
									<table class="table-inquiry-header">
										<tr>
											<td style="width: 7rem;">Asal Inquiry</td>
											<td>: <span class="badge rounded-3 bg-warning-50 text-warning-500 d-inquiry-waiting-oncallprice-origin"></span></td>
										</tr>
										<tr>
											<td>Status Saat Ini</td>
											<td>: <span class="text-warning d-inquiry-waiting-oncallprice-status"></span></td>
										</tr>
										<tr>
											<td>Jenis</td>
											<td>
												<div class="d-inquiry-waiting-oncallprice-product">
													<ul class="d-flex">
														<li class="me-2">
															<span class="badge rounded-pill bg-warning-50 text-warning-500">SS</span>
														</li>
													</ul>
												</div>
											</td>
										</tr>
									</table>
								</div>
							</div>
						</div>

						<div class="row my-4">
							<div class="col-lg-6">
								<div class="project-idea-data">
									<h5 class="text-dark mb-2 fw-bold">Score</h5>
									<div class="d-flex justify-content-start" style="border: 2px solid #E5E7E8; border-radius: 8px; padding: 20px;">
										<img src="{{ asset('backend/assets/images/start-green.png')}}" alt="">
										<div class="row ms-1">
											<p class="m-0" style="font-size: 16px; font-weight: 500;">Score Final</p>
											<p class="text-success m-0 d-flex" style="font-size: 36px; font-weight: 700;">0/100 <a class="text-primary ms-2" href="" style="font-size: 14px; font-weight: 700;">Lihat Detail <img src="{{ asset('backend/assets/images/svg/arrow-icon.svg')}}" alt="" style="margin-top: -2px; scale: 1.5; transform: rotate(-90deg);"></a></p>
										</div>
									</div>
								</div>
							</div>
							<div class="col-lg-6">
								<div class="project-idea-data">
									<h5 class="text-white mb-2">Score</h5>
									<div class="d-flex justify-content-start" style="border: 2px solid #E5E7E8; border-radius: 8px; padding: 20px;">
										<img src="{{ asset('backend/assets/images/start-blue.png')}}" alt="">
										<div class="row ms-1">
											<p class="m-0" style="font-size: 16px; font-weight: 500;">Score Penggalian Sales</p>
											<p class="text-success m-0 d-flex" style="font-size: 36px; font-weight: 700;">0% <a class="ms-2" href="" style="font-size: 14px; font-weight: 700; color: #626C70;">Buat Schedule Dulu <img src="{{ asset('backend/assets/images/svg/arrow-icon.svg')}}" alt="" style="margin-top: -2px; scale: 1.5; transform: rotate(-90deg);"></a></p>
										</div>
									</div>
								</div>
							</div>
						</div>

					</div>
					<div class="project-tab px-2">
						<ul class="nav nav-tabs" id="myTab" role="tablist">
							<li class="nav-item" role="presentation">
								<button class="nav-link active" id="list-permintaan-tab" data-bs-toggle="tab" data-bs-target="#list-permintaan" type="button" role="tab" aria-controls="list-permintaan" aria-selected="true"> List Permintaan </button>
							</li>
							<li class="nav-item" role="presentation">
								<button class="nav-link" id="progress-tab" data-bs-toggle="tab" data-bs-target="#progress" type="button" role="tab" aria-controls="progress" aria-selected="false"> Progress </button>
							</li>
							<li class="nav-item" role="presentation">
								<button class="nav-link" id="jadwal-tab" data-bs-toggle="tab" data-bs-target="#jadwal" type="button" role="tab" aria-controls="jadwal" aria-selected="false"> Jadwal </button>
							</li>
							<li class="nav-item" role="presentation">
								<button class="nav-link" id="diskusi-tab" data-bs-toggle="tab" data-bs-target="#diskusi" type="button" role="tab" aria-controls="diskusi" aria-selected="false"> Diskusi </button>
							</li>
							<li class="nav-item" role="presentation">
								<button class="nav-link" id="file-tab" data-bs-toggle="tab" data-bs-target="#file" type="button" role="tab" aria-controls="file" aria-selected="false"> File </button>
							</li>
							<li class="nav-item" role="presentation">
								<button class="nav-link" id="member-tab" data-bs-toggle="tab" data-bs-target="#member" type="button" role="tab" aria-controls="member" aria-selected="false"> Member </button>
							</li>
							<li class="nav-item" role="presentation">
								<button class="nav-link" id="log-aktivitas-tab" data-bs-toggle="tab" data-bs-target="#log-aktivitas" type="button" role="tab" aria-controls="log-aktivitas" aria-selected="false"> Log Aktivitas </button>
							</li>
						</ul>
						<div class="project-tab-body_s">
							<div class="tab-content" id="myTabContent">
								<div class="tab-pane fade show active" id="list-permintaan" role="tabpanel" aria-labelledby="list-permintaan-tab">
									<section class="tables">
										<div class="row">
											<div class="col-lg-12">
												<div class="table-wrapper">
													<div class="table-content table-responsive">

														<div class="row mt-2">
															<div class="col-lg-6">
																<p class="m-0" style="font-weight: 500; font-size: 14px;">List Permintaan</p>
																<p class="m-0" style="font-size: 14px;"><span class="d-total-produk-permintaan"></span> Produk</p>
															</div>
{{--															<div class="col-lg-6 text-end d-flex align-items-center justify-content-end">--}}
{{--																<button class="btn btn-primary" id="btn-detail-permintaan-waiting-oncallprice">--}}
{{--																	Lihat Detail--}}
{{--																</button>--}}
{{--															</div>--}}
														</div>

														<hr class="custom-hr">

														<div class="row my-2">
															<div class="col-lg-6">
																<table class="table-inquiry-detail">
																	<tr>
																		<td style="width: 6rem;">Stock</td>
																		<td>: <span class="d-inquiry-waiting-oncallprice-warehaouse"></span></td>
																	</tr>
																	<tr>
																		<td>User</td>
																		<td>: <span class="d-inquiry-waiting-oncallprice-customer-type">End User</span></td>
																	</tr>
																</table>
															</div>
															<div class="col-lg-6">
																<table class="table-inquiry-detail">
																	<tr>
																		<td style="width: 6rem;">OC</td>
																		<td>: <span class="d-inquiry-waiting-oncallprice-oc"></span></td>
																	</tr>
																	<tr>
																		<td>Ongkir</td>
																		<td>: <span class="d-inquiry-waiting-oncallprice-shopping-cost"></span></td>
																	</tr>
																</table>
															</div>
														</div>

														<div class="row">
															<div class="col-lg-6">

															</div>
														</div>

														<table class="table align-middle table-basic">
															<thead style="text-align: center">
																<tr>
																	<th scope="col" width="5%">NO</th>
																	<th scope="col">Produk</th>
																	<th scope="col">Qty</th>
																	<th scope="col">Stock</th>
																	<th scope="col">Status</th>
																	<th scope="col">Satuan</th>
																	<th scope="col">Harga / Unit</th>
																	<th scope="col">Harga NET</th>
																	<th scope="col">Taxes</th>
																	<th scope="col">Harga Total</th>
																</tr>
															</thead>
															<tbody id="tableBody_waiting_oncallprice"></tbody>
														</table>

														<hr class="custom-hr">

														<div class="row mt-3 mb-2">
															<div class="col-lg-6">
																<p style="font-weight: 700; font-size: 16px; margin: 0;">Harga Total : <span style="font-size: 16px; font-weight: 400;" class="d-total-harga-permintaan-waiting-oncallprice"></span><span class="text-danger"> (Harga Belum Valid)</span></p>
															</div>
														</div>

													</div>
												</div>
											</div>
										</div>
									</section>
								</div>
								<div class="tab-pane fade" id="progress" role="tabpanel" aria-labelledby="progress-tab"></div>
								<div class="tab-pane fade" id="jadwal" role="tabpanel" aria-labelledby="jadwal-tab"></div>
								<div class="tab-pane fade" id="diskusi" role="tabpanel" aria-labelledby="diskusi-tab"></div>
								<div class="tab-pane fade" id="file" role="tabpanel" aria-labelledby="file-tab"></div>
								<div class="tab-pane fade" id="member" role="tabpanel" aria-labelledby="member-tab"></div>
								<div class="tab-pane fade" id="log-aktivitas" role="tabpanel" aria-labelledby="log-aktivitas-tab"></div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="viewreject_waiting_oncallprice" tabindex="-1" role="dialog" aria-labelledby="reject_waiting_oncallprice" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content text-center px-4 py-3">

      <!-- Tombol Close -->
      <div class="d-flex justify-content-end">
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="border: none; background: transparent; font-size: 1.5rem;">&times;</button>
      </div>

      <!-- Icon Tanya -->
      <div class="my-2">
        <div class="mx-auto d-flex justify-content-center align-items-center">
		  <svg xmlns="http://www.w3.org/2000/svg" width="100px" height="100px" fill="#d54848" viewBox="0 0 256 256"><path d="M236.8,188.09,149.35,36.22h0a24.76,24.76,0,0,0-42.7,0L19.2,188.09a23.51,23.51,0,0,0,0,23.72A24.35,24.35,0,0,0,40.55,224h174.9a24.35,24.35,0,0,0,21.33-12.19A23.51,23.51,0,0,0,236.8,188.09ZM222.93,203.8a8.5,8.5,0,0,1-7.48,4.2H40.55a8.5,8.5,0,0,1-7.48-4.2,7.59,7.59,0,0,1,0-7.72L120.52,44.21a8.75,8.75,0,0,1,15,0l87.45,151.87A7.59,7.59,0,0,1,222.93,203.8ZM120,144V104a8,8,0,0,1,16,0v40a8,8,0,0,1-16,0Zm20,36a12,12,0,1,1-12-12A12,12,0,0,1,140,180Z"></path></svg>
        </div>
      </div>

      <!-- Judul dan Pesan -->
      <div class="modal-body">
        <h5 class="fw-bold">Yakin Reject On Call Price Ini?</h5>
        <p class="text-muted mb-0">
          Pastikan sudah review On Call Proce ini sebelum di reject
        </p>
      </div>

      <!-- Footer -->
      <div class="modal-footer justify-content-center border-0 mt-2">
        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Kembali</button>
        <button type="button" class="btn btn-primary" onclick="showmodal_insert_message_reject()">Lanjut</button>
      </div>

    </div>
  </div>
</div>

<div class="modal fade" id="viewmessage_reject_oncalprice" tabindex="-1" role="dialog" aria-labelledby="message_reject_oncalprice" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content text-center px-4 py-3">

      	<div class="modal-header">
			<h5 class="body-font-3">Alasan Reject</h5>
			<button type="button" class="" data-bs-dismiss="modal" aria-label="Close">
				<img src="{{ asset('backend/assets/images/svg/cross.svg') }}" alt="" draggable="false">
			</button>
		</div>

		<!-- Judul dan Pesan -->
		<div class="modal-body">
			<div class="mb-3">
				<label>Alasan</label>
                <textarea id="d-message-reject-oncallprice" aria-label="Masukkan alasan kamu" class="swal2-textarea" placeholder="Masukkan alasan kamu..." style="display: flex;"></textarea>
{{--				<input type="text" class="form-control" id="d-message-reject-oncallprice" value="">--}}
			</div>
		</div>

		<!-- Footer -->
		<div class="modal-footer justify-content-end">
			<button type="button" class="btn btn-primary" onclick="rejectInquiry_waiting_oncallprice()">
				<svg xmlns="http://www.w3.org/2000/svg" width="20px" height="20px" fill="#ffffff" viewBox="0 0 256 256"><path d="M219.31,72,184,36.69A15.86,15.86,0,0,0,172.69,32H48A16,16,0,0,0,32,48V208a16,16,0,0,0,16,16H208a16,16,0,0,0,16-16V83.31A15.86,15.86,0,0,0,219.31,72ZM168,208H88V152h80Zm40,0H184V152a16,16,0,0,0-16-16H88a16,16,0,0,0-16,16v56H48V48H172.69L208,83.31ZM160,72a8,8,0,0,1-8,8H96a8,8,0,0,1,0-16h56A8,8,0,0,1,160,72Z"></path></svg> Simpan
			</button>
		</div>

    </div>
  </div>
</div>

<div class="modal fade" id="viewapprove_waiting_oncallprice" tabindex="-1" role="dialog" aria-labelledby="approve_waiting_oncallprice" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content text-center px-4 py-3">

      <!-- Tombol Close -->
      <div class="d-flex justify-content-end">
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="border: none; background: transparent; font-size: 1.5rem;">&times;</button>
      </div>

      <!-- Icon Tanya -->
      <div class="my-2">
        <div class="mx-auto d-flex justify-content-center align-items-center">
          <svg xmlns="http://www.w3.org/2000/svg" width="100px" height="100px" fill="#005ce8" viewBox="0 0 256 256"><path d="M140,180a12,12,0,1,1-12-12A12,12,0,0,1,140,180ZM128,72c-22.06,0-40,16.15-40,36v4a8,8,0,0,0,16,0v-4c0-11,10.77-20,24-20s24,9,24,20-10.77,20-24,20a8,8,0,0,0-8,8v8a8,8,0,0,0,16,0v-.72c18.24-3.35,32-17.9,32-35.28C168,88.15,150.06,72,128,72Zm104,56A104,104,0,1,1,128,24,104.11,104.11,0,0,1,232,128Zm-16,0a88,88,0,1,0-88,88A88.1,88.1,0,0,0,216,128Z"></path></svg>
        </div>
      </div>

      <!-- Judul dan Pesan -->
      <div class="modal-body">
        <h5 class="fw-bold">Yakin Approve On Call Price</h5>
        <p class="text-muted mb-0">
          Pastikan sudah review on call price ini sebelum di approve
        </p>
      </div>

      <!-- Footer -->
      <div class="modal-footer justify-content-center border-0 mt-2">
        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Kembali</button>
{{--          <button type="button" class="btn btn-primary" onclick="update_stage_oncallpress($('#d-inquiry-waiting-oncallprice-id').val(), 'STATUS001')">Ya, Sudah</button>--}}
          <button type="button" class="btn btn-primary" onclick="approve_waiting_oncallpress()">Ya, Sudah</button>
      </div>

    </div>
  </div>
</div>


<style>
	.kanban-container {
		display: flex;
		gap: 20px;
		padding: 20px;
	}

	.kanban-column {
		min-height: 200px;
	}

	.card-priority {
		cursor: grab;
	}

	.card-priority__labels ul {
		flex-wrap: wrap;
	}

	.card-priority__labels ul li span {
		margin-right: .5rem;
		margin-bottom: .5rem;
	}

	.card-priority__footer {
		flex-direction: column;
		align-items: normal;
		margin-top: 8px;
	}

	.card-priority__footer div:nth-child(2) {
		display: flex;
		justify-content: flex-end;
		align-items: center;
		margin-top: 16px;
	}

	span.labels.red {
		background-color: transparent;
		font-weight: 700;
	}

	.plain-btn {
		display: inline-flex;
		align-items: center;
		justify-content: center;
		gap: 8px;
		/* Spacing between icon and text */
		background-color: #F5F6F7;
		border: none;
		padding: 0px 10px;
		border-radius: 8px;
		cursor: pointer;
		transition: background 0.3s;
	}

	.btn-content {
		display: flex;
		align-items: center;
		gap: 8px;
	}

	.plain-btn:hover {
		background-color: #E0E2E5;
	}

	.btn-text {
		font-size: 16px;
		font-weight: 500;
		color: #191B1C;
	}

	.card-details-wrap {
		max-width: 100%;
	}

	.project-idea-header {
		border-radius: 8px;
		padding: 20px;
	}

	.project-idea-header h3 {
		font-size: 18px;
		font-weight: 700;
		color: #fff;
	}

	.project-idea-header p {
		font-size: 14px;
		font-weight: 400;
		color: #fff;
		margin: 0;
		margin-top: 4px;
	}

	.project-idea-data {
		flex: 1;
	}

	.table-inquiry-title {
		font-size: 16px;
		font-weight: 500;
		margin-bottom: 0;
	}

	.table-inquiry-header td {
		padding: 4px 0;
		font-size: 14px;
		font-weight: 400;
		color: #111;
	}

	.table-inquiry-header td span {
		margin-left: 8px;
	}

	.custom-checkbox {
		width: 20px;
		/* Adjust size */
		height: 20px;
		cursor: pointer;
	}

	.custom-hr {
		border: none;
		height: 2px !important;
		/* Adjust thickness */
		background-color: #E5E7E8;
		/* Change color if needed */
	}

	.table-inquiry-detail td {
		margin: 0;
		font-size: 14px;
	}

	#inquiry-1 .cancel-inquiry {
		display: block;
	}

	#inquiry-2 .cancel-inquiry,
	#inquiry-3 .cancel-inquiry,
	#inquiry-4 .cancel-inquiry,
	#inquiry-5 .cancel-inquiry,
	#inquiry-6 .cancel-inquiry,
	#inquiry-7 .cancel-inquiry,
	#inquiry-8 .cancel-inquiry,
	#inquiry-9 .cancel-inquiry {
		display: none;
	}

	.kanban-section {
		height: 80vh;
		overflow: auto;
	}
</style>
<script>
	const onCallButton = @can('inquiry.editoncallpress')
		`<td class="text-center">
			<button class='btn btn-danger' onclick="add_callpress_item(PLACEHOLDER_ID)">On Call Price</button>
		</td>`
	@else
		''
	@endcan;

	$(document).ready(function() {
		$('#listpermintaanmodal').on('shown.bs.modal', function() {
			setTimeout(function() {
				$('#viewmodal').css('z-index', '-1');
				$('#viewmodaloncallpress').css('z-index', '-1');
			}, 100);
		});
		$('#listpermintaanmodal').on('hidden.bs.modal', function() {
			setTimeout(function() {
				$('#viewmodal').css('z-index', '');
				$('#viewmodaloncallpress').css('z-index', '');
			}, 100);
		});

		$('#btn-filter-inquiry').click(function() {
			$('#filtermodal').modal('show');
		})

		const thousandView = (number = 0) => {
			return number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
		}

		$('#btn-detail-permintaan').click(function() {
			let inquiryId = $('#d-inquiry-id').val();
			$.ajax({
				url: '/admin/inquiry/detail/' + inquiryId,
				dataType: 'json',
				success: function(response) {
					if (response.status == 200) {
						$("#listpermintaanmodal").modal("toggle");
						let inquiry = response.data.inquiry;
						$('.keterangan-detail-permintaan').html(inquiry.inquiry_notes);
						let list_permintaan = response.data.list_permintaan;
						$('#tableListPermintaan').empty();
						let totalProdukPermintaan = 0;
						let totalHargaPermintaan = 0;
						if (list_permintaan.length > 0) {
							list_permintaan.forEach(function(data, index) {
								totalProdukPermintaan += 1;
								totalHargaPermintaan += data.inquiry_product_total_price;
								$('#tableListPermintaan').append(`
                  <tr>
                    <td class="text-center">${ index + 1}</td>
                    <td class="text-center">${ data.inquiry_product_name }</td>
                    <td class="text-center">${ thousandView(data.inquiry_product_qty) }</td>
                    <td class="text-center">${ thousandView(data.goods_stock) }</td>
                    <td class="text-center">${ data.inquiry_product_status_on_inquiry }</td>
                    <td class="text-center">${ data.uom_name }</td>
                    <td class="text-center">${ thousandView(data.inquiry_product_pricelist) }</td>
                    <td class="text-center">${ thousandView(data.inquiry_product_net_price) }</td>
                    <td class="text-center">${ data.inquiry_taxes_percent } %</td>
                    <td class="text-center">${ thousandView(data.inquiry_product_total_price) }</td>
                  </tr>
                `);
							});
						} else {
							$('#tableListPermintaan').append('<tr><td colspan="10" class="text-center">No results found</td></tr>');
						}
					} else {
						Swal.fire({
							icon: 'warning',
							title: 'Warning!',
							text: 'Data tidak ditemukan!',
						})
					}
				},
				error: function(error) {
					console.log(error)
					Swal.fire({
						icon: 'error',
						title: 'Error!',
						text: 'Terjadi kesalahan data!',
					})
				}
			})
		})

		$('#reset-filters').on('click', function() {
			var $form = $(this).closest('form');
			$form.find('input[type=radio]').prop('checked', false);
			$form.find('input[type=date]').val('');
			$('#radio-jenis-all').prop('checked', true);
			$('#radio-user-all').prop('checked', true);
			$('#radio-stage-all').prop('checked', true);
			$('#radio-status-all').prop('checked', true);
			$('#radio-asal-all').prop('checked', true);
			$('#radio-kategori-all').prop('checked', true);
			$form.submit();
		});

		$('#btn-download-inquiry').click(function() {
			let inquiryId = $('#d-inquiry-id').val();
			if(inquiryId) {
				window.open('/admin/inquiry/download/' + inquiryId, '_blank', 'noopener,noreferrer');
			}
		})

        $('#viewadddetailitem_oncallpress').on('shown.bs.modal', function () {
            // Inisialisasi Select2
            $('#d-oncall-price-brand-code, #d-oncall-price-product-division-code, #d-oncall-price-uom-code, #d-oncall-category-code').select2({
                dropdownParent: $('#viewadddetailitem_oncallpress'),
                placeholder: "Pilih Data",
                allowClear: true,
                ajax: {
                    url: function () {
                        // Tentukan URL berdasarkan ID elemen
                        if ($(this).attr('id') === 'd-oncall-price-brand-code') return '/admin/combobrand';
                        if ($(this).attr('id') === 'd-oncall-price-product-division-code') return '/admin/comboproductdivision';
                        if ($(this).attr('id') === 'd-oncall-price-uom-code') return '/admin/combosatuan';
                        if ($(this).attr('id') === 'd-oncall-category-code') return '/admin/combokategori';
                    },
                    dataType: 'json',
                    delay: 250,
                    data: function (params) {
                        return { search: params.term };
                    },
                    processResults: function (data) {
                        return { results: data };
                    },
                    cache: true
                }
            });

        });
	});

    document.addEventListener("DOMContentLoaded", function () {

        function validateFields() {
            let isValid = true;

            const fields = [
                '#d-hargaPokok-oncallprice',
                '#d-marginEndUser-oncallprice',
                '#d-marginKontraktor-oncallprice',
                '#d-marginReseller-oncallprice',
                '#d-marginPricelist-oncallprice',
                '#d-hargaEndUser-oncallprice',
                '#d-hargaKontraktor-oncallprice',
                '#d-hargaReseller-oncallprice',
                '#d-hargaPricelist-oncallprice',
                '#d-oncall-price-brand-code',
                '#d-oncall-price-product-division-code',
                '#d-oncall-price-uom-code',
                '#d-oncall-category-code',
            ];

            for (const selector of fields) {
                const el = document.querySelector(selector);
                if (!el || el.value.trim() === "" || el.value === null) {
                    isValid = false;
                    break;
                }
            }

            document.getElementById("btn-save-oncall").disabled = !isValid;
        }

        // Daftar input biasa
        $('#d-hargaEndUser-oncallprice, #d-marginEndUser-oncallprice, #d-marginKontraktor-oncallprice, #d-marginReseller-oncallprice, #d-marginPricelist-oncallprice, #d-hargaKontraktor-oncallprice, #d-hargaReseller-oncallprice, #d-hargaPricelist-oncallprice')
            .on('input', validateFields);

// Daftar Select2
        $('#d-oncall-price-brand-code, #d-oncall-price-product-division-code, #d-oncall-price-uom-code, #d-oncall-category-code')
            .on('select2:select select2:unselect', validateFields);

// Jalankan validasi awal
        validateFields();
    });

	function cancel_inquiry(id) {
		Swal.fire({
			title: 'Hold Up! Butuh Alasan Nih! ⚠️',
			text: 'Atasan bakal cek alasan kamu sebelum batalin permintaan ini.',
			icon: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#005CE8',
			cancelButtonColor: '#93a1af',
			confirmButtonText: 'Lanjutkan',
			cancelButtonText: 'Kembali'
		}).then((result) => {
			if (result.isConfirmed) {
				Swal.fire({
					title: 'Alasan Card Dibatalkan',
					input: 'textarea',
					inputPlaceholder: 'Masukkan alasan kamu...',
					inputAttributes: {
						'aria-label': 'Masukkan alasan kamu'
					},
					showCancelButton: true,
					confirmButtonText: 'Kirim',
					cancelButtonText: 'Batal',
					inputValidator: (value) => {
						if (!value) {
							return 'Alasan wajib diisi!';
						}
					}
				}).then((result2) => {
					if (result2.isConfirmed) {
						let alasan = result2.value;

						$.ajax({
							headers: {
								'X-CSRF-TOKEN': '{{ csrf_token() }}'
							},
							url: `/admin/inquiry/cancel_stage`,
							method: 'POST',
							data: {
								id: id,
								alasan: alasan
							},
							dataType: 'json',
							success: function(response) {
								if (response.status == 200) {
									Swal.fire({
										icon: 'success',
										title: 'Request Canceled! 👍',
										text: 'Atasan bakal review alasan kamu.',
									}).then(function() {
										location.reload();
									});

								} else {
									Swal.fire('Gagal!', response.data, 'error');
								}
							},
							error: function(error) {
								console.log(error)
							}
						});
					}
				});
			}
		});
	}

	function show_edit_inquiry() {
		let id = $('#d-inquiry-id').val();

		if (id) {
			window.location.href = '/admin/inquiry_supply_only/edit/' + id;
		} else {
			Swal.fire({
				icon: 'warning',
				title: 'Warning!',
				text: 'Data tidak ditemukan!',
			})
		}
	}

	function rejectInquiry(inquiry_code, master_approvals_details_id) {
		$("#viewmodal").modal("hide");
		Swal.fire({
			icon: 'warning',
			title: 'Reject? Yakin 100%?',
			text: 'Cek lagi deh! Pastikan semuanya sudah bener sebelum kamu reject!',
			showCancelButton: true,
			confirmButtonColor: '#005CE8',
			cancelButtonColor: '#93a1af',
			confirmButtonText: 'Lanjut',
			cancelButtonText: 'Kembali'
		}).then((result) => {
			if (result.isConfirmed) {
				Swal.fire({
					title: 'Alasan Reject',
					input: 'textarea',
					inputPlaceholder: 'Masukkan alasan kamu...',
					inputAttributes: {
						'aria-label': 'Masukkan alasan kamu'
					},
					showCancelButton: true,
					confirmButtonText: 'Kirim',
					cancelButtonText: 'Batal',
					inputValidator: (value) => {
						if (!value) {
							return 'Alasan wajib diisi!';
						}
					}
				}).then((result2) => {
					if (result2.isConfirmed) {
						let alasan = result2.value;

						$.ajax({
							headers: {
								'X-CSRF-TOKEN': '{{ csrf_token() }}'
							},
							url: `/admin/inquiry/reject`,
							method: 'POST',
							data: {
								inquiry_code: inquiry_code,
								alasan: alasan,
								master_approvals_details_id: master_approvals_details_id
							},
							dataType: 'json',
							success: function(response) {
								if (response.status == 200) {
									Swal.fire({
										icon: 'success',
										title: 'Berhasil!',
										text: 'Berhasil!',
									}).then(function() {
										location.reload();
									});

								} else {
									Swal.fire('Gagal!', response.data, 'error');
								}
							},
							error: function(error) {
								console.log(error)
							}
						});
					}
				});
			}
		});
	}

	function approveInquiry(inquiry_code, master_approvals_details_id) {
		Swal.fire({
			icon: 'info',
			title: 'Yakin Approve? Gas atau Tahan? 🚀',
			text: 'Pastikan semua sudah sesuai sebelum kamu approve!',
			showCancelButton: true,
			confirmButtonColor: '#005CE8',
			cancelButtonColor: '#93a1af',
			confirmButtonText: 'Lanjut',
			cancelButtonText: 'Kembali'
		}).then((result) => {
			if (result.isConfirmed) {
				$.ajax({
					headers: {
						'X-CSRF-TOKEN': '{{ csrf_token() }}'
					},
					url: `/admin/inquiry/approve`,
					method: 'POST',
					data: {
						inquiry_code: inquiry_code,
						master_approvals_details_id: master_approvals_details_id
					},
					dataType: 'json',
					success: function(response) {
						if (response.status == 200) {
							Swal.fire({
								icon: 'success',
								title: 'Berhasil!',
								text: 'Berhasil!',
							}).then(function() {
								location.reload();
							});
						} else {
							Swal.fire('Gagal!', response.data, 'error');
						}
					},
					error: function(error) {
						console.log(error)
					}
				});
			}
		});
	}

	function showwarningbacktosales() {
		$('#viewbacktosales_oncallpress').modal('show');
	}

	function showwarningforwardapprove() {
		$('#viewapprove_oncallpress').modal('show');
	}

	function showreject_waiting_oncallprice() {
		$('#viewreject_waiting_oncallprice').modal('show');
	}

	function showmodal_insert_message_reject() {
		$('#viewmessage_reject_oncalprice').modal('show');
	}

	function showapprove_waiting_approval() {
		$('#viewapprove_waiting_oncallprice').modal('show');
	}

	function add_callpress_item(id){
        // console.log('id', id);
		$('#d-inquiry-oncallprace-aktive').val(id);
        $('#viewadddetailitem_oncallpress').modal('show');
        document.getElementById("btn-save-oncall").disabled = true;

        $('#d-hargaPokok-oncallprice').val('');
        $('#d-marginEndUser-oncallprice').val('');
        $('#d-marginKontraktor-oncallprice').val('');
        $('#d-marginReseller-oncallprice').val('');
        $('#d-marginPricelist-oncallprice').val('');
        $('#d-hargaEndUser-oncallprice').val('');
        $('#d-hargaKontraktor-oncallprice').val('');
        $('#d-hargaReseller-oncallprice').val('');
        $('#d-hargaPricelist-oncallprice').val('');

        $('#d-oncall-price-brand-code').append(new Option('', '', true, true)).trigger('change');
        $('#d-oncall-price-product-division-code').append(new Option('', '', true, true)).trigger('change');
        $('#d-oncall-price-uom-code').append(new Option('', '', true, true)).trigger('change');
        $('#d-oncall-category-code').append(new Option('', '', true, true)).trigger('change');

        $.ajax({
            url: '/admin/inquiry/detail_goods_oncall_price/' + id,
            dataType: 'json',
            success: function(response) {
                console.log(response.length);

                $('#d-hargaPokok-oncallprice').val(response.goods_price);
                $('#d-marginEndUser-oncallprice').val(response.goods_end_user_margin);
                $('#d-marginKontraktor-oncallprice').val(response.goods_contractor_margin);
                $('#d-marginReseller-oncallprice').val(response.goods_reseller_margin);
                $('#d-marginPricelist-oncallprice').val(response.goods_pricelist_margon);
                $('#d-hargaEndUser-oncallprice').val(response.goods_end_user_price);
                $('#d-hargaKontraktor-oncallprice').val(response.goods_contractor_price);
                $('#d-hargaReseller-oncallprice').val(response.goods_reseller_price);
                $('#d-hargaPricelist-oncallprice').val(response.goods_pricelist_price);

                $('#d-oncall-price-brand-code').append(new Option(response.brand_name, response.brand_code, true, true)).trigger('change');
                $('#d-oncall-price-product-division-code').append(new Option(response.product_divisions_name, response.product_division_code, true, true)).trigger('change');
                $('#d-oncall-price-uom-code').append(new Option(response.uom_name, response.uom_code, true, true)).trigger('change');
                $('#d-oncall-category-code').append(new Option(response.product_category_name, response.product_category_code, true, true)).trigger('change');

            }
        });

    }

    function approve_waiting_oncallpress() {
        let master_approvals_details_id = $('#d-inquiry-waiting-oncallprice-approvals-id').val();
        let inquiry_code = $('#d-inquiry-waiting-oncallprice-code').val();

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            url: `/admin/inquiry/approve_waiting_oncallprice`,
            method: 'POST',
            data: {
                inquiry_code: inquiry_code,
                master_approvals_details_id: master_approvals_details_id
            },
            dataType: 'json',
            success: function(response) {
                if (response.status == 200) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil!',
                        text: 'Berhasil!',
                    }).then(function() {
                        location.reload();
                    });
                } else {
                    Swal.fire('Gagal!', response.data, 'error');
                }
            },
            error: function(error) {
                console.log(error)
            }
        });
    }

    function rejectInquiry_waiting_oncallprice() {
        let master_approvals_details_id = $('#d-inquiry-waiting-oncallprice-approvals-id').val();
        let inquiry_code = $('#d-inquiry-waiting-oncallprice-code').val();
        let alasan = $('#d-message-reject-oncallprice').val();

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            url: `/admin/inquiry/reject_waiting_oncall_price`,
            method: 'POST',
            data: {
                inquiry_code: inquiry_code,
                alasan: alasan,
                master_approvals_details_id: master_approvals_details_id
            },
            dataType: 'json',
            success: function(response) {
                if (response.status == 200) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil!',
                        text: 'Berhasil!',
                    }).then(function() {
                        location.reload();
                    });

                } else {
                    Swal.fire('Gagal!', response.data, 'error');
                }
            },
            error: function(error) {
                console.log(error)
            }
        });
    }

</script>

@endsection
