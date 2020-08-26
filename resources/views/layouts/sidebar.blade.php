    <!-- START: Main Menu-->
    <div class="sidebar">
        <a href="#" class="sidebarCollapse float-right h6 dropdown-menu-right mr-2 mt-2 position-absolute d-block d-lg-none">
            <i class="icon-close"></i>
        </a>
        <!-- START: Logo-->
        <a href="index.html" class="sidebar-logo d-flex">
            <img src="{{ asset('dist/images/logo.png') }}" alt="logo" width="25" class="img-fluid mr-2"/>
            <span class="h5 align-self-center mb-0">CMS</span>        
        </a>
        <!-- END: Logo-->

        <!-- START: Menu-->
        <ul id="side-menu" class="sidebar-menu">
            <li class="dropdown"><a href="/"><i class="icon-speedometer"></i> @lang('admin.dashboard')</a> 
               
            </li>
        <li class="dropdown {{active('admins')}}"><a href="{{ aurl('admins') }}"><i class="fas fa-users-cog"></i>{{__('admin.admin')}}</a> 
                <div>
                    <ul>
                    <li><a href="{{ url('admin/admins')}}"><i class="icon-rocket"></i>{{__('admin.admins')}}</a></li>
                    </ul>
                </div>
            </li>

            <li class="dropdown  {{active('users')}}"><a href="{{ aurl('users') }}"><i class="fas fa-users"></i>{{__('admin.users')}}</a> 
                <div>
                    <ul>
                    <li><a href="{{ url('admin/users')}}?level=customer"><i class="fas fa-user-alt"></i>{{__('admin.customer')}}</a></li>

                    <li><a href="{{ url('admin/users')}}?level=vendor"><i class="fas fa-shuttle-van"></i>{{__('admin.vendor')}}</a></li>

                    <li><a href="{{ url('admin/users')}}?level=company"><i class="far fa-credit-card"></i>{{__('admin.company')}}</a></li>
                    </ul>
                </div>
            </li>
            <li class="dropdown  {{active('roles')}}"><a href="/"><i class="fas fa-traffic-light"></i> @lang('admin.roles')</a> 
               
            </li>

            <li class="dropdown  {{active('settings')}}"><a href="{{ aurl('settings') }}"><i class="fas fa-cogs"></i> @lang('admin.settings')</a> 
               
            </li>
            <li class="dropdown  {{active('countries')}}"><a href="{{ aurl('countries') }}"><i class="far fa-flag"></i> @lang('admin.countries')</a> 
               
            </li>
            <li class="dropdown  {{active('cities')}}"><a href="{{ aurl('cities') }}"><i class="fas fa-location-arrow"></i> @lang('admin.cities')</a> 
               
            </li>
            <li class="dropdown  {{active('states')}}"><a href="{{ aurl('states') }}"><i class="fas fa-map-marker-alt"></i> @lang('admin.states')</a> 
               
            </li>

            <li class="dropdown  {{active('departments')}}"><a href="{{ aurl('departments') }}"><i class="fas fa-list"></i>{{__('admin.departments')}}</a> 
                <div>
                    <ul>
                    <li><a href="{{ aurl('departments/create')}}"><i class="far fa-keyboard"></i>{{__('admin.add_departments')}}</a></li>
                    </ul>
                </div>
            </li>
            <li class="dropdown  {{active('manufacturers')}}"><a href="{{ aurl('manufacturers') }}"><i class="fas fa-hammer"></i>{{__('admin.manufacturers')}}</a> 
            </li>
            <li class="dropdown  {{active('shippings')}}"><a href="{{ aurl('shippings') }}"><i class=" fas fa-shipping-fast"></i>{{__('admin.shippings')}}</a> 
            </li>
            <li class="dropdown {{active('malls')}}"><a href="{{ aurl('malls') }}"><i class="fas fa-shopping-cart 
                "></i>{{__('admin.malls')}}</a> 
            </li>
          
            
            <li class="dropdown  {{active('products')}}"><a href="{{ aurl('products') }}"><i class="fas fa-box-open"></i>{{__('admin.products')}}</a> 
                <div>
                    <ul>
                        <li class="{{active('colors')}}"><a href="{{ aurl('colors') }}"><i class="fas fa-shopping-cart 
                            "></i>{{__('admin.colors')}}</a> 
                        </li>

                        <li class="{{active('sizes')}}"><a href="{{ aurl('sizes') }}"><i class="fas fa-bomb 
                            "></i>{{__('admin.sizes')}}</a> 
                        </li>

                        <li class="{{active('units')}}"><a href="{{ aurl('units') }}"><i class="fa fas fa-balance-scale
                            "></i>{{__('admin.units')}}</a> 
                        </li>
                        <li class="{{active('trademarks')}}"><a href="{{ aurl('trademarks') }}"><i class="fa fas fa-gem 
                            "></i></i>{{__('admin.trademarks')}}</a> 
                        </li>

                        <li class="{{active('categories')}}"><a href="{{ aurl('categories') }}"><i class="fa fas fa-tags 
                            "></i>{{__('admin.categories')}}</a> 
                        </li>
                    </ul>
                </div>
            </li>
            <li class="dropdown  {{active('purchases')}}"><a href="{{ aurl('purchases') }}"><i class="fas fa-cash-register"></i> @lang('admin.purchases')</a> 
               
            </li>
        </ul>
        <!-- END: Menu-->
    </div>
    <!-- END: Main Menu-->