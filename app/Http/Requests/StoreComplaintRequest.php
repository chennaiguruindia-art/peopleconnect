<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreComplaintRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'citizen_name' => ['required', 'string', 'max:150'],
            'citizen_mobile' => ['required', 'regex:/^[6-9]\d{9}$/'],
            'citizen_email' => ['nullable', 'email', 'max:150'],
            'citizen_address' => ['required', 'string', 'max:500'],
            'district_id' => ['required', 'exists:districts,id'],
            'revenue_division_id' => ['required', 'exists:revenue_divisions,id'],
            'taluk_id' => ['required', 'exists:taluks,id'],
            'revenue_village_id' => ['nullable'],
            'custom_village_name' => ['nullable', 'string', 'max:200'],
            'ward_number' => ['nullable', 'string', 'max:50'],
            'landmark' => ['nullable', 'string', 'max:200'],
            'live_latitude' => ['nullable', 'numeric', 'between:-90,90'],
            'live_longitude' => ['nullable', 'numeric', 'between:-180,180'],
            'live_address' => ['nullable', 'string', 'max:1000'],
            'category_id' => ['required', 'exists:complaint_categories,id'],
            'subject' => ['required', 'string', 'min:5', 'max:255'],
            'description' => ['required', 'string', 'min:20', 'max:3000'],
            'priority' => ['nullable', 'in:low,medium,high,urgent'],
            'photo' => ['nullable', 'file', 'image', 'mimes:jpeg,png,jpg,webp', 'max:5120'], // 5MB max
            'document' => ['nullable', 'file', 'mimes:pdf,jpeg,png,jpg', 'max:5120'], // 5MB max
            'privacy_consent' => ['required', 'accepted'],
        ];
    }

    public function messages(): array
    {
        return [
            'citizen_name.required' => 'Please enter your full name (முழு பெயரை உள்ளிடவும்).',
            'citizen_mobile.required' => 'Mobile number is required (கைபேசி எண் அவசியம்).',
            'citizen_mobile.regex' => 'Please enter a valid 10-digit Indian mobile number (சரியான 10 இலக்க கைபேசி எண்ணை உள்ளிடவும்).',
            'citizen_address.required' => 'Street address is required (முழு முகவரியை உள்ளிடவும்).',
            'district_id.required' => 'Please select District (மாவட்டம் தேர்வு செய்க).',
            'revenue_division_id.required' => 'Please select Revenue Division (வருவாய் கோட்டம் தேர்வு செய்க).',
            'taluk_id.required' => 'Please select Revenue Taluk (வருவாய் வட்டம் தேர்வு செய்க).',
            'category_id.required' => 'Please select Grievance Category (கோரிக்கை வகை தேர்வு செய்க).',
            'subject.required' => 'Please provide a brief subject (கோரிக்கையின் சுருக்கத்தை உள்ளிடவும்).',
            'description.required' => 'Please provide detailed description (பிரச்சனையின் முழு விளக்கத்தை உள்ளிடவும்).',
            'description.min' => 'Description must be at least 20 characters (விளக்கம் குறைந்தது 20 எழுத்துக்கள் இருக்க வேண்டும்).',
            'privacy_consent.accepted' => 'You must agree to the privacy and truthfulness terms (விதிமுறைகளை ஏற்க வேண்டும்).',
            'photo.max' => 'Photo size must not exceed 5MB (புகைப்படம் 5MB அளவிற்குள் இருக்க வேண்டும்).',
            'document.max' => 'Document size must not exceed 5MB (ஆவணம் 5MB அளவிற்குள் இருக்க வேண்டும்).',
        ];
    }
}
