/*var r = document.querySelector(':root');
function getDeckLocation() {
    var d = document.getElementById("deck-card");
    var c = d.getBoundingClientRect();
    r.style.setProperty('--deckRight', c.right);
    r.style.setProperty('--deckTop', c.top);
}
getDeckLocation();

function addClass() {
    document.getElementById("deck-card").classList.add = "deck-card";
}
addClass();*/
const resdiv = document.getElementById("game-result");
var bet = document.getElementById("bet-input");
var playerCard = { name: "player-card-", count: 0 };
var dealerCard = { name: "dealer-card-", count: 0 };
var ingame = false;

document.getElementById("input-3").addEventListener("click", function () {
  bet.value = (isNaN(parseInt(bet.value, 10))) ? 3 : parseInt(bet.value, 10) + 3;
});
document.getElementById("input-5").addEventListener("click", function () {
  bet.value = (isNaN(parseInt(bet.value, 10))) ? 5 : parseInt(bet.value, 10) + 5;
});
document.getElementById("input-10").addEventListener("click", function () {
  bet.value = (isNaN(parseInt(bet.value, 10))) ? 10 : parseInt(bet.value, 10) + 10;
});
document.getElementById("input-15").addEventListener("click", function () {
  bet.value = (isNaN(parseInt(bet.value, 10))) ? 15 : parseInt(bet.value, 10) + 15;
});
document.getElementById("input-20").addEventListener("click", function () {
  bet.value = (isNaN(parseInt(bet.value, 10))) ? 20 : parseInt(bet.value, 10) + 20;
});
document.getElementById("input-25").addEventListener("click", function () {
  bet.value = (isNaN(parseInt(bet.value, 10))) ? 25 : parseInt(bet.value, 10) + 25;
});
document.getElementById("input-50").addEventListener("click", function () {
  bet.value = (isNaN(parseInt(bet.value, 10))) ? 50 : parseInt(bet.value, 10) + 50;
});


document.getElementById("play-btn").addEventListener("click", async function () {
  const promise = await (await fetch("./server/checkLogin.php?", {
    method: "POST",
  })).json();

  if (promise.logged) {
    if (!ingame) {
      await reset();
      const promise = await (await fetch("./server/getBalance.php?", {
        method: "POST",
      })).json();

      if (bet.value == "" || bet.value == 0 || parseInt(bet.value) > parseInt(promise.Balance)) {
        alert("Wrong bet!");
        return;
      }
      const response = await (await fetch("./server/game.php?p=start;" + bet.value, {
        method: "POST",
      })).json();
      //console.log(response);

      refreshBalance();
      
      ingame = true;
      await createCard(response.playerHand.hand[playerCard.count].value, response.playerHand.hand[playerCard.count].name, playerCard);
      await createCard(response.playerHand.hand[playerCard.count].value, response.playerHand.hand[playerCard.count].name, playerCard);

      await createCard(response.dealerHand.hand[dealerCard.count].value, response.dealerHand.hand[dealerCard.count].name, dealerCard);
      await createDummyCard(dealerCard);

      if (response.responseText != null) {
        ingame = false;
        await fillDummyCard(response.dealerHand.hand[dealerCard.count].value, response.dealerHand.hand[dealerCard.count].name, dealerCard);
        end_game(response.responseText);
      }
    } else {
      alert("You're already playing!");
    }
  }
  else {
    window.location.replace("./login.php");
  }
});


document.getElementById("hit-btn").addEventListener("click", async function () {
  const promise = await (await fetch("./server/checkLogin.php?", {
    method: "POST",
  })).json();

  if (promise.logged) {
    if (ingame) {
      const response = await (await fetch("./server/game.php?p=hit", {
        method: "POST",
      })).json();
      //console.log(response);
      await createCard(response.playerHand.hand[playerCard.count].value, response.playerHand.hand[playerCard.count].name, playerCard);

      if (response.responseText != null) {
        ingame = false;
        await fillDummyCard(response.dealerHand.hand[dealerCard.count].value, response.dealerHand.hand[dealerCard.count].name, dealerCard);
        end_game(response.responseText);
      }
    }
    else {
      alert("You didn't start the game!");
    }
  }
  else {
    window.location.replace("./login.php");
  }
});

