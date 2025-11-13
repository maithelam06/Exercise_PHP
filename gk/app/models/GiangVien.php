<?php
class GiangVien {
    private PDO $db;
    public function __construct() {
        $this->db = Database::getInstance();
    }

    public function all(): array {
        $stmt = $this->db->query("SELECT * FROM GiangVien ORDER BY MaGV");
        return $stmt->fetchAll();
    }

    public function find(string $MaGV): ?array {
        $stmt = $this->db->prepare("SELECT * FROM GiangVien WHERE MaGV = ?");
        $stmt->execute([$MaGV]);
        $row = $stmt->fetch();
        return $row ?: null;
    }

    public function create(array $gv): bool {
        $sql = "INSERT INTO GiangVien (MaGV, HoTen, HinhAnh, TongSoLop) VALUES (?, ?, ?, ?)";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([$gv['MaGV'], $gv['HoTen'], $gv['HinhAnh'], (int)$gv['TongSoLop']]);
    }

    public function update(string $MaGV, array $gv): bool {
        $sql = "UPDATE GiangVien SET HoTen = ?, HinhAnh = ?, TongSoLop = ? WHERE MaGV = ?";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([$gv['HoTen'], $gv['HinhAnh'], (int)$gv['TongSoLop'], $MaGV]);
    }

    public function delete(string $MaGV): bool {
        $stmt = $this->db->prepare("DELETE FROM GiangVien WHERE MaGV = ?");
        return $stmt->execute([$MaGV]);
    }
}
