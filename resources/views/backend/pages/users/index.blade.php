
@extends('backend.layouts.master')

@section('title')
Users - Admin Panel
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
                    <div class="breadcrumbs ">
                        <div class="breadcrumb-title"> Account Setting</div>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href='/admin'>Home</a></li>
                                <li class="breadcrumb-item"><a href='/admin'>Setting</a></li>
                                <li class="breadcrumb-item active" aria-current="page"> User</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xxl-12 col-xl-12 col-md-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5>Setting User</h5>
                            <div class="d-flex align-items-center">
                                <div class="app-main-search me-2">
                                    <form action="/admin/users" method="GET" class="d-flex">
                                        <div class="input-box d-flex">
                                            <input type="text" name="search" id="search" value="{{$search ?? ''}}" class="form-control" placeholder="Search Here">
                                            <button type="submit" class="btn btn-light ms-2">
                                                <img src="{{ asset('backend/assets/images/svg/search.svg')}}" alt="Search" draggable="false">
                                            </button>
                                        </div>
                                    </form>
                                </div>
                                @if ($usr->can('users.create'))
                                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalinput" onclick="clearform()">Tambah Data</button>
                                @endif
                            </div>
                        </div>

                        <div class="card-body">
                            <section class="tables">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="table-wrapper">
                                            <div class="table-content table-responsive">
                                                <table class="table align-middle table-basic ">
                                                    <thead style="text-align: center">
                                                        <tr>
                                                            <th scope="col" width="5%">NO</th>
                                                            <th scope="col">CODE</th>
                                                            <th scope="col">NAME</th>
                                                            <th scope="col">E-MAIL</th>
                                                            <th scope="col">PHONE</th>
                                                            <th scope="col">Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="tableBody">
                                                        @foreach ($users as $user)
                                                            <tr>
                                                                <td scope="row" class="text-center">{{ $loop->index+1 }}</td>
                                                                <td>{{ Str::words($user->user_code, 10, '...') }}</td>
                                                                <td>{{ Str::words($user->users_name, 10, '...') }}</td>
                                                                <td>{{ Str::words($user->users_email, 10, '...') }}</td>
                                                                <td>{{ Str::words($user->users_office_phone, 10,'...') }}</td>
                                                                <td class="text-center">
                                                                    <div class="d-flex justify-content-center gap-2">
                                                                        <!-- Tombol Delete -->
                                                                        @if ($usr->can('users.delete'))
                                                                        <button class="btn btn-light btn-sm border border-danger text-danger" title="Delete" onclick="delete_data('{{ $user->user_id }}')">
                                                                            <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                                <path d="M12.5 3.5L3.5 12.5" stroke="red" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round" />
                                                                                <path d="M12.5 12.5L3.5 3.5" stroke="red" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round" />
                                                                            </svg>
                                                                        </button>
                                                                        @endif
                                                                        <!-- Tombol Edit -->
                                                                        <button class="btn btn-light btn-sm border border-success text-success" title="Edit" onclick="showedit('{{ $user->user_id }}')">
                                                                            <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                                <path d="M12.1464 1.85355C12.3417 1.65829 12.6583 1.65829 12.8536 1.85355L14.1464 3.14645C14.3417 3.34171 14.3417 3.65829 14.1464 3.85355L5.35355 12.6464L2.5 13.5L3.35355 10.6464L12.1464 1.85355Z" stroke="green" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round" />
                                                                                <path d="M11.5 2.5L13.5 4.5" stroke="green" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round" />
                                                                            </svg>
                                                                        </button>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Pagination -->
                                <div class="row">
                                    <div class="col-lg-12">
                                        <nav aria-label="Page navigation">
                                            <ul class="pagination justify-content-end" id="pagination">
                                                <!-- Previous Page Link -->
                                                <li class="page-item {{ $users->onFirstPage() ? 'disabled' : '' }}">
                                                    <a class="page-link" href="{{ $users->appends(['search' => $search ?? request('search')])->previousPageUrl() }}" aria-label="Previous">
                                                        <i class="ph-arrow-left"></i>
                                                    </a>
                                                </li>

                                                <!-- Page Number Links -->
                                                @foreach ($users->onEachSide(0)->appends(['search' => $search ?? request('search')])->links()->elements[0] as $page => $url)
                                                    <li class="page-item {{ $users->currentPage() == $page ? 'active' : '' }}">
                                                        <a class="page-link" href="{{ $url }}">{{ sprintf('%02d', $page) }}</a>
                                                    </li>
                                                @endforeach

                                                <!-- Next Page Link -->
                                                <li class="page-item {{ $users->hasMorePages() ? '' : 'disabled' }}">
                                                    <a class="page-link" href="{{ $users->appends(['search' => $search ?? request('search')])->nextPageUrl() }}" aria-label="Next">
                                                        <i class="ph-arrow-right"></i>
                                                    </a>
                                                </li>
                                            </ul>
                                        </nav>
                                    </div>
                                </div>
                            </section>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modalinput" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 85%;">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tittleform">Form Input</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="profile-wrap">
                <div class="profile-left">
                    <div class="profile-thumb">
                        <img src="{{ asset('backend/assets/images/all-img/users/user1.png')}}" alt="" id="photouser_profile" />
                    </div>
                    <div class="profile-data">
                        <h4 id="namauser_profile">-</h4>
                        <p id="emailuser_profile">-</p>
                    </div>
                </div>
            </div>
            <div class="modal-body">

                <form>
                    <input type="hidden" id="user_id">
                    <div id="alert-container"></div> <!-- Tempat Alert -->
                    <div class="row">
                        <div class="col-mb-3 col-lg-3">
                            <div class="fromGroup mb-3">
                                <label>Nama</label>
                                <input class="form-control" type="text" id="users_name" placeholder="Nama Karyawan" />
                            </div>
                        </div>
                        <div class="col-mb-3 col-lg-3">
                            <div class="fromGroup mb-3">
                                <label>Foto</label>
                                <input class="form-control" type="file" id="users_photo" placeholder="Foto File" />
                            </div>
                        </div>
                        <div class="col-mb-3 col-lg-3">
                            <div class="fromGroup mb-3">
                                <label>Email</label>
                                <input class="form-control" type="email" id="users_email" placeholder="mail@mail.com" />
                            </div>
                        </div>
                        <div class="col-mb-3 col-lg-3">
                            <label>Password</label>
                            <div class="fromGroup eye">
                                <div class="form-control-icon">
                                    <input id="password-hide_show" class="form-control" type="password" placeholder="password">
                                    <div class="has-badge">
                                        <i class="ph-eye"></i>
                                    </div>
                                </div>
                            </div>
                            {{-- <div class="fromGroup eye mb-3">
                                <div class="form-control-icon">
                                    <input class="form-control" type="password" id="users_password" placeholder="password" />
                                    <div class="has-badge select-icon__three">
                                        <i class="ph-eye"></i>
                                    </div>
                                </div>
                            </div> --}}
                        </div>
                        <div class="col-mb-3 col-lg-3">
                            <div class="fromGroup mb-3">
                                <label>No Hp Kantor</label>
                                <input class="form-control" type="text" id="users_office_phone" placeholder="no Hp" />
                            </div>
                        </div>
                        <div class="col-mb-3 col-lg-3">
                            <div class="fromGroup mb-3">
                                <label>No Hp Keluarga</label>
                                <input class="form-control" type="text" id="users_personal_phone" placeholder="No Hp" />
                            </div>
                        </div>
                        <div class="col-mb-3 col-lg-3">
                            <div class="fromGroup mb-3">
                                <label>Tanggal Bergabung</label>
                                <input class="form-control date-picker-calender hasDatepicker" type="date" id="users_join_date" placeholder="" />
                            </div>
                        </div>
                        <div class="col-mb-3 col-lg-3">
                            <div class="fromGroup mb-3">
                                <label>Company</label>
                                <select class="form-control" id="users_company" style="width: 100%;">
                                    <option value="" disabled selected>Pilih Company</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-mb-3 col-lg-3">
                            <div class="fromGroup mb-3">
                                <label>Divisi</label>
                                <select class="form-control" id="users_division" style="width: 100%;">
                                    <option value="" disabled selected>Pilih Divisi</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-mb-3 col-lg-3">
                            <div class="fromGroup mb-3">
                                <label>Department</label>
                                <select class="form-control" id="users_department" style="width: 100%;">
                                    <option value="" disabled selected>Pilih Department</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-mb-3 col-lg-3">
                            <div class="fromGroup mb-3">
                                <label>Level</label>
                                <select class="form-control" id="users_level" style="width: 100%;">
                                    <option value="" disabled selected>Pilih Level</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-mb-3 col-lg-3">
                            <div class="fromGroup mb-3">
                                <label>Homebase</label>
                                <select class="form-control" id="users_homebase" style="width: 100%;">
                                    <option value="" disabled selected>Pilih Homebase</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-mb-3 col-lg-3">
                            <div class="fromGroup mb-3">
                                <label>Shift</label>
                                <select class="form-control" id="users_shift" style="width: 100%;">
                                    <option value="" disabled selected>Pilih Shift</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-mb-3 col-lg-3">
                            <div class="fromGroup mb-3">
                                <label>Status Karyawan</label>
                                <div class="select-box">
                                    <select class="custom-select sources" id="users_employee_status" title="Status">
                                        <option value="kontrak1">kontrak1</option>
                                        <option value="kontrak2">kontrak2</option>
                                        <option value="probation">probation</option>
                                        <option value="HSE">HSE</option>
                                        <option value="Tetap">Tetap</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-mb-3 col-lg-3">
                            <div class="fromGroup mb-3">
                                <label>Tanggal Penetapan Status</label>
                                <input class="form-control" type="date" id="users_join_date_employee_status" placeholder="" />
                            </div>
                        </div>
                        <div class="col-mb-3 col-lg-3">
                            <div class="fromGroup mb-3">
                                <label>Periode Kontrak</label>
                                <input class="form-control" type="text" id="users_contract_period" placeholder="Bulan" />
                            </div>
                        </div>
                        <div class="col-mb-3 col-lg-3">
                            <div class="fromGroup mb-3">
                                <label>Keterangan</label>
                                <textarea class="form-control" name="users_notes" id="users_notes" placeholder="Alamat"></textarea>
                            </div>
                        </div>
                        <div class="col-mb-3 col-lg-3">
                            <div class="fromGroup mb-3">
                                <label>Jenis Kelamin</label>
                                <div class="select-box">
                                    <select class="custom-select sources" id="users_gender" title="Jenis Kelamin">
                                        <option value="laki-laki">laki-laki</option>
                                        <option value="perempuan">perempuan</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-mb-3 col-lg-3">
                            <div class="fromGroup mb-3">
                                <label>Tempat, Tanggal Lahir</label>
                                <input class="form-control" type="text" id="users_place_date_of_birth" placeholder="TTL" />
                            </div>
                        </div>
                        <div class="col-mb-3 col-lg-3">
                            <div class="fromGroup mb-3">
                                <label>Pendidikan</label>
                                <input class="form-control" type="text" id="users_education" placeholder="Pendidikan" />
                            </div>
                        </div>
                        <div class="col-mb-3 col-lg-3">
                            <div class="fromGroup mb-3">
                                <label>Agama</label>
                                <div class="select-box">
                                    <select class="custom-select sources" id="users_religion" title="Agama">
                                        <option value="Islam">Islam</option>
                                        <option value="Kristen">Kristen</option>
                                        <option value="Khatolik">Khatolik</option>
                                        <option value="Hindu">Hindu</option>
                                        <option value="Budha">Budha</option>
                                        <option value="Konghucu">Konghucu</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-mb-3 col-lg-3">
                            <div class="fromGroup mb-3">
                                <label>Status Keluarga</label>
                                <input class="form-control" type="text" id="users_family_status" placeholder="Status Keluarga" />
                            </div>
                        </div>
                        <div class="col-mb-3 col-lg-3">
                            <div class="fromGroup mb-3">
                                <label>Alamat Domisili</label>
                                <textarea class="form-control" name="users_address_of_domicile" id="users_address_of_domicile" placeholder="Alamat"></textarea>
                            </div>
                        </div>
                        <div class="col-mb-3 col-lg-3">
                            <div class="fromGroup mb-3">
                                <label>Alamat KTP</label>
                                <textarea class="form-control" name="users_address_of_id" id="users_address_of_id" placeholder="Alamat"></textarea>
                            </div>
                        </div>
                        <div class="col-mb-3 col-lg-3">
                            <div class="fromGroup mb-3">
                                <label>Nomor KK</label>
                                <input class="form-control" type="text" id="users_family_card" placeholder="KK" />
                            </div>
                        </div>
                        <div class="col-mb-3 col-lg-3">
                            <div class="fromGroup mb-3">
                                <label>Akun FB</label>
                                <input class="form-control" type="text" id="users_fb" placeholder="FB" />
                            </div>
                        </div>
                        <div class="col-mb-3 col-lg-3">
                            <div class="fromGroup mb-3">
                                <label>Akun Instagram</label>
                                <input class="form-control" type="text" id="users_ig" placeholder="IG" />
                            </div>
                        </div>
                        <div class="col-mb-3 col-lg-3">
                            <div class="fromGroup mb-3">
                                <label>No BPJS TK</label>
                                <input class="form-control" type="text" id="users_bpjs_tk_number" placeholder="BPJS Ketenagakerjaan" />
                            </div>
                        </div>
                        <div class="col-mb-3 col-lg-3">
                            <div class="fromGroup mb-3">
                                <label>No BPJS Kesehatan</label>
                                <input class="form-control" type="text" id="users_bpjs_number" placeholder="BPJS Kesehatan" />
                            </div>
                        </div>
                        <div class="col-mb-3 col-lg-3">
                            <div class="fromGroup mb-3">
                                <label>No KTP</label>
                                <input class="form-control" type="text" id="users_ktp_number" placeholder="KTP" />
                            </div>
                        </div>
                        <div class="col-mb-3 col-lg-3">
                            <div class="fromGroup mb-3">
                                <label>Scan KTP</label>
                                <input class="form-control" type="file" id="users_ktp_picture" placeholder="file" />
                            </div>
                        </div>
                        <div class="col-mb-3 col-lg-3">
                            <div class="fromGroup mb-3">
                                <label>Scan TTD</label>
                                <input class="form-control" type="file" id="users_signature" placeholder="file" />
                            </div>
                        </div>
                        <div class="col-mb-3 col-lg-3">
                            <div class="fromGroup mb-3">
                                <label>Role</label>
                                <select class="form-control" id="users_permission" style="width: 100%;">
                                    <option value="" disabled selected>Pilih Role</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                @if ($usr->can('users.create'))
                <button type="button" class="btn btn-warning" onclick="clearform()">Clear Data</button>
                @endif
                @if ($usr->can('users.update') || $usr->can('users.create'))
                <button type="button" class="btn btn-primary" id="saveclick" onclick="save()">Save</button>
                @endif
            </div>
        </div>
    </div>
