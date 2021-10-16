app.controller('productController', function ($scope, $http, $location) {
    $scope.price = 0;
   /* $scope.product_quantity = 1;*/
    $scope.product_quantity = "1";

    //Search Filter Params
    $scope.product_color = 0;
    $scope.product_size = 0;
    $scope.product_rating = null;
    $scope.min_price = 0;
    $scope.max_price = 0;
    $scope.type = null;
    $scope.category_id = null;
    $scope.query = null;
    $scope.offer = 0;
    $scope.promo_value = 0;
    $scope.division_id = '1';
    $scope.coupone = 0;
    $scope.discount = 0;
    $scope.min_order_quantity = 1

    //Filter vars
    $scope.sort_by = "newest";


    $scope.requestData = function (url, params) {
        setTimeout(function () {
            $http.post(url, params).then(function success(e) {
                return e.data.result
            });
        }, 10);
    }
    $scope.addToCart2 = function (product, product_type) {

        let delivery_charge, deliverable_quantity, extra_delivery_charge, selling_price, product_id;
        if (product_type === "whole_sale") {
            delivery_charge = 0;
            deliverable_quantity = 0;
            extra_delivery_charge = 0;
            selling_price = 0;
            product_id = product.whole_sales_product_id;
        } else {
            delivery_charge = product['delivery_charge'];
            deliverable_quantity = product['deliverable_quantity'];
            extra_delivery_charge = product['extra_delivery_charge'];
            selling_price = product['selling_price'];
            product_id = product.product_id;
        }


        $http.post('/cart/add', {
            product_color: $scope.product_color,
            product_size: $scope.product_size,
            product_quantity: $scope.product_quantity,
            product_id: product_id,
            selling_price: selling_price,
            product_name: product.product_name,
            product_image: product.featured_image,
            delivery_charge: delivery_charge,
            deliverable_quantity: deliverable_quantity,
            extra_delivery_charge: extra_delivery_charge,
            product_type: product_type,
            shop_id: product.shop_id,
            shop_name: product.shop_name,
            minimum_order_quantity: product.minimum_order_quantity,

        }).then(function success(e) {

            console.log(e.data);
            Swal.fire({
                position: 'center',
                icon: 'success',
                title: 'Added to cart',
                showConfirmButton: false,
                timer: 1500
            })
            $scope.getTotalSet();
        });


    }


    $scope.buyNow = function (product, product_type) {

        let delivery_charge, deliverable_quantity, extra_delivery_charge, selling_price, product_id;
        if (product_type === "whole_sale") {
            delivery_charge = 0;
            deliverable_quantity = 0;
            extra_delivery_charge = 0;
            selling_price = 0;
            product_id = product.whole_sales_product_id;
        } else {
            delivery_charge = product['delivery_charge'];
            deliverable_quantity = product['deliverable_quantity'];
            extra_delivery_charge = product['extra_delivery_charge'];
            selling_price = product['selling_price'];
            product_id = product.product_id;
        }

        $http.post('/cart/add', {
            product_color: $scope.product_color,
            product_size: $scope.product_size,
            product_quantity: $scope.product_quantity,
            product_id: product_id,
            selling_price: selling_price,
            product_name: product.product_name,
            product_image: product.featured_image,
            delivery_charge: delivery_charge,
            deliverable_quantity: deliverable_quantity,
            extra_delivery_charge: extra_delivery_charge,
            product_type: product_type,
            shop_id: product.shop_id,
            shop_name: product.shop_name,

        }).then(function success(e) {

            window.location.href = '/cart';

            $scope.getTotalSet();
        });
    }

    $scope.decreaseQuantity = function () {
        if ($scope.product_quantity > $scope.min_order_quantity) {
            $scope.product_quantity = parseInt($scope.product_quantity) - 1;
        }
    }

    $scope.increaseQuantity = function () {
        $scope.product_quantity = parseInt($scope.product_quantity) + 1;
    }

    $scope.removeQuantity = function (row_id, quantity,minimum_order_quantity) {

        console.log("ffff");

        if (quantity > minimum_order_quantity) {
            $scope.product_quantity = quantity - 1;
            $http.post('/cart/update', {
                row_id: row_id,
                quantity: quantity - 1,
            }).then(function success(e) {
                console.log(e.data);
                $scope.getTotalSet();
            });
        }else{
            Swal.fire({
                position: 'center',
                icon: 'success',
                title: 'Minimum Order Quantity is: '+minimum_order_quantity,
                showConfirmButton: false,
                timer: 1500
            })
        }

    }

    $scope.addQuantity = function (row_id, quantity) {

        console.log(row_id);
        //return;
        //quantity=parseInt(quantity);
        $scope.quantity = parseInt(quantity) + 1;
        $http.post('/cart/update', {
            row_id: row_id,
            quantity: parseInt(quantity) + 1,

        }).then(function success(e) {

            console.log($scope.quantity);
            /*Swal.fire({
                position: 'center',
                icon: 'success',
                title: 'Added to cart',
                showConfirmButton: false,
                timer: 1500
            })*/
            $scope.getTotalSet();
        });

    }

    $scope.removeItem = function (id) {


        $http.post('/cart/remove/' + id, {}).then(function success(e) {

            console.log(e.data);

            $scope.getTotalSet();
        });

    }

    $scope.getTotalPrice = function () {

        let url = "/cart/get-total-price";
        let params = {};

        setTimeout(function () {
            $http.post(url, params).then(function success(e) {
                $scope.price = e.data.result
            });
        }, 10);
    }

    $scope.getTotalSet = function () {

        let url = "/cart/get-total-set";
        let params = {};
        $http.post(url, params).then(function success(e) {
            $scope.total_price = e.data.total_price;
            $scope.total_product = e.data.total_product
            $scope.total_products = e.data.total_products
            $scope.total_delivery_charge = e.data.total_delivery_charge
            $scope.grand_total = e.data.grand_total
            $scope.group_by_data = e.data.group_by_data
            $scope.coupon = e.data.coupon
            $scope.voucher = e.data.voucher

            console.log($scope.total_price);
            console.log($scope.total_products);
        });
    }


    $scope.getProducts = function (type, category_id, query, offer) {
        console.log("Get Initial product");
        $scope.category_id = category_id;
        $scope.type = type;
        $scope.query = query;
        $scope.offer = offer;
        console.log(type);

        let url = "/web-api/products";
        let params = {
            'category_id': category_id,
            'type': type,
            'sort_by': $scope.sort_by,
            'query': $scope.query,
            'offer': $scope.offer,
        };
        $http.post(url, params).then(function success(e) {

            $scope.product_list = e.data.results;
            $scope.min_price = 0;
            $scope.temp_max_price = 50000;
            $scope.max_price = 50000;
            console.log($scope.product_list);
        });
    }

    $scope.changePriceRange = function () {
        $scope.temp_max_price = $scope.price_range;
    }

    $scope.filterProduct = function () {

        $scope.temp_max_price = $scope.price_range;
        //$location.search('price_range', $scope.price_range);
        //$location.search('product_rating[]', $scope.product_rating);

        console.log($scope.category_id);
        console.log($scope.type);
        console.log($scope.product_rating);
        console.log($scope.price_range);
        console.log($scope.sort_by);
        console.log($scope.product_list);

        let url = "/web-api/products";
        let params = {
            'category_id': $scope.category_id,
            'type': $scope.type,
            'product_rating': $scope.product_rating,
            'price_range': $scope.price_range,
            'sort_by': $scope.sort_by,
            'query': $scope.query,
            'offer': $scope.offer,

        };
        $http.post(url, params).then(function success(e) {

            $scope.product_list = e.data.results;
            /*  $scope.min_price = 7;
              $scope.max_price = 66666;*/
            console.log($scope.product_list);
        });
    }

    $scope.getTotalPrice();
    $scope.getTotalSet();

    //Shop product
    $scope.getShopsProduct = function (shop_id) {
        let url = "/web-api/shop-products";
        $scope.shop_id = shop_id;
        let params = {
            'shop_id': shop_id,
            'sort_by': $scope.sort_by,
        };
        $http.post(url, params).then(function success(e) {

            $scope.retail_product_list = e.data.retail_product_list;
            $scope.whole_sale_product_list = e.data.whole_sale_product_list;

            console.log($scope.retail_product_list);
        });
    }

    $scope.getFilteredShopsProduct = function () {
        console.log($scope.shop_id);
        console.log($scope.sort_by);
        let url = "/web-api/shop-products";
        let params = {
            'shop_id': $scope.shop_id,
            'sort_by': $scope.sort_by,
        };
        $http.post(url, params).then(function success(e) {

            $scope.retail_product_list = e.data.retail_product_list;
            $scope.whole_sale_product_list = e.data.whole_sale_product_list;
            console.log($scope.retail_product_list);
        });
    }


    // whole sale product


    $scope.getWholeSaleProducts = function (type, category_id, query) {
        $scope.category_id = category_id;
        $scope.type = type;
        $scope.query = query;

        let url = "/web-api/whole-sale/products";
        let params = {
            'category_id': category_id,
            'type': type,
            'sort_by': $scope.sort_by,
            'query': $scope.query,
        };
        $http.post(url, params).then(function success(e) {

            $scope.product_list = e.data.results;
            $scope.min_price = 0;
            $scope.temp_max_price = 50000;
            $scope.max_price = 50000;
        });
    }

    $scope.changePriceRange = function () {
        $scope.temp_max_price = $scope.price_range;
    }

    $scope.filterWholeSaleProducts = function () {

        $scope.temp_max_price = $scope.price_range;
        //$location.search('price_range', $scope.price_range);
        //$location.search('product_rating[]', $scope.product_rating);
        console.log($scope.price_range);
        console.log($scope.product_rating);
        console.log($scope.product_list);
        console.log($scope.category_id);
        console.log($scope.type);
        console.log($scope.sort_by);
        console.log($scope.query);

        let url = "/web-api/whole-sale/products";
        let params = {
            'category_id': $scope.category_id,
            'type': $scope.type,
            'product_rating': $scope.product_rating,
            'price_range': $scope.price_range,
            'sort_by': $scope.sort_by,
            'query': $scope.query,
        };
        $http.post(url, params).then(function success(e) {

            $scope.product_list = e.data.results;
            /*  $scope.min_price = 7;
              $scope.max_price = 66666;*/
            console.log($scope.product_list);
        });
    }


    //OTP verify

    $scope.startCounter = function (time) {
        document.getElementById("otp_counter").style.display = "block";
        document.getElementById("otp_button").style.display = "none";

        var sec = time;
        setInterval(function () {
            document.getElementById("timer").innerHTML = sec;
            sec--;
            if (sec == 0) {

                document.getElementById("otp_counter").style.display = "none";
                document.getElementById("otp_button").style.display = "block";
            }
        }, 1000);
    }


    $scope.sendOtp = function () {

        console.log($scope.phone_number);
        let url = "/api/v1/customer/create-account/generate-otp";
        let params = {
            'phone_number': $scope.phone_number,
        };
        $http.post(url, params).then(function success(e) {
            console.log("Success" + e.data);
            if (e.data.status_code == 200) {
                $scope.startCounter(e.data.timer);
                console.log(e.data);
            } else {
                Swal.fire({
                    position: 'center',
                    icon: 'error',
                    title: e.data.message,
                    showConfirmButton: false,
                    timer: 2500
                })
            }
        });
    }

    $scope.passResetOtpSend = function () {

        console.log($scope.phone_number);
        let url = "/api/merchant/reset-pass/otp";
        let params = {
            'phone': $scope.phone_number,
        };
        $http.post(url, params).then(function success(e) {
            console.log("Success" + e.data);
            if (e.data.status_code == 200) {
                $scope.startCounter(e.data.timer);
            } else {
                Swal.fire({
                    position: 'center',
                    icon: 'error',
                    title: e.data.message,
                    showConfirmButton: false,
                    timer: 2500
                })
            }
        });
    }

    $scope.customerRegistration = function () {

        let url = "/customer/register";
        let params = {
            'customer_name': $scope.customer_name,
            'customer_phone': $scope.phone_number,
            'otp': $scope.otp,
            'customer_password': $scope.customer_password,
        };
        $http.post(url, params).then(function success(e) {

            if (e.data.status_code == 200) {
                console.log("Success" + e.data.message);
                Swal.fire({
                    position: 'center',
                    icon: 'error',
                    title: e.data.message,
                    showConfirmButton: false,
                    timer: 2500
                })

                window.location.href = "/";
            } else {
                Swal.fire({
                    position: 'center',
                    icon: 'error',
                    title: e.data.message,
                    showConfirmButton: false,
                    timer: 2500
                })
            }
        });
    }

    $scope.productSizeInitialize = function (product_size) {

        $scope.product_size = product_size;
    }
    $scope.productColorInitialize = function (product_color) {

        $scope.product_color = product_color;
    }


    $scope.promoCode = function () {

        let url = "/web-api/promo-code";
        let params = {
            'coupon_code': $scope.coupon_code,
        };
        $http.post(url, params).then(function success(e) {

            if (e.data.status_code == 200) {

                $scope.promo_value = e.data.results.discount_rate;
                $scope.coupon_code = e.data.results.coupon_code;
                console.log("Success" + e.data.results.discount_rate);
                $scope.getTotalSet();
            } else {
                Swal.fire({
                    position: 'center',
                    icon: 'error',
                    title: e.data.message,
                    showConfirmButton: false,
                    timer: 2500
                })
            }
        });
    }

    //Division, District Change Event
    $scope.changeDivision = function () {
        let url = "/web-api/get-district";
        let params = {
            'division_id': $scope.division_id
        };
        $http.post(url, params).then(function success(e) {

            if (e.data.status_code == 200) {
                $scope.district_list = e.data.results;
                console.log($scope.district_list)
            }
        });


    }
    $scope.changeDistrict = function () {

        let url = "/web-api/get-upazila";
        let params = {
            'district_id': $scope.district_id
        };
        $http.post(url, params).then(function success(e) {
            if (e.data.status_code == 200) {
                $scope.upazila_list = e.data.results;
                console.log($scope.upazila_list)
            }
        });
    }

    $scope.getDivisions = function () {
        $scope.division_id = 1;
        let url = "/web-api/get-division";
        let params = {};
        $http.post(url, params).then(function success(e) {
            if (e.data.status_code == 200) {
                $scope.division_list = e.data.results;
                console.log($scope.division_list)
            }
        });
    }


    $scope.setMinOrderQuanity = function (qnt) {
        $scope.min_order_quantity = qnt;
    };
    $scope.minimumOrderQuantity = function (qnt) {
        $scope.product_quantity = qnt;
        $scope.setMinOrderQuanity(qnt);
    };

    $scope.changeQuantityFromInput = function (minimum_order_quantity) {

        console.log("Up"+$scope.product_quantity+"==="+minimum_order_quantity);
        //$scope.product_quantity ;
        if($scope.product_quantity<minimum_order_quantity){
            $scope.product_quantity = minimum_order_quantity;
            Swal.fire({
                position: 'center',
                icon: 'success',
                title: 'Min Order Quantity is: '+minimum_order_quantity,
                showConfirmButton: false,
                timer: 1500
            })

        }
    };

    $scope.changeQuantityFromCartInput = function (order, product_quantity) {

        console.log("Up"+product_quantity+"==="+order.options.minimum_order_quantity);
        //$scope.product_quantity ;
        if(product_quantity>order.options.minimum_order_quantity){

        }else{
            Swal.fire({
                position: 'center',
                icon: 'success',
                title: 'Min Order Quantity is: '+order.options.minimum_order_quantity,
                showConfirmButton: false,
                timer: 1500
            })

        }
    };


});

