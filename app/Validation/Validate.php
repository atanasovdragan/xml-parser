<?php
namespace App\Validation;

class Validate extends AbstractValidation {

    private $errors;

    public function __construct()
    {
        $this->errors = [];
    }

    /**
     * Validate XML file field
     * @param $file
     * @return array
     */
    public function validateXMLFileUpload($file)
    {
        //if file field is empty
        if (!$this->emptyFileField($file)) {
            $this->errors[] = "File field should not be empty.";
        }

        //if file was uploaded successfully
        if (!$this->successfulFileUpload($file)) {
            $this->errors[] = "File was not uploaded.";
        }

        //if file type is XML
        if (!$this->xmlFileType($file)) {
            $this->errors[] = "Please select a proper XML file.";
        }

        //if file is larger than 10MB
        if (!$this->fileSize($file)) {
            $this->errors[] = "Your file is too large. Please select a file less than 10MB.";
        }

        //return error messages
        return $this->errors;
    }

}