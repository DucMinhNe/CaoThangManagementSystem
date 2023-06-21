@extends('admin.layouts.layout')
@section('content')
<div class="form-group">
    <label for="id_lop_hoc_phan">Lớp Học Phần</label>
    <select name="id_lop_hoc_phan" id="id_lop_hoc_phan" class="form-control select2" style="width: 100%;">
        @foreach ($lophocphans as $lophocphan)
        @if ($lophocphan->trang_thai == 1)
        <option value="{{ $lophocphan->id }}">{{ $lophocphan->ten_lop_hoc_phan }}</option>
        @endif
        @endforeach
    </select>
</div>
<section>
    <div class="container">
        <ul class="nav nav-pills nav-pills-bg-soft justify-content-sm-end mb-4 ">
            <a class="btn btn-info" href="javascript:void(0)" id="xemBtn">Xem</a>
        </ul>
        <div class="card-body">
            <table id="example1" class="table table-bordered table-striped data-table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Tên Lớp Học Phần</th>
                        <th>Tên Sinh Viên</th>
                        <th>Chuyên Cần</th>
                        <th>TBKT</th>
                        <th>Thi 1</th>
                        <th>Thi 2</th>
                        <th>Tổng Kết 1</th>
                        <th>Tổng Kết 2</th>
                        <!-- <th width="100px">Hành Động</th> -->
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
</section>
</body>
<script src="{{ asset('plugins/jquery/jquery.js') }}"></script>
<script type="text/javascript">
$(function() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    var editingCell = null;

    $("#xemBtn").click(function() {
        var selectedLopHocPhanId = $("#id_lop_hoc_phan").val();

        var table = $(".data-table").DataTable();
        table.destroy();

        var table = $('.data-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('nhapdiem.index') }}?id_lop_hoc_phan=" + selectedLopHocPhanId,
            columns: [{
                    data: 'id',
                    name: 'id'
                },
                {
                    data: 'ten_lop_hoc_phan',
                    name: 'ten_lop_hoc_phan'
                },
                {
                    data: 'ten_sinh_vien',
                    name: 'ten_sinh_vien'
                },
                {
                    data: 'chuyen_can',
                    name: 'chuyen_can',
                    render: function(data, type, row, meta) {
                        return getEditableCellHtml('chuyen_can', data, row.id);
                    }
                },
                {
                    data: 'tbkt',
                    name: 'tbkt',
                    render: function(data, type, row, meta) {
                        return getEditableCellHtml('tbkt', data, row.id);
                    }
                },
                {
                    data: 'thi_1',
                    name: 'thi_1',
                    render: function(data, type, row, meta) {
                        return getEditableCellHtml('thi_1', data, row.id);
                    }
                },
                {
                    data: 'thi_2',
                    name: 'thi_2',
                    render: function(data, type, row, meta) {
                        return getEditableCellHtml('thi_2', data, row.id);
                    }
                },
                {
                    data: 'tong_ket_1',
                    name: 'tong_ket_1',
                    render: function(data, type, row, meta) {
                        return getEditableCellHtml('tong_ket_1', data, row.id);
                    }
                },
                {
                    data: 'tong_ket_2',
                    name: 'tong_ket_2',
                    render: function(data, type, row, meta) {
                        return getEditableCellHtml('tong_ket_2', data, row.id);
                    }
                }
            ],
            language: {
                "sEmptyTable": "Không có dữ liệu",
                "sInfo": "Hiển thị _START_ đến _END_ của _TOTAL_ bản ghi",
                "sInfoEmpty": "Hiển thị 0 đến 0 của 0 bản ghi",
                "sInfoFiltered": "(được lọc từ _MAX_ tổng số bản ghi)",
                "sInfoPostFix": "",
                "sInfoThousands": ",",
                "sLengthMenu": "Hiển thị _MENU_ bản ghi",
                "sLoadingRecords": "Đang tải...",
                "sProcessing": "Đang xử lý...",
                "sSearch": "Tìm kiếm:",
                "sZeroRecords": "Không tìm thấy kết quả nào phù hợp",
                "oPaginate": {
                    "sFirst": "Đầu",
                    "sLast": "Cuối",
                    "sNext": "Tiếp",
                    "sPrevious": "Trước"
                },
                "oAria": {
                    "sSortAscending": ": Sắp xếp tăng dần",
                    "sSortDescending": ": Sắp xếp giảm dần"
                }
            },
            dom: 'Bfrtip',
            buttons: [{
                    extend: 'copy',
                    text: 'Sao chép'
                },
                {
                    extend: 'excel',
                    text: 'Xuất Excel'
                },
                {
                    extend: 'pdf',
                    text: 'Xuất PDF'
                },
                {
                    extend: 'print',
                    text: 'In'
                },
                {
                    extend: 'colvis',
                    text: 'Hiển thị cột'
                },
                {
                    extend: 'pageLength',
                    text: 'Số bản ghi trên trang'
                }
            ],
        });
    });

    function getEditableCellHtml(columnName, value, id) {
        return `<div class="editable-cell" data-column="${columnName}" data-id="${id}" contenteditable>${value}</div>`;
    }

    $(document).on('keyup', '.editable-cell', function(e) {
        if (e.keyCode === 13) {
            var column = $(this).data('column');
            var id = $(this).data('id');
            var value = $(this).text();
            saveCellValue(column, id, value);
        }
    });
    $(document).on('blur', '.editable-cell', function() {
        var column = $(this).data('column');
        var id = $(this).data('id');
        var value = $(this).text();
        saveCellValue(column, id, value);
    });

    function saveCellValue(column, id, value) {
        $.ajax({
            url: "{{ route('nhapdiem.store') }}",
            method: "POST",
            data: {
                _token: "{{ csrf_token() }}",
                id: id,
                column: column,
                value: value
            },
            success: function(response) {
                console.log(response);
            },
            error: function(xhr) {
                console.log(xhr.responseText);
            }
        });
    }
});
</script>
@endsection