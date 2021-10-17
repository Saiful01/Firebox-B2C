<div class="mobile-menu-wrapper">
    <div class="mobile-menu-overlay"></div>
    <!-- End of .mobile-menu-overlay -->

    <a href="#" class="mobile-menu-close"><i class="close-icon"></i></a>
    <!-- End of .mobile-menu-close -->

    <div class="mobile-menu-container scrollable">
        <form action="/search" method="get" class="input-wrapper">
            <input type="text" class="form-control" name="search" autocomplete="off" placeholder="Search"
                   required/>
            <button class="btn btn-search" type="submit">
                <i class="w-icon-search"></i>
            </button>
        </form>
        <!-- End of Search Form -->
        <div class="tab">
            <ul class="nav nav-tabs" role="tablist">
                <li class="nav-item">
                    <a href="#main-menu" class="nav-link active">Main Menu</a>
                </li>
                <li class="nav-item">
                    <a href="#categories" class="nav-link">Categories</a>
                </li>
            </ul>
        </div>
        <div class="tab-content">
            <div class="tab-pane active" id="main-menu">
                <ul class="mobile-menu">
                    <li><a href="/">Home</a></li>
                 {{--  <li>
                                  <a href="/parent-categories/{{$parent_category->parent_category_id}}/{{getTitleToUrl($parent_category->parent_category_name_en)}}">
                                      <i class="w-icon-heartbeat"></i>{{$parent_category->parent_category_name_en}}
                                  </a>
                              </li>--}}




        {{--            <li>
                        <a href="#">Shop</a>
                        <ul>
                            <li> <a href="#">Shop Pages</a> </li>
                            <li>
                                <a href="#">Shop Pages</a>
                                <ul>
                                    <li><a href="shop-banner-sidebar.html">Banner With Sidebar</a></li>
                                    <li><a href="shop-boxed-banner.html">Boxed Banner</a></li>
                                    <li><a href="shop-fullwidth-banner.html">Full Width Banner</a></li>
                                </ul>
                            </li>

                        </ul>
                    </li>--}}

                </ul>
            </div>
            <div class="tab-pane" id="categories">
                <ul class="mobile-menu">
                    @foreach(getCategories(11) as $parent_category)

                        @if(count($parent_category->categories)>0)



                            <li class="">
                                <a href="/parent-categories/{{$parent_category->parent_category_id}}/{{getTitleToUrl($parent_category->parent_category_name_en)}}">
                                    <i class="w-icon-furniture"></i>{{$parent_category->parent_category_name_en}}
                                </a>

                                <ul >

                                    @foreach($parent_category->categories as $category)


                                        <li >
                                            <a href="/categories/{{$category->category_id}}/{{getTitleToUrl($category->category_name_en)}}">{{$category->category_name_en}} </a>
                                        </li>
                                    @endforeach

                                </ul>
                            </li>


                        @else
                            <li>
                                <a href="/parent-categories/{{$parent_category->parent_category_id}}/{{getTitleToUrl($parent_category->parent_category_name_en)}}">
                                    <i class="w-icon-heartbeat"></i>{{$parent_category->parent_category_name_en}}
                                </a>
                            </li>
                        @endif

                    @endforeach
             {{--       <li>
                        <a href="#">Shop</a>
                        <ul>
                            <li> <a href="#">Shop Pages</a> </li>
                            <li>
                                <a href="#">Shop Pages</a>
                                <ul>
                                    <li><a href="shop-banner-sidebar.html">Banner With Sidebar</a></li>
                                    <li><a href="shop-boxed-banner.html">Boxed Banner</a></li>
                                    <li><a href="shop-fullwidth-banner.html">Full Width Banner</a></li>
                                </ul>
                            </li>

                        </ul>
                    </li>--}}


                </ul>
            </div>
        </div>
    </div>
</div>
