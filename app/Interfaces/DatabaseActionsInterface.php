<?php
namespace App\Interfaces;

interface DatabaseActionsInterface {

    /**
     * Start database connection
     * @return mixed
     */
    public function startDatabaseConnection(): void;

    /**
     * Get top departments
     * @return mixed
     */
    public function getTopDepartments(): ?\mysqli_result ;

    /**
     * Get all departments
     * @return mixed
     */
    public function getAllDepartments(): ?\mysqli_result ;

    /**
     * Get employee by id
     * @param $id
     * @return mixed
     */
    public function getEmployee(\SimpleXMLElement $id): ?\mysqli_result ;

    /**
     * Get department by id
     * @param $id
     * @return mixed
     */
    public function getDepartment(\SimpleXMLElement $id): ?\mysqli_result ;

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