<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    'something_went_wrong' => [
        'page' => 'getProfile',
        'context' => 'Something went wrong',
        'message_type' => 'error',
        'message' => 'Something went wrong. Please try after some time.',
    ],
    'setting_retrived_success' => [
        'page' => 'profile',
        'context' => 'profile settings',
        'message_type' => 'success',
        'message' => 'Settings retirived successfully.',
    ],
    'unauthorized_access' => [
        'page' => 'login',
        'context' => 'unauthorized access',
        'message_type' => 'error',
        'message' => 'You are not authorised to access this service.',
    ],
    'logged' => [
        'page' => 'login',
        'context' => 'logged in',
        'message_type' => 'success',
        'message' => 'You are logged in!',
    ],
    'profile_retrived_success' => [
        'page' => 'profile',
        'context' => 'profile retrived',
        'message_type' => 'success',
        'message' => 'Profile retrieved successfully.',
    ],
    'profile_updated_success' => [
        'page' => 'profile',
        'context' => 'profile updated',
        'message_type' => 'success',
        'message' => 'Profile details updated successfully.',
    ],
    'invalid_data_provided' => [
        'page' => 'contactus',
        'context' => 'Contact Us',
        'message_type' => 'error',
        'message' => 'Invalid data provided!',
    ],
    'contactus_success' => [
        'page' => 'contactus',
        'context' => 'Contact Us',
        'message_type' => 'success',
        'message' => 'Information has been saved successfully.',
    ],
    'page_retrived_success' => [
        'page' => 'getpages',
        'context' => 'Get Page',
        'message_type' => 'success',
        'message' => 'Page URL retrieved successfully.',
    ],
    'unauthorized_login' => [
        'page' => 'login',
        'context' => 'Login',
        'message_type' => 'error',
        'message' => 'Provided login details don\'t match our records. Please try again.',
    ],
    'contact_admin' => [
        'page' => 'login',
        'context' => 'login',
        'message_type' => 'error',
        'message' => 'Your account is not active. Please contact admin.',
    ],
    'email_already_exists' => [
        'page' => 'signup',
        'context' => 'signup',
        'message_type' => 'error',
        'message' => 'Email already in use, Please try with some other email address.',
    ],
    'mobile_already_exists' => [
        'page' => 'signup',
        'context' => 'signup',
        'message_type' => 'error',
        'message' => 'Mobile number already in use, Please try with other mobile number or login',
    ],
    'signup_success' => [
        'page' => 'signup',
        'context' => 'signup',
        'message_type' => 'success',
        'message' => 'Signup successfully.',
    ],
    'signup_error' => [
        'page' => 'signup',
        'context' => 'signup',
        'message_type' => 'error',
        'message' => 'Something went wrong in signup.',
    ],
    'password_changed_success' => [
        'page' => 'change password',
        'context' => 'change password',
        'message_type' => 'success',
        'message' => 'Your password has been changed successfully.',
    ],
    'password_miss_match' => [
        'page' => 'change password',
        'context' => 'change password',
        'message_type' => 'error',
        'message' => 'Your current password is incorrect.',
    ],
    'email_not_found' => [
        'page' => 'forgot password',
        'context' => 'forgot password',
        'message_type' => 'error',
        'message' => 'Email does not exists.',
    ],
    'forgot_link_sent' => [
        'page' => 'forgot password',
        'context' => 'forgot password',
        'message_type' => 'success',
        'message' => 'Kindly check your email to reset your password.',
    ],
    'logged_out_success' => [
        'page' => 'logout',
        'context' => 'logout',
        'message_type' => 'success',
        'message' => 'User Logged Out Successfully.',
    ],
    'profile_updated_success' => [
        'page' => 'Update Profile',
        'context' => 'Profile',
        'message_type' => 'success',
        'message' => 'Profile updated successfully.',
    ],
    'user_deactivated' => 'Contact admin to activate your account.',
    'password_reset_success' => 'Your password has been reset successfully.',
    'mobile_not_match' => 'Your mobile number not match in our system..!!',
    'invalid_missing_data_provided' => 'Invalid data provided or Missing Required Data!',
    'profile_details_updated' => 'Your profile details updated successfully.',
    'enter_your_email' => 'Enter your email.',
    'admin_email_not_found' => 'Admin email not found.',
    'not_registered' => 'Account not found using social details.',
    'profile_retrived_error' => 'Error in getting profile details.',
    'profile_updated_error' => 'Error In Update Profile Details.',
    'settings_retrived_success' => 'Settings retrieved successfully.',
    'settings_updated_success' => 'Settings updated successfully.',
    'settings_retrived_error' => 'Error in getting Settings.',
    'page_retrived_error' => 'Error in getting page url.',
    'user_settings_retrive_success' => 'User Settings has been retrived successfully.',
    'user_settings_retrive_error' => 'Error in retrive User Settings',
    'user_settings_update_success' => 'User Settings has been updated successfully.',
    'user_settings_update_error' => 'Error in update User Settings',
    'hazina_data_retrieved' => 'Hazina data retrieved successfully.',
    'account_deactivated' => 'This account is de-activated by Administrator.',
    'invalid_authentication' => 'Session expired. Please try to login again.',
    'package_details_saved_success' => 'Package details saved successfully.',
    'general_data_retrieved' => 'Data retrieved successfully.',

];
