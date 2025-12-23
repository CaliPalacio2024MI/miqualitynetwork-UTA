<div class="navbar-container">
    <div class="navbar-brand">
    </div>
    
    <ul class="navbar-menu">
        <li>
            <a class="nav-link" href="{{route('processes.index')}}">
                <i class="material-icons">home</i>
                <span>Panorama General</span>
            </a>
        </li>
        @can('administrar') 
        <!--
        <li>
            <a class="nav-link" href="{{ route('customuser.index') }}">
                <i class="material-icons">dashboard</i>
                <span>Administrar</span>
            </a>
        </li>-->
        @endcan

    </ul>
   <div class="navbar-brand">
        <h3 class="navbar-title">Balance Score Card</h3>
    </div>

</div>