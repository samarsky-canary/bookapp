<?php

return [
    'class' => 'yii\db\Connection',
    'dsn' => 'pgsql:host=db;port=5432;dbname=yiitest',
    'username' => 'postgres',
    'password' => 'postgres',
    'charset' => 'utf8',

    // Schema cache options (for production environment)
    //'enableSchemaCache' => true,
    //'schemaCacheDuration' => 60,
    //'schemaCache' => 'cache',
];
