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
            'Shahriar Fahim', 'Nayem Islam', 'Sakib Ahmed', 'Rifat Hossain',
            'Arif Khan', 'Sajid Rahman', 'Touhid Islam', 'Rakib Hasan',
            'Nahid Ahmed', 'Sabbir Khan', 'Rony Islam', 'Fahim Rahman'
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
                'department' => $faker->randomElement(['CSE', 'EEE', 'BBA', 'Pharmacy', 'Civil Engineering', 'Mechanical Engineering', 'Economics', 'English', 'Bangla', 'Physics', 'Chemistry', 'Mathematics', 'Business Administration', 'Marketing', 'Finance']),
                'year' => $faker->randomElement(['1st', '2nd', '3rd', '4th']),
                'email' => Str::slug($name) . '@example.com',
                'password' => Hash::make('password'),
            ]);
        }

        // Categories
        $categoryNames = [
            'উপন্যাস', 'বিজ্ঞান', 'ইতিহাস', 'প্রযুক্তি', 'কবিতা', 'ধর্ম',
            'গল্প', 'নাটক', 'ভ্রমণ', 'জীবনী', 'দর্শন', 'শিক্ষা', 'চিকিৎসা', 'কৃষি'
        ];
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
                ['title' => 'গোরা', 'image' => 'https://rokbucket.rokomari.io/ProductNew20190903/260X372/Gora-Rabindranath_Tagore-8a1b2-123456.jpg'],
                ['title' => 'চোখের বালি', 'image' => 'https://rokbucket.rokomari.io/ProductNew20190903/260X372/Chokher_Bali-Rabindranath_Tagore-9b2c3-234567.jpg'],
                ['title' => 'নৌকাডুবি', 'image' => 'https://rokbucket.rokomari.io/ProductNew20190903/260X372/Noukadubi-Rabindranath_Tagore-1c3d4-345678.jpg'],
                ['title' => 'কৃষ্ণকান্তের উইল', 'image' => 'https://rokbucket.rokomari.io/ProductNew20190903/260X372/Krishnakanta_Will-Bankim_Chandra_Chattopadhyay-2d4e5-456789.jpg'],
                ['title' => 'আনন্দমঠ', 'image' => 'https://rokbucket.rokomari.io/ProductNew20190903/260X372/Anandamath-Bankim_Chandra_Chattopadhyay-3e5f6-567890.jpg'],
            ],
            'বিজ্ঞান' => [
                ['title' => 'আলো ও তড়িৎ চুম্বক', 'image' => 'https://rokbucket.rokomari.io/ProductNew20190903/260X372/4b3f8e8fa_212629.jpg'],
                ['title' => 'ক পদার্থবিজ্ঞান', 'image' => 'https://rokbucket.rokomari.io/ProductNew20190903/260X372/K_Padarthabigyan-Ratul_Khan-01ad3-226456.jpg'],
                ['title' => 'জীববিজ্ঞান', 'image' => 'https://rokbucket.rokomari.io/ProductNew20190903/260X372/Jibabigyan-4f6g7-678901.jpg'],
                ['title' => 'রসায়ন বিজ্ঞান', 'image' => 'https://rokbucket.rokomari.io/ProductNew20190903/260X372/Rasayan_Bigyan-5g7h8-789012.jpg'],
                ['title' => 'গণিতের মজা', 'image' => 'https://rokbucket.rokomari.io/ProductNew20190903/260X372/Ganiter_Moja-6h8i9-890123.jpg'],
                ['title' => 'জ্যোতির্বিদ্যা', 'image' => 'https://rokbucket.rokomari.io/ProductNew20190903/260X372/Jyotirbigyan-7i9j0-901234.jpg'],
            ],
            'ইতিহাস' => [
                ['title' => 'বাংলাদেশের মুক্তিযুদ্ধ', 'image' => 'https://rokbucket.rokomari.io/ProductNew20190903/130X186/Bangladesher_Muktijuddo-Rofiquzzaman_Humayun_-7de21-23325.jpg'],
                ['title' => 'প্রাচীন সভ্যতা সিরিজ: মিসর', 'image' => 'https://rokbucket.rokomari.io/ProductNew20190903/260X372/e2568383d_18166.jpg'],
                ['title' => 'ভারতের স্বাধীনতা আন্দোলন', 'image' => 'https://rokbucket.rokomari.io/ProductNew20190903/260X372/Bharoter_Swadhinata-8j0k1-012345.jpg'],
                ['title' => 'মুঘল সাম্রাজ্যের ইতিহাস', 'image' => 'https://rokbucket.rokomari.io/ProductNew20190903/260X372/Mughal_Samrajya-9k1l2-123456.jpg'],
                ['title' => 'বাংলার নবজাগরণ', 'image' => 'https://rokbucket.rokomari.io/ProductNew20190903/260X372/Banglar_Nabajagaran-0l2m3-234567.jpg'],
            ],
            'প্রযুক্তি' => [
                ['title' => 'অ্যাডভান্সড জাভা প্রোগ্রামিং', 'image' => 'https://rokbucket.rokomari.io/ProductNew20190903/260X372/7a1b316b2_179965.jpg'],
                ['title' => 'ডেটাবেজ ডিজাইন', 'image' => 'https://rokbucket.rokomari.io/ProductNew20190903/130X186/Database_Design_for_Mere_Mortals-Michael_J_Hernandez-a889f-438316.jpg'],
                ['title' => 'পাইথন প্রোগ্রামিং', 'image' => 'https://rokbucket.rokomari.io/ProductNew20190903/260X372/Python_Programming-1m3n4-345678.jpg'],
                ['title' => 'ওয়েব ডেভেলপমেন্ট', 'image' => 'https://rokbucket.rokomari.io/ProductNew20190903/260X372/Web_Development-2n4o5-456789.jpg'],
                ['title' => 'মোবাইল অ্যাপ ডেভেলপমেন্ট', 'image' => 'https://rokbucket.rokomari.io/ProductNew20190903/260X372/Mobile_App_Dev-3o5p6-567890.jpg'],
                ['title' => 'সাইবার সিকিউরিটি', 'image' => 'https://rokbucket.rokomari.io/ProductNew20190903/260X372/Cyber_Security-4p6q7-678901.jpg'],
            ],
            'কবিতা' => [
                ['title' => 'রবীন্দ্র কবিতা কানন', 'image' => 'https://rokbucket.rokomari.io/ProductNew20190903/260X372/Rabindronath_Kobita_kanon-Suryakant_Tripathi_Nirala-ad9b1-380526.jpg'],
                ['title' => 'নহলীকাব্য', 'image' => 'https://rokbucket.rokomari.io/ProductNew20190903/260X372/d93a14e0e_185716.jpg'],
                ['title' => 'কাজী নজরুল ইসলামের কবিতা', 'image' => 'https://rokbucket.rokomari.io/ProductNew20190903/260X372/Nazrul_Kobita-5q7r8-789012.jpg'],
                ['title' => 'জসীমউদ্দীনের কবিতা', 'image' => 'https://rokbucket.rokomari.io/ProductNew20190903/260X372/Jasimuddin_Kobita-6r8s9-890123.jpg'],
                ['title' => 'সুকান্ত ভট্টাচার্যের কবিতা', 'image' => 'https://rokbucket.rokomari.io/ProductNew20190903/260X372/Sukanta_Kobita-7s9t0-901234.jpg'],
            ],
            'ধর্ম' => [
                ['title' => 'ছোটদের ইসলামী গল্প সমগ্র', 'image' => 'https://rokbucket.rokomari.io/ProductNew20190903/260X372/160d8dff9f84_137659.jpg'],
                ['title' => 'প্রশ্নোত্তরে সীরাতে খাতামুল আম্বিয়া', 'image' => 'https://rokbucket.rokomari.io/ProductNew20190903/260X372/Proshnottore_Sirate_Khatamul_Amibiya-Mufti_Shofi_Saheb_Rh-f9a49-396947.png'],
                ['title' => 'কুরআনের তাফসির', 'image' => 'https://rokbucket.rokomari.io/ProductNew20190903/260X372/Quran_Tafsir-8t0u1-012345.jpg'],
                ['title' => 'হাদিস সংগ্রহ', 'image' => 'https://rokbucket.rokomari.io/ProductNew20190903/260X372/Hadith_Sangraha-9u1v2-123456.jpg'],
            ],
            'গল্প' => [
                ['title' => 'রূপকথার গল্প', 'image' => 'https://rokbucket.rokomari.io/ProductNew20190903/260X372/Rupkothar_Golpo-0v2w3-234567.jpg'],
                ['title' => 'শিশুদের গল্প', 'image' => 'https://rokbucket.rokomari.io/ProductNew20190903/260X372/Shishuder_Golpo-1w3x4-345678.jpg'],
                ['title' => 'বাংলা লোকগল্প', 'image' => 'https://rokbucket.rokomari.io/ProductNew20190903/260X372/Bangla_Lokgolpo-2x4y5-456789.jpg'],
                ['title' => 'আধুনিক গল্প', 'image' => 'https://rokbucket.rokomari.io/ProductNew20190903/260X372/Adhunik_Golpo-3y5z6-567890.jpg'],
            ],
            'নাটক' => [
                ['title' => 'রবীন্দ্রনাথের নাটক', 'image' => 'https://rokbucket.rokomari.io/ProductNew20190903/260X372/Rabindranath_Natak-4z6a7-678901.jpg'],
                ['title' => 'দীনবন্ধু মিত্রের নাটক', 'image' => 'https://rokbucket.rokomari.io/ProductNew20190903/260X372/Dinabandhu_Natak-5a7b8-789012.jpg'],
                ['title' => 'আধুনিক বাংলা নাটক', 'image' => 'https://rokbucket.rokomari.io/ProductNew20190903/260X372/Adhunik_Bangla_Natak-6b8c9-890123.jpg'],
            ],
            'ভ্রমণ' => [
                ['title' => 'বাংলাদেশ ভ্রমণ', 'image' => 'https://rokbucket.rokomari.io/ProductNew20190903/260X372/Bangladesh_Bhromon-7c9d0-901234.jpg'],
                ['title' => 'ভারত ভ্রমণ', 'image' => 'https://rokbucket.rokomari.io/ProductNew20190903/260X372/Bharat_Bhromon-8d0e1-012345.jpg'],
                ['title' => 'বিশ্ব ভ্রমণ', 'image' => 'https://rokbucket.rokomari.io/ProductNew20190903/260X372/Bishwa_Bhromon-9e1f2-123456.jpg'],
            ],
            'জীবনী' => [
                ['title' => 'রবীন্দ্রনাথের জীবনী', 'image' => 'https://rokbucket.rokomari.io/ProductNew20190903/260X372/Rabindranath_Jiboni-0f2g3-234567.jpg'],
                ['title' => 'কাজী নজরুলের জীবনী', 'image' => 'https://rokbucket.rokomari.io/ProductNew20190903/260X372/Nazrul_Jiboni-1g3h4-345678.jpg'],
                ['title' => 'বঙ্গবন্ধুর জীবনী', 'image' => 'https://rokbucket.rokomari.io/ProductNew20190903/260X372/Bangabandhu_Jiboni-2h4i5-456789.jpg'],
            ],
            'দর্শন' => [
                ['title' => 'ভারতীয় দর্শন', 'image' => 'https://rokbucket.rokomari.io/ProductNew20190903/260X372/Bharatiya_Dorshon-3i5j6-567890.jpg'],
                ['title' => 'পাশ্চাত্য দর্শন', 'image' => 'https://rokbucket.rokomari.io/ProductNew20190903/260X372/Paschatya_Dorshon-4j6k7-678901.jpg'],
                ['title' => 'ইসলামী দর্শন', 'image' => 'https://rokbucket.rokomari.io/ProductNew20190903/260X372/Islami_Dorshon-5k7l8-789012.jpg'],
            ],
            'শিক্ষা' => [
                ['title' => 'শিক্ষা ব্যবস্থা', 'image' => 'https://rokbucket.rokomari.io/ProductNew20190903/260X372/Shikkha_Bebostha-6l8m9-890123.jpg'],
                ['title' => 'শিশু শিক্ষা', 'image' => 'https://rokbucket.rokomari.io/ProductNew20190903/260X372/Shishu_Shikkha-7m9n0-901234.jpg'],
                ['title' => 'উচ্চ শিক্ষা', 'image' => 'https://rokbucket.rokomari.io/ProductNew20190903/260X372/Unncho_Shikkha-8n0o1-012345.jpg'],
            ],
            'চিকিৎসা' => [
                ['title' => 'সাধারণ চিকিৎসা', 'image' => 'https://rokbucket.rokomari.io/ProductNew20190903/260X372/Sadharon_Chikitsa-9o1p2-123456.jpg'],
                ['title' => 'হোমিওপ্যাথি', 'image' => 'https://rokbucket.rokomari.io/ProductNew20190903/260X372/Homoeopathy-0p2q3-234567.jpg'],
                ['title' => 'আয়ুর্বেদ', 'image' => 'https://rokbucket.rokomari.io/ProductNew20190903/260X372/Ayurveda-1q3r4-345678.jpg'],
            ],
            'কৃষি' => [
                ['title' => 'আধুনিক কৃষি', 'image' => 'https://rokbucket.rokomari.io/ProductNew20190903/260X372/Adhunik_Krishi-2r4s5-456789.jpg'],
                ['title' => 'জৈব কৃষি', 'image' => 'https://rokbucket.rokomari.io/ProductNew20190903/260X372/Jaibo_Krishi-3s5t6-567890.jpg'],
                ['title' => 'ফল চাষ', 'image' => 'https://rokbucket.rokomari.io/ProductNew20190903/260X372/Fol_Chash-4t6u7-678901.jpg'],
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
        for ($i = 0; $i < 15; $i++) {
            $bookRequested = $books[array_rand($books)];
            $bookOffered = $books[array_rand($books)];
            $requester = $users[array_rand($users)];
            
            // Make sure the requester is not the owner of the requested book
            if ($bookRequested->user_id !== $requester->id && $bookOffered->user_id === $requester->id) {
                Swap::create([
                    'book_requested_id' => $bookRequested->id,
                    'book_offered_id' => $bookOffered->id,
                    'requester_id' => $requester->id,
                    'status' => $faker->randomElement(['pending', 'accepted', 'declined']),
                ]);
            }
        }
    }
}
