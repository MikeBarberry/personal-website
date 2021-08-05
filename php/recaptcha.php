<?php

$data = json_decode(file_get_contents("php://input"), true);
$task = $data['response'];

try {
    $postdata = http_build_query( [
        'secret'   => '6LcR8tcbAAAAAN5q4WnT0G4YF1z5xrPoMr3BhM6a',
        'response' => $task
    ] );
    
    $opts = [
        'http' => [
            'method'  => 'POST',
            'header'  => 'Content-type: application/x-www-form-urlencoded',
            'content' => $postdata
        ]
    ];
    
    $context  = stream_context_create( $opts );
    
    $result = file_get_contents(
        'https://www.google.com/recaptcha/api/siteverify', false, $context
    );
    
    $check = json_decode( $result );
    if( $check->success ) {
        echo "validate";
    } else {
        echo "wrong recaptcha";
    }
    /* echo 'ok mouse foo bar';
    echo $task; */
} catch(error) {
    echo 'error';
}