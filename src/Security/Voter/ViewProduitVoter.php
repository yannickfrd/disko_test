<?php

namespace App\Security\Voter;

use App\Entity\Produit;
use App\Entity\User;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\VoterInterface;

class ViewProduitVoter implements VoterInterface{

    public function vote(TokenInterface $token, $subject, array $attributes)
    {
        if (!$subject instanceof Produit){
            return self::ACCESS_ABSTAIN;
        }
        if (!in_array('VIEW', $attributes)){
            return self::ACCESS_ABSTAIN;
        }

        $user = $token->getUser();
        if (!$user instanceof User){
            return self::ACCESS_DENIED;
        }
        if ($user !== $subject->getUserProd()){
            return self::ACCESS_DENIED;
        }

        return self::ACCESS_GRANTED;
    }
}

























//
//namespace App\Security\Voter;
//
//use App\Entity\Produit;
//use App\Entity\User;
//use phpDocumentor\Reflection\Types\Self_;
//use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
//use Symfony\Component\Security\Core\Authorization\Voter\Voter;
//use Symfony\Component\Security\Core\User\UserInterface;
//
//class ViewProduitVoter extends Voter
//{
//    // these strings are just invented: you can use anything
//    const VIEW = 'ROLE_VIEW_PRODUIT';
//
//    protected function supports($attribute, $subject)
//    {
//        // if the attribute isn't one we support, return false
//        if (!in_array($attribute, array(self::VIEW))) {
//            return false;
//        }
//
//        return true;
//
//        // replace with your own logic
//        // https://symfony.com/doc/current/security/voters.html
////        return in_array($attribute, [self::VIEW])
////            && $subject instanceof \App\Entity\Produit;
//    }
//
//    protected function voteOnAttribute($attribute, $subject, TokenInterface $token)
//    {
//        $user = $token->getUser();
//        // if the user is anonymous, do not grant access
//
//        if (!$user instanceof Produit) {
//            return self::ACCESS_ABSTAIN;
//        }
//        if ($user !== $subject->getUserProd()){
//            return self::ACCESS_DENIED;
//        }
//
//        // ... (check conditions and return true to grant permission) ...
//        switch ($attribute) {
//            case 'POST_VIEW':
//                // logic to determine if the user can VIEW
//                return $this->canShow($subject, $user);
//                // return true or false
//                break;
//        }
//
//        return self::ACCESS_GRANTED;
////        return new \LogicException('This code should not be reached!');
//    }
//
//    private function canShow(Produit $produit, User $user)
//    {
//        // this assumes that the data object has a getOwner() method
//        // to get the entity of the user who owns this data object
//        return $user === $produit->getUserProd();
//    }
//}
