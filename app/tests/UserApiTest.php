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
            'telefono_movil' => '4144055232',
            'email' => 'testjr@tests.org'
        );
        $this->setRequestData($data);
        $request = $this->request('POST', '/api/users');
        $content = json_decode($request->getContent());
        $this->assertTrue(!empty($content->data));
        $this->assertTrue($content->status);
        $this->assertEquals($content->data->email, $data['email']);
        $this->assertEquals($content->data->nombres, $data['nombres']);
        $this->assertTrue(isset($content->data->api_key));

        $data = array(
            'nombres' => 'New Name',
            'rut' => '11333444-9',
            'telefono_movil' => '4144055232',
            'email' => 'new@email.org'
        );
        $this->setRequestData($data);
        $request = $this->request('POST', '/api/users');
        $content = json_decode($request->getContent());
        $this->assertTrue(!empty($content->data));
        $this->assertTrue($content->status);
        $this->assertEquals($content->data->email, $data['email']);
        $this->assertEquals($content->data->nombres, $data['nombres']);
        $this->assertTrue(isset($content->data->api_key));
    }

    public function testUserRegisterNoData()
    {
        $request = $this->request('POST', '/api/users');
        $content = json_decode($request->getContent());
        $this->assertTrue(!empty($content->data));
        $this->assertFalse($content->status);
    }

    public function testUserLevel()
    {
        $resp = $this->request('GET', '/api/users/level');
        $content = json_decode($resp->getContent());
        $this->assertTrue(!empty($content->data));
        $this->assertTrue($content->status);
    }

    public function testUserLevelResourcesAreUrls()
    {
        $resp = $this->request('GET', '/api/users/level');
        $content = json_decode($resp->getContent());
        $this->assertTrue(!empty($content->data));
        $this->assertTrue($content->status);
        $level = $content->data;

        $this->assertEquals(1, preg_match('/^http|https*/', $level->imagen_on));
        $this->assertEquals(1, preg_match('/^http|https*/', $level->imagen_off));
    }

    public function testUserLevelEscalation()
    {
        $resp = $this->request('GET', '/api/users/level');
        $content = json_decode($resp->getContent());
        $this->assertTrue(!empty($content->data));
        $this->assertEquals($content->data->id, 1);
        $this->assertTrue($content->status);

        $benefit = Benefit::first();

        foreach (array(1, 2, 3) as $k)
        {
            $data = array(
                'lat' => $benefit->lat,
                'lng' => $benefit->lng
            );
            $this->setRequestData($data);
            $resp_redeem = $this->request('POST', '/api/benefits/' . $benefit->id . '/redeem');
            $redeem_content = json_decode($resp_redeem->getContent());
            $this->assertTrue(!empty($redeem_content->data));
            $this->assertTrue($redeem_content->status);

            $comment = array(
                'mensaje' => 'Esta es una prueba'
            );
            $this->setRequestData($comment);
            $resp_comment = $this->request('POST', '/api/benefits/' . $benefit->id . '/comments');
            $comment_content = json_decode($resp_comment->getContent());

            $share = array(
                'metodo' => 'twitter'
            );
            $this->setRequestData($share);
            $resp_share_comment = $this->request('POST', '/api/benefits/comments/' . $comment_content->data->id . '/share');
        }

        $resp = $this->request('GET', '/api/users/level');
        $content = json_decode($resp->getContent());
        $this->assertTrue(!empty($content->data));
        $this->assertEquals(3, $content->data->id);
        $this->assertTrue($content->status);
    }
}