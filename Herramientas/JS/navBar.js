var sesionROL = document.getElementById('SesionRol').value;

console.log(sesionROL);
//PARA CLIENTE - CLIENTE
if (sesionROL == 2) {

    //Identificador del NAVBAR
    let app = document.querySelector('#divPO');

    //Removemos Contenido
    app.innerHTML = "";

    //Crear un nuevo Elemento con sus atributos A
    var element0 = document.createElement("a");
    element0.setAttribute("class", "flex-sm-fill text-sm-center nav-link");
    element0.setAttribute("href", "?controlador=Principal&accion=mostrar");
    element0.innerHTML = 'Inicio';

    var element1 = document.createElement("a");
    element1.setAttribute("class", "flex-sm-fill text-sm-center nav-link");
    element1.setAttribute("href", "?controlador=clienteP&accion=apartadoP");
    element1.innerHTML = 'Tienda';

    var element11 = document.createElement("a");
    element11.setAttribute("class", "flex-sm-fill text-sm-center nav-link");
    element11.setAttribute("href", "?controlador=VC&accion=verificar_citas");
    element11.innerHTML = 'Crear cita';

    var element2 = document.createElement("a");
    element2.setAttribute("class", "flex-sm-fill text-sm-center nav-link");
    element2.setAttribute("href", "?controlador=ReadC&accion=Comprar");
    element2.innerHTML = 'Carrito';

    var element3 = document.createElement("a");
    element3.setAttribute("class", "flex-sm-fill text-sm-center nav-link");
    element3.setAttribute("href", "?controlador=ReadC&accion=cuenta_listas");
    element3.innerHTML = 'Cuenta y Lista';

    var element4 = document.createElement("a");
    element4.setAttribute("class", "flex-sm-fill text-sm-center nav-link");
    element4.setAttribute("href", "?controlador=Login&accion=cerrar");
    element4.innerHTML = 'Cerrar Sesión';


    //Se lo mandamos al NAVBAR
    app.appendChild(element0);
    app.appendChild(element1);
    app.appendChild(element11);
    app.appendChild(element2);
    app.appendChild(element3);
    app.appendChild(element4);
}

//PARA ADMINISTRADOR - ADMINISTRADOR
if (sesionROL == 1) {

    //Identificador del NAVBAR
    let app = document.querySelector('#divPO');

    //Removemos Contenido
    app.innerHTML = "";

    //Crear un nuevo Elemento con sus atributos A
    var element00 = document.createElement("a");
    element00.setAttribute("class", "flex-sm-fill text-sm-center nav-link");
    element00.setAttribute("href", "?controlador=Principal&accion=mostrar");
    element00.innerHTML = 'Inicio';

    var element0 = document.createElement("a");
    element0.setAttribute("class", "flex-sm-fill text-sm-center nav-link");
    element0.setAttribute("href", "?controlador=clienteP&accion=apartadoP");
    element0.innerHTML = 'Tienda';

    var element1 = document.createElement("a");
    element1.setAttribute("class", "flex-sm-fill text-sm-center nav-link");
    element1.setAttribute("href", "?controlador=administrador&accion=inicio");
    element1.innerHTML = 'Administrador';

    var element2 = document.createElement("a");
    element2.setAttribute("class", "flex-sm-fill text-sm-center nav-link");
    element2.setAttribute("href", "?controlador=Administrador&accion=inicio_administrador");
    element2.innerHTML = 'Reportes';

    var element3 = document.createElement("a");
    element3.setAttribute("class", "flex-sm-fill text-sm-center nav-link");
    element3.setAttribute("href", "?controlador=empleados&accion=inicio");
    element3.innerHTML = 'Empleados';

    var element4 = document.createElement("a");
    element4.setAttribute("class", "flex-sm-fill text-sm-center nav-link");
    element4.setAttribute("href", "?controlador=cliente&accion=inicio");
    element4.innerHTML = 'Clientes';

    var element5 = document.createElement("a");
    element5.setAttribute("class", "flex-sm-fill text-sm-center nav-link");
    element5.setAttribute("href", "?controlador=producto&accion=inicio");
    element5.innerHTML = 'Productos';

    var element6 = document.createElement("a");
    element6.setAttribute("class", "flex-sm-fill text-sm-center nav-link");
    element6.setAttribute("href", "?controlador=materia&accion=inicio");
    element6.innerHTML = 'Materia';

    var element9 = document.createElement("a");
    element9.setAttribute("class", "flex-sm-fill text-sm-center nav-link");
    element9.setAttribute("href", "?controlador=herramienta&accion=inicio");
    element9.innerHTML = 'Herramientas';

    var element8 = document.createElement("a");
    element8.setAttribute("class", "flex-sm-fill text-sm-center nav-link");
    element8.setAttribute("href", "?controlador=Administrador&accion=inicio_prestaciones");
    element8.innerHTML = 'Prestaciones';

    var element7 = document.createElement("a");
    element7.setAttribute("class", "flex-sm-fill text-sm-center nav-link");
    element7.setAttribute("href", "?controlador=Login&accion=cerrar");
    element7.innerHTML = 'Cerrar Sesión';

    //Se lo mandamos al NAVBAR
    app.appendChild(element00);
    app.appendChild(element0);
    app.appendChild(element1);
    app.appendChild(element2);
    app.appendChild(element3);
    app.appendChild(element4);
    app.appendChild(element5);
    app.appendChild(element6);
    app.appendChild(element8);
    app.appendChild(element9);
    app.appendChild(element7);
}

