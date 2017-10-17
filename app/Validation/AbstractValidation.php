<?php
namespace App\Validation;


abstract class AbstractValidation {

    /**
     * Validate XML file field
     * @param $file
     * @return mixed
     */
    abstract public function validateXMLFileUpload($file);

    /**
     * Empty file field validation
     * @param $file
     * @return bool
     */
    public function emptyFileField($file)
    {
        if ($file['xml_file']['size'] != 0) {
            return true;
        }
        return false;
    }

    /**
     * File upload validation
     * @param $file
     * @return bool
     */
    public function successfulFileUpload($file)
    {
        if ($file['xml_file']['error'] == 0) {
            return true;
        }
        return false;
    }

    /**
     * XML file type validation
     * @param $file
     * @return bool
     */
    public function xmlFileType($file)
    {
        if ($file['xml_file']['type'] == 'text/xml') {
            return true;
        }
        return false;
    }

    /**
     * File size validation (less then 10MB)
     * @param $file
     * @return bool
     */
    public function fileSize($file)
    {
        if ($file['xml_file']['size'] < 10000000) {
            return true;
        }

        return false;
    }

}