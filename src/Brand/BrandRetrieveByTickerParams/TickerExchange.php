<?php

declare(strict_types=1);

namespace ContextDev\Brand\BrandRetrieveByTickerParams;

/**
 * Optional stock exchange for the ticker. Defaults to NASDAQ if not specified.
 */
enum TickerExchange: string
{
    case AMEX = 'AMEX';

    case AMS = 'AMS';

    case AQS = 'AQS';

    case ASX = 'ASX';

    case ATH = 'ATH';

    case BER = 'BER';

    case BME = 'BME';

    case BRU = 'BRU';

    case BSE = 'BSE';

    case BUD = 'BUD';

    case BUE = 'BUE';

    case BVC = 'BVC';

    case CBOE = 'CBOE';

    case CNQ = 'CNQ';

    case CPH = 'CPH';

    case DFM = 'DFM';

    case DOH = 'DOH';

    case DUB = 'DUB';

    case DUS = 'DUS';

    case DXE = 'DXE';

    case EGX = 'EGX';

    case FSX = 'FSX';

    case HAM = 'HAM';

    case HEL = 'HEL';

    case HKSE = 'HKSE';

    case HOSE = 'HOSE';

    case ICE = 'ICE';

    case IOB = 'IOB';

    case IST = 'IST';

    case JKT = 'JKT';

    case JNB = 'JNB';

    case JPX = 'JPX';

    case KLS = 'KLS';

    case KOE = 'KOE';

    case KSC = 'KSC';

    case KUW = 'KUW';

    case LIS = 'LIS';

    case LSE = 'LSE';

    case MCX = 'MCX';

    case MEX = 'MEX';

    case MIL = 'MIL';

    case MUN = 'MUN';

    case NASDAQ = 'NASDAQ';

    case NEO = 'NEO';

    case NSE = 'NSE';

    case NYSE = 'NYSE';

    case NZE = 'NZE';

    case OSL = 'OSL';

    case OTC = 'OTC';

    case PAR = 'PAR';

    case PNK = 'PNK';

    case PRA = 'PRA';

    case RIS = 'RIS';

    case SAO = 'SAO';

    case SAU = 'SAU';

    case SES = 'SES';

    case SET = 'SET';

    case SGO = 'SGO';

    case SHH = 'SHH';

    case SHZ = 'SHZ';

    case SIX = 'SIX';

    case STO = 'STO';

    case STU = 'STU';

    case TAI = 'TAI';

    case TAL = 'TAL';

    case TLV = 'TLV';

    case TSX = 'TSX';

    case TSXV = 'TSXV';

    case TWO = 'TWO';

    case VIE = 'VIE';

    case WSE = 'WSE';

    case XETRA = 'XETRA';
}
