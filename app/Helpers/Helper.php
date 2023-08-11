<?php
function notify(string $message, string $status = 'success', array $button = null)
{
    return session()->flash('notify', [
        'message' => $message,
        'status' => $status,
        'button' => $button ? [$button[0], $button[1]] : null
    ]);
}

function setting($key, $default = null)
{
    return nova_get_setting($key, $default);
}

function customer()
{
    return auth('customer')->user();
}

function checkAuth()
{
    return auth('customer')->check();
}

function is_phone_number(string $value): bool
{
    return preg_match('/^[0-9]{11}+$/', ltrim($value, "+"));
}