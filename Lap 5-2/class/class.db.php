<?php

class DB
{
    private mysqli $link;

    public function __construct()
    {
        global $config;
        mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
        $this->link = new mysqli(
            $config['host'],
            $config['user'],
            $config['pass'],
            $config['data']
        );
        $this->link->set_charset('utf8mb4');
    }

    protected function db_query(string $query, string $types = '', array $params = []): mysqli_result|bool
    {
        $stmt = $this->link->prepare($query);
        if ($types !== '') {
            $stmt->bind_param($types, ...$params);
        }
        $stmt->execute();
        if (stripos(ltrim($query), 'SELECT') === 0) {
            return $stmt->get_result();
        }
        return $stmt->affected_rows >= 0;
    }

    protected function db_fetch(mysqli_result $result): ?array
    {
        $row = $result->fetch_assoc();
        return $row === null ? null : $row;
    }
}
