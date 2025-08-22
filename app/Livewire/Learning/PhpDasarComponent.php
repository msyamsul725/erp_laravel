<?php

namespace App\Livewire\Learning;

use App\Models\Models\Product;
use Livewire\Component;

class PhpDasarComponent extends Component
{

    public $dataTypes = [];

    public function mount()
    {
        $this->initDataTypes(); // inisialisasi latihan tipe data

    }

    protected function initDataTypes(): void
    {
        $string = "Halo Laravel";
        $integer = 42;
        $float = 3.14;
        $boolean = true;
        $array = ["Laravel", "Livewire", "PHP"];
        $null = null;
        $object = (object) ["nama" => "Andi", "role" => "Developer"];

        $this->dataTypes = [
            ["label" => "String",  "value" => $string,  "type" => gettype($string)],
            ["label" => "Integer", "value" => $integer, "type" => gettype($integer)],
            ["label" => "Float",   "value" => $float,   "type" => gettype($float)],
            ["label" => "Boolean", "value" => $boolean, "type" => gettype($boolean)],
            ["label" => "Array",   "value" => implode(", ", $array), "type" => gettype($array)],
            ["label" => "Null",    "value" => "NULL",   "type" => gettype($null)],
            ["label" => "Object",  "value" => json_encode($object), "type" => gettype($object)],
        ];
    }
    public ?string $name = null;
    public ?string $sellerName = null;
    public ?int $price = null;
    public ?string $category = null;

    public string $nama = 'Andi';
    public int $umur = 20;
    public bool $aktif = true;
    public string $address = 'Karawang';
    public string $hoby = 'Menyanyi';

    /** ===== Array & fungsi sederhana ===== */
    public array $angka = [2, 4, 6];
    public int $angkaBaru = 1;

    /** ===== Latihan mini: daftar user ===== */
    public array $users = [
        ['nama' => 'Ana',  'email' => 'ana@example.com'],
        ['nama' => 'Budi', 'email' => 'budi@example.com'],
    ];
    public string $userNama = '';
    public string $userEmail = '';

    /** ===== OOP demo (tanpa menyimpan objek di properti) ===== */
    public int $a = 5;
    public int $b = 7;
    public ?int $hasilTambah = null;
    public ?int $hasilKali = null;

    // --- fungsi bantuan (PHP murni) ---
    public function jumlahkanAngka(): int
    {
        return array_sum($this->angka);
    }

    public function tambahAngka(): void
    {
        // Tambah angka baru ke array
        $this->angka[] = (int) $this->angkaBaru;
        $this->angkaBaru = 1;
    }

    public function hapusAngka(int $index): void
    {
        if (isset($this->angka[$index])) {
            unset($this->angka[$index]);
            $this->angka = array_values($this->angka);
        }
    }

    public function tambahUser(): void
    {
        $this->validate([
            'userNama'  => 'required|min:2',
            'userEmail' => 'required|email',
        ]);

        $this->users[] = ['nama' => $this->userNama, 'email' => $this->userEmail];

        $this->reset(['userNama', 'userEmail']);
    }

    public function hapusUser(int $index): void
    {
        if (isset($this->users[$index])) {
            unset($this->users[$index]);
            $this->users = array_values($this->users);
        }
    }

    // --- OOP mini (definisi class + penggunaan di method) ---
    protected function kalkulator(): object
    {
        // Class kecil untuk demo OOP
        return new class {
            public function tambah(int ...$n): int
            {
                return array_sum($n);
            }
            public function kali(int ...$n): int
            {
                return array_product($n);
            }
        };
    }

    public function hitungOop(): void
    {
        $calc = $this->kalkulator();
        $this->hasilTambah = $calc->tambah($this->a, $this->b);
        $this->hasilKali   = $calc->kali($this->a, $this->b);
    }

    /** ===== Progress sederhana untuk materi ===== */
    public array $checks = [
        'tipe-data' => false,
        'variables' => false,
        'arrays'    => false,
        'functions' => false,
        'oop'       => false,
        'practice'  => false,
    ];

    public function getProgressProperty(): int
    {
        $total = count($this->checks);
        $done  = collect($this->checks)->filter()->count();
        return (int) round(($done / $total) * 100);
    }

    public function resetChecks(): void
    {
        $this->checks = array_map(fn() => false, $this->checks);
    }

    public function render()
    {

        return view('livewire.learning.php-dasar-component',);
    }
}
