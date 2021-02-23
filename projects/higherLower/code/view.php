<?php

$controller = new Controller();

?>

<!--- Controls section --->

<div class="controls">
    <table class="optionTable">
        <tr>
            <td><button class="optionButton" id="start" onclick="start()">New Game</button></td>
        </tr>
    </table>

    <table class="cardTable">
        <tr>
            <th>Card Pile (<span id="remaining">0</span>)</th>
            <th>Drawn Card</th>
        </tr>
        <tr>
            <td class="cardPile" id="cardPile">

            </td>
            <td class="drawnCard" id="drawnCard">

            </td>
        </tr>
    </table>
    <table class="controlTable">
        <tr>
            <td><button class="controlButton" onclick="highLow('h')">Higher</button></td>
            <td><button class="controlButton" onclick="highLow('l')">Lower</button></td>
        </tr>
    </table>
    <table class="scoreTable">
        <tr>
            <th>Correct</th>
            <th>Wrong</th>
        </tr>
        <tr>
            <td><span id="correct">0</span></td>
            <td><span id="wrong">0</span></td>
        </tr>
    </table>
    <table class="backsTable">
        <tr>
            <th colspan="6">Change Colour</th>
        </tr>
        <tr>
            <td><button class="backsButton" id="greyBack" onclick="changeBack('grey')"></button></td>
            <td><button class="backsButton" id="blueBack" onclick="changeBack('blue')"></button></td>
            <td><button class="backsButton" id="greenBack" onclick="changeBack('green')"></button></td>
            <td><button class="backsButton" id="redBack" onclick="changeBack('red')"></button></td>
            <td><button class="backsButton" id="purpleBack" onclick="changeBack('purple')"></button></td>
            <td><button class="backsButton" id="yellowBack" onclick="changeBack('yellow')"></button></td>
        </tr>
    </table>
</div>

<!--- Board section --->

<div class="board">
<h3>Dealt Cards<h3>
<table class="dealtTable">
    <tr>
        <th class="dealtNo"></th>
        <th class="dealtNo">Ace</th>
        <th class="dealtNo">2</th>
        <th class="dealtNo">3</th>
        <th class="dealtNo">4</th>
        <th class="dealtNo">5</th>
        <th class="dealtNo">6</th>
        <th class="dealtNo">7</th>
        <th class="dealtNo">8</th>
        <th class="dealtNo">9</th>
        <th class="dealtNo">10</th>
        <th class="dealtNo">Jack</th>
        <th class="dealtNo">Queen</th>
        <th class="dealtNo">King</th>
    </tr>
    <tr>
        <th class="dealtSuit">Spades</th>
        <?= $controller->buildDealtRow('s') ?>
    </tr>
    <tr>
        <th class="dealtSuit">Hearts</th>
        <?= $controller->buildDealtRow('h') ?>
    </tr>
    <tr>
        <th class="dealtSuit">Clubs</th>
        <?= $controller->buildDealtRow('c') ?>
    </tr>
    <tr>
        <th class="dealtSuit">Diamonds</th>
        <?= $controller->buildDealtRow('d') ?>
    </tr>
</table>
