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
                </div>
            </div>

            <!-- kanban start-->
            <div class="row">
                <div class="col-12">
                    <div id="board" class="board">
                        <!-- <div class="d-flex justify-content-end my-2">
                            <button type="button" class="btn btn-sm btn-outline-primary pill btn-icon">
                                <span class="button-content-wrapper">
                                    <span class="button-text">
                                        Button
                                    </span>
                                    <span class="button-icon">
                                        <img src="{{ asset('backend/assets/images/svg/search.svg')}}" alt="Search" draggable="false">
                                    </span>
                                </span>
                            </button>
                            <button type="button" class="btn btn-icon">
                                <span class="button-content-wrapper">
                                    <span class="button-icon">
                                        <img src="{{ asset('backend/assets/images/svg/search.svg')}}" alt="Search" draggable="false">
                                    </span>
                                </span>
                            </button>
                        </div> -->

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

<div
  class="modal fade"
  id="viewmodal"
  tabindex="-1"
  aria-labelledby="viewmodalLabel"
  aria-hidden="true"
>
  <div class="modal-dialog viewmodal-dialog modal-lg modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <div>
          <button class="plain-btn rt-mr-8">
            <svg
              width="40"
              height="40"
              viewBox="0 0 40 40"
              fill="none"
              xmlns="http://www.w3.org/2000/svg"
            >
              <path
                d="M0 20C0 8.95431 8.95431 0 20 0V0C31.0457 0 40 8.95431 40 20V20C40 31.0457 31.0457 40 20 40V40C8.95431 40 0 31.0457 0 20V20Z"
                fill="#F5F6F7"
              />
              <path
                d="M20 22.5H17.5V20L25 12.5L27.5 15L20 22.5Z"
                stroke="#191B1C"
                stroke-width="1.25"
                stroke-linecap="round"
                stroke-linejoin="round"
              />
              <path
                d="M23.125 14.375L25.625 16.875"
                stroke="#191B1C"
                stroke-width="1.25"
                stroke-linecap="round"
                stroke-linejoin="round"
              />
              <path
                d="M26.875 19.375V26.25C26.875 26.4158 26.8092 26.5747 26.6919 26.6919C26.5747 26.8092 26.4158 26.875 26.25 26.875H13.75C13.5842 26.875 13.4253 26.8092 13.3081 26.6919C13.1908 26.5747 13.125 26.4158 13.125 26.25V13.75C13.125 13.5842 13.1908 13.4253 13.3081 13.3081C13.4253 13.1908 13.5842 13.125 13.75 13.125H20.625"
                stroke="#191B1C"
                stroke-width="1.25"
                stroke-linecap="round"
                stroke-linejoin="round"
              />
            </svg>
          </button>
          <button class="plain-btn">
            <svg
              width="40"
              height="40"
              viewBox="0 0 40 40"
              fill="none"
              xmlns="http://www.w3.org/2000/svg"
            >
              <path
                d="M20 40C8.95431 40 0 31.0457 0 20V20C0 8.95431 8.95431 0 20 0V0C31.0457 0 40 8.95431 40 20V20C40 31.0457 31.0457 40 20 40V40Z"
                fill="#F5F6F7"
              />
              <path
                d="M20 25.5C19.7239 25.5 19.5 25.2761 19.5 25C19.5 24.7239 19.7239 24.5 20 24.5C20.2761 24.5 20.5 24.7239 20.5 25C20.5 25.2761 20.2761 25.5 20 25.5ZM20 20.5C19.7239 20.5 19.5 20.2761 19.5 20C19.5 19.7239 19.7239 19.5 20 19.5C20.2761 19.5 20.5 19.7239 20.5 20C20.5 20.2761 20.2761 20.5 20 20.5ZM20 15.5C19.7239 15.5 19.5 15.2761 19.5 15C19.5 14.7239 19.7239 14.5 20 14.5C20.2761 14.5 20.5 14.7239 20.5 15C20.5 15.2761 20.2761 15.5 20 15.5Z"
                fill="#191B1C"
                stroke="#191B1C"
                stroke-width="1.5"
              />
            </svg>
          </button>
        </div>
        <button
          type="button"
          class="plain-btn"
          data-bs-dismiss="modal"
          aria-label="Close"
        >
          <img
            src="{{ asset('assets/images/svg/close-btn.png') }}"
            alt=""
            draggable="false"
          />
        </button>
      </div>
      <div class="modal-body">
        <div class="card-details-wrap">
          <div class="card-details-body">
            <div class="project-idea-wrap">
              <div class="project-idea-header">
                <h3>
                  New Project Idea & Research
                  <span
                    class="badge rounded-pill bg-danger-50 text-danger-500 rt-ml-8"
                    >High Priority</span
                  >
                </h3>
              </div>
              <div class="project-idea-body">
                <div class="project-idea-data">
                  <h5>Label</h5>
                  <span
                    ><img
                      class="rt-mr-6"
                      src="{{ asset('assets/images/svg/red-circle.svg') }}"
                      alt=""
                    />Urgents</span
                  >
                </div>
                <div class="project-idea-data">
                  <h5>Created date</h5>
                  <p>12 Nov, 2021 at 9:40 PM</p>
                </div>
                <div class="project-idea-data">
                  <h5>Due Date</h5>
                  <p>15 Nov, 2021 at 10:00 AM</p>
                </div>
              </div>
            </div>
            <div class="project-description">
              <h4>Description</h4>
              <p>
                In lobortis fermentum venenatis. Phasellus orci libero, feugiat
                et velit non, sagittis feugiat eros. In placerat risus vitae est
                faucibus, in laoreet enim rutrum. Mauris posuere vitae felis at
                convallis. Integer consequat et tellus vel tincidunt. Aenean
                rhoncus ligula eu risus molestie semper.
              </p>
            </div>
            <div class="project-member-column">
              <h4>Members <span>(05)</span></h4>
              <div class="project-member-wrap">
                <div class="project-member-item">
                  <div class="project-member-thumb">
                    <img src="{{ asset('assets/images/all-img/users/user1.png') }}" alt="" />
                  </div>
                  <div class="project-member-data">
                    <h5>Brooklyn Simmons</h5>
                    <a href="#">ateniese@mac.com</a>
                  </div>
                </div>
                <div class="project-member-item">
                  <div class="project-member-thumb">
                    <img src="{{ asset('assets/images/all-img/users/two.png') }}" alt="" />
                  </div>
                  <div class="project-member-data">
                    <h5>Ralph Edwards</h5>
                    <a href="#">raines@optonline.com</a>
                  </div>
                </div>
                <div class="project-member-item">
                  <div class="project-member-thumb">
                    <img src="{{ asset('assets/images/all-img/users/one.png') }}" alt="" />
                  </div>
                  <div class="project-member-data">
                    <h5>Devon Lane</h5>
                    <a href="#">gravyface@mac.com</a>
                  </div>
                </div>
                <div class="project-member-item">
                  <div class="project-member-thumb">
                    <img src="{{ asset('assets/images/all-img/users/three.png') }}" alt="" />
                  </div>
                  <div class="project-member-data">
                    <h5>Arlene McCoy</h5>
                    <a href="#">kspiteri@live.com</a>
                  </div>
                </div>
                <div class="project-member-item">
                  <div class="project-member-thumb">
                    <img src="{{ asset('assets/images/all-img/users/one.png') }}" alt="" />
                  </div>
                  <div class="project-member-data">
                    <h5>Jane Cooper</h5>
                    <a href="#">mthurn@optonline.com</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="project-tab">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
              <li class="nav-item" role="presentation">
                <button
                  class="nav-link active"
                  id="home-tab"
                  data-bs-toggle="tab"
                  data-bs-target="#home"
                  type="button"
                  role="tab"
                  aria-controls="home"
                  aria-selected="true"
                >
                  Comments
                </button>
              </li>
              <li class="nav-item" role="presentation">
                <button
                  class="nav-link"
                  id="profile-tab"
                  data-bs-toggle="tab"
                  data-bs-target="#profile"
                  type="button"
                  role="tab"
                  aria-controls="profile"
                  aria-selected="false"
                >
                  Attach File
                </button>
              </li>
            </ul>
            <div class="project-tab-body_s">
              <div class="tab-content" id="myTabContent">
                <div
                  class="tab-pane fade show active"
                  id="home"
                  role="tabpanel"
                  aria-labelledby="home-tab"
                >
                  <div class="post-comment-wrap">
                    <h4 class="rt-mb-30 rt-pt-20">Post Comments</h4>
                    <form action="#">
                      <div class="fromGroup post-comment has-icon mb-4">
                        <div class="form-control-icon">
                          <input
                            class="form-control"
                            type="text"
                            placeholder="Write down your questions and comments..."
                          />
                          <div class="icon-badge-2">
                            <img
                              src="{{ asset('assets/images/svg/chat-circle-dots.svg') }}"
                              alt=""
                            />
                          </div>
                        </div>
                        <button
                          type="button"
                          class="btn btn-primary pill btn-icon"
                        >
                          <span class="button-content-wrapper">
                            <span class="button-icon align-icon-right">
                              <i class="ph-arrow-right"></i>
                            </span>
                            <span class="button-text"> Post </span>
                          </span>
                        </button>
                      </div>
                    </form>
                  </div>
                  <div class="latest-comment-wrap">
                    <h4>Latest Comments</h4>
                    <div class="latest-comment-item">
                      <div class="latest-comment-thumb">
                        <img
                          src="{{ asset('assets/images/all-img/users/three.png') }}"
                          alt=""
                        />
                      </div>
                      <div class="latest-comment-data">
                        <h5>Jane Cooper<span>10 mins ago</span></h5>
                        <p>
                          <a href="#"
                            ><span class="font-medium">@Everyone</span></a
                          >Great Job.
                        </p>
                      </div>
                    </div>
                    <div class="latest-comment-item">
                      <div class="latest-comment-thumb">
                        <img
                          src="{{ asset('assets/images/all-img/users/user1.png') }}"
                          alt=""
                        />
                      </div>
                      <div class="latest-comment-data">
                        <h5>Jane Cooper<span>10 mins ago</span></h5>
                        <p>
                          <a href="#"
                            ><span class="font-medium">@Everyone</span></a
                          >Great Job.
                        </p>
                      </div>
                    </div>
                    <div class="latest-comment-item">
                      <div class="latest-comment-thumb">
                        <img src="{{ asset('assets/images/all-img/users/one.png') }}" alt="" />
                      </div>
                      <div class="latest-comment-data">
                        <h5>Jane Cooper<span>10 mins ago</span></h5>
                        <p>
                          <a href="#"
                            ><span class="font-medium">@Everyone</span></a
                          >Great Job.
                        </p>
                      </div>
                    </div>
                  </div>
                </div>
                <div
                  class="tab-pane fade"
                  id="profile"
                  role="tabpanel"
                  aria-labelledby="profile-tab"
                >
                  <div class="latest-comment-wrap">
                    <div
                      class="upload-file-wrap_2 position-relative text-center"
                    >
                      <img
                        src="{{ asset('assets/images/svg/cloud-arrow-up.svg') }}"
                        alt=""
                        class="rt-mb-30"
                      />
                      <h4>Upload new file or folder</h4>
                      <p>Drag an drop a file or <a href="#">browse file</a></p>
                      <input type="file" />
                    </div>
                  </div>
                </div>
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
