<?php

namespace Core\Database;

use PDO;

class QueryBuilder
{
    /**
     * The PDO instance.
     *
     * @var PDO
     */
    protected $pdo;

    /**
     * Create a new QueryBuilder instance.
     *
     * @param PDO $pdo
     */
    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    /**
     * helper to prepare the filters and bindings before execution
     * @param $table
     * @param $filters
     * @param $joinTable
     * @param $joinColumn
     * @param $foreignColumn
     * @return array
     */
    private function prepareFilter($table, $filters, $joinTable = NULL, $joinColumn = NULL, $foreignColumn = NULL)
    {
        $query = $this->select() . $this->from($table, $joinTable, $joinColumn, $foreignColumn) . ' where true ';
        $bindings = [];
        foreach ($filters as $key => $value) {
            switch (gettype($value)) {
                case 'integer':
                case 'double':
                case 'boolean':
                    $query .= "and %s = %s ";
                    break;
                case 'string':
                    $query .= "and %s = '%s' ";
                    break;
            }
            array_push($bindings, $key);
            array_push($bindings, $value);
        }
        return [
            "query" => $query,
            "bindings" => $bindings
        ];
    }


    /**
     * helper that creates the query for joins
     * @param $table
     * @param $joinTable
     * @param $joinColumn
     * @param $foreignColumn
     * @return string
     */
    private function from($table, $joinTable = NULL, $joinColumn = NULL, $foreignColumn = NULL)
    {
        $statement = " from {$table} ";
        if ($joinTable && $joinColumn && $foreignColumn) {
            $statement .= " join {$joinTable} on {$table}.{$joinColumn} = {$joinTable}.{$foreignColumn} ";
        }
        return $statement;
    }

    /**
     * helper for preparing the selected fields
     * @param $selectedFields
     * @return string|void
     */
    private function select($selectedFields = NULL)
    {
        $statement = 'select * ';
        if (!$selectedFields) return $statement;
        // todo implement in case of selection of specified fields

    }


    /**
     * Select all records from a database table.
     *
     * @param string $table
     */
    public function selectAll($table)
    {
        $statement = $this->pdo->prepare("select * from {$table}");

        $statement->execute();

        return $statement->fetchAll(PDO::FETCH_CLASS);
    }

    /**
     * Insert a record into a table.
     *
     * @param string $table
     * @param array $parameters
     */
    public function insert($table, $parameters)
    {
        $sql = sprintf(
            'insert into %s (%s) values (%s)',
            $table,
            implode(', ', array_keys($parameters)),
            ':' . implode(', :', array_keys($parameters))
        );

        try {
            $statement = $this->pdo->prepare($sql);

            $statement->execute($parameters);
        } catch (\Exception $e) {
            die($e->getMessage());
        }
    }

    /**
     * gets record from a table depending on the filters
     * @param $table
     * @param $filters
     * @return array|false
     */
    public function find($table, $filters)
    {
        $filteredQuery = $this->prepareFilter($table, $filters);
        $query = $filteredQuery['query'];
        $query .= ' limit 1;';
        $sql = sprintf($query, ...$filteredQuery['bindings']);

        $statement = $this->pdo->prepare($sql);

        $statement->execute();

        return $statement->fetchAll(PDO::FETCH_CLASS);
    }


    /**
     * gets data from a table with pagination
     * @param $table
     * @param $page
     * @param $limit
     * @param $orderBy
     * @param $filters
     * @param $joinTable
     * @param $joinColumn
     * @param $foreignColumn
     * @return array|false
     *
     */
    public function getWithPagination($table, $page, $limit, $orderBy, $filters, $joinTable = NULL, $joinColumn = NULL, $foreignColumn = NULL)
    {
        $offset = $page * $limit;
        $filteredQuery = $this->prepareFilter($table, $filters, $joinTable, $joinColumn, $foreignColumn);
        $query = $filteredQuery['query'];
        $query .= " order By {$orderBy} limit {$limit} offset {$offset} ;";
        $sql = sprintf($query, $table, ...$filteredQuery['bindings']);

        $statement = $this->pdo->prepare($sql);

        $statement->execute();

        return $statement->fetchAll(PDO::FETCH_CLASS);

    }

}
