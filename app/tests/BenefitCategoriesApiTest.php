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

            foreach ($cat_content->data->sub_categories as $sub_cat)
            {
                $this->assertEquals(1, preg_match('/^http|https*/', $sub_cat->icono));
                $this->assertEquals(1, preg_match('/^http|https*/', $sub_cat->banner));

                $this->assertTrue(isset($sub_cat->benefits));
                
                foreach ($sub_cat->benefits as $benefit)
                {
                    $this->assertEquals(1, preg_match('/^http|https*/', $benefit->imagen_grande_web));
                    $this->assertEquals(1, preg_match('/^http|https*/', $benefit->imagen_grande));
                    $this->assertEquals(1, preg_match('/^http|https*/', $benefit->imagen_chica));
                    $this->assertEquals(1, preg_match('/^http|https*/', $benefit->imagen_titulo));
                    $this->assertEquals(1, preg_match('/^http|https*/', $benefit->icono));
                }
            }
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