<div class="topbar">

    <div class="menu-horizontal">
        <a href="/rack" class="menu-item">
            <img src="{{ asset('images/modules/bcp/iconos/estatushabitacion.svg') }}" alt="Estatus">
            <span>Rack de habitaciones</span>
        </a>
        <a href="/llegada" class="menu-item">
            <img src="{{ asset('images/modules/bcp/iconos/llegadas.svg') }}" alt="Llegadas">
            <span>Llegadas</span>
        </a>

        <div class="menu-item dropdown">
            <button class="dropbtn">
                <img src="{{ asset('images/modules/bcp/iconos/centroconsumo.svg') }}" alt="Centro">
                <span>Centro de consumo</span>
            </button>
            <div class="dropdown-content">
                <a href="/#">Palacio Mundo Imperial</a>
                <a href="/#">Pierre Mundo Imperial</a>
                <a href="/#">Princess Mundo Imperial</a>
            </div>
        </div>

        <a href="/#" class="menu-item">
            <img src="{{ asset('images/modules/bcp/iconos/estadodecuenta.svg') }}" alt="Cuenta">
            <span>Estado de cuenta</span>
        </a>

        <div class="menu-item dropdown">
            <button class="dropbtn">
                <img src="{{ asset('images/modules/bcp/iconos/llaves.svg') }}" alt="Ama De Llaves">
                <span>Ama De Llaves</span>
            </button>
            <div class="dropdown-content">
                <a href="/asignacion">Asignación</a>
                <a href="/status">Status</a>
            </div>
        </div>

        <div class="menu-item dropdown">
            <button class="dropbtn">
                <img src="{{ asset('images/modules/bcp/iconos/administracioncuentas.svg') }}" alt="Admin">
                <span>Administración</span>
            </button>
            <div class="dropdown-content">
                <a href="/#">Propiedades (Fuera)</a>
                <a href="/#">Centro consumo (Fuera)</a>
                <a href="/catalogo">Catálogo (Fuera)</a>
                <a href="/secciones">Secciones</a>
                <a href="/tipo_status">Tipos de Status (Fuera)</a>
                <a href="/creditos">Límite de créditos</a>
            </div>
        </div>
    </div>
</div>
