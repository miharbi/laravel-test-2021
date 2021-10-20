<?php

namespace App\Services;

use App\Interfaces\IShippingService;

use Illuminate\Support\Str;

class FakeShippingService implements IShippingService
{
    public function store(string $name, int $height, int $width, int $weigth, int $destination): array
    {
        if ($destination == 1) {
            $destinationAddress = "Sucursal EEUU, Avenue lorem ipsum dolor 13000";
            $company = 'Fake Shipping Service S.A';
        } elseif ($destination == 2) {
            $destinationAddress = "Sucursal X región Chile, Avenida lorem ipsum dolor 16000";
            $company = 'Own Fake Shipping Service';
        }

        return [
            'company' => $company,
            'uuid' => Str::uuid(),
            'name' => $name,
            'height' => $height,
            'width' => $width,
            'weigth' => $weigth,
            'destination' => $destinationAddress
        ];
    }
}
