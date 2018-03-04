<?php

namespace App\Http\Requests\Backend\Auth\Tenant;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class UpdateTenantRequest.
 */
class UpdateTenantRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user()->isAdmin();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'tenant_name' => 'required|max:255',
            'end_subscription' => 'required|date',
            'max_users' => ['required', 'int', 'min:'.$this->tenant->users()->count()]
        ];
    }
}
