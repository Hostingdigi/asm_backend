<div class="c-sidebar c-sidebar-dark c-sidebar-fixed c-sidebar-lg-show" id="sidebar">
    <div class="c-sidebar-brand d-lg-down-none">
        <svg class="c-sidebar-brand-full" width="118" height="46" alt="CoreUI Logo">
            <!-- <use xlink:href="{{ asset('img/brand/coreui.svg#full') }}"></use> -->
        </svg>
        <svg class="c-sidebar-brand-minimized" width="46" height="46" alt="CoreUI Logo">
            <use xlink:href="{{ asset('img/brand/coreui.svg#signet') }}"></use>
        </svg>
    </div><!--c-sidebar-brand-->

    <ul class="c-sidebar-nav">
        <li class="c-sidebar-nav-item">
            <x-utils.link
                class="c-sidebar-nav-link"
                :href="route('admin.dashboard')"
                :active="activeClass(Route::is('admin.dashboard'), 'c-active')"
                icon="c-sidebar-nav-icon cil-speedometer"
                :text="__('Dashboard')" />
        </li>

        <li class="c-sidebar-nav-item">
            <x-utils.link
                class="c-sidebar-nav-link"
                :href="route('admin.products.index')"
                :active="activeClass(Route::is('admin.products.*'), 'c-active')"
                icon="c-sidebar-nav-icon cil-line-weight"
                :text="__('Products')" />
        </li>

        <li class="c-sidebar-nav-item">
            <x-utils.link
                class="c-sidebar-nav-link"
                :href="route('admin.orders.listOrders')"
                :active="activeClass(Route::is('admin.orders.*'), 'c-active')"
                icon="c-sidebar-nav-icon cil-mouse"
                :text="__('Orders')" />
        </li>

                <li class="c-sidebar-nav-item">
            <x-utils.link
                class="c-sidebar-nav-link"
                :href="route('admin.coupons.index')"
                :active="activeClass(Route::is('admin.coupons.*'), 'c-active')"
                icon="c-sidebar-nav-icon cil-puzzle"
                :text="__('Coupons')" />
        </li>

        <li class="c-sidebar-nav-dropdown {{ activeClass(Route::is('admin.masters.*'), 'c-open c-show') }}">
                <x-utils.link
                    href="#"
                    icon="c-sidebar-nav-icon cil-control"
                    class="c-sidebar-nav-dropdown-toggle"
                    :text="__('Masters')" />

                <ul class="c-sidebar-nav-dropdown-items">
                    
                        <li class="c-sidebar-nav-item">
                            <x-utils.link
                                :href="route('admin.masters.categories.index')"
                                class="c-sidebar-nav-link"
                                :text="__('Categories')"
                                :active="activeClass(Route::is('admin.masters.categories'), 'c-active')" />
                        </li>

                        <li class="c-sidebar-nav-item">
                            <x-utils.link
                                :href="route('admin.masters.brands.index')"
                                class="c-sidebar-nav-link"
                                :text="__('Brands')"
                                :active="activeClass(Route::is('admin.masters.categories'), 'c-active')" />
                        </li>

                        <li class="c-sidebar-nav-item">
                            <x-utils.link
                                :href="route('admin.masters.units.index')"
                                class="c-sidebar-nav-link"
                                :text="__('Units')"
                                :active="activeClass(Route::is('admin.masters.units'), 'c-active')" />
                        </li>

                        
                </ul>
            </li>
            

        @if (
            $logged_in_user->hasAllAccess() ||
            (
                $logged_in_user->can('admin.access.user.list') ||
                $logged_in_user->can('admin.access.user.deactivate') ||
                $logged_in_user->can('admin.access.user.reactivate') ||
                $logged_in_user->can('admin.access.user.clear-session') ||
                $logged_in_user->can('admin.access.user.impersonate') ||
                $logged_in_user->can('admin.access.user.change-password')
            )
        )
            <!-- <li class="c-sidebar-nav-title">@lang('System')</li> -->

            <li class="c-sidebar-nav-dropdown {{ activeClass(Route::is('admin.auth.user.*') || Route::is('admin.auth.role.*'), 'c-open c-show') }}">
                <x-utils.link
                    href="#"
                    icon="c-sidebar-nav-icon cil-user"
                    class="c-sidebar-nav-dropdown-toggle"
                    :text="__('User Management')" />

                <ul class="c-sidebar-nav-dropdown-items">
                    @if (
                        $logged_in_user->hasAllAccess() ||
                        (
                            $logged_in_user->can('admin.access.user.list') ||
                            $logged_in_user->can('admin.access.user.deactivate') ||
                            $logged_in_user->can('admin.access.user.reactivate') ||
                            $logged_in_user->can('admin.access.user.clear-session') ||
                            $logged_in_user->can('admin.access.user.impersonate') ||
                            $logged_in_user->can('admin.access.user.change-password')
                        )
                    )
                        <li class="c-sidebar-nav-item">
                            <x-utils.link
                                :href="route('admin.auth.user.index')"
                                class="c-sidebar-nav-link"
                                :text="__('Users')"
                                :active="activeClass(Route::is('admin.auth.user.*'), 'c-active')" />
                        </li>
                    @endif

                    @if ($logged_in_user->hasAllAccess())
                        <li class="c-sidebar-nav-item d-none">
                            <x-utils.link
                                :href="route('admin.auth.role.index')"
                                class="c-sidebar-nav-link"
                                :text="__('Role Management')"
                                :active="activeClass(Route::is('admin.auth.role.*'), 'c-active')" />
                        </li>
                    @endif
                </ul>
            </li>
            
        @endif

        @if ($logged_in_user->hasAllAccess())
            <li class="c-sidebar-nav-dropdown d-none">
                <x-utils.link
                    href="#"
                    icon="c-sidebar-nav-icon cil-list"
                    class="c-sidebar-nav-dropdown-toggle"
                    :text="__('Logs')" />

                <ul class="c-sidebar-nav-dropdown-items">
                    <li class="c-sidebar-nav-item">
                        <x-utils.link
                            :href="route('log-viewer::dashboard')"
                            class="c-sidebar-nav-link"
                            :text="__('Dashboard')" />
                    </li>
                    <li class="c-sidebar-nav-item">
                        <x-utils.link
                            :href="route('log-viewer::logs.list')"
                            class="c-sidebar-nav-link"
                            :text="__('Logs')" />
                    </li>
                </ul>
            </li>
        @endif

        <li class="c-sidebar-nav-dropdown {{ activeClass(Route::is('admin.settings'), 'c-open c-show') }}">
                <x-utils.link
                    href="#"
                    icon="c-sidebar-nav-icon cil-cog"
                    class="c-sidebar-nav-dropdown-toggle"
                    :text="__('Settings')" />

                <ul class="c-sidebar-nav-dropdown-items">

                    <li class="c-sidebar-nav-item">
                            <x-utils.link
                                :href="route('admin.settings.delivery-date.index')"
                                class="c-sidebar-nav-link"
                                :text="__('Lock Delivery Date')"
                                :active="activeClass(Route::is('admin.settings.delivery-date'), 'c-active')" />
                        </li>
                    
                        <li class="c-sidebar-nav-item">
                            <x-utils.link
                                class="c-sidebar-nav-link"
                                :text="__('Site')"
                                :active="activeClass(Route::is('admin.masters.categories'), 'c-active')" />
                        </li>

                        <li class="c-sidebar-nav-item">
                            <x-utils.link
                                class="c-sidebar-nav-link"
                                :text="__('Payment')"
                                :active="activeClass(Route::is('admin.masters.categories'), 'c-active')" />
                        </li>

                        
                </ul>
            </li>
    </ul>

    <button class="c-sidebar-minimizer c-class-toggler" type="button" data-target="_parent" data-class="c-sidebar-minimized"></button>
</div><!--sidebar-->
