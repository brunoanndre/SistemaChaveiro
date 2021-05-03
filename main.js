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

function mostrarEndereco(){
    let tipo = document.getElementById('tipoCliente').value;
    let endereco = document.getElementById('endereco');
    if(tipo == 'Condomínio'){
        endereco.classList.remove('hidden');
    }else{
        endereco.classList.add('hidden');
    }
}

function verificaTipo(value){
    let cnpj = document.getElementById('cnpj');
    let cpf = document.getElementById('cpf');

    if(value == 'Empresa' || value == 'Condomínio'){
        cpf.classList.add('hidden');
        cnpj.classList.remove('hidden');
    }else{
        cpf.classList.remove('hidden');
        cnpj.classList.add('hidden');
    }
}



function verificaCpf(cpf){
    if (cpf == ""){
        $("#erroCpf").addClass("hide");
        return;
    }
    cpf = cpf.split(".").join("").replace('-','');
    var numeros, digitos, soma, i, resultado;
    var digitos_iguais = true;
    digitos_iguais = 1;
    if(cpf.length < 11){
        $("#erroCpf").removeClass("hide");
        return;
    }
    for(i = 0; i < cpf.length - 1; i++){
        if (cpf.charAt(i) != cpf.charAt(i + 1)){
            digitos_iguais = false;
            break;
        }
    }
    if(!digitos_iguais){
        numeros = cpf.substring(0,9);
        digitos = cpf.substring(9);
        soma = 0;
        for (i = 10; i > 1; i--){
            soma += numeros.charAt(10 - i) * i;
        }
        resultado = soma % 11 < 2 ? 0 : 11 - soma % 11;
        if (resultado != digitos.charAt(0)){
            $("#erroCpf").removeClass("hide");
            return;
        }
        numeros = cpf.substring(0,10);
        soma = 0;
        for (i = 11; i > 1; i--){
            soma += numeros.charAt(11 - i) * i;
        }
        resultado = soma % 11 < 2 ? 0 : 11 - soma % 11;
        if (resultado != digitos.charAt(1)){
            $("#erroCpf").removeClass("hide");
            return;
        }
        $("#erroCpf").addClass("hide");
        return;
    }else{
        $("#erroCpf").removeClass("hide");
        return;
    }
}

function mostrarClientes(idInput,value){
    var id = 'buscar_'+idInput;
 
    
    if (value.length===0) { 
        document.getElementById(id).innerHTML="";
        document.getElementById(id).style.border="0px";
        return;
    }

    if (window.XMLHttpRequest) {
        // code for IE7+, Firefox, Chrome, Opera, Safari
        xmlhttp=new XMLHttpRequest();
    } else {  // code for IE6, IE5
        xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange=function() {
        if (this.readyState==4 && this.status==200) {

           document.getElementById(id).innerHTML=this.responseText;
            document.getElementById(id).style.border="1px solid #A5ACB2";
        }
    }
    xmlhttp.open("GET","buscarCliente.php?value="+value+"&id="+id,true);
    xmlhttp.send();
}

function selecionaCliente(value,id){
    let idHide = document.getElementById('buscar_cliente');
    id.value = value;
    idHide.innerHTML = ""
    idHide.style.border = "0px"; 
}

function cadastrarClienteModal(){

    var idCliente = $("#idCliente").val();
    var nomeCliente = $("#nomeCliente").val();
    var emailCliente = $("#emailCliente").val();
    var tipoCliente = $("#tipoCliente").val();
    var cpfCliente = $("#cpfCliente").val();
    var cnpjCliente = $("#cnpjCliente").val();
    var telefoneCliente = $("#telefoneCliente").val();
    var emailCliente = $("#emailCliente").val();
    var cidade = $("#cidade").val();
    var bairro = $("#bairro").val();
    var logradouro = $("#logradouro").val();
    var numero = $("#numero").val();
    var referencia = $("#referencia").val();



    if (window.XMLHttpRequest) {
        // code for IE7+, Firefox, Chrome, Opera, Safari
        xmlhttp=new XMLHttpRequest();
    } else {  // code for IE6, IE5
        xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange=function() {
        if(this.readyState == 4 && this.status == 200){
            document.getElementById('alertComandaSucesso').innerHTML=this.responseText;
            document.getElementById('cliente').value = nomeCliente;
        }
    }
    xmlhttp.open("GET","cadastrarClienteModal.php?nomeCliente="+nomeCliente+"&emailCliente="+emailCliente+"&telefoneCliente="+telefoneCliente+"&tipoCliente="+tipoCliente+"&cpfCliente="+cpfCliente+"&cnpjcliente="+cnpjCliente+"&cidade="+cidade+"&bairro="+bairro+"&logradouro="+logradouro+"&numero="+numero+"&referencia="+referencia,true);
    xmlhttp.send();
    
    $('#modalCliente').modal('hide');
}

function inserirMaterial(){
    let material = document.getElementById('inputMaterial').value;
    let lista = document.getElementById('listaMateriais');


    lista.innerHTML += '<li><label style="color:green;">' +  material  + '</label></li>';
    


    if(document.getElementById('material1').value == ""){
        document.getElementById('material1'). value = material;
    }else if(document.getElementById('material2').value == ""){
        document.getElementById('material2').value = material;
    }else if(document.getElementById('material3').value == ""){
        document.getElementById('material3').value = material;
    }else{
        document.getElementById('material4').value = material;
    }

    document.getElementById('inputMaterial').value = "";
    $('#modalMateriais').modal('hide');

}