window.onload = function(){
    let anim_secuence = [
        {"wait": 50, "funct": show_title_hi},
        {"wait": 800, "funct": show_title_muf},
        {"wait": 800, "funct": show_res_hi},
        {"wait": 50, "funct": show_content}
    ].reverse();

    create_animation_secuence(anim_secuence)

}

function create_animation_secuence(secuence){
    anim = secuence.pop()
    if(anim == undefined) return;

    return setTimeout(()=>{
        let funct = new anim.funct()
        funct.exec()

        create_animation_secuence(secuence)

    }, anim.wait)
}

class show_title_hi{
    exec(){
        let hi = document.getElementById('hi');
        hi.style.transform = "translateY(0)";
        hi.style.opacity = "1.0";
    }
}

class show_title_muf{
    exec(){
        let muf = document.getElementById('muf');
        muf.style.opacity = "1.0";
    }
}

class show_res_hi{
    exec(){
        let reshi = document.getElementById('res-hi')
        reshi.style.opacity = "1.0";
    }
}

class show_content{
    exec(){
        let content = document.getElementsByClassName('content')
        console.log(content)
        for (let item of content) {
            item.style.transform = "translateY(0)";
            item.style.opacity = "1.0";

        }
    }
}

