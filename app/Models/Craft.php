<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Craft extends Model
{
    use HasFactory;

    protected $table = null;
    public $timestamps = false;
    protected $primaryKey = null;
    protected $guarded = [];


    private static array $data = [
        [
            'slug' => 'crochet',
            'name' => ' crochet',
            'description' => 'On peut faire plein de choses au crochet : amigurumis, vêtements, etc.',
        ],
        [
            'slug' => 'tricot',
            'name' => ' tricot',
            'description' => 'De la laine, des aiguilles, et c’est parti pour un beau pull !',
        ],

    ];


    public static function all($columns = ['*']): Collection
    {
        $instances = array_map(fn($item) => new static($item), static::$data);
        return new Collection($instances);
    }

    public static function whereSlug(string $slug): Collection
    {
        $filtered = array_filter(static::$data, fn($item) => $item['slug'] === $slug);
        $instances = array_map(fn($item) => new static($item), $filtered);
        return new Collection($instances);
    }


    public static function findBySlugOrFail(string $slug): static
    {
        $collection = static::whereSlug($slug);
        if ($collection->isEmpty()) {
            abort(404, 'Craft not found');
        }
        return $collection->first();
    }


    public function artisans()
    {
        return collect([]); 
    }

    public function courses()
    {
        return collect([]);
    }

    public function skills()
    {
        return collect([]);
    }
}
