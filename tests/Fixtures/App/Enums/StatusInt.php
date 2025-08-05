<?php

namespace Tests\Fixtures\App\Enums;

enum StatusInt: int
{
    case Draft = 0;
    case Published = 1;
    case Archived = 2;
}
