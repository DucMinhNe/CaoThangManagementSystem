@extends('students.layout')
@section('content_student')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h2>Sinh Viên</h2>
                    </div>
                    <div class="card-body">
                        <a href="{{ url('/student/create') }}" class="btn btn-success btn-sm" title="Add New student">
                            <i class="fa fa-plus" aria-hidden="true"></i> Thêm Sinh Viên
                        </a>
                        <br/>
                        <br/>
                        <div class="table-responsive">
                            <table class="table" >
                                <thead>
                                    <tr>
                                        <th>MSSV</th>
                                        <th>Tên Học Sinh</th>
                                        <th>Lớp</th>
                                        <th>Email</th>
                                        <th>CMND</th>   
                                        <th>Số Điện Thoại</th>
                                        <th>Ngày Sinh</th>
                                        <th>Giới Tính</th>
                                        <th>Hình Đại Diện</th>
                                        <th>Trạng Thái</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($students as $item)
                                    <tr>
                                        <td>{{ $item->mssv}}</td>
                                        <td><a href="{{ url('/student/' . $item->id . '/edit') }}">{{ $item->hoten }}</a></td>
                                        <td>{{ $item->lop}}</td>
                                        <td>{{ $item->email}}</td>
                                        <td>{{ $item->cmnd}}</td>
                                        <td>{{ $item->sdt}}</td>
                                        <td>{{ $item->ngaysinh}}</td>
                                        <td>{{ $item->gioitinh}}</td>
                                        <td><img src="/images/{{ $item->hinhdaidien }}" width="100px"></td>
                                        <!-- <td>{{ $item->hinhdaidien}}</td> -->
                                        <td>
                                        @if ($item->trangthai)
                                        <span style="color: green;">Hoạt Động</span>
                                        @else
                                        <span style="color: red;">Không Hoạt Động</span>
                                        @endif
                                        </td>
                                        <td>
                                            <!-- <a href="{{ url('/student/' . $item->id) }}" title="View student"><button class="btn btn-info btn-sm"><i class="fa fa-eye" aria-hidden="true"></i> Chi Tiết</button></a> -->
                                            <a href="{{ url('/student/' . $item->id . '/edit') }}" title="Edit student"><button class="btn btn-info btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Sửa</button></a>
                                            <form action="{{ url('student/' .$item->id) }}" method="post" accept-charset="UTF-8" style="display:inline">
                                                {{ method_field('PATCH') }}
                                                {{ csrf_field() }}
                                                @if ($item->trangthai == 1)
                                                <input type="hidden" name="trangthai" id="trangthai" value="0">
                                                @else
                                                <input type="hidden" name="trangthai" id="trangthai" value="1">
                                                @endif
                                                <button type="submit" class="btn btn-primary btn-sm"> Ẩn/Hiện</button>
                                            </form>
                                           
                                            <form method="POST" action="{{ url('/student' . '/' . $item->id) }}" accept-charset="UTF-8" style="display:inline">
                                                {{ method_field('DELETE') }}
                                                {{ csrf_field() }}
                                                <button type="submit" class="btn btn-danger btn-sm" title="Delete student" onclick="return confirm(&quot;Xác Nhận Xóa?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Xóa</button>
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
    </div>
@endsection