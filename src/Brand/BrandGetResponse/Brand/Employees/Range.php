<?php

declare(strict_types=1);

namespace ContextDev\Brand\BrandGetResponse\Brand\Employees;

/**
 * Employee count range for the brand (e.g. '11 to 50').
 */
enum Range: string
{
    case _1_TO_10 = '1 to 10';

    case _11_TO_50 = '11 to 50';

    case _51_TO_200 = '51 to 200';

    case _201_TO_500 = '201 to 500';

    case _501_TO_1000 = '501 to 1000';

    case _1001_TO_5000 = '1001 to 5000';

    case _5001_TO_10000 = '5001 to 10000';

    case _10001 = '10001+';
}
