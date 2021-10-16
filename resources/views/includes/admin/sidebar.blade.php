<div class="vertical-menu">

    <div data-simplebar class="h-100">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title">Menu</li>


                <li>
                    <a href="/admin/dashboard" class=" waves-effect">
                        <i class="bx bx-home-circle"></i>
                        <span>Dashboard</span>
                    </a>
                </li>

              {{--  <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="bx bx-list-check"></i>
                        <span>Whole Sales Product</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="/admin/whole-sale/product/create">New Product</a></li>
                        <li><a href="/admin/whole-sale/product/show">View Product</a></li>
                        <li><a href="/admin/whole-sale/category/create">New Category</a></li>
                        <li><a href="/admin/whole-sale/category/show">View Category</a></li>
                        <li><a href="/admin/whole-sale/sub-category/create">New Sub Category</a></li>
                        <li><a href="/admin/whole-sale/sub-category/show">View Sub Category</a></li>

                    </ul>
                </li>--}}

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="bx bx-list-check"></i>
                        <span>Manage Product</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="/admin/product/create">New Product</a></li>
                        <li><a href="/admin/product/show">View Product</a></li>
                        @if(\Illuminate\Support\Facades\Auth::user()->user_type==1)
                            <li><a href="/admin/parent-category/create">New Parent Category</a></li>
                            <li><a href="/admin/parent-category/show">View Parent Category</a></li>
                            <li><a href="/admin/category/create">New Category</a></li>
                            <li><a href="/admin/category/show">View Category</a></li>
                            <li><a href="/admin/sub-category/create">New Sub Category</a></li>
                            <li><a href="/admin/sub-category/show">View Sub Category</a></li>
                        @endif
                    </ul>
                </li>


                {{--        <li>
                            <a href="/company/order/show" class=" waves-effect">
                                <i class="bx bx-cart"></i>
                                <span>Manage Order</span>
                            </a>
                        </li>--}}


                <li>
                    <a href="/admin/order/show" class=" waves-effect">
                        <i class="bx bx-cart"></i>
                        <span>Manage Order</span>
                    </a>
                </li>
                @if(\Illuminate\Support\Facades\Auth::user()->user_type==1)
                {{--    <li>
                        <a href="" class=" waves-effect">
                            <i class="bx bx-store"></i>
                            <span>Shop Report</span>
                        </a>
                    </li>--}}

                    <li>
                        <a href="javascript: void(0);" class="has-arrow waves-effect">
                            <i class="bx bx-stats"></i>
                            <span>Report</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            <li><a href="/admin/report/show">Commission Report</a></li>
                         {{--   <li><a href="#">View Product</a></li>--}}

                        </ul>
                    </li>


                   {{-- <li>
                        <a href="/admin/shop/show" class=" waves-effect">
                            <i class="bx bx-store"></i>
                            <span>Manage Shop</span>
                        </a>
                    </li>--}}
                    <li>
                        <a href="/admin/brand/show" class=" waves-effect">
                            <i class="bx bx-store"></i>
                            <span>Manage Brand</span>
                        </a>
                    </li>
                    <li>
                        <a href="/admin/size/show" class=" waves-effect">
                            <i class="bx bx-font-size"></i>
                            <span>Manage Size</span>
                        </a>
                    </li>
                    <li>
                        <a href="/admin/color/show" class=" waves-effect">
                            <i class="bx bx-font-color"></i>
                            <span>Manage Color</span>
                        </a>
                    </li>
                   {{-- <li>
                        <a href="/admin/slider/show" class=" waves-effect">
                            <i class="bx bx-store"></i>
                            <span>Manage Slider</span>
                        </a>
                    </li>--}}
                    <li>
                        <a href="/admin/promotional-slider/show" class=" waves-effect">
                            <i class="bx bx-slider"></i>
                            <span> Promotional Slider</span>
                        </a>
                    </li>



                    <li class="menu-title">User</li>

                    <li>
                        <a href="/admin/customer/show" class=" waves-effect">
                            <i class="bx bx-user"></i>
                            <span>Manage Customers</span>
                        </a>
                    </li>
                @endif

                <li>
                    <a href="/admin/user/show" class=" waves-effect">
                        <i class="bx bx-user-circle"></i>
                        <span>Manage User</span>
                    </a>
                </li>
                {{--     <li>
                         <a href="/admin/hat/show" class=" waves-effect">
                             <i class="bx bx-user"></i>
                             <span>Payment Info</span>
                         </a>
                     </li>--}}

                @if(\Illuminate\Support\Facades\Auth::user()->user_type==1)
                    <li class="menu-title">Settings</li>
                    <li>
                        <a href="/admin/coupon/show" class=" waves-effect">
                            <i class="bx bxs-offer"></i>
                            <span>Manage Coupon</span>
                        </a>
                    </li>



                @endif
                {{-- <li>
                    <a href="/admin/user/show" class=" waves-effect">
                        <i class="bx bx-store"></i>
                        <span>Manage User</span>
                    </a>
                </li> --}}

               {{-- <li>
                    <a href="/admin/shop/create" class=" waves-effect">
                        <i class="bx bx-wrench"></i>
                        <span>New Shop</span>
                    </a>
                </li>--}}
                <li>
                    <a href="/admin/video/show" class=" waves-effect">
                        <i class="bx bx-video"></i>
                        <span>Video Tutorial</span>
                    </a>
                </li>
                <li>
                    <a href="/admin/app/setting" class=" waves-effect">
                        <i class="bx bx-wrench"></i>
                        <span>App Setting</span>
                    </a>
                </li>

                <li>
                    <a href="/admin/profile" class=" waves-effect">
                        <i class="bx bx-user-pin"></i>
                        <span>Profile</span>
                    </a>
                </li>

                <li>
                    <a href="/admin/logout" class=" waves-effect">
                        <i class="bx bx-log-out"></i>
                        <span>Logout</span>
                    </a>
                </li>


                {{--@if(\Illuminate\Support\Facades\Auth::user()->user_type==1)
                    <li class="menu-title">Delivery</li>
                    <li>
                        <a href="/admin/delivery-charge/create/" class=" waves-effect">
                            <i class="bx bxs-offer"></i>
                            <span>Manage Delivery System</span>
                        </a>
                    </li>
                @endif--}}

            </ul>
        </div>

        <!-- Sidebar -->
    </div>
</div>
