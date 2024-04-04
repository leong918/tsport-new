<?php

namespace App\Http\Controllers\Web;

use App\Repositories\SettingRepository;
use App\Repositories\FaqRepository;

class AboutController extends BaseController
{
    private SettingRepository $settingRepository;
    private FaqRepository $faqRepository;

    public function __construct(SettingRepository $settingRepository, FaqRepository $faqRepository)
    {
        $this->settingRepository = $settingRepository;
        $this->faqRepository = $faqRepository;
    }

    public function about()
    {
        $setting_model = $this->settingRepository->getListing()->get()->pluck('value', 'key')->toArray();

        return $this->view('about', compact('setting_model'));
    }
    public function aboutContact()
    {
        $setting_model = $this->settingRepository->getListing()->get()->pluck('value', 'key')->toArray();

        return $this->view('about_contact', compact('setting_model'));
    }
    public function aboutMembership()
    {
        $setting_model = $this->settingRepository->getListing()->get()->pluck('value', 'key')->toArray();

        return $this->view('about_membership', compact('setting_model'));
    }
    public function aboutPoint()
    {
        $setting_model = $this->settingRepository->getListing()->get()->pluck('value', 'key')->toArray();
        $faq_model = $this->faqRepository->getListing()->get();

        return $this->view('about_points', compact('setting_model', 'faq_model'));
    }
    public function aboutShipping()
    {
        $setting_model = $this->settingRepository->getListing()->get()->pluck('value', 'key')->toArray();

        return $this->view('about_shipping', compact('setting_model'));
    }
    public function aboutTnc()
    {
        $setting_model = $this->settingRepository->getListing()->get()->pluck('value', 'key')->toArray();

        return $this->view('about_tnc', compact('setting_model'));
    }
}
