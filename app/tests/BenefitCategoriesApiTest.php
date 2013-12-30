<?php
class BenefitCategoriesApiTest extends TestCase {

    public function setUp()
    {
        parent::setUp();
    }

    public function testBenefitCategoriesIndex()
    {
        $request = $this->request('GET', '/api/benefits/categories');
        $content = json_decode($request->getContent());
        $this->assertTrue(!empty($content->data));
        $this->assertTrue($content->status);
    }

    public function testBenefitCategoriesShow()
    {
        $request = $this->request('GET', '/api/benefits/categories');
        $content = json_decode($request->getContent());
        $this->assertTrue(!empty($content->data));
        $this->assertTrue($content->status);

        foreach ($content->data as $category)
        {
            $cat_req = $this->request('GET', '/api/benefits/categories/' . $category->id);
            $cat_content = json_decode($cat_req->getContent());
            $this->assertTrue(!empty($cat_content->data));
            $this->assertTrue($cat_content->status);
            $this->assertTrue(isset($cat_content->data->sub_categories));
        }
    }

    public function testBenefitCategoriesShowNonExistant()
    {
        $cat_req = $this->request('GET', '/api/benefits/categories/' . 99999);
        $cat_content = json_decode($cat_req->getContent());
        $this->assertTrue(empty($cat_content->data));
        $this->assertFalse($cat_content->status);
    }

    public function testBenefitSubCategoriesIndex()
    {
        $request = $this->request('GET', '/api/benefits/sub_categories');
        $content = json_decode($request->getContent());
        $this->assertTrue(!empty($content->data));
        $this->assertTrue($content->status);
    }

    public function testBenefitSubCategoriesShow()
    {
        $request = $this->request('GET', '/api/benefits/sub_categories');
        $content = json_decode($request->getContent());
        $this->assertTrue(!empty($content->data));
        $this->assertTrue($content->status);

        foreach ($content->data as $sub_category)
        {
            $cat_req = $this->request('GET', '/api/benefits/sub_categories/' . $sub_category->id);
            $cat_content = json_decode($cat_req->getContent());
            $this->assertTrue(!empty($cat_content->data));
            $this->assertTrue($cat_content->status);
            $this->assertTrue(isset($cat_content->data->benefits));
        }
    }
}