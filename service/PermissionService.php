<?php
declare(strict_types=1);

namespace App\Service;

class PermissionService
{
    /**
     * @param object $user     Payload JWT décodé (doit contenir la propriété ->role)
     * @param array  $route    Définition de route (tableau avec clé 'roles'=>[…])
     * @return bool            True si le rôle de l’utilisateur est dans la liste autorisée
     */
    public static function canAccessRoute(object $user, array $route): bool
    {
        // Si pas de restriction, c’est public
        if (empty($route['roles'])) {
            return true;
        }

        return in_array($user->role, $route['roles'], true);
    }

    /**
     * Vérifie un rôle spécifique.
     *
     * @param object $user
     * @param string $requiredRole  Ex. 'N3'
     * @return bool
     */
    public static function hasRole(object $user, string $requiredRole): bool
    {
        return isset($user->role) && $user->role === $requiredRole;
    }
}
