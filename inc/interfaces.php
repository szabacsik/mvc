<?php
/**
 * Created by PhpStorm.
 * User: szabacsik
 * Date: 2016. 06. 04.
 * Time: 9:38
 */

namespace improwerk\implement\mvc;
use improwerk\implement\mvc as mvc;

interface ibasic
{
    public function __construct ();
    public function __destruct ();
}

interface imodel
{
    public function __construct ();
    public function __destruct ();
    public function getData ();
    public function setData ( $action );
}

interface icontroller
{
    public function __construct ( $model );
    public function __destruct ();
}

interface iview
{
    public function __construct ( $model, $controller );
    public function __destruct ();
    public function render ();
}

