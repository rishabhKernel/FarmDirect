<?php
namespace App\Models;
use MongoDB\Laravel\Eloquent\Model;

class Crop extends Model
{
    protected $connection = 'mongodb';
    protected $collection = 'crops';

    protected $fillable = [
        'farmer_id',
        'name',
        'variety',
        'category',
        'quantity',
        'unit',
        'price_per_unit',
        'harvest_date',
        'expiry_date',
        'image_url',
        'quality_image_url',
        'status', // active, sold, expired
        'is_organic',
        'description'
    ];

    protected $casts = [
        'quantity' => 'integer',
        'price_per_unit' => 'float',
        'is_organic' => 'boolean',
    ];

    public function farmer()
    {
        return $this->belongsTo(User::class, 'farmer_id');
    }

    public function getImageUrlAttribute($value)
    {
        if ($value) {
            if (str_starts_with($value, 'http')) {
                return $value;
            }
            $cleanPath = ltrim($value, '/');
            if (str_starts_with($cleanPath, 'storage/')) {
                $cleanPath = substr($cleanPath, 8);
            }
            return asset('storage/' . $cleanPath);
        }
        
        $cropImages = [
            'wheat'       => 'photo-1574323347407-f5e1ad6d020b',
            'rice'        => 'photo-1586201375761-83865001e31c',
            'paddy'       => 'photo-1586201375761-83865001e31c',
            'basmati'     => 'photo-1586201375761-83865001e31c',
            'maize'       => 'photo-1551754655-cd27e38d2076',
            'corn'        => 'photo-1551754655-cd27e38d2076',
            'tomato'      => 'photo-1595855759920-86582396756a',
            'onion'       => 'photo-1518977956812-cd3dbadaaf31',
            'potato'      => 'photo-1518977676601-b53f82aba655',
            'carrot'      => 'photo-1582515073490-39981397c445',
            'mango'       => 'photo-1553279768-865429fa0078',
            'banana'      => 'photo-1571771894821-ce9b6c11b08e',
            'apple'       => 'photo-1567306226416-28f0efdc88ce',
            'grapes'      => 'photo-1537640538966-79f369143f8f',
            'orange'      => 'photo-1547514701-42782101795e',
            'lemon'       => 'photo-1608686207856-001b95cf60ca',
            'sugarcane'   => 'photo-1528183429752-a97d0bf99b5a',
            'cotton'      => 'photo-1594489428504-5c0c480a15fd',
            'soybean'     => 'photo-1599940824399-b87987ceb72a',
            'groundnut'   => 'photo-1542990253-0d0f5be5f0ed',
            'mustard'     => 'photo-1534073828943-f801091bb18c',
            'sunflower'   => 'photo-1597848212624-a19eb35e2651',
            'spinach'     => 'photo-1576045057995-568f588f82fb',
            'cabbage'     => 'photo-1597362925123-77861d3fbac7',
            'cauliflower' => 'photo-1591343395082-e120087004b4',
            'chili'       => 'photo-1588252399616-921473775b8e',
            'garlic'      => 'photo-1540148426945-6cf22a6b2383',
            'ginger'      => 'photo-1599940824399-b87987ceb72a',
            'turmeric'    => 'photo-1615485290382-441e4d049cb5',
            'pepper'      => 'photo-1588252399616-921473775b8e',
            'pea'         => 'photo-1587049352846-4a222e784d38',
            'beans'       => 'photo-1571770095004-6b61b1cf308a',
            'chickpea'    => 'photo-1542990253-0d0f5be5f0ed',
            'lentil'      => 'photo-1542990253-0d0f5be5f0ed',
            'dal'         => 'photo-1542990253-0d0f5be5f0ed',
            'brinjal'     => 'photo-1587132137056-bfbf0166836e',
            'eggplant'    => 'photo-1587132137056-bfbf0166836e',
            'pumpkin'     => 'photo-1570586437263-ab629fccc818',
            'watermelon'  => 'photo-1563114773-84221bd62daa',
            'strawberry'  => 'photo-1464965911861-746a04b4bca6',
            'pomegranate' => 'photo-1615485290382-441e4d049cb5',
            'coconut'     => 'photo-1546527868-ccde8624d895',
            'papaya'      => 'photo-1526318896980-cf78c088247c',
            'guava'       => 'photo-1600788907416-456578634209',
            'pineapple'   => 'photo-1550258987-190a2d41a8ba',
            'litchi'      => 'photo-1566132133282-8c0a28e15294',
            'cucumber'    => 'photo-1551877781-1c12ea7a9acd',
            'kheera'      => 'photo-1551877781-1c12ea7a9acd',
            'capsicum'    => 'photo-1518779578993-ec3579fee39f',
            'radish'      => 'photo-1598170845058-32b9d6a5da37',
            'beetroot'    => 'photo-1587049332298-1c42e83937a7',
            'turnip'      => 'photo-1598170845058-32b9d6a5da37',
        ];

        $nameLower = strtolower($this->name ?? '');
        foreach ($cropImages as $keyword => $photoId) {
            if (str_contains($nameLower, $keyword)) {
                return "https://images.unsplash.com/{$photoId}?auto=format&fit=crop&q=80&w=800";
            }
        }
        
        return 'https://images.unsplash.com/photo-1500937386664-56d1dfef3854?auto=format&fit=crop&q=80&w=800';
    }
}
