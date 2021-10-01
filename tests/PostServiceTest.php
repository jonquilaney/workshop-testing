<?php declare(strict_types=1);

namespace IW\Tests\Workshop;

use IW\Workshop\Client\Curl;
use IW\Workshop\PostService;
use PHPUnit\Framework\TestCase;


class PostServiceTest extends TestCase
{

    public function testCreatePostSuccessful()
    {
        $payload = [];
        $response = [201, '{"id": 101}'];
        $client = $this->mockClient($payload, $response);

        $postService = new PostService($client);

        $createdPostId = $postService->createPost($payload);

        $this->assertEquals($createdPostId, 101);
    }


    /**
     * @expectedException \RuntimeException
     */
    public function testCreatePostShouldThrowExceptionForPostCouldNotBeCreated()
    {
        $payload = [];
        $response = [500, '{}'];
        $client = $this->mockClient($payload, $response);

        $postService = new PostService($client);

        $postService->createPost($payload);
    }


    /**
     * @expectedException \RuntimeException
     */
    public function testCreatePostShouldThrowExceptionForMissingIdInResponse()
    {
        $payload = [];
        $response = [201, '{}'];
        $client = $this->mockClient($payload, $response);

        $postService = new PostService($client);

        $postService->createPost($payload);
    }


    private function mockClient(array $payload, array $response)
    {
        return \Mockery::mock(Curl::class)
            ->shouldReceive('post')
            ->withArgs([
               'https://jsonplaceholder.typicode.com/posts',
               json_encode($payload),
               [
                   'content-type' => 'application/json'
               ]
            ])
            ->andReturn($response)
            ->getMock();
    }

}

