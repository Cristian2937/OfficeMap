<?php

namespace App\Enum;

enum StatoWorkflow: int
{
case NON_DISPONIBILE = 0;
case DISPONIBILE = 1;
case ATTIVO = 2;
case NON_ATTIVO = 3;

case ATTESA_DI_APPROVAZIONE = 4;
case ATTESA = 5;
}