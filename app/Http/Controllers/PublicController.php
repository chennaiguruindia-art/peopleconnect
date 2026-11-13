<?php

namespace App\Http\Controllers;

use App\Models\Complaint;
use App\Models\ComplaintCategory;
use App\Models\DevelopmentBlock;
use App\Models\District;
use App\Models\Municipality;
use App\Models\PublicUpdate;
use App\Models\RevenueDivision;
use App\Models\SystemSetting;
use App\Models\Taluk;
use App\Models\TownPanchayat;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class PublicController extends Controller
{
    public function about(): View
    {
        $settings = SystemSetting::all()->pluck('value', 'key');
        return view('public.about', compact('settings'));
    }

    public function districtInformation(Request $request): View
    {
        $districts = District::where('is_active', true)->orderBy('name_en')->get();
        $selectedDistrictId = $request->input('district_id', District::where('code', 'VIR')->value('id') ?? $districts->first()?->id);
        $district = District::find($selectedDistrictId);

        $divisions = RevenueDivision::with(['taluks.revenueVillages'])->where('district_id', $district?->id)->get();
        $blocks = DevelopmentBlock::with('villagePanchayats')->where('district_id', $district?->id)->get();
        $municipalities = Municipality::with('wards')->where('district_id', $district?->id)->get();
        $townPanchayats = TownPanchayat::where('district_id', $district?->id)->get();

        return view('public.district-information', compact(
            'districts',
            'district',
            'divisions',
            'blocks',
            'municipalities',
            'townPanchayats'
        ));
    }

    public function updates(): View
    {
        $updates = PublicUpdate::where('is_active', true)
            ->orderBy('published_at', 'desc')
            ->paginate(6);

        return view('public.updates', compact('updates'));
    }

    public function contact(): View
    {
        $settings = SystemSetting::all()->pluck('value', 'key');
        return view('public.contact', compact('settings'));
    }

    public function privacy(): View
    {
        return view('public.privacy-policy');
    }

    public function terms(): View
    {
        return view('public.terms-conditions');
    }
}
