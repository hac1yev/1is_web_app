<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class vacRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
         return [
            'title' => 'required',
            'category' => 'required|numeric',
            'company' => 'required|numeric',
            'city' => 'required|numeric',
            'jobtype' => 'required|numeric',
            'experience' => 'required|numeric',
            'education' => 'required|numeric',
            'min_age' => 'nullable|numeric',
            'max_age' => 'nullable|numeric',
            'requirements' => 'required',
            'description' => 'required',
            'accept_type' => 'required|numeric',
            'deadline' => 'required|date',
            'region' => 'required_if:city,1|numeric',
            'min_salary' => 'required_if:salary_type,1|numeric',
            'max_salary' => 'required_if:salary_type,1|numeric',
            'contact_email' => 'required_if:accept_type,0|email',
            'contact_link' => 'required_if:accept_type,2',

        
    ];
}

public function messages()
{
    return [
        'title.required' => 'Başlığı daxil edin!',
        'category.required' => 'Kateqoriyanı seçin!',
        'category.numeric' => 'Kateqoriya sayı olmalıdır!',
        'company.required' => 'Şirkəti seçin!',
        'company.numeric' => 'Şirkət sayı olmalıdır!',
        'city.required' => 'Şəhəri seçin!',
        'city.numeric' => 'Şəhər sayı olmalıdır!',
        'jobtype.required' => 'İş növünü seçin!',
        'jobtype.numeric' => 'İş növü sayı olmalıdır!',
        'experience.required' => 'Təcrübəni seçin!',
        'experience.numeric' => 'Təcrübə sayı olmalıdır!',
        'education.required' => 'Təhsili seçin!',
        'education.numeric' => 'Təhsil sayı olmalıdır!',
        'min_age.numeric' => 'Min yaş rəqəm olmalıdır!',
        'max_age.numeric' => 'Max yaş rəqəm olmalıdır!',
        'requirements.required' => 'Tələbləri daxil edin!',
        'description.required' => 'Təsviri daxil edin!',
        'accept_type.required' => 'Qəbul formasını seçin!',
        'accept_type.numeric' => 'Qəbul formu sayı olmalıdır!',
        'deadline.required' => 'Son tarixi daxil edin!',
        'deadline.date' => 'Son tarix düzgün formatda olmalıdır!',
        'region.required_if' => 'Regionu seçin!',
        'region.numeric' => 'Region sayı olmalıdır!',
        'min_salary.required_if' => 'Minimum maaşı daxil edin!',
        'min_salary.numeric' => 'Minimum maaş rəqəm olmalıdır!',
        'max_salary.required_if' => 'Maksimum maaşı daxil edin!',
        'max_salary.numeric' => 'Maksimum maaş rəqəm olmalıdır!',
        'contact_email.required_if' => 'Əlaqə emailini daxil edin!',
        'contact_email.email' => 'Əlaqə emailini düzgün formatda daxil edin!',
        'contact_link.required_if' => 'Əlaqə linkini daxil edin!',
    ];
}

}