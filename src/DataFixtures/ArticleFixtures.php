<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Article;
use App\Entity\Categorie;
use App\Entity\Commentaire;

class ArticleFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);

        $faker = \Faker\Factory::create();
        
        for($i=0; $i<3; $i++)
        {   
            $categorie = new Categorie();
            $categorie ->setTitre ($faker->sentence())
                       ->setResumer ($faker->paragraph());
        
        $manager ->persist($categorie);
    
            for($j=0; $j<10; $j++)
            {
                $article = new Article();
                $article ->setTitle($faker->sentence())
                         ->setContent($faker->paragraph($nbSentences = 10, $variableNbSentences = true))
                         ->setImage($faker->imageUrl($width=400, $height=200))
                         ->setCreatedAt(new \DateTime())
                         ->setCategorie ($categorie);
            
            $manager->persist($article);
        
                for($k=0; $k<5; $k++)
                {
                    $commentaire = new commentaire();
                    $commentaire ->setAuteur($faker->userName())
                                 ->setCommentaire($faker->paragraph())
                                 ->setCreatedAt(new \DateTime())
                                 ->setArticle ($article);

                $manager->persist($commentaire);

                }
            }
        }

    $manager->flush(); 
        
    }
    
}