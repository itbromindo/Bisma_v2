<div class="card">
    <div class="card-body">
        <div class="kanban-board-header">
            <h5>{{ $inquiry->inquiry_status_name }}</h5>
        </div>
        <div id="task-inquiry-2" class="kanban-section">
            <div id="inquiry-2" class="kanban-column">
                <input type="hidden" value="{{ $inquiry->inquiry_status_code }}" class="inquiry-stage">
                @foreach($data as $row)
                @php
                    $duedate = $row->inquiry_end_date;
                    $today = date('Y-m-d H:i:s');
                    $status_card = '';

                    if($today > $duedate)
                    {
                        $status_card = ' bg-danger-50 border-danger';
                    }
                @endphp

                <div class="card-priority rt-mb-12 {{ $status_card }}">
                    <input type="hidden" value="{{ $row->inquiry_id }}" class="inquiry-id">
                    <!-- top bar  -->
                    <div class="card-priority__header">
                        <div class="date">
                            <span class="icon">
                                <img src="{{asset('backend/assets/images/svg/clock.svg')}}" alt="clock">
                            </span>
                            <p>Due Date Inquiry : <br>{{ date("d M, Y", strtotime($duedate)) }}</p>
                        </div>
                        <!-- actions  -->

                    </div>

                    <!-- labels  -->
                    <div class="card-priority__labels">
                        <ul>
                            <li>
                                <span class="badge rounded-pill bg-success-50 text-success-500"
                                >{{ $row->origin_inquiry_name }}</span>
                            </li>
                            @php
                                $product_divisions = $row->product_divisions_name;
                                $product_divisions = explode(',', $product_divisions);
                            @endphp
                            @foreach ($product_divisions as $divisi)
                            <li>
                                <span class="badge rounded-pill bg-primary-50 text-primary-500"
                                >{{ $divisi }}</span>
                            </li>
                            @endforeach
                            <li>
                                <span class="badge rounded-pill bg-warning-50 text-warning-500">{{ $row->inquiry_type_name }}</span>
                            </li>
                        </ul>
                    </div>

                    <h2 class="card-priority__title pointer">
                        {{ $row->inquiry_code }}
                    </h2>
                    <h3 class="card-priority__title pointer" style="font-size: 14px; color: #626C70; margin: 0;">{{ $row->customer_name }}</h3>

                    <!-- priority footer  -->
                    <div class="card-priority__footer">
                        <div>
                            <ul class="labels-info">
                                <li>
                                    <a href="#">
                                        <span>
                                            <img src="{{asset('backend/assets/images/svg/attach.svg')}}" alt="icon">
                                        </span> 5
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <span>
                                            <img src="{{asset('backend/assets/images/svg/comments.svg')}}" alt="icon">
                                        </span> 19
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <span>
                                            <img src="{{asset('backend/assets/images/svg/checks.svg')}}" alt="icon">
                                        </span> 19
                                    </a>
                                </li>
                                <li>
                                    <span class="labels urgent {{ $row->inquiry_stage_progress_color }}"
                                    >{{ ucwords($row->inquiry_stage_progress) }}</span>
                                </li>
                            </ul>
                        </div>
                        <div>
                            @php
                                $image = $row->users_photo;
                                $images = explode(',', $image);
                            @endphp
                            <ul class="users">
                                @foreach($images as $img)
                                <li class="users-item rounded-circle">
                                    <img src="{{ asset($img) }}" alt="user-photo">
                                </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

<script>
    function update_stage_oncallpress(id, stage)
    {
        // console.log('id', id);
        $.ajax({
            type: "GET",
            url: '/admin/inquiry/update_stage?id='+id+'&stage='+stage,
            processData: false,
            contentType: false,
            dataType: "json",
            async: false,
            // headers: {
            //     'X-CSRF-TOKEN': '{{ csrf_token() }}'
            // },
            success: function(data) {
                if (data.status == 401 || data.status == 501) {
                    showAlert('danger', "Terjadi kesalahan, silahkan coba lagi.");
                    return;
                } else {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: 'Data Saved!',
                    }).then(function() {
                        window.location.href = "/admin/inquiry";
                    });
                }
            },
            error: function(dataerror) {
                alertError(dataerror.responseJSON.message);
            }
        });

    }

    function saveOnCallPrice() {
        let id = $('#d-inquiry-oncallprace-aktive').val();
        let harga_pokok = $('#d-hargaPokok-oncallprice').val();

        let margin_enduser = $('#d-marginEndUser-oncallprice').val();
        let margin_kontraktor = $('#d-marginKontraktor-oncallprice').val();
        let margin_reseller = $('#d-marginReseller-oncallprice').val();
        let margin_pricelist = $('#d-marginPricelist-oncallprice').val();

        let price_enduser = $('#d-hargaEndUser-oncallprice').val();
        let price_kontraktor = $('#d-hargaKontraktor-oncallprice').val();
        let price_reseller = $('#d-hargaReseller-oncallprice').val();
        let price_pricelist = $('#d-hargaPricelist-oncallprice').val();

        let brand = $('#d-oncall-price-brand-code').val();
        let type = $('#d-oncall-price-product-division-code').val();
        let satuan = $('#d-oncall-price-uom-code').val();
        let kategori = $('#d-oncall-category-code').val();

        let type_user = $('#d-inquiry-type-user').val();

        var postdata = new FormData();
        postdata.append('_token', document.getElementsByName('_token')[0].defaultValue);
        postdata.append('harga_pokok', harga_pokok);
        postdata.append('margin_enduser', margin_enduser);
        postdata.append('margin_kontraktor', margin_kontraktor);
        postdata.append('margin_reseller', margin_reseller);
        postdata.append('margin_pricelist', margin_pricelist);
        postdata.append('price_enduser', price_enduser);
        postdata.append('price_kontraktor', price_kontraktor);
        postdata.append('price_reseller', price_reseller);
        postdata.append('price_pricelist', price_pricelist);
        postdata.append('brand', brand);
        postdata.append('type', type);
        postdata.append('satuan', satuan);
        postdata.append('kategori', kategori);
        postdata.append('type_user', type_user);

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            type: "POST",
            url: "/admin/inquiry/update_oncallprice/" + id,
            data: (postdata),
            processData: false, // Jangan ubah data
            contentType: false, // Atur tipe konten secara otomatis
            dataType: "json",
            async: false,
            success: function (data) {
                if (data.status == 401) {
                    showAlert('danger', "Form Wajib Diisi");
                    return;
                } else if (data.status == 501) {
                    showAlert('danger', "Form Wajib Diisi");
                    return;
                } else {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: 'Level Up! Permintaan Baru Ditambahkan!',
                    }).then(function() {
                        $('#viewadddetailitem_oncallpress').modal('hide');
                        const row = $(`#tableBody-kanban2 tr[data-inquiry-id="${id}"]`);

                        row.find('.pricelist-cell').text(data.detail_update.inquiry_product_pricelist);
                        row.find('.netprice-cell').text(data.detail_update.inquiry_product_net_price);
                        row.find('.totalprice-cell').text(data.detail_update.inquiry_product_total_price);

                        const thousandView = (number = 0) => {
                            return number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
                        }
                        $('.d-total-harga-permintaan-oncallprice').text('Rp.' + thousandView(data.count_price));

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
</script>
