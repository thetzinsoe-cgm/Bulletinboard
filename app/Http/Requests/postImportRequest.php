<?php

namespace App\Http\Requests;

use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Http\FormRequest;

class PostImportRequest extends FormRequest
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
     */
    public function rules(): array
    {
        return [
            'file' => ['required', 'file', 'mimes:csv,txt'],
        ];
    }

    /**
     * Prepare for validation
     *
     * @return void
     */
    protected function prepareForValidation()
    {
        if ($this->hasFile('file')) {
            $file = $this->file('file');
            $fileContents = file($file->getPathname());
            $rows = [];

            foreach ($fileContents as $line) {
                $data = str_getcsv($line);
                $rows[] = [
                    'title' => $data[0] ?? null,
                    'description' => $data[1] ?? null,
                    'flag' => $data[2] ?? null,
                ];
            }

            $this->merge(['csv_data' => $rows]);
        } else {
            $this->merge(['csv_data' => []]);
        }
    }

    /**
     * validator function
     *
     * @param mixed $validator
     * @return void
     */
    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            $csvData = $this->input('csv_data');
            $rules = [
                'title' => ['required', 'string', 'min:3', 'max:255'],
                'description' => ['required', 'string', 'min:10', 'max:500'],
                'flag' => ['required', 'in:0,1,true,false'],
            ];

            foreach ($csvData as $index => $row) {
                $rowValidator = Validator::make($row, $rules);
                if ($rowValidator->fails()) {
                    foreach ($rowValidator->errors()->all() as $error) {
                        $validator->errors()->add("csv_data.$index", "Row $index: $error");
                    }
                }
            }
        });
    }
}
