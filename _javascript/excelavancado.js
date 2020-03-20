function preload(){
    for(f=1;f<=9;f++){
        imgs = Array('excel_avancado1' + f + '.jpg');
    }
    imgQtde = imgs.length;
    for(i=0;i<imgQtde;i++){
        var preloadimg = new Image();
        preloadimg.src=imgs[i];
    }
}
function mudaFoto (foto) {
/* funcao mudaFoto recebe um parametro foto */
document.getElementById("icone").src = foto;
}
function iniciaSlider(){
    preload();
    min=1;//inicia o slide
    max=9;//ultimo slide 
    fi=min;
    carregaFoto("_imagens/excel_avancado1.jpg");
    tmp=10000;
    tmr=setInterval(trocaFoto,tmp);
}
function carregaFoto(foto){
    document.getElementById("moldura").style.backgroundImage=("URL("+ foto +")");
}
function trocaFoto(){
    fi++;
    if(fi>max){
        fi=min;
    }
    carregaFoto("_imagens/excel_avancado"+ fi +".jpg");
}
function ant(){
    clearInterval(tmr);
    fi--;
    if(fi<min){
        fi=max;
    }
    carregaFoto("_imagens/excel_avancado"+ fi +".jpg");
    tmr=setInterval(trocaFoto,tmp);
}
function prox(){
    clearInterval(tmr);
    fi++;
    if(fi>max){
        fi=min;
    }
    carregaFoto("_imagens/excel_avancado"+ fi +".jpg");
    tmr=setInterval(trocaFoto,tmp);
}