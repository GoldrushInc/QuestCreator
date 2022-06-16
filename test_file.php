<?php

require_once "./Quest.php";
require_once "./Condition.php";

use GoldRush\QuestCreator\Quest;
use GoldRush\QuestCreator\Condition;

(new Quest("theohdg2","ok"))
    ->setResult([])
    ->addCondition(new Condition(Condition::COND_TYPE_PASS_JOB_LVL,"farmeur",2))
    ->addCondition(new Condition(Condition::COND_TYPE_PASS_JOB_LVL,"mineur",1))
    ->submit(__FILE__);