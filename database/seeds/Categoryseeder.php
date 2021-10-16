<?php

use App\ParentCategory;
use App\ProductCategory;
use App\SubCategory;
use Illuminate\Database\Seeder;

class Categoryseeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        ParentCategory::create([
            'parent_category_name_en' => "Mobile",
            'parent_category_name_bn' => "মোবাইল",
            'featured_image' => "/images/parent_category/1.jpg",
        ]);
        ParentCategory::create([
            'parent_category_name_en' => "Men",
            'parent_category_name_bn' => "পুরুষ",
            'featured_image' => "/images/parent_category/2.jpg",
        ]);
        ParentCategory::create([
            'parent_category_name_en' => "Women",
            'parent_category_name_bn' => "মহিলা",
            'featured_image' => "/images/parent_category/3.jpg",
        ]);

        ProductCategory::create([
            'category_name_en' => "Smart phone",
            'parent_category_id' => '1',
            'is_whole_sales' => '1',
            'category_name_bn' => "স্মার্ট ফোন",
            'category_image' => "/images/category/1.jpg",
        ]);
        ProductCategory::create([
            'category_name_en' => "Normal phone",
            'parent_category_id' => '1',
            'is_whole_sales' => '1',
            'category_name_bn' => "সাধারণ ফোন",
            'category_image' => "/images/category/1.jpg",
        ]);
        ProductCategory::create([
            'category_name_en' => "Button phone",
            'parent_category_id' => '1',
            'is_whole_sales' => '1',
            'category_name_bn' => "বাটন ফোন",
            'category_image' => "/images/category/1.jpg",
        ]);
        ProductCategory::create([
            'category_name_en' => "Lungi",
            'parent_category_id' => '2',
            'is_whole_sales' => '1',
            'category_name_bn' => "লুঙ্গি",
            'category_image' => "/images/category/1.jpg",

        ]);
        ProductCategory::create([
            'category_name_en' => "Shari",
            'parent_category_id' => '3',
            'is_whole_sales' => '1',
            'category_name_bn' => "শাড়ি",
            'category_image' => "/images/category/1.jpg",
        ]);


        SubCategory::create([
            'sub_category_name_en' => "Walton",
            'sub_category_name_bn' => "ওয়ালটন",
            'is_whole_sales' => '1',
            'category_id' => '1',
            'featured_image' => "/images/category/1.jpg",

        ]);
        SubCategory::create([
            'sub_category_name_en' => "Samsang",
            'sub_category_name_bn' => "স্যামসাং",
            'is_whole_sales' => '1',
            'category_id' => '1',
            'featured_image' => "/images/category/2.jpg",

        ]);
        SubCategory::create([
            'sub_category_name_en' => "IPhone",
            'sub_category_name_bn' => "আইফোন",
            'is_whole_sales' => '1',
            'category_id' => '1',
            'featured_image' => "/images/category/1.jpg",

        ]);
        SubCategory::create([
            'category_id' => '2',
            'sub_category_name_en' => "Bashundhara lungi",
            'sub_category_name_bn' => "বসুন্ধরা লুঙ্গি",
            'featured_image' => "/images/category/1.jpg",

        ]);

        SubCategory::create([
            'sub_category_name_en' => "Walton",
            'sub_category_name_bn' => "ওয়ালটন",
            'is_whole_sales' => '1',
            'category_id' => '1',
            'featured_image' => "/images/category/1.jpg",

        ]);
        SubCategory::create([
            'sub_category_name_en' => "Samsang",
            'sub_category_name_bn' => "স্যামসাং",
            'is_whole_sales' => '1',
            'category_id' => '1',
            'featured_image' => "/images/category/2.jpg",

        ]);
        SubCategory::create([
            'sub_category_name_en' => "IPhone",
            'sub_category_name_bn' => "আইফোন",
            'is_whole_sales' => '1',
            'category_id' => '1',
            'featured_image' => "/images/category/1.jpg",

        ]);
        SubCategory::create([
            'category_id' => '2',
            'sub_category_name_en' => "Bashundhara lungi",
            'sub_category_name_bn' => "বসুন্ধরা লুঙ্গি",
            'featured_image' => "/images/category/1.jpg",

        ]);


        SubCategory::create([
            'sub_category_name_en' => "Walton",
            'sub_category_name_bn' => "ওয়ালটন",
            'is_whole_sales' => '1',
            'category_id' => '1',
            'featured_image' => "/images/category/1.jpg",

        ]);
        SubCategory::create([
            'sub_category_name_en' => "Samsang",
            'sub_category_name_bn' => "স্যামসাং",
            'is_whole_sales' => '1',
            'category_id' => '1',
            'featured_image' => "/images/category/2.jpg",

        ]);
        SubCategory::create([
            'sub_category_name_en' => "IPhone",
            'sub_category_name_bn' => "আইফোন",
            'is_whole_sales' => '1',
            'category_id' => '1',
            'featured_image' => "/images/category/1.jpg",

        ]);
        SubCategory::create([
            'category_id' => '2',
            'sub_category_name_en' => "Bashundhara lungi",
            'sub_category_name_bn' => "বসুন্ধরা লুঙ্গি",
            'featured_image' => "/images/category/1.jpg",

        ]);

        SubCategory::create([
            'sub_category_name_en' => "Walton",
            'sub_category_name_bn' => "ওয়ালটন",
            'is_whole_sales' => '1',
            'category_id' => '1',
            'featured_image' => "/images/category/1.jpg",

        ]);
        SubCategory::create([
            'sub_category_name_en' => "Samsang",
            'sub_category_name_bn' => "স্যামসাং",
            'is_whole_sales' => '1',
            'category_id' => '1',
            'featured_image' => "/images/category/2.jpg",

        ]);
        SubCategory::create([
            'sub_category_name_en' => "IPhone",
            'sub_category_name_bn' => "আইফোন",
            'is_whole_sales' => '1',
            'category_id' => '1',
            'featured_image' => "/images/category/1.jpg",

        ]);
        SubCategory::create([
            'category_id' => '2',
            'sub_category_name_en' => "Bashundhara lungi",
            'sub_category_name_bn' => "বসুন্ধরা লুঙ্গি",
            'featured_image' => "/images/category/1.jpg",

        ]);

    }
}
