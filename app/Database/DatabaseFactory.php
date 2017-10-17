<?php
namespace App\Database;

class DatabaseFactory {

    protected $dbActions;

    /**
     * Get all departments
     * @return array|null
     */
    public static function getAllDepartments(): array
    {
        $dbActions = new DatabaseActions();
        return mysqli_fetch_all($dbActions->getAllDepartments(),MYSQLI_ASSOC);
    }

    /**
     * Get top departments
     * @return array|null
     */
    public static function getTopDepartments(): array
    {
        $dbActions = new DatabaseActions();
        return mysqli_fetch_all($dbActions->getTopDepartments(),MYSQLI_ASSOC);
    }

}