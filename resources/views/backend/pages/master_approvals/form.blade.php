@extends('backend.layouts.master')

@section('title')
Form Master Approvals - Admin Panel
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
                    <div class="breadcrumbs">
                        <div class="breadcrumb-title">Form Master Approval Management</div>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href='/admin'>Home</a></li>
                                <li class="breadcrumb-item"><a href='/admin/master_approvals'>Master</a></li>
                                <li class="breadcrumb-item"><a href='/admin/master_approvals'>Master Approval</a></li>
                                <li class="breadcrumb-item"><a href='/admin/master_approvals/create'>Form Master Approval</a></li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xxl-12 col-xl-12 col-md-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5>Form Master Approvals</h5>
                        </div>

                        <div class="card-body">
                            <form id="form-data">
                                @csrf
                                <input type="hidden" id="master_approvals_id" name="master_approvals_id" value="{{ !empty($id) ? $id : '' }}">
                                <div id="alert-container"></div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="fromGroup mb-3">
                                            <label>Master Approval Name</label>
                                            <input class="form-control" type="text" id="master_approval_name" name="master_approval_name" value="{{ old('master_approval_name', $data->master_approvals_approval_name ?? '') }}" placeholder="Master Approval Name" required/>
                                        </div>
                                        <div class="fromGroup mb-3">
                                            <label>Notes</label>
                                            <textarea class="form-control" name="notes" id="notes" placeholder="Notes" rows="5">{{ old('notes', $data->master_approvals_notes ?? '') }}</textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="fromGroup mb-3">
                                            <label>Divsion</label>
                                            <select class="form-control js-select2" id="division" name="division" style="width: 100%;" required>
                                                <option value="" disabled selected>Pilih Division</option>
                                                @foreach ($divisions as $division)
                                                    <option value="{{ $division->division_code }}" 
                                                        {{ old('division', $data->division_code ?? '') == $division->division_code ? 'selected' : '' }}>
                                                        {{ $division->division_name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="fromGroup mb-3">
                                            <label>Department</label>
                                            <select class="form-control js-select2" name="department" id="department" style="width: 100%;" required>
                                                <option value="" disabled selected>Pilih Department</option>
                                                @foreach ($departments as $department)
                                                    <option value="{{ $department->department_code }}" 
                                                        {{ old('division', $data->department_code ?? '') == $department->department_code ? 'selected' : '' }}>
                                                        {{ $department->department_name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="fromGroup mb-3">
                                            <label>Level</label>
                                            <select class="form-control js-select2" name="level" id="level" style="width: 100%;" required>
                                                <option value="" disabled selected>Pilih Level</option>
                                                @foreach ($levels as $level)
                                                    <option value="{{ $level->level_code }}" 
                                                        {{ old('division', $data->level_code ?? '') == $level->level_code ? 'selected' : '' }}>
                                                        {{ $level->level_name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <button type="button" class="btn btn-success btn-sm my-4" id="btn-add-detail">Add Data Detail</button>
                                <section class="tables">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="table-wrapper">
                                                <div class="table-content table-responsive">
                                                    <table class="table align-middle table-basic">
                                                        <thead style="text-align: center">
                                                            <tr>
                                                                <th scope="col" width="20%">SECTION</th>
                                                                <th scope="col">ATASAN</th>
                                                                <th scope="col" width="20%">#</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody id="tableBody">
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </section>
                                
                                <div class="modal-footer">
                                    <a href="/admin/master_approvals" class="btn btn-dark btn-sm">Back</a>
                                    @if ($usr->can('master_approvals.update') || $usr->can('master_approvals.create'))
                                    <button type="submit" id="saveButton" class="btn btn-primary btn-sm">Save</button>
                                    @endif
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        let counter = 1;
        let id = $('#master_approvals_id').val();

        if(id) {
            $.ajax({
                url: '/admin/master_approvals/' + id,
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    $('#tableBody').empty();

                    // Loop setiap detail
                    data.details.forEach(function(item) {
                        let row = `
                            <tr id="row_${counter}">
                                <td>
                                    <input class="form-control" type="text" id="detail_section_${counter}" name="detail_section[]" value="${item.section}" placeholder="Section" required />
                                </td>
                                <td>
                                    <select class="form-control select2-level" name="detail_atasan[]" id="detail_atasan_${counter}" style="width: 100%;" required>
                                        <option value="${item.approver_code}" selected>${item.level_name}</option>
                                    </select>
                                </td>
                                <td class="text-center">
                                    <button type="button" class="btn btn-light btn-sm border border-danger text-danger" title="Delete" onclick="delete_data(${counter})">
                                        <svg width="16" height="16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M12.5 3.5L3.5 12.5" stroke="red" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round" />
                                            <path d="M12.5 12.5L3.5 3.5" stroke="red" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                    </button>
                                </td>
                            </tr>`;
                        
                        $('#tableBody').append(row);
                        counter++;
                    });

                    select2_level();
                },
                error: function(xhr) {
                    alert('Error: ' + xhr.statusText);
                }
            });
        }

        $('#btn-add-detail').click(function() {
            let rows = `<tr id="row_${counter}">
                <td>
                    <input class="form-control" type="text" id="detail_section_${counter}"  name="detail_section[]" placeholder="Section" required/>
                </td>
                <td>
                    <select class="form-control select2-level" name="detail_atasan[]" id="detail_atasan_${counter}" style="width: 100%;" required>
                        <option value="" disabled selected>Pilih Level</option>
                    </select>
                    </td>
                <td class="text-center">
                    <button type="button" class="btn btn-light btn-sm border border-danger text-danger" title="Delete" onclick="delete_data(${counter})">
                        <svg width="16" height="16" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M12.5 3.5L3.5 12.5" stroke="red" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M12.5 12.5L3.5 3.5" stroke="red" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </button>
                </td>
            </tr>`;
            $('#tableBody').append(rows);
            select2_level();

            counter++;
        });

        $('.js-select2').select2();

        function select2_level() {
            $('.select2-level').select2({
                placeholder: "Select Level",
                allowClear: true,
                ajax: {
                    url: '/admin/combolevels', 
                    dataType: 'json',
                    delay: 250,
                    data: function (params) {
                        return {
                            search: params.term
                        };
                    },
                    processResults: function (data) {
                        return {
                            results: data
                        };
                    }
                }
            });
        }

        select2_level();

        $('#form-data').on('submit', function (e) {
            e.preventDefault(); 

            let form = $('#form-data')[0];
            let formData = new FormData(form);
            // Token sudah ada di formData, tapi tetap baik kirim di header juga
            let csrfToken = document.getElementsByName('_token')[0].value;

            $('#tableBody tr').each(function (index) {
                let section = $(this).find('input[name="detail_section[]"]').val();
                let level = $(this).find('select[name="detail_atasan[]"]').val();

                formData.append(`detail_section[${index}]`, section);
                formData.append(`detail_atasan[${index}]`, level);
            });

            $.ajax({
                url: '/admin/master_approvals', 
                type: 'POST',
                headers: {
                    'X-CSRF-TOKEN': csrfToken
                },
                data: formData,
                processData: false,
                contentType: false,
                beforeSend: function () {
                    $('#saveButton').attr('disabled', true).text('Saving...');
                    $('#alert-container').html('');
                },
                success: function (response) {
                    $('#alert-container').html(`
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            ${response.message || 'Data berhasil disimpan.'}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    `);
                    $('#saveButton').attr('disabled', false).text('Save');
                    setTimeout(function () {
                        window.location.href = "/admin/master_approvals";
                    }, 2000);
                },
                error: function (xhr) {
                    let errorMsg = 'Terjadi kesalahan saat menyimpan data.';
                    if (xhr.responseJSON && xhr.responseJSON.message) {
                        errorMsg = xhr.responseJSON.message;
                    }
                    $('#alert-container').html(`
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            ${errorMsg}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    `);
                    $('#saveButton').attr('disabled', false).text('Save');
                }
            });
        });

        
    });

    function delete_data(counter) {
        $(`#row_${counter}`).remove();
    }
</script>

@endsection