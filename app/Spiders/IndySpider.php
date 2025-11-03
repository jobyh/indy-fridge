<?php

namespace App\Spiders;

use App\Spiders\Pipeline\StoreProcessor;
use Generator;
use Illuminate\Support\Facades\Log;
use RoachPHP\Downloader\Middleware\RequestDeduplicationMiddleware;
use RoachPHP\Extensions\LoggerExtension;
use RoachPHP\Extensions\StatsCollectorExtension;
use RoachPHP\Http\Request;
use RoachPHP\Http\Response;
use RoachPHP\Spider\BasicSpider;
use RoachPHP\Spider\ParseResult;
use Symfony\Component\DomCrawler\Crawler;

class IndySpider extends BasicSpider
{

    public array $downloaderMiddleware = [
        RequestDeduplicationMiddleware::class,
    ];

    public array $spiderMiddleware = [
        //
    ];

    public array $itemProcessors = [
        StoreProcessor::class,
    ];

    public array $extensions = [
        LoggerExtension::class,
        StatsCollectorExtension::class,
    ];

    public int $concurrency = 2;

    public int $requestDelay = 1;

    /**
     * @return Generator<ParseResult>
     */
    public function parse(Response $response): Generator
    {
        yield $this->item([
            'url' => str($response->getRequest()->getUri())->after('https://theindependent.pub/')->prepend('/')->rtrim('/'),
            'brewery' => $this->safeFilter($response, '.elementor-element-d4cf7e7 h2')?->text(),
            'name' => $this->safeFilter($response, '.elementor-element-5301631 h1')?->text(),
            'style' => $this->safeFilter($response, '.elementor-element-a62ad98 h4')?->text(),
            'hops' => $this->safeFilter($response, '.elementor-element-e000ce4 [rel=tag]')?->each(function (Crawler $node) {
                return $node->text();
            }) ?? [],
            'abv' => $this->abv($response),
            'size' => $this->safeFilter($response, '.elementor-element-52414de')?->text(),
            'description' => $this->safeFilter($response, '.elementor-element-a3924b1 p')?->text(),
            'price' => $this->price($response),
            'stock' => intval($this->safeFilter($response, 'form.cart input[name=quantity]')?->attr('max') ?? 0),
            'tags' => $this->safeFilter($response, '.elementor-element-e62b829 [rel=tag]')?->each(function (Crawler $node) {
                return $node->text();
            }) ?? [],
            'src' => $this->safeFilter($response, '.elementor-element-63cb0a9 img')?->attr('data-breeze'),
            'published_at' => $this->safeFilter($response, 'meta[property="article:published_time"]')?->attr('content'),
            'modified_at' => $this->safeFilter($response, 'meta[property="article:modified_time"]')?->attr('content'),
        ]);
    }

    protected function safeFilter(Response $response, string $selector): ?Crawler
    {
        /**
         * @var Crawler $result
         */
        $result = $response->filter($selector);

        return $result->count() === 0 ? null : $result;
    }

    protected function price(Response $response): ?int
    {
        $price = $this->safeFilter($response, '.elementor-element-7ba88fc .woocommerce-Price-amount')?->text();

        if (is_null($price)) {
            return null;
        }

        return intval(str($price)->trim()->ltrim('£')->replace('.', '')->value());
    }

    protected function abv(Response $response): ?string
    {
        $abv = $this->safeFilter($response, '.elementor-element-79d347b h5')?->text();

        if (is_null($abv)) {
            return null;
        }

        return floatval(str($abv)->trim()->rtrim('%')->value());
    }

    public function parseListing(Response $response): Generator
    {
        $nodes = $response->filterXPath("//a[contains(@class, 'woocommerce-LoopProduct-link')]");

        foreach ($nodes as $node) {
            yield $this->request('GET', $node->getAttribute('href'));
        }

        $next = $response->filter('nav.woocommerce-pagination a.next');

        if ($next->count() !== 0) {
            yield $this->request('GET', $next->link()->getUri(), 'parseListing');
        }
    }

    public function initialRequests(): array
    {
        return [
            new Request(
                'GET',
                'https://theindependent.pub/shop/beer/',
                [$this, 'parseListing']
            )
        ];
    }
}
