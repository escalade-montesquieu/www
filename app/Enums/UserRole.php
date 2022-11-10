<?php

namespace App\Enums;

enum UserRole: string
{
    case STUDENT = 'student';
    case MODERATOR = 'moderator';
    case ADMIN = 'admin';
}
