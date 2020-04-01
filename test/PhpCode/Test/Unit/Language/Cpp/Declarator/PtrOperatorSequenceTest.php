<?php
/**
 * This file is part of the PhpCode library.
 * 
 * @copyright   2020, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpCode\Test\Unit\Language\Cpp\Declarator;

use PhpCode\Exception\InvalidOperationException;
use PhpCode\Language\Cpp\Declarator\PtrOperator;
use PhpCode\Language\Cpp\Declarator\PtrOperatorSequence;
use PhpCode\Test\Language\Cpp\ConceptDoubleBuilder;
use PhpCode\Test\Language\Cpp\Declarator\PtrOperatorDoubleFactory;
use PHPUnit\Framework\TestCase;

/**
 * Represents the unit tests for the {@see PhpCode\Language\Cpp\Declarator\PtrOperatorSequence} 
 * class.
 * 
 * @group   declarator
 * @group   c++
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class PtrOperatorSequenceTest extends TestCase
{
    /**
     * Tests that getPtrOperators() returns an empty array when instantiated.
     */
    public function testGetPtrOperatorsReturnsEmptyArrayWhenInstantiated(): void
    {
        $sut = new PtrOperatorSequence();
        self::assertSame([], $sut->getPtrOperators());
    }
    
    /**
     * Tests that getPtrOperators() returns an indexed array of pointer 
     * operators when adding one pointer operator.
     * 
     * @param   PtrOperator $ptrOp      The pointer operator to add.
     * 
     * @dataProvider    getOperatorsProvider
     */
    public function testGetPtrOperatorsReturnsArrayPtrOperatorWhenAddOneOperator(
        PtrOperator $ptrOp
    ): void
    {
        $ptrOps = [];
        $ptrOps[] = $ptrOp;
        
        $sut = new PtrOperatorSequence();
        $sut->addPtrOperator($ptrOp);
        
        self::assertSame($ptrOps, $sut->getPtrOperators());
    }
    
    /**
     * Tests that addPtrOperator() throws an exception when adding an illegal 
     * pointer operator after a lvalue reference.
     * 
     * @param   PtrOperator $ptrOp      The pointer operator to add after the reference.
     * @param   string      $message    The expected exception message.
     * 
     * @dataProvider    getIllegalOperatorsAfterReferenceProvider
     */
    public function testAddPtrOperatorThrowsExceptionWhenAddIllegalPtrOperatorAfterLvalue(
        PtrOperator $ptrOp, 
        string $message
    ): void
    {
        $ptrOpFactory = $this->createPtrOperatorDoubleFactory();
        
        $sut = new PtrOperatorSequence();
        $sut->addPtrOperator($ptrOpFactory->createLvalue());
        
        $this->expectException(InvalidOperationException::class);
        $this->expectExceptionMessage($message);
        
        $sut->addPtrOperator($ptrOp);
    }
    
    /**
     * Tests that addPtrOperator() throws an exception when adding an illegal 
     * pointer operator after a rvalue reference.
     * 
     * @param   PtrOperator $ptrOp      The pointer operator to add after the reference.
     * @param   string      $message    The expected exception message.
     * 
     * @dataProvider    getIllegalOperatorsAfterReferenceProvider
     */
    public function testAddPtrOperatorThrowsExceptionWhenAddIllegalPtrOperatorAfterRvalue(
        PtrOperator $ptrOp, 
        string $message
    ): void
    {
        $ptrOpFactory = $this->createPtrOperatorDoubleFactory();
        
        $sut = new PtrOperatorSequence();
        $sut->addPtrOperator($ptrOpFactory->createRvalue());
        
        $this->expectException(InvalidOperationException::class);
        $this->expectExceptionMessage($message);
        
        $sut->addPtrOperator($ptrOp);
    }
    
    /**
     * Tests that getPtrOperators() returns an indexed array of pointer 
     * operators when adding a pointer operator after a pointer.
     * 
     * @param   PtrOperator $ptrOp  The pointer operator to add after the pointer.
     * 
     * @dataProvider    getOperatorsAfterPointerProvider
     */
    public function testGetPtrOperatorsReturnsArrayPtrOperatorWhenAddOperatorAfterPointer(
        PtrOperator $ptrOp
    ): void
    {
        $ptrOps = [];
        $ptrOps[] = $this->createPtrOperatorDoubleFactory()->createPointer();
        
        $sut = new PtrOperatorSequence();
        $sut->addPtrOperator($ptrOps[0]);
        self::assertSame($ptrOps, $sut->getPtrOperators());
        
        $ptrOps[] = $ptrOp;
        $sut->addPtrOperator($ptrOp);
        self::assertSame($ptrOps, $sut->getPtrOperators());
    }
    
    /**
     * Tests that getPtrOperators() returns an indexed array of pointer 
     * operators when adding a pointer operator after a pointer with a 
     * constant/volatile qualifier sequence.
     * 
     * @param   PtrOperator $ptrOp  The pointer operator to add after the pointer with a constant/volatile qualifier sequence.
     * 
     * @dataProvider    getOperatorsAfterPointerProvider
     */
    public function testGetPtrOperatorsReturnsArrayPtrOperatorWhenAddOperatorAfterPointerWithCVQualifierSequence(
        PtrOperator $ptrOp
    ): void
    {
        $ptrOps = [];
        $ptrOps[] = $this->createPtrOperatorDoubleFactory()->createPointer(
            ConceptDoubleBuilder::createCVQualifierSequence($this)->getDouble()
        );
        
        $sut = new PtrOperatorSequence();
        $sut->addPtrOperator($ptrOps[0]);
        self::assertSame($ptrOps, $sut->getPtrOperators());
        
        $ptrOps[] = $ptrOp;
        $sut->addPtrOperator($ptrOp);
        self::assertSame($ptrOps, $sut->getPtrOperators());
    }
    
    /**
     * Tests that count() returns zero when instantiated.
     */
    public function testCountReturnsZeroWhenInstantiated(): void
    {
        $sut = new PtrOperatorSequence();
        self::assertCount(0, $sut);
    }
    
    /**
     * Tests that count() returns one when adding one pointer operator.
     * 
     * @param   PtrOperator $ptrOp      The pointer operator to add.
     * 
     * @dataProvider    getOperatorsProvider
     */
    public function testCountReturnsOneWhenAddOneOperator(
        PtrOperator $ptrOp
    ): void
    {
        $sut = new PtrOperatorSequence();
        $sut->addPtrOperator($ptrOp);
        
        self::assertCount(1, $sut);
    }
    
    /**
     * Tests that count() returns an integer when adding a pointer operator 
     * after a pointer.
     * 
     * @param   PtrOperator $ptrOp  The pointer operator to add after the pointer.
     * 
     * @dataProvider    getOperatorsAfterPointerProvider
     */
    public function testCountReturnsIntWhenAddOperatorAfterPointer(
        PtrOperator $ptrOp
    ): void
    {
        $sut = new PtrOperatorSequence();
        $sut->addPtrOperator(
            $this->createPtrOperatorDoubleFactory()->createPointer()
        );
        $sut->addPtrOperator($ptrOp);
        self::assertCount(2, $sut);
    }
    
    /**
     * Tests that count() returns an integer when adding a pointer operator 
     * after a pointer with a constant/volatile qualifier sequence.
     * 
     * @param   PtrOperator $ptrOp  The pointer operator to add after the pointer with a constant/volatile qualifier sequence.
     * 
     * @dataProvider    getOperatorsAfterPointerProvider
     */
    public function testCountReturnsIntWhenAddOperatorAfterPointerWithCVQualifierSequence(
        PtrOperator $ptrOp
    ): void
    {
        $sut = new PtrOperatorSequence();
        $sut->addPtrOperator(
            $this->createPtrOperatorDoubleFactory()->createPointer(
                ConceptDoubleBuilder::createCVQualifierSequence($this)->getDouble()
            )
        );
        $sut->addPtrOperator($ptrOp);
        self::assertCount(2, $sut);
    }
    
    /**
     * Returns a data set of pointer operators to add when the sequence is 
     * empty.
     * 
     * @return  array[]
     */
    public function getOperatorsProvider(): array
    {
        $ptrOpFactory = $this->createPtrOperatorDoubleFactory();
        
        return [
            'Lvalue' => [
                $ptrOpFactory->createLvalue(), 
            ],
            'Rvalue' => [
                $ptrOpFactory->createRvalue(), 
            ],
            'Pointer' => [
                $ptrOpFactory->createPointer(), 
            ],
            'Pointer with a constant/volatile qualifier sequence' => [
                $ptrOpFactory->createPointer(
                    ConceptDoubleBuilder::createCVQualifierSequence($this)->getDouble()
                ), 
            ],
        ];
    }
    
    /**
     * Returns a data set of illegal pointer operators to add after a 
     * reference.
     * 
     * @return  array[] An associative array where the key is the name of the data and the value is an indexed array where:
     *                  [0] is the pointer operator to add after the reference, and 
     *                  [1] is the expected exception message.
     */
    public function getIllegalOperatorsAfterReferenceProvider(): array
    {
        $ptrOpFactory = $this->createPtrOperatorDoubleFactory();
        
        return [
            'Lvalue' => [
                $ptrOpFactory->createLvalue(), 
                'Reference to reference is illegal.', 
            ],
            'Rvalue' => [
                $ptrOpFactory->createRvalue(), 
                'Reference to reference is illegal.', 
            ],
            'Pointer' => [
                $ptrOpFactory->createPointer(), 
                'Pointer to reference is illegal.', 
            ],
            'Pointer with a constant/volatile qualifier sequence' => [
                $ptrOpFactory->createPointer(
                    ConceptDoubleBuilder::createCVQualifierSequence($this)->getDouble()
                ), 
                'Pointer to reference is illegal.', 
            ],
        ];
    }
    
    /**
     * Returns a data set of pointer operators to add after a pointer.
     * 
     * @return  array[]
     */
    public function getOperatorsAfterPointerProvider(): array
    {
        $ptrOpFactory = $this->createPtrOperatorDoubleFactory();
        
        return [
            'Lvalue' => [
                $ptrOpFactory->createLvalue(), 
            ],
            'Rvalue' => [
                $ptrOpFactory->createRvalue(), 
            ],
            'Pointer' => [
                $ptrOpFactory->createPointer(), 
            ],
            'Pointer with a constant/volatile qualifier sequence' => [
                $ptrOpFactory->createPointer(
                    ConceptDoubleBuilder::createCVQualifierSequence($this)->getDouble()
                ), 
            ],
        ];
    }
    
    
    /**
     * Creates a factory of pointer operator doubles.
     * 
     * @return  PtrOperatorDoubleFactory
     */
    private function createPtrOperatorDoubleFactory(): PtrOperatorDoubleFactory
    {
        return new PtrOperatorDoubleFactory($this);
    }
}

