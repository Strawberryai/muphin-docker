// Script para controlar la visibilidad del dropdown menu
// Alan García Justel

// Tomamos el botón de opciones y los drop_elms del DOM
let nav_opt = document.getElementById('nav_options');
let drop_elms = document.getElementById('drop_elms');

// Añadimos un Listener del click a la ventana
window.addEventListener('click', (event) => {
    if(nav_opt.contains(event.target)){
        // Si hacemos click sobre el menú lo mostramos
        dropdown_show_hide(true)
    }else if(!drop_elms.contains(event.target)){
        // Si no, lo ocultamos 
        dropdown_show_hide(false)
    }

});

function dropdown_show_hide(show){
    if(show){
        // Mostramos el menú
        drop_elms.classList.remove("dropdown-content-hide")
        drop_elms.classList.add("dropdown-content-show")
        drop_elms.style.visibility = "visible";

    }else{
        // Ocultamos el menú dando un tiempo para la animacón
        drop_elms.classList.add("dropdown-content-hide")
        drop_elms.classList.remove("dropdown-content-show")
        setTimeout(() => {
            drop_elms.style.visibility = "hidden";
        }, 70)
    }
}
