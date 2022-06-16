<?php

namespace GoldRush\QuestCreator;

class Condition
{
    const COND_TYPE_KILL_ENTITY = 1;
    const COND_TYPE_INTERACT_ENTITY = 3;
    const COND_TYPE_PASS_JOB_LVL = 4;

    public function __construct(int $type,...$args)
    {
        $this->init($type,$args);
    }

    private function init($type,$args): bool{
        switch ($type){
            case self::COND_TYPE_KILL_ENTITY:
            case self::COND_TYPE_INTERACT_ENTITY:
                if(isset($args[0]) && class_exists($args[0])){
                    return true;
                }else{
                    throw new \Exception("la class n'existe pas !");
                }
            case self::COND_TYPE_PASS_JOB_LVL:
                $arr = ["mineur","farmeur","assasin","bucheron"];
                if(isset($args[0]) && in_array($args[0],$arr)){
                    if(isset($args[1]) && is_int($args[1]) && $args[1] > 0 && $args[1] < PHP_INT_MAX){
                        return true;
                    }else{
                        throw new \Exception($args[1]." n'est pas un entier positif valide");
                    }
                }else{
                    throw new \Exception($args[0]." n'est pas un métier valide");
                }
            default:
                return false;
        }
    }
}