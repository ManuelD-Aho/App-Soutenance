<?php
declare(strict_types=1);

namespace App;

use PDO;
use App\Config\QueryBuilder;

/**
 * Pattern Repository générique pour CRUD sur une table via QueryBuilder.
 */
class Repository
{
    protected PDO $pdo;
    protected QueryBuilder $qb;
    protected string $table;
    protected string $primaryKey;

    /**
     * @param PDO    $pdo        Instance PDO
     * @param string $table      Nom de la table SQL
     * @param string $primaryKey Nom de la clé primaire (défaut 'id')
     */
    public function __construct(PDO $pdo, string $table, string $primaryKey = 'id')
    {
        $this->pdo        = $pdo;
        $this->qb         = new QueryBuilder($pdo);
        $this->table      = $table;
        $this->primaryKey = $primaryKey;
    }

    /**
     * Retourne tous les enregistrements.
     */
    public function all(): array
    {
        return $this->qb
            ->table($this->table)
            ->get();
    }

    /**
     * Trouve un enregistrement par sa clé primaire.
     */
    public function find(mixed $id): ?array
    {
        return $this->qb
            ->table($this->table)
            ->where("{$this->primaryKey} = :id", ['id' => $id])
            ->first();
    }

    /**
     * Insère un nouvel enregistrement.
     * @return int ID inséré
     */
    public function create(array $data): int
    {
        return $this->qb
            ->table($this->table)
            ->insert($data);
    }

    /**
     * Met à jour un enregistrement existant.
     * @return int Nombre de lignes affectées
     */
    public function update(mixed $id, array $data): int
    {
        return $this->qb
            ->table($this->table)
            ->where("{$this->primaryKey} = :id", ['id' => $id])
            ->update($data);
    }

    /**
     * Supprime un enregistrement.
     * @return int Nombre de lignes supprimées
     */
    public function delete(mixed $id): int
    {
        return $this->qb
            ->table($this->table)
            ->where("{$this->primaryKey} = :id", ['id' => $id])
            ->delete();
    }

    /**
     * Accès direct au QueryBuilder pour requêtes personnalisées.
     */
    public function query(): QueryBuilder
    {
        return $this->qb->table($this->table);
    }
}
