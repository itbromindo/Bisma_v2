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
                    <div class="button-filter">
                      <button type="button" class="btn btn-primary2 btn-icon">
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

            <!-- kanban start-->
            <div class="row">
                <div class="col-12">
                    <div id="board" class="board">

                        <div class="d-flex kanbanboard_parent" id="kanban_board_parent">
                            @if ($usr->can('inquiry.kanban1'))
                                <div class="kanbanboard_child">
                                    <x-inquiry.kanban1-component />
                                </div>
                            @endif
                            @if ($usr->can('inquiry.kanban2'))
                                <div class="kanbanboard_child">
                                    <x-inquiry.kanban2-component />
                                </div>
                            @endif
                            @if ($usr->can('inquiry.kanban3'))
                                <div class="kanbanboard_child">
                                    <x-inquiry.kanban3-component />
                                </div>
                            @endif
                            @if ($usr->can('inquiry.kanban4'))
                                <div class="kanbanboard_child">
                                    <x-inquiry.kanban4-component />
                                </div>
                            @endif
                            @if ($usr->can('inquiry.kanban5'))
                                <div class="kanbanboard_child">
                                    <x-inquiry.kanban5-component />
                                </div>
                            @endif
                            @if ($usr->can('inquiry.kanban6'))
                                <div class="kanbanboard_child">
                                    <x-inquiry.kanban6-component />
                                </div>
                            @endif
                            @if ($usr->can('inquiry.kanban7'))
                                <div class="kanbanboard_child">
                                    <x-inquiry.kanban7-component />
                                </div>
                            @endif
                            @if ($usr->can('inquiry.kanban8'))
                                <div class="kanbanboard_child">
                                    <x-inquiry.kanban8-component />
                                </div>
                            @endif
                            @if ($usr->can('inquiry.kanban9'))
                                <div class="kanbanboard_child">
                                    <x-inquiry.kanban9-component />
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
                                <p class="m-0" style="font-size: 14px;"><span>2</span> Produk</p>
                              </div>
                              <div class="col-lg-6 text-end d-flex align-items-center justify-content-end">
                                <button class="btn btn-primary">
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
                                    <td>: <span>Gudang Jakarta</span></td>
                                  </tr>
                                  <tr>
                                    <td>User</td>
                                    <td>: <span>End User</span></td>
                                  </tr>
                                </table>
                              </div>
                              <div class="col-lg-6">
                                <table class="table-inquiry-detail">
                                  <tr>
                                    <td style="width: 6rem;">OC</td>
                                    <td>: <span>0</span></td>
                                  </tr>
                                  <tr>
                                    <td>Ongkir</td>
                                    <td>: <span>50.000.000</span></td>
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
                                <p style="font-weight: 700; font-size: 16px; margin: 0;">Harga Total : <span style="font-size: 16px; font-weight: 400;">Rp 148.037.000.00</span><span class="text-success"> (Harga Valid)</span></p>
                                <p style="font-size: 12px; font-weight: 500; margin: 0;">*Termasuk PPN 11% dan Ongkir</p>
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

</style>
<script>
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
</script>

@endsection
