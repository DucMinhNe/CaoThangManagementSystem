@include('admin.layouts.header')
@if(auth()->user()->id_chuc_vu == 1)
@include('admin.layouts.sidebar1')
@elseif(auth()->user()->id_chuc_vu == 2)
@include('admin.layouts.sidebar2')
@elseif(auth()->user()->id_chuc_vu == 3)
@include('admin.layouts.sidebar3')
@endif
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
        </div><!-- /.container-fluid -->
    </div>
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <div class="row" style="margin-right: 12rem ; margin-left: 12rem;">
                <div class="col-lg-6 col-6">
                    <!-- small box -->
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3 id="so-sinh-vien">Đang Tải ...</h3>
                            <p>Học Sinh</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-graduation-cap"></i>
                        </div>
                        <a href="#" class="small-box-footer">Xem chi tiết <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-6 col-6">
                    <!-- small box -->
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3 id="so-giang-vien">Đang Tải ...</h3>
                            <p>Giảng Viên</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-person-chalkboard"></i>
                        </div>
                        <a href="#" class="small-box-footer">Xem chi tiết <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->

                <!-- ./col -->
            </div>
            <!-- /.row -->
            <!-- Main row -->
            <!-- /.row (main row) -->
        </div><!-- /.container-fluid -->
    </section>
    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel"
        style="margin-right: 15rem ; margin-left: 15rem;">
        <ol class="carousel-indicators">
            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img class="d-block w-100" src="{{ asset('dist/img/slide1.jpg') }}" alt="First slide">
            </div>
            <div class="carousel-item">
                <img class="d-block w-100" src="{{ asset('dist/img/slide2.jpg') }}" alt="Second slide">
            </div>
            <div class="carousel-item">
                <img class="d-block w-100" src="{{ asset('dist/img/slide3.jpg') }}" alt="Third slide">
            </div>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
            <span class="carousel-control-custom-icon" aria-hidden="true">
                <i class="fas fa-chevron-left"></i>
            </span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
            <span class="carousel-control-custom-icon" aria-hidden="true">
                <i class="fas fa-chevron-right"></i>
            </span>
            <span class="sr-only">Next</span>
        </a>
    </div>
    <div class="text-center" style="margin-top: 1rem">
        <h1>Cao Thắng Management System</h1>
    </div>

    <!-- /.content -->
    <!-- /.content-header -->
    <!-- Main content -->
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<script src="{{ asset('plugins/jquery/jquery.js') }}"></script>
<script type="text/javascript">
$(function() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $(document).ready(function() {
        $.ajax({
            url: '{{ route("lay-tong-sinh-vien") }}',
            type: 'GET',
            success: function(response) {
                var tongSinhViens = response.tongSinhViens;
                $('#so-sinh-vien').text(tongSinhViens);
            },
            error: function(xhr) {
                console.log(xhr.responseText);
            }
        });
        $.ajax({
            url: '{{ route("lay-tong-giang-vien") }}',
            type: 'GET',
            success: function(response) {
                var tongGiangViens = response.tongGiangViens;
                $('#so-giang-vien').text(tongGiangViens);
            },
            error: function(xhr) {
                console.log(xhr.responseText);
            }
        });
    });

});
</script>
@include('admin.layouts.footer')