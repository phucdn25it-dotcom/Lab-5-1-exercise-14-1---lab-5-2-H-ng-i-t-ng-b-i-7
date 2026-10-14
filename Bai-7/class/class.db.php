<?php

class DB
{
    protected mysqli $link;

    public function __construct()
    {
        require __DIR__ . '/../connect.php';
        if (!isset($connect) || !($connect instanceof mysqli)) {
            throw new RuntimeException('Không thể kết nối database tintuc.');
        }
        $this->link = $connect;
        $this->link->set_charset('utf8mb4');
    }

    protected function db_query(string $sql, string $types = '', array $params = []): mysqli_result|bool
    {
        $stmt = $this->link->prepare($sql);
        if ($types !== '') {
            $stmt->bind_param($types, ...$params);
        }
        $stmt->execute();
        if (stripos(ltrim($sql), 'SELECT') === 0) {
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
