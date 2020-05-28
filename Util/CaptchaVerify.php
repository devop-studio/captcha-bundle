<?php

namespace DevOpStudio\Bundle\CaptchaBundle\Util;

use Symfony\Component\HttpFoundation\RequestStack;

class CaptchaVerify
{

    const VERIFY_URL = 'https://hcaptcha.com/siteverify';

    /**
     * @var string
     */
    private $secret;

    /**
     * @var RequestStack
     */
    private $requestStack;

    /**
     * CaptchaVerify constructor.
     *
     * @param RequestStack $requestStack
     * @param string $secret
     */
    public function __construct(RequestStack $requestStack, string $secret)
    {
        $this->secret = $secret;
        $this->requestStack = $requestStack;
    }

    public function validate()
    {
        $request = $this->requestStack->getMasterRequest();

        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_URL => self::VERIFY_URL,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POSTFIELDS => [
                'secret' => $this->secret,
                'response' => $request->request->get('h-captcha-response', null)
            ]
        ]);

        $error = curl_error($curl);
        if (!$response = curl_exec($curl)) {
            throw new \Exception(curl_error($curl));
        }

        curl_close($curl);

        $results = json_decode($response, true, JSON_THROW_ON_ERROR);

        return !!$results['success'];
    }
}
