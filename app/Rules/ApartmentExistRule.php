<?php

namespace App\Rules;

use App\Models\Apartment;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class ApartmentExistRule implements ValidationRule
{
    private int $apartment_id;

    public function __construct(int $apartment_id)
    {
        $this->apartment_id = $apartment_id;
    }

    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $apartment = Apartment::where('id', $this->apartment_id)->exists();

        if (! $apartment) {
            $fail('Condominio informado não existe.');
        }
    }
}
