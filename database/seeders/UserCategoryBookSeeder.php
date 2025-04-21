<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Category;
use App\Models\Book;
use App\Models\Swap;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserCategoryBookSeeder extends Seeder
{
    public function run(): void
    {
        $faker = \Faker\Factory::create();

        $universities = [
            'North South University',
            'BRAC University',
            'East West University',
            'Independent University Bangladesh',
            'American International University-Bangladesh',
            'United International University',
        ];

        $muslimBoyNames = [
            'Hasan Mahmud', 'Abdullah Al Noman', 'Farhan Hossain', 'Raihan Kabir',
            'Jubayer Rahman', 'Mehedi Hasan', 'Tanzim Alam', 'Rashed Khan',
            'Shahriar Fahim', 'Nayem Islam'
        ];

        $users = [];

        foreach ($muslimBoyNames as $index => $name) {
            $users[] = User::create([
                'name' => $name,
                'university_name' => $universities[array_rand($universities)],
                'department' => $faker->randomElement(['CSE', 'EEE', 'BBA', 'Pharmacy']),
                'year' => $faker->randomElement(['1st', '2nd', '3rd', '4th']),
                'email' => Str::slug($name) . '@example.com',
                'password' => Hash::make('password'),
            ]);
        }

        $categories = ['উপন্যাস', 'বিজ্ঞান', 'ইতিহাস', 'প্রযুক্তি', 'কবিতা', 'ধর্ম'];

        foreach ($categories as $categoryName) {
            Category::create(['name' => $categoryName]);
        }

        $bookTitles = [
            'পথের পাঁচালী',
            'অপরাজিত',
            'দেবদাস',
            'চাঁদের পাহাড়',
            'নক্ষত্রের রাত',
            'মেঘ বলেছে যাব যাব',
            'ভবিষ্যতের ইতিহাস',
            'মহাকাশ অভিযান',
            'বাংলাদেশের মুক্তিযুদ্ধ',
            'প্রোগ্রামিং জাভা',
            'ডেটাবেজ ডিজাইন',
            'আধুনিক পদার্থবিজ্ঞান',
            'ছোটদের ইসলামী গল্প',
            'নবীজির জীবনী',
            'বাংলা সাহিত্যের ধারা',
            'রবীন্দ্র কবিতা সংগ্রহ',
            'মুক্তিযুদ্ধের ছায়া',
            'ভ্রমণ বাংলাদেশ',
            'তাহার কথা',
            'অন্ধকারে আলো'
        ];

        $imageUrls = [
            'https://i.imgur.com/1.jpg',
            'https://i.imgur.com/2.jpg',
            'https://i.imgur.com/3.jpg',
            'https://i.imgur.com/4.jpg',
            'https://i.imgur.com/5.jpg',
            'https://i.imgur.com/6.jpg',
            'https://i.imgur.com/7.jpg',
            'https://i.imgur.com/8.jpg',
            'https://i.imgur.com/9.jpg',
            'https://i.imgur.com/10.jpg'
        ];

        $books = [];

        foreach ($bookTitles as $title) {
            $books[] = Book::create([
                'user_id' => $users[array_rand($users)]->id,
                'category_id' => rand(1, count($categories)),
                'title' => $title,
                'description' => $faker->sentence(),
                'photo_path' => $imageUrls[array_rand($imageUrls)],
            ]);
        }

        for ($i = 0; $i < 5; $i++) {
            Swap::create([
                'book_requested_id' => $books[array_rand($books)]->id,
                'book_offered_id' => $books[array_rand($books)]->id,
                'requester_id' => $users[array_rand($users)]->id,
                'status' => $faker->randomElement(['pending', 'accepted', 'declined']),
            ]);
        }
    }
}
