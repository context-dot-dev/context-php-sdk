<?php

declare(strict_types=1);

namespace ContextDev\Brand\BrandGetByEmailResponse\Brand\Social;

/**
 * Type of social media platform.
 */
enum Type: string
{
    case X = 'x';

    case FACEBOOK = 'facebook';

    case INSTAGRAM = 'instagram';

    case LINKEDIN = 'linkedin';

    case YOUTUBE = 'youtube';

    case PINTEREST = 'pinterest';

    case TIKTOK = 'tiktok';

    case DRIBBBLE = 'dribbble';

    case GITHUB = 'github';

    case BEHANCE = 'behance';

    case SNAPCHAT = 'snapchat';

    case WHATSAPP = 'whatsapp';

    case TELEGRAM = 'telegram';

    case LINE = 'line';

    case DISCORD = 'discord';

    case TWITCH = 'twitch';

    case VIMEO = 'vimeo';

    case IMDB = 'imdb';

    case TUMBLR = 'tumblr';

    case FLICKR = 'flickr';

    case GIPHY = 'giphy';

    case MEDIUM = 'medium';

    case SPOTIFY = 'spotify';

    case SOUNDCLOUD = 'soundcloud';

    case TRIPADVISOR = 'tripadvisor';

    case YELP = 'yelp';

    case PRODUCTHUNT = 'producthunt';

    case REDDIT = 'reddit';

    case CRUNCHBASE = 'crunchbase';

    case APPSTORE = 'appstore';

    case PLAYSTORE = 'playstore';
}
