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
          <button class="plain-btn rt-mr-8">
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
          <button class="plain-btn rt-mr-8">
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
              <div class="project-idea-header">
                <h3>
                  Mission Possible: 4 Jam Menuju Keputusan!
                </h3>
                <p>Mau lanjut ke Quote atau No Quote? Waktu terus berjalan…</p>
              </div>
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
                      <td><div class="d-inquiry-product"><ul class="d-flex">
                      <li class="me-2">
                        <span class="badge rounded-pill bg-warning-50 text-warning-500">SS</span>
                      </li>
                    </ul></div></td>
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
      gap: 8px; /* Spacing between icon and text */
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
      background-color: #323C55;
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
      width: 20px; /* Adjust size */
      height: 20px;
      cursor: pointer;
    }

    .custom-hr {
      border: none;
      height: 2px !important; /* Adjust thickness */
      background-color: #E5E7E8; /* Change color if needed */
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
    #inquiry-9 .cancel-inquiry
    {
      display: none;
    }

    .kanban-section {
      height: 80vh;
      overflow: auto;
    }

</style>
<script>
  $(document).ready(function () {
    $('#listpermintaanmodal').on('shown.bs.modal', function () {
      setTimeout(function () {
          $('#viewmodal').css('z-index', '-1');
      }, 100);
    });
    $('#listpermintaanmodal').on('hidden.bs.modal', function () {
      setTimeout(function () {
          $('#viewmodal').css('z-index', '');
      }, 100);
    });

    function cancel_inquiry(id) {
      Swal.fire({
          title: 'Are you sure?',
          text: 'You will not be able to revert this!',
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Yes, cancel it!'
      }).then((result) => {
          if (result.isConfirmed) {
              $.ajax({
                  url: `/admin/inquiry/cancel_stage/${id}`,
                  type: 'GET',
                  dataType: 'JSON',
                  success: function (response) {
                      if(response.status == 200) {
                          Swal.fire({
                              icon: 'success',
                              title: 'Success!',
                              text: response.data,
                          }).then(function () {
                              location.reload();
                          });

                      }else{
                          Swal.fire({
                              icon: 'error',
                              title: 'Failed!',
                              text: response.data,
                          }).then(function () {
                              location.reload();
                          })
                      }
                  }
              });
          }
      });
    }

    $('#btn-filter-inquiry').click(function() {
      $('#filtermodal').modal('show');
    })

    const thousandView = (number = 0) => {
      return number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
    }

    $('#btn-detail-permintaan').click(function() {
      let inquiryId = $('#d-inquiry-id').val();
      $.ajax({
        url: '/admin/inquiry/detail/'+inquiryId,
        dataType: 'json',
        success: function(response) {
          if(response.status == 200) {
            $("#listpermintaanmodal").modal("toggle");
            let inquiry = response.data.inquiry;
            $('.keterangan-detail-permintaan').html(inquiry.inquiry_notes);
            let list_permintaan = response.data.list_permintaan;
            $('#tableListPermintaan').empty();
            let totalProdukPermintaan = 0;
            let totalHargaPermintaan = 0;
            if(list_permintaan.length > 0) {
              list_permintaan.forEach(function (data, index) {
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
            }else{
              $('#tableListPermintaan').append('<tr><td colspan="10" class="text-center">No results found</td></tr>');
            }
          }else{
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
  });
</script>

@endsection
