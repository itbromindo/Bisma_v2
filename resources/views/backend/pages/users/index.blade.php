
@extends('backend.layouts.master')

@section('title')
Users - Admin Panel
@endsection

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
                <div class="col-xxl-8 col-xl-8 col-md-8">
                    <section class="tables">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="table-wrapper">
                                    <div class="table-content table-responsive">
                                        <table class="table align-middle table-basic ">
                                            <thead style="text-align: center">
                                                <tr>
                                                    <th scope="col">NO</th>
                                                    <th scope="col">NAME</th>
                                                    <th scope="col">E-MAIL</th>
                                                    <th scope="col">PHONE</th>
                                                    <th scope="col">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($users as $user)
                                                    <tr>
                                                        <td scope="row">{{ $loop->index+1 }}</td>
                                                        <td>{{ $user->users_name }}</td>
                                                        <td>{{ $user->users_email }}</td>
                                                        <td>{{ $user->users_office_phone }}</td>
                                                        <td>
                                                            {{-- <a class="btn btn-success text-white" href="#">Edit</a> --}}
                                                            <ul class="action-btn">
                                                                <li>
                                                                    <button onclick="delete_data('{{ $user->user_id }}')">
                                                                        <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                            <path d="M12.5 3.5L3.5 12.5" stroke="currentColor" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round" />
                                                                            <path d="M12.5 12.5L3.5 3.5" stroke="currentColor" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round" />
                                                                        </svg>
                                                                    </button>
                                                                </li>
                                                                <li>
                                                                    <button title="Edit" onclick="showedit('{{ $user->user_id }}')">
                                                                        <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                            <path d="M12.1464 1.85355C12.3417 1.65829 12.6583 1.65829 12.8536 1.85355L14.1464 3.14645C14.3417 3.34171 14.3417 3.65829 14.1464 3.85355L5.35355 12.6464L2.5 13.5L3.35355 10.6464L12.1464 1.85355Z" stroke="currentColor" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round" />
                                                                            <path d="M11.5 2.5L13.5 4.5" stroke="currentColor" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round" />
                                                                        </svg>
                                                                    </button>
                                                                </li>

                                                            </ul>

                                                            {{-- <a class="btn btn-danger text-white" href="#"
                                                            onclick="event.preventDefault(); document.getElementById('delete-form-{{ $user->id }}').submit();">
                                                                Delete
                                                            </a>

                                                            <form id="delete-form-{{ $user->id }}" action="#" method="POST" style="display: none;">
                                                                @method('DELETE')
                                                                @csrf
                                                            </form> --}}
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
                <div class="col-xxl-4 col-xl-4 col-md-4">
                    <div class="card">
                        <div class="card-header">Form Input</div>
                        <div class="card-body">
                            <form>
                                <input type="hidden" id="user_id">
                                <div class="fromGroup mb-3">
                                    <label>Nama</label>
                                    <input class="form-control" type="text" id="users_name" placeholder="Nama Karyawan" />
                                </div>
                                <div class="fromGroup mb-3">
                                    <label>Foto</label>
                                    <input class="form-control" type="file" id="users_photo" placeholder="Foto File" />
                                </div>
                                <div class="fromGroup mb-3">
                                    <label>Email</label>
                                    <input class="form-control" type="email" id="users_email" placeholder="mail@mail.com" />
                                </div>
                                <div class="fromGroup eye mb-3">
                                    <label>Password</label>
                                    <div class="form-control-icon">
                                        <input class="form-control" type="password" id="users_password" placeholder="password" />
                                        <div class="has-badge select-icon__three">
                                            <i class="ph-eye"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="fromGroup mb-3">
                                    <label>No Hp Kantor</label>
                                    <input class="form-control" type="text" id="users_office_phone" placeholder="no Hp" />
                                </div>
                                <div class="fromGroup mb-3">
                                    <label>No Hp Keluarga</label>
                                    <input class="form-control" type="text" id="users_personal_phone" placeholder="No Hp" />
                                </div>
                                <div class="fromGroup mb-3">
                                    <label>Tanggal Bergabung</label>
                                    <input class="form-control date-picker-calender hasDatepicker" type="date" id="users_join_date" placeholder="" />
                                </div>
                                <div class="fromGroup mb-3">
                                    <label>Level</label>
                                    <input class="form-control" type="text" id="users_level" placeholder="Level Jabatan" />
                                </div>
                                <div class="fromGroup mb-3">
                                    <label>Company</label>
                                    <input class="form-control" type="text" id="users_company" placeholder="Company" />
                                </div>
                                <div class="fromGroup mb-3">
                                    <label>Homebase</label>
                                    <input class="form-control" type="text" id="users_homebase" placeholder="Homebase" />
                                </div>
                                <div class="fromGroup mb-3">
                                    <label>Devisi</label>
                                    <input class="form-control" type="text" id="users_division" placeholder="Devisi" />
                                </div>
                                <div class="fromGroup mb-3">
                                    <label>Department</label>
                                    <input class="form-control" type="text" id="users_department" placeholder="Department" />
                                </div>
                                <div class="fromGroup mb-3">
                                    <label>Sift</label>
                                    <input class="form-control" type="text" id="users_shift" placeholder="sift" />
                                </div>
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
                                <div class="fromGroup mb-3">
                                    <label>Tanggal Penetapan Status</label>
                                    <input class="form-control" type="date" id="users_join_date_employee_status" placeholder="" />
                                </div>
                                <div class="fromGroup mb-3">
                                    <label>Periode Kontrak</label>
                                    <input class="form-control" type="text" id="users_contract_period" placeholder="Bulan" />
                                </div>
                                <div class="fromGroup mb-3">
                                    <label>Keterangan</label>
                                    <textarea class="form-control" name="users_notes" id="users_notes" placeholder="Alamat"></textarea>
                                </div>
                                <div class="fromGroup mb-3">
                                    <label>Jenis Kelamin</label>
                                    <div class="select-box">
                                        <select class="custom-select sources" id="users_gender" title="Jenis Kelamin">
                                            <option value="laki-laki">laki-laki</option>
                                            <option value="perempuan">perempuan</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="fromGroup mb-3">
                                    <label>Tempat, Tanggal Lahir</label>
                                    <input class="form-control" type="text" id="users_place_date_of_birth" placeholder="TTL" />
                                </div>
                                <div class="fromGroup mb-3">
                                    <label>Pendidikan</label>
                                    <input class="form-control" type="text" id="users_education" placeholder="Pendidikan" />
                                </div>
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
                                <div class="fromGroup mb-3">
                                    <label>Status Keluarga</label>
                                    <input class="form-control" type="text" id="users_family_status" placeholder="Status Keluarga" />
                                </div>
                                <div class="fromGroup mb-3">
                                    <label>Alamat Domisili</label>
                                    <textarea class="form-control" name="users_address_of_domicile" id="users_address_of_domicile" placeholder="Alamat"></textarea>
                                </div>
                                <div class="fromGroup mb-3">
                                    <label>Alamat KTP</label>
                                    <textarea class="form-control" name="users_address_of_id" id="users_address_of_id" placeholder="Alamat"></textarea>
                                </div>
                                <div class="fromGroup mb-3">
                                    <label>Nomor KK</label>
                                    <input class="form-control" type="text" id="users_family_card" placeholder="KK" />
                                </div>
                                <div class="fromGroup mb-3">
                                    <label>Akun FB</label>
                                    <input class="form-control" type="text" id="users_fb" placeholder="FB" />
                                </div>
                                <div class="fromGroup mb-3">
                                    <label>Akun Instagram</label>
                                    <input class="form-control" type="text" id="users_ig" placeholder="IG" />
                                </div>
                                <div class="fromGroup mb-3">
                                    <label>No BPJS TK</label>
                                    <input class="form-control" type="text" id="users_bpjs_tk_number" placeholder="BPJS Ketenagakerjaan" />
                                </div>
                                <div class="fromGroup mb-3">
                                    <label>No BPJS Kesehatan</label>
                                    <input class="form-control" type="text" id="users_bpjs_number" placeholder="BPJS Kesehatan" />
                                </div>
                                <div class="fromGroup mb-3">
                                    <label>No KTP</label>
                                    <input class="form-control" type="text" id="users_ktp_number" placeholder="KTP" />
                                </div>
                                <div class="fromGroup mb-3">
                                    <label>Scan KTP</label>
                                    <input class="form-control" type="file" id="users_ktp_picture" placeholder="file" />
                                </div>
                                <div class="fromGroup mb-3">
                                    <label>Scan TTD</label>
                                    <input class="form-control" type="file" id="users_signature" placeholder="file" />
                                </div>
                                <div class="row">
                                    <button type="button" class="btn btn-primary pill mt-3" onclick="save()">
                                        Save
                                    </button>
                                    <button type="button" class="btn btn-secondary2 pill btn-icon" onclick="reload()">
                                        <span class="button-content-wrapper">
                                            <span class="button-text">
                                                New Data
                                            </span>
                                            <span class="button-icon">
                                                <i class="ph-arrow-left"></i>
                                            </span>
                                        </span>
                                    </button>
                                    
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- <div class="main-content-inner">
    <div class="row">
        <div class="col-12 mt-5">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title float-left">Users List</h4>
                    <p class="float-right mb-2">
                        <a class="btn btn-primary text-white" href="{{ route('admin.users.create') }}">Create New User</a>
                    </p>
                    <div class="clearfix"></div>
                    <div class="data-tables">
                        @include('backend.layouts.partials.messages')
                        <table id="dataTable" class="text-center">
                            <thead class="bg-light text-capitalize">
                                <tr>
                                    <th width="5%">Sl</th>
                                    <th width="10%">Name</th>
                                    <th width="10%">Email</th>
                                    <th width="40%">Roles</th>
                                    <th width="15%">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                               @foreach ($users as $user)
                               <tr>
                                    <td>{{ $loop->index+1 }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>
                                        @foreach ($user->roles as $role)
                                            <span class="badge badge-info mr-1">
                                                {{ $role->name }}
                                            </span>
                                        @endforeach
                                    </td>
                                    <td>
                                        <a class="btn btn-success text-white" href="#">Edit</a>

                                        <a class="btn btn-danger text-white" href="#"
                                        onclick="event.preventDefault(); document.getElementById('delete-form-{{ $user->id }}').submit();">
                                            Delete
                                        </a>

                                        <form id="delete-form-{{ $user->id }}" action="#" method="POST" style="display: none;">
                                            @method('DELETE')
                                            @csrf
                                        </form>
                                    </td>
                                </tr>
                               @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> -->
<script>

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

    function saveInput() {
        var postdata = new FormData();
        // Tambahkan token CSRF
        postdata.append('_token', document.getElementsByName('_token')[0].defaultValue);
        postdata.append('users_name', document.getElementById('users_name').value); 
        postdata.append('users_photo', document.getElementById('users_photo').value); 
        postdata.append('users_email', document.getElementById('users_email').value); 
        postdata.append('users_password', document.getElementById('users_password').value); 
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
        postdata.append('users_ktp_picture', document.getElementById('users_ktp_picture').value);
        postdata.append('users_signature', document.getElementById('users_signature').value);

        $.ajax({
            type: "POST",
            url: "/admin/users",
            data: (postdata),
            processData: false, // Jangan ubah data
            contentType: false, // Atur tipe konten secara otomatis
            dataType: "json",
            async: false,
            success: function (data) {
                // console.log('hasil => ',data);
                
                if (data.status == 401) {
                    alert('Form Wajib Harus diisi');
                    return;
                } else if (data.status == 501) {
                    alert(data.message);
                    return;
                } else {
                    alert('Berhasil Disimpan');
                    setTimeout(function () {
                        window.open("/admin/users", "_self");
                    }, 500);
                }
            },
            error: function (dataerror) {
                console.log(dataerror);
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
                // console.log('hasil => ',data);
                document.getElementById('user_id').value = data.user_id;
                document.getElementById('users_name').value = data.users_name; 
                // document.getElementById('users_photo').value = data.users_photo; 
                document.getElementById('users_email').value = data.users_email; 
                document.getElementById('users_office_phone').value = data.users_office_phone; 
                document.getElementById('users_personal_phone').value = data.users_personal_phone; 
                document.getElementById('users_join_date').value = data.users_join_date; 
                document.getElementById('users_level').value = data.users_level; 
                document.getElementById('users_company').value = data.users_company; 
                document.getElementById('users_homebase').value = data.users_homebase; 
                document.getElementById('users_division').value = data.users_division; 
                document.getElementById('users_department').value = data.users_department; 
                document.getElementById('users_shift').value = data.users_shift; 
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
            },
            error: function (dataerror) {
                console.log(dataerror);
            }
        });
    }

    function updateInput(id) {
        var postdata = new FormData();
        // Tambahkan token CSRF
        postdata.append('_token', document.getElementsByName('_token')[0].defaultValue);
        postdata.append('users_name', document.getElementById('users_name').value); 
        postdata.append('users_photo', document.getElementById('users_photo').value); 
        postdata.append('users_email', document.getElementById('users_email').value); 
        postdata.append('users_password', document.getElementById('users_password').value); 
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
        postdata.append('users_ktp_picture', document.getElementById('users_ktp_picture').value);
        postdata.append('users_signature', document.getElementById('users_signature').value);
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
                // console.log('hasil => ',data);
                
                if (data.status == 401) {
                    alert('Form Wajib Harus diisi');
                    return;
                } else if (data.status == 501) {
                    alert(data.message);
                    return;
                } else {
                    alert('Berhasil Diupdate');
                    setTimeout(function () {
                        window.open("/admin/users", "_self");
                    }, 500);
                }
            },
            error: function (dataerror) {
                console.log(dataerror);
            }
        });

    }

    function delete_data(id){
        var postdata = {};
        postdata._token = document.getElementsByName('_token')[0].defaultValue;
        
        $.ajax({
            type: "DELETE",
            url: "/admin/users/"+id,
            data: (postdata),
            dataType: "json",
            async: false,
            success: function (data) {
                if (data.status == 401) {
                    alert('Form Wajib Harus diisi');
                    return;
                } else if (data.status == 501) {
                    alert(data.message);
                    return;
                } else {
                    alert('Data Berhasil Dihapus');
                    setTimeout(function () {
                        window.open("/admin/users", "_self");
                    }, 500);
                }
            },
            error: function (dataerror) {
                console.log(dataerror);
            }
        });
    }

</script>
@endsection
