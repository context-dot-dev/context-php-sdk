<?php

declare(strict_types=1);

namespace ContextDev\Web\WebScreenshotParams;

/**
 * Optional parameter to specify which page type to screenshot. If provided, the system will scrape the domain's links and use heuristics to find the most appropriate URL for the specified page type (30 supported languages). If not provided, screenshots the main domain landing page. Only applicable when using 'domain', not 'directUrl'.
 */
enum Page: string
{
    case LOGIN = 'login';

    case SIGNUP = 'signup';

    case BLOG = 'blog';

    case CAREERS = 'careers';

    case PRICING = 'pricing';

    case TERMS = 'terms';

    case PRIVACY = 'privacy';

    case CONTACT = 'contact';
}
