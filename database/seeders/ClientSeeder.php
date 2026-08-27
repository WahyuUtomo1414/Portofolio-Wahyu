<?php

namespace Database\Seeders;

use App\Models\Client;
use Illuminate\Database\Seeder;

class ClientSeeder extends Seeder
{
    public function run(): void
    {
        foreach ($this->clients() as $client) {
            Client::query()->updateOrCreate(
                ['name' => $client['name']],
                $client + ['active' => true],
            );
        }
    }

    private function clients(): array
    {
        return [
            ['name' => 'PT Keysoft ERP Indonesia', 'logo' => 'https://picsum.photos/seed/client-keysoft/320/320', 'desc' => 'Perusahaan penyedia solusi ERP dan sistem bisnis.'],
            ['name' => 'Universitas BSI', 'logo' => 'https://picsum.photos/seed/client-ubsi/320/320', 'desc' => 'Institusi pendidikan tinggi berbasis teknologi informasi.'],
            ['name' => 'Personal Project', 'logo' => 'https://picsum.photos/seed/client-personal/320/320', 'desc' => 'Project pribadi untuk eksplorasi produk digital.'],
        ];
    }
}
