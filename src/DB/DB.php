<?php

namespace Accounting\DB;

use RedBeanPHP\R;

abstract class DB
{
    public static function initialize()
    {
        R::setup('mysql:host=localhost;port=3306;dbname=2019-09-unit-testing', '2019-09-unit-testing', '2019-09-unit-testing');
    }
}