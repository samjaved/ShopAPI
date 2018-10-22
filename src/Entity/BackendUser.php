<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 21/10/2018
 * Time: 1:28 PM
 */

namespace App\Entity;
use Doctrine\ORM\Mapping as ORM;
/**
 * @ORM\Entity
 * @ORM\Table(name="backend_user", indexes={@ORM\Index(name="backend_user_username", columns={"username"})})
 */
class BackendUser extends User
{
    const ROLE_ADMIN = 'ROLE_ADMIN';
    /**
     * {@inheritdoc}
     */
    public function getRoles()
    {
        return [self::ROLE_ADMIN];
    }
}