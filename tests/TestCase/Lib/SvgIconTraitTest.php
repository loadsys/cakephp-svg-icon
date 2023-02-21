<?php
declare(strict_types=1);

namespace SvgIcon\Test\TestCase\Lib;

use Cake\Core\Configure;
use Cake\TestSuite\TestCase;
use SvgIcon\Lib\SvgIconTrait;

/**
 * SvgIcon\Lib\SvgIconTrait Test Case
 */
class SvgIconTraitTest extends TestCase
{
    use SvgIconTrait;

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        Configure::load('SvgIcon.app_svg_icon', 'default');
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        parent::tearDown();
    }

    /**
     * Test get method
     *
     * @param string $name Name
     * @param array $options Options
     * @param string $expected Expected
     * @return void
     * @dataProvider provideGet
     */
    public function testGet($name, $options, $expected): void
    {
        $result = $this->getSvgIcon($name, $options);
        $this->assertStringContainsString($expected, $result);
    }

    /**
     * Data provider for testGet
     *
     * @return array
     */
    public function provideGet(): array
    {
        return SvgIconTraitTest::getProvider();
    }

    /**
     * Data provider source, available to other tests
     *
     * @return array
     */
    public static function getProvider(): array
    {
        return [
            'no options' => [
                'name' => 'heroicon.home',
                'options' => [],
                'expected' => 'stroke="currentColor" class="w-6 h-6"',
            ],
            'with option' => [
                'name' => 'heroicon.home',
                'options' => [
                    'class' => 'w-10 h-10',
                ],
                'expected' => 'stroke="currentColor" class="w-10 h-10"',
            ],
            'with options' => [
                'name' => 'heroicon.home',
                'options' => [
                    'class' => 'w-20 h-30',
                    'stroke' => 'red',
                ],
                'expected' => 'stroke="red" class="w-20 h-30"',
            ],
            'empty' => [
                'name' => 'foo',
                'options' => [],
                'expected' => '',
            ],
        ];
    }
}
