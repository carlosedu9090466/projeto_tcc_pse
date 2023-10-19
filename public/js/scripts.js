
var controle = 1;
function adicionarCampo() {
    controle++;
    document.getElementById('formulario').insertAdjacentHTML('beforeend',
        "<div class='form-group'><input type='text' class='form-control' id='pergunta[]' name='pergunta[]' minlength='5' maxlength='100' placeholder = '?Digite a pergunta?' ></div >")
}





var btnSignin = document.querySelector("#signin");
var btnSignup = document.querySelector("#signup");

var body = document.querySelector("body");


btnSignin.addEventListener("click", function () {
    body.className = "sign-in-js";
});

btnSignup.addEventListener("click", function () {
    body.className = "sign-up-js";
})



function mostrarDivEscola() {
    var clickUsuario = document.getElementById("divEscola");

    if (clickUsuario.style.display === 'none') {
        clickUsuario.style.display = 'flex';
    } else {
        clickUsuario.style.display = 'none';
    }
}
