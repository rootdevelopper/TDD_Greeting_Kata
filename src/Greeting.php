<?php

namespace tdd_tests;

class Greeting {

private $greeting = 'Hello,';
private $defaultName = ' my friend';
private $mixedName = '';
private $names = [];

    public function greet($name)
    {
        if (empty($name)) {
            return $this->greeting . $this->defaultName;
        }

        if(is_array($name)){
            return $this->complexGreeting($name, $this->names);
        }

        return $this->simpleGreeting($name, $this->greeting);
    }

    private function simpleGreeting($name, $greeting): string
    {
        if (strtoupper($name) == $name) {
            $greeting = substr(strtoupper($greeting), 0, strlen($greeting) - 1);
            $name = $name . '!';
        }
        return $greeting . ' ' . $name;
    }

    private function complexGreeting($name, $names): string
    {
        foreach ($name as $singleName) {
            if (strpos($singleName, ',')) {
                return $this->greet($this->splitArrayWithDoubleString($name, $singleName));
            }
            $names = $this->splitArrayWithSingleString($names, $singleName);
        }

        array_splice($names, count($names) - 1, 0, 'and');

        if (count($names) > 3 || $this->mixedName !== '') {
            return $this->greetManyMessage($names);
        }
        return $this->greetSingleMessage($names);
    }

    private function splitArrayWithSingleString($names, $singleName): array
    {
        if (strtoupper($singleName) == $singleName) {
            $this->mixedName .= ' AND ' . $this->simpleGreeting($singleName, $this->greeting, $this->defaultName);
        } else {
            $names[] = $singleName;
        }
        return $names;
    }

    private function splitArrayWithDoubleString($name, $singleName): array
    {
        $splitDoubles = explode(',', str_replace(' ', '', ($singleName)));
        $joinMultiples = array_merge([$name[0]], $splitDoubles);
        return $joinMultiples;
    }

    private function getMultiplePeopleGreeting($original)
    {
        $multiplePeople = str_replace('and,', 'and', implode(', ', $original));
        if ($this->mixedName !== '') {
            $multiplePeople = str_replace(', and', ' and', $multiplePeople);
        }
        return $multiplePeople;
    }

    private function greetManyMessage($names): string
    {
        $greetMany = $this->greeting . ' ' . $this->getMultiplePeopleGreeting($names) . '.' . $this->mixedName;
        return $greetMany;
    }

    private function greetSingleMessage($names): string
    {
        $greetSingleMessage = $this->greeting . ' ' . implode(' ', $names) . '.';
        return $greetSingleMessage;
    }


}
