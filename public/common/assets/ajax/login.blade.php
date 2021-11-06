<div class="login-popup">
    <div class="tab tab-nav-boxed tab-nav-center tab-nav-underline">
        <ul class="nav nav-tabs text-uppercase" role="tablist">
            <li class="nav-item">
                <a href="#sign-in" class="nav-link active">Sign In</a>
            </li>
            <li class="nav-item">
                <a href="#sign-up" class="nav-link">Sign Up</a>
            </li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane active" id="sign-in">

                <form action="/customer/sign-in" method="post">

                    <div class="form-group">
                        <label>Phone Number * </label>
                        <input type="tel" class="form-control" name="phone" id="username" required>
                    </div>
                    <div class="form-group mb-0">
                        <label>Password *</label>
                        <input type="password" class="form-control" name="password" id="password" required>
                    </div>
                    <div class="form-checkbox d-flex align-items-center justify-content-between">
                        <input type="checkbox" class="custom-checkbox" id="remember" name="remember" >
                        <label for="remember">Remember me</label>
                        <a href="#">Last your password?</a>
                    </div>
                    <button type="submit" class="btn btn-primary">Sign In</button>
                </form>

            </div>
            <div class="tab-pane" id="sign-up">
                <form action="/customer/sign-up" method="post">
                <div class="form-group">
                    <label>Full Name</label>
                    <input type="text" class="form-control" name="customer_name" id="customer_name" required>
                </div>
                <div class="form-group">
                    <label>Phone Number</label>
                    <input type="text" class="form-control" name="customer_phone" id="customer_phone" required>
                </div>
                <div class="form-group">
                    <label>Your Email address *</label>
                    <input type="text" class="form-control" name="customer_email" id="customer_email" required>
                </div>
                <div class="form-group mb-5">
                    <label>Password *</label>
                    <input type="password" class="form-control" name="customer_password" id="customer_password" required>
                </div>

                <div class="form-checkbox d-flex align-items-center justify-content-between mb-5">
                    <input type="checkbox" class="custom-checkbox" id="agree" name="agree" required="">
                    <label for="agree" class="font-size-md">I agree to the <a  href="#" class="text-primary font-size-md">privacy policy</a></label>
                </div>
                    <button type="submit" class="btn btn-primary">Sign Up</button>
                </form>
            </div>
        </div>

    </div>
</div>
