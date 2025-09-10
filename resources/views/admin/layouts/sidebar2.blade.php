  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->
      <a href="/" class="brand-link">
          <img src="{{ asset('dist/img/logo_caothang.jpg') }}" alt="AdminLTE Logo" class="brand-image img elevation-3"
              style="opacity: .8 ;width: 25px; height: 45px">
          <span class="brand-text font-weight-light">Education</span>
      </a>

      <!-- Sidebar -->
      <div class="sidebar">
          <!-- Sidebar user panel (optional) -->
          <div class="user-panel mt-2 pb-2 mb-2 d-flex">
              <div class="image">
                  @php
                  $hinhAnhDaiDien = auth()->user()->hinh_anh_dai_dien ? asset('giangvien_img/' .
                  auth()->user()->hinh_anh_dai_dien) : asset('dist/img/user2-160x160.jpg');
                  @endphp
                  <img src="{{ $hinhAnhDaiDien }}" class="img-circle elevation-2" alt="User Image"
                      style="opacity: .8 ;width: 31px; height: 38px">
                  <!-- <img src="{{ asset('giangvien_img/' . auth()->user()->hinh_anh_dai_dien) }}"
                      class="img-circle elevation-2" alt="User Image"> -->
                  <!-- <img src="{{ asset('dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2" alt="User Image"> -->
              </div>
              <div class="info">
                  <a href="/admin/thongtincanhan" class="d-block"> {{auth()->user()->ten_giang_vien}}</a>
              </div>
          </div>
          <!-- SidebarSearch Form -->
          <div class="form-inline">
              <div class="input-group" data-widget="sidebar-search">
                  <input class="form-control form-control-sidebar" type="search" placeholder="Tìm Kiếm"
                      aria-label="Search">
                  <div class="input-group-append">
                      <button class="btn btn-sidebar">
                          <i class="fas fa-search fa-fw"></i>
                      </button>
                  </div>
              </div>
          </div>

          <!-- Sidebar Menu -->
          <nav class="mt-2">
              <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                  data-accordion="false">
                  <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                  <li class="nav-item">
                      <a href="/admin" class="nav-link {{ Request::is('admin') ? 'active' :''}}">
                          <i class="nav-icon fas fa-duotone fa-house"></i>
                          <p>Trang Chủ</p>
                      </a>
                  </li>
                  @php
                  $isOpen = Request::is('admin/sinhvien') || Request::is('admin/chucvusinhvien') ||
                  Request::is('admin/danhsachchucvusinhvien') || Request::is('admin/lophoc');
                  @endphp
                  <li class="nav-item {{ $isOpen ? 'menu-open' : '' }} ">
                      <a href="#" class="nav-link">
                          <i class="nav-icon fas fa-graduation-cap"></i>
                          <p>
                              Quản Lý Sinh Viên
                              <i class="right fas fa-angle-left"></i>
                          </p>
                      </a>
                      <ul class="nav nav-treeview">
                          <li class="nav-item">
                              <a href="{{ url('/admin/sinhvien') }}"
                                  class="nav-link {{ Request::url() == url('/admin/sinhvien') ? 'active' : '' }}">
                                  <!-- <i class="nav-icon fas fa-graduation-cap"></i> -->
                                  <i class="far fa-circle nav-icon"></i>
                                  <p>Sinh Viên</p>
                              </a>
                          </li>
                          <li class="nav-item">
                              <a href="{{ url('/admin/chucvusinhvien') }}"
                                  class="nav-link {{ Request::url() == url('/admin/chucvusinhvien') ? 'active' : '' }}">
                                  <!-- <i class="nav-icon fas fa-users"></i> -->
                                  <i class="far fa-circle nav-icon"></i>
                                  <p>Chức Vụ Sinh Viên</p>
                              </a>
                          </li>
                          <li class="nav-item">
                              <a href="{{ url('/admin/danhsachchucvusinhvien') }}"
                                  class="nav-link {{ Request::url() == url('/admin/danhsachchucvusinhvien') ? 'active' : '' }}">
                                  <!-- <i class="nav-icon fas fa-users"></i> -->
                                  <i class="far fa-circle nav-icon"></i>
                                  <p>DS Chức Vụ Sinh Viên</p>
                              </a>
                          </li>
                          <li class="nav-item">
                              <a href="{{ url('/admin/lophoc') }}"
                                  class="nav-link {{ Request::url() == url('/admin/lophoc') ? 'active' : '' }}">
                                  <!-- <i class="nav-icon fas fa-users"></i> -->
                                  <i class="far fa-circle nav-icon"></i>
                                  <p>Lớp Học</p>
                              </a>
                          </li>
                      </ul>
                  </li>
                  @php
                  $isOpen = Request::is('admin/khoa') || Request::is('admin/chuyennganh') ||
                  Request::is('admin/chuongtrinhdaotao') || Request::is('admin/ctchuongtrinhdaotao')||
                  Request::is('admin/lophocphan')|| Request::is('admin/ctlophocphan')||
                  Request::is('admin/bomon') || Request::is('admin/loaimonhoc')|| Request::is('admin/monhoc');
                  @endphp
                  <li class="nav-item {{ $isOpen ? 'menu-open' : '' }}">
                      <a href="#" class="nav-link">
                          <i class="nav-icon fas fa-school"></i>
                          <p>
                              Quản Lý Đào Tạo
                              <i class="right fas fa-angle-left"></i>
                          </p>
                      </a>
                      <ul class="nav nav-treeview">
                          <li class="nav-item">
                              <a href="{{ url('/admin/khoa') }}"
                                  class="nav-link {{ Request::url() == url('/admin/khoa') ? 'active' : '' }}">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p>Khoa</p>
                              </a>
                          </li>
                          <li class="nav-item">
                              <a href="{{ url('/admin/chuyennganh') }}"
                                  class="nav-link {{ Request::url() == url('/admin/chuyennganh') ? 'active' : '' }}">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p>Chuyên Ngành</p>
                              </a>
                          </li>

                          <li class="nav-item">
                              <a href="{{ url('/admin/chuongtrinhdaotao') }}"
                                  class="nav-link {{ Request::url() == url('/admin/chuongtrinhdaotao') ? 'active' : '' }}">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p>Chương Trình Đào Tạo</p>
                              </a>
                          </li>
                          <li class="nav-item">
                              <a href="{{ url('/admin/ctchuongtrinhdaotao') }}"
                                  class="nav-link {{ Request::url() == url('/admin/ctchuongtrinhdaotao') ? 'active' : '' }}">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p>CT Chương Trình Đạo Tạo</p>
                              </a>
                          </li>
                          <li class="nav-item">
                              <a href="{{ url('/admin/lophocphan') }}"
                                  class="nav-link {{ Request::url() == url('/admin/lophocphan') ? 'active' : '' }}">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p>Lớp Học Phần</p>
                              </a>
                          </li>
                          <li class="nav-item">
                              <a href="{{ url('/admin/ctlophocphan') }}"
                                  class="nav-link {{ Request::url() == url('/admin/ctlophocphan') ? 'active' : '' }}">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p>CT Lớp Học Phần</p>
                              </a>
                          </li>
                          <li class="nav-item">
                              <a href="{{ url('/admin/bomon') }}"
                                  class="nav-link {{ Request::url() == url('/admin/bomon') ? 'active' : '' }}">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p>Bộ Môn</p>
                              </a>
                          </li>
                          <li class="nav-item">
                              <a href="{{ url('/admin/monhoc') }}"
                                  class="nav-link {{ Request::url() == url('/admin/monhoc') ? 'active' : '' }}">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p>Môn Học</p>
                              </a>
                          </li>
                          <li class="nav-item">
                              <a href="{{ url('/admin/loaimonhoc') }}"
                                  class="nav-link {{ Request::url() == url('/admin/loaimonhoc') ? 'active' : '' }}">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p>Loại Môn Học</p>
                              </a>
                          </li>
                      </ul>
                  </li>

                  @php
                  $isOpen = Request::is('admin/quyetdinh') || Request::is('admin/ctquyetdinh');
                  @endphp
                  <li class="nav-item {{ $isOpen ? 'menu-open' : '' }}">
                      <a href="#" class="nav-link">
                          <i class="nav-icon fas fa-pen-to-square"></i>
                          <p>
                              Quản Lý Quyết Định
                              <i class="right fas fa-angle-left"></i>
                          </p>
                      </a>
                      <ul class="nav nav-treeview">
                          <li class="nav-item">
                              <a href="{{ url('/admin/quyetdinh') }}"
                                  class="nav-link {{ Request::url() == url('/admin/quyetdinh') ? 'active' : '' }}">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p>Quyết Định</p>
                              </a>
                          </li>
                          <li class="nav-item">
                              <a href="{{ url('/admin/ctquyetdinh') }}"
                                  class="nav-link {{ Request::url() == url('/admin/ctquyetdinh') ? 'active' : '' }}">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p>Chi Tiết Quyết Định</p>
                              </a>
                          </li>

                      </ul>
                  </li>
                  <li class="nav-item">
                      <a href="{{ url('/admin/nhapdiem') }}"
                          class="nav-link {{ Request::url() == url('/admin/nhapdiem') ? 'active' : '' }}">
                          <i class="nav-icon fas fa-award"></i>
                          <p>Nhập Điểm</p>
                      </a>
                  </li>
                  <li class="nav-item">
                      <a href="{{ url('/admin/xettotnghiep') }}"
                          class="nav-link {{ Request::url() == url('/admin/xettotnghiep') ? 'active' : '' }}">
                          <i class="nav-icon fas fa-user-graduate"></i>
                          <p>Kết Quả Học Tập</p>
                      </a>
                  </li>
                  <li class="nav-item">
                      <a href="/admin/dangxuat" class="nav-link">
                          <i class="nav-icon fas fa-right-from-bracket"></i>
                          <p>Đăng Xuất</p>
                      </a>
                  </li>

              </ul>
          </nav>
          <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
  </aside>