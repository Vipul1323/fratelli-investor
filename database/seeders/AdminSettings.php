<?php

namespace Database\Seeders;

use App\Models\AdminSettings as Settings;
use Illuminate\Database\Seeder;

class AdminSettings extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $settingsArray = [
            [
                'name' => 'Forgot Password',
                'subject' => 'Reset your password',
                'title' => 'Forgot Password',
                'description' => '<p>Hello [[USERNAME]],</p>

                <p>We got requested to reset your password for your&nbsp;account. Click the given below button to reset it.</p>

                <p><a href="[[RESET_LINK]]" style="background-color:#4584F8;color:#ffffff;width:200px;padding:10px 16px;font-size:14px;text-decoration:none;border-radius:4px;display:inline-block;text-align:center">Reset Your Password</a></p>

                <p>(If you did not request for password reset, please ignore this email.)</p>

                <p>Thank You,</p>

                <p>[[PRODUCT_NAME]] Team.</p>',
                'image' => null,
                'type' => 'emails',
                'language' => 'en',
                'is_active' => 1,
                'slug' => 'forgot_password',
                'tags' => '[[USERNAME]],  [[PRODUCT_NAME]]',
            ],
            [
                'name' => 'Welcome - User - Added by Admin',
                'subject' => 'Welcome To App',
                'title' => 'Welcome - User',
                'description' => '<p>Hi [[USERNAME]],</p>

                <p>Welcome to [[PRODUCT_NAME]].</p>

                <p>Your account is created successfully by the site admin. Kindly reset your password and&nbsp;login using given Email on our Application.</p>

                <p>Email: [[EMAIL]]</p>

                <p><a href="[[RESET_LINK]]" style="background-color:#4584F8;color:#ffffff;width:200px;padding:10px 16px;font-size:14px;text-decoration:none;border-radius:4px;display:inline-block;text-align:center">Reset Password</a></p>

                <p>Thank you so much for joining us.</p>

                <p>Regards,</p>

                <p>[[PRODUCT_NAME]] Team.</p>',
                'image' => null,
                'type' => 'emails',
                'language' => 'en',
                'is_active' => 1,
                'slug' => 'welcome-signup',
                'tags' => '[[USERNAME]], [[PRODUCT_NAME]], [[EMAIL]]',
            ],
            [
                'name' => 'Change Password',
                'subject' => 'Your Password Changed Successfully',
                'title' => 'Change Password',
                'description' => '<p>Hello [[USERNAME]],</p>

                <p>Your password is successfully changed.</p>

                <p>Thank You,</p>

                <p>[[PRODUCT_NAME]]</p>',
                'image' => null,
                'type' => 'emails',
                'language' => 'en',
                'is_active' => 1,
                'slug' => 'change_password',
                'tags' => '[[USERNAME]], [[PRODUCT_NAME]]',
            ],
            [
                'name' => 'Welcome - Sub Admin',
                'subject' => 'Welcome To App',
                'title' => 'Welcome - Sub Admin',
                'description' => '<p>Hi [[SUBADMIN_NAME]],</p><p>Welcome to [[PRODUCT_NAME]].</p><p>Your account is created successfully by the site admin.&nbsp;</p><p>Email: [[EMAIL]]</p><p>Thank you so much for joining us.</p><p>Regards,</p><p>[[PRODUCT_NAME]] Team.</p>',
                'image' => null,
                'type' => 'emails',
                'language' => 'en',
                'is_active' => 1,
                'slug' => 'welcomesubadmin',
                'tags' => '[[SUBADMIN_NAME]], [[PRODUCT_NAME]], [[EMAIL]]',
            ],
            [
                'name' => 'Contact Us',
                'subject' => 'Contact Us',
                'title' => 'Inquiry',
                'description' => '[[INQUIRY_DATA]]',
                'image' => null,
                'type' => 'emails',
                'language' => 'en',
                'is_active' => 1,
                'slug' => 'inquiry',
                'tags' => '[[INQUIRY_DATA]]',
            ],
            [
                'name' => 'Email OTP verification',
                'subject' => 'OTP generated for email verification',
                'title' => 'Email OTP verification',
                'description' => '<p>Hello [[USERNAME]],</p>

                <p>Please use below OTP to verify your email address:</p>

                <p>[[OTP]]</p>

                <p>Regards,</p>

                <p>[[PRODUCT_NAME]] Team.</p>',
                'image' => null,
                'type' => 'emails',
                'language' => 'en',
                'is_active' => 1,
                'slug' => 'email-otp',
                'tags' => '[[USERNAME]], [[PRODUCT_NAME]], [[EMAIL]]',
            ],
            [
                'name' => 'Forgot Password - App User',
                'subject' => 'Reset your password',
                'title' => 'Forgot Password - App User',
                'description' => '<p>Hello [[USERNAME]],</p>

                <p>We got requested to reset your password for your&nbsp;account. Please proceed with the OTP given below to reset it.</p>

                <p><div style="background-color:#4584f8;color:#ffffff;width:200px;padding:10px 16px;font-size: 16px;text-decoration:none;border-radius:4px;display:inline-block;text-align:center;letter-spacing: 10px;">[[RESET_OTP]]</div></p>

                <p>(If you did not request for password reset, please ignore this email.)</p>

                <p>Thank You,</p>

                <p>[[PRODUCT_NAME]] Team.</p>',
                'image' => null,
                'type' => 'emails',
                'language' => 'en',
                'is_active' => 1,
                'slug' => 'app_forgot_password',
                'tags' => '[[USERNAME]],  [[PRODUCT_NAME]]',
            ],
            [
                'name' => 'Welcome - User - Signup from app',
                'subject' => 'Welcome To '.env('APP_NAME'),
                'title' => 'Welcome - User',
                'description' => '<p>Hi [[USERNAME]],</p>

                <p>Welcome to [[PRODUCT_NAME]].</p>

                <p>Thank you so much for joining us.</p>

                <p>Regards,</p>

                <p>[[PRODUCT_NAME]] Team.</p>',
                'image' => null,
                'type' => 'emails',
                'language' => 'en',
                'is_active' => 1,
                'slug' => 'welcome-signup-app',
                'tags' => '[[USERNAME]], [[PRODUCT_NAME]], [[EMAIL]]',
            ],
            [
                'name' => 'Welcome - User - Signup from app',
                'subject' => 'Welcome To '.env('APP_NAME'),
                'title' => 'Welcome - User',
                'description' => '<p>Hi [[USERNAME]],</p>

                <p>Welcome to [[PRODUCT_NAME]].</p>

                <p>Thank you so much for joining us.</p>

                <p><a href="[[RESET_LINK]]" style="background-color:#4584f8;color:#ffffff;width:250px;padding:10px 16px;font-size: 16px;text-decoration:none;border-radius:4px;display:inline-block;text-align:center;letter-spacing: 10px;">Set Password</a></p>

                <p>Regards,</p>

                <p>[[PRODUCT_NAME]] Team.</p>',
                'image' => null,
                'type' => 'emails',
                'language' => 'en',
                'is_active' => 1,
                'slug' => 'welcome',
                'tags' => '[[USERNAME]], [[PRODUCT_NAME]], [[EMAIL]]',
            ],
            [
                'name' => 'Privacy',
                'subject' => null,
                'title' => 'Privacy policy',
                'description' => '<p>Privacy Policy Test data</p>

                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus porttitor sapien in maximus euismod. Suspendisse potenti. Mauris pellentesque mollis velit non tincidunt. Aenean at dui libero. Vestibulum aliquam sed neque a convallis. Nunc ultricies turpis lorem, eu pulvinar arcu ultricies sed. Nunc in lectus at justo commodo mollis nec aliquam velit.</p>

                <p>Proin fermentum, ex condimentum ornare pretium, libero augue sollicitudin magna, vehicula eleifend ipsum massa quis ex. Curabitur malesuada aliquam lectus in dignissim. Fusce vitae sollicitudin est. Phasellus tincidunt sed ligula in tristique. Vivamus at gravida massa, nec finibus neque. Maecenas aliquam justo ut magna laoreet vulputate. Proin eget diam orci. In vestibulum luctus facilisis. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Etiam congue enim quis magna pellentesque, id suscipit ligula bibendum. Duis imperdiet sem at nisl fermentum, nec mollis eros fringilla. Sed ac arcu at nibh mollis tempor. Sed vitae sapien ornare, mollis sem id, facilisis nisl. In viverra convallis ligula, a imperdiet odio elementum sit amet.</p>',
                'image' => 'static_pages/support_privacy.png',
                'type' => 'pages',
                'language' => 'en',
                'is_active' => 1,
                'slug' => 'privacy',
                'tags' => null,
            ],
            [
                'name' => 'Terms & Conditions',
                'subject' => null,
                'title' => 'Terms & Conditions',
                'description' => '<p>Terms and Conditions Test Data</p>

                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus porttitor sapien in maximus euismod. Suspendisse potenti. Mauris pellentesque mollis velit non tincidunt. Aenean at dui libero. Vestibulum aliquam sed neque a convallis. Nunc ultricies turpis lorem, eu pulvinar arcu ultricies sed. Nunc in lectus at justo commodo mollis nec aliquam velit.</p>

                <p>Proin fermentum, ex condimentum ornare pretium, libero augue sollicitudin magna, vehicula eleifend ipsum massa quis ex. Curabitur malesuada aliquam lectus in dignissim. Fusce vitae sollicitudin est. Phasellus tincidunt sed ligula in tristique. Vivamus at gravida massa, nec finibus neque. Maecenas aliquam justo ut magna laoreet vulputate. Proin eget diam orci. In vestibulum luctus facilisis. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Etiam congue enim quis magna pellentesque, id suscipit ligula bibendum. Duis imperdiet sem at nisl fermentum, nec mollis eros fringilla. Sed ac arcu at nibh mollis tempor. Sed vitae sapien ornare, mollis sem id, facilisis nisl. In viverra convallis ligula, a imperdiet odio elementum sit amet.</p>',
                'image' => 'static_pages/support_terms.png',
                'type' => 'pages',
                'language' => 'en',
                'is_active' => 1,
                'slug' => 'privacy',
                'tags' => null,
            ],
            [
                'name' => 'About',
                'subject' => null,
                'title' => 'About us',
                'description' => '<p><strong>All You Need To Know</strong></p>

                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus porttitor sapien in maximus euismod. Suspendisse potenti. Mauris pellentesque mollis velit non tincidunt. Aenean at dui libero. Vestibulum aliquam sed neque a convallis. Nunc ultricies turpis lorem, eu pulvinar arcu ultricies sed. Nunc in lectus at justo commodo mollis nec aliquam velit.</p>

                <p>Proin fermentum, ex condimentum ornare pretium, libero augue sollicitudin magna, vehicula eleifend ipsum massa quis ex. Curabitur malesuada aliquam lectus in dignissim. Fusce vitae sollicitudin est. Phasellus tincidunt sed ligula in tristique. Vivamus at gravida massa, nec finibus neque. Maecenas aliquam justo ut magna laoreet vulputate. Proin eget diam orci. In vestibulum luctus facilisis. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Etiam congue enim quis magna pellentesque, id suscipit ligula bibendum. Duis imperdiet sem at nisl fermentum, nec mollis eros fringilla. Sed ac arcu at nibh mollis tempor. Sed vitae sapien ornare, mollis sem id, facilisis nisl. In viverra convallis ligula, a imperdiet odio elementum sit amet.</p>',
                'image' => 'static_pages/support_about.png',
                'type' => 'pages',
                'language' => 'en',
                'is_active' => 1,
                'slug' => 'aboutus',
                'tags' => null,
            ],
            [
                'name' => 'FAQ',
                'subject' => null,
                'title' => 'FAQ',
                'description' => '<p><strong>FAQ1</strong></p>

                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus porttitor sapien in maximus euismod. Suspendisse potenti. Mauris pellentesque mollis velit non tincidunt. Aenean at dui libero. Vestibulum aliquam sed neque a convallis. Nunc ultricies turpis lorem, eu pulvinar arcu ultricies sed. Nunc in lectus at justo commodo mollis nec aliquam velit.</p>

                <p>Proin fermentum, ex condimentum ornare pretium, libero augue sollicitudin magna, vehicula eleifend ipsum massa quis ex. Curabitur malesuada aliquam lectus in dignissim. Fusce vitae sollicitudin est. Phasellus tincidunt sed ligula in tristique. Vivamus at gravida massa, nec finibus neque. Maecenas aliquam justo ut magna laoreet vulputate. Proin eget diam orci. In vestibulum luctus facilisis. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Etiam congue enim quis magna pellentesque, id suscipit ligula bibendum. Duis imperdiet sem at nisl fermentum, nec mollis eros fringilla. Sed ac arcu at nibh mollis tempor. Sed vitae sapien ornare, mollis sem id, facilisis nisl. In viverra convallis ligula, a imperdiet odio elementum sit amet.</p>',
                'image' => 'static_pages/support_faq.png',
                'type' => 'pages',
                'language' => 'en',
                'is_active' => 1,
                'slug' => 'faq',
                'tags' => null,
            ],
            [
                'name' => 'Contact Us',
                'subject' => 'Contact Us',
                'title' => 'Contact Us',
                'description' => '<p><strong>Contact Us</strong></p>

                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus porttitor sapien in maximus euismod. Suspendisse potenti. Mauris pellentesque mollis velit non tincidunt. Aenean at dui libero. Vestibulum aliquam sed neque a convallis. Nunc ultricies turpis lorem, eu pulvinar arcu ultricies sed. Nunc in lectus at justo commodo mollis nec aliquam velit.</p>

                <p>Proin fermentum, ex condimentum ornare pretium, libero augue sollicitudin magna, vehicula eleifend ipsum massa quis ex. Curabitur malesuada aliquam lectus in dignissim. Fusce vitae sollicitudin est. Phasellus tincidunt sed ligula in tristique. Vivamus at gravida massa, nec finibus neque. Maecenas aliquam justo ut magna laoreet vulputate. Proin eget diam orci. In vestibulum luctus facilisis. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Etiam congue enim quis magna pellentesque, id suscipit ligula bibendum. Duis imperdiet sem at nisl fermentum, nec mollis eros fringilla. Sed ac arcu at nibh mollis tempor. Sed vitae sapien ornare, mollis sem id, facilisis nisl. In viverra convallis ligula, a imperdiet odio elementum sit amet.</p>',
                'image' => 'static_pages/support_contact.png',
                'type' => 'pages',
                'language' => 'en',
                'is_active' => 1,
                'slug' => 'contact_us',
                'tags' => null,
            ],
        ];

        foreach ($settingsArray as $key => $page) {
            $settingObj = Settings::where('slug', $page['slug'])->where('is_active', 1)->first();
            if (! $settingObj) {
                Settings::create($page);
            } else {
                Settings::where('slug', $page['slug'])->update($page);
            }
        }
    }
}
