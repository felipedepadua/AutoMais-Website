
function goBack() {
    window.history.back();
}


function exibir(id_janela,id_peca,peca,preco,quantidade,fornecedor) {
        document.getElementById(id_janela).style.display="";
        	//document.getElementById("demo").innerHTML = id_peca;
        document.getElementById("id_f").value = id_peca;
        document.getElementById("peca_f").value = peca;
        document.getElementById("preco_f").value = preco;
        document.getElementById("quantidade_f").value = quantidade;
        document.getElementById(fornecedor).selected = "true";      
}





