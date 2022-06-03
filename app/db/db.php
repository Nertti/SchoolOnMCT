<?php
session_start();
require('connect.php');

function tt($value)
{
    echo '<pre>';
    print_r($value);
    echo '</pre>';
    exit();
}

//проверка на ошибки
function checkErrors($query)
{
    $errInfo = $query->errorInfo();

    if ($errInfo[0] !== PDO::ERR_NONE) {
        echo $errInfo[2];
        exit();
    }
    return true;
}

function selectOne($table, $params = [])
{
    global $pdo;

    $sql = "select * from `$table`";

    if (!empty($params)) {
        $i = 0;
        foreach ($params as $key => $value) {

            if (!is_numeric($value)) {
                $value = "'" . $value . "'";
            }
            if ($i === 0) {
                $sql = $sql . " WHERE $key = $value";
            } else {
                $sql = $sql . " AND $key = $value";
            }
            $i++;
        }
    }

    $query = $pdo->prepare($sql);
    $query->execute();

    checkErrors($query);

    return $query->fetch();
}

function selectALL($table, $params = [])
{
    global $pdo;

    $sql = "select * from `$table`";

    if (!empty($params)) {
        $i = 0;
        foreach ($params as $key => $value) {

            if (!is_numeric($value)) {
                $value = "'" . $value . "'";
            }
            if ($i === 0) {
                $sql = $sql . " WHERE $key = $value";
            } else {
                $sql = $sql . " AND $key = $value";
            }
            $i++;
        }
    }
    $query = $pdo->prepare($sql);
    $query->execute();

    checkErrors($query);

    return $query->fetchAll();
}

function selectOrder($table, $sort_sql, $params = [])
{
    global $pdo;

    $sql = "select * from `$table`";

    if (!empty($params)) {
        $i = 0;
        foreach ($params as $key => $value) {
            //массив ассоциативный наоборот
            $value = "`" . $value . "`";
            $key = "'" . $key . "'";
            if ($i === 0) {
                $sql = $sql . " WHERE $value = $key";
            } elseif ($i === 1) {
                $sql = $sql . " AND $value >= $key";
            } else {
                $sql = $sql . " AND $value <= $key";
            }
            $i++;
        }
    }
    $sql = $sql . " ORDER BY $sort_sql";
    $query = $pdo->prepare($sql);
    $query->execute();
    checkErrors($query);

    return $query->fetchAll();
}

function selectFind($table, $find_sql, $column, $params = [])
{
    global $pdo;

    $sql = "select * from `$table`";

    if (!empty($params)) {
        $sql = $sql . " AND $column LIKE '%" . $find_sql . "%'";
    } else {
        $sql = $sql . " WHERE $column LIKE '%" . $find_sql . "%'";
    }

    $query = $pdo->prepare($sql);
    $query->execute();

    checkErrors($query);

    return $query->fetchAll();
}

//insert
function insertRow($table, $params)
{
    global $pdo;
    $i = 0;
    $coll = '';
    $mask = '';
    foreach ($params as $key => $value) {
        if ($i === 0) {
            $coll = $coll . "$key";
            $mask = $mask . " '" . "$value" . "'";
        } else {
            $coll = $coll . ", $key";
            $mask = $mask . "," . " '" . "$value" . "'";
        }
        $i++;
    }

    $sql = "INSERT INTO `$table`($coll) VALUES ($mask)";
    $query = $pdo->prepare($sql);
    $query->execute($params);

    checkErrors($query);

    return $pdo->lastInsertId();
}

function updateRow($table, $id, $params)
{
    global $pdo;
    $i = 0;
    $str = '';

    foreach ($params as $key => $value) {
        if ($i === 0) {
            $str = $str . $key . " = '" . $value . "'";
        } else {
            $str = $str . ", " . $key . " = '" . $value . "'";
        }
        $i++;
    }

    $sql = "UPDATE `$table` SET $str WHERE $id";
    $query = $pdo->prepare($sql);
    $query->execute($params);

    checkErrors($query);
}

function deleteRow($table, $id)
{
    global $pdo;

    $sql = "DELETE FROM `$table` WHERE $id";
    $query = $pdo->prepare($sql);
    $query->execute();

    checkErrors($query);
}

function callProc ($nameProc, $param)
{
    global $pdo;
    $sql = "CALL `$nameProc` ($param)";
    $query = $pdo->prepare($sql);
    $query->execute();

    checkErrors($query);

    return $query->fetchAll();
}

function sort_link_bar($title, $a, $b, $table)
{
    $sort = @$_GET['sort'];
    if ($sort == $a) {
        return ' active" href="?sort=' . $b . '&table=' . $table . '">' . $title . ' <i>↑</i>';
    } elseif ($sort == $b) {
        return ' active" href="?sort=' . $a . '&table=' . $table . '">' . $title . ' <i>↓</i>';
    } else {
        return '" href="?sort=' . $a . '&table=' . $table . ' ">' . $title ;
    }
}
