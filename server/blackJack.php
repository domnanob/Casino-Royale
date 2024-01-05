<?php 
class Dealer {
    public $deck;
    function __construct() {
        $this->deck = array(); 
        $suits = SUITS;
        foreach ($suits as $suit) {
            foreach (VALUES as $num) {
                $card = new Card($suit, $num);
                array_push($this->deck, $card);
            }
        }
    }
    function getCard() {
        $key = array_rand($this->deck);
        $element = $this->deck[$key];
        unset($this->deck[$key]);
        return $element;
    }
}

define("SUITS", array("hearts", "spades", "clubs", "diamonds"));
define("VALUES", array("2", "3", "4", "5", "6", "7", "8", "9", "10", "jack", "king", "queen", "ace"));

class Card {
    public $name;
    public $value;

    function __construct($cardname, $cardvalue) { 
        $this->name = $cardname;
        $this->value = $cardvalue;
    }

    function getValue() {
        switch ($this->value) {
            case "jack":
                return 10;
            case "queen":
                return 10;
            case "king":
                return 10;
            case "ace":
                return 0;
            default:
                return intval($this->value);
        }
    }
}

class Hand {
    public $hand;

    function addCard($card) {
        array_push($this->hand, $card);
    }
    function getValue() {
        $val = 0;
        foreach ($this->hand as $card) {
            $temp = $card->getValue();
            $val += ($temp == 0) ? (($val + 11 > 21) ? 1 : 11) : $temp;
        }
        return $val;
    }
    function __construct() { 
        $this->hand = array();
    }
}

?>