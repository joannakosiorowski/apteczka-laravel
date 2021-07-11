<div class="page-wrap">
    <div class="app-sidebar colored">
        <div class="sidebar-header">
            <a class="header-brand" href="">
                <div class="logo-img"> 
                </div>
                <span class="text">Apteczka</span>
            </a>
            <button type="button" class="nav-toggle"><i data-toggle="expanded" class="ik ik-toggle-right toggle-icon"></i></button>
            <button id="sidebarClose" class="nav-close"><i class="ik ik-x"></i></button>
        </div>
        
        <div class="sidebar-content">
            <div class="nav-container">
                <nav id="main-menu-navigation" class="navigation-main">
                    <div class="nav-lavel">Nawigacja</div>
                    <div class="nav-item active">
                        <a href="{{ route('my.drugstores')}}"><i class="fas fa-first-aid"></i><span>Moje apteczki</span></a>
                    </div>
                    <div class="nav-item active">
                        <a href="{{route('show.logreport')}}"><i class="ik ik-bar-chart-2"></i><span>Raporty</span></a>
                    </div>
                    <div class="nav-item active">
                        <a href=""><i class="fas fa-user"></i><span>Profil użytkownika</span></a>
                    </div>




                    <div class="nav-item active">
                        <a onclick="event.preventDefault();
                                         document.getElementById('logout-form').submit();" href="{{ route('logout') }}"><i class="ik ik-power dropdown-icon"></i><span>Wyloguj</span></a>
                                          <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>

                    <div class="nav-item active">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Powiadomienia
                            @if($ncounter = count($notifications->where('status', 0)))
                                <span id="app-notification-count" class="button__badge primary">{{ $ncounter }}</span>
                            @else
                                <span id="app-notification-count" class="button__badge primary hidden">0</span>
                            @endif
                            <span class="glyphicon glyphicon-envelope"></span> <span class="caret"></span></a>
                        <ul id="app-notifications-list" class="dropdown-menu">
                            @foreach($notifications as $notification)
                                @if($notification->status)
                                    <li><a>{{$notification->content}}</a></li>

                                @else
                                    <li class="unread_notification"><a href="{{$notification->id}}">{{$notification->content}}</a></li>
                                @endif
                            @endforeach
                        </ul>
                </div>
               
                    
                </nav>
            </div>
        </div>
    </div>

    <style>
        #app-notifications-list {
          background-color: #303030;
          color: white;
          font-family: Arial;
        }
      </style>