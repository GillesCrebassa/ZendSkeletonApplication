 <?php
// remove this line in local

//if (!empty(getenv('OPENSHIFT_GEAR_NAME')))

/* Add this part in local server


        SetEnv DB_NAME "<DBNAME>"
        SetEnv DB_USER "<USER>"
        SetEnv DB_PASS "<PASS>"
        SetEnv DB_HOST "<HOST>"
        SetEnv DB_PORT "<PORT>"

*/

$gear_name=getenv('OPENSHIFT_GEAR_NAME');
if (!empty($gear_name))
{

        $dbParams = array(
            'database'  => getenv('OPENSHIFT_GEAR_NAME'),
            'username'  => getenv('OPENSHIFT_MYSQL_DB_USER'),
            'password'  => getenv('OPENSHIFT_MYSQL_DB_PASS'),
            'hostname'  => getenv('OPENSHIFT_MYSQL_DB_HOST'),
            'port'  => getenv('OPENSHIFT_MYSQL_DB_PORT')
        );


}
else
{
        $dbParams = array(
            'database'  => getenv('DB_NAME'),
            'username'  => getenv('DB_USER'),
            'password'  => getenv('DB_PASS'),
            'hostname'  => getenv('DB_HOST'),
            'port'  => getenv('DB_PORT'),
        
/*
            'database'  => 'c9',
            'username'  => 'crebassa_gilles',
            'password'  => getenv('DB_PASS'),
            'hostname'  => 'localhost',
            'port'  	=> '3306',
*/            
            
        );
};

print $dbParams['database'];
        return array(
            'service_manager' => array(
                'factories' => array(
                    'Zend\Db\Adapter\Adapter' => function ($sm) use ($dbParams) {
                        return new Zend\Db\Adapter\Adapter(array(
                            'driver'    => 'pdo',
                            'dsn'       => 'mysql:dbname='.$dbParams['database'].';host='.$dbParams['hostname'].';port='.$dbParams['port'],
                            'database'  => $dbParams['database'],
                            'username'  => $dbParams['username'],
                            'password'  => $dbParams['password'],
                            'hostname'  => $dbParams['hostname'],
                            'port'  	=> $dbParams['port'],
                        ));
                    },
                ),
            ),
        );


