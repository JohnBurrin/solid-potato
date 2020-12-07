@extends( ($isadmin )  ?   backpack_view('layouts.top_left')  : 'layouts.top_left' )

@section('after_styles')
    <style media="screen">
        .backpack-profile-form .required::after {
            content: ' *';
            color: red;
        }
    </style>
@endsection

@php
  $breadcrumbs = [
      trans('backpack::crud.admin') => url(config('backpack.base.route_prefix'), 'dashboard'),
      'dashboard' => false,
  ];
@endphp

@section('content')
<div class="container">

    <div class="row">
        <div class="card w-100">
            <div class="card-header">
                New Pages
            </div>
            <div class="card-body">
                <ul class="list-group list-group-flush">
                    @if (count($newpages) > 0)
                        @foreach ($newpages as $lineitem)
                            <li class="list-group-item"><a href="{{ $lineitem->slug }}">{{ $lineitem->title }}</a></li>
                        @endforeach
                    @endif
                </ul>
            </div>
        </div>
    </div>

<div class="row">
    <div class="card w-50">
        <div class="card-header">
            Featured Pages
        </div>
        <div class="card-body">
            <ul class="list-group list-group-flush">
                @foreach ($featured as $lineitem)
                    <li class="list-group-item"><a href="{{ $lineitem->slug }}">{{ $lineitem->title }}</a></li>
                @endforeach
            </ul>
        </div>
</div>
    <div class="card w-50">
        <div class="card-header">
            Recently Updated
        </div>
        <div class="card-body">
            <ul class="list-group list-group-flush">
                @foreach ($latest as $lineitem)
                    <li class="list-group-item"><a href="{{ $lineitem->slug }}">{{ $lineitem->title }}</a></li>
                @endforeach
            </ul>
        </div>
    </div>
  </div>
  <div class="row">
      <div class="card w-100">
          <div class="card-header">
              My Recent Drafts
          </div>
          <div class="card-body">
              <ul class="list-group list-group-flush">
                  @if (count($mydrafts) > 0)
                      @foreach ($mydrafts as $lineitem)
                          <li class="list-group-item"><a href="{{ $lineitem->slug }}">{{ $lineitem->title }}</a></li>
                      @endforeach
                  @endif
              </ul>
          </div>
      </div>
  </div>
</div>
@endsection
