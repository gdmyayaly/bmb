<?php

namespace App\DataFixtures;

use App\Entity\Category;
use App\Entity\Produits;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $category=[
            ["nom"=>"ALUMINIUM",
            "image"=>"https://c3s.sn/wp-content/uploads/2018/11/s-l300.jpg",
            "slug"=>"aluminium"
            ],
            ["nom"=>"VITRERIE",
            "image"=>"https://c3s.sn/wp-content/uploads/2018/11/CABINE-DE-DOUCHE.jpg",
            "slug"=>"vitrine"
            ],
            ["nom"=>"QUINCAILLERIE GENERALE",
            "image"=>"https://c3s.sn/wp-content/uploads/2019/01/C3S-40253.jpg",
            "slug"=>"quincaillerie-general"
            ],
            ["nom"=>"SYSTEME INOX",
            "image"=>"https://c3s.sn/wp-content/uploads/2018/11/C3S-14235.jpg",
            "slug"=>"systeme-inox"
            ],
            ["nom"=>"FER FORGE",
            "image"=>"https://c3s.sn/wp-content/uploads/2018/12/barregrille.png",
            "slug"=>"fer-forge"
            ],
        ];
        $allproduits=[
            "ALUMINIUM"=>[
                "https://www.bmb.sn/wp-content/uploads/2021/01/alf-euro1.jpg",
                "https://www.bmb.sn/wp-content/uploads/2021/01/alf-euro1.jpg",
                "https://www.bmb.sn/wp-content/uploads/2021/01/alf-euro1.jpg",
                "https://www.bmb.sn/wp-content/uploads/2021/01/alf-euro1.jpg",
                "https://www.bmb.sn/wp-content/uploads/2021/01/alf-euro1.jpg"
            ],
            "VITRERIE"=>[
                "https://c3s.sn/wp-content/uploads/2018/11/C3S-20153.jpg",
                "https://c3s.sn/wp-content/uploads/2018/11/C3S-20153.jpg",
                "https://c3s.sn/wp-content/uploads/2018/11/C3S-20153.jpg"
            ],
            "QUINCAILLERIE GENERALE"=>[
                "https://c3s.sn/wp-content/uploads/2019/01/C3S-70089.jpg",
                "https://c3s.sn/wp-content/uploads/2019/01/C3S-70089.jpg",
                "https://c3s.sn/wp-content/uploads/2019/01/C3S-70089.jpg",
                "https://c3s.sn/wp-content/uploads/2019/01/C3S-70089.jpg",
                "https://c3s.sn/wp-content/uploads/2019/01/C3S-70089.jpg"
            ],
            "SYSTEME INOX"=>[
                "https://c3s.sn/wp-content/uploads/2018/11/C3S-14252.jpg",
                "https://c3s.sn/wp-content/uploads/2018/11/C3S-14252.jpg",
            ],
            "FER FORGE"=>[
                "https://c3s.sn/wp-content/uploads/2019/01/C3S-12021-copie-1.jpg",
                "https://c3s.sn/wp-content/uploads/2019/01/C3S-12021-copie-1.jpg",
                "https://c3s.sn/wp-content/uploads/2019/01/C3S-12021-copie-1.jpg",
            ]
        ];
        for ($i=0; $i < count($category); $i++) { 
            $cate=new Category();
            $cate->setNom($category[$i]["nom"])
                 ->setImage($category[$i]["image"])
                 ->setSlug($category[$i]["slug"])
                 ->setPosition($i+1);
            $manager->persist($cate);
            for ($j=0; $j < count($allproduits[$category[$i]["nom"]]); $j++) { 
                $produit=new Produits();
                $produit->setNom($category[$i]["nom"].$j)
                        ->setImage($allproduits[$category[$i]["nom"]][$j])
                        ->setSlug($category[$i]["slug"].$j)
                        ->setCategorie($cate);
                $manager->persist($produit);
            }
            $manager->persist($cate);
        }
        // $product = new Product();
        // $manager->persist($product);
        $manager->flush();
    }
}
