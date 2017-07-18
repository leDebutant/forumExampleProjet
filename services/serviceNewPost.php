<?php
session_start();
require('../model/operations.php');
require('../model/sessionManager.php');

$isError = false;
$missingFields = array();

$userId = isset($_POST['poster']) ? (int) $_POST['poster'] : '';
$title = isset($_POST['title']) ? strip_tags($_POST['title']) : '';
$description = isset($_POST['description']) ? strip_tags($_POST['description']) : '';
$category = isset($_POST['category']) ? (int) strip_tags($_POST['category']) : 1;

setSessionDescription($description);
setSessionTitle($title);

if(empty($userId) ) {
    setErrorsForm('Le posteur est vide petit hacker!!');
    kickOut();
}

if(empty($title) ) {
    $isError = true;
    $missingFields[] = 'Le titre est vide';
}else{
    if(strlen($title)<10){ // On veut que le sujet fasse au moins 30 caractères
        $isError = true;
        $missingFields[] = 'Le titre est trop court veuillez écrire au moins 10 caractères';
    }
}

if(empty($description)) {
    $isError = true;
    $missingFields[] = 'La description est vide';
}else{
    if(strlen($description)<30){ // On veut que le sujet fasse au moins 30 caractères
        $isError = true;
        $missingFields[] = 'La description est trop courte veuillez écrire au moins 30 caractères';
    }
}

if(empty($category)) {
    $isError = true;
    $missingFields[] = 'Error with your category';
}else{
    if((1 > $category) || ($category > 5)){ // Les ids en base de données des categs vont de 1 à 5
        $isError = true;
        $missingFields[] = "La category que vous voulez n'existe pas";
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
        header('location: ../index.php?p=newPost');
    }
}else{
    $res = setNewPost($userId,$title,$description,$category);
    unsetFormFields(); //sessions
    if($res==true){
        setSuccessForm('Votre sujet a bien été posté');
        header('location: ../index.php?p=acceuil');
        die();
    }
}
