<?php

//Establish the database connection and initialize the ORM
rORMDatabase::attach(new rDatabase('sqlite', rApplication::getPath('database', 'development.sqlite')));

//In development use the development scripts (non-minified)
$page->add('js', rRouter::getRoute('js', 'base.js'));

?>