<?php

namespace App\Http\Requests;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Prepare the data for validation.
     */
    protected function prepareForValidation(): void
    {
        $this->merge([
            'password' => 123
        ]);
    }


    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        $uniqueRule = $this->user ? Rule::unique(User::class)->ignore($this->user) : Rule::unique(User::class);
        $required = $this->user ? 'nullable' :  'required';
        return [
            'name' => ['required', 'required', 'max:255'],
          //  'password' => [$required, 'confirmed', Rules\Password::defaults()],
            'email' => ['email', 'required', 'max:255', $uniqueRule],
        ];
    }
}
