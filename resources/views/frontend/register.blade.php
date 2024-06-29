@include('frontend.includes.css')

    <!-- Contact Start -->
    <div class="container-fluid pt-5">
        <div class="d-flex flex-column text-center mb-5 pt-5">

            <h1 class="display-4 m-0">Register  <span class="text-primary">Now</span></h1>
        </div>
        <div class="container"><div class="row justify-content-center">
            <div class="col-12 col-sm-8 mb-5">
                <div class="contact-form">
                    <div id="success"></div>
                    <form name="sentMessage" id="contactForm" novalidate="novalidate"action="{{ route('user.store') }}" method="POST">
                        @csrf
                        <div class="container">
                            <input type="text" class="form-control p-4" id="name" name="name" placeholder="Your Name" required="required" data-validation-required-message="Please enter your name" />
                            <p class="help-block text-danger"></p>
                        </div>
                        <div class="container">
                            <input type="email" class="form-control p-4" id="email" name="email" placeholder="Your Email" required="required" data-validation-required-message="Please enter your email" />
                            <p class="help-block text-danger"></p>
                        </div>

                            <div class="container">
                                <input type="password" class="form-control p-4" id="pwd" name="password" placeholder="Your Password" required="required" data-validation-required-message="Please enter your password" >
                            </div>
                            <div>
                                <br>
                            </div>

                        <div class="text-center">
                            <button class="btn btn-primary py-2 px-5" type="submit" id="sendMessageButton">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    </div>
    <!-- Contact End -->



