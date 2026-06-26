<?php

declare(strict_types=1);

namespace ContextDev\Web\WebWebCrawlMdParams;

/**
 * Two-letter ISO 3166-1 alpha-2 country code identifying a supported Context.dev residential proxy exit location. Must be one of Context.dev's supported countries. When provided, Context.dev fetches the target page from that country.
 */
enum Country: string
{
    case AD = 'ad';

    case AE = 'ae';

    case AF = 'af';

    case AG = 'ag';

    case AI = 'ai';

    case AL = 'al';

    case AM = 'am';

    case AO = 'ao';

    case AR = 'ar';

    case AT = 'at';

    case AU = 'au';

    case AW = 'aw';

    case AZ = 'az';

    case BA = 'ba';

    case BB = 'bb';

    case BD = 'bd';

    case BE = 'be';

    case BF = 'bf';

    case BG = 'bg';

    case BH = 'bh';

    case BI = 'bi';

    case BJ = 'bj';

    case BM = 'bm';

    case BN = 'bn';

    case BO = 'bo';

    case BQ = 'bq';

    case BR = 'br';

    case BS = 'bs';

    case BW = 'bw';

    case BY = 'by';

    case BZ = 'bz';

    case CA = 'ca';

    case CD = 'cd';

    case CF = 'cf';

    case CG = 'cg';

    case CH = 'ch';

    case CI = 'ci';

    case CL = 'cl';

    case CM = 'cm';

    case CN = 'cn';

    case CO = 'co';

    case CR = 'cr';

    case CV = 'cv';

    case CW = 'cw';

    case CY = 'cy';

    case CZ = 'cz';

    case DE = 'de';

    case DJ = 'dj';

    case DK = 'dk';

    case DM = 'dm';

    case DO = 'do';

    case DZ = 'dz';

    case EC = 'ec';

    case EE = 'ee';

    case EG = 'eg';

    case ES = 'es';

    case ET = 'et';

    case FI = 'fi';

    case FJ = 'fj';

    case FR = 'fr';

    case GA = 'ga';

    case GB = 'gb';

    case GD = 'gd';

    case GE = 'ge';

    case GF = 'gf';

    case GG = 'gg';

    case GH = 'gh';

    case GM = 'gm';

    case GN = 'gn';

    case GP = 'gp';

    case GQ = 'gq';

    case GR = 'gr';

    case GT = 'gt';

    case GU = 'gu';

    case GW = 'gw';

    case GY = 'gy';

    case HK = 'hk';

    case HN = 'hn';

    case HR = 'hr';

    case HT = 'ht';

    case HU = 'hu';

    case ID = 'id';

    case IE = 'ie';

    case IL = 'il';

    case IM = 'im';

    case IN = 'in';

    case IQ = 'iq';

    case IR = 'ir';

    case IS = 'is';

    case IT = 'it';

    case JE = 'je';

    case JM = 'jm';

    case JO = 'jo';

    case JP = 'jp';

    case KE = 'ke';

    case KG = 'kg';

    case KH = 'kh';

    case KN = 'kn';

    case KR = 'kr';

    case KW = 'kw';

    case KY = 'ky';

    case KZ = 'kz';

    case LA = 'la';

    case LB = 'lb';

    case LC = 'lc';

    case LK = 'lk';

    case LR = 'lr';

    case LS = 'ls';

    case LT = 'lt';

    case LU = 'lu';

    case LV = 'lv';

    case LY = 'ly';

    case MA = 'ma';

    case MC = 'mc';

    case MD = 'md';

    case ME = 'me';

    case MF = 'mf';

    case MG = 'mg';

    case MK = 'mk';

    case ML = 'ml';

    case MM = 'mm';

    case MN = 'mn';

    case MO = 'mo';

    case MQ = 'mq';

    case MR = 'mr';

    case MT = 'mt';

    case MU = 'mu';

    case MV = 'mv';

    case MW = 'mw';

    case MX = 'mx';

    case MY = 'my';

    case MZ = 'mz';

    case NA = 'na';

    case NC = 'nc';

    case NE = 'ne';

    case NG = 'ng';

    case NI = 'ni';

    case NL = 'nl';

    case NO = 'no';

    case NP = 'np';

    case NZ = 'nz';

    case OM = 'om';

    case PA = 'pa';

    case PE = 'pe';

    case PF = 'pf';

    case PG = 'pg';

    case PH = 'ph';

    case PK = 'pk';

    case PL = 'pl';

    case PR = 'pr';

    case PS = 'ps';

    case PT = 'pt';

    case PY = 'py';

    case QA = 'qa';

    case RE = 're';

    case RO = 'ro';

    case RS = 'rs';

    case RU = 'ru';

    case RW = 'rw';

    case SA = 'sa';

    case SC = 'sc';

    case SD = 'sd';

    case SE = 'se';

    case SG = 'sg';

    case SI = 'si';

    case SK = 'sk';

    case SL = 'sl';

    case SM = 'sm';

    case SN = 'sn';

    case SO = 'so';

    case SR = 'sr';

    case SS = 'ss';

    case ST = 'st';

    case SV = 'sv';

    case SX = 'sx';

    case SY = 'sy';

    case SZ = 'sz';

    case TC = 'tc';

    case TD = 'td';

    case TG = 'tg';

    case TH = 'th';

    case TJ = 'tj';

    case TL = 'tl';

    case TM = 'tm';

    case TN = 'tn';

    case TR = 'tr';

    case TT = 'tt';

    case TW = 'tw';

    case TZ = 'tz';

    case UA = 'ua';

    case UG = 'ug';

    case US = 'us';

    case UY = 'uy';

    case UZ = 'uz';

    case VC = 'vc';

    case VE = 've';

    case VG = 'vg';

    case VI = 'vi';

    case VN = 'vn';

    case YE = 'ye';

    case YT = 'yt';

    case ZA = 'za';

    case ZM = 'zm';

    case ZW = 'zw';
}
