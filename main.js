function verificaConfirmaSenha(confirmaSenha){
    senha = $("#senha").val();
    if(senha != confirmaSenha){
        $("#erroConfirmaSenha").removeClass("hide");
    }else{
        $("#erroConfirmaSenha").addClass("hide");
    }
}

function verificaServico(id,value){
    let servico = document.getElementById('outroTipoServico')
    
    if(value == 'Outro'){
        servico.classList.remove('hide');
    }else{
        servico.classList.add('hide');
    }
}

function mostraFuncionario2(){
    let funcionario = document.getElementById('funcionario2');
  
    if(funcionario.classList.contains('hide')){
        funcionario.classList.remove('hide');
    }else{
        funcionario.classList.add('hide');
    }
}

function agendamentoPrevisao(value){
    let inputPrevisao = document.getElementById('inputPrevisao');

    if(value == 'true'){
        inputPrevisao.classList.remove('hide');
        document.getElementById("enderecoDiv").style.marginTop ='70px';
    }else{
        inputPrevisao.classList.add('hide');
        document.getElementById("enderecoDiv").style.marginTop ='0px';
    }
    
}

function chegada(){
    $("#previsaoChegada").mask("00/00/0000 00:00")
}