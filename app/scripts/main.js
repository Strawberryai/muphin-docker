let title_anim_start = 500;
let title_anim_wait = 1000;

window.onload = function(){
    let hi = document.getElementById('hi');
    let muf = document.getElementById('muf');

    setTimeout(() => {
        // Iniciamos la animación del título

        hi.style.transform = "translateY(0)";
        hi.style.opacity = "1.0";

        setTimeout(() => {
            muf.style.opacity = "1.0";
        }, title_anim_wait);

    }, title_anim_start);
}
