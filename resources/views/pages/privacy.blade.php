@php
    use App\Models\Bot;
    
    $page_title = 'Privacy Policy';
    $short_description = 'Prior to availing any of our services, we kindly request that you review and acknowledge our Privacy Policy. ';

    
    
@endphp

{{-- layout --}}
@extends('layouts.front')





@section('contents')
    {{-- breadcrumb --}}
    @include('pages.breadcrumb')

    <section class="w-full px-5 md:px-20 py-10 mt-10">
        <div class="w-full  flex justify-center">
            <div class="w-full flex items-center justify-center text-gray-500">
                <div class="w-full lg:w-3/4 grid grid-cols-1 gap-5 mt-10">                   

                    
                    <h2 class="text-2xl rescron-font-bold">1. Introduction</h2>

                    <p>Welcome to {{ site('name') }}. At {{ site('name') }}, we respect your privacy and are committed to protecting your
                        personal information. This Privacy Policy is designed to help you understand how we collect, use,
                        disclose, and safeguard your personal information. By using our services, you consent to the
                        practices described in this Privacy Policy.</p>

                    <h2 class="text-2xl rescron-font-bold">2. Information We Collect</h2>

                    <h3>2.1 Personal Information</h3>

                    <p>Personal Information is information that can be used to identify you as an individual. The types of
                        Personal Information we may collect include but are not limited to:</p>

                    <ul>
                        <li>Your name</li>
                        <li>Email address</li>
                        <li>Contact information</li>
                        <li>Financial information (for account verification and trading purposes)</li>
                        <li>User-generated content (such as comments, reviews, or support requests)</li>
                    </ul>

                    <p>We collect this information when you voluntarily provide it to us, such as when you create an
                        account, communicate with us, or use our Services.</p>

                    <h3>2.2 Non-Personal Information</h3>

                    <p>Non-Personal Information is data that cannot be used to identify you directly. This information
                        includes:</p>

                    <ul>
                        <li>Device information (e.g., device type, operating system)</li>
                        <li>Usage data (e.g., pages visited, time spent on our platform)</li>
                        <li>Log data (e.g., IP address, browser type)</li>
                        <li>Cookies and similar technologies (see Section 5)</li>
                    </ul>

                    <p>We may collect Non-Personal Information automatically as you interact with our Services.</p>

                    <h2 class="text-2xl rescron-font-bold">3. How We Use Your Information</h2>

                    <p>We use the information we collect for various purposes, including but not limited to:</p>

                    <li>Providing and maintaining our Services</li>
                    <li>Personalizing and improving user experience</li>
                    <li>Analyzing and monitoring usage patterns</li>
                    <li>Sending notifications and updates</li>
                    <li>Responding to your requests and inquiries</li>
                    <li>Complying with legal obligations</li>

                    <h2 class="text-2xl rescron-font-bold">4. Data Retention</h2>

                    <p>We retain your information only as long as necessary for the purposes outlined in this Privacy Policy
                        or as required by law. When your information is no longer needed, we will securely delete or
                        anonymize it.</p>

                    <h2 class="text-2xl rescron-font-bold">5. Cookies and Similar Technologies</h2>

                    <p>{{ site('name') }} uses cookies and similar technologies to enhance user experience and collect Non-Personal
                        Information. You can manage cookie preferences through your browser settings, but disabling cookies
                        may affect the functionality of our Services.</p>

                    <h2 class="text-2xl rescron-font-bold">6. Third-Party Services and Links</h2>

                    <p>Our Services may contain links to third-party websites or services. We are not responsible for the
                        privacy practices or content of these third parties. We recommend reviewing their privacy policies
                        before using their services.</p>

                    <h2 class="text-2xl rescron-font-bold">7. Data Security</h2>

                    <p>We take data security seriously and employ industry-standard measures to protect your information.
                        However, no method of transmission over the internet or electronic storage is entirely secure, and
                        we cannot guarantee absolute security.</p>

                    <h2 class="text-2xl rescron-font-bold">8. Children's Privacy</h2>

                    <p>Our Services are not intended for children under the age of 18. We do not knowingly collect Personal
                        Information from children. If you are a parent or guardian and believe that your child has provided
                        us with Personal Information, please contact us.</p>

                    <h2 class="text-2xl rescron-font-bold">9. Your Privacy Choices</h2>

                    <p>You have rights regarding your Personal Information, including:</p>

                    <ul>
                        <li>Accessing and updating your information</li>
                        <li>Deleting your account</li>
                        <li>Opting out of marketing communications</li>
                        <li>Managing cookie preferences</li>
                        <li>Withdrawing consent (where applicable)</li>
                    </ul>

                    <p>You can exercise these rights by contacting us through the information provided in Section 11.</p>

                    <h2 class="text-2xl rescron-font-bold">10. Changes to this Privacy Policy</h2>

                    <p>We may update this Privacy Policy periodically to reflect changes in our practices or for legal
                        reasons. Any modifications will be effective upon posting on our website. We encourage you to review
                        this Privacy Policy regularly to stay informed about how we collect and protect your information.
                    </p>

                    <h2 class="text-2xl rescron-font-bold">11. Contact Information</h2>

                    <p>If you have questions or concerns about this Privacy Policy or our data practices, please contact us
                        at [Contact Email].</p>

                </div>

            </div>
        </div>
    </section>
@endsection

@section('scripts')
@endsection
