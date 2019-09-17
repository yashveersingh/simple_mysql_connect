#Simple MySql Connect
\
installation: `composer require yashveer_singh/simple_mysql_connect`
\
USAGE:\
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;import using `use yashveer\Database;`\
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;initialise using `Database::init('TABLE_NAME','USERNAME','PASSWORD','HOST');`\
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;get object using : `$database = Database::get();`\
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;query using: \
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;`$result = $database->rawQuery('select * from TABLE');`
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;check error using: \
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;`if(!is_null($database->getError())){`\
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;`echo $database->getError();`\
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;`}` \
\
\
\
\
\
\
\
============>
######Author : **Yashveer Singh (yashveersingh444444@gmail.com)**
