<?php
const alphabet = ['a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z'];
const k = 10;
const n = 26;

function ceasar_encode($str)
{
    $str = strtolower($str);
    $length = strlen($str);
    $encode_str = '';
    for ($i = 0; $i < $length; $i++) {
        for ($j = 0; $j < n; $j++) {
            if ($str[$i] == alphabet[$j]) {
                $str .= alphabet[($j + k) % n];
                break;
            }
            if ($j == 25) // khi vòng lặp đã chạy đến cuối cùng
                $encode_str .= $str[$i]; // nếu là kí tự không nằm trong alphabet
        }
    }
    return $encode_str;
}

function ceasar_decode($encode_str)
{
    $encode_str = strtolower($encode_str);
    $length = strlen($encode_str);
    $decode_str = '';
    for ($i = 0; $i < $length; $i++) {
        for ($j = 0; $j < n; $j++) {
            if ($encode_str[$i] == alphabet[$j]) {
                $tmp = $j - k;
                if ($tmp < 0) { // nếu trừ ra số âm
                    $decode_str .= alphabet[n + $tmp];
                    break;
                } else { // nếu trừ ra số dương
                    $decode_str .= alphabet[($j - k) % n];
                    break;
                }
            }
            if ($j == 25) // chạy đến cuối
                $decode_str .= $encode_str[$i];
        }
    }
    return $decode_str;
}
