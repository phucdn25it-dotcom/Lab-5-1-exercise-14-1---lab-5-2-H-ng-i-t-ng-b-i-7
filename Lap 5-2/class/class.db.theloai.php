<?php
require_once __DIR__ . '/class.db.php';

class DB_TheLoai extends DB
{
    public function get_theloai(int $id = -1): array
    {
        $result = $id === -1
            ? $this->db_query('SELECT idTL, TenTL, ThuTu, AnHien FROM theloai ORDER BY ThuTu, idTL')
            : $this->db_query('SELECT idTL, TenTL, ThuTu, AnHien FROM theloai WHERE idTL = ?', 'i', [$id]);
        $rows = [];
        while ($row = $this->db_fetch($result)) {
            $rows[] = $row;
        }
        return $rows;
    }

    public function them_theloai(string $name, int $sort = 0, int $show = 1): bool
    {
        return $this->db_query(
            'INSERT INTO theloai (TenTL, ThuTu, AnHien) VALUES (?, ?, ?)',
            'sii', [$name, $sort, $show]
        );
    }

    public function sua_theloai(int $id, string $name, int $sort, int $show): bool
    {
        return $this->db_query(
            'UPDATE theloai SET TenTL = ?, ThuTu = ?, AnHien = ? WHERE idTL = ?',
            'siii', [$name, $sort, $show, $id]
        );
    }

    public function xoa_theloai(int $id): bool
    {
        return $this->db_query('DELETE FROM theloai WHERE idTL = ?', 'i', [$id]);
    }
}
