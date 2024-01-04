<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MessageFormPost extends FormRequest
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

    public function messages()
    {
        return [
            'message_text.required' => 'Вы не ввели сообщение!',
            'client.required'  => 'Выбирите пользователя, которому нужно отправить сообщение!',
        ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'message_text' => 'required',
            'client_id' => 'required',
        ];
    }
}
