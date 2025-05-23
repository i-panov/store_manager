<?php

namespace App\Models;

enum OrderStatus : string
{
    case NEW = 'new';
    case COMPLETED = 'completed';
}
