<?php

use GoldRush\QuestCreator\Quest;
use GoldRush\QuestCreator\Condition;
use pocketmine\entity\Human;

(new Quest("theohdg2","un simple exemple de quête pour vous !"))
    ->setResult([],100,[ //donnera 100 de money
        "mineur:1" //donnera 1 lvl au job mineur
    ])
    ->addCondition(new Condition(Condition::COND_TYPE_PASS_JOB_LVL,"mineur","14"))
    ->addCondition(new Condition(Condition::COND_TYPE_KILL_ENTITY,Human::class))
    ->submit(__FILE__);
