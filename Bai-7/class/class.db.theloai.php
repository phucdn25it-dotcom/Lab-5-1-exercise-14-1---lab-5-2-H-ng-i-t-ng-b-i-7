<?php
require_once __DIR__ . '/class.db.php';

class DB_TheLoai extends DB
{
    public function get_theloai(int $id = -1): array
    {
        $result = $id === -1
            ? $this->db_query('SELECT * FROM theloai ORDER BY ThuTu ASC, idTL ASC')
            : $this->db_query('SELECT * FROM theloai WHERE idTL = ?', 'i', [$id]);
        $categories = [];
        while ($row = $this->db_fetch($result)) {
            $categories[] = $row;
        }
        return $categories;
    }

    public function them_theloai(string $name, int $sort, int $show, string $icon = ''): bool
    {
        return $this->db_query(
            'INSERT INTO theloai (TenTL, ThuTu, AnHien, icon) VALUES (?, ?, ?, ?)',
            'siis', [$name, $sort, $show, $icon]
        );
    }

    public function sua_theloai(int $id, string $name, int $sort, int $show, string $icon): bool
    {
        return $this->db_query(
            'UPDATE theloai SET TenTL = ?, ThuTu = ?, AnHien = ?, icon = ? WHERE idTL = ?',
            'siisi', [$name, $sort, $show, $icon, $id]
        );
    }

    public function xoa_theloai(int $id): bool
    {
        return $this->db_query('DELETE FROM theloai WHERE idTL = ?', 'i', [$id]);
    }
}
