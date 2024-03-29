<?php

namespace App\Http\Requests;

use App\Models\Wallet;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreWalletRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('wallet_create');
    }

    public function rules()
    {
        return [
            'user_id'            => [
                'required',
                'integer',
            ],
            'balance'            => [
                'required',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'previous_balance'   => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'last_added_amount'  => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'last_deduct_amount' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
        ];
    }
}
