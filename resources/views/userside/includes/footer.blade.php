{{-- <div class="bordered_1px mb-4"></div>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="contact_text text-center p-4 shadow-sm rounded" style="background-color: #f9f9f9;">
                <div class="section_title text-center mb-4">
                    <h3 style="font-weight: 700; color: #333;">Why Choose PetPedia?</h3>
                    <p style="font-size: 1.1rem; color: #555;">
                        At PetPedia, we treat your pets like family. Rely on trustworthy support, whenever you need it.
                    </p>
                </div>
                <div class="contact_btn">
                    @php
                        $phoneNumber = "+923158230935";
                    @endphp
                    <a href="https://wa.me/{{ str_replace('+', '', $phoneNumber) }}" class="boxed-btn4 btn btn-primary px-4 py-2"
                       style="font-size: 1rem; font-weight: 600; border-radius: 30px; background-color: #25D366; color: white; text-decoration: none;"
                       target="_blank">
                        Contact Us on WhatsApp
                    </a>
                </div>
            </div>
        </div>
    </div>
</div> --}}




{{-- <div class="bordered_1px mb-4"></div>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="contact_text text-center p-5 shadow-lg rounded" style="background-color: #f5f7fa; border: 1px solid #e0e4e8;">
                <div class="section_title text-center mb-4">
                    <h3 style="font-weight: 700; color: #333;">Why Choose PetPedia?</h3>
                    <p style="font-size: 1.1rem; color: #555;">
                        <i class="fas fa-paw" style="color: #ff6b6b; font-size: 1.3rem;"></i> 
                        At PetPedia, we treat your pets like family. Rely on trustworthy support, whenever you need it.
                    </p>
                </div>

                <!-- Benefits Section -->
                <div class="benefits d-flex justify-content-around mb-4">
                    <div class="benefit-item text-center">
                        <i class="fas fa-shield-alt" style="font-size: 2rem; color: #007bff;"></i>
                        <h5 style="font-weight: 600; color: #333; margin-top: 10px;">Reliable Support</h5>
                        <p style="font-size: 0.9rem; color: #666;">24/7 Assistance</p>
                    </div>
                    <div class="benefit-item text-center">
                        <i class="fas fa-heart" style="font-size: 2rem; color: #ff6b6b;"></i>
                        <h5 style="font-weight: 600; color: #333; margin-top: 10px;">Pet-Centered Care</h5>
                        <p style="font-size: 0.9rem; color: #666;">Compassionate Service</p>
                    </div>
                    <div class="benefit-item text-center">
                        <i class="fas fa-thumbs-up" style="font-size: 2rem; color: #28a745;"></i>
                        <h5 style="font-weight: 600; color: #333; margin-top: 10px;">Trusted by Many</h5>
                        <p style="font-size: 0.9rem; color: #666;">Positive Feedback</p>
                    </div>
                </div>

                <!-- Contact Button -->
                <div class="contact_btn">
                    @php
                        $phoneNumber = "+923158230935";
                    @endphp
                    <a href="https://wa.me/{{ str_replace('+', '', $phoneNumber) }}" 
                       class="boxed-btn4 btn btn-primary px-5 py-3"
                       style="font-size: 1rem; font-weight: 600; border-radius: 30px; background-color: #25D366; color: white; text-decoration: none; transition: background-color 0.3s;"
                       target="_blank">
                        <i class="fab fa-whatsapp" style="margin-right: 8px;"></i> Contact Us on WhatsApp
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
           --}}
           
