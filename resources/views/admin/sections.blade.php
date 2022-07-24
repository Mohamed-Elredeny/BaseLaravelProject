<?php $guard = '' ?>
<li>
    <a href="">
        <div class="parent-icon">
            <ion-icon name="home-sharp"></ion-icon>
        </div>
        @if(Auth::guard($guard)->check())
            @if(Auth::guard('admin')->user()->is_super_admin)
                <div class="menu-title">{{__('Super Admin Dashboard')}} </div>
            @else
                <div class="menu-title">{{__('Admin Dashboard')}} </div>
            @endif
        @endif
    </a>
</li>


<li>
    <a href="javascript:;">
        <div class="parent-icon">
            <ion-icon name="people-outline"></ion-icon>
        </div>
        <div class="menu-title">Manage Users</div>

    </a>
    <ul>
        <li>
            <a href="javascript: void(0);">
                <span>Users</span>
            </a>
            <ul class="sub-menu" aria-expanded="false">
                <li>
                    <a href="">
                        <div class="parent-icon">
                            <ion-icon name="eye-outline"></ion-icon>
                        </div>
                        <div class="menu-title">{{__('View All')}}</div>

                    </a>
                </li>
                <li>
                    <a href="">
                        <div class="parent-icon">
                            <ion-icon name="add-outline"></ion-icon>
                        </div>
                        <div class="menu-title">{{__('Add New User')}}</div>

                    </a>
                </li>

            </ul>
        </li>


    </ul>
</li>

@if(Auth::guard($guard)->check())

    @if(Auth::guard('admin')->user()->is_super_admin)

        <li>
            <a href="javascript: void(0);">
                <div class="parent-icon">
                    <ion-icon name="earth-outline"></ion-icon>
                </div>
                <div class="menu-title">{{__('Countries')}} </div>

            </a>
            <ul>

                <li>
                    <a href="{{route('countries.index')}}">
                        <div class="parent-icon">
                            <ion-icon name="eye-outline"></ion-icon>
                        </div>
                        <div class="menu-title">{{__('View All')}}</div>

                    </a>
                </li>
                <li>
                    <a href="{{route('countries.create')}}">
                        <div class="parent-icon">
                            <ion-icon name="add-outline"></ion-icon>
                        </div>
                        <div class="menu-title">{{__('Add New')}}</div>

                    </a>
                </li>
            </ul>
        </li>
    @endif
@endif
@if(Auth::guard($guard)->user())

    <li>
        <a href="javascript:;">
            <div class="parent-icon">
                <ion-icon name="settings-outline"></ion-icon>
            </div>
            <div class="menu-title">Settings</div>

        </a>
        <ul>

            <li>
                <a href="{{route('admin.orders.settings')}}">
                    <div class="parent-icon">
                        <ion-icon name="cube-outline"></ion-icon>
                    </div>
                    <div class="menu-title">{{__(' Order Settings ')}}</div>
                </a>
            </li>

        </ul>
    </li>
@endif
