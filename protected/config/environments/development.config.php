<?php

//Establish the database connection and initialize the ORM
fORMDatabase::attach(
  new fDatabase('sqlite', fApplication::getPath('database', 'development.sqlite')
);

//In development use the development scripts (non-minified)
$page->add('js', fRouter::getRoute('js', 'base.js'));

?>