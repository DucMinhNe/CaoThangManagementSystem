  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->
      <a href="/" class="brand-link">
          <img src="{{ asset('dist/img/caothang.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
              style="opacity: .8">
          <span class="brand-text font-weight-light">Cao Thắng</span>
      </a>

      <!-- Sidebar -->
      <div class="sidebar">
          <!-- Sidebar user panel (optional) -->
          <div class="user-panel mt-3 pb-3 mb-3 d-flex">
              <div class="image">
                  <img src="{{ asset('dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2" alt="User Image">
              </div>
              <div class="info">
                  <a href="#" class="d-block"> {{auth()->user()->tai_khoan}}</a>
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
                  <li class="nav-item">
                      <a href="#" class="nav-link">
                          <i class="nav-icon fas fa-chart-pie"></i>
                          <p>
                              Quản Lý Sinh Viên
                              <i class="right fas fa-angle-left"></i>
                          </p>
                      </a>
                      <ul class="nav nav-treeview">
                          <li class="nav-item">
                              <a href="{{ url('/admin/sinhvien') }}"
                                  class="nav-link {{ Request::url() == url('/admin/sinhvien') ? 'active' : '' }}">
                                  <i class="nav-icon fas fa-users"></i>
                                  <p>Sinh Viên</p>
                              </a>
                          </li>
                          <li class="nav-item">
                              <a href="{{ url('/admin/chucvusinhvien') }}"
                                  class="nav-link {{ Request::url() == url('/admin/chucvusinhvien') ? 'active' : '' }}">
                                  <i class="nav-icon fas fa-users"></i>
                                  <p>Chức Vụ Sinh Viên</p>
                              </a>
                          </li>
                          <li class="nav-item">
                              <a href="{{ url('/admin/danhsachchucvusinhvien') }}"
                                  class="nav-link {{ Request::url() == url('/admin/danhsachchucvusinhvien') ? 'active' : '' }}">
                                  <i class="nav-icon fas fa-users"></i>
                                  <p>DS Chức Vụ Sinh Viên</p>
                              </a>
                          </li>
                      </ul>
                  </li>
                  <li class="nav-item">
                      <a href="#" class="nav-link">
                          <i class="nav-icon fas fa-chart-pie"></i>
                          <p>
                              Quản Lý Giảng Viên
                              <i class="right fas fa-angle-left"></i>
                          </p>
                      </a>
                      <ul class="nav nav-treeview">
                          <li class="nav-item">
                              <a href="{{ url('/admin/taikhoangiangvien') }}"
                                  class="nav-link {{ Request::url() == url('/admin/taikhoangiangvien') ? 'active' : '' }}">
                                  <i class="nav-icon fas fa-users"></i>
                                  <p>Tài Khoản Giảng Viên</p>
                              </a>
                          </li>
                          <li class="nav-item">
                              <a href="{{ url('/admin/giangvien') }}"
                                  class="nav-link {{ Request::url() == url('/admin/giangvien') ? 'active' : '' }}">
                                  <i class="nav-icon fas fa-users"></i>
                                  <p>Giảng Viên</p>
                              </a>
                          </li>
                          <li class="nav-item">
                              <a href="{{ url('/admin/chucvugiangvien') }}"
                                  class="nav-link {{ Request::url() == url('/admin/chucvugiangvien') ? 'active' : '' }}">
                                  <i class="nav-icon fas fa-users"></i>
                                  <p>Chức Vụ Giảng Viên</p>
                              </a>
                          </li>
                          <li class="nav-item">
                              <a href="{{ url('/admin/danhsachchucvugiangvien') }}"
                                  class="nav-link {{ Request::url() == url('/admin/danhsachchucvugiangvien') ? 'active' : '' }}">
                                  <i class="nav-icon fas fa-users"></i>
                                  <p>DS Chức Vụ Giảng Viên</p>
                              </a>
                          </li>
                      </ul>
                  </li>
                  <li class="nav-item">
                      <a href="{{ url('/admin/khoa') }}"
                          class="nav-link {{ Request::url() == url('/admin/khoa') ? 'active' : '' }}">
                          <i class="nav-icon fas fa-users"></i>
                          <p>Khoa</p>
                      </a>
                  </li>
                  <li class="nav-item">
                      <a href="{{ url('/admin/bomon') }}"
                          class="nav-link {{ Request::url() == url('/admin/bomon') ? 'active' : '' }}">
                          <i class="nav-icon fas fa-users"></i>
                          <p>Bộ Môn</p>
                      </a>
                  </li>
                  <li class="nav-item">
                      <a href="{{ url('/admin/loaimonhoc') }}"
                          class="nav-link {{ Request::url() == url('/admin/loaimonhoc') ? 'active' : '' }}">
                          <i class="nav-icon fas fa-users"></i>
                          <p>Loại Môn Học</p>
                      </a>
                  </li>
                  <li class="nav-item">
                      <a href="{{ url('/admin/monhoc') }}"
                          class="nav-link {{ Request::url() == url('/admin/monhoc') ? 'active' : '' }}">
                          <i class="nav-icon fas fa-users"></i>
                          <p>Môn Học</p>
                      </a>
                  </li>
                  <li class="nav-item">
                      <a href="{{ url('/admin/chuyennganh') }}"
                          class="nav-link {{ Request::url() == url('/admin/chuyennganh') ? 'active' : '' }}">
                          <i class="nav-icon fas fa-users"></i>
                          <p>Chuyên Ngành</p>
                      </a>
                  </li>
                  <li class="nav-item">
                      <a href="{{ url('/admin/lophoc') }}"
                          class="nav-link {{ Request::url() == url('/admin/lophoc') ? 'active' : '' }}">
                          <i class="nav-icon fas fa-users"></i>
                          <p>Lớp Học</p>
                      </a>
                  </li>
                  <li class="nav-item">
                      <a href="{{ url('/admin/loaiphong') }}"
                          class="nav-link {{ Request::url() == url('/admin/loaiphong') ? 'active' : '' }}">
                          <i class="nav-icon fas fa-users"></i>
                          <p>Loại Phòng</p>
                      </a>
                  </li>
                  <li class="nav-item">
                      <a href="{{ url('/admin/phong') }}"
                          class="nav-link {{ Request::url() == url('/admin/phong') ? 'active' : '' }}">
                          <i class="nav-icon fas fa-users"></i>
                          <p>Phòng</p>
                      </a>
                  </li>
                  <li class="nav-item">
                      <a href="{{ url('/admin/quyetdinh') }}"
                          class="nav-link {{ Request::url() == url('/admin/quyetdinh') ? 'active' : '' }}">
                          <i class="nav-icon fas fa-users"></i>
                          <p>Quyết Định</p>
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