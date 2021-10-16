<?php

use App\Product;
use App\ProductImage;
use App\ProductReview;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Product::create([
            'product_name' => "Purina Go Cat Beef Chicken Liver",
            'product_details' => "<p>Grocery Terms & Conditions:
                                    1. Home delivery inside and outside Dhaka, from specific area shops to specific area.
                                    2. The customer will pay the bill if products Weight more than 10 Kgs.
                                    3. VAT Included with Price
                                   </p>",
            'product_specification' => "<p>Grocery Terms & Conditions:
                                    1. Home delivery inside and outside Dhaka, from specific area shops to specific area.
                                    2. The customer will pay the bill if products Weight more than 10 Kgs.
                                    3. VAT Included with Price
                                   </p>",
            'regular_price' => "2000",
            'selling_price' => "1800",
            'discount_rate' => "10",
            'qr_code' => "1852555",
            'weight' => "500gm",
            'featured_image' => "/images/product/8.jpg",
            'category_id' => 1,
            'sub_category_id' => 1,
            'parent_category_id' => 1,
            'shop_id' => "1",
            'is_featured' => true,

            'product_type' => "1",


        ]);


        Product::create([
            'product_name' => "Genuine leather passport cover",
            'product_details' => "<p>Grocery Terms & Conditions:
                                    1. Home delivery inside and outside Dhaka, from specific area shops to specific area.
                                    2. The customer will pay the bill if products Weight more than 10 Kgs.
                                    3. VAT Included with Price
                                   </p>",
            'product_specification' => "<p>Grocery Terms & Conditions:
                                    1. Home delivery inside and outside Dhaka, from specific area shops to specific area.
                                    2. The customer will pay the bill if products Weight more than 10 Kgs.
                                    3. VAT Included with Price
                                   </p>",
            'regular_price' => "416.50",
            'selling_price' => "400",
            'discount_rate' => "10",
            'qr_code' => "1852555",
            'weight' => "500gm",
            'featured_image' => "/images/product/8.jpg",
            'category_id' => 1,
            'sub_category_id' => 1,
            'parent_category_id' => 1,

            'shop_id' => 2,
            'is_featured' => true,
            'product_type' => "1",
        ]);
        Product::create([
            'product_name' => "Apple Silicon Series MacBook Pro 2020 Laptop -13.3 - 256GB PCIe-based SSD - 8GB Unified Memory",
            'product_details' => "<p>Grocery Terms & Conditions:
                                    1. Home delivery inside and outside Dhaka, from specific area shops to specific area.
                                    2. The customer will pay the bill if products Weight more than 10 Kgs.
                                    3. VAT Included with Price
                                   </p>",
            'product_specification' => "<p>Grocery Terms & Conditions:
                                    1. Home delivery inside and outside Dhaka, from specific area shops to specific area.
                                    2. The customer will pay the bill if products Weight more than 10 Kgs.
                                    3. VAT Included with Price
                                   </p>",
            'regular_price' => "15000",
            'selling_price' => "79000",
            'discount_rate' => "10",
            'qr_code' => "1852555",
            'weight' => "500gm",
            'featured_image' => "/images/product/8.jpg",
            'parent_category_id' => 1,
            'category_id' => "2",
            'sub_category_id' => 1,
            'shop_id' => "1",
            'is_featured' => true,
            'product_type' => "1",
        ]);
        Product::create([
            'product_name' => "Cotton Table Mat Set with Runner - Black",
            'product_details' => "দেশি Tangail Shari",
            'regular_price' => "1900",
            'selling_price' => "1700",
            'discount_rate' => "10",
            'qr_code' => "1852555",
            'weight' => "500gm",
            'featured_image' => "/images/product/8.jpg",
            'category_id' => 1,
            'sub_category_id' => 1,
            'parent_category_id' => 1,
            'shop_id' => "1",
            'is_featured' => true,
            'product_type' => "1",
        ]);

        Product::create([
            'product_name' => "Sky Lantern - 20 pcs - Multicolor",
            'product_details' => "দেশি Tangail Shari",
            'regular_price' => "3000",
            'selling_price' => "2500",
            'discount_rate' => "10",
            'qr_code' => "1852555",
            'weight' => "500gm",
            'featured_image' => "/images/product/8.jpg",
            'category_id' => 1,
            'sub_category_id' => 1,
            'parent_category_id' => 1,
            'shop_id' => "1",
            'is_featured' => true,
            'product_type' => "1",
        ]);

        Product::create([
            'product_name' => "Wood Pen Holder - Wooden",
            'product_details' => "দেশি Tangail Shari",
            'regular_price' => "350",
            'selling_price' => "320",
            'discount_rate' => "10",
            'qr_code' => "1852555",
            'weight' => "500gm",
            'featured_image' => "/images/product/8.jpg",
            'category_id' => 1,
            'sub_category_id' => 1,
            'parent_category_id' => 1,
            'shop_id' => "1",
            'is_featured' => true,
            'product_type' => "1",
        ]);
        Product::create([
            'product_name' => "Mi Wifi Repeter",
            'product_details' => "দেশি Tangail Shari",
            'regular_price' => "1560",
            'selling_price' => "1500",
            'discount_rate' => "10",
            'qr_code' => "1852555",
            'weight' => "500gm",
            'featured_image' => "/images/product/8.jpg",
            'category_id' => 1,
            'sub_category_id' => 1,
            'parent_category_id' => 1,
            'shop_id' => "1",
            'is_featured' => true,
            'product_type' => "1",
        ]);
        Product::create([
            'product_name' => "Pureit Classic MO5 Blue Water Purifier",
            'product_details' => "<p> Brand: Pureit.
                                    Classic device water purifier.
                                    Color: Blue.
                                    Height: 61cm.
                                    Width: 29cm.
                                    Depth: 26cm.
                                    The total capacity is 23 Litres.
                                    Purified storage capacity is 9 liters.
                                    </p>",
            'product_specification' => "<p> Brand: Pureit.
                                    Classic device water purifier.
                                    Color: Blue.
                                    Height: 61cm.
                                    Width: 29cm.
                                    Depth: 26cm.
                                    The total capacity is 23 Litres.
                                    Purified storage capacity is 9 liters.
                                    </p>",
            'regular_price' => "4000",
            'selling_price' => "3000",
            'discount_rate' => "20",
            'qr_code' => "185258555",
            'weight' => "500gm",
            'featured_image' => "/images/product/8.jpg",
            'category_id' => 1,
            'sub_category_id' => 1,
            'parent_category_id' => 1,
            'shop_id' => "1",
            'is_featured' => true,
            'product_type' => "1",
        ]);

        Product::create([
            'product_name' => "CURREN 8355 Silver Stainless Steel Chronograph Watch For Men",
            'product_details' => "<p>Product details of CURREN 8355 Silver Stainless Steel Chronograph Watch For Men - Royal Blue & Silver
                                        Brand : Curren
                                        Model Number : 8355
                                        Gender : Men
                                        Movement : Quartz
                                    </p>",
            'product_specification' => "<p> Product details of CURREN 8355 Silver Stainless Steel Chronograph Watch For Men - Royal Blue & Silver
                                            Brand : Curren
                                            Model Number : 8355
                                            Gender : Men
                                            Movement : Quartz
                                    </p>",
            'regular_price' => "4000",
            'selling_price' => "3000",
            'discount_rate' => "20",
            'qr_code' => "185258555",
            'weight' => "500gm",
            'featured_image' => "/images/product/6.jpg",
            'category_id' => 1,
            'sub_category_id' => 1,
            'parent_category_id' => 1,
            'shop_id' => "1",
            'is_featured' => true,
            'product_type' => "1",
        ]);
        Product::create([
            'product_name' => "Full Sleeve Casual Shirt for Men - TX007",
            'product_details' => "<p>Full Sleeve Casual Shirt.
Product Type: Men’s Shirt.
Material: 100% Cotton.
100% export quality.
Wash & Care: Machine Wash.
Comfortable and stylish.
Fit: Slim fit.
                                    </p>",
            'product_specification' => "<p> Full Sleeve Casual Shirt.
Product Type: Men’s Shirt.
Material: 100% Cotton.
100% export quality.
Wash & Care: Machine Wash.
Comfortable and stylish.
Fit: Slim fit.
                                    </p>",
            'regular_price' => "4000",
            'selling_price' => "3000",
            'discount_rate' => "20",
            'qr_code' => "185258555",
            'weight' => "500gm",
            'featured_image' => "/images/product/8.jpg",
            'category_id' => "4",
            'sub_category_id' => "4",
            'parent_category_id' => 2,
            'shop_id' => "1",
            'is_featured' => true,
            'product_type' => "1",
        ]);


        ProductReview::create([
            'score' => 3,
            'product_id' => 1,
            'customer_id' => 1,
            'comment' => "Review one",
        ]);
        ProductReview::create([
            'score' => 3,
            'product_id' => 1,
            'customer_id' => 1,
            'comment' => "Review two",
        ]);
        ProductReview::create([
            'score' => 3,
            'product_id' => 1,
            'customer_id' => 1,
            'comment' => "Review three",
        ]);


        ProductImage::create([
            'image' => "/images/product/2.png",
            'product_id' => 1,
        ]);

        ProductImage::create([
            'image' => "/images/product/6.jpg",
            'product_id' => 1,
        ]);

        \App\Size::create([
            'size_name' => "Small",
        ]);
        \App\Size::create([
            'size_name' => "Medium",
        ]);
        \App\Size::create([
            'size_name' => "Large",
        ]);
        \App\Size::create([
            'size_name' => "Xtra Large",
        ]);
        \App\Color::create([
            'color_name' => "সাদা",
        ]);
        \App\Color::create([
            'color_name' => "কালো",
        ]);
        \App\Color::create([
            'color_name' => "লাল",
        ]);
        \App\Color::create([
            'color_name' => "ছাই",
        ]);
        \App\Color::create([
            'color_name' => "কালো-সাদা",
        ]);
        \App\Color::create([
            'color_name' => "ছাই-সাদা",
        ]);
        \App\Color::create([
            'color_name' => "লাল-সাদা",
        ]);

    }


}
