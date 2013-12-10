<?php
class AdminBenefitSubCategoriesController extends \BaseController {

    public function index()
    {
        $sub_categories = BenefitSubCategory::all();
    }

    public function show($id)
    {

    }

}