<?php

namespace App\Security\Voter;

use App\Entity\User;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;

class UserVoter extends Voter
{
    const VIEW = 'view';

    const CREATE = 'create';

    const UPDATE = 'update';

    /**
     * @param string $attribute
     * @param mixed  $subject
     */
    protected function supports($attribute, $subject): bool
    {
        if (!in_array($attribute, [self::VIEW, self::CREATE, self::UPDATE])) {
            return false;
        }

        if (!$subject instanceof User) {
            return false;
        }

        return true;
    }

    /**
     * @param string $attribute
     * @param mixed  $subject
     *
     * @return bool
     */
    protected function voteOnAttribute($attribute, $subject, TokenInterface $token)
    {
        $user = $token->getUser();

        if (!$user instanceof User) {
            return false;
        }

        switch ($attribute) {
            case self::VIEW:
                return $this->canView($user);
            case self::CREATE:
                return $this->canCreate($user);
            case self::UPDATE:
                return $this->canUpdate($user);
        }

        throw new \LogicException('This code should not be reached!');
    }

    /**
     * @param User $user
     * @return boolean
     */
    private function canView(User $user): bool
    {
        return '["ROLE_ADMIN"]' === $user->getRoles();
    }

    /**
     * @param User $user
     * @return boolean
     */
    private function canCreate(User $user)
    {
        return '["ROLE_ADMIN"]' === $user->getRoles();
    }

    /**
     * @param User $user
     * @return boolean
     */
    private function canUpdate(User $user)
    {
        return '["ROLE_ADMIN"]' === $user->getRoles();
    }
}
