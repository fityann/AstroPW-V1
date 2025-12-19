<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vendor extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'category', 'description', 'price', 'image', 'contact',
    ];

    public const CATEGORIES = [
        'wo' => 'Wedding Organizer (WO)',
        'venue' => 'Venue',
        'catering' => 'Catering',
        'dekorasi' => 'Dekorasi',
        'mua' => 'MUA & Tata Rambut',
        'dokumentasi' => 'Dokumentasi (Foto/Video)',
        'busana' => 'Busana Pengantin',
        'hiburan' => 'Hiburan (MC, Band/DJ)',
        'kue' => 'Kue Pernikahan',
        'undangan' => 'Undangan & Souvenir',
        'cincin' => 'Cincin',
    ];

    public function getCategoryLabelAttribute()
    {
        return self::CATEGORIES[$this->category] ?? $this->category;
    }
}
