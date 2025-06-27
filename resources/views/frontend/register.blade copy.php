@extends('frontend.partials.master')

@section('content')

    <!-- Breadcrumb Section Begin -->
        <x-breadcrumb :title="'Register'" />
    <!-- Breadcrumb Section End -->

    <!-- Contact Form Begin -->
    <div class="contact-form spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="contact__form__title">
                        <h2>Register</h2>
                    </div>
                </div>
            </div>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0" style="list-style: none; padding-left: 0;">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

             <form action="{{ route('user.register') }}" method="post" id="userRegisterForm" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-lg-6 col-md-6">
                        <input type="text" id="name" name="name" placeholder="Full Name (Required)" required>
                    </div>

                    <div class="col-lg-6 col-md-6">
                        <input type="text" id="address" name="address" placeholder="House Address">
                    </div>
                 
                    <div class="col-lg-6 col-md-6">
                        <input type="phone" id="phone" name="phone" placeholder="Phone | Ex: 01********* (Required)" required>
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <input type="email" id="email_or_phone" name="email_or_phone" placeholder="Email (Required)" required>
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <input type="password" id="password" name="password" placeholder="Password (Required)" required> 
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <input type="password" id="confirm-password" name="password_confirmation" placeholder="Re-Enter Password (Required)" required>
                    </div>
                    <div class="col-lg-12 text-center">
                        <button type="submit" class="site-btn">REGISTER</button>
                    </div>
                </div>
            </form>

                <div class="col-lg-12 text-center mt-3">
                    <p>Forgot Password? <a href="">Recover here</a></p>
                </div>

                <div class="col-lg-12 text-center mt-3">
                    <a href="#" class="btn btn-danger">
                        <img src="https://developers.google.com/identity/images/g-logo.png" alt="Google Logo" style="width:20px; height:20px; margin-right:8px;">
                        Register with Google
                    </a>
                </div>

              


        </div>
    </div>
    <!-- Contact Form End -->


@endsection

@push('frontend_scripts')

{{-- temporary --}}
<script>
        // Function to generate a random Bangladeshi name
        function generateBangladeshiName() {
            const firstNames = [
                "Rahim", "Karim", "Fatema", "Ayesha", "Akash", "Nusrat", "Sohan", "Jannatul",
                "Mehedi", "Tasnim", "Sakib", "Maliha", "Fahim", "Nadia", "Riad", "Shirin",
                "Imran", "Farah", "Anik", "Sharmin"
            ];
            const lastNames = [
                "Ahmed", "Khan", "Hossain", "Islam", "Chowdhury", "Rahman", "Miah", "Begum",
                "Akter", "Sarker", "Majumder", "Bhuyan", "Talukder", "Ali", "Haque", "Uddin",
                "Siddique", "Paul", "Das", "Roy"
            ];

            const randomFirstName = firstNames[Math.floor(Math.random() * firstNames.length)];
            const randomLastName = lastNames[Math.floor(Math.random() * lastNames.length)];
            return `${randomFirstName} ${randomLastName}`;
        }

        // Function to generate a random Bangladeshi phone number (01xxxxxxxxx format)
        function generateBangladeshiPhoneNumber() {
            const prefixes = ["7", "8", "9", "3"]; // Common prefixes after 01 for mobile operators (e.g., Grameenphone 017, Robi 018, Banglalink 019, Teletalk 015, Airtel 016 - though often merged with Robi now, Citycell 011 - defunct, new prefix 013 for GP)
            let phoneNumber = "01";
            phoneNumber += prefixes[Math.floor(Math.random() * prefixes.length)];
            for (let i = 0; i < 8; i++) {
                phoneNumber += Math.floor(Math.random() * 10);
            }
            return phoneNumber;
        }

        // Function to generate an email from a name
        function generateEmailFromName(fullName) {
            const sanitizedName = fullName.toLowerCase().replace(/ /g, '.').replace(/[^a-z0-9.]/g, '');
            const domains = ["example.com", "mail.com", "test.org", "bdmail.net"];
            const randomDomain = domains[Math.floor(Math.random() * domains.length)];
            const randomNumber = Math.floor(Math.random() * 1000); // Add a random number to avoid duplicates
            return `${sanitizedName}${randomNumber}@${randomDomain}`;
        }

        // Function to generate a simple Bangladeshi address
        function generateBangladeshiAddress() {
            const streetNumbers = ["123", "45/A", "Block C", "Road 7"];
            const streetNames = ["Mirpur Road", "Dhanmondi", "Gulshan Avenue", "Farmgate", "Motijheel"];
            const areas = ["Dhaka", "Chittagong", "Sylhet", "Khulna", "Rajshahi"];
            
            const randomStreetNum = streetNumbers[Math.floor(Math.random() * streetNumbers.length)];
            const randomStreetName = streetNames[Math.floor(Math.random() * streetNames.length)];
            const randomArea = areas[Math.floor(Math.random() * areas.length)];

            return `${randomStreetNum}, ${randomStreetName}, ${randomArea}`;
        }

        // Function to fill the form
        function fillForm() {
            // Get form elements
            const nameField = document.getElementById('name');
            const addressField = document.getElementById('address'); // Get address field
            const phoneField = document.getElementById('phone');
            const emailField = document.getElementById('email_or_phone');
            const passwordField = document.getElementById('password');
            const confirmPasswordField = document.getElementById('confirm-password');

            // Generate fake data
            const fakeName = generateBangladeshiName();
            const fakeAddress = generateBangladeshiAddress(); // Generate address
            const fakePhone = generateBangladeshiPhoneNumber();
            const fakeEmail = generateEmailFromName(fakeName);

            // Fill the form fields
            nameField.value = fakeName;
            addressField.value = fakeAddress; // Set address field value
            phoneField.value = fakePhone;
            emailField.value = fakeEmail;
            passwordField.value = 'dhaka12345';
            confirmPasswordField.value = 'dhaka12345';
        }

        // Call fillForm when the window loads
        window.onload = fillForm;

        // Keep the button functionality just in case the user wants to re-fill
        document.getElementById('fillFormBtn').addEventListener('click', fillForm);

    </script>
    
@endpush

