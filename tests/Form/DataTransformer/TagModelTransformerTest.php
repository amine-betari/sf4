<?php
/**
 * Created by PhpStorm.
 * User: aminebetari
 * Date: 18/04/20
 * Time: 21:31
 */

namespace App\Tests\Form\DataTransformer;

use PHPUnit\Framework\TestCase;
use App\Repository\TagRepository;
use App\Form\DataTransformer\TagModelTransformer;


class TagModelTransformerTest extends TestCase
{
    private $repo;
    private $transformer;

    protected function setUp()/* The :void return type declaration that should be here would cause a BC issue */
    {
        $this->repo        = $this->createMock(TagRepository::class);
        $this->transformer = new TagModelTransformer($this->repo);
    }

    public function testTransform()
    {
        $tags = ['tag1, tag2, tag3'];
        $this->assertIsArray($this->transformer->transform($tags), 'DJALIL TEST Unit One');

    }

    public function testreverseTransform()
    {
        $tags = ['tag1, tag2, tag3'];
        $this->assertIsNotArray($this->transformer->reverseTransform($tags));
    }
}