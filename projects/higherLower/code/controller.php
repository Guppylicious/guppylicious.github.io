<?php

class Controller
{
    public function buildDealtRow($suit)
    {
        $row = '';
        for ($i = 1; $i <= 13; $i++) {
            $card = $suit . '_' . $i;
            $row .= '<td id="' . $card . '" class="dealtCell"></td>';
        }

        return $row;
    }
}
