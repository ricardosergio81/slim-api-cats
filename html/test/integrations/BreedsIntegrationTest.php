<?php
namespace rs81\test;

class BreedsIntegrationTest extends BaseTest
{
    /** @test */
    public function testPageNotFound()
    {
        $this->request('GET', '/breeds1');
        $this->assertThatResponseHasStatus(404);
    }

    /** @test */
    public function testBreeds()
    {
        $this->request('GET', '/breeds?name=a');
        $this->assertThatResponseHasStatus(200);
    }

    /** @test */
    public function testBreedsBadRequestName1()
    {
        $this->request('GET', '/breeds?name1=a');
        $this->assertThatResponseHasStatus(400);
    }
	
	/** @test */
    public function testBreedsBadRequestWithoutName()
    {
        $this->request('GET', '/breeds');
        $this->assertThatResponseHasStatus(400);
    }
}