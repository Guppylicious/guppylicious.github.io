var deck = [], remaining = 0, drawn = '', current = '', correct = 0, wrong = 0;
const suits = ['s', 'h', 'c', 'd'];
var backColour = 'grey';

function start()
{
    clear();
    buildDeck();
    shuffleDeck();
    document.getElementById("cardPile").style.background = 'url(\'./img/backs/' + backColour + '_back.png\')';
    document.getElementById("cardPile").style.backgroundSize = 'cover';
    drawCard();
}

function clear()
{
    deck = [], remaining = 0, drawn = '', current = '', correct = 0, wrong = 0;

    document.getElementById("drawnCard").style.background = 'none';

    suits.forEach(function(suit) {
        for (var i = 1; i <= 13; i++) {
            card = [suit + '_' + i];
            document.getElementById(card).style.background = 'none';
        }
    });

    document.getElementById('remaining').innerHTML = remaining;
    document.getElementById('correct').innerHTML = correct;
    document.getElementById('wrong').innerHTML = wrong;
}

function buildDeck()
{
    suits.forEach(function(suit) {
        for (var i = 1; i <= 13; i++) {
            card = [suit + '_' + i];
            deck.push(card);
        }
    });

    return deck;
}

function shuffleDeck() {
    var currentCard = deck.length, shuffleCard, randomCard;

    // While there remain elements to shuffle...
    while (0 !== currentCard) {

        // Pick a remaining element...
        randomCard = Math.floor(Math.random() * currentCard);
        currentCard -= 1;

        // And swap it with the current element.
        shuffleCard = deck[currentCard];
        deck[currentCard] = deck[randomCard];
        deck[randomCard] = shuffleCard;
    }

    return deck;
}

function drawCard()
{
    current = drawn;
    drawn = deck[0];
    deck.splice(0, 1);
    remaining = deck.length;
    if (remaining == 0) {
        document.getElementById("cardPile").style.background = 'none';
    }
    document.getElementById('remaining').innerHTML = remaining;
    var imageUrl = './img/cards/' + drawn + '.png';
    document.getElementById("drawnCard").style.background = 'url(' + imageUrl + ')';
    document.getElementById("drawnCard").style.backgroundSize = 'cover';

    putDown(drawn);
}

function putDown(card)
{
    var imageUrl = './img/cards/' + card + '.png';
    document.getElementById(card).style.background = 'url(' + imageUrl + ')';
    document.getElementById(card).style.backgroundSize = 'cover';
}

function highLow(option)
{
    if (deck.length > 0) {
        drawCard();

        var currentValue = Number(String(current).split("_")[1]);
        var drawnValue = Number(String(drawn).split("_")[1]);

        if (option == 'h' && currentValue <= drawnValue) {
            correct++;
            document.getElementById('correct').innerHTML = correct;
        } else if (option == 'l' && currentValue >= drawnValue) {
            correct++;
            document.getElementById('correct').innerHTML = correct;
        } else {
            wrong++;
            document.getElementById('wrong').innerHTML = wrong;
        }
    } else {
       alert('No more cards to pickup.');
   }
}

function changeBack(colour)
{
    if (deck.length != 0) {
        backColour = String(colour);
        document.getElementById("cardPile").style.background = 'url(\'./img/backs/' + backColour + '_back.png\')';
        document.getElementById("cardPile").style.backgroundSize = 'cover';
    } else {
        alert('Please start a game first.');
    }
}
