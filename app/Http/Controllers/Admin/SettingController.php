<?php

namespace App\Http\Controllers\Admin;

use App\Repositories\ProductRepository;
use App\Repositories\SettingRepository;
use App\Repositories\SliderRepository;
use Illuminate\Http\Request;

class SettingController extends BaseController
{
    private ProductRepository $productRepository;
    private SettingRepository $settingRepository;
    private SliderRepository $sliderRepository;

    public function __construct(ProductRepository $productRepository, SettingRepository $settingRepository, SliderRepository $sliderRepository)
    {
        $this->productRepository = $productRepository;
        $this->settingRepository = $settingRepository;
        $this->sliderRepository = $sliderRepository;
    }

    public function homepageIndex(Request $request)
    {
        $productDropdown = $this->productRepository->dropdown();
        $setting_model = $this->settingRepository->getListing()->get()->pluck('value', 'key')->toArray();
        $slider_model = $this->sliderRepository->getListing()->get()->toArray();

        return $this->view('setting.homepage_index', compact('productDropdown', 'setting_model', 'slider_model'));
    }

    public function globalIndex(Request $request)
    {
        $productDropdown = $this->productRepository->dropdown();
        $setting_model = $this->settingRepository->getListing()->get()->pluck('value', 'key')->toArray();
        $slider_model = $this->sliderRepository->getListing()->get()->toArray();

        return $this->view('setting.global_index', compact('productDropdown', 'setting_model', 'slider_model'));
    }

    public function updateMainSlider(Request $request)
    {
        $this->sliderRepository->updateSlider($request->all());

        return redirect(route('admin.setting.index'))->with('success', "Successfully update main slider");
    }

    public function updateSubSlider(Request $request)
    {
        if ($request['sub_slider_title']) {
            $this->settingRepository->updateValueByKey('sub_slider_title', $request['sub_slider_title']);
        } else {
            $this->sliderRepository->updateSlider($request->all());
        }

        return redirect(route('admin.setting.index'))->with('success', "Successfully update sub slider");
    }

    public function updateSectionRight(Request $request)
    {
        $this->settingRepository->updateValueByKey('section_right_title', $request['section_right_title']);
        $this->settingRepository->updateValueByKey('product_right_select', $request['product_right_select']);

        return redirect(route('admin.setting.index'))->with('success', "Successfully update section right products");
    }

    public function updateSectionLeft(Request $request)
    {
        $this->settingRepository->updateValueByKey('section_left_title', $request['section_left_title']);
        $this->settingRepository->updateValueByKey('product_left_select', $request['product_left_select']);

        return redirect(route('admin.setting.index'))->with('success', "Successfully update section left products");
    }

    public function updateSectionCenter(Request $request)
    {
        $this->settingRepository->updateValueByKey('section_center_title', $request['section_center_title']);
        $this->settingRepository->updateValueByKey('product_center_select', $request['product_center_select']);

        return redirect(route('admin.setting.index'))->with('success', "Successfully update section center products");
    }

    public function updateSectionRecommended(Request $request)
    {
        $this->settingRepository->updateValueByKey('recommended_title', $request['recommended_title']);
        $this->settingRepository->updateValueByKey('product_recommended_select', $request['product_recommended_select']);

        return redirect(route('admin.setting.index'))->with('success', "Successfully update section recommended products");
    }

    public function destroy(int $id)
    {
        $this->sliderRepository->delete($id);

        return $this->response();
    }
}
