<?php
declare(strict_types=1);

namespace App\Models\Securite;

use App\Config\database;
use PDO;

/**
 * Modèle NiveauAccesDonnees (granularité d’accès)
 */
class NiveauAccesDonnees
{
    private int    $id_niv_acc;
    private string $libniv_acc;

    public function __construct(int $id, string $lib)
    {
        $this->id_niv_acc = $id;
        $this->libniv_acc = $lib;
    }

    public function getId(): int
    {
        return $this->id_niv_acc;
    }

    public function getLibelle(): string
    {
        return $this->libniv_acc;
    }

    public function setLibelle(string $lib): void
    {
        $this->libniv_acc = $lib;
    }

    /**
     * @return NiveauAccesDonnees[]
     */
    public static function findAll(): array
    {
        $sql  = 'SELECT id_niv_acc, libniv_acc FROM niveau_acces_donnees ORDER BY id_niv_acc';
        $pdo  = database::getConnection();
        $stmt = $pdo->query($sql, PDO::FETCH_ASSOC);

        $levels = [];
        foreach ($stmt as $row) {
            $levels[] = new self((int)$row['id_niv_acc'], $row['libniv_acc']);
        }
        return $levels;
    }

    public static function find(int $id): ?self
    {
        $sql  = 'SELECT id_niv_acc, libniv_acc FROM niveau_acces_donnees WHERE id_niv_acc = :id';
        $pdo  = database::getConnection();
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['id' => $id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        return $row
            ? new self((int)$row['id_niv_acc'], $row['libniv_acc'])
            : null;
    }

    public function save(): void
    {
        $pdo = database::getConnection();

        if (self::find($this->id_niv_acc) !== null) {
            $sql  = 'UPDATE niveau_acces_donnees 
                     SET libniv_acc = :lib 
                     WHERE id_niv_acc = :id';
            $stmt = $pdo->prepare($sql);
            $stmt->execute([
                'lib' => $this->libniv_acc,
                'id'  => $this->id_niv_acc,
            ]);
        } else {
            $sql  = 'INSERT INTO niveau_acces_donnees (id_niv_acc, libniv_acc) 
                     VALUES (:id, :lib)';
            $stmt = $pdo->prepare($sql);
            $stmt->execute([
                'id'  => $this->id_niv_acc,
                'lib' => $this->libniv_acc,
            ]);
        }
    }

    public function delete(): void
    {
        $sql  = 'DELETE FROM niveau_acces_donnees WHERE id_niv_acc = :id';
        $pdo  = database::getConnection();
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['id' => $this->id_niv_acc]);
    }
}
