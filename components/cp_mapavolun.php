<section style='top:0px; left:0px;'>

    <img src="img/mapa.png" id="mapa_fundo">
    <div style='position:absolute; top:130px; left:145px;'>
        <i class="fas fa-map-marker-alt fa-2x mt-2 mb-2"></i>
    </div>

    <div style='position:absolute; top:165px; left:100px;'>
        <p>Você está aqui</p>

    </div>

    <a href="#modal">
        <div style='position:absolute; top:350px; left:80px;'>

            <i class="fas fa-map-pin fa-3x" style="color: red;"></i>
            <div class="text-center bg-dark arr_txt_box">
                <span class="font-weight-bold text-white ml-2 mr-2">Restaurante A</span><br><span class=" font-weight-bold text-white ml-2 mr-2">Excedentes X</span>
            </div>

        </div>
    </a>
    <div class="modal" id="modal" tabindex="-1">
        <a href="#" class="modal__overlay" aria-label="Fechar"></a>
        <div class="modal__content ">
            <div class=" pt-5">
                <div class="centro">
                    <i class="fas fa-exclamation-triangle text-warning fa-2x"></i><br>
                </div>
                <div class="centro">
                    <h1 class="text-center text-dark"><b>Confirmar Recolha?</b></h1>
                </div>
                <p class="text-center">Pretende aceitar a recolha dos excedentes?</p>
            </div>
            <div class="centro p-2 mb-3 botaopop verde">
                <a href="mapa_voluntario_2.html" class="modal__close text-white ">
                    <i class="fas fa-check text-white"></i>
                    <b>Aceitar</b>
                </a>
            </div>
            <div class="p-2 mt-1  vermelho centro botaopop">
                <a href="mapa_voluntario_2.html" class="modal__close text-white ">
                    <b><i class="fas fa-times"></i> Rejeitar</b>
                </a>
            </div>
        </div>
    </div>


</section>

<a href="#"><div  class="text-center divbuttonplus">
        <img src="img/iconrecolhasbicla.png" id="plusbutton" class="mx-auto align-content-center" height="50" width="50">
    </div> </a>