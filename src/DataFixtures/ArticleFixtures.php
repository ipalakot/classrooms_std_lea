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
        
        for($i=0; $i<3; $i++)
        {   
            $categorie = new Categorie();
            $categorie ->setTitre ('titre n°')
                       ->setResumer ('resumer n°');
        
        $manager ->persist($categorie);
    
            for($j=0; $j<10; $j++)
            {
                $article = new Article();
                $article ->setTitle('article n°')
                         ->setContent('contenue n°')
                         ->setImage('image n°')
                         ->setCreatedAt(new \DateTime())
                         ->setCategorie ($categorie);
            
            $manager->persist($article);
        
                for($k=0; $k<5; $k++)
                {
                    $commentaire = new commentaire();
                    $commentaire ->setAuteur('auteur')
                                 ->setCommentaire('Commentaire')
                                 ->setCreatedAt(new \DateTime())
                                 ->setArticle ($article);

                $manager->persist($commentaire);

                }
            }
        }

    $manager->flush(); 
        
    }
    
}