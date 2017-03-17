<!--**
 * Created by PhpStorm.
 * User: Arnold
 * Date: 2/26/2017
 * Time: 9:58 AM
 */-->

<!-- Pre-loader -->
<div class="mask" style="display: none;">
    <div id="intro-loader" style="display: none;">
    </div>
</div>
<!-- End Pre-loader -->
<!-- Navbar -->
<div class="navbar  navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="{{url('/')}}"><img class="logo" src="{{ asset('public/img/logo1.png') }}" alt=""></a>
        </div>
        <nav id="my-nav" class="navbar-collapse collapse" role="navigation">
            <ul class="nav navbar-nav">
                <li class="active">
                    <a href="{{url('/#home')}}">Home</a>
                </li>
                <!--
                <li class="">
                    <a href="#portfolio">Works</a>
                </li>
                 -->
                <li class="">
                    <a href="{{url('/#services')}}">Services</a>
                </li>
                <!--
                <li class="">
                    <a href="#experience">Resume</a>
                </li>
                -->
                <li class="">
                    <a href="{{url('/#clients')}}">Clients</a>
                </li>
                <li class="">
                    <a href="{{url('/#process')}}">Process</a>
                </li>
                <li class="">
                    <a href="{{url('/#about')}}">About</a>
                </li>
                <li class="">
                    <a href="{{url('/#contact')}}">Contact</a>
                </li>
                @if (Auth::guest())
                    <li><a href="{{ url('/auth/login') }}">Login</a></li>
                    <li><a href="{{ url('/auth/register') }}">Register</a></li>
                @else
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">{{ Auth::user()->name }} <span class="caret"></span></a>
                        <ul class="dropdown-menu" role="menu">
                            <!--Check type of user and display appropriate menu-->
                            @if(Auth::user()->role_id == \App\Http\Helper\Utility::$EMPLOYER_ROLE_ID || Auth::user()->role_id == \App\Http\Helper\Utility::$PAID_EMPLOYER_ROLE_ID)
                                    <li class=" rd-navbar-right-buttons reveal-inline-block"><a href="{{ url("jobs/create") }}" style="max-height: 40px; line-height: 22px;"  class="btn btn-warning text-middle"><span class="big">Create a job</span></a></li>
                                @else @if(Auth::user()->role_id == \App\Http\Helper\Utility::$ABONNE_ROLE_ID)
                                    <li><a href="{{ url('abonnes/'. Auth::user()->abonnerInfos->id) }}"><span class="text-middle">Profil</span></a></li>
                                @else
                                    <li><a href="{{ url('admin/') }}"><span class="text-middle">Dashboard</span></a></li>
                                @endif
                            @endif
                            <li><a href="{{ url('/auth/logout') }}">Logout</a></li>
                        </ul>
                    </li>
                @endif
            </ul>
        </nav>
        <!--/.navbar-collapse -->
    </div>
</div>
<!-- End Navbar -->