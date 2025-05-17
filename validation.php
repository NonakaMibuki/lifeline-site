<?php

function validation($request)
{

    $errors = [];

    if (empty($request['name']) || 20 < mb_strlen($request['name'])) {
        $errors[] = 'お名前は必須です。';
    }

    if (empty($request['email']) || !filter_var($request['email'], FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'メールアドレスは必須です。正しい形式で入力してください。';
    }

    if (empty($request['tel']) || !preg_match('/^(0{1}\d{1,4}-{0,1}\d{1,4}-{0,1}\d{4})$/', $request['tel'])) {
        $errors[] = '電話番号は必須です。正しい形式で入力してください。（例: 090-1234-5678）';
    }

    if (empty(mb_ereg_replace("^[\s　]+|[\s　]+$", '', $request['contact']))) {
        $errors[] = 'お問い合わせ内容は必須です。';
    }    

    if (empty($request['checkbox']) || $request['checkbox'] !== 'on') {
        $errors[] = '利用規約への同意が必要です。';
    }

    return $errors;
}

?>