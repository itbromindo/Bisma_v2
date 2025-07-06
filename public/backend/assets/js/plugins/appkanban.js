(function ($) {

	dragula([
		document.getElementById("todo"),
		document.getElementById("doing"),
		document.getElementById("done"),
	]);

	const thousandView = (number = 0) => {
		return number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
	}

	// KANBAN BOARD

	// Dapatkan semua kolom kanban
	let columnsCustome = Array.from(document.querySelectorAll(".kanban-columnXX"));

	// Inisialisasi Dragula
	let drake = dragula(columnsCustome, {
		removeOnSpill: false,
		copy: false,
		moves: function (el, container, handle) {
			return el.classList.contains("card-priorityXX");
		},
		accepts: function (el, target, source, sibling) {
			return target.classList.contains("kanban-columnXX");
		}
	});

	// Event listener untuk saat elemen dijatuhkan ke kolom baru
	drake.on('drop', function (el, target, source, sibling) {
		if (el && target) {
			let inquiryStage = target.querySelector('.inquiry-stageXX');
			inquiryStage = inquiryStage.value;
			let inquiryId = target.querySelector('.inquiry-idXX');
			inquiryId = inquiryId.value;
			updateInquiryStage(inquiryId, inquiryStage);
		}
	});

	// Jika elemen kembali ke tempat lama
	drake.on('cancel', function (el, container, source) {
		if (el && target) {
			let inquiryStage = target.querySelector('.inquiry-stageXX');
			inquiryStage = inquiryStage.value;
			let inquiryId = target.querySelector('.inquiry-idXX');
			inquiryId = inquiryId.value;
			updateInquiryStage(inquiryId, inquiryStage);
		}
	});

	function updateInquiryStage(id, stage) {
		$.ajax({
			url: '/admin/inquiry/update_stage?id=' + id + '&stage=' + stage,
			type: 'GET',
			dataType: 'JSON',
			success: function (response) {
				console.log(response);
			},
			error: function (error) {
				console.log(error);
			}
		})
	}

	// END::KANBAN BOARD

	const boardTitle = document.getElementById("board_title");
	const CreateBoard = document.getElementById("createboard");

	if (boardTitle) {
		setInterval(function () {
			if (boardTitle.value.length > 0) {
				CreateBoard.disabled = false;
			} else {
				CreateBoard.disabled = true;
			}
		}, 100);
	}

	var ID = function () {
		return "_" + Math.random().toString(36).substr(2, 9);
	};

	if (CreateBoard) {
		CreateBoard.addEventListener("click", function (event) {
			event.preventDefault();

			let StingId =
				Math.random().toString(36).substring(2, 15) +
				Math.random().toString(36).substring(2, 15);

			let kanbanParents = document.getElementById("kanban_board_parent");
			let kabanChild = document.createElement("div");
			kabanChild.classList.add("kanbanboard_child");
			kabanChild.innerHTML = `
      <div class="kanbanboard_child">
      <div class="card">
          <div class="card-body" >
            <div class="kanban-board-header">
              <h5>${boardTitle.value}</h5>
              <button class="dots-three text-gray-400 f-size-24" type="button">
                <img src="assets/images/svg/dot.svg" alt="clock">
              </button>
            </div>
            <div id="${StingId}">
            <button class="btn btn-primary2 btn-icon pill d-block"  name="button-group2" type="button" id="${"btn" + StingId
				}">
            <span class="button-content-wrapper">
              <span class="button-icon align-icon-right">
                <i class="ph-arrow-right"></i>
              </span>
              <span class="button-text" >

            Add new card
              </span>
              </span>

            </button>

            </div>

          </div>
      </div>

    </div>

      `;

			kanbanParents.appendChild(kabanChild);
			kanbanParents.insertBefore(kabanChild, kanbanParents.childNodes[6]);
			boardTitle.value = "";
			$("#createboard-modal").modal("hide");
			document.querySelector(".modal-backdrop").remove();
			//$(".modal-backdrop").removeClass("show")
			dragula([document.getElementById(StingId)]);

			let btngroup = document.getElementsByName("button-group2");
			btngroup.forEach(function (item, index) {
				item.addEventListener("click", function () {
					let modalbox = document.createElement("div");
					let overlay = document.createElement("div");
					overlay.setAttribute("class", "modal-backdrop fade show");
					overlay.setAttribute("id", "modal-vag3");
					modalbox.setAttribute("class", "modal fade show");
					modalbox.style.display = "block";
					modalbox.innerHTML = `
          <div class="modal-dialog createcard-modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="body-font-3">Create New Card</h5>
            <button type="button" class="plain-btn" id="modal-vag" aria-label="Close">
              <img src="assets/images/svg/close-btn.png" alt="" draggable="false">
            </button>
          </div>
          <div class="modal-body">
            <form id="boardform">
              <div class="rt-mb-24">
                <div class="row">
                  <div class="col-12 rt-mb-15">
                  <div className="fromGroup">
                  <label class=" body-font-4 pointer block mb-2" for="card_title_1">Tittle</label>
                  <input type="text" placeholder="Add tittle" class="form-control" id="card_title_1">

                  </div>

                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6 rt-mb-15">
                    <label for="">Priority</label>
                    <select name="" id="priority__tag" >
                      <option value="High Priority">High Priority</option>
                      <option value="Low Priority">Low Priority</option>
                    </select>
                  </div>
                  <div class="col-md-6 rt-mb-15">
                    <label for="">Label</label>
                    <select name="" id="urgent_tag">
                      <option value="hight">Urgents</option>
                      <option value="low">Medium</option>
                    </select>
                  </div>
                </div>
                <div class="row">
                  <div class="col-12 rt-mb-15">
                    <textarea  rows="4" placeholder="Write something about your events..." ></textarea>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6 rt-mb-15">
                    <div class="fromGroup has-icon">
                      <label>Created Date</label>
                      <div class="form-control-icon">
                        <input class="form-control date-picker-calender" type="text" placeholder="DD / MM / YY">
                        <div class="icon-badge-2">
                          <img src="assets/images/svg/calendar.svg" alt="">
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6 rt-mb-15">
                    <div class="fromGroup has-icon">
                      <label>Due Date</label>
                      <div class="form-control-icon">
                        <input class="form-control date-picker-calender" type="text" placeholder="DD / MM / YY">
                        <div class="icon-badge-2">
                          <img src="assets/images/svg/calendar.svg" alt="">
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-12">
                  <div className="fromGroup">
                   <label for="member-email" class="block rt-mb-4">Add Member</label>
                    <input type="text" placeholder="Member email address" id="member-email">
                  </div>

                  </div>
                </div>
              </div>
              <div class="createcard-modal-footer d-flex justify-content-between">
                <button type="button" class="btn btn-dark2 pill" id="modal-vag2" >Cancel</button>

                <button type="submit" class="btn btn-primary pill btn-icon" id="createcard">
                  <span class="button-content-wrapper">
                  <span class="button-icon align-icon-right">
                    <i class="ph-arrow-right"></i>
                  </span>
                  <span class="button-text" >
                    Create Column
                  </span>
                  </span>
                </button>

              </div>
            </form>
          </div>
        </div>
      </div>

          `;
					document.body.appendChild(modalbox);
					document.body.appendChild(overlay);
					document.getElementById("modal-vag").onclick = function () {
						document.body.removeChild(modalbox);
						document.body.removeChild(overlay);
					};
					document.getElementById("modal-vag2").onclick = function () {
						document.body.removeChild(modalbox);
						document.body.removeChild(overlay);
					};
					document.getElementById("modal-vag3").onclick = function () {
						document.body.removeChild(modalbox);
						document.body.removeChild(overlay);
					};

					const createcard = document.getElementById("boardform"); // form id
					createcard.addEventListener("submit", function (event) {
						event.preventDefault();
						let cardTitle = document.getElementById("card_title_1");
						let collectdate = new Date();
						let currentdate =
							collectdate.getDate() +
							" " +
							collectdate.toLocaleString("default", { month: "short" }) +
							", " +
							collectdate.getFullYear();
						let priority__tag = document.getElementById("priority__tag");

						let CurrentcardP = item.getAttribute("id");

						let cardPriority = document.getElementById(
							$("#" + CurrentcardP)
								.parent()
								.attr("id")
						);

						let innerCard = document.createElement("div");
						innerCard.classList.add("div");
						innerCard.innerHTML = `
            <div class="card-priority rt-mb-12 newcard" id="${"newcard" + ID()
							}">
                                  <!-- top bar  -->
                                  <div class="card-priority__header">
                                    <div class="date">
                                      <span class="icon">
                                        <img src="assets/images/svg/clock.svg" alt="clock">
                                      </span>
                                      <p>${currentdate}</p>
                                    </div>
                                    <!-- actions  -->
                                    <div class="card-priority__actions">
                                      <button class="dots-three text-gray-400 f-size-24" type="button" id="downMenuButton1" data-bs-toggle="dropdown" aria-expanded="true">
                                        <img src="assets/images/svg/dot.svg" alt="clock">
                                      </button>
                                      <ul class="dropdown-menu dropdown-actions" aria-labelledby="dropdownMenuButton1" data-popper-placement="bottom-start">


                                        <li>
                                          <a href="#" class="dropdown-item" >
                                            <span>
                                                  <img src="assets/images/svg/pen.svg" alt="pen">
                                                </span>
                                            Edit
                                          </a>
                                        </li>
                                        <li>
                                          <a href="#" class="dropdown-item" >
                                            <span>
                                                  <img src="assets/images/svg/copy-link.svg" alt="copylink">
                                                </span>
                                            Copy Link
                                          </a>
                                        </li>
                                        <li>
                                        <a   href="#" type="button"  class="dropdown-item remove-killer2 plain-btn" id="${"newbtn_1" + ID()
							}">
                                        <span>
                                              <img src="assets/images/svg/trash.svg" alt="copylink">
                                            </span>
                                        Delete
                                      </a>
                                        </li>
                                      </ul>
                                    </div>
                                  </div>

                                  <!-- labels  -->
                                  <div class="card-priority__labels">
                                    <ul>
                                      <li><span class="labels medium">${priority__tag.value
							}</span></li>
                                      <li><span class="labels urgent"><img class="rt-mr-6" src="assets/images/svg/red-circle.svg" alt="">${document.getElementById("urgent_tag")
								.value
							}</span></li>
                                    </ul>
                                  </div>
                                  <h2 class="card-priority__title">
                                    ${cardTitle.value}
                                  </h2>
                                  <!-- priority footer  -->
                                  <div class="card-priority__footer">
                                    <div>
                                      <ul class="labels-info">
                                        <li>
                                          <a href="#">
                                            <span>
                                              <img src="assets/images/svg/attach.svg" alt="icon">
                                            </span>
                                            0
                                          </a>
                                        </li>
                                        <li>
                                          <a href="#">
                                            <span>
                                              <img src="assets/images/svg/comments.svg" alt="icon">
                                            </span>
                                            0
                                          </a>
                                        </li>
                                      </ul>
                                    </div>
                                    <div>
                                      <ul class="users">
                                        <li class="users-item"><img src="assets/images/all-img/users/user1.png" alt="user-photo"></li>
                                        <li class="users-item"><img src="assets/images/all-img/users/three.png" alt="user-photo"></li>
                                        <li class="users-item"><img src="assets/images/all-img/users/two.png" alt="user-photo"></li>
                                        <li class="users-item"><img src="assets/images/all-img/users/one.png" alt="user-photo"></li>
                                      </ul>
                                    </div>
                                  </div>
                                </div>
            `;
						cardPriority.appendChild(innerCard);
						cardPriority.insertBefore(innerCard, cardPriority.childNodes[0]);
						cardTitle.value = "";

						document.body.removeChild(modalbox);
						document.body.removeChild(overlay);
					});
				});
			});
		});
	}

	// kanban card add

	let btngroup = document.getElementsByName("button-group");
	btngroup.forEach(function (item, index) {
		item.addEventListener("click", function () {
			let modalbox = document.createElement("div");
			let overlay = document.createElement("div");
			overlay.setAttribute("class", "modal-backdrop fade show");
			overlay.setAttribute("id", "modal-vag3");
			modalbox.setAttribute("class", "modal fade show");
			modalbox.style.display = "block";
			modalbox.innerHTML = `
        <style>
          .inquiry-option {
              border: 2px solid #ddd;
              border-radius: 8px;
              padding: 10px;
              margin-bottom: 10px;
              cursor: pointer;
              display: flex;
              justify-content: space-between;
              align-items: center;
          }
          .inquiry-option input {
              display: none;
          }
          .inquiry-option.active {
              border-color: #007bff;
              background-color: #f0f8ff;
          }
        </style>
        <div class="modal-dialog createcard-modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="body-font-3">Buat Inquiry</h5>
          <button type="button" class="plain-btn" id="modal-vag" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form id="inquiryForm">
            <label class="inquiry-option" id="supply-only" onclick="inquiryactive('supply-only')">
                Supply Only
                <input type="radio" name="inquiry" value="Supply Only">
                <span class="badge bg-primary rounded-circle p-2"></span>
            </label>
            <label class="inquiry-option" id="project" onclick="inquiryactive('project')">
                Project
                <input type="radio" name="inquiry" value="Project">
                <span class="badge bg-secondary rounded-circle p-2"></span>
            </label>
            <label class="inquiry-option" id="refill" onclick="inquiryactive('refill')">
                Refill
                <input type="radio" name="inquiry" value="Refill">
                <span class="badge bg-secondary rounded-circle p-2"></span>
            </label>
            <label class="inquiry-option" id="servis" onclick="inquiryactive('servis')">
                Servis
                <input type="radio" name="inquiry" value="Servis">
                <span class="badge bg-secondary rounded-circle p-2"></span>
            </label>
            <label class="inquiry-option" id="info-harga" onclick="inquiryactive('info-harga')">
                Info Harga
                <input type="radio" name="inquiry" value="Info Harga">
                <span class="badge bg-secondary rounded-circle p-2"></span>
            </label>
          </form>
            <div class="createcard-modal-footer d-flex justify-content-between">
              <button type="button" class="btn btn-dark2 pill" id="modal-vag2" >&nbsp;</button>

              <button type="submit" class="btn btn-primary pill btn-icon" id="createcard" onclick="saveinquiry_active()">
                <span class="button-content-wrapper">
                <span class="button-icon align-icon-right">
                  <i class="ph-arrow-right"></i>
                </span>
                <span class="button-text" >
                  Simpan
                </span>
                </span>
              </button>

            </div>
        </div>
      </div>
    </div>

    <script>
        document.querySelectorAll('.inquiry-option').forEach(option => {
            option.addEventListener('click', function() {
                document.querySelectorAll('.inquiry-option').forEach(opt => {
                    opt.classList.remove('active');
                    opt.querySelector('span').classList.remove('bg-primary');
                    opt.querySelector('span').classList.add('bg-secondary');
                });
                this.classList.add('active');
                this.querySelector('input').checked = true;
                this.querySelector('span').classList.remove('bg-secondary');
                this.querySelector('span').classList.add('bg-primary');
            });
        });
    </script>

        `;
			document.body.appendChild(modalbox);
			document.body.appendChild(overlay);
			document.getElementById("modal-vag").onclick = function () {
				document.body.removeChild(modalbox);
				document.body.removeChild(overlay);
			};
			document.getElementById("modal-vag2").onclick = function () {
				document.body.removeChild(modalbox);
				document.body.removeChild(overlay);
			};
			document.getElementById("modal-vag3").onclick = function () {
				document.body.removeChild(modalbox);
				document.body.removeChild(overlay);
			};

			const createcard = document.getElementById("boardform"); // form id
			createcard.addEventListener("submit", function (event) {
				event.preventDefault();
				let cardTitle = document.getElementById("card_title_1");
				let collectdate = new Date();
				let currentdate =
					collectdate.getDate() +
					" " +
					collectdate.toLocaleString("default", { month: "short" }) +
					", " +
					collectdate.getFullYear();
				let priority__tag = document.getElementById("priority__tag");

				let CurrentcardP = item.getAttribute("id");
				console.log(CurrentcardP);
				let cardPriority = document.getElementById(
					$("#" + CurrentcardP)
						.parent()
						.parent()
						.attr("id")
				);

				let innerCard = document.createElement("div");
				innerCard.classList.add("div");
				innerCard.innerHTML = `
          <div class="card-priority rt-mb-12">
                                <!-- top bar  -->
                                <div class="card-priority__header">
                                  <div class="date">
                                    <span class="icon">
                                      <img src="assets/images/svg/clock.svg" alt="clock">
                                    </span>
                                    <p>${currentdate}</p>
                                  </div>
                                  <!-- actions  -->
                                  <div class="card-priority__actions">
                                    <button class="dots-three text-gray-400 f-size-24" type="button" id="downMenuButton1" data-bs-toggle="dropdown" aria-expanded="true">
                                      <img src="assets/images/svg/dot.svg" alt="clock">
                                    </button>
                                    <ul class="dropdown-menu dropdown-actions" aria-labelledby="dropdownMenuButton1" data-popper-placement="bottom-start">


                                      <li>
                                        <a href="#" class="dropdown-item" >
                                          <span>
                                                <img src="assets/images/svg/pen.svg" alt="pen">
                                              </span>
                                          Edit
                                        </a>
                                      </li>
                                      <li>
                                        <a href="#" class="dropdown-item" >
                                          <span>
                                                <img src="assets/images/svg/copy-link.svg" alt="copylink">
                                              </span>
                                          Copy Link
                                        </a>
                                      </li>
                                      <li>

                                    <a     class="dropdown-item remove-killer plain-btn">
                                        <span>
                                              <img src="assets/images/svg/trash.svg" alt="copylink">
                                            </span>
                                        Delete
                                      </a>
                                      </li>
                                    </ul>
                                  </div>
                                </div>

                                <!-- labels  -->
                                <div class="card-priority__labels">
                                  <ul>
                                    <li><span class="labels medium">${priority__tag.value
					}</span></li>
                                    <li><span class="labels urgent"><img class="rt-mr-6" src="assets/images/svg/red-circle.svg" alt="">${document.getElementById("urgent_tag")
						.value
					}</span></li>
                                  </ul>
                                </div>
                                <h2 class="card-priority__title">
                                  ${cardTitle.value}
                                </h2>
                                <!-- priority footer  -->
                                <div class="card-priority__footer">
                                  <div>
                                    <ul class="labels-info">
                                      <li>
                                        <a href="#">
                                          <span>
                                            <img src="assets/images/svg/attach.svg" alt="icon">
                                          </span>
                                          0
                                        </a>
                                      </li>
                                      <li>
                                        <a href="#">
                                          <span>
                                            <img src="assets/images/svg/comments.svg" alt="icon">
                                          </span>
                                          0
                                        </a>
                                      </li>
                                    </ul>
                                  </div>
                                  <div>
                                    <ul class="users">
                                      <li class="users-item"><img src="assets/images/all-img/users/user1.png" alt="user-photo"></li>
                                      <li class="users-item"><img src="assets/images/all-img/users/three.png" alt="user-photo"></li>
                                      <li class="users-item"><img src="assets/images/all-img/users/two.png" alt="user-photo"></li>
                                      <li class="users-item"><img src="assets/images/all-img/users/one.png" alt="user-photo"></li>
                                    </ul>
                                  </div>
                                </div>
                              </div>
          `;

				cardPriority.appendChild(innerCard);
				cardPriority.insertBefore(innerCard, cardPriority.childNodes[0]);
				cardTitle.value = "";

				document.body.removeChild(modalbox);
				document.body.removeChild(overlay);
			});
		});
	});

	const UniqBoardButton = document.querySelectorAll(".remove-killer");
	const UinqBoard = document.getElementsByClassName("card-priority");

	UinqBoard.forEach(function (item) {
		item.setAttribute("id", "pid_" + ID());
	});
	UniqBoardButton.forEach(function (item, index) {
		item.setAttribute("id", ID());
		let singleItem = item.getAttribute("id");
		let getsingletem = document.getElementById(singleItem);
		let removeitemid =
			getsingletem.parentNode.parentNode.parentNode.parentNode.parentNode.id;
		let removeitem = document.getElementById(removeitemid);

		getsingletem.addEventListener("click", function () {
			removeitem.remove();
		});
	});

	let cardviewModal = document.querySelectorAll(".card-priority__title");

	cardviewModal.forEach(function (singlemodal) {
		$(singlemodal).on("click", function () {
			let cardPriority = $(this).closest(".card-priority");
			let inquiryId = cardPriority.find(".inquiry-id").val();
			$.ajax({
				url: '/admin/inquiry/detail/' + inquiryId,
				dataType: 'json',
				success: function (response) {
					if (response.status == 200) {
						let inquiry = response.data.inquiry;

                        if (response.data.inquiry.inquiry_stage == 'STATUS002') {
                          oncallpress_function(response, inquiryId);
                          return;
                        }

                        if (response.data.inquiry.inquiry_stage == 'STATUS003') {
                          waiting_oncallpress_function(response, inquiryId);
                          return;
                        }

						$("#viewmodal").modal("toggle");

						if (inquiry.inquiry_stage == 'STATUS008') {
							if (inquiry.can_approve) {
								$('#card-action-status-inquiry').html(`<div class="project-idea-header" style="background-color: #BA3838;">
									<div class="row">
										<div class="col-md-8">
											<h3>Waiting Approval Inquiry Batal</h3>
											<p>Inquiry perlu persetujuan dulu sebelum benar-benar Dibatalkan.</p>
										</div>
										<div class="col-md-4 text-end">
											<a href="#" class="btn btn-danger2" onclick="rejectInquiry('${inquiry.inquiry_code}', ${inquiry.master_approvals_details_id})">Reject</a>
											<a href="#" class="btn btn-primary" onclick="approveInquiry('${inquiry.inquiry_code}', ${inquiry.master_approvals_details_id})">Approve</a>
										</div>
									</div>
								</div>`);
							} else {
								$('#card-action-status-inquiry').html(`<div class="project-idea-header" style="background-color: #BA3838;">
									<div class="row">
										<div class="col-md-12">
											<h3>Waiting Approval Inquiry Batal</h3>
											<p>Inquiry perlu persetujuan dulu sebelum benar-benar Dibatalkan.</p>
										</div>
									</div>
								</div>`);
							}
						} else {
							$('#card-action-status-inquiry').html(`<div class="project-idea-header" style="background-color: #323C55;">
								<h3>Mission Possible: 4 Jam Menuju Keputusan!</h3>
								<p>Mau lanjut ke Quote atau No Quote? Waktu terus berjalan…</p>
							</div>`);
						}

						$('#d-inquiry-id').val(inquiryId);
						$('.d-inquiry-nomor').text(inquiry.inquiry_code);
						$('.d-inquiry-create-date').text(inquiry.create_date);
						$('.d-inquiry-type').text(inquiry.inquiry_type_name);
						$('.d-inquiry-due-date').text(inquiry.due_date);
						$('.d-inquiry-customer-nama').text(inquiry.customer_name);
						$('.d-inquiry-customer-provinsi').text(inquiry.provinces_name);
						$('.d-inquiry-customer-kota').text(inquiry.cities_name);
						$('.d-inquiry-customer-alamat').text(inquiry.customers_full_address);
						$('.d-inquiry-customer-email').text(inquiry.customers_email);
						$('.d-inquiry-customer-telp').text(inquiry.customers_phone);
						$('.d-inquiry-customer-pic').text(inquiry.customers_PIC);
						$('.d-inquiry-user-name').text(inquiry.users_name);
						$('.d-inquiry-user-email').text(inquiry.users_email);
						$('.d-inquiry-user-telp').text(inquiry.users_personal_phone);
						$('.d-inquiry-origin').text(inquiry.origin_inquiry_name);
						$('.d-inquiry-status').text(inquiry.inquiry_status_name);

						let htmlInquiryProducts = '';
						if (inquiry.product_divisions_name) {
							let product_divisions = inquiry.product_divisions_name;
							let division_names = product_divisions.split(",");
							htmlInquiryProducts += `<ul class="d-flex"><li class="me-2">:</li>`;
							division_names.forEach(value => {
								htmlInquiryProducts += `<li class="me-2">
                  <span class="badge rounded-pill bg-primary-50 text-primary-500">${value}</span>
                </li>`;
							});

							htmlInquiryProducts += `</ul>`;
						}
						$('.d-inquiry-product').html(htmlInquiryProducts);

						// list permintaan
						$('.d-inquiry-warehaouse').text(inquiry.warehouse_name);
						$('.d-inquiry-customer-type').text(inquiry.inquiry_customer_type);
						$('.d-inquiry-oc').text(inquiry.inquiry_oc);
						$('.d-inquiry-shopping-cost').text(thousandView(inquiry.inquiry_shipping_cost));

						let list_permintaan = response.data.list_permintaan;
						$('#tableBody').empty();
						let totalProdukPermintaan = 0;
						let totalHargaPermintaan = 0;
						if (list_permintaan.length > 0) {
							list_permintaan.forEach(function (data, index) {
								totalProdukPermintaan += 1;
								totalHargaPermintaan += data.inquiry_product_total_price;
								$('#tableBody').append(`
                  <tr>
                    <td class="text-center">${index + 1}</td>
                    <td class="text-center">${data.inquiry_product_name}</td>
                    <td class="text-center">${thousandView(data.inquiry_product_qty)}</td>
                    <td class="text-center">${thousandView(data.goods_stock)}</td>
                    <td class="text-center">${data.inquiry_product_status_on_inquiry}</td>
                    <td class="text-center">${data.uom_name}</td>
                    <td class="text-center">${thousandView(data.inquiry_product_pricelist)}</td>
                    <td class="text-center">${thousandView(data.inquiry_product_net_price)}</td>
                    <td class="text-center">${data.inquiry_taxes_percent} %</td>
                    <td class="text-center">${thousandView(data.inquiry_product_total_price)}</td>
                  </tr>
                `);
							});
						} else {
							$('#tableBody').append('<tr><td colspan="10" class="text-center">No results found</td></tr>');
						}

						$('.d-total-produk-permintaan').text(thousandView(totalProdukPermintaan));
						$('.d-total-harga-permintaan').text('Rp.' + thousandView(totalHargaPermintaan));

					} else {
						Swal.fire({
							icon: 'warning',
							title: 'Warning!',
							text: 'Data tidak ditemukan!',
						})
					}
				},
				error: function (error) {
					console.log(error)
					Swal.fire({
						icon: 'error',
						title: 'Error!',
						text: 'Terjadi kesalahan data!',
					})
				}
			})

		});
	});

  // function khusus kanban 2 on call press
  function oncallpress_function(response, inquiryId) {
    let inquiry = response.data.inquiry;
    $("#viewmodaloncallpress").modal("toggle");
    $('#d-inquiry-id-kanban2').val(inquiryId);
    $('#d-inquiry-type-user').val(inquiry.inquiry_customer_type);
    $('.d-inquiry-oncallprice-nomor').text(inquiry.inquiry_code);
    $('.d-inquiry-oncallprice-create-date').text(inquiry.create_date);
    $('.d-inquiry-oncallprice-type').text(inquiry.inquiry_type_name);
    $('.d-inquiry-oncallprice-due-date').text(inquiry.due_date);
    $('.d-inquiry-oncallprice-customer-nama').text(inquiry.customer_name);
    $('.d-inquiry-oncallprice-customer-provinsi').text(inquiry.provinces_name);
    $('.d-inquiry-oncallprice-customer-kota').text(inquiry.cities_name);
    $('.d-inquiry-oncallprice-customer-alamat').text(inquiry.customers_full_address);
    $('.d-inquiry-oncallprice-customer-email').text(inquiry.customers_email);
    $('.d-inquiry-oncallprice-customer-telp').text(inquiry.customers_phone);
    $('.d-inquiry-oncallprice-customer-pic').text(inquiry.customers_PIC);
    $('.d-inquiry-oncallprice-user-name').text(inquiry.users_name);
    $('.d-inquiry-oncallprice-user-email').text(inquiry.users_email);
    $('.d-inquiry-oncallprice-user-telp').text(inquiry.users_personal_phone);
    $('.d-inquiry-oncallprice-origin').text(inquiry.origin_inquiry_name);
    $('.d-inquiry-oncallprice-status').text(inquiry.inquiry_status_name);
    // console.log("oncallpress_function", response);

    let htmlInquiryProducts = '';
    if(inquiry.product_divisions_name) {
      let product_divisions = inquiry.product_divisions_name;
      let division_names = product_divisions.split(",");
      htmlInquiryProducts += `<ul class="d-flex"><li class="me-2">:</li>`;
      division_names.forEach(value => {
        htmlInquiryProducts += `<li class="me-2">
          <span class="badge rounded-pill bg-primary-50 text-primary-500">${value}</span>
        </li>`;
      });

      htmlInquiryProducts += `</ul>`;
    }
    $('.d-inquiry-oncallprice-product').html(htmlInquiryProducts);

    // list permintaan
    $('.d-inquiry-oncallprice-warehaouse').text(inquiry.warehouse_name);
    $('.d-inquiry-oncallprice-customer-type').text(inquiry.inquiry_customer_type);
    $('.d-inquiry-oncallprice-oc').text(inquiry.inquiry_oc);
    $('.d-inquiry-oncallprice-shopping-cost').text(inquiry.inquiry_shipping_cost);

    let list_permintaan = response.data.list_permintaan;
    $('#tableBody-kanban2').empty();
    let totalProdukPermintaan = 0;
    let totalHargaPermintaan = 0;


    if(list_permintaan.length > 0) {
      list_permintaan.forEach(function (data, index) {
        totalProdukPermintaan += 1;
        totalHargaPermintaan += data.inquiry_product_total_price;
        let name_status = 'indent';
        if (data.inquiry_product_status_on_inquiry == 2) {
          name_status = '<p style="color: green;">Ready</p>';
        }
        if (data.inquiry_product_status_on_inquiry == 3) {
          name_status = '<p style="color: red;">Tidak ditemukan disistem</p>';
        }

        const btn = onCallButton.replace('PLACEHOLDER_ID', data.inquiry_product_id);

        $('#tableBody-kanban2').append(`
          <tr data-inquiry-id="${data.inquiry_product_id}">
            <td class="hidden">${ data.inquiry_product_id}</td>
            <td class="text-center">${ index + 1}</td>
            <td class="text-center">${ data.inquiry_product_name }</td>
            <td class="text-center">${ data.inquiry_product_qty }</td>
            <td class="text-center">${ name_status }</td>
            <td class="text-center pricelist-cell">${data.inquiry_product_pricelist}</td>
            <td class="text-center netprice-cell">${data.inquiry_product_net_price}</td>
            <td class="text-center totalprice-cell">${data.inquiry_product_total_price}</td>
            ${btn}
          </tr>
        `);
      });
    }else{
      $('#tableBody-kanban2').append('<tr><td colspan="10" class="text-center">No results found</td></tr>');
    }

    $('.d-total-produk-permintaan-oncallprice').text(thousandView(totalProdukPermintaan));
    $('.d-total-harga-permintaan-oncallprice').text('Rp.' + thousandView(totalHargaPermintaan));
  }


  // function khusus kanban 3 waiting on call press
  function waiting_oncallpress_function(response, inquiryId) {
    let inquiry = response.data.inquiry;
    if (inquiry.can_approve == true){
        $('#button_verification_waiting_oncallprice').removeClass('hidden');
    }else{
        $('#button_verification_waiting_oncallprice').addClass('hidden');
    }

    $("#viewmodal_waiting_oncallprice").modal("toggle");
    $('#d-inquiry-waiting-oncallprice-approvals-id').val(inquiry.master_approvals_details_id);
    $('#d-inquiry-waiting-oncallprice-code').val(inquiry.inquiry_code);
    $('#d-inquiry-waiting-oncallprice-id').val(inquiryId);
    $('.d-inquiry-waiting-oncallprice-nomor').text(inquiry.inquiry_code);
    $('.d-inquiry-waiting-oncallprice-create-date').text(inquiry.create_date);
    $('.d-inquiry-waiting-oncallprice-type').text(inquiry.inquiry_type_name);
    $('.d-inquiry-waiting-oncallprice-due-date').text(inquiry.due_date);
    $('.d-inquiry-waiting-oncallprice-customer-nama').text(inquiry.customer_name);
    $('.d-inquiry-waiting-oncallprice-customer-provinsi').text(inquiry.provinces_name);
    $('.d-inquiry-waiting-oncallprice-customer-kota').text(inquiry.cities_name);
    $('.d-inquiry-waiting-oncallprice-customer-alamat').text(inquiry.customers_full_address);
    $('.d-inquiry-waiting-oncallprice-customer-email').text(inquiry.customers_email);
    $('.d-inquiry-waiting-oncallprice-customer-telp').text(inquiry.customers_phone);
    $('.d-inquiry-waiting-oncallprice-customer-pic').text(inquiry.customers_PIC);
    $('.d-inquiry-waiting-oncallprice-user-name').text(inquiry.users_name);
    $('.d-inquiry-waiting-oncallprice-user-email').text(inquiry.users_email);
    $('.d-inquiry-waiting-oncallprice-user-telp').text(inquiry.users_personal_phone);
    $('.d-inquiry-waiting-oncallprice-origin').text(inquiry.origin_inquiry_name);
    $('.d-inquiry-waiting-oncallprice-status').text(inquiry.inquiry_status_name);

    let htmlInquiryProducts = '';
    if(inquiry.product_divisions_name) {
      let product_divisions = inquiry.product_divisions_name;
      let division_names = product_divisions.split(",");
      htmlInquiryProducts += `<ul class="d-flex"><li class="me-2">:</li>`;
      division_names.forEach(value => {
        htmlInquiryProducts += `<li class="me-2">
          <span class="badge rounded-pill bg-primary-50 text-primary-500">${value}</span>
        </li>`;
      });

      htmlInquiryProducts += `</ul>`;
    }
    $('.d-inquiry-waiting-oncallprice-product').html(htmlInquiryProducts);

    // list permintaan
    $('.d-inquiry-waiting-oncallprice-warehaouse').text(inquiry.warehouse_name);
    $('.d-inquiry-waiting-oncallprice-customer-type').text(inquiry.inquiry_customer_type);
    $('.d-inquiry-waiting-oncallprice-oc').text(inquiry.inquiry_oc);
    $('.d-inquiry-waiting-oncallprice-shopping-cost').text(thousandView(inquiry.inquiry_shipping_cost));

    let list_permintaan = response.data.list_permintaan;
    $('#tableBody_waiting_oncallprice').empty();
    let totalProdukPermintaan = 0;
    let totalHargaPermintaan = 0;
    if(list_permintaan.length > 0) {
      list_permintaan.forEach(function (data, index) {
        totalProdukPermintaan += 1;
        totalHargaPermintaan += data.inquiry_product_total_price;
        $('#tableBody_waiting_oncallprice').append(`
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
      $('#tableBody_waiting_oncallprice').append('<tr><td colspan="10" class="text-center">No results found</td></tr>');
    }

    $('.d-total-produk-permintaan-waiting-oncallprice').text(thousandView(totalProdukPermintaan));
    $('.d-total-harga-permintaan-waiting-oncallprice').text('Rp.' + thousandView(totalHargaPermintaan));
  }

})(jQuery);
