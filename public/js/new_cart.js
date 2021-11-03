let app = angular.module('ecomApp', []);
app.controller('shoppingController', function ($scope, $http, $location) {

    $scope.cart_products = [];
    $scope.delivery_charge = 80;
    $scope.coupon_code = "";
    $scope.size = "";
    $scope.color = "";
    $scope.coupon_value = 0;
    $scope.quantity = 1;
    $scope.customer_address_type = "Home";
    $scope.addToCart = function (item) {
        let flag = false;
        let tempProduct = {
            "product_id": item.product_id,
            "product_name": item.product_name,
            "selling_price": item.selling_price,
            "featured_image": item.featured_image,
            "shop_id": item.shop_id,
            "quantity": $scope.quantity,
            "qr_code": item.qr_code,
            "size": $scope.size,
            "color": $scope.color,

        };
        let cartProductList = localStorage.getItem('cart_product');
        if (cartProductList !== null && cartProductList !== undefined) {
            cartProductList = JSON.parse(cartProductList);

            if (cartProductList.length <= 0) {
                //Nothing
            } else {
                for (var cartProduct of cartProductList) {
                    if (cartProduct.product_id === item.product_id) {
                        cartProduct.quantity += 1;
                        flag = true;
                        break;
                    }
                }
            }
        } else {
            cartProductList = [];
        }

        if (!flag) {
            cartProductList.push(tempProduct);
            messageSuccess("Product added to cart")
        } else {
            messageSuccess("Product added to cart")
        }
        localStorage.setItem('cart_product', JSON.stringify(cartProductList));
        $scope.getTotalPrice();
        $scope.getList();
    }


    $scope.getTotalPrice = function () {

        let cartProductList = localStorage.getItem('cart_product');
        let totalPrice = 0;
        if (cartProductList !== null && cartProductList !== undefined) {
            cartProductList = JSON.parse(cartProductList);
            for (var cartProduct of cartProductList) {
                totalPrice = totalPrice + parseInt(cartProduct.selling_price) * parseInt(cartProduct.quantity);
            }
        }
        $scope.totalPriceCountAll = totalPrice;

    };

    $scope.getList = function () {
        let cartProductList = localStorage.getItem('cart_product');
        if (cartProductList !== null && cartProductList !== undefined) {
            cartProductList = JSON.parse(cartProductList);
            $scope.cart_products = cartProductList;
            $scope.cartActive = true;
            $scope.total_item = cartProductList.length;

        }
    };

    $scope.deleteItem = function (item) {
        let cartProductList = localStorage.getItem('cart_product');
        if (cartProductList != null && cartProductList !== undefined) {
            cartProductList = JSON.parse(cartProductList);
            for (let i = 0; i < cartProductList.length; i++) {
                if (cartProductList[i].product_id === item.product_id) {
                    cartProductList.splice(i, 1);
                    break;
                }
            }
            localStorage.setItem('cart_product', JSON.stringify(cartProductList));
        }
        $scope.getTotalPrice();
        $scope.getList();
    };

    $scope.dIncQty = function () {
        $scope.quantity = $scope.quantity + 1;
    }
    $scope.dDecQty = function () {
        if ($scope.quantity > 1) {
            $scope.quantity = $scope.quantity - 1;
        }

    }

    $scope.incQty = function (item) {
        let cartProductList = localStorage.getItem('cart_product');
        if (cartProductList != null && cartProductList !== undefined) {
            cartProductList = JSON.parse(cartProductList);
            for (let i = 0; i < cartProductList.length; i++) {
                if (cartProductList[i].product_id === item.product_id) {
                    cartProductList[i].quantity += 1;
                    break;
                }
            }
            localStorage.setItem('cart_product', JSON.stringify(cartProductList));
        }
        $scope.getTotalPrice();
        $scope.getList();
    };

    $scope.decQty = function (item) {

        let cartProductList = localStorage.getItem('cart_product');
        if (cartProductList != null && cartProductList !== undefined) {
            cartProductList = JSON.parse(cartProductList);
            for (let i = 0; i < cartProductList.length; i++) {
                if (cartProductList[i].product_id === item.product_id) {
                    if (cartProductList[i].quantity <= 1) {
                        messageError("Cant remove items", 'error');
                        break;
                    } else {
                        cartProductList[i].quantity -= 1;
                    }
                    break;
                }
            }
            localStorage.setItem('cart_product', JSON.stringify(cartProductList));
        }

        $scope.cartRemove = function () {
            localStorage.clear();
            $scope.getTotalPrice();
            $scope.getList();
        }
        $scope.getTotalPrice();
        $scope.getList();

    };

    $scope.couponApply = function () {

        if ($scope.coupon_code != null) {
            $http.post('/web-api/promo-code', {coupon_code: $scope.coupon_code}).then(function (response) {
                console.log(response.data);
                if (response.data.status_code == 200) {
                    $scope.coupon_value = response.data.results.discount_rate;
                    messageSuccess("Coupon is Applied");
                } else {
                    messageError("Coupon is expired or Invalid");
                }
            }, function (response) {

                console.log(response);
            });
        } else {
            messageError("Please input a coupon code");
        }
    };
    $scope.loginCheck = function () {
        $http.post('/web-api/login', {
            phone: $scope.phone,
            password: $scope.password,
        }).then(function (response) {
            if (response.data.status_code == 200) {
                messageSuccess(response.data.message);
                window.location.href = '/customer/profile';
            } else {
                messageError(response.data.message);
            }
        }, function (response) {
            //error
            console.log(response);
        });
    };
    $scope.subscribe = function () {
        $http.post('/web-api/subscribe', {
            email: $scope.email,
        }).then(function (response) {
            if (response.data.status_code == 200) {
                $scope.email = "";
                messageSuccess(response.data.message);
            } else {
                messageError(response.data.message);
            }
        }, function (response) {
            //error
            console.log(response);
        });
    };

    $scope.saveOrder = function () {

        let empty_status = false;

        if ($scope.customer_phone == null) {
            empty_status = true;
            messageError("Please fill all the fields")
            return;
        }
        if ($scope.customer_email == null) {
            empty_status = true;
            messageError("Please fill all the fields")
            return;
        }

        if ($scope.customer_name == null) {
            empty_status = true;
            messageError("Please fill all the fields")
            return;
        }
        if ($scope.customer_address == null) {
            empty_status = true;
            messageError("Please fill all the fields")
            return;
        }
        /*if (empty_status == true) {
           // messageError("Please fill all the fields")
           return;
            return;
        }*/

        let cartProductList = localStorage.getItem('cart_product');
        cartProductList = JSON.parse(cartProductList);
        console.log(cartProductList.length);
        if (cartProductList.length <= 0) {
            messageError("Add an Item")
            return;
        } else {
            $scope.cart_products = cartProductList;
        }

/*        if($scope.payment_type=="Online"){
            console.log("Online");
            //window.location.href = '/customer/order-save';
            let customer_data = {
                customer_name: $scope.customer_name,
                customer_phone: $scope.customer_phone,
                customer_email: $scope.customer_email,
                customer_password: $scope.customer_password,
                customer_address: $scope.customer_address,
                delivery_charge: $scope.delivery_charge,
                coupon_value: $scope.coupon_value,
                coupon_code: $scope.coupon_code,
                products: $scope.cart_products,
                payment_type: $scope.payment_type,
            }
            localStorage.setItem('customer_data',JSON.stringify(customer_data));

            let data=JSON.parse(localStorage.getItem('customer_data'));
            console.log( data.customer_name);
            window.location.href = '/customer/order-save';

        }
       // return;*/

        $http.post('/customer/order-save', {
            customer_name: $scope.customer_name,
            customer_phone: $scope.customer_phone,
            customer_email: $scope.customer_email,
            customer_password: $scope.customer_password,
            customer_address: $scope.customer_address,
            delivery_charge: $scope.delivery_charge,
            coupon_value: $scope.coupon_value,
            coupon_code: $scope.coupon_code,
            products: $scope.cart_products,
            payment_type: $scope.payment_type,

        }).then(function (response) {

            if (response.data.status_code == 200) {
                messageSuccess("Successfully Order Saved");
                localStorage.clear();
                window.location.href = '/success/'+response.data.order_invoice;

            } else {
                messageSuccess(response.data.message)
            }
        }, function (response) {
            messageSuccess("Unknown Error")
        });

    };

    function messageError(message) {
        Swal.fire({
            position: 'center',
            icon: 'error',
            title:message,
            showConfirmButton: false,
            timer: 1500
        })

        //toastr.warning(message, 'Failed')
    }

    function messageSuccess(message) {
        Swal.fire({
            position: 'center',
            icon: 'success',
            title: 'Added to cart',
            showConfirmButton: false,
            timer: 1500
        })

       // toastr.success(message, 'Success')
    }


    $scope.getTotalPrice();
    $scope.getList();

    $scope.getCustomer=function (){
        $http.post('/web-api/customer-info', {

        }).then(function (response) {
            if (response.data.status_code == 200) {
                $scope.customer_name=response.data.customer_name;
                $scope.customer_phone=response.data.customer_phone;
                $scope.customer_email=response.data.customer_email;
            }
        }, function (response) {

        });
    }
    $scope.insideDhaka=function (){
        $scope.delivery_charge=80;
    }
    $scope.outsideDhaka=function (){
        $scope.delivery_charge=120;
    }
    $scope.signIn=function (){

        console.log("lollll");

    }

    $scope.colorChange=function (){
        console.log($scope.color);
    }
    $scope.sizeChange=function (){
        console.log($scope.size);
    }
});


