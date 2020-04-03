/*
 *  Script com a lógica do cronometro.
 *  Ele possui o esqueleto dos método essenciais.
 *  Modifique este arquivo o quanto for necessário.
 *
 */
var comecar = false
var restart = false
var chora = 0
var cminuto = 0
var csegundo = 0
var cmilissegundo = 0


// Funcao para atualizar o display do cronometro no html.
// Dica: use do método 'setInterval' para executálo a cada 50 milissegundos.
function updateVisualization() {


    setInterval(() => {
        var hora = document.getElementsByClassName('hora');
        var minuto = document.getElementsByClassName('minuto');
        var segundo = document.getElementsByClassName('segundo');
        var milissegundo = document.getElementsByClassName('milissegundo');
        if (restart = false) {

            cmilissegundo = cmilissegundo + 50

            if (cmilissegundo >= 1000) {
                cmilissegundo = 0
                csegundo += 1
            }
            if (csegundo >= 60) {
                csegundo = 0
                cminuto += 1
            }
            if (cminuto >= 60) {
                cminuto = 0
                chora += 0
            }
        } else {
            chora = 0
            cminuto = 0
            csegundo = 0
            cmilissegundo = 0
            ccomecar = false

        }


        hora.innerHTML = chora
        minuto.innerHTML = cminuto
        segundo.innerHTML = csegundo
        milissegundo.innerHTML = cmilissegundo
        console.log("hora: " + chora + " minuto: " + cminuto + " segunto: " + csegundo + " milissegundo: " + cmilissegundo)
        console.log("start: " + comecar)
        console.log("Reiniciar: " + restart)

    }, 50);

}

// Funcao executada quando o botão 'Inicar' é clicado
// - se o cronometro estiver parado, iniciar contagem.
// - se estiver ativo, reiniciar a contagem
function start() {
    updateVisualization()
    comecar = true
}

// Funcao executada quando o botão 'Parar' é clicado
// - se o cronometro estiver ativo, parar na contagem atual
function stop() {
    comecar = false
}

// Funcao executada quando o botão 'Reiniciar' é clicado
// - se o cronometro estiver ativo, reiniciar contagem
// - se estiver parado, zerar e permanecer zerado
function reiniciar() {
    restart = true
}