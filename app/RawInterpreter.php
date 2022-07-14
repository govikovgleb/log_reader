<?php

namespace App;

class RawInterpreter
{
    private string $inputRaw;
    public string $responseCode;
    public string $trafic;
    public string $url;
    public ?string $searchBot;
    private array $searchBotsList = [
        'Googlebot',
        'YandexBot'
    ];

    public function __construct(string $inpitRaw)
    {
        $this->inputRaw = $inpitRaw;
        $this->setFields();
    }

    private function setFields() : void
    {
        $matches = $this->findMatches();
        $this->responseCode = $matches[1];
        $this->trafic = $matches[2];
        $this->url = $matches[3];
        $this->searchBot = $this->checkSearchBot($matches[4]);
    }

    /**
     * @return array
     */
    private function findMatches() : array
    {
        preg_match('/".*?"\s([0-9]*)\s([0-9]*)\s"(.*?)"\s"(.*?)"/', $this->inputRaw, $matches);
        return $matches;
    }

    /**
     * @param string $userAgentInfo
     * @return string|null
     */
    private function checkSearchBot(string $userAgentInfo) : ?string
    {
        foreach ($this->searchBotsList as $bot) {
            if (strstr($userAgentInfo, $bot)) return $bot;
        }
        return null;
    }
}