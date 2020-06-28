<?php
namespace rs81\test;

class LoginIntegrationTest extends BaseTest
{
    /** @test */
    public function testBadRequestWithoutBody()
    {
        $this->request('POST', '/login');
        $this->assertThatResponseHasStatus(400);
    }


    /** @test */
    public function testBadRequestWithWrongBodyUsername()
    {
        $this->request('POST', '/login', ['username1' => '', 'password' => '']);
        $this->assertThatResponseHasStatus(400);
    }
    
    /** @test */
    public function testBadRequestWithWrongBodyPassword()
    {
        $this->request('POST', '/login', ['username' => '', 'password1x' => '']);
        $this->assertThatResponseHasStatus(400);
    }

    /** @test */
    public function testBadRequestWithEmpityBodyValue()
    {
        $this->request('POST', '/login', ['username' => '', 'password' => '']);
        $this->assertThatResponseHasStatus(400);
    }

    /** @test */
    public function testSucessWithWrongValueLogin()
    {
        $this->request('POST', '/login', ['username' => '1', 'password' => '1']);
        $this->assertThatResponseHasStatus(200);
		$responseData = $this->responseData();
  	    $this->assertEquals($responseData['message'], 'These credentials do not match our records.');
    }


    /** @test */
    public function testLoginValid()
    {
        $this->request('POST', '/login', ['username' => 'admin', 'password' => '@#$RF@!718']);
        $this->assertThatResponseHasStatus(200);
		$responseData = $this->responseData();
  	    $this->assertEquals($responseData['jwt'], 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzZXJ2aWNlIjoiYXBpX2NhdHMifQ.NPRMrNtp9IES37mzj0x_kK-snIlbH46EiQwIMaGAovU');
    }
}