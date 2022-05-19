<?php
//  php vendor/bin/phpunit tests/operationsTest.php --colors
class operationsTest extends \PHPUnit\Framework\TestCase
{
    /**  @test */
    public function testReturnBowsersStock(){
        $operations = new Operations\Transactions();
        $expectedStock = 4;
        $actualStock = $operations->returnBowserStock(5000);

        $this->assertSame($expectedStock, $actualStock);
        $this->assertNotEquals(null, $actualStock);
    }
    /** @test */
    public function testReturnStockedBowsers(){
        $operations = new Operations\Transactions();
        $expectedBowserCost = 500;
        $incorrectBowserCost = 100;
        $actualBowserCost = $operations->returnStockedBowsers('Bowser_Cost', 500);

        $this->assertSame($expectedBowserCost, $actualBowserCost);
        $this->assertNotEquals($incorrectBowserCost, $actualBowserCost);
    }
}