<?php
declare(strict_types=1);

namespace SvgIcon\Test\TestCase\View\Helper;

use Cake\Cache\Cache;
use Cake\Core\Configure;
use Cake\TestSuite\TestCase;
use Cake\View\View;
use SvgIcon\Test\TestCase\Lib\SvgIconTraitTest;
use SvgIcon\View\Helper\SvgIconHelper;

/**
 * SvgIcon\View\Helper\SvgIconHelper Test Case
 */
class SvgIconHelperTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \SvgIcon\View\Helper\SvgIconHelper
     */
    protected $SvgIcon;

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $view = new View();
        $this->SvgIcon = new SvgIconHelper($view);
        Configure::load('SvgIcon.app_svg_icon', 'default');
        Cache::disable();
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->SvgIcon);

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
        $result = $this->SvgIcon->get($name, $options);
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
}
