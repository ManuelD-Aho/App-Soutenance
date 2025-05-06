<?php
declare(strict_types=1);

namespace App\Service;

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class JwtService
{
    private string $secret;
    private string $algo;

    /**
     * @param string $secret  Clé secrète pour signer vos JWT
     * @param string $algo    Algorithme (ex. "HS256")
     */
    public function __construct(string $secret, string $algo = 'HS256')
    {
        $this->secret = $secret;
        $this->algo   = $algo;
    }

    /**
     * Génère un JWT.
     *
     * @param array   $payload  Données à embarquer
     * @param int     $ttl      Durée de vie en secondes (défaut 3600)
     * @return string           Token encodé
     */
    public function generateToken(array $payload, int $ttl = 3600): string
    {
        $now   = time();
        $token = array_merge([
            'iat' => $now,
            'exp' => $now + $ttl,
        ], $payload);

        return JWT::encode($token, $this->secret, $this->algo);
    }

    /**
     * Décode et vérifie un JWT.
     *
     * @param string $token  Le token à valider
     * @return object        Payload décodé en stdClass
     */
    public function validateToken(string $token): object
    {
        return JWT::decode($token, new Key($this->secret, $this->algo));
    }
}
