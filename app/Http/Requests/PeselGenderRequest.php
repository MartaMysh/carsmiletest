<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PeselGenderRequest extends FormRequest
{
    /**
     * Indicates if the validator should stop on the first rule failure.
     *
     * @var bool
     */
    protected $stopOnFirstFailure = true;

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'pesel'  => ['nullable', 'regex:/^[0-9]{11}$/'],
            'gender' => 'required_with:pesel'
        ];
    }

    public function withValidator($validator): void
    {
        $validator->after(function ($validator) {
            if ($validator->failed()) return;
            if ($this->invalidGender()) {
                $validator->errors()->add(
                    'gender',
                    'The selected gender does not match the PESEL number entered'
                );
            }
        });
    }

    public function messages(): array
    {
        return [
            'pesel' => 'PESEL must contain eleven digits',
            'gender.required_with' => 'Gender cannot be empty',
        ];
    }

    /**
     * Sprawdzenie płci. 10 cyfra nieparzysta = mężczyzna, parzysta = kobieta
     * @return bool
     */
    private function invalidGender(): bool
    {
        $pesel = $this->request->get('pesel');
        $gender = $this->request->get('gender');

        if (!$pesel) {
            return false;
        }
        if (strlen($pesel) >= 11) {
            $tenth = $pesel[9];
            if (($tenth % 2 == 0 && $gender == 2) || ($tenth % 2 == 1 && $gender == 1)) {
                return false;
            }
        }
        return true;
    }
}
