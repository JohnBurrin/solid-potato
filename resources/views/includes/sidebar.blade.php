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

          @foreach(App\Models\MenuItem::getTree() as $menuItem)
                     @if($menuItem->children->isEmpty())
                         <li>
                             <a href="{{$menuItem->url()}}">
                                 @if($menuItem->icon)
                                     <i class="fa {{$menuItem->icon}}"></i>
                                 @endif
                                 <span>{{$menuItem->name}}</span>
                             </a>
                         </li>
                     @else
                         <li class="treeview">
                             <a href="#">
                                 @if($menuItem->icon)
                                     <i class="fa {{$menuItem->icon}}"></i>
                                 @endif
                                 <span>{{$menuItem->name}}</span>
                                 <i class="fa fa-angle-left pull-right"></i>
                             </a>
                             <ul class="treeview-menu">
                                 @foreach($menuItem->children as $child)
                                     <li>
                                         <a href="{{$child->url()}}">
                                             @if($child->icon)
                                                 <i class="fa {{$child->icon}}"></i>
                                             @endif
                                             <span>{{$child->name}}</span>
                                         </a>
                                     </li>
                                 @endforeach
                             </ul>
                         </li>
                     @endif
                 @endforeach
          <!-- ======================================= -->
          <!-- <li class="divider"></li> -->
          <!-- <li class="nav-title">Entries</li> -->
        </ul>
      </nav>
      <!-- /.sidebar -->
    </div>
@endif
