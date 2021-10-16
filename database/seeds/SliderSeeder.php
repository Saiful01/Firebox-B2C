<?php

use App\PromotionalSlider;
use App\Slider;
use Illuminate\Database\Seeder;

class SliderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        //brand create
        \App\Brand::create([
            'brand_name' => "Aarong"
        ]);
        \App\Brand::create([
            'brand_name' => "Hatil"
        ]);
        \App\Brand::create([
            'brand_name' => "Pran"
        ]);
        \App\Brand::create([
            'brand_name' => "RFL"
        ]);



        //slider create
        Slider::create([
            'slider_image' => "/images/slider_image/1.jpg",
            'slider_title' => "Welcome to Mart Venue"
        ]);
        Slider::create([
            'slider_image' => "/images/slider_image/2.jpg",
            'slider_title' => "Welcome to Mart Venue"
        ]);


        //Banner Section

        PromotionalSlider::create([
            'section_id' => 1,
            'slider_image' => "/images/promotional_slider/1.jpg",
            'slider_mobile_image' => "/images/promotional_slider/1.jpg",
            'slider_title' => "Welcome to Mart Venue"
        ]);

        PromotionalSlider::create([
            'section_id' => 1,
            'slider_image' => "/images/promotional_slider/2.jpg",
            'slider_mobile_image' => "/images/promotional_slider/2.jpg",
            'slider_title' => "Welcome to Mart Venue"
        ]);

        //Full bannner

        PromotionalSlider::create([
            'section_id' => 2,
            'slider_image' => "/images/promotional_slider/3.jpg",
            'slider_mobile_image' => "/images/promotional_slider/3.jpg",
            'slider_title' => "Welcome to Mart Venue"
        ]);

        //Half bannner

        PromotionalSlider::create([
            'section_id' => 3,
            'slider_image' => "/images/promotional_slider/4.jpg",
            'slider_mobile_image' => "/images/promotional_slider/4.jpg",
            'slider_title' => "Welcome to Mart Venue"
        ]);

        PromotionalSlider::create([
            'section_id' => 3,
            'slider_image' => "/images/promotional_slider/5.jpg",
            'slider_mobile_image' => "/images/promotional_slider/5.jpg",
            'slider_title' => "Welcome to Mart Venue"
        ]);


    }
}
