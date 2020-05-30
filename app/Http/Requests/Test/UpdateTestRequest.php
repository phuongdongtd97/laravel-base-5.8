<?php

namespace App\Http\Requests\Test;

use App\Rules\ValidContactContent;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\Rule;

class UpdateTestRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'title' => ['bail','required','min:2','max:200',  Rule::unique('tests', 'title')->whereNull('deleted_at')->ignore($this->test)],
            'content' => ['bail', 'required']
        ];
    }

    public function messages()
    {
        $attribute = 'test';
        return [
            'title.required' => __('Vui lòng nhập tiêu đề :attribute.', ['attribute' => $attribute]),
            'title.min' => __('Tiêu đề :attribute quá ngắn. Tối thiểu 2 ký tự', ['attribute' => $attribute]),
            'title.max' => __('Tiêu đề :attribute quá dài. Tối đa 100 ký tự', ['attribute' => $attribute]),
            'content.required' => __('Vui lòng nhập nội dung :attribute.', ['attribute' => $attribute]),

        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'errors' => $validator->errors(),
        ], JsonResponse::HTTP_UNPROCESSABLE_ENTITY));
    }
}
