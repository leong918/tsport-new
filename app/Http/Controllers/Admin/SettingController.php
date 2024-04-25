<?php

namespace App\Http\Controllers\Admin;

use App\Repositories\ProductRepository;
use App\Repositories\SettingRepository;
use App\Repositories\SliderRepository;
use App\Repositories\CountryRepository;
use Illuminate\Http\Request;

class SettingController extends BaseController
{
    private ProductRepository $productRepository;
    private SettingRepository $settingRepository;
    private SliderRepository $sliderRepository;
    private CountryRepository $countryRepository;

    public function __construct(ProductRepository $productRepository, SettingRepository $settingRepository, SliderRepository $sliderRepository, CountryRepository $countryRepository)
    {
        $this->productRepository = $productRepository;
        $this->settingRepository = $settingRepository;
        $this->sliderRepository = $sliderRepository;
        $this->countryRepository = $countryRepository;
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
        $countryDropdown = $this->countryRepository->dropdown();
        $setting_model = $this->settingRepository->getListing()->get()->pluck('value', 'key')->toArray();

        return $this->view('setting.global_index', compact('setting_model', 'productDropdown', 'countryDropdown'));
    }

    public function aboutIndex(Request $request)
    {
        $setting_model = $this->settingRepository->getListing()->get()->pluck('value', 'key')->toArray();

        return $this->view('setting.about_index', compact('setting_model'));
    }

    public function aboutMembership(Request $request)
    {
        $setting_model = $this->settingRepository->getListing()->get()->pluck('value', 'key')->toArray();

        return $this->view('setting.about_membership', compact('setting_model'));
    }

    public function aboutContact(Request $request)
    {
        $setting_model = $this->settingRepository->getListing()->get()->pluck('value', 'key')->toArray();

        return $this->view('setting.about_contact', compact('setting_model'));
    }

    public function aboutTnc(Request $request)
    {
        $setting_model = $this->settingRepository->getListing()->get()->pluck('value', 'key')->toArray();

        return $this->view('setting.about_tnc', compact('setting_model'));
    }

    public function aboutShipping(Request $request)
    {
        $setting_model = $this->settingRepository->getListing()->get()->pluck('value', 'key')->toArray();

        return $this->view('setting.about_shipping', compact('setting_model'));
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

    public function updateAbout(Request $request)
    {
        $data = $request->all();
        $data['about_banner'] = $this->settingRepository->uploadImage($data['about_banner']);
        $data['about_right_image'] = $this->settingRepository->uploadImage($data['about_right_image']);

        $this->updateSetting($data);

        return redirect(route('admin.setting.about_index'))->with('success', "Successfully update setting");
    }

    public function updateAboutMembership(Request $request)
    {
        $data = $request->all();
        $data['membership_banner'] = $this->settingRepository->uploadImage($data['membership_banner']);

        $this->updateSetting($data);

        return redirect(route('admin.setting.about_membership'))->with('success', "Successfully update setting");
    }

    public function updateAboutContact(Request $request)
    {
        $data = $request->all();
        $data['contact_banner'] = $this->settingRepository->uploadImage($data['contact_banner']);

        $this->updateSetting($data);

        return redirect(route('admin.setting.about_contact'))->with('success', "Successfully update setting");
    }

    public function updateAboutTnc(Request $request)
    {
        $data = $request->all();
        $data['tnc_banner'] = $this->settingRepository->uploadImage($data['tnc_banner']);

        $this->updateSetting($data);

        return redirect(route('admin.setting.about_tnc'))->with('success', "Successfully update setting");
    }

    public function updateAboutShipping(Request $request)
    {
        $data = $request->all();
        $data['shipping_banner'] = $this->settingRepository->uploadImage($data['shipping_banner']);

        $this->updateSetting($data);

        return redirect(route('admin.setting.about_shipping'))->with('success', "Successfully update setting");
    }

    public function updateFaqBanner(Request $request)
    {
        $data = $request->all();
        $data['faq_banner'] = $this->settingRepository->uploadImage($data['faq_banner']);

        $this->updateSetting($data);

        return redirect(route('admin.faq.index'))->with('success', "Successfully update faq");
    }

    private function updateSetting($data)
    {
        unset($data['_token']);
        foreach ($data as $key => $value) {
            if($key == 'new_order_email_image' || $key == 'tracking_number_email_image' || $key == 'shipping_fee_email_image' || $key == 'order_received_email_image' || $key == 'sales_order_status_image'|| $key == 'customer_note_email_image'){
                $value = $this->settingRepository->uploadImage($value);
            }
            if($value){
                $this->settingRepository->updateValueByKey($key, $value);
            }
        }
    }

    public function destroy(int $id)
    {
        $this->sliderRepository->delete($id);

        return $this->response();
    }
}
