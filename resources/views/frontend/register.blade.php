@include('frontend.includes.css')
@include('frontend.includes.header')
    <!-- Contact Start -->
    <div class="container-fluid pt-5">
        <div class="d-flex flex-column text-center mb-4 pt-4">
            <h1 class="display-4 m-0">Register  <span class="text-primary">Now</span></h1>
        </div>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-sm-8 mb-5">
                    <div class="contact-form">
                        <div id="success"></div>
                        <form name="sentMessage" id="contactForm" novalidate="novalidate"action="{{ route('user.store') }}"
                            method="POST">
                            @csrf
                            <div class="container">
                                <input type="text" class="form-control p-4" id="name" name="name"
                                    placeholder="Your Name" />
                                    <span class="text-danger">
                                        @error('name')
                                            {{ $message }}
                                        @enderror
                                    </span>
                            </div>
                            <div class="container">
                                <input type="email" class="form-control p-4" id="email" name="email"
                                    placeholder="Your Email"/>
                                    <span class="text-danger">
                                        @error('email')
                                            {{ $message }}
                                        @enderror
                                    </span>
                            </div>
                            <div class="container">
                                <input type="password" class="form-control p-4" id="pwd" name="password"
                                    placeholder="Your Password" />
                                    <span class="text-danger">
                                    @error('password')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>
                            <div>
                            </div>
                            <div class="container">
                                <input id="password-confirm" class="form-control p-4"
                                    type="password"placeholder="Confirm Password" name="password_confirmation"/>
                            </div>
                            <div>
                                <br>
                            </div>
                            <div class="text-center">
                                <button class="btn btn-primary py-2 px-5" type="submit"
                                  id="sendMessageButton">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    </div>
    <!-- Contact End -->



