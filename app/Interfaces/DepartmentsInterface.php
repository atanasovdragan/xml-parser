<?php
namespace App\Interfaces;


interface DepartmentsInterface {

    /**
     * Get department by id
     * @param $id
     * @return mixed
     */
    public function getDepartment(\SimpleXMLElement $id): ?array;

    /**
     * Get employee by id
     * @param $id
     * @return mixed
     */
    public function getEmployee(\SimpleXMLElement $id): ?array;

    /**
     * Store department
     * @param $data
     * @return mixed
     */
    public function storeDepartment(\SimpleXMLElement $data): bool;

    /**
     * Store employee
     * @param $data
     * @return mixed
     */
    public function storeEmployee(\SimpleXMLElement $data): bool;

    /**
     * Update employee
     * @param $data
     * @return mixed
     */
    public function updateEmployee(\SimpleXMLElement $data): bool;

}