<?php 
namespace PHPMVC\Models;
/**
 * 
 */
class AbstractModel
{

	
	public static function PrepareValues()
	{
		$params = '';

		foreach (static::$tableSchema as $columnName => $type) {
			$params .= $columnName . ' = :' . $columnName . ', ';
			
		}
		$params = trim($params, ', ');
		return $params;
	}

	protected function BindValues(\PDOStatement &$stmt)
	{
		foreach (static::$tableSchema as $columnName => $type) {
			if ($type == 'float') {
				$sanitizedValue = filter_var($this->$columnName, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
				$stmt->bindValue(":" . $columnName, $sanitizedValue);
			}else{
				$stmt->bindValue(":" . $columnName, $this->$columnName, $type);
			}
		}
	}

	public function register()
	{
		global $handler;
        $sql = 'INSERT INTO ' . static::$tableName . '(';

        foreach (static::$tableSchema as $columnName => $type) {
            $sql .= '' . $columnName . ', ';
        }

        $sql = trim($sql, ', ') . ')';

		$sql .= ' VALUES (';

		foreach (static::$tableSchema as $columnName => $type) {
			$sql .= '"' . $this->$columnName . '", ';
		}

		$sql = trim($sql, ', ') . ')';
		$stmt = $handler->prepare($sql);
		return $stmt->execute(array());
	}

	public function update()
	{
		global $handler;
		$sql = 'UPDATE ' . static::$tableName . ' SET ' . self::PrepareValues() . ' WHERE ' . static::$pk . ' = ' . $this->{static::$pk};
		$stmt = $handler->prepare($sql);

		self::BindValues($stmt);
		return $stmt->execute();
	}

	public function delete()
	{
		global $handler;
		$sql = 'DELETE FROM ' . static::$tableName . ' WHERE ' . static::$pk . ' = ' . $this->{static::$pk};
		$stmt = $handler->prepare($sql);
		return $stmt->execute(array());
	}

	public static function getAll()
	{
		global $handler;
		$sql = 'SELECT * FROM ' . static::$tableName;
		$stmt = $handler->prepare($sql);
		$stmt->execute();
		$results = $stmt->fetchAll(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, get_called_class(), array_keys(static::$tableSchema));
		if(isset($results) && !empty($results)){
			return $results;
		}else{
			return false;
		}
	}

	public static function getByPk($pk)
	{
		global $handler;
		$sql = 'SELECT * FROM ' . static::$tableName . ' WHERE ' . static::$pk . ' = ' . $pk;
		$stmt = $handler->prepare($sql);
		

	}

    public static function deleteByPk($pk)
    {
        global $handler;
        $sql = 'DELETE FROM ' . static::$tableName . ' WHERE ' . static::$pk . ' = ' . $pk;
        $stmt = $handler->prepare($sql);
        return $stmt->execute(array());
    }

    static public function getByColumns(array $cols){

        global $handler;
        $sql = 'SELECT * FROM ' . static::$tableName . ' WHERE ';

        foreach ($cols as $col=>$val){
            $sql .= $col . ' = :' . $col . ' OR ';
        }

        $sql = trim($sql, 'OR ');
        $stmt = $handler->prepare($sql);

        foreach ($cols as $col=>$val){
            $stmt->bindValue(":$col", $val);
        }

        $stmt->execute();
        $result = $stmt->fetchAll(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, get_called_class(), array_keys(static::$tableSchema));
        return $stmt->rowCount() > 0 ? $result : false;
    }

    static public function getByAllColumns(array $cols){
        global $handler;
        $sql = 'SELECT * FROM ' . static::$tableName . ' WHERE ';

        foreach ($cols as $col => $val){
            $sql .= $col . ' = :' . $col . ' and ';
        }

        $sql = trim($sql, "and ");
        $stmt = $handler->prepare($sql);
        foreach ($cols as $col=>$val){
            $stmt->bindValue(":$col", $val);
        }
        $stmt->execute();
        $result = $stmt->fetchAll(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, get_called_class(), array_keys(static::$tableSchema));
        return $stmt->rowCount() > 0 ? $result : false;
    }

}
