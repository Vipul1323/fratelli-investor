<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Password Reset Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines are the default lines which match reasons
    | that are given by the password broker for a password update attempt
    | has failed, such as for an invalid token or invalid new password.
    |
    */
    'inactive_account' => [
        'page' => 'Any',
        'context' => 'Account Inactive',
        'message_type' => 'flash error',
        'message' => 'Your account is Inactive. Please contact admin to activate your account.',
    ],
    'invalid_credentials' => [
        'page' => 'Signin',
        'context' => 'Invalid username or password',
        'message_type' => 'flash error',
        'message' => 'Invalid username or password.',
    ],
    'forgot_link_sent' => [
        'page' => 'Forgot Password',
        'context' => 'Reset password email',
        'message_type' => 'flash success',
        'message' => 'A password reset link is sent to your registered email.',
    ],
    'token_expired' => [
        'page' => 'Reset Password',
        'context' => 'Reset password link expired.',
        'message_type' => 'flash error',
        'message' => 'Your password reset link is expired. Please request again.',
    ],
    'password_reset_success' => [
        'page' => 'Reset Password',
        'context' => 'Password Reset Successfully.',
        'message_type' => 'flash success',
        'message' => 'Your password is changed successfully.',
    ],
    'edit_profile_success' => [
        'page' => 'Edit Profile',
        'context' => 'Profile Updated Successfully.',
        'message_type' => 'flash success',
        'message' => 'Profile Updated Successfully',
    ],
    'change_password_success' => [
        'page' => 'Change Password',
        'context' => 'Password Changed Successfully.',
        'message_type' => 'flash success',
        'message' => 'Password Changed Successfully.',
    ],
    'invalid_data_provided' => [
        'page' => 'Invalid Data',
        'context' => 'Invalid Data Provided.',
        'message_type' => 'flash error',
        'message' => 'Invalid Data Provided.',
    ],
    'subadmin_success_status' => [
        'page' => 'Status Changed',
        'context' => 'Status Changed Successfully.',
        'message_type' => 'flash success',
        'message' => 'Status Changed Successfully.',
    ],
    'problem_occured' => [
        'page' => 'Problem Occured',
        'context' => 'There is a problem occured. please try again later.',
        'message_type' => 'flash error',
        'message' => 'There is a problem occured. please try again later.',
    ],
    'user_delete_success' => [
        'page' => 'User',
        'context' => 'User Deleted Successfully.',
        'message_type' => 'flash success',
        'message' => 'User Deleted Successfully.',
    ],
    'user_update_success' => [
        'page' => 'User',
        'context' => 'User Updated Successfully.',
        'message_type' => 'flash success',
        'message' => 'User Updated Successfully.',
    ],
    'email_update_success' => [
        'page' => 'User',
        'context' => 'Email Template Updated Successfully.',
        'message_type' => 'flash success',
        'message' => 'Email Template Updated Successfully.',
    ],
    'static_update_success' => [
        'page' => 'User',
        'context' => 'Static Page Updated Successfully.',
        'message_type' => 'flash success',
        'message' => 'Static Page Updated Successfully.',
    ],
    'user_add_success' => [
        'page' => 'User',
        'context' => 'User Added Successfully.',
        'message_type' => 'flash success',
        'message' => 'User Added Successfully.',
    ],
    'subadmin_delete_success' => [
        'page' => 'Subadmin',
        'context' => 'Subadmin Deleted Successfully.',
        'message_type' => 'flash success',
        'message' => 'Subadmin Deleted Successfully.',
    ],
    'subadmin_update_success' => [
        'page' => 'Subadmin',
        'context' => 'Subadmin Updated Successfully.',
        'message_type' => 'flash success',
        'message' => 'Subadmin Updated Successfully.',
    ],
    'subadmin_add_success' => [
        'page' => 'Subadmin',
        'context' => 'Subadmin Added Successfully.',
        'message_type' => 'flash success',
        'message' => 'Subadmin Added Successfully.',
    ],

    'mail_setting_update_success' => [
        'page' => 'Mail Settings',
        'context' => 'Mail Settings Updated Successfully.',
        'message_type' => 'flash success',
        'message' => 'Mail Settings Updated Successfully.',
    ],

    's3_setting_update_success' => [
        'page' => 'AWS S3 Settings',
        'context' => 'AWS S3 Settings Updated Successfully.',
        'message_type' => 'flash success',
        'message' => 'AWS S3 Settings Updated Successfully.',
    ],
];
