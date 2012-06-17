<?php
/**
 * Created by JetBrains PhpStorm.
 * User: diegoplada
 * Date: 04/06/12
 * Time: 16:13
 * To change this template use File | Settings | File Templates.
 */
class Database extends PDO
{
       function __construct(){
           parent::__construct(DB_TYPE.':host='.DB_HOST.';dbname='.DB_NAME,DB_USER,DB_PASS);
       }
}
