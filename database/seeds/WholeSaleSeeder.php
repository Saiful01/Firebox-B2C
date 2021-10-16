<?php

namespace Database\Seeders;

use App\WholeSale;
use App\WholeSaleCategory;
use App\WholeSalePriceRange;
use App\WholesSaleSubCategory;
use Illuminate\Database\Seeder;

class WholeSaleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        WholeSaleCategory::create([
            'category_name_en' => "Sharee",
            'category_name_bn' => "শাড়ি",
            'category_image' => "/images/whole_sales/category/1.jpg",
        ]);
        WholeSaleCategory::create([
            'category_name_en' => "Lungee",
            'category_name_bn' => "লুঙ্গি",
            'category_image' => "/images/whole_sales/category/2.jpg",
        ]);

        WholeSaleCategory::create([
            'category_name_en' => "Gamcha",
            'category_name_bn' => "গামছা",
            'category_image' => "/images/whole_sales/category/3.jpg",
        ]);

        WholeSaleCategory::create([
            'category_name_en' => "Three Piece",
            'category_name_bn' => "থ্রি পিস",
            'category_image' => "/images/whole_sales/category/4.jpg",
        ]);

        WholeSaleCategory::create([
            'category_name_en' => "Dhuti",
            'category_name_bn' => "ধুতি",
            'category_image' => "/images/whole_sales/category/5.jpg",
        ]);


        // Sub Category
        WholesSaleSubCategory::create([
            'sub_category_name_en' => "Cotton sharee",
            'sub_category_name_bn' => "কটন শাড়ি",
            'category_id' => 1,
            'featured_image' => "/images/whole_sales/category/1.jpg",
        ]);

        WholesSaleSubCategory::create([
            'sub_category_name_en' => "Silk sharee",
            'sub_category_name_bn' => "সিল্ক শাড়ি",
            'category_id' => 1,
            'featured_image' => "/images/whole_sales/category/1.jpg",
        ]);
        WholesSaleSubCategory::create([
            'sub_category_name_en' => "Jamdani sharee",
            'sub_category_name_bn' => "জামদানী শাড়ী",
            'category_id' => 1,
            'featured_image' => "/images/whole_sales/category/1.jpg",
        ]);

        WholesSaleSubCategory::create([
            'sub_category_name_en' => "Cotton Lungee",
            'sub_category_name_bn' => "কটন লুঙ্গি",
            'category_id' => 2,
            'featured_image' => "/images/whole_sales/category/2.jpg",
        ]);

        WholesSaleSubCategory::create([
            'sub_category_name_en' => "Silk Lungee",
            'sub_category_name_bn' => "সিল্ক লুঙ্গি",
            'category_id' => 2,
            'featured_image' => "/images/whole_sales/category/2.jpg",
        ]);


        //product Seeder

        for ($i = 1; $i <= 8; $i++) {
            WholeSale::create([
                'product_name' => "Cotton Table Mat Set with Runner - Black",
                'product_details' => "<p> Brand: Pureit.
                                    Classic device water purifier.
                                    Color: Blue.
                                    Height: 61cm.
                                    Width: 29cm.
                                    Depth: 26cm.
                                    The total capacity is 23 Litres.
                                    Purified storage capacity is 9 liters.
                                    </p>",

                'qr_code' => "1852555",
                'height' => "12",
                'length' => "12",
                'length_class' => "2",
                'height_class' => "2",
                'featured_image' => "/images/product/8.jpg",
                'category_id' => "1",
                'sub_category_id' => "1",
                'shop_id' => "1",
                'is_featured' => true,
                'is_active' => true,
                'product_type' => "1",
            ]);

            WholeSalePriceRange::create([
                'min_quantity' => 1,
                'max_quantity' => 5,
                'price' => 500,
                'whole_sales_product_id' => $i,
            ]);

            WholeSalePriceRange::create([
                'min_quantity' => 6,
                'max_quantity' => 10,
                'price' => 480,
                'whole_sales_product_id' => $i,
            ]);

            WholeSalePriceRange::create([
                'min_quantity' => 11,
                'max_quantity' => 20,
                'price' => 450,
                'whole_sales_product_id' => $i,
            ]);

        }


    }
}
