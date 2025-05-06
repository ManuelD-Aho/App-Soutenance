<?php
declare(strict_types=1);

namespace App\Config;

use PDO;

class QueryBuilder
{
    protected PDO $pdo;
    protected string $table;
    protected array $select = ['*'];
    protected string $where = '';
    protected array $params = [];
    protected string $orderBy = '';
    protected ?int $limit = null;
    protected ?int $offset = null;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function table(string $table): self
    {
        $this->table = $table;
        return $this->resetQuery();
    }

    public function select(string|array ...$columns): self
    {
        if (count($columns) === 1 && is_array($columns[0])) {
            $this->select = $columns[0];
        } else {
            $this->select = $columns;
        }
        return $this;
    }

    public function where(string $condition, array $params = []): self
    {
        $this->where  = "WHERE {$condition}";
        $this->params = array_merge($this->params, $params);
        return $this;
    }

    public function orderBy(string $column, string $direction = 'ASC'): self
    {
        $dir = strtoupper($direction) === 'DESC' ? 'DESC' : 'ASC';
        $this->orderBy = "ORDER BY {$column} {$dir}";
        return $this;
    }

    public function limit(int $limit, int $offset = null): self
    {
        $this->limit  = $limit;
        $this->offset = $offset;
        return $this;
    }

    public function get(): array
    {
        $stmt = $this->pdo->prepare($this->toSql());
        $stmt->execute($this->params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function first(): ?array
    {
        $this->limit(1);
        $results = $this->get();
        return $results[0] ?? null;
    }

    public function insert(array $data): int
    {
        $cols  = array_keys($data);
        $binds = array_map(fn(string $c) => ":{$c}", $cols);
        $sql   = sprintf(
            'INSERT INTO %s (%s) VALUES (%s)',
            $this->table,
            implode(', ', $cols),
            implode(', ', $binds)
        );

        $stmt = $this->pdo->prepare($sql);
        foreach ($data as $col => $val) {
            $stmt->bindValue(":{$col}", $val);
        }
        $stmt->execute();

        return (int) $this->pdo->lastInsertId();
    }

    public function update(array $data): int
    {
        $pairs = array_map(fn(string $col) => "{$col} = :{$col}", array_keys($data));
        $sql   = sprintf(
            'UPDATE %s SET %s %s',
            $this->table,
            implode(', ', $pairs),
            $this->where
        );

        $stmt = $this->pdo->prepare($sql);
        foreach (array_merge($data, $this->params) as $key => $val) {
            $stmt->bindValue(":{$key}", $val);
        }
        $stmt->execute();

        return $stmt->rowCount();
    }

    public function delete(): int
    {
        $sql  = sprintf('DELETE FROM %s %s', $this->table, $this->where);
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($this->params);
        return $stmt->rowCount();
    }

    public function toSql(): string
    {
        $limitOffset = $this->buildLimitOffset();
        $sql = sprintf(
            'SELECT %s FROM %s %s %s %s',
            implode(', ', $this->select),
            $this->table,
            $this->where,
            $this->orderBy,
            $limitOffset
        );

        return trim($sql);
    }

    protected function buildLimitOffset(): string
    {
        if ($this->limit === null) {
            return '';
        }

        $clause = "LIMIT {$this->limit}";
        if ($this->offset !== null) {
            $clause .= " OFFSET {$this->offset}";
        }
        return $clause;
    }

    protected function resetQuery(): self
    {
        $this->select   = ['*'];
        $this->where    = '';
        $this->params   = [];
        $this->orderBy  = '';
        $this->limit    = null;
        $this->offset   = null;
        return $this;
    }
}
