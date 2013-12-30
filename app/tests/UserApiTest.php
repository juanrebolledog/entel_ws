<?php
class UserApiTest extends TestCase {

    public function setUp()
    {
        parent::setUp();
    }

    public function testUserRegister()
    {
        $data = array(
            'nombres' => 'Test User Name Jr.',
            'rut' => '11333444-9',
            'telefono_movil' => '5550198',
            'email' => 'testjr@tests.org'
        );
        $this->setRequestData($data);
        $request = $this->request('POST', '/api/users');
        $content = json_decode($request->getContent());
        $this->assertTrue(!empty($content->data));
        $this->assertTrue($content->status);
        $this->assertEquals($content->data->email, $data['email']);
        $this->assertTrue(isset($content->data->api_key));
    }

    public function testUserRegisterDuplicate()
    {
        $data = array(
            'nombres' => 'Test User Name Jr.',
            'rut' => '11333444-9',
            'telefono_movil' => '5550198',
            'email' => 'testjr@tests.org'
        );
        $this->setRequestData($data);
        $request = $this->request('POST', '/api/users');
        $content = json_decode($request->getContent());
        $this->assertTrue(!empty($content->data));
        $this->assertTrue($content->status);
        $this->assertEquals($content->data->email, $data['email']);
        $this->assertTrue(isset($content->data->api_key));

        $data = array(
            'nombres' => 'Test User Name Jr.',
            'rut' => '11333444-9',
            'telefono_movil' => '5550198',
            'email' => 'testjr@tests.org'
        );
        $this->setRequestData($data);
        $request = $this->request('POST', '/api/users');
        $content = json_decode($request->getContent());
        $this->assertTrue(!empty($content->data));
        $this->assertTrue($content->status);
        $this->assertEquals($content->data->email, $data['email']);
        $this->assertTrue(isset($content->data->api_key));
    }

    public function testUserRegisterNoData()
    {
        $request = $this->request('POST', '/api/users');
        $content = json_decode($request->getContent());
        $this->assertTrue(!empty($content->data));
        $this->assertFalse($content->status);
    }
}