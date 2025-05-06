<?php
declare(strict_types=1);

namespace App\Service;

use App\Config\Database;
use PDO;
use PDOException;

class AuthService
{
    private PDO        $pdo;
    private JwtService $jwt;

    public function __construct(JwtService $jwt)
    {
        // Charger la config PDO
        $dbConf = require __DIR__ . '/../Config/database.php';
        $cfg    = $dbConf['default'];
        $dsn    = sprintf(
            '%s:host=%s;port=%s;dbname=%s;charset=%s',
            $cfg['driver'], $cfg['host'], $cfg['port'], $cfg['database'], $cfg['charset']
        );
        $this->pdo = new PDO($dsn, $cfg['username'], $cfg['password'], $cfg['options']);
        $this->jwt = $jwt;
    }

    /**
     * Tente de connecter un utilisateur (étudiant/enseignant/admin).
     *
     * @param string $login
     * @param string $password
     * @return string|null  JWT en cas de succès, null sinon
     */
    public function login(string $login, string $password): ?string
    {
        // On stocke ici les tables + champs + rôle
        $candidats = [
            ['table'=>'etudiant',        'loginCol'=>'login_etu',   'pwdCol'=>'mdp_etu',   'role'=>'N1'],
            ['table'=>'enseignant',      'loginCol'=>'login_ens',   'pwdCol'=>'mdp_ens',   'role'=>'N2'],
            ['table'=>'personnel_admin', 'loginCol'=>'login_pers',  'pwdCol'=>'mdp_pers',  'role'=>'N4'],
        ];

        foreach ($candidats as $c) {
            $sql  = "SELECT * FROM {$c['table']} WHERE {$c['loginCol']} = :login";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute(['login'=>$login]);
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($user && password_verify($password, $user[$c['pwdCol']])) {
                // On embarque au minimum : id et rôle
                $idCol = array_key_first($user);
                $payload = [
                    'sub'  => $user[$idCol],
                    'role' => $c['role'],
                ];
                return $this->jwt->generateToken($payload);
            }
        }

        return null;
    }

    /**
     * Vérifie un token et renvoie le payload.
     *
     * @param string $token
     * @return object
     */
    public function authenticate(string $token): object
    {
        return $this->jwt->validateToken($token);
    }
}
