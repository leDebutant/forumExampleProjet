<?php

function getPageName(){
    if( isset($_GET['p']) ) {
        return $_GET['p'];
    } else {
        return 'login';
    }
}

function getSuccessFromGETRequest(){
    return isset($_GET['success']) ? $_GET['success'] : false;
}

function getPostIdFromGETRequest(){
    return isset($_GET['postid']) ? (int) $_GET['postid'] : false;
}

function getCategorySelected(){
    if( isset($_GET['categ']) ) {
        return $_GET['categ'];
    } else {
        return '';
    }
}