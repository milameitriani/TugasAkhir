<?php 

function active(string $url, string $res = 'active', bool $group = false): String
{
    $active = $group ? request()->is($url) || request()->is($url.'/*') : request()->is($url);

    return $active ? $res : '';
}

function user(string $key)
{
    return auth()->user()->$key;
}

function badge(array $replace): String
{
    $search = ['color', 'text'];
    $badge = '<span class="badge bg-color">text</span>';

    return str_replace($search, $replace, $badge);
}

function local_date(string $date): String
{
    return date('d M Y', strtotime($date));
}

function alert(string $msg): Void
{
    session()->flash('success', $msg);
}

function local(string $filename, string $dir): String
{
    return asset('storage/'.$dir.'/'.$filename);
}

function getRoleName(): String {
    switch (user('role')) {
        case 'admin':
            return 'Admin';
            break;
        case 'kasir':
            return 'Kasir';
            break;
        case 'pelayanan':
            return 'Pelayanan';
            break;
        case 'koki':
            return 'Koki';
            break;
        case 'bar':
            return 'Bar';
            break;
    }
}

function getPaymentMethodName($value) {
    $names = [
        "cash" => "Cash",
        "qris" => "QRIS",
        "bca" => "ATM BCA"
    ];

    return $value ? $names[$value] : '';
}

 ?>