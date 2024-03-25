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
        $setting_model = $this->settingRepository->getListing()->get()->pluck('value', 'key')->toArray();

        return $this->view('setting.global_index', compact('setting_model'));
    }

    public function updateSlider(Request $request)
    {
        $this->sliderRepository->updateSlider($request->all());
        return redirect(route('admin.setting.homepage_index'))->with('success', "Successfully update slider");
    }

    public function updateHomepageSetting(Request $request)
    {
        $data = $request->all();
        $this->updateSetting($data);

        return redirect(route('admin.setting.homepage_index'))->with('success', "Successfully update setting");
    }

    public function updateGlobalSetting(Request $request)
    {
        $data = $request->all();
        $this->updateSetting($data);

        return redirect(route('admin.setting.global_index'))->with('success', "Successfully update setting");
    }

    private function updateSetting($data)
    {
        foreach ($data as $key => $value) {
            $this->settingRepository->updateValueByKey($key, $value);
        }
    }

    public function destroy(int $id)
    {
        $this->sliderRepository->delete($id);

        return $this->response();
    }
}
