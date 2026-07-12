<?php

declare(strict_types=1);

namespace ContextDev\Parse\ParseHandleParams;

/**
 * Optional file extension hint. Case-insensitive; a leading dot is accepted (e.g. ".pdf").
 */
enum Extension: string
{
    case TXT = 'txt';

    case TEXT = 'text';

    case MD = 'md';

    case MARKDOWN = 'markdown';

    case HTML = 'html';

    case HTM = 'htm';

    case XHTML = 'xhtml';

    case XML = 'xml';

    case RSS = 'rss';

    case ATOM = 'atom';

    case CSV = 'csv';

    case TSV = 'tsv';

    case YAML = 'yaml';

    case YML = 'yml';

    case PY = 'py';

    case JAVA = 'java';

    case JS = 'js';

    case JSX = 'jsx';

    case MJS = 'mjs';

    case CJS = 'cjs';

    case JSON = 'json';

    case JSONL = 'jsonl';

    case NDJSON = 'ndjson';

    case PHP = 'php';

    case SH = 'sh';

    case BASH = 'bash';

    case ZSH = 'zsh';

    case FISH = 'fish';

    case RB = 'rb';

    case TS = 'ts';

    case TSX = 'tsx';

    case RTF = 'rtf';

    case SRT = 'srt';

    case CSS = 'css';

    case SCSS = 'scss';

    case LESS = 'less';

    case STYL = 'styl';

    case SASS = 'sass';

    case SVG = 'svg';

    case PDF = 'pdf';

    case DOCX = 'docx';

    case DOC = 'doc';

    case XLSX = 'xlsx';

    case XLSM = 'xlsm';

    case XLSB = 'xlsb';

    case XLTX = 'xltx';

    case XLTM = 'xltm';

    case XLS = 'xls';

    case PPTX = 'pptx';

    case PPTM = 'pptm';

    case PPSX = 'ppsx';

    case PPSM = 'ppsm';

    case POTX = 'potx';

    case POTM = 'potm';

    case PPT = 'ppt';

    case PPS = 'pps';

    case POT = 'pot';

    case JPG = 'jpg';

    case JPEG = 'jpeg';

    case JPE = 'jpe';

    case PNG = 'png';

    case GIF = 'gif';

    case BMP = 'bmp';

    case TIFF = 'tiff';

    case TIF = 'tif';

    case WEBP = 'webp';

    case PPM = 'ppm';

    case PBM = 'pbm';

    case PGM = 'pgm';

    case PNM = 'pnm';
}
