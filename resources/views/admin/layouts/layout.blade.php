@include('admin.layouts.header')
@if(auth()->user()->id_chuc_vu == 1)
@include('admin.layouts.sidebar1')
@elseif(auth()->user()->id_chuc_vu == 2)
@include('admin.layouts.sidebar2')
@elseif(auth()->user()->id_chuc_vu == 3)
@include('admin.layouts.sidebar3')
@endif
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <div class="container">
                        @yield('content')
                    </div>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
</div>
@include('admin.layouts.footer')