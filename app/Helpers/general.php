<?php

function getFolder(){
return app() -> getLocale() =='ar' ? 'css-rtl' :'css' ;
}

define('PAGINATION_COUNT',15);

function uploadImage($folder,$image){
    $image->store('/', $folder);
    $filename = $image->hashName();
    return  $filename;
}
