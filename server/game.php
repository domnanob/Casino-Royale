<?php
include "./blackJack.php";
class Response
{
    public $dealerHand;
    public $playerHand;
    public $responseText;

    function setDealerHand($hand)
    {
        $this->dealerHand = $hand;
    }
    function setPlayerHand($hand)
    {
        $this->playerHand = $hand;
    }
    function setResponseText($text)
    {
        $this->responseText = $text;
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    session_start();
    $response = new Response();
    $request = explode(";", $_REQUEST["p"]);
    switch ($request[0]) {
        case "start":
            $_SESSION["price"] = $request[1];
            include_once "./setBalance.php";
            setBalance($request[1]*(-1));
            $_SESSION["dealer"] = new Dealer();
            $_SESSION["playerHand"] = new Hand();
            $_SESSION["dealerHand"] = new Hand();

            $_SESSION["playerHand"]->addCard($_SESSION["dealer"]->getCard());
            $_SESSION["playerHand"]->addCard($_SESSION["dealer"]->getCard());

            $_SESSION["dealerHand"]->addCard($_SESSION["dealer"]->getCard());

            if ($_SESSION["playerHand"]->getValue() == 21) {
                $response->setResponseText("Black Jack!");
                $_SESSION["dealerHand"]->addCard($_SESSION["dealer"]->getCard());
                end_game(true, $request[1]);
            }

            $response->setPlayerHand($_SESSION["playerHand"]);
            $response->setDealerHand($_SESSION["dealerHand"]);
            break;
        case "hit":
            $_SESSION["playerHand"]->addCard($_SESSION["dealer"]->getCard());
            $response->setPlayerHand($_SESSION["playerHand"]);
            if ($_SESSION["playerHand"]->getValue() == 21) {
                $_SESSION["dealerHand"]->addCard($_SESSION["dealer"]->getCard());
                
                $response->setResponseText("Black Jack!");
                $response->setDealerHand($_SESSION["dealerHand"]);
                
                end_game(true, $_SESSION["price"]);
            } else if ($_SESSION["playerHand"]->getValue() > 21) {
                $_SESSION["dealerHand"]->addCard($_SESSION["dealer"]->getCard());

                $response->setResponseText("You Lost!");
                $response->setDealerHand($_SESSION["dealerHand"]);
                
                end_game(false);
            }
            break;
        case "stand":
            $playerHandValue = $_SESSION["playerHand"]->getValue();
            //fill dummy card
            $_SESSION["dealerHand"]->addCard($_SESSION["dealer"]->getCard());
            while ($playerHandValue >= $_SESSION["dealerHand"]->getValue()) {
                $_SESSION["dealerHand"]->addCard($_SESSION["dealer"]->getCard());
            }
            $response->setDealerHand($_SESSION["dealerHand"]);
            if ($_SESSION["dealerHand"]->getValue() > 21) {
                $response->setResponseText("You Win!");
                end_game(true, $_SESSION["price"]);
            } else {
                $response->setResponseText("You Lost!");
                end_game(false);
            }
            break;
    }
    echo json_encode($response);
}

function end_game($win, $price = 0)
{
    if ($win) {
        include_once "./setBalance.php";
        setBalance($price*2);
    } 
}
?>