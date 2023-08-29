<?php

namespace App\Constants;

class ServiceResponseMessages
{
    const REGISTER_SUCCESS = 'Account created successfully.';
    const REGISTER_ERROR = 'Unable to create account. Please try again later.';
    const EMAIL_NOT_FOUND = 'Email does not exists.';
    const INCORRECT_PASSWORD = 'Incorrect password.';
    const LOGIN_SUCCESS = 'Authenticated.';
    const LOGOUT_SUCCESS = 'Logged out successfully.';
    const LOGOUT_ERROR = 'Unable to logout. Please try again later.';
    const UPDATE_TASK_SUCCESS = 'Task updated successfully.';
    const UPDATE_TASK_ERROR = 'Unable to update task. Please try again later.';
    const DELETE_TASK_SUCCESS = 'Task deleted successfully.';
    const DELETE_TASK_ERROR = 'Unable to delete task. Please try again later.';

    const UNAUTHENTICATED = 'Unauthenticated.';
}