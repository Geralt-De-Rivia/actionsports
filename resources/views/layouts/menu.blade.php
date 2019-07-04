<li class="{{ Request::is('/*') ? '/' : '' }}">
    <a href="{!! url('/') !!}"><i class="fa fa-tachometer"></i><span>Dashboard</span></a>
</li>

@if(Auth::user()->role_id == 1)

<li class="{{ Request::is('activities*') ? 'active' : '' }}">
    <a href="{!! route('activities.index') !!}"><i class="fa fa-hand-spock-o"></i><span>Actividades</span></a>
</li>

<li class="{{ Request::is('classes*') ? 'active' : '' }}">
    <a href="{!! route('classes.index') !!}"><i class="fa fa-table"></i><span>Clases</span></a>
</li>

<li class="{{ Request::is('clients*') ? 'active' : '' }}">
    <a href="{!! route('clients.index') !!}"><i class="fa fa-users"></i><span>Clientes</span></a>
</li>

<li class="{{ Request::is('users*') ? 'active' : '' }}">
    <a href="{!! route('users.index') !!}"><i class="fa fa-user"></i><span>Usuarios</span></a>
</li>

<li class="{{ Request::is('classTypes*') ? 'active' : '' }}">
    <a href="{!! route('classTypes.index') !!}"><i class="fa fa-edit"></i><span>Tipos de clase</span></a>
</li>

<li class="{{ Request::is('keys*') ? 'active' : '' }}">
    <a href="{!! route('keys.index') !!}"><i class="fa fa-key"></i><span>Llaves</span></a>
</li>

@endif

<li class="{{ Request::is('class_schedules*') ? 'active' : '' }}">
    <a href="{!! route('class_schedules.index') !!}"><i class="fa fa-clock-o"></i><span>Horarios de clase</span></a>
</li>

<li class="{{ Request::is('machines*') ? 'active' : '' }}">
    <a href="{!! route('machines.index') !!}"><i class="fa fa-edit"></i><span>Máquinas</span></a>
</li>

<li class="{{ Request::is('news*') ? 'active' : '' }}">
    <a href="{!! route('news.index') !!}"><i class="fa fa-newspaper-o"></i><span>Noticias</span></a>
</li>

<li class="{{ Request::is('routines*') ? 'active' : '' }}">
    <a href="{!! route('routines.index') !!}"><i class="fa fa-book"></i><span>Rutinas</span></a>
</li>


<li class="{{ Request::is('routineClients*') ? 'active' : '' }}">
    <a href="{!! route('routineClients.index') !!}"><i class="fa fa-bookmark-o"></i><span>Rutinas de clientes</span></a>
</li>


<li class="{{ Request::is('classReservations*') ? 'active' : '' }}">
    <a href="{!! route('classReservations.index') !!}"><i
                class="fa fa-bar-chart"></i><span>Reserva de clases</span></a>
</li>
