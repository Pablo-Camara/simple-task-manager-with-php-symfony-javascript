<?php

namespace App\DataFixtures;

use App\Entity\Domain;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use DateTime;

class DomainFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $domains = [
          [
            'name' => 'light-life.it',
            'create_date' => '2018-03-11',
            'expiry_date' => '2020-03-10'
          ],
          [
            'name' => 'melhor-oferta.com',
            'create_date' => '2018-12-13',
            'expiry_date' => '2020-12-13'
          ],
          [
            'name' => 'softwaredesign.solutions',
            'create_date' => '2017-12-30',
            'expiry_date' => '2019-12-30'
          ],
          [
            'name' => 'afagamentos.com',
            'create_date' => '2019-03-16',
            'expiry_date' => '2020-03-16'
          ],
          [
            'name' => 'boasprendas.com',
            'create_date' => '2018-11-09',
            'expiry_date' => '2019-11-09'
          ],
          [
            'name' => 'cemporcentomulher.com',
            'create_date' => '2018-11-09',
            'expiry_date' => '2019-11-09'
          ],
          [
            'name' => 'camara.pt',
            'create_date' => '2018-12-06',
            'expiry_date' => '2019-12-05'
          ],
          [
            'name' => 'streetworkout.pt',
            'create_date' => '2018-12-28',
            'expiry_date' => '2019-12-27'
          ],
          [
            'name' => 'ppi.pt',
            'create_date' => '2019-02-19',
            'expiry_date' => '2020-02-18'
          ],
          [
            'name' => 'tabelaflorida.pt',
            'create_date' => '2019-03-16',
            'expiry_date' => '2020-03-15'
          ],
          [
            'name' => 'marciacabeleireiro.com',
            'create_date' => '2019-03-16',
            'expiry_date' => '2020-03-16'
          ]
        ];

        foreach($domains as $domainItem){
          $domain = new Domain();
          $domain->setName($domainItem['name']);
          $domain->setCreateDate(new DateTime($domainItem['create_date']));
          $domain->setExpiryDate(new DateTime($domainItem['expiry_date']));
          $manager->persist($domain);
        }

        $manager->flush();
    }
}
