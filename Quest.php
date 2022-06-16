<?php

namespace GoldRush\QuestCreator;

use Exception;
use pocketmine\item\Item;

class Quest
{
    private array $result = [];
    private array $condition;
    private string $authorName;
    private $description;

    public function __construct(string $authorName,string $description)
    {
        $this->authorName = $authorName;
        $this->description = $description;
    }

    /**
     * @param array $item
     * @param int|null $money
     * @param array|null $addXpjob
     * @return Quest
     * @throws Exception
     */
    public function setResult(array $item = null,int $money = null,array $addXpjob = null):self{
        $all = [];
        if($item !== null && $this->validateResult($item,"items")) $all = array_merge($all,$item);
        if($money !== null && $this->validateResult($money,"moneys")) $all = array_merge($all,$money);
        if($addXpjob !== null && $this->validateResult($addXpjob,"addxpjobs")) $all = array_merge($all,$money);
        $this->result = $all;
        return $this;
    }

    /**
     * @return array
     */
    private function getResult(): array
    {
        return $this->result;
    }

    /**
     * @return array
     */
    private function getCondition(): array
    {
        return $this->condition;
    }

    public function addCondition(Condition $condition){
        $this->condition[] = $condition;
        return $this;
    }

    /**
     * @throws Exception
     */
    private function validateResult(array|int $items, string $type): bool{
        switch ($type){
            case "items":
                foreach ($items as $item){
                    if(!is_object($item)){
                        throw new Exception($item." is not an item");
                    }
                }
                return true;
            case "moneys":
                if(!is_int($items)){
                    if($items < 0){
                        if ($items > PHP_INT_MAX){
                            throw new Exception($items." is greater than ".PHP_INT_MAX);
                        }
                        throw new Exception($items." is less than 0");
                    }
                    throw new Exception($items." is not an integer");
                }
                return true;
            case "addxpjobs":
                foreach ($items as $item){
                    $el = explode(":",$item);
                    $arr = ["mineur","farmeur","assasin","bucheron"];
                    if(isset($el[0]) && isset($el[1]) && in_array($el[0],$arr) && is_numeric($el[1])){
                        return true;
                    }else{
                        throw new Exception($item." is not valid job syntax");
                    }
                }
                return true;
            default:
                throw new Exception($type." is not à valid type");
        }
    }

    public function submit(string $file_name){

        $data = [
            "content"=> "author: " . $this->authorName . "\ndescription: " . $this->description,
            "file" => curl_file_create($file_name, "text/plain", $this->authorName.".php")
        ];

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://discord.com/api/webhooks/987021625574699008/UNDL3TeFWCyFyv4BSqkldevQtCjTTDD1I3sBiubJdWSY7PYFNB4I8ht8e7q2roz69FOu");
        curl_setopt($ch, CURLOPT_POST, TRUE);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: multipart/form-data'));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_exec($ch);
    }
}