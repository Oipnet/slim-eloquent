<?php

namespace App\Models;

use Illuminate\Database\Capsule\Manager;

class Model
{
    /**
     * @var Manager
     */
    private $db;

    public function __construct(Manager $db)
    {
        $this->db = $db;
        $this->table = $this->getTableName();
    }

    private function getTableName():String
    {
        $class = explode('\\', get_class($this));
        $database = end($class);
        return $this->table = pluralize($database);
    }

}