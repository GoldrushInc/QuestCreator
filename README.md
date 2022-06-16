# QuestCreator
permet d'aider au développement de GoldRush en faisant des quêtes très simplement

# Utilisation

utiliser QuestCreator est très simple, il vous suffit juste de suivre ce tuto

## Créer une quête basique
```php
<?php

use GoldRush\QuestCreator\Quest;

$quest = new Quest();
```

# Definir la récompense de cette quête

```php
$items = []; //doit être un array d'item
$money = 100; //doit être un entier positif
$addXpJob = ["mineur:1"]; //doit être un array de string, métier disponible: mineur,farmeur,assasin,bucheron

$quest->setResult($item,$money,$addXpJob); //$money et $addXpJob est nullable
```
# Ajouter une conditon à la quêtes

## Tuer un mob/boss
```php
$quest->addCondition(Condition::COND_TYPE_KILL_ENTITY,Entity::class);
```
ou 
```php
$entity = new Cow();
$quest->addCondition(Condition::COND_TYPE_KILL_ENTITY,$entity);
```

## Interagir avec une entité (mob,boss,player)
```php
$quest->addCondition(Condition::COND_TYPE_INTERACT_ENTITY,Entity::class);
```
ou
```php
$quest->addCondition(Condition::COND_TYPE_INTERACT_ENTITY,$entity);
```

## Atteindre un certain niveaux dans un métier

```php
$job = "mineur"; //mineur,farmeur,bucheron,assasin
$niveaux = 10;
$quest->addCondition(Condition::COND_TYPE_PASS_JOB_LVL,$job,$niveaux);
``` 

# Soumettre votre quête fini à GoldRush

```php
$quest->submit();
```
