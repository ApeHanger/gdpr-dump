<?php
use machbarmacher\GdprDump\ColumnTransformer\ColumnTransformer;

use \PHPUnit\Framework\TestCase;

class ColumnTransformerTest extends TestCase
{
    private $jsonData = '{"users_field_data":{"name":"uid","mail":"uid","init":"uid","pass":{"transformer":"faker", "formatter":"password"}}}';

    public function testCreatingOfNewExpressionStatement()
    {
        $gdprExpressions = json_decode($this->jsonData, TRUE);
        $tableName = "users_field_data";
        $columnName = "name";
        $result = ColumnTransformer::create($tableName, $columnName, $gdprExpressions[$tableName][$columnName]);
        $this->assertTrue($result instanceof \machbarmacher\GdprDump\ColumnTransformer\ColumnTransformSelectStatement);
    }

    public function testCreatingNewFakerStatement()
    {
        $gdprExpressions = json_decode($this->jsonData, TRUE);
        $tableName = "users_field_data";
        $columnName = "pass";
        $result = ColumnTransformer::create($tableName, $columnName, $gdprExpressions[$tableName][$columnName]);
        $this->assertTrue($result instanceof \machbarmacher\GdprDump\ColumnTransformer\ColumnTransformFaker);
    }
}