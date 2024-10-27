<?php

declare(strict_types=1);

namespace App\Service;

class Validation
{

    protected array $requiredFields = [
        'pizza'    => 'numeric',
        'size'     => 'numeric',
        'sauce'    => 'numeric',
        'currency' => 'string',
    ];

    /**
     * @param array $data
     *
     * @return array|null
     */
    public function validate(array $data): ?array
    {
        $errors = null;

        foreach ($data as $key => $value) {
            if (!array_key_exists($key, $this->requiredFields)) {
                $errors['error_field'][] = $key . ' field required';
                continue;
            }

            if ($this->requiredFields[$key] === 'numeric' && !is_numeric($value)) {
                $errors['error_field_type'][] = $key . ' - must be numeric';

            }
            if ($this->requiredFields[$key] === 'string' && !is_string($value)) {
                $errors['error_field_type'][] = $key . ' - must be string';
            }
        }

        return $errors;
    }
}