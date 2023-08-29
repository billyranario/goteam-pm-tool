<?php

namespace App\Constants;

class ServiceResponseMessages
{
    const REGISTER_SUCCESS = 'Account created successfully.';
    const REGISTER_ERROR = 'Unable to create account.Please try again later.';
    const EMAIL_NOT_FOUND = 'Email does not exists.';
    const INCORRECT_PASSWORD = 'Incorrect password.';
    const LOGIN_SUCCESS = 'Authenticated.';
}