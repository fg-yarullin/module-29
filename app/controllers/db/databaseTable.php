<?php

class DatabaseTable
{
    private $pdo;
    private $table;
    private $primaryKey;

    public function __construct(PDO $pdo, string $table, string $primaryKey) {
        $this->pdo = $pdo;
        $this->table = $table;
        $this->primaryKey = $primaryKey;        
    }

    private function query($query, $parameters = [])
    {
        $stmt = $this->pdo->prepare($query);
        $stmt->execute($parameters);
        // var_dump($parameters); exit();
        return $stmt;
    }

    private function insert($fields)
    {
        // var_dump($fields); exit();

        $query = 'INSERT INTO `' . $this->table . '` (';
        $part2 = ') VALUES (';
        foreach ($fields as $key => $value) {
            $query .= '`' . $key . '`,';
            $part2 .= ':' . $key . ',';
        }
        $query = rtrim($query, ',') . rtrim($part2, ',') . ')';

        // var_dump($query); exit();

        $fields = $this->processDate($fields);
        $this->query($query, $fields);
    }

    private function update($fields)
    {
        $query = 'UPDATE `' . $this->table . '` SET ';
        foreach ($fields as $key => $value) {
            $query .= '`' . $key . '` = :' . $key . ',';
        }
        $query = rtrim($query, ',');
        $query .= ' WHERE `' . $this->primaryKey . '` = :primaryKey';
        $fields['primaryKey'] = $fields['id'];
        $fields = $this->processDate($fields);
        $this->query($query, $fields);
    }

    public function delete($id)
    {
        $parameters = [':id' => $id];
        $query = 'DELETE FROM `' . $this->table . '` WHERE `' . $this->primaryKey . '` = :id';
        $this->query($query, $parameters);
    }

    public function findAll()
    {
        $result = $this->query('SELECT * FROM `' . $this->table . '`');
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }

    public function findWhere($column, $value, $sortColumn = 'id', $direction = 1)
    {
        $direction = $direction == 1 ? 'ASC' : 'DESC';
        $query = $this->query('SELECT * FROM `' . $this->table . '` WHERE `'
        . $column . '` = ' . $value . ' ORDER BY ' . $sortColumn . ' ' . $direction);
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function findAllSorted($direction = 1)
    {
        $direction = $direction == 1 ? 'ASC' : 'DESC';
        $result = $this->query("SELECT * FROM `$this->table` ORDER BY `$this->primaryKey` $direction");
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }

    public function findById($value)
    {
        $query = "SELECT * FROM `$this->table` WHERE `$this->primaryKey` = :primaryKey";
        $parameters = ['primaryKey' => $value];
        $query = $this->query($query, $parameters);
        return $query->fetch(PDO::FETCH_ASSOC);
    }

    public function find($column, $value)
    {
        $query = "SELECT * FROM `$this->table` WHERE `$column` = :value "; 
        $parameters = ['value' => $value];
        $query = $this->query($query, $parameters);
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function total()
    {
        $query = $this->query('SELECT COUNT(*) FROM `' . $this->table . '`');
        $row = $query->fetch();
        return $row[0];
    }

    public function save($record) //save or edit
    {
        try {
            if ($record[$this->primaryKey] == '') {
                $record[$this->primaryKey] = null;
            }
            $this->insert($record);
        } catch (PDOException $e) {
            $this->update($record);
        }
    }

    private function processDate($fields)
    {
        foreach ($fields as $key => $value) {
            if ($value instanceof DateTime) {
                $fields[$key] = $value->format('Y-m-d');
            }
        }
        return $fields;
    }

    public static function dateFormat($date)
    {
        $formatedDate = new DateTime($date);
        return $formatedDate->format('jS F Y');
    }
}
