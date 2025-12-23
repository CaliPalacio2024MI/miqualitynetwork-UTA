import Alpine from 'alpinejs';
import Konva from "konva";
import SignaturePad from 'signature_pad';
import Swal from 'sweetalert2';
import './bootstrap';

window.Konva = Konva;
window.SignaturePad = SignaturePad;
window.Alpine = Alpine;
window.Swal = Swal;
Alpine.start();
