<?php
//if (isset($_POST['login'])&&isset($_POST['password'])) {
	//echo(login($_POST['login'],$_POST['password']));
//}


	if (isset($_POST['login'])&&isset($_POST['password'])) {
        echo(login($_POST['login'],$_POST['password']));
    }


function login($login,$psw){
    //echo $login." ".$psw;
    if($login=="admin"&&$psw=="admin"){
        session_start();
        $_SESSION['isLogged']=true;
        return"ok";
    }
    else{
        return "Vsehuevo";}
}
?>