if(sesionROL == 0){
    //Identificador del NAVBAR
    let app = document.querySelector('#divPO');

    //Removemos Contenido
    app.innerHTML = "";

    //Crear un nuevo Elemento con sus atributos A
    var element0 = document.createElement("a");
    element0.setAttribute("class", "flex-sm-fill text-sm-center nav-link");
    element0.setAttribute("href", "?controlador=Principal&accion=mostrar");
    element0.innerHTML = 'Inicio';

    var element1 = document.createElement("a");
    element1.setAttribute("class", "flex-sm-fill text-sm-center nav-link");
    element1.setAttribute("href", "?controlador=clienteP&accion=apartadoP");
    element1.innerHTML = 'Tienda';

    var element2 = document.createElement("a");
    element2.setAttribute("class", "flex-sm-fill text-sm-center nav-link");
    element2.setAttribute("href", "?controlador=Login&accion=inicio");
    element2.innerHTML = 'Iniciar sesión';

    //Se lo mandamos al NAVBAR
    app.appendChild(element0);
    app.appendChild(element1);
    app.appendChild(element2);
}

var currentLocation = location.href;
var menuItem = document.querySelectorAll('a');
var menuLenght = menuItem.length;

for (let i = 0; i < menuLenght; i++) {
    if (menuItem[i].href === currentLocation) {
        menuItem[i].className = "flex-sm-fill text-sm-center nav-link active";
    }
}

  var  sesionROL2 = document.getElementById('SesionRol2').value;
  console.log(sesionROL2);
    //PARA ADMINISTRADOR - USUARIO
if (sesionROL == 0 && sesionROL2 == 1) {
    
    //Identificador del NAVBAR
    let app = document.querySelector('#divPO');

    //Removemos Contenido
    app.innerHTML = "";


    //Crear un nuevo Elemento con sus atributos A
    var element0 = document.createElement("a");
    element0.setAttribute("class", "flex-sm-fill text-sm-center nav-link");
    element0.setAttribute("href", "?controlador=Principal&accion=mostrar");
    element0.innerHTML = 'Inicio';

    var element1 = document.createElement("a");
    element1.setAttribute("class", "flex-sm-fill text-sm-center nav-link");
    element1.setAttribute("href", "?controlador=clienteP&accion=apartadoP");
    element1.innerHTML = 'Tienda';

    var element2 = document.createElement("a");
    element2.setAttribute("class", "flex-sm-fill text-sm-center nav-link");
    element2.setAttribute("href", "?controlador=Login&accion=inicio");
    element2.innerHTML = 'Ventana administrador';

    //Se lo mandamos al NAVBAR
    app.appendChild(element0);
    app.appendChild(element1);
    app.appendChild(element2);

}

if( sesionROL == 0 && sesionROL2 == 2  ){
 //Identificador del NAVBAR
 let app = document.querySelector('#divPO');

 //Removemos Contenido
 app.innerHTML = "";

 //Crear un nuevo Elemento con sus atributos A
 var element0 = document.createElement("a");
 element0.setAttribute("class", "flex-sm-fill text-sm-center nav-link");
 element0.setAttribute("href", "?controlador=Principal&accion=mostrar");
 element0.innerHTML = 'Inicio';

 var element1 = document.createElement("a");
 element1.setAttribute("class", "flex-sm-fill text-sm-center nav-link");
 element1.setAttribute("href", "?controlador=clienteP&accion=apartadoP");
 element1.innerHTML = 'Tienda';

 var element2 = document.createElement("a");
 element2.setAttribute("class", "flex-sm-fill text-sm-center nav-link");
 element2.setAttribute("href", "?controlador=Login&accion=inicio");
 element2.innerHTML = 'Cuenta carrito y cita';

 //Se lo mandamos al NAVBAR
 app.appendChild(element0);
 app.appendChild(element1);
 app.appendChild(element2);
}



var currentLocation = location.href;
var menuItem = document.querySelectorAll('a');
var menuLenght = menuItem.length;
for (let i = 0; i < menuLenght; i++) {
    if (menuItem[i].href === currentLocation) {
        menuItem[i].className = "flex-sm-fill text-sm-center nav-link active";
    }
}

