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

          @foreach (Backpack\MenuCRUD\app\Models\MenuItem::getTree(); as $item)
            <a class="no-underline hover:underline p-3"
               href="{{$item->url()}}">
               {{ $item->name }}
            </a>
          @endforeach
          <!-- ======================================= -->
          <!-- <li class="divider"></li> -->
          <!-- <li class="nav-title">Entries</li> -->
        </ul>
      </nav>
      <!-- /.sidebar -->
    </div>
@endif
