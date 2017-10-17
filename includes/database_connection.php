<?php
/*
 * Make an instance from the DatabaseFactory class. In a proper php framework, especially a MVC framework
 * this kind of a factory pattern implementation would be unnecessary.
 * I thought that the static nature of the pattern would be better for getting data and print them directly in the html
 * Also was a way to show the Factory Pattern implementation
 */
use App\Database\DatabaseFactory;

$dbConnect = new DatabaseFactory();