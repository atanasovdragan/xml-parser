<?php
namespace App\Gateways;

use App\Interfaces\DepartmentsInterface;

class DepartmentsGateway {

    private $repository;
    private $departmentsResponse;
    private $employeesResponse;

    /** Inversion of control, get the proper repository through interface
     * @param DepartmentsInterface $departmentsInterface
     */
    public function __construct(DepartmentsInterface $departmentsInterface)
    {
        $this->repository = $departmentsInterface;
        $this->departmentsResponse = false;
        $this->employeesResponse = false;
    }

    /**
     * Iterate over file parsed data
     * @param $data
     * @return bool
     */
    public function iterateParsedData(\SimpleXMLElement $data): bool
    {
        //iterate over departments list
        if (isset($data->DepartmentsList)) {
            $this->departmentsResponse = $this->iterateDepartmentsList($data->DepartmentsList->children());
        }

        //iterate over employees list
        if (isset($data->EmployeesList)) {
            $this->employeesResponse = $this->iterateEmployeesList($data->EmployeesList->children());
        }

        //check the iteration responses (true or false)
        if ($this->departmentsResponse && $this->employeesResponse) {
            return true;
        }

        return false;
    }

    /**
     * Iterate over departments list
     * @param $departmentsList
     * @return bool
     */
    public function iterateDepartmentsList(\SimpleXMLElement $departmentsList): bool
    {
        if (count($departmentsList)) {
            foreach ($departmentsList as $department) {
                //check if department already exist in database table
                $getExistingDepartment = $this->getExistingDepartment($department->ID);
                if (empty($getExistingDepartment)) {
                    //store department if doesn't exist
                    $response = $this->storeDepartment($department);
                    //if insert fails return false
                    if (!$response) {
                        return false;
                    }
                }
            }
        }

        return true;
    }

    /**
     * Iterate over employees list
     * @param $employeesList
     * @return bool
     */
    public function iterateEmployeesList(\SimpleXMLElement $employeesList): bool
    {
        if (count($employeesList)) {
            foreach ($employeesList as $employee) {
                //check if employee already exist in database table
                $getExistingEmployee = $this->getExistingEmployee($employee->ID);
                if (!empty($getExistingEmployee)) {
                    //if employee already exist, update
                    $response = $this->updateEmployee($employee);
                } else {
                    //if employee doesn't exist, store
                    $response = $this->storeEmployee($employee);
                }
                //if insert or update fails return false
                if (!$response) {
                    return false;
                }
            }
        }

        return true;
    }

    /**
     * Get already existing department
     * @param $id
     * @return mixed
     */
    public function getExistingDepartment(\SimpleXMLElement $id): ?array
    {
        return $this->repository->getDepartment($id);
    }

    /**
     * Get already existing employee
     * @param $id
     * @return mixed
     */
    public function getExistingEmployee(\SimpleXMLElement $id): ?array
    {
        return $this->repository->getEmployee($id);
    }

    /**
     * Store department
     * @param $data
     * @return mixed
     */
    public function storeDepartment(\SimpleXMLElement $data): bool
    {
        return $this->repository->storeDepartment($data);
    }

    /**
     * Store employee
     * @param $data
     * @return mixed
     */
    public function storeEmployee(\SimpleXMLElement $data): bool
    {
        return $this->repository->storeEmployee($data);
    }

    /**
     * Update employee
     * @param $data
     * @return mixed
     */
    public function updateEmployee(\SimpleXMLElement $data): bool
    {
        return $this->repository->updateEmployee($data);
    }

}