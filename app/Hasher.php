<?php
class Hasher{

function hash_pssw($password){
 return(password_hash($password,PASSWORD_DEFAULT));
}

function verificar_password($psww,$hash){
    return(password_verify($psww,$hash));
}
}
?>