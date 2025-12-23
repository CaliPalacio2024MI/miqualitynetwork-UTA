@extends('layouts.app')
@vite(['resources/css/inicio.css' ,'resources/js/carruselguiasmagicas.js','resources/js/alerta_no_autorizacion.js'])

@section('content')
    <meta name="mensaje" content="{{ $mensaje ?? 1 }}">

    <div class="contenedor-alerta-no-autorizado">
        <img src="{{ asset('images/pregunta.png') }}" class="icono-alerta-no-autorizado">
        <h1 class="titulo-alerta-no-autorizado">Ha ocurrido un error</h1>
        <h3>Le informamos que, para tener acceso a esta sección, debe comunicarse con el Departamento de Calidad mediante correo electrónico.</h2>

        <button class ="btn-aceptar-alerta-no-autorizado">Aceptar</button>
    </div>


    <div class="h-screen bienvenida">
        <header class="headerdashboard"></header>

        <main class="grid flex-1 h-full grid-cols-1 gap-4 px-6 contenedor md:grid-cols-3">
            <!-- Sección Misión -->
            <div class="col-span-3 secciones">

                <section id="mision"
                    class="flex flex-col items-center h-full p-4 text-center border border-gray-300 rounded-lg tarjeta1">
                    <h2 class="text-2xl font-bold text-gray-800">Misión</h2>
                    <div class="linea-dorada"></div>
                    <img src="/images/goal.png" alt="Icono de objetivo" class="w-10 h-10 my-2 icono-mision">
                    <p class="text-gray-600 letra">
                        Contribuimos con experiencias de vida memorables, inspirando bienestar y felicidad, creando
                        retorno de significativo valor compartido.
                    </p>
                </section>

                <!-- Sección Política Integral -->
                <section id="politica-integral"
                    class="flex flex-col items-center h-full p-4 text-center border border-gray-300 rounded-lg tarjeta2">
                    <h2 class="text-2xl font-bold text-gray-800">Política Integral</h2>
                    <div class="linea-dorada"></div>
                    <img src="/images/public-relation.png" alt="Icono de política integral" class="w-10 h-10 my-2 icono-mision">
                    <p class="text-gray-600 letra">
                        La Gerencia y todos los niveles de Mundo Imperial estamos comprometidos con la calidad en las
                        experiencias de hospitalidad, alimentos y bebidas, eventos, entretenimiento, deportes, SPA y
                        venta de artículos, contribuyendo en la prevención de riesgos tecnológicos, laborales y
                        ambientales, mediante el cumplimiento de requisitos normativos, la sustentabilidad, el apoyo a la
                        comunidad
                        y la mejora continua.
                    </p>

                </section>
                <!-- Sección Visión -->
                <section id="tarjeta-vision"
                    class="flex flex-col items-center h-full p-4 text-center border border-gray-300 rounded-lg tarjeta3">
                    <h2 class="text-2xl font-bold text-gray-800">Visión</h2>
                    <div class="linea-dorada"></div>
                    <img src="/images/prismaticos.png" alt="Icono de prismaticos" class="w-10 h-10 my-2 icono-mision">
                    <p class="text-gray-600 letra">
                        Ser la marca líder en experiencias integrales de hospitalidad y entretenimiento en México.
                    </p>

                </section>

            </div>
            <!-- Sección Valores y Guías Mágicas -->
            <section id="valores-y-guias-magicas"
                class="flex flex-col items-center h-full col-span-3 p-6 text-center border border-gray-300 rounded-lg">
                <!-- 🏆 Nuestros Valores -->
                <h2 class="text-2xl font-bold text-gray-800">Nuestros Valores</h2>
                <p class="mb-4 text-gray-600">
                    Nuestros valores guían cada una de nuestras acciones, promoviendo el compromiso, la ética y el
                    bienestar en todos los aspectos.
                </p>
                <div class="linea-dorada"></div>

                <!-- 🔹 Contenedor de Valores -->
                <div class="grid grid-cols-2 gap-4 mt-6 md:grid-cols-3 lg:grid-cols-6">
                    <!-- 🔹 Valor 1 -->
                    <div class="flex flex-col items-center text-center bg-white rounded-lg card">
                        <img src="/images/pasion.png" alt="Pasión" class="w-12 h-12">
                        <h3 class="mt-2 text-lg font-semibold">Pasión</h3>
                        <p class="text-sm text-gray-600">Es la energía que surge del corazón, se conecta con el cerebro y
                            nos impulsa a dar lo mejor de nosotros mismos.</p>
                    </div>

                    <!-- 🔹 Valor 2 -->
                    <div class="flex flex-col items-center text-center bg-white card">
                        <img src="/images/integridad.png" alt="Integridad" class="w-12 h-12">
                        <h3 class="mt-2 text-lg font-semibold">Integridad</h3>
                        <p class="text-sm text-gray-600">Actuamos con apego a la ética y los valores de la organización por
                            convicción.</p>
                    </div>

                    <!-- 🔹 Valor 3 -->
                    <div class="flex flex-col items-center text-center bg-white rounded-lg card">
                        <img src="/images/sinergia.png" alt="Sinergia" class="w-12 h-12">
                        <h3 class="mt-2 text-lg font-semibold">Sinergia</h3>
                        <p class="text-sm text-gray-600">Nos enfocamos en multiplicar; trabajar para multiplicar las
                            voluntades en lugar de sumarlas.</p>
                    </div>

                    <!-- 🔹 Valor 4 -->
                    <div class="flex flex-col items-center text-center bg-white card">
                        <img src="/images/audacia.png" alt="Audacia" class="w-12 h-12">
                        <h3 class="mt-2 text-lg font-semibold">Audacia</h3>
                        <p class="text-sm text-gray-600">Nos atrevemos a realizar acciones innovadoras calibrando los
                            riesgos y ganancias.</p>
                    </div>

                    <!-- 🔹 Valor 5 -->
                    <div class="flex flex-col items-center text-center bg-white rounded-lg card">
                        <img src="/images/efectividad.png" alt="Efectividad" class="w-12 h-12">
                        <h3 class="mt-2 text-lg font-semibold">Efectividad</h3>
                        <p class="text-sm text-gray-600">Alcanzamos las metas que nos proponemos de manera que podamos
                            conseguir resultados mejores en el futuro.</p>
                    </div>

                    <!-- 🔹 Valor 6 -->
                    <div class="flex flex-col items-center text-center bg-white card">
                        <img src="/images/bienestar.png" alt="Bienestar" class="w-12 h-12">
                        <h3 class="mt-2 text-lg font-semibold">Bienestar</h3>
                        <p class="text-sm text-gray-600">Cuidamos nuestros pensamientos, emociones y salud para sentirnos
                            bien con nosotros y nuestro entorno.</p>
                    </div>
                </div>

                <!-- 📜 Guías Mágicas (Carrusel) -->
                <h2 class="mt-8 text-2xl font-bold text-gray-800">Guías Mágicas</h2>
                <p class="mb-4 text-gray-600">
                    Principios clave para brindar un servicio excepcional.
                </p>
                <div class="linea-dorada"></div>

                <!-- 🔹 Contenedor del Carrusel -->
                <div class="relative w-full mt-6 carousel-container">
                    <!-- 🔹 Carrusel -->
                    <div id="carousel" class="flex px-8 space-x-4 overflow-x-auto scroll-container scroll-smooth cursor-grab">
                        <!-- 🔹 Tarjeta 1 -->
                        <div class="min-w-[300px] p-4 border rounded-lg shadow-lg flex flex-col items-center bg-white">
                            <img src="/images/contacto.png" alt="Contacto" class="w-16 h-16">
                            <h3 class="mt-2 text-lg font-semibold">Contacto</h3>
                            <p class="text-sm text-gray-600">Mantengo contacto visual con mis compañeros y clientes cuando
                                estoy cerca de ellos.</p>
                        </div>

                        <!-- 🔹 Tarjeta 2 -->
                        <div class="min-w-[300px] p-4 border rounded-lg shadow-lg flex flex-col items-center bg-white">
                            <img src="/images/reconocimiento.png" alt="Reconocimiento" class="w-16 h-16">
                            <h3 class="mt-2 text-lg font-semibold">Reconocimiento</h3>
                            <p class="text-sm text-gray-600">Me dirijo al cliente por su nombre al menos en dos ocasiones en
                                cada interacción.</p>
                        </div>

                        <!-- 🔹 Tarjeta 3 -->
                        <div class="min-w-[300px] p-4 border rounded-lg shadow-lg flex flex-col items-center bg-white">
                            <img src="/images/estandares.png" alt="Estándares" class="w-16 h-16">
                            <h3 class="mt-2 text-lg font-semibold">Estándares</h3>
                            <p class="text-sm text-gray-600">Los estándares de servicio son nuestra ventaja competitiva.</p>
                        </div>

                        <!-- 🔹 Tarjeta 4 -->
                        <div class="min-w-[300px] p-4 border rounded-lg shadow-lg flex flex-col items-center bg-white">
                            <img src="/images/cordialidad.png" alt="Cordialidad" class="w-16 h-16">
                            <h3 class="mt-2 text-lg font-semibold">Cordialidad</h3>
                            <p class="text-sm text-gray-600">Siempre obsequio una sonrisa a mis compañeros y clientes.</p>
                        </div>

                        <!-- 🔹 Tarjeta 5 -->
                        <div class="min-w-[300px] p-4 border rounded-lg shadow-lg flex flex-col items-center bg-white">
                            <img src="/images/imagen.png" alt="Imagen" class="w-16 h-16">
                            <h3 class="mt-2 text-lg font-semibold">Imagen</h3>
                            <p class="text-sm text-gray-600">Mi presentación y la de mi área de trabajo es impecable.</p>
                        </div>

                        <!-- 🔹 Tarjeta 6 -->
                        <div class="min-w-[300px] p-4 border rounded-lg shadow-lg flex flex-col items-center bg-white">
                            <img src="/images/prevencion.png" alt="Prevención" class="w-16 h-16">
                            <h3 class="mt-2 text-lg font-semibold">Prevención</h3>
                            <p class="text-sm text-gray-600">Me concentro en prevenir riesgos para mí y para los demás.</p>
                        </div>

                        <!-- 🔹 Tarjeta 7 -->
                        <div class="min-w-[300px] p-4 border rounded-lg shadow-lg flex flex-col items-center bg-white">
                            <img src="/images/apropiacion.png" alt="Apropiacion" class="w-16 h-16">
                            <h3 class="mt-2 text-lg font-semibold">Apropiacion</h3>
                            <p class="text-sm text-gray-600">Ante el cliente yo represento a mundo imperial, por lo que me
                                apropio de cualquier solicitud suya y me encargo a darle solucion hasta su satisfaccion.</p>
                        </div>
                        <!-- 🔹 Tarjeta 8 -->
                        <div class="min-w-[300px] p-4 border rounded-lg shadow-lg flex flex-col items-center bg-white">
                            <img src="/images/alternativas.png" alt="Alternativas" class="w-16 h-16">
                            <h3 class="mt-2 text-lg font-semibold">Alternativas</h3>
                            <p class="text-sm text-gray-600">Ofrezco al cliente al menos dos opciones evitando decir no</p>
                        </div>
                        <!-- 🔹 Tarjeta 9 -->
                        <div class="min-w-[300px] p-4 border rounded-lg shadow-lg flex flex-col items-center bg-white">
                            <img src="/images/informaciongm.png" alt="Informacion" class="w-16 h-16">
                            <h3 class="mt-2 text-lg font-semibold">Informacion</h3>
                            <p class="text-sm text-gray-600">Me mantengo informado para poder orientar al cliente
                                eficientemente</p>
                        </div>
                        <!-- 🔹 Tarjeta 10 -->
                        <div class="min-w-[300px] p-4 border rounded-lg shadow-lg flex flex-col items-center bg-white">
                            <img src="/images/diversion.png" alt="Diversion" class="w-16 h-16">
                            <h3 class="mt-2 text-lg font-semibold">Diversion</h3>
                            <p class="text-sm text-gray-600">Disfruto mi trabajo y me divierto</p>
                        </div>
                    </div>
                </div>
            </section>
        </main>
    </div>

@endsection
