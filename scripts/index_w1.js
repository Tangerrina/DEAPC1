function valida()//Função de validação do formulário
{
    document.getElementById("place").innerHTML="<b>Chamada à função de validação! ;)<b>";
    //var nome = document.getElementById("nome").value;
    //var idade = document.getElementById("idade").value;
    //var nome = document.getElementsByName("nome")[0].value;
    //var idade= document.getElementsByName("idade")[0].value;
    //se name="ambos" em ambos os inputs, então, seria:
    //var nome = document.getElementsByName("ambos")[0].value;
    //var idade = document.getElementsByName("ambos")[1].value;
    //var nome = document.forms["myform"]["nome"].value;
    //var idade = document.forms["myform"]["idade"].value;
    var nome = myform.nome.value;
    var idade = myform.idade.value;
    
    //nome:
    //Definição de uma expressão regulares teste do nome
    var detetor1=/[^a-zA-Z]/;
    var flag1 = detetor1.test(nome); //flag1 = true se aparece qualquer caracter diferente de uma letra.

    c1 = document.getElementById("nome");
    if(nome.length==0)
    {
      window.alert("o campo nome está vazio!");
      c1.value = "Campo vazio";
      c1.style.border="2px dashed black";
      c1.style.background="red";
      return false;
    }
    else if(isNaN(nome) && !flag1)
          {
            c1.value = "Campo OK!";
            c1.style.background="green"; 
          }
          else
          {
            window.alert("Campo Inválido!");
            c1.value = "Campo Inválido!";
            c1.style.border="2px dashed brown";
            c1.style.background="magenta"; 
            return false;     
          }

  //idade:
  c2 = document.getElementById("idade");
  if(idade.length==0)
    {
      window.alert("o campo idade está vazio!");
      c2.value = "Campo vazio";
      c2.style.border="2px dashed black";
      c2.style.background="red";
      return false;
    }
    else if(!isNaN(idade))
          {
            c2.value = "Campo OK!";
            c2.style.background="green"; 
          }
          else
          {
            window.alert("Campo Inválido!");
            c2.value = "Campo Inválido!";
            c2.style.border="2px dashed brown";
            c2.style.background="magenta"; 
            return false;     
          }

   return true;//não é necessário porque dá true por default
  }

//Activa e desativa div;
function controla_div_by_link()
{
  var x = document.getElementById('target');
  if(x.style.display == "none" || x.style.display == "")
     {
      x.style.display = "block";
      document.getElementById('check1').checked=true;
      document.getElementById('check2').checked=true;
      document.getElementById('mylink').style.color="green";
     }
  else
     {
      x.style.display = "none";
      document.getElementById('check1').checked=false;
      document.getElementById('check2').checked=false;
      document.getElementById('mylink').style.color="blue";
     }
}

function controla_div_by_checkbox()
{
  var x = document.getElementById('target');
  var y = document.getElementById('check1').checked;
  if(y && (x.style.display == "none" || x.style.display == ""))
     {
      x.style.display = "block";
      document.getElementById('check1').checked=true;
      document.getElementById('check2').checked=true;
      document.getElementById('mylink').style.color="green";
     }
  else
     {
      x.style.display = "none";
      document.getElementById('check1').checked=false;
      document.getElementById('check2').checked=false;
      document.getElementById('mylink').style.color="blue";
     }
}

function controla_div_by_radio()
{
  var x = document.getElementById('target');
  var z = document.getElementById('check2').checked;
  if(z && (x.style.display == "none" || x.style.display == ""))
     {
      x.style.display = "block";
      document.getElementById('check1').checked=true;
      document.getElementById('check2').checked=true;
      document.getElementById('mylink').style.color="green";
     }
     else
     {
      x.style.display = "none";
      document.getElementById('check1').checked=false;
      document.getElementById('check2').checked=false;
      document.getElementById('mylink').style.color="blue";
     }
}