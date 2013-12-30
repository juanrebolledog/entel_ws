<?php
class UserLevelsApiTest extends TestCase {

    public function setUp()
    {
        parent::setUp();
    }

    public function testUserLevelIndex()
    {
        $resp = $this->request('GET', '/api/user_levels');
        $content = json_decode($resp->getContent());
        $this->assertTrue(!empty($content->data));
        $this->assertTrue($content->status);
    }

    public function testUserLevelIndexResourcesAreUrls()
    {
        $resp = $this->request('GET', '/api/user_levels');
        $content = json_decode($resp->getContent());
        $this->assertTrue(!empty($content->data));
        $this->assertTrue($content->status);
        
        foreach ($content->data as $level)
        {
            $this->assertEquals(1, preg_match('/^http|https*/', $level->imagen_on));
            $this->assertEquals(1, preg_match('/^http|https*/', $level->imagen_off));
        }
    }

    public function testUserLevelDetail()
    {
        $level = UserLevel::first();
        $resp = $this->request('GET', '/api/user_levels/' . $level->id);
        $content = json_decode($resp->getContent());
        $this->assertTrue(!empty($content->data));
        $this->assertTrue($content->status);
    }

    public function testUserLevelDetailResourcesAreUrls()
    {
        $level = UserLevel::first();
        $resp = $this->request('GET', '/api/user_levels/' . $level->id);
        $content = json_decode($resp->getContent());
        $this->assertTrue(!empty($content->data));
        $this->assertTrue($content->status);
        $level = $content->data;
        $this->assertEquals(1, preg_match('/^(http|https)*/', $level->imagen_on));
        $this->assertEquals(1, preg_match('/^(http|https)*/', $level->imagen_off));
    }

    public function testUserLevelDetailUnknown()
    {
        $resp = $this->request('GET', '/api/user_levels/9001');
        $content = json_decode($resp->getContent());
        $this->assertTrue(empty($content->data));
        $this->assertFalse($content->status);
    }

}