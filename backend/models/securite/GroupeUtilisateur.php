<?php
declare(strict_types=1);

namespace App\Models\Securite;

use App\Config\Database;
use PDO;

/**
 * Modèle GroupeUtilisateur (groupes de permissions par typeUtilisateur)
 */
class GroupeUtilisateur
{
    private int    $id_GU;
    private string $lib_GU;
    private int    $id_TU;

    public function __construct(int $id_GU, string $lib_GU, int $id_TU)
    {
        $this->id_GU = $id_GU;
        $this->lib_GU = $lib_GU;
        $this->id_TU = $id_TU;
    }

    public function getId(): int
    {
        return $this->id_GU;
    }

    public function getLibelle(): string
    {
        return $this->lib_GU;
    }

    public function setLibelle(string $lib): void
    {
        $this->lib_GU = $lib;
    }

    public function getTypeId(): int
    {
        return $this->id_TU;
    }

    public function setTypeId(int $typeId): void
    {
        $this->id_TU = $typeId;
    }

    /**
     * @return GroupeUtilisateur[]
     */
    public static function findAll(): array
    {
        $sql  = 'SELECT id_GU, lib_GU, id_TU FROM groupe_utilisateur ORDER BY lib_GU';
        $pdo  = database::getConnection();
        $stmt = $pdo->query($sql, PDO::FETCH_ASSOC);

        $groups = [];
        foreach ($stmt as $row) {
            $groups[] = new self((int)$row['id_GU'], $row['lib_GU'], (int)$row['id_TU']);
        }
        return $groups;
    }

    public static function find(int $id): ?self
    {
        $sql  = 'SELECT id_GU, lib_GU, id_TU FROM groupe_utilisateur WHERE id_GU = :id';
        $pdo  = database::getConnection();
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['id' => $id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        return $row
            ? new self((int)$row['id_GU'], $row['lib_GU'], (int)$row['id_TU'])
            : null;
    }

    /**
     * @return GroupeUtilisateur[]
     */
    public static function findByType(int $typeId): array
    {
        $sql  = 'SELECT id_GU, lib_GU, id_TU FROM groupe_utilisateur WHERE id_TU = :tu';
        $pdo  = database::getConnection();
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['tu' => $typeId]);

        $groups = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $groups[] = new self((int)$row['id_GU'], $row['lib_GU'], (int)$row['id_TU']);
        }
        return $groups;
    }

    public function save(): void
    {
        $pdo = database::getConnection();

        if (self::find($this->id_GU) !== null) {
            $sql  = 'UPDATE groupe_utilisateur 
                     SET lib_GU = :lib, id_TU = :tu 
                     WHERE id_GU = :id';
            $stmt = $pdo->prepare($sql);
            $stmt->execute([
                'lib' => $this->lib_GU,
                'tu'  => $this->id_TU,
                'id'  => $this->id_GU,
            ]);
        } else {
            $sql  = 'INSERT INTO groupe_utilisateur (id_GU, lib_GU, id_TU) 
                     VALUES (:id, :lib, :tu)';
            $stmt = $pdo->prepare($sql);
            $stmt->execute([
                'id'  => $this->id_GU,
                'lib' => $this->lib_GU,
                'tu'  => $this->id_TU,
            ]);
        }
    }

    public function delete(): void
    {
        $sql  = 'DELETE FROM groupe_utilisateur WHERE id_GU = :id';
        $pdo  = database::getConnection();
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['id' => $this->id_GU]);
    }

    public function getTypeUtilisateur(): ?TypeUtilisateur
    {
        return TypeUtilisateur::find($this->id_TU);
    }
}
