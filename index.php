<html>
<head>
<meta name="author" content="n2ImageHost" />
<meta charset="utf-8" />
<meta name="language" content="pt-br" />
<meta name="robots" content="index, follow" /> 
<meta name="description" content="n2Imagehost é um site de upload de imagens gratuito feito principlamente para pessoas que tem a necessidade de hospedar as suas imagens facilmente e rapidamente, disponibilizamos upload ilimitado e hospedagem por tempo ilimitado." />
<meta  name="keywords" content="n2, image, host, upload, de, imagens, gratuito, free, image, hosting, png, gif, jpg, imagem, hospedagem, indeterminado, sem, limite, download, xp3, biz, site" />
<link rel='index' title='n2ImageHost - Upload de imagens gratuito' href='http://n2imagehost.xp3.biz/' />        
<link rel="icon" type="image/gif" href="favicon.gif" >

<title>n2ImageHost</title>
<style>

.realupload {
      position: relative;
      float: right;
      top: -21px;
      right: 3px;
      opacity:0;
      -moz-opacity:0;
      filter:alpha(opacity:0);
	  z-index: 1;
}

.fakeupload {
      width:450px;
      background: url("botao-selecione.png") no-repeat 99% 51%;
      cursor: default;
      background-color: #FFFFFF;
	  z-index: 2;
}

input {
      background-color: #FFFFFF;
      border: 1px solid #bebebe;
      letter-spacing: 1px;
      font-size: 11px;
      color: #333;
      padding-left: 5px;
      padding-top: 5px;
      padding-bottom: 5px;
      margin-left: 5px;
      height: 30px;
      vertical-align: middle;
}

/*ABAIXO SÓ É NECESSÁRIO PARA CRIAR O EXEMPLO*/
div#filestyle {
	margin: 0 auto;
	width: 450px;
}

body {
	background-color: #f7f7f7;
}

label {
	font-size: 11px;
	font-family: Verdana;
	padding: 10px;
}

#submit{
margin-left:9px;
margin-top:-23px;
 width: 455px;
 color:black;
 background-image:url(bg.png);
}

img{
text-decoration:none;
border:none;
}

table tr td#text{
text-align:center;
color:white;
background-color:#BEBEBE;
}

table tr td#code{
text-align:center;
color:#AEAEAE;
}

table{
margin-top:20px;
}

table tr td{
padding-left:10px;
padding-right:10px;
}

#rodape{
color:#BEBEBE;
}

a{
text-ecoration:none;
color:#AEAEAE
}
</style>
</head>
<body>
<center>
<br/><br/><br/>
<a href="index.php"><img src="logon2.png"></a>
<br/>
<br/>
<form name="newad" method="post" enctype="multipart/form-data"  action="">
 <table>
 	<tr><td>

	<div id="filestyle">
	 <input id="fakeupload" name="fakeupload" class="fakeupload"  type="text" />
	<input id="file" name="image" class="realupload" type="file" onChange="this.form.fakeupload.value = this.value;" />
</div>
<input name="Submit" type="submit" id="submit" value="Enviar">
</td></tr>
 	    </table>	
	 
	
	
	 
 </form>
<img src="hr.png">
<br/>

<?php
//tamanho maximo dos arquivos em Kb
 define ("MAX_SIZE","1024"); 

//Checa a extensao da imagem. e usado para determinar se o aruivo e uma imagem ou nao
 function getExtension($str) {
         $i = strrpos($str,".");
         if (!$i) { return ""; }
         $l = strlen($str) - $i;
         $ext = substr($str,$i+1,$l);
         return $ext;
 }

 $txt = "http://n2imagehost.xp3.biz/";

 
//essa variavel e usada como flag .o valor começa como (0) significando sem erros
//e sera mudada para 1 se algum erro aparecer  
//Se o erro ocorrer o arquivo não sera enviado.
 $errors=0;
//checa se o formulario foi enviado
 if(isset($_POST['Submit'])) 
 {
 	//checa o nome do arquivo
 	$image=$_FILES['image']['name'];
 	//se ele nao esta vazio
 	if ($image) 
 	{
 	//get the original name of the file from the clients machine
 		$filename = stripslashes($_FILES['image']['name']);
 	//get the extension of the file in a lower case format
  		$extension = getExtension($filename);
 		$extension = strtolower($extension);
 	//if it is not a known extension, we will suppose it is an error and will not  upload the file,  
	//otherwise we will do more tests
 if (
 
 ($extension != "jpg")
 && ($extension != "jpeg")
 && ($extension != "png")
 && ($extension != "gif")
 && ($extension != "bmp")
 && ($extension != "pdf")
 && ($extension != "rar")
 && ($extension != "zip")
 && ($extension != "txt")
 && ($extension != "doc")
 && ($extension != "docx")
 && ($extension != "ppt")
 && ($extension != "pptx")
 && ($extension != "xls")
 && ($extension != "avi")
 && ($extension != "3gp")
 && ($extension != "mp3")
 && ($extension != "mp4")
 && ($extension != "flv")
 && ($extension != "html")
 && ($extension != "css")
 && ($extension != "js")
 ) 
 		{
		//print error message
 			echo '<h1>Extensão Desconhecida! <img src="no.png"> </h1>';
 			$errors=1;
 		}
 		else
 		{
//get the size of the image in bytes
 //$_FILES['image']['tmp_name'] is the temporary filename of the file
 //in which the uploaded file was stored on the server
 $size=filesize($_FILES['image']['tmp_name']);

//compare the size with the maxim size we defined and print error if bigger
if ($size > MAX_SIZE*1024)
{
	echo '<h1>Você Excedeu O Limite de Tamanho <img src="no.png"> <br/>
	<small><small>(1Mb)</small></small></h1>';
	$errors=1;
}

//we will give an unique name, for example the time in unix time format
$image_name = md5(time()).'.'.$extension;
//the new name will be containing the full path where will be stored (images folder)
$newname="images/".$image_name;
//we verify if the image has been uploaded, and print error instead
$copied = copy($_FILES['image']['tmp_name'], $newname);



if (!$copied) 
{
	echo '<h1>Erro ao Enviar!  <img src="no.png"> </h1>';
	$errors=1;
}
}}}

//If no errors registred, print the success message
 if(isset($_POST['Submit']) && !$errors) 
 {
 	echo "
	
	<h1>Arquivo Enviado com Sucesso <img src=\"ok.png\"> </h1>
	
	<img src=".$newname." width=\"300px\" id=\"uploaded\">
	
	<table>
	<tr><td id=\"text\">URL</td></tr>
	<tr><td id=\"code\"><a href=\"".$txt.$newname."\"><xmp>".$txt.$newname."</xmp></a></td></tr>
	
	<tr><td id=\"text\">CÓDIGO HTML</td></tr>
	<tr><td id=\"code\"><xmp><img src=\"".$txt.$newname."\"></xmp></td></tr>
	
	<tr><td id=\"text\">NOME DO ARQUIVO</td></tr>
	<tr><td id=\"code\"><xmp>".$image_name."</xmp></td></tr>
	
	
	</table>
	
	<img src=\"hr.png\">
	
	";
	
	 }

 ?>
 
 <br/>

</br></br>
<div id="rodape"><a href="mailto:doublenrules@gmail.com">Contato</a> - copyright(c)2010 - Todos os Direitos Reservados - n2</div>
</body>
</html>



 </center>