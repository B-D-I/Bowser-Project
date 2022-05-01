<?php
//  php vendor/bin/phpunit tests/operationsTest.php --colors

class operationsTest extends \PHPUnit\Framework\TestCase
{
    /**  @test */
    public function returnBowsersStock(){
        $operations = new Operations\Transactions();
        $expectedStock = 4;
        $actualStock = $operations->returnBowserStock(5000);

        $this->assertSame($expectedStock, $actualStock);
    }
}