@if (backpack_auth()->check())
    <!-- Left side column. contains the sidebar -->
    <div class="{{ config('backpack.base.sidebar_class') }}">
      <!-- sidebar: style can be found in sidebar.less -->
      <nav class="sidebar-nav overflow-hidden">
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="nav">
          <!-- <li class="nav-title">{{ trans('backpack::base.administration') }}</li> -->
          <!-- ================================================ -->
          <!-- ==== Recommended place for admin menu items ==== -->
          <!-- ================================================ -->
          <li class="nav-item">
              <a class="nav-link" href="/">
                  <i class="la la-home nav-icon"></i>
                  Home
              </a>
          </li>

        @foreach ($pages as $page)
            <li class="nav-item">
                <a class="nav-link" href="/{{ $page->slug }}">
                    <i class="la la-file-alt nav-icon"></i>
                    {{ $page->name }}
                </a>
            </li>
        @endforeach
          <!-- ======================================= -->
          <!-- <li class="divider"></li> -->
          <!-- <li class="nav-title">Entries</li> -->
        </ul>
      </nav>
      <!-- /.sidebar -->
    </div>
@endif
