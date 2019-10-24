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
        for($i=0; $i<10; $i++)
        {
            $article = new Article();
            $article->setTitle('article n°')
                    ->setContent('contenue n°')
                    ->setImage('image n°')
                    ->setCreatedAt(new \DateTime());
            
            $manager->persist($article);
        
        }
     
    $manager->flush();
        
    }
    
}
