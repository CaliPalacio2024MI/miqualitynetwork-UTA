@vite(['resources/css/carpetas.css'])
<a href="{{ route('archivos.list', ['carpeta_id' => $carpeta->id]) }}" class="btn-carpeta">
    {{ $carpeta->nombre_carpeta }}
</a>
