<?php
/**
 * Created by PhpStorm.
 * User: szabacsik
 * Date: 2016. 06. 04.
 * Time: 9:37
 */

require_once ( "./inc/interfaces.php" );
require_once ( "./inc/classes.php" );

use improwerk\implement\mvc as mvc;

$model = new mvc\model();
$controller = new mvc\controller($model);
$view = new mvc\view($model,$controller);
$view -> render();
