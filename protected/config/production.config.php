<?php

//Establish the database connection and initialize the ORM
fORMDatabase::attach(new fDatabase());

//In production use minified scripts
$page->add('js', JS_URL . 'base.min.js');

?>