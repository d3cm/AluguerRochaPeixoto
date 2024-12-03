<?php

$con = new MYsqli ("localhost", "root", "", "alugel");

if($con->connect_errno!=0){
    echo "Erro no Acesso à base de dados " . $con->connect_error;
    exit;
}
?>