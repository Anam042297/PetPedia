@include('frontend.includes.css')

@include('frontend.includes.css')

<!-- Contact Start -->
<div class="container-fluid pt-5">
    <div class="d-flex flex-column text-center mb-5 pt-5">

        <h1 class="display-4 m-0">Log<span class="text-primary">In</span></h1>
    </div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-sm-8 mb-5">
                <div class="contact-form">
                    <div id="success">
                        @if (session('error'))
                        <div class="alert alert-success">
                            {{ session('error') }}
                        </div>
                    @endif

                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
                    </div>
                    <form name="sentMessage" id="contactForm" novalidate="novalidate" action="{{ route('form.submit') }}"
                        method="POST">
                        @csrf
                        <div class="container">
                            <input type="email" name="email" class="form-control p-4" id="email"
                                placeholder="Your Email" required="required">
                                <span class="text-danger">
                                    @error('email')
                                        {{ $message }}
                                    @enderror
                                </span>
                            <p class="help-block text-danger"></p>
                           
                        </div>
                        <div class="container">
                            <input type="password" name="password" class="form-control p-4" id="pwd"
                                placeholder="Your Password"required="required">
                                <span class="text-danger">
                                    @error('password')
                                        {{ $message }}
                                    @enderror
                                </span>
                        </div>
                        <div>
                            <br>
                        </div>
                        <div class="text-center">
                            <button class="btn btn-primary py-2 px-5" type="submit"
                                id="sendMessageButton">Submit</button>
                        </div>
                        <div>Don't have account <a href="{{ route('register') }}">Register?</a></div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- Contact End -->



