<li class="{{ Request::is('activities*') ? 'active' : '' }}">
    <a href="{!! route('activities.index') !!}"><i class="fa fa-edit"></i><span>Actividades</span></a>
</li>

<li class="{{ Request::is('classes*') ? 'active' : '' }}">
    <a href="{!! route('classes.index') !!}"><i class="fa fa-edit"></i><span>Clases</span></a>
</li>

<li class="{{ Request::is('clients*') ? 'active' : '' }}">
    <a href="{!! route('clients.index') !!}"><i class="fa fa-edit"></i><span>Clientes</span></a>
</li>

<li class="{{ Request::is('machines*') ? 'active' : '' }}">
    <a href="{!! route('machines.index') !!}"><i class="fa fa-edit"></i><span>Máquinas</span></a>
</li>

<li class="{{ Request::is('news*') ? 'active' : '' }}">
    <a href="{!! route('news.index') !!}"><i class="fa fa-edit"></i><span>Noticias</span></a>
</li>

<li class="{{ Request::is('routines*') ? 'active' : '' }}">
    <a href="{!! route('routines.index') !!}"><i class="fa fa-edit"></i><span>Rutinas</span></a>
</li>

<li class="{{ Request::is('users*') ? 'active' : '' }}">
    <a href="{!! route('users.index') !!}"><i class="fa fa-edit"></i><span>Usuarios</span></a>
</li>

<li class="{{ Request::is('classTypes*') ? 'active' : '' }}">
    <a href="{!! route('classTypes.index') !!}"><i class="fa fa-edit"></i><span>Tipos de clase</span></a>
</li>

<li class="{{ Request::is('class_schedules*') ? 'active' : '' }}">
    <a href="{!! route('class_schedules.index') !!}"><i class="fa fa-edit"></i><span>Horarios de clase</span></a>
</li>

<li class="{{ Request::is('keys*') ? 'active' : '' }}">
    <a href="{!! route('keys.index') !!}"><i class="fa fa-edit"></i><span>Llaves</span></a>
</li>

<li class="{{ Request::is('routineClients*') ? 'active' : '' }}">
    <a href="{!! route('routineClients.index') !!}"><i class="fa fa-edit"></i><span>Rutinas de clientes</span></a>
</li>

<li class="{{ Request::is('routines_activity*') ? 'active' : '' }}">
    <a href="{!! route('routines_activity.index') !!}"><i class="fa fa-edit"></i><span>Rutinas actividades</span></a>
</li>

