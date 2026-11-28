<?php

declare(strict_types=1);

namespace ContextDev\Web\WebScreenshotParams;

/**
 * Capture this type of page instead of the home page. Context.dev finds it among the domain's links, in 30 languages. Only with `domain`.
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
