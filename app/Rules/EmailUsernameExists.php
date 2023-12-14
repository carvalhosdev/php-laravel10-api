<?php

namespace App\Rules;

use App\Models\User;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class EmailUsernameExists implements ValidationRule
{

    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        
          
            if (User::where('email', $value)->exists()) {
                $fail("O $attribute já existe.");
            }
    
            if (User::where('username', $value)->exists()) {
                $fail("O $attribute já existe.");
            }
   
      
    }
}
