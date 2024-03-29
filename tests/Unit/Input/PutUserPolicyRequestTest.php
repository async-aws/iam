<?php

namespace AsyncAws\Iam\Tests\Unit\Input;

use AsyncAws\Core\Test\TestCase;
use AsyncAws\Iam\Input\PutUserPolicyRequest;

class PutUserPolicyRequestTest extends TestCase
{
    public function testRequest(): void
    {
        $input = new PutUserPolicyRequest([
            'UserName' => 'Bob',
            'PolicyName' => 'All Access Policy',
            'PolicyDocument' => '{"Version":"2012-10-17","Statement":{"Effect":"Allow","Action":"*","Resource":"*"}}',
        ]);

        // see example-1.json from SDK
        $expected = '
            POST / HTTP/1.0
            Content-Type: application/x-www-form-urlencoded

            Action=PutUserPolicy
            &UserName=Bob
            &PolicyName=All+Access+Policy
            &PolicyDocument=%7B%22Version%22%3A%222012-10-17%22%2C%22Statement%22%3A%7B%22Effect%22%3A%22Allow%22%2C%22Action%22%3A%22%2A%22%2C%22Resource%22%3A%22%2A%22%7D%7D
            &Version=2010-05-08
                ';

        self::assertRequestEqualsHttpRequest($expected, $input->request());
    }
}
