<?php

namespace App\Security\Voter;

use App\Entity\Task;
use App\Entity\User;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;

class TaskVoter extends Voter
{
    const EDIT = 'edit';

    const DELETE = 'delete';

    /**
     * @param string $attribute
     * @param mixed  $subject
     */
    protected function supports($attribute, $subject): bool
    {
        if (!in_array($attribute, [self::EDIT, self::DELETE])) {
            return false;
        }

        if (!$subject instanceof Task) {
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

        $task = $subject;

        switch ($attribute) {
            case self::EDIT:
                return $this->canEdit($task, $user);
            case self::DELETE:
                return $this->canDelete($task, $user);
                /*
                if ($user === $subject->getUser()) {
                    return true;
                }
                if ($this->security->isGranted('ROLE_ADMIN') && $subject->getUser()->getUsername() == 'UserAnon') {
                    return true;
                }
                */
        }

        throw new \LogicException('This code should not be reached!');
    }

    private function canEdit(Task $task, User $user): bool
    {
        return $user === $task->getUser();
    }

    private function canDelete(Task $task, User $user): bool
    {
        if ($user->getRoles() === '["ROLE_ADMIN"]' || $user === $task->getUser()) {
			return true;
		}
    }
}
