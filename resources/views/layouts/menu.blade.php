
<li class="nav-item">
    <a href="{{ route('vueusuario.index') }}"
       class="nav-link {{ Request::is('vueusuario*') ? 'active' : '' }}">
        <p>Usuario</p>
    </a>
</li>

<li class="nav-item">
    <a href="{{ route('vuepaciente.index') }}"
       class="nav-link {{ Request::is('vuepaciente*') ? 'active' : '' }}">
        <p>Paciente</p>
    </a>
</li>

<li class="nav-item">
    <a href="{{ route('vuecita.index') }}"
       class="nav-link {{ Request::is('vuecita*') ? 'active' : '' }}">
        <p>Cita</p>
    </a>
</li>

<li class="nav-item">
    <a href="{{ route('vuedetalle.index') }}"
       class="nav-link {{ Request::is('vuedetalle*') ? 'active' : '' }}">
        <p>Cita Detalle</p>
    </a>
</li>


<li class="nav-item">
    <a href="{{ route('vuedoctor.index') }}"
       class="nav-link {{ Request::is('vuedoctor*') ? 'active' : '' }}">
        <p>Doctor</p>
    </a>
</li>

<li class="nav-item">
    <a href="{{ route('clientevue.index') }}"
       class="nav-link {{ Request::is('clientevue*') ? 'active' : '' }}">
        <p>Enfermeros</p>
    </a>
</li>


<li class="nav-item">
    <a href="{{ route('vuehistoriaclinica.index') }}"
       class="nav-link {{ Request::is('vuehistoriaclinica*') ? 'active' : '' }}">
        <p>Historia Clinica</p>
    </a>
</li>

<li class="nav-item">
    <a href="{{ route('vueatencion.index') }}"
       class="nav-link {{ Request::is('vueatencion*') ? 'active' : '' }}">
        <p>Detalle Atencion</p>
    </a>
</li>

<li class="nav-item">
    <a href="{{ route('vuecama.index') }}"
       class="nav-link {{ Request::is('vuecama*') ? 'active' : '' }}">
        <p>Paciente Cama</p>
    </a>
</li>