{{--            
           <div class="bordered_1px mb-4"></div>
           <div class="container">
               <div class="row justify-content-center">
                   <div class="col-lg-8">
                       <div class="contact_text text-center p-5 shadow-lg rounded" style="background-color: #f9fafb; border: 1px solid #dde1e7;">
                           <div class="section_title text-center mb-4">
                               <h3 style="font-weight: 700; color: #2c3e50;">Why Choose Petpedia?</h3>
                               <p style="font-size: 1.1rem; color: #546e7a;">
                                   <i class="fas fa-paw" style="color: #ff6b6b; font-size: 1.3rem;"></i> 
                                   Dedicated to a community that cares, Petpedia is your one-stop destination for pet care, adoption, and trusted guidance.
                               </p>
                           </div>
           
                           <!-- Pet-Specific Benefits Section -->
                           <div class="benefits d-flex justify-content-around mb-4">
                               <div class="benefit-item text-center">
                                   <i class="fas fa-user-md" style="font-size: 2rem; color: #007bff;"></i>
                                   <h5 style="font-weight: 600; color: #2c3e50; margin-top: 10px;">Professional Advice</h5>
                                   <p style="font-size: 0.9rem; color: #607d8b;">Get reliable pet care guidance from experts.</p>
                               </div>
                               <div class="benefit-item text-center">
                                   <i class="fas fa-heartbeat" style="font-size: 2rem; color: #ff6b6b;"></i>
                                   <h5 style="font-weight: 600; color: #2c3e50; margin-top: 10px;">Wellness & Safety</h5>
                                   <p style="font-size: 0.9rem; color: #607d8b;">We prioritize your pet’s health and happiness.</p>
                               </div>
                               <div class="benefit-item text-center">
                                   <i class="fas fa-paw" style="font-size: 2rem; color: #28a745;"></i>
                                   <h5 style="font-weight: 600; color: #2c3e50; margin-top: 10px;">Community of Pet Lovers</h5>
                                   <p style="font-size: 0.9rem; color: #607d8b;">Connect with fellow pet enthusiasts across Pakistan.</p>
                               </div>
                           </div>
           
                           <!-- Contact Button -->
                           <div class="contact_btn">
                               @php
                                   $phoneNumber = "+923158230935";
                               @endphp
                               <a href="https://wa.me/{{ str_replace('+', '', $phoneNumber) }}" 
                                  class="boxed-btn4 btn btn-primary px-5 py-3"
                                  style="font-size: 1rem; font-weight: 600; border-radius: 30px; background-color: #25D366; color: white; text-decoration: none; transition: background-color 0.3s ease;"
                                  target="_blank">
                                   <i class="fab fa-whatsapp" style="margin-right: 8px;"></i> Reach Out on WhatsApp
                               </a>
                           </div>
                       </div>
                   </div>
               </div>
           </div> --}}
           
           <footer class="text-white pt-5 pb-4">
            <div class="container text-center text-md-left">
              <div class="row">
                <!-- About Section -->
                <div class="col-md-3 col-lg-3 col-xl-3 mx-auto mt-3">
                  <h5 class="text-uppercase mb-4 font-weight-bold">About Petpedia</h5>
                  <p>Petpedia is your one-stop pet adoption platform for adopting pets,buying related products and finding assistance. Explore and connect with platform for finding your furry friend!</p>
                </div>
          
          
                <!-- Features -->
                <div class="col-md-3 col-lg-3 col-xl-3 mx-auto mt-3">
                  <h5 class="text-uppercase mb-4 font-weight-bold">Features</h5>
                  <p><i class="fas fa-paw mr-2"></i>Pet Blogging</p>
                  <p><i class="fas fa-calendar-check mr-2"></i>Pet Assistance</p>
                  <p><i class="fas fa-search mr-2"></i>Search by Category & Breed</p>
                  <p><i class="fas fa-shopping-cart mr-2"></i>Pet Product Marketplace</p>
                </div>
          
                <!-- Contact Section -->
                <div class="col-md-4 col-lg-4 col-xl-4 mx-auto mt-3">
                  <h5 class="text-uppercase mb-4 font-weight-bold">Contact</h5>
                  <p><i class="fas fa-home mr-2"></i>123 Pet Street, PetCity</p>
                  <p><i class="fas fa-envelope mr-2"></i>info@petpedia.com</p>
                  <p><i class="fas fa-phone mr-2"></i>+92302-5094990</p>
                  <p><i class="fas fa-globe mr-2"></i>petpedia.projectflux.online</p>
                </div>
              </div>
          
          
            
          
              <hr class="mb-3 text-white">
              <div class="row d-flex justify-content-center">
                <div class="col-md-8 text-center">
                  <p>&copy; 2024 Petpedia. All Rights Reserved.</p>
                </div>
              </div>
            </div>
          </footer>
          