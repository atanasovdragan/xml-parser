<?php
use App\Gateways\DepartmentsGateway;
use App\Repositories\DepartmentsRepository;
use App\Services\XMLParser;
use App\Validation\Validate;

//instantiate Validation class
$validate = new Validate();

//declare error message array
$errorMessages=[];

//declare successful message variable
$successMessage="";

//check if the file is set
if (isset($_FILES['xml_file'])) {
    //validate XML file field
    $errorMessages = $validate->validateXMLFileUpload($_FILES);

    //check if validation has return any error messages
    if (empty($errorMessages)) {
        //get XML parser
        $parseFile = new XMLParser();

        //parse XML file
        $parsedData = $parseFile->parseFile($_FILES['xml_file']['tmp_name']);

        //implement data management solution
        $departmentsGateway = new DepartmentsGateway(new DepartmentsRepository());
        $response = $departmentsGateway->iterateParsedData($parsedData);

        //check response
        if ($response) {
            $successMessage = "File was successfully parsed and database was successfully updated.";
        } else {
            $errorMessages[] = "Please select valid and properly structured XML file.";
        }
    }else {
        $errorMessages[] = "File was not uploaded successfully. Please try again.";
    }
}