document.getElementById("stand-btn").addEventListener("click", async function () {
  const promise = await (await fetch("./server/checkLogin.php?", {
    method: "POST",
  })).json();
  if (promise.logged) {
    if (ingame) {
      const response = await (await fetch("./server/game.php?p=stand", {
        method: "POST",
      })).json();
      //console.log(response);
      
      if (response.responseText != null) {
        ingame = false;
      }
      await fillDummyCard(response.dealerHand.hand[dealerCard.count].value, response.dealerHand.hand[dealerCard.count].name, dealerCard);

      while (dealerCard.count < response.dealerHand.hand.length) {
        await createCard(response.dealerHand.hand[dealerCard.count].value, response.dealerHand.hand[dealerCard.count].name, dealerCard);
      }
      end_game(response.responseText);
    }
    else {
      alert("You didn't start the game!");
    }
  }
  else {
    window.location.replace("./login.php");
  }
});

async function createCard(value, suit, cardCount) {
  const front = document.createElement("div");
  const back = document.createElement("div");
  const imgBack = document.createElement("img");

  front.className = "card-front";
  back.className = "card-back";
  imgBack.src = "./assets/img/cards/" + value + "_of_" + suit + ".svg";

  back.appendChild(imgBack);

  document.getElementById(cardCount.name + "" + (cardCount.count + 1)).appendChild(front);
  document.getElementById(cardCount.name + "" + (cardCount.count + 1)).appendChild(back);

  await delay(250);
  await flippCard(cardCount.name + "" + (cardCount.count + 1));
  cardCount.count++;
}
async function createDummyCard(cardCount) {
  const front = document.createElement("div");
  const back = document.createElement("div");
  front.className = "card-front";
  back.className = "card-back";
  document.getElementById(cardCount.name + "" + (cardCount.count + 1)).appendChild(front);
  document.getElementById(cardCount.name + "" + (cardCount.count + 1)).appendChild(back);
  await delay(250);
}
async function fillDummyCard(value, suit, cardCount) {
  const imgBack = document.createElement("img");
  imgBack.src = "./assets/img/cards/" + value + "_of_" + suit + ".svg";
  const back = document.getElementById("dealer-card-2").getElementsByClassName("card-back")[0];
  back.appendChild(imgBack);
  await flippCard(cardCount.name + "" + (cardCount.count + 1));
  cardCount.count++;
}

function delay(time) {
  return new Promise(resolve => setTimeout(resolve, time));
}

async function reset() {
  playerCard = { name: "player-card-", count: 0 };
  dealerCard = { name: "dealer-card-", count: 0 };
  for (let i = 1; i < 5; i++) {
    let playerfield = document.getElementById("player-card-" + i)
    let dealerfield = document.getElementById("dealer-card-" + i)
    playerfield.innerHTML = "";
    dealerfield.innerHTML = "";
    playerfield.classList.remove("card-flipp");
    dealerfield.classList.remove("card-flipp");
  }
  await delay(1000);
}
async function flippCard(containerID) {
  document.getElementById(containerID).classList.add("card-flipp");
  await delay(1500);
  return;
}
async function refreshBalance() {
  const promise = await (await fetch("./server/getBalance.php?", {
    method: "POST",
  })).json();
  document.getElementById("profile-balance").innerHTML = "Bank: " + promise.Balance + "$";
}
function end_game(end_message) {
  switch (end_message) {
    case "You Win!":
      showEndMessage("win");
      break;
    case "You Lost!":
      showEndMessage("lost");
      break;
    case "Black Jack!":
      showEndMessage("jackpot");
      break;
  }
  refreshBalance();
}
function showEndMessage(src) {
  resdiv.classList.remove("d-none");
  const img = document.createElement("img");
  img.src = "./assets/img/icons/"+src+".png";
  img.id = "game-result-img";
  img.classList.add("result-img");
  resdiv.appendChild(img);
}
resdiv.addEventListener("click", function () {
  resdiv.classList.add("d-none");
  resdiv.removeChild(document.getElementById("game-result-img"));
  const list = document.getElementsByClassName("card-inner-wrap");
  for (let i = 0; i < list.length; i++) {
    list[i].innerHTML = "";
  }
});
