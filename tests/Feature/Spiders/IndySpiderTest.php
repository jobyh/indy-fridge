<?php

namespace Tests\Feature\Spiders;

use App\Spiders\IndySpider;
use Illuminate\Support\Facades\App;
use JetBrains\PhpStorm\Internal\TentativeType;
use Tests\TestCase;

class IndySpiderTest extends TestCase
{
    #[Test]
    public function it_retrieves_product_image_from_srcset(): void
    {
        $src = 'https://theindependent.pub/wp-content/uploads/2024/08/cryo-triple-point.png 585w, https://theindependent.pub/wp-content/uploads/2024/08/cryo-triple-point-300x300.png 300w, https://theindependent.pub/wp-content/uploads/2024/08/cryo-triple-point-150x150.png 150w, https://theindependent.pub/wp-content/uploads/2024/08/cryo-triple-point-100x100.png 100w';

        App::make(IndySpider::class)->parse();

//        $response->assertStatus(200);
    }
}
