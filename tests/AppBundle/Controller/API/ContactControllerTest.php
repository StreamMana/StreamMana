<?php

namespace Tests\AppBundle\Controller\API;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ContactControllerTest extends WebTestCase
{
    public function testPost()
    {
        $client = static::createClient();
        $client->request(
            'POST',
            '/api/contact',
            array(),
            array(),
            array('CONTENT_TYPE' => 'application/json'),
            '{"name":"Name1","mail":"mail@mail.com","phone":"985050505","message":"Example message"}'
        );
        $this->assertEquals(201, $client->getResponse()->getStatusCode());
    }
    public function testPostError()
    {
        $client = static::createClient();
        $client->request(
            'POST',
            '/api/contact',
            array(),
            array(),
            array('CONTENT_TYPE' => 'application/json'),
            '{"title":"title1","body":"body1"}'
        );
        $this->assertEquals(400, $client->getResponse()->getStatusCode());
    }
}
