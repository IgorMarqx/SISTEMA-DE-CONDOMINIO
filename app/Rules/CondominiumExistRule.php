<?php

namespace App\Rules;

use App\Models\Condominium;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class CondominiumExistRule implements ValidationRule
{
    private int $condominium_id;

    public function __construct(int $condominium_id)
    {
        $this->condominium_id = $condominium_id;
    }

    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $condominium = Condominium::where('id', $this->condominium_id)->exists();

        if (! $condominium) {
            $fail('Condominio informado não existe.');
        }
    }
}