</div>

<script>

    $(document).ready(function() {     
        $('#modalinput').on('shown.bs.modal', function () {
            // Inisialisasi Select2
            $('#users_level, #users_company, #users_homebase, #users_division, #users_department, #users_shift, #users_permission').select2({
                dropdownParent: $('#modalinput'),
                placeholder: "Pilih Data",
                allowClear: true,
                ajax: {
                    url: function () {
                        // Tentukan URL berdasarkan ID elemen
                        if ($(this).attr('id') === 'users_level') return '/admin/combolevels';
                        if ($(this).attr('id') === 'users_company') return '/admin/combocompanies';
                        if ($(this).attr('id') === 'users_homebase') return '/admin/combohomebases';
                        if ($(this).attr('id') === 'users_division') return '/admin/combodivisions';
                        if ($(this).attr('id') === 'users_department') return '/admin/combodepartments';
                        if ($(this).attr('id') === 'users_shift') return '/admin/comboshifts';
                        if ($(this).attr('id') === 'users_permission') return '/admin/comboroles';
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

        $('#modalinput').on('select2:open', function (e) {
            // Fokus pada kolom pencarian Select2 yang baru dibuka
            setTimeout(function() {
                document.querySelector('.select2-search__field').focus();
            }, 1);
        });

        $('#search').on('keyup', function () {
            let searchQuery = $(this).val();
            fetchSubmenus(searchQuery, 1); // Panggil fungsi dengan searchQuery dan halaman pertama
        });

        $(document).on('click', '.page-link', function (e) {
            e.preventDefault(); // Mencegah reload halaman
            let pageUrl = $(this).attr('href'); // Ambil URL dari elemen yang diklik
            let page = new URLSearchParams(pageUrl.split('?')[1]).get('page'); // Ambil nomor halaman dari URL
            let searchQuery = $('#search').val(); // Ambil nilai pencarian saat ini

            if (page) {
                fetchSubmenus(searchQuery, page); // Panggil fungsi dengan nomor halaman
            }
        });
        
    });

    function fetchSubmenus(searchQuery, page) {
        $.ajax({
            url: '/admin/users',
            type: 'GET',
            data: { 
                search: searchQuery,
                page: page
            },
            success: function (response) {
                // Update table body
                $('#tableBody').html('');
                if (response.users.data.length > 0) {
                    response.users.data.forEach(function (user, index) {
                        $('#tableBody').append(`
                            <tr>
                                <td class="text-center">${(response.users.current_page - 1) * response.users.per_page + index + 1}</td>
                                <td>${truncateText(user.user_code, 10, '...')}</td>
                                <td>${truncateText(user.users_name, 10, '...')}</td>
                                <td>${truncateText(user.users_email, 10, '...')}</td>
                                <td>${truncateText(user.users_office_phone, 10, '...')}</td>
                                <td class="text-center">
                                    <div class="d-flex justify-content-center gap-2">
                                        <!-- Tombol Delete -->
                                        @if ($usr->can('users.delete'))
                                        <button class="btn btn-light btn-sm border border-danger text-danger" title="Delete" onclick="delete_data('${user.user_id}')">
                                            <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M12.5 3.5L3.5 12.5" stroke="red" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round" />
                                                <path d="M12.5 12.5L3.5 3.5" stroke="red" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round" />
                                            </svg>
                                        </button>
                                        @endif
                                        <!-- Tombol Edit -->
                                        <button class="btn btn-light btn-sm border border-success text-success" title="Edit" onclick="showedit('${user.user_id}')">
                                            <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M12.1464 1.85355C12.3417 1.65829 12.6583 1.65829 12.8536 1.85355L14.1464 3.14645C14.3417 3.34171 14.3417 3.65829 14.1464 3.85355L5.35355 12.6464L2.5 13.5L3.35355 10.6464L12.1464 1.85355Z" stroke="green" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round" />
                                                <path d="M11.5 2.5L13.5 4.5" stroke="green" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round" />
                                            </svg>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        `);
                    });
                } else {
                    $('#tableBody').append('<tr><td colspan="5" class="text-center">No results found</td></tr>');
                }

                paginemain(response,'users');
                
            },
            error: function (xhr) {
                alert('Error: ' + xhr.statusText);
            }
        });
    }

    function reload(){
        // setTimeout(function () {
            window.open("/admin/users", "_self");
        // }, 500);
    }

    function save() {
        id = document.getElementById('user_id').value;
        if (id == '') {
            saveInput();
        } else {
            updateInput(id);
        }
    }
    
    function clearform() {
        document.getElementById('user_id').value = '';
        document.getElementById('users_name').value = ''; 
        document.getElementById('users_photo').value = ''; 
        document.getElementById('users_email').value = ''; 
        // document.getElementById('users_password').value = ''; 
        document.getElementById('password-hide_show').value = ''; 
        document.getElementById('users_office_phone').value = ''; 
        document.getElementById('users_personal_phone').value = ''; 
        document.getElementById('users_join_date').value = ''; 
        $('#users_level').append(new Option('', '', true, true)).trigger('change');
        $('#users_company').append(new Option('', '', true, true)).trigger('change');
        $('#users_homebase').append(new Option('', '', true, true)).trigger('change');
        $('#users_division').append(new Option('', '', true, true)).trigger('change');
        $('#users_department').append(new Option('', '', true, true)).trigger('change');
        $('#users_shift').append(new Option('', '', true, true)).trigger('change');
        document.getElementById('users_employee_status').value = ''; 
        document.getElementById('users_join_date_employee_status').value = ''; 
        document.getElementById('users_contract_period').value = ''; 
        document.getElementById('users_notes').value = '';
        document.getElementById('users_gender').value = '';
        document.getElementById('users_place_date_of_birth').value = '';
        document.getElementById('users_education').value = '';
        document.getElementById('users_religion').value = '';
        document.getElementById('users_family_status').value = '';
        document.getElementById('users_address_of_domicile').value = '';
        document.getElementById('users_address_of_id').value = '';
        document.getElementById('users_family_card').value = '';
        document.getElementById('users_fb').value = '';
        document.getElementById('users_ig').value = '';
        document.getElementById('users_bpjs_tk_number').value = '';
        document.getElementById('users_bpjs_number').value = '';
        document.getElementById('users_ktp_number').value = '';
        document.getElementById('users_ktp_picture').value = '';
        document.getElementById('users_signature').value = '';
        $('#users_permission').append(new Option('', '', true, true)).trigger('change');

        document.getElementById('tittleform').innerHTML = 'Form Input';
        document.getElementById('saveclick').innerHTML = 'Save';
    }

    function saveInput() {
        var postdata = new FormData();
        // Tambahkan token CSRF
        postdata.append('_token', document.getElementsByName('_token')[0].defaultValue);
        postdata.append('users_name', document.getElementById('users_name').value); 
        postdata.append('users_photo', document.getElementById('users_photo').files[0]); 
        postdata.append('users_email', document.getElementById('users_email').value); 
        // postdata.append('users_password', document.getElementById('users_password').value); 
        postdata.append('users_password', document.getElementById('password-hide_show').value); 
        postdata.append('users_office_phone', document.getElementById('users_office_phone').value); 
        postdata.append('users_personal_phone', document.getElementById('users_personal_phone').value); 
        postdata.append('users_join_date', document.getElementById('users_join_date').value); 
        postdata.append('users_level', document.getElementById('users_level').value); 
        postdata.append('users_company', document.getElementById('users_company').value); 
        postdata.append('users_homebase', document.getElementById('users_homebase').value); 
        postdata.append('users_division', document.getElementById('users_division').value); 
        postdata.append('users_department', document.getElementById('users_department').value); 
        postdata.append('users_shift', document.getElementById('users_shift').value); 
        postdata.append('users_employee_status', document.getElementById('users_employee_status').value); 
        postdata.append('users_join_date_employee_status', document.getElementById('users_join_date_employee_status').value); 
        postdata.append('users_contract_period', document.getElementById('users_contract_period').value); 
        postdata.append('users_notes', document.getElementById('users_notes').value);
        postdata.append('users_gender', document.getElementById('users_gender').value);
        postdata.append('users_place_date_of_birth', document.getElementById('users_place_date_of_birth').value);
        postdata.append('users_education', document.getElementById('users_education').value);
        postdata.append('users_religion', document.getElementById('users_religion').value);
        postdata.append('users_family_status', document.getElementById('users_family_status').value);
        postdata.append('users_address_of_domicile', document.getElementById('users_address_of_domicile').value);
        postdata.append('users_address_of_id', document.getElementById('users_address_of_id').value);
        postdata.append('users_family_card', document.getElementById('users_family_card').value);
        postdata.append('users_fb', document.getElementById('users_fb').value);
        postdata.append('users_ig', document.getElementById('users_ig').value);
        postdata.append('users_bpjs_tk_number', document.getElementById('users_bpjs_tk_number').value);
        postdata.append('users_bpjs_number', document.getElementById('users_bpjs_number').value);
        postdata.append('users_ktp_number', document.getElementById('users_ktp_number').value);
        postdata.append('users_ktp_picture', document.getElementById('users_ktp_picture').files[0]); 
        postdata.append('users_signature', document.getElementById('users_signature').files[0]); 
        postdata.append('users_permission', document.getElementById('users_permission').value);

        $.ajax({
            type: "POST",
            url: "/admin/users",
            data: (postdata),
            processData: false, // Jangan ubah data
            contentType: false, // Atur tipe konten secara otomatis
            dataType: "json",
            async: false,
            success: function (data) {
                if (data.status == 401) {
                    showAlert('danger', "Form Wajib Diisi");
                    if (data.column == 'users_level' || data.column == 'users_company' || data.column == 'users_homebase' || data.column == 'users_division' || data.column == 'users_department' || data.column == 'users_shift' || data.column == 'users_permission') {
                        alertform('select2',data.column,"Form ini Tidak Boleh Kosong");
                    } else if (data.column == 'users_ktp_picture' || data.column == 'users_signature' || data.column == 'users_photo') {
                        alertform('file',data.column,"Form ini Tidak Boleh Kosong");
                    } else {
                        alertform('text',data.column,"Form ini Tidak Boleh Kosong");
                    }
                    return;
                } else if (data.status == 501) {
                    showAlert('danger', "Form Wajib Diisi");
                    if (data.column == 'users_level' || data.column == 'users_company' || data.column == 'users_homebase' || data.column == 'users_division' || data.column == 'users_department' || data.column == 'users_shift' || data.column == 'users_permission') {
                        alertform('select2',data.column,"Form ini Tidak Boleh Kosong");
                    } else if (data.column == 'users_ktp_picture' || data.column == 'users_signature' || data.column == 'users_photo') {
                        alertform('file',data.column,"Form ini Tidak Boleh Kosong");
                    } else {
                        alertform('text',data.column,"Form ini Tidak Boleh Kosong");
                    }
                    return;
                } else {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: 'Data Saved!',
                    }).then(function() {
                        location.reload();
                    });
                }
            },
            error: function (dataerror) {
                console.log(dataerror);
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: dataerror.responseJSON.message
                });
            }
        });

    }

    function showedit(id){
        $.ajax({
            type: "GET",
            url: "/admin/users/"+id,
            dataType: "json",
            async: false,
            success: function (data) {
                document.getElementById('user_id').value = data.user_id;
                document.getElementById('users_name').value = data.users_name; 
                document.getElementById('namauser_profile').innerHTML = data.users_name;
                document.getElementById('emailuser_profile').innerHTML = data.users_email; 
                document.getElementById('users_email').value = data.users_email;
                // document.getElementById('users_photo').value = data.users_photo; 

                var imgElement = document.getElementById("photouser_profile");

                if (imgElement) {
                    imgElement.src = "../"+data.users_photo;
                }

                document.getElementById('users_office_phone').value = data.users_office_phone; 
                document.getElementById('users_personal_phone').value = data.users_personal_phone; 
                document.getElementById('users_join_date').value = data.users_join_date; 
                
                $('#users_level').append(new Option(data.level_name, data.users_level, true, true)).trigger('change');
                $('#users_company').append(new Option(data.companies_name, data.users_company, true, true)).trigger('change');
                $('#users_homebase').append(new Option(data.homebase_name, data.users_homebase, true, true)).trigger('change');
                $('#users_division').append(new Option(data.division_name, data.users_division, true, true)).trigger('change');
                $('#users_department').append(new Option(data.department_name, data.users_department, true, true)).trigger('change');
                $('#users_shift').append(new Option(data.shift_name, data.users_shift, true, true)).trigger('change');

                document.getElementById('users_employee_status').value = data.users_employee_status; 
                document.getElementById('users_join_date_employee_status').value = data.users_join_date_employee_status; 
                document.getElementById('users_contract_period').value = data.users_contract_period; 
                document.getElementById('users_notes').value = data.users_notes;
                document.getElementById('users_gender').value = data.users_gender;
                document.getElementById('users_place_date_of_birth').value = data.users_place_date_of_birth;
                document.getElementById('users_education').value = data.users_education;
                document.getElementById('users_religion').value = data.users_religion;
                document.getElementById('users_family_status').value = data.users_family_status;
                document.getElementById('users_address_of_domicile').value = data.users_address_of_domicile;
                document.getElementById('users_address_of_id').value = data.users_address_of_id;
                document.getElementById('users_family_card').value = data.users_family_card;
                document.getElementById('users_fb').value = data.users_fb;
                document.getElementById('users_ig').value = data.users_ig;
                document.getElementById('users_bpjs_tk_number').value = data.users_bpjs_tk_number;
                document.getElementById('users_bpjs_number').value = data.users_bpjs_number;
                document.getElementById('users_ktp_number').value = data.users_ktp_number;
                // document.getElementById('users_ktp_picture').value = data.users_ktp_picture;
                // document.getElementById('users_signature').value = data.users_signature;
                $('#users_permission').append(new Option(data.users_permission, data.users_permission, true, true)).trigger('change');
                
                document.getElementById('tittleform').innerHTML = 'Form Detail & Edit';
                document.getElementById('saveclick').innerHTML = 'Save Changes';
                // Tampilkan modal
                $('#modalinput').modal('show')
            },
            error: function (dataerror) {
                console.log(dataerror);
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: dataerror.responseJSON.message
                });
            }
        });
    }

    function updateInput(id) {
        var postdata = new FormData();
        // Tambahkan token CSRF
        postdata.append('_token', document.getElementsByName('_token')[0].defaultValue);
        postdata.append('users_name', document.getElementById('users_name').value); 
        postdata.append('users_photo', document.getElementById('users_photo').files[0]); 
        postdata.append('users_email', document.getElementById('users_email').value); 
        // postdata.append('users_password', document.getElementById('users_password').value); 
        postdata.append('users_password', document.getElementById('password-hide_show').value); 
        postdata.append('users_office_phone', document.getElementById('users_office_phone').value); 
        postdata.append('users_personal_phone', document.getElementById('users_personal_phone').value); 
        postdata.append('users_join_date', document.getElementById('users_join_date').value); 
        postdata.append('users_level', document.getElementById('users_level').value); 
        postdata.append('users_company', document.getElementById('users_company').value); 
        postdata.append('users_homebase', document.getElementById('users_homebase').value); 
        postdata.append('users_division', document.getElementById('users_division').value); 
        postdata.append('users_department', document.getElementById('users_department').value); 
        postdata.append('users_shift', document.getElementById('users_shift').value); 
        postdata.append('users_employee_status', document.getElementById('users_employee_status').value); 
        postdata.append('users_join_date_employee_status', document.getElementById('users_join_date_employee_status').value); 
        postdata.append('users_contract_period', document.getElementById('users_contract_period').value); 
        postdata.append('users_notes', document.getElementById('users_notes').value);
        postdata.append('users_gender', document.getElementById('users_gender').value);
        postdata.append('users_place_date_of_birth', document.getElementById('users_place_date_of_birth').value);
        postdata.append('users_education', document.getElementById('users_education').value);
        postdata.append('users_religion', document.getElementById('users_religion').value);
        postdata.append('users_family_status', document.getElementById('users_family_status').value);
        postdata.append('users_address_of_domicile', document.getElementById('users_address_of_domicile').value);
        postdata.append('users_address_of_id', document.getElementById('users_address_of_id').value);
        postdata.append('users_family_card', document.getElementById('users_family_card').value);
        postdata.append('users_fb', document.getElementById('users_fb').value);
        postdata.append('users_ig', document.getElementById('users_ig').value);
        postdata.append('users_bpjs_tk_number', document.getElementById('users_bpjs_tk_number').value);
        postdata.append('users_bpjs_number', document.getElementById('users_bpjs_number').value);
        postdata.append('users_ktp_number', document.getElementById('users_ktp_number').value);
        postdata.append('users_ktp_picture', document.getElementById('users_ktp_picture').files[0]); 
        postdata.append('users_signature', document.getElementById('users_signature').files[0]); 
        postdata.append('users_permission', document.getElementById('users_permission').value);
        // console.log('Data FormData: ', Array.from(postdata.entries()));
        

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            type: "POST",
            url: "/admin/users/"+id,
            data: (postdata),
            processData: false, // Jangan ubah data
            contentType: false, // Atur tipe konten secara otomatis
            dataType: "json",
            async: false,
            success: function (data) {
                if (data.status == 401) {
                    showAlert('danger', "Form Wajib Diisi");
                    if (data.column == 'users_level' || data.column == 'users_company' || data.column == 'users_homebase' || data.column == 'users_division' || data.column == 'users_department' || data.column == 'users_shift' || data.column == 'users_permission') {
                        alertform('select2',data.column,"Form ini Tidak Boleh Kosong");
                    } else if (data.column == 'users_ktp_picture' || data.column == 'users_signature' || data.column == 'users_photo') {
                        alertform('file',data.column,"Form ini Tidak Boleh Kosong");
                    } else {
                        alertform('text',data.column,"Form ini Tidak Boleh Kosong");
                    }
                    return;
                } else if (data.status == 501) {
                    showAlert('danger', "Form Wajib Diisi");
                    if (data.column == 'users_level' || data.column == 'users_company' || data.column == 'users_homebase' || data.column == 'users_division' || data.column == 'users_department' || data.column == 'users_shift' || data.column == 'users_permission') {
                        alertform('select2',data.column,"Form ini Tidak Boleh Kosong");
                    } else if (data.column == 'users_ktp_picture' || data.column == 'users_signature' || data.column == 'users_photo') {
                        alertform('file',data.column,"Form ini Tidak Boleh Kosong");
                    } else {
                        alertform('text',data.column,"Form ini Tidak Boleh Kosong");
                    }
                    return;
                } else {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: 'Data Updated!',
                    }).then(function() {
                        location.reload();
                    });
                }
            },
            error: function (dataerror) {
                console.log(dataerror);
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: dataerror.responseJSON.message
                });
            }
        });

    }

    function delete_data(id){
        var postdata = {};
        postdata._token = document.getElementsByName('_token')[0].defaultValue;
        
        Swal.fire({
            title: 'Are you sure?',
            text: 'You will not be able to revert this!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "DELETE",
                    url: "/admin/users/"+id,
                    data: (postdata),
                    dataType: "json",
                    async: false,
                    success: function (data) {
                        if (data.status == 401) {
                            showAlert('danger', data.data);
                            return;
                        } else if (data.status == 501) {
                            showAlert('danger', data.data);
                            return;
                        } else {
                            Swal.fire({
                                icon: 'success',
                                title: 'Deleted!',
                                text: 'Data has been deleted.',
                            }).then(function() {
                                location.reload();
                            });
                        }
                    },
                    error: function (dataerror) {
                        console.log(dataerror);
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: dataerror.responseJSON.message
                        });
                    }
                });
            }
        });
    }

</script>
@endsection
