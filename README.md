# PHP XML parser web application

This is an XML parser web application developed with custom PHP coding without using any frameworks. The codebase represents some 
tips how to organize your custom PHP code, developed in Object Oriented style and with some proper design patterns implemented.

## The application

In a company we have several departments and some employees working in them. We need a tool to generate some statistics about them.

We have:
- HTML Form for XML file upload to add/update employees and departments Structure. Sample XML file is located in the application root folder. 
The file upload is not overwriting the existing database but only adding/updating the employees from the XML file;
- Table with top 5 most departments with the most employees;
- Table listing all departments, how many employees belong to them, the maximum salary paid in the department and the name of the employee (one row per department);

The SQL script is located in the sql folder in the application root. After running the script 
"xml_parser" database will be created with some initial data for "departments" and "employees".

Autoloading of classes are made through composer (psr-4), so you will need composer installed on your computer in order to run the application. 
Just `composer install` to the root of the application and all classes would be autoloaded.

Database configurable variables are located in app/Database/DatabaseConnection.php.

Application running bootstrap for its front-end needs.

All classes and interfaces and basically the full implementation is located in the "app" folder.

**Notice:** You can find Singleton, Factory, Strategy, Gateway and Repository patterns in some of the implemented code solutions. You will need
PHP 7.1 installed to run this app.