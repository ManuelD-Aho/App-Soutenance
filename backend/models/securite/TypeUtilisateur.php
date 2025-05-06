<?php
declare(strict_types=1);

namespace App\Models\Securite;

use App\Config\database;
use PDO;

/**
 * Modèle TypeUtilisateur (N0–N4)
 */
class TypeUtilisateur
{
    private int $id_TU;
    private string $lib_TU;

    public function __construct(int $id_TU, string $lib_TU)
    {
        $this->id_TU  = $id_TU;
        $this->lib_TU = $lib_TU;
    }

    public function getId(): int
    {
        return $this->id_TU;
    }

    public function getLibelle(): string
    {
        return $this->lib_TU;
    }

    public function setLibelle(string $lib): void
    {
        $this->lib_TU = $lib;
    }

    /**
     * @return TypeUtilisateur[]
     */
    public static function findAll(): array
    {
        $sql  = 'SELECT id_TU, lib_TU FROM typeutilisateur ORDER BY id_TU';
        $pdo  = database::getConnection();
        $stmt = $pdo->query($sql, PDO::FETCH_ASSOC);

        $types = [];
        foreach ($stmt as $row) {
            $types[] = new self((int)$row['id_TU'], $row['lib_TU']);
        }
        return $types;
    }

    public static function find(int $id): ?self
    {
        $sql  = 'SELECT id_TU, lib_TU FROM typeutilisateur WHERE id_TU = :id';
        $pdo  = database::getConnection();
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['id' => $id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        return $row
            ? new self((int)$row['id_TU'], $row['lib_TU'])
            : null;
    }

    public function save(): void
    {
        $pdo = database::getConnection();

        if (self::find($this->id_TU) !== null) {
            // update
            $sql  = 'UPDATE typeutilisateur SET lib_TU = :lib WHERE id_TU = :id';
            $stmt = $pdo->prepare($sql);
            $stmt->execute([
                'lib' => $this->lib_TU,
                'id'  => $this->id_TU,
            ]);
        } else {
            // insert
            $sql  = 'INSERT INTO typeutilisateur (id_TU, lib_TU) VALUES (:id, :lib)';
            $stmt = $pdo->prepare($sql);
            $stmt->execute([
                'id'  => $this->id_TU,
                'lib' => $this->lib_TU,
            ]);
        }
    }

    public function delete(): void
    {
        $sql  = 'DELETE FROM typeutilisateur WHERE id_TU = :id';
        $pdo  = database::getConnection();
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['id' => $this->id_TU]);
    }

    /**
     * Renvoie les GroupeUtilisateur associés.
     * @return GroupeUtilisateur[]
     */
    public function getGroupes(): array
    {
        return GroupeUtilisateur::findByType($this->id_TU);
    }
}
