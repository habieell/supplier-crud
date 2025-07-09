<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class SupplierFactory extends Factory
{
    public function definition(): array
    {
        $harga = $this->faker->numberBetween(1000, 100000);
        $jumlah = $this->faker->numberBetween(1, 50);
        $total = $harga * $jumlah;

        return [
            'nama' => $this->faker->company(),
            'alamat' => $this->faker->address(),
            'telepon' => $this->faker->phoneNumber(),
            'email' => $this->faker->unique()->safeEmail(),
            'perusahaan' => $this->faker->company(),
            'jenis_barang' => $this->faker->randomElement(['Elektronik', 'Makanan', 'Pakaian', 'Alat Tulis']),
            'harga_barang' => $harga,
            'jumlah_barang' => $jumlah,
            'total_harga' => $total,
        ];
    }
}