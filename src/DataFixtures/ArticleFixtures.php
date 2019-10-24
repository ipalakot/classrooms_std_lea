<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Article;

class ArticleFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);

        for ($i=0; $i>10; $i++)
        {
            $article = new Article();
            $article->setTitle('Titre de larticle');
            $article->setContent('contenue de larticle');
            $article->setImage('image de larticle');
            $article->setCreated_At ('new \date');
            $article->setResumer ('resumer de larticle');

            $manager->persist($article);
       
        }
        $manager->flush();
    }
}
