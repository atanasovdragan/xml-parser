<?php
namespace App\Repositories;

use App\Database\DatabaseActions;
use App\Interfaces\DepartmentsInterface;

class DepartmentsRepository implements DepartmentsInterface {

    private $database;

    public function __construct()
    {
        //get primary database functions
        //(if we have used a proper PHP framework, this level of the abstraction was going to be the ORM)
        $this->database = new DatabaseActions();
    }

    /**
     * Get department by id
     * @param $id
     * @return array|null
     */
    public function getDepartment(\SimpleXMLElement $id): ?array
    {
        return mysqli_fetch_all($this->database->getDepartment($id),MYSQLI_ASSOC);
    }

    /**
     * Get employee by id
     * @param $id
     * @return array|null
     */
    public function getEmployee(\SimpleXMLElement $id): ?array
    {
        return mysqli_fetch_all($this->database->getEmployee($id),MYSQLI_ASSOC);
    }

    /**
     * Store department
     * @param $data
     * @return mixed
     */
    public function storeDepartment(\SimpleXMLElement $data): bool
    {
        return $this->database->storeDepartment($data);
    }

    /**
     * Store employee
     * @param $data
     * @return mixed
     */
    public function storeEmployee(\SimpleXMLElement $data): bool
    {
        return $this->database->storeEmployee($data);
    }

    /**
     * Update employee
     * @param $data
     * @return mixed
     */
    public function updateEmployee(\SimpleXMLElement $data): bool
    {
        return $this->database->updateEmployee($data);
    }

}