<?php
session_start();
require('../model/operations.php');
require('../model/sessionManager.php');

$isError = false;
$missingFields = array();


$userId = isset($_POST['commentator_id']) ? (int) $_POST['commentator_id'] : '';
$postId = isset($_POST['subjet_id']) ? (int) $_POST['subjet_id'] : '';
$comment = isset($_POST['comment']) ? strip_tags($_POST['comment']) : '';

setSessionComment($comment);

/**
 * userId et postId doivent être valide sinon on détruit la session et on balance le user
 * dehors.
 */
if(empty($userId) ) {
    kickOut();
}elseif($userId!==getMyId()){
    kickOut();
}
if(empty($postId) ) {
    kickOut();
}

if(empty($comment) ) {
    $isError = true;
    $missingFields[] = 'Le commentaire est vide';
}else{
    if(strlen($comment)<30){ // On veut que le sujet fasse au moins 30 caractères
        $isError = true;
        $missingFields[] = 'Le commentaire doit avoir au moins 30 caractères';
    }
}

if( $isError==true ) {
    $stringError="";
    if( $isError ) {
        $stringError .= "Erreurs sur les champs suivants : <br />";
        foreach( $missingFields as $fieldName ) {
            $stringError .= $fieldName . "<br />";
        }
        setErrorsForm($stringError);
        header("location: ../index.php?p=viewPost&postid=$postId");
        die();
    }
}else{
    $res = setNewComment($userId,$postId,$comment);
    unsetFormFields(); //sessions
    if($res==true){
        setSuccessForm('Votre commentaire a bien été posté');
        header("location: ../index.php?p=viewPost&postid=$postId");
        die();
    }
}
