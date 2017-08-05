<nav class="navbar navbar-default">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <a class="navbar-brand" href="{{ route('product.index') }}">Laravel eCart Native using Session</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav navbar-right">
                <li>
                    <a href="{{ route('cart') }}">
                        <i class="fa fa-shopping-cart" aria-hidden="true"></i> Cart
                        <span id="header_quantity" class="badge">
                            {{ Session::has('cart') ? Session::get('cart')->total_quantity : '0' }}
                        </span>
                    </a>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-user" aria-hidden="true"></i> User Account <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        @if( Auth::check() )
                            <li><a href="{{ route('user.profile') }}">My Orders</a></li>
                            <li role="separator" class="divider"></li>
                            <li>
                                <a href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">Logout
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </li>
                        @else
                            <li><a href="{{ route('register') }}">Sign Up</a></li>
                            <li><a href="{{ route('login') }}">Sign In</a></li>
                        @endif
                    </ul>
                </li>
            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>