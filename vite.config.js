import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import { glob } from 'glob';

// Obtener todos los archivos CSS/JS automáticamente
const getResources = (path) => glob.sync(`resources/${path}`);

export default defineConfig({
  plugins: [
    laravel({
      input: [
        // — Recursos generales de MyQuality (se cargan con glob) —
        ...getResources('css/*.css'),
        ...getResources('css/modules/**/*.css'),
        ...getResources('js/*.js'),
        ...getResources('js/modules/**/*.js'),

        // — Archivos CSS específicos del módulo de “residuos” —
        'resources/css/inicio.css',
        'resources/css/modules/residuos/app.css',
        'resources/css/modules/residuos/areaprocedencia.css',
        'resources/css/modules/residuos/tiporesiduo.css',
        'resources/css/modules/residuos/estadistico.css',
        'resources/css/modules/residuos/estadistico_barra.css',
        'resources/css/modules/residuos/entradas.css',
        'resources/css/modules/residuos/salidas.css',
        'resources/css/modules/residuos/compras.css',
        'resources/css/modules/residuos/poblacion.css',

        // — Archivos JS específicos del módulo de “residuos” —
        'resources/js/modules/residuos/app.js',
        'resources/js/modules/residuos/areaprocedencia.js',
        'resources/js/modules/residuos/tiporesiduo.js',
        'resources/js/modules/residuos/estadistico.js',
        'resources/js/modules/residuos/entradas.js',
        'resources/js/modules/residuos/salidas.js',
        'resources/js/modules/residuos/compras.js',
        'resources/js/modules/residuos/poblacion.js',
      ],
      refresh: true,
    }),
  ],
});
