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

        // Users
        $universities = [
            'North South University', 'BRAC University',
            'East West University', 'Independent University Bangladesh',
            'American International University-Bangladesh', 'United International University',
        ];

        $muslimBoyNames = [
            'Hasan Mahmud', 'Abdullah Al Noman', 'Farhan Hossain', 'Raihan Kabir',
            'Jubayer Rahman', 'Mehedi Hasan', 'Tanzim Alam', 'Rashed Khan',
            'Shahriar Fahim', 'Nayem Islam'
        ];

        $users = [];
		
		$users[] = User::create([
                'name' => 'Mohammad Ibrahim',
                'university_name' => 'North Western University, Khulna',
                'department' => 'CSE',
                'year' => '3rd',
                'email' => 'ibrahim@gmail.com',
                'password' => Hash::make('ibrahim1234'),
            ]);
		
        foreach ($muslimBoyNames as $name) {
            $users[] = User::create([
                'name' => $name,
                'university_name' => $universities[array_rand($universities)],
                'department' => $faker->randomElement(['CSE', 'EEE', 'BBA', 'Pharmacy']),
                'year' => $faker->randomElement(['1st', '2nd', '3rd', '4th']),
                'email' => Str::slug($name) . '@example.com',
                'password' => Hash::make('password'),
            ]);
        }

        // Categories
        $categoryNames = ['উপন্যাস', 'বিজ্ঞান', 'ইতিহাস', 'প্রযুক্তি', 'কবিতা', 'ধর্ম'];
        $categories = [];
        foreach ($categoryNames as $cname) {
            $categories[] = Category::create(['name' => $cname]);
        }

        // Dummy books
        $dummyBooks = [
            'উপন্যাস' => [
                ['title' => 'পথের পাঁচালী', 'image' => 'https://rokbucket.rokomari.io/ProductNew20190903/260X372/rokimg_2111_22493.GIF'],
                ['title' => 'দেবদাস', 'image' => 'https://rokbucket.rokomari.io/ProductNew20190903/260X372/Devdas-Saratchandra_Chattopadhyay-20edb-40769.jpg'],
                ['title' => 'চাঁদের পাহাড়', 'image' => 'https://rokbucket.rokomari.io/ProductNew20190903/260X372/Chader_Pahar-Bibhutibhusan_Bandopadhyay-d478f-397502.jpg'],
				['title' => 'পথের পাঁচালী', 'image' => 'https://rokbucket.rokomari.io/ProductNew20190903/260X372/rokimg_2111_22493.GIF'],
                ['title' => 'দেবদাস', 'image' => 'https://rokbucket.rokomari.io/ProductNew20190903/260X372/Devdas-Saratchandra_Chattopadhyay-20edb-40769.jpg'],
                ['title' => 'চাঁদের পাহাড়', 'image' => 'https://rokbucket.rokomari.io/ProductNew20190903/260X372/Chader_Pahar-Bibhutibhusan_Bandopadhyay-d478f-397502.jpg'],
            ],
            'বিজ্ঞান' => [
                ['title' => 'আলো ও তড়িৎ চুম্বক', 'image' => 'https://rokbucket.rokomari.io/ProductNew20190903/260X372/4b3f8e8fa_212629.jpg'],
                ['title' => 'ক পদার্থবিজ্ঞান', 'image' => 'https://rokbucket.rokomari.io/ProductNew20190903/260X372/K_Padarthabigyan-Ratul_Khan-01ad3-226456.jpg'],
				['title' => 'আলো ও তড়িৎ চুম্বক', 'image' => 'https://rokbucket.rokomari.io/ProductNew20190903/260X372/4b3f8e8fa_212629.jpg'],
                ['title' => 'ক পদার্থবিজ্ঞান', 'image' => 'https://rokbucket.rokomari.io/ProductNew20190903/260X372/K_Padarthabigyan-Ratul_Khan-01ad3-226456.jpg'],
            ],
            'ইতিহাস' => [
                ['title' => 'বাংলাদেশের মুক্তিযুদ্ধ', 'image' => 'https://rokbucket.rokomari.io/ProductNew20190903/130X186/Bangladesher_Muktijuddo-Rofiquzzaman_Humayun_-7de21-23325.jpg'],
                ['title' => 'প্রাচীন সভ্যতা সিরিজ: মিসর', 'image' => 'https://rokbucket.rokomari.io/ProductNew20190903/260X372/e2568383d_18166.jpg'],
				['title' => 'বাংলাদেশের মুক্তিযুদ্ধ', 'image' => 'https://rokbucket.rokomari.io/ProductNew20190903/130X186/Bangladesher_Muktijuddo-Rofiquzzaman_Humayun_-7de21-23325.jpg'],
                ['title' => 'প্রাচীন সভ্যতা সিরিজ: মিসর', 'image' => 'https://rokbucket.rokomari.io/ProductNew20190903/260X372/e2568383d_18166.jpg'],
            ],
            'প্রযুক্তি' => [
                ['title' => 'অ্যাডভান্সড জাভা প্রোগ্রামিং', 'image' => 'https://rokbucket.rokomari.io/ProductNew20190903/260X372/7a1b316b2_179965.jpg'],
                ['title' => 'ডেটাবেজ ডিজাইন', 'image' => 'https://rokbucket.rokomari.io/ProductNew20190903/130X186/Database_Design_for_Mere_Mortals-Michael_J_Hernandez-a889f-438316.jpg'],
				['title' => 'অ্যাডভান্সড জাভা প্রোগ্রামিং', 'image' => 'https://rokbucket.rokomari.io/ProductNew20190903/260X372/7a1b316b2_179965.jpg'],
                ['title' => 'ডেটাবেজ ডিজাইন', 'image' => 'https://rokbucket.rokomari.io/ProductNew20190903/130X186/Database_Design_for_Mere_Mortals-Michael_J_Hernandez-a889f-438316.jpg'],
            ],
            'কবিতা' => [
                ['title' => 'রবীন্দ্র কবিতা কানন', 'image' => 'https://rokbucket.rokomari.io/ProductNew20190903/260X372/Rabindronath_Kobita_kanon-Suryakant_Tripathi_Nirala-ad9b1-380526.jpg'],
                ['title' => 'নহলীকাব্য', 'image' => 'https://rokbucket.rokomari.io/ProductNew20190903/260X372/d93a14e0e_185716.jpg'],
				['title' => 'রবীন্দ্র কবিতা কানন', 'image' => 'https://rokbucket.rokomari.io/ProductNew20190903/260X372/Rabindronath_Kobita_kanon-Suryakant_Tripathi_Nirala-ad9b1-380526.jpg'],
                ['title' => 'নহলীকাব্য', 'image' => 'https://rokbucket.rokomari.io/ProductNew20190903/260X372/d93a14e0e_185716.jpg'],
            ],
            'ধর্ম' => [
                ['title' => 'ছোটদের ইসলামী গল্প সমগ্র', 'image' => 'https://rokbucket.rokomari.io/ProductNew20190903/260X372/160d8dff9f84_137659.jpg'],
                ['title' => 'প্রশ্নোত্তরে সীরাতে খাতামুল আম্বিয়া', 'image' => 'https://rokbucket.rokomari.io/ProductNew20190903/260X372/Proshnottore_Sirate_Khatamul_Amibiya-Mufti_Shofi_Saheb_Rh-f9a49-396947.png'],
				['title' => 'ছোটদের ইসলামী গল্প সমগ্র', 'image' => 'https://rokbucket.rokomari.io/ProductNew20190903/260X372/160d8dff9f84_137659.jpg'],
                ['title' => 'প্রশ্নোত্তরে সীরাতে খাতামুল আম্বিয়া', 'image' => 'https://rokbucket.rokomari.io/ProductNew20190903/260X372/Proshnottore_Sirate_Khatamul_Amibiya-Mufti_Shofi_Saheb_Rh-f9a49-396947.png'],
            ],
        ];

        $books = [];
        foreach ($dummyBooks as $categoryName => $bookList) {
            $category = Category::where('name', $categoryName)->first();
            foreach ($bookList as $book) {
                $books[] = Book::create([
                    'user_id' => $users[array_rand($users)]->id,
                    'category_id' => $category->id,
                    'title' => $book['title'],
                    'description' => $faker->sentence(),
                    'photo_path' => $book['image'],
                ]);
            }
        }

        // Create dummy swaps
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
