@push('css')
<style>
    .bacground-1 {
        background: rgb(231, 231, 154);
    }

    /* .side_bar {
        background: #aacf39;
    } */
    /* .dash_hover:hover {
    background: #20df49 !important;
} */
</style>
@endpush
<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme bacground-1">
    <div class="app-brand demo">
        <a href="/" class="app-brand-link">
            <span class="app-brand-logo demo">
                <img style="object-fit:cover;height: 60px;
                width: 195px;
                margin: 4px 0 0 0px;" src="{{ asset('backend/img/logo.png') }}" alt="">
            </span>

        </a>

        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
            <i class="bx bx-chevron-left bx-sm align-middle"></i>
        </a>
    </div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">
        <!-- Dashboard -->

        <li class="menu-item {{ $data['active_menu'] == 'dashboard' ? 'active' : '' }}">
            <a href="{{ route('admin.dashboard') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div data-i18n="Analytics">Dashboard</div>
            </a>
        </li>


        {{-- User panel --}}
        @if(Auth::guard('admin')->user()->can('view-client-management'))
        <li class="menu-item  {{ $data['active_menu']  == 'Investor' || $data['active_menu']  == 'InvestorCreate'|| $data['active_menu']  == 'investorApprove' || $data['active_menu']  == 'investorList' || $data['active_menu']  == 'facilitiesApproval' || $data['active_menu']  == 'InvestorMultipule' ? 'active open' : '' }}">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-layout"></i>
                <div data-i18n="Layouts">Client Management</div>
            </a>
            <ul class="menu-sub ">

                <li class="menu-item {{ $data['active_menu'] == 'InvestorCreate' ? 'active' : '' }}">
                    <a href="{{ route('investor_create') }}" class="menu-link">
                        <div data-i18n="Without menu">Add Client</div>
                    </a>
                </li>
                <li class="menu-item {{ $data['active_menu'] == 'InvestorMultipule' ? 'active' : '' }}">
                    <a href="{{ route('add.multipule.investor') }}" class="menu-link">
                        <div data-i18n="Without menu">Add Multipule Investor</div>
                    </a>
                </li>
                @if(Auth::guard('admin')->user()->can('approve-investor'))
                <li class="menu-item {{ $data['active_menu'] == 'investorApprove' ? 'active' : '' }}">
                    <a href="{{ route('investorApprove') }}" class="menu-link">
                        <div data-i18n="Without navbar">Client Approval</div>
                    </a>
                </li>
                @endif
                <li class="menu-item {{ $data['active_menu'] == 'investorList' ? 'active' : '' }}">
                    <a href="{{ route('investorList') }}" class="menu-link">
                        <div data-i18n="Without navbar">Client List</div>
                    </a>
                </li>
                <li class="menu-item {{ $data['active_menu'] == 'facilitiesApproval' ? 'active' : '' }}">
                    <a href="{{ route('facilities.approval') }}" class="menu-link">
                        <div data-i18n="Without navbar">Facilities Approval</div>
                    </a>
                </li>
            </ul>
        </li>
        @endif
        {{-- Lead Management panel --}}
        @if(Auth::guard('admin')->user()->can('view-suspect-management'))

        <li class="menu-item {{  $data['active_menu']  == 'hr_management' || $data['active_menu']  == 'LeadList' || $data['active_menu']  == 'LeadProcess' || $data['active_menu']  == 'task' ||$data['active_menu']  == 'myWork' ? 'active open' : '' }}">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-layout"></i>
                <div data-i18n="Layouts">Suspect Management</div>
            </a>
            <ul class="menu-sub">

                <li class="menu-item {{ $data['active_menu'] == 'LeadList' ? 'active' : '' }}">
                    <a href="{{ route('lead') }}" class="menu-link">
                        <div data-i18n="Without menu">Add Suspect</div>
                    </a>
                </li>
            </ul>
            <ul class="menu-sub">
                <li class="menu-item {{ $data['active_menu'] == 'task' ? 'active' : '' }}">
                    <a href="{{ route('tasks.index') }}" class="menu-link">
                        <div data-i18n="Without menu">Update Task</div>
                    </a>
                </li>
            </ul>
            <ul class="menu-sub">
                <li class="menu-item {{ $data['active_menu'] == 'LeadProcess' ? 'active' : '' }}">
                    <a href="{{ route('lead.process') }}" class="menu-link">
                        <div data-i18n="Without menu">Work Progress</div>
                    </a>
                </li>
            </ul>
            <ul class="menu-sub">
                <li class="menu-item {{ $data['active_menu'] == 'myWork' ? 'active' : '' }}">
                    <a href="{{ route('my.work.list') }}" class="menu-link">
                        <div data-i18n="Without menu">My Work List</div>
                    </a>
                </li>
            </ul>
        </li>
        @endif
        {{--Lead Management End --}}
        {{-- Suspect List panel --}}
        @if(Auth::guard('admin')->user()->can('view-all-suspect-list'))

        <li class="menu-item {{  $data['active_menu']  == 'suspectList'  || $data['active_menu']  == 'mplList' || $data['active_menu']  == 'sglList'|| $data['active_menu']  == 'activeList' || $data['active_menu']  == 'junkList' || $data['active_menu']  == 'clientList' ? 'active open' : '' }}">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-layout"></i>
                <div data-i18n="Layouts">All Suspect List</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item {{ $data['active_menu'] == 'mplList' ? 'active' : '' }}">
                    <a href="{{ route('mpl.list') }}" class="menu-link">
                        <div data-i18n="Without menu">MPL Suspect</div>
                    </a>
                </li>
            </ul>
            <ul class="menu-sub">
                <li class="menu-item {{ $data['active_menu'] == 'sglList' ? 'active' : '' }}">
                    <a href="{{ route('sgl.list') }}" class="menu-link">
                        <div data-i18n="Without menu">SGL Suspect</div>
                    </a>
                </li>
            </ul>
            <ul class="menu-sub">
                <li class="menu-item {{ $data['active_menu'] == 'activeList' ? 'active' : '' }}">
                    <a href="{{ route('active.suspect.list') }}" class="menu-link">
                        <div data-i18n="Without menu">Active Prospect List</div>
                    </a>
                </li>
            </ul>
            <ul class="menu-sub">
                <li class="menu-item {{ $data['active_menu'] == 'junkList' ? 'active' : '' }}">
                    <a href="{{ route('junk.suspect.list') }}" class="menu-link">
                        <div data-i18n="Without menu">Junk Suspect List</div>
                    </a>
                </li>
            </ul>
            <ul class="menu-sub">
                <li class="menu-item {{ $data['active_menu'] == 'clientList' ? 'active' : '' }}">
                    <a href="{{ route('client.suspect.list') }}" class="menu-link">
                        <div data-i18n="Without menu">Prospect to Client</div>

                    </a>
                </li>
            </ul>

        </li>
        @endif
        {{--Suspect List End --}}
        {{-- Employee Management panel --}}
        @if(Auth::guard('admin')->user()->can('view-employee'))
        <li class="menu-item {{ $data['active_menu']  == 'system_management' || $data['active_menu']  == 'employee' || $data['active_menu']  == 'gmList' ? 'active open' : '' }}">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-layout"></i>
                <div data-i18n="Layouts">Employee Management</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item {{ $data['active_menu'] == 'employee' ? 'active' : '' }}">
                    <a href="{{ route('employee') }}" class="menu-link">
                        <div data-i18n="Without menu">Employee List</div>
                    </a>
                </li>

            </ul>
            <ul class="menu-sub">
                <li class="menu-item {{ $data['active_menu'] == 'teamLeader' ? 'active' : '' }}">
                    <a href="{{ route('teamLeader') }}" class="menu-link">
                        <div data-i18n="Without menu">Team Leader List</div>
                    </a>
                </li>

            </ul>
            <ul class="menu-sub">
                <li class="menu-item {{ $data['active_menu'] == 'cmoList' ? 'active' : '' }}">
                    <a href="{{ route('cmoList') }}" class="menu-link">
                        <div data-i18n="Without menu">CMO List</div>
                    </a>
                </li>
            </ul>
            <ul class="menu-sub">
                <li class="menu-item {{ $data['active_menu'] == 'gmList' ? 'active' : '' }}">
                    <a href="{{ route('gmList') }}" class="menu-link">
                        <div data-i18n="Without menu">GM List</div>
                    </a>
                </li>
            </ul>

        </li>
        @endif

        {{--Employee Management End --}}
        {{-- Target Management --}}
        @if(Auth::guard('admin')->user()->can('view-target-management'))
        <li class="menu-item {{ $data['active_menu']  == 'Reward' || $data['active_menu']  == 'assignAdmin' || $data['active_menu']  == 'assignTeam'? 'active open' : '' }}">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-layout"></i>
                <div data-i18n="Layouts">Target Management</div>
            </a>
            <ul class="menu-sub">
                @if(Auth::guard('admin')->user()->can('view-target-assign1'))
                <li class="menu-item {{ $data['active_menu'] == 'assignAdmin' ? 'active' : '' }}">
                    <a href="{{ route('target.assign.admin') }}" class="menu-link">
                        <div data-i18n="Without menu">Target Team Leader</div>
                    </a>
                </li>
                @endif
                @if(Auth::guard('admin')->user()->can('view-target-assign2'))

                <li class="menu-item {{ $data['active_menu'] == 'assignTeam' ? 'active' : '' }}">
                    <a href="{{ route('target.assign.teamLeader') }}" class="menu-link">
                        <div data-i18n="Without menu">Target Sales Person</div>
                    </a>
                </li>
                @endif
            </ul>
        </li>
        @endif

        {{--Target Management panel End --}}
        {{-- payment panel --}}
        @if(Auth::guard('admin')->user()->can('view-payment'))
        <li class="menu-item {{ $data['active_menu']  == 'payment' || $data['active_menu']  == 'InvestorPay' || $data['active_menu']  == 'InvestorList' || $data['active_menu']  == 'downPayment'? 'active open' : '' }}">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-layout"></i>
                <div data-i18n="Layouts">Account</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item {{ $data['active_menu'] == 'downPayment' ? 'active' : '' }}">
                    <a href="{{ route('downPayment') }}" class="menu-link">
                        <div data-i18n="Without menu">Down Payment Form</div>
                    </a>
                </li>
                <li class="menu-item {{ $data['active_menu'] == 'InvestorPay' ? 'active' : '' }}">
                    <a href="{{ route('investor_pay') }}" class="menu-link">
                        <div data-i18n="Without menu">Payment Form</div>
                    </a>
                </li>

                <li class="menu-item {{ $data['active_menu'] == 'InvestorList' ? 'active' : '' }}">
                    <a href="{{ route('payment.list') }}" class="menu-link">
                        <div data-i18n="Without menu">Payment List</div>
                    </a>
                </li>

            </ul>
        </li>
        @endif

        {{--payment panel End --}}
        {{-- Reward panel --}}
        @if(Auth::guard('admin')->user()->can('view-payment'))
        <li class="menu-item {{ $data['active_menu']  == 'Reward' || $data['active_menu']  == 'InvestorPay' || $data['active_menu']  == 'InvestorList'? 'active open' : '' }}">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-layout"></i>
                <div data-i18n="Layouts">Reward Management</div>
            </a>
            <ul class="menu-sub">
                {{-- <li class="menu-item {{ $data['active_menu'] == 'InvestorPay' ? 'active' : '' }}">
                <a href="{{ route('investor_pay') }}" class="menu-link">
                    <div data-i18n="Without menu">Payment Form</div>
                </a>
        </li> --}}
        {{-- <li class="menu-item {{ $data['active_menu'] == 'InvestorList' ? 'active' : '' }}">
        <a href="{{ route('payment.list') }}" class="menu-link">
            <div data-i18n="Without menu">Payment List</div>
        </a>
        </li> --}}
    </ul>
    </li>
    @endif

    {{--reward panel End --}}
    {{-- payment panel --}}
    @if(Auth::guard('admin')->user()->can('view-role'))
    <li class="menu-item {{ $data['active_menu']  == 'role' || $data['active_menu']  == 'module' || $data['active_menu']  == 'subModule' || $data['active_menu']  == 'permission' || $data['active_menu']  == 'accessControl' || $data['active_menu']  == 'role' || $data['active_menu']  == 'adminList' || $data['active_menu']  == 'adminCreate' || $data['active_menu']  == 'adminEdit'? 'active open' : '' }}">
        <a href="javascript:void(0);" class="menu-link menu-toggle">
            <i class="menu-icon tf-icons bx bx-layout"></i>
            <div data-i18n="Layouts">Role Management</div>
        </a>
        <ul class="menu-sub">
            @if(Auth::guard('admin')->user()->can('view-module'))
            <li class="menu-item {{ $data['active_menu'] == 'module' ? 'active' : '' }}">
                <a href="{{route('module')}}" class="menu-link">
                    <div data-i18n="Basic">Module </div>
                </a>
            </li>
            @endif
            @if(Auth::guard('admin')->user()->can('view-sub-module'))
            <li class="menu-item {{ $data['active_menu'] == 'subModule' ? 'active' : '' }}">
                <a href="{{route('subModule')}}" class="menu-link">
                    <div data-i18n="Basic">Sub Module </div>
                </a>
            </li>
            @endif
            @if(Auth::guard('admin')->user()->can('view-permission'))
            <li class="menu-item {{ $data['active_menu'] == 'permission' ? 'active' : '' }}">
                <a href="{{route('permission')}}" class="menu-link">
                    <div data-i18n="Basic">Permission</div>
                </a>
            </li>
            @endif
            @if(Auth::guard('admin')->user()->can('view-access-controll'))
            <li class="menu-item {{ $data['active_menu'] == 'accessControl' ? 'active' : '' }}">
                <a href="{{route('access-control')}}" class="menu-link">
                    <div data-i18n="Basic">Access Control</div>
                </a>
            </li>
            @endif
            @if(Auth::guard('admin')->user()->can('view-permission'))
            <li class="menu-item {{ $data['active_menu'] == 'role' ? 'active' : '' }}">
                <a href="{{route('role')}}" class="menu-link">
                    <div data-i18n="Basic">Role </div>
                </a>
            </li>
            @endif
            @if(Auth::guard('admin')->user()->can('view-admin'))
            <li class="menu-item  {{ $data['active_menu'] == 'adminList' ? 'active' : '' }}">
                <a href="{{route('adminList')}}" class="menu-link">
                    <div data-i18n="Basic">Admin</div>
                </a>
            </li>
            @endif
        </ul>
    </li>
    @endif
    {{--payment panel End --}}





    {{-- Report Management panel --}}
    @if(Auth::guard('admin')->user()->can('view-report'))
    <li class="menu-item {{ $data['active_menu']  == 'report_management' || $data['active_menu']  == 'reportList' || $data['active_menu']  == 'investorReport' || $data['active_menu']  == 'incentiveRatio' || $data['active_menu']  == 'dueReport' || $data['active_menu']  == 'targetReport' ? 'active open' : '' }}">
        <a href="javascript:void(0);" class="menu-link menu-toggle">
            <i class="menu-icon tf-icons bx bx-layout"></i>
            <div data-i18n="Layouts">Report</div>
        </a>
        {{-- @if(Auth::guard('admin')->user()->can('view-task-report'))
        <ul class="menu-sub">
            <li class="menu-item {{ $data['active_menu'] == 'reportList' ? 'active' : '' }}">
        <a href="{{ route('work.report') }}" class="menu-link">
            <div data-i18n="Without menu">Task Report</div>
        </a>
    </li>
    </ul>
    @endif --}}
    @if(Auth::guard('admin')->user()->can('view-client-report'))
    <ul class="menu-sub">
        <li class="menu-item {{ $data['active_menu'] == 'investorReport' ? 'active' : '' }}">
            <a href="{{ route('investorReport') }}" class="menu-link">
                <div data-i18n="Without menu">Client Report</div>
            </a>
        </li>
    </ul>
    @endif
    @if(Auth::guard('admin')->user()->can('view-due-report'))
    <ul class="menu-sub">
        <li class="menu-item {{ $data['active_menu'] == 'dueReport' ? 'active' : '' }}">
            <a href="{{ route('dueReport') }}" class="menu-link">
                <div data-i18n="Without menu">Due Report</div>
            </a>
        </li>
    </ul>
    @endif
    @if(Auth::guard('admin')->user()->can('view-target-report'))
    <ul class="menu-sub">
        <li class="menu-item {{ $data['active_menu'] == 'targetReport' ? 'active' : '' }}">
            <a href="{{ route('targetReport') }}" class="menu-link">
                <div data-i18n="Without menu">Target Report</div>
            </a>
        </li>
    </ul>
    @endif
    @if(Auth::guard('admin')->user()->can('view-incentive-report'))
    <ul class="menu-sub">
        <li class="menu-item {{ $data['active_menu'] == 'incentiveRatio' ? 'active' : '' }}">
            <a href="{{ route('incentive.ratio') }}" class="menu-link">
                <div data-i18n="Without menu">Incentive Ratio</div>
            </a>
        </li>
    </ul>
    @endif
    </li>

    @endif
    </ul>
</aside>
<!-- / Menu -->