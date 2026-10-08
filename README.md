# Context Dev PHP API library

Context.dev is a web scraping API for AI agents and LLMs. This SDK turns any URL into clean, LLM-ready markdown, crawls whole sites, searches the web, takes screenshots and extracts structured JSON against a schema you define, all with one API key. Proxies, JavaScript rendering and anti-bot handling run on Context.dev's side, so there is no headless browser to host.

## Documentation

The REST API documentation can be found on [docs.context.dev](https://docs.context.dev/).

## Installation

<!-- x-release-please-start-version -->

```
composer require "context-dev/context-dev-php 2.24.0"
```

<!-- x-release-please-end -->

## Usage

Set `CONTEXT_DEV_API_KEY` to your API key; the client reads it automatically.

### Scrape markdown and HTML

This library uses named parameters to specify optional arguments.
Parameters with a default value must be set by name.

```php
<?php

use ContextDev\Client;

$client = new Client();

$page = $client->web->scrape(
    url: 'https://example.com',
    formats: ['markdown' => true, 'html' => true],
);

echo $page->markdown->data, PHP_EOL;
echo $page->html->data, PHP_EOL;
```

### Extract structured JSON

```php
<?php

use ContextDev\Client;

$client = new Client();

$page = $client->web->scrape(
    url: 'https://example.com',
    formats: ['json' => true],
    jsonParams: [
        'schema' => [
            'type' => 'object',
            'properties' => [
                'title' => ['type' => ['string', 'null']],
                'description' => ['type' => ['string', 'null']],
            ],
            'required' => ['title', 'description'],
            'additionalProperties' => false,
        ],
    ],
);

var_dump($page->json->data);
```

### Extract relevant highlights

Return the passages that answer a question about the page.

```php
<?php

use ContextDev\Client;

$client = new Client();

$page = $client->web->scrape(
    url: 'https://example.com',
    formats: ['highlights' => true],
    highlightsParams: ['query' => 'What is this domain used for?'],
);

var_dump($page->highlights->data);
```

### Take a screenshot

The screenshot is returned as a base64 image data URL.

```php
<?php

use ContextDev\Client;

$client = new Client();

$page = $client->web->scrape(
    url: 'https://example.com',
    formats: ['screenshot' => true],
);

var_dump($page->screenshot->data);
```

## What you can do

| Task | Method |
| --- | --- |
| Scrape a URL to markdown, HTML, JSON, highlights or a screenshot | `$client->web->scrape` |
| Crawl a site and get every page as markdown | `$client->web->webCrawlMd` |
| Map every URL on a domain | `$client->web->mapUrls` |
| Search the web | `$client->web->search` |
| Take a screenshot of a page | `$client->web->screenshot` |
| Parse PDFs and documents | `$client->parse->handle` |
| Run thousands of URLs as a batch | `$client->batch->submit` |
| Watch a page for changes | `$client->monitors->create` |
| Look up a company's logo, colors and brand data | `$client->brand->retrieve` |

## Use it from an AI agent

Context.dev also ships as a plugin for [Claude](https://github.com/context-dot-dev/claude-plugin), [Cursor](https://github.com/context-dot-dev/cursor-plugin) and [Gemini CLI](https://github.com/context-dot-dev/gemini-cli-context), and as tools for [LangChain](https://github.com/context-dot-dev/langchain-context) and [Haystack](https://github.com/context-dot-dev/context-haystack).

### Value Objects

It is recommended to use the static `with` constructor `Dog::with(name: "Joey")`
and named parameters to initialize value objects.

However, builders are also provided `(new Dog)->withName("Joey")`.

### Handling errors

When the library is unable to connect to the API, or if the API returns a non-success status code (i.e., 4xx or 5xx response), a subclass of `ContextDev\Core\Exceptions\APIException` will be thrown:

```php
<?php

use ContextDev\Core\Exceptions\APIConnectionException;
use ContextDev\Core\Exceptions\RateLimitException;
use ContextDev\Core\Exceptions\APIStatusException;

try {
  $page = $client->web->scrape(url: 'https://example.com', formats: ['markdown' => true]);
} catch (APIConnectionException $e) {
  echo "The server could not be reached", PHP_EOL;
  var_dump($e->getPrevious());
} catch (RateLimitException $e) {
  echo "A 429 status code was received; we should back off a bit.", PHP_EOL;
} catch (APIStatusException $e) {
  echo "Another non-200-range status code was received", PHP_EOL;
  echo $e->getMessage();
}
```

Error codes are as follows:

| Cause            | Error Type                     |
| ---------------- | ------------------------------ |
| HTTP 400         | `BadRequestException`          |
| HTTP 401         | `AuthenticationException`      |
| HTTP 403         | `PermissionDeniedException`    |
| HTTP 404         | `NotFoundException`            |
| HTTP 409         | `ConflictException`            |
| HTTP 422         | `UnprocessableEntityException` |
| HTTP 429         | `RateLimitException`           |
| HTTP >= 500      | `InternalServerException`      |
| Other HTTP error | `APIStatusException`           |
| Timeout          | `APITimeoutException`          |
| Network error    | `APIConnectionException`       |

### Retries

Certain errors will be automatically retried 2 times by default, with a short exponential backoff.

Connection errors (for example, due to a network connectivity problem), 408 Request Timeout, 409 Conflict, 429 Rate Limit, >=500 Internal errors, and timeouts will all be retried by default.

You can use the `maxRetries` option to configure or disable this:

```php
<?php

use ContextDev\Client;

// Configure the default for all requests:
$client = new Client(requestOptions: ['maxRetries' => 0]);

// Or, configure per-request:
$result = $client->web->scrape(
  url: 'https://example.com', formats: ['markdown' => true], requestOptions: ['maxRetries' => 5]
);
```

## Advanced concepts

### Making custom or undocumented requests

#### Undocumented properties

You can send undocumented parameters to any endpoint, and read undocumented response properties, like so:

Note: the `extra*` parameters of the same name overrides the documented parameters.

```php
<?php

$page = $client->web->scrape(
  url: 'https://example.com',
  formats: ['markdown' => true],
  requestOptions: [
    'extraQueryParams' => ['my_query_parameter' => 'value'],
    'extraBodyParams' => ['my_body_parameter' => 'value'],
    'extraHeaders' => ['my-header' => 'value'],
  ],
);
```

#### Undocumented request params

If you want to explicitly send an extra param, you can do so with the `extra_query`, `extra_body`, and `extra_headers` under the `request_options:` parameter when making a request, as seen in the examples above.

#### Undocumented endpoints

To make requests to undocumented endpoints while retaining the benefit of auth, retries, and so on, you can make requests using `client.request`, like so:

```php
<?php

$response = $client->request(
  method: "post",
  path: '/undocumented/endpoint',
  query: ['dog' => 'woof'],
  headers: ['useful-header' => 'interesting-value'],
  body: ['hello' => 'world']
);
```

## Versioning

This package follows [SemVer](https://semver.org/spec/v2.0.0.html) conventions. As the library is in initial development and has a major version of `0`, APIs may change at any time.

This package considers improvements to the (non-runtime) PHPDoc type definitions to be non-breaking changes.

## Requirements

PHP 8.1.0 or higher.

## Contributing

See [the contributing documentation](https://github.com/context-dot-dev/context-php-sdk/tree/main/CONTRIBUTING.md).
