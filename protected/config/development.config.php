<?php

//Establish the database connection and initialize the ORM
fORMDatabase::attach(new fDatabase('sqlite', DATABASE_ROOT . 'development.sqlite'));

//In development use the development scripts (non-minified)
$page->add('js', JS_URL . 'base.js');

?>