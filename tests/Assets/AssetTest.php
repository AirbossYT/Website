<?php

namespace Tests\Assets;


use Tests\FactoryTrait;

class AssetTest extends \TestCase
{
    use FactoryTrait;

    public function test_get_stats()
    {
        $asset = $this->createBlueprint();

        $this->assertInternalType('array', $asset->getStats());
    }
}
