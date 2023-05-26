@extends('admin.giangviens.layout')
@section('content_giangvien')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Thêm Học Sinh</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ url('/student') }}"> Trở Lại</a>
        </div>
    </div>
</div>
 
<form action="{{ url('student') }}" method="POST" enctype="multipart/form-data">
    {!! csrf_field() !!}
     <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-5">
            <div class="form-group">
                <strong>MSSV:</strong>
                <input type="text" name="mssv" id="mssv" class="form-control" placeholder="Name">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-5">
            <div class="form-group">
                <strong>Họ Tên:</strong>
                <input type="text" name="hoten" id="hoten" class="form-control" placeholder="Name">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-5">
            <div class="form-group">
                <strong>Lớp:</strong>
                <input type="text" name="lop" id="lop" class="form-control" placeholder="Name">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-5">
            <div class="form-group">
                <strong>Email:</strong>
                <input type="text" name="email" id="email" class="form-control" placeholder="Name">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-5">
            <div class="form-group">
                <strong>CMND:</strong>
                <input type="text" name="cmnd" id="cmnd" class="form-control" placeholder="Name">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-5">
            <div class="form-group">
                <strong>SDT:</strong>
                <input type="text" name="sdt" id="sdt" class="form-control" placeholder="Name">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-5">
            <div class="form-group">
                <strong>Ngày Sinh:</strong>
                <input type="date" name="ngaysinh" id="ngaysinh" class="form-control" placeholder="Name">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-5">
            <div class="form-group">
                <strong>Giới Tính</strong>
                <input type="text" name="gioitinh" id="gioitinh" class="form-control" placeholder="Name">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-5">
            <div class="form-group">
                <strong>Image:</strong>
                <input type="file" name="hinhdaidien" id="hinhdaidien" class="form-control" placeholder="image">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-5">
            <div class="form-group">
                <strong>Trạng Thái:</strong>
                <input type="number" name="trangthai" id="trangthai" class="form-control" placeholder="Name">
            </div>
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-1 text-center">
                <button type="submit" class="btn btn-primary">Submit</button>
        </div>
</form>
@endsection