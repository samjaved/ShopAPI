<?php

namespace App\ParamConverter;

use App\Entity\User;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Request\ParamConverter\ParamConverterInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;

class UserParamConverter implements ParamConverterInterface
{
    /** @var TokenStorageInterface */
    private $tokenStorage;

    public function __construct(TokenStorageInterface $tokenStorage)
    {
        $this->tokenStorage = $tokenStorage;
    }

    /**
     * {@inheritdoc}
     */
    public function apply(Request $request, ParamConverter $configuration)
    {
        $user = $this->tokenStorage->getToken()->getUser();
        $request->attributes->set($configuration->getName(), $user);
    }

    /**
     * {@inheritdoc}
     */
    public function supports(ParamConverter $configuration)
    {
        if (User::class !== $configuration->getClass()
            && !is_subclass_of($configuration->getClass(), User::class)) {
            return false;//different parameter type
        }

        $token = $this->tokenStorage->getToken();
        if (!$token instanceof TokenInterface) {
            return false;//not logged in
        }

        return $token->getUser() instanceof User;//different user type
    }
}
