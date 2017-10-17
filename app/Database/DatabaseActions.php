<?php
namespace App\Database;

use App\Interfaces\DatabaseActionsInterface;

class DatabaseActions extends DatabaseConnection implements DatabaseActionsInterface {

    private $database;
    private $mysql;

    public function __construct()
    {
        //make database connection
        $this->startDatabaseConnection();
    }

    /**
     * Start database connection
     */
    public function startDatabaseConnection(): void
    {
        $this->database = DatabaseConnection::makeInstance();
        $this->mysql = $this->database->connect();
    }

    /**
     * Get top departments
     * @return mixed
     */
    public function getTopDepartments(): ?\mysqli_result 
    {
        return $this->mysql->query(
            "select departments.name as dep_name, count(employees.id) as emp_count
                from departments
                left join employees on departments.id=employees.department_id
                group by departments.id
                order by emp_count desc
                limit 5"
        );
    }

    /**
     * Get all departments
     * @return mixed
     */
    public function getAllDepartments(): ?\mysqli_result 
    {
        return $this->mysql->query(
            "select departments.id, departments.name, count(employees.id) as emp_count,
                max(salary) as max_salary,
                (select name from employees where department_id=departments.id
                order by salary
                desc
                limit 1) as emp_name
                from departments
                left outer join employees
                on departments.id=employees.department_id
                group by departments.id
                order by departments.id desc"
        );
    }

    /**
     * Get employee by id
     * @param $id
     * @return mixed
     */
    public function getEmployee(\SimpleXMLElement $id): ?\mysqli_result 
    {
        return $this->mysql->query("select * from employees where id=".$id." limit 1");
    }

    /**
     * Get department by id
     * @param $id
     * @return mixed
     */
    public function getDepartment(\SimpleXMLElement $id): ?\mysqli_result 
    {
        return $this->mysql->query("select * from departments where id=".$id." limit 1");
    }

    /**
     * Store department
     * @param $data
     * @return mixed
     */
    public function storeDepartment(\SimpleXMLElement $data): bool
    {
        return $this->mysql->query(
            "insert into departments (id, name)
                values ('$data->ID', '$data->Name')"
        );
    }

    /**
     * Store employee
     * @param $data
     * @return mixed
     */
    public function storeEmployee(\SimpleXMLElement $data): bool
    {
        return $this->mysql->query(
            "insert into employees (id, name, salary, department_id)
                values ('$data->ID', '$data->Name', '$data->Salary', '$data->DepartmentId')"
        );
    }

    /**
     * Update employee
     * @param $data
     * @return mixed
     */
    public function updateEmployee(\SimpleXMLElement $data): bool
    {
        return $this->mysql->query(
            "update employees
                set name='$data->Name', salary='$data->Salary', department_id='$data->DepartmentId'
                where id ='$data->ID'"
        );
    }

}