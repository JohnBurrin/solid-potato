@extends( ($isadmin )  ?   backpack_view('layouts.top_left')  : 'layouts.top_left' )
    @section('content')
        @php
         echo $page->content;
        @endphp
        <a href="{{ route('dashboard') }}">Back</a>
    @endsection
