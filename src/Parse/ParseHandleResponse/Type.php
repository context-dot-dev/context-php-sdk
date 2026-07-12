<?php

declare(strict_types=1);

namespace ContextDev\Parse\ParseHandleResponse;

/**
 * Detected content type used for parsing.
 */
enum Type: string
{
    case HTML = 'html';

    case XML = 'xml';

    case JSON = 'json';

    case JSONL = 'jsonl';

    case TEXT = 'text';

    case CSV = 'csv';

    case TSV = 'tsv';

    case MARKDOWN = 'markdown';

    case YAML = 'yaml';

    case PYTHON = 'python';

    case JAVA = 'java';

    case JAVASCRIPT = 'javascript';

    case PHP = 'php';

    case SHELL = 'shell';

    case RUBY = 'ruby';

    case TYPESCRIPT = 'typescript';

    case RTF = 'rtf';

    case SRT = 'srt';

    case CSS = 'css';

    case SCSS = 'scss';

    case LESS = 'less';

    case STYLUS = 'stylus';

    case SASS = 'sass';

    case SVG = 'svg';

    case PDF = 'pdf';

    case DOCX = 'docx';

    case DOC = 'doc';

    case XLSX = 'xlsx';

    case XLS = 'xls';

    case PPTX = 'pptx';

    case PPT = 'ppt';

    case JPG = 'jpg';

    case PNG = 'png';

    case GIF = 'gif';

    case BMP = 'bmp';

    case TIFF = 'tiff';

    case WEBP = 'webp';

    case PPM = 'ppm';

    case PBM = 'pbm';

    case PGM = 'pgm';

    case PNM = 'pnm';
}
