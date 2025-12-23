const actions = [];

const canvas = document.querySelector('canvas');
const form = document.querySelector('.signature-pad-form');
const clearButton = document.querySelector('.clear-button');

const ctx = canvas.getContext('2d');

let writingMode = false;
let positionX;
let positionY;

let imageURL;
























const getCursorPosition = (event) => {
    positionX = event.clientX - event.target.getBoundingClientRect().x;
    positionY = event.clientY - event.target.getBoundingClientRect().y;
    return [positionX, positionY];
}

const handlePointerDown = (event) => {
    writingMode = true;
    ctx.beginPath();
    const [positionX, positionY] = getCursorPosition(event);
    ctx.moveTo(positionX, positionY);
}

const handlePointerUp = () => {
    writingMode = false;
}

const handlePointerMove = (event) => {
    if (!writingMode) return
    const [positionX, positionY] = getCursorPosition(event);
    ctx.lineTo(positionX, positionY);
    ctx.stroke();
}

canvas.addEventListener('pointerdown', handlePointerDown, {passive: true});
canvas.addEventListener('pointerup', handlePointerUp, {passive: true});
canvas.addEventListener('pointermove', handlePointerMove, {passive: true});

ctx.lineWidth = 3;
ctx.lineJoin = ctx.lineCap = 'round';

/*form.addEventListener('submit', (event) => {
    event.preventDefault();
    const imageURL = canvas.toDataURL();
    const image = document.createElement('img');
    image.src = imageURL;
    image.height = canvas.height;
    image.width = canvas.width;
    image.style.display = 'block';
    form.appendChild(image);
    clearPad();
})*/

form.addEventListener('submit', (event) => {
    event.preventDefault();
    imageURL = canvas.toDataURL();
    const image = document.createElement('img');
    image.src = imageURL;
    image.height = canvas.height;
    image.width = canvas.width;
    image.style.display = 'block';
    canvas.replaceWith(image);

    console.log(actions)

    let img_data = {
        signature: imageURL
    }
    actions.push(img_data);

    document.getElementById('signinput').value = imageURL;

    clearPad();
})

const clearPad = () => {
    ctx.clearRect(0, 0, canvas.width, canvas.height);
}

clearButton.addEventListener('click', (event) => {
    event.preventDefault();
    clearPad();
})





















































//para guardar los datos de la accion
const addActions = (ev)=>{
    var source = document.actionsform.source.value;
    var solution = document.actionsform.solution.value;
    var property = document.actionsform.property.value;
    var description = document.actionsform.description.value;
    var process = document.actionsform.process.value;
    var cost = document.actionsform.cost.value;
    var opportunity = document.actionsform.opportunity.value;
    var responsible = document.actionsform.responsible.value;
    var concept = document.actionsform.concept.value;
    var begin = document.actionsform.begin.value;
    var cause = document.actionsform.cause.value;
    var end = document.actionsform.end.value;
    var comment = document.actionsform.comment.value;

    ev.preventDefault();  //para que el formulario no se envie

    let action = {
        origen: source,
        tipo_solucion: solution,
        propiedad: property,
        descripcion: description,
        proceso: process,
        costo: cost,
        oportunidad: opportunity,
        responsable: responsible,
        criterio: concept,
        fecha_inicio: begin,
        causa_raiz: cause,
        fecha_cumplimiento: end,
        observacion: comment
    }

    actions.push(action);
    //document.forms[0].reset(); //limpia el formulario para nueva accion
    document.getElementById('actform').reset();

    //para guardar en localStorage
    localStorage.setItem('Actions', JSON.stringify(actions) );
    
    //para mostrar la accion en la tabla
    var tr = document.createElement('tr');
    
    var td1 = tr.appendChild(document.createElement('td'));
    var td2 = tr.appendChild(document.createElement('td'));
    var td3 = tr.appendChild(document.createElement('td'));
    var td4 = tr.appendChild(document.createElement('td'));
    var td5 = tr.appendChild(document.createElement('td'));
    var td6 = tr.appendChild(document.createElement('td'));
    
    td1.innerHTML=source;
    td2.innerHTML=process;
    td3.innerHTML=opportunity;
    td4.innerHTML=description;
    td5.innerHTML=responsible;
    td6.innerHTML=end;

    document.getElementById('actionstable').appendChild(tr);
 
    //envia las acciones como JSON en la url
    

    console.log(imageURL);
        
}

function sendJSON(){
    const url = "print?data=" + encodeURIComponent(JSON.stringify(actions));
    document.getElementById('obj-url').href = url;
}

document.getElementById('obj-url').addEventListener('click', sendJSON);

//evento para el boton Guardar
document.addEventListener('DOMContentLoaded', ()=>{
    document.getElementById('saveactions').addEventListener('click', addActions);
});

//muestra la ventana de vista previa
$(document).ready(function(){
    $('#modal-btn').click(function(){
        $('#modal-plan').modal('show');
    });
});

//rellena la tabla que se muestra en la vista previa
function previewTable(){
    let tbody = document.getElementById("tablebody");

    //limpia la tabla manteniendo el header
    $("#previewtable tbody tr").remove();

    actions.forEach((action) => {
        let row = document.createElement("tr");
        let td1 = document.createElement("td");
        let td2 = document.createElement("td");
        let td3 = document.createElement("td");
        let td4 = document.createElement("td");
        let td5 = document.createElement("td");
        let td6 = document.createElement("td");

        td1.innerHTML = action.origen;
        td2.innerHTML = action.proceso;
        td3.innerHTML = action.oportunidad;
        td4.innerHTML = action.descripcion;
        td5.innerHTML = action.responsable;
        td6.innerHTML = action.fecha_cumplimiento;

        row.appendChild(td1);
        row.appendChild(td2);
        row.appendChild(td3);
        row.appendChild(td4);
        row.appendChild(td5);
        row.appendChild(td6);
        // append the row element 
        tbody.appendChild(row);
    });
}

document.getElementById('modal-btn').addEventListener('click', previewTable);