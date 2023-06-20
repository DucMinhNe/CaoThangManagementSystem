@include('admin.layouts.header')

@if(auth()->user()->id_chuc_vu == 1)
@include('admin.layouts.sidebar1')
@elseif(auth()->user()->id_chuc_vu == 2)
@include('admin.layouts.sidebar2')
@endif


@yield('content')


@include('admin.layouts.footer')